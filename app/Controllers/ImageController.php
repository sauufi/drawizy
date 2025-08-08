<?php

namespace App\Controllers;

use App\Models\Image;
use App\Models\Category;
use App\Models\Setting;
use App\Models\Tag;
use App\Core\View;

/**
 * ImageController with PDF compression and A4 format enforcement
 * 
 * @package App\Controllers
 */
class ImageController
{
    // PDF compression configuration
    private $pdfCompressionEnabled = true;
    private $maxPdfSize = 2 * 1024 * 1024; // 2MB - compress if larger
    private $compressionQuality = 75; // 1-100, lower = more compression

    public function index()
    {
        $this->checkAuth();

        $db = \App\Core\Database::getInstance();

        // Get search query and pagination parameters
        $search = $_GET['q'] ?? '';
        $categoryFilter = $_GET['category'] ?? '';
        $page = max(1, (int)($_GET['page'] ?? 1));
        $perPage = (int)($_GET['per_page'] ?? 20); // Allow dynamic per page
        $perPage = min(100, max(10, $perPage)); // Limit between 10-100
        $offset = ($page - 1) * $perPage;

        // Build WHERE clause conditions
        $conditions = [];
        $params = [];

        if ($search) {
            $conditions[] = "i.title LIKE ?";
            $params[] = "%$search%";
        }

        if ($categoryFilter) {
            $conditions[] = "i.category_id = ?";
            $params[] = $categoryFilter;
        }

        $whereClause = '';
        if (!empty($conditions)) {
            $whereClause = 'WHERE ' . implode(' AND ', $conditions);
        }

        // Count total records for pagination calculation
        $countQuery = "SELECT COUNT(*) as total 
                   FROM images i 
                   LEFT JOIN categories c ON i.category_id = c.id
                   $whereClause";

        $stmt = $db->prepare($countQuery);
        $stmt->execute($params);
        $total = $stmt->fetch()['total'];
        $totalPages = ceil($total / $perPage);

        // Get images for current page with full information
        $sql = "SELECT i.*, 
                   c.name as category_name,
                   c.slug as category_slug,
                   p.name as parent_category_name,
                   p.slug as parent_category_slug,
                   GROUP_CONCAT(t.name ORDER BY t.name ASC SEPARATOR ', ') as tags
            FROM images i 
            LEFT JOIN categories c ON i.category_id = c.id
            LEFT JOIN categories p ON c.parent_id = p.id
            LEFT JOIN image_tags it ON i.id = it.image_id
            LEFT JOIN tags t ON it.tag_id = t.id
            $whereClause
            GROUP BY i.id
            ORDER BY i.created_at DESC 
            LIMIT $perPage OFFSET $offset";

        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        $images = $stmt->fetchAll();

        // Get all categories for filter dropdown
        $categories = \App\Models\Category::all();

        View::render('images/index.php', [
            'images' => $images,
            'search' => $search,
            'categoryFilter' => $categoryFilter,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'total' => $total,
            'perPage' => $perPage,
            'categories' => $categories
        ], 'layouts/admin.php');
    }

    public function create()
    {
        $this->checkAuth();
        $categories = Category::all();
        $popularTags = Tag::getPopular(10);
        View::render('images/form.php', [
            'categories' => $categories,
            'popularTags' => $popularTags
        ], 'layouts/admin.php');
    }

    public function store()
    {
        $this->checkAuth();
        $title = $_POST['title'];
        $category_id = $_POST['category_id'];
        $slug = $this->slugify($title);
        $meta_title = $_POST['meta_title'] ?? null;
        $meta_description = $_POST['meta_description'] ?? null;

        $file = $_FILES['image'];
        $filename = time() . "_" . $this->slugify(pathinfo(basename($file['name']), PATHINFO_FILENAME)) . ".pdf";

        // Create upload directory if it doesn't exist
        $uploadDir = __DIR__ . "/../../public/uploads/pdf/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $filePath = $uploadDir . $filename;
        move_uploaded_file($file['tmp_name'], $filePath);

        // Compress PDF if enabled and file is too large
        if ($this->pdfCompressionEnabled && filesize($filePath) > $this->maxPdfSize) {
            $this->compressPdf($filePath);
        }

        $result = Image::store($title, $filename, null, $slug, $category_id, $meta_title, $meta_description);

        if ($result['status']) {
            $imageId = $result['id'];

            // Handle tags
            if (!empty($_POST['manual_tags'])) {
                $tagIds = Tag::processTagsFromInput($_POST['manual_tags']);
                if (!empty($tagIds)) {
                    Tag::setForImage($imageId, $tagIds);
                }
            }
        }

        header("Location: /dashboard/images");
        exit;
    }

    /**
     * Store multiple PDF files with optional thumbnails and compression
     */
    public function storeMultiple()
    {
        $this->checkAuth();

        if (!isset($_FILES['pdf_files'])) {
            echo json_encode(['status' => 'error', 'message' => 'No PDF files uploaded']);
            return;
        }

        $category_id = $_POST['category_id'];
        $meta_title = $_POST['meta_title'] ?? null;
        $meta_description = $_POST['meta_description'] ?? null;
        $tags_input = $_POST['manual_tags'] ?? '';
        $time = time();

        $pdfFiles = $_FILES['pdf_files'];
        $thumbFiles = $_FILES['thumb_files'] ?? null;

        // Create directories if not exist
        $pdfDir = __DIR__ . "/../../public/uploads/pdf/";
        $imageDir = __DIR__ . "/../../public/uploads/images/";

        if (!is_dir($pdfDir)) {
            mkdir($pdfDir, 0755, true);
        }
        if (!is_dir($imageDir)) {
            mkdir($imageDir, 0755, true);
        }

        $totalFiles = count($pdfFiles['name']);
        $results = [];
        $compressionStats = [];

        // Process tags once for all images
        $tagIds = [];
        if (!empty($tags_input)) {
            $tagIds = Tag::processTagsFromInput($tags_input);
        }

        for ($i = 0; $i < $totalFiles; $i++) {
            // Extract title from PDF filename
            $title = pathinfo($pdfFiles['name'][$i], PATHINFO_FILENAME);
            $slug = $this->slugify($title);
            $title = $this->slugifytitle($title);

            // Save PDF file
            $pdfName = $time . "_" . $this->slugify(pathinfo(basename($pdfFiles['name'][$i]), PATHINFO_FILENAME)) . ".pdf";
            $pdfPath = $pdfDir . $pdfName;
            move_uploaded_file($pdfFiles['tmp_name'][$i], $pdfPath);

            // Compress PDF if enabled and file is too large
            $originalSize = filesize($pdfPath);
            $compressed = false;

            if ($this->pdfCompressionEnabled && $originalSize > $this->maxPdfSize) {
                $compressedSize = $this->compressPdf($pdfPath);
                if ($compressedSize && $compressedSize < $originalSize) {
                    $compressed = true;
                    $compressionStats[] = [
                        'file' => $pdfName,
                        'original_size' => $originalSize,
                        'compressed_size' => $compressedSize,
                        'reduction' => round((($originalSize - $compressedSize) / $originalSize) * 100, 1)
                    ];
                }
            }

            // Save thumbnail if provided (match index)
            $thumbName = null;
            if ($thumbFiles && !empty($thumbFiles['name'][$i])) {
                $thumbExtension = strtolower(pathinfo($thumbFiles['name'][$i], PATHINFO_EXTENSION));
                $baseThumbName = strtolower(pathinfo($time . "_" . basename($thumbFiles['name'][$i]), PATHINFO_FILENAME));

                $thumbName = strtolower($time . "_" . basename($thumbFiles['name'][$i]));

                if (in_array($thumbExtension, ['jpg', 'jpeg', 'png', 'gif'])) {
                    // Create tiny variant (75x100px)
                    $tinyThumbName = $baseThumbName . '_tiny.' . $thumbExtension;
                    $this->resizeImage($thumbFiles['tmp_name'][$i], $imageDir . $tinyThumbName, 75, 100);

                    // Create small variant (240x320px)
                    $smallThumbName = $baseThumbName . '_small.' . $thumbExtension;
                    $this->resizeImage($thumbFiles['tmp_name'][$i], $imageDir . $smallThumbName, 240, 320);

                    // Create medium variant (465x620px)
                    $mediumThumbName = $baseThumbName . '_medium.' . $thumbExtension;
                    $this->resizeImage($thumbFiles['tmp_name'][$i], $imageDir . $mediumThumbName, 465, 620);

                    // Create large variant (600x800px)
                    $largeThumbName = $baseThumbName . '_large.' . $thumbExtension;
                    $this->resizeImage($thumbFiles['tmp_name'][$i], $imageDir . $largeThumbName, 600, 800);

                    // Create origin variant (1200x1600px)
                    $originThumbName = $baseThumbName . '_origin.' . $thumbExtension;
                    $this->resizeImage($thumbFiles['tmp_name'][$i], $imageDir . $originThumbName, 1200, 1600);
                }
            }

            // Store record with SEO meta
            $result = Image::store($title, $pdfName, $thumbName, $slug, $category_id, $meta_title, $meta_description);

            if ($result['status'] && !empty($tagIds)) {
                Tag::setForImage($result['id'], $tagIds);
            }

            $results[] = [
                'pdf' => $pdfName,
                'preview' => $thumbName,
                'compressed' => $compressed,
                'original_size' => $originalSize,
                'final_size' => filesize($pdfPath)
            ];
        }

        $response = [
            'status' => 'success',
            'uploaded' => $results
        ];

        // Add compression statistics if any files were compressed
        if (!empty($compressionStats)) {
            $response['compression_stats'] = $compressionStats;
        }

        echo json_encode($response);
    }

    public function edit($id)
    {
        $this->checkAuth();
        $image = Image::find($id);
        $categories = Category::all();
        $popularTags = Tag::getPopular(10);
        $imageTags = Tag::getByImageId($id);

        if (!$image) {
            http_response_code(404);
            echo "Image not found";
            exit;
        }

        View::render('images/edit.php', [
            'image' => $image,
            'categories' => $categories,
            'popularTags' => $popularTags,
            'imageTags' => $imageTags
        ], 'layouts/admin.php');
    }

    // Method update($id) - Updated untuk handle variants and compression
    public function update($id)
    {
        $this->checkAuth();

        $title = $_POST['title'];
        $slug = $_POST['slug'];
        $category_id = $_POST['category_id'];
        $meta_title = $_POST['meta_title'] ?? null;
        $meta_description = $_POST['meta_description'] ?? null;
        $time = time();

        // Create directories if not exist
        $pdfDir = __DIR__ . "/../../public/uploads/pdf/";
        $imageDir = __DIR__ . "/../../public/uploads/images/";

        if (!is_dir($pdfDir)) {
            mkdir($pdfDir, 0755, true);
        }
        if (!is_dir($imageDir)) {
            mkdir($imageDir, 0755, true);
        }

        // Handle PDF file upload (optional)
        $filename = $_POST['existing_filename'];
        if (!empty($_FILES['pdf_file']['name'])) {
            $filename = strtolower($time . "_" . basename($_FILES['pdf_file']['name']));
            $pdfPath = $pdfDir . $filename;
            move_uploaded_file($_FILES['pdf_file']['tmp_name'], $pdfPath);

            // Compress PDF if enabled and file is too large
            if ($this->pdfCompressionEnabled && filesize($pdfPath) > $this->maxPdfSize) {
                $this->compressPdf($pdfPath);
            }
        }

        // Handle thumbnail upload (optional) with variants
        $preview = $_POST['existing_preview'];
        if (!empty($_FILES['thumb_file']['name'])) {
            $thumbExtension = strtolower(pathinfo($_FILES['thumb_file']['name'], PATHINFO_EXTENSION));
            $baseThumbName = strtolower(pathinfo($time . "_" . basename($_FILES['thumb_file']['name']), PATHINFO_FILENAME));

            if (in_array($thumbExtension, ['jpg', 'jpeg', 'png', 'gif'])) {
                // Delete old variants if exist
                if ($preview) {
                    $this->deleteImageVariants($preview);
                }

                // Create tiny variant (75x100px)
                $tinyThumbName = $baseThumbName . '_tiny.' . $thumbExtension;
                $this->resizeImage($_FILES['thumb_file']['tmp_name'], $imageDir . $tinyThumbName, 75, 100);

                // Create small variant (240x320px)
                $smallThumbName = $baseThumbName . '_small.' . $thumbExtension;
                $this->resizeImage($_FILES['thumb_file']['tmp_name'], $imageDir . $smallThumbName, 240, 320);

                // Create medium variant (465x620px)
                $mediumThumbName = $baseThumbName . '_medium.' . $thumbExtension;
                $this->resizeImage($_FILES['thumb_file']['tmp_name'], $imageDir . $mediumThumbName, 465, 620);

                // Create large variant (600x800px)
                $largeThumbName = $baseThumbName . '_large.' . $thumbExtension;
                $this->resizeImage($_FILES['thumb_file']['tmp_name'], $imageDir . $largeThumbName, 600, 800);

                // Create origin variant (1200x1600px)
                $originThumbName = $baseThumbName . '_origin.' . $thumbExtension;
                $this->resizeImage($_FILES['thumb_file']['tmp_name'], $imageDir . $originThumbName, 1200, 1600);

                $preview = strtolower($time . "_" . basename($_FILES['thumb_file']['name']));
            }
        }

        // Update DB (auto slug uniqueness already handled in model)
        Image::updateImage(
            $id,
            $title,
            $filename,
            $preview,
            $slug,
            $category_id,
            $meta_title,
            $meta_description
        );

        // Handle tags
        if (isset($_POST['manual_tags'])) {
            $tagIds = Tag::processTagsFromInput($_POST['manual_tags']);
            Tag::setForImage($id, $tagIds);
        }

        header("Location: /dashboard/images");
    }

    public function checkSlug()
    {
        $slug = $_GET['slug'];
        $id = $_GET['id'] ?? null;
        $unique = Image::isSlugUnique($slug, $id);
        header('Content-Type: application/json');
        echo json_encode(['unique' => $unique]);
    }

    // Method delete($id) - Updated untuk hapus semua variants
    public function delete($id)
    {
        $this->checkAuth();

        // Get image data first
        $db = \App\Core\Database::getInstance();
        $stmt = $db->prepare("SELECT filename, preview FROM images WHERE id=?");
        $stmt->execute([$id]);
        $image = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($image) {
            // Delete main file
            if ($image['filename']) {
                // Check if it's in PDF folder
                $pdfPath = __DIR__ . "/../../public/uploads/pdf/" . $image['filename'];
                if (file_exists($pdfPath)) {
                    @unlink($pdfPath);
                }

                // Check if it's in images folder (or old uploads folder)
                $imagePath = __DIR__ . "/../../public/uploads/images/" . $image['filename'];
                if (file_exists($imagePath)) {
                    @unlink($imagePath);
                    // Delete variants if they exist
                    $this->deleteImageVariants($image['filename']);
                }

                // Check old uploads folder for backward compatibility
                $oldPath = __DIR__ . "/../../public/uploads/" . $image['filename'];
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                }
            }

            // Delete preview file and its variants
            if ($image['preview']) {
                $previewPath = __DIR__ . "/../../public/uploads/images/" . $image['preview'];
                if (file_exists($previewPath)) {
                    @unlink($previewPath);
                    $this->deleteImageVariants($image['preview']);
                }

                // Check old uploads folder for backward compatibility
                $oldPreviewPath = __DIR__ . "/../../public/uploads/" . $image['preview'];
                if (file_exists($oldPreviewPath)) {
                    @unlink($oldPreviewPath);
                }
            }
        }

        // Remove all tag associations first
        Tag::removeAllFromImage($id);

        // Then delete the image record
        Image::delete($id);

        header("Location: /dashboard/images");
        exit;
    }

    /**
     * Compress PDF file using available methods with A4 format enforcement
     * 
     * @param string $filePath Full path to the PDF file
     * @return int|false New file size or false on failure
     */
    private function compressPdf($filePath)
    {
        if (!file_exists($filePath)) {
            return false;
        }

        $originalSize = filesize($filePath);
        $tempPath = $filePath . '.tmp';
        $compressed = false;

        // Method 1: Try Ghostscript (most effective for A4 format + compression)
        if ($this->isGhostscriptAvailable()) {
            $compressed = $this->compressPdfWithGhostscript($filePath, $tempPath);
        }

        // Method 2: Try Imagick as fallback
        if (!$compressed && extension_loaded('imagick')) {
            $compressed = $this->compressPdfWithImagick($filePath, $tempPath);
        }

        // Method 3: Try system pdftk as another fallback
        if (!$compressed && $this->isPdftkAvailable()) {
            $compressed = $this->compressPdfWithPdftk($filePath, $tempPath);
        }

        // If compression was successful, replace original file
        if ($compressed && file_exists($tempPath)) {
            $newSize = filesize($tempPath);

            // Only use compressed version if it's valid and not corrupted
            if ($newSize > 0 && $this->validatePdf($tempPath)) {
                rename($tempPath, $filePath);
                return $newSize;
            } else {
                // Compressed version has issues, remove it
                @unlink($tempPath);
                error_log("PDF compression resulted in invalid file: " . $filePath);
            }
        }

        // Clean up temp file if it exists
        if (file_exists($tempPath)) {
            @unlink($tempPath);
        }

        return false;
    }

    /**
     * Compress PDF using Ghostscript with A4 format enforcement
     */
    private function compressPdfWithGhostscript($inputPath, $outputPath)
    {
        $quality = $this->getGhostscriptQuality();

        // A4 dimensions in points: 595.276 x 841.890
        $command = sprintf(
            'gs -sDEVICE=pdfwrite -dCompatibilityLevel=1.4 -dPDFSETTINGS=/%s -dNOPAUSE -dQUIET -dBATCH -dFIXEDMEDIA -dPDFFitPage -g5953x8419 -sPAPERSIZE=a4 -sOutputFile="%s" "%s" 2>&1',
            $quality,
            $outputPath,
            $inputPath
        );

        $output = [];
        $return_var = 0;
        exec($command, $output, $return_var);

        return $return_var === 0 && file_exists($outputPath) && filesize($outputPath) > 0;
    }

    /**
     * Compress PDF using Imagick with A4 format enforcement
     */
    private function compressPdfWithImagick($inputPath, $outputPath)
    {
        try {
            /** @var \Imagick $imagick */
            $imagick = new \Imagick();

            // Set A4 dimensions (595.276 x 841.890 points at 72 DPI = 8.27 x 11.69 inches)
            $imagick->setResolution(150, 150); // Reduce resolution for compression
            $imagick->readImage($inputPath);

            // Process each page to ensure A4 format
            $imagick = $imagick->coalesceImages();
            foreach ($imagick as $page) {
                /** @var \Imagick $page */
                // Set A4 page size (595.276 x 841.890 points)
                $page->setImagePage(595, 842, 0, 0);
                $page->scaleImage(2300, 3250, true); // Scale to fit A4 with aspect ratio

                // Set compression quality
                $page->setImageCompressionQuality($this->compressionQuality);
                $page->setCompression(\Imagick::COMPRESSION_JPEG);
                $page->setImageFormat('pdf');
            }

            // Write compressed PDF with A4 format
            $imagick->writeImages($outputPath, true);
            $imagick->clear();
            $imagick->destroy();

            return file_exists($outputPath) && filesize($outputPath) > 0;
        } catch (\Exception $e) {
            error_log("Imagick PDF compression failed: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Compress PDF using pdftk with A4 format enforcement
     */
    private function compressPdfWithPdftk($inputPath, $outputPath)
    {
        // First, try to enforce A4 format using pdftk
        $tempA4Path = $inputPath . '.a4.tmp';

        // Create A4 formatted version
        $a4Command = sprintf(
            'pdftk "%s" output "%s" 2>&1',
            $inputPath,
            $tempA4Path
        );

        $output = [];
        $return_var = 0;
        exec($a4Command, $output, $return_var);

        // If A4 formatting worked, compress the A4 version
        if ($return_var === 0 && file_exists($tempA4Path)) {
            $compressCommand = sprintf(
                'pdftk "%s" output "%s" compress 2>&1',
                $tempA4Path,
                $outputPath
            );

            exec($compressCommand, $output, $return_var);

            // Clean up temp file
            @unlink($tempA4Path);

            return $return_var === 0 && file_exists($outputPath) && filesize($outputPath) > 0;
        }

        // Fallback: just compress without A4 formatting
        $command = sprintf(
            'pdftk "%s" output "%s" compress 2>&1',
            $inputPath,
            $outputPath
        );

        exec($command, $output, $return_var);

        return $return_var === 0 && file_exists($outputPath) && filesize($outputPath) > 0;
    }

    /**
     * Check if Ghostscript is available
     */
    private function isGhostscriptAvailable()
    {
        $output = [];
        $return_var = 0;
        exec('gs -version 2>&1', $output, $return_var);
        return $return_var === 0;
    }

    /**
     * Check if pdftk is available
     */
    private function isPdftkAvailable()
    {
        $output = [];
        $return_var = 0;
        exec('pdftk --version 2>&1', $output, $return_var);
        return $return_var === 0;
    }

    /**
     * Get Ghostscript quality setting based on compression quality
     */
    private function getGhostscriptQuality()
    {
        if ($this->compressionQuality >= 80) {
            return 'prepress';  // High quality
        } elseif ($this->compressionQuality >= 60) {
            return 'printer';   // Medium quality
        } elseif ($this->compressionQuality >= 40) {
            return 'ebook';     // Lower quality
        } else {
            return 'screen';    // Lowest quality
        }
    }

    // Helper method untuk resize gambar
    private function resizeImage($sourcePath, $destinationPath, $targetWidth, $targetHeight)
    {
        list($originalWidth, $originalHeight, $imageType) = getimagesize($sourcePath);

        // Create image resource based on type
        switch ($imageType) {
            case IMAGETYPE_JPEG:
                $sourceImage = imagecreatefromjpeg($sourcePath);
                break;
            case IMAGETYPE_PNG:
                $sourceImage = imagecreatefrompng($sourcePath);
                break;
            case IMAGETYPE_GIF:
                $sourceImage = imagecreatefromgif($sourcePath);
                break;
            default:
                return false;
        }

        // Calculate aspect ratio and new dimensions
        $aspectRatio = $originalWidth / $originalHeight;
        $targetAspectRatio = $targetWidth / $targetHeight;

        if ($aspectRatio > $targetAspectRatio) {
            // Image is wider than target ratio
            $newWidth = $targetWidth;
            $newHeight = $targetWidth / $aspectRatio;
        } else {
            // Image is taller than target ratio
            $newWidth = $targetHeight * $aspectRatio;
            $newHeight = $targetHeight;
        }

        // Create new image
        $newImage = imagecreatetruecolor($targetWidth, $targetHeight);

        // Handle transparency for PNG and GIF
        if ($imageType == IMAGETYPE_PNG || $imageType == IMAGETYPE_GIF) {
            imagealphablending($newImage, false);
            imagesavealpha($newImage, true);
            $transparent = imagecolorallocatealpha($newImage, 255, 255, 255, 127);
            imagefill($newImage, 0, 0, $transparent);
        } else {
            // Fill with white background for JPEG
            $white = imagecolorallocate($newImage, 255, 255, 255);
            imagefill($newImage, 0, 0, $white);
        }

        // Center the resized image
        $xOffset = (int)(($targetWidth - $newWidth) / 2);
        $yOffset = (int)(($targetHeight - $newHeight) / 2);

        // Resize and copy
        imagecopyresampled(
            $newImage,
            $sourceImage,
            $xOffset,
            $yOffset,
            0,
            0,
            (int)$newWidth,
            (int)$newHeight,
            $originalWidth,
            $originalHeight
        );

        // Save image based on type
        $result = false;
        switch ($imageType) {
            case IMAGETYPE_JPEG:
                $result = imagejpeg($newImage, $destinationPath, 85);
                break;
            case IMAGETYPE_PNG:
                $result = imagepng($newImage, $destinationPath, 8);
                break;
            case IMAGETYPE_GIF:
                $result = imagegif($newImage, $destinationPath);
                break;
        }

        // Clean up
        imagedestroy($sourceImage);
        imagedestroy($newImage);

        return $result;
    }

    // Helper method untuk hapus varian gambar
    private function deleteImageVariants($filename)
    {
        $imageDir = __DIR__ . "/../../public/uploads/images/";

        // Get base filename without extension
        $pathInfo = pathinfo($filename);
        $baseName = $pathInfo['filename'];
        $extension = $pathInfo['extension'] ?? '';

        // Remove size suffix if exists (e.g., filename_240x320 -> filename)
        $baseName = preg_replace('/_\d+x\d+$/', '', $baseName);

        // Delete all variants
        $variants = ['_tiny', '_small', '_medium', '_large', '_origin'];
        foreach ($variants as $variant) {
            $variantFile = $baseName . $variant . '.' . $extension;
            if (file_exists($imageDir . $variantFile)) {
                @unlink($imageDir . $variantFile);
            }
        }

        // Also delete old format variants for backward compatibility
        $oldVariants = ['_240x320', '_600x800'];
        foreach ($oldVariants as $variant) {
            $variantFile = $baseName . $variant . '.' . $extension;
            if (file_exists($imageDir . $variantFile)) {
                @unlink($imageDir . $variantFile);
            }
        }
    }

    public function detail($slug)
    {
        $image = Image::findBySlug($slug);
        if (!$image) {
            http_response_code(404);
            echo "Gambar tidak ditemukan";
            exit;
        }

        $setting = Setting::get();
        $meta_title = $image['meta_title'] ?: $image['title'] . " - " . $setting['site_title'];
        $meta_description = $image['meta_description'] ?: substr(strip_tags($image['title']), 0, 150);

        // Ambil 4 gambar terkait berdasarkan kategori
        $relatedImages = Image::getRelated($image['category_id'], $image['id']);

        // Get tags for this image
        $imageTags = Tag::getByImageId($image['id']);

        View::render('frontend/detail.php', [
            'image' => $image,
            'meta_title' => $meta_title,
            'meta_description' => $meta_description,
            'relatedImages' => $relatedImages,
            'imageTags' => $imageTags
        ], 'layouts/frontend.php');
    }

    public function home()
    {
        $db = \App\Core\Database::getInstance();
        $setting = \App\Models\Setting::get();

        // Ambil keyword pencarian
        $search = $_GET['q'] ?? '';
        $page = max(1, (int)($_GET['page'] ?? 1));
        $perPage = 12;
        $offset = ($page - 1) * $perPage;

        // Hitung total data
        $countQuery = "SELECT COUNT(*) as total FROM images";
        $where = '';
        $params = [];
        if ($search) {
            $where = " WHERE title LIKE ?";
            $params[] = "%$search%";
        }
        $stmt = $db->prepare($countQuery . $where);
        $stmt->execute($params);
        $total = $stmt->fetch()['total'];
        $totalPages = ceil($total / $perPage);

        // Ambil data sesuai halaman
        $sql = "SELECT * FROM images $where ORDER BY created_at DESC LIMIT $perPage OFFSET $offset";
        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        $images = $stmt->fetchAll();

        // Generate dynamic meta title and description
        $meta_title = $this->generateHomeMetaTitle($search, $page, $setting);
        $meta_description = $this->generateHomeMetaDescription($search, $page, $total, $setting);

        \App\Core\View::render('frontend/home.php', [
            'images' => $images,
            'search' => $search,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'meta_title' => $meta_title,
            'meta_description' => $meta_description
        ], 'layouts/frontend.php');
    }

    /**
     * Generate dynamic meta title for home page
     */
    private function generateHomeMetaTitle($search, $page, $setting)
    {
        $baseTitle = $setting['site_title'];

        if ($search && $page > 1) {
            // Search with pagination: "unicorn coloring pages - Page 2 - Site Name"
            return htmlspecialchars($search) . " Coloring Pages - Page {$page} - {$baseTitle}";
        } elseif ($search) {
            // Search only: "unicorn coloring pages - Site Name" 
            return htmlspecialchars($search) . " Coloring Pages - {$baseTitle}";
        } elseif ($page > 1) {
            // Pagination only: "Free Coloring Pages - Page 2 - Site Name"
            return "Free Coloring Pages - Page {$page} - {$baseTitle}";
        } else {
            // Default home page: Use setting or fallback
            return $baseTitle;
        }
    }

    /**
     * Generate dynamic meta description for home page
     */
    private function generateHomeMetaDescription($search, $page, $total, $setting)
    {
        $baseDescription = $setting['site_description'];

        if ($search && $page > 1) {
            // Search with pagination
            return "Discover {$search} coloring pages on page {$page}. Browse through our collection of free printable coloring sheets perfect for kids and adults.";
        } elseif ($search) {
            // Search only
            $resultText = $total > 0 ? "Found {$total} " : "Search for ";
            return "{$resultText}{$search} coloring pages. Free printable coloring sheets for kids and adults. Download and print instantly!";
        } elseif ($page > 1) {
            // Pagination only
            return "Browse free coloring pages on page {$page}. Discover hundreds of printable coloring sheets for kids and adults. Download instantly!";
        } else {
            // Default home page
            return $baseDescription ?: "Free printable coloring pages for kids and adults. Download and print instantly from our huge collection of fun designs!";
        }
    }

    public function download($id)
    {
        $image = Image::find($id);
        if (!$image) {
            echo "Image not found";
            exit;
        }

        // Check both possible locations for the file
        $file = __DIR__ . "/../../public/uploads/pdf/" . $image['filename'];
        if (!file_exists($file)) {
            $file = __DIR__ . "/../../public/uploads/" . $image['filename'];
        }

        if (!file_exists($file)) {
            echo "File not found";
            exit;
        }

        Image::incrementDownload($id);

        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf'); // because filename is PDF
        header('Content-Disposition: inline; filename="' . basename($file) . '"');
        header('Content-Length: ' . filesize($file));
        readfile($file);
        exit;
    }

    private function slugify($text)
    {
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $text)));
    }

    private function slugifytitle($text)
    {
        $clean = trim(preg_replace('/[^A-Za-z0-9]+/', ' ', $text));
        return ucwords($clean);
    }

    private function checkAuth()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: /login");
            exit;
        }
    }

    /**
     * Validate if PDF file is not corrupted
     */
    private function validatePdf($filePath)
    {
        if (!file_exists($filePath) || filesize($filePath) < 100) {
            return false;
        }

        // Check PDF header
        $handle = fopen($filePath, 'rb');
        if (!$handle) {
            return false;
        }

        $header = fread($handle, 8);
        fclose($handle);

        // PDF files should start with %PDF-
        return strpos($header, '%PDF-') === 0;
    }

    /**
     * Get compression statistics for admin dashboard
     */
    public function getCompressionStats()
    {
        $this->checkAuth();

        // You can implement this to show compression statistics
        // in your admin dashboard if needed

        header('Content-Type: application/json');
        echo json_encode([
            'compression_enabled' => $this->pdfCompressionEnabled,
            'max_file_size' => $this->maxPdfSize,
            'compression_quality' => $this->compressionQuality,
            'ghostscript_available' => $this->isGhostscriptAvailable(),
            'imagick_available' => extension_loaded('imagick'),
            'pdftk_available' => $this->isPdftkAvailable()
        ]);
    }

    /**
     * Update compression settings
     */
    public function updateCompressionSettings()
    {
        $this->checkAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->pdfCompressionEnabled = (bool)($_POST['compression_enabled'] ?? false);
            $this->maxPdfSize = (int)($_POST['max_file_size'] ?? 2 * 1024 * 1024);
            $this->compressionQuality = min(100, max(1, (int)($_POST['compression_quality'] ?? 75)));

            // Here you might want to save these settings to database or config file
            // For now, they'll reset when the class is instantiated again

            header('Content-Type: application/json');
            echo json_encode(['status' => 'success', 'message' => 'Settings updated']);
        }
    }
}

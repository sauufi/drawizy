<?php
if (!function_exists('img_url')) {
    /**
     * Generate image URL based on size variant.
     *
     * @param string $path Path stored in DB, e.g., "/uploads/images/file_img.jpg"
     * @param string $size Variant: 'origin', 'small', or 'thumb'
     * @return string
     */
    function img_url(string $path, string $size = 'origin'): string
    {
        // Normalize path
        $path = ltrim($path, '/');

        // If original, return as-is
        // if ($size === 'origin') {
        //     return '/uploads/images/' . $path;
        // }

        // Extract filename and extension
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $filename = pathinfo($path, PATHINFO_FILENAME);
        $dirname = pathinfo($path, PATHINFO_DIRNAME);

        // Prevent "/./" in path
        if ($dirname === '.' || $dirname === '') {
            $dirname = '';
        }

        // Build new filename with size suffix
        $newFilename = $filename . '_' . $size . '.' . $ext;

        return '/uploads/images' . $dirname . '/' . $newFilename;
    }
}

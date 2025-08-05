<div class="bg-white p-6 shadow rounded">
    <h1 class="text-2xl font-bold mb-4">Upload PDF with Thumbnail</h1>
    <form method="post" action="/admin/images/multiple" enctype="multipart/form-data">
        <!-- Category Selection -->
        <select name="category_id" class="border p-2 w-full mb-3" required>
            <option value="">Select Category</option>
            <?php foreach ($categories as $c): ?>
                <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['name']) ?></option>
            <?php endforeach; ?>
        </select>

        <!-- SEO Fields -->
        <input type="text" name="meta_title" placeholder="Meta Title (optional)" class="border p-2 w-full mb-3">
        <textarea name="meta_description" placeholder="Meta Description (optional)" class="border p-2 w-full mb-3"></textarea>

        <!-- PDF Files -->
        <label class="block mb-2 font-semibold">PDF Files</label>
        <input type="file" name="pdf_files[]" multiple accept="application/pdf" class="border p-2 w-full mb-4" required>

        <!-- Thumbnail Files -->
        <label class="block mb-2 font-semibold">Thumbnail Images (.png/.jpg) (optional, match order with PDF files)</label>
        <input type="file" name="thumb_files[]" multiple accept="image/png,image/jpeg" class="border p-2 w-full mb-4">

        <!-- Progress Bar -->
        <div id="progressContainer" class="hidden mt-4">
            <div class="w-full bg-gray-200 rounded-full">
                <div id="progressBar" class="bg-blue-500 text-xs leading-none py-1 text-center text-white rounded-full" style="width:0%">0%</div>
            </div>
        </div>

        <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Upload</button>
    </form>
</div>

<script>
    const form = document.querySelector('form');
    const progressContainer = document.getElementById('progressContainer');
    const progressBar = document.getElementById('progressBar');

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(form);
        progressContainer.classList.remove('hidden');

        const xhr = new XMLHttpRequest();
        xhr.open('POST', form.action, true);

        xhr.upload.onprogress = function(e) {
            if (e.lengthComputable) {
                const percent = Math.round((e.loaded / e.total) * 100);
                progressBar.style.width = percent + '%';
                progressBar.textContent = percent + '%';
            }
        };

        xhr.onload = function() {
            if (xhr.status === 200) {
                alert('Upload completed successfully!');
                window.location.href = '/admin/images';
            } else {
                alert('Upload failed!');
            }
        };

        xhr.send(formData);
    });
</script>
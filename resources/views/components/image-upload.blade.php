@props([
'name' => 'images[]',
'id' => 'imageInput',
'previewId' => 'imagePreview',
'multiple' => true,
'accept' => 'image/*',
'label' => 'Upload New Images',
'maxSize' => 4 * 1024 * 1024 // 4MB
])

<div class="image-upload-wrapper">
    @if($label)
    <label class="form-label small fw-bold text-muted d-block mb-3">{{ $label }}</label>
    @endif

    <div class="image-upload-zone border-2 border-dashed rounded-4 p-4 text-center mb-3" onclick="document.getElementById('{{ $id }}').click()">
        <i class="fa-solid fa-cloud-arrow-up fs-2 text-primary mb-2"></i>
        <input type="file" name="{{ $name }}" {{ $multiple ? 'multiple' : '' }} class="d-none" id="{{ $id }}" accept="{{ $accept }}">
        <div>
            <button type="button" class="btn btn-sm btn-primary mt-2 rounded-pill px-3">Select Files</button>
        </div>
        <p class="text-muted small mt-2 mb-0">Max size: {{ number_format($maxSize / (1024 * 1024), 0) }}MB per file</p>
    </div>

    <div id="{{ $previewId }}" class="row g-2"></div>
</div>

@push('scripts')
<script>
    document.getElementById('{{ $id }}').addEventListener('change', function(e) {
        const preview = document.getElementById('{{ $previewId }}');
        preview.innerHTML = '';

        const files = Array.from(e.target.files);
        const maxSize = {
            {
                $maxSize
            }
        };

        files.forEach((file, index) => {
            if (file.size > maxSize) {
                const alert = document.createElement('div');
                alert.className = 'col-12 mb-2';
                alert.innerHTML = `<div class="alert alert-warning x-small py-1 mb-0"><i class="fa-solid fa-triangle-exclamation me-1"></i> File "${file.name}" is over ${Math.round(maxSize / (1024 * 1024))}MB and may fail.</div>`;
                preview.appendChild(alert);
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                const col = document.createElement('div');
                col.className = 'col-4';
                col.innerHTML = `
                    <div class="position-relative">
                        <img src="${e.target.result}" class="img-fluid rounded-3 shadow-sm" style="height: 60px; width: 100%; object-fit: cover;">
                        ${file.size > maxSize ? '<div class="position-absolute top-0 end-0 bg-danger text-white rounded-circle d-flex align-items-center justify-content-center" style="width:16px; height:16px; font-size:10px;"><i class="fa-solid fa-exclamation"></i></div>' : ''}
                    </div>
                `;
                preview.appendChild(col);
            }
            reader.readAsDataURL(file);
        });
    });
</script>
@endpush

@once
@push('styles')
<style>
    .image-upload-zone {
        border-color: #dee2e6 !important;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .image-upload-zone:hover {
        border-color: #4f46e5 !important;
        background-color: #f8f9fa;
    }
</style>
@endpush
@endonce
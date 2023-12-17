import './bootstrap';

document.addEventListener('DOMContentLoaded', function () {
    const dropzoneFile = document.getElementById('dropzone-file');
    const imagePreview = document.getElementById('image-preview');

    dropzoneFile.addEventListener('change', function (e) {
        const fileInput = e.target;
        const file = fileInput.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                imagePreview.style.backgroundImage = `url('${e.target.result}')`;
            };

            reader.readAsDataURL(file);
        }
    });
});
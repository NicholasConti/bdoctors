import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])

// image preview

const imageInput = document.querySelector('#image');
const cvInput = document.querySelector('#cv');

imageInput.addEventListener('change', showPreviewImg);
cvInput.addEventListener('change', showPreviewCv);

function showPreviewImg() {
    if (event.target.files.length > 0) {
        const src = URL.createObjectURL(event.target.files[0]);
        const preview = document.getElementById("file-image-preview");
        preview.src = src;
        preview.style.display = "block";
    }
}

function showPreviewCv() {
    if (event.target.files.length > 0) {
        const src = URL.createObjectURL(event.target.files[0]);
        const previewCv = document.getElementById("file-cv-preview");
        previewCv.data = src;
        previewCv.style.display = "block";
    }
}

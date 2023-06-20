import './bootstrap';
import '~resources/scss/app.scss';
import './mychart';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])

// image preview

const imageInput = document.querySelector('#image');

imageInput.addEventListener('change', showPreviewImg);

function showPreviewImg() {
    if (event.target.files.length > 0) {
        const src = URL.createObjectURL(event.target.files[0]);
        const preview = document.getElementById("file-image-preview");
        preview.src = src;
        preview.style.display = "block";
    }
}

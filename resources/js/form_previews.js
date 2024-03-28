// Preview Immagine
const placeholder = 'https://marcolanci.it/boolean/assets/placeholder.png';
const input = document.getElementById('preview_project');
const preview = document.getElementById('preview');

input.addEventListener('input', () => {

    if (input.files && input.files[0]) {

        const file = input.files[0];
        const blobUrl = URL.createObjectURL(file);

        preview.src = blobUrl;
    } else {
        preview.src = input.value || placeholder;
    }
})

// Preview Slug
const title = document.getElementById('title');
const slug = document.getElementById('slug');

title.addEventListener('keyup', () => {
    slug.value = title.value.trim().toLowerCase().split(' ').join('-');
})
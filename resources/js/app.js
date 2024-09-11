import './bootstrap';

import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();



// tinymce for textarea
tinymce.init({
    selector: 'textarea.letter',
    license_key: 'glpvuu4bgw2i0d17uizamjpfwjswu59kbeacaefftswsyuty',
    plugins: "emoticons autoresize",
    toolbar: "emoticons",
    maxwidth: 600,
    maxHeight: 250
});
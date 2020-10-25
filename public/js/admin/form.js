window.addEventListener("DOMContentLoaded", init);

/**
 * Init event listeners
 * @return {void}
 */
function init(){
    var inputFile = document.querySelector('input[type="file"][name*="[imageFile]"');
    if(inputFile){
        inputFile.addEventListener('change', displayUploadPreview)
    }

    var clearUploadPreviewIcon = document.querySelector('.clear-upload-preview');
    if(clearUploadPreviewIcon){
        clearUploadPreviewIcon.addEventListener('click', clearUploadPreview)
    }

    var generateSlug = document.querySelector('.generate-slug');
    if(generateSlug){
        generateSlug.addEventListener('click', genertaSlug)
    }

    $('.datepicker').datepicker({
        language: 'fr',
        format: 'dd/mm/yyyy'
    });

    /* tinymce.init({
        selector: '.tynimce-editor textarea'
    }); */
}

/**
 * If input have file display it else clear preview
 * @return {void}
 */
function displayUploadPreview(){
    if(this.files[0]){
        var reader = new FileReader();
        reader.addEventListener('load', readImageUrl);
        reader.readAsDataURL(this.files[0]);
    }else{
        clearUploadPreview();
    }    

    return;
}

/**
 * Clear upload image preview and hide hiscontainer
 * @return {void}
 */
function clearUploadPreview(){
    var previewContainer = document.querySelector('.preview-upload');
    previewContainer.classList.add('d-none');
    previewContainer.querySelector('img').src = '';
    document.querySelector('.current-thumbnail').classList.remove('old-thumbnail')
}

/**
 * Fill upload image preview and display his container
 * @param {Event} event - Load event
 * @return {void}
 */
function readImageUrl(event){
    var previewContainer = document.querySelector('.preview-upload');
    previewContainer.classList.remove('d-none');
    previewContainer.querySelector('img').src = event.target.result;
    document.querySelector('.current-thumbnail').classList.add('old-thumbnail')
}

/**
 * Generate and fill slug field based on name field value
 * @return {void}
 */
function genertaSlug(){
    document.querySelector('[name*="[slug]"]').value = document.querySelector('[name*="[name]"]').value
        .toString()
        .normalize('NFD')
        .replace(/[\u0300-\u036f]|_/g, '')
        .toLowerCase()
        .trim()
        .replace(/\s+/g, '-')
        .replace(/[^\w-]+/g, '')
        .replace(/--+/g, '-')
    ;
}
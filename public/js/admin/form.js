window.addEventListener("DOMContentLoaded", init);

/**
 * Init event listeners
 * @return {void}
 */
function init(){
    var inputFiles = document.querySelectorAll('input[type="file"][name*="[uploadThumbnail]"], input[type="file"][name*="[uploadLogo]"]');
    for(var i = 0; i < inputFiles.length; ++i){
        inputFiles[i].addEventListener('change', displayUploadPreview);
    }

    var clearUploadPreviewIcons = document.querySelectorAll('.clear-upload-preview');
    for(var i = 0; i < clearUploadPreviewIcons.length; ++i){
        clearUploadPreviewIcons[i].addEventListener('click', clearUploadPreview);
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
 * @param {Event} event - Change event
 * @return {void}
 */
function displayUploadPreview(event){
    var field = event.currentTarget;
    if(this.files[0]){
        var reader = new FileReader();
        reader.addEventListener('load', function(loadEvent){
            readImageUrl(loadEvent, field)
        });
        reader.readAsDataURL(this.files[0]);
    }else{
        clearUploadPreview(event);
    }    

    return;
}

/**
 * Clear upload image preview and hide hiscontainer
 * @param {Event} event
 * @return {void}
 */
function clearUploadPreview(event){
    var uploadContainer = event.currentTarget.closest('.upload-container');
    var previewContainer = uploadContainer.querySelector('.preview-upload');
    previewContainer.classList.add('d-none');
    previewContainer.querySelector('img').src = '';
    uploadContainer.querySelector('.current-thumbnail').classList.remove('old-thumbnail')
}

/**
 * Fill upload image preview and display his container
 * @param {Event} event - Load event
 * @param {HTMLElement} field - upload field
 * @return {void}
 */
function readImageUrl(event, field){
    var uploadContainer = field.closest('.upload-container');
    var previewContainer = uploadContainer.querySelector('.preview-upload');
    previewContainer.classList.remove('d-none');
    previewContainer.querySelector('img').src = event.target.result;
    uploadContainer.querySelector('.current-thumbnail').classList.add('old-thumbnail')
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
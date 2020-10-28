window.addEventListener("DOMContentLoaded", init);


function init(){
    var fullViewIcons = document.querySelectorAll('.view-full-text');
    for(var index = 0; index < fullViewIcons.length; ++index){
        fullViewIcons[index].addEventListener('click', manageTextFullView);
    }
    var removeLinks = document.querySelectorAll('.remove-entity');
    for(var index = 0; index < removeLinks.length; ++index){
        removeLinks[index].addEventListener('click', confirmRemove);
    }

    var seeThumbnail = document.querySelectorAll('.see-thumbnail');
    for(var index = 0; index < seeThumbnail.length; ++index){
        seeThumbnail[index].addEventListener('click', applyThumbnailInModal);
    }
}

/**
 * Display or hide truncated text
 * @param {Event} event - Click event
 * @return {void}
 */
function manageTextFullView(event){
    var target = event.currentTarget;
    var textContainer = target.closest('.row').querySelector('p');
    var iconToRemove, iconToAdd;
    
    if(textContainer.classList.contains('truncated-text')){
        textContainer.classList.remove('truncated-text');
        iconToRemove = 'fa-search-plus';
        iconToAdd = 'fa-search-minus';
    }else{
        textContainer.classList.add('truncated-text');
        iconToRemove = 'fa-search-minus';
        iconToAdd = 'fa-search-plus';
    }

    target.classList.remove(iconToRemove);
    target.classList.add(iconToAdd);
    return;
}

/**
 * Display dialog to confirm remove
 * @param {Event} event - Click event
 * @return {void}
 */
function confirmRemove(event){
    if(!confirm(document.querySelector('main').getAttribute('data-text-confirm-remove-entity'))){
        event.preventDefault();
    }
}

/**
 * Change src attribute of img tag in modal with thumbnail path
 * @param {Event} event - Click event
 * @return {void}
 */
function applyThumbnailInModal(event){
    document.querySelector('#thumbnail-modal img').setAttribute('src', event.currentTarget.getAttribute('data-thumbnail'));
}
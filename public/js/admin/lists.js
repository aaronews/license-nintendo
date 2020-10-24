window.addEventListener("DOMContentLoaded", init);


function init(){
    var fullViewIcons = document.querySelectorAll('.view-full-text');
    for(var index = 0; index < fullViewIcons.length; ++index){
        fullViewIcons[index].addEventListener('click', manageTextFullView);
    }
    var RemoveLinks = document.querySelectorAll('.remove-entity');
    for(var index = 0; index < RemoveLinks.length; ++index){
        RemoveLinks[index].addEventListener('click', confirmRemove);
    }
}

/**
 * Display or hide truncated text
 * @param {Event} event - Click event
 * @return {void}
 */
function manageTextFullView(event){
    var target = event.currentTarget;
    var textContainer = target.closest('.row').querySelector('.text-container');
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
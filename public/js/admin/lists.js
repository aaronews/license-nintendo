window.addEventListener("DOMContentLoaded", init);


function init(){
    var fullViewIcons = document.querySelectorAll('.view-full-text');
    for(var index = 0; index < fullViewIcons.length; ++index){
        fullViewIcons[index].addEventListener('click', manageTextFullView);
    }
}

function manageTextFullView(event){
    var target = event.currentTarget;
    var paragraph = target.closest('.row').querySelector('p');
    var iconToRemove, iconToAdd;
    
    if(paragraph.classList.contains('truncated-text')){
        paragraph.classList.remove('truncated-text');
        iconToRemove = 'fa-search-plus';
        iconToAdd = 'fa-search-minus';
    }else{
        paragraph.classList.add('truncated-text');
        iconToRemove = 'fa-search-minus';
        iconToAdd = 'fa-search-plus';
    }

    target.classList.remove(iconToRemove);
    target.classList.add(iconToAdd);
    return;
}
window.addEventListener("DOMContentLoaded", init);

function init(){
    document.querySelector('#menu-toggle').addEventListener('click', displayMenu);
}

function displayMenu(){
    var body = document.querySelector('body');
    
    if(body.classList.contains('menuDisplayed')){
        body.classList.remove('menuDisplayed');
    }else{
        body.classList.add('menuDisplayed');
    }
    return;
}
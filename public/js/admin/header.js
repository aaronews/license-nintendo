window.addEventListener("DOMContentLoaded", init);


/**
 * Init event listeners
 * @return {void}
 */
function init(){
    document.querySelector('#menu-toggle').addEventListener('click', displayMenu);
}

/**
 * Dsiplay or hide menu
 * @return {void}
 */
function displayMenu(){
    var body = document.querySelector('body');
    
    if(body.classList.contains('menuDisplayed')){
        body.classList.remove('menuDisplayed');
    }else{
        body.classList.add('menuDisplayed');
    }
    return;
}
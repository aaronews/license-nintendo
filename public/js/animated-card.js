window.addEventListener("DOMContentLoaded", init);

/**
 * Init event listeners
 * @return {void}
 */
function init(){
    var animatedCardLinks = document.querySelectorAll('.animated-card .animated-card-content a');
    for(var index = 0; index < animatedCardLinks.length; ++index){
        animatedCardLinks[index].addEventListener('focusin', applyFocus);
        animatedCardLinks[index].addEventListener('focusout', removeFocus);
    }
}

/**
 * Add class focus
 * @param {Event} event - focus event
 * @return {void}
 */
function applyFocus(event){
    event.currentTarget.closest('.animated-card').classList.add('focused');
    return;
}

/**
 * Remove class focus
 * @param {Event} event - focus event
 * @return {void}
 */
function removeFocus(event){
    event.currentTarget.closest('.animated-card').classList.remove('focused');
    return;
}
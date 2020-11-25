window.addEventListener("DOMContentLoaded", init);

var isAnimationSlidBkgFinish = false;

function init(){
    if(document.querySelector('.license.super-smash-bros')){
        setInterval(checkAnimationBackground, 1000);
    }
}

function checkAnimationBackground(){
    var logoBlock = document.querySelector('.license .license-logo');
    
    if(logoBlock){
        var bkgPosition = window.getComputedStyle(logoBlock, null).getPropertyValue('background-position');
        if(isAnimationSlidBkgFinish && bkgPosition === '0% 50%'){
            logoBlock.classList.remove('animation-finish');
            isAnimationSlidBkgFinish = false;
        }else if(!isAnimationSlidBkgFinish && bkgPosition === '100% 50%'){
            logoBlock.classList.add('animation-finish');
            isAnimationSlidBkgFinish = true;
        }
    }
}
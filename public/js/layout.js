window.addEventListener("DOMContentLoaded", init);

function init(){
    displayCustomAlert();
}

function displayCustomAlert(){
    var top = 80;

    document.querySelectorAll('.custom-alert').forEach(function(oAlert){
        oAlert.style.top = top + 'px';
        oAlert.classList.add('show')
        top += 100;
    });

   setTimeout(hideCustomAlert, 5000);
}

function hideCustomAlert(value, div){
    document.querySelectorAll('.custom-alert').forEach(function(oAlert){
        oAlert.classList.remove('show')
    });
}
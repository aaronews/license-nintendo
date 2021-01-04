window.addEventListener("DOMContentLoaded", init);

function init(){
    $('.datepicker').datepicker({
        language: 'fr',
        format: 'dd/mm/yyyy'
    });
}
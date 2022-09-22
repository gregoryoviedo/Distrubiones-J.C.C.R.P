$(document).ready(function(){

    var pag_final = $('#pag_final').val();
    var pag_actual = $('#pag_actual').val();
    verif_pagina(pag_actual,pag_final);
});


$('#form_buscar').submit(function(){
    event.preventDefault();

    var buscar = $('#busqueda').val();
    var enlace = 'inventario_historial.php?busqueda='+buscar+'&p=1';
    window.location.href = enlace;
});

function siguiente(busqueda,pag_actual){
    var pagina = pag_actual+1;
    var enlace = 'inventario_historial.php?busqueda='+busqueda+'&p='+pagina;
    window.location.href = enlace;
}

function atras(busqueda,pag_actual){
    var pagina = pag_actual-1;
    var enlace = 'inventario_historial.php?busqueda='+busqueda+'&p='+pagina;
    window.location.href = enlace;
}


function verif_pagina(pag_actual,pag_final){

    var btn_atras = document.getElementById('btn_atras');
    var btn_adelante = document.getElementById('btn_adelante');

    if(pag_actual == 1){
        btn_atras.setAttribute("disabled","");
    }else{
        if(pag_actual == pag_final){
            btn_adelante.setAttribute("disabled","");
        }else{
            btn_atras.removeAttribute("disabled");
            btn_adelante.removeAttribute("disabled");
        }
    }
    
}
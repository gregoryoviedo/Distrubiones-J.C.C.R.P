
$('#form_login').on('submit',function(){
    ingresar();
});

function ingresar(){
    event.preventDefault();

    var datosEnviados = {
        'usuario'	:$('#usuario').val(),
        'pass'	    :$('#pass').val()
    };

        $.ajax({
            type:"POST",
            url:"../../mainmenu/controlador/autenticar.php",
            data: datosEnviados,
            dataType: 'json',
            encode: true,

            success:function(datos){
                if(datos.exito){
                    window.location.replace("../../mainmenu/vista/mainmenu.php");
                }else{
                    
                    if(datos.errores.mensaje){
                        $('#mensajeError').text(datos.errores.mensaje);
                        $('#alertaError').modal('toggle');
                    }
                }
            },
            error:function(e){
            console.log(e);
            }
            
        });

};
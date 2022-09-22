$('#vendedor1').on('change',function(){
    $.ajax({
		type:"POST",
		url:"ficha.php",
		dataType:"html",
        data:{id_empleado: $('#vendedor1').val()}
	})
	.done(function(respuesta){
        $('#ficha1').html(respuesta);
	})
	.fail(function(e){
		console.log(e);
	})
});

$('#vendedor2').on('change',function(){
    $.ajax({
		type:"POST",
		url:"ficha.php",
		dataType:"html",
        data:{id_empleado: $('#vendedor2').val()}
	})
	.done(function(respuesta){
        $('#ficha2').html(respuesta);
	})
	.fail(function(e){
		console.log(e);
	})
});


function new_ruta(){

    var datosEnviados = {
        'id_vendedor1'  :$('#vendedor1').val(),
        'id_vendedor2'	:$('#vendedor2').val(),
        'id_vehiculo'	:$('#vehiculo').val()
    };

        $.ajax({
            type:"POST",
            url:"../../rutas/controlador/resp_newruta.php",
            data: datosEnviados,
            dataType: 'json',
            encode: true,

            success:function(datos){
                if(datos.exito){
                    $('#verifGuardar').modal( 'toggle' );
                    $('#mensajeExito').text(datos.mensaje);
                    $('#alertaExito').modal('toggle');
					               
                }else{
                    
                    if(datos.errores.mensaje){
                        $('#verifGuardar').modal( 'toggle' );
                        $('#mensajeError').text(datos.errores.mensaje);
                        $('#alertaError').modal('toggle');
                    }
                    if(datos.errores.guardar){
                        $('#verifGuardar').modal( 'toggle' );

                        $('#mensajeError').text(datos.errores.guardar);

                        $('#alertaError').modal('toggle');
                    }
                    
                }
            },
            error:function(e){
            console.log(e);
            }
            
        });

}

function mod_ruta(){

    var datosEnviados = {
		'id_ruta' :$('#id_ruta').val(),
        'id_vendedor1'  :$('#vendedor1').val(),
        'id_vendedor2'	:$('#vendedor2').val(),
        'id_vehiculo'	:$('#vehiculo').val()
    };

        $.ajax({
            type:"POST",
            url:"../../rutas/controlador/resp_modruta.php",
            data: datosEnviados,
            dataType: 'json',
            encode: true,

            success:function(datos){
                if(datos.exito){
                    $('#verifGuardar').modal( 'toggle' );
                    $('#mensajeExito').text(datos.mensaje);
                    $('#alertaExito').modal('toggle');
					               
                }else{
                    
                    if(datos.errores.mensaje){
                        $('#verifGuardar').modal( 'toggle' );
                        $('#mensajeError').text(datos.errores.mensaje);
                        $('#alertaError').modal('toggle');
                    }
                    if(datos.errores.guardar){
                        $('#verifGuardar').modal( 'toggle' );

                        $('#mensajeError').text(datos.errores.guardar);

                        $('#alertaError').modal('toggle');
                    }
                    
                }
            },
            error:function(e){
            console.log(e);
            }
            
        });

}

function rellenar_delruta(id_ruta){
    $('#id_delruta').val(id_ruta);
}

function del_ruta(){
    
    var datosEnviados = {
        'id_ruta' :$('#id_delruta').val()
    };

        $.ajax({
            type:"POST",
            url:"../../rutas/controlador/resp_delruta.php",
            data: datosEnviados,
            dataType: 'json',
            encode: true,

            success:function(datos){
                if(datos.exito){
                    console.log('ruta eliminada');
                    location.reload();
                }else{

                    if(datos.errores.guardar){
                        $('#msg_error_delruta').show();
                        $('#msg_error_delruta').text(datos.errores.guardar);
                    }
                    if(datos.errores.mensaje){
                        $('#msg_error_delruta').show();
                        $('#msg_error_delruta').text(datos.errores.mensaje);                  
                    }
    
                }
            },
            error:function(e){
            console.log(e);
            }
            
        });

}


function hab_ruta(){

    var datosEnviados = {
		'id_ruta' :$('#id_ruta').val(),
        'id_vendedor1'  :$('#vendedor1').val(),
        'id_vendedor2'	:$('#vendedor2').val(),
        'id_vehiculo'	:$('#vehiculo').val()
    };

        $.ajax({
            type:"POST",
            url:"../../rutas/controlador/resp_habruta.php",
            data: datosEnviados,
            dataType: 'json',
            encode: true,

            success:function(datos){
                if(datos.exito){
                    var enlace = 'lista_rutas.php';
                    window.location.href = enlace;
                }else{
                    
                    if(datos.errores.mensaje){
                        $('#verifGuardar').modal( 'toggle' );
                        $('#mensajeError').text(datos.errores.mensaje);
                        $('#alertaError').modal('toggle');
                    }
                    if(datos.errores.guardar){
                        $('#verifGuardar').modal( 'toggle' );

                        $('#mensajeError').text(datos.errores.guardar);

                        $('#alertaError').modal('toggle');
                    }
                    
                }
            },
            error:function(e){
            console.log(e);
            }
            
        });

}
$(document).ready(function(){

    cargar_tablazona();

});


function cargar_tablazona(){
    $.ajax({
		type:"POST",
		url:"tabla_zonas.php",
		dataType:"html"
	})
	.done(function(respuesta){
        $('#caja_tablazona').html(respuesta);
	})
	.fail(function(e){
		console.log(e);
	})
}


function new_zona(){
    
    var datosEnviados = {
        'tipo_op' :'insertar',
        'nom_newzona'   :$('#nom_newzona').val()
    };

        $.ajax({
            type:"POST",
            url:"../../clientes/controlador/resp_zona.php",
            data: datosEnviados,
            dataType: 'json',
            encode: true,

            success:function(datos){
                if(datos.exito){
                    console.log('zona agregada');
                    $('#modal_new_zona').modal('toggle');
                    $('#mensajeExito').text(datos.mensaje);
                    $('#alertaExito').modal('toggle');
                    document.getElementById("form_new_zona").reset();
                    cargar_tablazona();
                }else{

                    if(datos.errores.guardar){
                        $('#msg_error_newzona').show();
                        $('#msg_error_newzona').text(datos.errores.guardar);
                    }
                    if(datos.errores.mensaje){
                        $('#msg_error_newzona').show();
                        $('#msg_error_newzona').text(datos.errores.mensaje);                  
                    }

                }
            },
            error:function(e){
            console.log(e);
            }
            
        });

}


function cargardatos_zona(id_zona,nombre){
    $('#mod_idzona').val(id_zona);
    $('#mod_nombrezona').val(nombre);
}

function mod_zona(){
    
    var datosEnviados = {
        'tipo_op' :'modificar',
        'nom_modzona'   :$('#nom_modzona').val(),
        'id_zona'       : $('#mod_idzona').val()
    };

        $.ajax({
            type:"POST",
            url:"../../clientes/controlador/resp_zona.php",
            data: datosEnviados,
            dataType: 'json',
            encode: true,

            success:function(datos){
                if(datos.exito){
                    console.log('zona modificada');
                    $('#modal_mod_zona').modal('toggle');
                    $('#mensajeExito').text(datos.mensaje);
                    $('#alertaExito').modal('toggle');
                    document.getElementById("form_mod_zona").reset();
                    cargar_tablazona();
                }else{

                    if(datos.errores.guardar){
                        $('#msg_error_newzona').show();
                        $('#msg_error_newzona').text(datos.errores.guardar);
                    }
                    if(datos.errores.mensaje){
                        $('#msg_error_newzona').show();
                        $('#msg_error_newzona').text(datos.errores.mensaje);                  
                    }

                }
            },
            error:function(e){
            console.log(e);
            }
            
        });

}
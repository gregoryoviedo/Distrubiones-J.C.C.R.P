$(document).ready(function(){

    cargar_tablatrabajo();

});


function cargar_tablatrabajo(){
    $.ajax({
		type:"POST",
		url:"tabla_trabajo.php",
		dataType:"html"
	})
	.done(function(respuesta){
        $('#caja_tabla').html(respuesta);
	})
	.fail(function(e){
		console.log(e);
	})
}



function cargar_tablacargo(id_diatrabajo){
    $.ajax({
		type:"POST",
		url:"tabla_cargamento.php",
		dataType:"html",
        data:{'id_diatrabajo': id_diatrabajo}
	})
	.done(function(respuesta){
        $('#id_tra_listcargo').val(id_diatrabajo);
        $('#tabla_cargo').html(respuesta);
	})
	.fail(function(e){
		console.log(e);
	})
}

function new_trabajo(){
    
    var datosEnviados = {
        'id_ruta' :$('#id_newruta').val(),
		'id_zona' :$('#id_newzona').val(),
		'escolta' :$('#escolta').val()
    };

        $.ajax({
            type:"POST",
            url:"../../dia_trabajo/controlador/resp_newtrabajo.php",
            data: datosEnviados,
            dataType: 'json',
            encode: true,

            success:function(datos){
                if(datos.exito){
                    console.log('trabajo agregado');
                    $('#modal_new_trabajo').modal('toggle');
                    $('#mensajeExito').text(datos.mensaje);
                    $('#alertaExito').modal('toggle');
                    cargar_tablatrabajo();
                }else{

                    if(datos.errores.guardar){
                        $('#msg_error_newtrabajo').show();
                        $('#msg_error_newtrabajo').text(datos.errores.guardar);
                    }
                    if(datos.errores.mensaje){
                        $('#msg_error_newtrabajo').show();
                        $('#msg_error_newtrabajo').text(datos.errores.mensaje);                  
                    }

                }
            },
            error:function(e){
            console.log(e);
            }
            
        });

}


function mostrar_newcargo(){
    $('#modal_cargamento').modal('toggle');
    $('#modal_new_cargamento').modal('toggle');
}

function mostrar_listacargo(){
    $('#modal_new_cargamento').modal('toggle');
    $('#modal_cargamento').modal('toggle');
}


$('#id_cat').on('change',function(){

    $.ajax({
            type:"POST",
            url:"lista_categorias.php",
            dataType:"html",
            data:{'id_categoria': $('#id_cat').val()}
        })
        .done(function(respuesta){
            $('#caja_elemento').html(respuesta);
        })
        .fail(function(e){
            console.log(e);
        })
});

$('#id_ele').on('change',function(){
    var band = $('#id_ele').val();

    var array = band.split('||');

    $('#existencias').val(array[1]);

});

function new_cargo(){

    var band = $('#id_ele').val();

    var array = band.split('||');
    var datosEnviados = {
        'id_elemento' : array[0],
        'existencias' : array[1],
        'llevar' : $('#llevar').val(),
        'id_diatrabajo' : $('#id_tra_listcargo').val()
    }

    $.ajax({
        type:"POST",
        url:"../../dia_trabajo/controlador/resp_newcargo.php",
        data: datosEnviados,
        dataType: 'json',
        encode: true,

        success:function(datos){
            if(datos.exito){
                console.log('cargamento agregado');
                $('#modal_new_cargamento').modal('toggle');
                $('#modal_cargamento').modal('toggle');
                document.getElementById("form_newcargo").reset();
                cargar_tablacargo(datos.id_diatrabajo);
                
            }else{

                if(datos.errores.guardar){
                    $('#msg_error_newcargo').show();
                    $('#msg_error_newcargo').text(datos.errores.guardar);
                }
                if(datos.errores.mensaje){
                    $('#msg_error_newcargo').show();
                    $('#msg_error_newcargo').text(datos.errores.mensaje);                  
                }

            }
        },
        error:function(e){
        console.log(e);
        }
        
    });

}


function del_cargo(id_elemento,id_cargamento,cant_prod){

    var datosEnviados = {
        'id_elemento' : id_elemento,
        'id_cargamento' : id_cargamento,
        'id_diatrabajo' : $('#id_tra_listcargo').val(),
        'cant_prod' :cant_prod
    }

    $.ajax({
        type:"POST",
        url:"../../dia_trabajo/controlador/resp_delcargo.php",
        data: datosEnviados,
        dataType: 'json',
        encode: true,

        success:function(datos){
            if(datos.exito){
                console.log('cargamento eliminado');
                document.getElementById("form_newcargo").reset();
                cargar_tablacargo(datos.id_diatrabajo);
            }
        },
        error:function(e){
        console.log(e);
        }
        
    });
}


function enviar_ruta(id_diatrabajo){

    var datosEnviados={
        'id_diatrabajo' : id_diatrabajo
    }

    $.ajax({
        type:"POST",
        url:"../../dia_trabajo/controlador/resp_enviar.php",
        data: datosEnviados,
        dataType: 'json',
        encode: true,

        success:function(datos){
            if(datos.exito){
                $('#verifGuardar').modal( 'toggle' );
                $('#mensajeExito').text(datos.mensaje);
                $('#alertaExito').modal('toggle');
                cargar_tablatrabajo();
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


function fin_dia(id_diatrabajo){

    var datosEnviados={
        'id_diatrabajo' : id_diatrabajo
    }

    $.ajax({
        type:"POST",
        url:"../../dia_trabajo/controlador/resp_findia.php",
        data: datosEnviados,
        dataType: 'json',
        encode: true,

        success:function(datos){
            if(datos.exito){
                var enlace = 'trabajo_enviado.php';
                window.location.replace(enlace);
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
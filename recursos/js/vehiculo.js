function new_vehiculo(){
    
    var datosEnviados = {
        'matricula'   :$('#matricula').val(),
        'marca'       :$('#marca').val(),
        'modelo'      :$('#modelo').val()
    };

        $.ajax({
            type:"POST",
            url:"../../vehiculo/controlador/resp_newvehiculo.php",
            data: datosEnviados,
            dataType: 'json',
            encode: true,

            success:function(datos){
                if(datos.exito){
                    console.log('vehiculo agregado');
                    $('#modal_new_vehiculo').modal('toggle');
                    $('#mensajeExito').text(datos.mensaje);
                    $('#alertaExito').modal('toggle');
                    document.getElementById("form_new_vehiculo").reset();
                    location.reload();
                }else{

                    if(datos.errores.guardar){
                        $('#msg_error_newvehiculo').show();
                        $('#msg_error_newvehiculo').text(datos.errores.guardar);
                    }
                    if(datos.errores.mensaje){
                        $('#msg_error_newvehiculo').show();
                        $('#msg_error_newvehiculo').text(datos.errores.mensaje);                  
                    }

                }
            },
            error:function(e){
            console.log(e);
            }
            
        });

}


function rellenar_mod_vehiculo(id,matricula,marca,modelo){
    $('#mod_id_vehiculo').val(id);
    $('#mod_matricula').val(matricula);
    $('#mod_marca').val(marca);
    $('#mod_modelo').val(modelo);
}

function mod_vehiculo(){
    
    var datosEnviados = {
        'id_vehiculo' :$('#mod_id_vehiculo').val(),
        'matricula'   :$('#mod_matricula').val(),
        'marca'       :$('#mod_marca').val(),
        'modelo'      :$('#mod_modelo').val()
    };

        $.ajax({
            type:"POST",
            url:"../../vehiculo/controlador/resp_modvehiculo.php",
            data: datosEnviados,
            dataType: 'json',
            encode: true,

            success:function(datos){
                if(datos.exito){
                    console.log('vehiculo agregado');
                    $('#modal_mod_vehiculo').modal('toggle');
                    $('#mensajeExito').text(datos.mensaje);
                    $('#alertaExito').modal('toggle');
                    document.getElementById("form_mod_vehiculo").reset();
                    location.reload();
                }else{

                    if(datos.errores.guardar){
                        $('#msg_error_modvehiculo').show();
                        $('#msg_error_modvehiculo').text(datos.errores.guardar);
                    }
                    if(datos.errores.mensaje){
                        $('#msg_error_modvehiculo').show();
                        $('#msg_error_modvehiculo').text(datos.errores.mensaje);                  
                    }

                }
            },
            error:function(e){
            console.log(e);
            }
            
        });

}


function estado_vehiculo(id_vehiculo,tipo){
    
    var datosEnviados = {
        'id_vehiculo' :id_vehiculo,
        'tipo'   :tipo
    };

        $.ajax({
            type:"POST",
            url:"../../vehiculo/controlador/resp_delvehiculo.php",
            data: datosEnviados,
            dataType: 'json',
            encode: true,

            success:function(datos){
                if(datos.exito){
                    console.log('vehiculo estado cambiado');
                    $('#mensajeExito').text(datos.mensaje);
                    $('#alertaExito').modal('toggle');
                    location.reload();
                }
            },
            error:function(e){
            console.log(e);
            }
            
        });

}
function regiscli(){

    var datosEnviados = {
        'nom_fiscal'	:$('#nom_fiscal').val(),
        'tipo_rif'	:$('#tipo_rif').val(),
        'rif'	    :$('#rif').val(),
        'tipo_tel'  :$('#tipo_tel').val(),
        'telefono'  :$('#telefono').val(),
        'direccion'		:$('#direccion').val(),
        'id_zona'   :$('#id_zona').val()
    };

        $.ajax({
            type:"POST",
            url:"../../clientes/controlador/resp_newcliente.php",
            data: datosEnviados,
            dataType: 'json',
            encode: true,

            success:function(datos){
                if(datos.exito){
                    console.log('cliente insertado');
                    $('#verifGuardar').modal( 'toggle' );
                    $('#mensajeExito').text(datos.mensaje);
                    $('#alertaExito').modal('toggle');
                    document.getElementById("regisper").reset();
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

function modcli(){

    var datosEnviados = {
        'nom_fiscal'	:$('#nom_fiscal').val(),
        'tipo_tel'  :$('#tipo_tel').val(),
        'telefono'  :$('#telefono').val(),
        'direccion'		:$('#direccion').val(),
        'id_zona'   :$('#id_zona').val(),
        'id_cliente'   :$('#id_cliente').val()
    };

        $.ajax({
            type:"POST",
            url:"../../clientes/controlador/resp_modcliente.php",
            data: datosEnviados,
            dataType: 'json',
            encode: true,

            success:function(datos){
                if(datos.exito){
                    console.log('cliente modificado');
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


function rellenar_delcliente(id_cliente){
    $('#id_delcliente').val(id_cliente);
}


function del_cliente(tipo){
    
    var datosEnviados = {
      'id_cliente'   :$('#id_delcliente').val(),
      'tipo' :tipo
     };

      $.ajax({
        type:"POST",
        url:"../../clientes/controlador/resp_delcliente.php",
        data: datosEnviados,
        dataType: 'json',
        encode: true,

        success:function(datos){
            if(datos.exito){
                console.log('cliente eliminado');
                location.reload();
            }else{

                if(datos.errores.guardar){
                    $('#msg_error_delcliente').show();
                    $('#msg_error_delcliente').text(datos.errores.guardar);
                }
                if(datos.errores.mensaje){
                    $('#msg_error_delcliente').show();
                    $('#msg_error_delcliente').text(datos.errores.mensaje);                  
                }

            }
        },
        error:function(e){
        console.log(e);
        }
        
    });
  

}

function hab_cliente(id_cliente,tipo){
    
    var datosEnviados = {
      'id_cliente'   :id_cliente,
      'tipo' :tipo
     };

      $.ajax({
        type:"POST",
        url:"../../clientes/controlador/resp_delcliente.php",
        data: datosEnviados,
        dataType: 'json',
        encode: true,

        success:function(datos){
            if(datos.exito){
                console.log('cliente habilitado');
                location.reload();
            }else{

                if(datos.errores.guardar){
                    $('#msg_error_delcliente').show();
                    $('#msg_error_delcliente').text(datos.errores.guardar);
                }
                if(datos.errores.mensaje){
                    $('#msg_error_delcliente').show();
                    $('#msg_error_delcliente').text(datos.errores.mensaje);                  
                }

            }
        },
        error:function(e){
        console.log(e);
        }
        
    });
  

}
function regisper(){

    var datosEnviados = {
        'nombre'	:$('#nombre').val(),
        'apellido'	:$('#apellido').val(),
        'tipo_ced'	:$('#tipo_ced').val(),
        'cedula'	:$('#cedula').val(),
        'tipo_tel'  :$('#tipo_tel').val(),
        'telefono'  :$('#telefono').val(),
        'email'		:$('#email').val(),
        'tipo_emp'	:$('#tipo_emp').val(),
        'usuario'	:$('#usuario').val(),
        'pass1'	    :$('#pass1').val(),
        'pass2'	    :$('#pass2').val()
    };

        $.ajax({
            type:"POST",
            url:"../../empleados/controladores/resp_newemp.php",
            data: datosEnviados,
            dataType: 'json',
            encode: true,

            success:function(datos){
                if(datos.exito){
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

                    if(datos.errores.cedula && datos.errores.email){
                        $('#verifGuardar').modal( 'toggle' );
                        $('#mensajeError').text("El email y la cedula ya estan registrados");
                        $('#alertaError').modal('toggle');
                    }else{
                        if(datos.errores.cedula){
                        $('#verifGuardar').modal( 'toggle' );
                        $('#mensajeError').text(datos.errores.cedula);
                        $('#alertaError').modal('toggle');
                        }

                        if(datos.errores.email){
                        $('#verifGuardar').modal( 'toggle' );
                        $('#mensajeError').text(datos.errores.email);
                        $('#alertaError').modal('toggle');
                        }
                    }
                }
            },
            error:function(e){
            console.log(e);
            }
            
        });

}


function modper(){

    var datosEnviados = {
        'id'	    :$('#id').val(),
        'nombre'	:$('#nombre').val(),
        'apellido'	:$('#apellido').val(),
        'tipo_tel'  :$('#tipo_tel').val(),
        'telefono'  :$('#telefono').val(),
        'email'		:$('#email').val()
    };

        $.ajax({
            type:"POST",
            url:"../../empleados/controladores/resp_modemp.php",
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

function estado_emp(id,tipo){
    console.log('llega');
    var datosEnviados = {
        'id'    :id,
        'tipo' :tipo
    };

    $.ajax({
        type:"POST",
        url:"../../empleados/controladores/resp_delemp.php",
        data: datosEnviados,
        dataType: 'json',
        encode: true,

        success:function(datos){
            if(datos.exito){
                location.href='../../empleados/vistas/empleados.php';
            }else{
                
                if(datos.errores.mensaje){
                    $('#verifGuardar').modal( 'toggle' );
                    $('#mensajeError').text(datos.errores.mensaje);
                    $('#alertaError').modal('toggle');
                }
                
            }
        },
        error:function(e){
        console.log(e);
        }
        
    });
}


function modpass(){
    
    var datosEnviados = {
        'id_empleado_pass' :$('#id_empleado_pass').val(),
        'newpass1'           :$('#newpass1').val(),
        'newpass2'           :$('#newpass2').val()
    };

        $.ajax({
            type:"POST",
            url:"../../empleados/controladores/resp_modpass.php",
            data: datosEnviados,
            dataType: 'json',
            encode: true,

            success:function(datos){
                if(datos.exito){
                    console.log('cambiar pass exito');
                    $('#cambiarPass').modal('toggle');
                    $('#mensajeExito').text(datos.mensaje);
                    $('#alertaExito').modal('toggle');
                     
                }else{

                    if(datos.errores.guardar){
                        $('#mensajeError_pass').show();
                        $('#mensajeError_pass').text(datos.errores.guardar);
                    }
                    if(datos.errores.mensaje){
                        $('#mensajeError_pass').show();
                        $('#mensajeError_pass').text(datos.errores.mensaje);                  
                    }

                }
            },
            error:function(e){
            console.log(e);
            }
            
        });

}



    $('#form_mod_pic').on('submit',function(){
        var datosEnviados = new FormData();
        datosEnviados.append('id_empleado_pic',$('#id_empleado_pic').val());
        datosEnviados.append('cedula_pic',$('#cedula_pic').val());
        datosEnviados.append('imagen',$('input[name=imagen]')[0].files[0]);
        $.ajax({
            type:"POST",
            url:"../../empleados/controladores/resp_modpic.php",
            data: datosEnviados,
            contentType: false,
            processData: false,
            cache:       false,
            success:function(){
                $('#modal_pic').modal('toggle');
                $('#mensajeExito').text('Se ha subido la imagen, recargue el perfil para ver los cambios');
                $('#alertaExito').modal('toggle');
                document.getElementById("form_mod_pic").reset();
            },
            error:function(e){
            console.log(e);
            }
            
        });
        return false;
    });

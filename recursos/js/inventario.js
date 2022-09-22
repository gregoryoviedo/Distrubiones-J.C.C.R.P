function new_categoria(){
    
  var datosEnviados = {
      'nom_newcategoria'   :$('#nom_newcategoria').val()
  };

      $.ajax({
          type:"POST",
          url:"../../inventario/controlador/resp_newcategoria.php",
          data: datosEnviados,
          dataType: 'json',
          encode: true,

          success:function(datos){
              if(datos.exito){
                  console.log('categoria agregada');
                  location.reload();
              }else{

                  if(datos.errores.guardar){
                      $('#msg_error_newcategoria').show();
                      $('#msg_error_newcategoria').text(datos.errores.guardar);
                  }
                  if(datos.errores.mensaje){
                      $('#msg_error_newcategoria').show();
                      $('#msg_error_newcategoria').text(datos.errores.mensaje);                  
                  }

              }
          },
          error:function(e){
          console.log(e);
          }
          
      });

}


function cargardatos_newelemento(id_categoria){
  $('#id_cat_newelemento').val(id_categoria);
  
}


function new_elemento(){
    
  var datosEnviados = {
      'id_categoria'   :$('#id_cat_newelemento').val(),
      'nombre'         :$('#nom_newelemento').val(),
      'precio'         :$('#precio_newelemento').val(),
      'cantidad'       :$('#cantidad_newelemento').val(),
      'descripcion'    :$('#descripcion_newelemento').val()
  };

      $.ajax({
          type:"POST",
          url:"../../inventario/controlador/resp_newelemento.php",
          data: datosEnviados,
          dataType: 'json',
          encode: true,

          success:function(datos){
              if(datos.exito){
                  console.log('elemento agregado');
                  location.reload();
              }else{

                  if(datos.errores.guardar){
                      $('#msg_error_newelemento').show();
                      $('#msg_error_newelemento').text(datos.errores.guardar);
                  }
                  if(datos.errores.mensaje){
                      $('#msg_error_newelemento').show();
                      $('#msg_error_newelemento').text(datos.errores.mensaje);                  
                  }

              }
          },
          error:function(e){
          console.log(e);
          }
          
      });

}


function rellenar_mod_elemento(id_elemento, nombre, precio, cantidad, descripcion){
  $('#id_mod_elemento').val(id_elemento);
  $('#nom_modelemento').val(nombre);
  $('#precio_modelemento').val(precio);
  $('#cantidad_modelemento').val(cantidad);
  $('#descripcion_modelemento').val(descripcion);
}



function mod_elemento(){
    
  var datosEnviados = {
      'id_elemento'   :$('#id_mod_elemento').val(),
      'nombre'         :$('#nom_modelemento').val(),
      'precio'         :$('#precio_modelemento').val(),
      'cantidad'       :$('#cantidad_modelemento').val(),
      'descripcion'    :$('#descripcion_modelemento').val()
  };

      $.ajax({
          type:"POST",
          url:"../../inventario/controlador/resp_modelemento.php",
          data: datosEnviados,
          dataType: 'json',
          encode: true,

          success:function(datos){
              if(datos.exito){
                  console.log('elemento agregado');
                  location.reload();
              }else{

                  if(datos.errores.guardar){
                      $('#msg_error_modelemento').show();
                      $('#msg_error_modelemento').text(datos.errores.guardar);
                  }
                  if(datos.errores.mensaje){
                      $('#msg_error_modelemento').show();
                      $('#msg_error_modelemento').text(datos.errores.mensaje);                  
                  }

              }
          },
          error:function(e){
          console.log(e);
          }
          
      });

}


function rellenar_del_elemento(id_elemento,cantidad){
    $('#id_delelemento').val(id_elemento);
    $('#cantidad_delelemento').val(cantidad);
}


function rellenar_del_categoria(id_categoria){
  $('#id_delcategoria').val(id_categoria);
}

function rellenar_mod_categoria(id_categoria,nombre_cat){
    $('#id_mod_categoria').val(id_categoria);
    $('#nom_modcategoria').val(nombre_cat);
}



function del_elemento(tipo){
    
  
    var datosEnviados = {
      'id_elemento'   :$('#id_delelemento').val(),
      'tipo' :tipo,
      'cantidad' :$('#cantidad_delelemento').val()
     };

      $.ajax({
        type:"POST",
        url:"../../inventario/controlador/resp_delelemento.php",
        data: datosEnviados,
        dataType: 'json',
        encode: true,

        success:function(datos){
            if(datos.exito){
                console.log('elemento eliminado');
                location.reload();
            }else{

                if(datos.errores.guardar){
                    $('#msg_error_delelemento').show();
                    $('#msg_error_delelemento').text(datos.errores.guardar);
                }
                if(datos.errores.mensaje){
                    $('#msg_error_delelemento').show();
                    $('#msg_error_delelemento').text(datos.errores.mensaje);                  
                }

            }
        },
        error:function(e){
        console.log(e);
        }
        
    });
  

}

function hab_elemento(id_elemento,tipo){
    
  
  var datosEnviados = {
    'id_elemento'   :id_elemento,
    'tipo' :tipo
   };

    $.ajax({
      type:"POST",
      url:"../../inventario/controlador/resp_delelemento.php",
      data: datosEnviados,
      dataType: 'json',
      encode: true,

      success:function(datos){
          if(datos.exito){
              console.log('elemento habilitado');
              location.reload();
          }
      },
      error:function(e){
      console.log(e);
      }
      
  });


}


function mod_categoria(){
    
  var datosEnviados = {
      'id_categoria'   :$('#id_mod_categoria').val(),
      'nombre'         :$('#nom_modcategoria').val()
  };

      $.ajax({
          type:"POST",
          url:"../../inventario/controlador/resp_modcategoria.php",
          data: datosEnviados,
          dataType: 'json',
          encode: true,

          success:function(datos){
              if(datos.exito){
                  console.log('categoria modificado');
                  location.reload();
              }else{

                  if(datos.errores.guardar){
                      $('#msg_error_modcategoria').show();
                      $('#msg_error_modcategoria').text(datos.errores.guardar);
                  }
                  if(datos.errores.mensaje){
                      $('#msg_error_modcategoria').show();
                      $('#msg_error_modcategoria').text(datos.errores.mensaje);                  
                  }

              }
          },
          error:function(e){
          console.log(e);
          }
          
      });

}




function del_categoria(tipo){
    
  
  var datosEnviados = {
    'id_categoria'   :$('#id_delcategoria').val(),
    'tipo' :tipo
   };

    $.ajax({
      type:"POST",
      url:"../../inventario/controlador/resp_delcategoria.php",
      data: datosEnviados,
      dataType: 'json',
      encode: true,

      success:function(datos){
          if(datos.exito){
              console.log('categoria eliminado');
              location.reload();
          }else{

              if(datos.errores.guardar){
                  $('#msg_error_delcategoria').show();
                  $('#msg_error_delcategoria').text(datos.errores.guardar);
              }
              if(datos.errores.mensaje){
                  $('#msg_error_delcategoria').show();
                  $('#msg_error_delcategoria').text(datos.errores.mensaje);                  
              }

          }
      },
      error:function(e){
      console.log(e);
      }
      
  });


}


function hab_categoria(id_categoria,tipo){
    
  
    var datosEnviados = {
      'id_categoria'   :id_categoria,
      'tipo' :tipo
     };
  
      $.ajax({
        type:"POST",
        url:"../../inventario/controlador/resp_delcategoria.php",
        data: datosEnviados,
        dataType: 'json',
        encode: true,
  
        success:function(datos){
            if(datos.exito){
                console.log('categoria eliminado');
                location.reload();
            }else{
  
                if(datos.errores.guardar){
                    $('#msg_error_delcategoria').show();
                    $('#msg_error_delcategoria').text(datos.errores.guardar);
                }
                if(datos.errores.mensaje){
                    $('#msg_error_delcategoria').show();
                    $('#msg_error_delcategoria').text(datos.errores.mensaje);                  
                }
  
            }
        },
        error:function(e){
        console.log(e);
        }
        
    });
  
  
  }
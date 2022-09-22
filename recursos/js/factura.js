function buscar_datos(){

    var datosEnviados = {
        'rif' : $('#rif').val(),
        'id_zona' : $('#id_zona').val()
    };

        $.ajax({
            type:"POST",
            url:"../../factura/controlador/resp_buscardatos.php",
            data: datosEnviados,
            dataType: 'json',
            encode: true,

            success:function(datos){
                if(datos.exito){
                    $('#nom_fiscal').val(datos.cliente.nom_fiscal);
                    $('#id_cliente').val(datos.cliente.id_cliente);
                    $('#telefono').val(datos.cliente.telefono);
                    $('#rif').prop('disabled',true);
                    $('#btnbuscar').prop('disabled',true);
                    console.log('cliente cargado');
                }else{
                    
                    if(datos.errores.mensaje){
                        $('#mensajeError').text(datos.errores.mensaje);
                        $('#alertaError').modal('toggle');
                    }
                    if(datos.errores.guardar){
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



$('#elemento_cargo').on('change',function(){
    var band = $('#elemento_cargo').val();

    var array = band.split('||');

    $('#id_cargo').val(array[0]);
    $('#id_ele').val(array[1]);
    $('#precio').val(array[2]);
    $('#nom_ele').val(array[3]);
    $('#cant_prod').val(array[4]);
    

});





var carrito = [];
var total = 0;
var tbody = document.getElementById('cuerpo_tabla');

function validar_cantidad(){
    var existencia= $('#cant_prod').val();
    var llevar = $('#cant_llevar').val();
    var band = existencia - llevar;

    if(existencia == ''){
        $('#mensajeError').text('Debe seleccionar un elemento');
        $('#alertaError').modal('toggle');
        return false;
    }else{
        if(band<0){
            $('#mensajeError').text('La cantidad a llevar es mayor a existencias');
            $('#alertaError').modal('toggle');
            return false;
        }else{
            if(llevar == '' || llevar === 0){
                $('#mensajeError').text('La cantidad a llevar no puede ser 0 o vacio');
                $('#alertaError').modal('toggle');
                return false;
            }else{
                return true;
            }
        }
    }
}


function agregar_carrito(){
    var validar = validar_cantidad();
    
    

    if(validar){
        
        var band = {
            id_cargo :  $('#id_cargo').val(),
            id_ele : $('#id_ele').val(),
            precio : $('#precio').val(),
            nom_ele : $('#nom_ele').val(),
            cant_llevar : $('#cant_llevar').val()
        }
        var verif_dupla = duplicado(band);
        if(verif_dupla){
            $('#mensajeError').text('Este producto ya fue agregado');
            $('#alertaError').modal('toggle');
        }else{
            carrito.push(band);
            var suma = band.cant_llevar*band.precio;
            total = total+suma;
            $('#total_fact').val(total);

            var fila = '<tr><td>'+band.nom_ele+'</td><td>'+band.cant_llevar+'</td><td>'+band.precio+'</td><td>'+suma+'</td></tr>';
            $('#cuerpo_tabla').append(fila);

            
        }

        
    }

}


function duplicado(band){
    

    for(var i = 0 ; i<carrito.length ; i++){
        
        if(carrito[i].id_ele == band.id_ele){
            return true;
        }

    }
}



function validar_datos_fact(){

    var nom_fiscal = $('#nom_fiscal').val();
    var serial = $('#serial').val();

    if(nom_fiscal == '' || nom_fiscal == null){
        $('#verifGuardar').modal('toggle');
        $('#mensajeError').text('Debe llenar los datos del cliente');
        $('#alertaError').modal('toggle');
        return false;
    }else{
        if(serial == '' || serial == null){
            $('#verifGuardar').modal('toggle');
            $('#mensajeError').text('Ingrese el serial de la factura');
            $('#alertaError').modal('toggle');
            return false;
        }else{
            if(carrito.length<1){
                $('#verifGuardar').modal('toggle');
                $('#mensajeError').text('Llene los productos comprados');
                $('#alertaError').modal('toggle');
                return false;
            }else{
                return true;
            }
        }
    }
}


function new_fact(id_diatrabajo){

    var ok = validar_datos_fact();

    if(ok){
        var carro_final = JSON.stringify(carrito);

        var datosEnviados = {
                'id_diatrabajo' : id_diatrabajo,
                'id_cliente' : $('#id_cliente').val(),
                'serial' : $('#serial').val(),
                'total_fact' : $('#total_fact').val(),
                'carrito' : carro_final
            }
        
        
    }

    $.ajax({
        type:"POST",
        url:"../../factura/controlador/resp_newfact.php",
        data: datosEnviados,
        dataType: 'json',
        encode: true,

        success:function(datos){
            if(datos.exito){
                var enlace = '../../dia_trabajo/vista/finalizar_dia.php?trabajo='+datos.id_diatrabajo;
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

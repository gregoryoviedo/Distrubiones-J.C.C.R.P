<?php

    require("../modelo/factura.class.php");

    $obj = new factura;

    $id_factura = $_POST['id_factura'];

    $cliente = $obj->buscardatos_cli($id_factura);

    $compras = $obj->buscardatos_compra($id_factura);

    $resultado = '';


    foreach ($cliente as $row) {
        $nom_fiscal = $row['nom_fiscal'];
        $serial = $row['fact_serial'];
        $rif = $row['rif'];
        $telefono = $row['telefono'];
        $total_factura = $row['total_factura'];
        $fecha = $row['fecha'];
    }


    // SERIAL Y FECHA
    
    $resultado.='
        
        <input type="hidden" name="id_fact_imprimir" id="id_fact_imprimir" value="'.$id_factura.'">
        <div class="form-group">
            <div class="row">
                <div class="col-8">
                    <label for="">Serial:</label>
                    <input class="form-control" type="text" value="'.$serial.'" disabled>
                </div>
                <div class="col-4">
                    <label for="">Fecha:</label>
                    <input class="form-control" type="text" value="'.$fecha.'" disabled>
                </div>
            </div>
        </div>
    ';


    // NOMBRE FISCAL

    $resultado.='
        <div class="form-group">
            <div class="row">
                <div class="col-12">
                    <label for="">Nombre Fiscal:</label>
                    <input  class="form-control" type="text" value="'.$nom_fiscal.'" disabled>
                </div>
            </div>
        </div>
    ';

    // RIF Y TELEFONO

    $resultado.='
        <div class="form-group">
            <div class="row">
                <div class="col-6">
                    <label for="">RIF:</label>
                    <input class="form-control" type="text" value="'.$rif.'" disabled>
                </div>
                <div class="col-6">
                    <label for="">Telefono:</label>
                    <input class="form-control" type="text" value="'.$telefono.'" disabled>
                </div>
            </div>
        </div>
    ';

    // TABLA DE COMPRAS

    $resultado.='<table class="table">';
        $resultado.='<thead>';
            $resultado.='<tr>';
                $resultado.='<th>Producto</th>';
                $resultado.='<th>Cantidad</th>';
                $resultado.='<th>Precio</th>';
                $resultado.='<th>Total</th>';
            $resultado.='</tr>';
        $resultado.='</thead>';
        $resultado.='<tbody>';
            foreach ($compras as $row) {
                $multiplica = $row['cantidad_prod']*$row['precio'];
                $resultado.='<tr>';
                    $resultado.='<td>'.$row['nombre'].'</td>';
                    $resultado.='<td>'.$row['cantidad_prod'].'</td>';
                    $resultado.='<td>'.$row['precio'].'</td>';
                    $resultado.='<td>'.$multiplica.'</td>';
                $resultado.='</tr>';

            }
        $resultado.='</tbody>';
    $resultado.='</table>';

    // TOTAL DE LA FACTURA

    $resultado.='
        <div class="form-group">
            <div class="row">
                <div class="col-12">
                    <label for="">Total Factura:</label>
                    <input class="form-control" type="text" value="'.$total_factura.'" disabled>
                </div>
            </div>
        </div>
    ';

    echo $resultado;
?>


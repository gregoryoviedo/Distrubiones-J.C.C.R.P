<?php

    session_start();
    require('../modelo/factura.class.php');

    require_once('../../auditoria/modelo/auditoria.class.php');
	$auditor = new auditor;

    $obj = new factura;
    $datos = array();
    $errores = array();

    // CAPTURA DE DATOS 

    $id_diatrabajo = $_POST['id_diatrabajo'];
    $id_cliente = $_POST['id_cliente'];
    $total_factura = $_POST['total_fact'];
    $fact_serial = $_POST['serial'];


    $carrito = array();
    $carrito = json_decode($_POST['carrito'],true);

    // VALIDAR SERIAL REPETIDO

    $ok = $obj->verificar_serial($fact_serial);

    if($ok){
        $errores['mensaje']="Este serial ya se encuentra en otra factura";
    }
    

    if(empty($errores)){

        $ok = $obj->new_factura($id_diatrabajo,$fact_serial,$id_cliente,$total_factura);
        
        if($ok){

            $band = $obj->get_id_factura($fact_serial);
            foreach ($band as $row) {
                $id_factura = $row['id_factura'];
            }
            $band->closeCursor();

            foreach ($carrito as $row) {
                $id_elemento = $row['id_ele'];
                $id_cargamento = $row['id_cargo'];
                $cantidad_prod = $row['cant_llevar'];
                $ok2= $obj->new_compra($id_cargamento,$id_factura,$id_elemento,$cantidad_prod);
            }
            

            if($ok2){
                $datos['exito'] = true;
                $datos['mensaje'] = "Se ha guardado la factura correctamente";
                $datos['id_diatrabajo'] = $id_diatrabajo;
                $auditor->auditar($_SESSION['id_empleado'],$_SESSION['usuario'],'Insert','Facturas','Nueva factura Serial: '.$fact_serial);
            }else{
                $datos['exito'] = false;
                $errores['guardar'] = "Error guardar las compras";
                $datos['errores'] = $errores;
            }

        }
        else{
            $datos['exito'] = false;
            $errores['guardar'] = "Error al crear factura";
            $datos['errores'] = $errores;
        }        

    }else{
        $datos['exito'] = false;
		$datos['errores'] = $errores;
    }

    

    ///retorno de json
    echo json_encode($datos);


?>
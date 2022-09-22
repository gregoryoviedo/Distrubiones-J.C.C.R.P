<?php

    session_start();

    require('../modelo/vehiculo.class.php');

    require_once('../../auditoria/modelo/auditoria.class.php');
	$auditor = new auditor;

    $obj = new vehiculo;
    $datos = array();
    $errores = array();

    // CAPTURA DE DATOS 

    // id_vehiculo +++

    $id_vehiculo = $_POST['id_vehiculo'];

    // tipo +++

    $tipo = $_POST['tipo'];

    
    // insersion de datos

    if(empty($errores)){
        $ok = $obj->estado_vehiculo($id_vehiculo,$tipo);
  
        if($ok){
            $datos['exito'] = true;
            $auditor->auditar($_SESSION['id_empleado'],$_SESSION['usuario'],'Update','Vehiculos','Cambio estado ID: '.$id_vehiculo.' A: '.$tipo);
        }
        else{
            $datos['exito'] = false;
            $errores['guardar'] = "Error en el servidor";
            $datos['errores'] = $errores;
        }    
    }else{
        $datos['exito'] = false;
        $datos['errores'] = $errores;
    }

    

    ///retorno de json
    echo json_encode($datos);


?>
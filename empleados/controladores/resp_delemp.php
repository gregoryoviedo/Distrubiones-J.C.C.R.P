<?php

    session_start();

    require('../modelos/empleados.class.php');

    require_once('../../auditoria/modelo/auditoria.class.php');

	$auditor = new auditor;

    $obj = new empleados;
    $datos = array();
    $errores = array();

    // CAPTURA DE DATOS 

    // id +++

    $id = $_POST['id'];

    // tipo +++

    $tipo = $_POST['tipo'];


    // insersion de datos

    $ok = $obj->cambiar_estado($id,$tipo);
  
    if($ok){
        $datos['exito'] = true;
        $auditor->auditar($_SESSION['id_empleado'],$_SESSION['usuario'],'Update','Empleados','Cambio estado ID:'.$id.' A: '.$tipo);
    }
    else{
        $datos['exito'] = false;
        $errores['guardar'] = "Error en el servidor";
        $datos['errores'] = $errores;
    }        

    

    ///retorno de json
    echo json_encode($datos);


?>
<?php

    session_start();
    require('../modelo/inventario.class.php');
    require_once('../../auditoria/modelo/auditoria.class.php');
	$auditor = new auditor;

    $obj = new inventario;
    $datos = array();
    $errores = array();

    // CAPTURA DE DATOS 

    // id_elemento +++

    $id_elemento = $_POST['id_elemento'];

    // tipo +++

    $tipo = $_POST['tipo'];

    // cantidad

    

    if($tipo=='eliminar'){
        $cantidad = $_POST['cantidad'];
        if($cantidad>0){
            $errores['mensaje'] = "No se puede eliminar elementos con stock mayor que 0";
        }
    }
    
    // insersion de datos

    if(empty($errores)){
        $ok = $obj->estado_elemento($id_elemento,$tipo);
  
        if($ok){
            $datos['exito'] = true;
            $auditor->auditar($_SESSION['id_empleado'],$_SESSION['usuario'],'Update','Inventario','Cambiar estado elemento ID: '.$id_elemento.' A: '.$tipo);
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
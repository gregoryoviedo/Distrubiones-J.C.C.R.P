<?php

    session_start();

    require('../modelo/ruta.class.php');
    require_once('../../auditoria/modelo/auditoria.class.php');
	$auditor = new auditor;

    $obj = new ruta;
    $datos = array();
    $errores = array();

    // CAPTURA DE DATOS 

    // id_ruta +++

    $id_ruta = $_POST['id_ruta'];

    if(empty($errores)){
        $ok = $obj->del_ruta($id_ruta);
  
        if($ok){
            $datos['exito'] = true;
            $auditor->auditar($_SESSION['id_empleado'],$_SESSION['usuario'],'Update','Rutas','Cambiar estado ruta ID: '.$id_ruta.' A: eliminado');
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
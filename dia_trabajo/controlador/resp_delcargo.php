<?php

    session_start();
    require('../modelo/trabajo.class.php');
    require_once('../../auditoria/modelo/auditoria.class.php');
	$auditor = new auditor;

    $obj = new trabajo;
    $datos = array();
    $errores = array();

    // CAPTURA DE DATOS Y VERIFICACION DE DATOS VACIOS

    $id_elemento = $_POST['id_elemento'];
    $id_cargamento = $_POST['id_cargamento'];
    $id_diatrabajo = $_POST['id_diatrabajo'];
    $cant_prod = $_POST['cant_prod'];
    
    // insersion de datos

    if(empty($errores)){

        $ok = $obj->del_cargo($id_cargamento);
        $ok2 = $obj->del_act_inv($id_diatrabajo,$id_elemento,$cant_prod);
        if($ok&&$ok2){
            $datos['exito'] = true;
            $datos['mensaje'] = "Se ha eliminado correctamente";
            $datos['id_diatrabajo'] = $id_diatrabajo;
            $auditor->auditar($_SESSION['id_empleado'],$_SESSION['usuario'],'Delete','Trabajo','Cargamento Devuelto ID: '.$id_elemento);
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
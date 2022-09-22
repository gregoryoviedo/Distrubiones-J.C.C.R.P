<?php

    session_start();
    require('../modelo/trabajo.class.php');
    require_once('../../auditoria/modelo/auditoria.class.php');
	$auditor = new auditor;


    $obj = new trabajo;
    $datos = array();
    $errores = array();

    // CAPTURA DE DATOS Y VERIFICACION DE DATOS VACIOS

    $id_diatrabajo = $_POST['id_diatrabajo'];
    
    // VALIDAR QUE NO ESTE VACIO EL CARGAMENTO

    $ok = $obj->cargo_vacio($id_diatrabajo);

    if($ok){
        $errores['mensaje']= "No puede enviarse una ruta con cargamento vacio";
    }
    
    // insersion de datos

    if(empty($errores)){

        $ok = $obj->enviar_ruta($id_diatrabajo);
       
        if($ok){
            $datos['exito'] = true;
            $datos['mensaje'] = "Se ha enviado correctamente";
            $auditor->auditar($_SESSION['id_empleado'],$_SESSION['usuario'],'Update','Trabajo','Ruta enviada del trabajo ID:'.$id_diatrabajo);
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
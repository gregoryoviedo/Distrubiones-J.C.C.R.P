<?php

    session_start();
    require('../modelo/trabajo.class.php');
    require_once('../../auditoria/modelo/auditoria.class.php');
	$auditor = new auditor;
    date_default_timezone_set('America/Caracas');
    $obj = new trabajo;
    $datos = array();
    $errores = array();

    // CAPTURA DE DATOS Y VERIFICACION DE DATOS VACIOS


    $id_ruta = $_POST['id_ruta'];
    $id_zona = $_POST['id_zona'];
    


    // VALIDAR DATOS

    if(empty($_POST['escolta'])){
        $escolta = "NO POSEE";
    }else{
        $escolta = mb_strtoupper($_POST['escolta']);
    }

    $ok = $obj->verif_rutatrabajo($id_ruta,date("Y-m-d"));
    if($ok){
        $errores['mensaje'] = "Esta ruta ya fue seleccionada para hoy";
    }

    $ok = $obj->verif_zonatrabajo($id_zona,date("Y-m-d"));
    if($ok){
        $errores['mensaje'] = "Esta zona ya fue seleccionada para hoy";
    }

    $ok = $obj->verif_activos($id_ruta);
    if($ok){
        $errores['mensaje'] = "Esta ruta posee elementos deshabilitados";
    }

    // insersion de datos

    if(empty($errores)){

        $ok = $obj->new_trabajo($id_ruta,$id_zona,$escolta,date("Y-m-d"));

        if($ok){
            $datos['exito'] = true;
            $datos['mensaje'] = "Se ha insertado correctamente";
            $auditor->auditar($_SESSION['id_empleado'],$_SESSION['usuario'],'Insert','Trabajo','Nuevo trabajo asignado Ruta: '.$id_ruta);
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
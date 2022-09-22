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
    $existencias = $_POST['existencias'];
    $id_diatrabajo = $_POST['id_diatrabajo'];

    if(empty($_POST['llevar'])){
        $errores['mensaje'] = "Debe seleccionar la cantidad a llevar";
    }else{
        $llevar = $_POST['llevar'];
        if($llevar > $existencias){
            $errores['mensaje'] = "La cantidad a llevar no puede ser mayor a existencias";
        }
    }

    // VALIDAR DATOS

    $ok = $obj->verif_elemento($id_elemento,$id_diatrabajo);

    if($ok){
        $errores['mensaje'] = "Este elemento ya fue asignado a esta ruta";
    }
    
    // insersion de datos

    if(empty($errores)){

        $ok = $obj->new_cargo($id_diatrabajo,$id_elemento,$llevar);
        $ok2 = $obj->new_act_inv($id_diatrabajo,$id_elemento,$llevar,$existencias);
        if($ok&&$ok2){
            $datos['exito'] = true;
            $datos['mensaje'] = "Se ha insertado correctamente";
            $datos['id_diatrabajo'] = $id_diatrabajo;
            $auditor->auditar($_SESSION['id_empleado'],$_SESSION['usuario'],'Insert','Trabajo','Cargamento Asignado ID: '.$id_elemento.' Cantidad: '.$llevar);
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
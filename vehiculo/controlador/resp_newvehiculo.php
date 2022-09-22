<?php

    session_start();

    require("../modelo/vehiculo.class.php");

    require_once('../../auditoria/modelo/auditoria.class.php');
	$auditor = new auditor;


    $obj = new vehiculo;

    $errores = array();
    $datos = array();

    // captura de datos

    if(empty($_POST['matricula'])){
        $errores['mensaje'] = "Por favor llenar todos los campos marcados (*)";
    }else{
        $verif_matricula = $obj->verif_matricula(strtoupper($_POST['matricula']));
        if($verif_matricula){
            $errores['mensaje'] = "Esta matricula ya se encuentra registrada";
        }else{
            $matricula = strtoupper($_POST['matricula']);
        }
    }

    if(empty($_POST['marca'])){
        $errores['mensaje'] = "Por favor llenar todos los campos marcados (*)";
    }else{
        $marca = strtoupper($_POST['marca']);
    }

    if(empty($_POST['modelo'])){
        $errores['mensaje'] = "Por favor llenar todos los campos marcados (*)";
    }else{
        $modelo = strtoupper($_POST['modelo']);
    }

    if(empty($errores)){
    
        $ok = $obj->new_vehiculo($matricula,$marca,$modelo);
    
        if($ok){
            $datos['exito'] = true;
            $datos['mensaje'] = "Se ha insertado correctamente";     
            $auditor->auditar($_SESSION['id_empleado'],$_SESSION['usuario'],'Insert','Vehiculos','Registro vehiculo matricula: '.$matricula);      
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
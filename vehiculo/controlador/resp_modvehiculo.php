<?php

    session_start();

    require("../modelo/vehiculo.class.php");

    require_once('../../auditoria/modelo/auditoria.class.php');
	$auditor = new auditor;

    $obj = new vehiculo;

    $errores = array();
    $datos = array();

    // captura de datos

    $id_vehiculo = $_POST['id_vehiculo'];

    if(empty($_POST['matricula'])){
        $errores['mensaje'] = "Por favor llenar todos los campos marcados (*)";
    }else{
        $verif_matricula = $obj->verif_mod_matricula(strtoupper($_POST['matricula']),$id_vehiculo);
        if($verif_matricula){
            $errores['mensaje'] = "Esta matricula ya se encuentra registrada en otro vehiculo";
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
    
        $ok = $obj->mod_vehiculo($id_vehiculo,$matricula,$marca,$modelo);
    
        if($ok){
            $datos['exito'] = true;
            $datos['mensaje'] = "Se ha modificado correctamente";
            $auditor->auditar($_SESSION['id_empleado'],$_SESSION['usuario'],'Update','Vehiculos','Modificar vehiculo ID: '.$id_vehiculo);             
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
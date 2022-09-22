<?php

    session_start();

    require('../modelos/empleados.class.php');

    require_once('../../auditoria/modelo/auditoria.class.php');

	$auditor = new auditor;
    $obj = new empleados;
    $datos = array();
    $errores = array();

    // CAPTURA DE DATOS Y VERIFICACION DE DATOS VACIOS

    // id +++

    $id = $_POST['id'];

    //nombre +++

    if(empty($_POST['nombre'])){
        $errores['mensaje'] = "Por favor llenar todos los campos marcados (*)";
    }else{
        $nombre = strtoupper($_POST['nombre']);
    }

    //apellido +++

    if(empty($_POST['apellido'])){
        $errores['mensaje'] = "Por favor llenar todos los campos marcados (*)";
    }else{
        $apellido = strtoupper($_POST['apellido']);
    }

    

    //telefono +++

    if(empty($_POST['telefono'])){
        $errores['mensaje'] = "Por favor llenar todos los campos marcados (*)";
    }else{
        $telefono = $_POST['tipo_tel'].$_POST['telefono'];
    }

    //email +++

    if(empty($_POST['email'])){
        $email = "N/R";
    }else{
        $email = $_POST['email'];
    }
    
    // insersion de datos

    if(empty($errores)){

        $ok = $obj->modemp($id,$nombre,$apellido,$telefono,$email);

        if($ok){
            $datos['exito'] = true;
            $datos['mensaje'] = "Se ha modificado correctamente";
            $auditor->auditar($_SESSION['id_empleado'],$_SESSION['usuario'],'Update','Empleados','Modificacion de ID:'.$id);

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
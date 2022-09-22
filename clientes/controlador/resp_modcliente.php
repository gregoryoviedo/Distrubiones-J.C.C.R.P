<?php

    session_start();

    require('../modelo/cliente.class.php');

    require_once('../../auditoria/modelo/auditoria.class.php');


	$auditor = new auditor;

    $obj = new cliente;
    $datos = array();
    $errores = array();

    // CAPTURA DE DATOS Y VERIFICACION DE DATOS VACIOS

    // id_cliente +++

    $id_cliente = $_POST['id_cliente'];

    // id_zona +++

    $id_zona = $_POST['id_zona'];

    //nom_fiscal +++

    if(empty($_POST['nom_fiscal'])){
        $errores['mensaje'] = "Por favor llenar todos los campos marcados (*) falta nom";
    }else{
        $nom_fiscal = mb_strtoupper($_POST['nom_fiscal']);
    }

    //telefono +++

    if(empty($_POST['telefono'])){
        $errores['mensaje'] = "Por favor llenar todos los campos marcados (*) falta tel";
    }else{
        $telefono = $_POST['tipo_tel'].$_POST['telefono'];
    }

    //direccion +++

    if(empty($_POST['direccion'])){
        $errores['mensaje'] = "Por favor llenar todos los campos marcados (*) falta direc";
    }else{
        $direccion = mb_strtoupper($_POST['direccion']);
    }
    
    // insersion de datos

    if(empty($errores)){

        $ok = $obj->mod_cliente($id_cliente,$id_zona,$nom_fiscal,$telefono,$direccion);

        if($ok){
            $datos['exito'] = true;
            $datos['mensaje'] = "Se ha modificado correctamente";
            $auditor->auditar($_SESSION['id_empleado'],$_SESSION['usuario'],'Update','Clientes','Modificacion Cliente de ID:'.$id_cliente);
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
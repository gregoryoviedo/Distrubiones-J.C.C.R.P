<?php

    session_start();

    require('../modelo/cliente.class.php');

    require_once('../../auditoria/modelo/auditoria.class.php');


	$auditor = new auditor;

    $obj = new cliente;
    $datos = array();
    $errores = array();

    // CAPTURA DE DATOS Y VERIFICACION DE DATOS VACIOS


    //nom_fiscal +++

    if(empty($_POST['nom_fiscal'])){
        $errores['mensaje'] = "Por favor llenar todos los campos marcados (*)";
    }else{
        $nom_fiscal = mb_strtoupper($_POST['nom_fiscal']);
    }

     //rif +++

    if(empty($_POST['rif'])){
        $errores['mensaje'] = "Por favor llenar todos los campos marcados (*)";
    }else{

        $rif = $_POST['tipo_rif'].$_POST['rif'];

        //verificando si la rif ya esta registrada
       $verifrif = $obj->verif_rif($rif);
        if($verifrif){
            $errores['mensaje'] = "Esta rif ya se encuentra registrado";
        }
        
    }

    //id_zona +++

    if(empty($_POST['id_zona'])){
        $errores['mensaje'] = "Por favor seleccionar una zona urbana";
    }else{
        $id_zona = $_POST['id_zona'];
    }

    //telefono +++

    if(empty($_POST['telefono'])){
        $errores['mensaje'] = "Por favor llenar todos los campos marcados (*)";
    }else{
        $telefono = $_POST['tipo_tel'].$_POST['telefono'];
    }


    //direccion +++

    if(empty($_POST['direccion'])){
        $errores['mensaje'] = "Por favor llenar todos los campos marcados (*)";
    }else{
        $direccion = mb_strtoupper($_POST['direccion']);
    }

    

    // insersion de datos

    if(empty($errores)){

        $ok = $obj->nuevo_cliente($id_zona,$nom_fiscal,$rif,$telefono,$direccion);

        if($ok){
            $datos['exito'] = true;
            $datos['mensaje'] = "Se ha registrado correctamente";
            $auditor->auditar($_SESSION['id_empleado'],$_SESSION['usuario'],'Insert','Clientes','Registro Cliente de RIF:'.$rif);

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
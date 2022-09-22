<?php

    session_start();

    require("../modelo/ruta.class.php");

    require_once('../../auditoria/modelo/auditoria.class.php');
	$auditor = new auditor;

    $obj= new ruta;

    $datos = array();
    $errores = array();
    
    // CAPTURA DE DATOS Y VERIFICACION DE DATOS VACIOS
    
    // CAPTURAR VENDEDOR 1
    
    if(empty($_POST['id_vendedor1'])){
        $errores['mensaje'] = "Por favor seleccione todos los campos (*)";
    }else{

        $ok=$obj->verif_newvendedor($_POST['id_vendedor1']);
        if($ok){
            $errores['mensaje'] = "El vendedor 1 ya pertenece a otra ruta";
        }else{
            $id_vendedor1 = $_POST['id_vendedor1'];
        }
    }
    
    // CAPTURAR VENDEDOR 2
    
    if(empty($_POST['id_vendedor2'])){
        $errores['mensaje'] = "Por favor seleccione todos los campos (*)";
    }else{
        $ok=$obj->verif_newvendedor($_POST['id_vendedor2']);
        if($ok){
            $errores['mensaje'] = "El vendedor 2 ya pertenece a otra ruta";
        }else{
            $id_vendedor2 = $_POST['id_vendedor2'];               
        }
    }

    
    if($_POST['id_vendedor1']==$_POST['id_vendedor2']){
        $errores['mensaje'] = "No puede seleccionar dos veces el mismo vendedor";
    }   

    // CAPTURAR VEHICULO
    
    if(empty($_POST['id_vehiculo'])){
        $errores['mensaje'] = "Por favor seleccione todos los campos (*)";
    }else{
        $ok=$obj->verif_newvehiculo($_POST['id_vehiculo']);
        if($ok){
            $errores['mensaje'] = "Este vehiculo ya esta asignado a otra ruta";
        }else{
            $id_vehiculo = $_POST['id_vehiculo'];
        }
    }

    // INSERSION DE DATOS

    if(empty($errores)){
    
        $ok = $obj->new_ruta($id_vendedor1,$id_vendedor2,$id_vehiculo);
    
        if($ok){
            $datos['exito'] = true;
            $datos['mensaje'] = "El registro se ha realizado correctamente";
            $auditor->auditar($_SESSION['id_empleado'],$_SESSION['usuario'],'Insert','Rutas','Nueva ruta ID vendedor 1:'.$id_vendedor1.' ID vendedor 2:'.$id_vendedor2.' ID vehiculo: '.$id_vehiculo);        
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
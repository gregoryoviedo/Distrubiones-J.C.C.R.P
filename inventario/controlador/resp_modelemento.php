<?php

    session_start();
    require("../modelo/inventario.class.php");
    require_once('../../auditoria/modelo/auditoria.class.php');
	$auditor = new auditor;

    $obj= new inventario;

    $datos = array();
    $errores = array();
    
    // CAPTURA DE DATOS Y VERIFICACION DE DATOS VACIOS
    
    // CAPTURAR ID CATEGORIA

    $id_elemento = $_POST['id_elemento'];

    // CAPTURAR NOMBRE
    
    if(empty($_POST['nombre'])){
        $errores['mensaje'] = "Por favor llenar todos los campos marcados (*)";
    }else{
        $nombre = strtoupper($_POST['nombre']);
    }
    
    // CAPTURAR PRECIO
    
    if(empty($_POST['precio'])){
        $errores['mensaje'] = "Por favor llenar todos los campos marcados (*)";

    }else{

        if($_POST['precio']<1){
            $errores['mensaje'] = "El precio no puede ser 0 o menor";
        }else{
            $precio = $_POST['precio'];
        }      
    }

    // CAPTURAR CANTIDAD
    
    if(empty($_POST['cantidad'])){
        $cantidad = 0;
    }else{

        if($_POST['cantidad']<1){
            $errores['mensaje'] = "La cantidad no puede un numero negativo";
        }else{
            $cantidad = $_POST['cantidad'];
        }      
    }

    // CAPTURAR DESCRIPCION
    
    $descripcion = strtoupper($_POST['descripcion']);
    

    // INSERSION DE DATOS

    if(empty($errores)){
    
        $ok = $obj->mod_elemento($id_elemento,$nombre,$cantidad,$precio,$descripcion);
    
        if($ok){
            $datos['exito'] = true;
            $datos['mensaje'] = "El registro se ha realizado correctamente"; 
            $auditor->auditar($_SESSION['id_empleado'],$_SESSION['usuario'],'Update','Inventario','Modificar elemento ID: '.$id_elemento);         
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
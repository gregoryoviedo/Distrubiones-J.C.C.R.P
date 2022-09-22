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

    $id_categoria = $_POST['id_categoria'];

    // CAPTURAR NOMBRE
    
    if(empty($_POST['nombre'])){
        $errores['mensaje'] = "Por favor llenar todos los campos marcados (*)";
    }else{
        $nombre = strtoupper($_POST['nombre']);
    }
    

    // INSERSION DE DATOS

    if(empty($errores)){
    
        $ok = $obj->mod_categoria($id_categoria,$nombre);
    
        if($ok){
            $datos['exito'] = true;
            $datos['mensaje'] = "El registro se ha realizado correctamente"; 
            $auditor->auditar($_SESSION['id_empleado'],$_SESSION['usuario'],'Update','Inventario','Modificar categoria ID: '.$id_categoria);          
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
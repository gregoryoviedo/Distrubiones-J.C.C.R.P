<?php

    session_start();
    require("../modelo/inventario.class.php");
    require_once('../../auditoria/modelo/auditoria.class.php');
	$auditor = new auditor;

    $obj= new inventario;

    $datos = array();
    $errores = array();
    
    // CAPTURA DE DATOS Y VERIFICACION DE DATOS VACIOS
    
    // CAPTURAR NOMBRE
    
    if(empty($_POST['nom_newcategoria'])){
        $errores['mensaje'] = "Por favor llenar todos los campos marcados (*)";
    }else{
        $nom_newcategoria = strtoupper($_POST['nom_newcategoria']);
    }
    
    // INSERSION DE DATOS

    if(empty($errores)){
    
        $ok = $obj->new_categoria($nom_newcategoria);
    
        if($ok){
            $datos['exito'] = true;
            $datos['mensaje'] = "El registro se ha realizado correctamente";   
            $auditor->auditar($_SESSION['id_empleado'],$_SESSION['usuario'],'Insert','Inventario','Nueva Categoria: '.$nom_newcategoria);         
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
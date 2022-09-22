<?php

    session_start();

    require("../modelo/cliente.class.php");

    require_once('../../auditoria/modelo/auditoria.class.php');


	$auditor = new auditor;

    $obj= new cliente;

    $datos = array();
    $errores = array();
    
    // CAPTURA DE DATOS Y VERIFICACION DE DATOS VACIOS
    
    // CAPTURAR TIPO DE OPERACION
    
    $tipo_op = $_POST["tipo_op"];
    
    if($tipo_op=="insertar"){

        if(empty($_POST['nom_newzona'])){
            $errores['mensaje'] = "Por favor llenar todos los campos marcados (*)";
        }else{
            $nom_newzona = mb_strtoupper($_POST['nom_newzona']);
        }


        // INSERSION EN ZONA
        if(empty($errores)){
    
            $ok = $obj->new_zona($nom_newzona);
        
            if($ok){
                $datos['exito'] = true;
                $datos['mensaje'] = "El registro se ha realizado correctamente";    
                $auditor->auditar($_SESSION['id_empleado'],$_SESSION['usuario'],'Insert','Zonas','Se ha registrado la zona: '.$nom_newzona);       
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

    }elseif($tipo_op=="modificar"){

        $id_zona = $_POST['id_zona'];

        if(empty($_POST['nom_modzona'])){
            $errores['mensaje'] = "Por favor llenar todos los campos marcados (*)";
        }else{
            $nom_modzona = mb_strtoupper($_POST['nom_modzona']);
        }


        // INSERSION EN ZONA
        if(empty($errores)){
    
            $ok = $obj->mod_zona($id_zona,$nom_modzona);
        
            if($ok){
                $datos['exito'] = true;
                $datos['mensaje'] = "Se ha modificado correctamente";    
                $auditor->auditar($_SESSION['id_empleado'],$_SESSION['usuario'],'Update','Zonas','Se ha modificado la zona ID: '.$id_zona.' A: '.$nom_modzona);       
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
    }

    
    
    ///retorno de json
    echo json_encode($datos);

?>
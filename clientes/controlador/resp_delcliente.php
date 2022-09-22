<?php

    session_start();

    require('../modelo/cliente.class.php');

    require_once('../../auditoria/modelo/auditoria.class.php');


	$auditor = new auditor;

    $obj = new cliente;
    $datos = array();
    $errores = array();

    // CAPTURA DE DATOS 

    // id_cliente +++

    $id_cliente = $_POST['id_cliente'];

    // tipo +++

    $tipo = $_POST['tipo'];

    // insersion de datos

    if(empty($errores)){
        $ok = $obj->estado_cliente($id_cliente,$tipo);
  
        if($ok){
            $datos['exito'] = true;
            $auditor->auditar($_SESSION['id_empleado'],$_SESSION['usuario'],'Update','Clientes','Cambio estado ID:'.$id_cliente.' A: '.$tipo);
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
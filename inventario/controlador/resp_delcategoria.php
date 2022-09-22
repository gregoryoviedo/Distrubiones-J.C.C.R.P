<?php

    session_start();
    require('../modelo/inventario.class.php');
    require_once('../../auditoria/modelo/auditoria.class.php');
	$auditor = new auditor;

    $obj = new inventario;
    $datos = array();
    $errores = array();

    // CAPTURA DE DATOS 

    // id_categoria +++

    $id_categoria = $_POST['id_categoria'];

    // tipo +++

    $tipo = $_POST['tipo'];

       
    // validar que no haya elementos activos
    
    if($tipo=='eliminar'){
        $ok = $obj->verif_elementos_activos($id_categoria);
        if($ok){
            $errores['mensaje'] = "No se puede eliminar categorias que posean elementos activos";
        }
    }
    
    // insersion de datos

    if(empty($errores)){
        $ok = $obj->estado_categoria($id_categoria,$tipo);
  
        if($ok){
            $datos['exito'] = true;
            $auditor->auditar($_SESSION['id_empleado'],$_SESSION['usuario'],'Update','Inventario','Cambiar estado categoria ID: '.$id_categoria.' A: '.$tipo);
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
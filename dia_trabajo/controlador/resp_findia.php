<?php

    session_start();

    require('../modelo/trabajo.class.php');

    require_once('../../auditoria/modelo/auditoria.class.php');
	$auditor = new auditor;

    $obj = new trabajo;
    $datos = array();
    $errores = array();

    // CAPTURA DE DATOS Y VERIFICACION DE DATOS VACIOS

    $id_diatrabajo = $_POST['id_diatrabajo'];
    
    // VALIDAR QUE TENGA FACTURAS

    $ok = $obj->validar_facturas($id_diatrabajo);

    if($ok){
        $errores['mensaje']= "No puede finalizar un dia sin facturas";
    }
    
    // insersion de datos

    if(empty($errores)){

        $ok = $obj->devolver_cargo($id_diatrabajo);
       
        if($ok){

            $ok = $obj->estado_diatrabajo($id_diatrabajo);
            if($ok){
                $datos['exito'] = true;
                $datos['mensaje'] = "Se ha finalizado";
                $auditor->auditar($_SESSION['id_empleado'],$_SESSION['usuario'],'Update','Trabajo','Dia finalizado ID: '.$id_diatrabajo);
            }else{
                $datos['exito'] = false;
                $errores['guardar'] = "Error al finalizar dia";
                $datos['errores'] = $errores;
            }
        }
        else{
            $datos['exito'] = false;
            $errores['guardar'] = "Error al regresar el cargamento";
            $datos['errores'] = $errores;
        }        

    }else{
        $datos['exito'] = false;
		$datos['errores'] = $errores;
        
    }

    ///retorno de json
    echo json_encode($datos);


?>
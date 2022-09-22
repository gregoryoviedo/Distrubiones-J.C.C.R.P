<?php

// inicializacion del objeto y los array

session_start();



date_default_timezone_set('America/Caracas');
require('../modelos/empleados.class.php');
require_once('../../auditoria/modelo/auditoria.class.php');


$obj = new empleados;
$auditor = new auditor;

$datos = array();
$errores = array();


$id_empleado = $_POST["id_empleado_pic"];

$cedula = $_POST["cedula_pic"];

$ruta_guardar = '../../recursos/img/fotos_perfil/';

$tipo_img=$_FILES["imagen"]["type"];


if (($tipo_img == "image/pjpeg") || ($tipo_img == "image/jpeg") || ($tipo_img == "image/jpg") || ($tipo_img == "image/png")) {

    $fichero = $ruta_guardar.basename('imgperfil_'.$cedula.'_'.date('Y-m-d').'.png');    
    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $fichero)) {
        echo "imagen guardada";
        $band = $obj->new_galeria($id_empleado,'imgperfil_'.$cedula.'_'.date('Y-m-d').'.png');
        if($band){
            echo "base de datos actualizada";
            $auditor->auditar($_SESSION['id_empleado'],$_SESSION['usuario'],'Update','Empleados','Foto de perfil de C.I:'.$cedula);
        }else{
            echo "no se pudo actualizar la base de datos";
        }
    } else {
        echo "no se pudo guardar";
    }
} else {
    echo "formato invalido";
}


?>
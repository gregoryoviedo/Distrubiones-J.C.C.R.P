<?php

// inicializacion del objeto y los array

session_start();

require('../modelos/empleados.class.php');
require_once('../../auditoria/modelo/auditoria.class.php');

$auditor = new auditor;

$obj = new empleados;

$datos = array();
$errores = array();

// CAPTURA DE DATOS Y VERIFICACION DE DATOS VACIOS

// passwords

$id_empleado = $_POST["id_empleado_pass"];

if(empty($_POST['newpass1'])||empty($_POST['newpass2'])){
    $errores['mensaje'] = "Por favor llenar todos los campos marcados (*)";
    
}elseif($_POST['newpass1']!=$_POST['newpass2']){
    $errores['mensaje'] = "Las contraseñas no son similares";
}elseif(strlen($_POST['newpass1'])<6 || strlen($_POST['newpass2'])<6){
    $errores['mensaje'] = "La contreña es muy pequeña";
}else{
    $pass = $_POST['newpass1'];
}

// insersion de datos

if(empty($errores)){

    $ok = $obj->mod_pass($id_empleado,$pass);

    if($ok){
        $datos['exito'] = true;
        $datos['mensaje'] = "La modificacion se ha realizado correctamente";
        $auditor->auditar($_SESSION['id_empleado'],$_SESSION['usuario'],'Update','Empleados','Cambio de contraseña de ID:'.$id_empleado);
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
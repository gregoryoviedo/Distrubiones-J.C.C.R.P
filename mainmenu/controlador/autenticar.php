<?php

require('../modelo/menu.class.php');
require_once('../../auditoria/modelo/auditoria.class.php');

$auditor = new auditor;

$obj = new menu;


$datos = array();
$errores = array();


if(empty($_POST['usuario'])||empty($_POST['pass'])){
    $errores['mensaje']= 'Introducir datos de acceso';
}else{
    $usuario = $_POST['usuario'];
    $pass = hash('sha512',$_POST['pass']);
    $verif = $obj->ingresar($usuario,$pass);
    if(!$verif){
        $errores['mensaje']= 'Usuario y/o contraseña erroneo';
    }

    $eliminado = $obj->verif_eliminado($usuario,$pass);
    if($eliminado){
        $errores['mensaje']= 'Esta usuario se encuentra deshabilitado';
    }
}


if(empty($errores)){

    $info = $obj->datos_usuario($usuario);

    foreach ($info as $row) {
        $id_usuario = $row['id_usuarios'];
        $id_empleado = $row['id_empleado'];
        $usuario = $row['usuario'];
        $nivel = $row['nivel'];
        $nombre = $row['nombre'];
        $apellido = $row['apellido'];
        $cedula = $row['cedula'];
        $cargo = $row['cargo'];
        $urlfoto = $row['urlfoto'];
        $id_galeria = $row['id_galeria'];
    }

    session_start();

    $_SESSION['id_usuario'] = $id_usuario;
    $_SESSION['id_empleado'] = $id_empleado;
    $_SESSION['usuario'] = $usuario;
    $_SESSION['nivel'] = $nivel;
    $_SESSION['nombre'] = $nombre;
    $_SESSION['apellido'] = $apellido;
    $_SESSION['cedula'] = $cedula;
    $_SESSION['cargo'] = $cargo;
    $_SESSION['urlfoto'] = $urlfoto;
    $_SESSION['id_galeria'] = $id_galeria;

    $auditor->auditar($_SESSION['id_empleado'],$_SESSION['usuario'],'Ingreso','LogIn','Ingreso al sistema');

    $datos['exito'] = true;

}else{

    $datos['errores'] = $errores;

    
}

echo json_encode($datos);
?>
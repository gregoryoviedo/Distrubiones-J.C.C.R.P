<?php

    session_start();

    require('../modelos/empleados.class.php');
    require_once('../../auditoria/modelo/auditoria.class.php');


	$auditor = new auditor;

    $obj = new empleados;
    $datos = array();
    $errores = array();

    // CAPTURA DE DATOS Y VERIFICACION DE DATOS VACIOS

    //nombre +++

    if(empty($_POST['nombre'])){
        $errores['mensaje'] = "Por favor llenar todos los campos marcados (*)";
    }else{
        $nombre = mb_strtoupper($_POST['nombre']);
    }

    //apellido +++

    if(empty($_POST['apellido'])){
        $errores['mensaje'] = "Por favor llenar todos los campos marcados (*)";
    }else{
        $apellido = mb_strtoupper($_POST['apellido']);
    }

    //cedula +++

    if(empty($_POST['cedula'])){
        $errores['mensaje'] = "Por favor llenar todos los campos marcados (*)";
    }else{

        $cedula = $_POST['tipo_ced'].$_POST['cedula'];

        //verificando si la cedula ya esta registrada
       $verifced = $obj->verif_ced($cedula);
        if($verifced){
            $errores['mensaje'] = "Esta cedula ya se encuentra registrada";
        }
        
    }

    //telefono +++

    if(empty($_POST['telefono'])){
        $errores['mensaje'] = "Por favor llenar todos los campos marcados (*)";
    }else{
        $telefono = $_POST['tipo_tel'].$_POST['telefono'];
    }

    //email +++

    if(empty($_POST['email'])){
        $email = "N/R";
    }else{
        $email = $_POST['email'];
    }

    
    // tipo de empleado +++

    $cargo = strtoupper($_POST['tipo_emp']);

    // usuario +++

    if(empty($_POST['usuario'])){
        $errores['mensaje'] = "Por favor llenar todos los campos marcados (*)";
    }else{
        $usuario = $_POST['usuario'];

        //verificando si el usuario ya esta registrado
        
        $verifuser = $obj->verif_user($usuario);
        if($verifuser){
            $errores['mensaje'] = "Este nombre de usuario ya esta ocupado";
        }
        
        if(strlen($usuario)<6){
            $errores['mensaje'] = "El nombre de usuario es muy pequeño";
        }
        
    }
    

    // passwords

    if(empty($_POST['pass1'])||empty($_POST['pass2'])){
        $errores['mensaje'] = "Por favor llenar todos los campos marcados (*)";
        
    }elseif($_POST['pass1']!=$_POST['pass2']){
        $errores['mensaje'] = "Las contraseñas no son similares";
    }elseif(strlen($_POST['pass1'])<6 || strlen($_POST['pass2'])<6){
        $errores['mensaje'] = "La contreña es muy pequeña";
    }else{
        $pass = $_POST['pass1'];
    }

     // insersion de datos

    if(empty($errores)){

        $ok1 = $obj->nuevo_empleado($nombre,$apellido,$cedula,$telefono,$email,$cargo);
        $ok2 = $obj->nuevo_login($usuario, $pass, $cargo, $cedula);

        if($ok1 && $ok2){
            $datos['exito'] = true;
            $datos['mensaje'] = "El registro se ha realizado correctamente";
            $auditor->auditar($_SESSION['id_empleado'],$_SESSION['usuario'],'Insert','Empleados','Registro empleado de C.I:'.$cedula);
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
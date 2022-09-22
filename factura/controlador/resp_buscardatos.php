<?php

    require('../modelo/factura.class.php');

    $obj = new factura;
    $datos = array();
    $errores = array();

    // CAPTURA DE DATOS 

    $id_zona = $_POST['id_zona'];

    if(empty($_POST['rif'])){
        $errores['mensaje'] = "El campo rif esta vacio";
    }else{
        $rif = strtoupper($_POST['rif']);
    }
   
    // busqueda de datos

    if(empty($errores)){
        $ok = $obj->datos_cli($id_zona,$rif);
        
        
        if(!$ok){
            $datos['exito'] = false;
            $errores['guardar'] = "Este rif no pertenece a un cliente de la zona asignada";
            $datos['errores'] = $errores;
        }else{
            $datos['exito'] = true;
            $cliente = array();
            foreach ($ok as $row) {
                $cliente['nom_fiscal'] = $row['nom_fiscal'];
                $cliente['id_cliente'] = $row['id_cliente'];
                $cliente['telefono'] = $row['telefono'];
            }
            $datos['cliente'] = $cliente;
        }
         
    }else{
        $datos['exito'] = false;
        $datos['errores'] = $errores;
    }

    

    ///retorno de json
    echo json_encode($datos);


?>
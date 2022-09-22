<?php


    function conectar(){
        $dbname ='jccrp';
        $host ='localhost';
        $user ='postgres';
        $pass ='gregory123';

        $dsn = "pgsql:host=$host;dbname=$dbname;user=$user;password=$pass";

        try {
            //creando conexion
            $conexion= new PDO($dsn);

            //habilitando modo errores
            $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            //retornando la conexion
            return $conexion;
        } catch (PDOException $e) {
            die("el error de conexion es: ". $e->getMessage());
        }
        
    }

?>
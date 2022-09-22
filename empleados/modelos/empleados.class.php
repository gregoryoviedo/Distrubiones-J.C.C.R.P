<?php

    require('../../recursos/db/conexiondb.php');

    class empleados{
    
    // INSERTAR EN EMPLEADO

        public function nuevo_empleado($nombre,$apellido,$cedula,$telefono,$email,$cargo){
            
            $conexion = conectar();

            try {

                $sql='INSERT INTO empleado(nombre,apellido,cedula,telefono,email,cargo) 
                  VALUES (:nombre,:apellido,:cedula,:telefono,:email,:cargo)';

                $query = $conexion->prepare($sql);

                $query->bindParam(":nombre",$nombre);
                $query->bindParam(":apellido",$apellido);
                $query->bindParam(":cedula",$cedula);
                $query->bindParam(":telefono",$telefono);
                $query->bindParam(":email",$email);
                $query->bindParam(":cargo",$cargo);

                $query->execute();
                return true;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }
    
    // INSERTAR EN USUARIOS

        public function nuevo_login($usuario, $pass, $cargo, $cedula){
            
            $conexion = conectar();

            try {
                $sql1 = "SELECT id_empleado FROM empleado WHERE cedula = '$cedula'";

                foreach ($conexion->query($sql1) as $row) {
                    $id= $row['id_empleado'];
                }
                
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }

            try {
                
                if($cargo=='VENDEDOR'){
                    $nivel=1;
                }
                if($cargo=='GERENTE'){
                    $nivel=2;
                }
                if($cargo=='ADMINISTRADOR'){
                    $nivel=3;
                }
                

                $sql2='INSERT INTO usuarios(id_empleado,usuario,pass,nivel) VALUES (:id_empleado,:usuario,:pass,:nivel)';

                $query = $conexion->prepare($sql2);

                $clave = hash('sha512',$pass);

                $query->bindParam(":id_empleado",$id);
                $query->bindParam(":usuario",$usuario);
                $query->bindParam(":pass",$clave);
                $query->bindParam(":nivel",$nivel);
               
                $query->execute();
                return true;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }

    // VERIFICAR SI LA CEDULA ESTA REGISTRADA

        public function verif_ced($cedula){

            $conexion = conectar();

            try {
                $sql="SELECT * FROM empleado WHERE cedula = '$cedula'";
                $query=$conexion->prepare($sql);
                $query->execute();
                if($query->fetchColumn()>0){
                    return true;
                }else{
                    return false;
                }
            } catch (PDOException $e) {
                die($e->getMessage());
                return true;
            }

        }


    // VERIFICAR SI EL USUARIO ESTA REGISTRADO

        public function verif_user($usuario){

            $conexion = conectar();

            try {
                $sql="SELECT * FROM usuarios WHERE usuario = '$usuario'";
                $query=$conexion->prepare($sql);
                $query->execute();
                if($query->fetchColumn()>0){
                    return true;
                }else{
                    return false;
                }
            } catch (PDOException $e) {
                die($e->getMessage());
                return true;
            }

        }

        // LISTA DE EMPLEADOS

        public function lista($habilitado){

            $conexion = conectar();

            if($habilitado=='habilitados'){
                $sql="SELECT * FROM empleado INNER JOIN galeria ON galeria.id_galeria = empleado.id_galeria WHERE empleado.eliminado = false ORDER BY empleado.id_empleado";
            }elseif($habilitado=='deshabilitados'){
                $sql="SELECT * FROM empleado INNER JOIN galeria ON galeria.id_galeria = empleado.id_galeria WHERE empleado.eliminado = true ORDER BY empleado.id_empleado";
            }

            try {
                $query = $conexion->prepare($sql);
                $query->execute();
                return $query;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }

        }


        // SELECT RELLENAR FORMULARIO

        public function rellenar($id){
            $conexion = conectar();

            try {
                $sql="SELECT * FROM empleado INNER JOIN galeria ON galeria.id_galeria = empleado.id_galeria INNER JOIN usuarios ON usuarios.id_empleado = empleado.id_empleado WHERE empleado.id_empleado = '$id'";
                $query = $conexion->prepare($sql);
                $query->execute();
                return $query;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }


        // MODIFICAR DATOS EMPLEADO

        public function modemp($id,$nombre,$apellido,$telefono,$email){
            
            $conexion = conectar();

            try {
                $sql="UPDATE empleado SET nombre = '$nombre', apellido = '$apellido', telefono = '$telefono', email = '$email' WHERE id_empleado = $id;";
                $query=$conexion->prepare($sql);
                
                
                $query->execute();
                return true;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }


        }

        // MODIFICAR ESTADO EMPLEADO

        public function cambiar_estado($id,$tipo){

            $conexion = conectar();

            if($tipo == 'eliminar'){
                $sql="UPDATE empleado SET eliminado = true WHERE id_empleado = $id";
            }
            if($tipo == 'habilitar'){
                $sql="UPDATE empleado SET eliminado = false WHERE id_empleado = $id";
            }

            try {
                
                $query = $conexion->prepare($sql);
                $query->execute();
                return true;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }


        }

        // CAMBIAR PASSWORD
        public function mod_pass($id_empleado,$pass){
            $conexion = conectar();
            $clave = hash('sha512',$pass);
            try {
                $sql = "UPDATE usuarios SET pass = '$clave' WHERE id_empleado = $id_empleado";
                $query = $conexion->prepare($sql);
                $query->execute();
                return true;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }

        // CAMBIAR FOTO

        public function new_galeria($id_empleado,$urlfoto){
            $conexion = conectar();
            
            try {

                
                $sql = "INSERT INTO galeria(urlfoto) VALUES ('$urlfoto')";
                $query = $conexion->prepare($sql);
                $query->execute();
                $query->closeCursor();

                $sql = "SELECT * FROM galeria ORDER BY id_galeria DESC LIMIT 1";
                $query2 = $conexion->prepare($sql);
                $query2->execute();

                foreach ($query2 as $row) {
                    $id_galeria = $row['id_galeria'];
                }
                $query2->closeCursor();

                $sql = "UPDATE empleado SET id_galeria = $id_galeria WHERE id_empleado = $id_empleado";
                $query3 = $conexion->prepare($sql);
                $query3->execute();

                return true;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }

    // FIN DE LA CLASE
    }

?>
<?php
    require("../../recursos/db/conexiondb.php");

    class menu {
        
        // LOG IN SISTEMA

        public function ingresar($usuario,$pass){

            $conexion = conectar();

            try {
                $sql="SELECT * FROM usuarios WHERE usuario = '$usuario' AND pass = '$pass' AND eliminado = false";
                $query = $conexion->prepare($sql);
                $query->execute();
                if($query->fetchColumn()>0){
                    return true;
                }else{
                    return false;
                }
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }

        }

        // VERIFICAR SI ESTA ELIMINADO EL USUARIO
        public function verif_eliminado($usuario,$pass){

            $conexion = conectar();

            try {
                $sql="SELECT * FROM usuarios WHERE usuario = '$usuario' AND pass = '$pass' AND eliminado = true";
                $query = $conexion->prepare($sql);
                $query->execute();
                if($query->fetchColumn()>0){
                    return true;
                }else{
                    return false;
                }
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }

        }

        public function datos_usuario($usuario){
            $conexion = conectar();

            try {
                $sql="SELECT usuarios.id_usuarios,usuarios.usuario,usuarios.nivel,empleado.cargo,empleado.id_empleado,empleado.nombre,empleado.apellido,empleado.cedula,galeria.* 
                      FROM usuarios INNER JOIN empleado ON empleado.id_empleado = usuarios.id_empleado
                      INNER JOIN galeria ON galeria.id_galeria = empleado.id_galeria
                      WHERE usuario = '$usuario'";
                $query = $conexion->prepare($sql);
                $query->execute();
                return $query;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }


        // DATOS FICHAS

        public function datos_fichas(){

            $conexion = conectar();

            $datos = array();

            try {
                $sql = "SELECT COUNT(*) FROM cliente";
                $cliente = $conexion->prepare($sql);
                $cliente->execute();
                foreach ($cliente as $row) {
                    $datos['clientes'] = $row['count'];
                }
                $cliente->closeCursor();

                $sql = "SELECT COUNT(*) FROM empleado";
                $empleado = $conexion->prepare($sql);
                $empleado->execute();
                foreach ($empleado as $row) {
                    $datos['empleados'] = $row['count'];
                }
                $empleado->closeCursor();

                $sql = "SELECT COUNT(*) FROM ruta";
                $ruta = $conexion->prepare($sql);
                $ruta->execute();
                foreach ($ruta as $row) {
                    $datos['rutas'] = $row['count'];
                }
                $ruta->closeCursor();

                $sql = "SELECT COUNT(*) FROM zona";
                $zona = $conexion->prepare($sql);
                $zona->execute();
                foreach ($zona as $row) {
                    $datos['zonas'] = $row['count'];
                }
                $zona->closeCursor();

                return $datos;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }


        public function zonas_clientes(){

            $conexion = conectar();
    
            try {
                $sql = "SELECT zona.nombre,COUNT(cliente.id_cliente) FROM zona
                        INNER JOIN cliente ON cliente.id_zona = zona.id_zona  
                        GROUP BY zona.nombre";
                $query = $conexion->prepare($sql);
                $query->execute();
                return $query;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }

        }

        // FIN DE CLASE
    }

?>
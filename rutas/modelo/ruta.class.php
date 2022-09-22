<?php

    require("../../recursos/db/conexiondb.php");

    class ruta{

        // NUEVA RUTA

        public function new_ruta($id_vendedor1,$id_vendedor2,$id_vehiculo){

            $conexion = conectar();

            try {
                $sql="INSERT INTO ruta(id_vendedor1,id_vendedor2,id_vehiculo) VALUES ($id_vendedor1,$id_vendedor2,$id_vehiculo)";
                $query = $conexion->prepare($sql);
                $query->execute();
                $query->closeCursor();
                return true;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }

        }

        // VERIFICAR VENDEDOR NO ESTE EN OTRA RUTA

        public function verif_newvendedor($id_vendedor){
            $conexion = conectar();

            try {
                $sql = "SELECT * FROM ruta WHERE (id_vendedor1 = $id_vendedor OR id_vendedor2 = $id_vendedor) AND eliminado = false";
                $query = $conexion->prepare($sql);
                $query->execute();
                $band = $query->rowCount();
                $query->closeCursor();
                if($band>0){
                    return true;
                }else{
                    return false;
                }

            } catch (PDOException $e) {
                die($e->getMessage());
                return true;
            }
        }

        // VERIFICAR VEHICULO NO ESTE EN OTRA RUTA

        public function verif_newvehiculo($id_vehiculo){
            $conexion = conectar();

            try {
                $sql = "SELECT * FROM ruta WHERE id_vehiculo = $id_vehiculo AND eliminado=false";
                $query = $conexion->prepare($sql);
                $query->execute();
                $band = $query->rowCount();
                $query->closeCursor();
                if($band>0){
                    return true;
                }else{
                    return false;
                }

            } catch (PDOException $e) {
                die($e->getMessage());
                return true;
            }
        }

        // LISTA DE VENDEDORES

        public function lista_vendedores(){

            $conexion = conectar();

            try {
                $sql="SELECT * FROM empleado WHERE cargo = 'VENDEDOR' AND eliminado=false ORDER BY id_empleado";
                $query = $conexion->prepare($sql);
                $query->execute();
                return $query;
            } catch (PDOException $e) {
                die($e->getMessage());
                return true;
            }

        }

        // LISTA VEHICULOS

        public function lista_vehiculos(){

            $conexion = conectar();

            try {
                $sql="SELECT * FROM vehiculos WHERE eliminado = false";
                $query = $conexion->prepare($sql);
                $query->execute();
                return $query;
            } catch (PDOException $e) {
                die($e->getMessage());
                return true;
            }

        }

        // LLENAR FICHA

        public function llenarficha($id_empleado){
            $conexion = conectar();

            try {
                $sql="SELECT * FROM empleado 
                      INNER JOIN galeria 
                      ON galeria.id_galeria = empleado.id_galeria 
                      WHERE empleado.id_empleado = $id_empleado";
                $query = $conexion->prepare($sql);
                $query->execute();
                return $query;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }

        }


        // LISTA DE RUTAS

        public function lista_rutas(){
            $conexion = conectar();

            try {
                $sql="SELECT ruta.*,emp1.nombre AS emp1_nom, emp1.apellido AS emp1_ape,emp1.eliminado AS emp1_eli,
                emp2.nombre AS emp2_nom, emp2.apellido AS emp2_ape,emp2.eliminado AS emp2_eli,
                vehiculos.matricula, vehiculos.modelo,vehiculos.eliminado AS veh_eli
                FROM ruta
                INNER JOIN empleado AS emp1 ON emp1.id_empleado = ruta.id_vendedor1
                INNER JOIN empleado AS emp2 ON emp2.id_empleado = ruta.id_vendedor2
                INNER JOIN vehiculos ON vehiculos.id_vehiculo = ruta.id_vehiculo
                WHERE ruta.eliminado=false ORDER BY ruta.id_ruta";

                $query= $conexion->prepare($sql);
                $query->execute();
                return $query;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }


        // VERIFICAR VENDEDOR MOD RUTA

        public function verif_modvendedor($id_vendedor,$id_ruta){
            $conexion = conectar();

            try {
                $sql = "SELECT * FROM ruta WHERE (id_vendedor1 = $id_vendedor OR id_vendedor2 = $id_vendedor) AND eliminado = false AND id_ruta != $id_ruta";
                $query = $conexion->prepare($sql);
                $query->execute();
                $band = $query->rowCount();
                $query->closeCursor();
                if($band>0){
                    return true;
                }else{
                    return false;
                }

            } catch (PDOException $e) {
                die($e->getMessage());
                return true;
            }
        }

        // VERIFICAR VEHICULO MOD RUTA

        public function verif_modvehiculo($id_vehiculo,$id_ruta){
            $conexion = conectar();

            try {
                $sql = "SELECT * FROM ruta WHERE id_vehiculo = $id_vehiculo AND eliminado=false AND id_ruta != $id_ruta";
                $query = $conexion->prepare($sql);
                $query->execute();
                $band = $query->rowCount();
                $query->closeCursor();
                if($band>0){
                    return true;
                }else{
                    return false;
                }

            } catch (PDOException $e) {
                die($e->getMessage());
                return true;
            }
        }

        // MODIFICAR RUTA

        public function mod_ruta($id_ruta,$id_vendedor1,$id_vendedor2,$id_vehiculo){

            $conexion = conectar();

            try {
                $sql= "UPDATE ruta SET id_vendedor1 = $id_vendedor1, id_vendedor2 = $id_vendedor2, id_vehiculo = $id_vehiculo WHERE id_ruta = $id_ruta";
                $query = $conexion->prepare($sql);
                $query->execute();
                $query->closeCursor();
                return true;

            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }


        // DESHABILITAR RUTAS

        public function del_ruta($id_ruta){

            $conexion = conectar();

            try {
                $sql = "UPDATE ruta SET eliminado = true WHERE id_ruta = $id_ruta";
                $query = $conexion->prepare($sql);
                $query->execute();
                $query->closeCursor();
                return true;

            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }

        }

        // LISTA DESHABILITADOS

        public function lista_deshabilitados(){

            $conexion = conectar();

            try {
                $sql = "SELECT ruta.*,emp1.nombre AS emp1_nom, emp1.apellido AS emp1_ape,emp1.eliminado AS emp1_eli,
                emp2.nombre AS emp2_nom, emp2.apellido AS emp2_ape,emp2.eliminado AS emp2_eli,
                vehiculos.matricula, vehiculos.modelo,vehiculos.eliminado AS veh_eli
                FROM ruta
                INNER JOIN empleado AS emp1 ON emp1.id_empleado = ruta.id_vendedor1
                INNER JOIN empleado AS emp2 ON emp2.id_empleado = ruta.id_vendedor2
                INNER JOIN vehiculos ON vehiculos.id_vehiculo = ruta.id_vehiculo
                WHERE ruta.eliminado=true ORDER BY ruta.id_ruta";

                $query = $conexion->prepare($sql);
                $query->execute();
                return $query;
                
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }

        }

        // HABILITAR RUTA

        public function hab_ruta($id_ruta,$id_vendedor1,$id_vendedor2,$id_vehiculo){

            $conexion = conectar();

            try {
                $sql= "UPDATE ruta SET id_vendedor1 = $id_vendedor1, id_vendedor2 = $id_vendedor2, id_vehiculo = $id_vehiculo, eliminado = false WHERE id_ruta = $id_ruta";
                $query = $conexion->prepare($sql);
                $query->execute();
                $query->closeCursor();
                return true;

            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }

        // FIN DE CLASE
    }



?>
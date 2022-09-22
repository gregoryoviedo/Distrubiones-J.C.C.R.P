<?php

    require('../../recursos/db/conexiondb.php');

    class vehiculo{

        // AGREGAR VEHICULO

        public function new_vehiculo($matricula,$marca,$modelo){

            $conexion = conectar();

            try {
                $sql="INSERT INTO vehiculos(matricula,marca,modelo) VALUES ('$matricula','$marca','$modelo');";
                $query = $conexion->prepare($sql);
                $query->execute();
                $query->closeCursor();
                return true;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }

        }

        // VERIFICAR MATRICULA REGISTRADA

        function verif_matricula($matricula){
            
            $conexion = conectar();

            try {
                $sql="SELECT * FROM vehiculos WHERE matricula = '$matricula';";
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

        // VERIFICAR MATRICULA REGISTRADA PARA MODIFICAR

        function verif_mod_matricula($matricula,$id_vehiculo){
            
            $conexion = conectar();

            try {
                $sql="SELECT * FROM vehiculos WHERE matricula = '$matricula' AND id_vehiculo != '$id_vehiculo';";
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


        // MODIFICAR VEHICULO

        public function mod_vehiculo($id_vehiculo,$matricula,$marca,$modelo){
            $conexion = conectar();

            try {
                $sql="UPDATE vehiculos SET matricula = '$matricula', marca = '$marca', modelo = '$modelo' WHERE id_vehiculo = $id_vehiculo;";
                $query = $conexion->prepare($sql);
                $query->execute();
                $query->closeCursor();
                return true;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }

        // ESTADO VEHICULO

        public function estado_vehiculo($id_vehiculo,$tipo){
            
            $conexion = conectar();

            try {

                if($tipo=='eliminar'){
                    $sql="UPDATE vehiculos SET eliminado = true WHERE id_vehiculo = $id_vehiculo";
                }elseif($tipo=='habilitar'){
                    $sql="UPDATE vehiculos SET eliminado = false WHERE id_vehiculo = $id_vehiculo";
                }
                $query = $conexion->prepare($sql);
                $query->execute();
                $query->closeCursor();
                return true;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }


        // LISTA DE VEHICULOS

        public function lista_vehiculo($estado){

            $conexion = conectar();

            try {
                if($estado == 'habilitados'){
                    $sql = "SELECT * FROM vehiculos WHERE eliminado = false ORDER BY id_vehiculo";
                }
                if($estado == 'deshabilitados'){
                    $sql = "SELECT * FROM vehiculos WHERE eliminado = true ORDER BY id_vehiculo";
                }
                $query = $conexion->prepare($sql);
                $query->execute();
                return $query;
            } catch (PDOException $e) {
               die($e->getMessage());
               return false;
            }


        }


        // FIN DE LA CLASE
    }

?>
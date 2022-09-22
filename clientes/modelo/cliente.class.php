<?php

    require('../../recursos/db/conexiondb.php');

    class cliente{

        /////////////// zonas /////////////

        // INSERTAR  ZONA

        public function new_zona($nombre){
            
            $conexion = conectar();

            try {
                $sql="INSERT INTO zona(nombre) VALUES ('$nombre');";
                $query = $conexion->prepare($sql);
                $query->execute();
                return true;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }
        
        // MODIFICAR ZONA

        public function mod_zona($id_zona,$nombre){

            $conexion = conectar();

            try {
                $sql="UPDATE zona SET nombre = '$nombre' WHERE id_zona = $id_zona";
                $query = $conexion->prepare($sql);
                $query->execute();
                return true;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }

        // LISTA DE ZONAS

        public function lista_zonas(){

            $conexion = conectar();

            try {
                $sql="SELECT * FROM zona";
                $query = $conexion->prepare($sql);
                $query->execute();
                return $query;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }

        }

        /////////////// clientes //////////
    
        // INSERTAR CLIENTE

        public function nuevo_cliente($id_zona,$nom_fiscal,$rif,$telefono,$direccion){
            
            $conexion = conectar();

            try {

                $sql="INSERT INTO cliente (id_zona,nom_fiscal,rif,telefono,direccion) 
                      VALUES ($id_zona,$$$nom_fiscal$$,'$rif','$telefono',$$$direccion$$);";

                $query = $conexion->prepare($sql);
                $query->execute();
                return true;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }

        // MODIFICAR CLIENTE

        public function mod_cliente($id_cliente,$id_zona,$nom_fiscal,$telefono,$direccion){
                
            $conexion = conectar();

            try {

                $sql="UPDATE cliente 
                      SET id_zona = $id_zona, 
                      nom_fiscal = $$$nom_fiscal$$,
                      telefono = '$telefono',
                      direccion = $$$direccion$$
                      WHERE id_cliente = $id_cliente;";

                $query = $conexion->prepare($sql);
                $query->execute();
                return true;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }

        // VERIFICAR SI EL RIF ESTA REGISTRADO

        public function verif_rif($rif){

            $conexion = conectar();

            try {
                $sql="SELECT * FROM cliente WHERE rif = '$rif'";
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

        // LISTA DE CLIENTES

        public function contar_paginas($busqueda){
            $conexion = conectar();

            try {
                $sql = "SELECT cliente.*,zona.nombre AS nom_zona FROM cliente 
                        INNER JOIN zona ON zona.id_zona = cliente.id_zona
                        WHERE LOWER(nom_fiscal) LIKE LOWER('%$busqueda%') OR
                        LOWER(rif) LIKE LOWER('%$busqueda%') OR
                        LOWER(telefono) LIKE LOWER('%$busqueda%') OR
                        LOWER(zona.nombre) LIKE LOWER('%$busqueda%')
                        AND cliente.eliminado = false
                        ORDER BY id_cliente DESC
                        ";
                $query= $conexion->prepare($sql);
                $query->execute();
                $cantidad = $query->rowCount();
                $query->closeCursor();
                return $cantidad;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }

        public function lista_cliente($busqueda,$pagina,$total_pag){

            $conexion = conectar();

            $empezar = ($pagina-1)*$total_pag;

            try {
                $sql = "SELECT cliente.*,zona.nombre AS nom_zona FROM cliente 
                        INNER JOIN zona ON zona.id_zona = cliente.id_zona
                        WHERE (LOWER(nom_fiscal) LIKE LOWER('%$busqueda%') OR
                        LOWER(rif) LIKE LOWER('%$busqueda%') OR
                        LOWER(telefono) LIKE LOWER('%$busqueda%') OR
                        LOWER(zona.nombre) LIKE LOWER('%$busqueda%'))
                        AND cliente.eliminado = 'false'
                        ORDER BY id_cliente DESC
                        LIMIT $total_pag OFFSET $empezar";
                $query= $conexion->prepare($sql);
                $query->execute();
                return $query;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }

        }

        public function lista_deshabilitados(){

            $conexion = conectar();

            try {
                $sql = "SELECT cliente.id_cliente,cliente.nom_fiscal,cliente.rif,zona.nombre AS nom_zona
                        FROM cliente INNER JOIN zona ON zona.id_zona = cliente.id_zona WHERE cliente.eliminado = true
                        ORDER BY cliente.id_cliente DESC";
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
                $sql="SELECT * FROM cliente INNER JOIN zona ON zona.id_zona = cliente.id_zona WHERE cliente.id_cliente = '$id'";
                $query = $conexion->prepare($sql);
                $query->execute();
                return $query;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }

        // CAMBIAR ESTADO DE CLIENTE

        public function estado_cliente($id_cliente,$tipo){
           
            $conexion = conectar();

            try {

                if($tipo=='eliminar'){
                    $sql="UPDATE cliente SET eliminado = true WHERE id_cliente = $id_cliente";
                }elseif($tipo=='habilitar'){
                    $sql="UPDATE cliente SET eliminado = false WHERE id_cliente = $id_cliente";
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
        


    // FIN DE LA CLASE
    }

?>
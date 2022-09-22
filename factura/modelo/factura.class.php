<?php
    require("../../recursos/db/conexiondb.php");
    date_default_timezone_set('America/Caracas');
    class factura{
        
        // NUEVA FACTURA 

        public function new_factura($id_diatrabajo,$fact_serial,$id_cliente,$total_factura){
            $conexion = conectar();
            $hoy = date('Y-m-d');
            try {
                $sql = "INSERT INTO factura(id_diatrabajo,fact_serial,id_cliente,total_factura,fecha) 
                        VALUES ($id_diatrabajo,'$fact_serial',$id_cliente,$total_factura,'$hoy') ";
                $query = $conexion->prepare($sql);
                $query->execute();
                $query->closeCursor();
                return true;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }

        // NUEVA COMPRA

        public function new_compra($id_cargamento,$id_factura,$id_elemento,$cantidad_prod){

            $conexion = conectar();
            try {
                $sql = "INSERT INTO compra(id_factura,id_elemento,cantidad_prod) 
                        VALUES ($id_factura,$id_elemento,$cantidad_prod) ";
                $query = $conexion->prepare($sql);
                $query->execute();
                $query->closeCursor();

                $sql = "UPDATE cargamento SET cantidad_prod = cantidad_prod - $cantidad_prod
                        WHERE id_cargamento = $id_cargamento";
                $query = $conexion->prepare($sql);
                $query->execute();
                $query->closeCursor();
                
                return true;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }

        }

        // BUSCAR DATOS CLIENTE

        public function datos_trabajo($id_diatrabajo){
            $conexion = conectar();

            try {
                $sql = "SELECT * FROM dia_trabajo WHERE id_diatrabajo = $id_diatrabajo";
                $query = $conexion->prepare($sql);
                $query->execute();
                return $query;
                
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }

        public function datos_cli($id_zona,$rif){
            $conexion = conectar();

            try {
                $sql = "SELECT * FROM cliente WHERE id_zona = $id_zona AND rif = '$rif'";
                $query = $conexion->prepare($sql);
                $query->execute();
                if($query->rowCount()>0){
                    return $query;
                }else{
                    return false;
                }    
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }

        public function lista_cargamento($id_diatrabajo){

            $conexion = conectar();

            try {
                $sql = "SELECT cargamento.*,inv_elemento.nombre,inv_elemento.precio FROM cargamento 
                        INNER JOIN inv_elemento ON inv_elemento.id_elemento = cargamento.id_elemento
                        WHERE cargamento.id_diatrabajo = $id_diatrabajo";
                $query = $conexion->prepare($sql);
                $query->execute();
                return $query;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }

        }

        // VERIFICAR SI EL SERIAL YA FUE REGISTRADO

        public function verificar_serial($fact_serial){
            $conexion = conectar();

            try {
                $sql="SELECT * FROM factura WHERE fact_serial = '$fact_serial'";
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

        // GET ID_FACTURA

        public function get_id_factura($fact_serial){

            $conexion = conectar();
            try {
                $sql="SELECT * FROM factura WHERE fact_serial = '$fact_serial'";
                $query=$conexion->prepare($sql);
                $query->execute();
                return $query;
                 
            } catch (PDOException $e) {
                die($e->getMessage());
                return true;
            }
        }



        // CONTAR PAGINAS HISTORIAL FACTURA

        public function contar_paginas($busqueda){
            $conexion = conectar();

            try {
                $sql = "SELECT factura.*,cliente.nom_fiscal,cliente.rif FROM factura 
                        INNER JOIN cliente ON cliente.id_cliente = factura.id_cliente
                        WHERE (LOWER(CAST(fecha AS VARCHAR)) LIKE LOWER('%$busqueda%')
                        OR LOWER(cliente.nom_fiscal) LIKE LOWER('%$busqueda%')
                        OR LOWER(factura.fact_serial) LIKE LOWER('%$busqueda%')
                        OR LOWER(cliente.rif) LIKE LOWER('%$busqueda%'))
                        ORDER BY id_factura DESC
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

        // BUSQUEDA HISTORIAL FACTURA
        
        public function historial_factura($busqueda,$pagina,$total_pag){

            $conexion = conectar();

            $empezar = ($pagina-1)*$total_pag;
          
            try {

                $sql = "SELECT factura.*,cliente.nom_fiscal,cliente.rif FROM factura 
                        INNER JOIN cliente ON cliente.id_cliente = factura.id_cliente
                        WHERE (LOWER(CAST(fecha AS VARCHAR)) LIKE LOWER('%$busqueda%')
                        OR LOWER(cliente.nom_fiscal) LIKE LOWER('%$busqueda%')
                        OR LOWER(factura.fact_serial) LIKE LOWER('%$busqueda%')
                        OR LOWER(cliente.rif) LIKE LOWER('%$busqueda%'))
                        ORDER BY id_factura DESC
                        LIMIT $total_pag OFFSET $empezar";
                
                $query= $conexion->prepare($sql);
                $query->execute();
                return $query;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }

        }


        // LLENAR DATOS VER MAS FACTURA

        public function buscardatos_cli($id_factura){

            $conexion = conectar();

            try {
                
                $sql = "SELECT factura.*,cliente.nom_fiscal,cliente.rif,cliente.telefono FROM factura
                        INNER JOIN cliente ON cliente.id_cliente = factura.id_cliente
                        WHERE factura.id_factura = $id_factura";
                $query = $conexion->prepare($sql);
                $query->execute();

                return $query;
                
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }

        }

        // BUSCAR DATOS COMPRAS

        public function buscardatos_compra($id_factura){

            $conexion = conectar();

            try {
                
                $sql = "SELECT compra.*,inv_elemento.nombre,inv_elemento.precio FROM compra
                        INNER JOIN inv_elemento ON inv_elemento.id_elemento = compra.id_elemento
                        WHERE compra.id_factura = $id_factura";
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
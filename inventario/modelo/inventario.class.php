<?php   

    require("../../recursos/db/conexiondb.php");

    class inventario{

        ////////////////CATEGORIA//////////////////////

        // INSERTAR CATEGORIA

        public function new_categoria($nombre){
            
            $conexion = conectar();

            try {
                $sql="INSERT INTO inv_categoria(nombre) VALUES ('$nombre');";
                $query = $conexion->prepare($sql);
                $query->execute();
                return true;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }

        // MODIFICAR CATEGORIA

        public function mod_categoria($id_categoria,$nombre){
            
            $conexion = conectar();

            try {
                $sql="UPDATE inv_categoria SET nombre = '$nombre' WHERE id_categoria = $id_categoria";
                $query = $conexion->prepare($sql);
                $query->execute();
                return true;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }


        // VALIDAR ELIMINAR CATEGORIA

        public function verif_elementos_activos($id_categoria){

            $conexion = conectar();

            try {
                $sql="SELECT * FROM inv_elemento WHERE id_categoria = '$id_categoria' AND eliminado = false";
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

        // ESTADO CATEGORIA

        public function estado_categoria($id_categoria,$tipo){
            
            $conexion = conectar();

            try {

                if($tipo=='eliminar'){
                    $sql="UPDATE inv_categoria SET eliminado = true WHERE id_categoria = $id_categoria";
                }elseif($tipo=='habilitar'){
                    $sql="UPDATE inv_categoria SET eliminado = false WHERE id_categoria = $id_categoria";
                }
                $query = $conexion->prepare($sql);
                $query->execute();
                return true;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }


        ////////////////ELEMENTOS//////////////////

        // INSERTAR ELEMENTO

        public function new_elemento($id_categoria,$nombre,$cantidad,$precio,$descripcion){
            
            $conexion = conectar();

            try {
                $sql="INSERT INTO inv_elemento(id_categoria,nombre,cantidad,precio,descripcion) 
                VALUES ($id_categoria,'$nombre',$cantidad,$precio,'$descripcion');";
                $query = $conexion->prepare($sql);
                $query->execute();
                return true;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }

        // MODIFICAR ELEMENTO

        public function mod_elemento($id_elemento,$nombre,$cantidad,$precio,$descripcion){
            
            $conexion = conectar();

            try {
                $sql="UPDATE inv_elemento SET nombre = '$nombre', 
                      cantidad = $cantidad, precio = $precio, 
                      descripcion = '$descripcion' WHERE id_elemento = $id_elemento";
                $query = $conexion->prepare($sql);
                $query->execute();
                return true;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }


        // ELIMINAR ELEMENTO

        public function estado_elemento($id_elemento,$tipo){
           
            $conexion = conectar();

            try {

                if($tipo=='eliminar'){
                    $sql="UPDATE inv_elemento SET eliminado = true WHERE id_elemento = $id_elemento";
                }elseif($tipo=='habilitar'){
                    $sql="UPDATE inv_elemento SET eliminado = false WHERE id_elemento = $id_elemento";
                }
                $query = $conexion->prepare($sql);
                $query->execute();
                return true;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }


        ///////////////////LISTAS///////////////////////

        // LISTA DE CATEGORIA
        
        public function lista_categoria($estado){
            
            $conexion = conectar();

            try {
                if($estado == 'habilitado'){
                    $sql = "SELECT * FROM inv_categoria WHERE eliminado = false ORDER BY id_categoria" ;
                }
                if($estado == 'deshabilitado'){
                    $sql = "SELECT * FROM inv_categoria WHERE eliminado = true ORDER BY id_categoria";
                }

                $query = $conexion->prepare($sql);
                $query->execute();
                return $query;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }

        }

        // LISTA DE ELEMENTOS

        public function lista_elemento($estado,$id_categoria){
            
            $conexion = conectar();

            try {
                if($estado == 'habilitado'){
                    $sql = "SELECT * FROM inv_elemento WHERE eliminado = false AND id_categoria = $id_categoria ORDER BY id_elemento";
                }
                if($estado == 'deshabilitado'){
                    $sql = "SELECT * FROM inv_elemento WHERE eliminado = true AND id_categoria = $id_categoria ORDER BY id_elemento";
                }

                $query = $conexion->prepare($sql);
                $query->execute();
                return $query;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }

        }

        // LISTA DE MOVIMIENTO

        public function contar_paginas($busqueda){
            $conexion = conectar();

            try {
                $sql = "SELECT * FROM movimiento
                        WHERE LOWER(nombre) LIKE LOWER('%$busqueda%') OR
                        LOWER(accion) LIKE LOWER('%$busqueda%') OR
                        LOWER(descripcion) LIKE LOWER('%$busqueda%')
                        ORDER BY id_movimiento DESC
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

        public function lista_movimiento($busqueda,$pagina,$total_pag){

            $conexion = conectar();

            $empezar = ($pagina-1)*$total_pag;

            try {
                $sql = "SELECT * FROM movimiento
                        WHERE LOWER(nombre) LIKE LOWER('%$busqueda%') OR
                        LOWER(accion) LIKE LOWER('%$busqueda%') OR
                        LOWER(descripcion) LIKE LOWER('%$busqueda%') OR
                        LOWER(CAST(fecha AS VARCHAR)) LIKE LOWER('%$busqueda%')
                        ORDER BY id_movimiento DESC
                        LIMIT $total_pag OFFSET $empezar";
                $query= $conexion->prepare($sql);
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
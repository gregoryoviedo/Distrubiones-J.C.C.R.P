<?php
    require("../../recursos/db/conexiondb.php");
    date_default_timezone_set('America/Caracas');

    class trabajo{

        // INSERTAR NUEVO TRABAJO

        public function new_trabajo($id_ruta,$id_zona,$escolta,$fecha){
            $conexion = conectar();

            try {
                $sql = "INSERT INTO dia_trabajo(id_ruta,id_zona,escolta,fecha) VALUES($id_ruta,$id_zona,$$$escolta$$,'$fecha')";
                $query = $conexion->prepare($sql);
                $query->execute();
                $query->closeCursor();
                return true;
                
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }

        // VERIFICAR QUE TODO ESTE ACTIVO EN LA RUTA

        public function verif_activos($id_ruta){
            $conexion = conectar();
            
            try {
                $sql = "SELECT emp1.eliminado AS emp1_eliminado,emp2.eliminado AS emp2_eliminado,vehiculos.eliminado AS veh_eliminado FROM ruta
                        INNER JOIN empleado AS emp1 ON emp1.id_empleado = ruta.id_vendedor1
                        INNER JOIN empleado AS emp2 ON emp2.id_empleado = ruta.id_vendedor2
                        INNER JOIN vehiculos ON vehiculos.id_vehiculo = ruta.id_vehiculo
                        WHERE ruta.id_ruta = $id_ruta";
                $query = $conexion->prepare($sql);
                $query->execute();
                foreach ($query as $row) {
                    $vend1 = $row['emp1_eliminado'];
                    $vend2 = $row['emp2_eliminado'];
                    $veh = $row['veh_eliminado'];
                }

                if($vend1 || $vend2 || $veh){
                    return true;
                }else{
                    return false;
                }

            } catch (PDOException $e) {
                die($e->getMessage());
                return true;
            }
        }

        // VERIFICAR QUE NO ESTE INSERTADA LA RUTA EL DIA DE HOY

        public function verif_rutatrabajo($id_ruta,$fecha){
            $conexion = conectar();

            try {
                $sql = "SELECT * FROM dia_trabajo WHERE fecha = '$fecha' AND id_ruta = $id_ruta";
                $query = $conexion->prepare($sql);
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

        // VERIFICAR QUE NO ESTE INSERTADA LA ZONA EL DIA DE HOY

        public function verif_zonatrabajo($id_zona,$fecha){
            $conexion = conectar();

            try {
                $sql = "SELECT * FROM dia_trabajo WHERE fecha = '$fecha' AND id_zona = $id_zona";
                $query = $conexion->prepare($sql);
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

        // LISTA DE RUTAS
        public function lista_rutas(){
            $conexion = conectar();

            try {
                $sql = "SELECT * FROM ruta WHERE eliminado = false ORDER BY id_ruta";
                $query = $conexion->prepare($sql);
                $query->execute();
                return $query;
                
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }

        // LISTA DE ZONAS

        public function lista_zonas(){
            $conexion = conectar();

            try {
                $sql = "SELECT * FROM zona ORDER BY id_zona";
                $query = $conexion->prepare($sql);
                $query->execute();
                return $query;
                
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }

        // LISTA DE CATEGORIA

        public function lista_categoria(){
            $conexion = conectar();

            try {
                $sql = "SELECT * FROM inv_categoria WHERE eliminado = false";
                $query = $conexion->prepare($sql);
                $query->execute();
                return $query;
                
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }

        // LISTA DE ELEMENTO

        public function lista_elemento($id_categoria){
            $conexion = conectar();

            try {
                $sql = "SELECT * FROM inv_elemento WHERE id_categoria = $id_categoria AND eliminado = false";
                $query = $conexion->prepare($sql);
                $query->execute();
                return $query;
                
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }


        // LISTA DE TRABAJO DE HOY

        public function lista_trabajo($fecha){
            $conexion = conectar();

            try {
                $sql = "SELECT dia_trabajo.*,zona.nombre FROM dia_trabajo 
                        INNER JOIN zona ON zona.id_zona = dia_trabajo.id_zona
                        WHERE dia_trabajo.fecha = '$fecha' 
                        ORDER BY dia_trabajo.id_diatrabajo";
                $query = $conexion->prepare($sql);
                $query->execute();
                return $query;
                
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }

        // LISTA DE CARGAMENTO

        public function lista_cargamento($id_diatrabajo){
            $conexion = conectar();

            try {
                $sql = "SELECT cargamento.*,inv_elemento.nombre FROM cargamento 
                        INNER JOIN inv_elemento ON inv_elemento.id_elemento = cargamento.id_elemento
                        WHERE id_diatrabajo = $id_diatrabajo ORDER BY id_cargamento";
                $query = $conexion->prepare($sql);
                $query->execute();
                return $query;
                
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }


        // VERIFICAR ELEMENTO DUPLICADO

        public function verif_elemento($id_elemento,$id_diatrabajo){
            $conexion = conectar();

            try {
                $sql = "SELECT * FROM cargamento WHERE id_elemento = $id_elemento AND id_diatrabajo = $id_diatrabajo";
                $query = $conexion->prepare($sql);
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


        // NUEVO CARGAMENTO

        public function new_cargo($id_diatrabajo,$id_elemento,$llevar){

            $conexion = conectar();

            try {
                $sql = "INSERT INTO cargamento(id_diatrabajo,id_elemento,cantidad_prod) 
                        VALUES ($id_diatrabajo,$id_elemento,$llevar)";
                $query = $conexion->prepare($sql);
                $query->execute();
                $query->closeCursor();
                return true;

            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }

        }

        // ACTUALIZAR INVENTARIO Y MOVIMIENTO
        
        public function new_act_inv($id_diatrabajo,$id_elemento,$llevar,$existencias){
            $conexion = conectar();

            $cant_old = $existencias;
            $cant_new = $existencias - $llevar;
            $descripcion = 'Asignado al dia trabajo: '.$id_diatrabajo;
            $fecha = date('Y-m-d');
            $hora = date('H:i:s').'.00';

            try {

                //Sacar datos del elemento
                $sql="SELECT nombre,precio FROM inv_elemento WHERE id_elemento = $id_elemento";
                $lista = $conexion->prepare($sql);
                $lista->execute();

                foreach ($lista as $row) {
                    $nombre = $row['nombre'];
                    $precio_old = $row['precio'];
                }
                $lista->closeCursor();

                //Actualizar elemento
                $sql="UPDATE inv_elemento SET cantidad = $cant_new WHERE id_elemento = $id_elemento";
                $query = $conexion->prepare($sql);
                $query->execute();
                $query->closeCursor();

                //Insertar en movimiento
                $sql="INSERT INTO movimiento(id_elemento,nombre,accion,precio_old,existencia_old,existencia_new,descripcion,fecha,hora)
                      VALUES ($id_elemento,'$nombre','Nuevo Cargamento',$precio_old,$cant_old,$cant_new,'$descripcion','$fecha','$hora')";
                $mov = $conexion->prepare($sql);
                $mov->execute();
                $mov->closeCursor();

                return true;

            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }

        // ELIMINAR CARGAMENTO

        public function del_cargo($id_cargamento){
            $conexion = conectar();

            try {
                $sql="DELETE FROM cargamento WHERE id_cargamento = $id_cargamento";
                $query=$conexion->prepare($sql);
                $query->execute();
                $query->closeCursor();
                return true;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }


        // ACTUALIZAR INVENTARIO Y MOVIMIENTO after delete
        
        public function del_act_inv($id_diatrabajo,$id_elemento,$cant_prod){
            $conexion = conectar();

            $descripcion = 'Eliminado de dia trabajo: '.$id_diatrabajo;
            $fecha = date('Y-m-d');
            $hora = date('H:i:s').'.00';

            try {

                //Sacar datos del elemento
                $sql="SELECT nombre,precio,cantidad FROM inv_elemento WHERE id_elemento = $id_elemento";
                $lista = $conexion->prepare($sql);
                $lista->execute();

                foreach ($lista as $row) {
                    $nombre = $row['nombre'];
                    $precio_old = $row['precio'];
                    $cant_old = $row['cantidad'];
                }
                $lista->closeCursor();

                $cant_new = $cant_prod+$cant_old;
                //Actualizar elemento
                $sql="UPDATE inv_elemento SET cantidad = $cant_new WHERE id_elemento = $id_elemento";
                $query = $conexion->prepare($sql);
                $query->execute();
                $query->closeCursor();

                //Insertar en movimiento
                $sql="INSERT INTO movimiento(id_elemento,nombre,accion,precio_old,existencia_old,existencia_new,descripcion,fecha,hora)
                      VALUES ($id_elemento,'$nombre','Eliminar Cargamento',$precio_old,$cant_old,$cant_new,'$descripcion','$fecha','$hora')";
                $mov = $conexion->prepare($sql);
                $mov->execute();
                $mov->closeCursor();

                return true;

            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }


        // ENVIAR RUTA

        public function enviar_ruta($id_diatrabajo){
            $conexion = conectar();

            try {
                $sql = "UPDATE dia_trabajo SET estado = 'enviado' WHERE id_diatrabajo = $id_diatrabajo";
                $query= $conexion->prepare($sql);
                $query->execute();
                $query->closeCursor();
                return true;

            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }

        }

        // VALIDAR CARGAMENTO VACIO

        public function cargo_vacio($id_diatrabajo){
            $conexion = conectar();

            try {
                $sql = "SELECT * FROM cargamento WHERE id_diatrabajo = $id_diatrabajo";
                $query = $conexion->prepare($sql);
                $query->execute();
                if($query->fetchColumn()>0){
                    return false;
                }else{
                    return true;
                }          
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }


        // HISTORIAL TRABAJO

        public function historial(){
            $conexion = conectar();

            try {
                $sql = "SELECT * FROM dia_trabajo WHERE estado = 'enviado' ORDER BY id_diatrabajo DESC";
                $query = $conexion->prepare($sql);
                $query->execute();
                return $query;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }

        // LISTA DE ENVIADOS

        public function lista_enviados(){
            $conexion = conectar();
            $hoy = date('Y-m-d');
            try {
                $sql = "SELECT dia_trabajo.*,ruta.id_vendedor1,ruta.id_vendedor2,zona.nombre FROM dia_trabajo 
                        INNER JOIN ruta ON ruta.id_ruta = dia_trabajo.id_ruta
                        INNER JOIN zona ON zona.id_zona = dia_trabajo.id_zona
                        WHERE dia_trabajo.fecha = '$hoy' AND (dia_trabajo.estado = 'enviado' OR dia_trabajo.estado = 'finalizado')
                        ORDER BY dia_trabajo.id_diatrabajo";
                $query = $conexion->prepare($sql);
                $query->execute();
                return $query;
                
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }

        // RELLENAR FINALIZAR

        public function rellenar_finalizar($id_diatrabajo){
            $conexion = conectar();

            try {
                $sql = "SELECT dia_trabajo.*,zona.nombre FROM dia_trabajo 
                        INNER JOIN zona ON zona.id_zona = dia_trabajo.id_zona
                        WHERE dia_trabajo.id_diatrabajo = $id_diatrabajo";
                $query = $conexion->prepare($sql);
                $query->execute();
                return $query;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }

        // LISTA DE FACTURAS DEL DIA

        public function lista_facturas($id_diatrabajo){
            $conexion = conectar();

            try {
                $sql = "SELECT factura.*,cliente.nom_fiscal,cliente.rif FROM factura
                        INNER JOIN cliente ON cliente.id_cliente = factura.id_cliente
                        WHERE id_diatrabajo = $id_diatrabajo";
                $query = $conexion->prepare($sql);
                $query->execute();
                return $query;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }


        // VALIDAR QUE TENGA FACTURAS EL DIA

        public function validar_facturas($id_diatrabajo){

            $conexion = conectar();

            try {
                $sql = "SELECT * FROM factura WHERE id_diatrabajo = $id_diatrabajo";
                $query = $conexion->prepare($sql);
                $query->execute();
                if($query->rowCount()<1){
                    return true;
                }else{
                    return false;
                }
            } catch (PDOException $e) {
                die($e->getMessage());
                return true;
            }

        }

        // DEVOLVER EL CARGAMENTO A INVENTARIO

        public function devolver_cargo($id_diatrabajo){

            $conexion = conectar();

            try {
                $sql = "SELECT * FROM cargamento WHERE id_diatrabajo = $id_diatrabajo";
                $query = $conexion->prepare($sql);
                $query->execute();

                foreach ($query as $row) {
                    $cantidad_prod = $row['cantidad_prod'];
                    $id_elemento = $row['id_elemento'];
                    $band = self::act_inventario($id_elemento,$cantidad_prod);
                }

                if($band){
                    return true;
                }else{
                    return false;
                }

            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }

        }

        // ACTUALIZAR EN INVENTARIO

        public function act_inventario($id_elemento,$cantidad_prod){
            $conexion = conectar();

            try {
                $sql = "UPDATE inv_elemento SET cantidad = cantidad + $cantidad_prod WHERE id_elemento = $id_elemento";
                $query = $conexion->prepare($sql);
                $query->execute();
                $query->closeCursor();
                return true;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }

        // ACTUALIZAR ESTADO DIA TRABAJO

        public function estado_diatrabajo($id_diatrabajo){

            $conexion = conectar();

            try {
                $sql = "UPDATE dia_trabajo SET estado = 'finalizado' WHERE id_diatrabajo = $id_diatrabajo";
                $query = $conexion->prepare($sql);
                $query->execute();
                $query->closeCursor();
                return true;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }


        // LISTA DE HISTORIAL TRABAJO

        public function contar_paginas($busqueda){
            $conexion = conectar();

            $busc_ruta = explode(':',strtolower($busqueda));
            if(count($busc_ruta)>1 && $busc_ruta[0]=='ruta'){
                $id_ruta = $busc_ruta[1];
                $sql = "SELECT dia_trabajo.*,zona.nombre AS nom_zona FROM dia_trabajo 
                        INNER JOIN zona ON zona.id_zona = dia_trabajo.id_zona
                        WHERE dia_trabajo.id_ruta = $id_ruta
                        AND dia_trabajo.estado = 'finalizado'
                        ORDER BY id_diatrabajo DESC
                        ";
            }else{
                $sql = "SELECT dia_trabajo.*,zona.nombre AS nom_zona FROM dia_trabajo 
                        INNER JOIN zona ON zona.id_zona = dia_trabajo.id_zona
                        WHERE (LOWER(CAST(fecha AS VARCHAR)) LIKE LOWER('%$busqueda%')
                        OR LOWER(zona.nombre) LIKE LOWER('%$busqueda%'))
                        AND dia_trabajo.estado = 'finalizado'
                        ORDER BY id_diatrabajo DESC
                        ";
            }

            try {
                
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

        public function historial_trabajo($busqueda,$pagina,$total_pag){

            $conexion = conectar();

            $empezar = ($pagina-1)*$total_pag;
            
            $busc_ruta = explode(':',strtolower($busqueda));
            if(count($busc_ruta)>1 && $busc_ruta[0]=='ruta'){
                $id_ruta = $busc_ruta[1];
                $sql = "SELECT dia_trabajo.*,zona.nombre AS nom_zona FROM dia_trabajo 
                        INNER JOIN zona ON zona.id_zona = dia_trabajo.id_zona
                        WHERE dia_trabajo.id_ruta = $id_ruta
                        AND dia_trabajo.estado = 'finalizado'
                        ORDER BY id_diatrabajo DESC
                        LIMIT $total_pag OFFSET $empezar";
            }else{
                $sql = "SELECT dia_trabajo.*,zona.nombre AS nom_zona FROM dia_trabajo 
                        INNER JOIN zona ON zona.id_zona = dia_trabajo.id_zona
                        WHERE (LOWER(CAST(fecha AS VARCHAR)) LIKE LOWER('%$busqueda%')
                        OR LOWER(zona.nombre) LIKE LOWER('%$busqueda%'))
                        AND dia_trabajo.estado = 'finalizado'
                        ORDER BY id_diatrabajo DESC
                        LIMIT $total_pag OFFSET $empezar";
            }

            try {
                
                $query= $conexion->prepare($sql);
                $query->execute();
                return $query;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }

        }

        // HISTORIAL DE CARGAMENTO

        public function historial_cargamento($id_diatrabajo){
            $conexion = conectar();

            try {
                $sql = "SELECT cargo_historico.*,inv_elemento.nombre FROM cargo_historico 
                        INNER JOIN inv_elemento ON inv_elemento.id_elemento = cargo_historico.id_elemento
                        WHERE id_diatrabajo = $id_diatrabajo ORDER BY id_cargo";
                $query = $conexion->prepare($sql);
                $query->execute();
                return $query;
                
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }


        // VERIFICAR QUE PERTENECE A LA RUTA

        public function verif_pertenece($id_diatrabajo,$id_empleado){

            $conexion = conectar();

            try {
                $sql = "SELECT * FROM dia_trabajo INNER JOIN ruta ON ruta.id_ruta = dia_trabajo.id_ruta
                        WHERE (id_vendedor1 = $id_empleado OR id_vendedor2 = $id_empleado) 
                        AND id_diatrabajo = $id_diatrabajo";
                $query = $conexion->prepare($sql);
                $query->execute();
                if($query->rowCount()>0){
                    return true;
                }else{
                    return false;
                }

            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }

        }

        // FIN DE CLASE
    }

?>
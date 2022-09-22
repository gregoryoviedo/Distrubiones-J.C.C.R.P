<?php

    require('../recursos/db/conexiondb.php');

    class reporte{

        // REPORTE LISTA EMPLEADOS

        public function lista_empleados(){
            $conexion = conectar();

            try {
                $sql = "SELECT * FROM empleado WHERE eliminado = false ORDER BY id_empleado";
                $query = $conexion->prepare($sql);
                $query->execute();
                return $query;

            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }

        public function lista_clientes($busqueda){
            $conexion = conectar();

            try {
                $sql = "SELECT cliente.*,zona.nombre AS nom_zona FROM cliente 
                        INNER JOIN zona ON zona.id_zona = cliente.id_zona
                        WHERE (LOWER(nom_fiscal) LIKE LOWER('%$busqueda%') OR
                        LOWER(rif) LIKE LOWER('%$busqueda%') OR
                        LOWER(telefono) LIKE LOWER('%$busqueda%') OR
                        LOWER(zona.nombre) LIKE LOWER('%$busqueda%'))
                        AND cliente.eliminado = 'false'
                        ORDER BY id_cliente DESC";
                $query = $conexion->prepare($sql);
                $query->execute();
                return $query;

            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }

        public function lista_auditoria($busqueda){
            $conexion = conectar();

            try {
                $sql = "SELECT auditor.*,empleado.nombre,empleado.apellido FROM auditor 
                        INNER JOIN empleado ON empleado.id_empleado = auditor.empleado
                        WHERE (LOWER(CAST(fecha AS VARCHAR)) LIKE LOWER('%$busqueda%')
                        OR LOWER(empleado.nombre) LIKE LOWER('%$busqueda%')
                        OR LOWER(empleado.apellido) LIKE LOWER('%$busqueda%')
                        OR LOWER(auditor.user_sis) LIKE LOWER('%$busqueda%')
                        OR LOWER(auditor.accion) LIKE LOWER('%$busqueda%')
                        OR LOWER(auditor.modulo) LIKE LOWER('%$busqueda%'))
                        ORDER BY id_auditoria DESC";
                $query = $conexion->prepare($sql);
                $query->execute();
                return $query;

            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }


        public function lista_movimiento($busqueda){

            $conexion = conectar();

            try {
                $sql = "SELECT * FROM movimiento
                        WHERE LOWER(nombre) LIKE LOWER('%$busqueda%') OR
                        LOWER(accion) LIKE LOWER('%$busqueda%') OR
                        LOWER(descripcion) LIKE LOWER('%$busqueda%') OR
                        LOWER(CAST(fecha AS VARCHAR)) LIKE LOWER('%$busqueda%')
                        ORDER BY id_movimiento DESC";
                $query = $conexion->prepare($sql);
                $query->execute();
                return $query;

            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }

        }

        public function lista_categoria(){

            $conexion = conectar();

            try {
                $sql="SELECT * FROM inv_categoria WHERE eliminado = false ORDER BY id_categoria";
                $query = $conexion->prepare($sql);
                $query->execute();
                return $query;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
            
        }

        public function lista_elemento($id_categoria){
            $conexion = conectar();

            try {
                $sql="SELECT * FROM inv_elemento WHERE eliminado = false AND id_categoria = $id_categoria ORDER BY id_elemento";
                $query = $conexion->prepare($sql);
                $query->execute();
                return $query;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }

        public function datos_diatrabajo($id_diatrabajo){
            $conexion = conectar();

            try {
                $sql="SELECT dia_trabajo.*,
                        emp1.nombre AS emp1_nom,emp1.apellido AS emp1_ape,emp1.cedula AS emp1_ced,
                        emp2.nombre AS emp2_nom,emp2.apellido AS emp2_ape,emp2.cedula AS emp2_ced,vehiculos.* FROM dia_trabajo
                        INNER JOIN ruta ON ruta.id_ruta = dia_trabajo.id_ruta
                        INNER JOIN empleado AS emp1 ON emp1.id_empleado = ruta.id_vendedor1
                        INNER JOIN empleado AS emp2 ON emp2.id_empleado = ruta.id_vendedor2
                        INNER JOIN vehiculos ON vehiculos.id_vehiculo = ruta.id_vehiculo
                        WHERE dia_trabajo.id_diatrabajo = $id_diatrabajo";
                $query = $conexion->prepare($sql);
                $query->execute();
                return $query;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }

        public function lista_cargamento($id_diatrabajo){
            $conexion = conectar();

            try {
                $sql="SELECT cargo_historico.*,inv_elemento.nombre FROM cargo_historico
                      INNER JOIN inv_elemento ON inv_elemento.id_elemento = cargo_historico.id_elemento
                      WHERE cargo_historico.id_diatrabajo = $id_diatrabajo";
                $query = $conexion->prepare($sql);
                $query->execute();
                return $query;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }


        public function historial_trabajo(){

            $conexion = conectar();

            try {
                $sql="SELECT dia_trabajo.*,zona.nombre AS nom_zona FROM dia_trabajo 
                        INNER JOIN zona ON zona.id_zona = dia_trabajo.id_zona
                        WHERE dia_trabajo.estado = 'finalizado'
                        ORDER BY id_diatrabajo DESC";
                $query = $conexion->prepare($sql);
                $query->execute();
                return $query;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }


        public function lista_vehiculos(){
            $conexion = conectar();

            try {
                $sql="SELECT * FROM vehiculos WHERE eliminado = false ORDER BY id_vehiculo";
                $query = $conexion->prepare($sql);
                $query->execute();
                return $query;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }


        public function lista_facturas($busqueda){
            $conexion = conectar();

            try {
                $sql="SELECT factura.*,cliente.nom_fiscal,cliente.rif FROM factura 
                INNER JOIN cliente ON cliente.id_cliente = factura.id_cliente
                WHERE (LOWER(CAST(fecha AS VARCHAR)) LIKE LOWER('%$busqueda%')
                OR LOWER(cliente.nom_fiscal) LIKE LOWER('%$busqueda%')
                OR LOWER(factura.fact_serial) LIKE LOWER('%$busqueda%')
                OR LOWER(cliente.rif) LIKE LOWER('%$busqueda%'))
                ORDER BY id_factura DESC";
                $query = $conexion->prepare($sql);
                $query->execute();
                return $query;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }

        public function datos_cliente($id_factura){

            $conexion = conectar();

            try {
                $sql="SELECT factura.*,cliente.* FROM factura INNER JOIN cliente ON cliente.id_cliente = factura.id_cliente
                        WHERE factura.id_factura = $id_factura";
                $query = $conexion->prepare($sql);
                $query->execute();
                return $query;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }


        }

        public function carrito($id_factura){
            $conexion = conectar();

            try {
                $sql="SELECT compra.*,inv_elemento.precio,inv_elemento.nombre FROM compra INNER JOIN inv_elemento ON inv_elemento.id_elemento = compra.id_elemento WHERE id_factura = $id_factura";
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
<?php
    require_once("../../recursos/db/conexiondb.php");
    date_default_timezone_set('America/Caracas');
    class auditor{

        // MARCAR ACCION

        public function auditar($id_empleado,$user_sis,$accion,$modulo,$descripcion){
            $conexion = conectar();
            
            $fecha = date('Y-m-d');
            $hora = date('H:i:s').'.00';

            try {
                $sql = "INSERT INTO auditor(empleado,user_sis,accion,modulo,descripcion,fecha,hora)
                        VALUES ($id_empleado,$$$user_sis$$,'$accion','$modulo',$$$descripcion$$,'$fecha','$hora')";
                $query = $conexion->prepare($sql);
                $query->execute();
                $query->closeCursor();
                return true;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }

        // LISTA AUDITORIA

        // CONTAR PAGINAS

        public function contar_paginas($busqueda){
            $conexion = conectar();

            try {
                $sql = "SELECT auditor.*,empleado.nombre,empleado.apellido,empleado.cedula,galeria.urlfoto FROM auditor 
                        INNER JOIN empleado ON empleado.id_empleado = auditor.empleado
                        INNER JOIN galeria ON galeria.id_galeria = empleado.id_galeria
                        WHERE (LOWER(CAST(fecha AS VARCHAR)) LIKE LOWER('%$busqueda%')
                        OR LOWER(empleado.nombre) LIKE LOWER('%$busqueda%')
                        OR LOWER(empleado.apellido) LIKE LOWER('%$busqueda%')
                        OR LOWER(empleado.cedula) LIKE LOWER('%$busqueda%')
                        OR LOWER(auditor.user_sis) LIKE LOWER('%$busqueda%')
                        OR LOWER(auditor.accion) LIKE LOWER('%$busqueda%')
                        OR LOWER(auditor.modulo) LIKE LOWER('%$busqueda%'))
                        ORDER BY id_auditoria DESC
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
        
        public function lista_auditor($busqueda,$pagina,$total_pag){

            $conexion = conectar();

            $empezar = ($pagina-1)*$total_pag;
          
            try {

                $sql = "SELECT auditor.*,empleado.nombre,empleado.apellido,galeria.urlfoto FROM auditor 
                        INNER JOIN empleado ON empleado.id_empleado = auditor.empleado
                        INNER JOIN galeria ON galeria.id_galeria = empleado.id_galeria
                        WHERE (LOWER(CAST(fecha AS VARCHAR)) LIKE LOWER('%$busqueda%')
                        OR LOWER(empleado.nombre) LIKE LOWER('%$busqueda%')
                        OR LOWER(empleado.apellido) LIKE LOWER('%$busqueda%')
                        OR LOWER(auditor.user_sis) LIKE LOWER('%$busqueda%')
                        OR LOWER(auditor.accion) LIKE LOWER('%$busqueda%')
                        OR LOWER(auditor.modulo) LIKE LOWER('%$busqueda%'))
                        ORDER BY id_auditoria DESC
                        LIMIT $total_pag OFFSET $empezar";
                
                $query= $conexion->prepare($sql);
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
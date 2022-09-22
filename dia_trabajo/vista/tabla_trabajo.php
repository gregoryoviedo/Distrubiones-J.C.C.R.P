<?php

require("../modelo/trabajo.class.php");

$obj = new trabajo;
date_default_timezone_set('America/Caracas');
$query = $obj->lista_trabajo(date("Y-m-d"));

$tabla = '';

$tabla .= '<table class="table">';
    $tabla.= '<thead>';
        $tabla.='<tr>';
            $tabla.='<th>Ruta</th>';
            $tabla.='<th>Zona</th>';
            $tabla.='<th>Escolta</th>';
            $tabla.='<th>Ver Cargamento</th>';
            $tabla.='<th>Accion</th>';
        $tabla.='</tr>';
    $tabla.= '</thead>';

    $tabla.= '<tbody>';
            $band = 0;
            foreach ($query as $row) {
                $band+=1;
                $tabla.='<tr>';
                    $tabla.='<td>';
                        $tabla.='Ruta: '.$row['id_ruta'];
                    $tabla.='</td>';
                    $tabla.='<td>';
                        $tabla.=$row['nombre'];
                    $tabla.='</td>';
                    $tabla.='<td>';
                        $tabla.=$row['escolta'];
                    $tabla.='</td>';
                    $tabla.='<td>';
                        if($row['estado'] == 'espera'){
                            $tabla.='<button class="btn btn-info" id="btncargamento" data-toggle="modal" data-target="#modal_cargamento" onclick="cargar_tablacargo('.$row['id_diatrabajo'].');">Asignar Cargamento</button>';
                        }else{
                            $tabla.='<button class="btn btn-dark" id="btnasignado" disabled>Ruta Enviada</button>';
                        }
                    $tabla.='</td>';
                    $tabla.='<td>';
                        if($row['estado'] == 'espera'){
                            $tabla.='<button class="btn btn-success" id="btnenviar" onclick="enviar_ruta('.$row['id_diatrabajo'].')">Enviar Ruta</button>';
                        }else{
                            $tabla.='<a href="../../reportes/trabajo_pdf.php?id_diatrabajo='.$row['id_diatrabajo'].'" class="btn btn-warning" id="btnpdf">Imprimir PDF</a>';
                        }
                    $tabla.='</td>';
                $tabla.='</tr>';
            }

            $query->closeCursor();
            if($band==0){
                                       
                $tabla.='<tr>';
                    $tabla.='<td colspan=4 class="text-center">';
                        $tabla.='No se han asignado rutas hoy';
                    $tabla.='</td>';
                $tabla.='</tr>';
                
            }
    $tabla.= '</tbody>';

$tabla.= '</table>';

echo $tabla;
?>

                            
                                
                                
                                    
                                    
                                
                           
                        
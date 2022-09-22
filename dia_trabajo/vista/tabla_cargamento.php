<?php

require("../modelo/trabajo.class.php");

$obj = new trabajo;

$id_diatrabajo = $_POST['id_diatrabajo'];

$query = $obj->lista_cargamento($id_diatrabajo);

$tabla = '';

$tabla .= '<table class="table">';
    $tabla.= '<thead>';
        $tabla.='<tr>';
            $tabla.='<th>Nombre Articulo</th>';
            $tabla.='<th>Cantidad a llevar</th>';
            $tabla.='<th>Eliminar</th>';
        $tabla.='</tr>';
    $tabla.= '</thead>';

    $tabla.= '<tbody>';
            $band = 0;
            foreach ($query as $row) {
                $band+=1;
                $tabla.='<tr>';
                    $tabla.='<td>';
                        $tabla.=$row['nombre'];
                    $tabla.='</td>';
                    $tabla.='<td>';
                        $tabla.=$row['cantidad_prod'];
                    $tabla.='</td>';
                    $tabla.='<td>';
                        $tabla.='<button class="btn btn-danger" id="btnelicargo" onclick="del_cargo('.$row['id_elemento'].','.$row['id_cargamento'].','.$row['cantidad_prod'].')">Eliminar</button>';
                    $tabla.='</td>';
                   
                $tabla.='</tr>';
            }

            $query->closeCursor();
            if($band==0){
                                       
                $tabla.='<tr>';
                    $tabla.='<td colspan=3 class="text-center">';
                        $tabla.='No se ha asignado cargamento';
                    $tabla.='</td>';
                $tabla.='</tr>';
                
            }
    $tabla.= '</tbody>';

$tabla.= '</table>';

echo $tabla;
?>

                            
                                
                                
                                    
                                    
                                
                           
                        
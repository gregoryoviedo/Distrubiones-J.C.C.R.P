<?php
    require('../modelo/trabajo.class.php');

    $obj = new trabajo;

    $id_diatrabajo = $_POST['id_diatrabajo'];

    $query = $obj->historial_cargamento($id_diatrabajo);

    $tabla = '';

    $tabla.='<table class="table">';
        $tabla.='<thead>';
            $tabla.='<tr>';
                $tabla.='<th>Elemento</th>';
                $tabla.='<th>Cantidad</th>';
            $tabla.='</tr>';
        $tabla.='</thead>';
        $tabla.='<tbody>';
            foreach ($query as $row) {
                $tabla.='<tr>';
                    $tabla.='<td>'.$row['nombre'].'</td>';
                    $tabla.='<td>'.$row['cantidad_prod'].'</td>';
                $tabla.='</tr>';
            }
        $tabla.='</tbody>';
    $tabla.='</table>';

    echo $tabla;

?>
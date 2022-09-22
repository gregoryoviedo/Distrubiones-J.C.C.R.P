<?php

    require("../modelo/trabajo.class.php");

    $obj = new trabajo;

    $id_categoria = $_POST['id_categoria'];

    $query = $obj->lista_elemento($id_categoria);

    $respuesta = '';

    $respuesta .= '<select class="form-control" id="id_ele" name="id_ele">';
        $respuesta .= '<option value="" hidden>Selecciona un elemento</option>';
        foreach ($query as $row) {
            $respuesta.='<option value="'.$row['id_elemento'].'||'.$row['cantidad'].'">';
                $respuesta.= $row['nombre'];
            $respuesta .= '</option>';
        }
    $respuesta .= '</select>';

    
    echo $respuesta;
?>

<script src="../../recursos/js/trabajo.js"></script>
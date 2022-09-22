<?php

    require('../modelo/cliente.class.php');

    $obj2 = new cliente;


    $tabla = '<div style="overflow-x: auto;">
                <table class="table table-bordered">
                    <thead class="bg-dark text-white">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Modificar</th>
                    </tr>
                    </thead>
                    <tbody>';


    $query=$obj2->lista_zonas();
    $band = 0;
    foreach ($query as $row) {
    $band+=1;
    
    

    $tabla.='<tr>';
        $tabla.='<th scope="row">'.$row['id_zona'].'</th>';   
        $tabla.='<td scope="row">'.$row['nombre'].'</td>';
        $tabla.='<td> <button class="btn btn-warning" data-toggle="modal" data-target="#modal_mod_zona" onclick="cargardatos_zona('.$row['id_zona'].','."'".$row['nombre']."'".')"> Modificar </td>';
    $tabla.='</tr>';

                                    
    }

    if($band==0){
        $tabla.='<tr>
                    <td colspan=3>
                    No hay elementos para mostrar
                    </td>
                </tr>';
    }

    $tabla.='   </tbody>
            </table>
        </div>';

    echo $tabla;
?>

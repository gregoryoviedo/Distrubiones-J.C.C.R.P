<?php

    require("../modelo/ruta.class.php");

    $obj = new ruta;


    $id_empleado=$_POST['id_empleado'];

    $query = $obj->llenarficha($id_empleado);

    foreach ($query as $row) {
        $nombre = $row['nombre'];
        $apellido = $row['apellido'];
        $cedula = $row['cedula'];
        $urlfoto = $row['urlfoto'];
    }

    $query->closeCursor();

    $ficha='';

    
    $ficha.='<div class="form-group mt-4">';
        $ficha.='<div class="row">';
            $ficha.='<div class="col-4 text-center">';
                //foto
                $ficha.='<img src="../../recursos/img/fotos_perfil/'.$urlfoto.'" alt="foto_vendedor" width=150px height=200px>';
            $ficha.='</div>';
            $ficha.='<div class="col-8">';
                $ficha.='<div class="row">';
                    $ficha.='<div class="col-12">';
                    //nombre
                        $ficha.='<label for="">Nombre</label>';
                        $ficha.='<input type="text" class="form-control" value="'.$nombre.'" disabled>';
                    $ficha.='</div>';
                    $ficha.='<div class="col-12">';
                    //apellido
                        $ficha.='<label for="">Apellido</label>';
                        $ficha.='<input type="text" class="form-control" value="'.$apellido.'" disabled>';
                    $ficha.='</div>';
                    $ficha.='<div class="col-12">';
                    //cedula
                        $ficha.='<label for="">Cedula</label>';
                        $ficha.='<input type="text" class="form-control" value="'.$cedula.'" disabled>';
                    $ficha.='</div>';
                $ficha.='</div>';
            $ficha.='</div>';
        $ficha.='</div>';
    $ficha.='</div>';

    echo $ficha;
?>


    

                
                    

            
      
        
            
                

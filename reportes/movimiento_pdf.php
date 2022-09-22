<?php 
	require_once '../recursos/libs/dompdf/lib/html5lib/Parser.php';
	require_once '../recursos/libs/dompdf/src/Autoloader.php';
	date_default_timezone_set('America/Caracas');
	Dompdf\Autoloader::register();
	// reference the Dompdf namespace
	use Dompdf\Dompdf;
	
	require('reporte.class.php');
    $obj = new reporte;

    $busqueda = $_GET['busqueda'];

    $query =$obj->lista_movimiento($busqueda);


	$tabla = '';
	

    $tabla .= '

    <style>
    table {
        border-collapse: collapse;
      }
      
      .table {
        width: 100%;
        margin-bottom: 1rem;
        color: #212529;
      }
      
      .table th,
      .table td {
        padding: 0.75rem;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
      }
      
      .table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #dee2e6;
      }
      
      .table tbody + tbody {
        border-top: 2px solid #dee2e6;
      }
    </style>

    
    <div class="">
        <img src="../recursos/img/logo.jpg" width=100px height=100px>
        
            
            <p>Fecha de Impresion:'.date("Y-m-d").'</p>
            <p>Valor de busqueda:'.$busqueda.'</p>
            <br>
            <h3 class="">Movimiento inventario</h3>
    </div>

    <br><br><br><br><br><br><br><br><br>
    
    <table class="table">
        <thead class="">
            <tr>
                <th rowspan="2"># <br><br></th>
                <th rowspan="2">Tabla<br><br></th>
                <th rowspan="2">Nombre<br><br></th>
                <th rowspan="2">Accion<br><br></th>
                <th colspan="2">Precio</th>
                <th colspan="2">Cantidad</th>
                <th rowspan="2">Descripcion<br><br></th>
                <th rowspan="2">Fecha y Hora<br><br></th>
            </tr>
            <tr>
                <th>pas.</th>
                <th>nue.</th>
                <th>pas.</th>
                <th>nue.</th>
            </tr>
        </thead>
    <tbody>';

       
    foreach ($query as $row) {
        $tabla.='<tr>';
            $tabla.='<td>';
                $tabla.= $row['id_movimiento'];;
            $tabla.='</td>';

            $tabla.='<td>';
            if(empty($row['id_categoria'])){
                $tabla.= 'Elemento: '.$row['id_elemento'];
            }
            if(empty($row['id_elemento'])){
                $tabla.= 'Categoria: '.$row['id_categoria'];
            }
            $tabla.='</td>';

            $tabla.='<td>';
                $tabla.= $row['nombre'];;
            $tabla.='</td>';
            $tabla.='<td>';
                $tabla.= $row['accion'];
            $tabla.='</td>';
            $tabla.='<td>';
                $tabla.= $row['precio_old'];
            $tabla.='</td>';
            $tabla.='<td>';
                $tabla.= $row['precio_new'];
            $tabla.='</td>';
            $tabla.='<td>';
                $tabla.= $row['existencia_old'];
            $tabla.='</td>';
            $tabla.='<td>';
                $tabla.= $row['existencia_new'];
            $tabla.='</td>';
            $tabla.='<td>';
                $tabla.= $row['descripcion'];
            $tabla.='</td>';

            $hora = explode('.',$row['hora']);

            $tabla.='<td>';
                $tabla.= $row['fecha'].' / '.$hora[0];;
            $tabla.='</td>';

        $tabla.='</tr>';
    }

 
	  
$tabla.='   </tbody>
            </table>
            ';	
	
 
	// instantiate and use the dompdf class
	$dompdf = new Dompdf();

	$dompdf->loadHtml($tabla);

    

	// (Optional) Setup the paper size and orientation
	$dompdf->setPaper('A4','landscape');

	// Render the HTML as PDF
	$dompdf->render();

	// Output the generated PDF to Browser
	$dompdf->stream("JCCRP_Movimiento_Inventario_".date("Y-m-d"));

    $datos = array();
    $datos['exito']=true;
    echo json_encode($datos);
?>


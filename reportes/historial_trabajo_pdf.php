<?php 
	require_once '../recursos/libs/dompdf/lib/html5lib/Parser.php';
	require_once '../recursos/libs/dompdf/src/Autoloader.php';
	date_default_timezone_set('America/Caracas');
	Dompdf\Autoloader::register();
	// reference the Dompdf namespace
	use Dompdf\Dompdf;
	
	require('reporte.class.php');
    $obj = new reporte;

    $query =$obj->historial_trabajo();


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
            <br>
            <h3 class="">Historial de Trabajo</h3>
    </div>

    <br><br><br><br><br><br><br><br><br>
    
    <table class="table">
        <thead class="">
            <tr>
            <th>Fecha</th>
            <th>Ruta</th>
            <th>Zona</th>
            <th>Escolta</th>
            </tr>
        </thead>
    <tbody>';

    
    foreach ($query as $row) {
        $tabla.='<tr>';
            $tabla.='<td>';
                $tabla.= $row['fecha'];
            $tabla.='</td>';
            $tabla.='<td>';
                $tabla.= 'Ruta: '.$row['id_ruta'];
            $tabla.='</td>';
            $tabla.='<td>';
                $tabla.= $row['nom_zona'];
            $tabla.='</td>';
            $tabla.='<td>';
                $tabla.= $row['escolta'];
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
	$dompdf->setPaper('A4');

	// Render the HTML as PDF
	$dompdf->render();

	// Output the generated PDF to Browser
	$dompdf->stream("JCCRP_Historial_trabajo_".date("Y-m-d"));

    $datos = array();
    $datos['exito']=true;
    echo json_encode($datos);
?>


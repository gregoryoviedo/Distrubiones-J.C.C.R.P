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

    $query =$obj->lista_auditoria($busqueda);


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
            <h3 class="">Auditoria</h3>
    </div>

    <br><br><br><br><br><br><br><br><br>
    
    <table class="table">
        <thead class="">
            <tr>
            <th>#</th>
            <th>Nombre y Apellido</th>
            <th>Usuario</th>
            <th>Accion</th>
            <th>Modulo</th>
            <th>Descripcion</th>
            <th>Fecha</th>
            <th>Hora</th>
            </tr>
        </thead>
    <tbody>';

    
    foreach ($query as $row) {
        $tabla.='<tr>';
            $tabla.='<td>';
                $tabla.= $row['id_auditoria'];
            $tabla.='</td>';
            $tabla.='<td>';
                $tabla.= $row['nombre'].' '.$row['apellido'];
            $tabla.='</td>';
            $tabla.='<td>';
                $tabla.= $row['user_sis'];
            $tabla.='</td>';
            $tabla.='<td>';
                $tabla.= $row['accion'];
            $tabla.='</td>';
            $tabla.='<td>';
                $tabla.= $row['modulo'];
            $tabla.='</td>';
            $tabla.='<td>';
                $tabla.= $row['descripcion'];
            $tabla.='</td>';
            $tabla.='<td>';
                $tabla.= $row['fecha'];
            $tabla.='</td>';
            $tabla.='<td>';
                $tabla.= $row['hora'];
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
	$dompdf->stream("JCCRP_Auditoria_".date("Y-m-d"));

    $datos = array();
    $datos['exito']=true;
    echo json_encode($datos);
?>


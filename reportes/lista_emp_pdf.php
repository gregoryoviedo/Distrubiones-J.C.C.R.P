<?php 
	require_once '../recursos/libs/dompdf/lib/html5lib/Parser.php';
	require_once '../recursos/libs/dompdf/src/Autoloader.php';
	date_default_timezone_set('America/Caracas');
	Dompdf\Autoloader::register();
	// reference the Dompdf namespace
	use Dompdf\Dompdf;
	
	require('reporte.class.php');
    $obj = new reporte;

    $query =$obj->lista_empleados();


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
        
            <h3 class="display-4 my-2 py-2">Lista de Personal</h3>
            <label>Fecha de Impresion:'.date("Y-m-d").'</label>
    </div>

    <br><br><br><br><br><br><br><br><br>
    <table class="table">
        <thead class="">
            <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre y Apellido</th>
            <th scope="col">Cedula</th>
            <th scope="col">Telefono</th>
            <th scope="col">Email</th>
            <th scope="col">Cargo</th>
            </tr>
        </thead>
    <tbody>';

    foreach ($query as $row) {
        $tabla.='<tr>';
            $tabla.='<td>';
                $tabla.= $row['id_empleado'];
            $tabla.='</td>';
            $tabla.='<td>';
                $tabla.= $row['nombre'].' '.$row['apellido'];
            $tabla.='</td>';
            $tabla.='<td>';
                $tabla.= $row['cedula'];
            $tabla.='</td>';
            $tabla.='<td>';
                $tabla.= $row['telefono'];
            $tabla.='</td>';
            $tabla.='<td>';
                $tabla.= $row['email'];
            $tabla.='</td>';
            $tabla.='<td>';
                $tabla.= $row['cargo'];
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
	$dompdf->stream("JCCRP_Lista_Empleados_".date("Y-m-d"));

?>


<?php 
	require_once '../recursos/libs/dompdf/lib/html5lib/Parser.php';
	require_once '../recursos/libs/dompdf/src/Autoloader.php';
	date_default_timezone_set('America/Caracas');
	Dompdf\Autoloader::register();
	// reference the Dompdf namespace
	use Dompdf\Dompdf;
	
	require('reporte.class.php');
    $obj = new reporte;

    $id_diatrabajo=$_GET['id_diatrabajo'];
    $query =$obj->datos_diatrabajo($id_diatrabajo);
    $query2 = $obj->lista_cargamento($id_diatrabajo);

    foreach ($query as $row) {
        $emp1_nom = $row['emp1_nom'];
        $emp1_ape = $row['emp1_ape'];
        $emp1_ced = $row['emp1_ced'];
        $emp2_nom = $row['emp2_nom'];
        $emp2_ape = $row['emp2_ape'];
        $emp2_ced = $row['emp2_ced'];
        $marca = $row['marca'];
        $modelo = $row['modelo'];
        $matricula = $row['marca'];
        $fecha = $row['fecha'];
    }


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

      .form-control {
        display: block;
        width: 100%;
        height: calc(1.5em + 0.75rem + 2px);
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
      }
    </style>

    
    <div class="">
        <img src="../recursos/img/logo.jpg" width=100px height=100px>
            <p>Fecha:'.$fecha.'</p>
            <br>
            <h3 class="">Guia de Movilizacion</h3>
    </div>

    <br><br><br><br><br><br><br><br><br>
    <div>
        <p>Vendedor 1: '.$emp1_nom.' '.$emp1_ape.'</p>
        <br>
        <p>Cedula: '.$emp1_ced.'</p>
    </div>
    
    <br><br><br><br>
    <div>
        <p>Vendedor 2: '.$emp2_nom.' '.$emp2_ape.'</p>
        <br>
        <p>Cedula: '.$emp2_ced.'</p>
    </div>


    <br><br><br><br><br><br>
    
    <table class="table">
        <thead class="">
            <tr>
                <th>Nombre</th>
                <th>Cantidad</th>
            </tr>
        </thead>
    <tbody>';

       
    foreach ($query2 as $row) {
        $tabla.='<tr>';
            $tabla.='<td>';
                $tabla.= $row['nombre'];
            $tabla.='</td>';
            $tabla.='<td>';
                $tabla.= $row['cantidad_prod'];
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
	$dompdf->stream("JCCRP_Manual_Movilizacion_".date("Y-m-d"));
?>


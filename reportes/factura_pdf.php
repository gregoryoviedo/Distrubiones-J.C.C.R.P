<?php 
	require_once '../recursos/libs/dompdf/lib/html5lib/Parser.php';
	require_once '../recursos/libs/dompdf/src/Autoloader.php';
	date_default_timezone_set('America/Caracas');
	Dompdf\Autoloader::register();
	// reference the Dompdf namespace
	use Dompdf\Dompdf;
	
	require('reporte.class.php');
    $obj = new reporte;

    $id_factura=$_GET['id_factura'];
    $query =$obj->datos_cliente($id_factura);
    $query2 = $obj->carrito($id_factura);

    foreach ($query as $row) {
        $nom_fiscal = $row['nom_fiscal'];
        $rif = $row['rif'];
        $telefono = $row['telefono'];
        $serial = $row['fact_serial'];
        $total_factura = $row['total_factura'];
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

    </style>

    
    <div class="">
        <img src="../recursos/img/logo.jpg" width=100px height=100px>
            <h3 class="">Factura</h3>
            <br>
            <p>*Este documento no posee ningun valor legal*</p>
    </div>

    <br><br><br><br><br><br><br><br>

    <p>Fecha:'.$fecha.'</p>
    <br>
    <p>Serial:'.$serial.'</p>
    <br>
    <p>Nombre Fiscal:'.$nom_fiscal.'</p>
    <br>
    <p>Telefono:'.$telefono.'</p>
    

    <br><br><br><br>
    
    <table class="table">
        <thead class="">
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Total</th>
            </tr>
        </thead>
    <tbody>';

    foreach ($query2 as $row) {
        $multiplica = $row['precio']*$row['cantidad_prod'];
        $tabla.= '<tr>';
            $tabla.= '<td>';
                $tabla.= $row['nombre'];
            $tabla.= '</td>';
            $tabla.= '<td>';
                $tabla.= $row['cantidad_prod'];
            $tabla.= '</td>';
            $tabla.= '<td>';
                $tabla.= $row['precio'];
            $tabla.= '</td>';
            $tabla.= '<td>';
                $tabla.= $multiplica;
            $tabla.= '</td>';
        $tabla.= '</tr>';
    }

    $tabla.= '<tr>';
            $tabla.= '<td colspan="4">';
                $tabla.= 'Total Factura: '.$total_factura.' (Este valor esta excento de IVA)';
            $tabla.= '</td>';
    $tabla.= '</tr>';

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
	$dompdf->stream("JCCRP_Factura_".$serial);
?>


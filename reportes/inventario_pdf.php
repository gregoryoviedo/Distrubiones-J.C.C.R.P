<?php 
	require_once '../recursos/libs/dompdf/lib/html5lib/Parser.php';
	require_once '../recursos/libs/dompdf/src/Autoloader.php';
	date_default_timezone_set('America/Caracas');
	Dompdf\Autoloader::register();
	// reference the Dompdf namespace
	use Dompdf\Dompdf;
	
	require('reporte.class.php');
    $obj = new reporte;

    $query =$obj->lista_categoria();


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
            <h3 class="">Inventario</h3>
    </div>

    <br><br><br><br><br><br><br><br><br>
    
    <table class="table">
        <thead class="">
            <tr>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Descripcion</th>
            </tr>
        </thead>
    <tbody>';

       
    foreach ($query as $row) {
        $tabla.='<tr>';
            $tabla.='<td colspan="4">';
                $tabla.= 'Categoria: '.$row['nombre'];
            $tabla.='</td>';
        $tabla.='</tr>';
            $query2 = $obj->lista_elemento($row['id_categoria']);
            foreach ($query2 as $row2) {
                $tabla.='<tr>';
                    
                    $tabla.='<td>';
                        $tabla.= $row2['nombre'];
                    $tabla.='</td>';
                    $tabla.='<td>';
                        $tabla.= $row2['cantidad'];
                    $tabla.='</td>';
                    $tabla.='<td>';
                        $tabla.= $row2['precio'];
                    $tabla.='</td>';
                    $tabla.='<td>';
                        $tabla.= $row2['descripcion'];
                    $tabla.='</td>';
                $tabla.='</tr>';
            }

        
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
	$dompdf->stream("JCCRP_Inventario_".date("Y-m-d"));
?>


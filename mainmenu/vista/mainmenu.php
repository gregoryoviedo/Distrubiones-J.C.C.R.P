<?php
    session_start();

    if($_SESSION['nombre'] == null || $_SESSION['nombre'] == ''){
		header("Location:../../mainmenu/vista/login.html");
		exit();
	}

    require("../modelo/menu.class.php");

    $obj = new menu;

    $fichas = $obj->datos_fichas();

?>


<!DOCTYPE html>
<html lang="es">
<head>
 
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Distribuciones J.C.C.R.P</title>

  <!-- Estilos Css -->
  <link rel="stylesheet" href="../../recursos/libs/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../../recursos/css/slidebar.css">
  <link rel="stylesheet" href="../../recursos/css/style.css">

  <!-- Libreria de las alerta, no colocar despues de Jquery -->
  <script src="../../recursos/libs/sweetalert2.all.min.js"></script>
</head>
<body>
  <!-- page-wrapper -->
  <div class="page-wrapper default-theme sidebar-bg toggled bg-light">
    <a id="show-sidebar" class="btn btn-sm azul-rey text-white" style="border-radius: 0%;" href="#">
      <i class="fas fa-bars"></i>
    </a>
    <nav id="sidebar" class="sidebar-wrapper">
            <div class="sidebar-content">
                <!-- sidebar-brand  -->
                <div class="sidebar-item sidebar-brand">
                    <a href="../../mainmenu/vista/mainmenu.php">INICIO</a>
                    <div id="close-sidebar">
                        <span class="fas fa-angle-double-left" style="color: #efb810;"></span>
                    </div>
                </div>
                <!-- sidebar-header  -->
                <div class="sidebar-item sidebar-header d-flex flex-nowrap">
                    <div class="user-pic">
                        <img class="img-responsive img-rounded img-fluid rounded-circle w-100" src="../../recursos/img/fotos_perfil/<?php echo $_SESSION['urlfoto'];?>" alt="User picture">
                    </div>
                    <div class="user-info">
                        <span class="user-name">
                            <?php echo $_SESSION['apellido'].', '.$_SESSION['nombre'];?>
                        </span>
                        <span class="user-role"><?php echo $_SESSION['cargo'];?></span>
                        <span class="user-status">
                            <a href="../../empleados/vistas/perfil_emp.php?id=<?php echo $_SESSION['id_empleado']?>"><i class="fas fa-id-card"></i> Ver Perfil</a>
                        </span>
                    </div>
                </div>
                <!-- sidebar-menu  -->
                <div class=" sidebar-item sidebar-menu">
                    <ul>
                        <!-- dropdown administracion -->
                        <li class="sidebar-dropdown mt-2">
                            <a href="#">
                                <i class="fas fa-angle-down arrow"></i>
                                <i class="square"></i>
                                <i class="fas fa-user-tie text-dark" style="left: 29px"></i>
                                <span class="menu-text">Administracion</span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <?php
                                        if($_SESSION['nivel']>1){
                                            ?>
                                        <li>
                                            <a href="../../empleados/vistas/empleados.php">
                                                <i class="square"></i>
                                                <i class="fas fa-users text-dark" style="left: 29px"></i>
                                                Empleados
                                            </a>
                                        </li>
                                        <li>
                                            <a href="../../vehiculo/vista/vehiculos.php">
                                                <i class="square"></i>
                                                <i class="fas fa-truck text-dark" style="left: 29px"></i>
                                                Vehiculos
                                            </a>
                                        </li>
                                        <li>
                                            <a href="../../rutas/vista/lista_rutas.php">
                                                <i class="square"></i>
                                                <i class="fas fa-map-marked-alt text-dark" style="left: 29px"></i>    
                                                Rutas
                                            </a>
                                        </li>
                                        <li>
                                            <a href="../../auditoria/vista/auditoria.php?busqueda=&p=1">
                                                <i class="square"></i>
                                                <i class="fas fa-list-ol text-dark" style="left: 29px"></i>
                                                Auditoria
                                            </a>
                                        </li>
                                            <?php
                                        }
                                    ?>
                                </ul>
                            </div>
                        </li>

                        <!-- dropdown clientes -->
                        <li class="sidebar-dropdown">
                          <a href="#">
                                <i class="fas fa-angle-down arrow"></i>
                                <i class="square"></i>
                                <i class="fas fa-user-circle text-dark" style="left: 29px"></i>
                                <span class="menu-text">Clientes</span>
                          </a>
                          <div class="sidebar-submenu">
                              <ul>
                                  <?php
                                    if($_SESSION['nivel']>1){
                                        ?>
                                    <li>
                                        <a href="../../clientes/vista/new_cliente.php">
                                            <i class="square"></i>
                                            <i class="fas fa-plus-circle text-dark" style="left: 29.5px"></i>
                                            Nuevo Cliente
                                        </a>
                                    </li>
                                    <li>
                                        <a href="../../clientes/vista/lista_cliente.php?busqueda=&p=1">
                                            <i class="square"></i>
                                            <i class="fas fa-clipboard-list text-dark" style="left: 31px"></i>
                                            Lista de Clientes
                                        </a>
                                    </li>
                                    <li>
                                        <a href="../../clientes/vista/zonas.php">
                                            <i class="square"></i>
                                            <i class="fas fa-map-marker-alt text-dark" style="left: 31px"></i>
                                            Zonas
                                        </a>
                                    </li>
                                        <?php
                                    }
                                  ?>
                              </ul>
                          </div>
                        </li>

                        <!-- dropdown trabajo -->
                        <li class="sidebar-dropdown">
                          <a href="#">
                                <i class="fas fa-angle-down arrow"></i>
                                <i class="square"></i>
                                <i class="fas fa-briefcase text-dark" style="left: 29px"></i>
                                <span class="menu-text">Trabajo</span>
                          </a>
                          <div class="sidebar-submenu">
                              <ul>
                                  <?php
                                    if($_SESSION['nivel']>1){
                                        ?>
                                        <li>
                                        <a href="../../dia_trabajo/vista/trabajo.php">
                                            <i class="square"></i>
                                            <i class="fas fa-hammer text-dark" style="left: 29px"></i>
                                            Trabajo de Hoy
                                        </a>
                                        </li>
                                        <?php
                                    }
                                  ?>
                                  <li>
                                        <a href="../../dia_trabajo/vista/trabajo_enviado.php">
                                            <i class="square"></i>
                                            <i class="fas fa-check-square text-dark" style="left: 30px"></i>
                                            Finalizar Dia
                                        </a>
                                  </li>
                                  <?php
                                    if($_SESSION['nivel']>1){
                                        ?>
                                        <li>
                                            <a href="../../dia_trabajo/vista/historial_trabajo.php?busqueda=&p=1">
                                                <i class="square"></i>
                                                <i class="fas fa-history text-dark" style="left: 29px"></i>
                                                Historial laboral
                                            </a>
                                        </li>
                                        <li>
                                            <a href="../../factura/vista/historial_factura.php?busqueda=&p=1">
                                                <i class="square"></i>
                                                <i class="fas fa-file-invoice text-dark" style="left: 31px"></i>
                                                Historial Facturas
                                            </a>
                                        </li>
                                        <?php
                                    }
                                  ?>
                                  
                              </ul>
                          </div>
                        </li>

                        <!-- boton inventario -->
                        <?php
                            if($_SESSION['nivel']>1){
                                ?>
                                <li>
                                    <a href="../../inventario/vista/inventario.php">
                                        <i class="square"></i>
                                        <i class="fas fa-box-open text-dark" style="left: 27px"></i>
                                        <span class="menu-text">Inventario</span>
                                    </a>
                                </li>
                                <?php
                            }                        
                        ?>
                        
                    </ul>
                </div>
                <!-- sidebar-menu  -->
            </div>
            <!-- sidebar-footer  -->
            <div class="sidebar-footer">
                <div class="text-center">
                    <a href="../../mainmenu/controlador/logout.php">
                        <i class="fa fa-power-off"></i> Cerrar Sesion
                    </a>
                </div>
                <div class="pinned-footer">
                    <a href="#">
                        <i class="fas fa-ellipsis-h"></i>
                    </a>
                </div>
            </div>
        </nav>

        <main class="page-content pt-2">
            <div class="container-fluid">
                <div class="row">
                   <div class="col-lg-12">
                        <h1 class="display-4">Bienvenido <?php echo $_SESSION['apellido'].', '.$_SESSION['nombre'];?></h1>
                        <hr>
                   </div>
                   <div class="col-lg-3">
                        <div class="card">
                        <div class="card-body py-2 bg-danger">
                            <h1 class="text-light"><?php echo $fichas['clientes'];?></h1>
                            <i class="fas fa-user-circle" style="color:#D01212;position: absolute;font-size: 70px;margin-left: 175px;margin-top: -40px;"></i>
                            <p class="text-light">Clientes registrados</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item my-0 py-3 text-center " style="background: #D01212;"><a href="../../Controller/admin/ClienteAdminController.php?accion=mostrar" class="text-light"></a></li>
                        </ul>
                        </div>
                        </div>
                        <div class="col-lg-3">
                        <div class="card">
                        <div class="card-body py-2 bg-primary">
                            <h1 class="text-light"><?php echo $fichas['empleados'];?></h1>
                            <i class="fas fa-user-tie" style="color:#105FD0;position: absolute;font-size: 70px;margin-left: 190px;margin-top: -40px;"></i>
                            <p class="text-light">Empleados registrados</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item my-0 py-3 text-center " style="background: #105FD0;"><a href="../../Controller/admin/AdministradoresController.php?accion=mostrar" class="text-light"></a></li>
                        </ul>
                        </div>
                        </div>
                        <div class="col-lg-3">
                        <div class="card">
                        <div class="card-body py-2 bg-success">
                            <h1 class="text-light"><?php echo $fichas['rutas'];?></h1>
                            <i class="fas fa-truck-moving" style="color:#148E1D;position: absolute;font-size: 70px;margin-left: 180px;margin-top: -40px;"></i>
                            <p class="text-light">Rutas registrados</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item my-0 py-3 text-center " style="background: #148E1D;"><a href="../../Controller/admin/EmpleadosController.php?accion=mostrar" class="text-light"></a></li>
                        </ul>
                        </div>
                        </div>
                        <div class="col-lg-3">
                        <div class="card">
                        <div class="card-body py-2 bg-warning">
                            <h1 class="text-dark"><?php echo $fichas['zonas'];?></h1>
                            <i class="fas fa-map-marked-alt" style="color: #E3C30C;position: absolute;font-size: 70px;margin-left: 180px;margin-top: -40px;"></i>    
                            <p class="text-dark">Zonas registradas</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item my-0 py-3 text-center " style="background: #E3C30C;"><a href="../../Controller/admin/ContactanosMensajesController.php?accion=view" class="text-dark"></a></li>
                        </ul>
                        </div>
                    </div>
                </div>

                <!-- CHART -->

                <div class="row justify-content-around">
                    <div class="col-lg-4">
                        <canvas id="myChart" width="400" height="400"></canvas>
                    </div>
                    <div class="col-lg-4">
                        <canvas id="myChart-two" width="500" height="500"></canvas>
                    </div>
                </div>


                

            </div>
        </main>
  </div>
  <!-- page-wrapper -->

  
</body>
<!-- Scripts -->
<script src="../../recursos/libs/all.min.js"></script>
  <script src="../../recursos/libs/jquery.js"></script>
  <script src="../../recursos/libs/bootstrap/js/popper.js"></script>
  <script src="../../recursos/libs/bootstrap/js/bootstrap.min.js"></script>
  <script src="../../recursos/js/slidebar.js"></script>
  <script src="../../recursos/libs/Charts.min.js"></script>
  
    <script>

    
    var ctx= document.getElementById("myChart").getContext("2d");
    var myChart= new Chart(ctx,{
        type:"pie",
        data:{
            labels:['Administradores','Gerentes','Vendedores'],
            datasets:[{
                label:'Num datos',
                data:[5,9,3],
                backgroundColor:[
                    'rgb(66, 134, 244,0.5)',
                    'rgb(74, 135, 72,0.5)',
                    'rgb(229, 89, 50,0.5)'
                ]
            }]
        },
        options:{
            scales:{
                yAxes:[{
                    ticks:{
                        beginAtZero:true
                    }
                }]
            }
        }
    });

    var ctx = document.getElementById('myChart-two').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Lucky Strike', 'Belmont', 'Pallmall', 'Universall', 'Universall', 'Universall', 'Universall', 'Universall', 'Universall', 'Universall', 'Universall', 'Universall'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3, 11, 5, 2, 3, 11, 5],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    </script>
</html>
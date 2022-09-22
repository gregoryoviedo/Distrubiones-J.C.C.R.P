<!DOCTYPE html>
<html lang="es">
<head>

    <?php

    session_start();

    if($_SESSION['nombre'] == null || $_SESSION['nombre'] == ''){
        header("Location:../../mainmenu/vista/login.html");
        exit();
    }

    require('../modelo/trabajo.class.php');

    $obj = new trabajo;

    ?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Distribuciones J.C.C.R.P</title>

    <!-- Estilos Css -->
    <link rel="stylesheet" href="../../recursos/libs/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../../recursos/css/slidebar.css">
    <link rel="stylesheet" href="../../recursos/css/style.css">
</head>

<body>
    <div class="page-wrapper default-theme sidebar-bg bg1 toggled">
        <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
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
        <!-- Contenido de la pagina  -->
        <main class="page-content pt-2">
            <div class="container-fluid">
                <div class="row">
                   <div class="col-lg-12">
                        <h1>Finalizar dia - rutas de hoy</h1>
                        <hr>
                   </div>
                </div>

                <div class="col-12" >
                    <!-- INICIO DE TABLA -->
                     <div id="caja_enviados" style="overflow-x: auto;" >
                        <table class="table">
                            <thead>
                                <thead>
                                    <th>#</th>
                                    <th>Ruta</th>
                                    <th>Zona</th>
                                    <th>Estado</th>
                                    <th>Finalizar</th>
                                </thead>
                            </thead>
                            <tbody>
                                <?php
                                    $query = $obj->lista_enviados();
                                    $band = 0;
                                    foreach ($query as $row) {
                                        $band+=1;
                                        ?>
                                        <tr>
                                            <td><?php echo $row['id_diatrabajo'];?></td>
                                            <td><?php echo 'Ruta: '.$row['id_ruta'];?></td>
                                            <td><?php echo $row['nombre'];?></td>
                                            <td><?php echo $row['estado'];?></td>
                                            <td>
                                                <?php

                                                
                                                if($row['estado']=='enviado'){
                                                    if($_SESSION['nivel']==2){
                                                        ?>
                                                            <button class="btn btn-light" disabled>No tienes permisos para esto</button>
                                                        <?php
                                                    }else{
                                                        if($_SESSION['nivel']==1){
                                                            $verif_empleado = $obj->verif_pertenece($row['id_diatrabajo'],$_SESSION['id_empleado']);
                                                            if(!$verif_empleado){
                                                                ?>
                                                                <button class="btn btn-light" disabled>No perteneces a esta ruta</button>
                                                                <?php
                                                            }else{
                                                                ?>
                                                                <a href="finalizar_dia.php?trabajo=<?php echo $row['id_diatrabajo'];?>" class="btn btn-info">Finalizar</a>
                                                                <?php
                                                            }
                                                        }else{
                                                            ?>
                                                            <a href="finalizar_dia.php?trabajo=<?php echo $row['id_diatrabajo'];?>" class="btn btn-info">Finalizar</a>
                                                            <?php
                                                        }
                                                    }
                                                }
                                                if($row['estado']=='finalizado'){
                                                    ?>
                                                    <button class="btn btn-dark" disabled>Ruta finalizada</button>
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                        </tr>                                        
                                        <?php
                                    }
                                    if($band==0){
                                        echo '<tr><td class="text-center"colspan=5>No se han enviado rutas hoy</td></tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                     </div>
                    <!-- FIN DE TABLA -->
                </div>


            </div>
        </main>
        <!-- Contenido de la pagina" -->
    </div>
    <!-- page-wrapper -->

    <!-- Scripts -->
    <script src="../../recursos/libs/all.min.js"></script>
    <script src="../../recursos/libs/jquery.js"></script>
    <script src="../../recursos/libs/bootstrap/js/popper.js"></script>
    <script src="../../recursos/libs/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../recursos/js/slidebar.js"></script>
    

</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>

    <?php

    session_start();

    if($_SESSION['nombre'] == null || $_SESSION['nombre'] == ''){
        header("Location:../../mainmenu/vista/login.html");
        exit();
    }else{
        if($_SESSION['nivel']==1){
            header("Location:../../mainmenu/vista/mainmenu.php");
        }
    }

    require('../modelo/ruta.class.php');

    $obj = new ruta;

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
                        <h1>Lista de Rutas</h1>
                        <hr>
                   </div>
                   <div class="col-12 pb-4">
                       <a href="new_ruta.php" class="btn btn-success"><i class="fas fa-plus-square"></i> Agregar Ruta</a>
                       <button class="btn btn-danger" data-toggle="modal" data-target="#lista_deshabilitados"><i class="far fa-eye-slash"></i> Ver deshabilidatos</button>
                    </div>
                </div>

                <div class="col-12" >
                    <!-- INICIO DE TABLA -->
                     <div style="overflow-x: auto;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Ruta</th>
                                    <th>Vendedor 1</th>
                                    <th>Vendedor 2</th>
                                    <th>Vehiculo</th>
                                    <th>Estado</th>
                                    <th>Modificar</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $query=$obj->lista_rutas();

                                    foreach ($query as $row) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo 'Ruta: '.$row['id_ruta'];?>
                                            </td>
                                            <td>
                                                <?php echo $row['emp1_ape'].', '.$row['emp1_nom'];?>
                                            </td>
                                            <td>
                                                <?php echo $row['emp2_ape'].', '.$row['emp2_nom'];?>
                                            </td>
                                            <td>
                                                <?php echo $row['matricula'].', '.$row['modelo'];?>
                                            </td>
                                            <td>
                                                <?php
                                                    if(!$row['emp1_eli'] && !$row['emp2_eli'] && !$row['veh_eli'] ){
                                                        echo '<p class="text-success">Todos activos</p>';
                                                    }else{
                                                        echo '<p class="text-danger">Deshabilitado:';
                                                            if($row['emp1_eli']){
                                                                echo ' Vendedor 1.';
                                                            }
                                                            if($row['emp2_eli']){
                                                                echo ' Vendedor 2.';
                                                            }
                                                            if($row['veh_eli']){
                                                                echo ' Vehiculo.';
                                                            }
                                                        echo '</p>';
                                                    }

                                                ?>
                                            </td>
                                            <td>
                                                <a href="mod_ruta.php?ruta=<?php echo $row['id_ruta'];?>&emp1=<?php echo $row['id_vendedor1'];?>&emp2=<?php echo $row['id_vendedor2'];?>&veh=<?php echo $row['id_vehiculo'];?>" class="btn btn-warning">Modificar</a>
                                            </td>
                                            <td>
                                                <button class="btn btn-danger" data-toggle="modal" data-target="#modal_del_ruta" onclick="rellenar_delruta(<?php echo $row['id_ruta'];?>);">Eliminar</button>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    $query->closeCursor();
                                ?>
                            </tbody>
                        </table>
                     </div>
                    <!-- FIN DE TABLA -->
                </div>
                

                <!-- MODAL VERIFICAR ELIMINAR -->

                <div class="modal fade" id="modal_del_ruta" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" >¿Desea eliminar esta ruta?</h5>
                            </div>
                            
                            <input type="hidden" name="id_delruta" id="id_delruta"> 
                            <br>
                            <p class="text-danger" id="msg_error_delruta"></p>
                            <br>
                            
                            <div class="modal-footer">
                                <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
                                <button type="button" id="btneliminar" class="btn btn-danger" onclick="del_ruta();">Eliminar</button>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- LISTA DESHABILITADOS -->

                <div class="modal fade" id="lista_deshabilitados" tabindex="-1" role="dialog" aria-labelledby="lista_deshabilitadosTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="titulo_modal">Lista de eliminados</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" style="overflow-x: auto;">
                                <table class="table">
                                    <thead>
                                        <tr>
                                        <th scope="col">Ruta</th>
                                        <th scope="col">Vendedor 1</th>
                                        <th scope="col">Vendedor 2</th>
                                        <th scope="col">Vehiculo</th>
                                        <th scope="col">Habilitar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $query =$obj->lista_deshabilitados();
                                            foreach ($query as $row) {
                                                ?>
                                                    <td>
                                                        <?php echo 'Ruta: '.$row['id_ruta'];?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['emp1_ape'].', '.$row['emp1_nom'];?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['emp2_ape'].', '.$row['emp2_nom'];?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['matricula'].', '.$row['modelo'];?>
                                                    </td>
                                                    <td>
                                                        <a href="hab_ruta.php?ruta=<?php echo $row['id_ruta'];?>&emp1=<?php echo $row['id_vendedor1'];?>&emp2=<?php echo $row['id_vendedor2'];?>&veh=<?php echo $row['id_vehiculo'];?>" class="btn btn-success">Habilitar</a>
                                                    </td>
                                                <?php
                                            }
                                            $query->closeCursor();
                                        ?>


                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
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
    <script src="../../recursos/js/ruta.js"></script>

</body>
</html>
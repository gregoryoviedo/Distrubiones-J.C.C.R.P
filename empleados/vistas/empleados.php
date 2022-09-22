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

    require('../modelos/empleados.class.php');

    $obj = new empleados;
    

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
                        <h1>Empleados</h1>
                        <hr>         
                    </div>
                    <div class="col-lg-12 pb-4">
                        <a href="new_empleado.php" class="btn btn-success"><i class="fas fa-plus-square"></i> Agregar Empleado</a>
                        <button class="btn btn-danger" data-toggle="modal" data-target="#lista_deshabilitados"><i class="far fa-eye-slash"></i> Ver deshabilidatos</button>
                        <a href="../../reportes/lista_emp_pdf.php" class="btn btn-warning"><i class="fas fa-file-pdf"></i> Generar PDF</a>
                    </div>
                    
                
                    <!-- INICIO DE TABLA -->
                    <?php
                        $query=$obj->lista('habilitados');
                        $band = 0;
                        foreach ($query as $row) {
                        $band+=1;
                    ?>
                    <div class="col-lg-3 col-md-2 col-sm-12 ">
                        <div class="card card_custom mb-5">
                            <div class="card-body">
                                <div class="text-center contenedor_foto">
                                    <img src="../../recursos/img/fotos_perfil/<?php echo $row['urlfoto'];?>" class="redondear">
                                </div>
                                <h3 class="text-center mt-4"><?php echo $row['nombre'];?></h3>
                                <h3 class="text-center"><?php echo $row['apellido'];?></h3>
                                <p class="texto_cargo"><?php echo $row['cargo']; ?></p>
                                <div class="float-right">
                                <a href="perfil_emp.php?id=<?php echo $row['id_empleado'];?>" class="btn btn-primary btn-sm">Ver Perfil <i class="fas fa-caret-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                        if($band==0){
                    ?>
                        <tr>
                            <td colspan=6>
                            No hay elementos para mostrar
                            </td>
                        </tr>
                    <?php     
                        }
                    ?>
        
                        <!-- FIN DE TABLA -->

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
                                                <th scope="col">#</th>
                                                <th scope="col">Nombre</th>
                                                <th scope="col">Apellido</th>
                                                <th scope="col">Cedula</th>
                                                <th scope="col">Cargo</th>
                                                <th scope="col">Habilitar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $query=$obj->lista('deshabilitados');

                                                    foreach ($query as $row) {
                                                ?>
                                                <tr>
                                                    <th scope="row"><?php echo $id=$row['id_empleado'];?></th>
                                                    
                                                    <td><?php echo $row['nombre'];?></td>
                                                    <td><?php echo $row['apellido'];?></td>
                                                    <td><?php echo $row['cedula'];?></td>
                                                    <td><?php echo $row['cargo'];?></td>
                                                    <td>
                                                    <button class="btn btn-success" id="btnhab" onclick="estado_emp(<?php echo $id;?>,'habilitar')">Habilitar</button>
                                                    </td>
                                                </tr>
                                                <?php
                                                    }
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
    <script src="../../recursos/js/empleados.js"></script>


</body>
</html>
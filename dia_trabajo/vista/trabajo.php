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
                        <h1>Trabajo de hoy</h1>
                        <hr>
                   </div>
                   <div class="col-12 pb-4">
                       <button class="btn btn-success" data-toggle="modal" data-target="#modal_new_trabajo"><i class="fas fa-plus-square"></i> Asignar nueva ruta</button>
                    </div>
                </div>
                
                <h3>
                    Asignadas hoy:
                </h3>
                <div class="col-12" >
                    <!-- INICIO DE TABLA -->
                     <div id="caja_tabla" style="overflow-x: auto;">
                        
                     </div>
                    <!-- FIN DE TABLA -->
                </div>

                <!-- MODAL NUEVO TRABAJO -->

                <div class="modal fade" id="modal_new_trabajo" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" >Asignar ruta</h5>
                            </div>
                            <div class="modal-body">
                                <form action="#" id="form_new_trabajo">
                                    
                                    <div class="form-group">
                                        <label for="zona">Seleccione una ruta:</label>
                                        <select class="form-control" name="id_newruta" id="id_newruta">
                                            <?php
                                                $query = $obj->lista_rutas();
                                                foreach ($query as $row) {
                                                    ?>
                                                    
                                                    <option value="<?php echo $row['id_ruta'];?>"><?php echo 'Ruta: '.$row['id_ruta'];?></option>
                                                    <?php
                                                }
                                                $query->closeCursor();
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="zona">Seleccione una zona:</label>
                                        <select class="form-control" name="id_newzona" id="id_newzona">
                                            <?php
                                                $query = $obj->lista_zonas();
                                                foreach ($query as $row) {
                                                    ?>
                                                    
                                                    <option value="<?php echo $row['id_zona'];?>"><?php echo $row['nombre'];?></option>
                                                    <?php
                                                }
                                                $query->closeCursor();
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="escolta">Escolta de la ruta</label>
                                        <textarea class="form-control" name="escolta" id="escolta" cols="5" rows="4" placeholder="Ingrese informacion de la escolta si posee" maxlenght=150></textarea>
                                    </div>

                                    <p class="text-danger" id="msg_error_newtrabajo"></p>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
                                <button type="button" id="btnguardar" class="btn btn-success" onclick="new_trabajo()">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- MODAL LISTA CARGAMENTO -->
                <div class="modal fade" id="modal_cargamento" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal">Asignar cargamento</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </div>
                              
                            <div class="modal-body">
                                <!-- TABLA DE CARGAMENTO -->
                                <input type="hidden" name="id_tra_listcargo" id="id_tra_listcargo">
                                <div id="tabla_cargo">

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
                                <button type="button" id="btnnuevocargo" class="btn btn-success" onclick="mostrar_newcargo()">Añadir Nuevo</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- MODAL NUEVO CARGAMENTO -->
                <div class="modal fade" id="modal_new_cargamento" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal">Asignar cargamento</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </div>
                              
                            <div class="modal-body">
                                <!-- form new cargo -->
                                <form id="form_newcargo" action="#" method="post">
                                    <div class="form-group">
                                        <label for="id_cat">Categoria:</label>
                                        <select class="form-control" name="id_cat" id="id_cat">
                                            <option value="" hidden>Seleccione una categoria</option>
                                            <?php
                                                $query = $obj->lista_categoria();
                                                foreach ($query as $row) {
                                                    ?>
                                                    <option value="<?php echo $row['id_categoria'];?>"><?php echo $row['nombre'];?></option>
                                                    <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    
                                    
                                    <div class="form-group">
                                        <label for="id_ele">Elemento: </label>
                                        <div id="caja_elemento">
                                                <select class="form-control" id="id_ele" name="id_ele">
                                                    <option value="" hidden>Selecciona una categoria</option>
                                                </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="existencia">Cantidad en existencias</label>
                                        <input type="text" class="form-control" name="existencias" id="existencias" disabled>
                                    </div>

                                    <div class="form-group">
                                        <label for="existencia">Cantidad para llevar</label>
                                        <input type="text" class="form-control" name="llevar" id="llevar" onkeypress="return numeros(event);">
                                    </div>
                                </form>
                                
                                <p class="text-danger" id="msg_error_newcargo"></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-dark" onclick="mostrar_listacargo()">Cancelar</button>
                                <button type="button" id="btnguardarcargo" class="btn btn-success" onclick="new_cargo()">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- MODAL EXITO -->
                <div class="modal fade" id="alertaExito" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal">Exito</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </div>
                                <div class="alert alert-success" role="alert" id="mensajeExito">
                                
                                </div>
                            <div class="modal-footer">
                            
                            </div>
                        </div>
                    </div>
                </div>

                <!-- MODAL ERROR -->
                <div class="modal fade" id="alertaError" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal">Error</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </div>
                                <div class="alert alert-danger" role="alert" id="mensajeError">
                                
                                </div>
                            <div class="modal-footer">
                            
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
    <script src="../../recursos/js/validaciones.js"></script>
    <script src="../../recursos/js/trabajo.js"></script>

</body>
</html>
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
    require('../modelo/cliente.class.php');

    $obj = new cliente;
    $busqueda = $_GET['busqueda'];
    $pagina = $_GET['p'];

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
                        <h1>Lista de Clientes</h1>
                        <hr>         
                    </div>
                    <div class="col-lg-12 pb-4">
                        <a href="new_cliente.php" class="btn btn-success"><i class="fas fa-plus-square"></i> Agregar Cliente</a>
                        <button class="btn btn-danger" data-toggle="modal" data-target="#lista_deshabilitados"><i class="far fa-eye-slash"></i> Ver deshabilidatos</button>
                        <a href="../../reportes/lista_cli_pdf.php?busqueda=<?php echo $busqueda?>" class="btn btn-warning"><i class="fas fa-file-pdf"></i> Generar PDF</a>
                    </div>
                    
                    <div class="row">
                        <div class="col-12">
                            <form action="#" method="get" id="form_buscar">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="adorno">Buscar:</span>
                                    </div>
                                    <input type="text" class="form-control" name="busqueda" id="busqueda" placeholder="ingresar valor de busqueda (buscar en blanco para ver todo)" aria-label="Username" aria-describedby="adorno">
                                    <div class="input-group-append">
                                        <button class="btn btn-success btn-info">Buscar -></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                
                    <!-- INICIO DE TABLA -->
                    <div class="col-12" style="overflow-x: auto;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre Fiscal</th>
                                    <th>RIF</th>
                                    <th>Telefono</th>
                                    <th>Zona</th>
                                    <th>Direccion</th>
                                    <th>Modificar</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php

                                $num_paginas = ceil($obj->contar_paginas($busqueda)/10);
                                $query = $obj->lista_cliente($busqueda,$pagina,10);


                                foreach($query as $row){
                                ?>
                                    <tr>
                                        <td><?php echo $row['id_cliente'];?></td>
                                        <td><?php echo $row['nom_fiscal'];?></td>
                                        <td><?php echo $row['rif'];?></td>
                                        <td><?php echo $row['telefono'];?></td>
                                        <td><?php echo $row['nom_zona'];?></td>
                                        <td><?php echo $row['direccion'];?></td>
                                        <td>
                                            <a href="mod_cliente.php?id=<?php echo $row['id_cliente'];?>" class="btn btn-warning">modificar</a>
                                        </td>
                                        <td>
                                            <button class="btn btn-danger" data-toggle="modal" data-target="#modal_del_cliente" onclick="rellenar_delcliente(<?php echo $row['id_cliente'];?>)">eliminar</button>
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
                        <div class="row mb-5">
                            <div class="col-12">
                                <div class="input-group mt-3">
                                    <div class="input-group-prepend">
                                        <button id="btn_atras" class="btn btn-info" onclick="atras('<?php echo $busqueda;?>',<?php echo $pagina;?>)"><i class="fas fa-caret-left"></i> Atras</button>
                                        
                                    </div>
                                    <input type="text" class="text-center" value="<?php echo 'Pagina: '.$pagina.' de '.$num_paginas?>" disabled>
                                    <div class="input-group-append">
                                        <button id="btn_adelante" class="btn btn-info" onclick="siguiente('<?php echo $busqueda;?>',<?php echo $pagina;?>)">Adelante <i class="fas fa-caret-right"></i></button>
                                        
                                    </div>  
                                </div>
                            </div>                          
                        </div>
                        <input type="hidden" id="pag_actual" value="<?php echo $pagina;?>">
                        <input type="hidden" id="pag_final" value="<?php echo $num_paginas;?>">

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
                                    <th scope="col">Nombre Fiscal</th>
                                    <th scope="col">RIF</th>
                                    <th scope="col">Zona</th>
                                    <th scope="col">Habilitar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $query2=$obj->lista_deshabilitados();
                                        foreach ($query2 as $row) {
                                        ?>
                                            <tr>
                                                <td><?php echo $row['id_cliente'];?></td>
                                                <td><?php echo $row['nom_fiscal'];?></td>
                                                <td><?php echo $row['rif'];?></td>
                                                <td><?php echo $row['nom_zona'];?></td>
                                                <td>
                                                <button type="button" id="btnhabilitar" class="btn btn-success" onclick="hab_cliente(<?php echo $row['id_cliente'];?>,'habilitar')">Habilitar</button>
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

           <!-- MODAL VERIFICAR ELIMINAR -->

          <div class="modal fade" id="modal_del_cliente" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" >¿Desea eliminar este cliente?</h5>
                      </div>
                      
                      <input type="hidden" name="id_delcliente" id="id_delcliente"> 
                      <br>
                      <p class="text-danger" id="msg_error_delcliente"></p>
                      <br>
                      
                      <div class="modal-footer">
                          <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
                          <button type="button" id="btneliminar" class="btn btn-danger" onclick="del_cliente('eliminar')">Eliminar</button>
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
    <script src="../../recursos/js/clientes.js"></script>
    <script src="../../recursos/js/lista_cliente.js"></script>


</body>
</html>
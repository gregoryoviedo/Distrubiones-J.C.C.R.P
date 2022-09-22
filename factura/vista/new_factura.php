<!DOCTYPE html>
<html lang="es">
<head>

    <?php

    session_start();

    if($_SESSION['nombre'] == null || $_SESSION['nombre'] == ''){
        header("Location:../../mainmenu/vista/login.html");
        exit();
    }else{
        if($_SESSION['nivel']==2){
            header("Location:../../mainmenu/vista/mainmenu.php");
        }
    }

    require("../modelo/factura.class.php");
    date_default_timezone_set('America/Caracas');
    $obj = new factura;
    
    $id_diatrabajo = $_GET['trabajo'];

    $query = $obj->datos_trabajo($id_diatrabajo);
    foreach ($query as $row) {
        $id_zona = $row['id_zona'];
    }
    $query->closeCursor();

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

    <!-- Contenido de la pagina  -->
    <main class="page-content pt-2">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>Nueva Factura</h1>
                        <hr>
                        
                    </div>
                    
                    <div class="col-lg-12">
                    <form id="form_factura" action="#" method="POST" class="container">
                        <!-- TITULO PRINCIPAL -->
                        
                        <h4>Datos Personales o Negocio</h4>

                        <input type="hidden" name="id_zona" id="id_zona" value="<?php echo $id_zona;?>">
                        <!-- RIF -->
                        <div class="form-group">
                            <div class="row">
                                <div class="col-1">
                                    <label for="rif">RIF(*):</label>
                                </div>
                                <div class="col-6">
                                    
                                    <input type="text" class="form-control" name="rif" id="rif" maxlenght=15>
                                </div>
                                <div class="col-4">
                                    <button type="button" class="btn btn-info" id="btnbuscar" onclick="buscar_datos()">Buscar datos</button>
                                </div>
                            </div>
                        </div>
                        
                        
                        <input type="hidden" name="id_cliente" id="id_cliente">

                        <!-- NOMBRE -->
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="serial">Serial:</label>
                                    <input type="text" class="form-control" id="serial" name="serial" maxlenght=40>
                                </div>
                                <div class="col-6">
                                    <label for="nom_fiscal">Nombre Fiscal:</label>
                                    <input type="text" class="form-control" id="nom_fiscal" name="nom_fiscal" disabled>
                                </div>
                            </div>
                        </div>

                        
                        <div class="form-group">
                            <div class="row">
                                <!-- FECHA -->
                                <div class="col-4">
                                <label for="fecha">Fecha:</label>
                                <input type="text" class="form-control" name="fecha" id="fecha" value="<?php echo date('d/m/Y');?>" disabled>
                                </div>
                                <!-- TELEFONO -->
                                <div class="col-8">
                                <label for="telefono">Telefono:</label>
                                <input type="text" class="form-control" name="telefono" id="telefono" disabled>
                                </div>
                            </div>
                        </div>                        

                        
                        <div class="form-group">
                            
                        </div>
                        
                        <!-- LISTA DE COMPRAS -->

                        <hr>
                        <h4>Lista de compras</h4>
                        <div class="form-group">
                            <label for="">Selecciona un elemento del cargamento</label>
                            <select class="form-control" name="elemento_cargo" id="elemento_cargo">
                                <option value="" hidden>Selecciona un elemento</option>
                                <?php
                                    $query = $obj->lista_cargamento($id_diatrabajo);
                                    foreach ($query as $row) {
                                        $valor=$row['id_cargamento'].'||'
                                               .$row['id_elemento'].'||'
                                               .$row['precio'].'||'
                                               .$row['nombre'].'||'
                                               .$row['cantidad_prod'];
                                        ?>
                                        <option value="<?php echo $valor;?>"><?php echo $row['nombre'];?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </div>
                        
                        <!-- SELECCIONADOR DE PRODUCTO -->
                        <div class="form-group">
                            <div class="row">
                                <input type="hidden" name="id_cargo" id="id_cargo">
                                <input type="hidden" name="id_ele" id="id_ele">
                                <input type="hidden" name="precio" id="precio">
                                <div class="col-3">
                                    <label for="">Nombre:</label>
                                    <input type="text" class="form-control" name="nom_ele" id="nom_ele" disabled>
                                </div>
                                <div class="col-2">
                                    <label for="">Cantidad disponible:</label>
                                    <input type="text" class="form-control" name="cant_prod" id="cant_prod" disabled>
                                </div>
                                <div class="col-2">
                                    <label for="">Cantidad a llevar:</label>
                                    <input type="text" class="form-control" name="cant_llevar" id="cant_llevar" onkeypress="return numeros(event);">
                                </div>
                                <div class="col-2">
                                    <label for="">Agregar compra:</label>
                                    <button type="button" class="btn btn-info" id='btnagregar' onclick="agregar_carrito();">Agregar</button>
                                </div>
                            </div>
                        </div>

                        <!-- TABLA DE COMPRAS -->
                        <div class="form-group">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Elemento</th>
                                        <th>Cantidad</th>
                                        <th>Precio Unidad</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody id="cuerpo_tabla">

                                </tbody>
                            </table>
                        </div>


                        <div class="form-group mt-4">
                            <div class="row">
                                <div class="col-12">
                                    <label for="total">Total de la Factura:</label>
                                    <input type="text" class="form-control" name="total_fact" id="total_fact" value=0 disabled>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <!-- BOTON GUARDAR -->
                        <div class="form-group form_footer">
                            <a href="../../dia_trabajo/vista/finalizar_dia.php?trabajo=<?php echo $id_diatrabajo;?>" class="btn btn-dark">
                                Volver
                            </a>
                            <button type="button" class="btn btn-success btnverif" data-toggle="modal" data-target="#verifGuardar">
                            Guardar
                            </button>
                        </div>
                        
                        <!-- MODAL VERIFICAR GUARDADO -->

                        <div class="modal fade" id="verifGuardar" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" >¿Desea guardar esta factura?</h5>
                                    </div>
                                    
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
                                        <button type="button" id="btnguardar" class="btn btn-success" onclick='new_fact(<?php echo $id_diatrabajo;?>)'>Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        </form>
                        
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
  <script src="../../recursos/js/validaciones.js" ></script>
  <script src="../../recursos/js/factura.js" ></script>
  
</body>
</html>
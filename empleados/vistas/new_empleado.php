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
                        <h1>Registro de Empleados</h1>
                        <hr>
                        
                    </div>
                    
                    <div class="col-lg-12">
                    <form id="regisper" action="../controlador/resp_newemp.php" method="POST" class="container">
                        <!-- TITULO PRINCIPAL -->
                        <div>
                            <span class="text-danger">Los campos marcados con (*) son obligatorios</span>
                        </div>
                        <h4>Datos Personales</h4>
                        <div class="row">
                            <!-- NOMBRE -->
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                <label for="nombre">Nombre(*):</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre" maxlength=30 onkeypress="return letras(event);">
                                </div>
                            </div>

                            <!-- APELLIDO -->

                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                <label for="apellido">Apellido(*):</label>
                                <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Ingrese el apellido" maxlength=30 onkeypress="return letras(event);">
                                </div>
                            </div>

                        </div>

                        
                        <!-- CEDULA -->

                        <div class="form-group">
                            <label for="cedula">Cedula(*):</label>
                            <div class="row">
                                <div class="col-5 col-sm-2">
                                    <select class="form-control" name="tipo_ced" id="tipo_ced">
                                    <option value="V">V</option>
                                    <option value="E">E</option>
                                    </select>
                                </div>
                                <div class="col-7 col-sm-10">
                                    <input type="text" class="form-control" id="cedula" name="cedula" pattern="[0-9]" placeholder="Ingrese la cedula" maxlength=11 onkeypress="return numeros(event);">
                                </div>
                            </div>
                        </div>

                        <!-- TELEFONO -->

                        <div class="form-group">
                            <label for="numtel">Telefono(*):</label> <br>
                                <div class="row">
                                    <div class="col-sm-12 col-md-3">
                                        <select class="form-control" name="tipo_tel" id="tipo_tel">
                                            <option value="0414">0414</option>
                                            <option value="0424">0424</option>
                                            <option value="0416">0416</option>
                                            <option value="0426">0426</option>
                                            <option value="0412">0412</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-8 col-md-9">
                                        <input type="text" class="form-control" name="telefono" id="telefono" pattern="[0-9]" placeholder="Ingresar telefono" maxlength="7" onkeypress="return numeros(event);">
                                    </div>
                                </div>
                        </div>
                        <!-- EMAIL -->

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese el email" maxlength="30">
                        </div>

                        <!-- TIPO DE EMPLEADO -->

                        <div class="form-group">
                            <label for="tipo_emp">Tipo de Empleado(*):</label>
                            <select class="form-control" name="tipo_emp" id="tipo_emp">
                                <option value="VENDEDOR">Vendedor</option>
                                <option value="GERENTE">Gerente</option>
                                <option value="ADMINISTRADOR">Administrador</option>
                            </select>
                        </div>

                        <hr>

                        <!-- DATOS PARA LOGIN -->

                        <h4>Datos de acceso</h4>
                        <div class="form-group">
                            <label for="usuario">Usuario(6 a 15 caracteres)(*):</label>
                            <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Ingrese datos de usuario" maxlength="15">
                        </div>

                        <div class="form-group">
                            <label for="usuario">Contraseña(6 a 15 caracteres)(*):</label>
                            <input type="password" class="form-control" name="pass1" id="pass1" placeholder="Ingrese contraseña de (6 a 15 caracteres)" maxlength="15">
                        </div>

                        <div class="form-group">
                            <label for="usuario">Repita la contraseña(*):</label>
                            <input type="password" class="form-control" name="pass2" id="pass2" placeholder="Repita su contraseña" maxlength="15">
                        </div>

                        <hr>

                        <!-- BOTON GUARDAR -->
                        <div class="form-group form_footer">
                            <a href="empleados.php" class="btn btn-dark">
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
                                        <h5 class="modal-title" >¿Desea completar el registro?</h5>
                                    </div>
                                    
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
                                        <button type="button" id="btnguardar" class="btn btn-success" onclick='regisper()'>Guardar</button>
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
  <script src="../../recursos/libs/query.validate.js"></script>
  <script src="../../recursos/js/validaciones.js" ></script>
  <script src="../../recursos/js/empleados.js" ></script>
  
</body>
</html>
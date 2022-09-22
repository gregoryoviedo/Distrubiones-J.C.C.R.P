<!DOCTYPE html>
<html lang="es">
<head>

    <?php
        session_start();

        if($_SESSION['nombre'] == null || $_SESSION['nombre'] == ''){
            header("Location:../../mainmenu/vista/login.html");
            exit();
        }

        require('../modelos/empleados.class.php');

        $obj = new empleados;

        $id=$_GET['id'];
    
        $query = $obj->rellenar($id);

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
                    <div class="col-12">
                        <h1>Perfil de Empleado</h1>
                        <hr>
                        <?php
                            foreach ($query as $row) {
                                $nombre = $row['nombre'];
                                $apellido = $row['apellido'];
                                $cedula = $row['cedula'];
                                $telefono = $row['telefono'];
                                $email = $row['email'];
                                $usuario = $row['usuario'];
                                $cargo = $row['cargo'];
                                $foto = $row['urlfoto'];

                                if($row['eliminado']){
                                    $estado = 'DESHABILITADO';
                                }else{
                                    $estado = 'ACTIVO';
                                }
                            }
                        ?>    
                        <div class="col-12">
                        <div class="row justify-content-between">
                            <div class="col-4">
                                <a href="empleados.php" class="btn btn-dark">
                                    <i class="fas fa-caret-left"></i> Volver
                                </a>
                            </div>
                            <div class="col-4">
                                <div class="btn-group float-right">
                                    <button type="button" class="btn bg-azul-rey px-5 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Mas opciones
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right border_dropdown px-2">
                                        <button class="btn btn-primary btn-sm w-100 mt-1" data-toggle="modal" data-target="#cambiarPass">Cambiar contraseña <i class="fas fa-edit"></i></button>
                                        <button class="btn btn-info btn-sm w-100 mt-1" data-toggle="modal" data-target="#modal_pic">Cambiar foto <i class="fas fa-edit"></i></button>
                                        <?php
                                            if($_SESSION['nivel']>1){
                                                ?>
                                                <a href="modificar_emp.php?id=<?php echo $row['id_empleado'];?>" class="btn btn-warning btn-sm w-100">
                                                Modificar <i class="fas fa-edit"></i>
                                                </a>
                                                <button class="btn btn-danger btn-sm w-100 mt-1" data-toggle="modal" data-target="#verifEliminar">Eliminar <i class="fas fa-trash-alt"></i></button>
                                                <?php
                                            }                                        
                                        ?>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                            
                            <div class="card card_cusotm mt-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-lg-4">
                                            <div class="text-center contenedor_foto mt-5" style="width: 300px;height: 300px">
                                                <img src="../../recursos/img/fotos_perfil/<?php echo $foto;?>" alt="perfil">
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-8">
                                            <!-- NOMBRE Y APELLIDO -->
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="nombre">Apellido y Nombre:</label>
                                                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $apellido?>, <?php echo $nombre?>" disabled>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- CEDULA -->
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="cedula">Cedula:</label>        
                                                        <input type="text" class="form-control" id="cedula" name="cedula" value="<?php echo $cedula?>" disabled>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- cargo -->
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="cargo">Cargo:</label> <br>
                                                        <input type="text" class="form-control" id="cargo" name="cargo" value="<?php echo $cargo?>" disabled>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- usuario -->
                                            <div class="row">
                                                <div class="col-12 col-lg-6">
                                                    <div class="form-group">
                                                    <label for="usuario">Usuario:</label> <br>
                                                        <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $usuario?>" disabled>
                                                    </div>
                                                </div>
                                                <!-- ESTADO -->
                                                <div class="col-12 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="estado">Estado:</label>        
                                                        <input type="text" class="form-control" id="estado" name="estado" value="<?php echo $estado?>" disabled>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- TELEFONO -->
                                            <div class="row">
                                                <div class="col-12 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="numtel">Telefono:</label> <br>
                                                        <input type="text" class="form-control" name="telefono" id="telefono" value="<?php echo $telefono?>" disabled>
                                                    </div>
                                                </div>
                                                <!-- EMAIL -->
                                                <div class="col-12 col-lg-8">
                                                    <div class="form-group">
                                                        <label for="email">Email:</label> <br>
                                                        <input type="text" class="form-control" id="email" name="email" value="<?php echo $email?>" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                                            
                        <div class="col-12">
                            <!-- PANEL DE BOTONES -->
                            <div class="form-group form_footer">
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

           

            <!-- MODAL VERIFICAR ELIMINAR -->

            <div class="modal fade" id="verifEliminar" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" >¿Desea deshabilitar este empleado?</h5>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
                            <button type="button" id="btneliminar" class="btn btn-danger" onclick="estado_emp(<?php echo $id;?>,'eliminar')">Eliminar</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- MODAL CAMBIAR PASSWORD -->
            
            <div class="modal fade" id="cambiarPass" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" >Cambiar contraseña</h5>
                        </div>
                        <div class="modal-body">
                            <form action="#" id="form_mod_pass">
                                <div>
                                    <span class="text-danger">Los campos marcados con (*) son obligatorios</span>
                                </div>

                                <input type="hidden" name="id_empleado_pass" id="id_empleado_pass" value="<?php echo $id;?>">

                                <div class="form-group">
                                    <label for="usuario">Nueva Contraseña(6 a 15 caracteres)(*):</label>
                                    <input type="password" class="form-control" name="newpass1" id="newpass1" placeholder="Ingrese contraseña de (6 a 15 caracteres)" maxlength="15">
                                </div>

                                <div class="form-group">
                                    <label for="usuario">Repita la contraseña(*):</label>
                                    <input type="password" class="form-control" name="newpass2" id="newpass2" placeholder="Repita su contraseña" maxlength="15">
                                </div>

                                <p class="text-danger" id="mensajeError_pass"></p>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
                            <button type="button" id="btncambiarpass" class="btn btn-success" onclick="modpass()">Cambiar contraseña</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!--Modal cambiar foto-->
            <div class="modal fade" id="modal_pic" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Cambiar foto de perfil</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="form_mod_pic" action="../controlador/resp_modpic.php" method="post" enctype="multipart/form-data">
                            <div class="modal-body">

                                <input type="hidden" name="id_empleado_pic" id="id_empleado_pic" value="<?php echo $id;?>">
                                <input type="hidden" name="cedula_pic" id="cedula_pic" value="<?php echo $cedula;?>">
                                
                                <label for="imagen">Seleccionar nueva foto de perfil:</label>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">  
                                            <input type="file" class="form-control-filel" name="imagen" id="imagen" accept="image/jpg, image/jpeg, image/png" required/>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-danger" id="mensajeError_pic"></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-success">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </main>
        <!-- Contenido de la pagina" -->
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
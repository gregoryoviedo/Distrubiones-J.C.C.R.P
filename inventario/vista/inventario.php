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
  
  require("../modelo/inventario.class.php");

  $obj = new inventario;
  
  $query = $obj->lista_categoria('habilitado');
  
  ?>

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
    <!-- Contenido de la pagina  -->
    <main class="page-content pt-2">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <h1>Inventario</h1><hr>         
          </div>
          <div class="col-lg-12 pb-4">
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal_new_categoria"><i class="fas fa-plus-square"></i> Agregar Categoria</a>
            <a href="#" class="btn btn-secondary" data-toggle="modal" data-target="#modal_eliminados_categoria"><i class="fas fa-eye"></i> Ver categorias eliminadas</a>
            <a href="inventario_historial.php?busqueda=&p=1" class="btn btn-success"><i class="fas fa-history"></i> Ver Historial del Inventario</a>
            <a href="../../reportes/inventario_pdf.php" class="btn btn-warning"><i class="fas fa-file-pdf"></i> Generar PDF</a>
          </div>
          
          <!--- Listado de los elementos por las distintas categorias ---->

          <!-- inicio lista -->

          <?php

              $band = 0;
              foreach($query as $row){
                $band+=1;
                $id_categoria = $row['id_categoria'];
                $nombre_cat = $row['nombre'];
          ?>
          <div class="col-lg-12">
            <div class="accordion" id="acordeon_id_<?php echo $id_categoria;?>">
              <div class="card">
                <div class="card-header" id="headingOne">
                  <div class="col-12">
                      <div class="row">
                        <div class="col-6 col-lg-10">
                          <h2 class="mb-0">
                            <button class="btn btn-light text-left text-dark" style="width: 100%;text-decoration: none;" type="button" data-toggle="collapse" data-target="#collapseOne_id_<?php echo $id_categoria;?>" aria-expanded="true" aria-controls="collapseOne_id_<?php echo $id_categoria;?>">
                              <?php echo $nombre_cat;?>
                            </button>
                          </h2>
                        </div>
                        <div class="col-5 col-lg-2">
                        <button class="btn btn-warning" data-toggle="modal" data-target="#modal_mod_categoria"
                                    onclick="rellenar_mod_categoria(<?php echo $id_categoria;?>,'<?php echo $nombre_cat;?>')"><i class="fas fa-edit"></i></button>
                          <button class="btn btn-danger" data-toggle="modal" data-target="#modal_del_categoria" onclick="rellenar_del_categoria(<?php echo $id_categoria;?>)"><i class="fas fa-trash-alt"></i></button>
                        </div>
                      </div>
                  </div>
                </div>
                <div id="collapseOne_id_<?php echo $id_categoria;?>" class="collapse" aria-labelledby="headingOne" data-parent="#acordeon_id_<?php echo $id_categoria;?>">
                  <!-- cuerpo de la carta -->
                  <div class="card-body">
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal_new_elemento" onclick="cargardatos_newelemento(<?php echo $id_categoria;?>)" ><i class="fas fa-plus-square"></i> Agregar elemento</a>
                    <a href="#" class="btn btn-secondary" data-toggle="modal" data-target="#elementos_deshab_<?php echo $id_categoria;?>" onclick="" ><i class="fas fa-eye"></i> Ver elementos eliminados</a>
                    <hr>
                    <div style="overflow-x: auto;">
                      <table class="table">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Nombre</th>
                              <th>Cantidad</th>
                              <th>Precio</th>
                              <th>Descripcion</th>
                              <th>Modificar</th>
                              <th>Eliminar</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              $query2= $obj->lista_elemento('habilitado',$id_categoria);
                              $lista=0;
                              foreach($query2 as $row2){
                                ?>
                                <tr>
                                  <td><?php echo $lista+=1;?></td>
                                  <td><?php echo $row2['nombre'];?></td>
                                  <td><?php echo $row2['cantidad'];?></td>
                                  <td><?php echo $row2['precio'];?></td>
                                  <td><?php echo $row2['descripcion'];?></td>
                                  <td>
                                    <button class="btn btn-warning" data-toggle="modal" data-target="#modal_mod_elemento"
                                    onclick="rellenar_mod_elemento(<?php echo $row2['id_elemento'];?>, 
                                    '<?php echo $row2['nombre'];?>', 
                                    <?php echo $row2['precio'];?>, 
                                    <?php echo $row2['cantidad'];?>
                                    , '<?php echo $row2['descripcion'];?>')">
                                    modificar
                                  </button>
                                  </td>
                                  <td>
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_del_elemento"
                                    onclick="rellenar_del_elemento(<?php echo $row2['id_elemento'];?>,<?php echo $row2['cantidad'];?>)">eliminar</button>
                                  </td>
                                </tr>
                                
                                


                              <!-- FIN FOREACH ELEMENTOS-->
                                <?php
                              }

                            ?>
                          </tbody>
                      </table>

<!-- LISTA ELEMENTOS DESHABILITADOS -->
                      <div class="modal fade" id="elementos_deshab_<?php echo $id_categoria;?>" tabindex="-1" role="dialog" aria-labelledby="elementos_deshab_elementos_deshab_<?php echo $id_categoria;?>" aria-hidden="true">
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
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Habilitar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $query3=$obj->lista_elemento('deshabilitado',$id_categoria);

                                                foreach ($query3 as $row3) {
                                            ?>
                                            <tr>
                                                <td><?php echo $row3['nombre'];?></td>
                                                <td>
                                                <button class="btn btn-success" id="btnhab" onclick="hab_elemento(<?php echo $row3['id_elemento'];?>,'habilitar')">Habilitar</button>
                                                </td>
                                            </tr>
                                            <?php
                                                }
                                                $query3->closeCursor();
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
                  <!-- fin cuerpo de la carta -->
                </div>
              </div>
            </div>
          </div>




            

          <!-- FIN FOREACH CATEGORIA -->
          <?php 
          }
          
          if($band<1){
            ?>
              <div class="col-12">
                <p class="text-center">No hay registros en el inventario</p> 
              </div>
            <?php
          }
          
          ?>
          <!-- fin lista-->

          <!-- MODAL NUEVA CATEGORIA -->

          <div class="modal fade" id="modal_new_categoria" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" >Nueva Categoria</h5>
                      </div>
                      <div class="modal-body">
                          <form action="#" id="form_new_categoria">
                              <div>
                                  <span class="text-danger">Los campos marcados con (*) son obligatorios</span>
                              </div>

                              <div class="form-group">
                                  <label for="categoria">Ingrese nombre de la categoria(*):</label>
                                  <input type="text" class="form-control" name="nom_newcategoria" id="nom_newcategoria" placeholder="Ingrese el nombre de la categoria" maxlength="50">
                              </div>

                              <p class="text-danger" id="msg_error_newcategoria"></p>
                          </form>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
                          <button type="button" id="btnguardar" class="btn btn-success" onclick="new_categoria()">Guardar</button>
                      </div>
                  </div>
              </div>
          </div>

          <!-- MODAL NUEVO ELEMENTO -->

          <div class="modal fade" id="modal_new_elemento" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" >Agregar elemento</h5>
                      </div>
                      <div class="modal-body">
                          <form action="#" id="form_new_elemento">
                              <div>
                                  <span class="text-danger">Los campos marcados con (*) son obligatorios</span>
                              </div>
                              
                              <input type="hidden" name="id_cat_newelemento" id="id_cat_newelemento">

                              <div class="form-group">
                                  <label for="nom_newelemento">Ingrese nombre(*):</label>
                                  <input type="text" class="form-control" name="nom_newelemento" id="nom_newelemento" placeholder="Ingrese el nombre" maxlength="50">
                              </div>

                              <div class="form-group">
                                  <label for="precio_newelemento">Ingrese precio(*):</label>
                                  <input type="number" class="form-control" name="precio_newelemento" id="precio_newelemento" placeholder="Ingrese el precio" onkeypress="return decimales(event);">
                              </div>

                              <div class="form-group">
                                  <label for="cantidad_newelemento">Ingrese cantidad(*):</label>
                                  <input type="number" class="form-control" name="cantidad_newelemento" id="cantidad_newelemento" placeholder="Ingrese la cantidad de stock" onkeypress="return numeros(event);">
                              </div>

                              <div class="form-group">
                                  <label for="descripcion_newelemento">Ingrese descripcion:</label>
                                  <textarea class="form-control" name="descripcion_newelemento" id="descripcion_newelemento" cols="10" rows="3" placeholder="Ingrese una descripcion" maxlength="200"></textarea>
                              </div>

                              <p class="text-danger" id="msg_error_newelemento"></p>
                          </form>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
                          <button type="button" id="btnguardar" class="btn btn-success" onclick="new_elemento()">Guardar</button>
                      </div>
                  </div>
              </div>
          </div>

          <!-- MODAL MODIFICAR ELEMENTO -->

          <div class="modal fade" id="modal_mod_elemento" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" >Modificar elemento</h5>
                      </div>
                      <div class="modal-body">
                          <form action="#" id="form_mod_elemento">
                              <div>
                                  <span class="text-danger">Los campos marcados con (*) son obligatorios</span>
                              </div>
                              
                              <input type="hidden" name="id_mod_elemento" id="id_mod_elemento">

                              <div class="form-group">
                                  <label for="nom_modelemento">Ingrese nombre(*):</label>
                                  <input type="text" class="form-control" name="nom_modelemento" id="nom_modelemento" placeholder="Ingrese el nombre" maxlength="50">
                              </div>

                              <div class="form-group">
                                  <label for="precio_modelemento">Ingrese precio(*):</label>
                                  <input type="number" class="form-control" name="precio_modelemento" id="precio_modelemento" placeholder="Ingrese el precio" onkeypress="return decimales(event);">
                              </div>

                              <div class="form-group">
                                  <label for="cantidad_modelemento">Ingrese cantidad(*):</label>
                                  <input type="number" class="form-control" name="cantidad_modelemento" id="cantidad_modelemento" placeholder="Ingrese la cantidad de stock" onkeypress="return numeros(event);">
                              </div>

                              <div class="form-group">
                                  <label for="descripcion_modelemento">Ingrese descripcion:</label>
                                  <textarea class="form-control" name="descripcion_modelemento" id="descripcion_modelemento" cols="10" rows="3" placeholder="Ingrese una descripcion" maxlength="200"></textarea>
                              </div>

                              <p class="text-danger" id="msg_error_modelemento"></p>
                          </form>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
                          <button type="button" id="btnguardar" class="btn btn-success" onclick="mod_elemento()">Guardar</button>
                      </div>
                  </div>
              </div>
          </div>

          <!-- MODAL MODIFICAR CATEGORIA -->

          <div class="modal fade" id="modal_mod_categoria" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" >Modificar categoria</h5>
                      </div>
                      <div class="modal-body">
                          <form action="#" id="form_mod_categoria">
                              <div>
                                  <span class="text-danger">Los campos marcados con (*) son obligatorios</span>
                              </div>
                              
                              <input type="hidden" name="id_mod_categoria" id="id_mod_categoria">

                              <div class="form-group">
                                  <label for="nom_modcategoria">Ingrese nombre(*):</label>
                                  <input type="text" class="form-control" name="nom_modcategoria" id="nom_modcategoria" placeholder="Ingrese el nombre" maxlength="50">
                              </div>

                              <p class="text-danger" id="msg_error_modcategoria"></p>
                          </form>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
                          <button type="button" id="btnguardar" class="btn btn-success" onclick="mod_categoria()">Guardar</button>
                      </div>
                  </div>
              </div>
          </div>

          <!-- MODAL VERIFICAR ELIMINAR ELEMENTO -->

          <div class="modal fade" id="modal_del_elemento" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" >¿Desea eliminar este elemento?</h5>
                      </div>
                      
                      <input type="hidden" name="id_delelemento" id="id_delelemento">
                      <input type="hidden" name="cantidad_delelemento" id="cantidad_delelemento">

                      <!-- acomodar esto -->
                      <br>
                      <p class="text-danger" id="msg_error_delelemento"></p>
                      <br>

                      
                      <div class="modal-footer">
                          <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
                          <button type="button" id="btneliminar" class="btn btn-danger" onclick="del_elemento('eliminar')">Eliminar</button>
                      </div>
                  </div>
              </div>
          </div>

          <!-- MODAL VERIFICAR ELIMINAR CATEGORIA -->

          <div class="modal fade" id="modal_del_categoria" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" >¿Desea eliminar esta categoria?</h5>
                      </div>
                      
                      <input type="hidden" name="id_delcategoria" id="id_delcategoria">
                      <!-- acomodar esto -->
                      <br>
                      <p class="text-danger" id="msg_error_delcategoria"></p>
                      <br>

                      
                      <div class="modal-footer">
                          <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
                          <button type="button" id="btneliminar" class="btn btn-danger" onclick="del_categoria('eliminar')">Eliminar</button>
                      </div>
                  </div>
              </div>
          </div>


<!-- LISTA CATEGORIA DESHABILITADOS -->
<div class="modal fade" id="modal_eliminados_categoria" tabindex="-1" role="dialog" aria-labelledby="modal_eliminados_categoria" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="titulo_modal">Lista de categorias eliminadas</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body" style="overflow-x: auto;">
              <table class="table">
                  <thead>
                      <tr>
                      <th scope="col">Nombre</th>
                      <th scope="col">Habilitar</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php
                          $query4=$obj->lista_categoria('deshabilitado');

                          foreach ($query4 as $row) {
                      ?>
                      <tr>
                          <td><?php echo $row['nombre'];?></td>
                          <td>
                          <button class="btn btn-success" id="btnhab" onclick="hab_categoria(<?php echo $row['id_categoria'];?>,'habilitar')">Habilitar</button>
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
  <script src="../../recursos/js/inventario.js"></script>
  
</body>
</html>
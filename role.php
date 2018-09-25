<?php
  session_start();
  if(!$_SESSION['codUsuarioG'] || $_SESSION['roleG']!=1)
  {
  	header("location: login.php");
  }
  require_once "inc/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php require "inc/header.php"; ?>
</head>
<body class="app sidebar-mini rtl">
  <!-- Navbar-->
  <!-- Navbar Logo, Barra superior donde se tiene las notificaciones el buscador el boton de menu etc-->
  <?php require "inc/navbar.php"; ?>
  <!-- nav bar final -->
  <!-- Sidebar menu lateral -->
  <?php require "inc/menuLateralUsuarios.php"; ?>
  <!-- menu lateral fin -->
  <!-- contenido inicio -->
  <main class="app-content">
    <div class="app-title">
      <div>
        <h1><i class="fa fa-user"></i> Roles</h1>
        <p>Gestion de Rol</p>
      </div>
      <ul class="app-breadcrumb breadcrumb side">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item active"><a href="gerenteConsole.php">Inicio</a></li>
        <li class="breadcrumb-item">Roles</li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <span class="btn btn-primary" data-toggle="modal" data-target="#modalNuevoRole">
              Agregar nuevo <span class="fa fa-plus-circle"></span>
            </span>
            <hr>
            <!-- div donde se cargara el data table -->
            <div id="divDataTable">
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!-- crear modal para nuevo usuario -->
  <form id="wfrNuevoRole" method="post">
  <div class="modal fade" id="modalNuevoRole" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo Rol</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <label>Rol</label>
          <input type="text" class="form-control input-sm" id="txtRole" name="txtRole" required>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Nuevo Rol</button>
      </div>
    </div>
  </div>
</div>
</form>

<!-- modal para actualizar -->
<form id="wfrActualizarRole">
<div class="modal fade" id="modalEditarRole" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar Rol</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <input type="hidden" class="form-control input-sm" id="hdeCodRoleA" name="hdeCodRoleA">
          <label>Rol</label>
          <input type="text" class="form-control input-sm" id="txtRoleA" name="txtRoleA" required>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-warning" id="btnActualizar">Actualizar</button>
      </div>
    </div>
  </div>
</form>
</div>

  <!-- Essential javascripts for application to work-->
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
  <!-- script para funcionar el select con busquedas -->
  <script type="text/javascript" src="js/plugins/select2.min.js"></script>
  <!-- The javascript plugin to display page loading on top-->
  <script src="js/plugins/pace.min.js"></script>
  <!-- Page specific javascripts-->
  <!-- Data table plugin-->
  <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
  <!-- javascript para notificacionse -->
  <script type="text/javascript" src="js/plugins/bootstrap-notify.min.js"></script>
  <script type="text/javascript" src="js/plugins/sweetalert.min.js"></script>
  <!-- llamar a la data table de usuarios -->
  <script type="text/javascript">
    // cargar la datatable usuarios
    $(document).ready(function(){
      $('#divDataTable').load('inc/tablaRole.php');
    // llenar por ajax nuevo usuarios
      $(document).on("submit","#wfrNuevoRole",function(event){
        event.preventDefault();
        datos=$('#wfrNuevoRole').serialize();
        $.ajax({
          type:"POST",
          data:datos,
          url:"ajax/agregarRole.php",
          success:function(r){
            if(r==1){
              $('#wfrNuevoRole')[0].reset();
              $('#divDataTable').load('inc/tablaRole.php');
              $('#modalNuevoRole').modal('hide');
              swal({
                title: "Nuevo Rol",
                text: "Registro Exitoso!",
                icon: "success"
              });
            }else{
              swal({
                title: "Nuevo Rol",
                text: "Error en Registrar!",
                icon: "error"
              });

            }
          }
        });
       });

       //ajax actualizar
       $(document).on("submit","#wfrActualizarRole",function(event){
        event.preventDefault();
        datos=$('#wfrActualizarRole').serialize();
        $.ajax({
          type:"POST",
          data:datos,
          url:"ajax/actualizarRole.php",
          success:function(r){
            if(r==1){
              $('#modalEditarRole').modal('hide');
              swal({
                title: "Actualizar Rol",
                text: "Registro Exitoso!",
                icon: "success"
              });
              $('#divDataTable').load('inc/tablaRole.php');
            }else{
              swal({
                 title: "Actualizar Rol",
                 text: "Error en Registrar!",
                 icon: "error"
              });
            }
          }
        });
        });


      });
  </script>
  <script type="text/javascript">
    // funcion borrar usuario
    function borrarRole(cod)
    {
      swal({
        title: "Esta Seguro?",
        text: "Los Datos no Podran Recuperarse!",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "SI, Borrar!",
        cancelButtonText: "NO, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
      }, function(isConfirm) {
        if (isConfirm) {
          // llamar ajax para borrar
          $.ajax({
            type:"POST",
            data:"cod=" + cod,
            url:"ajax/eliminarRole.php",
            success:function(r){
              if(r==1){
                $('#divDataTable').load('inc/tablaRole.php');
                swal("Borrado!", "El Registro fue Eliminado.", "success");
              }else{
                swal("Error de Borrado!", "Hubo un problema con la Conexion.", "error");
              }
            }
          });
        }
      });
    }
    // funcion Actualizar
    function llenarDatos(cod)
    {
      // alert(codUsuario);
      $.ajax({
        type:"POST",
        data:"cod=" + cod,
        url:"ajax/obtenDatosRole.php",
        success:function(r){
          datos=jQuery.parseJSON(r);
          $('#hdeCodRoleA').val(datos['codRole']);
          $('#txtRoleA').val(datos['role']);
        }
      });

      $('#modalEditarRole').modal('show');
    }
  </script>
</body>
</html>

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
  <?php require "inc/menuLateral.php"; ?>
  <!-- menu lateral fin -->
  <!-- contenido inicio -->
  <main class="app-content">
    <div class="app-title">
      <div>
        <h1><i class="fa fa-user"></i> Proveedores</h1>
        <p>Gestion de Proveedores</p>
      </div>
      <ul class="app-breadcrumb breadcrumb side">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item active"><a href="gerenteConsole.php">Inicio</a></li>
        <li class="breadcrumb-item">Proveedores</li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <span class="btn btn-primary" data-toggle="modal" data-target="#modalNuevo">
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
  <form id="wfrNuevo" method="post">
  <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo Proveedor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <label>Empresa</label>
          <input type="text" class="form-control input-sm" id="txtEmpresa" name="txtEmpresa" required>
          <label>Pais</label>
          <select class="form-control" name="cmbPais" id="cmbPais">
            <?php require "inc/pais.php" ?>
          </select>
          <label>Contacto</label>
          <input type="text" class="form-control input-sm" id="txtContacto" name="txtContacto" >
          <label>Email</label>
          <input type="text" class="form-control input-sm" id="txtEmail" name="txtEmail" >
          <label>Telefono</label>
          <input type="text" class="form-control input-sm" id="txtTelefono" name="txtTelefono" >
          <label>Celular</label>
          <input type="text" class="form-control input-sm" id="txtCelular" name="txtCelular" >
          <label>Direccion</label>
          <input type="text" class="form-control input-sm" id="txtDireccion" name="txtDireccion" >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Nuevo Proveedor</button>
      </div>
    </div>
  </div>
</div>
</form>

<!-- modal para actualizar -->
<form id="wfrActualizar">
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar Proveedor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <input type="hidden" class="form-control input-sm" id="hdeCodProveedorA" name="hdeCodProveedorA">
          <label>Empresa</label>
          <input type="text" class="form-control input-sm" id="txtEmpresaA" name="txtEmpresaA" required>
          <label>Pais</label>
          <select class="form-control" name="cmbPaisA" id="cmbPaisA">
            <?php require "inc/pais.php" ?>
          </select>
          <label>Contacto</label>
          <input type="text" class="form-control input-sm" id="txtContactoA" name="txtContactoA" >
          <label>Email</label>
          <input type="text" class="form-control input-sm" id="txtEmailA" name="txtEmailA" >
          <label>Telefono</label>
          <input type="text" class="form-control input-sm" id="txtTelefonoA" name="txtTelefonoA" >
          <label>Celular</label>
          <input type="text" class="form-control input-sm" id="txtCelularA" name="txtCelularA" >
          <label>Direccion</label>
          <input type="text" class="form-control input-sm" id="txtDireccionA" name="txtDireccionA" >
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
      $('#divDataTable').load('inc/tablaProveedor.php');
    // llenar por ajax nuevo usuarios
      $(document).on("submit","#wfrNuevo",function(event){
        event.preventDefault();
        datos=$('#wfrNuevo').serialize();
        $.ajax({
          type:"POST",
          data:datos,
          url:"ajax/agregarProveedor.php",
          success:function(r){
            if(r==1){
              $('#wfrNuevo')[0].reset();
              $('#divDataTable').load('inc/tablaProveedor.php');
              $('#modalNuevo').modal('hide');
              swal({
                title: "Nuevo Proveedor",
                text: "Registro Exitoso!",
                icon: "success"
              });
            }else{
              swal({
                title: "Nuevo Proveedor",
                text: "Error en Registrar!",
                icon: "error"
              });

            }
          }
        });
       });

       //ajax actualizar
       $(document).on("submit","#wfrActualizar",function(event){
        event.preventDefault();
        datos=$('#wfrActualizar').serialize();
        $.ajax({
          type:"POST",
          data:datos,
          url:"ajax/actualizarProveedor.php",
          success:function(r){
            if(r==1){
              $('#modalEditar').modal('hide');
              swal({
                title: "Actualizar Proveedor",
                text: "Registro Exitoso!",
                icon: "success"
              });
              $('#divDataTable').load('inc/tablaProveedor.php');
            }else{
              swal({
                 title: "Actualizar Proveedor",
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
    // funcion borrar
    function borrar(cod)
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
        url:"ajax/obtenDatosProveedor.php",
        success:function(r){
          datos=jQuery.parseJSON(r);
          $('#hdeCodProveedorA').val(datos['codProveedor']);
          $('#txtEmpresaA').val(datos['empresa']);
          $('#cmbPaisA').val(datos['pais']);
          $('#txtContactoA').val(datos['contacto']);
          $('#txtEmailA').val(datos['email']);
          $('#txtTelefonoA').val(datos['tel']);
          $('#txtCelularA').val(datos['cel']);
          $('#txtDireccionA').val(datos['direccion']);
        }
      });

      $('#modalEditar').modal('show');
    }
  </script>
</body>
</html>

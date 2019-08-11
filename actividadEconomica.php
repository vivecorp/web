<?php
  session_start();
  if($_SESSION['roleG']!=0)
  {
  	header("location: login.php");
  }
  require_once "inc/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php require "inc/headerUploader.php" ?>
</head>
<body class="app sidebar-mini rtl">
  <div id="loading-screen" >
    <img src="images/spinning-circles.svg" >
  </div>
  <!-- Navbar-->
  <!-- Navbar Logo, Barra superior donde se tiene las notificaciones el buscador el boton de menu etc-->
  <?php require "inc/navbar.php"; ?>
  <!-- nav bar final -->
  <!-- Sidebar menu lateral -->
  <?php require "inc/menuLateralProductos.php"; ?>
  <!-- menu lateral fin -->
  <!-- contenido inicio -->
  <main class="app-content">
    <div class="app-title">
      <div>
        <h1><i class="fa fa-user"></i>Actividad Economica</h1>
        <p>Gestion de Actividades Economicas (Impuestos Bolivia)</p>
      </div>
      <ul class="app-breadcrumb breadcrumb side">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item active"><a href="gerenteConsole.php">Inicio</a></li>
        <li class="breadcrumb-item">Actividad Economica</li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <span class="btn btn-primary" data-toggle="modal" data-target="#modalNuevo">
              Agregar Nuevo <span class="fa fa-plus-circle"></span>
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
  <form id="wfrNuevo" name="wfrNuevo"  method="post" enctype="multipart/form-data">
  <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nueva Actividad Economica</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <label>Codigo Actividad Economica</label>
          <input type="text" class="form-control input-sm" id="txtCodigo" name="txtCodigo" required>
          <label>Actividad Economica</label>
          <input type="text" class="form-control input-sm" id="txtActividadEconomica" name="txtActividadEconomica" required>
          <label>Abreviatura</label>
          <input type="text" class="form-control input-sm" id="txtAbreviatura" name="txtAbreviatura" >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Nuevo</button>
      </div>
    </div>
  </div>
</div>
</form>

<!-- modal para actualizar -->
<form id="wfrActualizar" name="wfrActualizar" enctype="multipart/form-data" method="post">
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar Actividad Economica</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <input type="hidden" class="form-control input-sm" id="hdeCodActividadEconomicaA" name="hdeCodActividadEconomicaA">
          <label>Codigo Actividad Economica</label>
          <input type="text" class="form-control input-sm" id="txtCodigoA" name="txtCodigoA" required>
          <label>Actividad Economica</label>
          <input type="text" class="form-control input-sm" id="txtActividadEconomicaA" name="txtActividadEconomicaA" required>
          <label>Abreviatura</label>
          <input type="text" class="form-control input-sm" id="txtAbreviaturaA" name="txtAbreviaturaA">
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
  <!-- <script src="js/jquery-3.2.1.min.js"></script> -->
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
    $(document).ready(function(){
      // loader Inicio
      var screen = $('#loading-screen');
      configureLoadingScreen(screen);
      // carga del datatable
      $('#divDataTable').load('inc/tablaActividadEconomica.php');
    // llenar por ajax nuevo usuarios
      // $(document).on("submit","#wfrNuevo",function(event){
      $("#wfrNuevo").on("submit", function(event){
        event.preventDefault();
        // datos=$('#wfrNuevo').serialize();
        var f = $(this);
        var formData = new FormData(document.getElementById("wfrNuevo"));
        formData.append("dato", "valor");
        $.ajax({
          url:"ajax/agregarActividadEconomica.php",
          type:"POST",
          dataType: "html",
          data: formData,
          cache: false,
          contentType: false,
	        processData: false
        })
          // data:datos,
          .done(function(r){
            if(r==1){
              $('#wfrNuevo')[0].reset();
              $('#divDataTable').load('inc/tablaActividadEconomica.php');
              $('#modalNuevo').modal('hide');
              swal("Nueva Actividad Economica", "El Registro fue Exitoso.", "success");
            }else{
              swal("Nueva Actividad Economica", "Error de Registro:"+r, "error");
            }
          });
      });

       //ajax actualizar
       $(document).on("submit","#wfrActualizar",function(event){
        event.preventDefault();
        var f = $(this);
        var formData = new FormData(document.getElementById("wfrActualizar"));
        formData.append("dato", "valor");
        $.ajax({
          url:"ajax/actualizarActividadEconomica.php",
          type:"POST",
          dataType: "html",
          data: formData,
          cache: false,
          contentType: false,
	        processData: false
        })
        .done(function(r){
          if(r==1){
            $('#modalEditar').modal('hide');
            swal("Actualizar Actividad Economica", "El Registro fue Actualizado.", "success");
            $('#divDataTable').load('inc/tablaActividadEconomica.php');
          }else{
            swal("Actualizar Actividad Economica", "Error"+r, "error");
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
      },function(isConfirm) {
        if (isConfirm) {
          // llamar ajax para borrar
          $.ajax({
            type:"POST",
            data:"cod=" + cod,
            url:"ajax/eliminarActividadEconomica.php",
            success:function(r){
              if(r==1){
                $('#divDataTable').load('inc/tablaActividadEconomica.php');
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
        url:"ajax/obtenDatosActividadEconomica.php",
        success:function(r){
          datos=jQuery.parseJSON(r);
          $('#hdeCodActividadEconomicaA').val(datos['codActividadEconomica']);
          $('#txtCodigoA').val(datos['codigo']);
          $('#txtActividadEconomicaA').val(datos['descripcion']);
          $('#txtAbreviaturaA').val(datos['abreviatura']);
        }
      });

      $('#modalEditar').modal('show');
    }
    // loader
    function configureLoadingScreen(screen){
      $(document)
        .ajaxStart(function () {
          screen.fadeIn();
        })
        .ajaxStop(function () {
          screen.fadeOut();
        });
    }
  </script>
</body>
</html>

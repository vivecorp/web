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
  <?php require "inc/menuLateralConfig.php"; ?>
  <!-- menu lateral fin -->
  <!-- contenido inicio -->
  <main class="app-content">
    <div class="app-title">
      <div>
        <h1><i class="fa fa-cog"></i> Parametros de Empresa</h1>
        <p>Gestion de los Parametros de la Empresa</p>
      </div>
      <ul class="app-breadcrumb breadcrumb side">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item active"><a href="configConsole.php">Inicio</a></li>
        <li class="breadcrumb-item">Parametros de Empresa</li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <!-- div donde se cargara el data table -->
            <div id="divDataTable">
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!-- crear modal para nuevo usuario -->

<!-- modal para actualizar -->
<form id="wfrActualizar" enctype="multipart/form-data" method="post">
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar Parametros</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" class="form-control input-sm" id="hdeCodA" name="hdeCodA">
        <label>Empresa</label>
        <input type="text" class="form-control input-sm" id="txtEmpresaA" name="txtEmpresaA" required>
        <label>Sigla</label>
        <input type="text" class="form-control input-sm" id="txtSiglaA" name="txtSiglaA" required>

        <label>NIT</label>
        <input type="text" class="form-control input-sm" id="txtNitA" name="txtNitA" >
        <label>Direccion</label>
        <input type="text" class="form-control input-sm" id="txtDireccionA" name="txtDireccionA" >
        <label>Telefono</label>
        <input type="text" class="form-control input-sm" id="txtTelefonoA" name="txtTelefonoA" >
        <label>Celular</label>
        <input type="text" class="form-control input-sm" id="txtCelularA" name="txtCelularA" >
        <label>Email</label>
        <input type="email" class="form-control input-sm" id="txtEmailA" name="txtEmailA" >
        <label>Ciudad</label>
        <input type="text" class="form-control input-sm" id="txtCiudadA" name="txtCiudadA" >
        <label>Pais</label>
        <input type="text" class="form-control input-sm" id="txtPaisA" name="txtPaisA" >
        <label>Tipo de Cambio</label>
        <input type="number" step="any" class="form-control input-sm" id="txtTipoCambioA" name="txtTipoCambioA" >
        <label>Leyenda Consumidor</label>
        <textarea class="form-control" id="txtLeyendaConsumidorA" name="txtLeyendaConsumidorA" rows="3"></textarea>
        <label>Logo</label>
        <div id="divFotoAntiguo"></div>
        <input id="fileFotoA" name="fileFotoA" multiple="false" type="file">
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
      // uploader java
      $("#fileFotoA").fileinput({
        // uploadUrl: "/file-upload-batch/1",
        // uploadAsync: false,
        overwriteInitial: true,
        allowedFileExtensions: ['jpg', 'png', 'gif'],
        // overwriteInitial: false,
        // maxFileSize: 1000,
        // maxFilesNum: 1,
        allowedFileTypes: ['image'],
        // slugCallback: function(filename) {
        //   return filename.replace('(', '_').replace(']', '_');
        // }
        showUpload: false,
        showCancel: false
      });
      // carga del datatable
      $('#divDataTable').load('inc/tablaParametros.php');
    // llenar por ajax nuevo usuarios
      // $(document).on("submit","#wfrNuevo",function(event){

       //ajax actualizar
       $(document).on("submit","#wfrActualizar",function(event){
        event.preventDefault();
        var f = $(this);
        var formData = new FormData(document.getElementById("wfrActualizar"));
        formData.append("dato", "valor");
        $.ajax({
          url:"ajax/actualizarParametros.php",
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
            swal("Actualizar Producto", "El Registro fue Exitoso.", "success");
            $('#divDataTable').load('inc/tablaParametros.php');
          }else{
            swal("Actualizar Producto", "Error de Registro:"+r, "error");
          }
        });

      });
    });


  </script>
  <script type="text/javascript">
    // funcion borrar

    // funcion Actualizar
    function llenarDatos(cod)
    {
      // alert(codUsuario);
      $.ajax({
        type:"POST",
        data:"cod=" + cod,
        url:"ajax/obtenDatosParametros.php",
        success:function(r){
          datos=jQuery.parseJSON(r);
          $('#hdeCodA').val(datos['codParametro']);
          $('#txtEmpresaA').val(datos['empresa']);
          $('#txtSiglaA').val(datos['sigla']);
          $('#txtNitA').val(datos['nit']);
          $('#txtDireccionA').val(datos['direccion']);
          $('#txtTelefonoA').val(datos['telefono']);
          $('#txtCelularA').val(datos['celular']);
          $('#txtEmailA').val(datos['email']);
          $('#txtCiudadA').val(datos['ciudad']);
          $('#txtPaisA').val(datos['pais']);
          $('#txtTipoCambioA').val(datos['tipoCambio']);
          $('#txtLeyendaConsumidorA').val(datos['leyendaConsumidor']);

          $('#divFotoAntiguo').html("<img class='img-fluid' width='150px' src='images/"+datos['logo']+"' >");
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

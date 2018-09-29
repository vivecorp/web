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
        <h1><i class="fa fa-user"></i> Lineas Empresarial</h1>
        <p>Gestion de Lineas Empresarial</p>
      </div>
      <ul class="app-breadcrumb breadcrumb side">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item active"><a href="gerenteConsole.php">Inicio</a></li>
        <li class="breadcrumb-item">Lineas Empresarial</li>
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
        <h5 class="modal-title" id="exampleModalLabel">Nueva Linea Empresarial</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <label>Linea Empresa</label>
          <input type="text" class="form-control input-sm" id="txtLineaEmpresa" name="txtLineaEmpresa" required>
          <label>Logo</label>
          <input id="fileLogo" name="fileLogo" multiple="false" type="file">
          <!-- <input id="foto" name="foto" class="file-loading" type="file" multiple="false" align="center"> -->
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
<form id="wfrActualizar" enctype="multipart/form-data" method="post">
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar Linea Empresarial</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <input type="hidden" class="form-control input-sm" id="hdeCodLineaEmpresaA" name="hdeCodLineaEmpresaA">
          <label>Linea Empresa</label>
          <input type="text" class="form-control input-sm" id="txtLineaEmpresaA" name="txtLineaEmpresaA" required>
          <label>Logo</label>
          <div id="divLogoAntiguo"></div>
          <input id="fileLogoA" name="fileLogoA" multiple="false" type="file">
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

  <script>


      // $("#foto").fileinput({
      //   // uploadUrl: 'upload.php', // you must set a valid URL here else you will get an error
      //   // allowedFileExtensions: ['jpg', 'png', 'gif'],
      //   // overwriteInitial: false,
      //   // maxFileSize: 1000,
      //   // maxFilesNum: 1,
      //   // allowedFileTypes: ['image'],
      //   width: '20px',
      //   resizeImage: true,
      //   maxImageWidth: 1000,
      //   maxImageHeight: 1000,
      //   resizePreference: 'width'
      //   // slugCallback: function(filename) {
      //   //   return filename.replace('(', '_').replace(']', '_');
      //   // }
      //   // showUpload: false
      // });
    </script>

  <!-- llamar a la data table de usuarios -->
  <script type="text/javascript">
    $(document).ready(function(){
      // loader Inicio
      var screen = $('#loading-screen');
      configureLoadingScreen(screen);
      // uploader java
      $("#fileLogo").fileinput({
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
      $("#fileLogoA").fileinput({
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
      $('#divDataTable').load('inc/tablaLineaEmpresa.php');
    // llenar por ajax nuevo usuarios
      // $(document).on("submit","#wfrNuevo",function(event){
      $("#wfrNuevo").on("submit", function(event){
        event.preventDefault();
        // datos=$('#wfrNuevo').serialize();
        var f = $(this);
        var formData = new FormData(document.getElementById("wfrNuevo"));
        formData.append("dato", "valor");
        $.ajax({
          url:"ajax/agregarLineaEmpresa.php",
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
              $('#divDataTable').load('inc/tablaLineaEmpresa.php');
              $('#modalNuevo').modal('hide');
              swal({
                title: "Nueva Linea Empresarial",
                text: "Registro Exitoso!",
                icon: "success"
              });
            }else{
              swal({
                title: "Nueva Linea Empresarial",
                text: r,
                icon: "error"
              });
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
          url:"ajax/actualizarLineaEmpresa.php",
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
            swal({
              title: "Actualizar Linea Empresarial",
              text: "Registro Exitoso!",
              icon: "success"
            });
            $('#divDataTable').load('inc/tablaLineaEmpresa.php');
          }else{
            swal({
               title: "Actualizar Linea Empresarial",
               text: "Error en Registrar!",
               icon: "error"
            });
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
            url:"ajax/eliminarLineaEmpresa.php",
            success:function(r){
              if(r==1){
                $('#divDataTable').load('inc/tablaLineaEmpresa.php');
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
        url:"ajax/obtenDatosLineaEmpresa.php",
        success:function(r){
          datos=jQuery.parseJSON(r);
          $('#hdeCodLineaEmpresaA').val(datos['codLineaEmpresa']);
          $('#txtLineaEmpresaA').val(datos['linea']);
          $('#divLogoAntiguo').html("<img class='img-fluid' src='logos/"+datos['logo']+"' >");
          // $('#divLogoAntiguo').html("<img class='img-fluid' src='logos/1logo.jpg' >");
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

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
        <h1><i class="fa fa-user"></i> Producto</h1>
        <p>Gestion de Productos</p>
      </div>
      <ul class="app-breadcrumb breadcrumb side">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item active"><a href="gerenteConsole.php">Inicio</a></li>
        <li class="breadcrumb-item">Productos</li>
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

      // carga del datatable
      // $('#divDataTable').load('inc/tablaComprasPendientePago.php');
    // llenar por ajax nuevo usuarios
      // $(document).on("submit","#wfrNuevo",function(event){



    });


  </script>
  <script type="text/javascript">
    // funcion borrar

    // funcion Actualizar

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

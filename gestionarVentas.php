<?php
  session_start();
  if(!$_SESSION['codUsuarioG'] || $_SESSION['roleG']==3)
  {
    header("location: login.php");
  }
  require_once "inc/config.php";
  require "inc/obtener.php";

  if($_SESSION['roleG']==1)
  {
    $menu="inc/menuLateralVentas.php";
    $inicio="gerenteConsole.php";
  }
  if($_SESSION['roleG']==2)
  {
    $menu="inc/menuLateralVentas2.php";
    $inicio="ventasConsole.php";
  }
  
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require "inc/headerUploader.php" ?>
  </head>
  <body class="app sidebar-mini rtl">
    <!-- Navbar-->
    <!-- Navbar Logo, Barra superior donde se tiene las notificaciones el buscador el boton de menu etc-->
    <?php require "inc/navbar.php"; ?>
    <!-- nav bar final -->
    <!-- Sidebar menu lateral -->
    <?php require $menu; ?>
    <!-- menu lateral fin -->
    <!-- contenido inicio -->
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-list"></i> Ventas</h1>
          <p>Gestion de Ventas</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item active"><a href="<?php echo $inicio; ?>">Inicio</a></li>
          <li class="breadcrumb-item">Gestion de Ventas</li>
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

  <!-- modal para actualizar -->


    <!-- Essential javascripts for application to work-->
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
        var screen = $('#loading-screen');
        configureLoadingScreen(screen);
        // cargar el controlador de las fotos

    		$('#divDataTable').load('inc/tablaGestionarVentas.php');
         //ajax actualizar
      });
    </script>
    <script type="text/javascript">
      // imprimir nota de venta
      function imprimir(cod)
      {
        swal("Impresion de Nota de Venta!", "Prepare la Impresora.", "warning");
        window.open("impresionNotaVenta.php?codVentas="+cod);
      }
      // imprimir Factura
      function imprimirFactura(cod)
      {
        window.open("impresionFactura.php?codVentas="+cod);
      }
      // funcion Actualizar
      function actualizar(cod,cont,codCliente)
      {
        location.href = "actualizarVentas.php?cod="+cod+"&cont="+cont+"&codCliente="+codCliente;
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

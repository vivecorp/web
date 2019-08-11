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
  <?php require "inc/menuLateralReportesInventario.php"; ?>
  <!-- menu lateral fin -->
  <!-- contenido inicio -->
  <form class="" id="wfrReporte" name="wfrReporte"  method="post">


  <main class="app-content">
    <div class="app-title">
      <div>
        <h1><i class="fa fa-newspaper-o"></i> Reportes</h1>
        <p>Reporte de Existencias</p>
      </div>
      <ul class="app-breadcrumb breadcrumb side">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item active"><a href="gerenteConsole.php">Inicio</a></li>
        <li class="breadcrumb-item">Reporte de Existencias</li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="tile" style="height: 95%;">
          <div class="tile-body">
            <h3 class="tile-title">Producto</h3>
            <br>
            <div class="animated-radio-button">
              <label>
                <input type="radio" name="rdoProducto" id="rdoTodos" value="todos" checked><span class="label-text">Todos</span>
              </label>
            </div>
            <br>
            <div class="animated-radio-button">
              <label>
                <input type="radio" name="rdoProducto" id="rdoElegir" value="elegir"><span class="label-text">Elegir Producto...</span>
              </label>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="tile" style="height: 95%;">
          <div class="tile-body">

          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="tile " style="height: 95%;">
          <div class="tile-body">
            <h3 class="tile-title">Tipo de Reporte</h3>
            <br>
            <div class="animated-radio-button">
              <label>
                <input type="radio" name="rdoTipoReporte" id="rdoExcel" value="excel" checked><span class="label-text">Excel</span>
              </label>
            </div>
            <br>
            <div class="animated-radio-button">
              <label>
                <input type="radio" name="rdoTipoReporte" id="rdoPdf" value="pdf"><span class="label-text">PDF</span>
              </label>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <p align='center'><button type="submit" class="btn btn-primary" id="btnRegistrar">Generar Reporte</button></p>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!-- crear modal para nuevo usuario -->
  </form>
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
      // reenviar al tipo de reporte inicio
      $(document).on("submit","#wfrReporte",function(event){
        event.preventDefault();
        op=$('input:radio[name=rdoTipoReporte]:checked').val();
        if (op == "excel") {
          $('#wfrReporte').get(0).setAttribute('action', 'reporteExistenciasExcel.php');
        }
        if (op == "pdf") {
          // $('#wfrReporte').prop('action', 'reporteVentasProductoExcel.php');
          $('#wfrReporte').get(0).setAttribute('action', 'reporteExistenciasPdf.php');

        }
        $( "#wfrReporte" ).get(0).submit();
      });
      // reenviar al tipo de reporte fin
    // llenar por ajax nuevo usuarios

       // capturar el click del radio button
      $("input[name=rdoTipo]").click(function () {
        opt=$(this).val();
        if (opt == "cliente") {
          $("#labelTipo").text("Datos Cliente");
          $("#labelTipoOpcion").text("Cliente: ");
          $('#divTipo').load('inc/cmbClienteReporte.php');
        }
        if (opt == "producto") {
          // $("#labelTipo").text("Datos Producto");
          $("#labelTipo").text("Datos Producto");
          $("#labelTipoOpcion").text("Producto: ");
          // $('#divTipo').text("");
          $('#divTipo').load('inc/cmbProducto.php');
        }
      });
    });
  </script>
  <script type="text/javascript">
    // funcion borrar usuario

  </script>
</body>
</html>

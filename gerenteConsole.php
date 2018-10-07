<?php
session_start();
if(!$_SESSION['codUsuarioG'] || $_SESSION['role'] =! 1)
{
  header("location: login.php");
}

?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <?php require "inc/header.php"; ?>
  </head>
  <body class="app sidebar-mini rtl">
    <!-- Navbar Logo, Barra superior donde se tiene las notificaciones el buscador el boton de menu etc-->
    <?php require "inc/navbar.php"; ?>
    <!-- nav bar final -->
    <!-- Sidebar menu lateral -->
    <?php require "inc/menuLateral.php"; ?>
    <!-- menu lateral fin -->
    <!-- contenido inicio -->
    <main class="app-content">
      <!-- titulo inicio -->
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="gerenteConsole.php">Dashboard</a></li>
        </ul>
      </div>
      <!-- titulo final -->
      <!-- contenido inicio -->
        <!-- linea de espacio para crear contenido -->
      <div class="row">
        <div class="col-md-6" >
          <div class="tile" style="height:350px;" >
            <h3 class="tile-title">Cuentas por Pagar</h3>
            <!-- llenar el contenido de la tarjeta -->
            <div id="divCuentasPagar"></div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="tile" style="height:350px;">
            <h3 class="tile-title">Compras por Almacenar</h3>
            <!-- llenar contenido de la tarjeta -->
            <div id="divPendienteAlmacen"></div>
          </div>
        </div>
      </div>
      <!-- linea para contenido final -->
      <!-- line para graficos inicio-->
      <div class="row">
        <div class="col-md-6">
          <div class="tile">
            <h3 class="tile-title">Ventas Mensuales</h3>
            <div class="embed-responsive embed-responsive-16by9">
              <canvas class="embed-responsive-item" id="lineChartDemo"></canvas>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="tile">
            <h3 class="tile-title">Datos de Ventas por Area</h3>
            <div class="embed-responsive embed-responsive-16by9">
              <canvas class="embed-responsive-item" id="pieChartDemo"></canvas>
            </div>
          </div>
        </div>
      </div>
      <!-- linea para graficos final -->
    </main>
    <!-- Essential javascripts for application to work-->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
    <script type="text/javascript" src="js/plugins/chart.js"></script>
    <script type="text/javascript">
      var data = {
      	labels: ["January", "February", "March", "April", "May"],
      	datasets: [
      		{
      			label: "My First dataset",
      			fillColor: "rgba(220,220,220,0.2)",
      			strokeColor: "rgba(220,220,220,1)",
      			pointColor: "rgba(220,220,220,1)",
      			pointStrokeColor: "#fff",
      			pointHighlightFill: "#fff",
      			pointHighlightStroke: "rgba(220,220,220,1)",
      			data: [65, 59, 80, 81, 56]
      		},
      		{
      			label: "My Second dataset",
      			fillColor: "rgba(151,187,205,0.2)",
      			strokeColor: "rgba(151,187,205,1)",
      			pointColor: "rgba(151,187,205,1)",
      			pointStrokeColor: "#fff",
      			pointHighlightFill: "#fff",
      			pointHighlightStroke: "rgba(151,187,205,1)",
      			data: [28, 48, 40, 19, 86]
      		}
      	]
      };
      var pdata = [
      	{
      		value: 300,
      		color: "#46BFBD",
      		highlight: "#5AD3D1",
      		label: "Complete"
      	},
      	{
      		value: 50,
      		color:"#F7464A",
      		highlight: "#FF5A5E",
      		label: "In-Progress"
      	}
      ]

      var ctxl = $("#lineChartDemo").get(0).getContext("2d");
      var lineChart = new Chart(ctxl).Line(data);

      var ctxp = $("#pieChartDemo").get(0).getContext("2d");
      var pieChart = new Chart(ctxp).Pie(pdata);
    </script>
    <!-- Google analytics script-->
    <script type="text/javascript">
      
    </script>
  </body>
</html>

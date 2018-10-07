<?php
  session_start();
  if(!$_SESSION['codUsuarioG'] || $_SESSION['roleG']!=1)
  {
  	header("location: login.php");
  }
  require_once "inc/config.php";
  require "inc/obtener.php";

  $codUsuario=$_SESSION['codUsuarioG'];
  // recibir datos post
  $codCompras=$_POST['txtCodCompras'];
  $fecha=$_POST['txtFecha'];
  $proveedor=$_POST['cmbproveedor'];
  $observaciones=$_POST['areaObservaciones'];
  $total=$_POST['txtTotal'];
  $queryI="insert into compras values($codCompras,
                                     '$fecha',
                                     '$observaciones',
                                     $total,
                                     $proveedor,
                                     $codUsuario,
                                     1,
                                     1
                                    )";
  $insertar=$con->exec($queryI);
  $producto=$_POST['hdeP'];
  $cantidad=$_POST['txtC'];
  $precio=$_POST['txtP'];
  $descuento=$_POST['txtD'];
  $subtotal=$_POST['txtS'];

  for ( $e = 0; $e < count ($cantidad); $e++ )
  {
    $codigo=obtenerUltimo("detallecompras","codDetalleCompras");
    $q="insert into detallecompras values($codigo,
                                          $precio[$e],
                                          $cantidad[$e],
                                          $descuento[$e],
                                          $subtotal[$e],
                                          1,
                                          $codCompras,
                                          $producto[$e]
                                          )";
    $insertarDetalle=$con->exec($q);
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php require "inc/headerUploader.php" ?>
</head>
<body class="app sidebar-mini rtl" onload="imprimir()">
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
        <h1><i class="fa fa-user"></i> Orden de Compra</h1>
        <p>Impresion de Orden de Compra</p>
      </div>
      <ul class="app-breadcrumb breadcrumb side">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item active"><a href="gerenteConsole.php">Inicio</a></li>
        <li class="breadcrumb-item active"><a href="compras.php">Compras</a></li>
        <li class="breadcrumb-item">Impresion Orden de Compra</li>
      </ul>
    </div>

    <div class="page-error tile">
      <div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
						<h2 class="modal-title">COMPRA REGISTRADA</h2>
					</div>
				  <div class="modal-body">
            <?php


             ?>
					  <p>Desea Volver a Imprimir los Registros</p>
            <p>Re - Imprimir Orden de Compra <button type="button" class="btn btn-primary" onClick="imprimir()">Imprimir</button></p>
				  </div>
				  <div class="modal-footer">
					  <button type="button" class="btn btn-default" data-dismiss="modal" onClick="volver()">Volver</button>
				  </div>
			  </div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
    </div>
  </main>
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
    });
  </script>
  <script type="text/javascript">
    function volver()
    {
      location.href = "compras.php";
    }

    function imprimir()
		{

				var cod="<?php echo $codCompras; ?>";
				//window.open("impresionVentas.php");
        alert("Se Realizara la Impresion de la Orden de Compra");
				window.open("impresionOrdenCompraPdf.php?codCompras="+cod);
		}
  </script>
</body>
</html>

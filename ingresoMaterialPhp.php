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
  $codDetalleCompras=$_POST['hdeCodDetalleCompras'];
  $fecha=$_POST['txtFecha'];
  $cantidad=$_POST['txtCantidad'];
  $codProducto=$_POST['hdeCodProducto'];
  $codAlmacen=$_POST['cmbAlmacen'];
  $codTipoMovimiento=1;
  $codEstadoMaterial=$_POST['cmbEstadoMaterial'];
  // estado para actualizar en detallescompras
  $estado=$_POST['hdeEstado'];

  // // obtener ultimo codigo de inventario
  $codInventario=obtenerUltimo("inventario","codInventario");
  $queryI="insert into inventario values($codInventario,
                                     '$fecha',
                                     $cantidad,
                                     $codDetalleCompras,
                                     null,
                                     $codProducto,
                                     $codAlmacen,
                                     $codTipoMovimiento,
                                     $codEstadoMaterial,
                                     $codUsuario
                                    )";
  $insertar=$con->exec($queryI);
  // // actualizar estado
  $queryA="UPDATE detallecompras set
                    codEstadoInventario=$estado
					where codDetalleCompras=$codDetalleCompras";
  $actualizar=$con->exec($queryA);
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
  <?php require "inc/menuLateralInventario.php"; ?>
  <!-- menu lateral fin -->
  <!-- contenido inicio -->
  <main class="app-content">
    <div class="app-title">
      <div>
        <h1><i class="fa fa-user"></i>Comprobante Ingreso Material</h1>
        <p>Impresion Comprobante Ingreso Material</p>
      </div>
      <ul class="app-breadcrumb breadcrumb side">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item active"><a href="gerenteConsole.php">Inicio</a></li>
        <li class="breadcrumb-item active"><a href="ingresoMaterial.php">Ingreso Material</a></li>
        <li class="breadcrumb-item">Impresion Comprobante Ingreso Material</li>
      </ul>
    </div>

    <div class="page-error tile">
      <div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
						<h2 class="modal-title">INGRESO MATERIAL</h2>
					</div>
				  <div class="modal-body">
            <?php
             ?>
					  <p>Desea Volver a Imprimir los Registros</p>
            <p>Re - Imprimir Comprobante Ingreso Material <button type="button" class="btn btn-primary" onClick="imprimir()">Imprimir</button></p>
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
      location.href = "ingresoMaterial.php";
    }

    function imprimir()
		{

				var cod="<?php echo $codInventario; ?>";
        alert("Se Imprimira el Comprobante de Ingreso de Material");
				window.open("impresionIngresoMaterialPdf.php?codInventario="+cod);
		}
  </script>
</body>
</html>

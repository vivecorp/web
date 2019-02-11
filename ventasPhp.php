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
  $codVentas=$_POST['txtCodVentas'];
  $fecha=$_POST['txtFecha'];
  $total=$_POST['txtTotal'];
  $dsctTotal=$_POST['txtDsctTotal'];
  $codCliente=$_POST['cmbcliente'];
  $razonSocial=$_POST['txtRazonSocial'];
  $nit=$_POST['txtNit'];
  $formaPago=$_POST['cmbformapago'];
  if($formaPago==1)
  {
    $plazo=null;
    $codEstadoPago=2;
  }
  else {
    $plazo=$_POST['txtPlazo'];
    $codEstadoPago=1;
  }
  $codAlmacen=$_POST['hdeAlmacen'];
  $codTipoMovimiento=2;
  // registrar la tabla ventas
  $queryI="insert into ventas values($codVentas,
                                     '$fecha',
                                     $total,
                                     $dsctTotal,
                                     $codCliente,
                                     '$razonSocial',
                                     '$nit',
                                     0,
                                     $codEstadoPago,
                                     $formaPago,
                                     $codUsuario
                                    )";

  $insertar=$con->exec($queryI);

  // obtener datos para detalle ventas
  $producto=$_POST['hdeP'];
  $cantidad=$_POST['txtC'];
  $precio=$_POST['txtP'];
  $descuento=$_POST['txtD'];
  $subtotal=$_POST['txtS'];
  // $aux="";
  for ( $e = 0; $e < count ($cantidad); $e++ )
  {
    $codigo=obtenerUltimo("detalleventas","codDetalleVentas");
    $desc=$descuento[$e];
    if(!$desc)
    {
      $desc=0;
    }
    $q="insert into detalleventas values($codigo,
                                          $precio[$e],
                                          $cantidad[$e],
                                          $desc,
                                          $subtotal[$e],
                                          $codVentas,
                                          $producto[$e]
                                          )";
    $insertarDetalle=$con->exec($q);
    // $aux=$aux."|".$q;
    // obtener datos para el inventario
    // // obtener ultimo codigo de inventario
    $codEstadoMaterial=1;
    $cantidadI=$cantidad[$e] * (-1);
    $codInventario=obtenerUltimo("inventario","codInventario");
    $queryIn="insert into inventario values($codInventario,
                                       '$fecha',
                                       $cantidadI,
                                       null,
                                       $codigo,
                                       $producto[$e],
                                       $codAlmacen,
                                       $codTipoMovimiento,
                                       $codEstadoMaterial,
                                       $codUsuario
                                      )";
    $insertar=$con->exec($queryIn);
    // obtener datos para el inventario fin
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php require "inc/headerUploader.php" ?>
</head>
<body class="app sidebar-mini rtl" >
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
						<h2 class="modal-title">VENTA REGISTRADA</h2>
					</div>
				  <div class="modal-body">
            <?php
              // echo $aux;
              // echo $queryIn;
              // echo $codAlmacen;
             ?>
					  <p>Impresion de los Registros</p>
            <p>Imprimir Orden de Venta <button type="button" class="btn btn-primary" onClick="imprimir()">Imprimir</button></p>
            <p>Imprimir Factura <button type="button" class="btn btn-primary" onClick="imprimirFactura()">Imprimir</button></p>
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
      location.href = "ventas.php";
    }

    function imprimir()
		{

				var cod="<?php echo $codVentas; ?>";
				// window.open("impresionVentas.php");
        alert("Se Realizara la Impresion de la Orden de Venta");
				window.open("impresionOrdenVentaPdf.php?codVentas="+cod);
		}
    function imprimirFactura()
    {
      codVentas="<?php echo $codVentas; ?>";
      $.ajax({
        type:"POST",
        data:"codVentas=" + codVentas,
        url:"ajax/generarFactura.php"
      }).done( function(r) {

          datos=jQuery.parseJSON(r);
          if(typeof datos['codFactura'] == "string" )
          {
            alert(datos['codFactura']);

          }
          else {
            alert("es entero " + datos['codFactura']);

          }

        }).fail( function(r) {

          alert( 'Error!!' );

      });
    }
  </script>
</body>
</html>

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
  $codVentas=$_GET['codVentas'];
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
        <h1><i class="fa fa-user"></i>Impresion Venta</h1>
        <p>Area de Impresion de Ventas</p>
      </div>
      <ul class="app-breadcrumb breadcrumb side">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item active"><a href="gerenteConsole.php">Inicio</a></li>
        <li class="breadcrumb-item active"><a href="ventas.php">Ventas</a></li>
        <li class="breadcrumb-item">Area Impresion Ventas </li>
      </ul>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="bs-component" id="divAlerta">

        </div>
      </div>
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
            <p>Imprimir Nota de Venta <button type="button" class="btn btn-primary" onClick="imprimir()">Imprimir</button></p>
            <p>Imprimir Factura <button type="button" id="btnFactura" class="btn btn-primary" onClick="imprimirFactura()">Imprimir</button></p>
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
      // obtener alertas
      cod="<?php echo $codUsuarioG; ?>";

      $.ajax({
        type:"POST",
        data:"cod=" + cod,
        url:"ajax/obtenAlertas.php",
        success:function(r){
          datos=jQuery.parseJSON(r);
          // $('#lblUsuario').text(datos['nombre']+ "(" + datos['usuario'] + ")" );
          // $('#cmbDosificacionA').val(datos['codDosificacion']);
          // $('#cmbSucursalA').val(datos['codPuntoVenta']);
          // alert(datos['fechaLimite']);
          // alert(datos['actual']);
          // alert(datos['diferencia']);
          // alert(datos['invert']);

          tipoMsg=datos['tipoMsg'];
          msg="<div class='alert alert-dismissible alert-"+tipoMsg+"'><button class='close' type='button' data-dismiss='alert'>×</button><h4>Alerta!</h4><p>"+datos['mensaje']+"</p></div>";
          if (datos['mostrar']==1) {
            $('#divAlerta').html(msg);
            if(tipoMsg=='danger')
            {
              $('#btnFactura').prop("disabled", true);
            }


          }

        }
      });
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
        swal("Impresion","Se Realizara la Impresion de la Nota de Venta","warning");

				window.open("impresionNotaVenta.php?codVentas="+cod);
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

          if(datos['opt'] == 1)
          {
            swal("Impresion","Se realizara la impresion de la FACTURA","warning");
            window.open("impresionFactura.php?codVentas="+datos['codVentas']);
          }else {
            swal("Impresion",datos['codFactura'],"error");
          }

        }).fail( function(r) {

          alert( 'Error!!' );

      });
    }
  </script>
</body>
</html>

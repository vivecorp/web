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
    <img src="images/spinning-circles.svg">
  </div>
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
        <h1><i class="fa fa-user"></i> Existencias</h1>
        <p>Ver Existencias de Productos</p>
      </div>
      <ul class="app-breadcrumb breadcrumb side">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item active"><a href="gerenteConsole.php">Inicio</a></li>
        <li class="breadcrumb-item">Existencias de Producto</li>
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
  <form id="wfrNuevo" name="wfrNuevo"  method="post" enctype="multipart/form-data" action="ingresoMaterialPhp.php">
  <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ingreso Material</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <img id="imgFoto" src="" width="40">  <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" class="form-control input-sm" readonly name="hdeEstado" id="hdeEstado" value="">
        <input type="hidden" class="form-control input-sm" readonly name="hdeCodProducto" id="hdeCodProducto" value="">
        <label>Codigo Detalle Compras</label>
        <input type="text" class="form-control input-sm" readonly name="hdeCodDetalleCompras" id="hdeCodDetalleCompras" value="">
        <label>Articulo</label>
        <input type="text" class="form-control input-sm" readonly name="txtArticulo" id="txtArticulo" value="">
        <label>Producto</label>
        <input type="text" class="form-control input-sm" readonly id="txtProducto" name="txtProducto" required>
        <label>Pendiente de Recepcion</label>
        <input type="text" class="form-control input-sm" readonly id="txtPendiente" name="txtPendiente" required>
        <label id="">Fecha de Recepcion</label>
        <input type="date" class="form-control input-sm" id="txtFecha" name="txtFecha" required>
        <label id="">Cantidad</label>
        <input type="number" step="any" class="form-control input-sm" id="txtCantidad" name="txtCantidad" required>
        <label id="">Almacen</label>
        <?php require "inc/cmbAlmacen.php" ?>
        <label id="">Estado de Material</label>
        <?php require "inc/cmbEstadoMaterial.php" ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Ingreso Material</button>
      </div>
    </div>
  </div>
  </div>
</form>

<!-- modal para ver existencias en almacenes-->
<div class="modal fade" id="modalVer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Existencias por Almacen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <img id="imgFotoA" src="" width="40">  <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label><h5>Articulo: </h5></label>
        <label><h5><div id="divArticulo"></div></h5></label>
        <br>
        <label><h5>Producto: </h5></label>
        <label><h5><div id="divProducto"></div></h5></label>

        <div id="divAlmacen"></div>
      </div>
      <div class="modal-footer">
        <h5><div id="divCantidad"></div></h5>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


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
      // carga del datatable
      $('#divDataTable').load('inc/tablaExistencias.php');
      // capturar el envio del formulario
    });


  </script>
  <script type="text/javascript">
    // funcion borrar
    // loader
    function verAlmacen(codProducto,cantidad)
    {
      $.ajax({
        type:"POST",
        data:"cod=" + codProducto,
        url:"ajax/obtenDatosProducto.php",
        success:function(r){
          datos=jQuery.parseJSON(r);
          $('#imgFotoA').attr("src","productos/"+datos['foto']);
          $('#divArticulo').text(datos['articulo']);
          $('#divProducto').text(datos['descripcion']);
          //
          // $('#hdeCodProductoA').val(datos['codProducto']);
          // $('#txtArticuloA').val(datos['articulo']);
          // $('#txtDescripcionA').val(datos['descripcion']);
          // $('#txtCodigoBarraA').val(datos['codigoBarra']);
          // $('#cmbUnidadMedidaA').val(datos['codUnidadMedida']);
          // $('#cmbLineaEmpresaA').val(datos['codLineaEmpresa']);
          // $('#cmbActividadEconomicaA').val(datos['codActividadEconomica']);
          // $('#divLogoAntiguo').html("<img class='img-fluid' src='logos/1logo.jpg' >");
        }
      });
      $('#divAlmacen').load('inc/tablaExistenciasAlmacen.php?codProducto='+codProducto);
      $('#divCantidad').text("Total: "+cantidad);
      $('#modalVer').modal('show');
    }
    
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

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
  <?php require "inc/menuLateralPagos.php"; ?>

  <!-- menu lateral fin -->
  <!-- contenido inicio -->
  <main class="app-content">
    <div class="app-title">
      <div>
        <h1><i class="fa fa-user"></i> Pagos</h1>
        <p>Compras Pendiente de Pagos</p>
      </div>
      <ul class="app-breadcrumb breadcrumb side">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item active"><a href="gerenteConsole.php">Inicio</a></li>
        <li class="breadcrumb-item">Pagos Pendientes</li>
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
  <form id="wfrNuevo" name="wfrNuevo"  method="post" enctype="multipart/form-data" action="pagosPhp.php">
  <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo Pago</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="text" class="form-control input-sm" readonly name="hdeEstado" id="hdeEstado" >
        <label>Codigo Compra</label>
        <input type="text" class="form-control input-sm" readonly name="hdeCodCompras" id="hdeCodCompras" value="">
        <label>Pendiente de Pago (Bs)</label>
        <input type="number" class="form-control input-sm" readonly name="txtPendiente" id="txtPendiente" value="">
        <label>Fecha</label>
        <input type="date" class="form-control input-sm" id="txtFecha" name="txtFecha" required>
        <label>Tipo de Pago</label>
        <?php require "inc/cmbTipoPago.php" ?>
        <label id="labelBanco">Banco</label>
        <?php require "inc/cmbBancos.php" ?>
        <label id="labelComprobante">Comprobante</label>
        <input type="text" class="form-control input-sm" id="txtComprobante" name="txtComprobante" value="0" required>
        <label id="labelMonto">Monto</label>
        <input type="number" step="any" class="form-control input-sm" id="txtMonto" name="txtMonto" required>
        <label id="labelGlosa">Concepto</label>
        <textarea class="form-control" id="areaGlosa" name="areaGlosa" rows="2" style="margin-top: 0px; margin-bottom: 0px; height: 100px;"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Nuevo Pago</button>
      </div>
    </div>
  </div>
</div>
</form>

<!-- modal para actualizar -->
<form id="wfrActualizar" enctype="multipart/form-data" method="post">
<div class="modal fade" id="modalVer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ver Pagos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
  <!-- llamar a la data table de usuarios -->
  <script type="text/javascript">
    $(document).ready(function(){
      // ocultar imputs por defecto hasta que se elija un tipo de pago
      $('#labelBanco').hide();
      $('#cmbBancos').hide();
      $('#labelComprobante').hide();
      $('#txtComprobante').hide();
      $('#labelMonto').hide();
      $('#txtMonto').hide();
      $('#labelGlosa').hide();
      $('#areaGlosa').hide();

      // loader Inicio
      var screen = $('#loading-screen');
      configureLoadingScreen(screen);
      // carga del datatable
      $('#divDataTable').load('inc/tablaComprasPendientePago.php');
      // capturar el envio del formulario
       $("#wfrNuevo").submit(function(event) {
        event.preventDefault();
        pend=parseFloat($('#txtPendiente').val());
        mon=parseFloat($('#txtMonto').val());
        if(mon>pend)
        {
          exce=mon-pend;
          swal({
            title: "Precaucion",
            text: "El Monto de Pago excede en "+exce+" Bs Desea Continuar?",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "SI, Registrar!",
            cancelButtonText: "NO, cancelar!",
            closeOnConfirm: false,
            closeOnCancel: true
          },function(isConfirm) {
            if (isConfirm) {
              $('#hdeEstado').val("3");
              $('#wfrNuevo')[0].submit();
            }
          });
        }
        if(pend==mon)
        {
          $('#hdeEstado').val("2");
          $('#wfrNuevo')[0].submit();
        }
        if(mon<pend)
        {
          $('#hdeEstado').val("1");
          $('#wfrNuevo')[0].submit();
        }
      });
      // comprobar el tipo de pago
      $('#cmbTipoPago').on('change', function() {
        if(this.value==1)
        {
          // cuando es efectivo ocultar comprobante y Banco
          $('#labelBanco').hide();
          $('#cmbBancos').hide();
          $('#labelComprobante').hide();
          $('#txtComprobante').hide();
          $('#labelMonto').show();
          $('#txtMonto').show();
          $('#labelGlosa').show();
          $('#areaGlosa').show();
        }
        else
        {
          // cuando es efectivo ocultar comprobante y Banco
          $('#labelBanco').show();
          $('#cmbBancos').show();
          $('#labelComprobante').show();
          $('#txtComprobante').show();
          $('#labelMonto').show();
          $('#txtMonto').show();
          $('#labelGlosa').show();
          $('#areaGlosa').show();
        }
        if(this.value == "")
        {
          $('#labelBanco').hide();
          $('#cmbBancos').hide();
          $('#labelComprobante').hide();
          $('#txtComprobante').hide();
          $('#labelMonto').hide();
          $('#txtMonto').hide();
          $('#labelGlosa').hide();
          $('#areaGlosa').hide();
        }
      })
    });


  </script>
  <script type="text/javascript">
    // funcion borrar
    // loader
    function nuevoPago(codCompras,pendiente){
      $('#modalNuevo').modal('show');
      $('#hdeCodCompras').val(codCompras);
      $('#txtPendiente').val(pendiente);

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

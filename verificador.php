<?php
  session_start();
  if($_SESSION['roleG']!=0)
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
  <?php require "inc/menuLateralConfig.php"; ?>
  <!-- menu lateral fin -->
  <!-- contenido inicio -->
  <main class="app-content">
    <div class="app-title">
      <div>
        <h1><i class="fa fa-print"></i> Verificador Codigo de Control</h1>
        <p id="divDataTable"></p>
      </div>
      <ul class="app-breadcrumb breadcrumb side">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item active"><a href="configConsole.php">Inicio</a></li>
        <li class="breadcrumb-item">Verificador Codigo de Control</li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile"  >
          <div class="tile-body">
            <div class="toggle" align='left'>
              <label>
                <input type="checkbox"  name="chkMostrar" id="chkMostrar"><span class="button-indecator">Mostrar Todos los Parametros</span>
              </label>
            </div>
            <hr>
            <!-- div donde se cargara el data table -->
            <div  align="center" style="height:650px;" >
              <form action="" id="wfrVerificador" name="wfrVerificador" method="post">
              <table class="table table-hover table-bordered " id="dataTable" align="center" style="display: inline;">
                <thead>
                  <tr class="btn-primary">
                    <th>Item</th>
                    <th>Valor</th>
                  </tr>
                </thead>
                <tbody>
                  <tr id="trNitEmisor">
                    <td>
                      NIT Emisor
                    </td>
                    <td>
                      <input type="text" class="form-control input-sm" id="txtNitEmisor" name="txtNitEmisor" value="" >
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <strong>No Factura</strong>
                    </td>
                    <td>
                      <input type="number" required class="form-control input-sm" id="txtFactura" name="txtFactura" value="" >
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <strong>No Autorizacion</strong>
                    </td>
                    <td>
                      <input type="number" required class="form-control input-sm" id="txtAutorizacion" name="txtAutorizacion" value="" >
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <strong>Fecha de Emision</strong>
                    </td>
                    <td>
                      <input type="date" required class="form-control input-sm" id="txtFechaEmision" name="txtFechaEmision" value="" >
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <strong>Total</strong>
                    </td>
                    <td>
                      <input type="number" step="any" required class="form-control input-sm" id="txtTotal" name="txtTotal" value="" >
                    </td>
                  </tr>
                  <tr id="trImporteBase">
                    <td>
                      Importe Base para Credito Fiscal
                    </td>
                    <td>
                      <input type="number" class="form-control input-sm" id="txtImporteBase" name="txtImporteBase" value="" >
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <strong>NIT/CI/CEX Comprador</strong>
                    </td>
                    <td>
                      <input type="text" required class="form-control input-sm" id="txtNitComprador" name="txtNitComprador" value="" >
                    </td>
                  </tr>
                  <tr id="trIce">
                    <td>
                      Importe ICE/IEHD/TASAS
                    </td>
                    <td>
                      <input type="number" class="form-control input-sm" id="txtIce" name="txtIce" value="" >
                    </td>
                  </tr>
                  <tr id="trVentasNoGravadas">
                    <td>
                      Importe por Ventas no Gravadas
                    </td>
                    <td>
                      <input type="number" class="form-control input-sm" id="txtNoGravadas" name="txtNoGravadas" value="" >
                    </td>
                  </tr>
                  <tr id="trNoCreditoFiscal">
                    <td>
                      Importe no Sujeto a Credito Fiscal
                    </td>
                    <td>
                      <input type="number" class="form-control input-sm" id="txtImporteSinCreditoFiscal" name="txtImporteSinCreditoFiscal" value="" >
                    </td>
                  </tr>
                  <tr id="trDescuentos">
                    <td>
                      Descuentos, Bonificaciones y Rebajas Obtenidas
                    </td>
                    <td>
                      <input type="number" class="form-control input-sm" id="txtDescuento" name="txtDescuento" value="" >
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <strong>Llave de Dosificacion</strong>
                    </td>
                    <td>
                      <input type="text" required class="form-control input-sm" id="txtLlave" name="txtLlave" value="" >
                    </td>
                  </tr>
                  <tfoot>

                    <tr>
                      <td colspan="2">
                        <p align='center'>
                          <button type="button" class="btn btn-secondary" id="btnLimpiar">Limpiar</button>
                          <button type="submit" class="btn btn-primary" id="btnRegistrar">Generar</button>
                        </p>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        Codigo de Control
                      </td>
                      <td>
                        <input type="text" class="form-control input-sm txtCodControl" id="txtCodControl" name="txtCodControl" value="" >

                      </td>
                    </tr>
                  </tfoot>
                </tbody>
              </table>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!-- crear modal para nuevo usuario -->

<!-- modal para actualizar -->

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
      // ocultar las filas no usadas
      $('#trNitEmisor').hide();
      $('#trImporteBase').hide();
      $('#trIce').hide();
      $('#trVentasNoGravadas').hide();
      $('#trNoCreditoFiscal').hide();
      $('#trDescuentos').hide();
      // loader Inicio
      var screen = $('#loading-screen');
      configureLoadingScreen(screen);
      // uploader java

      // carga del datatable para que funcione el load screen
      $('#divDataTable').load('inc/tablaVerificador.php');
      $(document).on('click', '#btnLimpiar', function(event) {
        $('#wfrVerificador')[0].reset();

      });
      $("#wfrVerificador").on("submit", function(event){
        event.preventDefault();
        datos=$('#wfrVerificador').serialize();
        $.ajax({
          type:"POST",
          data:datos,
          url:"ajax/obtenCodControl.php"
        }).done( function(r) {
            dat=jQuery.parseJSON(r);
            // alert(dat['codControl']);
            $('.txtCodControl').val(dat['codControl']);
          }).fail( function(r) {

            alert( 'Error!!' );

        });
      });
    });


  </script>
  <script type="text/javascript">
  $(document).ready(function(){
    $('#dataTable').DataTable( {
      responsive: true,
      ordering: false,
      searching: false,
      info: false,
      paging: false,
      scrollY: 410,
      "scrollX": true,
      "language": {
        "lengthMenu": "Mostrar _MENU_ Registros por Pagina",
        "zeroRecords": "Sin Registros",
        "info": "Mostrando Pagina _PAGE_ de _PAGES_",
        "infoEmpty": "Sin Registros Disponibles",
        "search": "Buscar",
        "infoFiltered": "(filtered from _MAX_ total records)"
      }
    });
  });
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

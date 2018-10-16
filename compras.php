<?php
  session_start();
  if(!$_SESSION['codUsuarioG'] || $_SESSION['roleG']!=1)
  {
  	header("location: login.php");
  }
  require_once "inc/config.php";
  require "inc/obtener.php";
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
  <?php require "inc/menuLateralProductos.php"; ?>
  <!-- menu lateral fin -->
  <!-- contenido inicio -->
  <main class="app-content">
    <div class="app-title">
      <div>
        <h1><i class="fa fa-user"></i> Compras</h1>
        <p>Nueva Compra</p>
      </div>
      <ul class="app-breadcrumb breadcrumb side">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item active"><a href="gerenteConsole.php">Inicio</a></li>
        <li class="breadcrumb-item">Compras</li>
      </ul>
    </div>
    <form id="wfrNuevo" name="wfrNuevo"  method="post" enctype="multipart/form-data" action="comprasPhp.php">

    <div class="row">
      <div class="col-md-6">
        <div class="tile">
          <h3 class="tile-title">Datos de Compra</h3>

          <div class="tile-body">
            <!-- div donde se cargara el data table -->
            <label>Codigo:</label>
            <input type="text" class="form-control input-sm" readonly id="txtCodCompras" name="txtCodCompras" value="<?php echo obtenerUltimo('compras','codCompras'); ?>" >
            <label>Fecha</label>
            <input type="date" required class="form-control input-sm" id="txtFecha" name="txtFecha" >
            <label>Proveedor</label>
            <?php echo obtenerCombo('proveedor','codProveedor','empresa'); ?>
            <label>Observaciones</label>
            <textarea class="form-control" id="areaObservaciones" name="areaObservaciones" rows="2" style="margin-top: 0px; margin-bottom: 0px; height: 100px;"></textarea>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="tile">
          <h3 class="tile-title">Productos</h3>
          <div class="tile-body">
            <!-- div donde se cargara el data table -->
            <div id="divDataTable">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <h3 class="tile-title">Detalle de Compras</h3>
          <div class="tile-body">
            <div id="divDataDetalle">
                <p align='center'>Sin Registros</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <p align='center'><button type="submit" class="btn btn-primary" id="btnRegistrar">Registrar</button></p>
          </div>
        </div>
      </div>
    </div>
    </form>
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
    $('#cmbproveedor').select2();
    $(document).ready(function(){
      // loader Inicio
      var screen = $('#loading-screen');
      configureLoadingScreen(screen);
      // carga del datatable
      $('#divDataTable').load('inc/tablaProductoCompras.php');
      // carga datatable detalle
      $('#divDataDetalle').load('inc/tablaDetalleCompras.php');
    // llenar por ajax nuevo usuarios
      $("#wfrNuevo").submit(function() {
        if (cont==0) {
          swal("Error al Registrar!", "Necesita Seleccionar un Producto.", "error");
          return false;
        } else
          return true;
      });
    });
  </script>
  <script type="text/javascript">
    // funcion agregar Detalle compras
    var cont=0;
    var band=0;
    function detalleCompras(cod,articulo,descripcion,foto,unidad)
    {
      co="<input type='hidden' id='hdeP' name='hdeP[]' value='"+cod+"' >"
      c="<input type='number' onkeyup='calcular("+cod+")' required  class='form-control' id='txtC"+cod+"' name='txtC[]'>";
      p="<input type='number' onkeyup='calcular("+cod+")' required step='any' class='form-control' id='txtP"+cod+"' name='txtP[]'>";
      d="<input type='number' onkeyup='calcular("+cod+")'  class='form-control' id='txtD"+cod+"' name='txtD[]' required value='0'>";
      s="<input type='number' readonly class='form-control' id='txtS"+cod+"' name='txtS[]' >";
      b="<span class='btn btn-danger btn-sm' onclick='borrarFila("+cod+")'><span class='fa fa fa-trash'></span></span>";
      fila="<tr id='fila"+cod+"'><td>"+cod+co+"</td><td>"+articulo+"</td><td>"+descripcion+"</td><td><img style='max-width: 60px ' class='img-fluid' src='productos/"+foto+"' ></td><td>"+unidad+"</td><td>"+c+"</td><td>"+p+"</td><td>"+d+"</td><td>"+s+"</td><td>"+b+"</td></tr>";
      $('#filaProducto'+cod).hide();
      $('#dataTableDetalle').prepend(fila);
      // adicionar al final el total
      if(band==0)
      {
        band=1;
        filaTotal="<tfoot><tr id='filaTotal'><td colspan='8' align='right'>Total</td><td><input type='number' readonly class='form-control' id='txtTotal' value='0' required name='txtTotal'></td></tr></tfoot>";
        $('#dataTableDetalle').append(filaTotal);
      }
      cont++;
    }
    function calcular(cod)
    {
      cantidad=$('#txtC'+cod).val();
      precio=$('#txtP'+cod).val();
      dsct=$('#txtD'+cod).val();
      sub=cantidad * precio;
      if(dsct)
      {
        aux=sub * (dsct/100);
        sub=sub - aux;
      }
      $('#txtS'+cod).val(sub);
      calcularTotal();

    }
    // calculo del total independientemente del codigo
    function calcularTotal()
    {
      if(cont>0)
      {
        su=0;
        $("#dataTableDetalle tbody tr").each(function(){
          co = $(this).find("td:eq(0)").text();
          subtotal=parseFloat($('#txtS'+co).val());
          if(isNaN(subtotal)==true)
          {
            subtotal=0;
          }
          su=su + subtotal;
        });
        $('#txtTotal').val(su);
      }
    }
    // funcion para borra la fila del detalle de compras
    function borrarFila(cod)
    {
      cont--;
      $('#fila'+cod).remove();
      $('#filaProducto'+cod).show();
      if (cont == 0)
      {
        band=0;
        $('#filaTotal').remove();
      }
      calcularTotal();
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

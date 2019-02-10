<?php
  session_start();
  if(!$_SESSION['codUsuarioG'] || $_SESSION['roleG']!=1)
  {
  	header("location: login.php");
  }
  require_once "inc/config.php";
  require "inc/obtener.php";
  $almacenA=obtenerAsignacionAlmacen($_SESSION['codUsuarioG']);
  $almacen=$almacenA[0];
  $codAlmacenHde=$almacenA[1];
  $linea=obtenerAsignacionLinea($_SESSION['codUsuarioG']);
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
        <h1><i class="fa fa-user"></i> Ventas <div id="divLinea"></div></h1>
        <p>Nueva Venta</p>
      </div>
      <ul class="app-breadcrumb breadcrumb side">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item active"><a href="gerenteConsole.php">Inicio</a></li>
        <li class="breadcrumb-item">Ventas</li>
      </ul>
    </div>
    <form id="wfrNuevo" name="wfrNuevo"  method="post" enctype="multipart/form-data" action="ventasPhp.php">

    <div class="row">
      <div class="col-md-6">
        <div class="tile">
          <h3 class="tile-title">Datos de Venta</h3>

          <div class="tile-body">
            <!-- div donde se cargara el data table -->

            <input type="hidden" class="form-control input-sm" id="hdeAlmacen" name="hdeAlmacen" value="<?php echo $codAlmacenHde; ?>" >

            <label>Codigo:</label>
            <input type="text" class="form-control input-sm" readonly id="txtCodVentas" name="txtCodVentas" value="<?php echo obtenerUltimo('ventas','codVentas'); ?>" >
            <label>Fecha</label>
            <input type="date" required class="form-control input-sm" id="txtFecha" name="txtFecha" value="<?php echo date("Y-m-d");?>">
            <label>Cliente</label>
            <button type="button" class="btn btn-success btn-sm fa fa fa-plus" data-toggle="modal" data-target="#modalNuevoCliente">
            </button>
            <button type="button" class="btn btn-info btn-sm fa fa fa-search">
            </button>
            <input type="hidden" class="form-control input-sm"  id="hdeDescuento" name="hdeDescuento" value="" >

            <div id="divCliente"> <?php require "inc/cmbCliente.php"; ?> </div>
            <label>Razon Social</label>
            <input type="text" class="form-control input-sm"  id="txtRazonSocial" name="txtRazonSocial" value="Consumidor Final" >
            <label>NIT</label>
            <input type="text" class="form-control input-sm"  id="txtNit" name="txtNit" value="99002" >
            <label>Forma de Pago</label>
            <?php echo obtenerCombo('formapago','codFormaPago','formaPago'); ?>
            <label id="labelPlazo">Plazo</label>
            <input type="number" class="form-control input-sm"  id="txtPlazo" name="txtPlazo" value="" >
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="tile">
          <h3 class="tile-title"><div id="divAlmacen"></div></h3>
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
          <h3 class="tile-title">Detalle de Ventas</h3>
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
            <p align='center'><button type="button" class="btn btn-primary" id="btnRegistrar">Registrar</button></p>
          </div>
        </div>
      </div>
    </div>
    <!-- modal de tipo de pago efectivo deposito cheque tarjeta de credito transferencia en el exterior   -->
    <!-- modal para ver existencias en almacenes-->
    <div class="modal fade" id="modalTipoPago" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">VENTA AL CONTADO</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h1 style="width: 100%; text-align: center;"><div id="divTotalCancelar"  ></div></h1>
            <br>
            <label>Tipo de Pago</label>
            <?php echo obtenerCombo('tipopago','codTipoPago','tipoPago'); ?>
            <div class="divContTipoPago">
              <label id="lblPagoEfectivo">Efectivo (Bs)</label>
              <input type="number" step="any" class="form-control input-sm" id="txtPagoEfectivo" name="txtPagoEfectivo" oninput="calcularCambio()" required>
              <label id="lblCambio">Cambio (Bs)</label>
              <input type="number" step="any" class="form-control input-sm" id="txtCambio" name="txtCambio" readonly>
              <label id="lblBanco">Banco</label>
              <?php echo obtenerCombo('bancos','codBancos','banco'); ?>
              <label id="lblComprobante">Comprobante</label>
              <input type="text" class="form-control input-sm" id="txtComprobante" name="txtComprobante">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary" id="btnRegistrarModal" name="btnRegistrarModal">Registrar</button>

          </div>
        </div>
      </div>
    </div>
    <!-- fin modal tipo pago -->

    </form>
  </main>
</div>

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

        <div id="divAlmacenTabla"></div>
      </div>
      <div class="modal-footer">
        <h5><div id="divCantidad"></div></h5>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>



<!-- crear modal para nuevo cliente -->
<form id="wfrNuevoCliente" name="wfrNuevoCliente"  method="post" enctype="multipart/form-data">
<div class="modal fade" id="modalNuevoCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Nuevo Cliente</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <label>Nombre</label>
      <input type="text" class="form-control input-sm" id="txtNombre" name="txtNombre" required>
      <label>CI</label>
      <input type="text" class="form-control input-sm" id="txtCi" name="txtCi" required>
      <label>Fecha de Nacimiento</label>
      <input type="date" class="form-control input-sm" id="txtFechaNacimiento" name="txtFechaNacimiento" >
      <label>Direccion</label>
      <input type="text" class="form-control input-sm" id="txtDireccion" name="txtDireccion" >
      <label>Telefono</label>
      <input type="text" class="form-control input-sm" id="txtTelefono" name="txtTelefono" >
      <label>Celular</label>
      <input type="text" class="form-control input-sm" id="txtCelular" name="txtCelular" required>
      <label>Email</label>
      <input type="email" class="form-control input-sm" id="txtEmail" name="txtEmail" >
      <label>Razon Social</label>
      <input type="text" class="form-control input-sm" id="txtRazonSocialN" name="txtRazonSocialN" >
      <label>NIT</label>
      <input type="text" class="form-control input-sm" id="txtNitN" name="txtNitN">
      <label>Descuento (%)</label>
      <input type="number" step="any" class="form-control input-sm" id="txtDescuentoN" name="txtDescuentoN">
      <label>Plazo Credito (Dias)</label>
      <input type="number"  class="form-control input-sm" id="txtPlazoN" name="txtPlazoN">
      <label>Limite Credito (Bs)</label>
      <input type="number"  class="form-control input-sm" id="txtLimiteCreditoN" name="txtLimiteCreditoN">
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      <button type="submit" class="btn btn-primary">Nuevo</button>
    </div>
  </div>
</div>
</div>
</form>

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
    $('#cmbcliente').select2();
    $(document).ready(function(){

      // nuevo Cliente
      $("#wfrNuevoCliente").on("submit", function(event){
        event.preventDefault();
        // datos=$('#wfrNuevo').serialize();
        var f = $(this);
        var formData = new FormData(document.getElementById("wfrNuevoCliente"));
        formData.append("dato", "valor");
        $.ajax({
          url:"ajax/agregarCliente.php",
          type:"POST",
          dataType: "html",
          data: formData,
          cache: false,
          contentType: false,
	        processData: false
        })
          // data:datos,
          .done(function(r){
            datos=jQuery.parseJSON(r);
            id=datos['id'];
            if(id==1){
              $('#wfrNuevoCliente')[0].reset();
              codigoC=datos['codClienteJ'];
              // codigoC=7;
              $('#divCliente').load('inc/cmbCliente.php?codClienteG='+codigoC);
              // capturar datos de plazo descuentos y credito
              $('#txtPlazo').val(datos['plazo']);
              $('#hdeDescuento').val(datos['descuento']);
              $('#modalNuevoCliente').modal('hide');
              swal({
                title: "Nuevo Cliente",
                text: "Registro Exitoso!",
                icon: "success"
              });
            }else{
              swal({
                title: "Nuevo Cliente Error",
                text: r,
                icon: "error"
              });
            }
          });
      });
      // nuevo cliente fin

      // verificar asignacion de linea empresarial
      lineaO="<?php echo $linea[0]; ?>";
      logoO="<?php echo $linea[1]; ?>";
      codLineaO="<?php echo $linea[2]; ?>";
      codAlmacenO="<?php echo $almacenA[1]; ?>";
      if (lineaO == "") {
        swal({
          title: "Error de Configuracion!",
          text: "El Usuario no tiene Asignado una Linea Empresarial, Ponganse en Contacto con el Administrador",
          type: "error",
          showCancelButton: false,
          confirmButtonText: "Aceptar",
          closeOnConfirm: false,
          closeOnCancel: true
        },function(isConfirm) {
          if (isConfirm) {
            location.href="login.php";
          }
        });
      }
      else {
        $('#divLinea').html("<img src='logos/"+logoO+"' width='80'>"+lineaO);
      }
      // verificar si hay asignacion de almacen
      almacen="<?php echo $almacen; ?>";
      if (almacen == "") {
        swal({
          title: "Error de Configuracion!",
          text: "El Usuario no tiene Asignado un Almacen, Ponganse en Contacto con el Administrador",
          type: "error",
          showCancelButton: false,
          confirmButtonText: "Aceptar",
          closeOnConfirm: false,
          closeOnCancel: true
        },function(isConfirm) {
          if (isConfirm) {
            location.href="login.php";
          }
        });
      }
      else {
        $('#divAlmacen').text("Productos en Almacen: "+almacen);
      }


      // ocultar Plazo
      $('#labelPlazo').hide();
      $('#txtPlazo').hide();
      // capturar el evento onchange del cmbformapago
      $(document).on('change', '#cmbformapago', function(event) {
        v=$("#cmbformapago").val();
        if(v=="1")
        {
          $('#labelPlazo').hide();
          $('#txtPlazo').hide();
        }
        if(v=="2")
        {
          codC=$("#cmbcliente").val();
          // alert(codC);
          $('#labelPlazo').show();
          $('#txtPlazo').show();
        }
      });
      // loader Inicio
      var screen = $('#loading-screen');
      configureLoadingScreen(screen);
      // carga del datatable
      $('#divDataTable').load('inc/tablaProductoVentas.php?codLinea='+codLineaO+'&codAlmacen='+codAlmacenO);
      // carga datatable detalle
      $('#divDataDetalle').load('inc/tablaDetalleVentas.php');


      $(document).on('click', '#btnRegistrar', function(event) {
      // $( "#wfrNuevo" ).submit(function( event ) {
        // event.preventDefault();
        if (cont==0) {
          swal("Error al Registrar!", "Necesita Seleccionar un Producto.", "error");
        } else{
          aux=0;
          $("#dataTableDetalle tbody tr").each(function(){
            co = $(this).find("td:eq(0)").text();
            elemento=document.getElementById('txtC'+co);
            if(!elemento.checkValidity())
            {
              aux=1;
            }
          });
          if(aux==0)
          {
            $('#divTotalCancelar').text("TOTAL (Bs): "+$('#txtTotal').val());
            $('#txtPagoEfectivo').val($('#txtTotal').val());
            $('#txtCambio').val(0);

            // ocultar los campos del modal
            $('#lblBanco').hide();
            $('#cmbbancos').hide();
            $("#cmbbancos").prop('disabled', true);
            $('#lblComprobante').hide();
            $('#txtComprobante').hide();
            $("#txtComprobante").prop('disabled', true);
            // ocultar los campos del modal final
            $('#modalTipoPago').modal('show');

          }
          else {
            swal("Error al Registrar!", "Necesita Ingresar la Cantidad", "error");
          }

        }
      });

      // intentar hacer submit
      // $( "#btnRegistrarModal" ).click(function() {
      //   alert("jiji");
      //   $( "#wfrNuevo" ).submit();
      // });

      // capturar evento onchange de tipoPago inicio
      $(document).on('change', '#cmbtipopago', function(event) {
        a=$('#cmbtipopago').val();
        if(a==1)
        {
          // ocultar
          $('#lblBanco').hide();
          $('#cmbbancos').hide();
          $("#cmbbancos").prop('disabled', true);
          $('#lblComprobante').hide();
          $('#txtComprobante').hide();
          $("#txtComprobante").prop('disabled', true);
          // mostrar
          $('#txtPagoEfectivo').show();
          $("#txtPagoEfectivo").prop('disabled', false);
          $('#txtCambio').show();
          $("#txtCambio").prop('disabled', false);
          $('#lblPagoEfectivo').show();
          $('#lblCambio').show();
        }
        if(a==2)
        {
          // ocultar
          $('#txtPagoEfectivo').hide();
          $("#txtPagoEfectivo").prop('disabled', true);
          $('#txtCambio').hide();
          $("#txtCambio").prop('disabled', true);
          $('#lblPagoEfectivo').hide();
          $('#lblCambio').hide();
          // mostrar
          $('#lblBanco').show();
          $('#cmbbancos').show();
          $("#cmbbancos").prop('disabled', false);
          $('#lblComprobante').show();
          $('#txtComprobante').show();
          $("#txtComprobante").prop('disabled', false);
        }
        if(a==3)
        {
          // ocultar
          $('#txtPagoEfectivo').hide();
          $("#txtPagoEfectivo").prop('disabled', true);
          $('#txtCambio').hide();
          $("#txtCambio").prop('disabled', true);
          $('#lblPagoEfectivo').hide();
          $('#lblCambio').hide();
          // mostrar
          $('#lblBanco').show();
          $('#cmbbancos').show();
          $("#cmbbancos").prop('disabled', false);
          $('#lblComprobante').show();
          $('#txtComprobante').show();
          $("#txtComprobante").prop('disabled', false);
        }
        if(a==4)
        {
          // ocultar
          $('#txtPagoEfectivo').hide();
          $("#txtPagoEfectivo").prop('disabled', true);
          $('#txtCambio').hide();
          $("#txtCambio").prop('disabled', true);
          $('#lblPagoEfectivo').hide();
          $('#lblCambio').hide();
          // mostrar
          $('#lblBanco').show();
          $('#cmbbancos').show();
          $("#cmbbancos").prop('disabled', false);
          $('#lblComprobante').show();
          $('#txtComprobante').show();
          $("#txtComprobante").prop('disabled', false);
        }
        if(a==5)
        {
          // ocultar
          $('#txtPagoEfectivo').hide();
          $("#txtPagoEfectivo").prop('disabled', true);
          $('#txtCambio').hide();
          $("#txtCambio").prop('disabled', true);
          $('#lblPagoEfectivo').hide();
          $('#lblCambio').hide();
          // mostrar
          $('#lblBanco').show();
          $('#cmbbancos').show();
          $("#cmbbancos").prop('disabled', false);
          $('#lblComprobante').show();
          $('#txtComprobante').show();
          $("#txtComprobante").prop('disabled', false);
        }
      });
      // capturar evento onchange de tipoPago fin

    });
  </script>
  <script type="text/javascript">
    // funcion agregar Detalle compras
    var cont=0;
    var band=0;
    function detalleCompras(cod,articulo,descripcion,foto,unidad,cantidadD,precioV)
    {
      descC=$("#hdeDescuento").val();
      co="<input type='hidden' id='hdeP' name='hdeP[]' value='"+cod+"' >"
      cantidadAlmacen="<input type='hidden' id='hdeCA"+cod+"' name='hdeCA[]' value='"+cantidadD+"' >"
      c="<input type='number' oninput='calcular("+cod+")' required  class='form-control' id='txtC"+cod+"' name='txtC[]'>";
      p="<input type='number' onkeyup='calcular("+cod+")' required step='any' class='form-control' id='txtP"+cod+"' name='txtP[]' value='"+precioV+"' readonly>";
      d="<input type='number' oninput='calcular("+cod+")'  class='form-control' id='txtD"+cod+"' name='txtD[]' value='"+descC+"'>";
      s="<input type='number' readonly class='form-control' id='txtS"+cod+"' name='txtS[]' >";
      b="<span class='btn btn-danger btn-sm fa fa fa-trash' onclick='borrarFila("+cod+")'></span>";
      fila="<tr id='fila"+cod+"'><td>"+cod+co+"</td><td>"+cantidadD+cantidadAlmacen+"</td><td>"+articulo+"</td><td>"+descripcion+"</td><td><img style='max-width: 40px ' class='img-fluid' src='productos/"+foto+"' ></td><td>"+unidad+"</td><td>"+c+"</td><td>"+p+"</td><td>"+d+"</td><td>"+s+"</td><td>"+b+"</td></tr>";
      $('#filaProducto'+cod).hide();
      $('#dataTableDetalle').prepend(fila);
      // adicionar al final el total
      if(band==0)
      {
        band=1;
        filaTotal="<tfoot><tr id='filaTotal'><td colspan='9' align='right'>Total</td><td><input type='number' readonly class='form-control' id='txtTotal' value='0' required name='txtTotal'></td></tr></tfoot>";
        $('#dataTableDetalle').append(filaTotal);
      }
      cont++;
    }
    function calcular(cod)
    {
      cantidad=$('#txtC'+cod).val();
      cantidadA=$('#hdeCA'+cod).val();
      p=cantidad-cantidadA;
      if (p>0) {
        swal({
          title: "Cantidad Mayor a las Existentes!",
          text: "La cantidad no puede ser mayor a la Disponible",
          type: "warning",
          showCancelButton: false,
          confirmButtonText: "Aceptar",
          closeOnConfirm: true,
          closeOnCancel: true
        });
        $('#txtC'+cod).val("");
      }
      else {

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
    // ver existencias
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
        }
      });
      $('#divAlmacenTabla').load('inc/tablaExistenciasAlmacen.php?codProducto='+codProducto);
      $('#divCantidad').text("Total: "+cantidad);
      $('#modalVer').modal('show');
    }
    function alertaExistencias()
    {
      swal({
        title: "Producto sin Exitencias!",
        text: "Consulte a su Administrador",
        type: "warning",
        showCancelButton: false,
        confirmButtonText: "Aceptar",
        closeOnConfirm: true,
        closeOnCancel: true
      });
    }

    function alertaPrecioVenta()
    {
      swal({
        title: "Precio de Venta no Establecido!",
        text: "Consulte a su Administrador",
        type: "error",
        showCancelButton: false,
        confirmButtonText: "Aceptar",
        closeOnConfirm: true,
        closeOnCancel: true
      });
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
    function obtenerNit()
    {
      codCliente=$('#cmbcliente').val();
      if(codCliente==0)
      {
        $('#txtRazonSocial').val("Consumidor Final");
        $('#txtNit').val(99002);
      }else {

        $.ajax({
          type:"POST",
          data:"cod=" + codCliente,
          url:"ajax/obtenDatosCliente.php",
          success:function(r){
            datos=jQuery.parseJSON(r);
            $('#txtRazonSocial').val(datos['razonSocial']);
            $('#txtNit').val(datos['nit']);
            $('#txtPlazo').val(datos['plazoCredito']);
            $('#hdeDescuento').val(datos['descuento']);
            // llenar descuentos despues de elegir productos
            if(cont>0)
            {
              $("#dataTableDetalle tbody tr").each(function(){
                co = $(this).find("td:eq(0)").text();

                $('#txtD'+co).val(datos['descuento']);
              });
            }

            // $('#divLogoAntiguo').html("<img class='img-fluid' src='logos/1logo.jpg' >");
          }
        });
      }
    }

    function calcularCambio()
    {
      pa=$('#txtPagoEfectivo').val();
      tot=$('#txtTotal').val();
      cambio=pa - tot;
      $('#txtCambio').val(cambio);
    }


  </script>
</body>
</html>

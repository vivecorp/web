<?php
  session_start();
  require_once "config.php";
  $codUsuario=$_SESSION["codUsuarioG"];
  $codVentas=$_GET['codVentas'];
  if(!$codUsuario)
  {
?>
    <script type="text/javascript">
      alert("Se Cerro la Sesion por Seguridad, Vuelva a iniciar Sesion");
      location.href="login.php";
    </script>
<?php
  }
  $queryOV="select date_format(v.fecha,'%d/%m/%Y %H:%i') as fecha,
                   v.total as total,
                   c.nombre as cliente,
                   c.ci as ci,c.cel as celular,
                   u.nombre as usuario
              from ventas v, cliente c, usuario u
              where v.codCliente=c.codCliente and
                    v.codUsuario=u.codUsuario and
                    v.codVentas=$codVentas";
  $resultOV=$con->query($queryOV);
  if($resultOV->rowCount() == 1){
     // existe usuario
    $rowOV=$resultOV->fetch(PDO::FETCH_ASSOC);
    $cliente=$rowOV['cliente'];
    $ci=$rowOV['ci'];
    $total=$rowOV['total'];
    $totalN=number_format($total, 2, '.', '');
    $fecha=$rowOV['fecha'];
    $celular=$rowOV['celular'];
    $usuario=$rowOV['usuario'];
  }else{
      echo "No se encontro ningun registro";
      return false;
  }
?>
<table class="table table-hover table-condensed table-bordered" id="dataTableModal">
  <thead>
    <tr>
      <th colspan="10">
        Nro Venta: <?php echo $codVentas; ?>
      </th>
    </tr>
    <tr>
      <th colspan="10">
        Cliente: <?php echo $cliente; ?>
      </th>
    </tr>
    <tr>
      <th colspan="10">
        Fecha: <?php echo $fecha; ?>
      </th>
    </tr>
    <tr>
      <th colspan="10">
        Usuario: <?php echo $usuario; ?>
      </th>
    </tr>
    <tr>
      <th colspan="10">
        Estado de Pago:
      </th>
    </tr>
    <tr>
      <th>Art.</th>
      <th>Producto</th>
      <th>Foto</th>
      <th>Cantidad</th>
      <th>Precio</th>
      <th>Descuento</th>
      <th>Sub Total</th>
    </tr>
  </thead>
  <tbody>
  <?php
  $queryODV="select d.precio as precio,
              	    d.cantidad as cantidad,
                    d.descuento as descuento,
                    d.subTotal as subTotal,
                    p.articulo as articulo,
                    p.descripcion as producto,
                    p.foto as foto,
                    u.sigla as sigla
              from detalleventas d, producto p, unidadmedida u
              where d.codProducto=p.codProducto and
                    p.codUnidadMedida=u.codUnidadMedida and
                    d.codVentas=$codVentas";
  $buscarODV=$con->query($queryODV);
  $totalCajas=0;
  while($rowODV=$buscarODV->fetch(PDO::FETCH_ASSOC))
  {
    $precioF=$rowODV['precio'];
    $cantidadF=$rowODV['cantidad'];
    $descuentoF=$rowODV['descuento'];
    $subTotalF=$rowODV['subTotal'];
    $articuloF=$rowODV['articulo'];
    $productoF=$rowODV['producto'];
    $fotoF=$rowODV['foto'];
    $siglaF=$rowODV['sigla'];
    echo "<tr>
            <td>$articuloF</td>
            <td>$productoF ($siglaF)</td>
            <td><img style='max-width: 50px ' class='img-fluid' src='productos/$fotoF' ></td>
            <td class='right'>$cantidadF</td>
            <td class='right'>$precioF</td>
            <td class='right'>$descuentoF</td>
            <td class='right'>$subTotalF</td>
          </tr>";
  }

  ?>
  </tbody>
    <tr>
      <th colspan="7">
        Total (Bs): <?php echo $total; ?>
      </th>
    </tr>

</table>

<script type="text/javascript">
$(document).ready(function(){
  $('#dataTableModal').DataTable( {
    responsive: true,
    searching: false,
    info: false,
    paging: false,
    scrollY: 210,
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
</script>

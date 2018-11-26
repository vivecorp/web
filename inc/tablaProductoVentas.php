<?php
  require_once "config.php";
  $codLineaG=$_GET['codLinea'];
  $codAlmacenG=$_GET['codAlmacen'];
?>
<table class="table table-hover table-condensed table-bordered" id="dataTable" style="font-size: 12px;">
  <thead>
    <tr valign="middle">
      <th>Art.</th>
      <th>Producto</th>
      <th>C.Barra</th>
      <th>Foto</th>
      <th>Unidad</th>
      <th>Precio</th>
      <th>Cant. Almacen</th>
      <th>Cant. Total</th>
    </tr>
  </thead>
  <tbody>
  <?php
    // obtener los productos
    $query="select p.codProducto, p.articulo, p.descripcion,
                  p.codigoBarra, p.foto, p.estado, u.sigla,
                  l.linea, l.logo, a.descripcion
                  from producto p, unidadmedida u, lineaempresa l, actividadeconomica a
                  where p.codUnidadMedida=u.codUnidadMedida and
                  p.codLineaEmpresa=l.codLineaEmpresa and
                  p.codActividadEconomica=a.codActividadEconomica and
                  p.codLineaEmpresa=$codLineaG";
    // $result=mysql_query($query);
    $buscarU=$con->query($query);
    while($row=$buscarU->fetch(PDO::FETCH_NUM))
    {
      // obtener existencias por almacen
      $queryOC="select ifnull(sum(cantidad),0) from inventario
                where codProducto=$row[0] and
                  	  codAlmacen=$codAlmacenG";
      $buscarOC=$con->query($queryOC);
      if($buscarOC->rowCount() == 1){
        // existe
        $rowOC=$buscarOC->fetch(PDO::FETCH_NUM);
        $cantidadOC=$rowOC[0];

      }
      // obtener existencias en todos los almacenes
      $queryOT="select ifnull(sum(cantidad),0) from inventario
                where codProducto=$row[0]";
      $buscarOT=$con->query($queryOT);
      if($buscarOT->rowCount() == 1){
        // existe
        $rowOT=$buscarOT->fetch(PDO::FETCH_NUM);
        $cantidadOT=$rowOT[0];

      }
      // obtener precio de venta de cada producto
      $queryP="select precio from precioventa where codProducto=$row[0] and estado=1";
      $buscarP=$con->query($queryP);
      $rowP=$buscarP->fetch(PDO::FETCH_NUM);
      $precioVenta=$rowP[0];
      if($cantidadOC>0)
      {
        $param="detalleCompras($row[0],\"".$row[1]."\",\"".$row[2]."\",\"".$row[4]."\",\"".$row[6]."\",$cantidadOC,$precioVenta)";
      }
      else {
        $param="alertaExistencias()";
      }
      // obtener precio de venta de cada producto
      $queryP="select precio from precioventa where codProducto=$row[0] and estado=1";
      $buscarP=$con->query($queryP);
      $rowP=$buscarP->fetch(PDO::FETCH_NUM);
      $precioVenta=$rowP[0];
      if(!$precioVenta)
      {
        $precioVenta="S/R";
        $param="alertaPrecioVenta()";
      }

      echo "<tr id='filaProducto$row[0]' ondblclick='$param'>
              <td>$row[1]</td>
              <td>$row[2]</td>
              <td>$row[3]</td>
              <td><img style='max-width: 40px ' class='img-fluid' src='productos/$row[4]' ></td>
              <td>$row[6]</td>
              <td>$precioVenta</td>
              <td>$cantidadOC</td>
              <td><a class='btn' href='javascript:verAlmacen($row[0],$cantidadOT);' id='linkCantidad' role='button'>$cantidadOT</a></td>
            </tr>";
    }

  ?>

  </tbody>
</table>

<script type="text/javascript">
  $(document).ready(function(){
    $('#dataTable').DataTable( {
      responsive: true,
      info: false,
      paging: false,
      scrollY: 309,
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

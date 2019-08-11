<?php
  require_once "config.php";
?>
<table class="table table-hover table-condensed table-bordered" id="dataTable">
  <thead>
    <tr>
      <th>Detalle Compra</th>
      <th>Fecha Compra</th>
      <th>Empresa</th>
      <th>Articulo</th>
      <th>Producto</th>
      <th>Cod. Barra</th>
      <th>Foto</th>
      <th>Cant. Comp</th>
      <th>Cant. Ing</th>
      <th>Cant. Pend</th>
      <th>Opciones</th>
    </tr>
  </thead>
  <tbody>
  <?php
    $query="select d.codCompras, d.codDetalleCompras, date_format(c.fecha,'%d/%m/%Y'), p.empresa,
            	   pr.articulo, pr.descripcion, pr.codigoBarra,
                   pr.foto, d.cantidad, pr.codProducto
            from detallecompras d, compras c, proveedor p, producto pr
            where d.codCompras=c.codCompras and
            	  c.codProveedor=p.codProveedor and
                  d.codProducto=pr.codProducto and
                  d.codEstadoInventario=1 order by d.codCompras";
    // $result=mysql_query($query);
    $buscarU=$con->query($query);
    while($row=$buscarU->fetch(PDO::FETCH_NUM))
    {
      $queryP="select ifnull(sum(cantidad),0) from inventario where codDetalleCompras=$row[1]";
      $buscarP=$con->query($queryP);
      if($rowP=$buscarP->fetch(PDO::FETCH_NUM))
      {
        $ingresado=$rowP[0];
        $pendiente=$row[8]-$ingresado;
      }
      echo "<tr >
              <td>$row[1]</td>
              <td>$row[2]</td>
              <td>$row[3]</td>
              <td>$row[4]</td>
              <td>$row[5]</td>
              <td>$row[6]</td>
              <td><img src='productos/$row[7]' width='40'></td>
              <td>$row[8]</td>
              <td>$ingresado</td>
              <td>$pendiente</td>
              <td style='text-align: center;'>
                <span class='btn btn-primary btn-sm fa fa-plus-circle' data-toggle='modal' data-target='#modalNuevo' onclick='nuevoIngreso($row[1],$pendiente,\"$row[7]\",\"$row[4]\",\"$row[5]\",$row[9])'>
                </span>
                <span class='btn btn-success btn-sm fa fa-search' onclick='ver( $row[1])'>
                </span>
              </td>
            </tr>";
    }

  ?>

  </tbody>
</table>

<script type="text/javascript">
$(document).ready(function(){
  $('#dataTable').DataTable( {
    responsive: true,
    searching: true,
    "pageLength": 100,
    info: true,
    paging: true,
    scrollY: 410,
    "scrollX": true,
    "language": {
      "lengthMe nu": "Mostrar _MENU_ Registros por Pagina",
      "zeroRecords": "Sin Registros",
      "info": "Mostrando Pagina _PAGE_ de _PAGES_",
      "infoEmpty": "Sin Registros Disponibles",
      "search": "Buscar",
      "infoFiltered": "(filtered from _MAX_ total records)"
    }
  });
});
</script>

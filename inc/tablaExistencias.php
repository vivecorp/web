<?php
  require_once "config.php";
?>
<table class="table table-hover table-condensed table-bordered" id="dataTable">
  <thead>
    <tr>
      <th>Articulo</th>
      <th>Cod. Barra</th>
      <th>Producto</th>
      <th>Foto</th>
      <th>Linea Empresarial</th>
      <th>Unidad</th>
      <th>Existencias</th>
      <th>Opciones</th>
    </tr>
  </thead>
  <tbody>
  <?php
    $query="select sum(i.cantidad) as cantidad, p.descripcion as producto, p.codProducto as codProducto,
            	     p.articulo as articulo, p.foto as foto, p.codigoBarra as codigoBarra, l.linea as linea,
                   um.sigla as sigla
            from inventario i, producto p, lineaempresa l, unidadmedida um
            where i.codProducto=p.codProducto and
            	    l.codLineaEmpresa=p.codLineaEmpresa and
                  um.codUnidadMedida=p.codUnidadMedida
                  group by i.codProducto";
    // $result=mysql_query($query);
    $buscarU=$con->query($query);
    while($row=$buscarU->fetch(PDO::FETCH_BOTH))
    {

      echo "<tr >
              <td>$row[3]</td>
              <td>$row[5]</td>
              <td>$row[1]</td>
              <td><img src='productos/$row[4]' width='40'></td>
              <td>$row[6]</td>
              <td>$row[7]</td>
              <td><a class='btn' href='javascript:verAlmacen($row[2],$row[0]);' id='linkCantidad' role='button'>$row[0]</a></td>
              <td style='text-align: center;'>
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
    info: true,
    paging: true,
    scrollY: 300,
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

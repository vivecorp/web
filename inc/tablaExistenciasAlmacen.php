<?php
  require_once "config.php";
  $codProducto=$_GET['codProducto'];
?>
<table class="table table-hover table-condensed table-bordered" id="dataTableAlmacen">
  <thead>
    <tr>
      <th>Almacen</th>
      <th>Ubicacion</th>
      <th>Cantidad</th>
    </tr>
  </thead>
  <tbody>
  <?php
    $query="select sum(i.cantidad) as cantidad, a.almacen as almacen, a.ubicacion as ubicacion
            from inventario i, almacen a
            where i.codAlmacen=a.codAlmacen and
	                i.codProducto=$codProducto group by a.almacen ";
    // $result=mysql_query($query);
    $buscarU=$con->query($query);
    while($row=$buscarU->fetch(PDO::FETCH_BOTH))
    {

      echo "<tr >
              <td>$row[1]</td>
              <td>$row[2]</td>
              <td>$row[0]</td>
            </tr>";
    }

  ?>

  </tbody>
</table>

<script type="text/javascript">
$(document).ready(function(){
  $('#dataTableAlmacen').DataTable( {
    responsive: true,
    searching: false,
    info: false,
    paging: false,
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

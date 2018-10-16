<?php
  require_once "config.php";
?>
<table class="table table-hover table-condensed table-bordered" id="dataTable">
  <thead>
    <tr>
      <th>Cod</th>
      <th>Fecha</th>
      <th>Empresa</th>
      <th>Total</th>
      <th>Pagado</th>
      <th>Pendiente</th>
    </tr>
  </thead>
  <tbody>
  <?php
    $query="select c.codCompras, date_format(c.fecha,'%d/%m/%Y'), c.total, p.empresa
	from compras c, proveedor p where c.codEstadoPago=1 and c.codProveedor=p.codProveedor";
    // $result=mysql_query($query);
    $buscarU=$con->query($query);
    while($row=$buscarU->fetch(PDO::FETCH_NUM))
    {
      $queryP="select ifnull(sum(monto),0) from pagos where codCompras=$row[0]";
      $buscarP=$con->query($queryP);
      if($rowP=$buscarP->fetch(PDO::FETCH_NUM))
      {
        $pagado=$rowP[0];
        $pendiente=$row[2]-$pagado;
      }
      echo "<tr >
              <td>$row[0]</td>
              <td>$row[1]</td>
              <td>$row[3]</td>
              <td>$row[2]</td>
              <td>$pagado</td>
              <td>$pendiente</td>
            </tr>";
    }

  ?>

  </tbody>
</table>

<script type="text/javascript">
$(document).ready(function(){
  $('#dataTable').DataTable( {
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

<?php
  require_once "config.php";
?>
<table class="table table-hover table-condensed table-bordered" id="usuarios">
  <thead>
    <tr>
      <th>Nro Venta</th>
      <th>Fecha y Hora</th>
      <th>Usuario</th>
      <th>Cliente</th>
      <th>Total</th>
      <th>Estado Pago</th>
      <th>Nro Factura</th>
      <th>Opciones</th>
    </tr>
  </thead>
  <tbody>
  <?php
    $i=0;
    $query="select v.codVentas as codVentas,
                   date_format(v.fecha,'%d/%m/%Y %H:%i') as hora,
                   u.nombre as usuario,
                   c.nombre as cliente,
                   v.total as total,
                   e.estado as estadopago
              from ventas v, usuario u, cliente c, estadopago e
              where v.codUsuario=u.codUsuario and
                    v.codCliente=c.codCliente and
                    v.codEstadoPago=e.codEstadoPago";
    // $result=mysql_query($query);
    $buscarU=$con->query($query);
    while($row=$buscarU->fetch(PDO::FETCH_NUM))
    {
      $q="select count(*) as cont from detalleventas where codVentas=$row[0]";
      $buscarQ=$con->query($q);
      $rowQ=$buscarQ->fetch(PDO::FETCH_NUM);
      $cont=$rowQ[0];

      $codVentasO=$row[0];
      $qf="select * from factura where codVentas=$codVentasO";
      $buscarQF=$con->query($qf);
      $rowQF=$buscarQF->fetch(PDO::FETCH_NUM);

      if ($rowQF[0]=="") {
        $rowQF[0]="S/R";
      }
      else {
        // $rowQF[0]="<span class='btn btn-sm btn-primary'>$rowQF[0]</span>";
        $rowQF[0]="<a href='#' onclick='imprimirFactura($row[0])'>$rowQF[0]</a>";
      }

      echo "<tr>
              <td>$row[0]</td>
              <td>$row[1]</td>
              <td>$row[2]</td>
              <td>$row[3]</td>
              <td>$row[4]</td>
              <td>$row[5]</td>
              <td>$rowQF[0]</td>
              <td style='text-align: center;'>
                <span class='btn btn-warning btn-sm fa fa-pencil-square-o' onclick='actualizar( $row[0],$cont,$row[6] )'>
                </span>
                <span class='btn btn-primary btn-sm  fa fa-print' onclick='imprimir( $row[0] )'>
                </span>
              </td>
            </tr>";
    }

  ?>

  </tbody>
</table>

<script type="text/javascript">
  $(document).ready(function(){
    $('#usuarios').DataTable( {
      responsive: true,
      "order": [0,'desc'],
      "pageLength": 100,
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

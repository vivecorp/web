<?php
  session_start();
  require_once "config.php";
  $codUsuario=$_SESSION["codUsuarioG"];
  $codRole=$_SESSION["roleG"];
  if(!$codUsuario)
  {
?>
    <script type="text/javascript">
      alert("Se Cerro la Sesion por Seguridad, Vuelva a iniciar Sesion");
      location.href="login.php";
    </script>
<?php
  }
?>
<table class="table table-hover table-condensed table-bordered" id="dataTableVentas">
  <thead>
    <tr>
      <th>Nro Venta </th>
      <th>Usuario</th>
      <th>Hora de Venta</th>
      <th>Cliente</th>
      <th>Total</th>
      <th>Estado de Pago</th>
    </tr>
  </thead>
  <tbody >
  <?php

    if($codRole==1)
    {
      $query="select c.nombre as cliente, u.nombre as usuario, v.total as total, e.estado as estadopago, date_format(v.fecha,'%H:%i') as hora, v.codVentas as codVentas
                from ventas v, usuario u, cliente c, estadopago e
                where v.codUsuario=u.codUsuario and
                      v.codCliente=c.codCliente and
                      v.codEstadoPago=e.codEstadoPago and
                      date_format(v.fecha,'%d/%m/%Y')=date_format(now(),'%d/%m/%Y')";
    }
    if($codRole==2)
    {
      $query="select c.nombre as cliente, u.nombre as usuario, v.total as total, e.estado as estadopago, date_format(v.fecha,'%H:%i') as hora, v.codVentas as codVentas
                from ventas v, usuario u, cliente c, estadopago e
                where v.codUsuario=u.codUsuario and
                      v.codCliente=c.codCliente and
                      v.codEstadoPago=e.codEstadoPago and
                      date_format(v.fecha,'%d/%m/%Y')=date_format(now(),'%d/%m/%Y') and
                      u.codUsuario=$codUsuario";
    }

    // $result=mysql_query($query);
    $buscarU=$con->query($query);
    $st=0;
    while($row=$buscarU->fetch(PDO::FETCH_NUM))
    {
      $st=$st+$row[2];
      echo "<tr onclick='mostrarModal($row[5])' style='cursor:pointer'>
              <td>$row[5]</td>
              <td>$row[1]</td>
              <td>$row[4]</td>
              <td>$row[0]</td>
              <td>$row[2]</td>
              <td>$row[3]</td>
            </tr>";
    }

  ?>

  </tbody>
  <tr>
    <th colspan="2">
      Total (Bs):
    </th>
    <th colspan="4">
      <?php echo $st; ?>
    </th>
  </tr>
</table>

<script type="text/javascript">
$(document).ready(function(){
  $('#dataTableVentas').DataTable( {
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

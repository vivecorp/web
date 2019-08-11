<?php
  require_once "config.php";
?>
<table class="table table-hover table-condensed table-bordered" id="dataTable" style="font-size: 12px;">
  <thead>
    <tr valign="middle" class="btn-primary">
      <th>Articulo</th>
      <th>Descripcion</th>
      <th>C.Barra</th>
      <th>Foto</th>
      <th>U.Medida</th>
      <th>L.Empresa</th>
    </tr>
  </thead>
  <tbody>
  <?php
    $query="select p.codProducto, p.articulo, p.descripcion,
                  p.codigoBarra, p.foto, p.estado, u.unidad,
                  l.linea, l.logo, a.descripcion
                  from producto p, unidadmedida u, lineaempresa l, actividadeconomica a
                  where p.codUnidadMedida=u.codUnidadMedida and
                  p.codLineaEmpresa=l.codLineaEmpresa and
                  p.codActividadEconomica=a.codActividadEconomica";
    // $result=mysql_query($query);
    $buscarU=$con->query($query);
    while($row=$buscarU->fetch(PDO::FETCH_NUM))
    {
      echo "<tr id='filaProducto$row[0]' onclick='detalleCompras($row[0],\"".$row[1]."\",\"".$row[2]."\",\"".$row[4]."\",\"".$row[6]."\")'>
              <td>$row[1]</td>
              <td>$row[2]</td>
              <td>$row[3]</td>
              <td><img style='max-width: 60px ' class='img-fluid' src='productos/$row[4]' ></td>
              <td>$row[6]</td>
              <td><img style='max-width: 60px ' class='img-fluid' src='logos/$row[8]' ></td>
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

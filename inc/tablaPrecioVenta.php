<?php
  require_once "config.php";
?>
<table class="table table-hover table-condensed table-bordered" id="dataTable">
  <thead>
    <tr>
      <th>Articulo</th>
      <th>Descripcion</th>
      <th>Codigo Barra</th>
      <th>Foto</th>
      <th>Unidad de Medida</th>
      <th>Linea de Empresa</th>
      <th>Precio de Venta</th>
      <th>Opciones</th>
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
      $q="select precio from precioventa where codProducto=$row[0] and estado=1";
      $buscarQ=$con->query($q);
      $rowQ=$buscarQ->fetch(PDO::FETCH_NUM);
      if($rowQ[0]=="")
      {
        $rowQ[0]="S/R";
      }

      $ae=substr($row[9], 0, 25).'...';
      echo "<tr>
              <td>$row[1]</td>
              <td>$row[2]</td>
              <td>$row[3]</td>
              <td><img style='max-width: 50px ' class='img-fluid' src='productos/$row[4]' ></td>
              <td>$row[6]</td>
              <td><img style='max-width: 50px ' class='img-fluid' src='logos/$row[8]' ></td>
              <td>$rowQ[0]</td>
              <td style='text-align: center;'>
                <span class='btn btn-warning btn-sm fa fa-pencil' data-toggle='modal' data-target='#modalEditar' onclick='llenarDatos( $row[0] )'>
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

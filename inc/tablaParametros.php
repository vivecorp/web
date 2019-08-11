<?php
  require_once "config.php";
?>
<table class="table table-hover table-condensed table-bordered" id="dataTable">
  <thead>
    <tr class="btn-primary">
      <th>Empresa</th>
      <th>Sigla</th>
      <th>Logo</th>
      <th>NIT</th>
      <th>Direccion</th>
      <th>Telefono</th>
      <th>Celular</th>
      <th>Email</th>
      <th>Ciudad</th>
      <th>Pais</th>
      <th>Tipo de Cambio</th>
      <th>Leyenda Consumidor</th>
      <th>Opciones</th>
    </tr>
  </thead>
  <tbody>
  <?php
    $query="select * from parametros";
    // $result=mysql_query($query);
    $buscarU=$con->query($query);
    while($row=$buscarU->fetch(PDO::FETCH_NUM))
    {
      echo "<tr>
              <td>$row[1]</td>
              <td>$row[2]</td>
              <td><img style='max-width: 70px ' class='img-fluid' src='images/$row[3]' ></td>
              <td>$row[4]</td>
              <td>$row[5]</td>
              <td>$row[6]</td>
              <td>$row[7]</td>
              <td>$row[8]</td>
              <td>$row[9]</td>
              <td>$row[10]</td>
              <td>$row[11]</td>
              <td>$row[12]</td>
              <td style='text-align: center;'>
                <span class='btn btn-warning btn-sm fa fa-pencil' data-toggle='modal' data-target=''#modalEditar' onclick='llenarDatos( $row[0] )'>
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

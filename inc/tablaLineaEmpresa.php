<?php
  require_once "config.php";
?>
<table class="table table-hover table-condensed table-bordered" id="dataTable">
  <thead>
    <tr>
      <th>Cod</th>
      <th>Linea Empresarial</th>
      <th>Logo</th>
      <th>Logo Archivo</th>
      <th>Estado</th>
      <th>Opciones</th>
    </tr>
  </thead>
  <tbody>
  <?php
    $query="select * from lineaempresa";
    // $result=mysql_query($query);
    $buscarU=$con->query($query);
    while($row=$buscarU->fetch(PDO::FETCH_NUM))
    {
      echo "<tr>
              <td>$row[0]</td>
              <td>$row[1]</td>
              <td><img style='max-width: 80px ' class='img-fluid' src='logos/$row[2]' ></td>
              <td>$row[2]</td>
              <td>$row[3]</td>
              <td style='text-align: center;'>
                <span class='btn btn-warning btn-sm fa fa-pencil' data-toggle='modal' data-target=''#modalEditar' onclick='llenarDatos( $row[0] )'>
                </span>
                <span class='btn btn-danger btn-sm fa fa-trash' onclick='borrar( $row[0] )'>
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

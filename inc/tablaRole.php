<?php
  require_once "config.php";
?>
<table class="table table-hover table-condensed table-bordered" id="role">
  <thead>
    <tr>
      <th>Nro</th>
      <th>Rol</th>
      <th>Opciones</th>
    </tr>
  </thead>
  <tbody>
  <?php
    $query="select * from role";
    // $result=mysql_query($query);
    $buscarU=$con->query($query);
    while($row=$buscarU->fetch(PDO::FETCH_NUM))
    {
      echo "<tr>
              <td>$row[0]</td>
              <td>$row[1]</td>
              <td style='text-align: center;'>
                <span class='btn btn-warning btn-sm' data-toggle='modal' data-target=''#modalEditarRole' onclick='llenarDatos( $row[0] )'>
                  <span class='fa fa-pencil-square-o'></span>
                </span>
                <span class='btn btn-danger btn-sm' onclick='borrarRole( $row[0] )'>
                  <span class='fa fa fa-trash'></span>
                </span>
              </td>
            </tr>";
    }

  ?>

  </tbody>
</table>

<script type="text/javascript">
  $(document).ready(function(){
    $('#role').DataTable( {
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

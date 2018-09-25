<?php
  require_once "config.php";
?>
<table class="table table-hover table-condensed table-bordered" id="usuarios">
  <thead>
    <tr>
      <th>Nro</th>
      <th>Nombre</th>
      <th>CI</th>
      <th>Celular</th>
      <th>Direccion</th>
      <th>Usuario</th>
      <th>Fecha Nacimiento</th>
      <th>Cargo</th>
      <th>Opciones</th>
    </tr>
  </thead>
  <tbody>
  <?php
    $i=0;
    $query="select u.codUsuario,
                   u.nombre,
                   u.ci,
                   u.cel,
                   u.direccion,
                   u.usuario,
                   date_format(u.fechaNacimiento,'%d/%m/%Y'),
                   r.role
                   from usuario u, role r
                   where u.codRole=r.codRole";
    // $result=mysql_query($query);
    $buscarU=$con->query($query);
    while($row=$buscarU->fetch(PDO::FETCH_NUM))
    {
      echo "<tr>
              <td>$row[0]</td>
              <td>$row[1]</td>
              <td>$row[2]</td>
              <td>$row[3]</td>
              <td>$row[4]</td>
              <td>$row[5]</td>
              <td>$row[6]</td>
              <td>$row[7]</td>
              <td style='text-align: center;'><span class='btn btn-warning btn-sm' data-toggle='modal' data-target=''#modalEditarUsuario' onclick='llenarDatos( $row[0] )'>
                    <span class='fa fa-pencil-square-o'></span>
                  </span>
                  <span class='btn btn-danger btn-sm' onclick='borrarUsuario( $row[0] )'>
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
    $('#usuarios').DataTable( {
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

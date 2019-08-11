<?php
  require_once "config.php";
?>
<table class="table table-hover table-condensed table-bordered" id="usuarios">
  <thead>
    <tr>
      <th>Cod</th>
      <th>Nombre</th>
      <th>Usuario</th>
      <th>CI</th>
      <th>Cargo</th>
      <th>Foto</th>
      <th>Linea Empresa</th>
      <th>Almacen</th>
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
                   r.role,
                   u.foto
                   from usuario u, role r
                   where u.codRole=r.codRole";
    // $result=mysql_query($query);
    $buscarU=$con->query($query);
    while($row=$buscarU->fetch(PDO::FETCH_NUM))
    {
      $cod=$row[0];
      $q1="select l.linea as linea from asignacionlinea al, lineaempresa l where al.codLineaEmpresa=l.codLineaEmpresa and al.codUsuario=$cod and al.estado=1";
      $buscarQ1=$con->query($q1);
      $rowQ1=$buscarQ1->fetch(PDO::FETCH_NUM);

      $q2="select a.almacen as almacen from almacen a, asignacionalmacen aa where a.codAlmacen=aa.codAlmacen and aa.codUsuario=$cod and aa.estado=1";
      $buscarQ2=$con->query($q2);
      $rowQ2=$buscarQ2->fetch(PDO::FETCH_NUM);

      echo "<tr>
              <td>$row[0]</td>
              <td>$row[1]</td>
              <td>$row[5]</td>
              <td>$row[2]</td>
              <td>$row[7]</td>
              <td><img style='max-width: 50px ' class='img-fluid' src='foto/$row[8]' ></td>
              <td>$rowQ1[0]</td>
              <td>$rowQ2[0]</td>
              <td style='text-align: center;'><span class='btn btn-warning btn-sm fa fa-pencil-square-o' data-toggle='modal' data-target=''#modalEditarUsuario' onclick='llenarDatos( $row[0] )'>
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

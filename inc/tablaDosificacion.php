<?php
  require_once "config.php";
?>
<table class="table table-hover table-condensed table-bordered" id="dataTable">
  <thead>
    <tr class="btn-primary">
      <th>Fecha Registro</th>
      <th>NIT</th>
      <th>Llave</th>
      <th>Nro Autorizacion</th>
      <th>Fecha Limite</th>
      <th>Estado</th>
      <th>Actividad Economica</th>
      <th>Opciones</th>
    </tr>
  </thead>
  <tbody>
  <?php
    $query="select date_format(d.fecha,'%d/%m/%Y %H:%i') as fecha, d.nit as nit, d.llave as llave, d.nroAutorizacion as autorizacion,
                   date_format(d.fechaLimite,'%d/%m/%Y') as fechaLimite, d.estado as estado, a.descripcion as actividadEconomica, d.codDosificacion as codDosificacion
            from dosificacion d, actividadeconomica a
            where d.codActividadEconomica=a.codActividadEconomica";
    // $result=mysql_query($query);
    $buscarU=$con->query($query);
    while($row=$buscarU->fetch(PDO::FETCH_NUM))
    {
      if($row[5]==1)
      {
        $row[5]="<span class='btn-primary'>Activo</span>";
      }
      else {
        // code...
        $row[5]="<span class='btn-secondary'>Inactivo</span>";
      }
      $ll=substr($row[2], 0, 30).'...';
      $ae=substr($row[6], 0, 30).'...';
      echo "<tr>
              <td>$row[0]</td>
              <td>$row[1]</td>
              <td><a href='#' title='$row[2]'>$ll</a></td>
              <td>$row[3]</td>
              <td>$row[4]</td>
              <td>$row[5]</td>
              <td><a href='#' title='$row[6]'>$ae</a></td>
              <td style='text-align: center;'>
                <span class='btn btn-warning btn-sm fa fa-pencil' data-toggle='modal' data-target=''#modalEditar' onclick='llenarDatos( $row[7] )'>
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

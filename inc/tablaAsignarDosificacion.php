<?php
  require_once "config.php";
?>
<table class="table table-hover table-condensed table-bordered" id="dataTable">
  <thead>
    <tr class="btn-primary">
      <th>Cod</th>
      <th>Nombre</th>
      <th>Usuario</th>
      <th>Linea Empresarial</th>
      <th>Almacen</th>
      <th>Punto Venta</th>
      <th>Estado Dosificacion</th>
      <th>Nro Autorizacion</th>
      <th>Fecha Limite</th>
      <th>Actividad Economica</th>
      <th>Opciones</th>
    </tr>
  </thead>
  <tbody>
  <?php
    // $query="select date_format(d.fecha,'%d/%m/%Y %H:%i') as fecha, d.nit as nit, d.llave as llave, d.nroAutorizacion as autorizacion,
    //                date_format(d.fechaLimite,'%d/%m/%Y') as fechaLimite, d.estado as estado, a.descripcion as actividadEconomica, d.codDosificacion as codDosificacion
    //         from dosificacion d, actividadeconomica a
    //         where d.codActividadEconomica=a.codActividadEconomica";

    $query="SELECT * from usuario where codUsuario <> 0 and estado=1";
    // $result=mysql_query($query);
    $buscarU=$con->query($query);
    while($row=$buscarU->fetch(PDO::FETCH_NUM))
    {

      // if($row[5]==1)
      // {
      //   $row[5]="<span class='btn-primary'>Activo</span>";
      // }
      // else {
      //   // code...
      //   $row[5]="<span class='btn-secondary'>Inactivo</span>";
      // }
      // $ll=substr($row[2], 0, 30).'...';
      // $ae=substr($row[6], 0, 30).'...';
      // <td><a href='#' title='$row[2]'>$ll</a></td>
      $cod=$row[0];
      $qa="select date_format(d.fecha,'%d/%m/%Y %H:%i') as fecha,
                  d.nit as nit,
                  d.llave as llave,
                  d.nroAutorizacion as autorizacion,
                  date_format(d.fechaLimite,'%d/%m/%Y') as fechaLimite,
                  asi.estado as estado,
                  a.descripcion as actividadEconomica,
                  d.codDosificacion as codDosificacion,
                  p.nombre as puntoVenta
           from dosificacion d, actividadeconomica a, asignacion asi, usuario u, puntoventa p
           where d.codActividadEconomica=a.codActividadEconomica and asi.codDosificacion=d.codDosificacion and asi.codUsuario=u.codUsuario and asi.codPuntoVenta=p.codPuntoVenta and asi.estado=1 and u.codUsuario=$cod";
      $buscarQA=$con->query($qa);
      $rowQA=$buscarQA->fetch(PDO::FETCH_NUM);
      $ll=substr($rowQA[6], 0, 30).'...';
      // $ae=substr($row[6], 0, 30).'...';
      if($rowQA[5]==1)
      {
        $rowQA[10]="<span class='btn-primary'>Activo</span>";
      }
      else {
        // code...
        $rowQA[10]="<span class='btn-secondary'>Sin Asignacion</span>";
        $rowQA[8]="<span class='btn-secondary'>Sin Asignacion</span>";
        $rowQA[3]="<span class='btn-secondary'>Sin Asignacion</span>";
        $rowQA[4]="<span class='btn-secondary'>Sin Asignacion</span>";

      }

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
              <td>$rowQ1[0]</td>
              <td>$rowQ2[0]</td>
              <td>$rowQA[8]</td>
              <td>$rowQA[10]</td>
              <td>$rowQA[3]</td>
              <td>$rowQA[4]</td>
              <td><a href='#' title='$rowQA[6]'>$ll</a></td>
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

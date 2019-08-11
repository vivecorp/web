<?php
  session_start();
  if(!$_SESSION['codUsuarioG'] || $_SESSION['roleG']!=1)
  {
  	header("location: login.php");
  }
  require_once "inc/config.php";
  header('Content-type:application/xls');
  header('Content-Disposition: attachment; filename="reporteExistencias.xls"');


  $rdoProducto=$_POST['rdoProducto'];
  $fecha=date("d/m/Y");
  // will output 2 days

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <style media="screen">
    table th{

    }
  </style>
</head>
<body>
  <h2 align="center">Reporte de Existencias</h2>
  <h3 align="center"><?php echo $fecha; ?></h3>
  <!-- Navbar-->
  <table border="1">
    <thead>
      <tr style="font-size: 11px; background: #c8c8c8;">
        <th>Art.</th>
        <th>Producto</th>
        <th>Unidad</th>
        <th>Foto</th>
        <th>Linea Empresarial</th>
        <th>Existencias</th>
        <th>Precio de Venta</th>
        <th>Sub Total Venta</th>
      </tr>
    </thead>
    <tbody >
    <?php
      $cad="";
      $query="select sum(i.cantidad) as cantidad,
                     p.descripcion as producto,
                     p.codProducto as codProducto,
              	     p.articulo as articulo,
                     p.foto as foto,
                     p.codigoBarra as codigoBarra,
                     l.linea as linea,
                     um.sigla as sigla
              from inventario i, producto p, lineaempresa l, unidadmedida um
              where i.codProducto=p.codProducto and
              	    l.codLineaEmpresa=p.codLineaEmpresa and
                    um.codUnidadMedida=p.codUnidadMedida
                    group by i.codProducto";
      // $result=mysql_query($query);
      $buscarU=$con->query($query);
      $total=0;
      while($row=$buscarU->fetch(PDO::FETCH_BOTH))
      {
        $codProducto=$row[2];
        $q="select precio from precioventa where codProducto=$codProducto and estado=1";
        $buscarQ=$con->query($q);
        $rowQ=$buscarQ->fetch(PDO::FETCH_BOTH);
        $precio=$rowQ[0];
        $cantidad=$row[0];
        $sub=$cantidad * $precio;
        $total=$total+$sub;
        echo "<tr >
                <td>$row[3]</td>
                <td>$row[1]</td>
                <td>$row[7]</td>
                <td><img src='productos/$row[4]' width='40'></td>
                <td>$row[6]</td>
                <td>$row[0]</td>
                <td>$rowQ[0]</td>
                <td>$sub</td>
              </tr>";
      }
    ?>
      <tr>
        <td colspan="7">
          Total (Bs)
        </td>
        <td>
          <?php echo $total; ?>
        </td>
      </tr>
    </tbody>

  </table>
  <!-- contenido inicio -->
</body>
</html>

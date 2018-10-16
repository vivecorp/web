<?php
session_start();
if(!$_SESSION['codUsuarioG'] || $_SESSION['roleG']!=1)
{
  header("location: login.php");
}
require_once "inc/config.php";
require "inc/obtener.php";
require "inc/numeros.php";

$codInventarioG=$_GET['codInventario'];
$queryOC="select i.fecha as fecha, i.cantidad as cantidad, i.codDetalleCompras as codDetalleCompras,
          	     p.articulo as articulo, p.descripcion as producto, a.almacen as almacen,
                 pr.empresa as proveedor, p.foto as foto, um.sigla as sigla,
                 tm.tipoMovimiento as tipoMovimiento, m.estado as estadoMaterial, u.nombre as usuario, dc.codCompras as codCompras
          from unidadmedida um, inventario i, producto p, proveedor pr, almacen a, tipomovimiento tm, estadomaterial m, usuario u, detallecompras dc, compras c
          where i.codProducto=p.codProducto and
          	    i.codAlmacen=a.codAlmacen and
                i.codTipoMovimiento=tm.codTipoMovimiento and
                i.codEstadoMaterial=m.codEstadoMaterial and
                i.codUsuario=u.codUsuario and
                i.codDetalleCompras=dc.codDetalleCompras and
                dc.codCompras=c.codCompras and
                p.codUnidadMedida=um.codUnidadMedida and
                c.codProveedor=pr.codProveedor and
                i.codInventario=$codInventarioG";
$buscarC=$con->query($queryOC);
if($row=$buscarC->fetch(PDO::FETCH_ASSOC))
{
  $fecha=$row['fecha'];
  $fechaLiteral=obtenerfechaCastellano($fecha);
  $cantidad=$row['cantidad'];
  $articulo=$row['articulo'];
  $producto=$row['producto'];
  $almacen=$row['almacen'];
  $tipoMovimiento=$row['tipoMovimiento'];
  $proveedor=$row['proveedor'];
  $foto=$row['foto'];
  $estadoMaterial=$row['estadoMaterial'];
  $sigla=$row['sigla'];


  $codCompras=$row['codCompras'];
  $usuario=$row['usuario'];
}
ob_start();
?>
<page backtop="00mm" backbottom="0mm"  >
  <page_header>
  </page_header>
  <page_footer>

  </page_footer>

  <table cellspacing="0" style="width: 100%; height:50%; font-size: 16;" border="1" >
    <tr >
      <td style="width: 25%;" align="center"><img src="images/logo.jpg" width="150" align="middle" ></td>
      <td style="width: 50%;" align="center"><h3>NOTA DE INGRESO MATERIAL</h3><h3>No: <?php echo $codInventarioG; ?></h3></td>
      <td style="width: 25%;" align="center"><img src="logos/logo.jpg" width="150" align="middle" ></td>
    </tr>
    <tr>
      <td colspan="3"  align="center"  valign="top">
        <b>Cochabamba, <?php echo $fechaLiteral; ?></b>
      </td>
    </tr>
    <tr>
      <td colspan="3" >
        <table style="width: 100%;" border="0" cellspacing="0" >
          <tr >
            <td style="width: 25%;" valign="middle" align="right"><b>Responsable: </b></td>
            <td style="width: 25%;" valign="middle" align="left"><?php echo $usuario; ?></td>
            <td style="width: 25%;" valign="middle" align="right"><b>OC Nro: </b></td>
            <td style="width: 25%;" valign="middle" align="left"><?php echo $codCompras; ?></td>
          </tr>
          <tr >
            <td style="width: 25%;" valign="middle" align="right"><b>Proveedor: </b></td>
            <td style="width: 25%;" valign="middle" align="left"><?php echo $proveedor; ?></td>
            <td style="width: 25%;" valign="middle" align="right"><b>Almacen: </b></td>
            <td style="width: 25%;" valign="middle" align="left"><?php echo $almacen; ?></td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td colspan="3" align="left" style="height:30%;" valign="top" >
        <br>
        <table style="width: 90%;" border="1" cellspacing="0" align="center">
          <tr>
            <th style="width: 15%;" valign="middle" align="center">Articulo</th>
            <th style="width: 20%;" valign="middle" align="center">Producto</th>
            <th style="width: 20%;" valign="middle" align="center">Foto</th>
            <th style="width: 15%;" valign="middle" align="center">Unidad</th>
            <th style="width: 15%;" valign="middle" align="center">Cantidad</th>
            <th style="width: 15%;" valign="middle" align="center">Estado</th>
          </tr>
          <tr>
            <td style="width: 15%;" valign="middle" align="center"><?php echo $articulo; ?></td>
            <td style="width: 20%;" valign="middle" align="center"><?php echo $producto; ?></td>
            <td style="width: 20%;" valign="middle" align="center"><img src="productos/<?php echo $foto; ?>" width="50" ></td>
            <td style="width: 15%;" valign="middle" align="center"><?php echo $sigla; ?></td>
            <td style="width: 15%;" valign="middle" align="center"><?php echo $cantidad; ?></td>
            <td style="width: 15%;" valign="middle" align="center"><?php echo $estadoMaterial; ?></td>
          </tr>
        </table>
        <br>
        Obs: <?php echo $tipoMovimiento; ?>
      </td>
    </tr>
    <tr>
      <td colspan="3" >
        <table style="width: 100%;" border="1" cellspacing="0" align="center">
          <tr >
            <td style="width: 25%; height:20%;" valign="top">Preparado</td>
            <td style="width: 25%;" valign="top">Revisado</td>
            <td style="width: 25%;" valign="top">Aprobado</td>
            <td style="width: 25%;" valign="top">Contabilizado</td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</page>

<?php
// Output-Buffer in variable:

$content=ob_get_clean();
// delete Output-Buffer
require_once('html2pdf-4.5.1/vendor/autoload.php');
//$html2pdf = new HTML2PDF('P', array(216,216), 'fr', true, 'UTF-8', array(15, 5, 15, 5));
$html2pdf = new HTML2PDF('P', 'LETTER', 'fr', true, 'UTF-8', array(15, 15, 15, 10));
        //$html2pdf->pdf->SetDisplayMode('fullpage');
		// $html2pdf->pdf->IncludeJS("print(true);");
$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
$html2pdf->Output('comprobanteEgreso.pdf');

?>

<?php
session_start();
if(!$_SESSION['codUsuarioG'] || $_SESSION['roleG']!=1)
{
  header("location: login.php");
}
require_once "inc/config.php";
require "inc/obtener.php";
$codComprasG=$_GET['codCompras'];
$queryOC="select c.fecha as fecha, c.observacion as observacion,
	   c.total as total, u.nombre as usuario, p.empresa as proveedor,
       p.pais as pais, p.contacto as contacto, p.cel as cel, p.email as email
from compras c, proveedor p, usuario u
where c.codCompras=$codComprasG and c.codProveedor=p.codPRoveedor and c.codUsuario=u.codUsuario ";
$buscarC=$con->query($queryOC);
if($row=$buscarC->fetch(PDO::FETCH_ASSOC))
{
  $usuario=$row['usuario'];
  $fecha=$row['fecha'];
  $observacion=$row['observacion'];
  $total=$row['total'];
  $proveedor=$row['proveedor'];
  $pais=$row['pais'];
  $contacto=$row['contacto'];
  $cel=$row['cel'];
  $email=$row['email'];

}
ob_start();
?>
<page backtop="00mm" backbottom="0mm"  >
  <page_header>
  </page_header>
  <page_footer>
    <table style="width: 100%; border: solid 1px black;">
      <tr>
        <td style="text-align: center;    width: 100%">Pagina [[page_cu]]/[[page_nb]]</td>
      </tr>
    </table>
  </page_footer>

  <table cellspacing="0" style="width: 100%; height:100%; font-size: 16;" border="1" >
    <tr >
      <td style="width: 30%;" align="center"><img src="images/logo.jpg" width="150" align="middle" ></td>
      <td style="width: 40%;" align="center"><h2>ORDEN DE COMPRA</h2><h3>No: <?php echo $codComprasG; ?></h3></td>
      <td style="width: 30%;" align="center"><img src="logos/logo.jpg" width="150" align="middle"></td>
    </tr>
    <tr>
      <td colspan="3" style="height:80%;"  valign="top">
        <table border="0" style="width: 100%;">
          <tr>
            <td colspan="5" style="width: 100%;"></td>
          </tr>
          <tr >
            <td colspan="2" style="">
              <h4>Informacion de Orden de Compra</h4>
            </td>
            <td></td>
            <td align="right">
              <h4>Usuario:</h4>
            </td>
            <td align="left">
              <h4><?php echo $usuario; ?></h4>
            </td>
          </tr>
          <tr>
            <td align="right" style="font-weight:bold;">Fecha:</td>
            <td align="left"><?php echo $fecha; ?></td>
            <td></td>
            <td align="right" style="font-weight:bold;">Procedencia:</td>
            <td align="left"><?php echo $pais; ?></td>
          </tr>
          <tr>
            <td align="right" style="font-weight:bold;">Proveedor:</td>
            <td align="left"><?php echo $proveedor; ?></td>
            <td></td>
            <td align="right" style="font-weight:bold;">Contacto:</td>
            <td align="left"><?php echo $contacto; ?></td>
          </tr>
          <tr>
            <td align="right" style="font-weight:bold;">Cel:</td>
            <td align="left"><?php echo $cel; ?></td>
            <td></td>
            <td align="right" style="font-weight:bold;">Email:</td>
            <td align="left"><?php echo $email; ?></td>
          </tr>
          <tr>
            <td colspan="5" style="width: 100%;"></td>
          </tr>
          <tr >
            <td colspan="5" style="">
              <h4>Detalle de Compra</h4>
            </td>
          </tr>
          <tr>
            <td colspan="5" align="center">
              <table border="1" cellspacing="0" style="width:100%; font-size:14px;" align="center">
                <tr>
                  <th style="width:10%;" valign="middle">Articulo</th>
                  <th style="width:25%;" valign="middle">Producto</th>
                  <th style="width:15%;" valign="middle">Foto</th>
                  <th style="width:10%;" valign="middle">Unidad</th>
                  <th style="width:10%;" valign="middle">Cantidad</th>
                  <th style="width:10%;" valign="middle">Precio (Bs)</th>
                  <th style="width:10%;" valign="middle">Desc (%)</th>
                  <th style="width:10%;" valign="middle">Sub Total (Bs)</th>
                </tr>
                <?php
                  $queryDP="select p.articulo as articulo, p.descripcion as descripcion,
                               p.foto as foto, u.unidad as unidad, d.precio as precio,
                               d.cantidad as cantidad, d.descuento as descuento, d.subTotal as subTotal from
                               detallecompras d, producto p, unidadmedida u where
                               d.codCompras=$codComprasG and d.codProducto=p.codProducto and p.codUnidadMedida=u.codUnidadMedida";
                  $buscar=$con->query($queryDP);
                  while($row=$buscar->fetch(PDO::FETCH_NUM))
                  {
                    echo "<tr style='font-size:12px;'>
                      <td style='width:10%;' valign='middle'>$row[0]</td>
                      <td style='width:25%;' valign='middle'>$row[1]</td>
                      <td style='width:15%;' valign='middle'><img src='productos/$row[2]' width='50'></td>
                      <td style='width:10%;' valign='middle'>$row[3]</td>
                      <td style='width:10%;' valign='middle'>$row[5]</td>
                      <td style='width:10%;' valign='middle'>$row[4]</td>
                      <td style='width:10%;' valign='middle'>$row[6]</td>
                      <td style='width:10%;' valign='middle'>$row[7]</td>
                    </tr>";
                  }
                  echo "
                  <tr>
                    <th colspan='7'>
                      TOTAL
                    </th>
                    <th>
                      $total
                    </th>
                  </tr>"
                ?>

              </table>
            </td>
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
$html2pdf->Output('registro.pdf');

?>

<?php
session_start();
if(!$_SESSION['codUsuarioG'] || $_SESSION['roleG']!=1)
{
  header("location: login.php");
}
require_once "inc/config.php";
require "inc/obtener.php";
require "inc/numeros.php";

$codPagosG=$_GET['codPagos'];
$queryOC="select p.fecha as fecha, p.monto as monto, p.destinatario as destinatario,
          	     p.comprobante as comprobante, p.glosa as concepto, t.codTipoPago as codTipoPago,
                 b.banco as banco, p.codCompras as codCompras, u.nombre as usuario
          from pagos p, bancos b, tipopago t, usuario u
          where p.codTipoPago=t.codTipoPago and
          	    p.codBancos=b.codBancos and
                p.codUsuario=u.codUsuario and
                p.codPagos=$codPagosG";
$buscarC=$con->query($queryOC);
if($row=$buscarC->fetch(PDO::FETCH_ASSOC))
{
  $fecha=$row['fecha'];
  $fechaLiteral=obtenerfechaCastellano($fecha);
  $monto=$row['monto'];
  $montoD=number_format($monto, 2, '.', '');
  $destinatario=$row['destinatario'];
  $comprobante=$row['comprobante'];
  $concepto=$row['concepto'];
  $tipoPago=$row['codTipoPago'];
  $banco=$row['banco'];

  if($tipoPago==1)
  {
    $cadTipoPago="<b>EN EFECTIVO</b>";
  }
  if($tipoPago==2)
  {
    $cadTipoPago="<b>CHEQUE Nro</b> $comprobante <b>BANCO</b>: $banco";
  }
  if($tipoPago==3)
  {
    $cadTipoPago="<b>TRANSFERENCIA BANCARIA Nro</b> $comprobante <b>BANCO</b>: $banco";
  }
  if($tipoPago==4)
  {
    $cadTipoPago="<b>TRANSFERENCIA EXTRANJERO Nro</b> $comprobante <b>BANCO</b>: $banco";
  }
  if($tipoPago==5)
  {
    $cadTipoPago="<b>TARJETA CREDITO/DEBITO</b> $comprobante <b>BANCO</b>: $banco";
  }
  $codCompras=$row['codCompras'];
  $cadCompras="";
  if($codCompras != 0)
  {
    $cadCompras=" Segun OC Nro $codCompras";
  }
  else {
    $cadCompras="";
  }
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
      <td style="width: 50%;" align="center"><h3>COMPROBANTE DE EGRESO</h3><h3>No: <?php echo $codPagosG; ?></h3></td>
      <td style="width: 25%;" align="center"><h3><?php echo $montoD; ?> (Bs)</h3></td>
    </tr>
    <tr>
      <td colspan="3" style="height:50%;" align="center"  valign="top">
        <br>
        <table  style="width: 100%; border: 2px" align="center">
          <tr>
            <td style="width: 90%; height:25px;" valign="middle">
              <b>Cochabamba, <?php echo $fechaLiteral; ?></b>
            </td>
          </tr>
        </table>
        <br>
        <table  style="width: 100%;" border="1" cellspacing="0" align="center">
          <tr>
            <td style="width: 90%; height:25px;" align="left" valign="middle">
              <b>Pagado a:</b> <?php echo $destinatario; ?>
            </td>
          </tr>
          <tr>
            <td style="width: 90%; height:25px;" align="left" valign="middle">
              <b>Por Concepto de:</b> <?php echo $concepto." ".$cadCompras; ?>
            </td>
          </tr>
          <tr>
            <td style="width: 90%; height:25px;" align="left" valign="middle">
              <b>La Suma de:</b> <?php echo numtoletras($monto); ?>
            </td>
          </tr>
          <tr>
            <td style="width: 90%; height:25px;" align="left" valign="middle">
              <?php echo $cadTipoPago; ?>
            </td>
          </tr>
        </table>
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

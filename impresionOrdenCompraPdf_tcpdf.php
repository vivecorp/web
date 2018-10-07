<?php
// Include the main TCPDF library (search for installation path).
require_once('tcpdf/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


// set default header data
// $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->setPrintHeader(false);
// $pdf->setPrintFooter(false);
// set default monospaced font

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusans', '', 10);

// add a page
$pdf->AddPage();

// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)


// create some HTML content
$codCompras=$_GET['codCompras'];

$html = '
<table border="2" width="100%" >
    <tr >
      <th  height="90" align="center"><br><br><img src="images/logo.jpg" width="150" align="middle" ></th>
      <th align="center"><br><h2>ORDEN DE COMPRA</h2><h3>No:'.$codCompras.' </h3></th>
      <th style="text-align:center; vertical-align:middle;"><br><br><img src="logos/logo.jpg" width="150" align="middle"></th>
    </tr>
    <tr>
      <td height="750" colspan="3" >
          <table border="1" style="width: 90%; border: solid 0px #000000; ">
            <tr>
              <td colspan="5">Informacion de Compra</td>
            </tr>
            <tr>
              <td>Fecha:</td>
              <td>12/09/2018</td>
              <td>j</td>
              <td>Procedencia</td>
              <td>China</td>
            </tr>
          </table>
      </td>
    </tr>
</table>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, 'C');
// $pdf->writeHTMLCell(100, '', '', '', $html, 1, 1, 1, true, 'C', true);
//Close and output PDF document
$pdf->Output('example_006.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>

<?php
session_start();
if(!$_SESSION['codUsuarioG'] || $_SESSION['roleG']==3)
{
header("location: login.php");
}
require_once "inc/config.php";
require "inc/obtener.php";
require "inc/numeros.php";


$codVentas=$_GET["codVentas"];
$queryOV="select f.codFactura as codFactura, date_format(f.fecha,'%d/%m/%Y') as fecha, date_format(f.hora,'%H:%i') as hora,
                 f.nroFactura as nroFactura, f.razonSocial as razonSocial, f.nit as nit, f.codControl as codControl,
                 f.qr as qr, f.total as total, f.descuento as descuento,
                 date_format(d.fechaLimite, '%d/%m/%Y') as fechaLimite, d.nit as nitEmpresa,
                 d.nroAutorizacion as nroAutorizacion, u.nombre as usuario, ae.abreviatura as actividadEconomica,
                 pv.nombre as puntoVenta,f.flete as flete
            from factura f, dosificacion d, asignacion a, usuario u, actividadeconomica ae, puntoventa pv
            where f.codAsignacion=a.codAsignacion and a.codPuntoVenta=pv.codPuntoVenta and
                  a.codDosificacion=d.codDosificacion and d.codActividadEconomica=ae.codActividadEconomica and
                  f.codUsuario=u.codUsuario and  f.codVentas=$codVentas";
$resultOV=$con->query($queryOV);
if($resultOV->rowCount() == 1){
   // existe usuario
  $rowOV=$resultOV->fetch(PDO::FETCH_ASSOC);
  $codFactura=$rowOV['codFactura'];
  $fecha=$rowOV['fecha'];
  $hora=$rowOV['hora'];
  $nroFactura=$rowOV['nroFactura'];
  $razonSocial=$rowOV['razonSocial'];
  $nitCliente=$rowOV['nit'];
  $codControl=$rowOV['codControl'];
  $qr=$rowOV['qr'];
  $total=$rowOV['total'];
  $total=round($total,2);
  $descuento=$rowOV['descuento'];
  $fechaLimite=$rowOV['fechaLimite'];
  $nitEmpresa=$rowOV['nitEmpresa'];
  $nroAutorizacion=$rowOV['nroAutorizacion'];
  $usuario=$rowOV['usuario'];
  $actividadEconomica=$rowOV['actividadEconomica'];
  $puntoVenta=$rowOV['puntoVenta'];
  $flete=$rowOV['flete'];

}else{
    echo "No se encontro ningun registro";
    return false;
}
// obtener datos de impresion
$qi="select * from parametrosimpresion where estado=1";
$resultQi=$con->query($qi);
if ($rowI=$resultQi->fetch(PDO::FETCH_ASSOC)) {
  $pag=$rowI['direccion'];
  // code...
}
else {
  $pag='rawbt.css';
}



// obtener parametros de la empresa
$qe="select * from parametros";
$resultQe=$con->query($qe);
if ($rowE=$resultQe->fetch(PDO::FETCH_ASSOC)) {
  $empresa=$rowE['empresa'];
  $sigla=$rowE['sigla'];
  $logo=$rowE['logo'];
  $nit=$rowE['nit'];
  $direccion=$rowE['direccion'];
  $telefono=$rowE['telefono'];
  $celular=$rowE['celular'];
  $ciudad=$rowE['ciudad'];
  $pais=$rowE['pais'];
  $leyendaConsumidor=$rowE['leyendaConsumidor'];

}
else {
  $empresa="Nombre de Empresa no definido";
  $direccion="no definido";
  $telefono="no definido";
  $celular="no definido";
}
 ?>
<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="css/<?php echo $pag; ?>">
    <script language="javascript">
      window.onfocus=function(){ window.close();}
    </script>
    <script type="text/javascript" src="js/qrcode.js"></script>
    <style media="screen">
    .contenedor{
      float:left;
    }

    .contenedor img{
      float: left;
    }
    </style>
</head>
<body onload="window.print();">
<!-- <body> -->
    <div class="invoice">
        <div class="header">
            <p class="company" style="line-height: 10px"><?php echo strtoupper($empresa); ?><br>
              <span class="lema" style="">Sucursal: <?php echo $puntoVenta; ?></span>
            </p>
            <p class="linespace-short"><strong><?php echo $direccion; ?></strong></p>
            <p class="linespace-short">Celular: <?php echo $celular; ?> <img src="images/whatsapp.png" width="15" alt=""></p>
            <p class="linespace-short">Telf: <?php echo $telefono; ?></p>
            <div class="group">
            </div>
            <p class="title" style="font-size: 20px;">FACTURA</p>

            <div class="group">

            </div>
            <p class="title">NIT: <?php echo $nitEmpresa; ?></p>
            <p class="title" style="font-size: 20px;">Factura No: <?php echo $nroFactura; ?></p>
            <p class="title">Autorizacion No: <?php echo $nroAutorizacion; ?></p>
            <div class="group">

            </div>
            <p class="linespace-short"><?php echo $actividadEconomica; ?></p>
        </div>

        <div class="group">
          <div class="header">
            <p class="title"><?php echo "$fecha $hora"; ?></p>
            <p class="linespace-short negrilla">Señor(es): <?php echo $razonSocial; ?></p>
            <p class="linespace-short">NIT/CI Cliente: <?php echo $nitCliente; ?></p>
          </div>
        </div>

        <div class="group">
          <p class="title"><strong>DETALLE DE VENTAS</strong></p>

            <table class="table" border="1" style="border-collapse: collapse;">
                <tr >
                  <td class="filaNegrilla">Art.</td>
                  <td style="width: 25%" class="filaNegrilla">Detalle</td>
                  <td class="right filaNegrilla">Cant.</td>
                  <td class="right filaNegrilla">Precio</td>
                  <td class="right filaNegrilla">Dsc (Bs)</td>
                  <td class="right filaNegrilla">Sub T</td>
                </tr>
                <?php

                  $queryODV="select p.articulo as articulo, p.descripcion as descripcion,
                                    u.sigla as sigla, d.cantidad as cantidad, d.precio as precio,
                                    d. descuento as descuento, d.subTotal as subTotal
                             from detallefactura d, producto p, unidadmedida u
                             where d.codProducto=p.codProducto and p.codUnidadMedida=u.codUnidadMedida and d.codFactura=$codFactura";
                  $buscarODV=$con->query($queryODV);
                  $t=0;
                  $d=0;
                  $tn=0;

                  while($rowODV=$buscarODV->fetch(PDO::FETCH_ASSOC))
                  {
                    $articuloF=$rowODV['articulo'];
                    $productoF=$rowODV['descripcion'];
                    $siglaF=$rowODV['sigla'];
                    $cantidadF=$rowODV['cantidad'];
                    $precioF=$rowODV['precio'];
                    $descuentoF=$rowODV['descuento'];
                    $subTotalF=$rowODV['subTotal'];
                    $a=$precioF*$cantidadF;
                    $descM=($a)*($descuentoF/100);
                    $descM=round($descM,2);

                    $t=$t+$a;
                    $d=$d+$descM;
                    $tn=$tn+$subTotalF;

                    echo "<tr>
                            <td>$articuloF</td>
                            <td>$productoF ($siglaF)</td>
                            <td class='right'>$cantidadF</td>
                            <td class='right'>$precioF</td>
                            <td class='right'>$descM</td>
                            <td class='right'><strong>$subTotalF</strong></td>
                          </tr>";
                  }
                  echo "<tr class='filaNegrilla'>
                          <td colspan='2' align='right'>
                            Total:
                          </td>
                          <td colspan='2' align='center'>
                            $t
                          </td>
                          <td align='center'>
                            $d
                          </td>
                          <td align='center'>
                            $tn
                          </td>
                        </tr>";

                  echo " <tr>
                          <td colspan='5' align='right'>
                            Flete
                          </td>
                          <td align='center'>
                            $flete
                          </td>
                         </tr>";
                   echo " <tr class='filaNegrilla'>
                           <td colspan='5' align='right'>
                             A Pagar
                           </td>
                           <td align='center'>
                             $total
                           </td>
                          </tr>";
                ?>

              </table>
            <p class="subtitle linespace-short">Total (Bs): <?php echo $total; ?></p>
        </div>
        <div>
            <p class="linespace-short">SON: <?php echo numtoletras($total); ?> </p>
            <div class="group">
            </div>

            <p class="filaNegrilla">CODIGO DE CONTROL: <?php echo $codControl; ?></p>
            <p class="filaNegrilla">FECHA LIMITE DE EMISION: <?php echo $fechaLimite; ?></p>
            <p >Usuario: <?php echo ucwords($usuario); ?></p>
            <table border="0">
              <tr>
                <td>
                  <div id="divQr" align="left" valign="middle" class="contenedor"></div>
                </td>
                <td>
                  <strong>"ESTA FACTURA CONTRIBUYE AL DESARROLLO DEL PAIS EL USO ILICITO DE ESTA SERA SANCIONADO DE ACUERDO A LA LEY"</strong>
                </td>
              </tr>
            </table>
            <p class="center linespace-short"><strong><?php echo strtoupper($leyendaConsumidor); ?></strong></p>
            <p align='center'>
              *** LA VIDA ES <span class="bella"> Bella </span> ***
            </p>
            <p align='center'>
              *** GRACIAS POR SU PREFERENCIA ***
            </p>
        </div>


    </div>


  <script type="text/javascript">
  var typeNumber = 8;
  var errorCorrectionLevel = 'M';
  var qr = qrcode(typeNumber, errorCorrectionLevel);
  q="<?php echo $qr; ?>";
  qr.addData(q);
  qr.make();
  // qr.cellSize("8");
  document.getElementById('divQr').innerHTML = qr.createImgTag();
  </script>
</body>
</html>

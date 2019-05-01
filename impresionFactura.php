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
                 d.nroAutorizacion as nroAutorizacion, u.nombre as usuario, ae.descripcion as actividadEconomica, pv.nombre as puntoVenta
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
  $nit=$rowOV['nit'];
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
</head>
<!-- <body onload="window.print();"> -->
<body>
    <div class="invoice">
        <div class="header">
            <p class="company" style="line-height: 10px"><?php echo $empresa; ?><br>
              <span class="lema" style="">Sucursal: <?php echo $puntoVenta; ?></span>
            </p>
            <p class="linespace-short"><strong><?php echo $direccion; ?></strong></p>
            <p class="linespace-short">Cel (Whatsapp): <?php echo $celular; ?></p>
            <p class="linespace-short">Telf: <?php echo $telefono; ?></p>
            <br>
            <div class="group">
            </div>
            <p class="title">FACTURA</p>
            <br>
            <div class="group">

            </div>
            <p class="title">NIT: <?php echo $nitEmpresa; ?></p>
            <p class="title">Factura No: <?php echo $nroFactura; ?></p>
            <p class="title">Autorizacion No: <?php echo $nroAutorizacion; ?></p>
            <br>
            <p class="title"><?php echo "$fecha $hora"; ?></p>

        </div>

        <div class="group">
          <div class="header">
            <p class="linespace-short negrilla">Señor(es): <?php echo $razonSocial; ?></p>
            <p class="linespace-short">NIT/CI Cliente: <?php echo $nit; ?></p>
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
                          <td>
                            $flete
                          </td>
                         </tr>";
                   echo " <tr class='filaNegrilla'>
                           <td colspan='5' align='right'>
                             A Pagar
                           </td>
                           <td>
                             $pagar
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
            <p >Usuario: <?php echo $usuario; ?></p>

            <p class="center linespace-short"><strong>"ESTA FACTURA CONTRIBUYE AL DESARROLLO DEL PAIS EL USO ILICITO DE ESTA SERA SANCIONADO DE ACUERDO A LA LEY"</strong></p>
            <br>
            <p class="center linespace-short"><strong>LEY No. 453 TIENES DERECHO A UN TRATO EQUITATIVO SIN DISCRIMINACION EN LA OFERTA DE PRODUCTOS.</strong></p>
            <br>
            <p align='center'>
              *** LA VIDA ES <span class="bella"> Bella </span> ***
            </p>
            <p align='center'>
              *** GRACIAS POR SU PREFERENCIA ***
            </p>
        </div>


    </div>
</body>
</html>

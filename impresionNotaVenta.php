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
$queryOV="select date_format(v.fecha,'%d/%m/%Y') as fecha,
                 date_format(v.fecha,'%H:%i') as hora,
                 v.razonSocial as razonSocial,
                 v.nit as nit,
                 v.total as total,
                 v.descuento as descuento,
                 v.flete as flete,
                 u.nombre as usuario,
                 l.linea as linea
            from ventas v, usuario u, lineaempresa l, asignacionlinea a
            where v.codUsuario=u.codUsuario and
                  v.codUsuario=a.codUsuario and
                  a.codLineaEmpresa=l.codLineaEmpresa and
                  v.codVentas=$codVentas";

$resultOV=$con->query($queryOV);
if($resultOV->rowCount() == 1){
   // existe usuario
  $rowOV=$resultOV->fetch(PDO::FETCH_ASSOC);
  $fecha=$rowOV['fecha'];
  $hora=$rowOV['hora'];
  $razonSocial=$rowOV['razonSocial'];
  $nitCliente=$rowOV['nit'];
  $total=$rowOV['total'];
  $total=round($total,2);
  $descuento=$rowOV['descuento'];
  $usuario=$rowOV['usuario'];
  $flete=$rowOV['flete'];
  $linea=$rowOV['linea'];

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
            <p class="company" style="line-height: 10px">"<?php echo strtoupper($linea); ?>"<br>
            </p>
            <p class="linespace-short"><strong><?php echo $direccion; ?></strong></p>
            <p class="linespace-short">Celular: <?php echo $celular; ?> <img src="images/whatsapp.png" width="15" alt=""></p>
            <p class="linespace-short">Telf: <?php echo $telefono; ?></p>
            <div class="group">
            </div>
            <p class="title" style="font-size: 20px;">NOTA DE VENTA</p>

            <p class="title" style="font-size: 20px;">Nota No: <?php echo $codVentas; ?></p>
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
                             from detalleventas d, producto p, unidadmedida u
                             where d.codProducto=p.codProducto and p.codUnidadMedida=u.codUnidadMedida and d.codVentas=$codVentas";
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
            <p >Usuario: <?php echo ucwords($usuario); ?></p>

            <p align='center'>
              *** LA VIDA ES <span class="bella"> Bella </span> ***
            </p>
            <p align='center'>
              *** GRACIAS POR SU PREFERENCIA ***
            </p>
        </div>


    </div>


  <script type="text/javascript">

  </script>
</body>
</html>

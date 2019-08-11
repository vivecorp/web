<?php
  require_once "../inc/config.php";
  include '../inc/control.php';

  $datos=array(
    $_POST['txtFactura'],
    $_POST['txtAutorizacion'],
    $_POST['txtFechaEmision'],
    $_POST['txtTotal'],
    $_POST['txtNitComprador'],
    $_POST['txtLlave']
  );
  // capturar foto
  $controlCode = new ControlCode();
  // llamar a la funcion de codigo de control para la Factura
  // $nroFactura=673173;
  // $nitCliente="1666188";
  // $fechaFactura="2008/08/10";
  // $total=51330;

  $code = $controlCode->generate($datos[1],//Numero de autorizacion
                                 $datos[0],//Numero de factura
                                 $datos[4],//Número de Identificación Tributaria o Carnet de Identidad
                                 str_replace('-','',$datos[2]),//fecha de transaccion de la forma AAAAMMDD
                                 $datos[3],//Monto de la transacción
                                 $datos[5]//Llave de dosificación
                                );

  $a=array(codControl => $code);
  echo json_encode($a);
?>

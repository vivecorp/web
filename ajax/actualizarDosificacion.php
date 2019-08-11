<?php
  require_once "../inc/config.php";
  $datos=array(
    $_POST['hdeCodA'],
    $_POST['txtNitA'],
    $_POST['txtLlaveA'],
    $_POST['txtAutorizacionA'],
    $_POST['txtFechaLimiteA'],
    $_POST['chkEstadoA'],
    $_POST['cmbActividadEconomicaA'],
  );
  if($datos[5]=='on')
  {
    $estado=1;
  }
  else {
    $estado=2;
  }
  $query="UPDATE dosificacion set
                    nit='$datos[1]',
                    llave='$datos[2]',
                    nroAutorizacion='$datos[3]',
                    fechaLimite='$datos[4]',
                    estado=$estado,
                    codActividadEconomica=$datos[6]
					where codDosificacion=$datos[0]";
  echo $actualizarU=$con->exec($query);
  // echo $query;
?>

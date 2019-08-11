<?php
  require_once "../inc/config.php";
  require_once "../inc/obtener.php";
  $datos=array(
  $_POST['hdeCodA'],
  $_POST['cmbLineaA'],
  $_POST['cmbAlmacenA'],
      );
  // buscar ultimo codigo de usuario
  $fecha=date("Y-m-d");
  $queryUL="update asignacionlinea set estado=2 where codUsuario=$datos[0]";
  $actualizarUL=$con->exec($queryUL);

  $codAsignacionLinea=obtenerUltimo('asignacionlinea','codAsignacionLinea');
  $query="INSERT INTO asignacionlinea values($codAsignacionLinea,'$fecha',1,$datos[0],$datos[1])";
  $insertar=$con->exec($query);

  $queryUL="update asignacionalmacen set estado=2 where codUsuario=$datos[0]";
  $actualizarUL=$con->exec($queryUL);

  $codAsignacion=obtenerUltimo('asignacionalmacen','codAsignacionAlmacen');
  $query="INSERT INTO asignacionalmacen values($codAsignacion,'$fecha',1,$datos[0],$datos[2])";
  echo $insertar=$con->exec($query);
?>

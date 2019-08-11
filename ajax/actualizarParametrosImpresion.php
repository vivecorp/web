<?php
  require_once "../inc/config.php";
  $datos=array(
    $_POST['hdeCodA'],
    $_POST['txtParametroA'],
    $_POST['txtDireccionA'],
    $_POST['chkEstadoA'],
  );
  // capturar foto
  if($datos[3])
  {
    $estado=1;
    $queryA="UPDATE parametrosimpresion set
                    estado=2";
    $actualizarA=$con->exec($queryA);

    $query="UPDATE parametrosimpresion set
                      parametro='$datos[1]',
                      direccion='$datos[2]',
                      estado=$estado
  					where codParametro=$datos[0]";
    echo $actualizarU=$con->exec($query);
    // echo $query;
  }
  else {
    $estado=2;
    
    $query="UPDATE parametrosimpresion set
                      parametro='$datos[1]',
                      direccion='$datos[2]',
                      estado=$estado
  					where codParametro=$datos[0]";
    echo $actualizarU=$con->exec($query);
  }

?>

<?php
  require_once "../inc/config.php";
  $datos=array(
  $_POST['hdeCodUnidadMedidaA'],
  $_POST['txtUnidadMedidaA'],
  $_POST['txtSiglaA']
      );
  $query="UPDATE unidadmedida set
                    unidad='$datos[1]',
                    sigla='$datos[2]'
					where codUnidadMedida=$datos[0]";
  echo $actualizarU=$con->exec($query);
?>

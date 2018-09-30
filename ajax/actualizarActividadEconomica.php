<?php
  require_once "../inc/config.php";
  $datos=array(
  $_POST['hdeCodActividadEconomicaA'],
  $_POST['txtCodigoA'],
  $_POST['txtActividadEconomicaA']
      );
  $query="UPDATE actividadeconomica set
                    codigo='$datos[1]',
                    descripcion='$datos[2]'
					where codActividadEconomica=$datos[0]";
  echo $actualizarU=$con->exec($query);
?>

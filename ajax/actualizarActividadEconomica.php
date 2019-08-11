<?php
  require_once "../inc/config.php";
  $datos=array(
  $_POST['hdeCodActividadEconomicaA'],
  $_POST['txtCodigoA'],
  $_POST['txtActividadEconomicaA'],
  $_POST['txtAbreviaturaA']
      );
  $query="UPDATE actividadeconomica set
                    codigo='$datos[1]',
                    descripcion='$datos[2]',
                    abreviatura='$datos[3]'
					where codActividadEconomica=$datos[0]";
  echo $actualizarU=$con->exec($query);
?>

<?php
  require_once "../inc/config.php";
  $datos=array(
  $_POST['hdeCodRoleA'],
  $_POST['txtRoleA']
      );
  // buscar ultimo codigo de usuario
  $query="UPDATE role set
                    role='$datos[1]'
					where codRole=$datos[0]";
  echo $actualizarU=$con->exec($query);
?>

<?php
  require_once "../inc/config.php";
  $datos=array(
  $_POST['hdeCodUsuarioA'],
  $_POST['txtNombreA'],
  $_POST['txtCiA'],
  $_POST['txtCelA'],
  $_POST['txtDireccionA'],
  $_POST['txtUsuarioA'],
  $_POST['txtPasswordA'],
  $_POST['txtNacimientoA'],
  $_POST['cmbRoleA'],
      );
  // buscar ultimo codigo de usuario
  $query="UPDATE usuario set
                    nombre='$datos[1]',
										ci='$datos[2]',
										cel='$datos[3]',
                    direccion='$datos[4]',
                    usuario='$datos[5]',
                    password='$datos[6]',
                    estado=1,
                    fechaNacimiento='$datos[7]',
                    codRole=$datos[8]
					where codUsuario=$datos[0]";
  echo $actualizarU=$con->exec($query);
?>

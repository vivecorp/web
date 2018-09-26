<?php
  require_once "../inc/config.php";
  $datos=array(
  $_POST['hdeCodProveedorA'],
  $_POST['txtEmpresaA'],
  $_POST['cmbPaisA'],
  $_POST['txtContactoA'],
  $_POST['txtEmailA'],
  $_POST['txtTelefonoA'],
  $_POST['txtCelularA'],
  $_POST['txtDireccionA']
      );
  // buscar ultimo codigo de usuario
  $query="UPDATE proveedor set
                    empresa='$datos[1]',
                    pais='$datos[2]',
                    contacto='$datos[3]',
                    email='$datos[4]',
                    tel='$datos[5]',
                    cel='$datos[6]',
                    direccion='$datos[7]'
					where codProveedor=$datos[0]";
  echo $actualizarU=$con->exec($query);
?>

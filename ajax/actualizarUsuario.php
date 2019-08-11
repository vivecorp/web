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
  $_POST['cmbRoleA']
      );
  // capturar foto
  $f='fileFotoA';
  $fotoO=$datos[0].".".pathinfo($_FILES[$f]['name'], PATHINFO_EXTENSION);
  // logo upload
  if ($_FILES[$f]["error"] > 0)
  {
    if($_FILES[$f]["error"] == 4)
    {
      if (file_exists("../foto/" . $fotoO))
      {
        $fotoO=$fotoO;
      }
      else {
        // code...
        $fotoO="defecto.jpg";
      }
    }
    else {
      echo "Error de subida: " . $_FILES[$f]['error'];
      return false;
    }

  }
  else
  {
    /*ahora co la funcion move_uploaded_file lo guardaremos en el destino que queramos*/
    if (file_exists("../foto/" . $fotoO))
    {
      unlink("../foto/" . $fotoO);
    }
    move_uploaded_file($_FILES[$f]['tmp_name'],"../foto/" . $fotoO);
    // echo "subio";
  }
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
                    codRole=$datos[8],
                    foto='$fotoO'
					where codUsuario=$datos[0]";
  $actualizarU=$con->exec($query);
  if($actualizarU==0)
  {
    $actualizarU=1;
  }
  echo $actualizarU;
?>

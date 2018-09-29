<?php
  require_once "../inc/config.php";
  $datos=array(
  $_POST['hdeCodLineaEmpresaA'],
  $_POST['txtLineaEmpresaA'],
  1
      );
  $fotoO=$_FILES['fileLogoA']['name'];
  $fotoO=$datos[0].$fotoO;
  if ($_FILES['fileLogoA']["error"] > 0)
  {
    echo  "Error: " . $_FILES['fileLogoA']['error'];

  }
  else
  {
    /*ahora co la funcion move_uploaded_file lo guardaremos en el destino que queramos*/
    move_uploaded_file($_FILES['fileLogoA']['tmp_name'],"../logos/" . $fotoO);
  }
  $query="UPDATE lineaempresa set
                    linea='$datos[1]',
                    logo='$fotoO',
                    estado=$datos[2]
					where codLineaEmpresa=$datos[0]";
  echo $actualizarU=$con->exec($query);
?>

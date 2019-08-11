<?php
  require_once "../inc/config.php";
  $datos=array(
    $_POST['hdeCodA'],
    $_POST['txtEmpresaA'],
    $_POST['txtSiglaA'],
    $_POST['txtNitA'],
    $_POST['txtDireccionA'],
    $_POST['txtTelefonoA'],
    $_POST['txtCelularA'],
    $_POST['txtEmailA'],
    $_POST['txtCiudadA'],
    $_POST['txtPaisA'],
    $_POST['txtTipoCambioA'],
    $_POST['txtLeyendaConsumidorA']
  );
  // capturar foto
  $f='fileFotoA';
  if(!empty($_FILES[$f]))
  {
		$fotoO=$datos[0].".".pathinfo($_FILES[$f]['name'], PATHINFO_EXTENSION);
		if ($_FILES[$f]["error"] > 0)
		{
			if($_FILES[$f]["error"] == 4)
			{
				$fotoO="defecto.jpg";
			}
			else {
				echo "Error de subida: " . $_FILES[$f]['error'];
				return false;
			}
		}
		else
		{
		  /*ahora co la funcion move_uploaded_file lo guardaremos en el destino que queramos*/
		  move_uploaded_file($_FILES[$f]['tmp_name'],"../images/" . $fotoO);
		}
	}
  else {
    // verificar si hay foto
    $qr="select * from parametros";
    $buscarU=$con->query($qr);
    $rowQ=$buscarU->fetch(PDO::FETCH_ASSOC);

    $fotoQ=$rowQ['logo'];
    if(!$fotoQ)
    {
      $fotoO="defecto.jpg";
    }
    else {
      if ($fotoQ != "defecto.jpg") {
        // code...
        $fotoO=$fotoQ;
      }
      else {
        $fotoO="defecto.jpg";
      }
    }
  }
  $query="UPDATE parametros set
                    empresa='$datos[1]',
                    sigla='$datos[2]',
                    logo='$fotoO',
                    nit='$datos[3]',
                    direccion='$datos[4]',
                    telefono='$datos[5]',
                    celular='$datos[6]',
                    email='$datos[7]',
                    ciudad='$datos[8]',
                    pais='$datos[9]',
                    tipoCambio=$datos[10],
                    leyendaConsumidor='$datos[11]'
					where codParametro=$datos[0]";
  echo $actualizarU=$con->exec($query);
?>

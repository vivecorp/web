<?php
  require_once "../inc/config.php";
  $datos=array(
    $_POST['hdeCodProductoA'],
    $_POST['txtArticuloA'],
    $_POST['txtDescripcionA'],
    $_POST['txtCodigoBarraA'],
    $_POST['cmbUnidadMedidaA'],
    $_POST['cmbLineaEmpresaA'],
    $_POST['cmbActividadEconomicaA'],
    1
      );
      // capturar foto
    	$f='fileFotoA';
      $fotoO=$datos[1].".".pathinfo($_FILES[$f]['name'], PATHINFO_EXTENSION);
    	// logo upload
    	if ($_FILES[$f]["error"] > 0)
    	{
    	  echo "Error de subiDA: " . $_FILES[$f]['error'];
    		return false;
    	}
    	else
    	{
    	  /*ahora co la funcion move_uploaded_file lo guardaremos en el destino que queramos*/
    	  move_uploaded_file($_FILES[$f]['tmp_name'],"../productos/" . $fotoO);
    	}
  $query="UPDATE producto set
                    articulo='$datos[1]',
                    descripcion='$datos[2]',
                    codigoBarra='$datos[3]',
                    foto='$fotoO',
                    estado=$datos[7],
                    codUnidadMedida=$datos[4],
                    codLineaEmpresa=$datos[5],
                    codActividadEconomica=$datos[6]
					where codProducto=$datos[0]";
  echo $actualizarU=$con->exec($query);
?>

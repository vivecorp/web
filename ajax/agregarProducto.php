<?php
	require_once "../inc/config.php";
	$datos=array(
		$_POST['txtArticulo'],
		$_POST['txtDescripcion'],
		$_POST['txtCodigoBarra'],
		1,
		$_POST['cmbUnidadMedida'],
		$_POST['cmbLineaEmpresa'],
		$_POST['cmbActividadEconomica']
				);
	// capturar foto
	$f='fileFoto';
	$fotoO=$_FILES[$f]['name'];
	// logo upload
	$fotoO=$datos[0]."_".$fotoO;
	if ($_FILES[$f]["error"] > 0)
	{
	  echo "Error de subida: " . $_FILES[$f]['error'];
		return false;
	}
	else
	{
	  /*ahora co la funcion move_uploaded_file lo guardaremos en el destino que queramos*/
	  move_uploaded_file($_FILES[$f]['tmp_name'],"../productos/" . $fotoO);
	}
		// buscar ultimo codigo de usuario
		$query="SELECT ifnull(max(codProducto)+1,1) as ult from producto";
		$result=$con->query($query);
		if($result->rowCount() == 1){
	    // existe
	    $row=$result->fetch(PDO::FETCH_NUM);
	    $codO=$row[0];
		}else{
			echo "No se encontro ningun registro";
			return false;
		}
		$sql="INSERT into producto	values (
												$codO,
												'$datos[0]',
												'$datos[1]',
												'$datos[2]',
												'$fotoO',
												$datos[3],
												$datos[4],
												$datos[5],
												$datos[6]
											)";
			echo $buscarU=$con->exec($sql);
			// echo $obj->agregarUsuario($datos);


 ?>

<?php
	require_once "../inc/config.php";
	$datos=array(
		$_POST['txtLineaEmpresa'],
		1
				);
	// informacion de archivo imagen
	// obtener los datos por post
$fotoO=$_FILES['fileLogo']['name'];
// verificar si el nombre del logo existe

	// buscar ultimo codigo de usuario
	$query="SELECT ifnull(max(codLineaEmpresa)+1,1) as ult from lineaempresa";
	$result=$con->query($query);
	if($result->rowCount() == 1){
    // existe
    $row=$result->fetch(PDO::FETCH_NUM);
    $codO=$row[0];
	}else{
		echo "No se encontro ningun registro";
		return false;
	}
	// logo upload
	$fotoO=$codO.$fotoO;
	if ($_FILES['fileLogo']["error"] > 0)
	{
	  echo "Error: " . $_FILES['fileLogo']['error'] . "<br>";
	}
	else
	{
	  /*ahora co la funcion move_uploaded_file lo guardaremos en el destino que queramos*/
	  move_uploaded_file($_FILES['fileLogo']['tmp_name'],"../logos/" . $fotoO);
	}
	$sql="INSERT into lineaempresa	values (
											$codO,
											'$datos[0]',
											'$fotoO',
											'$datos[1]'
										)";
		echo $buscarU=$con->exec($sql);
		// echo $obj->agregarUsuario($datos);


 ?>

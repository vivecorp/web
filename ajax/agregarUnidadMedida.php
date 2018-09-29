<?php
	require_once "../inc/config.php";
	$datos=array(
		$_POST['txtUnidadMedida'],
		$_POST['txtSigla']
				);
	// buscar ultimo codigo
	$query="SELECT ifnull(max(codUnidadMedida)+1,1) as ult from unidadmedida";
	$result=$con->query($query);
	if($result->rowCount() == 1){
    // existe
    $row=$result->fetch(PDO::FETCH_NUM);
    $codO=$row[0];
	}else{
		echo "No se encontro ningun registro";
		return false;
	}
	$sql="INSERT into unidadmedida	values (
											$codO,
											'$datos[0]',
											'$datos[1]'
										)";
		echo $buscarU=$con->exec($sql);
		// echo $obj->agregarUsuario($datos);
 ?>

<?php
	require_once "../inc/config.php";
	$datos=array(
		$_POST['txtRole']
				);
		// buscar ultimo codigo de usuario
		$query="SELECT ifnull(max(codRole)+1,1) as ult from role";
		$result=$con->query($query);
		if($result->rowCount() == 1){
	    // existe
	    $row=$result->fetch(PDO::FETCH_NUM);
	    $codRoleO=$row[0];
		}else{
			echo "No se encontro ningun registro";
			return false;
		}
		$sql="INSERT into role	values (
												$codRoleO,
												'$datos[0]'
											)";
			echo $buscarU=$con->exec($sql);
			// echo $obj->agregarUsuario($datos);


 ?>

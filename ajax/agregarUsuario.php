<?php
	require_once "../inc/config.php";
	$datos=array(
		$_POST['txtNombre'],
		$_POST['txtCi'],
		$_POST['txtCel'],
		$_POST['txtDireccion'],
		$_POST['txtUsuario'],
		$_POST['txtPassword'],
		$_POST['txtNacimiento'],
		$_POST['cmbRole'],
				);
		// buscar ultimo codigo de usuario
		$query="SELECT ifnull(max(codUsuario)+1,1) as ult from usuario";
		$result=$con->query($query);
		if($result->rowCount() == 1){
	    // existe usuario
	    $row=$result->fetch(PDO::FETCH_NUM);
	    $codUsuarioO=$row[0];
		}else{
			echo "No se encontro ningun registro";
			return false;
		}
		$sql="INSERT into usuario	values (
												$codUsuarioO,
												'$datos[0]',
												'$datos[1]',
												'$datos[2]',
												'$datos[3]',
												'$datos[4]',
												'$datos[5]',
												1,
												'$datos[6]',
												$datos[7]
											)";
			echo $buscarU=$con->exec($sql);
			// echo $obj->agregarUsuario($datos);


 ?>

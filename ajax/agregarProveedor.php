<?php
	require_once "../inc/config.php";
	$datos=array(
		$_POST['txtEmpresa'],
		$_POST['cmbPais'],
		$_POST['txtContacto'],
		$_POST['txtEmail'],
		$_POST['txtTelefono'],
		$_POST['txtCelular'],
		$_POST['txtDireccion'],
		1
				);
		// buscar ultimo codigo de usuario
		$query="SELECT ifnull(max(codProveedor)+1,1) as ult from proveedor";
		$result=$con->query($query);
		if($result->rowCount() == 1){
	    // existe
	    $row=$result->fetch(PDO::FETCH_NUM);
	    $codO=$row[0];
		}else{
			echo "No se encontro ningun registro";
			return false;
		}
		$sql="INSERT into proveedor	values (
												$codO,
												'$datos[0]',
												'$datos[1]',
												'$datos[2]',
												'$datos[3]',
												'$datos[4]',
												'$datos[5]',
												'$datos[6]',
												$datos[7]
											)";
			echo $buscarU=$con->exec($sql);
			// echo $obj->agregarUsuario($datos);


 ?>

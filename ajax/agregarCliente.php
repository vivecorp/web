<?php
	require_once "../inc/config.php";
	$datos=array(
		$_POST['txtNombre'],
		$_POST['txtCi'],
		$_POST['txtFechaNacimiento'],
		$_POST['txtDireccion'],
		$_POST['txtTelefono'],
		$_POST['txtCelular'],
		$_POST['txtEmail'],
		$_POST['txtRazonSocialN'],
		$_POST['txtNitN'],
		$_POST['txtDescuentoN'],
		$_POST['txtPlazoN'],
		$_POST['txtLimiteCreditoN'],
		1
				);

		// buscar ultimo codigo de usuario
		$query="SELECT ifnull(max(codCliente)+1,1) as ult from cliente";
		$result=$con->query($query);
		if($result->rowCount() == 1){
	    // existe
	    $row=$result->fetch(PDO::FETCH_NUM);
	    $codO=$row[0];
		}else{
			echo "No se encontro ningun registro";
			return false;
		}
		$sql="INSERT into cliente	values (
												$codO,
												'$datos[0]',
												'$datos[1]',
												'$datos[2]',
												'$datos[3]',
												'$datos[4]',
												'$datos[5]',
												'$datos[6]',
												'$datos[7]',
												'$datos[8]',
												$datos[9],
												$datos[10],
												$datos[11],
												$datos[12]
											)";
			
			echo $buscarU=$con->exec($sql);

			// echo $obj->agregarUsuario($datos);
 ?>

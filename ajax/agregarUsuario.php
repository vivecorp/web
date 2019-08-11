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
		$_POST['cmbRole']
				);

				$f='fileFoto';

		// buscar ultimo codigo de usuario
		$query="SELECT ifnull(max(codUsuario)+1,1) as ult from usuario";
		$result=$con->query($query);
		if($result->rowCount() == 1){
	    // existe usuario
	    $row=$result->fetch(PDO::FETCH_NUM);
	    $codUsuarioO=$row[0];
			// agregar imagen Inicio
			if(!empty($_FILES[$f]))
		  {
				$fotoO=$codUsuarioO.".".pathinfo($_FILES[$f]['name'], PATHINFO_EXTENSION);
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
				  move_uploaded_file($_FILES[$f]['tmp_name'],"../foto/" . $fotoO);
				}
			}
		  else {
		    $fotoO="defecto.jpg";
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
													'$fotoO',
													$datos[7]
												)";
			echo $buscarU=$con->exec($sql);

		}else{
			echo "No se encontro ningun registro";
			return false;
		}

			// echo $obj->agregarUsuario($datos);


 ?>

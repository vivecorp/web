<?php
	require_once "../inc/config.php";

	$codUsuarioP=$_POST['codUsuario'];
		// buscar ultimo codigo de usuario
	$query="SELECT * from usuario where codUsuario=$codUsuarioP";
	$result=$con->query($query);
	if($result->rowCount() == 1){
	   // existe usuario
	   $row=$result->fetch(PDO::FETCH_ASSOC);
     echo json_encode($row);
	}else{
			echo "No se encontro ningun registro";
			return false;
	}
?>

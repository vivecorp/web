<?php
	require_once "../inc/config.php";

	$cod=$_POST['cod'];
		// buscar ultimo codigo de usuario
	$query="SELECT * from role where codRole=$cod";
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

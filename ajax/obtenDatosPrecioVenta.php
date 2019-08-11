<?php
	require_once "../inc/config.php";

	$cod=$_POST['cod'];
		// buscar ultimo codigo de usuario
	$query="SELECT * from producto where codProducto=$cod";
	$result=$con->query($query);
	if($result->rowCount() == 1){
	   // existe usuario
	  $row=$result->fetch(PDO::FETCH_ASSOC);
		$q="select * from precioventa where codProducto=$cod and estado=1";
		$resultQ=$con->query($q);
		$rowQ=$resultQ->fetch(PDO::FETCH_ASSOC);
		$row['precioVenta']=$rowQ['precio'];
		$row['observacion']=$rowQ['observacion'];
    echo json_encode($row);
	}else{
		echo "No se encontro ningun registro";
		return false;
	}
?>

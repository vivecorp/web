<?php
	require_once "../inc/config.php";

	$codUsuarioP=$_POST['codUsuario'];
		// buscar ultimo codigo de usuario
	$query="SELECT * FROM usuario WHERE codUsuario=$codUsuarioP";
	$result=$con->query($query);
	if($result->rowCount() == 1){
	   // existe usuario
	   $row=$result->fetch(PDO::FETCH_ASSOC);
		 // obtener datos de almacen
		 $q1="select ifnull(codAlmacen,0) as codAlmacen from asignacionalmacen where codUsuario=$codUsuarioP and estado=1";
		 $resultQ1=$con->query($q1);
		 if($resultQ1->rowCount() == 1){
		 	$rowQ1=$resultQ1->fetch(PDO::FETCH_ASSOC);
			$row['codAlmacen']=$rowQ1['codAlmacen'];
		 }
		 else {
		 	$row['codAlmacen']=0;
		 }
		 // obtener datos de linea empresarial
		 $q2="select ifnull(codLineaEmpresa,0) as codLinea from asignacionlinea where codUsuario=$codUsuarioP and estado=1";
		 $resultQ2=$con->query($q2);
		 if($resultQ2->rowCount() == 1){
		 	$rowQ2=$resultQ2->fetch(PDO::FETCH_ASSOC);
			$row['codLinea']=$rowQ2['codLinea'];
		 }
		 else {
		 	$row['codLinea']=0;
		 }

     echo json_encode($row);
	}else{
			echo "No se encontro ningun registro";
			return false;
	}
?>

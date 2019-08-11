<?php
	require_once "../inc/config.php";

	$cod=$_POST['cod'];
		// buscar ultimo codigo de usuario
	$query="SELECT * from usuario where codUsuario=$cod";
	$result=$con->query($query);
	if($result->rowCount() == 1){
	   // existe usuario
	  $row=$result->fetch(PDO::FETCH_ASSOC);

		$q="select a.codDosificacion as codDosificacion,
							 a.codPuntoVenta as codPuntoVenta,
							 d.codActividadEconomica as codActividadEconomica
				from asignacion a, dosificacion d
				where a.codDosificacion=d.codDosificacion and a.codUsuario=$cod and a.estado=1 ";
		$r=$con->query($q);
		if($r->rowCount() == 1){
			$rowQ=$r->fetch(PDO::FETCH_ASSOC);
			$row['codDosificacion']=$rowQ['codDosificacion'];
			$row['codPuntoVenta']=$rowQ['codPuntoVenta'];
			$row['codActividadEconomica']=$rowQ['codActividadEconomica'];
		}
		else {
			$row['codDosificacion']=0;
			$row['codPuntoVenta']=0;
			$row['codActividadEconomica']=0;
		}

    echo json_encode($row);
	}else{
		echo "No se encontro ningun registro";
		return false;
	}
?>

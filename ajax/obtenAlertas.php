<?php
	require_once "../inc/config.php";

	$cod=$_POST['cod'];
		// buscar ultimo codigo de usuario
	$query="SELECT d.fechaLimite as fechaLimite
					from asignacion a, dosificacion d
					where a.codDosificacion=d.codDosificacion and a.codUsuario=$cod and a.estado=1";
	$result=$con->query($query);
	if($result->rowCount() == 1){
	   // existe usuario
	  $row=$result->fetch(PDO::FETCH_ASSOC);
		$f=date("Y-m-d");
		$actual=new DateTime("now");
		$fechaLimite=new DateTime($row['fechaLimite']);
		// $dif=$fechaLimite->diff($actual);
		$dif=$actual->diff($fechaLimite);
		// $row['diferencia']=$dif->days;
		$row['invert']=$dif->invert;
		if($dif->invert == 0)
		{
			$row['diferencia']=($dif->days)+1;
			$row['mensaje']="Faltan ".$row['diferencia']." Dias Para que Expire la Dosificacion de Facturacion";
			$row['tipoMsg']="warning";
			if($row['diferencia']<11)
			{
				$row['mostrar']=1;
			}
		}
		else {
			$row['diferencia']=($dif->days)+1;
			$row['mensaje']="La Dosificacion de Facturacion ha Expirado con ". $row['diferencia']." Dias";
			$row['tipoMsg']="danger";
			$row['mostrar']=1;
		}
		$row['actual']=$f;
    echo json_encode($row);
	}else{
		$row['mensaje']="No tiene Asignada una Dosificacion de Facturacion";
		$row['tipoMsg']="danger";
		$row['mostrar']=1;

    echo json_encode($row);
	}
?>

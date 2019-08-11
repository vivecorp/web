<?php
	require_once "../inc/config.php";
	$datos=array(
		$_POST['txtNit'],
		$_POST['txtLlave'],
		$_POST['txtAutorizacion'],
		$_POST['txtFechaLimite'],
		$_POST['chkEstado'],
		$_POST['cmbActividadEconomica']
				);
		if($datos[4]=="on")
		{
			$estado=1;
		}
		else {
			$estado=2;
		}

		$fecha=date("Y-m-d H:i:s");
		// buscar ultimo codigo de usuario
		$query="SELECT ifnull(max(codDosificacion)+1,1) as ult from dosificacion";
		$result=$con->query($query);
		if($result->rowCount() == 1){
	    // existe
	    $row=$result->fetch(PDO::FETCH_NUM);
	    $codO=$row[0];
		}else{
			echo "No se encontro ningun registro";
			return false;
		}
		$sql="INSERT into dosificacion	values (
												$codO,
												'$fecha',
												'$datos[0]',
												'$datos[1]',
												'$datos[2]',
												'$datos[3]',
												 $estado,
												 $datos[5]
											)";
			echo $buscarU=$con->exec($sql);
			// echo $obj->agregarUsuario($datos);


 ?>

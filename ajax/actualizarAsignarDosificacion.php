<?php
  require_once "../inc/config.php";
  $datos=array(
    $_POST['hdeCodA'],
    $_POST['cmbDosificacionA'],
    $_POST['cmbSucursalA']
  );

  $query="UPDATE asignacion set
                    estado=2
					where codUsuario=$datos[0]";
  $actualizarU=$con->exec($query);
  if($datos[1] > 0)
  {
    $query="SELECT ifnull(max(codAsignacion)+1,1) as ult from asignacion";
		$result=$con->query($query);
		if($result->rowCount() == 1){
	    // existe
	    $row=$result->fetch(PDO::FETCH_NUM);
	    $codO=$row[0];
		}else{
			echo "No se encontro ningun registro";
			return false;
		}
    $fecha=date("Y-m-d");

    $sql="INSERT into asignacion	values (
												$codO,
												'$fecha',
												1,
												$datos[0],
												$datos[1],
												$datos[2]
											)";
			echo $buscarU=$con->exec($sql);
  }
  else {
    echo 1;
  }
  // echo $actualizarU=$con->exec($query);
  // echo $query;
?>

<?php
	require_once "../inc/config.php";
	$codVentas=$_POST['codVentas'];

	// buscar ultimo codigo de usuario
	$query="SELECT * from ventas where codVentas=$codVentas";
	$result=$con->query($query);
	if($result->rowCount() == 1)
	{
    // existe
    $row=$result->fetch(PDO::FETCH_ASSOC);
		$codUsuario=$row['codUsuario'];
		$queryA="select d.nit as nit, d.key as llave, d.nroAutorizacion as nroAutorizacion,
										d.fechaLimite as fechaLimite, a.descripcion as actividadEconomica,
										p.nombre as puntoVenta, p.direccion as direccion, p.celular as celular,
										p.telefono as telefono, u.nombre as nombreUsuario
						 from asignacion asi,
						 			dosificacion d,
									actividadeconomica a,
									puntoventa p,
									usuario u
						 where asi.codUsuario=u.codUsuario and
						 			 asi.codDosificacion=d.codDosificacion and
									 asi.codPuntoVenta=p.codPuntoVenta and
									 d.codActividadEconomica=a.codActividadEconomica and
									 asi.codUsuario=$codUsuario and
									 asi.estado=1";
		$resultA=$con->query($queryA);
		if($resultA->rowCount()==0)
		{
			$ro= array(codFactura => "No Existe Dosificacion Asignada");
			echo json_encode($ro);
			return false;
		}
		else
		{
			// obtener los datos de asignacion dosificacion codigo de control fecha Limite
			$rowA=$resultA->fetch(PDO::FETCH_ASSOC);
			$nitEmpresa=$rowA['nit'];
			$llave=$rowA['llave'];
			$nroAutorizacion=$rowA['nroAutorizacion'];
			$fechaLimite=$rowA['fechaLimite'];
			$actividadEconomica=$rowA['actividadEconomica'];
			$puntoVenta=$rowA['puntoVenta'];
			$direccion=$rowA['direccion'];
			$celular=$rowA['celular'];
			$telefono=$rowA['telefono'];
			$nombreUsuario=$rowA['nombreUsuario'];

			$queryF="select * from factura where codVentas=$codVentas";
			$resultF=$con->query($queryF);
			if($resultF->rowCount()==0)
			{

				// generar factura y luego Imprimir
				$total=$row['total'];
				$razonSocial=$row['razonSocial'];
				$nitCliente=$row['nit'];

				
				// $ro= array(codFactura => $celular);
				// echo json_encode($ro);


			}
			else
			{
					$ro= array(codFactura => "factura generada solo imprimir");
					echo json_encode($ro);
			}

			// $queryI="insert into factura values($codFactura,
		  //                                    $nroFactura,
		  //                                    '$fecha',
		  //                                    current_time(),
		  //                                    '$razonSocial',
		  //                                    '$nit',
		  //                                    0,
		  //                                    $codEstadoPago,
		  //                                    $formaPago,
		  //                                    $codUsuario
		  //                                   )";
			// $ro= array(codFactura => 1);
			// echo json_encode($ro);
	    // echo json_encode($row);
		}

	}
	else
	{
		echo "No se encontro ningun registro";
		return false;
	}
	// $sql="INSERT into cliente	values (
	// 										$codO,
	// 										'$datos[0]',
	// 										'$datos[1]',
	// 										'$datos[2]',
	// 										'$datos[3]',
	// 										'$datos[4]',
	// 										'$datos[5]',
	// 										'$datos[6]',
	// 										'$datos[7]',
	// 										'$datos[8]',
	// 										$datos[9],
	// 										$datos[10],
	// 										$datos[11],
	// 										$datos[12]
	// 									)";
	//
	// 	$row= array(id => $buscarU=$con->exec($sql), codClienteJ => $codO,plazo => $datos[10], descuento => $datos[9]);
	// 	echo json_encode($row);

		// echo $obj->agregarUsuario($datos);
 ?>

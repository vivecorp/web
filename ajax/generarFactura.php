<?php
	session_start();
	if(!$_SESSION['codUsuarioG'] || $_SESSION['roleG']!=1)
	{
		header("location: login.php");
	}
	include '../inc/control.php';
	require_once "../inc/config.php";
	require "../inc/obtener.php";
	$codVentas=$_POST['codVentas'];
	$codUsuarioG=$_SESSION['codUsuarioG'];

	// buscar ultimo codigo de usuario
	$query="SELECT * from ventas where codVentas=$codVentas";
	$result=$con->query($query);
	if($result->rowCount() == 1)
	{
    // existe
    $row=$result->fetch(PDO::FETCH_ASSOC);
		$codUsuario=$row['codUsuario'];
		$queryA="select asi.codAsignacion as codAsignacion, d.nit as nit, d.key as llave, d.nroAutorizacion as nroAutorizacion,
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
			$ro= array(codFactura => "No Existe Dosificacion Asignada", opt => 0);
			echo json_encode($ro);
			return false;
		}
		else
		{
			// obtener los datos de asignacion dosificacion codigo de control fecha Limite
			$rowA=$resultA->fetch(PDO::FETCH_ASSOC);
			$codAsignacion=$rowA['codAsignacion'];
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
				$dsctTotal=$row['descuento'];
				$razonSocial=$row['razonSocial'];
				$nitCliente=$row['nit'];
				// Obtener ultimo numero de factura
				$queryOF="SELECT ifnull(max(nroFactura)+1,1) as ultF from factura where codAsignacion=$codAsignacion";
				$resultFactura=$con->query($queryOF);
			  if($resultFactura->rowCount() == 1){
			    // existe
			    $rowFactura=$resultFactura->fetch(PDO::FETCH_NUM);
			    $nroFactura=$rowFactura[0];
			  }else{
			    echo "No se encontro ningun registro";
			    return false;
			  }
				$controlCode = new ControlCode();
				// llamar a la funcion de codigo de control para la Factura
				// $nroFactura=673173;
				// $nitCliente="1666188";
				// $fechaFactura="2008/08/10";
				// $total=51330;

				$fechaFactura=date("Y/m/d");
				$code = $controlCode->generate($nroAutorizacion,//Numero de autorizacion
                                       $nroFactura,//Numero de factura
                                       $nitCliente,//Número de Identificación Tributaria o Carnet de Identidad
                                       str_replace('/','',$fechaFactura),//fecha de transaccion de la forma AAAAMMDD
                                       $total,//Monto de la transacción
                                       $llave//Llave de dosificación
                    									);
				if(!$dsctTotal)
				{
					$dsctTotal=0;
				}
				$dsctMonto=round($total*($dsctTotal/100),2);
				$qr="$nitEmpresa|$nroFactura|$nroAutorizacion|$fechaFactura|$total|$total|$code|$nitCliente|0|0|0|$dsctMonto";
				$codFactura=obtenerUltimo("factura","codFactura");
				$queryIF="insert into factura values($codFactura,
																						$nroFactura,
																						CURDATE(),
			                                     current_time(),
																					 '$razonSocial',
																					 '$nitCliente',
																					 $dsctTotal,
																					 $total,
			                                     '$code',
			                                     '$qr',
			                                     $codVentas,
			                                     $codAsignacion,
																					 $codUsuarioG
			                                    )";
				// $ro= array(codFactura => $queryIF);
				// echo json_encode($ro);
				$insertarF=$con->exec($queryIF);
				// insertar detalle Factura
				$queryODV="select * from detalleventas where codVentas = $codVentas";
				$buscarODV=$con->query($queryODV);
		    while($rowODV=$buscarODV->fetch(PDO::FETCH_ASSOC))
		    {
					$precioF=$rowODV['precio'];
					$cantidadF=$rowODV['cantidad'];
					$descuentoF=$rowODV['descuento'];
					$subTotalF=$rowODV['subTotal'];
					$codProductoF=$rowODV['codProducto'];

					$codDetalleFactura=obtenerUltimo("detallefactura","codDetalleFactura");

					$queryIDF="insert into detallefactura values($codDetalleFactura,
																							$precioF,
																							$cantidadF,
																						 $descuentoF,
																						 $subTotalF,
																						 $codFactura,
				                                     $codProductoF
				                                    )";
					$insertarIDF=$con->exec($queryIDF);
				}
				$ro= array(codVentas => $codVentas, opt => 1);
				echo json_encode($ro);
				return false;
			}
			else
			{
					$ro= array(codVentas => $codVentas, opt => 1);
					echo json_encode($ro);
					return false;
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

 ?>

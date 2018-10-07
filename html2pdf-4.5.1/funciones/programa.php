<?php
session_start();
if(!$_SESSION['codUsuario'] || $_SESSION['rol']!=1)
{
	header("location: login.php");
}
include("funciones/libreria.php");
$cn = fnConnect( $msg );
//******* Verificar la conexion con la base de datos
if( !$cn )
{
	say("<div align='center' class='titulo'>No se pudo conectar con el servidor.</div>");
	say( "</body>" );
	return;
}

$codUsuario=$_SESSION['codUsuario'];
$rol=$_SESSION['rol'];
//obtener usuario
$query="select * from usuario where codUsuario=$codUsuario";
$result=mysql_query($query);
$row=mysql_fetch_array($result);
$nombreUsuario=$row["nombre"];
$ci=$row["ci"];
$f=$row["foto"];
if($f)
{
  $foto="subidas/".$f;
}
else
{
  $foto="subidas/defecto.png";
}
// fin usuarios

$tc=6.96;
$fecha=date("d/m/Y");

//XAJAX Inicio
require_once("xajax/xajax.inc.php");
$xajax=new xajax();
$xajax->registerFunction("llenarModalV");
function llenarModalV($codVacuna)
{
	$objResponse = new xajaxResponse();
	$query="select * from detalleVacunas where codPlan=$codVacuna";
	$result=mysql_query($query);
	$cv="<table class='table-hover table-condensed table-bordered'><tr bgcolor='#5C8AD0' style='color:#ffffff; align:center; font-size:13px;'><td>Nro</td><td>Vacuna</td><td>Dia</td><td>Aplicacion</td></tr>";
	$aux=1;
	while($row=mysql_fetch_array($result))
	{
		$vacunaO=$row['vacuna'];
		$diaO=$row['dia'];
		$metodoO=$row['metodo'];

		$cv=$cv."<tr class='table-primary'><td>$aux</td><td>$vacunaO</td><td>$diaO</td><td>$metodoO</td></tr>";
		$aux++;
	}
	$cv=$cv."</table>";
	$objResponse->assign("divV","innerHTML", $cv);
	return $objResponse;
}
$xajax->registerFunction("obtenerGalponeroA");
function obtenerGalponeroA()
{
	$objResponse = new xajaxResponse();
	$query="select * from galponero";
	$result=mysql_query($query);
	$cad="<select name='cmbGalponero' id='cmbGalponero'  class='form-control' onChange=''><option value=''>Elija Galponero...</option>";
	while($row=mysql_fetch_array($result))
	{
		$codGalponeroO=$row['codGalponero'];
		$nombreO=$row['nombre'];
		$cad=$cad."<option value='$codGalponeroO' $aux>$nombreO</option>";
	}
	$cad=$cad."</select>";

	$query="select * from planVacunas";
	$result=mysql_query($query);
	$cad1="<select name='cmbVacunas' id='cmbVacunas' class='form-control' onChange=''><option value=''>Elija Plan de Vacunas...</option>";
	while($row=mysql_fetch_array($result))
	{
		$codVacunasO=$row['codPlan'];
		$nombreO=$row['nombre'];
		$cad1=$cad1."<option value='$codVacunasO' $aux>$nombreO</option>";
	}
	$cad1=$cad1."</select>";
	$cad2="<button type='button' class='btn btn-primary btn-lg' data-toggle='modal' data-target='#vacunas' style='font-size:14px' onclick='llenarModalVacuna()'>Ver</button>";
	// $objResponse->addAssign("hde","value", $placaA);
	$objResponse->assign("divGalponeroL","innerHTML", "Galponero:");
	$objResponse->assign("divGalponero","innerHTML", $cad);
	$objResponse->assign("divPlanVacunasL","innerHTML", "Plan de Vacunas:");
	$objResponse->assign("divPlanVacunas","innerHTML", $cad1);
	$objResponse->assign("divPlanVacunasBtn","innerHTML", $cad2);
	return $objResponse;
}

$xajax->registerFunction("cerrarLoteA");
function cerrarLoteA($codLoteA,$fechaCA)
{
	$objResponse = new xajaxResponse();
	$query="update lote set estado=4,fechaCierre=str_to_date('$fechaCA','%d/%m/%Y') where codLote=$codLoteA";
	$result=mysql_query($query);

	//opener.location.reload()
	$objResponse->addScriptCall("recargar()");

	return $objResponse;
}
$xajax->registerFunction("recepcionarLoteA");
function recepcionarLoteA($codLoteA,$fechaRA,$cantidadRA,$codGalponeroA,$codPlanA)
{
	$objResponse = new xajaxResponse();
	$query="update lote set estado=3,fechaRecepcion=str_to_date('$fechaRA','%d/%m/%Y'),cantidadRecepcion=$cantidadRA, codGalponero=$codGalponeroA, codPlan=$codPlanA where codLote=$codLoteA";
	$result=mysql_query($query);

	//opener.location.reload()
	$objResponse->addScriptCall("imprimirRegistro($codLoteA)");

	return $objResponse;
}
$xajax->registerFunction("iniciarLoteA");
function iniciarLoteA($codLoteA)
{
	$objResponse = new xajaxResponse();
	$query="update lote set estado=2,fechaInicio=now() where codLote=$codLoteA";
	$result=mysql_query($query);

	//opener.location.reload()
	$objResponse->addScriptCall("recargar()");

	return $objResponse;
}
$xajax->processRequests();
//XAJAX Fin
?>
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<?php
	$xajax->printJavascript("xajax/");
?>
<title>AVIVEI</title>
<!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Minimal Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/font-awesome.css" rel="stylesheet">
<script src="js/jquery.min.js"> </script>
<script src="js/bootstrap.min.js"> </script>
<!-- script para validad -->
<script src="js/jquery.validate.min"> </script>
<!-- script para el chosen -->
<link rel="stylesheet" href="css/chosen.css">
<!-- para el Calendario -->
<link rel="stylesheet" href="css/jquery-ui.css">
<!-- Mainly scripts -->

<script src="js/jquery.metisMenu.js"></script>
<script src="js/jquery.slimscroll.min.js"></script>
<!-- Custom and plugin javascript -->
<link href="css/custom.css" rel="stylesheet">
<script src="js/custom.js"></script>
<script src="js/screenfull.js"></script>
<!-- para el calendario plugin -->
<script src="js/jquery-ui.js"></script>
		<script>
		$( function() {
			$( "#txtFechaR" ).datepicker({
				dateFormat: "dd/mm/yy"
			});
		} );

		$( function() {
		$( "#txtFechaC" ).datepicker({
			dateFormat: "dd/mm/yy"
		});
		} );
		function calendario()
		{
			$( function() {
		    $( "#txtFechaR" ).datepicker({
					dateFormat: "dd/mm/yy"
				});

		  } );
			$( function() {
			$( "#txtFechaC" ).datepicker({
				dateFormat: "dd/mm/yy"
			});
			} );
		}
		$(function () {
			$("#btnVentas").on("click", function(){
				// $("#wfrVentas").validate
				// ({
				// 	rules:
				// 	{
				// 		modPago:{required: true, email: true}
				// 	},
				// 	messages:
				// 	{
				// 		modPago: {required: 'El campo es requerido', email: 'hjkhjk'}
				// 	}
				// });
				// alert("joji");
			});
		});

		$(function () {
			$('#supported').text('Supported/allowed: ' + !!screenfull.enabled);

			if (!screenfull.enabled) {
				return false;
			}
			$('#toggle').click(function () {
				screenfull.toggle($('#container')[0]);
			});
		});
		</script>
</head>
<body>
<div id="wrapper">
<!----->
	<?php require "menu.php"; ?>
	<div id="page-wrapper" class="gray-bg dashbard-1">
  	<div class="content-main">
 			<!--banner-->
		  <div class="banner">
		 		<h2>
					<a href="gerenteConsole.php">Inicio</a>
					<i class="fa fa-angle-right"></i>
					<a href="granjas.php">Granjas</a>
					<i class="fa fa-angle-right"></i>
					<span>Programa Pollito BB</span>
				</h2>
		  </div>
			<!--//banner-->
 	 		<!--faq-->
 			<div class="blank">
  			<form id="wfrPrograma" name="wfrPrograma" action=""  class="form-inline" method="post">
    			<div class="blank-page">
      			<table width="100%" border="0">
		        	<tr>
		          	<td colspan="2" class="titulo">
		            	Programas Pollito BB
		            </td>
		          </tr>
		          <tr>
		      	  	<td colspan="2">
		        	  	<div class="container col-md-12">
										<!-- ver si existen programas de pollito bb  -->
										<?php
											$query="SELECT COUNT(*) AS contador,fechaPrograma FROM lote GROUP BY year(fechaPrograma) ORDER BY year(fechaPrograma) DESC";
											$result=mysql_query($query);
											$row=mysql_fetch_array($result);
											$contador=$row["contador"];
											if ($contador==0)
											{
										?>
											<div class="panel-group" id="accordion" role="tablist">
												<div class="panel panel-default">
													<div class="panel-heading" role="tab" id="heading1">
														<h4 class="panel-title">
															<a href="#collapse" data-toggle="collapse" data-parent="#accordion">
																Registrar Programa
															</a>
														</h4>
													</div>
													<div id="collapse1" class="panel-collapse collapse ">
														<div class="panel-body">
														</div>
													</div>
												</div>
											</div>
										<?php
											}
											else
											{
												$query="SELECT COUNT(*) AS contador,fechaPrograma,year(fechaPrograma) as gestion FROM lote GROUP BY year(fechaPrograma)  ORDER BY year(fechaPrograma) asc";
												$result=mysql_query($query);
												$aux=1;
										?>
										<div class="panel-group" id="accordion" role="tablist">
										<?php
												$a=date("Y");
												$cad1="panel-collapse collapse";
												while($row=mysql_fetch_array($result))
												{
													$e="#collapse".$aux;
													$e1="collapse".$aux;
													$f="heading".$aux;
													$gestion=$row["gestion"];
													if($a==$gestion)
													{
														$cad1="panel-collapse collapse in";
														$t="a: ".$a." ges: ".$gestion;
														$estado="<span style='color: #52b136'>(ACTIVO)</span>";
													}
													else
													{
														$cad1="panel-collapse collapse";
														if ($gestion<$a)
														{
															$estado="<span style='color: #51565c'>(CERRADO)</span>";
														}
														if ($gestion>$a)
														{
															$estado="<span style='color: #f61c1c'>(PENDIENTE)</span>";
														}
													}
													$cad="PROGRAMA POLLITO BB ";
										?>
														<div class="panel panel-default">
															<div class="panel-heading" role="tab" id="<?php echo $f; ?>">
																<h4 class="panel-title">
																	<a href="<?php echo $e; ?>" data-toggle="collapse" data-parent="#accordion">
																		<?php echo $cad; echo $gestion; ?>
																	</a><?php echo $estado; ?>
																</h4>
															</div>

															<div id="<?php echo $e1; ?>" class="<?php echo $cad1; ?>">
																<div class="panel-body">
																	<table border="1" width="100%" class="table-condensed table-responsive-sm">
																		<tr bgcolor="#5C8AD0" style="color:#ffffff; align:center; font-size:13px;">
																			<td width="" align="center" valign="middle">
																				Nro
																			</td>
																			<td width="" align="center" valign="middle" >
																				Procedencia
																			</td>
																			<td width="" align="center" valign="middle" >
																				Granja
																			</td>
																			<td width="" align="center" valign="middle" >
																				Fecha Programa
																			</td>
																			<td width="" align="center" valign="middle" >
																				Dia
																			</td>
																			<td width="" align="center" valign="middle">
																				Cantidad Programa
																			</td>
																			<td width="" align="center" valign="middle">
																				Fecha Inicio Lote
																			</td>
																			<td width="" align="center" valign="middle">
																				Fecha Recepcion
																			</td>
																			<td width="" align="center" valign="middle">
																				Cantidad Recepcion
																			</td>
																			<td width="" align="center" valign="middle">
																				Fecha de Cierre
																			</td>
																			<td width="" align="center" valign="middle">
																				Estado
																			</td>
																		</tr>
																		<?php
																			$queryP="select l.codLote as codLote,l.procedencia as procedencia,date_format(l.fechaRecepcion,'%d/%m/%Y') as fechaRecepcion,l.cantidadRecepcion as cantidadRecepcion, date_format(l.fechaPrograma,'%d/%m/%Y') as fechaPrograma,date_format(l.fechaInicio,'%d/%m/%Y') as fechaInicio,l.fechaPrograma as fecha,date_format(l.fechaCierre,'%d/%m/%Y') as fechaCierre, l.estado as estado, l.cantidadPrograma as cantidadPrograma, g.nombre as granja from lote l, granja g where l.codGranja=g.codGranja and year(fechaPrograma)='$gestion'";
																			$resultP=mysql_query($queryP);
																			$bandC=0;
																			$n=0;
																			$array_dias['Sunday'] = "Domingo";
																			$array_dias['Monday'] = "Lunes";
																			$array_dias['Tuesday'] = "Martes";
																			$array_dias['Wednesday'] = "Miercoles";
																			$array_dias['Thursday'] = "Jueves";
																			$array_dias['Friday'] = "Viernes";
																			$array_dias['Saturday'] = "Sabado";
																			while ($rowP=mysql_fetch_array($resultP))
																			{
																				$n++;
																				$codLoteO=$rowP['codLote'];
																				$granjaO=$rowP['granja'];
																				$procedenciaO=$rowP['procedencia'];
																				$fechaO=$rowP['fechaPrograma'];
																				$fechaR=$rowP['fechaRecepcion'];
																				$fechaI=$rowP['fechaInicio'];
																				$fechaC=$rowP['fechaCierre'];
																				$fecha2O=$rowP['fecha'];

																				// para el dia
																				$d=strtotime($fecha2O);


																				// $fechaD=$array_dias[date('l', strtotime($fechaO))];
																				$fechaD=date('l', $d);
																				$fecha2D=$array_dias[$fechaD];
																				$cantidadO=$rowP['cantidadPrograma'];
																				$cantidadR=$rowP['cantidadRecepcion'];

																				$estadoO=$rowP['estado'];

																				// Hay 4 estados en el lote
																				// 1 Pendiente cuando el lote esta pendiente
																				// 2 Iniciado cuando se inicia un lote pero el pollo aun no esta en granja
																				// 3 Recepcionado cuando la granja esta con pollo
																				// 4 cerrado cuando se termina de sacar el pollo y se hace todos los ajustes
																				if($estadoO==1)
																				{
																					$cadE="<button type='button' class='btn btn-danger btn-lg' data-toggle='modal' data-target='#pendiente' style='font-size:14px' onclick='llenarModal($codLoteO,\"$granjaO\",\"$fechaO\",\"$fechaI\",\"$fechaR\",\"$fechaC\",\"$cantidadR\",\"$cantidadO\",\"$procedenciaO\")'>PENDIENTE</button>";
																				}
																				if($estadoO==2)
																				{
																					$cadE="<button type='button' class='btn btn-warning btn-lg' data-toggle='modal' data-target='#pendiente' style='font-size:14px' onclick='llenarModal($codLoteO,\"$granjaO\",\"$fechaO\",\"$fechaI\",\"$fechaR\",\"$fechaC\",\"$cantidadR\",\"$cantidadO\",\"$procedenciaO\")'>INICIADO</button>";
																				}
																				if($estadoO==3)
																				{
																					$cadE="<button type='button' class='btn btn-success btn-lg' data-toggle='modal' data-target='#pendiente' style='font-size:14px' onclick='llenarModal($codLoteO,\"$granjaO\",\"$fechaO\",\"$fechaI\",\"$fechaR\",\"$fechaC\",\"$cantidadR\",\"$cantidadO\",\"$procedenciaO\")'>RECEPCIONADO</button>";
																				}
																				if($estadoO==4)
																				{
																					$cadE="Cerrado";
																				}
																				if($bandC==0)
																				{
																						$colorF="bgColor=#FFFFFF";
																						$color="#FFFFFF";
																						$bandC=1;
																				}
																				else
																				{
																						$colorF="bgColor=#A7CDED";
																						$color="#A7CDED";
																						$bandC=0;
																				}

																					echo "<tr title='Plazo:  Dias ' style='align:center; font-size:13px; height:40px;' id='filaPago$codLoteO' $colorF onmouseover='this.style.cursor = \"pointer\"; this.style.background=\"#e4a326\"; ' onmouseout='this.style.background=\"$color\";' onclick=''>
																							<td>
																								$n
																							</td>
																							<td>
																								$procedenciaO
																							</td>
																							<td>
																								$granjaO";

																						 echo "</td>
																						 	<td>
																								$fechaO
																							</td>
																							<td>
																								$fecha2D
																							</td>
																							<td>
																								$cantidadO
																							</td>
																							<td>
																								$fechaI
																							</td>
																							<td>
																								$fechaR
																							</td>
																							<td>
																								$cantidadR
																							</td>
																							<td>
																								$fechaC
																							</td>
																							<td align='center'>
																								$cadE
																							</td>
																					</tr>";
																				}
																		 ?>
										              </table>
																</div>
															</div>
														</div>
										<?php
													$aux=$aux+1;
												}
											}
										?>
									</div>
		            </td>
		          </tr>
		        </table>
					</div>

			</div>
			<!--//faq-->
			<!---->
			<!-- modal inicio -->
			<div class="modal fade" id="pendiente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h2 class="modal-title"><div id="divGranja"></div> </h2><input type="hidden" name="hdeCodLote" value="">
						</div>
						<div class="modal-body" align="center">
							<table>
              	<tr>
                	<td>
                  	<div class="form-group">
                    	<label for="exampleInputName2">Fecha Programada:</label>
                    </div>
                  </td>
                  <td>
                  	<div class="form-group" id="divFP">
                    	<label for="exampleInputName2">

                      </label>
                    </div>
                	</td>
                </tr>
								<tr>
                	<td>
                  	<div class="form-group">
                    	<label for="exampleInputName2">Cantidad Programada:</label>
                    </div>
                  </td>
                  <td>
                  	<div class="form-group" id="divCP">
                    	<label for="exampleInputName2">

                      </label>
                    </div>
                	</td>
                </tr>
								<tr>
                	<td>
                  	<div class="form-group">
                    	<label for="exampleInputName2">Procedencia:</label>
                    </div>
                  </td>
                  <td>
                  	<div class="form-group" id="divProcedencia">
                    	<label for="exampleInputName2">

                      </label>
                    </div>
                	</td>
                </tr>
								<tr>
                	<td>
                  	<div class="form-group">
                    	<label for="exampleInputName2"><div id="divFechaInicioL"></div></label>
                    </div>
                  </td>
                  <td>
                  	<div class="form-group">
                    	<label for="exampleInputName2"><div id="divFechaInicio"></div></label>
                    </div>
                	</td>
                </tr>
								<tr>
                	<td>
                  	<div class="form-group">
                    	<label for="exampleInputName2"><div id="divFechaRecepcionL"></div></label>
                    </div>
                  </td>
                  <td>
                  	<div class="form-group">
                    	<label for="exampleInputName2"><div id="divFechaRecepcion"></div></label>
                    </div>
                	</td>
                </tr>
								<tr>
                	<td>
                  	<div class="form-group">
                    	<label for="exampleInputName2"><div id="divCantidadRL"></div></label>
                    </div>
                  </td>
                  <td>
                  	<div class="form-group">
                    	<label for="exampleInputName2"><div id="divCantidadR"></div></label>
                    </div>
                	</td>
                </tr>
								<tr>
                	<td>
                  	<div class="form-group">
                    	<label for="exampleInputName2"><div id="divPlanVacunasL"></div></label>
                    </div>
                  </td>
                  <td>
                  	<div class="form-group">
                    	<label for="exampleInputName2"><div id="divPlanVacunas"></div></label>
                    </div>
                	</td>
									<td>
                  	<div class="form-group">
                    	<label for="exampleInputName2"><div id="divPlanVacunasBtn"></div></label>
                    </div>
                	</td>
                </tr>
								<tr>
                	<td>
                  	<div class="form-group">
                    	<label for="exampleInputName2"><div id="divGalponeroL"></div></label>
                    </div>
                  </td>
                  <td>
                  	<div class="form-group">
                    	<label for="exampleInputName2"><div id="divGalponero"></div></label>
                    </div>
                	</td>
                </tr>
								<tr>
                	<td>
                  	<div class="form-group">
                    	<label for="exampleInputName2"><div id="divFechaCierreL"></div></label>
                    </div>
                  </td>
                  <td>
                  	<div class="form-group">
                    	<label for="exampleInputName2"><div id="divFechaCierre"></div></label>
                    </div>
                	</td>
                </tr>
              </table>
						</div>
						<div class="modal-footer">
							<div id="divBoton"><button type="button" class="btn btn-primary" onClick="iniciarLote()" id="btnAccion" name="btnAccion">INICIAR fdsLOTE</button>
            	<button type="button" class="btn btn-default" data-dismiss="modal">SALIR</button></div>
            </div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			 </div>
			<!-- modal final -->

			<!-- modal inicio -->
			<div class="modal fade" id="vacunas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h2 class="modal-title">PLAN DE VACUNAS</h2><input type="hidden" name="hdeCodVacuna" value="">
						</div>
						<div class="modal-body" align="center">
							<div class="form-group" id="divV"></div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">SALIR</button>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			 </div>
			<!-- modal final -->
			</form>
			<div class="copy">
    		<p> &copy; 2017 AVIVEI. Todos Los Derechos Reservados | Diseñado por: <a href="http://w3layouts.com/" target="_blank">VyV LTDA</a> </p>	    </div>
			</div>
		</div>
		<div class="clearfix"> </div>
	</div>
</div>
<!---->
<!-- para el chosen -->
<script src="js/chosen.jquery.js" type="text/javascript"></script>
<script src="docsupport/init.js" type="text/javascript" charset="utf-8"></script>
<!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
  <script language="javascript1.5">
		// setInterval("xajax_obtenerNotificacionA()",2000);
	</script>
  <script type="text/javascript">
		function llenarModalVacuna()
		{
			document.wfrPrograma.hdeCodVacuna.value=document.getElementById("cmbVacunas").value;
			a=document.getElementById("cmbVacunas").value;
			xajax_llenarModalV(a);
		}
		function llenarModal(codLote,granja,fecha,fechaI,fechaR,fechaC,cantidadR,cantidad,procedencia)
		{
			// alert(granja);
			document.wfrPrograma.hdeCodLote.value=codLote;
			document.getElementById("divGranja").innerHTML="Granja "+granja;
			document.getElementById("divFP").innerHTML=fecha;
			document.getElementById("divCP").innerHTML=cantidad;
			document.getElementById("divProcedencia").innerHTML=procedencia;
			document.getElementById("divFechaRecepcionL").innerHTML="";
			document.getElementById("divFechaRecepcion").innerHTML="";
			document.getElementById("divPlanVacunasL").innerHTML="";
			document.getElementById("divPlanVacunas").innerHTML="";
			document.getElementById("divPlanVacunasBtn").innerHTML="";
			document.getElementById("divGalponeroL").innerHTML="";
			document.getElementById("divGalponero").innerHTML="";
			document.getElementById("divFechaCierreL").innerHTML="";
			document.getElementById("divFechaCierre").innerHTML="";

			// alert(fechaI);
			if(fechaI != "")
			{
				if(fechaR == "")
				{
					document.getElementById("divFechaInicioL").innerHTML="Fecha de Inicio:";
					document.getElementById("divFechaInicio").innerHTML=fechaI;
					document.getElementById("divFechaRecepcionL").innerHTML="Fecha de Recepcion:";
					document.getElementById("divFechaRecepcion").innerHTML="<input type='text' id='txtFechaR' class='form-control1' name='txtFechaR' onClick='calendario()' >";
					document.getElementById("divCantidadRL").innerHTML="Cantidad de Recepcion:";
					document.getElementById("divCantidadR").innerHTML="<input type='text' name='txtCantidadR' class='form-control1' id='txtCantidadR'>";
					document.getElementById("divFechaCierreL").innerHTML="";
					document.getElementById("divFechaCierre").innerHTML="";
					xajax_obtenerGalponeroA();
					document.getElementById("divBoton").innerHTML="<button type='button' class='btn btn-primary' onClick='recepcionarLote()' id='btnAccion' name='btnAccion'>RECEPCIONAR</button><button type='button' class='btn btn-default' data-dismiss='modal'>SALIR</button>";
				}
				else
				{
					document.getElementById("divFechaInicioL").innerHTML="Fecha de Inicio:";
					document.getElementById("divFechaInicio").innerHTML=fechaI;
					document.getElementById("divFechaRecepcionL").innerHTML="Fecha de Recepcion:";
					document.getElementById("divFechaRecepcion").innerHTML=fechaR;
					document.getElementById("divCantidadRL").innerHTML="Cantidad de Recepcion:";
					document.getElementById("divCantidadR").innerHTML=cantidadR;
					document.getElementById("divFechaCierreL").innerHTML="Fecha de Cierre:";
					document.getElementById("divFechaCierre").innerHTML="<input type='text' id='txtFechaC' class='form-control1' name='txtFechaC' onClick='calendario()' >";
					document.getElementById("divBoton").innerHTML="<button type='button' class='btn btn-primary' onClick='cerrarLote()' id='btnAccion' name='btnAccion'>CERRAR LOTE</button><button type='button' class='btn btn-default' data-dismiss='modal'>SALIR</button>";
				}
			}
			else
			{
				document.getElementById("divFechaInicioL").innerHTML="";
				document.getElementById("divFechaInicio").innerHTML="";
				document.getElementById("divFechaRecepcionL").innerHTML="";
				document.getElementById("divFechaRecepcion").innerHTML="";
				document.getElementById("divCantidadRL").innerHTML="";
				document.getElementById("divCantidadR").innerHTML="";
				document.getElementById("divFechaCierreL").innerHTML="";
				document.getElementById("divFechaCierre").innerHTML="";

				document.getElementById("divBoton").innerHTML="<button type='button' class='btn btn-primary' onClick='iniciarLote()' id='btnAccion' name='btnAccion'>INICIAR LOTE</button><button type='button' class='btn btn-default' data-dismiss='modal'>SALIR</button>";
			}
		}

		function iniciarLote()
		{
			codLoteI=document.wfrPrograma.hdeCodLote.value;
			xajax_iniciarLoteA(codLoteI);
			$("#pendiente").modal('hide');
		}
		function recepcionarLote()
		{
			codLoteI=document.wfrPrograma.hdeCodLote.value;
			fechaR=document.getElementById("txtFechaR").value;
			cantidadR=document.getElementById("txtCantidadR").value;
			codGalponero=document.getElementById("cmbGalponero").value;
			codPlan=document.getElementById("cmbVacunas").value;
			// cantidadR=document.wfrPrograma.txtCantidadR.value;
			xajax_recepcionarLoteA(codLoteI,fechaR,cantidadR,codGalponero,codPlan);
			$("#pendiente").modal('hide');
		}
		function cerrarLote()
		{
			codLoteI=document.wfrPrograma.hdeCodLote.value;
			fechaC=document.getElementById("txtFechaC").value;
			// cantidadR=document.wfrPrograma.txtCantidadR.value;
			xajax_cerrarLoteA(codLoteI,fechaC);
			$("#pendiente").modal('hide');
		}
		function recargar()
		{
			// alert("jiji");
			location.reload(true);
		}
		function imprimirRegistro(codLote)
		{
			window.open("impresionRegistro.php?codLote="+codLote);
		}

	</script>
	<!--//scrolling js-->
</body>
</html>

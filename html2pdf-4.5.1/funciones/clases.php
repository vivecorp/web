<?php
//clase para autenticar un usuario 
class autenticacion
{
	private $user;
	private $password;
	
	function __construct($user,$password)
	{
		$this->user=$user;
		$this->password=$password;
	}
			
	function setUser($user)
	{
		$this->user=$user;
	}
	
	function setPassword($password)
	{
		$this->password=$password;
	}
	
	function getUser()
	{
		return($this->user);
	}
	
	function getPassword()
	{
		return($this->password);
	}
//realiza la autenticacion
	public function autenticar()
	{			
		$queryOU="select * from usuario where password='".$this->password."' and login='".$this->user."'";
		$resultOU=mysql_query($queryOU);
		$rowOU=mysql_fetch_array($resultOU);
		if($rowOU)
		{
			$codUsuarioG=$rowOU['codUsuario'];
			$nivelG=$rowOU['codRol'];
			
			if($nivelG==1)
			{
				$retorna=array("principalGerenteGeneral.php",$codUsuarioG,$nivelG);
				return($retorna);
			}
			if($nivelG==2)
			{
				$retorna=array("principalGerenteProduccion.php",$codUsuarioG,$nivelG);
				return($retorna);
			}
			if($nivelG==3)
			{
				$retorna=array("principalTecnicoVeterinario.php",$codUsuarioG,$nivelG);
				return($retorna);
			}
			if($nivelG==4)
			{
				$retorna=array("principalEncargadoMolino.php",$codUsuarioG,$nivelG);
				return($retorna);
			}
		}
		else
		{
			return NULL;
		}
	}
	
}
//obtiene datos de usuario
class obtenerUsuario
{
	private $codUsuario;
	
	function __construct($codUsuario)
	{
		$this->codUsuario=$codUsuario;
	}
	function setCodUsuario($codUsuario)
	{
		$this->codUsuario=$codUsuario;
	}
	function getCodUsuario()
	{
		return($this->codUsuario);
	}
	public function obtenerNombre()
	{
		$queryONU="select * from usuario where codUsuario=".$this->codUsuario."";
		$resultONU=mysql_query($queryONU);
		$rowONU=mysql_fetch_array($resultONU);
		$cadNombre=ucwords(strtolower($rowONU['nombre']));
		return($cadNombre);
	}
	public function obtenerArea()
	{
		$queryONU="select a.area from usuario u, area a where a.codArea=u.codArea and u.codUsuario=".$this->codUsuario."";
		$resultONU=mysql_query($queryONU);
		$rowONU=mysql_fetch_array($resultONU);
		$cadArea=ucwords(strtolower($rowONU['area']));
		return($cadArea);
	}
	public function obtenerLogin()
	{
		$queryONU="select * from usuario where codUsuario=".$this->codUsuario."";
		$resultONU=mysql_query($queryONU);
		$rowONU=mysql_fetch_array($resultONU);
		$cadNombre=$rowONU['login'];
		return($cadNombre);
	}
	public function obtenerCi()
	{
		$queryONU="select * from usuario where codUsuario=".$this->codUsuario."";
		$resultONU=mysql_query($queryONU);
		$rowONU=mysql_fetch_array($resultONU);
		$cadNombre=ucwords(strtolower($rowONU['ci']));
		return($cadNombre);
	}
}
//clase para obtener datos de almacen
class obtenerAlmacen
{
	private $codAlmacen;
	
	function __construct($codAlmacen)
	{
		$this->codAlmacen=$codAlmacen;
	}
	function setCodAlmacen($codAlmacen)
	{
		$this->codAlmacen=$codAlmacen;
	}
	function getCodAlmacen()
	{
		return($this->codAlmacen);
	}
	public function obtenerNombre()
	{
		$queryONU="select * from almacen where codAlmacen=".$this->codAlmacen."";
		$resultONU=mysql_query($queryONU);
		$rowONU=mysql_fetch_array($resultONU);
		$cadAlmacen=ucwords(strtolower($rowONU['almacen']));
		return($cadAlmacen);
	}
	
	public function obtenerSigla()
	{
		$queryONU="select * from almacen where codAlmacen=".$this->codAlmacen."";
		$resultONU=mysql_query($queryONU);
		$rowONU=mysql_fetch_array($resultONU);
		$cadAlmacen=ucwords(strtolower($rowONU['sigla']));
		return($cadAlmacen);
	}
}
//clase para obtener datos de solicitud
class obtenerSolicitud
{
	private $codSolicitud;
	
	function __construct($codSolicitud)
	{
		$this->codSolicitud=$codSolicitud;
	}
	function setCodSolicitud($codSolicitud)
	{
		$this->codSolicitud=$codSolicitud;
	}
	function getCodSolicitud()
	{
		return($this->codSolicitud);
	}
	public function obtenerNombre()
	{
		$queryONU="select nombre from solicitud where codSolicitud=".$this->codSolicitud."";
		$resultONU=mysql_query($queryONU);
		$rowONU=mysql_fetch_array($resultONU);
		$cadNombre=ucwords(strtolower($rowONU['nombre']));
		return($cadNombre);
	}
	public function obtenerCi()
	{
		$queryONU="select ci from solicitud where codSolicitud=".$this->codSolicitud."";
		$resultONU=mysql_query($queryONU);
		$rowONU=mysql_fetch_array($resultONU);
		$cadCi=ucwords(strtolower($rowONU['ci']));
		return($cadCi);
	}
	public function obtenerFecha()
	{
		$queryONU="select date_format(fecha,'%d/%m/%Y %H:%i:%s') as fecha from solicitud where codSolicitud=".$this->codSolicitud."";
		$resultONU=mysql_query($queryONU);
		$rowONU=mysql_fetch_array($resultONU);
		$cadFecha=ucwords(strtolower($rowONU['fecha']));
		return($cadFecha);
	}
	public function obtenerMensaje()
	{
		$queryONU="select mensaje from solicitud where codSolicitud=".$this->codSolicitud."";
		$resultONU=mysql_query($queryONU);
		$rowONU=mysql_fetch_array($resultONU);
		$cadMensaje=ucwords(strtolower($rowONU['mensaje']));
		return($cadMensaje);
	}
	public function obtenerCodUsuario()
	{
		$queryONU="select codUsuario from solicitud where codSolicitud=".$this->codSolicitud."";
		$resultONU=mysql_query($queryONU);
		$rowONU=mysql_fetch_array($resultONU);
		$cadMensaje=ucwords(strtolower($rowONU['codUsuario']));
		return($cadMensaje);
	}
}

//clase para obtener datos de Mensaje
class obtenerMensaje
{
	private $codSolicitud;
	
	function __construct($codSolicitud)
	{
		$this->codSolicitud=$codSolicitud;
	}
	function setCodSolicitud($codSolicitud)
	{
		$this->codSolicitud=$codSolicitud;
	}
	function getCodSolicitud()
	{
		return($this->codSolicitud);
	}
	public function obtenerMensajeProveedor()
	{
		$queryONU="select mensaje from mensaje where codSolicitud=".$this->codSolicitud."";
		$resultONU=mysql_query($queryONU);
		$rowONU=mysql_fetch_array($resultONU);
		$cadMensaje=ucwords(strtolower($rowONU['mensaje']));
		return($cadMensaje);
	}
	public function obtenerDescripcion()
	{
		$queryONU="select descripcion from mensaje where codSolicitud=".$this->codSolicitud."";
		$resultONU=mysql_query($queryONU);
		$rowONU=mysql_fetch_array($resultONU);
		$cadDescripcion=ucwords(strtolower($rowONU['descripcion']));
		return($cadDescripcion);
	}
	public function obtenerFecha()
	{
		$queryONU="select date_format(fecha,'%d/%m/%Y %H:%i:%s') as fecha from mensaje where codSolicitud=".$this->codSolicitud."";
		$resultONU=mysql_query($queryONU);
		$rowONU=mysql_fetch_array($resultONU);
		$cadFecha=ucwords(strtolower($rowONU['fecha']));
		return($cadFecha);
	}
	
}

//obtener datos de detalle solicitud
class obtenerDetalleSolicitud
{
	private $codDetalleSolicitud;
	
	function __construct($codDetalleSolicitud)
	{
		$this->codDetalleSolicitud=$codDetalleSolicitud;
	}
	function setCodDetalleSolicitud($codDetalleSolicitud)
	{
		$this->codDetalleSolicitud=$codDetalleSolicitud;
	}
	function getCodDetalleSolicitud()
	{
		return($this->codDetalleSolicitud);
	}
	public function obtenerCodMaterial()
	{
		$queryONU="select codMaterial from detalle_solicitud where codDetalleSolicitud=".$this->codDetalleSolicitud."";
		$resultONU=mysql_query($queryONU);
		$rowONU=mysql_fetch_array($resultONU);
		$cadCodMaterial=$rowONU['codMaterial'];
		return($cadCodMaterial);
	}
	public function obtenerCantidad()
	{
		$queryONU="select cantidad from detalle_solicitud where codDetalleSolicitud=".$this->codDetalleSolicitud."";
		$resultONU=mysql_query($queryONU);
		$rowONU=mysql_fetch_array($resultONU);
		$cadCantidad=$rowONU['cantidad'];
		return($cadCantidad);
	}
	public function obtenerDescripcion()
	{
		$queryONU="select descripcion from detalle_solicitud where codDetalleSolicitud=".$this->codDetalleSolicitud."";
		$resultONU=mysql_query($queryONU);
		$rowONU=mysql_fetch_array($resultONU);
		$cadDescripcion=$rowONU['descripcion'];
		return($cadDescripcion);
	}
}
//obtener datos de material
class obtenerDatosMaterial
{
	private $codMaterial;
	
	function __construct($codMaterial)
	{
		$this->codMaterial=$codMaterial;
	}
	function setCodMaterial($codMaterial)
	{
		$this->codMaterial=$codMaterial;
	}
	function getCodMaterial()
	{
		return($this->codMaterial);
	}
	public function obtenerMaterial()
	{
		$queryOM="select * from material where codMaterial=".$this->codMaterial."";
		$resultOM=mysql_query($queryOM);
		$rowOM=mysql_fetch_array($resultOM);
		$cadMaterial=ucwords(strtolower($rowOM['material']));
		return($cadMaterial);
	}
}
//clase para obtener la tabla de caracteristica material
class obtenerCaracteristica
{
	private $codMaterial;
	private $codAsignacionMaterial;
	
	function __construct($codMaterial,$codAsignacionMaterial)
	{
		$this->codMaterial=$codMaterial;
		$this->codAsignacionMaterial=$codAsignacionMaterial;
	}
	
	function setCodMaterial($codMaterial)
	{
		$this->codMaterial=$codMaterial;
	}
	function getCodMaterial()
	{
		return($this->codMaterial);
	}
	function setCodAsignacionMaterial($codAsignacionMaterial)
	{
		$this->codAsignacionMaterial=$codAsignacionMaterial;
	}
	function getCodAsignacionMaterial()
	{
		return($this->codAsignacionMaterial);
	}
	
	//Funcion para Caracteristica Material 
	public function caracteristicaMaterial()
	{
		$cadCaracteristica="<div id='divContenidoCaracteristica' class='materialDiv2'>
						<table border='0' class='textoNormal'>
							<tr bgcolor='#996600' style='color:#FFFFFF' style='text-align:center'>";
		$queryOCM="select * from caracteristica where codMaterial=".$this->codMaterial." order by codCaracteristica";
		$resultOCM=mysql_query($queryOCM);
		while($rowOCM=mysql_fetch_array($resultOCM))
		{
			$codCaracteristicaMaterialO=$rowOCM['codCaracteristica'];
			$caracteristicaO=utf8_encode($rowOCM['caracteristica']);
			$cadCaracteristica.="<td>
									$caracteristicaO
								 </td>";
		}
		$cadCaracteristica.="	</tr>";
		//generar descripciones de caracteristicas
		
			$cadCaracteristica.="<tr>";
			$queryODC="select * from caracteristica_material where codAsignacionMaterial=".$this->codAsignacionMaterial." order by codCaracteristica";
			$resultODC=mysql_query($queryODC);
			while($rowODC=mysql_fetch_array($resultODC))
			{
				$descripcionO=$rowODC['descripcion'];
				$cadCaracteristica.="<td>
										$descripcionO
									 </td>";
			}
			$cadCaracteristica.="</tr>";
		
		
		$cadCaracteristica.="</table>
							 </div>";
		return($cadCaracteristica);
	}
	
	public function caracteristicaMaterialTotal($codAlmacen, $cadValorTotal)
	{
		$totalC=new obtenerTotales($this->codAsignacionMaterial,$codAlmacen);
		$totalIngresoC=$totalC->totalIngreso();
		$totalSalidaC=$totalC->totalSalida();
		$totalReservaC=$totalC->totalReserva();
												
		$total=$totalIngresoC - $totalSalidaC - $totalReservaC;
		
		//obtener si existe alguna asignacion en el vector de valores y restarlo al total que se obtuvo en el paso anterior
		$cadCopia=$cadValorTotal;
		$cad1V=split("-",$cadCopia);
		$cant1=count($cad1V)-1;
		$indice1=0;

		$sumaCaracteristica=0;
		while($indice1<$cant1)
		{
		
			$cad2V=split(":",$cad1V[$indice1]);
			//calcular total por caracteristica
			if($this->codAsignacionMaterial == $cad2V[1])
			{
				$sumaCaracteristica=$sumaCaracteristica + $cad2V[2];
			}
											
			$indice1++;			
		}
		
		$totalN=$total-$sumaCaracteristica;
		
		if($sumaCaracteristica!=0)
		{
			$cadEncabezado="<td>
								Total Inicial
							</td>
							<td>
								Total Final
							</td>";
			$cadTotalM="<td>
							$total
						</td>
						<td>
							<div id='divTotalCaracteristica".$this->codAsignacionMaterial."'>$totalN</div>
							<input name='hdeTotalCaracteristica".$this->codAsignacionMaterial."' type='hidden' value='$total' />
						</td>
						";
						
		}
		else
		{
			$cadEncabezado="<td>
								Total
							</td>";
							
			$cadTotalM="<td>
							<div id='divTotalCaracteristica".$this->codAsignacionMaterial."'>$totalN</div>
							<input name='hdeTotalCaracteristica".$this->codAsignacionMaterial."' type='hidden' value='$total' />
						</td>
						";
		}
		
		$cadCaracteristica="<div id='divContenidoCaracteristica' class='materialDiv2'>
						<table border='0' class='textoNormal'>
							<tr bgcolor='#996600' style='color:#FFFFFF' style='text-align:center'>";
		$queryOCM="select * from caracteristica where codMaterial=".$this->codMaterial." order by codCaracteristica";
		$resultOCM=mysql_query($queryOCM);
		
		
		while($rowOCM=mysql_fetch_array($resultOCM))
		{
			$codCaracteristicaMaterialO=$rowOCM['codCaracteristica'];
			$caracteristicaO=utf8_encode($rowOCM['caracteristica']);
			$cadCaracteristica.="<td>
									$caracteristicaO
								 </td>";
		}
		$cadCaracteristica.="	 $cadEncabezado	
							   </tr>";
		//generar descripciones de caracteristicas
		
			$cadCaracteristica.="<tr>";
			$queryODC="select * from caracteristica_material where codAsignacionMaterial=".$this->codAsignacionMaterial." order by codCaracteristica";
			$resultODC=mysql_query($queryODC);
			while($rowODC=mysql_fetch_array($resultODC))
			{
				$descripcionO=$rowODC['descripcion'];
				$cadCaracteristica.="<td>
										$descripcionO
									 </td>";
			}
			
			$cadCaracteristica.="	$cadTotalM
								  </tr>";
		
		
		$cadCaracteristica.="</table>
							 </div>";
		return($cadCaracteristica);
	}
	
	public function caracteristicaMaterial_chelo()
	{
		$cadCaracteristica="<div id='divContenidoCaracteristica' class='materialDiv2' style='border:none'>
						<table border='0' class='textoNormal' width='100%'>
							<tr bgcolor='#D6BFA9' style='color:#000000' style='text-align:center'>";
		$queryOCM="select * from caracteristica where codMaterial=".$this->codMaterial." order by codCaracteristica";
		$resultOCM=mysql_query($queryOCM);
		while($rowOCM=mysql_fetch_array($resultOCM))
		{
			$codCaracteristicaMaterialO=$rowOCM['codCaracteristica'];
			$caracteristicaO=utf8_encode($rowOCM['caracteristica']);
			$cadCaracteristica.="<td>
									$caracteristicaO
								 </td>";
		}
		$cadCaracteristica.="	</tr>";
		//generar descripciones de caracteristicas
		
			$cadCaracteristica.="<tr>";
			$queryODC="select * from caracteristica_material where codAsignacionMaterial=".$this->codAsignacionMaterial." order by codCaracteristica";
			$resultODC=mysql_query($queryODC);
			while($rowODC=mysql_fetch_array($resultODC))
			{
				$descripcionO=$rowODC['descripcion'];
				$cadCaracteristica.="<td>
										$descripcionO
									 </td>";
			}
			$cadCaracteristica.="</tr>";
		
		
		$cadCaracteristica.="</table>
							 </div>";
		return($cadCaracteristica);
	}
	
	public function caracteristicaMaterial_nota()
	{
		$cadCaracteristica="<div id='divContenidoCaracteristica' class='materialDiv2' style='border:none'>
						<table border='1' frame='void' rules='all' cellspacing='0' class='textoNormal' width='100%'>
							<tr class='formulario'>";
		$queryOCM="select * from caracteristica where codMaterial=".$this->codMaterial." order by codCaracteristica";
		$resultOCM=mysql_query($queryOCM);
		while($rowOCM=mysql_fetch_array($resultOCM))
		{
			$codCaracteristicaMaterialO=$rowOCM['codCaracteristica'];
			$caracteristicaO=utf8_encode($rowOCM['caracteristica']);
			$cadCaracteristica.="<td>
									$caracteristicaO
								 </td>";
		}
		$cadCaracteristica.="	</tr>";
		//generar descripciones de caracteristicas
		
			$cadCaracteristica.="<tr>";
			$queryODC="select * from caracteristica_material where codAsignacionMaterial=".$this->codAsignacionMaterial." order by codCaracteristica";
			$resultODC=mysql_query($queryODC);
			while($rowODC=mysql_fetch_array($resultODC))
			{
				$descripcionO=$rowODC['descripcion'];
				$cadCaracteristica.="<td>
										$descripcionO
									 </td>";
			}
			$cadCaracteristica.="</tr>";
		
		
		$cadCaracteristica.="</table>
							 </div>";
		return($cadCaracteristica);
	}
	
	public function unidadMedida()
	{
		$cadCaracteristica="<div id='divContenidoUnidadMedida' class='materialDiv2'>
						<table border='0' class='textoNormal'>";
	
		$codAsignacionCantidadO=$rowOCA['codAsignacionCantidad'];
		$queryOCM="select * from unidad_medida u, caracteristica_cantidad c where c.codCaracteristicaCantidad=u.codCaracteristicaCantidad and u.codAsignacionCantidad=".$this->codAsignacionMaterial." order by nivel desc";
		$resultOCM=mysql_query($queryOCM);
		$bandI=0;
		
		$cadCaracteristica.="<tr>
									<td>
								 ";
		while($rowOCM=mysql_fetch_array($resultOCM))
		{
			$caracteristicaO=ucwords($rowOCM['caracteristica']);	
			$cantidadO=$rowOCM['cantidad'];	
			//generar Unidades de Medida
			
			if($bandI==0)
			{
				$cadCaracteristica.="$caracteristicaO de ";
				$bandI=1;
			}
			else
			{
	//funcion para obtener la unidad de medida
	
				$cadCaracteristica.="$cantidadO $caracteristicaO(s) de ";
			}
		}
		$cadCaracteristica=substr($cadCaracteristica,0,-4);
		$cadCaracteristica.="	</td>
							 </tr>";
		
		
		$cadCaracteristica.="  </table>
							 </div>";
		return($cadCaracteristica);
	}
	
	public function unidadMedida_chelo()
	{
		$cadCaracteristica="<div id='divContenidoUnidadMedida' class='materialDiv2' style='border:none'>
						<table border='0' class='textoNormal'>";
	
		$codAsignacionCantidadO=$rowOCA['codAsignacionCantidad'];
		$queryOCM="select * from unidad_medida u, caracteristica_cantidad c where c.codCaracteristicaCantidad=u.codCaracteristicaCantidad and u.codAsignacionCantidad=".$this->codAsignacionMaterial." order by nivel desc";
		$resultOCM=mysql_query($queryOCM);
		$bandI=0;
		
		$cadCaracteristica.="<tr>
									<td>
								 ";
		while($rowOCM=mysql_fetch_array($resultOCM))
		{
			$caracteristicaO=ucwords($rowOCM['caracteristica']);	
			$cantidadO=$rowOCM['cantidad'];	
			//generar Unidades de Medida
			
			if($bandI==0)
			{
				$cadCaracteristica.="$caracteristicaO de ";
				$bandI=1;
			}
			else
			{
	//funcion para obtener la unidad de medida
	
				$cadCaracteristica.="$cantidadO $caracteristicaO(s) de ";
			}
		}
		$cadCaracteristica=substr($cadCaracteristica,0,-4);
		$cadCaracteristica.="	</td>
							 </tr>";
		
		
		$cadCaracteristica.="  </table>
							 </div>";
		return($cadCaracteristica);
	}
		
	//obtiene una unidad de medida
	public function unidadMedidaUnidad($codAsignacionCantidad)
	{
		$cadCaracteristica="<div id='divContenidoUnidadMedida' class='materialDiv2'>
						<table border='0' class='textoNormal'>";
	
		$codAsignacionCantidadO=$rowOCA['codAsignacionCantidad'];
		$queryOCM="select * from unidad_medida u, caracteristica_cantidad c where c.codCaracteristicaCantidad=u.codCaracteristicaCantidad and u.codAsignacionCantidad=".$codAsignacionCantidad." order by nivel desc";
		$resultOCM=mysql_query($queryOCM);
		$bandI=0;
		
		$cadCaracteristica.="<tr>
									<td>
								 ";
		while($rowOCM=mysql_fetch_array($resultOCM))
		{
			$caracteristicaO=ucwords($rowOCM['caracteristica']);	
			$cantidadO=$rowOCM['cantidad'];	
			//generar Unidades de Medida
			
			if($bandI==0)
			{
				$cadCaracteristica.="$caracteristicaO de ";
				$bandI=1;
			}
			else
			{
	//funcion para obtener la unidad de medida
	
				$cadCaracteristica.="$cantidadO $caracteristicaO(s) de ";
			}
		}
		$cadCaracteristica=substr($cadCaracteristica,0,-4);
		$cadCaracteristica.="	</td>
							 </tr>";
		
		
		$cadCaracteristica.="  </table>
							 </div>";
		return($cadCaracteristica);
	}
	//obtiene una unidad de medida con el formato para la nota de remision
	public function unidadMedidaUnidad_nota($codAsignacionCantidad)
	{
		$cadCaracteristica="<div id='divContenidoUnidadMedida'>
						<table border='0' class='textoNormal'>";
	
		$codAsignacionCantidadO=$rowOCA['codAsignacionCantidad'];
		$queryOCM="select * from unidad_medida u, caracteristica_cantidad c where c.codCaracteristicaCantidad=u.codCaracteristicaCantidad and u.codAsignacionCantidad=".$codAsignacionCantidad." order by nivel desc";
		$resultOCM=mysql_query($queryOCM);
		$bandI=0;
		
		$cadCaracteristica.="<tr>
									<td>
								 ";
		while($rowOCM=mysql_fetch_array($resultOCM))
		{
			$caracteristicaO=ucwords($rowOCM['caracteristica']);	
			$cantidadO=$rowOCM['cantidad'];	
			//generar Unidades de Medida
			
			if($bandI==0)
			{
				$cadCaracteristica.="$caracteristicaO de ";
				$bandI=1;
			}
			else
			{
	//funcion para obtener la unidad de medida
	
				$cadCaracteristica.="$cantidadO $caracteristicaO(s) de ";
			}
		}
		$cadCaracteristica=substr($cadCaracteristica,0,-4);
		$cadCaracteristica.="	</td>
							 </tr>";
		
		
		$cadCaracteristica.="  </table>
							 </div>";
		return($cadCaracteristica);
	}
	//obtiene la cantidad expresada en los parametros de la unidad de medida para ello se le pasa la unidad de medida y la cantidad a convertir
	public function expresionUnidadMedida($cantidad,$codAsignacionCantidad)
	{
		$queryOUM="select * from unidad_medida um, caracteristica_cantidad cc where um.codCaracteristicaCantidad=cc.codCaracteristicaCantidad and um.codAsignacionCantidad=$codAsignacionCantidad order by cc.nivel";
		$resultOUM=mysql_query($queryOUM);
		$x=$cantidad;
		$cadExpresion[]="";
		//obtener ultimo nivel
		$queryOUN="select max(cc.nivel) as nivelM from unidad_medida um, caracteristica_cantidad cc where um.codCaracteristicaCantidad=cc.codCaracteristicaCantidad and um.codAsignacionCantidad=$codAsignacionCantidad ";
		$resultOUN=mysql_query($queryOUN);
		$rowOUN=mysql_fetch_array($resultOUN);
		$nivelM=$rowOUN['nivelM'];
		$contE=0;
		while($rowOUM=mysql_fetch_array($resultOUM))
		{
			$nivelO=$rowOUM['nivel'];
			$y=$rowOUM['cantidad'];
			$r = fmod($x, $y);
			$x=intval($x/$y);
			$caracteristica=$rowOUM['caracteristica'];
			if($nivelO==$nivelM)
			{
				if($x!=0)
				{
					$cadExpresion[$contE]=" $x $caracteristica(s)";
					$contE=$contE+1;
				}
			}
			else
			{
				if($r!=0)
				{
					$cadExpresion[$contE]=" $r $caracteristica(s)";
					$contE=$contE+1;
				}
			}
		}
		$cadE="";
		$contE=$contE-1;
		while($contE >= 0)
		{
			if($contE==1)
			{
				$cadE.=$cadExpresion[$contE]." y ";
			}
			else
			{
				$cadE.=$cadExpresion[$contE]." , ";	
			}
			$contE=$contE-1;
		}
		$tam=count($cadE)-3;
		$cadE=substr($cadE,0,$tam);
		return $cadE;
	}
	
	
	////////////////////
	public function unidadMedidaTxt($codAsignacionCantidad)
	{
		//Caracteristicas de Cantidad
		$cadCantidad="<div id='divContenidoCantidad' class='materialDiv'>
							<table border='0' class='textoNormal'>
							<tr>
								<td bgcolor='#996600' align='center' style='color:#ffffff' colspan='2'>
										CANTIDADES
								</td>
							</tr>";
						
		//obtener cantidad de txt que se generaran
		$queryOC="select count(*) as cantidad from unidad_medida u, caracteristica_cantidad c where c.codCaracteristicaCantidad=u.codCaracteristicaCantidad and u.codAsignacionCantidad=$codAsignacionCantidad";
		$resultOC=mysql_query($queryOC);
		$rowOC=mysql_fetch_array($resultOC);
		$cantidadT=$rowOC['cantidad'];
		
		
		
		$queryOCM="select * from unidad_medida u, caracteristica_cantidad c where c.codCaracteristicaCantidad=u.codCaracteristicaCantidad and u.codAsignacionCantidad=$codAsignacionCantidad order by nivel desc";
		$resultOCM=mysql_query($queryOCM);
		$i=1;
		while($rowOCM=mysql_fetch_array($resultOCM))
		{
			$caracteristicaO=$rowOCM['caracteristica'];
			$codCaracteristicaCantidadO=$rowOCM['codCaracteristicaCantidad'];
			$codUnidadMedidaO=$rowOCM['codUnidadMedida'];
			$cadCantidad.=" <tr>
								<td align='left'>
									$caracteristicaO:
								</td>
								<td>
									txt$codAsignacionCantidad".$this->codAsignacionMaterial."<input name='txt$codAsignacionCantidad".$this->codAsignacionMaterial."' type='text' onkeyup='calcularTotal(this.value,$codAsignacionCantidad,".$this->codAsignacionMaterial.",this)' />								
								</td>
							</tr>";
			$i++;
		}	
			
		$cadCantidad.="		</table>
						</div>";
		return($cadCantidad);
	}
	
	/////////////
	
	
	public function tablaUnidad($codAlmacen,$cadValorTotal)
	{
		$cadTabla="<table>";
		
		$queryOUM="select distinct(codAsignacionCantidad) from kardex k, kardex_detalle kd where k.codKardex=kd.codKardex and k.codAlmacen=$codAlmacen and codAsignacionMaterial=".$this->codAsignacionMaterial;
		$resultOUM=mysql_query($queryOUM);
		while($rowOUM=mysql_fetch_array($resultOUM))
		{
			$codAsignacionCantidadO=$rowOUM['codAsignacionCantidad'];
			$obtenerTotalesC=new obtenerTotales($this->codAsignacionMaterial, $codAlmacen);
			$cadTotalI=$obtenerTotalesC->totalCaracteristicaIngreso($codAsignacionCantidadO);
			$cadTotalS=$obtenerTotalesC->totalCaracteristicaSalida($codAsignacionCantidadO);
			$cadTotalR=$obtenerTotalesC->totalCaracteristicaReserva($codAsignacionCantidadO);
			
			$cadTotal=$cadTotalI - $cadTotalS - $cadTotalR;
			
			//obtener si existe alguna asignacion en el vector de valores y restarlo al total que se obtuvo en el paso anterior
			$cadCopia=$cadValorTotal;
			$cad1V=split("-",$cadCopia);
			$cant1=count($cad1V)-1;
			$indice1=0;
	
			$sumaCaracteristica=0;
			$cadAsignado="";
			while($indice1<$cant1)
			{
			
				$cad2V=split(":",$cad1V[$indice1]);
				//calcular total por caracteristica
				if($this->codAsignacionMaterial == $cad2V[1] && $codAsignacionCantidadO==$cad2V[0])
				{
					$sumaCaracteristica=$sumaCaracteristica + $cad2V[2];
					
					$queryONM="SELECT caracteristica FROM caracteristica_cantidad c, unidad_medida u where u.codCaracteristicaCantidad=c.codCaracteristicaCantidad and c.nivel=1 and u.codAsignacionCantidad=$codAsignacionCantidadO";
					$resultONM=mysql_query($queryONM);
					$rowONM=mysql_fetch_array($resultONM);
					$caracteristicaO=$rowONM['caracteristica'];
	
					$cadAsignado="<div id='divContenidoTotal' class='materialDiv2' >
			 		<div class='titulo' style='background-color:#8E4B02' style='color=#ffffff'>Usted Esta Asignando </div><strong><div id='divCantidadTotal' class='textoNormal'>$sumaCaracteristica</div></strong> $caracteristicaO(s)
			   </div>";
				}
												
				$indice1++;			
			}
			
			$cadTotalN=$cadTotal-$sumaCaracteristica;
			
			if($cadTotal>0)
			{
				$cadCaracteristicaM=$this->unidadMedidaUnidad($codAsignacionCantidadO);
				
				$cadUnidadTxt=$this->unidadMedidaTxt($codAsignacionCantidadO);
				
				$cadTabla.="<tr>
								<td>
									<div id='divCantidadUnidad$codAsignacionCantidadO".$this->codAsignacionMaterial."'>
										$cadTotalN  
									</div>
									<input name='hdeCantidadUnidad$codAsignacionCantidadO".$this->codAsignacionMaterial."' type='hidden' value='$cadTotal' />
								</td>
								<td>
									$cadUnidadTxt
								</td>
								<td>
									$cadCaracteristicaM
								</td>
								<td>
									<div id='divCantidadAsignada$codAsignacionCantidadO".$this->codAsignacionMaterial."'>
										$cadAsignado
									</div>
								</td>
							</tr>";
			}
		}
		$cadTabla.="</table>";
		return($cadTabla);
	}
}
//clase para obtener totales
class obtenerTotales
{
	private $codAsignacionMaterial;
	private $codAlmacen;
	
	function __construct($codAsignacionMaterial,$codAlmacen)
	{
		$this->codAsignacionMaterial=$codAsignacionMaterial;
		$this->codAlmacen=$codAlmacen;
	}
	function setCodAsignacionMaterial($codAsignacionMaterial)
	{
		$this->codAsignacionMaterial=$codAsignacionMaterial;
	}
	function getCodAsignacionMaterial()
	{
		return($this->codAsignacionMaterial);
	}
	function setCodAlmacen($codAlmacen)
	{
		$this->codAlmacen=$codAlmacen;
	}
	function getCodAlmacen()
	{
		return($this->codAlmacen);
	}
	
	public function totalIngreso()
	{
		$query="select ifnull(sum(kd.cantidad),0) as total from kardex k, kardex_detalle kd where k.codKardex=kd.codKardex and k.estado=1 and k.codAlmacen=".$this->codAlmacen." and kd.codAsignacionMaterial=".$this->codAsignacionMaterial;
		$result=mysql_query($query);
		$row=mysql_fetch_array($result);
		
		$total=$row['total'];
		return($total);
	}
	public function totalSalida()
	{
		$query="select ifnull(sum(kd.cantidad),0) as total from kardex k, kardex_detalle kd where k.codKardex=kd.codKardex and k.estado=3 and k.codAlmacen=".$this->codAlmacen." and kd.codAsignacionMaterial=".$this->codAsignacionMaterial;
		$result=mysql_query($query);
		$row=mysql_fetch_array($result);
		
		$total=$row['total'];
		return($total);
	}
	public function totalReserva()
	{
		$query="select ifnull(sum(kd.cantidad),0) as total from kardex k, kardex_detalle kd where k.codKardex=kd.codKardex and k.estado=2 and k.codAlmacen=".$this->codAlmacen." and kd.codAsignacionMaterial=".$this->codAsignacionMaterial;
		$result=mysql_query($query);
		$row=mysql_fetch_array($result);
		
		$total=$row['total'];
		return($total);
	}
	
	public function totalCaracteristicaIngreso($codAsignacionCantidad)
	{
		$query="select sum(kd.cantidad) as total from kardex k, kardex_detalle kd where k.codKardex=kd.codKardex and k.estado=1 and k.codAlmacen=".$this->codAlmacen." and kd.codAsignacionMaterial=".$this->codAsignacionMaterial." and kd.codAsignacionCantidad=".$codAsignacionCantidad;
		
		$result=mysql_query($query);
		$row=mysql_fetch_array($result);
		$total=$row['total'];
		return($total);
	}
	
	public function totalCaracteristicaSalida($codAsignacionCantidad)
	{
		$query="select sum(kd.cantidad) as total from kardex k, kardex_detalle kd where k.codKardex=kd.codKardex and k.estado=3 and k.codAlmacen=".$this->codAlmacen." and kd.codAsignacionMaterial=".$this->codAsignacionMaterial." and kd.codAsignacionCantidad=".$codAsignacionCantidad;
		
		$result=mysql_query($query);
		$row=mysql_fetch_array($result);
		$total=$row['total'];
		return($total);
	}
	
	public function totalCaracteristicaReserva($codAsignacionCantidad)
	{
		$query="select sum(kd.cantidad) as total from kardex k, kardex_detalle kd where k.codKardex=kd.codKardex and k.estado=2 and k.codAlmacen=".$this->codAlmacen." and kd.codAsignacionMaterial=".$this->codAsignacionMaterial." and kd.codAsignacionCantidad=".$codAsignacionCantidad;
		
		$result=mysql_query($query);
		$row=mysql_fetch_array($result);
		$total=$row['total'];
		return($total);
	}
}

//clase para obtener una lista de opciones <option></option> y llenar un combo box
class llenarCombo
{
	private $tabla;
	private $codigo;
	private $descripcion;
	private $codUsuario;
	
	function __construct($tabla, $codigo, $descripcion, $codUsuario)
	{
		$this->tabla=$tabla;
		$this->codigo=$codigo;
		$this->descripcion=$descripcion;
		$this->codUsuario=$codUsuario;
		
	}
	function setTabla($tabla)
	{
		$this->tabla=$tabla;
	}
	function setCodigo($codigo)
	{
		$this->codigo=$codigo;
	}

	function setDescripcion($descripcion)
	{
		$this->descripcion=$descripcion;
	}
	function setCodUsuario($codUsuario)
	{
		$this->codUsuario=$codUsuario;
	}
	
	function getTabla()
	{
		return($this->tabla);
	}
	function getCodigo()
	{
		return($this->codigo);
	}
	function getDescripcion()
	{
		return($this->descripcion);
	}
	function getCodUsuario()
	{
		return($this->codUsuario);
	}
	
	public function obtenerOpcionesMaterialUsuario()
	{
		$queryOD="select m.codMaterial, m.material from material m, usuario_material um where um.codMaterial=m.codMaterial and um.codUsuario=".$this->codUsuario."";
		$resultOD=mysql_query($queryOD);
		$cadOpciones="";
		while($rowOD=mysql_fetch_array($resultOD))
		{
			$codigoO=$rowOD['codMaterial'];
			$descripcionO=ucwords(strtolower($rowOD['material']));
			$cadOpciones.="<option value='$codigoO'>$descripcionO</option>";
		}
		return($cadOpciones);
	}
}

//clase para obtener una tabla del detalle_solicitud
class obtenerDetalle
{
	private $codSolicitud;
	
	function __construct($codSolicitud)
	{
		$this->codSolicitud=$codSolicitud;
	}
	
	function setCodSolicitud($codSolicitud)
	{
		$this->codSolicitud=$codSolicitud;
	}
	
	function getCodSolicitud()
	{
		return($this->codSolicitud);
	}
	
	public function tablaDetalleSolicitud()
	{
			$cadTabla="<table border='0' style='font-family:Verdana' style='font-size:11px' width='100%' align='center'>
					<tr bgcolor='#9D6A26' style='color:#FFFFFF' >
						<td>
							Material
						</td>
						<td>
							Cantidad
						</td>
						<td>
							Descripcion
						</td>
						<td>
							&nbsp;
						</td>
					</tr>";
		$queryODD="select m.material, ds.codDetalleSolicitud, ds.cantidad, ds.descripcion from detalle_solicitud ds, material m where ds.codMaterial=m.codMaterial and ds.codSolicitud=".$this->codSolicitud;
		$resultODD=mysql_query($queryODD);
		$aux=1;
		while($rowODD=mysql_fetch_array($resultODD))
		{
			$materialO=$rowODD['material'];
			$codDetalleSolicitudO=$rowODD['codDetalleSolicitud'];
			$cantidadO=$rowODD['cantidad'];
			$descripcionO=$rowODD['descripcion'];
			
			if($aux==1)
			{
				$men="bgcolor=#F6F3ED";
				$aux=2;
			}
			else
			{
				$men="bgcolor=#FFFFFF";
				$aux=1;
			}
			
			$cadTabla.="<tr $men>
							<td align='left'>
								$materialO
							</td>
							<td>
								$cantidadO
							</td>
							<td align='left'>
								$descripcionO
							</td>
							<td>
								<img src='imagenes/b_drop.png' onmouseover='this.style.cursor = \"hand\"' alt='Eliminar' onclick='eliminarRegistro($codDetalleSolicitudO)'>
							</td>
						</tr>";
		}
		$cadTabla.="</table>";
		return ($cadTabla);
	}
}

class calcular
{
	private $codSolicitud;
	
	function __construct($codSolicitud)
	{
		$this->codSolicitud=$codSolicitud;
	}
	
	function setCodSolicitud($codSolicitud)
	{
		$this->codSolicitud=$codSolicitud;
	}
	
	function getCodSolicitud()
	{
		return($this->codSolicitud);
	}
	
	public function calcularRowSpan()
	{
		$queryOC="select count(*) as cantidad from detalle_solicitud where codSolicitud=".$this->codSolicitud;
		$resultOC=mysql_query($queryOC);
		$rowOC=mysql_fetch_array($resultOC);
		
		$cantidadO=$rowOC['cantidad'];
		return($cantidadO);
	}
}
?>
<?php

function obtenerAsignacionLinea($usuario)
{
  require "config.php";
  $query="SELECT  l.linea as linea, l.logo as logo
          from lineaempresa l, asignacionlinea asi
          where asi.codUsuario=$usuario and
	              asi.codLineaEmpresa=l.codLineaEmpresa and
	              asi.estado=1";
  $result=$con->query($query);
  if($result->rowCount() == 1){
    // existe
    $row=$result->fetch(PDO::FETCH_NUM);
    $codO=array($row[0],$row[1]);
  }else{
    echo "No se encontro ningun registro";
    return false;
  }
  return $codO;
}
function obtenerAsignacionAlmacen($usuario)
{
  require "config.php";
  $query="SELECT a.almacen as almacen
          from asignacionalmacen asi, almacen a
          where asi.codUsuario=$usuario and
	              asi.codAlmacen=a.codAlmacen and
	              asi.estado=1";
  $result=$con->query($query);
  if($result->rowCount() == 1){
    // existe
    $row=$result->fetch(PDO::FETCH_NUM);
    $codO=$row[0];
  }else{
    echo "No se encontro ningun registro";
    return false;
  }
  return $codO;
}
function obtenerUltimo($tabla,$codigo)
{
  require "config.php";
  $query="SELECT ifnull(max($codigo)+1,1) as ult from $tabla";
  $result=$con->query($query);
  if($result->rowCount() == 1){
    // existe
    $row=$result->fetch(PDO::FETCH_NUM);
    $codO=$row[0];
  }else{
    echo "No se encontro ningun registro";
    return false;
  }
  return $codO;
}
function obtenerCombo($tabla,$val,$opt)
{
  require "config.php";
  $query="select * from $tabla";
  $buscarU=$con->query($query);
  $cad="<select id='cmb$tabla' name='cmb$tabla' class='form-control' required>";
  while($row=$buscarU->fetch(PDO::FETCH_ASSOC))
  {
    $cad.="<option value='$row[$val]'>$row[$opt]</option>";
  }
  $cad.="</select>";
  return $cad;
}
function obtenerfechaCastellano ($fecha) {
  $fecha = substr($fecha, 0, 10);
  $numeroDia = date('d', strtotime($fecha));
  $dia = date('l', strtotime($fecha));
  $mes = date('F', strtotime($fecha));
  $anio = date('Y', strtotime($fecha));
  $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
  $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
  $nombredia = str_replace($dias_EN, $dias_ES, $dia);
  $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
  $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
  $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
  return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
}
 ?>

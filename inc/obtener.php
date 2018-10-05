<?php
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
 ?>

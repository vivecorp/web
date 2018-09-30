<?php
require_once "config.php";
$query="select * from lineaempresa where estado=1";
// $result=mysql_query($query);
$buscarU=$con->query($query);
$cad="<select id='cmbLineaEmpresa' name='cmbLineaEmpresa' class='form-control' required>";
while($row=$buscarU->fetch(PDO::FETCH_NUM))
{
  $cad.="<option value='$row[0]'>$row[1]</option>";
}
$cad.="</select>";
echo $cad;
 ?>

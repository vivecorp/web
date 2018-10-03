<?php
require_once "config.php";
$query="select * from actividadeconomica";
// $result=mysql_query($query);
$buscarU=$con->query($query);
$cad="<select id='cmbActividadEconomicaA' name='cmbActividadEconomicaA' class='form-control' required>";
while($row=$buscarU->fetch(PDO::FETCH_NUM))
{
  $cad.="<option value='$row[0]'>($row[1]) $row[2]</option>";
}
$cad.="</select>";
echo $cad;
 ?>

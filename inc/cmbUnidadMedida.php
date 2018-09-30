<?php
require_once "config.php";
$query="select * from unidadmedida";
// $result=mysql_query($query);
$buscarU=$con->query($query);
$cad="<select id='cmbUnidadMedida' name='cmbUnidadMedida' class='form-control' required>";
while($row=$buscarU->fetch(PDO::FETCH_NUM))
{
  $cad.="<option value='$row[0]'>$row[1] ($row[2])</option>";
}
$cad.="</select>";
echo $cad;
 ?>

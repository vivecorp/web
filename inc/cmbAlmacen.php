<?php
require_once "config.php";
$query="select * from almacen";
// $result=mysql_query($query);
$buscarU=$con->query($query);
$cad="<select id='cmbAlmacen' name='cmbAlmacen' class='form-control' required>";
while($row=$buscarU->fetch(PDO::FETCH_NUM))
{
  $cad.="<option value='$row[0]'>$row[1]</option>";
}
$cad.="</select>";
echo $cad;
 ?>

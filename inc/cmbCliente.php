<?php
require_once "config.php";
$cod=$_GET['codClienteG'];
$query="select * from cliente";
// $result=mysql_query($query);
$buscarU=$con->query($query);
$cad="<select id='cmbcliente' name='cmbcliente' class='form-control' required onchange=obtenerNit()>";
while($row=$buscarU->fetch(PDO::FETCH_NUM))
{
  $aux="";
  if ($row[0] == $cod) {
    // code...
    $aux="selected";
  }
  $cad.="<option value='$row[0]' $aux>$row[1]</option>";
}
$cad.="</select>";
echo $cad;
 ?>

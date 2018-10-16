<?php
require_once "config.php";
$query="select * from tipopago";
// $result=mysql_query($query);
$buscarU=$con->query($query);
$cad="<select id='cmbTipoPago' name='cmbTipoPago' class='form-control' required>
        <option value=''>seleccione Tipo Pago...</option>";
while($row=$buscarU->fetch(PDO::FETCH_NUM))
{
  $cad.="<option value='$row[0]'>$row[1]</option>";
}
$cad.="</select>";
echo $cad;
 ?>

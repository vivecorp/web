<?php
require_once "../inc/config.php";
$cod=$_POST['cod'];
$query="delete from lineaempresa where codLineaEmpresa=$cod";
echo $borrarU=$con->exec($query);

?>

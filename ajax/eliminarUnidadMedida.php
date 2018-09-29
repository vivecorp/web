<?php
require_once "../inc/config.php";
$cod=$_POST['cod'];
$query="delete from unidadmedida where codUnidadMedida=$cod";
echo $borrarU=$con->exec($query);

?>

<?php
require_once "../inc/config.php";
$cod=$_POST['cod'];
$query="delete from actividadeconomica where codActividadEconomica=$cod";
echo $borrarU=$con->exec($query);

?>

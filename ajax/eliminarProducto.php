<?php
require_once "../inc/config.php";
$cod=$_POST['cod'];
$query="delete from producto where codProducto=$cod";
echo $borrarU=$con->exec($query);

?>

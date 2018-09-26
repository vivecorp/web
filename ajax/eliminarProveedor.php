<?php
require_once "../inc/config.php";
$cod=$_POST['cod'];
$query="delete from proveedor where codProveedor=$cod";
echo $borrarU=$con->exec($query);

?>

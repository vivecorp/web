<?php
require_once "../inc/config.php";
$cod=$_POST['cod'];
$query="delete from role where codRole=$cod";
echo $borrarU=$con->exec($query);

?>

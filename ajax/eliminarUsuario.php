<?php
require_once "../inc/config.php";
$codUsuarioP=$_POST['codUsuario'];
$query="delete from usuario where codUsuario=$codUsuarioP";
echo $borrarU=$con->exec($query);

?>

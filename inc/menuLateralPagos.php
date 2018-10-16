<?php
// llenar los datos de usuario
session_start();
require_once "inc/config.php";
$codUsuarioG=$_SESSION['codUsuarioG'];
$query="select u.nombre as nombre, u.foto as foto, r.role as role from usuario u, role r where u.codUsuario=$codUsuarioG and u.codRole=r.codRole";
$result=$con->query($query);
if($result->rowCount() == 1){
   // existe usuario
   $row=$result->fetch(PDO::FETCH_ASSOC);

}else{
    echo "No se encontro ningun registro";
    return false;
}
?>
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
  <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" width="48" src="foto/<?php echo $row['foto']; ?>" alt="User Image">
    <div>
      <p class="app-sidebar__user-name" id="pUsuario"><?php echo $row['nombre']; ?></p>
      <p class="app-sidebar__user-designation" id="pRole"><?php echo $row['role']; ?></p>
    </div>
  </div>
  <ul class="app-menu">
    <li><a class="app-menu__item active" href="gerenteConsole.php"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
    <li><a class="app-menu__item" href="pagos.php"><i class="app-menu__icon fa fa-cart-plus"></i><span class="app-menu__label">Pagos Pendientes</span></a></li>
    <li><a class="app-menu__item" href="pagosRealizados.php"><i class="app-menu__icon fa fa-list"></i><span class="app-menu__label">Pagos Realizados</span></a></li>
    <li><a class="app-menu__item" href="bancos.php"><i class="app-menu__icon fa fa-balance-scale"></i><span class="app-menu__label">Bancos</span></a></li>
    <li><a class="app-menu__item" href="tiposPago.php"><i class="app-menu__icon fa fa-book"></i><span class="app-menu__label">Tipos de Pago</span></a></li>
  </ul>
</aside>

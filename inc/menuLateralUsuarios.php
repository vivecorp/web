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
    <li><a class="app-menu__item" href="usuario.php"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">Usuarios</span></a></li>
    <li><a class="app-menu__item" href="role.php"><i class="app-menu__icon fa fa-address-card"></i><span class="app-menu__label">Roles</span></a></li>
  </ul>
</aside>

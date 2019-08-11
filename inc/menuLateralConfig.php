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
  <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" width="48" src="foto/<?php echo $row['foto']; ?>" alt="Usuario de Configuracion">
    <div>
      <p class="app-sidebar__user-name" id="pUsuario"><?php echo $row['nombre']; ?></p>
      <p class="app-sidebar__user-designation" id="pRole"><?php echo $row['role']; ?></p>
    </div>
  </div>
  <ul class="app-menu">
    <li><a class="app-menu__item active" href="configConsole.php"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
    <li><a class="app-menu__item" href="usuario.php"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">Usuarios</span></a></li>
    <li><a class="app-menu__item" href="actividadEconomica.php"><i class="app-menu__icon fa fa-industry"></i><span class="app-menu__label">Actividad Economica</span></a></li>
    <li><a class="app-menu__item" href="lineaEmpresa.php"><i class="app-menu__icon fa fa-list"></i><span class="app-menu__label">Lineas Empresarial</span></a></li>
    <li><a class="app-menu__item" href="almacen.php"><i class="app-menu__icon fa fa-archive"></i><span class="app-menu__label">Almacenes</span></a></li>
    <li><a class="app-menu__item" href="parametrosUsuario.php"><i class="app-menu__icon fa fa-user-secret"></i><span class="app-menu__label">Parametros Usuarios</span></a></li>
    <li><a class="app-menu__item" href="parametros.php"><i class="app-menu__icon fa fa-cog"></i><span class="app-menu__label">Parametros Empresa</span></a></li>
    <li><a class="app-menu__item" href="parametrosImpresion.php"><i class="app-menu__icon fa fa-print"></i><span class="app-menu__label">Parametros Impresion</span></a></li>
    <li><a class="app-menu__item" href="verificador.php"><i class="app-menu__icon fa fa-check-square-o"></i><span class="app-menu__label">Verificador Cod. Control</span></a></li>
    <li><a class="app-menu__item" href="dosificacion.php"><i class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">Dosificacion</span></a></li>
    <li><a class="app-menu__item" href="asignarDosificacion.php"><i class="app-menu__icon fa fa-handshake-o"></i><span class="app-menu__label">Asignar Dosificacion</span></a></li>
    <li><a class="app-menu__item" href="index.php"><i class="app-menu__icon fa fa-sign-out"></i><span class="app-menu__label">Salir</span></a></li>
  </ul>
</aside>

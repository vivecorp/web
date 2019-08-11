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
    <li><a class="app-menu__item" href="proveedor.php"><i class="app-menu__icon fa fa-suitcase"></i><span class="app-menu__label">Proveedores</span></a></li>
    <li><a class="app-menu__item" href="producto.php"><i class="app-menu__icon fa fa-product-hunt"></i><span class="app-menu__label">Productos</span></a></li>
    <li><a class="app-menu__item" href="compras.php"><i class="app-menu__icon fa fa-shopping-basket"></i><span class="app-menu__label">Compras</span></a></li>
    <li><a class="app-menu__item" href="ventas.php"><i class="app-menu__icon fa fa-cart-plus"></i><span class="app-menu__label">Ventas</span></a></li>
    <li><a class="app-menu__item" href="pagos.php"><i class="app-menu__icon fa fa-cc-visa"></i><span class="app-menu__label">Pagos</span></a></li>
    <li><a class="app-menu__item" href="pagos.php"><i class="app-menu__icon fa fa-money"></i><span class="app-menu__label">Cobros</span></a></li>
    <li><a class="app-menu__item" href="ingresoMaterial.php"><i class="app-menu__icon fa fa-archive"></i><span class="app-menu__label">Inventario</span></a></li>
    <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-newspaper-o"></i><span class="app-menu__label">Reportes</span><i class="treeview-indicator fa fa-angle-right"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item" href="reporteInventarios.php" ><i class="icon fa fa-archive"></i> Inventario</a></li>
        <li><a class="treeview-item" href="reporteVentas.php"><i class="icon fa fa-cart-plus"></i> Ventas</a></li>
        <li><a class="treeview-item" href="reporteCompras.php"><i class="icon fa fa-circle-o"></i> Compras</a></li>
      </ul>
    </li>
    <li><a class="app-menu__item" href="login.php"><i class="app-menu__icon fa fa-sign-out"></i><span class="app-menu__label">Salir</span></a></li>

    <li><a class="app-menu__item" href="charts.html"><i class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">Charts</span></a></li>

  </ul>
</aside>

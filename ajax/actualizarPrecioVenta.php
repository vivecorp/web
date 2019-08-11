<?php
  session_start();
  if(!$_SESSION['codUsuarioG'] || $_SESSION['roleG']!=1)
  {
    header("location: login.php");
  }
  require_once "../inc/config.php";
  $datos=array(
    $_POST['hdeCodProductoA'],
    $_POST['txtPrecioVentaA'],
    $_POST['txtObservacionesA']
      );
      // capturar foto
  $codUsuario=$_SESSION['codUsuarioG'];

  $query="UPDATE precioventa set
                    estado=2
					where codProducto=$datos[0]";
  $actualizarU=$con->exec($query);

  // buscar ultimo codigo de usuario
  $query="SELECT ifnull(max(codPrecioVenta)+1,1) as ult from precioventa";
  $result=$con->query($query);
  if($result->rowCount() == 1){
    // existe
    $row=$result->fetch(PDO::FETCH_NUM);
    $codO=$row[0];
  }else{
    echo "No se encontro ningun registro";
    return false;
  }
  $fecha=date("Y-m-d");

  $sql="INSERT into precioventa	values (
                      $codO,
                      '$fecha',
                      $datos[1],
                      '$datos[2]',
                      1,
                      $codUsuario,
                      $datos[0]
                    )";
  echo $buscarU=$con->exec($sql);
?>

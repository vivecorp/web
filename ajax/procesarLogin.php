<?php
  require_once "../inc/config.php";
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    header("Content-Type: application/json");
    $arrayDevolver=[];
    $usuario=$_POST['usuario'];
    $password=$_POST['password'];
    // comprobar si el usuario existe
    $buscarU=$con->prepare("select * from usuario where usuario=:usuario and password=:password");
    $buscarU->bindParam(':usuario',$usuario);
    $buscarU->bindParam(':password',$password);
    $buscarU->execute();

  if($buscarU->rowCount() == 1){
    // existe usuario
    $user=$buscarU->fetch(PDO::FETCH_ASSOC);
    $codUsuario=$user['codUsuario'];
    $role=$user['codRole'];
    session_start();
    $_SESSION['codUsuarioG']=$codUsuario;
    $_SESSION['roleG']=$role;
    // redirecciona de acuerdo a su role
    if($role == 1){
      $arrayDevolver['redirect']='gerenteConsole.php';
    }
  }else{
    $arrayDevolver['error']="Usuario o Password Incorrecto";
  }
  echo json_encode($arrayDevolver);
}else{
  exit("Prohibido su Ingreso");
}
?>

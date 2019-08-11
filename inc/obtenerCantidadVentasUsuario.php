<?php
  session_start();
  require_once "config.php";
  $codUsuario=$_SESSION["codUsuarioG"];
  $codRole=$_SESSION["roleG"];
  if(!$codUsuario)
  {
?>
    <script type="text/javascript">
      alert("Se Cerro la Sesion por Seguridad, Vuelva a iniciar Sesion");
      location.href="login.php";
    </script>
<?php
  }
  if($codRole==1)
  {
    $queryOV="select count(codVentas) as numVentas
                from ventas
                where  date_format(fecha,'%d/%m/%Y')=date_format(now(),'%d/%m/%Y')";
  }
  if($codRole==2)
  {
    $queryOV="select count(codVentas) as numVentas
                from ventas
                where codUsuario=$codUsuario and date_format(fecha,'%d/%m/%Y')=date_format(now(),'%d/%m/%Y')";
  }


  $resultOV=$con->query($queryOV);
  if($resultOV->rowCount() == 1){
     // existe usuario
    $rowOV=$resultOV->fetch(PDO::FETCH_ASSOC);

    $numVentas=$rowOV['numVentas'];
    echo $numVentas;
  }else{
      echo "No se encontro ningun registro";
      return false;
  }
?>

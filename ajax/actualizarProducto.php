<?php
  require_once "../inc/config.php";
  $datos=array(
    $_POST['hdeCodProductoA'],
    $_POST['txtArticuloA'],
    $_POST['txtDescripcionA'],
    $_POST['txtCodigoBarraA'],
    $_POST['cmbUnidadMedidaA'],
    $_POST['cmbLineaEmpresaA'],
    $_POST['cmbActividadEconomicaA'],
    1
      );
      // capturar foto
    	$f='fileFotoA';
      if(!empty($_FILES[$f]))
  	  {
  			$fotoO=$datos[1].".".pathinfo($_FILES[$f]['name'], PATHINFO_EXTENSION);
        // echo $fotoO;
  			if ($_FILES[$f]["error"] > 0)
  			{
  				if($_FILES[$f]["error"] == 4)
  				{
            // verificar si hay foto
            $qr="select * from producto where codProducto=$datos[0]";
            $buscarU=$con->query($qr);
            $rowQ=$buscarU->fetch(PDO::FETCH_ASSOC);

            $fotoQ=$rowQ['foto'];

            if (file_exists("../productos/" . $fotoQ))
            {
              $fotoO=$fotoQ;
            }
            else {
              // code...
              $fotoO="defecto.jpg";
            }
  				}
  				else {
  					echo "Error de subida: " . $_FILES[$f]['error'];
  					return false;
  				}
  			}
  			else
  			{
  			  /*ahora co la funcion move_uploaded_file lo guardaremos en el destino que queramos*/
          // echo "subira".$fotoO;
          if (file_exists("../productos/" . $fotoO))
          {
            unlink("../productos/" . $fotoO);
          }
          move_uploaded_file($_FILES[$f]['tmp_name'],"../productos/" . $fotoO);
  			}
  		}
  	  else {
        // verificar si hay foto
        $qr="select * from producto where codProducto=$datos[0]";
        $buscarU=$con->query($qr);
        $rowQ=$buscarU->fetch(PDO::FETCH_ASSOC);

        $fotoQ=$rowQ['foto'];
        if(!$fotoQ)
        {
          $fotoO="defecto.jpg";
        }
        else {
          if ($fotoQ != "defecto.jpg") {
            // code...
            $fotoO=$fotoQ;
          }
          else {
            $fotoO="defecto.jpg";
          }
        }
  	  }
  $query="UPDATE producto set
                    articulo='$datos[1]',
                    descripcion='$datos[2]',
                    codigoBarra='$datos[3]',
                    foto='$fotoO',
                    estado=$datos[7],
                    codUnidadMedida=$datos[4],
                    codLineaEmpresa=$datos[5],
                    codActividadEconomica=$datos[6]
					where codProducto=$datos[0]";
  $actualizarU=$con->exec($query);
  if($actualizarU==0)
  {
    $actualizarU=1;
  }
  echo $actualizarU;
  // echo $query;
?>

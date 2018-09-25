<?php
include 'control.php';
require "phpqrcode/qrlib.php";

	//Declaramos una carpeta temporal para guardar la imagenes generadas
	$dir = 'temp/';

	//Si no existe la carpeta la creamos
	if (!file_exists($dir))
        mkdir($dir);

        //Declaramos la ruta y nombre del archivo a generar
	$filename = $dir.'test.png';

        //Parametros de Condiguración

	$tamaño = 2; //Tamaño de Pixel
	$level = 'H'; //Precisión Baja
	$framSize = 0; //Tamaño en blanco
	$contenido = "7904006306693|876814|1665979|2008/05/19|35958,6|zZ7Z]xssKqkEf_6K9uH(EcV+%x+u[Cca9T%+_$kiLjT8(zr3T9b5Fx2xG-D+_EBS|27773|7904006306693zZ787681455Z]xssKqk166597949Ef_6K9uH2008051967(EcV+%x+3595999u[Cc|15847127|ySxN|7B-F3-48-A8|"; //Texto

        //Enviamos los parametros a la Función para generar código QR
	QRcode::png($contenido, $filename, $level, $tamaño, $framSize);

        //Mostramos la imagen generada
	echo '<img src="'.$dir.basename($filename).'" /><hr/>';


try
{
    $controlCode = new ControlCode();
    $code = $controlCode->generate('7904006306693',//Numero de autorizacion
                                   '876814',//Numero de factura
                                   '1665979',//Número de Identificación Tributaria o Carnet de Identidad
                                   str_replace('/','','2008/05/19'),//fecha de transaccion de la forma AAAAMMDD
                                   35958.6,//Monto de la transacción
                                   'zZ7Z]xssKqkEf_6K9uH(EcV+%x+u[Cca9T%+_$kiLjT8(zr3T9b5Fx2xG-D+_EBS'//Llave de dosificación
                                  );
  echo $code." funciono";
}catch ( Exception $e ){
  // header("location: login.php");
  echo "Error (File: ".$e->getFile().", line ".$e->getLine()."): ".$e->getMessage();
}
?>

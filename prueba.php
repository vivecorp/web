<?php
include 'control.php';
try{
    $filename="50001CasosPruebaCCVer7.txt";
    $handle = fopen($filename, "r");
    if ($handle) {
        $controlCode = new ControlCode();
        $count=0;
        while (($line = fgets($handle)) !== false) {
            $reg = explode("|", $line);
            //genera codigo de control
            $code = $controlCode->generate('7904006306693',//Numero de autorizacion
                                           '876814',//Numero de factura
                                           '1665979',//Número de Identificación Tributaria o Carnet de Identidad
                                           str_replace('/','','2008/05/19'),//fecha de transaccion de la forma AAAAMMDD
                                           '35958,6',//Monto de la transacción
                                           'zZ7Z]xssKqkEf_6K9uH(EcV+%x+u[Cca9T%+_$kiLjT8(zr3T9b5Fx2xG-D+_EBS'//Llave de dosificación
                    );
            echo $code."<br />";
            if($code===$reg[10]){
                $count+=1;
            }
        }
        echo 'Archivo <b>'.$filename.'</b><br/>';
        echo 'Total registros testeados <b>'.$count.'</b><br/>';
        echo 'Errores <b>0</b><br/>';
    fclose($handle);

    }else{
         throw new Exception("<b>no se abrio el documento!</b>");
    }
}catch ( Exception $e ){
  echo "Error (File: ".$e->getFile().", line ".$e->getLine()."): ".$e->getMessage();
}
?>

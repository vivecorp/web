<?php
// clases para codigo de control

class Verhoeff {

    static public $d = array(
        array(0,1,2,3,4,5,6,7,8,9),
        array(1,2,3,4,0,6,7,8,9,5),
        array(2,3,4,0,1,7,8,9,5,6),
        array(3,4,0,1,2,8,9,5,6,7),
        array(4,0,1,2,3,9,5,6,7,8),
        array(5,9,8,7,6,0,4,3,2,1),
        array(6,5,9,8,7,1,0,4,3,2),
        array(7,6,5,9,8,2,1,0,4,3),
        array(8,7,6,5,9,3,2,1,0,4),
        array(9,8,7,6,5,4,3,2,1,0)
    );

    static public $p = array(
        array(0,1,2,3,4,5,6,7,8,9),
        array(1,5,7,6,2,8,3,0,9,4),
        array(5,8,0,3,7,9,6,1,4,2),
        array(8,9,1,6,0,4,3,5,2,7),
        array(9,4,5,3,1,2,6,8,7,0),
        array(4,2,8,6,5,7,3,9,0,1),
        array(2,7,9,3,8,0,6,4,1,5),
        array(7,0,4,6,9,1,3,2,5,8)
    );

    static public $inv = array(0,4,3,2,1,5,6,7,8,9);

    static function calc($num) {
        if(!preg_match('/^[0-9]+$/', $num)) {
            throw new \InvalidArgumentException(sprintf("Error! Value is restricted to the number, %s is not a number.",
                                                    $num));
        }

        $r = 0;
        foreach(array_reverse(str_split($num)) as $n => $N) {
            $r = self::$d[$r][self::$p[($n+1)%8][$N]];
        }
        return self::$inv[$r];
    }

    static function check($num) {
        if(!preg_match('/^[0-9]+$/', $num)) {
            throw new \InvalidArgumentException(sprintf("Error! Value is restricted to the number, %s is not a number.",
                                                    $num));
        }

        $r = 0;
        foreach(array_reverse(str_split($num)) as $n => $N) {
            $r = self::$d[$r][self::$p[$n%8][$N]];
        }
        return $r;
    }

    static function generate($num) {
        return sprintf("%s%s", $num, self::calc($num));
    }

    static function validate($num) {
        return self::check($num) === 0;
    }
}

class AllegedRC4 {

    /**
     * Retorna mensaje encriptado
     * @param message mensaje a encriptar
     * @param key llave para encriptar
     * @param unscripted sin guion TRUE|FALSE
     * @return String mensaje encriptado
     */
    static function encryptMessageRC4($message, $key,$unscripted=false){
        $state = range(0, 255);
        $x=0;
        $y=0;
        $index1=0;
        $index2=0;
        $nmen="";
        $messageEncryption="";

        for($i=0;$i<=255;$i++){
            //Index2 = ( ObtieneASCII(key[Index1]) + State[I] + Index2 ) MODULO 256
            $index2 =  ( ord($key[$index1]) +  $state[$i] + $index2) % 256;
            //IntercambiaValor( State[I], State[Index2] )
            $aux = $state[$i];
            $state[$i] = $state[$index2];
            $state[$index2] = $aux;
            //Index1 = (Index1 + 1) MODULO LargoCadena(Key)
            $index1 = ($index1 + 1 ) % strlen($key);
        }
        //PARA I = 0 HASTA LargoCadena(Mensaje)-1 HACER
        for($i=0; $i<strlen($message);$i++ ){
            //X = (X + 1) MODULO 256
            $x = ($x + 1) % 256;
            //Y = (State[X] + Y) MODULO 256
            $y = ($state[$x] + $y) % 256;
            //IntercambiaValor( State[X] , State[Y] )
            $aux = $state[$x];
            $state[$x] = $state[$y];
            $state[$y] = $aux;
            //NMen = ObtieneASCII(Mensaje[I]) XOR State[(State[X] + State[Y]) MODULO 256]
            $nmen = ( ord($message[$i])) ^ $state[($state[$x]+$state[$y]) % 256];
            //MensajeCifrado = MensajeCifrado + "-" + RellenaCero(ConvierteAHexadecimal(NMen))
            $nmenHex = strtoupper(dechex($nmen));
            $messageEncryption = $messageEncryption . (($unscripted)?"":"-"). ((strlen($nmenHex)==1)?('0'.$nmenHex):$nmenHex);
        }
        return (($unscripted)?$messageEncryption:substr($messageEncryption,1,strlen($messageEncryption)));
    }

}

class Base64SIN {

    static function convert($value){
        $dictionary = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9",
                            "A", "B", "C", "D", "E", "F", "G", "H", "I", "J",
                            "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T",
                            "U", "V", "W", "X", "Y", "Z", "a", "b", "c", "d",
                            "e", "f", "g", "h", "i", "j", "k", "l", "m", "n",
                            "o", "p", "q", "r", "s", "t", "u", "v", "w", "x",
                            "y", "z", "+", "/");
        $quotient = 1;
        $word = "";
        while ($quotient > 0)
        {
            $quotient = floor($value / 64);
            $remainder = $value % 64;
            $word = $dictionary[$remainder] . $word;
            $value = $quotient;
        }
        return $word;
    }
}
?>

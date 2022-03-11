<?php
/**
 * Clase para verificar inputs en listas de tipo checkbox, radiobutton...
 */
class Utilidades {
    /**
     * @param array de checkbox y el valor del checkbox correspondiente
     * comprueba si estaba marcado y lo marca
     */
    public static function verificarCheckbox($arrayCB, $valorMenu){
        if(isset($_POST['enviar'])){
            if($arrayCB != ""){
            for($i = 0; $i < count($arrayCB);$i++){
                if($arrayCB[$i] == $valorMenu){
                    echo 'checked';
                }
            }
        }
        }
    }
    /**
     * esta función servía tenía una función como el pattern, 
     * pero al final utilicé pattern.
     */
    /*public static function verificarDni($nif){
        $partes = explode('-', $nif);
        $numeros = $partes[0];
        $letra = strtoupper($partes[1]);
        if (substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeros % 23, 1) == $letra){
        echo 'checked';
        }
    }*/
}

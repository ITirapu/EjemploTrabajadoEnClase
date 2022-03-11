<?php
class Input{
    /**
     * @return si se ha enviado el formulario
     */
    static function siEnviado(){
        return (isset($_POST['enviar'])) ? true : false;
    }

    /**
     * @param datos comprueba si el dato está,
     * si es asi, lo sanea y lo devuelve
     */
    static function get($dato){
            if(isset($_POST[$dato])){
                return Input::filtrarDato($_POST[$dato]);
            }
            return "";
    }
    /**
     * @param recibe un dato, comprueba si es un array
     * para y seguido lo sanea con diferentes metodos
     */
    static function filtrarDato($datos){
        if(is_array($datos)){
            foreach ($datos as $dato) {
                $dato1 = htmlspecialchars(strip_tags(trim($dato)));
                str_replace($dato, $dato1, $datos);
            }
        }else{
            $dato1 = htmlspecialchars(strip_tags(trim($datos)));
            str_replace($datos, $dato1, $datos);
        }
        return $datos;
    }
}
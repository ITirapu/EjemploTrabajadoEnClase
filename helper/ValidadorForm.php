<?php

class ValidadorForm
{
    private $errores;
    private $reglasValidacion;
    private $valido;

    function __construct()
    {
        $this->errores = array();
        $this->reglasValidacion = null;
        $this->numeroSeguridadSocial = false;
    }
    /**
     * Esta funcion recibe como @param 
     * la fuente y las reglas para validar los datos
     */
    function validar($fuente, $reglasValidacion)
    {

        $this->reglasValidacion = $reglasValidacion;
        foreach ($this->reglasValidacion as $nombreCampo => $contenido) {

            if (isset($fuente[$nombreCampo])) {
                $dato = $fuente[$nombreCampo];
                
            } else {
                $dato = "";
            }

            foreach ($contenido as $regla => $valor) {
                switch ($regla) {
                    case "required":
                        if ($dato == "") {
                            $this->addError($nombreCampo, "El campo ${nombreCampo} es requerido.");
                        }
                        break;
                        /*case "min":
                        if(!count($dato) >= $valor){
                            $this->addError($nombreCampo, `Tienes que elegir un minimo de ${nombreCampo} (1 al menos)`);
                        }
                        break;*/
                    case "pattern":
                        if (preg_match($valor, $dato) === 0) {
                            $this->addError($nombreCampo, "El patron de DNI no es correcto, debe consistir en 8 números y 1 letra.");
                        }
                }
            }
        }
        if (count($this->errores) === 0) {
            $this->valido = true;
        }
    }
    /**
     * esta funcion, añade errores al array errores
     * recibe por @param el nombre y el error que ocurre con el dato
     */
    function addError($nombre, $error)
    {

        array_push($this->errores, array($nombre => $error));
    }

    /**
     * @return si es valido
     */
    function esValido()
    {
        return $this->valido;
    }
    /**
     * @return errores
     */
    function getErrores()
    {
        return $this->errores;
    }
}

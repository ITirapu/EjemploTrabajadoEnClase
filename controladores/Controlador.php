<?php
include "helper\ValidadorForm.php";
include "helper\Input.php";
include "modelo\Votante.php";
include "modelo\daoVotante.php";

class Controlador
{
    private $daoVoto;

    function __construct()
    {
        $this->daoVoto = new DaoVotante();
    }
    public function run()
    {
        if (!isset($_POST['enviar']) || ($_POST['enviar'] !== "Validar" && $_POST['enviar'] !== "Continuar")) { //no se ha enviado el formulario
            $this->mostrarFormulario("Validar", null, null);
            exit();
        }
        if (isset($_POST['enviar']) && ($_POST['enviar'] == "Validar")) {
            $this->validar();
            exit();
        }
        if (isset($_POST['enviar']) && ($_POST['enviar'] == "Continuar")) {
            unset($_POST);
            $this->mostrarFormulario("Validar", null, null);
            exit();
        }
    }
    /**
     * esta funcion valida el formulario al enviarse,
     * comprobando entre otras cosas si ya está introducido en la DB
     * 
    */
    private function validar()
    {
        $resultado = "";
        $validador = new ValidadorForm();
        $reglasValidacion = $this->crearReglasDevalidacion();
        $datosVotante = $_POST;
        $validador->validar($datosVotante, $reglasValidacion);
        if ($validador->esValido()) {
            $resultado = $this->daoVoto->existeVotante($datosVotante['dni']);
            if (!$resultado) {
                $this->daoVoto->insertarVotante($this->crearVotante($datosVotante));
                $resultado = $this->parseLinea();
                $this->mostrarFormulario("Continuar", $validador, $resultado);
                exit();
            }
            $this->mostrarFormulario("Validar", $validador, $resultado);
            exit();
        } else {
            $this->mostrarFormulario("Validar", $validador, null);
            exit();
        }
    }
    // Con este metodo, construye la frase 
    // con los datos introducidos
    // @return el resultado
    private function parseLinea()
    {
        $resultado = "Formulario completado, tus Datos y votación: \n ";

        $dni = $_POST['dni'];
        $resultado .= "DNI: $dni";

        $generos = $_POST['generos'];
        $resultado .= "<br>Generos elegidos: ";
        foreach ($generos as $gen) {
            $resultado .= " $gen,";
        }
        $resultado = substr($resultado, 0, -1);

        $cantantes = $_POST['cantantes'];
        $resultado .= "<br>Cantantes de referencia: ";
        foreach ($cantantes as $cant) {
            $resultado .= " ${cant},";
        }
        $resultado = substr($resultado, 0, -1);

        return $resultado .= "<br />";
    }
    // esta funcion, crea y devuelve las reglas de Validacion
    private function crearReglasDeValidacion()
    {
        $reglas = array(
            "dni" => array("pattern" => '/^[0-9]{8}[a-z,A-Z]$/', "maxlength" => 9, "required" => true),
            "generos" => array("required" => true),
            "cantantes" => array("required" => true)
        );
        return $reglas;
    }
    private function mostrarFormulario($fase, $validador, $resultado)
    {
        //se muestra la vista del formulario (la plantilla form_bienvenida.php)   
        include 'vistas/form_bienvenida.php';
    }
    /*private function mostrarResultado($resultado)
    {
        // y se muestra la vista del resultado (la plantilla resultado.,php)
        include 'vistas/form_bienvenida.php';
    }*/

    /**
     * Función que filtra los datos y crea un obj Votante
     * @param array $datos array con los datos validados del $_POST(datos del formulario para crear el voto)
     * @return Votante devuelve un obj Votante
     */
    private function crearVotante($datos)
    {
        foreach ($datos as $key => $value) {
            $datos[$key] = Input::filtrarDato($value);
            if (is_array($value)) {
                $resultado = "";
                foreach ($value as $valor) {
                    $resultado .= "$valor - ";
                }
                $resultado = substr($resultado, 0, -3);
                $datos[$key] = $resultado;
            }
        }
        return new Votante($datos['dni'], $datos['generos'], $datos['cantantes']);
    }
}

<?php
class Votante
{
    private $dni;
    private $votosG;
    private $votosC;

    /**
     * constructor de la clase Votante
     */
    function __construct($queDni, $queVotosG, $queVotosC)
    {
        $this->dni = $queDni;
        $this->votosG = $queVotosG;
        $this->votosC = $queVotosC;
    }

    /**
     * Get the value of dni
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set the value of dni
     *
     * @return  self
     */
    public function setDni($dni)
    {
        $this->dni = $dni;

        return $this;
    }

    /**
     * Get the value of votosG
     */
    public function getVotosG()
    {
       return $this->votosG;
    }

    /**
     * Set the value of votosG
     *
     * @return  self
     */
    public function setVotosG($votosG)
    {
        $this->votosG = $votosG;

        return $this;
    }

    /**
     * Get the value of votosC
     */
    public function getVotosC()
    {
        return $this->votosC;
    }

    /**
     * Set the value of votosC
     *
     * @return  self
     */
    public function setVotosC($votosC)
    {
        $this->votosC = $votosC;

        return $this;
    }
}

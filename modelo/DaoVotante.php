<?php 
include "modelo/DataBase.php";
class DaoVotante{
    private $db;
    function __construct()
    {
        $this->db= new DataBase();
    } 
    /**
     * Comprueba si el dni del Votante existe en la DB
     */
    function existeVotante($dni){
       
        $this->db->conectarDb();
        $sql = "Select * from votantes where dni = :dni";
        $args = array(":dni" => $dni);

       
        $tempo = $this->db->ejecutarSql($sql, $args);
        if(is_string($tempo)){
            $this->db->desconectar();
            return $tempo;
        } else {
            if(count($tempo) > 0){
                $this->db->desconectar();
                return "Ya has hecho la votación, solo se permite una por persona.";
            } else {
                $this->db->desconectar();
                return false;
            }
        }
    }
    /**
     * Funcion que mediante un objeto de la clase votante,
     * lo introduce en la DB
     */
    function insertarVotante($votante){
        
        $this->db->conectarDb();
 
        $sql= 'INSERT INTO votantes(part_id, dni, Votos_Cantantes, Votos_Generos)  VALUES (NULL ,:dni, :votosC, :votosG)';

        $args = array(":dni" => $votante->getDni(), ":votosC" => $votante->getVotosC(), ":votosG" => $votante->getVotosG());

        $tempo = $this->db->ejecutarSql($sql, $args);
        if(is_string($tempo)){
            $this->db->desconectar();
            return $tempo;
        } else {
            if(count($tempo) > 0){
                $this->db->desconectar();
                return "La inserción no se ha podido producir correctamente.";
            } else {
                $this->db->desconectar();
                return "La inserción se ha realizado correctamente.";
            }
        }
    }
}

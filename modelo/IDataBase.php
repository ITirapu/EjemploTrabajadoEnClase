<?php 
/**
 * Una interfaz define el comportamiento de los metodos que implementa, es decir, sus metodos y los parametros de entrada.
*/
Interface IDataBase {

    public function conectarDb();

    public function desconectar();

    // no la usamos
   // public function ejecutarSql($sql, $args);
    
    public function ejecutarSql($sql, $args);
}
?>
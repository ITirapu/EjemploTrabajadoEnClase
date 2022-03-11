<?php
include "IDataBase.php";
include "config/config.php";
class DataBase implements IDataBase
{
    private $conexion;

    /**
     * Crea la conexión con la base de datos
     */
    public function conectarDb()
    {
        try {
            $this->conexion = new PDO("mysql:host=" . DB_SERVER . ";dbname=" .
                DB_NAME, DB_USER, DB_PASS);

            // Se puede configurar el objeto
            $this->conexion->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
            $this->conexion->exec("set names utf8mb4");
            return ($this->conexion);
        } catch (PDOException $e) {
            echo " <p>Error: " . $e->getMessage() . "</p>\n";
            exit();
            //OTRA Opción podría ser enviar a otra página
            header('Location: vistas/error.php?error=ERROR');
            exit();
        }
    }

    /**
     * se desconecta de la base de datos
     */
    public function desconectar()
    {
        $this->conexion = null;
    }

    // no la usamos
    /*public function ejecutarSql($sql)
    {
        try {
            $tempo = $this->conexion->query($sql);
            return $tempo;
        } catch (Exception $exception){
            return $exception->getMessage();
        }
    }*/

    public function ejecutarSql($sql, $args)
    {
        try {
            if(isset($this->conexion)){
                $tempo = $this->conexion->prepare($sql);
                if(!$tempo->execute($args)){
                    return "Ha ocurrido un problema con la consulta.";
                } else {
                    return $tempo->fetchAll();
                }
            } else {
                return "No se ha podido conectar con la base de datos.";
            }
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }
}

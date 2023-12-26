<?php

class Conexion{
    private $servidor = "localhost";
    private $usuario = "root";
    private $contrasenia = "";
    private $conexion;

    public function __construct(){
        try {
            $this->conexion = new PDO("mysql:host=$this->servidor;dbname=album", $this->usuario, $this->contrasenia);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            return "Falla de conexión: " . $e->getMessage(); //
        }
    }

    public function ejecutar($sql) {
        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            return $this->conexion->lastInsertId();
        } catch(PDOException $e) {
            return "Error en la ejecución de la consulta: " . $e->getMessage();
        }
    }
    

    public function consultar($sql){
        $sentencia=$this->conexion->prepare($sql);
        $sentencia->execute();
        return $sentencia->fetchAll();
    }
}

?>

<?php

class ComandoCiudadEstado
{

    private $SQL;
    private $sta;



    function __construct()
    {
    }


    public function listarEstados()
    {
        $result = null;
        
        try {

            try {
                $Conexion = Conexion::getInstance()->obtenerConexion();
                $this->SQL = "SELECT id,estado FROM Estados ORDER BY estado ASC";
                $this->sta = $Conexion->prepare($this->SQL);
                $this->sta->execute();
                $datos = $this->sta->fetchAll(PDO::FETCH_ASSOC);
                Conexion::getInstance()->cerrarConexion();



                return $datos;
            } catch (Exception $e) {
                Conexion::getInstance()->cerrarConexion();
                return $e->getMessage();
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        Conexion::getInstance()->cerrarConexion();
        return $result;
    }


    public function listarCiudadesXIdEstado($idEstado)
    {
        $result = null;
        try {

            try {
                $Conexion = Conexion::getInstance()->obtenerConexion();
                $this->SQL = "SELECT id,ciudad
                FROM Ciudades WHERE idEstado='$idEstado' ORDER BY Ciudad ASC";
                $this->sta = $Conexion->prepare($this->SQL);
                $this->sta->execute();
                $datos = $this->sta->fetchAll(PDO::FETCH_ASSOC);
                Conexion::getInstance()->cerrarConexion();



                return $datos;
            } catch (Exception $e) {
                Conexion::getInstance()->cerrarConexion();
                return $e->getMessage();
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        Conexion::getInstance()->cerrarConexion();
        return $result;
    }

    public function listarCiudadesXNombreEstado($estado)
    {
        $result = null;
        try {

            try {
                $Conexion = Conexion::getInstance()->obtenerConexion();
                $this->SQL = "SELECT c.ciudad,c.id FROM ciudades c
                INNER JOIN estados e ON c.idEstado=e.id 
                WHERE e.Estado='$estado' ORDER BY Ciudad ASC";
                $this->sta = $Conexion->prepare($this->SQL);
                $this->sta->execute();
               
                $datos = $this->sta->fetchAll(PDO::FETCH_ASSOC);
                Conexion::getInstance()->cerrarConexion();



                return $datos;
            } catch (Exception $e) {
                Conexion::getInstance()->cerrarConexion();
                return $e->getMessage();
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        Conexion::getInstance()->cerrarConexion();
        return $result;
    }   
}

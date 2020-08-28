<?php   

class ComandosConfiguracion
{
   
    private $SQL;
	private $sta;
     

    function __construct() {
       
    }


    public function listarUsuariosXNegocio($idNegocio) 
    {
        try 
        {
            try {
                $Conexion = Conexion::getInstance()->obtenerConexion();
                $this->SQL = "SELECT id,nombre,email FROM Usuarios ";
                $this->sta = $Conexion->prepare($this->SQL);
                $this->sta->execute();
                $datos = $this->sta->fetchAll(PDO::FETCH_ASSOC);
                Conexion::getInstance()->cerrarConexion();
                //var_dump($datos);
                return $datos;
            }catch (Exception $e){
                Conexion::getInstance()->cerrarConexion();
                return $e->getMessage();
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        Conexion::getInstance()->cerrarConexion();
        return $result;

    }

    public function EliminarUsuario($id) 
    {
        try 
        {
            try {
                $Conexion = Conexion::getInstance()->obtenerConexion();
                $this->SQL = "DELETE FROM usuarios WHERE id='$id'";
                $this->sta = $Conexion->prepare($this->SQL);
                $this->sta->execute();
                $datos = $this->sta->fetchAll(PDO::FETCH_ASSOC);
                Conexion::getInstance()->cerrarConexion();
                //var_dump($datos);
                return $datos;
            }catch (Exception $e){
                Conexion::getInstance()->cerrarConexion();
                return $e->getMessage();
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        Conexion::getInstance()->cerrarConexion();
        return $result;

    }


    public function ModificarUsuario($id,$nombre,$email) 
    {
        try 
        {
            try {
                $Conexion = Conexion::getInstance()->obtenerConexion();
                $this->SQL = "UPDATE usuarios SET nombre='$nombre', email='$email' WHERE id='$id'";
                $this->sta = $Conexion->prepare($this->SQL);
                $this->sta->execute();
                $datos = $this->sta->fetchAll(PDO::FETCH_ASSOC);
                Conexion::getInstance()->cerrarConexion();
                //var_dump($datos);
                return $datos;
            }catch (Exception $e){
                Conexion::getInstance()->cerrarConexion();
                return $e->getMessage();
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        Conexion::getInstance()->cerrarConexion();
        return $result;

    }

    public function IngresarUsuario($idNegocio,$nombre,$email) 
    {
        try 
        {
            try {
                $Conexion = Conexion::getInstance()->obtenerConexion();
                $this->SQL = "INSERT INTO usuarios(idNegocio,id,email,nombre,perfil) values('653fef81-36a0-4a27-a901-87f29936e8e2',NEWID(),'$email','$nombre','1');";
                $this->sta = $Conexion->prepare($this->SQL);
                $this->sta->execute();
                $datos = $this->sta->fetchAll(PDO::FETCH_ASSOC);
                Conexion::getInstance()->cerrarConexion();
                //var_dump($datos);
                return $datos;
            }catch (Exception $e){
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

?>
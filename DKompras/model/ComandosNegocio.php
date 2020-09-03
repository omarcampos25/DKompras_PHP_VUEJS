<?php   

class ComandoNegocio
{
    
    private $SQL;
    private $sta;
    
     

    function __construct() {
       
    }


    public function obtenerInfoNegocio() 
    {
        $result=null;
        try 
        {
            
            session_start();
            $empresa=$_SESSION['empresa'];
            
            try {
                $Conexion = Conexion::getInstance()->obtenerConexion();
                $this->SQL = "SELECT  negocio,email,direccion,ciudad,estado,telefono,licencia,logo
                                FROM negocios where id='$empresa'";
                $this->sta = $Conexion->prepare($this->SQL);
                $this->sta->execute();
                $datos = $this->sta->fetchAll(PDO::FETCH_ASSOC);
                Conexion::getInstance()->cerrarConexion();

               
                
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



    public function ModificarNegocio($nombreNegocio,$correoNegocio,$direccionNegocio,$ciudadNegocio,$estadoNegocio,$telefonoNegocio,$logo) 
    {
        try 
        {
            
            session_start();
            $empresa=$_SESSION['empresa'];
           
           
            try {
                $Conexion = Conexion::getInstance()->obtenerConexion();
                $this->SQL = "UPDATE negocios
                 SET Negocio='$nombreNegocio',
                 Email='$correoNegocio',
                 Direccion='$direccionNegocio',
                 Ciudad='$ciudadNegocio',
                 Estado='$estadoNegocio',
                 Telefono='$telefonoNegocio'
                 ,logo='$logo' WHERE id='$empresa'";
                $this->sta = $Conexion->prepare($this->SQL);
                $datos =$this->sta->execute();
                Conexion::getInstance()->cerrarConexion();
            
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

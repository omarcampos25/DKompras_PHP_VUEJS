<?php   

class ComandoSucursales
{
    
    private $SQL;
    private $sta;
    
     

    function __construct() {
       
    }


    public function listarSucursalesXNegocio() 
    {
        $result=null;
        try 
        {
            
            session_start();
            $empresa=$_SESSION['empresa'];
            
            try {
                $Conexion = Conexion::getInstance()->obtenerConexion();
                $this->SQL = "SELECT idSucursal,sucursal,
                direccion,ciudad,estado,telefono,
                email FROM sucursales WHERE idNegocio='$empresa'";
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


    public function listarFormasPagosXSucursal() 
    {
        $result=null;
        try 
        {
            
            session_start();
            $empresa=$_SESSION['empresa'];
           
            
            try {
                $Conexion = Conexion::getInstance()->obtenerConexion();
                $this->SQL = "SELECT fp.idFormaPago,fp.FormaPago,isnull(sp.idSucursal,0) AS sucursal
                FROM FormasPago fp	LEFT JOIN Sucursal_pago sp ON fp.idFormaPago=sp.idFormaPago
                WHERE fp.idNegocio='$empresa' ";
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
    

    public function listarFormasEntregasXSucursal() 
    {
        $result=null;
        try 
        {
            
            session_start();
            $empresa=$_SESSION['empresa'];
           
            try {
                $Conexion = Conexion::getInstance()->obtenerConexion();
                $this->SQL = "SELECT fe.idFormaEntrega,fe.FormaEntrega,isnull(se.idSucursal,0) as sucursal
                FROM FormasEntrega fe INNER JOIN Sucursal_entrega se on fe.idFormaEntrega=se.idFormaEntrega
                WHERE fe.idNegocio='$empresa'";
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

    public function InsertarSucursal() 
    {
        $result=null;
        try 
        {
            
            session_start();
            $empresa=$_SESSION['empresa'];
            $sucursal=$_SESSION['sucursal'];
            
            try {
                $Conexion = Conexion::getInstance()->obtenerConexion();
                $this->SQL = "SELECT fp.idFormaPago,fp.FormaPago
                FROM FormasPago fp INNER JOIN Sucursal_pago sp ON fp.idFormaPago=sp.idFormaPago
                INNER JOIN Sucursales s ON sp.idSucursal=s.idSucursal
                WHERE s.idSucursal='$sucursal' and s.idNegocio='$empresa'";
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
    
}

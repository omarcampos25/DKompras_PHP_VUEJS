<?php   

class ComandoFormaPago
{
    
    private $SQL;
    private $sta;
    
     

    function __construct() {
       
    }


    public function ListarFormasPagoXNegocio() 
    {
        $result=null;
        try 
        {
            
            session_start();
            $empresa=$_SESSION['empresa'];
            
            try {
                $Conexion = Conexion::getInstance()->obtenerConexion();
                $this->SQL = "SELECT fp.idFormaPago,fp.FormaPago
                FROM FormasPago fp INNER JOIN Sucursal_pago sp ON fp.idFormaPago=sp.idFormaPago
                INNER JOIN Sucursales s ON sp.idSucursal=s.idSucursal
                WHERE s.idNegocio='$empresa'";
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

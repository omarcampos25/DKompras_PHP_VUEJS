<?php   

class ComandoBuscarProducto
{
    
    private $SQL;
    private $sta;
    
     

    function __construct() {
       
    }


    public function ListarProductosPrincipales() 
    {
        $result=null;
        try 
        {
            
            try {
                $Conexion = Conexion::getInstance()->obtenerConexion();
                $this->SQL = " SELECT codigo,precio,imagen FROM productos";
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

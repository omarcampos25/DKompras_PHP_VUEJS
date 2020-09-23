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

    public function BuscarProductos($codigo){
        $result=null;
        try 
        {
            try {
                $Conexion = Conexion::getInstance()->obtenerConexion();
                $this->SQL = "SELECT p.codigo FROM productos p
                INNER JOIN familias f ON p.idFamilia=f.idFamilia
                WHERE  f.Familia like '%$codigo%' or f.Familia like '%$codigo%' 
                or p.Descripcion='%$codigo%'";
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

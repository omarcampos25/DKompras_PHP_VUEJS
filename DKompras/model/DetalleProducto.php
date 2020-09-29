<?php   

class DetalleProducto
{
    
    private $SQL;
    private $sta;
    
     

    function __construct() {
       
    }


    public function ConsultarDetalleProducto($idProducto) 
    {
        $result=null;
        try 
        {
            
            try {
                $Conexion = Conexion::getInstance()->obtenerConexion();
                $this->SQL = "SELECT p.codigo, p.descripcion, p.precio, p.precioDesc, p.imagen, n.logo,n.Negocio 
                FROM productos p INNER JOIN negocios n ON p.idNegocio=n.id  WHERE p.idProducto='$idProducto'";
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


    public function ConsultarImagenes($idProducto){
        $result=null;
        try 
        {
            
            try {
                $Conexion = Conexion::getInstance()->obtenerConexion();
                $this->SQL = "SELECT i.ruta FROM productos p
                INNER JOIN imagenes i ON p.idProducto=i.idProducto WHERE p.idProducto=$idProducto";
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
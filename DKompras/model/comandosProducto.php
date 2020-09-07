<?php   

class ComandoProducto
{
    /*
     * Metodo que devuelve un arreglo asociativo con las opciones del menu
     * para un usuario especificado por su cve
     */
    private $SQL;
	private $sta;
     

    function __construct() {
       
    }


    public function listarFamiliasNegocio() 
    {
        try 
        {
            try {
                $Conexion = Conexion::getInstance()->obtenerConexion();
                $this->SQL = "SELECT  Familia
                                FROM Familias";
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


    public function listarProductosXEmpresa() 
    {
        try 
        {
            try {
                session_start();
                $empresa=$_SESSION['empresa'];
                $Conexion = Conexion::getInstance()->obtenerConexion();
                $this->SQL = "SELECT  
                codigo AS producto,
                 descripcion,precio,
                  precioDesc AS descuento,
                   existencias AS cantidad,
                    imagen AS foto  FROM productos WHERE idNegocio='$empresa'";
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

    public function insertarProducto($codigo,$descripcion,$familia,$precio,$descuento,$foto,$cantidad) 
    {
        
        try 
        {
            try {
                session_start();
                $empresa=$_SESSION['empresa'];
                $Conexion = Conexion::getInstance()->obtenerConexion();
                $this->SQL = "INSERT INTO Productos
                (idNegocio,codigo,descripcion,
                familia,precio,precioDesc,imagen,existencias,Estatus)
                 VALUES ('$empresa',
                 '$codigo',
                 '$descripcion',
                 '520D05CC-9BBA-4285-BC43-DEA0F3AB4ABE',
                 '$precio',
                 '$descuento',
                 '$foto',
                 '$cantidad',1);";
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


    public function encodeBase64($foto){
        //se remplaza +/= por -_,
        $fotoEncode=strtr($foto,'-_,','+/=');
        return $fotoEncode;
    }

    public function decodeBase64($foto){
        //se remplaza +/= por -_,
        $fotoDecode=strtr($foto,'+/=','-_,');
        return $fotoDecode;
    }

    public function ListarFamiliasCrud($idNegocio) 
    {          
       try 
        {
            try {
                session_start();
                $empresa=$_SESSION['empresa'];
                $Conexion = Conexion::getInstance()->obtenerConexion();
                $this->SQL = "SELECT familia,foto,idFamilia FROM familias where idNegocio='$empresa'";
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

    public function InsertarFamilia($familia,$foto) 
    {          
       try 
        {
            try {
                session_start();
                $empresa=$_SESSION['empresa'];
                $Conexion = Conexion::getInstance()->obtenerConexion();
                $this->SQL = "INSERT INTO familias (idNegocio,familia,foto)
                VALUES ('$empresa','$familia','$foto')";
                $this->sta = $Conexion->prepare($this->SQL);
                $this->sta->execute();
                $datos = $this->sta->fetchAll(PDO::FETCH_ASSOC);
                echo($this->SQL);
                
                Conexion::getInstance()->cerrarConexion();
                //var_dump($datos);
                return $datos;
            }catch (Exception $e){
                Conexion::getInstance()->cerrarConexion();
                return $e->getMessage();
            }
        } catch (Exception $e) {
            echo "Error en la insercion: " . $e->getMessage();
        }
        Conexion::getInstance()->cerrarConexion();
        return $result;
    }
    

    public function EliminarFamilia($idFamilia) 
    {          
       try 
        {
            try {
                $Conexion = Conexion::getInstance()->obtenerConexion();
                $this->SQL = "DELETE familias WHERE idFamilia='$idFamilia'";
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
            echo "Error en la insercion: " . $e->getMessage();
        }
        Conexion::getInstance()->cerrarConexion();
        return $result;
    }
   
    public function ModificarFamilia($idFamilia,$familia,$foto) 
    {          
       try 
        {
            try {
                $Conexion = Conexion::getInstance()->obtenerConexion();
                $this->SQL = "UPDATE familias
                 SET familia='$familia', foto='$foto' WHERE idFamilia='$idFamilia'";
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
            echo "Error en la insercion: " . $e->getMessage();
        }
        Conexion::getInstance()->cerrarConexion();
        return $result;
    }
    


    
}




?>
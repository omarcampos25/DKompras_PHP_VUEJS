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
                session_start();
                $empresa=$_SESSION['empresa'];
                $Conexion = Conexion::getInstance()->obtenerConexion();
                $this->SQL = "SELECT  Familia,idFamilia
                                FROM Familias WHERE idNegocio='$empresa'";
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
                p.idProducto,p.codigo AS producto,
                 p.descripcion,p.precio,
                 p.precioDesc AS descuento,
                 p.existencias ,
                 p.imagen AS foto,f.Familia  FROM productos p INNER JOIN familias f on p.idFamilia=f.idFamilia WHERE p.idNegocio='$empresa'";
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
                idfamilia,precio,precioDesc,imagen,existencias,Estatus)
                 VALUES ('$empresa',
                 '$codigo',
                 '$descripcion',
                 '$familia',
                 '$precio',
                 '$descuento',
                 '$foto',
                 '$cantidad',1);";
                 echo($this->SQL);
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
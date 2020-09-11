<?php   

class ComandoSucursales
{
    
    private $SQL;
    private $sta;
    
     

    function __construct() {
       
    }


    public function ListarSucursalesXNegocio() 
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


    public function ListarFormasPagosXSucursal() 
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
    

    public function ListarFormasEntregasXSucursal() 
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

    public function InsertarNuevaSucursal($sucursal,$direccion,$ciudad,$estado,$telefono,$email,$formasPagos,$formasEntregas) 
    {
       
        $arrayEntregas=json_decode($formasEntregas,true);
        $arrayPagos=json_decode($formasPagos,true);
        
        //var_dump($arrayEntregas);
        //var_dump($arrayPagos);

        $result=null;
        $idSucursal="";
        try 
        {

            session_start();
            $empresa=$_SESSION['empresa'];
            
                        
            try {
                
                $Conexion = Conexion::getInstance()->obtenerConexion();
                $this->SQL = "INSERT INTO sucursales
                (sucursal,direccion,ciudad,estado,telefono,email,idNegocio)
                VALUES ('$sucursal','$direccion','$ciudad','$estado','$telefono','$email',$empresa)";
              
                $this->sta = $Conexion->prepare($this->SQL);
                $this->sta->execute();
              
               

                $Conexion = Conexion::getInstance()->obtenerConexion();
                $this->SQL = "SELECT MAX(idSucursal)  AS idSucursal from Sucursales";
               
                $this->sta = $Conexion->prepare($this->SQL);
                $this->sta->execute();
                $datos = $this->sta->fetchAll(PDO::FETCH_ASSOC);


                foreach ($datos as &$element) {
                   
                    $idSucursal=$element["idSucursal"];
                 
                }

                if (is_array($arrayPagos) || is_object($arrayPagos))
                {
                    foreach ($arrayPagos as &$element){
                        $idPago=$element['idFormaPago'];
                        $Conexion = Conexion::getInstance()->obtenerConexion();
                        $this->SQL = "INSERT INTO Sucursal_pago (idSucursal, idFormaPago) 
                        VALUES($idSucursal,$idPago)";
                        
                        $this->sta = $Conexion->prepare($this->SQL);
                        $this->sta->execute();
                       
                       
                    }
                }
                
               
                if (is_array($arrayEntregas) || is_object($arrayEntregas))
                {
                  
                    foreach ($arrayEntregas as &$element){
                        $idEntrega=$element['idFormaEntrega'];
                        $Conexion = Conexion::getInstance()->obtenerConexion();
                        $this->SQL = "INSERT INTO Sucursal_entrega(idSucursal,idFormaEntrega)
                        VALUES($idSucursal,$idEntrega)";
                    
                        $this->sta = $Conexion->prepare($this->SQL);
                        $this->sta->execute();
                        
                        
                    }

                }

                
               

               
                
                return true;
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


    public function  EliminarSucursal($sucursal){
        $result=null;
        try 
        {
            
            session_start();
            $empresa=$_SESSION['empresa'];
            
            try {

                $Conexion = Conexion::getInstance()->obtenerConexion();
                $this->SQL = "DELETE Sucursal_entrega WHERE idSucursal='$sucursal'";
                $this->sta = $Conexion->prepare($this->SQL);
                $this->sta->execute();
                Conexion::getInstance()->cerrarConexion();


                $Conexion = Conexion::getInstance()->obtenerConexion();
                $this->SQL = "DELETE Sucursal_pago WHERE idSucursal='$sucursal'";
                $this->sta = $Conexion->prepare($this->SQL);
                $this->sta->execute();
                Conexion::getInstance()->cerrarConexion();

                $Conexion = Conexion::getInstance()->obtenerConexion();
                $this->SQL = "DELETE FROM sucursales WHERE idSucursal='$sucursal'";
                $this->sta = $Conexion->prepare($this->SQL);
                $this->sta->execute();
                Conexion::getInstance()->cerrarConexion();

               
                
                return true;
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

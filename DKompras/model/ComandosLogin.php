<?php   
require_once '../../model/Conexion.php';
class ComandosLogin
{
    
   
    private $SQL;
	private $sta;
     

    function __construct() {
       
    }


    public function RegistrarEmpresa($nombreEmpresa,$direccion,$ciudad,$estado,$telefono,$licencia,$emailEmpresa) 
    {
        try 
        {
                 $uid= $_SESSION["uid"];
                /* Iniciar la transacción. */
                $Conexion = Conexion::getInstance()->obtenerConexion();
               

               // $obj->beginTransaction();
                

                /* Preprar y ejecutar la primera sentencia . */
                $this->SQL = "INSERT INTO
                negocios (negocio,email,direccion,ciudad,estado,telefono,licencia,idMembresia)
                 VALUES ('$nombreEmpresa','$emailEmpresa','$direccion','$ciudad','$estado','$telefono',GETDATE()+30,'22BB3AA7-DC25-4F74-AB9D-045B5fg93021')";
                $this->sta = $Conexion->prepare($this->SQL);
                $this->sta->execute();
                $idNegocio = $this->sta->fetchAll(PDO::FETCH_ASSOC);


              /*  $sql1 = "INSERT INTO
                 negocios (negocio,email,direccion,ciudad,estado,telefono,licencia,idMembresia)
                  VALUES ('?','?','?','?','?','?','?','22BB3AA7-DC25-4F74-AB9D-045B5fg93021')";
                $params1=array($nombreEmpresa,$emailEmpresa,$direccion,$ciudad,$estado,$telefono,$licencia);
                $stmt1=sqlsrv_query( $Conexion, $sql1, $params1 );*/

                /* Preparar y ejecutar la segunda sentencia.*/
                $this->SQL = "SELECT SCOPE_IDENTITY()";
                $this->sta = $Conexion->prepare($this->SQL);
                $this->sta->execute();
                $idNegocio = $this->sta->fetchAll(PDO::FETCH_ASSOC);

                /* Preparar y ejecutar la tercera sentencia. */
                $this->SQL = "UPDATE usuarios 
                SET idNegocio =  '$idNegocio' 
                WHERE id = '$uid'";
                $this->sta = $Conexion->prepare($this->SQL);
                $this->sta->execute();
                $idNegocio = $this->sta->fetchAll(PDO::FETCH_ASSOC);

                /*
                $sql2 = "UPDATE usuarios 
                SET idNegocio =  ? 
                WHERE id = ?";

                $params2 = array($idNegocio, $_SESSION["uid"]);
                $stmt2=sqlsrv_query( $Conexion, $sql2, $params2 );*/

/*
                if( $stmt1 && $stmt2 ) {
                    sqlsrv_commit( $Conexion );
                    $datos="true";
                } else {
                    sqlsrv_rollback( $Conexion );
                    $datos="false";
                }*/
                Conexion::getInstance()->cerrarConexion();
                return $datos;
            
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
       

    }

    public function RegistrarUsuario($email,$nombre){

        try {
            $Conexion = Conexion::getInstance()->obtenerConexion();
            $sql = "INSERT INTO usuarios (id,email,nombre,perfil)VALUES('?','?','?','1')";
            $params=array($_SESSION["uid"],$email,$nombre);
            $stmt=sqlsrv_query( $Conexion, $sql, $params );
            Conexion::getInstance()->cerrarConexion();
            return $stmt;
            
        } catch (Exception $e) {
            Conexion::getInstance()->cerrarConexion();
            return $e->getMessage();
            
        }
       
      
    }

    public function ObtenerEmpresa($uid) 
    {
        try 
        {
            try {
                $Conexion = Conexion::getInstance()->obtenerConexion();
                $this->SQL = "SELECT idNegocio
                              FROM usuarios
                              WHERE id='$uid'";
                $this->sta = $Conexion->prepare($this->SQL);
                $this->sta->execute();
                $datos = $this->sta->fetchAll(PDO::FETCH_ASSOC);
               
                foreach($datos as &$element){
                    $_session['empresa']=$element["idNegocio"];
                }

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

?>
<?php   

class ComandosLogin
{
   
    private $SQL;
	private $sta;
     

    function __construct() {
       
    }


    public function RegistrarEmpresa($nombreEmpresa,$direcion,$ciudad,$estado,$telefono,$licencia,$emailEmpresa) 
    {
        try 
        {
                /* Iniciar la transacción. */
                $Conexion = Conexion::getInstance()->obtenerConexion();
                if ( sqlsrv_begin_transaction( $Conexion ) === false ) {
                    die( print_r( sqlsrv_errors(), true ));
                }
               
                /* Preprar y ejecutar la primera sentencia . */
                $sql1 = "INSERT INTO
                 negocios (negocio,email,direccion,ciudad,estado,telefono,licencia,idMembresia)
                  VALUES ('?','?','?','?','?','?','?','22BB3AA7-DC25-4F74-AB9D-045B5fg93021')";
                $params1=array($nombreEmpresa,$emailEmpresa,$direccion,$ciudad,$estado,$telefono,$licencia);
                $stmt1=sqlsrv_query( $Conexion, $sql1, $params1 );

                /* Preparar y ejecutar la segunda sentencia.*/
                $this->SQL = "SELECT SCOPE_IDENTITY()";
                $this->sta = $Conexion->prepare($this->SQL);
                $this->sta->execute();
                $idNegocio = $this->sta->fetchAll(PDO::FETCH_ASSOC);

                /* Preparar y ejecutar la tercera sentencia. */
                $sql2 = "UPDATE usuarios 
                SET idNegocio =  ? 
                WHERE id = ?";

                $params2 = array($idNegocio, $_SESSION["uid"]);

                if( $stmt1 && $stmt2 ) {
                    sqlsrv_commit( $conn );
                    $datos="true";
                } else {
                    sqlsrv_rollback( $conn );
                    $datos="false";
                }
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


}

?>
<?php
/**
  * Descripcion         : Conexión a base de datos
  * Autor           : Angel Omar Martinez campos 
  * Version                     : 1.0 (Beta)
  * Fecha de creacion           : 30/07/2020, 00:00:00
  **/
class Conexion {
    //  variables para conexion SQL SERVIDOR
    private $conexion;

    private $SQLhost = 'sql5050.site4now.net';
    private $SQLDatabase = 'DB_A622AE_dekompras';
    private $SQLusername = 'DB_A622AE_dekompras_admin';
    private $SQLpass = 'Leon@0020';
    private static $instancia;
     
    /**
     * 
     * Crea la configuracion para la conexion a BD en PDO
     */
    //singletone para validar si ya existe el objeto conexion

    function __construct() {
        $this->conexion = NULL;
    }
    
        public static function  getInstance(){
        if(!self::$instancia instanceof self){
            self::$instancia = new self;
        }
        return self::$instancia;
    }
    
    public function obtenerConexion() 
    {
        $this->conexionSQL();
        if ($this->conexion === NULL) 
        {
            
           // echo("Conexion fallida");
        } else{
           // echo("Conexion exitosa");
        }
       
        return $this->conexion;
    }

    //realiza la conexion
    public function conexionSQL() 
    {
        try 
        { 
        //var_dump("sqlsrv:Server=$this->SQLhost;Database=$this->SQLDatabase", $this->SQLusername,$this->SQLpass);
            $this->conexion = new PDO("sqlsrv:Server=$this->SQLhost;Database=$this->SQLDatabase", $this->SQLusername,$this->SQLpass);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           
        } 
        catch (PDOException $e) 
        {
            echo 'Problema de conexión '.$e->getMessage();
            exit();
        }
    }
    
    public function cerrarConexion()
    {
        
    //@mssql_close($this->conexion);
        $this->conexion = NULL;
    }
}
?>
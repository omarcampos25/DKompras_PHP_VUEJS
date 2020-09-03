<?php

require_once '../../model/Conexion.php';
require_once '../../model/ComandosSucursales.php';


$obj=new ComandoSucursales();
$accion = clear_input(isset($_REQUEST['accion']) && $_REQUEST['accion'] != '' ? $_REQUEST['accion'] : '0');


switch ($accion) {

      case 1:  
        $result = $obj->listarSucursalesXNegocio();
        echo json_encode($result);
      break;

      

      default:
          echo json_encode(0);
      break;
  }

  function clear_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
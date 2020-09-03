<?php
//phpinfo();

require_once '../../model/Conexion.php';
require_once '../../model/ComandosNegocio.php';


$obj=new ComandoNegocio();


$accion = clear_input(isset($_REQUEST['accion']) && $_REQUEST['accion'] != '' ? $_REQUEST['accion'] : '0');
$idNegocio = clear_input(isset($_REQUEST['idNegocio']) && $_REQUEST['idNegocio'] != '' ? $_REQUEST['idNegocio'] : '0');
$nombreNegocio = clear_input(isset($_REQUEST['nombreNegocio']) && $_REQUEST['nombreNegocio'] != '' ? $_REQUEST['nombreNegocio'] : '0');
$correoNegocio = clear_input(isset($_REQUEST['correoNegocio']) && $_REQUEST['correoNegocio'] != '' ? $_REQUEST['correoNegocio'] : '0');
$direccionNegocio = clear_input(isset($_REQUEST['direccionNegocio']) && $_REQUEST['direccionNegocio'] != '' ? $_REQUEST['direccionNegocio'] : '0');
$ciudadNegocio = clear_input(isset($_REQUEST['ciudadNegocio']) && $_REQUEST['ciudadNegocio'] != '' ? $_REQUEST['ciudadNegocio'] : '0');
$estadoNegocio = clear_input(isset($_REQUEST['estadoNegocio']) && $_REQUEST['estadoNegocio'] != '' ? $_REQUEST['estadoNegocio'] : '0');
$telefonoNegocio = clear_input(isset($_REQUEST['telefonoNegocio']) && $_REQUEST['telefonoNegocio'] != '' ? $_REQUEST['telefonoNegocio'] : '0');
$logo = clear_input(isset($_REQUEST['logo']) && $_REQUEST['logo'] != '' ? $_REQUEST['logo'] : '0');


switch ($accion) {

      case 1:  
        $result = $obj->obtenerInfoNegocio();
        echo json_encode($result);
      break;

      case 2:  
        $result = $obj->ModificarNegocio($nombreNegocio,$correoNegocio,$direccionNegocio,$ciudadNegocio,$estadoNegocio,$telefonoNegocio,$logo);
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
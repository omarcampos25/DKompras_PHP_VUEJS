<?php
session_start();
require_once '../../model/Conexion.php';
require_once '../../model/ComandosConfiguracion.php';


$obj=new ComandosConfiguracion();
$accion = clear_input(isset($_REQUEST['accion']) && $_REQUEST['accion'] != '' ? $_REQUEST['accion'] : '0');
$nombre = clear_input(isset($_REQUEST['nombre']) && $_REQUEST['nombre'] != '' ? $_REQUEST['nombre'] : '0');
$email = clear_input(isset($_REQUEST['email']) && $_REQUEST['email'] != '' ? $_REQUEST['email'] : '0');
$id = clear_input(isset($_REQUEST['id']) && $_REQUEST['id'] != '' ? $_REQUEST['id'] : '0');
$idNegocio = clear_input(isset($_REQUEST['idNegocio']) && $_REQUEST['idNegocio'] != '' ? $_REQUEST['idNegocio'] : '0');


switch ($accion) {

      case 1:  
        $result = $obj->listarUsuariosXNegocio($idNegocio);
        echo json_encode($result);
      break;

      case 2:  
        $result = $obj->ModificarUsuario($id,$nombre,$email);
        echo json_encode($result);
      break;

      case 3:  
        $result = $obj->EliminarUsuario($id);
        echo json_encode($result);
      break;

      case 4:  
        $result = $obj->IngresarUsuario($idNegocio,$nombre,$email);
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
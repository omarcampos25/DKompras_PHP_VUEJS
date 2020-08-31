<?php


require_once '../../model/Conexion.php';
require_once '../../model/ComandosLogin.php';



$obj=new ComandosLogin();
$accion = clear_input(isset($_REQUEST['accion']) && $_REQUEST['accion'] != '' ? $_REQUEST['accion'] : '0');
$url = clear_input(isset($_REQUEST['url']) && $_REQUEST['url'] != '' ? $_REQUEST['url'] : '0');
$negocio = clear_input(isset($_REQUEST['negocio']) && $_REQUEST['negocio'] != '' ? $_REQUEST['negocio'] : '0');

$nombreEmpresa = clear_input(isset($_REQUEST['nombreEmpresa']) && $_REQUEST['nombreEmpresa'] != '' ? $_REQUEST['nombreEmpresa'] : '0');
$direccion = clear_input(isset($_REQUEST['direccion']) && $_REQUEST['direccion'] != '' ? $_REQUEST['direccion'] : '0');
$ciudad = clear_input(isset($_REQUEST['ciudad']) && $_REQUEST['ciudad'] != '' ? $_REQUEST['ciudad'] : '0');
$estado = clear_input(isset($_REQUEST['estado']) && $_REQUEST['estado'] != '' ? $_REQUEST['estado'] : '0');
$telefono = clear_input(isset($_REQUEST['telefono']) && $_REQUEST['telefono'] != '' ? $_REQUEST['telefono'] : '0');
$licencia = clear_input(isset($_REQUEST['licencia']) && $_REQUEST['licencia'] != '' ? $_REQUEST['licencia'] : '0');
$emailEmpresa = clear_input(isset($_REQUEST['emailEmpresa']) && $_REQUEST['emailEmpresa'] != '' ? $_REQUEST['emailEmpresa'] : '0');

$uid = clear_input(isset($_REQUEST['uid']) && $_REQUEST['uid'] != '' ? $_REQUEST['uid'] : '0');
$email = clear_input(isset($_REQUEST['email']) && $_REQUEST['email'] != '' ? $_REQUEST['email'] : '0');
$nombre = clear_input(isset($_REQUEST['nombre']) && $_REQUEST['nombre'] != '' ? $_REQUEST['nombre'] : '0');

session_start();
$_SESSION["uid"] = $uid;

switch ($accion) {
    case 1: // Opcion para devolver la pagina a mostrar
         echo json_encode(file_get_contents($url));              
    break;

    case 2:
          $result = $obj->RegistrarEmpresa($nombreEmpresa,$direcion,$ciudad,$estado,$telefono,$licencia,$emailEmpresa);
          echo json_encode($result);
    break;

    case 2:
      $result = $obj->RegistrarUsuario($email,$nombre);
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
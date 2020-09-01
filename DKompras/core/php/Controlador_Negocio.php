<?php
//phpinfo();
session_start();
require_once '../../model/Conexion.php';
require_once '../../model/ComandosNegocio.php';


$obj=new ComandoNegocio();

$accion = clear_input(isset($_REQUEST['accion']) && $_REQUEST['accion'] != '' ? $_REQUEST['accion'] : '0');
/*
$idNegocio = clear_input(isset($_REQUEST['idNegocio']) && $_REQUEST['idNegocio'] != '' ? $_REQUEST['idNegocio'] : '0');
$nombreNegocio = clear_input(isset($_REQUEST['codigo']) && $_REQUEST['codigo'] != '' ? $_REQUEST['codigo'] : '0');
$correoNegocio = clear_input(isset($_REQUEST['descripcion']) && $_REQUEST['descripcion'] != '' ? $_REQUEST['descripcion'] : '0');
$direccionNegocio = clear_input(isset($_REQUEST['familia']) && $_REQUEST['familia'] != '' ? $_REQUEST['familia'] : '0');
$ciudadNegocio = clear_input(isset($_REQUEST['precio']) && $_REQUEST['precio'] != '' ? $_REQUEST['precio'] : '0');
$estadoNegocio = clear_input(isset($_REQUEST['descuento']) && $_REQUEST['descuento'] != '' ? $_REQUEST['descuento'] : '0');
$telefonoNegocio = clear_input(isset($_REQUEST['foto']) && $_REQUEST['foto'] != '' ? $_REQUEST['foto'] : '0');
*/

switch ($accion) {

      case 1:  //listado de familias para los combos
        $result = $obj->obtenerInfoNegocio();
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
<?php

require_once '../../model/Conexion.php';
require_once '../../model/BuscarProducto.php';


$obj = new ComandoBuscarProducto();
$accion = clear_input(isset($_REQUEST['accion']) && $_REQUEST['accion'] != '' ? $_REQUEST['accion'] : '0');

switch ($accion) {

  case 1:
    $result = $obj->ListarProductosPrincipales();
    echo json_encode($result);
    break;

  default:
    echo json_encode(0);
    break;
}

function clear_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

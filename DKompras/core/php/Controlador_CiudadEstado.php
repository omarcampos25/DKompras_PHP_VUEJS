<?php

require_once '../../model/Conexion.php';
require_once '../../model/ComandosCiudadEstado.php';


$obj = new ComandoCiudadEstado();
$accion = clear_input(isset($_REQUEST['accion']) && $_REQUEST['accion'] != '' ? $_REQUEST['accion'] : '0');
$idEstado = clear_input(isset($_REQUEST['idEstado']) && $_REQUEST['idEstado'] != '' ? $_REQUEST['idEstado'] : '0');
$estado = clear_input(isset($_REQUEST['estado']) && $_REQUEST['estado'] != '' ? $_REQUEST['estado'] : '0');

switch ($accion) {

  case 1:
    $result = $obj->listarEstados();
    echo json_encode($result);
    break;

  case 2:
    $result = $obj->listarCiudadesXIdEstado($idEstado);
    echo json_encode($result);
    break;

  case 3:
    $result = $obj->listarCiudadesXNombreEstado($estado);
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

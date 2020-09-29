<?php


require_once '../../model/Conexion.php';
require_once '../../model/DetalleProducto.php';


$obj = new DetalleProducto();

$accion = clear_input(isset($_REQUEST['accion']) && $_REQUEST['accion'] != '' ? $_REQUEST['accion'] : '0');
$idProducto = clear_input(isset($_REQUEST['idProducto']) && $_REQUEST['idProducto'] != '' ? $_REQUEST['idProducto'] : '0');



switch ($accion) {

      case 1:
            $result = $obj->ConsultarDetalleProducto($idProducto);
            echo json_encode($result);
      break;

      case 2:
            $result=$obj->ConsultarImagenes($idProducto);
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

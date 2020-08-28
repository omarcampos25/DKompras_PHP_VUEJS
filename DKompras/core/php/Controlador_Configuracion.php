<?php
//phpinfo();
session_start();
require_once '../../model/Conexion.php';
require_once '../../model/ComandosProducto.php';


$obj=new ComandoProducto();
$accion = clear_input(isset($_REQUEST['accion']) && $_REQUEST['accion'] != '' ? $_REQUEST['accion'] : '0');
$idNegocio = clear_input(isset($_REQUEST['idNegocio']) && $_REQUEST['idNegocio'] != '' ? $_REQUEST['idNegocio'] : '0');
$codigo = clear_input(isset($_REQUEST['codigo']) && $_REQUEST['codigo'] != '' ? $_REQUEST['codigo'] : '0');
$descripcion = clear_input(isset($_REQUEST['descripcion']) && $_REQUEST['descripcion'] != '' ? $_REQUEST['descripcion'] : '0');


switch ($accion) {

      case 1:  //listado de familias para los combos
        $result = $obj->listarUsuariosNegocio($idNegocio);
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
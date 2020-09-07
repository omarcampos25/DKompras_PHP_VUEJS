<?php
//phpinfo();
require_once '../../model/Conexion.php';
require_once '../../model/ComandosFormaEntrega.php';


$obj=new ComandoFormaEntrega();
$accion = clear_input(isset($_REQUEST['accion']) && $_REQUEST['accion'] != '' ? $_REQUEST['accion'] : '0');

switch ($accion) {

      case 1:  //listado de familias para los combos
        $result = $obj->ListarFormasEntregaXNegocio();
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
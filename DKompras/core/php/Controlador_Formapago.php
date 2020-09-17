<?php
//phpinfo();
require_once '../../model/Conexion.php';
require_once '../../model/ComandosFormaPago.php';


$obj=new ComandoFormaPago();
$accion = clear_input(isset($_REQUEST['accion']) && $_REQUEST['accion'] != '' ? $_REQUEST['accion'] : '0');
$formaPago=clear_input(isset($_REQUEST['formaPago']) && $_REQUEST['formaPago'] !='' ? $_REQUEST['formaPago'] : '0');
$comision=clear_input(isset($_REQUEST['comision']) && $_REQUEST['comision'] !='' ? $_REQUEST['comision'] : '0');

switch ($accion) {

    case 1:  //listado de familias para los combos
      $result = $obj->ListarFormasPagoXNegocio();
      echo json_encode($result);
    break;
      

    case 2: 
      $result = $obj->RegistrarFormaPagoXNegocio($formaPago,$comision);
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
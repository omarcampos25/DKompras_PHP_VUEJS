<?php

require_once '../../model/Conexion.php';
require_once '../../model/ComandosSucursales.php';


$obj=new ComandoSucursales();
$accion = clear_input(isset($_REQUEST['accion']) && $_REQUEST['accion'] != '' ? $_REQUEST['accion'] : '0');
$SelectSucursal = clear_input(isset($_REQUEST['SelectSucursal']) && $_REQUEST['SelectSucursal'] != '' ? $_REQUEST['SelectSucursal'] : '0');

$sucursal = clear_input(isset($_REQUEST['sucursal']) && $_REQUEST['sucursal'] != '' ? $_REQUEST['sucursal'] : '0');
$direccion = clear_input(isset($_REQUEST['direccion']) && $_REQUEST['direccion'] != '' ? $_REQUEST['direccion'] : '0');
$ciudad = clear_input(isset($_REQUEST['ciudad']) && $_REQUEST['ciudad'] != '' ? $_REQUEST['ciudad'] : '0');
$estado = clear_input(isset($_REQUEST['estado']) && $_REQUEST['estado'] != '' ? $_REQUEST['estado'] : '0');
$telefono = clear_input(isset($_REQUEST['telefono']) && $_REQUEST['telefono'] != '' ? $_REQUEST['telefono'] : '0');
$email = clear_input(isset($_REQUEST['email']) && $_REQUEST['email'] != '' ? $_REQUEST['email'] : '0');
$formasPagos = (isset($_REQUEST['formasPagos']) && $_REQUEST['formasPagos'] != '' ? $_REQUEST['formasPagos'] : '0');
$formasEntregas = (isset($_REQUEST['formasEntregas']) && $_REQUEST['formasEntregas'] != '' ? $_REQUEST['formasEntregas'] : '0');

$idSucursal = clear_input(isset($_REQUEST['idSucursal']) && $_REQUEST['idSucursal'] != '' ? $_REQUEST['idSucursal'] : '0');



/*echo($formasEntregas);


echo($ciudad);


echo($estado);*/

switch ($accion) {

      case 1:  
        $result = $obj->listarSucursalesXNegocio();
        echo json_encode($result);
      break;
      
      case 2:  
        $result = $obj->listarFormasPagosXSucursal();
        echo json_encode($result);
      break;
      
      case 3:  
        $result = $obj->listarFormasEntregasXSucursal();
        echo json_encode($result);
      break;

      case 4:  
        $result = $obj->InsertarNuevaSucursal($sucursal,$direccion,$ciudad,$estado,$telefono,$email,$formasPagos,$formasEntregas);
        echo json_encode($result);
      break;

      case 5:  
        $result = $obj->EliminarSucursal($sucursal);
        echo json_encode($result);
      break;

      case 6:  
        $result = $obj->ModificarSucursal($idSucursal,$sucursal,$direccion,$ciudad,$estado,$telefono,$email,$formasPagos,$formasEntregas);
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
<?php
//phpinfo();
require_once '../../model/Conexion.php';
require_once '../../model/ComandosProducto.php';


$obj=new ComandoProducto();
$accion = clear_input(isset($_REQUEST['accion']) && $_REQUEST['accion'] != '' ? $_REQUEST['accion'] : '0');
$idNegocio = clear_input(isset($_REQUEST['idNegocio']) && $_REQUEST['idNegocio'] != '' ? $_REQUEST['idNegocio'] : '0');
$codigo = clear_input(isset($_REQUEST['codigo']) && $_REQUEST['codigo'] != '' ? $_REQUEST['codigo'] : '0');
$descripcion = clear_input(isset($_REQUEST['descripcion']) && $_REQUEST['descripcion'] != '' ? $_REQUEST['descripcion'] : '0');
$familia = clear_input(isset($_REQUEST['familia']) && $_REQUEST['familia'] != '' ? $_REQUEST['familia'] : '0');
$precio = clear_input(isset($_REQUEST['precio']) && $_REQUEST['precio'] != '' ? $_REQUEST['precio'] : '0');
$descuento = clear_input(isset($_REQUEST['descuento']) && $_REQUEST['descuento'] != '' ? $_REQUEST['descuento'] : '0');
$foto = clear_input(isset($_REQUEST['foto']) && $_REQUEST['foto'] != '' ? $_REQUEST['foto'] : '0');
$cantidad = clear_input(isset($_REQUEST['cantidad']) && $_REQUEST['cantidad'] != '' ? $_REQUEST['cantidad'] : '0');
$idFamilia = clear_input(isset($_REQUEST['idFamilia']) && $_REQUEST['idFamilia'] != '' ? $_REQUEST['idFamilia'] : '0');

switch ($accion) {

      case 1:  //listado de familias para los combos
        $result = $obj->listarFamiliasNegocio($idNegocio);
        echo json_encode($result);
      break;

      case 2:
        $result = $obj->listarProductosXEmpresa();
        echo json_encode($result);
      break;

      case 3:
        $result = $obj->insertarProducto($idNegocio,$codigo,$descripcion,$familia,$precio,$descuento,$foto,$cantidad);
        echo json_encode($result);
      break;

      case 4:
        $result = $obj->ListarFamiliasCrud($idNegocio);
        echo json_encode($result);
      break;

      case 5:
        $result = $obj-> InsertarFamilia($familia,$foto);
        echo json_encode($result);
      break;

      case 6:
        $result = $obj-> EliminarFamilia($idFamilia);
        echo json_encode($result);
      break;

      case 7:
        $result = $obj-> ModificarFamilia($idFamilia,$familia,$foto);
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
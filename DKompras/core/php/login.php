<?php

session_start();
$accion = clear_input(isset($_REQUEST['accion']) && $_REQUEST['accion'] != '' ? $_REQUEST['accion'] : '0');
$url = clear_input(isset($_REQUEST['url']) && $_REQUEST['url'] != '' ? $_REQUEST['url'] : '0');

switch ($accion) {
    case 1: // Opcion para devolver la pagina a mostrar
         echo json_encode(file_get_contents($url));              
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
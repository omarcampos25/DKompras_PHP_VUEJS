<?php
//phpinfo();
require_once '../../model/Conexion.php';
require_once '../../model/ComandosFormaPago.php';


$obj=new ComandoFormaPago();
$imagen = clear_input(isset($_REQUEST['imagen']) && $_REQUEST['imagen'] != '' ? $_REQUEST['imagen'] : '0');

$imagen = json_decode($imagen, true);
print_r($imagen);
$nombre=$imagen['archivo']['name'];
$guardado=$imagen['archivo']['tmp_name'];
echo($nombre);


if(!file_exists('archivos')){
  echo('si existe');
  mkdir('archivos',0777,true);
  if(file_exists('archivos')){
    if(move_uploaded_file($guardado,'archivos/'.$nombre)){
      echo("archivo guardado");
    }else{
      echo("archivo no se pudo guardar");
    }
  }
}else{
  if(move_uploaded_file($guardado,'archivos/'.$nombre)){
    echo("archivo guardado");
  }else{
    echo("archivo no se pudo guardar 32");
  }
}

function clear_input($data) {

    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    
}
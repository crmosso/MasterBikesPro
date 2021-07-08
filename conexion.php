<?php
include("configuracion.php");
//Create instance sql
$conexion =  new mysqli($server,$user,$pass,$bd);
if(mysqli_connect_errno()){
  echo "No conectado", mysqli_connect_errno();
  exit();
}else{
  //echo 'Conectado';
}

?>

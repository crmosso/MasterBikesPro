<?php

//Conexión php y validar sesión 
include("conexion.php");  
session_start();

if(!isset($_SESSION['id_usuario'])){
    
    header("Location: login.php");
  }
  $iduser = $_SESSION['id_usuario'];
  $sql = "SELECT idusuarios, NombreC,rol FROM usuarios WHERE
  idusuarios = '$iduser'";
  $resultado = $conexion->query($sql);
  $row = $resultado->fetch_assoc();

  //Listar productos

$sqllistar = "SELECT * FROM productos";
$resultadoListar = $conexion->query($sqllistar);
?>

<!doctype html>
<html lang="es">
  <head>
  <title>Listar productos</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet" >
    
  
 
   
       <link rel="stylesheet" href="assets/css/stylediseño.css">
     
     <!-- bootstrap & fontawesome -->
         <link rel="stylesheet" href="assets/csscopy/bootstrap.min.css" />
     <link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />
 
     <!-- text fonts -->
     <link rel="stylesheet" href="assets/csscopy/fonts.googleapis.com.css" />
 
     <!-- ace styles -->
     <link rel="stylesheet" href="assets/csscopy/ace.min.css" />
 
     <!--[if lte IE 9]>
       <link rel="stylesheet" href="assets/css/ace-part2.min.css" />
     <![endif]-->
     <link rel="stylesheet" href="assets/csscopy/ace-rtl.min.css" />  </head>
     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">


  </head>
<BODY style=" 
  background-image: url('https://www.jasminsoftware.es/wp-content/uploads/2020/05/gestion-de-stock.jpg') ;
   min-height: 100%;
 
   background-size: cover;
   background-repeat: no-repeat;
   background-position: center center;
   ">
<?php require 'partials/header.php'?> 
<br>
<div class="container"> 
<div class="jumbotron ">
<h1 class="text-center  " style="background-color:goldenrod"><strong>STOCK</strong></h1>

<table id="datatable" class="table table-striped table-bordered table-danger " >
  <thead class="table-dark">
  <tr> <th>Codigo</th> <th>Nombre</th> <th>Tipo</th> <th>Marca</th> <th>Descripción</th> <th>Cantidad</th> <th>Precio</th> <th>Actualizar</th>
  <th>Eliminar</th></tr>
  </thead>
  <tbody>
  <?php
if($resultadoListar) {
	while( $productos = mysqli_fetch_array($resultadoListar) ){
	?>
		  <tr><td><?php echo $productos['codigo'] ?></td>
			  <td><?php echo $productos['nombre'] ?></td>
			  <td><?php echo $productos['tipoProducto'] ?></td>
        <td><?php echo $productos['marca'] ?></td>
        <td><?php echo $productos['descripcion'] ?></td>
        <td><?php echo $productos['cantidad'] ?></td>
        <td><?php echo $productos['precio'] ?></td>

        <td><a class="btn btn-warning" href="actualizar.php?codigo=<?php echo $productos['codigo']?>&nombre=<?php echo $productos['nombre']?>&descripcion=<?php echo $productos['descripcion'] ?>&cantidad=<?php echo $productos['cantidad']?>&precio=<?php echo $productos['precio']?>">Actualizar</a></td>
			  <td><a class="btn btn-danger"  href="eliminar_producto.php?codigo=<?php echo $productos['codigo'] ?>&cantidad=<?php echo $productos['cantidad']?>">Eliminar</a></td>
		  </tr>
	<?php
	}
}
?> 
  </tbody>
</table>

  <a href="index.php" class="btn btn-danger">Regresar a la pagina de inicio</a>
  <a href="form_producto_bootstra.php" class="btn btn-info">Registrar producto</a>


</div> <!-- jumbotron -->
</div> <!-- container -->

  <!--SCRIPTS-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
       <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
      <script src="assets/js/validaciones.js"></script>
       <script src="https://use.fontawesome.com/a208faf5e5.js"></script>
       <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
  </body>
<script>
$(document).ready( function () {
    $('#datatable').DataTable();
} );
 </script>
</html>





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

  if(isset($_POST["registrar"])){
    // Función myaqli_real_escape_string permite que el usuario no pueda enviar inyyeción sql 
    //por medio del formulario.
    $nombre = mysqli_real_escape_string($conexion,$_POST['name']);
    $tipo = mysqli_real_escape_string($conexion,$_POST['select']);
    $marca = mysqli_real_escape_string($conexion,$_POST['marca']);
    $descripcion = mysqli_real_escape_string($conexion,$_POST['descripcion']);
    $cantidad = 1;
    $precio = mysqli_real_escape_string($conexion,$_POST['precio']);
   

    $sqlproduct = "SELECT codigo FROM productos WHERE nombre = '$nombre'"; 

    $resultaproduct = $conexion->query($sqlproduct);
    $filas= $resultaproduct->num_rows;
    if($filas > 0){

      echo "<script>
              alert('¡Producto ya existente, para modificar cantidad actualize en visualizar stock!');
              window.location = 'listar_productos.php';
              </script>";
     }else{
      //insertar nuevo producto
      $sqlproduct = "INSERT INTO productos(
         nombre,tipoProducto,marca,descripcion,precio,cantidad) VALUES('$nombre','$tipo','$marca','$descripcion','$precio','$cantidad')";
      $resultadoproduct = $conexion->query($sqlproduct);
      if($resultadoproduct > 0){
   echo "<script>
   alert('¡Nuevo producto agregado!')
   window.location = 'listar_productos.php';
   </script>";
    }
  }
}


?>
<!doctype html>

<html lang="en">
  <head>
  
    <title>Insertar productos</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet" >
    
    <!--SCRIPTS-->
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
       <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
      <script src="assets/js/validaciones.js"></script>
       <script src="https://use.fontawesome.com/a208faf5e5.js"></script>
 
   
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

  <body  >
  <?php require 'partials/header.php'?> 

 
  <div class="container ">
    <div class="row">
        <div class="col-md-12">
            <div class="well well-sm">
                <form class="form-horizontal <?php $_SERVER["PHP_SELF"]; ?>"  method="post">
                    <fieldset>
                        <legend class="text-center header">Registro de Productos</legend>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-pencil  bigicon"></i></span>
                            <div class="col-md-8">
                                <input id="pname" name="name" type="text" placeholder="Nombre de producto" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group" required> 
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-tags bigicon"></i></span>
                            <div class="col-md-8">
                            <select name="select">
                                  <option id="tproduct" name="tipo" type="text" placeholder="Tipo de producto" class="form-control" selected> Bicicleta </option>
                                  <option id="tproduct" name="tipo" type="text" placeholder="Tipo de producto" class="form-control" selected>Accesorio</option>
                                  <option id="tproduct" name="tipo" type="text" placeholder="Tipo de producto" class="form-control" selected>Repuesto</option>
                            </select>
                            </div>
                        </div>

                        
 

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-barcode bigicon"></i></span>
                            <div class="col-md-8">
                                <input id="tmarcas" name="marca" type="text" placeholder="Marca" class="form-control" required>
                            </div>
                        </div>

           
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-usd bigicon"></i></span>
                            <div class="col-md-8">
                                <input class="form-control" type="number" id="price" name="precio" placeholder="$Precio"  required> </textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-pencil-square-o bigicon"></i></span>
                            <div class="col-md-8">
                                <textarea class="form-control" id="decription" name="descripcion" placeholder="Descripción de producto" rows="7" require>Descripción... </textarea>
                            </div>
                        </div>

                       

                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary btn-lg" name="registrar">Registrar producto</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
  <style>
    .header {
    color: #36A0FF;
    font-size: 27px;
    padding: 10px;
}


.form-horizontal{
  background-color: #393838;
}

.bigicon {
    font-size: 35px;
    color: #36A0FF;
}

body{

  background-image: url('  https://wallery.app/dufovot/bike-in-the-sunset-wallpaper.webp') ;
   min-height: 100%;
 
   background-size: cover;
   background-repeat: no-repeat;
   background-position: center center;

}
  </style>
  </body>
</html>
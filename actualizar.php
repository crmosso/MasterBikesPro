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



     // recibiendo las variables desde listar_clientes
     $codigo      = $_REQUEST['codigo'];
     $nombre     = $_REQUEST['nombre'];
     $descripcion   = $_REQUEST['descripcion'];
     $cantidad      = $_REQUEST['cantidad'];
     $precio        = $_REQUEST['precio'];
     //Actualizar
     if(isset($_POST["actualizar"])){
      //por medio del formulario.
      $cantidadU = mysqli_real_escape_string($conexion,$_POST['cantidad']);
      $descripcionU = mysqli_real_escape_string($conexion,$_POST['descripcion']);
      $precioU = mysqli_real_escape_string($conexion,$_POST['precio']);
  
      $sqlproduct = "SELECT codigo FROM productos WHERE codigo = '$codigo'"; 
  
      $resultaproduct = $conexion->query($sqlproduct);
      $filas= $resultaproduct->num_rows;
      if($filas > 0){
       $sqlUp = "UPDATE productos SET cantidad = '$cantidadU', descripcion = '$descripcionU', precio = '$precioU' WHERE codigo = $codigo ";
       $resultadoUp = $conexion->query($sqlUp);

        echo "<script>
                alert('¡Producto Actualizado !');
                window.location = 'listar_productos.php';
                </script>";
       }else{
     echo "<script>
     alert('¡Producto no existe!')
     window.location = 'listar_productos.php';
     </script>";
      }
    }
  
?>

<!doctype html>
<html lang="es">
  <head>
    <title>MODIFICAR REGISTRO</title>
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
     <link rel="stylesheet" href="assets/csscopy/ace-rtl.min.css" />  
     <script src="https://use.fontawesome.com/a208faf5e5.js"></script></head>
  </head>
  <body

  style=" 
  background-image: url('https://images2.alphacoders.com/900/thumb-1920-900581.jpg') ;
   min-height: 100%;
 
   background-size: cover;
   background-repeat: no-repeat;
   background-position: center center;
   "
  >  
  <?php require 'partials/header.php'?> 


<br>
 <br>
 <br>
<br>

 
<div class="container ">
    <div class="row">
        <div class="col-md-12">
            <div class="well well-sm">
                <form class="form-horizontal  <?php $_SERVER["PHP_SELF"]; ?>"  method="post">
                    <fieldset>
                        <legend class="text-center header"> <strong>Actualizar Producto</strong></legend>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-asterisk  bigicon"></i></span>
                            <div class="col-md-8">
                                <input id="pcodigo" name="codigo" type="text" value="<?php echo $codigo ?>" placeholder="Codigo (Solo lectura)" class="form-control" readonly required>
                            </div>
                        </div>


                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-font  bigicon"></i></span>
                            <div class="col-md-8">
                                <input id="pname" name="name" type="text" value="<?php echo $nombre ?>"placeholder="Nombre de producto (Solo lectura)" class="form-control" readonly required>
                            </div>
                        </div>

                        
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-calculator bigicon"></i></span>
                            <div class="col-md-8">
                                <input class="form-control" type="number" value="<?php echo $cantidad ?>"id="cantidad" name="cantidad" placeholder="cantidad"  required> </textarea>
                            </div>
                        </div>

           
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-usd bigicon"></i></span>
                            <div class="col-md-8">
                                <input class="form-control" type="number" value="<?php echo $precio ?>"id="price" name="precio" placeholder="$Precio "  required> </textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-pencil-square-o bigicon"></i></span>
                            <div class="col-md-8">
                                <textarea class="form-control" type="text" id="decription" name="descripcion" placeholder="<?php echo $descripcion ?>" rows="7" required><?php echo $descripcion ?></textarea>
                            </div>
                        </div>

                       

                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-success btn-lg" name="actualizar">Actualizar producto</button>
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
    color: #EEF45C;
    font-size: 27px;
    padding: 10px;
}


.form-horizontal{
  background-color: #062D51;
}

.bigicon {
    font-size: 35px;
    color:#EEF45C ;
}


  </style>

  </body>
</html>
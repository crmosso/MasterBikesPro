
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
// Attempt to read property "num_rows" on bool in D:\xamp\htdocs\MasterBikes\eliminar_producto.php on line 22
      // recibiendo las variables desde listar_productos.php
      
      $cantidad = $_REQUEST['cantidad'];
      $codigo  = $_REQUEST['codigo'];
      if(isset($_POST["actualizar"])){

      $aeliminar = mysqli_real_escape_string($conexion,$_POST['cant_eliminar']);
        
        if ($cantidad == $aeliminar) {
          $sqleliminar = "DELETE FROM productos WHERE codigo =  '$codigo'  AND cantidad = '$aeliminar'";
          $resultadoEliminar = $conexion->query($sqleliminar);
        echo "<script>
				alert('¡El producto ha sido eliminado!');
				window.location = 'listar_productos.php';
			</script>";
			exit();
        
      } else {
        $sqleliminar = "UPDATE productos SET cantidad = cantidad-$aeliminar WHERE codigo = '$codigo' AND cantidad > 1";
       $resultadoEliminar = $conexion->query($sqleliminar);
      echo "<script>
      alert('¡Producto eliminado aun queda producto en stock  !')
      window.location = 'listar_productos.php';
      </script>";
      exit();
      
         
  }
}
?>


<!doctype html>
<html lang="es">
  <head>
    <title>ELIMINAR REGISTRO</title>
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
                        <legend class="text-center header"> <strong>Eliminar Producto</strong></legend>
                        <h4>Ingrese cantidad de productos a eliminar</h4>
                        <h4>Cantidad Actual: <?php echo $cantidad ?> </h4>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-trash bigicon"></i></span>
                            <div class="col-md-8">
                                <input class="form-control" type="number" value="<?php echo $cantidad ?>"id="cant" name="cant_eliminar" placeholder="Ingrese cantidad de productos a eliminar"  required> </textarea>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-danger btn-lg" name="actualizar">Eliminar </button>
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
    color:white;
    font-size: 27px;
    padding: 10px;
}

h4{
  color:white;
  text-align: center;
}

.form-horizontal{
  background-color:darkred;
}

.bigicon {
    font-size: 35px;
    color:white;
}


  </style>

  </body>
</html>
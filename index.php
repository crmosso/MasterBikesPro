
<?php
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

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <title>Index Masterbikes</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet" >
    
   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
  <link rel="stylesheet" href="assets/css/stylediseño.css">
    
  <link rel="stylesheet" href="assets/css/style.css">
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
</head>
 
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">

  <?php require 'partials/header.php'?> 

<!--
    <!?php if(!empty($user)): ?>
    <br>Bienvenid(a)   <!?= $user['nombre'] ?>
    <br>Empieza a rodar con nosotros
    <a href="logout.php">Cerrar sesión</a>  
    <!?php else: ?>    
    <h1>Iniciar sesión </h1>

    <a href="login.php">Iniciar sesión</a> or
    <a href="registrarse.php">Crear Cuenta</a>
    <!?php endif; ?>

    -->

    <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="https://cdn.wallpapersafari.com/73/87/hiducV.jpg" alt="Mountainbike" width="1200" height="700">
        <div class="carousel-caption">
          <h1><strong>AVENTURA</strong></h1>
         
        </div>      
      </div>

      <div class="item">
        <img src="https://wallpaperaccess.com/full/4171818.jpg" alt="Chicago" width="1200" height="700">
        <div class="carousel-caption">
          <h1><strong>PASEO</strong></h1>
       
        </div>      
      </div>
    
      <div class="item">
        <img src="https://s1.1zoom.me/big0/136/Boys_Bicycle_Helmet_492218.jpg" alt="Los Angeles" width="1200" height="700">
        <div class="carousel-caption">
          <h1><strong>NIÑOS</strong></h1>

        </div>      
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>
<!-- Container (Productos Section) -->
<div id="tour" class="bg-1">
  <div class="container">
    <h3 class="text-center ">¡OFERTAS!</h3>
    <p class="text-center">¡Tenemos todo lo que necesitas!<br> Recuerda iniciar sesión para poder comprar</p>
    <ul class="list-group">
      <li class="list-group-item"><p><strong> Bicicletas</strong></p> <span class="label label-danger"></span></li>
      <li class="list-group-item"><p><strong>Accesorios</strong></p><span class="label label-danger"></span></li> 
      <li class="list-group-item"><p><strong>Arriendo o reparación</strong></p><span class="badge"></span></li> 
    </ul>
    
    <div class="row text-center">
      <div class="col-sm-4">
        <div class="thumbnail">
          <img src="https://contents.mediadecathlon.com/p1319543/k$93054dd3d5bce63e35663edaf6a21ba2/bicicleta-polivalente-origin-500-8-12-anos-azul.jpg?format=auto&f=800x800" alt="Paris" width="400" height="300">
          <p><strong>Bicicleta Polivalente Origin 500 8-12 Años Azul</b></strong></p>
          <p>$200.000</p>
          <button class="btn btn-danger" data-toggle="modal" data-target="#myModal">Comprar</button>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="thumbnail">
          <img src="https://falabella.scene7.com/is/image/Falabella/882097994_1?wid=800&hei=800&qlt=70" alt="New York" width="400" height="300">
          <p><strong>Bicicleta Elect E-Falcon 2</strong></p>
          <p>$779.990</p>
          <button class="btn btn-danger" data-toggle="modal" data-target="#myModal">Comprar</button>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="thumbnail">
          <img src="https://fullbike.cl/6359-tm_thickbox_default/casco-best-enduro-fucsia-turquesa.jpg" alt="San Francisco" width="400" height="300">
          <p><strong>Accesorio</strong></p>
          <p>$ 34.900</p>
          <button class="btn btn-danger" data-toggle="modal" data-target="#myModal">Comprar</button>
        </div>
      </div>
    </div>
  </div>
  

</body>
</html>
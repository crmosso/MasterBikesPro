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

?>
<!DOCTYPE html>
<html>
  <head>
    <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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

  
   <TITLE>MenuStock.html</TITLE>
  </head>
  <body >
    <?php require 'partials/header.php'?>    

    <div class="tile ">
        <article class="tile is-child notification is-info ">
          <p class="title">Administración de Stock</p>
          <p class="subtitle">Pagina  para administración de stock Masterbikes </p>
         <form action="form_cliente_bootstra.php"> <button class="btn btn-primary" type="submit">Registrar Producto</button></form>
         <br>
         <form action="listar_clientes.php"> <button class="btn btn-success" type="submit">Visualizar Stock</button></form>
            <br>
         <div class="notification is-warning">
            <button class="delete"></button>
           <strong> ¡En Visualizar productos registrados</strong> Usted podra actualizar o eliminar un producto!
          </div>
<br></br>


        </article>
      </div>
    
   
      
  </body>
  <style>
     
      #imagen{
          text-align: center;
          align-items: center;
          

      }
     #container{ 
         color:aquamarine;
       
       
    }
    
    #btn-color-picker {
        background: none;
        border: #000 1px solid;
        padding: 2px;
        cursor: pointer;
    }
    </style>
</html>
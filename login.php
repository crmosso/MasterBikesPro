<?php
  include("conexion.php");  
  include("enviar_correo.php");

      session_start();
      if (isset($_SESSION['id_usuario'])){
          header('Location: /MasterBikes');
      }
    
      //Login
      if(isset($_POST["ingresar"])) {
        $usuario = mysqli_real_escape_string($conexion,$_POST['user']);
        $contraseña = mysqli_real_escape_string($conexion,$_POST['pass']);
        $password_encriptada = sha1($contraseña); //Con esta variable encripto la contraseña en la base de datos.
        $sql = "SELECT idusuarios,rol FROM usuarios WHERE usuario = '$usuario'  AND password = '$password_encriptada' ";
        $resultado = $conexion->query($sql);
        $rows = $resultado->num_rows;
        if($rows > 0){
          $row = $resultado->fetch_assoc();
          $_SESSION['id_usuario'] = $row["idusuarios"];
          header("Location:index.php");
        }else{
           echo "<script>
            alert('Usuario o contraseña incorrecta');
            window.location = 'login.php';
            </script>";
        }
      }
      //Registrar usuario
      if(isset($_POST["registrar"])){
       // Función myaqli_real_escape_string permite que el usuario no pueda enviar inyyeción sql 
       //por medio del formulario.
	   $rut = mysqli_real_escape_string($conexion,$_POST['rut']);
       $nombre = mysqli_real_escape_string($conexion,$_POST['nombre']);
       $email = mysqli_real_escape_string($conexion,$_POST['correo']);
       $usuario = mysqli_real_escape_string($conexion,$_POST['user']);
       $telefono = mysqli_real_escape_string($conexion,$_POST['phonenumber']);
       $direccion = mysqli_real_escape_string($conexion,$_POST['address']);
       $contraseña =  mysqli_real_escape_string($conexion,$_POST['pass']);
       $password_encriptada = sha1($contraseña); //Con esta variable encripto la contraseña en la base de datos.
	   $token = sha1(rand(0,1000));

	   $sqluser = "SELECT idusuarios FROM usuarios WHERE rut = '$rut'"; // Evita que haya usuarios duplicados.

       $resultadouser = $conexion->query($sqluser);
       $filas= $resultadouser->num_rows;
       if($filas > 0){
        echo "<script>
                alert('El rut ingresado ya existe');
                window.location = 'login.php';
                </script>";
       }else{
         //insertar informacion del usuario
         $sqlusuario = "INSERT INTO usuarios(
            rut,NombreC,Correo,usuario,phone,direccion,password,Token) VALUES('$rut','$nombre','$email','$usuario','$telefono','$direccion',
             '$password_encriptada','$token')";
         $resultadousuario = $conexion->query($sqlusuario);
         if($resultadousuario > 0){
			echo "<script>
			alert('¡Bienvenido(a) $nombre, hemos enviado un correo de confirmación para completar tu registro!')
			window.location = 'login.php';
			</script>";
			$para_usuario = $email;
			$asunto = 'Verifica tu cuenta (masterbikes456@gmail.com)';
			$mensaje = 'Hola '.$nombre. 'Gracias por registrarte !
			Por favor confirma tu cuenta haciendo click en este link:
			http://localhost/MasterBikes/activar_correo.php?email='.$email.'&token='.$token;
			sendEmail($para_usuario,$asunto,$mensaje);
         }else{

            echo "<script>
                    alert('Error al registrarse');
                    window.location = 'login.php';
            </script>";
         }      
       }
     }
	 //Restaurar password
	 if(isset($_POST["recuperarpass"])){
		$email = mysqli_real_escape_string($conexion,$_POST['correo']);
		$sqlrecuperar = "SELECT * FROM usuarios WHERE Correo = '$email'";
		$resultadoRecupera = $conexion->query($sqlrecuperar);
		$resultado = $resultadoRecupera->num_rows;
		if($resultado === 0){
			echo "<script>
				alert('El usuario con ese correo no fue encontrado!');
				window.location = 'login.php';
			</script>";
			exit();
		}else{
			$user = $resultadoRecupera->fetch_assoc();

			$correo = $user['Correo'];
			$token = $user['Token'];
			$nombre = $user['NombreC'];
			$para_usuario = $correo;
			$asunto = 'Cambiar password (masterbikes@gmail.com)';
			$mensaje = 'Hola '.$nombre. ' Has pedido un cambio de contraseña!
			<br/>
			Por favor haz click en el link para cambiar tu contraseña: 
			<br/>
			<a href="http://localhost/MasterBikes/recuperar.php?correo='.$correo.'&token='.$token.' "><b> Click 
			aqui para Cambiar Password</b></h>
			';
			sendEmail($para_usuario,$asunto,$mensaje);


			echo "<script>
				alert('Por favor revisa tu correo [ $correo ] hemos enviado un  link de confirmación para completar el cambio de contraseña!');
				window.location = 'login.php';

			</script>";
			exit();
		}
	 }




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

</head>
<body class="login-layout" style=" 
  background-image: url('https://i.pinimg.com/originals/65/fd/e0/65fde0d8abe15a8b7c877f3ce81c2087.jpg') ;
   min-height: 100%;
 
   background-size: cover;
   background-repeat: no-repeat;
   background-position: center center;">

 
<?php require 'partials/headerlogin.php'?>    
 
    


<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
							<div class="center">
							

							<div class="space-6"></div>

							<div class="position-relative">
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
                                            <!-- LOGIN DE USUARIO -->
									<h3>
												<i class="ace-icon fa fa-bicycle green"></i>
												Ingresa tu Información
										</h3>	

											<div class="space-6"></div>

											<form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST" >
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control"  name="user"placeholder="Usuario" required/>
															<i class="ace-icon fa fa-user"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" name="pass"class="form-control" placeholder="Contraseña" required/>
															<i class="ace-icon fa fa-lock"></i>
														</span>
													</label>

													<div class="space"></div>

													<div class="clearfix">
														<label class="inline">
															<input type="checkbox" class="ace" />
															<span class="lbl"> Recordarme</span>
														</label>

											<button type="submit" class="width-35 pull-right btn btn-sm btn-primary" name="ingresar">
												<i class="ace-icon fa fa-key"></i>
												<span class="bigger-110">Ingresar</span>
											</button>


													</div>

													<div class="space-4"></div>
												</fieldset>
											</form>

										</div><!-- /.widget-main -->

										<div class="toolbar clearfix">
											<div>
												<a href="#" data-target="#forgot-box" class="forgot-password-link">
													<i class="ace-icon fa fa-arrow-left"></i>
													Olvide mi contraseña
												</a>
											</div>

											<div>
												<a href="#" data-target="#signup-box" class="user-signup-link">
													Nuevo Registro
													<i class="ace-icon fa fa-arrow-right"></i>
												</a>
											</div>
										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.login-box -->
	 								<!--RECUPERAR CONTRASEÑA-->
								<div id="forgot-box" class="forgot-box widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h3 class="header red lighter bigger">
												<i class="ace-icon fa fa-key"></i>
												Recuperar Contraseña
											</h3>

											<div class="space-6"></div>
											<p>
												Ingresa tu correo electronico para recibir las instrucciones
											</p>

						<form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">
							<fieldset>
								<label class="block clearfix">
									<span class="block input-icon input-icon-right">
									<input type="email" class="form-control" placeholder="Email" name="correo" required/>
									<i class="ace-icon fa fa-envelope"></i>
									</span>
								</label>
							<div class="clearfix">
								<button type="submit" name="recuperarpass" class="width-35 pull-right btn btn-sm btn-danger">
								<i class="ace-icon fa fa-lightbulb-o"></i>
								<span class="bigger-110">Enviar</span>
								</button>
							</div>
							</fieldset>
						</form>
				</div><!-- /.widget-main -->

	<div class="toolbar center">
		<a href="#" data-target="#login-box" class="back-to-login-link">
			Regresar al Login
			<i class="ace-icon fa fa-arrow-right"></i>
			</a>
			</div>
			</div><!-- /.widget-body -->
			</div><!-- /.forgot-box -->

<!-- REGISTRO DE NUEVOS USUARIOS -->
	<div id="signup-box" class="signup-box widget-box no-border">
             	<div class="widget-body">
			<div class="widget-main">
				<h3 class="header green lighter bigger">
					<i class="ace-icon fa fa-users blue"></i>
						Registro de Nuevos Usuarios
				</h3>
	<div class="space-6"></div>
		<p>Ingresa los datos solicitados acontinuacion: </p>
		<form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST" >
			<fieldset>
			<!--RUT-->
			<label class="block clearfix">
					<span class="block input-icon input-icon-right">
						<input type="text" class="form-control"  name="rut" ntype="text" class="form-control" required name="r" id="rut" oninput="checkRut(this)"
                                aria-describedby="hrut" placeholder="Ingrese Rut"  required />
								<small id="hrut" class="form-text text-danger"></small>
							<i class="ace-icon fa fa-address-card"></i>
							
					</span>

				</label>



				<!--Nombre-->	
			            <label class="block clearfix">
					<span class="block input-icon input-icon-right">
						<input type="text" class="form-control"  name="nombre" placeholder="Nombre Completo" 
						onkeypress="return sololetras(event)" aria-describedby="hnom" required />
							<i class="ace-icon fa fa-users"></i>
					</span>
				</label>
	 			<!--CORREO-->
				<label class="block clearfix">
					<span class="block input-icon input-icon-right">
				             	<input type="text" class="form-control" name="correo" id="email1" aria-describedby="hemail11"
      							  onchange="return FormatoEmail(this)" placeholder="Email"  required />
									<small id="mail" class="form-text text-muted"></small>
					                        <i class="ace-icon fa fa-envelope"></i>
					</span>
				</label>

	 			<!--CONFIRMAR CORREO-->
	 			<label class="block clearfix">
						<span class="block input-icon input-icon-right">
							<input type="text" class="form-control"
							name="" id="email2" aria-describedby="helpemail" oninput="validaremail()"
							placeholder="Confirmar Email" name="Confirmar E-mail"required />
							<small id="helpemail" class="form-text text-muted"></small>
							<i class="ace-icon fa fa-envelope"></i>
						</span>
				</label>
				<!--NOMBRE DE USUARIO-->
					<label class="block clearfix">
						<span class="block input-icon input-icon-right">
			                     		<input type="text" class="form-control" name="user" placeholder="Usuario"  required />
                                       				<i class="ace-icon fa fa-user"></i>
  						</span>
				</label>

                <!--TELEFONO-->
				<label class="block clearfix">
                     				<span class="block input-icon input-icon-right">
		                      			<input type="text" class="form-control" name="phonenumber" placeholder="Telefono "
										  onkeypress="return solonumeros(event)" onpaste="return false" onchange="return ValidarTelefono(this)"
										   required />
										   <small id="ntel" class="form-text text-danger"></small>
							<i class="ace-icon fa fa-phone"></i>
					</span>
				</label>
		

	 			<!--DIRECCIÓN-->
                <label class="block clearfix">
                     				<span class="block input-icon input-icon-right">
		                      			<input type="text" class="form-control" name="address" placeholder="Dirección"  required />
							<i class="ace-icon fa fa-map"></i>
					</span>
				</label>
                
				
	 			<!--CONTRASEÑA-->
				<label class="block clearfix">
                     				<span class="block input-icon input-icon-right">
		                      			<input type="password" class="form-control" name="pass" id="psw1" aria-describedby="hpsw1" 
										  placeholder="Password"  required />
							<i class="ace-icon fa fa-lock"></i>
					</span>
				</label>
				<!--CONFIRMAR CONTRASEÑA-->
				<label class="block clearfix">
					<span class="block input-icon input-icon-right">
						<input type="password" class="form-control" name="passr" id="psw2" aria-describedby="helpconf" oninput="validarpass()"
						placeholder="Repetir password" required/>
						<small id="helpconf" class="form-text text-danger"></small>
							<i class="ace-icon fa fa-retweet"></i>
									</span>
				</label>
				
	 			<!--ACEPTO DE CONDICIONES-->

				<label class="block">
					<input type="checkbox" class="ace" required/>
						<span class="lbl">
						Acepto los
						<a href="#">Terminos de Uso</a>
						</span>
				</label>
				<div class="space-24"></div>
				<div class="clearfix">
					<button type="reset" class="width-30 pull-left btn btn-sm">
						<i class="ace-icon fa fa-refresh"></i>
							<span class="bigger-110">Reset</span>
					</button>
					
					<button type="submit" name="registrar"   class="width-65 pull-right btn btn-sm btn-success">
						<span class="bigger-110">Registrar</span>
							<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
					</button>
					 </div>
			</fieldset>
		</form>
	</div>

			<div class="toolbar center">
				<a href="#" data-target="#login-box" class="back-to-login-link">
					<i class="ace-icon fa fa-arrow-left"></i>
						Regresar al Login
				</a>
			</div>
		</div><!-- /.widget-body -->
	</div><!-- /.signup-box -->
</div><!-- /.position-relative -->

<!--NAVBAR -->


						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="assets/js/jquery-2.1.4.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
			 $(document).on('click', '.toolbar a[data-target]', function(e) {
				e.preventDefault();
				var target = $(this).data('target');
				$('.widget-box.visible').removeClass('visible');//hide others
				$(target).addClass('visible');//show target
			 });
			});


		</script>
 
  
</body>
</html>
<?php
  include("conexion.php");  
  session_start();
  if(isset($_GET['correo']) && !empty($_GET['correo'])  AND isset($_GET['token']) && !empty($_GET['token'])  ) {
      $correo = mysqli_real_escape_string($conexion,$_GET['correo']);
      $token = mysqli_real_escape_string($conexion,$_GET['token']);

      $sqlrecuperar = "SELECT * FROM usuarios WHERE Correo= '$correo' AND Token='$token'";
      $resultadoRecupera = $conexion->query($sqlrecuperar);
		$resultado = $resultadoRecupera->num_rows;
		if($resultado === 0){
			echo "<script>
				alert('Has ingresado una URL invalida para cambiar de contraseña');
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
    <title>Cambio de contraseña</title>
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
                                            <!-- RECUPERAR CONTRASEÑA -->
									<h4>
												<i class="ace-icon fa fa-bicycle green"></i>
												Ingresa nueva contraseña
										</h4>	

											<div class="space-6"></div>

											<form action="recuperarpassword.php" method="POST" >
												<fieldset>
												
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" name="nuevapass"class="form-control" id="psw1" aria-describedby="hpsw1" placeholder="Nueva Contraseña" required/>
															<i class="ace-icon fa fa-lock"></i>
														</span>
													</label>
                                                    

                                                    <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" name="confirmarpass"class="form-control" id="psw2" aria-describedby="helpconf" oninput="validarpass()"
                                                             placeholder="Confirmar contraseña" required/>
															<i class="ace-icon fa fa-lock"></i>
														</span>
													</label>

													<div class="space"></div>
													<div class="clearfix">
                                                        
                                            <input type="hidden" name="correo" value="<?= $correo ?>"> 
                                            <input type="hidden" name="token" value="<?= $token ?>"> <br/>   
   
											<button  class="width-35 pull-right btn btn-sm btn-primary" >
												<i class="ace-icon fa fa-key"></i>
												<span class="bigger-110">Actualizar</span>
											</button>

													</div>

													<div class="space-4"></div>
												</fieldset>
											</form>

										</div><!-- /.widget-main -->

										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.login-box -->
	 							
				
				</div><!-- /.widget-main -->

			</div><!-- /.widget-body -->
			</div><!-- /.forgot-box -->
			
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
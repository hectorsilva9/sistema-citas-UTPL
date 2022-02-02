<?php
include_once('../../controller/paciente/config.php');
if(isset($_POST['submit']))
{
$fcedula=$_POST['cedula'];
$fname=$_POST['full_name'];
$ffechanacimiento=$_POST['appdate'];
$address=$_POST['address'];
$city=$_POST['city'];
$gender=$_POST['gender'];
$email=$_POST['email'];
$password=md5($_POST['password']);
$query=mysqli_query($con,"insert into users(cedula,fullname,fechanacimiento,address,city,gender,email,password) values('$fcedula','$fname','$ffechanacimiento','$address','$city','$gender','$email','$password')");
if($query)
{
	echo "<script>alert('Registro exitoso');</script>";
	//header('location:user-login.php');
}
}
?>


<!DOCTYPE html>
<html lang="en">

	<head>
		<title>Registro de pacientes</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description" />
		<meta content="" name="author" />
		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
		<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
		<link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
		<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="assets/css/plugins.css">
		<link rel="stylesheet" href="assets/css/themes/theme-6.css" id="skin_color" />
		
		
		

	</head>

	<body class="login">
		<!-- start: REGISTRATION -->
		<div class="row">
			<div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
				<div class="logo margin-top-30">
				<a href="../index.htmlssss"><h2>Registro de paciente</h2></a>
				</div>
				<!-- start: REGISTER BOX -->
				<div class="box-register">
					<form name="registration" id="registration"  method="post">
						<fieldset>
							<legend>
								Regístrate
							</legend>
							<p>
								Ingrese sus datos personales a continuación:

							</p>
							<div class="form-group">
								<input type="text" class="form-control" name="cedula" placeholder="Ingresar cedula" id="cedula" onChange=" validar()" required>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" name="full_name" placeholder="Nombre completo" required>
							</div>
							
							<div class="form-group">
															<label for="fechanacimiento">
																Fecha nacimiento
															</label>
									<input class="form-control datepicker" name="appdate"  type="date" required="required">
									
														</div>
							
							<div class="form-group">
							<label for="fechanacimiento">
																Dirección
															</label>
								<input type="text" class="form-control" name="address" placeholder="Dirección" required>
							</div>
							
							<div class="form-group">
															<label for="city">
																Ciudad

															</label>
							<select name="city" class="form-control" required="required">
																									<option value="">Seleccione Ciudad</option>
									<?php $ret=mysqli_query($con,"select * from ciudad");
									while($row=mysqli_fetch_array($ret))
{
?>
																<option value="<?php echo htmlentities($row['ciudad']);?>">
																	<?php echo htmlentities($row['ciudad']);?>
																</option>
																<?php } ?>
																
															</select>
														</div>
							
							
							<div class="form-group">
								<label class="block">
									Género
								</label>
								<div class="clip-radio radio-primary">
									<input type="radio" id="rg-female" name="gender" value="femenino" >
									<label for="rg-female">
										Femenino
									</label>
									<input type="radio" id="rg-male" name="gender" value="masculino">
									<label for="rg-male">
										Masculino
									</label>
								</div>
							</div>
							<p>
Ingrese los detalles de su cuenta a continuación:
							</p>
							<div class="form-group">
								<span class="input-icon">
									<input type="email" class="form-control" name="email" id="email" onBlur="userAvailability()"  placeholder="Email" required>
									<i class="fa fa-envelope"></i> </span>
									 <span id="user-availability-status1" style="font-size:12px;"></span>
							</div>
							<div class="form-group">
								<span class="input-icon">
									<input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
									<i class="fa fa-lock"></i> </span>
							</div>
							<div class="form-group">
								<span class="input-icon">
									<input type="password" class="form-control" name="password_again" placeholder="Contraseña nuevamente" required>
									<i class="fa fa-lock"></i> </span>
							</div>
							<div class="form-group">
								<div class="checkbox clip-check check-primary">
									<input type="checkbox" id="agree" value="agree">
									<label for="agree">
									Estoy de acuerdo

									</label>
								</div>
							</div>
							<div class="form-actions">
								<p>
								¿Ya tienes una cuenta?
									<a href="user-login.php">
										Iniciar sesión
									</a>
								</p>
								<button type="submit" class="btn btn-primary pull-right" id="submit" name="submit">
									Aceptar <i class="fa fa-arrow-circle-right"></i>
								</button>
							</div>
						</fieldset>
					</form>

					<div class="copyright">
						&copy; <span class="current-year"></span><span class="text-bold text-uppercase"> UTPL </span>. <span>Todos los derechos reservados </span>
					</div>

				</div>

			</div>
		</div>
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>
		<script src="vendor/jquery-validation/jquery.validate.min.js"></script>
		<script src="assets/js/main.js"></script>
		<script src="assets/js/login.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				Login.init();
			});
		</script>
		
	<script>
function userAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'email='+$("#email").val(),
type: "POST",
success:function(data){
$("#user-availability-status1").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
function validar() {
	var cedula = document.getElementById("cedula").value;
  if (cedula.length!=10) {
    alert('El campo debe tener 10 dígitos');
    document.getElementById("cedula").value = '';
	document.getElementById("cedula").focus();
  }
}
</script>	
		
	</body>
	<!-- end: BODY -->
</html>
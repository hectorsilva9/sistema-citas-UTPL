<?php
session_start();
//error_reporting(0);
include('../../controller/admin/include/config.php');
include('../../controller/admin/include/checklogin.php');
check_login();

if(isset($_POST['submit']))
{	
	//echo "<script>alert('2');</script>";
	//echo "<script>alert($_POST['Doctorspecialization']);</script>";
	//echo "Especialidad:" . $_POST['Doctorspecialization'];
foreach($_POST['Doctorspecialization'] as $especialidad )
{
	$especialidades.= $especialidad." - ";
}
$especialidades = substr($especialidades, 0, -2);
$docspecialization=$especialidades;
$docname=$_POST['docname'];
$cedula=$_POST['cedula'];
$ffechanacimiento=$_POST['appdate'];
$docaddress=$_POST['clinicaddress'];
$docfees=$_POST['docfees'];
$doccontactno=$_POST['doccontact'];
$docemail=$_POST['docemail'];
$password=md5($_POST['npass']);
$sql=mysqli_query($con,"insert into doctors(specilization,doctorName,cedula, fechanacimiento, address,docFees,contactno,docEmail,password) values('$docspecialization','$docname','$cedula','$ffechanacimiento','$docaddress','$docfees','$doccontactno','$docemail','$password')");
if($sql)
{
echo "<script>alert('Doctor agregado correctamente');</script>";
//header('location:manage-doctors.php');

}
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Admin | Añadir Doctor</title>
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
		<link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
		<link href="vendor/select2/select2.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="assets/css/plugins.css">
		<link rel="stylesheet" href="assets/css/themes/theme-6.css" id="skin_color" />
<script type="text/javascript">
function valid()
{
 if(document.adddoc.npass.value!= document.adddoc.cfpass.value)
{
alert("Password and Confirm Password Field do not match  !!");
document.adddoc.cfpass.focus();
return false;
}
return true;
}
</script>

	</head>
	<body>
		<div id="app">		
<?php include('../../controller/admin/include/sidebar.php');?>
			<div class="app-content">
				
						<?php include('../../controller/admin/include/header.php');?>
						
				<!-- end: TOP NAVBAR -->
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Admin | Añadir Doctor</h1>
																	</div>
								<ol class="breadcrumb">
									<li>
										<span>Admin</span>
									</li>
									<li class="active">
										<span>Añadir Doctor</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: BASIC EXAMPLE -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									
									<div class="row margin-top-30">
										<div class="col-lg-8 col-md-12">
											<div class="panel panel-white">
												<div class="panel-heading">
													<h5 class="panel-title">Añadir Doctor</h5>
												</div>
												<div class="panel-body">
									
													<form role="form" name="adddoc" method="post" onSubmit="return valid();">
														<div class="form-group">
															<label for="DoctorSpecialization">
																Especialización médica

															</label>
							<select multiple name="Doctorspecialization[]" class="form-control" id="Doctorspecialization" required="required">
																<option value="">Seleccione Especialidad</option>
<?php $ret=mysqli_query($con,"select * from doctorspecilization");
while($row=mysqli_fetch_array($ret))
{
?>
																<option value="<?php echo htmlentities($row['specilization']);?>">
																	<?php echo htmlentities($row['specilization']);?>
																</option>
																<?php } ?>
																
															</select>
														</div>

<div class="form-group">
															<label for="doctorname">
																 Nombre del doctor

															</label>
					<input type="text" name="docname" class="form-control"  placeholder="Nombre médico">
														</div>
<div class="form-group">
															<label for="doctorname">
																 Cédula

															</label>
					<input type="text" name="cedula" class="form-control"  placeholder="Ingresar cédula" id='cedula' onChange="validar()"=>
														</div>
														
														<div class="form-group">
															<label for="fechanacimiento">
																Fecha nacimiento
															</label>
									<input class="form-control datepicker" name="appdate"  type="date" required="required">
									
														</div>


<div class="form-group">
															<label for="address">
																 Dirección clinica de Doctor 

															</label>
					<textarea name="clinicaddress" class="form-control"  placeholder="Dirección médico"></textarea>
														</div>
<div class="form-group">
															<label for="fess">
																 Honorarios de consultoría médica
															</label>
					<input type="text" name="docfees" class="form-control"  placeholder="Honorarios médico">
														</div>
	
<div class="form-group">
									<label for="fess">
																		Celular
															</label>
					<input type="text" name="doccontact" class="form-control"  placeholder="Celular médico">
														</div>

<div class="form-group">
									<label for="fess">
																 Email
															</label>
					<input type="email" name="docemail" class="form-control"  placeholder="Email médico">
														</div>



														
														<div class="form-group">
															<label for="exampleInputPassword1">
																 Contraseña

															</label>
					<input type="password" name="npass" class="form-control"  placeholder="Nueva contraseña" required="required">
														</div>
														
<div class="form-group">
															<label for="exampleInputPassword2">
																Confirmar Contraseña

															</label>
									<input type="password" name="cfpass" class="form-control"  placeholder="Confirmar contraseña" required="required">
														</div>
														
														
														
														<button type="submit" name="submit" class="btn btn-o btn-primary" >
															Aceptar
														<button/>
													</form>
												</div>
											</div>
										</div>
											
											</div>
										</div>
									<div class="col-lg-12 col-md-12">
											<div class="panel panel-white">
												
												
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- end: BASIC EXAMPLE -->
			
					
					
						
						
					
						<!-- end: SELECT BOXES -->
						
					</div>
				</div>
			</div>
			<!-- start: FOOTER -->
	<?php include('../../controller/admin/include/footer.php');?>
			<!-- end: FOOTER -->
		
			<!-- start: SETTINGS -->
	<?php include('../../controller/admin/include/setting.php');?>
			<>
			<!-- end: SETTINGS -->
		</div>
		<!-- start: MAIN JAVASCRIPTS -->
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>
		<script src="vendor/jquery-validation/jquery.validate.min.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
		<script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
		<script src="vendor/autosize/autosize.min.js"></script>
		<script src="vendor/selectFx/classie.js"></script>
		<script src="vendor/selectFx/selectFx.js"></script>
		<script src="vendor/select2/select2.min.js"></script>
		<script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CLIP-TWO JAVASCRIPTS -->
		<script src="assets/js/main.js"></script>
		<!-- start: JavaScript Event Handlers for this page -->
		<script src="assets/js/form-elements.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				FormElements.init();
			});
			function validar() {
	var cedula = document.getElementById("cedula").value;
  if (cedula.length!=10) {
    alert('El campo debe tener 10 dígitos');
    document.getElementById("cedula").value = '';
	document.getElementById("cedula").focus();
  }
  
}
 function insertarEspecialidad()
  {
	  var sel =  document.getElementById("Doctorspecialization");
	  //var selectOp = this.options[sel.selectIndex];
	  alert(sel.value);
	  for (var i=0; i<sel.length;i++)
	  {
		  var opt = sel[i];
		//alert(opt.select);
	  }
  }
		</script>
		<!-- end: JavaScript Event Handlers for this page -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->
	</body>
</html>

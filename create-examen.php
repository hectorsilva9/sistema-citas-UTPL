<?php
session_start();
//error_reporting(0);
include('../../controller/doctor/config.php');
include('../../controller/doctor/checklogin.php');
check_login();
$did=intval($_GET['id']);
if(isset($_POST['submit']))
{	
$idCita = $_GET['id'];
$sql=mysqli_query($con,"select * from appointment a, users b where a.userId=b.id and a.id='$did'");
while($data=mysqli_fetch_array($sql))
{
	$idUser = $data['userId'];
	$idDoctor = $data['doctorId'];
}
foreach($_POST['examenes'] as $examen )
{
	$examenes.= $examen." - ";
}
$examenes = substr($examenes, 0, -2);
$ordenExamen=$examenes;
$indicaciones=$_POST['indicaciones'];
$diagnostico=$_POST['diagnostico'];
$sintomas=$_POST['descripcion'];
$sql=mysqli_query($con,"insert into ordenexamenes(idCita, idUser, idDoctor, examenes, indicaciones, diagnostico, sintomas) values('$idCita','$idUser','$idDoctor','$ordenExamen','$indicaciones','$diagnostico','$sintomas')");
if($sql)
{
echo "<script>alert('Examen agregado correctamente');</script>";

}
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Añadir examen</title>
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


	</head>
	<body>
		<div id="app">		
<?php include('../../controller/doctor/sidebar.php');?>
			<div class="app-content">
				
						<?php include('../../controller/doctor/header.php');?>
						
				<!-- end: TOP NAVBAR -->
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Crear examen</h1>
																	</div>
							
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
													<h5 class="panel-title">Examen</h5>
												</div>
												<div class="panel-body">											
									
													<form role="form" name="adddoc" method="post">
														<div class="form-group">
															<label for="examenes">
																Exámenes

															</label>
							<select multiple name="examenes[]" class="form-control" id="examenes" required="required">
																<option value="">Seleccione Exámenes</option>
<?php $ret=mysqli_query($con,"select * from examenes");
while($row=mysqli_fetch_array($ret))
{
?>
																<option value="<?php echo htmlentities($row['examen']);?>">
																	<?php echo htmlentities($row['examen']);?>
																</option>
																<?php } ?>
																
															</select>
														</div>

<div class="form-group">
															<label for="indicaciones">
																 Indicaciones

															</label>
					<input type="text" name="indicaciones" class="form-control"  placeholder="Indicaciones">
														</div>
														<div class="form-group">
															<label for="diagnostico">
																 Diagnóstico

															</label>
					<input type="text" name="diagnostico" class="form-control"  placeholder="Diagnostico">
														</div>
<div class="form-group">
<?php 
$sql=mysqli_query($con,"select * from appointment a, users b where a.userId=b.id and a.id='$did'");
while($data=mysqli_fetch_array($sql))
{
?>
															<label for="paciente">
																 Paciente

															</label>
					<input type="text" name="fname" class="form-control" readonly="readonly" value="<?php echo htmlentities($data['fullName']);?>" >
					
					<label for="sintomas">
																 Síntomas

															</label>
					<input type="text" name="descripcion" class="form-control" readonly="readonly" value="<?php echo htmlentities($data['Descripcion']);?>" >
														</div>

														
														
														
														<button type="submit" name="submit" class="btn btn-o btn-primary" >
															Aceptar
														<button/>
														<?php } ?>
													</form>
												</div>
											</div>
										</div>
											
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
	</script>
		<!-- end: JavaScript Event Handlers for this page -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->
	</body>
</html>

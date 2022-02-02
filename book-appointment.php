<?php
session_start();
//error_reporting(0);
include('../../controller/paciente/config.php');
include('../../controller/paciente/checklogin.php');
check_login();

if(isset($_POST['submit']))
{
$specilization=$_POST['Doctorspecialization'];
$doctorid=$_POST['doctor'];
$userid=$_SESSION['id'];
$fees=$_POST['fees'];
$appdate=$_POST['appdate'];
$time=$_POST['apptime'];
$userstatus=1;
$docstatus=1;
$sintomas=$_POST['Descripcion'];
$queryCantidad=mysqli_query($con,"select count(*) as conteo2  from appointment where userId = '".$_SESSION['id']."' and appointmentDate = '".$_POST['appdate']."'");
$queryCita=mysqli_query($con,"select count(*) as conteo  from appointment where doctorId = '".$_POST['doctor']."' and appointmentTime = '".$_POST['apptime']."'");
$row=mysqli_fetch_array($queryCita);
$row2=mysqli_fetch_array($queryCantidad);

if($row['conteo'] >= 1)
{
	echo "<script>alert('No hay disponibilidad, elija otro horario');</script>";
}
else
{
	if($row2['conteo2'] >= 2)
		{
			echo "<script>alert('No puede generar más de 2 citas al día');</script>";
		}
	else
	{
		$query=mysqli_query($con,"insert into appointment(doctorSpecialization,doctorId,userId,consultancyFees,appointmentDate,appointmentTime,userStatus,doctorStatus,Descripcion) values('$specilization','$doctorid','$userid','$fees','$appdate','$time','$userstatus','$docstatus','$sintomas')");
		if($query)
			{
				echo "<script>alert('Tu cita se reservó correctamente');</script>";
			}
	}
}
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Usuario | Reservar una cita</title>
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
		<link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="assets/css/plugins.css">
		<link rel="stylesheet" href="assets/css/themes/theme-6.css" id="skin_color" />
		<script>
function getdoctor(val) {
	$.ajax({
	type: "POST",
	url: "../../model/paciente/get_doctor.php",
	data:'specilizationid='+val,
	success: function(data){
		$("#doctor").html(data);
	}
	});
}
</script>	


<script>
function getfee(val) {
	$.ajax({
	type: "POST",
	url: "../../model/paciente/get_doctor.php",
	data:'doctor='+val,
	success: function(data){
		$("#fees").html(data);
	}
	});
}
</script>	




	</head>
	<body>
		<div id="app">		
<?php include('../../controller/paciente/sidebar.php');?>
			<div class="app-content">
			
						<?php include('../../controller/paciente/header.php');?>
					
				<!-- end: TOP NAVBAR -->
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Usuario | Reservar una cita</h1>
																	</div>
								<ol class="breadcrumb">
									<li>
										<span>Usuario</span>
									</li>
									<li class="active">
										<span>Reservar una cita</span>
									</li>
								</ol>
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
													<h5 class="panel-title">Reservar una cita</h5>
												</div>
												<div class="panel-body">
								<p style="color:red;"><?php echo htmlentities($_SESSION['msg1']);?>
								<?php echo htmlentities($_SESSION['msg1']="");?></p>	
													<form role="form" name="book" method="post" >
														


<div class="form-group">
															<label for="DoctorSpecialization">
															Especialización médica

															</label>
							<select name="Doctorspecialization" class="form-control" onChange="getdoctor(this.value);" required="required">
																<option value="">Select Specialization</option>
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
															<label for="doctor">
																Doctor
															</label>
						<select name="doctor" class="form-control" id="doctor" onChange="getfee(this.value);" required="required">
						<option value="">Seleccione Doctor</option>
						</select>
														</div>

		<div class="form-group">
		<label for="Descripcion">
																Descripción
															</label>
								<input type="text" class="form-control" name="Descripcion" placeholder="Ingresar síntomas" id="Descripcion"  required>
							</div>



														<div class="form-group">
															<label for="consultancyfees">
																Honorarios de consultoría

															</label>
					<select name="fees" class="form-control" id="fees"  readonly>
						
						</select>
														</div>
														
<div class="form-group">
															<label for="AppointmentDate">
																Fecha
															</label>
									<input class="form-control datepicker" name="appdate"  type="date" required="required" onChange="validarCalendario()" id="appdate">
									
														</div>
													

		<div class="form-group">
															<label for="apptime">
																Horario

															</label>
							<select name="apptime" class="form-control" required="required">
																									<option value="">Seleccione horario</option>
									<?php $ret=mysqli_query($con,"select * from horario");
									while($row=mysqli_fetch_array($ret))
{
?>
																<option value="<?php echo htmlentities($row['Horario']);?>">
																	<?php echo htmlentities($row['Horario']);?>
																</option>
																<?php } ?>
																
															</select>
														</div>

														
														
														<button type="submit" name="submit" class="btn btn-o btn-primary">
															Enviar
														</button>
													</form>
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
	<?php include('../../controller/paciente/footer.php');?>
			<!-- end: FOOTER -->
		
			<!-- start: SETTINGS -->
	<?php include('../../controller/paciente/setting.php');?>
			
			<!-- end: SETTINGS -->
		</div>
		<!-- start: MAIN JAVASCRIPTS -->
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
		<script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
		<script src="vendor/autosize/autosize.min.js"></script>
		<script src="vendor/selectFx/classie.js"></script>
		<script src="vendor/selectFx/selectFx.js"></script>
		<script src="vendor/select2/select2.min.js"></script>
		<script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
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
		<script>
		$(function(){
			$("#datepicker").datepicker({minDate: 0});
		});
		
		function validarCalendario() {
		var fechaActual = new Date();
		var anio = fechaActual.getFullYear();
		var mes = fechaActual.getMonth()+1;
		var dia = fechaActual.getDate();
		if(mes.length = 1)
		{
			mes = '0' + mes;
		}
		var fechaTotal = anio + '-' + mes + '-' + dia;
		var fecha = document.getElementById("appdate").value;
		if (fecha < fechaTotal) {
		alert('La fecha debe ser mayor o igual a la actual');
		document.getElementById("appdate").value = fechaActual.value;
		
  }
}
		</script>
		<!-- end: JavaScript Event Handlers for this page -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>

	</body>
</html>

<?php
session_start();
//error_reporting(0);
include('../../controller/doctor/config.php');
include('../../controller/doctor/checklogin.php');
require('../../fpdf/fpdf.php');

check_login();
$did=intval($_GET['id']);
if(isset($_POST['submit']))
{
class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('../../images/hospital3.jpg',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(60);
    // Título
    $this->Cell(200,10,'Hospital de El Oro',0,0,'C');
    // Salto de línea
    $this->Ln(20);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Página '.$this->PageNo().'/{nb}',0,0,'C');
}
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
//$hoy = getDate();
$sql=mysqli_query($con,"select * from appointment a, doctors b where a.doctorId=b.id and a.id='$did'");
while($data=mysqli_fetch_array($sql))
{
	$pdf->Cell(90, 10, 'DOCTOR:', 1, 0, 'C', 0);
	$pdf->Cell(90, 10, $data['doctorName'], 1, 1, 'C', 0);
}
$sqlPac=mysqli_query($con,"select * from appointment a, users b where a.userId=b.id and a.id='$did'");
while($dataPac=mysqli_fetch_array($sqlPac))
{
	$pdf->Cell(90, 10, 'PACIENTE:', 1, 0, 'C', 0);
	$pdf->Cell(90, 10, $dataPac['fullName'], 1, 1, 'C', 0);
}
$sqlRec=mysqli_query($con,"select * from receta where idCita='$did'");
while($dataRec=mysqli_fetch_array($sqlRec))
{
$pdf->Cell(90, 10, 'FECHA DE EMISION:', 1, 0, 'C', 0);
$pdf->Cell(90, 10, $dataRec['creationDate'], 1, 1, 'C', 0);
$pdf->Cell(90, 10, 'MEDICINAS:', 1, 0, 'C', 0);
$pdf->Cell(90, 10, $dataRec['medicinas'], 1, 1, 'C', 0);
$pdf->Cell(90, 10, 'POSOLOGIA:', 1, 0, 'C', 0);
$pdf->Cell(90, 10, $dataRec['posologia'], 1, 500, 'C', 0);
}

$sqlDoc=mysqli_query($con,"select * from appointment a, doctors b where a.doctorId=b.id and a.id='$did'");
while($dataDoc=mysqli_fetch_array($sqlDoc))
{
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(90, 10, 'EMITIDO POR:', 0, 20, 'C', 0);
	$pdf->Cell(90, 10, $dataDoc['doctorName'], 0, 500, 'C', 0);
}
$sqlFecha=mysqli_query($con,"select now() as fecha");
while($dataFecha=mysqli_fetch_array($sqlFecha))
{
	$pdf->Cell(90, 10, 'FECHA DE GENERACION:', 0, 20, 'C', 0);
	$pdf->Cell(90, 10, $dataFecha['fecha'], 0, 1, 'C', 0);
}
$pdf->Output();
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Añadir receta</title>
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
									<h1 class="mainTitle">Imprimir receta</h1>
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
											
												<div class="panel-body">											
									
													<form role="form" name="adddoc" method="post">
														
<div class="form-group">
<?php 
$sql=mysqli_query($con,"select * from appointment a, users b where a.userId=b.id and a.id='$did'");
while($data=mysqli_fetch_array($sql))
{
?>
					
					
					
														</div>

														
														
														
														<button type="submit" name="submit" class="btn btn-o btn-primary" >
															Imprimir receta
														<button/>
														<?php } ?>
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
	</script>
		<!-- end: JavaScript Event Handlers for this page -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->
	</body>
</html>

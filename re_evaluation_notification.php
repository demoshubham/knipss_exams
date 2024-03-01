<?php
set_time_limit(0);
//session_cache_limiter('nocache');
//session_start();
include("settings.php");
include("exam_crosslist_marksheet_functions.php");
 page_header();
$response=1;
$msg='';
?>
<!DOCTYPE html>
<html>
<head>
<style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  width: 300px;
  background-color: #f1f1f1;
}

li a {
  display: block;
  color: #000;
  padding: 10px 16px;
  text-decoration: none;
  font-size:20px;
  text-align:left;
}



li a:hover:not(.active) {
  background-color: blue;
  color: white;
}
li a.active {
  background-color: blue;
  color: white;
}
</style>
</head>
<body>

<div class="d-flex justify-content-center " style="gap:1rem;">
<ul>
  <li><a  href="#home" >Instructions</a></li>
  <li><a href="re_evaluation_notification.php" class="active" >Notification</a></li>
  <li><a href="re_evaluation_reg.php">Click To Registration</a></li>
  <li><a href="re_evalucation_reprint_application_view_scanned.php">Reprint Application</a></li>
  <li><a href="re_evalucation_reprint_application_view_scanned.php">View Scanned Copy</a></li>
  <li><a href="#about">Check Payment Status</a></li>
  <li><a href="index.php">Go to Home</a></li>
</ul>
<div id="container" width="70%">
	<div class="row ">
		<section class="content-header">
			<h1 style="color: #000!important;">Notifications</h1> <br>
		</section>
		<section class="content-header" style="margin-top: -25px">
			<h3 style="font-size: 20px; font-weight: 600;"></h3>
		</section>
		

				<div style=" width:95%;">
					<div class="text-center" style="font-size:1rem;">No record found!</div>
				</div>
				
		
	
<!---Examination Section-------------------------------------------------------------------------------------------------------------------------->
					
				

				
					
				</div>
			</div>

			

	
	
	</div>
</div> 
</div>



</body>
</html>


<?php 

	page_footer();
	ob_end_flush();
?>


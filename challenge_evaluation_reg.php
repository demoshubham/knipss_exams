<?php
set_time_limit(0);
//session_cache_limiter('nocache');
//session_start();
include("settings.php");
include("exam_crosslist_marksheet_functions.php");
 page_header();

 print_r($_POST);
 if(!isset($_POST['edited'])){
		$_POST['appno']="";
	 	$_POST['bankrefno']="";
        $_POST['rollno']="";
 }
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
  <li><a  href="challenge_evaluation_instruction.php" >Instructions</a></li>
  <li><a href="challenge_notification.php">Notification</a></li>
  <li><a href="challenge_evaluation_reg.php" class="active">Click To Registration</a></li>
  <li><a href="#about">Reprint Application</a></li>
  <li><a href="#about">View Scanned Copy</a></li>
  <li><a href="#about">Check Payment Status</a></li>
  <li><a href="index.php">Go to Home</a></li>
</ul>
<div id="container" width="70%">
	<div class="row ">
		<section class="content-header">
			<h1 style="color: #000!important;">Challenge to Evaluation of Answer Book</h1> <br>
		</section>
		<section class="content-header" style="margin-top: -25px">
			<h3 style="font-size: 20px; font-weight: 600;"></h3>
		</section>
		
		
<!---Student info section-------------------------------------------------------------------------------------------------------------------------------->
			
		<form action="challenge_answer_sheet_view.php" id="examForm" class="wufoo leftLabel page1" name="admission_newadmission" enctype="multipart/form-data" method="post" onSubmit="" >
				<?php //echo $msg; ?>	
				<div style=" width:95%;">
					<div class="text-start" style="font-size:1.5rem;">Student Registration</div>
					<div class=" card card-body col-md-12 my-auto mx-auto" style="border-top-color: #d2d6de; background-color:whitesmoke;" >
					
					<div class="row mt-1">							
						<div class="col-md-4">					
							<label>Applicaton No.(Inspection) </label>
							<input  type="text" name="appno" id="appno" class="form-control bolding bolding" value="<?php echo $_POST['appno']; ?>" tabindex="<?php echo $tabindex++;?>"  required>
						</div>
						<div class="col-md-4">							
							<label>Bank Reference No.</label>
							<input  type="text" name="bankrefno" id="bankrefno" class="form-control bolding bolding " value="<?php echo $_POST['bankrefno']; ?>"  required>
						</div>
						<div class="col-md-4">							
							<label>Roll No.</label>
							<input  type="text" name="rollno" id="rollno" class="form-control bolding bolding "  value="<?php echo $_POST['rollno']; ?>" required>
						</div>
					</div>
					<div class=" text-center mt-3" style="font-size:0.8rem;">Please View Your Scanned Copy first then candidate can eligible to Challenge for Marks. :</div>
					<div class="row mt-1">
						<div class="col-md-12">	
						    <label></label>						
							<center><button name = "submit" value="save" target="_blank" class="btn btn-primary mt-1" >Verify Details</button></center><br>
						</div>
						<div class="col-md-4">	
						</div>
					</div>
				</div>
				
			</div>
	
<!---Examination Section-------------------------------------------------------------------------------------------------------------------------->
					
				

				
					
				</div>
			</div>

			
		</form>
<!--END Form-------------------------------------------------------------------------------------------------------------------------->

	
	
	</div>
</div> 
</div>



</body>
</html>


<?php 

	page_footer();
	ob_end_flush();
?>


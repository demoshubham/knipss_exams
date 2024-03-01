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
  <li><a href="re_evaluation_notification.php" >Notification</a></li>
  <li><a href="re_evaluation_reg.php" class="active" >Click To Registration</a></li>
  <li><a href="re_evalucation_reprint_application_view_scanned.php">Reprint Application</a></li>
  <li><a href="re_evalucation_reprint_application_view_scanned.php">View Scanned Copy</a></li>
  <li><a href="#about">Check Payment Status</a></li>
  <li><a href="index.php">Go to Home</a></li>
</ul>
<div id="container" width="70%">
	<div class="row ">
		<section class="content-header">
			<h1 style="color: #000!important;">Online Application of Inspection of Answer Book</h1> <br>
		</section>
		<section class="content-header" style="margin-top: -25px">
			<h3 style="font-size: 20px; font-weight: 600;"></h3>
		</section>
		
		
<!---Student info section-------------------------------------------------------------------------------------------------------------------------------->
			
		<form action="anwer_sheet_view.php" id="examForm" class="wufoo leftLabel page1" name="admission_newadmission" enctype="multipart/form-data" method="post" onSubmit="" >
				<?php //echo $msg; ?>	
				<div style=" width:95%;">
					<div class="text-start" style="font-size:1.5rem;">Registration Form</div>
					<div class=" card card-body col-md-12 my-auto mx-auto" style="border-top-color: #d2d6de; background-color:whitesmoke;" >
					
					<div class="row mt-1">							
						<div class="col-md-4">							
							<label>Roll Number </label>
							<input  type="text" name="exam_roll_no" id="exam_roll_no" class="form-control bolding bolding" value="<?php //echo $row['stu_name']; ?>"   required>
						</div>
						<div class="col-md-4">							
							<label>Email ID</label>
							<input  type="text" name="email" id="email" class="form-control bolding bolding " value="<?php //echo $row['father_name']; ?>"  required>
						</div>
						<div class="col-md-4">							
							<label>Mobile</label>
							<input  type="text" name="mobile_no" id="mobile_no" class="form-control bolding bolding "  value="<?php //echo $row['mother_name']; ?>" required>
						</div>
					</div>
					<div class="row mt-1">
						
						
						<div class="col-md-4">							
							<label>Course</label>
										<select name="result_course" id="course" value="" class="form-control" required>
												<option selected disabled >---Select Course---</option>
												<?php 
												echo $sql  = 'select distinct(course_name),result_class.class_description from exam_student_info LEFT JOIN result_class on exam_student_info.course_name = result_class.sno WHERE result_class.show_result = 1 ORDER BY result_class.class_description';
												// echo $sql;
												$dept_list = mysqli_query($erp_link,$sql);
												if($dept_list){
													while($list = mysqli_fetch_assoc($dept_list)){
														echo '<option  value = "'.$list['course_name'].'">'.$list['class_description'].'</option>';
													}
												}
												?>
												
										</select>
						</div>
						<div class="col-md-4">	
						<label></label>						
							<center><button name = "submit" value="save" target="_blank" class="btn btn-primary mt-2" >Verify Details</button></center><br>
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


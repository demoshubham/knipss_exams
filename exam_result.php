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
<html>
	<body id="public">
		<div id="container" width="70%">
			<div class="card">
				<div class="card-body col-md-11  " style="background-color:#E5E4E2;">
					<div class="row ">
						<section class="content-header" style="margin-top: -25px">
							<h2 style="font-size: 30px; font-weight: 700;">Result 2023-24</h2>
						</section>
						<form action="exam_result_print.php" method="POST" enctype="multipart/form-data" target="_blank">
							<?php echo $msg; ?> 
							<div class="col-md-12">
								<div class="row">
									<div class=" col-md-4 ">
										<label><h6 style="font-size: 15px; font-weight: 600;">Course</h6></label>
										<select name="result_course" id="course" value="" class="form-control" tabindex="1" required>
												<option selected disabled >---Select Course---</option>
												<?php 
												$sql  = 'select distinct(course_name),result_class.class_description from exam_student_info LEFT JOIN result_class on exam_student_info.course_name = result_class.sno WHERE result_class.show_result = 1 ORDER BY result_class.class_description';
												echo $sql;
												$dept_list = mysqli_query($erp_link,$sql);
												if($dept_list){
													while($list = mysqli_fetch_assoc($dept_list)){
														echo '<option  value = "'.$list['course_name'].'">'.$list['class_description'].'</option>';
													}
												}
												?>
												
										</select>
									</div>
									<div class=" col-md-4 ">
										<label><h6 style="font-size: 15px; font-weight: 600;">Exam Roll Number</h6></label>
										<input type="text" name="exam_roll_no" id="exam_roll_no" class="form-control" required>
									</div>
									<div class=" col-md-3">
										<label><h6 style="font-size: 15px; font-weight: 600;">Date Of Birth</h6></label>
										<input type="date" name="stu_dob" id="stu_dob" class="form-control" required>
									</div>
								</div>
								<div class="row mt-1">
									<div class="col-md-2">
									<button type="submit" name = "submit" value="save" target="_blank" class="btn btn-primary mt-2 ms-2">Search</button> 
									</div>
								</div>
							</div>
					   </form>
					</div>
				</div>
			</div>
		</div>  
	</body>
</html>	
<?php
page_footer();
?>
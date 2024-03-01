<?php
date_default_timezone_set('Asia/Calcutta');
session_cache_limiter('nocache');

$response=1;
$tabindex=1;
$msg='';
if(isset($_POST)){
	foreach($_POST as $k=>$v){
		$_POST[$k] = htmlspecialchars($v);
	}
}
include("settings.php");
include("image_upload.php");
///	$sup=dbconnect($_POST[$id]);
page_header();
?>

<?php
if(isset($_GET['id']) && $_GET['id']!=''){
    $sql = execute_query('select * from admission_student_info where sno = '.$_GET['id']);
    if($sql){
        $stu_details = mysqli_fetch_assoc($sql);
    }
}



if(isset($_GET['id']) && $_GET['id']!=''){
	$sql1 = "SELECT * FROM admission_address WHERE d_student_info_sno = ".(isset($_GET['id']) ? $_GET['id']: $_GET['edit']) . " AND type_of_address = 'permanent'";
	//echo $sql1;
   $sql = execute_query($sql1);
	
    if($sql){
        $p_address_details = mysqli_fetch_assoc($sql);
    }
}
if(isset($_GET['id']) && $_GET['id']!=''){
    $sql = execute_query("SELECT * FROM admission_address WHERE d_student_info_sno = " .(isset($_GET['id']) ? $_GET['id'] : $_GET['edit'] ). " AND type_of_address = 'correspondence'");
    if($sql){
        $c_address_details = mysqli_fetch_assoc($sql);
    }
}	

	if(isset($_GET['edit'])){
	$sql= 'select * from admission_student_info where sno = '.$_GET['edit'];
	$qry = mysqli_query($db, $sql);
	$res = mysqli_fetch_assoc($qry);
}

if(isset($_POST['submit'])){
	if(isset($_POST['edit']) && $_POST['edit'] != ''){
		//echo "updatre";
		// echo $_POST['id'];
		$edit= $_POST['edit'];
		$sql = 'UPDATE `admission_student_info` SET '.
        'candidate_name = "'.$_POST['candidate_name'].'", '.
        'father_name = "'.$_POST['father_name'].'", '.
        'mother_name = "'.$_POST['mother_name'].'", '.
        'dob = "'.$_POST['dob'].'", '.
        'aadhar = "'.$_POST['aadhar'].'", '.
        'gender = "'.$_POST['gender'].'", '.
        'mobile = "'.$_POST['mobile'].'", '.
        'email = "'.$_POST['email'].'", '.
        'course_type = "'.$_POST['course_type'].'", '.
        'course_applying_for = "'.$_POST['course_applying_for'].'", '.
        'religion = "'.$_POST['religion'].'", '.
        'category = "'.$_POST['category'].'", '.
        'caste = "'.$_POST['caste'].'", '.
        'status = "'.$_POST['status'].'", '.
        'college_roll_no = "'.$_POST['college_roll_no'].'", '.
        'parent_income = "'.$_POST['parent_income'].'", '.
        'domicile = "'.$_POST['domicile'].'", '.
        'mother_tongue = "'.$_POST['mother_tongue'].'", '.
        'weightage = "'.$_POST['weightage'].'", '.
        'blood_group = "'.$_POST['blood_group'].'" '.
        'WHERE sno = "'.$_POST['id'].'"';
	execute_query($sql);
	//echo $sql;
	if(mysqli_error($db)){
			$rs=0;
			$msg .= '<li>'.mysqli_error($db).' >> '.$sql.'</li>';
			echo $msg;
	}
	else{
		$rs=1;
	}
	if($rs==1) { 
		
		for($i=1; $i<=4; $i++){
		if(isset($_POST['q_sno'.$i]) && $_POST['q_sno'.$i]!='' ){
			if($_POST['part_desc'.$i.'_board']!='' ){
				//echo "hello";
				$qualification_sql = 'UPDATE admission_qualification SET '.
				'name_of_examination = "'.$_POST['part_desc'.$i].'", '.
				'board_university_name = "'.$_POST['part_desc'.$i.'_board'].'", '.
				'college_name = "'.$_POST['part_desc'.$i.'_college'].'", '.
				'year = "'.$_POST['part_desc'.$i.'_year'].'", '.
				'roll_no = "'.$_POST['part_desc'.$i.'_rollno'].'", '.
				'obtained_marks = "'.$_POST['part_desc'.$i.'_obtmarks'].'", '.
				'total_marks = "'.$_POST['part_desc'.$i.'_totmarks'].'", '.
				'percentage = "'.$_POST['part_desc'.$i.'_percentage'].'", '.
				'cgpa = "'.$_POST['part_desc'.$i.'_cgpa'].'", '.
				'status = "'.$_POST['part_desc'.$i.'_status'].'", '.
				'edition_time = "'.date('Y-m-d H:i:s').'" '.
				 'WHERE sno = ' . $_POST['q_sno'.$i];
				 //echo $qualification_sql;
				 $sql = execute_query($qualification_sql);
				 
				 if(mysqli_errno($db)){
					$rs=0;
					$msg .= '<li>'.mysqli_error($db).' >> '.$sql.'</li>';
				}
			}	
		}
				
				
			}
		if(isset($_POST['p_sno']) && $_POST['p_sno']!=''){
			$query1 = "UPDATE admission_address SET 
				type_of_address = 'permanent',
				address = '" . $_POST['p_address'] . "',
				post = '" . $_POST['p_post'] . "',
				district = '" . $_POST['p_district'] . "',
				state = '" . $_POST['p_state'] . "',
				tehsil = '" . $_POST['p_tehsil'] . "',
				thana = '" . $_POST['p_thana'] . "',
				pin = '" . $_POST['p_pin'] . "',
				edition_time = '" . date('Y-m-d H:i:s') . "'
				WHERE sno = ".$_POST['p_sno'];
			
			$sql = execute_query($query1);
			
			if(mysqli_errno($db)){
				$rs=0;
				$msg .= '<li>'.mysqli_error($db).' >> '.$sql.'</li>';
			}
		}
		if(isset($_POST['c_sno']) && $_POST['c_sno']!=''){
			$query2 = "UPDATE admission_address SET
				type_of_address = 'correspondence',
				address = '" . $_POST['c_address'] . "',
				post = '" . $_POST['c_post'] . "',
				district = '" . $_POST['c_district'] . "',
				state = '" . $_POST['c_state'] . "',
				tehsil = '" . $_POST['c_tehsil'] . "',
				thana = '" . $_POST['c_thana'] . "',
				pin = '" . $_POST['c_pin'] . "',
				edition_time = '" . date('Y-m-d H:i:s') . "'
				WHERE sno = ".$_POST['c_sno'];
		  
			$sql = execute_query($query2);
			
			if(mysqli_errno($db)){
				$rs=0;
				$msg .= '<li>'.mysqli_error($db).' >> '.$sql.'</li>';
			}
			else{
				$msg .= '<li>Data Updated successfully</li>';
			}
		}		
				echo '<script>alert("Form Updated Successfully")</script>';
				header('location: uin_report_edit_print.php?id='.$edit);
				
				$_POST['candidate_name'] = '';
				$_POST['father_name'] = '';
				$_POST['mother_name'] = '';
				$_POST['dob'] = date("Y-m-d");
				$_POST['aadhar'] = '';
				$_POST['gender'] = '';
				$_POST['mobile'] = '';
				$_POST['email'] = '';
				$_POST['course_type'] = '';
				$_POST['course_applying_for'] = '';
				$_POST['religion'] = '';
				$_POST['category'] = '';
				$_POST['caste'] = '';
				$_POST['status'] = '';
				$_POST['college_roll_no'] = '';
				$_POST['parent_income']='';
				$_POST['domicile']='';
				$_POST['mother_tongue']='';
				$_POST['weightage']='';
				$_POST['blood_group']='';
				$_POST['stu_status'] = '';
				$_FILES['photo'] = '';
				$_FILES['signature'] = '';
				for($i=1; $i<=$_POST['qualification_no']; $i++){
					$_POST['part_desc'.$i] = '';
					$_POST['part_desc'.$i.'_board']= '';
					$_POST['part_desc'.$i.'_college']= '';
					$_POST['part_desc'.$i.'_year']= '';
					$_POST['part_desc'.$i.'_rollno']= '';
					$_POST['part_desc'.$i.'_obtmarks']= '';
					$_POST['part_desc'.$i.'_totmarks']= '';
					$_POST['part_desc'.$i.'_percentage']= '';
					$_POST['part_desc'.$i.'_cgpa']= '';
					$_POST['part_desc'.$i.'_division']= '';
					$_POST['part_desc'.$i.'_status']= '';
					
				}
				$_POST['qualification_no'] = '';
				$_POST['p_address']= '';
				$_POST['p_post']= '';
				$_POST['p_district']= '';
				$_POST['p_state']= '';
				$_POST['p_tehsil']= '';
				$_POST['p_thana']= '';
				$_POST['p_pin']= '';
				$_POST['c_address']= '';
				$_POST['c_post']= '';
				$_POST['c_district']= '';
				$_POST['c_state']= '';
				$_POST['c_tehsil']= '';
				$_POST['c_thana']= '';
				$_POST['c_pin']= '';
				$_POST['edit']= '';
				
				
	}		 
	 }
}
else{
	// $_POST['sr_no'] = '';
	
	//$id= '';
	$_POST['candidate_name'] = '';
	$_POST['father_name'] = '';
	$_POST['mother_name'] = '';
	$_POST['dob'] = date("Y-m-d");
	$_POST['aadhar'] = '';
	$_POST['gender'] = '';
	$_POST['mobile'] = '';
	$_POST['email'] = '';
	$_POST['course_type'] = '';
	$_POST['course_applying_for'] = '';
	$_POST['religion'] = '';
	$_POST['category'] = '';
	$_POST['caste'] = '';
	$_POST['status'] = '';
	$_POST['college_roll_no'] = '';
	$_POST['parent_income']='';
	$_POST['domicile']='';
	$_POST['mother_tongue']='';
	$_POST['weightage']='';
	$_POST['blood_group']='';
	$_POST['stu_status'] = '';
	$_FILES['photo'] = '';
	$_FILES['signature'] = '';
	$_POST['edit'] = '';
	
	if(isset($_POST['qualification_no'])){
		for($i=1; $i<=$_POST['qualification_no']; $i++){
			$_POST['part_desc'.$i] = '';
			$_POST['part_desc'.$i.'_board']= '';
			$_POST['part_desc'.$i.'_college']= '';
			$_POST['part_desc'.$i.'_year']= '';
			$_POST['part_desc'.$i.'_rollno']= '';
			$_POST['part_desc'.$i.'_obtmarks']= '';
			$_POST['part_desc'.$i.'_totmarks']= '';
			$_POST['part_desc'.$i.'_percentage']= '';
			$_POST['part_desc'.$i.'_division']= '';
			$_POST['part_desc'.$i.'_status']= '';
			
		}
	}
	$_POST['qualification_no'] = '';
	$_POST['p_address']= '';
	$_POST['p_post']= '';
	$_POST['p_district']= '';
	$_POST['p_state']= '';
	$_POST['p_tehsil']= '';
	$_POST['p_thana']= '';
	$_POST['p_pin']= '';
	$_POST['c_address']= '';
	$_POST['c_post']= '';
	$_POST['c_district']= '';
	$_POST['c_state']= '';
	$_POST['c_tehsil']= '';
	$_POST['c_thana']= '';
	$_POST['c_pin']= '';
	$_POST['edit']= '';
	
}
if(isset($_GET['id']) && $_GET['id']!='' ){
	$sql = execute_query('select  * from new_student_info where sno = '.$_GET['id'], $db);
	if($sql){
		$data = mysqli_fetch_assoc($sql);
	}
	//print_r($data);
}

if(isset($_GET['edit']) && $_GET['edit']!=''){
    $sql = execute_query('select * from admission_qualification where d_student_info_sno  = '.$_GET['edit']);
    if($sql){
		$i = 1;
		while($row = mysqli_fetch_assoc($sql)){
			if($row['name_of_examination']!= 'High School' && $row['name_of_examination']!='Intermediate' && $row['name_of_examination']!='B.Ed'){
				$examination_name = 'select * from class_detail where sno = '.$row['name_of_examination'];
				//echo $examination_name;
				$examination_name = execute_query($examination_name);
				if($examination_name){
					$examination_name = mysqli_fetch_assoc($examination_name);
					$_POST['part_desc'.$i] = $examination_name['class_description'];
				}
			}
			if($row['name_of_examination']=='B.Ed'){
				$_POST['part_desc'.$i] = 'B.Ed';
			}
			$_POST['q_sno'.$i] = $row['sno'];
			$_POST['part_desc'.$i.'_board'] = $row['board_university_name'];
			$_POST['part_desc'.$i.'_college'] = $row['college_name'];
			$_POST['part_desc'.$i.'_year'] = $row['year'];
			$_POST['part_desc'.$i.'_rollno'] = $row['roll_no'];
			if($row['cgpa']== NULL || $row['cgpa']== ''){
				$_POST['part_desc'.$i.'_obtmarks'] = $row['obtained_marks'];
				$_POST['part_desc'.$i.'_totmarks'] = $row['total_marks'];
				$_POST['part_desc'.$i.'_percentage'] = $row['percentage'];
			}else{
				$_POST['part_desc'.$i.'_cgpa'] = $row['cgpa'];
			}
			$_POST['part_desc'.$i.'_division'] = $row['division'];
			$_POST['part_desc'.$i.'_status'] = $row['status'];
			$i++;
		}
        
	}
}
?>
<style></style>


<div id="container" width="70%">
	<div class="card">
		<div class="card-body col-md-11  " style="background-color:#E5E4E2;">
			
			<div class="row ">
				
				<section class="content-header">
					<h1 style="color: #000!important;">Admission Form <span></span>(2023-24)</h1>
								 <br>
				</section>
				<section class="content-header" style="margin-top: -25px">
					<h3 style="font-size: 20px; font-weight: 600;"></h3>
				</section>
				<form action="" id="examForm" class="wufoo leftLabel page1" name="admission_newadmission" enctype="multipart/form-data" method="post" onSubmit="" >
				<?php echo $msg; ?>	
					<div class=" card card-body col-md-11 my-auto mx-auto" style="border-top-color: #d2d6de; background-color:whitesmoke;" >
					
						<div class="row mt-1">							
							<div class="col-md-6">							
								<label>Candidate Name * <span style="color:red;">(हाईस्कूल का प्रमाण-पत्र के अनुसार)</span></label>
								<input type="text" name="candidate_name" id="candidate_name" class="form-control " value="<?php echo isset($_GET['id'])? $stu_details['candidate_name'] : '' ?>" tabindex="<?php echo $tabindex++;?>" style="pointer-events:none ;" required>
							</div>
							<div class="col-md-6">							
								<label>Father&#39;s Name* <span style="color:red;">(हाईस्कूल का प्रमाण-पत्र के अनुसार)</span></label>
								<input type="text" name="father_name" id="father_name" class="form-control " value="<?php echo isset($_GET['id'])? $stu_details['father_name'] : '' ?>" style="pointer-events:none ;" required>
							</div>
						</div>
						<div class="row mt-1">
							<div class="col-md-6">							
								<label>Mother&#39;s Name</label>
								<input type="text" name="mother_name" id="mother_name" class="form-control " style="pointer-events:none ;" value="<?php echo isset($_GET['id'])? $stu_details['mother_name'] : '' ?>" required>
							</div>
							<div class="col-md-6">							
								<label>Date of Birth* <span style="color:red; ">(हाईस्कूल का प्रमाण-पत्र के अनुसार)</span></label>
								<input type="text" id="dob" name="dob" readonly class="form-control">

								<script>
									// JavaScript code to populate the Date of Birth field and make it read-only
									document.addEventListener("DOMContentLoaded", function () {
										var dobInput = document.getElementById("dob");
										var defaultDate = '<?php if(isset($_GET['id'])){echo $stu_details['dob'];}else{echo date("Y-m-d");}?>';
										
										// Set the default value for the Date of Birth field
										dobInput.value = defaultDate;

										// Make the Date of Birth field read-only
										dobInput.readOnly = true;
									});
								</script>
							</div>
						</div>
						<div class="row mt-1">
							<div class="col-md-6">
								<label>Aadhar</label>
								<input type="text" name="aadhar" style="pointer-events:none ;" id="aadhar" class="form-control " value="<?php echo isset($_GET['id'])? $stu_details['aadhar'] : '' ?>" tabindex="<?php echo $tabindex++;?>" style="pointer-events:none ;" required>
							</div>
							<div class="col-md-6">							
								<label>E-Mail</label>
								<input type="text" name="email" id="email" class="form-control " value="<?php echo isset($_GET['id'])? $stu_details['email'] : '' ?>" style="pointer-events:none ;"  required>
							</div>
						</div>
						<div class="row mt-1">
							<div class="col-md-6">							
								<label>Mobile</label>
								<input type="text" name="mobile" id="mobile" class="form-control " value="<?php echo isset($_GET['id'])? $stu_details['mobile'] : '' ?>" style="pointer-events:none ;" required>
							</div>
							<div class="col-md-6">							
								<label>Course Type</label>
								<!-- <input type="text" name="course_type" id="course_type" class="form-control " value="<?php echo isset($_GET['id'])? $stu_details['course_type'] : '' ?>" placeholder="" style="pointer-events:none ;"/> -->
								<select name="course_type" id="course_type" value="<?php echo $data['course_type']?>" class="form-control" style="pointer-events: none;" required>
										<option disabled <?php echo isset($_GET['id'])? "":' selected = "selected" '?>>---Select Your Course Type---</option>
										<?php 
											$sql  = 'select * from mst_course_type';
											$dept_list = execute_query( $sql);
											if($dept_list){
												while($list = mysqli_fetch_assoc($dept_list)){
													echo '<option  value = "'.$list['sno'].'" '.(isset($_GET['id']) && $stu_details['course_type'] == $list['sno'] ? ' selected = "selected" ':"").'>'.$list['course_type'].'</option>';
												}
											}
										?>
								</select>
							</div>
						</div>
						<div class="row mt-1">							
							<div class="col-md-6">							
								<label>Course Applying for</label>
								<!-- <input type="text" name="course_applying_for" id="course_applying_for" class="form-control " value="<?php echo isset($_GET['id'])? $stu_details['course_applying_for'] : '' ?>" style="pointer-events:none ;"/> -->
								<select name="course_applying_for" id="course_applying_for" value="" class="form-control" style="pointer-events: none;" required >
									
								</select>												
							</div>
							<div class="col-md-6">							
								<label>Category</label>
								<select name="category" id="category" class="form-control" tabindex="<?php echo $tabindex++;?>" style="pointer-events: none;" required>
								<option disabled <?php echo isset($_GET['id'])? "":' selected = "selected" '?>>---Select Your Category---</option>
									<option value="GEN" <?php if(isset($_GET['id']) && $stu_details['category']=="GEN"){ echo 'selected ';}?>>General</option>
									<option value="OBC" <?php if(isset($_GET['id']) && $stu_details['category']=="OBC"){ echo 'selected ';}?>>OBC</option>
									<option value="SC" <?php if(isset($_GET['id']) && $stu_details['category']=="SC"){ echo 'selected ';}?>>SC</option>
									<option value="ST" <?php if( isset($_GET['id']) && $stu_details['category']=="ST"){ echo 'selected ';}?>>ST</option>
									<option value="EWS" <?php if( isset($_GET['id']) && $stu_details['category']=="EWS"){ echo 'selected ';}?>>EWS</option>
								</select>
							</div>
						</div>
						<div class="row mt-1">
						<div class="col-md-6">


							<label for="selectOption">Religion</label>
									<select id="selectOption" name="religion" class="form-control" tabindex="<?php echo $tabindex++;?>"  required>
										<option value="" disabled selected>---Select Your Religion---</option>
										<option value="HINDU" <?php if(isset($_GET['edit']) && $stu_details['religion']=="HINDU"){ echo 'selected ';}?>>HINDU</option>
									<option value="MUSLIM" <?php if(isset($_GET['edit']) && $stu_details['religion']=="MUSLIM"){ echo 'selected ';}?>>MUSLIM</option>
									<option value="SIKH" <?php if(isset($_GET['edit']) && $stu_details['religion']=="SIKH"){ echo 'selected ';}?>>SIKH</option>
									<option value="CHRISTIAN" <?php if(isset($_GET['edit']) && $stu_details['religion']=="CHRISTIAN"){ echo 'selected ';}?>>CHRISTIAN</option>
									</select>

								<script>
									function validateForm() {
										var selectedOption = document.getElementById('selectOption').value;
										if (selectedOption === "") {
											alert("Please select religion");
											return false;
										}
										return true;
									}
								</script>
						</div>

							
							<div class="col-md-6">
								
								<label for="selectOption">Gender</label>
									<select id="selectOption" name="gender" class="form-control" tabindex="<?php echo $tabindex++;?>"  required>
										<option value="" disabled selected>---Select Your Gender---</option>
										<option value="Male" <?php if(isset($_GET['edit']) && $stu_details['gender']=="Male"){ echo 'selected ';}?>>Male</option>
									<option value="Female" <?php if(isset($_GET['edit']) && $stu_details['gender']=="Female"){ echo 'selected ';}?>>Female</option>
									<option value="Other" <?php if(isset($_GET['edit']) && $stu_details['gender']=="Other"){ echo 'selected ';}?>>Transgender</option>
									</select>

								<script>
									function validateForm() {
										var selectedOption = document.getElementById('selectOption').value;
										if (selectedOption === "") {
											alert("Please select gender");
											return false;
										}
										return true;
									}
								</script>
								
							</div>
						</div>
						<div class="row mt-1">
							<div class="col-md-6">	
								<label>Whatsapp Mobile No.</label>
								<input type="text" name="caste" id="caste" class="form-control " value="<?php echo isset($_GET['edit'])? $stu_details['caste']: '' ?>" pattern=[0-9]{10} minlength="10" maxlength="10"  required />
								
							</div>
							<div class="col-md-6">							
								<label>PARENT'S Mobile No.</label>
								<input type="text" name="parent_income" id="parent_income" class="form-control " pattern=[0-9]{10} minlength="10" maxlength="10" value="<?php echo isset($_GET['edit'])? $stu_details['parent_income']: '' ?>" required>
							</div>
						</div>
						<div class="row mt-1">
							
							<div class="col-md-6">							
								<label>DOMICILE</label>
								<!-- <input type="text" name="course_type" id="course_type" class="form-control " value="<?php echo isset($_GET['id'])? $stu_details['domicile'] : '' ?>" placeholder="" style="pointer-events:none ;"/> -->
								<select name="domicile" id="domicile" value="" class="form-control"  required>
										<option >---Select Your Domicile ---</option>
										<?php 
											$sql  = 'select * from mst_domicile';
											$dept_list = execute_query( $sql);
											if($dept_list){
												while($list = mysqli_fetch_assoc($dept_list)){
													echo '<option  value = "'.$list['sno'].'" '.(isset($_GET['edit'])&& isset($stu_details['domicile']) && $stu_details['domicile'] == $list['sno'] ? ' selected = "selected" ':"").'>'.$list['domicile'].'</option>';
												}
											}
										?>
								</select>
							</div>
							<div class="col-md-6">							
								<label>MOTHER TONGUE</label>
								<select name="mother_tongue" id="mother_tongue" class="form-control" required>
									<option value="hindi" <?php if(isset($_GET['edit']) && $stu_details['mother_tongue']=="hindi"){ echo 'selected ';}?>>Hindi</option>
									<option value="english" <?php if(isset($_GET['edit']) && $stu_details['mother_tongue']=="english"){ echo 'selected ';}?>>English</option>
									
								</select>
							</div>
						</div>
						<div class="row mt-1">
							
							
							<div class="col-md-6">							
								<label>WEIGHTAGE </label>
								<select name="weightage" id="weightage" class="form-control" required>
									<option  disabled >---Select Your Weightage---</option>
									<option value="not_applicable" <?php if(isset($_GET['edit']) && $stu_details['weightage']=="not_applicable"){ echo 'selected ';}?>>Not applicable </option>
									<option value="ncc" <?php if(isset($_GET['edit']) && $stu_details['weightage']=="ncc"){ echo 'selected ';}?>>NCC</option>
									<option value="freedom_fighters" <?php if(isset($_GET['edit']) && $stu_details['weightage']=="freedom_fighters"){ echo 'selected ';}?>>Freedom Fighters</option>
									<option value="sports_achievements" <?php if(isset($_GET['edit']) && $stu_details['weightage']=="sports_achievements"){ echo 'selected ';}?>>Sports Achievements</option>
									<option value="cultural_activities" <?php if(isset($_GET['edit']) && $stu_details['weightage']=="cultural_activities"){ echo 'selected ';}?>>Cultural Activities</option>
									<option value="social_work" <?php if(isset($_GET['edit']) && $stu_details['weightage']=="social_work"){ echo 'selected ';}?>>Social Work</option>
									<option value="volunteering" <?php if(isset($_GET['edit']) && $stu_details['weightage']=="volunteering"){ echo 'selected ';}?>>Volunteering</option>
									
								</select>
							</div>
							<div class="col-md-6">							
								<label>Blood Group</label>
								<select name="blood_group" id="blood_group" class="form-control" required>
									<option <?php echo isset($_GET['id'])? "":' selected = "selected" '?>>---Select Your Blood Group---</option>
									<option value="N/A" <?php if(isset($_GET['edit']) && $stu_details['blood_group']=="N/A"){ echo 'selected ';}?>>N/A</option>
									<option value="A+" <?php if(isset($_GET['edit']) && $stu_details['blood_group']=="A+"){ echo 'selected ';}?>>A+</option>
									<option value="A-" <?php if(isset($_GET['edit']) && $stu_details['blood_group']=="A-"){ echo 'selected ';}?>>A-</option>
									<option value="B+" <?php if(isset($_GET['edit']) && $stu_details['blood_group']=="B+"){ echo 'selected ';}?>>B+</option>
									<option value="B-" <?php if(isset($_GET['edit']) && $stu_details['blood_group']=="B-"){ echo 'selected ';}?>>B-</option>
									<option value="AB+" <?php if(isset($_GET['edit']) && $stu_details['blood_group']=="AB+"){ echo 'selected ';}?>>AB+</option>
									<option value="AB-" <?php if(isset($_GET['edit']) && $stu_details['blood_group']=="AB-"){ echo 'selected ';}?>>AB-</option>
									<option value="O+" <?php if(isset($_GET['edit']) && $stu_details['blood_group']=="O+"){ echo 'selected ';}?>>O+</option>
									<option value="O-" <?php if(isset($_GET['edit']) && $stu_details['blood_group']=="O-"){ echo 'selected ';}?>>O-</option>
									
								</select>
							</div>
						</div>
						<div class="row mt-1">
							<div class="col-md-6">	
								<label>Status</label>
								<select name="status" id="status" class="form-control" tabindex="" style="pointer-events:none;" required>
									<option value="reguler" <?php echo (isset($_GET['id'])  && isset($data['status']) && $data['status']=='reguler') ? 'selected="selected"' : ''; ?>>Regular</option>
									
								</select>
							</div>
							<div class="col-md-6">	
								<label>College Roll No.*<span style="color:red;">(Example:2023abc010001)</span></label>
								<input type="text" name="college_roll_no" id="roll_no" class="form-control " value="<?php echo isset($_GET['edit'])? $stu_details['college_roll_no']: '' ?>" required>
							</div>
						</div>
						<div class="row mt-1">
							<div class="col-md-6">	
								<label>Photo Upload</label>
								<input type="file" name="photo" id="photo" class="form-control " value=""  required>
							</div>
							
							<div class="col-md-6">
								<label>Signature Upload</label>
								<input type="file" name="signature" id="signature" class="form-control " value="" tabindex=""  required>
							</div>
							<div class="col-md-6">
							</div>
						</div>
						<div class="row mt-1">
							<div class="col-md-6">
								<!-- <label>Signature Upload</label>
								<input type="file" name="signature" id="signature" class="form-control " value="" tabindex="" /> -->
							</div>
						</div>
						<!-- <div class="row mt-1">
							<div class="col-md-6">	
								<label>Transfer Certificate</label>
								<input type="file" name="tc" id="tc" class="form-control " value="" />
							</div>
							<div class="col-md-6">	
								
							</div>
						</div> -->
						<div class="row mt-1">
							<div class="col-md-2">
							<!--
								<button id="submit" name="submit" class=" btn btn-primary" type="submit" value="submit">Submit</button>
							--->
							</div>
						</div>
					</div>
			</div>
	<div id="educationDetailsContainer">
			<h2 class="text-dark" >Education Details</h2>
		
                  
		<div class="container">
    <table class="table table-striped table-hover rounded ">
        <thead class="bg-secondary text-white">
            <tr>
                <th scope="col-" >S.No</th>
                <th scope="col" >Name Of<br> Examination</th>
                <th scope="col" >Board<br>University Name</th>
                <th scope="col" >College Name</th>
                <th scope="col">Year of<br> Passing</th>
                <th scope="col" >Roll No</th>
                <th scope="col">Select</th>
                <th scope="col">Obt. Marks</th>
                <th scope="col" >Total Marks</th>
                <th scope="col">Percentage</th>
                <th scope="col" >&nbsp;&nbsp;&nbsp;CGPA &nbsp;&nbsp;</th>
                <th scope="col" >Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
			if($stu_details['course_type']=='2'){
				
				$a = 5;	
			}
			else{
				$a = 3;
			}
			if ($stu_details['course_applying_for'] == '52' || $stu_details['course_applying_for'] == '53' || $stu_details['course_applying_for'] == '54') {
				$a = 5;
			}

            for ($i = 1; $i < $a; $i++) {
                if ($i % 2 != 0) {
                    echo '<tr class="table-secondary">';
                } else {
                    echo '<tr>';
                }
                ?>
                <td><?php echo $i; ?></td>
                <?php
                if ($i == 1) {
                    echo '<td>High School<input type="hidden" name="part_desc' . $i . '"  value="High School" required ></td>';
                } elseif ($i == 2) {
                    echo '<td>Intermediate<input type="hidden" name="part_desc' . $i . '"  value="Intermediate" required ></td>';
                } elseif ($i == 3 || $i == 4) {
                    ?>
                    <td>
                        <select name="part_desc<?php echo $i; ?>" id="part_desc<?php echo $i; ?>" onBlur="tab_fill(1,8)" onFocus="getCurrent(<?php echo $i; ?>)">
                            <option value="<?php echo isset($_POST['part_desc' . $i]) ? $_POST['part_desc' . $i] : ''; ?>"
                                    selected><?php if (isset($_POST['part_desc' . $i . ''])) {
                                    echo $_POST['part_desc' . $i . ''];
                                } ?></option>

                            <option value="B.Ed">B.Ed</option>
                            <?php
                            $sql = 'select * from class_detail ';
                            $result = execute_query($sql);
                            if ($result) {
                                while ($name = mysqli_fetch_array($result)) {
                                    echo '<option value="' . $name['sno'] . '" ';
                                    echo '>' . $name['class_description'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </td>
                    <?php
                }
                ?>
                <td>
                    <input name="part_desc<?php echo $i; ?>_board" type="text"
                           value="<?php echo isset($_GET['edit']) ? (isset($_POST['part_desc' . $i . '_board']) ? $_POST['part_desc' . $i . '_board'] : '') : '' ?>"
                           class="form-control" maxlength="100" id="part_desc<?php echo $i; ?>_board"  <?php if($i<=3){ echo " required ";} ?> />
                </td>

                <td><input name="part_desc<?php echo $i; ?>_college" type="text"
                           value="<?php if (isset($_POST['part_desc' . $i . '_college'])) {
                               echo $_POST['part_desc' . $i . '_college'];
                           } ?>" class="form-control" maxlength="100" id="part_desc<?php echo $i; ?>_college" <?php if($i<=3){ echo " required ";} ?>  /></td>

                <td><input name="part_desc<?php echo $i; ?>_year" type="text"
                           value="<?php if (isset($_POST['part_desc' . $i . '_year'])) {
                               echo $_POST['part_desc' . $i . '_year'];
                           } ?>" class="form-control" maxlength="6" id="part_desc<?php echo $i; ?>_year"  <?php if($i<=3){ echo " required ";} ?> /></td>

                <td><input name="part_desc<?php echo $i; ?>_rollno" type="text"
                           value="<?php if (isset($_POST['part_desc' . $i . '_rollno'])) {
                               echo $_POST['part_desc' . $i . '_rollno'];
                           } ?>" class="form-control"  id="part_desc<?php echo $i; ?>_rollno"  <?php if($i<=3){ echo " required ";} ?> />
                </td>

                <td width="10%">
                    <select name="" id="select<?php echo $i; ?>" class="form-control"
                            onchange="toggleFields(<?php echo $i; ?>)">
                        <option value="" selected>--select--</option>
                        <option value="percentage" <?php if (isset($_POST['part_desc' . $i . '_obtmarks'])) {
                            echo 'selected="selected"';
                        } ?>>percentage
                        </option>
                        <option value="cgpa" <?php if (isset($_POST['part_desc' . $i . '_cgpa'])) {
                            echo 'selected="selected"';
                        } ?>>CGPA
                        </option>
                    </select>
                </td>

                <td><input name="part_desc<?php echo $i; ?>_obtmarks" type="text"
                           value="<?php if (isset($_POST['part_desc' . $i . '_obtmarks'])) {
                               echo $_POST['part_desc' . $i . '_obtmarks'];
                           } ?>" placeholder="Obtained Marks" class="form-control" maxlength="6"
                           id="<?php echo $i ?>_obt"/></td>
                <td>
                    <input name="part_desc<?php echo $i; ?>_totmarks" type="text"
                           value="<?php if (isset($_POST['part_desc' . $i . '_totmarks'])) {
                               echo $_POST['part_desc' . $i . '_totmarks'];
                           } ?>" placeholder="Total Marks" class="form-control" maxlength="6"
                           onBlur="get_perc(<?php echo $i ?>)" id="<?php echo $i ?>_total"/></td>
                <td>
                    <input name="part_desc<?php echo $i; ?>_percentage" type="text"
                           value="<?php if (isset($_POST['part_desc' . $i . '_percentage'])) {
                               echo $_POST['part_desc' . $i . '_percentage'];
                           } ?>" placeholder="Percentage" class="form-control" maxlength="6"
                           id="<?php echo $i ?>_perc" OnBlur="get_division(<?php echo $i ?>)"/></td>
                <td>
                    <input name="part_desc<?php echo $i; ?>_cgpa" type="text"
                           value="<?php if (isset($_POST['part_desc' . $i . '_cgpa'])) {
                               echo $_POST['part_desc' . $i . '_cgpa'];
                           } ?>" class="form-control" placeholder="Enter CGPA" maxlength="10"
                           id="<?php echo $i ?>_cgpa"/></td>

                <td>
                    <select name="part_desc<?php echo $i; ?>_status"
                            value="<?php if (isset($_POST['part_desc' . $i . '_status'])) {
                                echo $_POST['part_desc' . $i . '_status'];
                            } ?>" id="part_desc" onBlur="tab_fill(1,8)" onFocus="getCurrent(<?php echo $i; ?>)">
                        <option value="Passed">Passed</option>
                        <option value="Failed">Failed</option>
                    </select>
                </td>
                <input type="hidden" name="q_sno<?php echo $i; ?>"
                       value="<?php echo isset($_GET['edit']) ? isset($_POST['q_sno' . $i]) ? $_POST['q_sno' . $i] : '' : '' ?>">
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</div>
		
		<div>
			
			<div  name="info_table" id="info_table">
				<table width="100%" class="table table-striped-primary table-hover rounded ">	
					<tr class="bg-secondary text-white ">
						<th colspan="6" class="h5"><strong>Permanent Address</strong></th>
					</tr>
					<tr class="table-secondary">
						<input type="hidden" name="p_sno" value="<?php echo isset($_GET['edit'])? $p_address_details['sno']: '' ?>">
						<th>House No./Village</th>
						<td><input type="text"  class="form-control" id="p_address" name="p_address" value="<?php echo isset($_GET['id'])? $data['p_address'] : '' ?>" required></td>
						<th>Post</th>
						<td><input type="text" class="form-control" id="p_post" name="p_post" value="<?php echo isset($_GET['id'])? $data['p_post'] : '' ?>"  value="<?php echo isset($_GET['edit'])? $p_address_details['post']: '' ?>" required></td>
						<th>Tahsil</th>
						<td><input type="text" class="form-control" id="p_tehsil" name="p_tehsil" value="<?php echo isset($_GET['id'])? $data['p_tehsil'] : '' ?>" required></td>
					</tr>
					<tr>
						<th>Thana</th>
						<td><input type="text" class="form-control" id="p_thana" name="p_thana" value="<?php echo isset($_GET['id'])? $data['p_thana'] : '' ?>" required></td>
						<th>District</th>
						<td><input type="text" class="form-control" id="p_district" name="p_district" value="<?php echo isset($_GET['id'])? $data['p_district'] : '' ?>" required></td>
						<th>State</th>
						<td><input type="text" class="form-control" id="p_state" name="p_state" value="<?php echo isset($_GET['id'])? $data['p_state'] : '' ?>" required></td>
					</tr>
					<tr>
						
						<th>Pin</th>
						<td><input type="text" class="form-control"  id="p_pin" name="p_pin" value="<?php echo isset($_GET['id'])? $data['p_pin'] : '' ?>" required></td>
					</tr>
					<tr class="bg-secondary text-white">
						<th colspan="6" class="h5" >Correspondence Address <a href="javascript:copy_adr()" class="btn btn-danger" >Click Here to Copy</a></th>
					</tr>
					<tr class="table-secondary">
						<input type="hidden" name="c_sno" value="<?php echo isset($_GET['edit'])? $c_address_details['sno']: '' ?>">
						<th>House No./Village</th>
						<td><input type="text" class="form-control" id="c_address" name="c_address" value="<?php echo isset($_GET['edit'])? $c_address_details['address']: '' ?>" required></td>
						<th>Post</th>
						<td><input type="text" class="form-control" id="c_post" name="c_post" value="<?php echo isset($_GET['edit'])? $c_address_details['post']: '' ?>" required></td>
						<th>Tahsil</th>
						<td><input type="text" class="form-control" id="c_tehsil" name="c_tehsil" value="<?php echo isset($_GET['edit'])? $c_address_details['tehsil']: '' ?>" required></td>
						
					</tr>
					<tr>
						<th>Thana</th>
						<td><input type="text" class="form-control" id="c_thana" name="c_thana" value="<?php echo isset($_GET['edit'])? $c_address_details['thana']: '' ?>" required></td>
						<th>District</th>
						<td><input type="text" class="form-control" id="c_district" name="c_district" value="<?php echo isset($_GET['edit'])? $c_address_details['district']: '' ?>" required></td>
						<th>State</th>
						<td><input type="text" class="form-control" id="c_state" name="c_state" value="<?php echo isset($_GET['edit'])? $c_address_details['state']: '' ?>" required></td>
					</tr>
					<tr>
						<th>Pin</th>
						<td><input type="text" class="form-control"  id="c_pin" name="c_pin" value="<?php echo isset($_GET['edit'])? $c_address_details['pin']: '' ?>" required></td>
					</tr>
					
				</table>
			</div>
		</div>
		<table>
			<input type="hidden" name="qualification_no" value="<?php echo --$i; ?>" /><br/>
			<input type="hidden" name="id" id="id" value="<?php echo isset($_REQUEST['id'])? $_REQUEST['id']:"" ?>" />
			<input type="hidden" name="edit" value="<?php echo isset($_GET['edit'])?$_GET['edit']:'' ?>" />
			<center><button type="submit" class="btn btn-danger "  name="submit" value="Submit">Submit</button><center>
		</form>
		<script type="text/javascript">
					function show_info() {
						 $("#info_table").toggle();
					
				}
				 function copy_adr(){
					 document.getElementById('c_address').value = document.getElementById('p_address').value;
					 document.getElementById('c_district').value = document.getElementById('p_district').value;
					 document.getElementById('c_state').value = document.getElementById('p_state').value;
					 document.getElementById('c_post').value = document.getElementById('p_post').value;
					 document.getElementById('c_pin').value = document.getElementById('p_pin').value;
					 document.getElementById('c_tehsil').value = document.getElementById('p_tehsil').value;
					 document.getElementById('c_thana').value = document.getElementById('p_thana').value;
				 }
				 
				 
				 
				</script>

				<script language="javascript">
				function get_perc(value) {
    var obtmarks = '';
    var totmarks = '';
    var percentage = '';

    value = value.toString();
    obtmarks = value.concat("_obt");
    obtmarks = parseFloat(document.getElementById(obtmarks).value);
    totmarks = value.concat("_total");
    totmarks = parseFloat(document.getElementById(totmarks).value);
    percentage = value.concat("_perc");

    var calculatedPercentage = (obtmarks / totmarks) * 100;
    document.getElementById(percentage).value = calculatedPercentage.toFixed(2);
}
				function get_division(value){
					var percentage='';
					value = value.toString();
					percentage = value.concat('_perc');
					//alert(percentage);
					percentage= parseFloat(document.getElementById(percentage).value);
					division= value.concat('_division');
					if(percentage>=60){
						document.getElementById(division).value ='FIRST';
					}
					else if(percentage<60 && percentage>=45){
						document.getElementById(division).value ='SECOND';
					}
					else if(percentage<45){
						document.getElementById(division).value ='THIRD';
					}
					
				}



				function printinvoice() {
					window.open("printing.php?inv=<?php echo isset($fee_print['sno'])?$fee_print['sno']:'';?>");
				}
				function get_subject(class_name){
					if(class_name==91){// class_name>=76 && class_name<=81 || class_name>=52 && class_name<=59 || class_name==45 || class_name==28){
						document.getElementById('fees').style.display='block';
					}
					else{
						document.getElementById('fees').style.display='none';
					}
					
					if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp=new XMLHttpRequest();
					}
					else{// code for IE6, IE5
						xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
					}
					
					xmlhttp.onreadystatechange=function(){
						if (xmlhttp.readyState==4 && xmlhttp.status==200){
							var v = xmlhttp.responseText;
							v = JSON.parse(v);
							//console.log(v);
							//alert(v);
							//var v = v.split('#');
							//console.log(v[6]);
							if(v['class_category']=='PG' || v['class_type']=='aided' || v['class_type']=='PG'){
								document.getElementById('prev_univ_li').style.display = 'block';
							}
							else{
								document.getElementById('prev_univ_li').style.display = 'none';
							}
							if(v['computer']==''){
								document.getElementById('computer').style.display = 'none';
							}
							else{
								document.getElementById('computer').style.display = 'block';
							}
							if(v['self']==''){
								document.getElementById('self').style.display = 'none';
							}
							else{
								document.getElementById('self').style.display = 'block';
							}
							if(v['tour']==''){
								document.getElementById('tour').style.display = 'none';
							}
							else{
								document.getElementById('tour').style.display = 'block';
							}
							if(v['vocational']=='' || v['vocational']==null){
								document.getElementById('vocational').style.display = 'none';
							}
							else{
								document.getElementById('vocational').style.display = 'block';
							}
							if(v['class_type']=='SELF'){
								document.getElementById('fees_detail').style.display='block';
								document.getElementById('fees_value').innerHTML=v['fees'];
								document.getElementById('max_discount').innerHTML=v['discount'];
								v['fees'] = parseFloat(v['fees'])?parseFloat(v['fees']):0;
								v['discount'] = parseFloat(v['discount'])?parseFloat(v['discount']):0;
								v['fix_amount'] = parseFloat(v['fix_amount'])?parseFloat(v['fix_amount']):0;
								document.getElementById('fees_deposit').value=(v['fees']-v['discount'])+v['fix_amount'];
								document.getElementById('fix_amount').value=(v['fees']-v['discount']);
							}
							document.getElementById('sub1').innerHTML=v['subjects'];
							<?php 
							if(isset($_POST['sub1'])){
								echo "document.getElementById('sub1').value = '".$_POST['sub1']."';";
							}
							?>
							//alert(v[2]);
							if(v['class_category']!='PG' && v['class_type']!='self'){
								document.getElementById('sub2').innerHTML=v['subjects']+'<option value=""></option>';
								<?php 
								if(isset($_POST['sub2'])){
									echo "document.getElementById('sub2').value = '".$_POST['sub2']."';";
								}
								?>
								if(class_name == 3|| class_name == 6 || class_name == 9 || class_name == 35){
									document.getElementById('sub3').innerHTML='';
								}
								else {
									document.getElementById('sub3').innerHTML=v['subjects'];
									<?php 
									if(isset($_POST['sub3'])){
										echo "document.getElementById('sub3').value = '".$_POST['sub3']."';";
									}
									?>
								}
							}
							else{
								document.getElementById('sub2').innerHTML='';
								document.getElementById('sub3').innerHTML='';
							}
						}
					}
					xmlhttp.open("GET","get_subject.php?q="+class_name,true);
					xmlhttp.send();
					get_session(class_name);
				}
					
				function get_session(class_name){
					if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp1=new XMLHttpRequest();
					}
					else{// code for IE6, IE5
						xmlhttp1=new ActiveXObject("Microsoft.XMLHTTP");
					}
					xmlhttp1.onreadystatechange=function(){
						if (xmlhttp1.readyState==4 && xmlhttp.status==200){
							var v = xmlhttp1.responseText;
							//console.log("Test: "+v);
							v = JSON.parse(v);
							document.getElementById("batch").value = v['session_from']+'-'+v['session_to'];			
						}
					}
					xmlhttp1.open("GET","get_session.php?q="+class_name,true);
					xmlhttp1.send();
				}
					
				function check_discount(val){
					var fees = (!parseFloat(document.getElementById('fees_value').innerHTML))?0:parseFloat(document.getElementById('fees_value').innerHTML);
					var max_discount = (!parseFloat(document.getElementById('max_discount').innerHTML))?0:parseFloat(document.getElementById('max_discount').innerHTML);
					var fees_discount = (!parseFloat(document.getElementById('fees_discount').value))?0:parseFloat(document.getElementById('fees_discount').value);
					
					if(fees_discount>max_discount){
						alert('Discount Not Allowd.');
						document.getElementById('fees_discount').value = '';
						document.getElementById('fees_discount').focus();
					}
					else{
						var final_fees = fees-fees_discount;
					}
					document.getElementById('final_fees').innerHTML = final_fees;
					document.getElementById('fees_deposit').value = final_fees;
					document.getElementById('final_fees_value').value = final_fees;

					
				}

				function check_deposit(val){
					var fees_deposit = (!parseFloat(document.getElementById('fees_deposit').value))?0:parseFloat(document.getElementById('fees_deposit').value);
					var fix_amount = (!parseFloat(document.getElementById('fix_amount').value))?0:parseFloat(document.getElementById('fix_amount').value);
					if(fees_deposit<fix_amount){
						alert('Deposit amount is less than fix amount.');
						document.getElementById('fees_deposit').value = '';
					}
				}
					
				function isNumberKey(evt)
					  {
						 var charCode = (evt.which) ? evt.which : event.keyCode
						 if (charCode > 31 && (charCode < 48 || charCode > 57))
							return false;

						 return true;
					  }
					function fnTXTFocus(id)
					{

						var objTXT = document.getElementById(id)
						objTXT.style.borderColor = "Red";

					}

					function fnTXTLostFocus(id)
					{
						var objTXT = document.getElementById(id)
						objTXT.style.borderColor = "green";
					}
				window.onload = function(){
					<?php
					if(isset($_POST['s_class'])){
						echo "get_subject(".$_POST['s_class'].");";
					}
					?>
				};
				</script>
				<script type="text/javascript">
					function copy_address(){
						var address = document.getElementById('t_address').value;
						document.getElementById('address').value = address;
					}
				</script>
			</form>
		</div>
	</div>
</div>  
<script>

	$(document).ready(function(){
		let selected_value = $("#course_type").val();
			//console.log(selected_value);

			$.ajax({
    			url: 'ajax_course_applied_for.php',
    			method: 'GET',
				data : {selected_value: selected_value, id: <?php echo $_GET['id']?>},
    			success: function(data){
					$("#course_applying_for").html(data);
    			}
    		});
	})
</script>
<script>
    // Initialize the display state of fields when the page loads
    document.addEventListener("DOMContentLoaded", function () {
        for (var i = 1; i < 5; i++) {
            toggleFields(i);
        }
    });

    function toggleFields(row) {
        var selectedOption = document.getElementById('select' + row).value;
        var obtMarks = document.getElementById(row + '_obt');
        var totMarks = document.getElementById(row + '_total');
        var perc = document.getElementById(row + '_perc');
        //var division = document.getElementById(row + '_division');
        var cgpa = document.getElementById(row + '_cgpa');

        if (selectedOption === 'percentage') {
            obtMarks.style.display = 'block';
            totMarks.style.display = 'block';
            perc.style.display = 'block';
            //division.style.display = 'block';
            cgpa.style.display = 'none';
        } else if (selectedOption === 'cgpa') {
            obtMarks.style.display = 'none';
            totMarks.style.display = 'none';
            perc.style.display = 'none';
            //division.style.display = 'none';
            cgpa.style.display = 'block';
        } else {
            obtMarks.style.display = 'none';
            totMarks.style.display = 'none';
            perc.style.display = 'none';
            //division.style.display = 'none';
            cgpa.style.display = 'none';
        }
    }
</script>
<script>
    // Get references to the course type dropdown and education details container
    const courseTypeDropdown = document.getElementById('course_type');
    const educationDetailsContainer = document.getElementById('educationDetailsContainer');

    // Function to show or hide education details rows based on the selected course type
    function toggleEducationDetails() {
        const selectedCourseType = courseTypeDropdown.value;

        // Check the selected course type and toggle visibility accordingly
        if (selectedCourseType === 'UG') {
            // Show only "High School" and "Intermediate" rows
            showOnlyHighSchoolAndIntermediateRows();
        } else if (selectedCourseType === 'PG') {
            // Show all rows
            showAllRows();
        } else {
            // Hide all rows if no course type is selected
            hideAllRows();
        }
    }

    // Function to show only "High School" and "Intermediate" rows
    function showOnlyHighSchoolAndIntermediateRows() {
        // Your logic to show only relevant rows here
        // For example, you can set the display property of rows accordingly
    }

    // Function to show all rows
    function showAllRows() {
        // Your logic to show all rows here
        // For example, you can set the display property of rows accordingly
    }

    // Function to hide all rows
    function hideAllRows() {
        // Your logic to hide all rows here
        // For example, you can set the display property of rows to 'none'
    }

    // Add an event listener to the course type dropdown to trigger the toggle function
    courseTypeDropdown.addEventListener('change', toggleEducationDetails);

    // Initially, call the toggle function to set the initial visibility based on the default selection
    toggleEducationDetails();
</script>
</div>
<?php
// page_footer();
ob_end_flush();
?>


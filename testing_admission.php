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
<!---
<script type="text/javascript" src="js/webcam.js"></script>
<div id="content">    	
				<form action="admission_newadmission.php" class="wufoo leftLabel page1" name="admission_newadmission" enctype="multipart/form-data" method="post" onSubmit="" >
					<h2> New Admission</h2>
					<?php //echo $msg; ?>
					<table width="100%">
						<tr>
							<td>Sr No</td>
							<td><input type="text" name="sr_no" id="sr_no" class="fieldtextmedium" value="" tabindex="<?php //echo $tabindex++;?>" /></td>
							<td>Class &amp; Section</td>
							<td>
								<select class="select" name="classsection" id="classsection" onChange='get_subject(this.value)' tabindex="<?php //echo $tabindex++;?>">
								<option value=""></option>
								<?php
								// $sql = 'select * from section';
								// $res = execute_query($sql);
								// print_r($res);
								// if($res){
								// while($row = mysqli_fetch_array($res)) {
									// echo "hello";
									// print_r($row);
									// $sql1 = execute_query('select * from class where sno="'.$row['class_desc'].'"');
									// if($sql1){
										// $result = mysqli_fetch_array($sql1);
									// print_r($result);
										// echo '<option value="'.(isset($row['sno'])?$row['sno']:'').'" >'.(isset($result['class_desc'])?$result['class_desc']:'').' '.(isset($row['section'])?$row['section']:'').'</option>';
									// }
								// }
								// }
								//echo '</select></div>';
								?>

							</td>
							<td colspan="2" rowspan="7" align="right">
								<div style="width:225px; height:175px; border:1px solid; text-align:center; float:left;" id="profile">
									<img src="" height="175" width="225"><input name="profile_name" value="" type="hidden">
								</div>
								<div style="width:225px; border:1px solid; text-align:center; float: right;">
									<script language="JavaScript">
									document.write( webcam.get_html(225, 175) );
									</script>
									
									<input value="Take Snapshot" onclick="take_snapshot()" style="width:150px;" type="button">
									&nbsp;&nbsp;
									<input value="Con." onclick="webcam.configure()" style="width:35px;" type="button">
									<div id="upload_results" style="background-color:#eee;"></div>
								</div>
							</td>
						</tr>
						<tr>
							<td>Student Name</td>
							<td><input type="text" name="student_name" id="student_name" class="fieldtextmedium"  value="<?php //echo $res['stname']; ?>" tabindex="<?php //echo $tabindex++;?>"/></td>
							<td>Date of Birth</td>
							<td><script>DateInput('dob', false, 'YYYY-MM-DD', '<?php //echo date("Y-m-d") ?>', <?php //echo $tabindex++; $tabindex += 3; ?>)</script></td>
						</tr>
						<tr>
							<td>Gender</td>
							<td><select name="gender" id="gender" class="select" tabindex="<?php //echo $tabindex++;?>">
							<option value="M" >Male</option>
							<option value="F" >Female</option>
							</select></td>
							<td>Father Name</td>
							<td><input type="text" name="father_name" id="father_name" class="fieldtextmedium" value="<?php //echo $res['fname']?>" tabindex="<?php //echo $tabindex++;?>"/></td>
						</tr>
						<tr>
							<td>Mother Name</td>
							<td><input type="text" name="mother_name" id="mother_name" class="fieldtextmedium" value="" tabindex="<?php //echo $tabindex++;?>"/></td>
							<td>Category</td>
							<td>
							<select name="category" id="category" class="select" tabindex="<?php //echo $tabindex++;?>">
							<option value="GEN" >General</option>
							<option value="OBC" >OBC</option>
							<option value="SC" >SC</option>
							<option value="ST" >ST</option>
							</select>								
							</td>
						</tr>
						<tr>
							<td>Religion</td>
							<td>
							<select name="religion" id="religion" class="select" tabindex="<?php //echo $tabindex++;?>">
							<option value="HINDU" >HINDU</option>
							<option value="MUSLIM" >MUSLIM</option>
							<option value="SIKH" >SIKH</option>
							<option value="CHRISTIAN" >CHRISTIAN</option>
							<option value="CHRISTIAN" >OTHER</option>
							</select>								
							</td>
							<td>Caste</td>
							<td><input type="text" name="caste" id="caste" class="fieldtextmedium" value="" tabindex="<?php //echo $tabindex++;?>"/></td>
						</tr>
						<tr>
							<td>Local Address</td>
							<td><input type="text" name="t_address" id="t_address" class="fieldtextmedium" value="<?php //echo $res['address']?>" tabindex="<?php //echo $tabindex++;?>"/></td>
							<td>Permanent Address</td>
							<td><input type="text" name="address" id="address" class="fieldtextmedium"value="<?php //echo $res['address']?>" tabindex="<?php //echo $tabindex++;?>"/></td>
						</tr>
						<tr>
							<td>Phone No.</td>
							<td><input type="text" name="phoneno" id="phoneno" class="fieldtextmedium"  value="" tabindex="<?php //echo $tabindex++;?>"/></td>
							<td>Mobile No.</td>
							<td><input type="text" name="mobileno" id="mobileno" class="fieldtextmedium" value="<?php //echo $res['mobile_no']?>" tabindex="<?php //echo $tabindex++;?>"/></td>
						</tr>
						<tr>
						<td>Father Occupation</td>
						<td><input type="text" name="fatheroccupation" id="fatheroccupation" class="fieldtextmedium" value="" tabindex="<?php //echo $tabindex++;?>"/>
						</td>
						<td>Mother Occupation </td>
						<td><input type="text" name="motheroccupation" id="motheroccupation" class="fieldtextmedium" value="" tabindex="<?php //echo $tabindex++;?>"/>
						</td>
						<td>Upload Application Form</td>
						<td><input type="file" name="application_upload"></td>
						</tr>

						<tr>
						<td>Father Qualification</td>
						<td><input type="text" name="father_quali" id="father_quali" class="fieldtextmedium" value="" tabindex="<?php //echo $tabindex++;?>"/>
						</td>
						<td>Mother Qualification</td>
						<td><input type="text" name="mother_quali" id="mother_quali" class="fieldtextmedium" value=""tabindex="<?php //echo $tabindex++;?>"/>
						</td>
						<td>Upload Character Certificate</td>
						<td><input type="file" name="cc_upload"></td>
						</tr>

						<tr>
						<td>Previous School</td>
						<td><input type="text" name="pre_school" id="pre_school" class="fieldtextmedium" value="" tabindex="<?php //echo $tabindex++;?>"/>
						</td>
						<td>TC Number</td>
						<td><input type="text" name="tc_num" id="tc_num" class="fieldtextmedium" value="" tabindex="<?php //echo $tabindex++;?>"/>
						</td>
						<td>Upload Transfer Certificate</td>
						<td><input type="file" name="tc_upload"></td>
						</tr>

						<tr>
						<td>TC Class</td>
						<td><input type="text" name="tc_class" id="tc_class" class="fieldtextmedium" value="" tabindex="<?php //echo $tabindex++;?>"/>
						</td>
						<td>Elder Relative</td>
						<td><input type="text" name="elder_relative" id="elder_relative" class="fieldtextmedium" tabindex="<?php //echo $tabindex++;?>"/>
						</td>
						</tr>

						<tr>
						<td>Identification Mark</td>
						<td><input type="text" name="identification" id="identification" class="fieldtextmedium" value=""  tabindex="<?php //echo $tabindex++;?>"/></td>
						<td>Remarks</td>
						<td><input type="text" name="remark" id="remark" class="fieldtextmedium" value="" tabindex="<?php //echo $tabindex++;?>"/></td>
						</tr>
						<tr>
						<td>Status</td>
						<td>	<select name="status" id="status" class="select" tabindex="<?php //echo $tabindex++;?>">
						<option value="reguler" >Regular</option>
						<option value="private" >Private</option>
						</select></td>
						<td> Student Status</td>
						<td>	<select name="stu_status" id="stu_status" class="select" tabindex="<?php //echo $tabindex++;?>">
						<option value="0" >Normal</option>
						<option value="1" >Staff</option>
						</select></td>
						</tr>
						
						<tr>
						<td>TC Date</td>
						<td><script>DateInput('tcdate', false, 'YYYY-MM-DD', '<?php //echo date("Y-m-d") ?>', <?php //echo $tabindex++; $tabindex += 3;?>)</script>
						</td>
						<td> Date Of Admission</td>
						<td><script>DateInput('admissiondate', false, 'YYYY-MM-DD', '<?php //echo date("Y-m-d") ?>', <?php //echo $tabindex++; $tabindex += 3;?>)</script></td>
						</tr>						
					</table>

					<li id="supplier_id" class="notranslate"> <input type="submit" class="btTxt submit" name="submit" value="Submit" onClick="return confirmSubmit()"/>
					<div><input type="hidden" name="id" id="id" value="<?php //echo $_REQUEST['id'];?>" /></div>
					</form>
					</div>
					
	<script language="JavaScript">
	webcam.set_api_url( 'camera.php' );
	webcam.set_quality( 90 ); // JPEG quality (1 - 100)
	webcam.set_shutter_sound( true ); // play shutter click sound
	webcam.set_hook( 'onComplete', 'my_completion_handler' );

	function take_snapshot(){
		// take snapshot and upload to server
		document.getElementById('upload_results').innerHTML = '<h3>Uploading...</h3>';
		webcam.snap();
	}

	function my_completion_handler(msg) {
		// extract URL out of PHP output
		// show JPEG image in page
		document.getElementById('upload_results').innerHTML ='<h3>Upload Successful!</h3>';
		document.getElementById('profile').innerHTML = '<img src="'+msg+'" height="175" width="225"><input type="hidden" name="profile_name" value="'+msg+'">';
		// reset camera for another shot
		webcam.reset();
	}
</script>				
				---------->

<?php
if(isset($_POST['submit'])) {
	$target_path_photo = 'student_admission_images/'.date('Y').'/'.date('m').'/'.'photo/' ;	 
	$target_path_signature = 'student_admission_images/'.date('Y').'/'.date('m').'/'.'signature/' ;	 
	$sql = 'INSERT INTO `admission_student_info`(`sno`,`candidate_name`, `father_name`, `mother_name`, `dob`, `aadhar`, `gender`, `mobile`, `email`, `course_type`, `course_applying_for`, `religion`, `category`, `caste`, `remark`, `status`, `parent_income`, `domicile`, `mother_tongue`, `weightage`, `blood_group`) values("'.
			$_POST['id'].'","'.
			$_POST['candidate_name'].'","'.
			$_POST['father_name'].'","'.
			$_POST['mother_name'].'","'.
			$_POST['dob'].'","'.
			$_POST['aadhar'].'","'.
			$_POST['gender'].'","'.
			$_POST['mobile'].'","'.
			$_POST['email'].'","'.
			$_POST['course_type'].'","'.
			$_POST['course_applying_for'].'","'.
			$_POST['religion'].'","'.
			$_POST['category'].'","'.
			$_POST['caste'].'","'.
			$_POST['remark'].'","'.
			$_POST['status'].'","'.
			$_POST['parent_income'].'","'.
			$_POST['domicile'].'","'.
			$_POST['mother_tongue'].'","'.
			$_POST['weightage'].'","'.
			$_POST['blood_group'].'")';
			
	execute_query($sql,$db);
	//echo $sql;
	if(mysqli_error($db)){
			$rs=0;
			$msg .= '<li>'.mysqli_error($db).' >> '.$sql.'</li>';
	}
	else{
		$rs=1;
		$id=mysqli_insert_id($db);
	}
	if($rs==1){
		if(isset($_FILES['photo']) && $_FILES['photo']['name']!=''){
			$result = upload_img($_FILES['photo'],$target_path_photo,$id);
			$sql = execute_query('update admission_student_info set 
				photo = "'.$target_path_photo.$result['file_name'].'" where sno = '.$id, $db);
			if(mysqli_error($db)){
				$rs=0;
				$msg .= '<li>Photo upload Failed'.mysqli_error($db).' >> '.$sql.'</li>';
			}
			else{
				$msg .= '<li>Photo Uploaded successfully</li>';
			}

		}
		if(isset($_FILES['signature']) && $_FILES['signature']['name']!=''){
			$result = upload_img($_FILES['signature'],$target_path_signature,$id);
			$sql = execute_query('update admission_student_info set 
				signature = "'.$target_path_signature.$result['file_name'].'" where sno = '.$id, $db);
			if(mysqli_error($db)){
				$rs=0;
				$msg .= '<li>Signature upload Failed'.mysqli_error($db).' >> '.$sql.'</li>';
			}
			else{
				$msg .= '<li>Signature Uploaded successfully</li>';
			}
		}
	}
	if($rs==1) { 
		if(isset($_POST['qualification_no']) ){
			for($i=1; $i<=$_POST['qualification_no']; $i++){
				if($_POST['part_desc'.$i.'_board']!='' ){
					$sql = execute_query('insert into admission_qualification(d_student_info_sno,name_of_examination,board_university_name,college_name,year,roll_no,obtained_marks,total_marks,percentage,division,status,created_by,creation_time)values("'.
					$id.'","'.
					$_POST['part_desc'.$i].'","'.
					$_POST['part_desc'.$i.'_board'].'","'.
					$_POST['part_desc'.$i.'_college'].'","'.
					$_POST['part_desc'.$i.'_year'].'","'.
					$_POST['part_desc'.$i.'_rollno'].'","'.
					$_POST['part_desc'.$i.'_obtmarks'].'","'.
					$_POST['part_desc'.$i.'_totmarks'].'","'.
					$_POST['part_desc'.$i.'_percentage'].'","'.
					$_POST['part_desc'.$i.'_division'].'","'.
					$_POST['part_desc'.$i.'_status'].'","'.
					$_SESSION['username'].'","'.
					date('Y-m-d H:m:s').
					'")',$db);

					if(mysqli_errno($db)){
						$rs=0;
						$msg .= '<li>'.mysqli_error($db).' >> '.$sql.'</li>';
					}
				}
			}
		}
		if(isset($_POST['p_address']) && $_POST['p_address']!=''){
			
			$sql = execute_query('insert into admission_address(d_student_info_sno,type_of_address,address,post,district,state,tehsil,thana,pin,created_by,creation_time)values("'.
			$id.'","permanent","'.
			$_POST['p_address'].'","'.
			$_POST['p_post'].'","'.
			$_POST['p_district'].'","'.
			$_POST['p_state'].'","'.
			$_POST['p_tehsil'].'","'.
			$_POST['p_thana'].'","'.
			$_POST['p_pin'].'","'.
			$_SESSION['username'].'","'.
			date('Y-m-d H:m:s').
			'")',$db);
			
			if(mysqli_errno($db)){
				$rs=0;
				$msg .= '<li>'.mysqli_error($db).' >> '.$sql.'</li>';
			}
		}
		if(isset($_POST['c_address']) && $_POST['c_address']!=''){
			
			$sql = execute_query('insert into admission_address(d_student_info_sno,type_of_address,address,post,district,state,tehsil,thana,pin,created_by,creation_time)values("'.
			$id.'","correspondence","'.
			$_POST['c_address'].'","'.
			$_POST['c_post'].'","'.
			$_POST['c_district'].'","'.
			$_POST['c_state'].'","'.
			$_POST['c_tehsil'].'","'.
			$_POST['c_thana'].'","'.
			$_POST['c_pin'].'","'.
			$_SESSION['username'].'","'.
			date('Y-m-d H:m:s').
			'")',$db);
			if(mysqli_errno($db)){
				$rs=0;
				$msg .= '<li>'.mysqli_error($db).' >> '.$sql.'</li>';
			}
			else{
				$msg .= '<li>Data Inserted successfully</li>';
			}
		}
		
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
		$_POST['remark'] = '';
		$_POST['status'] = '';
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
		echo '<script>alert("Form submitted Successfully")</script>';
		header('location: admission_form_print.php?id='.$id);
	}			
	else {
		$msg .= '<li id="li">Please Correct Errors.</li>';
	}
}
else{
	// $_POST['sr_no'] = '';
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
	$_POST['remark'] = '';
	$_POST['status'] = '';
	$_POST['parent_income']='';
	$_POST['domicile']='';
	$_POST['mother_tongue']='';
	$_POST['weightage']='';
	$_POST['blood_group']='';
	$_POST['stu_status'] = '';
	$_FILES['photo'] = '';
	$_FILES['signature'] = '';
	
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
	
}
if(isset($_GET['id']) && $_GET['id']!='' ){
	$sql = execute_query('select  * from new_student_info where sno = '.$_GET['id'], $db);
	if($sql){
		$data = mysqli_fetch_assoc($sql);
	}
	//print_r($data);

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
				<form action="admission_form.php" class="wufoo leftLabel page1" name="admission_newadmission" enctype="multipart/form-data" method="post" onSubmit="" >
				<?php echo $msg; ?>	
					<div class=" card card-body col-md-11 my-auto mx-auto" style="border-top-color: #d2d6de; background-color:whitesmoke;" >
					
						<div class="row mt-1">							
							<div class="col-md-6">							
								<label>Candidate Name</label>
								<input type="text" name="candidate_name" id="candidate_name" class="form-control " value="<?php echo isset($_GET['id'])? $data['candidate_name'] : '' ?>" tabindex="<?php echo $tabindex++;?>" style="pointer-events:none ;" required/>
							</div>
							<div class="col-md-6">							
								<label>Father&#39;s Name</label>
								<input type="text" name="father_name" id="father_name" class="form-control " value="<?php echo isset($_GET['id'])? $data['father_name'] : '' ?>" style="pointer-events:none ;" required/>
							</div>
						</div>
						<div class="row mt-1">
							<div class="col-md-6">							
								<label>Mother&#39;s Name</label>
								<input type="text" name="mother_name" id="mother_name" class="form-control " style="pointer-events:none ;" value="<?php echo isset($_GET['id'])? $data['mother_name'] : '' ?>" required/>
							</div>
							<div class="col-md-6">							
								<label>Date of Birth</label>
								<script>DateInput('dob', false, 'YYYY-MM-DD', '<?php if(isset($_GET['id'])){echo $data['dob'];}else{echo date("Y-m-d");}?>', <?php echo $tabindex++; $tabindex += 3; ?>)</script>
							</div>
						</div>
						<div class="row mt-1">
							<div class="col-md-6">
								<label>Aadhar</label>
								<input type="text" name="aadhar" style="pointer-events:none ;" id="aadhar" class="form-control " value="<?php echo isset($_GET['id'])? $data['aadhar'] : '' ?>" tabindex="<?php echo $tabindex++;?>" style="pointer-events:none ;" required/>
							</div>
							<div class="col-md-6">							
								<label>E-Mail</label>
								<input type="text" name="email" id="email" class="form-control " value="<?php echo isset($_GET['id'])? $data['email'] : '' ?>" style="pointer-events:none ;"  required/>
							</div>
						</div>
						<div class="row mt-1">
							<div class="col-md-6">							
								<label>Mobile</label>
								<input type="text" name="mobile" id="mobile" class="form-control " value="<?php echo isset($_GET['id'])? $data['mobile'] : '' ?>" style="pointer-events:none ;" required/>
							</div>
							<div class="col-md-6">							
								<label>Course Type</label>
								<!-- <input type="text" name="course_type" id="course_type" class="form-control " value="<?php echo isset($_GET['id'])? $data['course_type'] : '' ?>" placeholder="" style="pointer-events:none ;"/> -->
								<select name="course_type" id="course_type" value="<?php echo $data['course_type']?>" class="form-control" style="pointer-events: none;" required>
										<option disabled <?php echo isset($_GET['id'])? "":' selected = "selected" '?>>---Select Your Course Type---</option>
										<?php 
											$sql  = 'select * from mst_course_type';
											$dept_list = execute_query( $sql);
											if($dept_list){
												while($list = mysqli_fetch_assoc($dept_list)){
													echo '<option  value = "'.$list['sno'].'" '.(isset($_GET['id']) && $data['course_type'] == $list['sno'] ? ' selected = "selected" ':"").'>'.$list['course_type'].'</option>';
												}
											}
										?>
								</select>
							</div>
						</div>
						<div class="row mt-1">							
							<div class="col-md-6">							
								<label>Course Applying for</label>
								<!-- <input type="text" name="course_applying_for" id="course_applying_for" class="form-control " value="<?php echo isset($_GET['id'])? $data['course_applying_for'] : '' ?>" style="pointer-events:none ;"/> -->
								<select name="course_applying_for" id="course_applying_for" value="" class="form-control" style="pointer-events: none;" required >
									
								</select>												
							</div>
							<div class="col-md-6">							
								<label>Category</label>
								<select name="category" id="category" class="form-control" tabindex="<?php echo $tabindex++;?>" style="pointer-events: none;" required>
								<option disabled <?php echo isset($_GET['id'])? "":' selected = "selected" '?>>---Select Your Category---</option>
									<option value="GEN" <?php if(isset($_GET['id']) && $data['category']=="GEN"){ echo 'selected ';}?>>General</option>
									<option value="OBC" <?php if(isset($_GET['id']) && $data['category']=="OBC"){ echo 'selected ';}?>>OBC</option>
									<option value="SC" <?php if(isset($_GET['id']) && $data['category']=="SC"){ echo 'selected ';}?>>SC</option>
									<option value="ST" <?php if( isset($_GET['id']) && $data['category']=="ST"){ echo 'selected ';}?>>ST</option>
								</select>
							</div>
						</div>
						<div class="row mt-1">
							<div class="col-md-6">							
								<label>Religion</label>
								<select name="religion" id="religion" class="form-control" tabindex="<?php echo $tabindex++;?>" required>
								<option disabled <?php echo isset($_GET['id'])? "":' selected = "selected" '?>>---Select Your Religion---</option>
									<option value="HINDU" <?php if($_POST['religion']=="HINDU"){ echo 'selected ';}?>>HINDU</option>
									<option value="MUSLIM" <?php if($_POST['religion']=="MUSLIM"){ echo 'selected ';}?>>MUSLIM</option>
									<option value="SIKH" <?php if($_POST['religion']=="SIKH"){ echo 'selected ';}?>>SIKH</option>
									<option value="CHRISTIAN" <?php if($_POST['religion']=="CHRISTIAN"){ echo 'selected ';}?>>CHRISTIAN</option>
								</select>
							</div>
							<div class="col-md-6">
								<label>Gender</label>
								<select name="gender" id="gender" class="form-control" tabindex="" required>
								<option disabled selected>---Select Your Gender---</option>
									<option value="male" <?php if($_POST['gender']=="male"){ echo 'selected ';}?>>Male</option>
									<option value="Female" <?php if($_POST['gender']=="female"){ echo 'selected ';}?>>Female</option>
									<option value="other" <?php if($_POST['gender']=="other"){ echo 'selected ';}?>>Transgender</option>
								</select>
							</div>
						</div>
						<div class="row mt-1">
							<div class="col-md-6">	
								<label>Caste</label>
								<input type="text" name="caste" id="caste" class="form-control " value="" required/>
							</div>
							<div class="col-md-6">
								<label>Remark</label>
								<input type="text" name="remark" id="remark" class="form-control " value="" tabindex="" />
							</div>
						</div>
						<div class="row mt-1">
							<div class="col-md-6">							
								<label>PARENT'S INCOME</label>
								<input type="text" name="parent_income" id="parent_income" class="form-control " value="" 	required/>
							</div>
							<div class="col-md-6">							
								<label>DOMICILE</label>
								<!-- <input type="text" name="course_type" id="course_type" class="form-control " value="<?php echo isset($_GET['id'])? $data['domicile'] : '' ?>" placeholder="" style="pointer-events:none ;"/> -->
								<select name="domicile" id="domicile" value="" class="form-control"  required>
										<option  <?php echo isset($_GET['id'])? "":' selected = "selected" '?>>---Select Your Course Type---</option>
										<?php 
											$sql  = 'select * from mst_domicile';
											$dept_list = execute_query( $sql);
											if($dept_list){
												while($list = mysqli_fetch_assoc($dept_list)){
													echo '<option  value = "'.$list['sno'].'" '.(isset($_GET['id'])&& isset($data['domicile']) && $data['domicile'] == $list['sno'] ? ' selected = "selected" ':"").'>'.$list['domicile'].'</option>';
												}
											}
										?>
								</select>
							</div>
						</div>
						<div class="row mt-1">
							<div class="col-md-6">							
								<label>MOTHER TONGUE</label>
								<input type="text" name="mother_tongue" id="mother_tongue" class="form-control " value="<?php echo (isset($_GET['id']) && isset($data['mother_tongue']))? $data['mother_tongue'] : '' ?>" 	required/>
							</div>
							<div class="col-md-6">							
								<label>WEIGHTAGE </label>
								<select name="weightage" id="weightage" class="form-control" required>
									<option  selected>---Select Your Weightage---</option>
									<option value="ncc" <?php echo (isset($_GET['id']) && isset($data['weightage']) && $data['weightage']=='ncc') ? 'selected="selected"' : ''; ?>>NCC</option>
									<option value="freedom_fighters" <?php echo (isset($_GET['id']) && isset($data['weightage']) && $data['weightage']=='freedom_fighters') ? 'selected="selected"' : ''; ?>>Freedom Fighters</option>
									<option value="sports_achievements" <?php echo (isset($_GET['id']) && isset($data['weightage']) && $data['weightage']=='sports_achievements') ? 'selected="selected"' : ''; ?>>Sports Achievements</option>
									<option value="cultural_activities" <?php echo (isset($_GET['id']) && isset($data['weightage']) && $data['weightage']=='cultural_activities') ? 'selected="selected"' : ''; ?>>Cultural Activities</option>
									<option value="social_work" <?php echo (isset($_GET['id']) && isset($data['weightage']) && $data['weightage']=='social_work') ? 'selected="selected"' : ''; ?>>Social Work</option>
									<option value="volunteering" <?php echo (isset($_GET['id']) && isset($data['weightage']) && $data['weightage']=='volunteering') ? 'selected="selected"' : ''; ?>>Volunteering</option>
									<option value="not_applicable" <?php echo (isset($_GET['id']) && isset($data['weightage']) && $data['weightage']=='not_applicable') ? 'selected="selected"' : ''; ?>>Not applicable </option>
								</select>
							</div>
						</div>
						<div class="row mt-1">
							<div class="col-md-6">							
								<label>Blood Group</label>
								<select name="blood_group" id="blood_group" class="form-control" required>
									<option <?php echo isset($_GET['id'])? "":' selected = "selected" '?>>---Select Your Blood Group---</option>
									<option value="A+" <?php echo (isset($_GET['id'])  && isset($data['blood_group']) && $data['blood_group']=='A+') ? 'selected="selected"' : ''; ?>>A+</option>
									<option value="A-" <?php echo (isset($_GET['id']) && isset($data['blood_group']) && $data['blood_group']=='A-') ? 'selected="selected"' : ''; ?>>A-</option>
									<option value="B+" <?php echo (isset($_GET['id']) && isset($data['blood_group']) && $data['blood_group']=='B+') ? 'selected="selected"' : ''; ?>>B+</option>
									<option value="B-" <?php echo (isset($_GET['id']) && isset($data['blood_group']) && $data['blood_group']=='B-') ? 'selected="selected"' : ''; ?>>B-</option>
									<option value="AB+" <?php echo (isset($_GET['id']) && isset($data['blood_group']) && $data['blood_group']=='AB+') ? 'selected="selected"' : ''; ?>>AB+</option>
									<option value="AB-" <?php echo (isset($_GET['id']) && isset($data['blood_group']) && $data['blood_group']=='AB-') ? 'selected="selected"' : ''; ?>>AB-</option>
									<option value="O+" <?php echo (isset($_GET['id']) && isset($data['blood_group']) && $data['blood_group']=='O+') ? 'selected="selected"' : ''; ?>>O+</option>
									<option value="O-" <?php echo (isset($_GET['id']) && isset($data['blood_group']) && $data['blood_group']=='O-') ? 'selected="selected"' : ''; ?>>O-</option>
									<option value="N/A" <?php echo (isset($_GET['id']) && isset($data['blood_group']) && $data['blood_group']=='na') ? 'selected="selected"' : ''; ?>>N/A</option>
								</select>
							</div>
							<div class="col-md-6">	
								<label>Status</label>
								<select name="status" id="status" class="form-control" tabindex="" required>
									<option value="reguler" <?php echo (isset($_GET['id'])  && isset($data['status']) && $data['status']=='reguler') ? 'selected="selected"' : ''; ?>>Regular</option>
									<option value="private" <?php echo (isset($_GET['id'])  && isset($data['status']) && $data['status']=='private') ? 'selected="selected"' : ''; ?>>Private</option>
								</select>
							</div>
						</div>
						<div class="row mt-1">
							
							<div class="col-md-6">	
								<label>Photo Upload</label>
								<input type="file" name="photo" id="photo" class="form-control " value="" required/>
							</div>
							<div class="col-md-6">
								<label>Signature Upload</label>
								<input type="file" name="signature" id="signature" class="form-control " value="" tabindex="" required/>
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
			<h2 class="text-dark" >Education Details</h2>
		
		<table width="80%" class="table table-striped-success table-hover rounded ">
			<tr class="bg-secondary text-white" style='background-color: #F5F5F5 ;'>
				<th>S.No</th>
				<th>Name Of Examination</th>
				<th>Board/University Name</th>
				<th>College Name</th>
				<th>Year of Passing</th>
				<th>Roll No</th>
				<th>Percentage/CGPA</th>
				<th>Obtained Marks</th>
				<th>Total Marks</th>
				<th>Percentage/CGPA</th> 
				<th>Division</th>
				<th>Status</th>                 
			</tr>                
			<!---->
			
			<?php 
				for($i=1; $i<=5; $i++){
					if($i%2!=0){
				echo '<tr class="table-secondary">';
					}
					else{
						echo '<tr class="">';
					}
			?>
            	<td><?php echo $i; ?></td>
				<?php 
					if($i==1){
						echo '<td>High School<input type="hidden" name="part_desc'.$i.'"  value="High School"></td>';
					}
					elseif($i==2){
						echo '<td>Intermediate<input type="hidden" name="part_desc'.$i.'"  value="Intermediate"></td>';
					}
					elseif($i==3 || $i==4){
				?>
				<td>
				<select name="part_desc<?php echo $i; ?>" id="part_desc<?php echo $i; ?>" onBlur="tab_fill(1,8)" onFocus="getCurrent(<?php echo $i; ?>)" >
					<option value="<?php echo isset($_POST['part_desc'.$i])?$_POST['part_desc'.$i] :''; ?>" selected><?php if(isset($_POST['part_desc'.$i.''])){echo $_POST['part_desc'.$i.''];} ?></option>
				   
					<option value="B.Ed">B.Ed</option>
					<?php
						$sql = 'select * from class_detail order by sort_no, year';
						$result = execute_query($sql,$db);
						if($result){
							while($name = mysqli_fetch_array($result)){
								echo '<option value="'.$name['sno'].'" ';
								echo '>'.$name['class_description'].'</option>';
							}
						}
						?>
					</option>
				</select>
				</td>
				<?php
					}
					else{
						echo '<td>Others<input type="hidden" name="part_desc'.$i.'" value="others"></td>';
					}
					
				?>
                
                <td><input name="part_desc<?php echo $i; ?>_board" type="text" value="<?php if(isset($_POST['part_desc'.$i.'_board'])){echo $_POST['part_desc'.$i.'_board'];} ?>" class="fieldtextmedium" maxlength="100" id="part_desc<?php echo $i; ?>_board" /></td>
				<td><input name="part_desc<?php echo $i; ?>_college" type="text" value="<?php if(isset($_POST['part_desc'.$i.'_college'])){echo $_POST['part_desc'.$i.'_college'];} ?>" class="fieldtextmedium" maxlength="100" id="part_desc<?php echo $i; ?>_college" /></td>
				<td><input name="part_desc<?php echo $i; ?>_year" type="text" value="<?php if(isset($_POST['part_desc'.$i.'_year'])){echo $_POST['part_desc'.$i.'_year'];} ?>" class="fieldtextmedium" maxlength="6" id="part_desc<?php echo $i; ?>_year" /></td>
				<td><input name="part_desc<?php echo $i; ?>_rollno" type="text" value="<?php if(isset($_POST['part_desc'.$i.'_rollno'])){echo $_POST['part_desc'.$i.'_rollno'];} ?>" class="fieldtextmedium" maxlength="12" id="part_desc<?php echo $i; ?>_rollno" /></td>
				<td><select name="part_desc<?php echo $i; ?>_status" value="<?php if(isset($_POST['part_desc'.$i.'_status'])){echo $_POST['part_desc'.$i.'_status'];} ?> id="part_desc" onBlur="tab_fill(1,8)" onFocus="getCurrent(<?php echo $i; ?>)">
					<option value="percent">Percent</option>
					<option value="cgpa">CGPA</option>
				</select>
				</td>
				<div class="active">
					<td><input name="part_desc<?php echo $i; ?>_obtmarks" type="text" value="<?php if(isset($_POST['part_desc'.$i.'_obtmarks'])){echo $_POST['part_desc'.$i.'_obtmarks'];} ?>" class="fieldtextmedium" maxlength="6" id="<?php echo $i ?>_obt" /></td>
					<td><input name="part_desc<?php echo $i; ?>_totmarks" type="text" value="<?php if(isset($_POST['part_desc'.$i.'_totmarks'])){echo $_POST['part_desc'.$i.'_totmarks'];} ?>" class="fieldtextmedium" maxlength="6" onBlur="get_perc(<?php echo $i ?>)" id="<?php echo $i ?>_total" /></td>
					<td><input name="part_desc<?php echo $i; ?>_percentage" type="text" value="<?php if(isset($_POST['part_desc'.$i.'_percentage'])){echo $_POST['part_desc'.$i.'_percentage'];} ?>" class="fieldtextmedium" maxlength="6" id="<?php echo $i ?>_perc" OnBlur="get_division(<?php echo $i ?>)" /></td>
				</div>
				<div class="deactive">
					<td><input name="part_desc<?php echo $i; ?>_cgpa" type="text" value="<?php if(isset($_POST['part_desc'.$i.'_obtmarks'])){echo $_POST['part_desc'.$i.'_obtmarks'];} ?>" class="fieldtextmedium" maxlength="6" id="<?php echo $i ?>_obt" /></td>
				</div>
				<td><input name="part_desc<?php echo $i; ?>_division" type="text" value="<?php if(isset($_POST['part_desc'.$i.'_division'])){echo $_POST['part_desc'.$i.'_division'];} ?>" class="fieldtextmedium" maxlength="6" id="<?php echo $i ?>_division" /></td>              
                <td><select name="part_desc<?php echo $i; ?>_status" value="<?php if(isset($_POST['part_desc'.$i.'_status'])){echo $_POST['part_desc'.$i.'_status'];} ?> id="part_desc" onBlur="tab_fill(1,8)" onFocus="getCurrent(<?php echo $i; ?>)">
					<option value="Passed">Passed</option>
					<option value="Failed">Failed</option>
				</select>
				</td>
           </tr>
				<?php } ?>
			<!---->
			
		</table>
		
		<div>
			
			<div  name="info_table" id="info_table">
				<table width="100%" class="table table-striped-primary table-hover rounded ">	
					<tr class="bg-secondary text-white ">
						<th colspan="6" class="h5"><strong>Permanent Address</strong></th>
					</tr>
					<tr class="table-secondary">
						<th>House No./Village</th>
						<td><input type="text" class="form-control" id="p_address" name="p_address" value="<?php if(isset($_POST['p_address'])){echo $_POST['p_address'];} ?>"></td>
						<th>Post</th>
						<td><input type="text" class="form-control" id="p_post" name="p_post" value="<?php if(isset($_POST['p_post'])){echo $_POST['p_post'];} ?>" ></td>
						<th>Tahsil</th>
						<td><input type="text" class="form-control" id="p_tehsil" name="p_tehsil" value="<?php if(isset($_POST['p_tehsil'])){echo $_POST['p_tehsil'];} ?>"></td>
					</tr>
					<tr>
						<th>Thana</th>
						<td><input type="text" class="form-control" id="p_thana" name="p_thana" value="<?php if(isset($_POST['p_thana'])){echo $_POST['p_thana'];} ?>" ></td>
						<th>District</th>
						<td><input type="text" class="form-control" id="p_district" name="p_district" value="<?php if(isset($_POST['p_district'])){echo $_POST['p_district'];} ?>" ></td>
						<th>State</th>
						<td><input type="text" class="form-control" id="p_state" name="p_state" value="<?php if(isset($_POST['p_state'])){echo $_POST['p_state'];} ?>" ></td>
					</tr>
					<tr>
						
						<th>Pin</th>
						<td><input type="text" class="form-control"  id="p_pin" name="p_pin" value="<?php if(isset($_POST['p_pin'])){echo $_POST['p_pin'];} ?>"></td>
					</tr>
					<tr class="bg-secondary text-white">
						<th colspan="6" class="h5" >Correspondence Address <a href="javascript:copy_adr()" class="btn btn-primary" >Click Here to Copy</a></th>
					</tr>
					<tr class="table-secondary">
						<th>House No./Village</th>
						<td><input type="text" class="form-control" id="c_address" name="c_address" value="<?php if(isset($_POST['c_address'])){echo $_POST['c_address'];} ?>" ></td>
						<th>Post</th>
						<td><input type="text" class="form-control" id="c_post" name="c_post" value="<?php if(isset($_POST['c_post'])){echo $_POST['c_post'];} ?>" ></td>
						<th>Tahsil</th>
						<td><input type="text" class="form-control" id="c_tehsil" name="c_tehsil" value="<?php if(isset($_POST['c_tehsil'])){echo $_POST['c_tehsil'];} ?>"></td>
						
					</tr>
					<tr>
						<th>Thana</th>
						<td><input type="text" class="form-control" id="c_thana" name="c_thana" value="<?php if(isset($_POST['c_thana'])){echo $_POST['c_thana'];} ?>" ></td>
						<th>District</th>
						<td><input type="text" class="form-control" id="c_district" name="c_district" value="<?php if(isset($_POST['c_district'])){echo $_POST['c_district'];} ?>" ></td>
						<th>State</th>
						<td><input type="text" class="form-control" id="c_state" name="c_state" value="<?php if(isset($_POST['c_state'])){echo $_POST['c_state'];} ?>" ></td>
						
					</tr>
					<tr>
						
						
						<th>Pin</th>
						<td><input type="text" class="form-control"  id="c_pin" name="c_pin" value="<?php if(isset($_POST['c_pin'])){echo $_POST['c_pin'];} ?>"></td>
					</tr>
					
				</table>
			</div>
		</div>


		
		<table>
			<input type="hidden" name="qualification_no" value="<?php echo --$i; ?>" /><br/>
			<input type="hidden" name="id" id="id" value="<?php echo isset($_REQUEST['id'])? $_REQUEST['id']:"" ?>" />
			<button type="submit" class="btn btn-primary" name="submit" value="Submit" onClick="return confirmSubmit()">Submit</button>
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
					var obtmarks='',totmarks='', percentage='';
					//console.log(value);
					value = value.toString();
					obtmarks = value.concat("_obt")
					obtmarks = parseFloat(document.getElementById(obtmarks).value);
					totmarks = value.concat("_total");
					totmarks = parseFloat(document.getElementById(totmarks).value);
					percentage = value.concat("_perc");
					document.getElementById(percentage).value = Math.round((obtmarks/totmarks)*100);
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
</div>
<?php

// page_footer();
ob_end_flush();
?>


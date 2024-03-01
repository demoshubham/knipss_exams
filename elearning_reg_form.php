<?php
ob_start();
date_default_timezone_set('Asia/Calcutta');
session_cache_limiter('nocache');
session_start();
include("settings.php");

$response=1;
$tabindex=1;
$msg='';
if(isset($_POST)){
	foreach($_POST as $k=>$v){
		$_POST[$k] = htmlspecialchars($v);
	}
}
if(isset($_POST['register'])){
	$response=2;
}
if(isset($_POST['register1'])){
	$response=3;
}
if(isset($_GET['reg_no'])){
    $sql = 'select * from register_users where user_name="'.$_GET['reg_no'].'"';
    $register = mysqli_fetch_assoc(execute_query($sql));
    if($register['payment_status'] == 'Success'){
        echo '<script>alert("Payment Already Completed" )</script>';
		$response=1;
    }
    else{
    	$reg_no = $_GET['reg_no'];
    	$response = 4;
        
    }
}

///	$sup=dbconnect($_POST[$id]);
if(isset($_POST['login_button'])) {
	if($_POST['uin_no']!=''){	
		$sql = 'select * from student_info where university_uin="'.$_POST['uin_no'].'" and dob="'.$_POST['dob'].'"';
		$result = mysqli_query($erp_link, $sql);
		if(mysqli_num_rows($result)!=0) {
			$row = mysqli_fetch_array($result);
			$sub_data = $row;
			
			$sql2 = 'select * from student_info2 where student_id ='.$row['sno'];
			$result2 = mysqli_query($erp_link, $sql2);
			if(mysqli_num_rows($result2)!=0){
				$row2 = mysqli_fetch_array($result2);
				$sub_data = $row2;	
			}
			$response = 2;
		}
		else{
				$msg .=  '<script>alert("Incorrect UIN Number Or Date Of Birth" )</script>';
				$response=1;	
			}
	}
	else {
			$msg .=  '<script>alert("Please Enter UIN Number And Date Of Birth" )</script>';
			$response=1;
	}
	
}

page_header();

?>


<?php
// print_r($sub_data);
// echo '<h4>row</h4>';
// print_r($row);
// $response=4;
// $reg_no = 'KNI2023009030';
switch($response){
	case 1:{
?>	
<style>
	.backgr1{
		display:block;
		border-radius:12px;
		width:45%;
		height:150px;
		background-image:url("css/demo_img/first.jpg");
		background-repeat:no-repeat;
		background-size:cover;
		background-position:center;
		position:relative;
		box-shadow:3px 3px 5px #333;
		
	}
	.backgr2{
		border-radius:12px;
		display:block;
		width:45%;
		height:150px;
		background-image:url("css/demo_img/second.png");
		background-repeat:no-repeat;
		background-size:cover;
		background-position:center;
		position:relative;
		box-shadow:3px 3px 5px #333; 
	}
	
	.backgr1:before,
	.backgr1:after,
	.backgr2:before,
	.backgr2:after {
		content: "";
		position: absolute;
		display: block;
		box-sizing: border-box;
		top: 0;
		left: 0;
	}

	.backgr1:after {
		width: 70%;
		height: 90%;
		margin-top:10px;
		line-height: 50px;
		background: url('css/demo_img/print.png');
		background-repeat: no-repeat;
		background-size: contain;
		border-radius: 50%;
		/* background: #82d173; */
		/* mix-blend-mode: lighten; */
		transition: all 0.5s ease;
		transform-origin: center;
		transform: scale(0) rotate(0);
	
	}
	.backgr1:hover:after {
		border-radius: 0;
		transform: scale(1) rotate(180deg);
	}
	.backgr1:hover{
		box-shadow:0 0 0 transparent;
	}
	.backgr2:after {
		width: 70%;
		height: 90%;
		margin-top:10px;
		line-height: 50px;
		background: url('css/demo_img/search.png');
		background-repeat: no-repeat;
		background-size: contain;
		border-radius: 50%;
		/* background: #82d173; */
		/* mix-blend-mode: lighten; */
		transition: all 0.5s ease;
		transform-origin: center;
		transform: scale(0) rotate(0);
	}
	.backgr2:hover:after {
		border-radius: 0;
		transform: scale(1) rotate(180deg);
	}
	.backgr2:hover{
		box-shadow:0 0 0 transparent;
	}
	.gridd{
		display:grid;
		gap:1rem;
		grid-template-columns: 30% 30% 30%;
		grid-auto-row:100px;
		justify-content:center;
	}
	.btnn{
		border-radius:10px;
		/* font-size:0.8rem; */
		width:100%;
		height:100px;
		background-color:aliceblue;
		text-align:center;
		color:black; 
		width:100%; 
		box-shadow:3px 3px 5px #333;
		display:flex;
		align-items:center;
		position: relative;
	}
	.btnn:hover{
		box-shadow:0 0 0 transparent;
	}
	.btnn:after,.btnn:before{
		content: "";
		position: absolute;
		display: block;
		box-sizing: border-box;
		top: 0;
		left: 0;
	}
	.btnn1:after{
		width: 60%;
		height: 90%;
		margin-top:6px;
		line-height: 50px;
		background: url('css/demo_img/1on.png');
		background-repeat: no-repeat;
		background-size: contain;
		border-radius: 50%;
		transition: all 0.5s ease;
		transform-origin: center;
		transform: scale(0) rotate(0);
	}
	.btnn1:hover:after{
		border-radius: 0;
		transform: scale(1) rotate(180deg);
	}
	.btnn2:after{
		width: 65%;
		height: 90%;
		margin-top:6px;
		line-height: 50px;
		background: url('css/demo_img/2on.png');
		background-repeat: no-repeat;
		background-size: contain;
		border-radius: 50%;
		transition: all 0.5s ease;
		transform-origin: center;
		transform: scale(0) rotate(0);
	}
	.btnn2:hover:after{
		border-radius: 0;
		transform: scale(1) rotate(180deg);
	}
	.btnn3:after{
		width: 65%;
		height: 90%;
		margin-top:6px;
		line-height: 50px;
		background: url('css/demo_img/3on.png');
		background-repeat: no-repeat;
		background-size: contain;
		border-radius: 50%;
		transition: all 0.5s ease;
		transform-origin: center;
		transform: scale(0) rotate(0);
	}
	.btnn3:hover:after{
		border-radius: 0;
		transform: scale(1) rotate(180deg);
	}
	.btnn4:after{
		width: 65%;
		height: 90%;
		margin-top:6px;
		line-height: 50px;
		background: url('css/demo_img/4on.png');
		background-repeat: no-repeat;
		background-size: contain;
		border-radius: 50%;
		transition: all 0.5s ease;
		transform-origin: center;
		transform: scale(0) rotate(0);
	}
	.btnn4:hover:after{
		border-radius: 0;
		transform: scale(1) rotate(180deg);
	}
	.btnn5:after{
		width: 65%;
		height: 90%;
		margin-top:6px;
		line-height: 50px;
		background: url('css/demo_img/5on.png');
		background-repeat: no-repeat;
		background-size: contain;
		border-radius: 50%;
		transition: all 0.5s ease;
		transform-origin: center;
		transform: scale(0) rotate(0);
	}
	.btnn5:hover:after{
		border-radius: 0;
		transform: scale(1) rotate(180deg);
	}
	.btnn6:after{
		width: 65%;
		height: 90%;
		margin-top:6px;
		line-height: 50px;
		background: url('css/demo_img/6on.png');
		background-repeat: no-repeat;
		background-size: contain;
		border-radius: 50%;
		transition: all 0.5s ease;
		transform-origin: center;
		transform: scale(0) rotate(0);
	}
	.btnn6:hover:after{
		border-radius: 0;
		transform: scale(1) rotate(180deg);
	}
	.btnn7:after{
		width: 65%;
		height: 90%;
		margin-top:6px;
		line-height: 50px;
		background: url('css/demo_img/7on.png');
		background-repeat: no-repeat;
		background-size: contain;
		border-radius: 50%;
		transition: all 0.5s ease;
		transform-origin: center;
		transform: scale(0) rotate(0);
	}
	.btnn7:hover:after{
		border-radius: 0;
		transform: scale(1) rotate(180deg);
	}
	.btnn8:after{
		width: 65%;
		height: 90%;
		margin-top:6px;
		line-height: 50px;
		background: url('css/demo_img/8on.png');
		background-repeat: no-repeat;
		background-size: contain;
		border-radius: 50%;
		transition: all 0.5s ease;
		transform-origin: center;
		transform: scale(0) rotate(0);
	}
	.btnn8:hover:after{
		border-radius: 0;
		transform: scale(1) rotate(180deg);
	}
.marquee {
    top: 6em;
    position: relative;
    box-sizing: border-box;
    animation: marquee 15s linear infinite;
}

.marquee:hover {
    animation-play-state: paused;
}

/* Make it move! */
@keyframes marquee {
    0%   { top:  20em }
    100% { top: -20em }
}
.OAP_active{
	display: block;
}
.OAP_hidden{
	display: none;
}


</style>

<div class="panel panel-default " style="width:550px; margin-left:20px; float:left; font-size:18px; font-weight:bold; overflow-y: scroll; height: 340px; line-height: 36px; padding: 10px; color: #666;">
	<div class="bg-primary text-white"><a class=" text-white" >E-Learning Registration - Process</a></div>
	<div class="panel-body">
		<ul class="fa-ul"></ul>
		<table class="table table-condensed rounded" cellpadding="5" cellspacing="5" style="font-weight: bold; text-align:left;">
			<tbody >
				<tr style="margin-left:10px;">
					<th><u>Step 1</u> - If you are KNIPSS student then login with UIN & DOB  || If you are not KNIPSS student then Click New student Registration</th>
				</tr>
				<tr>
					<th><u>Step 2</u> - Fill & Check Important Details</th>
				</tr>
				<tr>
					<th> <u>Step 3</u> - Upload Photo and Signature</th>
				</tr>
				<tr>
					<th><u>Step 4</u> - Proceed to Payment</th>
				</tr>
				
			</tbody>
		</table>
	</div>
</div>

	<div id="container" class="ltr" style="width:550px; float:right; margin-right:25px; height: 340px;">
		<form id="loginform" name="login" class="wufoo page" autocomplete="off" enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
			<h2 class="bg-primary text-white p-2 w-100 rounded	" >E-LEARNING FORM LOGIN</h2>
			<?php echo $msg; ?>
			<table style="width:100%" class="p-2 fs-1">
				<!--<tr>
					<td><input id="register" name="register" class="btTxt submit blink_me" type="button" onclick="register_now()" value="Click Here to Register" tabindex="100"/></td>
				</tr>-->
				<tr>
					<td><label  class="desc fs-6 p-2" id="title2" for="Field2">UIN Number <span id="req_1" class="req">*</span></label></td>
				</tr>
			
				<tr>
					<td>
						<input id="uin_no" name="uin_no" type="text" spellcheck="false" class="form-control bolding" value="" maxlength="20" tabindex="1" onBlur="checkname('uin_no')" placeholder="Enter UIN Number." /><p class="instruct" id="instruct1"><small>This field is required.</small></p>
					</td>
				</tr>
				<tr>
					<td><label  class="desc fs-6 p-2" id="title2" for="Field2">Date of Birth <span id="req_1" class="req">*</span></label></td>
				</tr>
			
				<tr>
					<td>
						<input id="dob" name="dob" type="date" spellcheck="false" class="form-control bolding" value="" maxlength="20" /><p class="instruct"  id="instruct1"><small>This field is required.</small></p>
					</td>
				</tr>
				
			</table>
			<button id="login_button" tabindex="3" name="login_button" class="btn btn-success " type="submit" value="Login to Application Section">Login </button>
			
		</form>
	</div>

		<h2 align="center;" id="" tabindex="3" name="" class="btn btn-danger " type="submit" value="Login to Application Section"><a href="elearning_new_reg_form.php" style="color:white; font-size:20px; ">New student Registration<img style="height:30px;" id="gif" src="images/new_gif.gif" alt="new gif "></a></h2>

<div style="clear: both;"></div><br><br>
		<!--<h1 id="register" name="register" class="  submit blink_me bg-danger text-white mx-auto"  onclick="register_now()" value="Step 1. Pre-Registration For Fees Payment-2023" tabindex="100">Step 1. Pre-Registration For U.I.N.-2023</h1>-->
		<div id="container">
		<table class="table	" width="100%">
			<tr>
				<th colspan="4"><span class="text-danger fs-4">हेल्प डेस्क :</span><th>
			</tr>
			<tr>
				<td width="30%">1.<u>समय</u> - प्रात: 10 से सायं 6 बजे तक(On Working time)<td>
				<td width="35%">2.<u>मोबाईल</u> -9554969773 & 7052984802<td>
				<td width="35%">3. <u>ई-मेल</u> - knipssexams@gmail.com<td>
			</tr>
			<tr>
				<td colspan="4">4. <u>पता</u> - कमला नेहरू भौतिक एवं सामाजिक विज्ञान संस्थान, सुल्तानपुर , उत्तर प्रदेश, 228118<td>
			</tr>
		</table>
		</div>
<?php 
		break;
	}
	case 2:{
		
	/*
	$reg_user = $sub_data;
	
	$sql = 'select * from online_payment_exams where registration_no="'.$reg_user['user_name'].'" and order_status="Success"';
	$payment = execute_query($sql);
	if(mysqli_num_rows($payment)==0){
	    //echo '<script>alert("Payment information not found. Contact Administrator"); window.location.replace("https://knipssexams.in");</script>';
	}
	*/
	
	/*
	//For Education Details
	
	$_GET['id'] = $sub_data['sno'];
	
	$data = $sub_data;

	$sql = 'select * from class_detail where sno="'.$data['class'].'"';
	$course = mysqli_fetch_assoc(mysqli_query($erp_link, $sql));
	print_r($course);
	$data = $course;
		
	$stu_details = $sub_data;
	
	$sql='select * from qual_detail where student_id = '.$sub_data['sno'];
	//echo $sql;
	$sql = mysqli_query($erp_link, $sql);
	$i = 1;
	while($row = mysqli_fetch_assoc($sql)){
		if($row['exam_name']!= 'High School' && $row['exam_name']!='Intermediate' && $row['exam_name']!='B.Ed'){
			$examination_name = 'select * from class_detail where class_description = '.$row['exam_name'];
			//echo $examination_name;
			$examination_name = mysqli_query($erp_link, $examination_name);
			if($examination_name){
				echo 'Helloq';
				$examination_name = mysqli_fetch_assoc($examination_name);
				$_POST['part_desc'.$i] = $examination_name['class_description'];
			}
		}
		if($row['exam_name']=='B.Ed'){
			$_POST['part_desc'.$i] = 'B.Ed';
		}
		$_POST['q_sno'.$i] = $row['sno'];
		$_POST['part_desc'.$i.'_board'] = $row['board'];
		$_POST['part_desc'.$i.'_college'] = $row['univ_name'];
		$_POST['part_desc'.$i.'_year'] = $row['year'];
		$_POST['part_desc'.$i.'_rollno'] = $row['roll_no'];
		//if($row['cgpa'] != NULL || $row['cgpa'] != ''){
			$_POST['part_desc'.$i.'_obtmarks'] = $row['obt_marks'];
			$_POST['part_desc'.$i.'_totmarks'] = $row['tot_marks'];
			$_POST['part_desc'.$i.'_percentage'] = $row['percentage'];
		// }else{
			// $_POST['part_desc'.$i.'_cgpa'] = $row['cgpa'];
		// }
		$_POST['part_desc'.$i.'_division'] = $row['division'];
		$_POST['part_desc'.$i.'_status'] = $row['status'];
		$i++;
	}
	*/
	
if(isset($_POST['submit'])){
	echo "Hello";
	$sql = "INSERT INTO `exam_student_info`(`student_info_sno`, `student_name`, `college_roll_no`, `dob`, `mobile_no`, `uin_no`, `status`, `prev_univ`, `created_by`, `creation_time`) 
	VALUES ('".$sub_data['sno']."',
            '".$sub_data['stu_name']."',
            '".$sub_data['roll_no']."',
            '".$sub_data['dob']."',
            '".$sub_data['mobile']."',
            '".$sub_data['university_uin']."',
            '".$sub_data['status']."',
			'".$sub_data['prev_uni']."',
            '".$_SESSION['username']."',
            '".date("d-m-y H:i:s")."')";
			mysqli_query($erp_link, $sql);
		if(mysqli_error($erp_link)){
			$rs=0;
			$msg .= '<li>'.mysqli_error($erp_link).' >> '.$sql.'</li>';
		}
		else{
			
			$sql = 'select * from exam_student_info where student_info_sno="'.$sub_data['sno'].'"';
			$result = mysqli_fetch_assoc(mysqli_query($erp_link, $sql));
			
			$sql2 = "INSERT INTO `exam_student_paper_info`(`exam_student_info_sno`, `type`, `subject_name`, `paper_code`, `paper_title`, `credit`, `status`, `created_by`, `creation_time`)
			VALUES ('".$result['sno']."',
				'".$sub_data['type']."',
				'".$sub_data['sub_name']."',
				'".$sub_data['paper_code']."',
				'".$sub_data['paper_title']."',
				'".$sub_data['credit']."',
				'".$sub_data['status']."',
				'".$_SESSION['username']."',
				'".date("d-m-y H:i:s")."')";
				mysqli_query($erp_link, $sql2);
			
			if(mysqli_error($erp_link)){
				$rs=0;
				$msg .= '<li>'.mysqli_error($erp_link).' >> '.$sql.'</li>';
			}
		}
}
?>

<div id="container" width="70%">
	<div class="row ">
		<section class="content-header">
			<h1 style="color: #000!important;">E-Learning Form <span></span>(2023-24)</h1> <br>
		</section>
		<section class="content-header" style="margin-top: -25px">
			<h3 style="font-size: 20px; font-weight: 600;"></h3>
		</section>
		
		
<!---Student info section-------------------------------------------------------------------------------------------------------------------------------->
			
		<form action="elearning_payment_proceed.php" id="examForm" class="wufoo leftLabel page1" name="admission_newadmission" enctype="multipart/form-data" method="post" onSubmit="" >
				<?php echo $msg; ?>	
				<div class=" card card-body col-md-11 my-auto mx-auto" style="border-top-color: #d2d6de; background-color:whitesmoke;" >
				
					<div class="row mt-1">							
						<div class="col-md-6">							
							<label>Candidate Name * <span style="color:red;">(हाईस्कूल का प्रमाण-पत्र के अनुसार)</span></label>
							<input  type="text" name="candidate_name" id="candidate_name" class="form-control bolding bolding" value="<?php echo $row['stu_name']; ?>" tabindex="<?php echo $tabindex++;?>" style="pointer-events:none ;" required>
						</div>
						<div class="col-md-6">							
							<label>Father&#39;s Name* <span style="color:red;">(हाईस्कूल का प्रमाण-पत्र के अनुसार)</span></label>
							<input  type="text" name="father_name" id="father_name" class="form-control bolding bolding " value="<?php echo $row['father_name']; ?>" style="pointer-events:none ;" required>
						</div>
					</div>
					<div class="row mt-1">
						<div class="col-md-6">							
							<label>Mother&#39;s Name</label>
							<input  type="text" name="mother_name" id="mother_name" class="form-control bolding bolding " style="pointer-events:none ;" value="<?php echo $row['mother_name']; ?>" required>
						</div>
						<div class="col-md-6">							
							<label>Date of Birth* <span style="color:red; ">(हाईस्कूल का प्रमाण-पत्र के अनुसार)</span></label>
							<input  type="text" id="dob" name="dob" readonly class="form-control bolding bolding">

							<script>
								// JavaScript code to populate the Date of Birth field and make it read-only
								document.addEventListener("DOMContentLoaded", function () {
									var dobInput = document.getElementById("dob");
									var defaultDate = '<?php echo $row['dob']; ?>';
									
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
							<input  type="text" name="aadhar" style="pointer-events:none ;" id="aadhar" class="form-control bolding bolding " value="<?php echo $row['aadhar']; ?>" tabindex="<?php echo $tabindex++;?>" style="pointer-events:none ;" required>
						</div>
						<div class="col-md-6">							
							<label>E-Mail</label>
							<input  type="text" name="email" id="email" class="form-control bolding bolding " value="<?php echo $row['e_mail1']; ?>" style="pointer-events:none ;" tabindex="<?php echo $tabindex++;?>"  required>
						</div>
					</div>
					<div class="row mt-1">
						<div class="col-md-6">							
							<label>Mobile</label>
							<input  type="text" name="mobile" id="mobile" class="form-control bolding bolding " value="<?php echo $row['mobile']; ?>" style="pointer-events:none ;" tabindex="<?php echo $tabindex++;?>" required>
						</div>
						<div class="col-md-6">							
							<label>Course Type</label>
							<?php
								$sql = 'select * from class_detail where sno ='.$sub_data['class'];
								$course_result = mysqli_fetch_assoc(mysqli_query($erp_link, $sql));
							?>
							<input  type="text" name="course_type" id="course_type" class="form-control bolding bolding " value="<?php echo $course_result['category']; ?>" style="pointer-events:none ;" tabindex="<?php echo $tabindex++;?>" required>
						</div>
					</div>
					<div class="row mt-1">							
						<div class="col-md-6"	>	
							<label>Course Applying for</label>
							<input  type="text" name="course_applying_for" id="course_applying_for" class="form-control bolding bolding " value="<?php echo $course_result['class_description']; ?>" style="pointer-events:none ;" tabindex="<?php echo $tabindex++;?>" required>								
						</div>
						<div class="col-md-6">							
							<label>Category</label>
							<select  name="category" id="category" class="form-control bolding bolding" tabindex="<?php echo $tabindex++;?>" style="pointer-events: none;" required>
							<option   <?php //echo isset($_GET['id'])? "":' selected = "selected" '?>>---Select Your Category---</option>
								<option value="GEN" <?php if($sub_data['category']=="GEN"){ echo 'selected ';}?>>General</option>
								<option value="OBC" <?php if($sub_data['category']=="OBC"){ echo 'selected ';}?>>OBC</option>
								<option value="SC" <?php if($sub_data['category']=="SC"){ echo 'selected ';}?>>SC</option>
								<option value="ST" <?php if($sub_data['category']=="ST"){ echo 'selected ';}?>>ST</option>
								<option value="EWS" <?php if($sub_data['category']=="EWS"){ echo 'selected ';}?>>EWS</option>
							</select>
						</div>
					</div>
					<div class="row mt-1">
					<div class="col-md-6">


						<label for="selectOption">Religion</label>
								<select  id="selectOption" name="religion" class="form-control bolding bolding" tabindex="<?php echo $tabindex++;?>"  required>
									<option value=""   selected>---Select Your Religion---</option>
									<option value="HINDU" <?php if($row['religion']=="HINDU"){ echo 'selected ';}?>>HINDU</option>
								<option value="MUSLIM" <?php if($row['religion']=="MUSLIM"){ echo 'selected ';}?>>MUSLIM</option>
								<option value="SIKH" <?php if($row['religion']=="SIKH"){ echo 'selected ';}?>>SIKH</option>
								<option value="CHRISTIAN" <?php if($row['religion']=="CHRISTIAN"){ echo 'selected ';}?>>CHRISTIAN</option>
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
							<input  type="text" name="gender" id="gender" class="form-control bolding bolding " value="<?php
							if($sub_data['gender'] == ("M"||"m")){
								echo "Male"; 
							}
							elseif($sub_data['gender'] == ("F"||"f")){
								echo "Female"; 
							}
							else{
								echo $sub_data['gender'];
							}
							?>" style="pointer-events:none ;" tabindex="<?php echo $tabindex++;?>" required>
							
						</div>
					</div>
					<div class="row mt-1">
						<div class="col-md-6">	
							<label>Whatsapp Mobile No.</label>
							<input  type="text" name="w_number" id="w_number" class="form-control bolding bolding " value="<?php echo $row['whatsapp_no']; ?>" pattern=[0-9]{10} minlength="10" maxlength="10" tabindex="<?php echo $tabindex++;?>"  required />
							
						</div>
						<div class="col-md-6">							
							<label>PARENT'S Mobile No.</label>
							<input  type="text" name="parent_number" id="parent_number" class="form-control bolding bolding " pattern=[0-9]{10} minlength="10" maxlength="10" value="<?php echo $row['p_mobile']; ?>" tabindex="<?php echo $tabindex++;?>" required>
						</div>
					</div>
					<div class="row mt-1">
						
					
						<div class="col-md-6">
							
							<label for="selectOption">DOMICILE</label>
								<input  type="text" name="domicile" id="domicile" class="form-control bolding bolding " value="<?php echo $row['p_state']; ?>" tabindex="<?php echo $tabindex++;?>"   />

			
							
						</div>
						<div class="col-md-6">							
							<label>MOTHER TONGUE</label>
							<select  name="mother_tongue" id="mother_tongue" class="form-control bolding bolding" tabindex="<?php echo $tabindex++;?>" required>
								<option value="hindi" <?php if($row['mother_tongue']=="hindi"){ echo 'selected ';}?>>Hindi</option>
								<option value="english" <?php if($row['mother_tongue']=="english"){ echo 'selected ';}?>>English</option>
								
							</select>
						</div>
					</div>
					<div class="row mt-1">
						
						
						
						<div class="col-md-6">
							
							<label for="selectOption">WEIGHTAGE</label>
								<select  name="weightage" id="weightage" class="form-control bolding bolding" tabindex="<?php echo $tabindex++;?>" required>
									<option value=""   selected>---Select Your Weightage ---</option>
									<option value="not_applicable" <?php if($row['waightage']=="not_applicable"){ echo 'selected ';}?>>Not applicable </option>
									<option value="ncc" <?php if($row['waightage']=="ncc"){ echo 'selected ';}?>>NCC</option>
									<option value="freedom_fighters" <?php if($row['waightage']=="freedom_fighters"){ echo 'selected ';}?>>Freedom Fighters</option>
									<option value="sports_achievements" <?php if($row['waightage']=="sports_achievements"){ echo 'selected ';}?>>Sports Achievements</option>
									<option value="cultural_activities" <?php if($row['waightage']=="cultural_activities"){ echo 'selected ';}?>>Cultural Activities</option>
									<option value="social_work" <?php if($row['waightage']=="social_work"){ echo 'selected ';}?>>Social Work</option>
									<option value="volunteering" <?php if($row['waightage']=="volunteering"){ echo 'selected ';}?>>Volunteering</option>
								</select>

							<script>
								function validateForm() {
									var selectedOption = document.getElementById('weightage').value;
									if (selectedOption === "") {
										alert("Please select Weightage");
										return false;
									}
									return true;
								}
							</script>
							
						</div>
						
						<div class="col-md-6">
							
							<label for="selectOption">Blood Group</label>
								<select  name="blood_group" id="blood_group" class="form-control bolding bolding" tabindex="<?php echo $tabindex++;?>" required>
									<option value="N/A" <?php if($row['blood_group']==''){ echo 'selected ';}?>>N/A</option>
									<option value="N/A" <?php if($row['blood_group']=="N/A"){ echo 'selected ';}?>>N/A</option>
									<option value="A+" <?php if($row['blood_group']=="A+"){ echo 'selected ';}?>>A+</option>
									<option value="A-" <?php if($row['blood_group']=="A-"){ echo 'selected ';}?>>A-</option>
									<option value="B+" <?php if($row['blood_group']=="B+"){ echo 'selected ';}?>>B+</option>
									<option value="B-" <?php if($row['blood_group']=="B-"){ echo 'selected ';}?>>B-</option>
									<option value="AB+" <?php if($row['blood_group']=="AB+"){ echo 'selected ';}?>>AB+</option>
									<option value="AB-" <?php if($row['blood_group']=="AB-"){ echo 'selected ';}?>>AB-</option>
									<option value="O+" <?php if($row['blood_group']=="O+"){ echo 'selected ';}?>>O+</option>
									<option value="O-" <?php if($row['blood_group']=="O-"){ echo 'selected ';}?>>O-</option>
								</select>

							<script>
								function validateForm() {
									var selectedOption = document.getElementById('blood_group').value;
									if (selectedOption === "") {
										alert("Please select Blood Group");
										return false;
									}
									return true;
								}
							</script>
							
						</div>
					</div>
					<div class="row mt-1">
						
						<div class="col-md-6">	
							<label>Status</label>
							<select  name="status" id="status" class="form-control bolding bolding"  style="pointer-events:none;" tabindex="<?php echo $tabindex++;?>" required>
								<option value="reguler" <?php if($row['status']=="regular"){ echo 'selected ';}?>>Regular</option>
								
							</select>
						</div>
						<div class="col-md-6">	
							<label>College Roll No.*<span style="color:red;">(Example:2023abc010001)</span></label>
							<input  type="text" name="college_roll_no" id="roll_no" class="form-control bolding bolding " value="<?php echo $sub_data['roll_no']; ?>" tabindex="<?php echo $tabindex++;?>" required>
						</div>
					</div>
					<div class="row mt-1">						
						<div class="col-md-6"	>	
							<label>Course Applying for</label>
							<select name="course_name" id="" value="" class="form-control" tabindex="<?php echo $tabindex++;?>"  >
										<option value="" >---Select Your course ---</option>
										<?php 
											$sql  = 'select * from elearning_course';
											$dept_list = execute_query( $sql);
											while($list = mysqli_fetch_assoc($dept_list)){
												echo '<option  value = "'.$list['course_name'].'" ';
												// if(isset($_GET['id'])){
													// if(isset($stu_details['course_name'])){
														// if($stu_details['course_name'] == $list['sno']){
															// echo ' selected = "selected" ';
														// }
													// }
												// }
												echo '>'.$list['course_name'].'</option>';
											}
										?>
									</select>							
						</div>
						<div class="col-md-6"	>	
														
						</div>
						</div>
					<div class="row mt-1">
						<div class="col-md-6">
						<?php
							$sql = 'select * from admission_student_info where uin ="'.$row['university_uin'].'"';
							$result_img = mysqli_fetch_assoc(mysqli_query($db, $sql));
						?>
							<label>Photo</label>
							<img src="<?php echo $result_img['photo']; ?>" alt="person Pic" class="img-fluid " style="height: 150px;">
						</div>
						
						<div class="col-md-6">
							<label>Signature</label>
							<img src="<?php echo $result_img['signature']; ?>" alt="person Pic" class="img-fluid " style="height: 120px; width: 300px;">

						</div>
						<div class="col-md-6">
							
						</div>
					</div>
					<div class="row mt-1">
						
						<div class="col-md-6">
							<!-- <label>Signature Upload</label>
							<input  type="file" name="signature" id="signature" class="form-control bolding bolding " value="" tabindex="" /> -->
						</div>
					</div>
					<!-- <div class="row mt-1">
						<div class="col-md-6">	
							<label>Transfer Certificate</label>
							<input  type="file" name="tc" id="tc" class="form-control bolding bolding " value="" />
						</div>
						<div class="col-md-6">	
							
						</div>
					</div> -->
					
					</div>
				</div>
				
			</div>
			

<!-----Address Section--------------------------------------------------------------------------------------------------------------------->


			<div  name="info_table" id="info_table">
				<table width="100%" class="table table-striped-primary table-hover rounded ">	
					<tr class="bg-secondary text-white ">
						<th colspan="6" class="h5"><strong>Permanent Address</strong></th>
					</tr>
					<tr class="table-secondary">
						<input  type="hidden" name="p_sno" value="<?php echo $row['sno']; ?>">
						<th>House No./Village</th>
						<td><input  type="text"  class="form-control bolding bolding" id="p_address" name="p_address" value="<?php if($row['p_house_no'] != $row['p_village']){
							echo $row['p_house_no'].$row['p_village'];
							}
							else {
								echo $row['p_house_no'];
							}
						?>"  required></td>
						<th>Post</th>
						<td><input  type="text" class="form-control bolding bolding" id="p_post" name="p_post" value="<?php echo $row['p_post']; ?>" required></td>
						<th>Tahsil</th>
						<td><input  type="text" class="form-control bolding bolding" id="p_tehsil" name="p_tehsil" value="<?php echo $row['p_tehsil']; ?>" required></td>
					</tr>
					<tr>
						<th>Thana</th>
						<td><input  type="text" class="form-control bolding bolding" id="p_thana" name="p_thana" value="<?php echo $row['p_thana']; ?>" required></td>
						<th>District</th>
						<td><input  type="text" class="form-control bolding bolding" id="p_district" name="p_district" value="<?php echo $row['p_district']; ?>" required></td>
						<th>State</th>
						<td><input  type="text" class="form-control bolding bolding" id="p_state" name="p_state" value="<?php echo $row['p_state']; ?>" required></td>
					</tr>
					<tr>

						<th>Pin</th>
						<td><input  type="text" class="form-control bolding bolding"  id="p_pin" name="p_pin" value="<?php echo $row['p_pin']; ?>" required></td>
					</tr>
					<tr class="bg-secondary text-white">
						<th colspan="6" class="h5" >Correspondence Address </th>
					</tr>
					<tr class="table-secondary">
						<input  type="hidden" name="c_sno" value="<?php echo $row['sno']; ?>">
						<th>House No./Village</th>
						<td><input  type="text" class="form-control bolding bolding" id="c_address" name="c_address" value="<?php echo $row['c_address']; ?>" required></td>
						<th>Post</th>
						<td><input  type="text" class="form-control bolding bolding" id="c_post" name="c_post" value="<?php echo $row['c_post']; ?>" required></td>
						<th>Tahsil</th>
						<td><input  type="text" class="form-control bolding bolding" id="c_tehsil" name="c_tehsil" value="<?php echo $row['c_tehsil']; ?>" required></td>

					</tr>
					<tr>
						<th>Thana</th>
						<td><input  type="text" class="form-control bolding bolding" id="c_thana" name="c_thana" value="<?php echo $row['c_thana']; ?>" required></td>
						<th>District</th>
						<td><input  type="text" class="form-control bolding bolding" id="c_district" name="c_district" value="<?php echo $row['c_district']; ?>" required></td>
						<th>State</th>
						<td><input  type="text" class="form-control bolding bolding" id="c_state" name="c_state" value="<?php echo $row['c_state']; ?>" required></td>
					</tr>
					<tr>
						<th>Pin</th>
						<td><input  type="text" class="form-control bolding bolding"  id="c_pin" name="c_pin" value="<?php echo $row['c_pin']; ?>" required></td>
					</tr>

				</table>
			</div>
	
<!---Examination Section-------------------------------------------------------------------------------------------------------------------------->
					
				

				
					<input type="hidden" name="student_id" value="<?php echo $row['sno']; ?>" />
					<div class="text-center" style="font-size:25px; font-weight:500;">PAYABLE FEES ₹500/</div>
					<center><button type="submit" class="btn btn-danger" name="submit" value="Submit">Proceed to Payment</button></center><br>
				</div>
			</div>

			
		</form>
<!--END Form-------------------------------------------------------------------------------------------------------------------------->

	
	
	</div>
</div> 
<?php 
		break;
	}
}
	page_footer();
	ob_end_flush();
?>

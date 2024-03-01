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
<script type="text/javascript" language="javascript">
function register_now(){
    var method = "post"; // Set method to post by default if not specified.

    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", "uin_reg_form.php");

	var hiddenField = document.createElement("input");
	hiddenField.setAttribute("type", "hidden");
	hiddenField.setAttribute("name", "register");
	hiddenField.setAttribute("value", "testing");

	form.appendChild(hiddenField);
    document.body.appendChild(form);
    form.submit();	
}
function toggleOAP(val){
	console.log(val);
	if(val==2){
		console.log(val);
		document.getElementById("div_transaction_id").classList.remove("OAP_hidden");
		document.getElementById("div_dob").classList.remove("OAP_active");
		document.getElementById("div_transaction_id").classList.add("OAP_active");
		document.getElementById("div_dob").classList.add("OAP_hidden");
		document.getElementById("login_button").classList.add("OAP_hidden");
		document.getElementById("login_button").classList.remove("OAP_active");
		document.getElementById("transaction_login").classList.remove("OAP_hidden");
		document.getElementById("transaction_login").classList.add("OAP_active");
		
	}
	if(val==1){
		console.log(val);
		document.getElementById("div_transaction_id").classList.remove("OAP_active");
		document.getElementById("div_dob").classList.remove("OAP_hidden");
		document.getElementById("div_dob").classList.add("OAP_active");
		document.getElementById("div_transaction_id").classList.add("OAP_hidden");
		document.getElementById("login_button").classList.remove("OAP_hidden");
		document.getElementById("login_button").classList.add("OAP_active");
		document.getElementById("transaction_login").classList.add("OAP_hidden");
		document.getElementById("transaction_login").classList.remove("OAP_active");
		
	}
}


</script>
<div class="panel panel-default " style="width:550px; margin-left:20px; float:left; font-size:18px; font-weight:bold; overflow-y: scroll; height: 340px; line-height: 36px; padding: 10px; color: #666;">
	<div class="bg-primary text-white"><a class=" text-white" >Exam Registration - Process</a></div>
	<div class="panel-body">
		<ul class="fa-ul"></ul>
		<table class="table table-condensed rounded" cellpadding="5" cellspacing="5" style="font-weight: bold; text-align:left;">
			<tbody >
				<tr style="margin-left:10px;">
					<th><u>Step 1</u> - Click on Pre-Registration For Fees Payment</th>
				</tr>
				<tr>
					<th><u>Step 2</u> - Online Fee Payment</th>
				</tr>
				<tr>
					<th> <u>Step 3</u> - Fill complete Entrance Form with Transaction ID and Registration</th>
				</tr>
				<tr>
					<th><u>Step 4</u> - Fill Important Details</th>
				</tr>
				<tr>
					<th><u>Step 5</u> - Upload Photo and Signature</th>
				</tr>
				<tr>
					<th><u>Step 6</u> -  Final Submission</th>
				</tr>
				<tr>
					<th><u>Step 7</u> -Take Print of Form for Future Reference</th>
				</tr>
			</tbody>
		</table>
	</div>
</div>

	<div id="container" class="ltr" style="width:550px; float:right; margin-right:25px; height: 340px;">
		<form id="loginform" name="login" class="wufoo page" autocomplete="off" enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
			<h2 class="bg-primary text-white p-2 w-100 rounded	" >EXAMINATION FORM LOGIN</h2>
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
			<button id="login_button" tabindex="3" name="login_button" class="btn btn-danger " type="submit" value="Login to Application Section">Login </button>
		</form>
	</div>


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
	
	$student_info = $sub_data;
	if(!isset($student_info)){
		$msg .= '<script>Some Error Occurred. Contact Help Desk</script>';
		$response=1;
	}
	else{
		$sql = 'select * from class_detail where sno="'.$student_info['class'].'"';
		$class = mysqli_query($erp_link, $sql);
		if(mysqli_num_rows($class)!=0){
			$class = mysqli_fetch_assoc($class);
			
		}
		else{
			$msg .= '<div class="alert alert-danger">Invalid Class Data</div>';
			
		}
		$papers = array();
		$i=1;
			
		if(($class['sort_no']=='BA_SEM' || $class['sort_no']=='BSC_SEM') && $class['year']=='1'){
			$sub1 = mysqli_fetch_assoc(mysqli_query($erp_link, "select * from add_subject where sno=".$student_info['sub1']));
			$sub2 = mysqli_fetch_assoc(mysqli_query($erp_link, "select * from add_subject where sno=".$student_info['sub2']));
			$sub3 = mysqli_fetch_assoc(mysqli_query($erp_link, "select * from add_subject where sno=".$student_info['sub3']));
			

			$sql = 'select * from add_subject_details where class_id="'.$class['sno'].'" and subject_id="'.$sub1['sno'].'"';
			$paper1 = mysqli_query($erp_link, $sql);
			while($row_paper1 = mysqli_fetch_assoc($paper1)){
				$papers[$i]['subject_name'] = $sub1['subject'];
				$papers[$i++][] = $row_paper1;
			}
			$papers[$i]['subject_name'] = $sub1['subject'];

			$sql = 'select * from add_subject_details where class_id="'.$class['sno'].'" and subject_id="'.$sub2['sno'].'"';
			$paper2 = mysqli_query($erp_link, $sql);
			while($row_paper2 = mysqli_fetch_assoc($paper2)){
				$papers[$i]['subject_name'] = $sub2['subject'];
				$papers[$i++][] = $row_paper2;
			}
			

			$sql = 'select * from add_subject_details where class_id="'.$class['sno'].'" and subject_id="'.$sub3['sno'].'"';
			$paper3 = mysqli_query($erp_link, $sql);
			while($row_paper3 = mysqli_fetch_assoc($paper3)){
				$papers[$i]['subject_name'] = $sub3['subject'];
				$papers[$i++][] = $row_paper3;
			}
			$sql = 'select add_subject2.subject, add_subject2.sno as subject_id from student_info_subject left join add_subject2 on add_subject2.sno = student_info_subject.subject_id where student_id="'.$student_info['sno'].'"';
			//echo $sql;
			$result_vocational_subs = mysqli_query($erp_link, $sql);
			$vocational_subs = array();
			while($row_vocational_subs = mysqli_fetch_assoc($result_vocational_subs)){
				$sql = 'select * from add_subject_details where class_id="'.$student_info['class'].'" and type_status="2" and subject_id="'.$row_vocational_subs['subject_id'].'"';
				$result_subs = mysqli_query($erp_link, $sql);
				if(mysqli_num_rows($result_subs)!=0){
					while($row_subs = mysqli_fetch_assoc($result_subs)){
						$papers[$i]['subject_name'] = $row_vocational_subs['subject'];
						$papers[$i++][] = $row_subs;
					}
				}
				//$vocational_subs[$row_vocational_subs['subject_type']] = $row_vocational_subs['subject'];
			}
			//print_r($papers);
		}
		else{
			$sql = 'select * from add_subject_details where class_id="'.$class['sno'].'"';
			$paper1 = mysqli_query($erp_link, $sql);
			while($row_paper1 = mysqli_fetch_assoc($paper1)){
				if($row_paper1['type_status']=='1'){
					$sub_name = mysqli_fetch_assoc(mysqli_query($erp_link, "select * from add_subject where sno=".$row_paper1['subject_id']));	
				}
				elseif($row_paper1['type_status']=='2'){
					$sub_name = mysqli_fetch_assoc(mysqli_query($erp_link, "select * from add_subject2 where sno=".$row_paper1['subject_id']));
				}
				
				$papers[$i]['subject_name'] = $sub_name['subject'];
				$papers[$i++][] = $row_paper1;
			}

			
		}
	}
if(isset($_POST['submit'])){
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
			<h1 style="color: #000!important;">Examination Form <span></span>(2023-24)</h1> <br>
		</section>
		<section class="content-header" style="margin-top: -25px">
			<h3 style="font-size: 20px; font-weight: 600;"></h3>
		</section>
		
		
<!---Student info section-------------------------------------------------------------------------------------------------------------------------------->
			
		<form action="exam_payment_proceed.php" id="examForm" class="wufoo leftLabel page1" name="admission_newadmission" enctype="multipart/form-data" method="post" onSubmit="" >
				<?php echo $msg; ?>	
				<div class=" card card-body col-md-11 my-auto mx-auto" style="border-top-color: #d2d6de; background-color:whitesmoke;" >
				
					<div class="row mt-1">							
						<div class="col-md-6">							
							<label>Candidate Name * <span style="color:red;">(हाईस्कूल का प्रमाण-पत्र के अनुसार)</span></label>
							<input disabled type="text" name="candidate_name" id="candidate_name" class="form-control bolding bolding" value="<?php echo $row['stu_name']; ?>" tabindex="<?php echo $tabindex++;?>" style="pointer-events:none ;" required>
						</div>
						<div class="col-md-6">							
							<label>Father&#39;s Name* <span style="color:red;">(हाईस्कूल का प्रमाण-पत्र के अनुसार)</span></label>
							<input disabled type="text" name="father_name" id="father_name" class="form-control bolding bolding " value="<?php echo $row['father_name']; ?>" style="pointer-events:none ;" required>
						</div>
					</div>
					<div class="row mt-1">
						<div class="col-md-6">							
							<label>Mother&#39;s Name</label>
							<input disabled type="text" name="mother_name" id="mother_name" class="form-control bolding bolding " style="pointer-events:none ;" value="<?php echo $row['mother_name']; ?>" required>
						</div>
						<div class="col-md-6">							
							<label>Date of Birth* <span style="color:red; ">(हाईस्कूल का प्रमाण-पत्र के अनुसार)</span></label>
							<input disabled type="text" id="dob" name="dob" readonly class="form-control bolding bolding">

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
							<input disabled type="text" name="aadhar" style="pointer-events:none ;" id="aadhar" class="form-control bolding bolding " value="<?php echo $row['aadhar']; ?>" tabindex="<?php echo $tabindex++;?>" style="pointer-events:none ;" required>
						</div>
						<div class="col-md-6">							
							<label>E-Mail</label>
							<input disabled type="text" name="email" id="email" class="form-control bolding bolding " value="<?php echo $row['e_mail1']; ?>" style="pointer-events:none ;" tabindex="<?php echo $tabindex++;?>"  required>
						</div>
					</div>
					<div class="row mt-1">
						<div class="col-md-6">							
							<label>Mobile</label>
							<input disabled type="text" name="mobile" id="mobile" class="form-control bolding bolding " value="<?php echo $row['mobile']; ?>" style="pointer-events:none ;" tabindex="<?php echo $tabindex++;?>" required>
						</div>
						<div class="col-md-6">							
							<label>Course Type</label>
							<?php
								$sql = 'select * from class_detail where sno ='.$sub_data['class'];
								$course_result = mysqli_fetch_assoc(mysqli_query($erp_link, $sql));
							?>
							<input disabled type="text" name="course_type" id="course_type" class="form-control bolding bolding " value="<?php echo $course_result['category']; ?>" style="pointer-events:none ;" tabindex="<?php echo $tabindex++;?>" required>
						</div>
					</div>
					<div class="row mt-1">							
						<div class="col-md-6"	>	
							<label>Course Applying for</label>
							<input disabled type="text" name="course_applying_for" id="course_applying_for" class="form-control bolding bolding " value="<?php echo $course_result['class_description']; ?>" style="pointer-events:none ;" tabindex="<?php echo $tabindex++;?>" required>								
						</div>
						<div class="col-md-6">							
							<label>Category</label>
							<select disabled name="category" id="category" class="form-control bolding bolding" tabindex="<?php echo $tabindex++;?>" style="pointer-events: none;" required>
							<option disabled  <?php //echo isset($_GET['id'])? "":' selected = "selected" '?>>---Select Your Category---</option>
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
								<select disabled id="selectOption" name="religion" class="form-control bolding bolding" tabindex="<?php echo $tabindex++;?>"  required>
									<option value="" disabled  selected>---Select Your Religion---</option>
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
							<input disabled type="text" name="gender" id="gender" class="form-control bolding bolding " value="<?php
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
							<input disabled type="text" name="caste" id="caste" class="form-control bolding bolding " value="<?php echo $row['whatsapp_no']; ?>" pattern=[0-9]{10} minlength="10" maxlength="10" tabindex="<?php echo $tabindex++;?>"  required />
							
						</div>
						<div class="col-md-6">							
							<label>PARENT'S Mobile No.</label>
							<input disabled type="text" name="parent_income" id="parent_income" class="form-control bolding bolding " pattern=[0-9]{10} minlength="10" maxlength="10" value="<?php echo $row['p_mobile']; ?>" tabindex="<?php echo $tabindex++;?>" required>
						</div>
					</div>
					<div class="row mt-1">
						
					
						<div class="col-md-6">
							
							<label for="selectOption">DOMICILE</label>
								<input disabled type="text" name="domicile" id="domicile" class="form-control bolding bolding " value="<?php echo $row['p_state']; ?>" pattern=[0-9]{10} minlength="10" maxlength="10" tabindex="<?php echo $tabindex++;?>"  required />

							<script>
								function validateForm() {
									var selectedOption = document.getElementById('domicile').value;
									if (selectedOption === "") {
										alert("Please select Domicile");
										return false;
									}
									return true;
								}
							</script>
							
						</div>
						<div class="col-md-6">							
							<label>MOTHER TONGUE</label>
							<select disabled name="mother_tongue" id="mother_tongue" class="form-control bolding bolding" tabindex="<?php echo $tabindex++;?>" required>
								<option value="hindi" <?php if($row['mother_tongue']=="hindi"){ echo 'selected ';}?>>Hindi</option>
								<option value="english" <?php if($row['mother_tongue']=="english"){ echo 'selected ';}?>>English</option>
								
							</select>
						</div>
					</div>
					<div class="row mt-1">
						
						
						
						<div class="col-md-6">
							
							<label for="selectOption">WEIGHTAGE</label>
								<select disabled name="weightage" id="weightage" class="form-control bolding bolding" tabindex="<?php echo $tabindex++;?>" required>
									<option value="" disabled  selected>---Select Your Weightage ---</option>
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
								<select disabled name="blood_group" id="blood_group" class="form-control bolding bolding" tabindex="<?php echo $tabindex++;?>" required>
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
							<select disabled name="status" id="status" class="form-control bolding bolding"  style="pointer-events:none;" tabindex="<?php echo $tabindex++;?>" required>
								<option value="reguler" <?php if($row['status']=="regular"){ echo 'selected ';}?>>Regular</option>
								
							</select>
						</div>
						<div class="col-md-6">	
							<label>College Roll No.*<span style="color:red;">(Example:2023abc010001)</span></label>
							<input disabled type="text" name="college_roll_no" id="roll_no" class="form-control bolding bolding " value="<?php echo $sub_data['roll_no']; ?>" tabindex="<?php echo $tabindex++;?>" required>
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
							<input disabled type="file" name="signature" id="signature" class="form-control bolding bolding " value="" tabindex="" /> -->
						</div>
					</div>
					<!-- <div class="row mt-1">
						<div class="col-md-6">	
							<label>Transfer Certificate</label>
							<input disabled type="file" name="tc" id="tc" class="form-control bolding bolding " value="" />
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
			
			
<!--Education section------------------------------------------------------------------------------------------------------------------------------------------>
	<!---
	
	
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
							/*
							echo '<br>';
							print_r($data);
							if($data['type']=='PG'){
							}
							elseif ($data['sno'] == '60' || $data['sno'] == '107' || $data['sno'] == '245') {
								$a = 5;
							}
							else{
								$a = 3;
									echo "Hello";
							}
							 if ($data['sno'] == '60' || $data['sno'] == '107' || $data['sno'] == '245') {
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
									echo '<td>High School<input disabled type="hidden" name="part_desc' . $i . '"  value="High School" required ></td>';
								} elseif ($i == 2) {
									echo '<td>Intermediate<input disabled type="hidden" name="part_desc' . $i . '"  value="Intermediate" required ></td>';
								} elseif ($i == 3 || $i == 4) {
									?>
									<td>
										<select disabled name="part_desc<?php echo $i; ?>" id="part_desc<?php echo $i; ?>" onBlur="tab_fill(1,8)" onFocus="getCurrent(<?php echo $i; ?>)">
											<option value="<?php echo isset($_POST['part_desc' . $i]) ? $_POST['part_desc' . $i] : ''; ?>"
													selected><?php if (isset($_POST['part_desc' . $i . ''])) {
													echo $_POST['part_desc' . $i . ''];
												} ?></option>

											<option value="B.Ed">B.Ed</option>
											<?php
											$sql = 'select * from class_detail ';
											$result = mysqli_query($erp_link, $sql);
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
									<input disabled name="part_desc<?php echo $i; ?>_board" type="text"
										   value="<?php echo isset($_GET['id']) ? (isset($_POST['part_desc' . $i . '_board']) ? $_POST['part_desc' . $i . '_board'] : '') : '' ?>"
										   class="form-control bolding bolding" maxlength="100" id="part_desc<?php echo $i; ?>_board"  <?php if($i<=3){ echo " required ";} ?> />
								</td>

								<td><input disabled name="part_desc<?php echo $i; ?>_college" type="text"
										   value="<?php if (isset($_POST['part_desc' . $i . '_college'])) {
											   echo $_POST['part_desc' . $i . '_college'];
										   } ?>" class="form-control bolding" maxlength="100" id="part_desc<?php echo $i; ?>_college" <?php if($i<=3){ echo " required ";} ?>  /></td>

								<td><input disabled name="part_desc<?php echo $i; ?>_year" type="text"
										   value="<?php if (isset($_POST['part_desc' . $i . '_year'])) {
											   echo $_POST['part_desc' . $i . '_year'];
										   } ?>" class="form-control bolding" maxlength="6" id="part_desc<?php echo $i; ?>_year"  <?php if($i<=3){ echo " required ";} ?> /></td>

								<td><input disabled name="part_desc<?php echo $i; ?>_rollno" type="text"
										   value="<?php if (isset($_POST['part_desc' . $i . '_rollno'])) {
											   echo $_POST['part_desc' . $i . '_rollno'];
										   } ?>" class="form-control bolding"  id="part_desc<?php echo $i; ?>_rollno"  <?php if($i<=3){ echo " required ";} ?> />
								</td>

								<td width="10%">
									<select disabled name="" id="select<?php echo $i; ?>" class="form-control bolding"
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

								<td><input disabled name="part_desc<?php echo $i; ?>_obtmarks" type="text"
										   value="<?php if (isset($_POST['part_desc' . $i . '_obtmarks'])) {
											   echo $_POST['part_desc' . $i . '_obtmarks'];
										   } ?>" placeholder="Obtained Marks" class="form-control bolding" maxlength="6"
										   id="<?php echo $i ?>_obt"/></td>
								<td>
									<input disabled name="part_desc<?php echo $i; ?>_totmarks" type="text"
										   value="<?php if (isset($_POST['part_desc' . $i . '_totmarks'])) {
											   echo $_POST['part_desc' . $i . '_totmarks'];
										   } ?>" placeholder="Total Marks" class="form-control bolding" maxlength="6"
										   onBlur="get_perc(<?php echo $i ?>)" id="<?php echo $i ?>_total"/></td>
								<td>
									<input disabled name="part_desc<?php echo $i; ?>_percentage" type="text"
										   value="<?php if (isset($_POST['part_desc' . $i . '_percentage'])) {
											   echo $_POST['part_desc' . $i . '_percentage'];
										   } ?>" placeholder="Percentage" class="form-control bolding" maxlength="6"
										   id="<?php echo $i ?>_perc" OnBlur="get_division(<?php echo $i ?>)"/></td>
								<td>
									<input disabled name="part_desc<?php echo $i; ?>_cgpa" type="text"
										   value="<?php if (isset($_POST['part_desc' . $i . '_cgpa'])) {
											   echo $_POST['part_desc' . $i . '_cgpa'];
										   } ?>" class="form-control bolding bolding" placeholder="Enter CGPA" maxlength="10"
										   id="<?php echo $i ?>_cgpa"/></td>

								<td>
									<select disabled name="part_desc<?php echo $i; ?>_status"
											value="<?php if (isset($_POST['part_desc' . $i . '_status'])) {
												echo $_POST['part_desc' . $i . '_status'];
											} ?>" id="part_desc" onBlur="tab_fill(1,8)" onFocus="getCurrent(<?php echo $i; ?>)">
										<option value="Passed">Passed</option>
										<option value="Failed">Failed</option>
									</select>
								</td>
								<input disabled type="hidden" name="q_sno<?php echo $i; ?>"
									   value="<?php echo isset($_GET['id']) ? isset($_POST['q_sno' . $i]) ? $_POST['q_sno' . $i] : '' : '' ?>">
								</tr>
							<?php } 
							*/?>
						</tbody>
					</table>
				</div>
			</div>
	
	---->
	
<!-----Address Section--------------------------------------------------------------------------------------------------------------------->


			<div  name="info_table" id="info_table">
				<table width="100%" class="table table-striped-primary table-hover rounded ">	
					<tr class="bg-secondary text-white ">
						<th colspan="6" class="h5"><strong>Permanent Address</strong></th>
					</tr>
					<tr class="table-secondary">
						<input disabled type="hidden" name="p_sno" value="<?php echo $row['sno']; ?>">
						<th>House No./Village</th>
						<td><input disabled type="text"  class="form-control bolding bolding" id="p_address" name="p_address" value="<?php if($row['p_house_no'] != $row['p_village']){
							echo $row['p_house_no'].$row['p_village'];
							}
							else {
								echo $row['p_house_no'];
							}
						?>"  required></td>
						<th>Post</th>
						<td><input disabled type="text" class="form-control bolding bolding" id="p_post" name="p_post" value="<?php echo $row['p_post']; ?>" required></td>
						<th>Tahsil</th>
						<td><input disabled type="text" class="form-control bolding bolding" id="p_tehsil" name="p_tehsil" value="<?php echo $row['p_tehsil']; ?>" required></td>
					</tr>
					<tr>
						<th>Thana</th>
						<td><input disabled type="text" class="form-control bolding bolding" id="p_thana" name="p_thana" value="<?php echo $row['p_thana']; ?>" required></td>
						<th>District</th>
						<td><input disabled type="text" class="form-control bolding bolding" id="p_district" name="p_district" value="<?php echo $row['p_district']; ?>" required></td>
						<th>State</th>
						<td><input disabled type="text" class="form-control bolding bolding" id="p_state" name="p_state" value="<?php echo $row['p_state']; ?>" required></td>
					</tr>
					<tr>

						<th>Pin</th>
						<td><input disabled type="text" class="form-control bolding bolding"  id="p_pin" name="p_pin" value="<?php echo $row['p_pin']; ?>" required></td>
					</tr>
					<tr class="bg-secondary text-white">
						<th colspan="6" class="h5" >Correspondence Address </th>
					</tr>
					<tr class="table-secondary">
						<input disabled type="hidden" name="c_sno" value="<?php echo $row['sno']; ?>">
						<th>House No./Village</th>
						<td><input disabled type="text" class="form-control bolding bolding" id="c_address" name="c_address" value="<?php echo $row['c_address']; ?>" required></td>
						<th>Post</th>
						<td><input disabled type="text" class="form-control bolding bolding" id="c_post" name="c_post" value="<?php echo $row['c_post']; ?>" required></td>
						<th>Tahsil</th>
						<td><input disabled type="text" class="form-control bolding bolding" id="c_tehsil" name="c_tehsil" value="<?php echo $row['c_tehsil']; ?>" required></td>

					</tr>
					<tr>
						<th>Thana</th>
						<td><input disabled type="text" class="form-control bolding bolding" id="c_thana" name="c_thana" value="<?php echo $row['c_thana']; ?>" required></td>
						<th>District</th>
						<td><input disabled type="text" class="form-control bolding bolding" id="c_district" name="c_district" value="<?php echo $row['c_district']; ?>" required></td>
						<th>State</th>
						<td><input disabled type="text" class="form-control bolding bolding" id="c_state" name="c_state" value="<?php echo $row['c_state']; ?>" required></td>
					</tr>
					<tr>
						<th>Pin</th>
						<td><input disabled type="text" class="form-control bolding bolding"  id="c_pin" name="c_pin" value="<?php echo $row['c_pin']; ?>" required></td>
					</tr>

				</table>
			</div>
	
<!---Examination Section-------------------------------------------------------------------------------------------------------------------------->
					
					
					<?php
					if($class['category']=='UG'){
					?>
					<table width="100%" class="table table-bordered">
						<tr>
							<th width="15%" style="font-size:1.05rem;">Apply For NSS</th>
							<th width="25%">
								<select name="nss" class="form-control bolding bolding" id="nss" value="" tabindex="<?php echo $tab++; ?>" required>
									<option value="">---Select---</option>
									<option value="yes">YES</option>
									<option value="no">NO</option>
								</select>
							</th>
							
							<th width="15%">
								<input type="text" name="code" id="code" class="form-control bolding" placeholder="Alpha Numeric Code">
							</th>
							<th width="45%"></th>
						</tr>
					</table>
					<?php } ?>
					<?php
						if($class['category']=='PG'){
					?>
					<table width="100%" class="table table-bordered">
						<tr class="table-secondary">
							<th width="20%" style="font-size:1.05rem;">Previous University</th>
							<style>
								ul{
									margin:0;
									padding:0;
								}
								.frmSearch {
									background-color: #c6f7d0;
									
									border-radius: 4px;
								}

								#prev_uni {
									width: 450px;
								}

								#prev_uni li {
									padding:0.4rem;
									background: yellow;
									border-bottom: #bbb9b9 1px solid;
								}

								#prev_uni li:hover {
									background: #ece3d2;
									cursor: pointer;
								}

								#search-box1, #prev_uni {
									margin:0;
									
									border: #a8d4b1 1px solid;
									border-radius: 4px;
								}
								#a_suggesstion-box{
									width:450px;
									height:450px;
									position:absolute;
									overflow-y:auto;
									z-index:10;
									
								}

							</style>
							<th width="15%">
								<div class="frmSearch">
									<input type="text" class="form-control" name="prev_uni" id="prev_uni" placeholder="University Name" required />
									<div id="a_suggesstion-box"></div>
									<script>
										function select_prev_uni(val) {
											console.log(val);
											$("#prev_uni").val(val);
											$("#a_suggesstion-box").hide();
										}
									</script>
								</div>
							</th>
							<th width="50%"></th>
						</tr>
					</table>
					<script>
		$(document).ready(function() {
			function fetchUniversities() {
				$.ajax({
					type: "GET",
					url: "testing_autocomplete_university.php",
					data: '',
					beforeSend: function() {
						$("#prev_uni").css("background", "#FFF url(LoaderIcon.gif) no-repeat 165px");
					},
					success: function(data) {
						$("#a_suggesstion-box").show();
						$("#a_suggesstion-box").html(data);
						$("#prev_uni").css("background", "#FFF");
					}
				});
			}

			$("#prev_uni").click(function() {
				fetchUniversities();
			});

			$("#prev_uni").keyup(function() {
				$.ajax({
					type: "GET",
					url: "testing_autocomplete_university.php",
					data: 'prev_uni_keyword=' + $(this).val(),
					beforeSend: function() {
						$("#prev_uni").css("background", "#FFF url(LoaderIcon.gif) no-repeat 165px");
					},
					success: function(data) {
						$("#a_suggesstion-box").show();
						$("#a_suggesstion-box").html(data);
						$("#prev_uni").css("background", "#FFF");
					}
				});
			});

			// Prevent form submission if the entered value is not in the options
			$("form").submit(function(event) {
				let userInput = $("#prev_uni").val();
				let options = $("#prev_uni li").map(function() {
					return $(this).text();
				}).get();

				if (!options.includes(userInput)) {
					event.preventDefault();
					alert("Please select a university from the option.");
				}
			});
		});
	</script>
					<?php } ?>
			<style>
				.blinking-css{
				font-size: 25px;
				font-weight:bolder;
				color:aliceblue;
				animation: blink 0.7s linear infinite;
				}
				@keyframes blink{
				0%{opacity: 1; background-color:red;}
				50%{opacity: .8;}
				100%{opacity: 1;background-color:green;}
				}
				.bolding{
					font-weight:bolder;
				}
				th{
					font-weight:bolder;
				}
				
			</style>
			<div class="row">
				<div class="col-md-12">
					<div class="bg-secondary  p-3 my-2" ><span style="font-size:20px;color:aliceblue;margin-right:30px;" class="bolding">Subject & Paper Details</span><button class=" blinking-css btn btn-danger"><b>(Carefully Read and Submit)</b> </button></div>

					<table class="table  table-bordered table-striped " width="100%">
						<tr class="bg-secondary text-white">
							<th width="7%" class="bolding">S. No.</th>
							<th width="15%" class="bolding">TYPE</th>
							<th width="18%" class="bolding">SUBJECT</th>
							<th width="15%" class="bolding">PAPER CODE </th>
							<th width="35%" class="bolding">PAPER NAME </th>
							<th width="10%" class="bolding">CREDIT</th>
						</tr>
							<?php
							$paper1 = $papers[1];
							//print_r($papers);
							$i=1;
							foreach($papers as $key=>$val){
								foreach($val as $k=>$v){
									if($k!=='subject_name'){
										echo '<tr class="table-danger "><td class="bolding">'.$i++.'</td>
										<td class="bolding">'.$v['type'].'</td>
										<td class="bolding">'.$val['subject_name'].'</td>
										<td class="bolding">'.$v['paper_code'].'</td>
										<td class="bolding">'.$v['title_of_paper'].'</td>
										<td class="bolding">'.$v['credit'].'</td>
										</tr>';
									}
								}
							}

						
						?>
					</table>
					<!--<?php
					if($class['category']=='PG'){
					?>
					<table width="100%" class="table table-bordered">
						<tr class="table-secondary">
							<th width="15%" style="font-size:1.05rem;">Previous University</th>
							<th width="25%">
								<select name="prev_univ" class="form-control bolding bolding" id="selectOption" value="<?php if(isset($_POST['prev_univ'])){echo $_POST['prev_univ'];} ?>" onFocus="fnTXTFocus(this.id)" tabindex="<?php echo $tab++; ?>" required>
									<option disabled <?php echo isset($_GET['edit'])? "":' selected = "selected" '?> value="">---Select Your Course Type---</option>
									<?php 
										$sql  = 'select * from university_list';
										$univ_list = execute_query( $sql);
										if($univ_list){
											while($list = mysqli_fetch_assoc($univ_list)){
												echo '<option  value = "'.$list['sno'].'" '.(isset($_GET['edit']) && $data['course_type'] == $list['sno'] ? ' selected = "selected" ':"").'>'.$list['university'].'</option>';
											}
										}
									?>
							</th>
							<th width="60%"></th>
						</tr>
					   
					</table>
					<?php } ?>
					<?php
					if($class['category']=='UG'){
					?>
					<table width="100%" class="table table-bordered">
						<tr>
							<th width="15%" style="font-size:1.05rem;">Apply For NSS</th>
							<th width="25%">
								<select name="nss" class="form-control bolding bolding" id="nss" value="" tabindex="<?php echo $tab++; ?>" required>
									<option value="">---Select---</option>
									<option value="yes">YES</option>
									<option value="no">NO</option>
								</select>
							</th>
							
							<th width="15%">
								<input type="text" name="code" id="code" class="form-control bolding" placeholder="Alpha Numeric Code">
							</th>
							<th width="45%"></th>
						</tr>
					</table>
					<?php } ?>-->
<!---Check Disclemer-------------------------------------------------------------------------------------------->
					
					<input type="checkbox" class="ms-2" style="width:30px;" required><h5 class="bolding ms-5" style="margin-top:-22px;">Dear Student, Please check your subjects carefully, There will not be subject related any changes after filling the final form.<br><br> (प्रिय छात्र/छात्रा, अपने विषयो को ध्यानपूर्वक जाँच कर ले, अंतिम फॉर्म भरने के बाद विषय सम्बन्धित कोई बदलाव नही होगा।) </h5></input><br>
					<script>
						var nssSelect = document.getElementById("nss");
						var codeInput = document.getElementById("code");

						// Initially, hide the input box
						codeInput.style.display = "none";
						codeInput.removeAttribute("required");

						// When the dropdown changes
						nssSelect.addEventListener("change", function() {
							if (this.value === "yes") {
								// If "yes" is selected, show the input box and make it required
								codeInput.style.display = "block";
								codeInput.setAttribute("required", "required");
							} else {
								// If "no" is selected, hide the input box and remove the required attribute
								codeInput.style.display = "none";
								codeInput.removeAttribute("required");
							}
						});
					</script>
					<script>
						function validateForm() {
							var selectedOption = document.getElementById('selectOption').value;
							if (selectedOption === "") {
								alert("Please select University");
								return false;
							}
							return true;
						}
					</script>


					<input type="hidden" name="student_id" value="<?php echo $row['sno']; ?>" />
					
					<center><button type="submit" class="btn btn-danger" name="submit" value="Submit">Proceed to Payment</button></center><br>
				</div>
			</div>

			
		</form>
<!--END Form-------------------------------------------------------------------------------------------------------------------------->

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
			function fnTXTFocus(id)	{

				var objTXT = document.getElementById(id)
				objTXT.style.borderColor = "Red";

					}

			function fnTXTLostFocus(id)	{
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
			
			function copy_address(){
				var address = document.getElementById('t_address').value;
				document.getElementById('address').value = address;
			}
		</script>
				<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script>
			// $(document).ready(function() {
				// function fetchUniversities() {
					// $.ajax({
						// type: "GET",
						// url: "testing_autocomplete_university.php",
						// data: '',
						// beforeSend: function() {
							// $("#prev_uni").css("background", "#FFF url(LoaderIcon.gif) no-repeat 165px");
						// },
						// success: function(data) {
							// $("#a_suggesstion-box").show();
							// $("#a_suggesstion-box").html(data);
							// $("#prev_uni").css("background", "#FFF");
						// }
					// });
				// }

				// $("#prev_uni").click(function() {
					// fetchUniversities();
				// });

				// $("#prev_uni").keyup(function() {
					// $.ajax({
						// type: "GET",
						// url: "testing_autocomplete_university.php",
						// data: 'prev_uni_keyword=' + $(this).val(),
						// beforeSend: function() {
							// $("#prev_uni").css("background", "#FFF url(LoaderIcon.gif) no-repeat 165px");
						// },
						// success: function(data) {
							// $("#a_suggesstion-box").show();
							// $("#a_suggesstion-box").html(data);
							// $("#prev_uni").css("background", "#FFF");
						// }
					// });
				// });
			// });
	</script>
	
	</div>
</div> 
<?php 
		break;
	}
}
	page_footer();
	ob_end_flush();
?>

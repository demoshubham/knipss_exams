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
	<style>
		.combobox-list {
  position: relative;
}

.combobox .group {
  display: inline-flex;
  padding: 4px;
  cursor: pointer;
}

.combobox input,
.combobox button {
  background-color: white;
  color: black;
  box-sizing: border-box;
  height: 30px;
  padding: 0;
  margin: 0;
  vertical-align: bottom;
  border: 1px solid gray;
  position: relative;
  cursor: pointer;
}

.combobox input {
  width: 150px;
  border-right: none;
  outline: none;
  font-size: 87.5%;
  padding: 1px 3px;
}

.combobox button {
  width: 19px;
  border-left: none;
  outline: none;
  color: rgb(0 90 156);
}

.combobox button[aria-expanded="true"] svg {
  transform: rotate(180deg) translate(0, -3px);
}

ul[role="listbox"] {
  margin: 0;
  padding: 0;
  position: absolute;
  left: 4px;
  top: 34px;
  list-style: none;
  background-color: white;
  display: none;
  box-sizing: border-box;
  border: 2px currentcolor solid;
  max-height: 250px;
  width: 168px;
  overflow: scroll;
  overflow-x: hidden;
  font-size: 87.5%;
  cursor: pointer;
}

ul[role="listbox"] li[role="option"] {
  margin: 0;
  display: block;
  padding-left: 3px;
  padding-top: 2px;
  padding-bottom: 2px;
}

/* focus and hover styling */

.combobox .group.focus,
.combobox .group:hover {
  padding: 2px;
  border: 2px solid currentcolor;
  border-radius: 4px;
}

.combobox .group.focus polygon,
.combobox .group:hover polygon {
  fill-opacity: 1;
}

.combobox .group.focus input,
.combobox .group.focus button,
.combobox .group input:hover,
.combobox .group button:hover {
  background-color: #def;
}

[role="listbox"].focus [role="option"][aria-selected="true"],
[role="listbox"] [role="option"]:hover {
  background-color: #def;
  padding-top: 0;
  padding-bottom: 0;
  border-top: 2px solid currentcolor;
  border-bottom: 2px solid currentcolor;
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
						<input id="uin_no" name="uin_no" type="text" spellcheck="false" class="form-control" value="" maxlength="20" tabindex="1" onBlur="checkname('uin_no')" placeholder="Enter UIN Number." /><p class="instruct" id="instruct1"><small>This field is required.</small></p>
					</td>
				</tr>
				<tr>
					<td><label  class="desc fs-6 p-2" id="title2" for="Field2">Date of Birth <span id="req_1" class="req">*</span></label></td>
				</tr>
			
				<tr>
					<td>
						<input id="dob" name="dob" type="date" spellcheck="false" class="form-control" value="" maxlength="20" /><p class="instruct"  id="instruct1"><small>This field is required.</small></p>
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
	$sql = "INSERT INTO `exam_student_info`(`student_info_sno`, `student_name`, `college_roll_no`, `dob`, `mobile_no`, `uin_no`, `status`, `created_by`, `creation_time`) 
	VALUES ('".$sub_data['sno']."',
            '".$sub_data['stu_name']."',
            '".$sub_data['roll_no']."',
            '".$sub_data['dob']."',
            '".$sub_data['mobile']."',
            '".$sub_data['university_uin']."',
            '".$sub_data['status']."',
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


<!---Examination Section-------------------------------------------------------------------------------------------------------------------------->
	
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
		font-weight:bolder; bolder
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
					<?php
					if($class['category']=='PG'){
					?>
					<table width="100%" class="table table-bordered">
						<tr class="table-secondary">
							<th width="15%" style="font-size:1.05rem;">Previous University</th>
							<th width="25%">
								<select name="prev_univ" class="form-control" id="selectOption" value="<?php if(isset($_POST['prev_univ'])){echo $_POST['prev_univ'];} ?>" onFocus="fnTXTFocus(this.id)" tabindex="<?php echo $tab++; ?>" required>
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
								<select name="nss" class="form-control" id="nss" value="" tabindex="<?php echo $tab++; ?>" required>
									<option value="">---Select---</option>
									<option value="yes">YES</option>
									<option value="no">NO</option>
								</select>
							</th>
							
							<th width="15%">
								<input type="text" name="code" id="code" class="form-control" placeholder="Alpha Numeric Code">
							</th>
							<th width="45%"></th>
						</tr>
					</table>
					<?php } ?>
					<label for="cb1-input">State</label>
<div class="combobox combobox-list">
  <div class="group">
    <input id="cb1-input" class="cb_edit" type="text" role="combobox" aria-autocomplete="list" aria-expanded="false" aria-controls="cb1-listbox">
    <button id="cb1-button" tabindex="-1" aria-label="States" aria-expanded="false" aria-controls="cb1-listbox">
      <svg width="18" height="16" aria-hidden="true" focusable="false" style="forced-color-adjust: auto">
        <polygon class="arrow" stroke-width="0" fill-opacity="0.75" fill="currentcolor" points="3,6 15,6 9,14"></polygon>
      </svg>
    </button>
  </div>
  <ul id="cb1-listbox" role="listbox" aria-label="States">
    <li id="lb1-al" role="option">Alabama</li>
    <li id="lb1-ak" role="option">Alaska</li>
    <li id="lb1-as" role="option">American Samoa</li>
    <li id="lb1-az" role="option">Arizona</li>
    <li id="lb1-ar" role="option">Arkansas</li>
    <li id="lb1-ca" role="option">California</li>
    <li id="lb1-co" role="option">Colorado</li>
    <li id="lb1-ct" role="option">Connecticut</li>
    <li id="lb1-de" role="option">Delaware</li>
    <li id="lb1-dc" role="option">District of Columbia</li>
    <li id="lb1-fl" role="option">Florida</li>
    <li id="lb1-ga" role="option">Georgia</li>
    <li id="lb1-gm" role="option">Guam</li>
    <li id="lb1-hi" role="option">Hawaii</li>
    <li id="lb1-id" role="option">Idaho</li>
    <li id="lb1-il" role="option">Illinois</li>
    <li id="lb1-in" role="option">Indiana</li>
    <li id="lb1-ia" role="option">Iowa</li>
    <li id="lb1-ks" role="option">Kansas</li>
    <li id="lb1-ky" role="option">Kentucky</li>
    <li id="lb1-la" role="option">Louisiana</li>
    <li id="lb1-me" role="option">Maine</li>
    <li id="lb1-md" role="option">Maryland</li>
    <li id="lb1-ma" role="option">Massachusetts</li>
    <li id="lb1-mi" role="option">Michigan</li>
    <li id="lb1-mn" role="option">Minnesota</li>
    <li id="lb1-ms" role="option">Mississippi</li>
    <li id="lb1-mo" role="option">Missouri</li>
    <li id="lb1-mt" role="option">Montana</li>
    <li id="lb1-ne" role="option">Nebraska</li>
    <li id="lb1-nv" role="option">Nevada</li>
    <li id="lb1-nh" role="option">New Hampshire</li>
    <li id="lb1-nj" role="option">New Jersey</li>
    <li id="lb1-nm" role="option">New Mexico</li>
    <li id="lb1-ny" role="option">New York</li>
    <li id="lb1-nc" role="option">North Carolina</li>
    <li id="lb1-nd" role="option">North Dakota</li>
    <li id="lb1-mp" role="option">Northern Marianas Islands</li>
    <li id="lb1-oh" role="option">Ohio</li>
    <li id="lb1-ok" role="option">Oklahoma</li>
    <li id="lb1-or" role="option">Oregon</li>
    <li id="lb1-pa" role="option">Pennsylvania</li>
    <li id="lb1-pr" role="option">Puerto Rico</li>
    <li id="lb1-ri" role="option">Rhode Island</li>
    <li id="lb1-sc" role="option">South Carolina</li>
    <li id="lb1-sd" role="option">South Dakota</li>
    <li id="lb1-tn" role="option">Tennessee</li>
    <li id="lb1-tx" role="option">Texas</li>
    <li id="lb1-ut" role="option">Utah</li>
    <li id="lb1-ve" role="option">Vermont</li>
    <li id="lb1-va" role="option">Virginia</li>
    <li id="lb1-vi" role="option">Virgin Islands</li>
    <li id="lb1-wa" role="option">Washington</li>
    <li id="lb1-wv" role="option">West Virginia</li>
    <li id="lb1-wi" role="option">Wisconsin</li>
    <li id="lb1-wy" role="option">Wyoming</li>
  </ul>
</div>
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
					
					<center><button type="submit" class="btn btn-danger" name="submit" value="Submit">Proceed to Payment</button></center>
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
		<script>
	/*
 *   This content is licensed according to the W3C Software License at
 *   https://www.w3.org/Consortium/Legal/2015/copyright-software-and-document
 */

'use strict';

class ComboboxAutocomplete {
  constructor(comboboxNode, buttonNode, listboxNode) {
    this.comboboxNode = comboboxNode;
    this.buttonNode = buttonNode;
    this.listboxNode = listboxNode;

    this.comboboxHasVisualFocus = false;
    this.listboxHasVisualFocus = false;

    this.hasHover = false;

    this.isNone = false;
    this.isList = false;
    this.isBoth = false;

    this.allOptions = [];

    this.option = null;
    this.firstOption = null;
    this.lastOption = null;

    this.filteredOptions = [];
    this.filter = '';

    var autocomplete = this.comboboxNode.getAttribute('aria-autocomplete');

    if (typeof autocomplete === 'string') {
      autocomplete = autocomplete.toLowerCase();
      this.isNone = autocomplete === 'none';
      this.isList = autocomplete === 'list';
      this.isBoth = autocomplete === 'both';
    } else {
      // default value of autocomplete
      this.isNone = true;
    }

    this.comboboxNode.addEventListener(
      'keydown',
      this.onComboboxKeyDown.bind(this)
    );
    this.comboboxNode.addEventListener(
      'keyup',
      this.onComboboxKeyUp.bind(this)
    );
    this.comboboxNode.addEventListener(
      'click',
      this.onComboboxClick.bind(this)
    );
    this.comboboxNode.addEventListener(
      'focus',
      this.onComboboxFocus.bind(this)
    );
    this.comboboxNode.addEventListener('blur', this.onComboboxBlur.bind(this));

    document.body.addEventListener(
      'pointerup',
      this.onBackgroundPointerUp.bind(this),
      true
    );

    // initialize pop up menu

    this.listboxNode.addEventListener(
      'pointerover',
      this.onListboxPointerover.bind(this)
    );
    this.listboxNode.addEventListener(
      'pointerout',
      this.onListboxPointerout.bind(this)
    );

    // Traverse the element children of domNode: configure each with
    // option role behavior and store reference in.options array.
    var nodes = this.listboxNode.getElementsByTagName('LI');

    for (var i = 0; i < nodes.length; i++) {
      var node = nodes[i];
      this.allOptions.push(node);

      node.addEventListener('click', this.onOptionClick.bind(this));
      node.addEventListener('pointerover', this.onOptionPointerover.bind(this));
      node.addEventListener('pointerout', this.onOptionPointerout.bind(this));
    }

    this.filterOptions();

    // Open Button

    var button = this.comboboxNode.nextElementSibling;

    if (button && button.tagName === 'BUTTON') {
      button.addEventListener('click', this.onButtonClick.bind(this));
    }
  }

  getLowercaseContent(node) {
    return node.textContent.toLowerCase();
  }

  isOptionInView(option) {
    var bounding = option.getBoundingClientRect();
    return (
      bounding.top >= 0 &&
      bounding.left >= 0 &&
      bounding.bottom <=
        (window.innerHeight || document.documentElement.clientHeight) &&
      bounding.right <=
        (window.innerWidth || document.documentElement.clientWidth)
    );
  }

  setActiveDescendant(option) {
    if (option && this.listboxHasVisualFocus) {
      this.comboboxNode.setAttribute('aria-activedescendant', option.id);
      if (!this.isOptionInView(option)) {
        option.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
      }
    } else {
      this.comboboxNode.setAttribute('aria-activedescendant', '');
    }
  }

  setValue(value) {
    this.filter = value;
    this.comboboxNode.value = this.filter;
    this.comboboxNode.setSelectionRange(this.filter.length, this.filter.length);
    this.filterOptions();
  }

  setOption(option, flag) {
    if (typeof flag !== 'boolean') {
      flag = false;
    }

    if (option) {
      this.option = option;
      this.setCurrentOptionStyle(this.option);
      this.setActiveDescendant(this.option);

      if (this.isBoth) {
        this.comboboxNode.value = this.option.textContent;
        if (flag) {
          this.comboboxNode.setSelectionRange(
            this.option.textContent.length,
            this.option.textContent.length
          );
        } else {
          this.comboboxNode.setSelectionRange(
            this.filter.length,
            this.option.textContent.length
          );
        }
      }
    }
  }

  setVisualFocusCombobox() {
    this.listboxNode.classList.remove('focus');
    this.comboboxNode.parentNode.classList.add('focus'); // set the focus class to the parent for easier styling
    this.comboboxHasVisualFocus = true;
    this.listboxHasVisualFocus = false;
    this.setActiveDescendant(false);
  }

  setVisualFocusListbox() {
    this.comboboxNode.parentNode.classList.remove('focus');
    this.comboboxHasVisualFocus = false;
    this.listboxHasVisualFocus = true;
    this.listboxNode.classList.add('focus');
    this.setActiveDescendant(this.option);
  }

  removeVisualFocusAll() {
    this.comboboxNode.parentNode.classList.remove('focus');
    this.comboboxHasVisualFocus = false;
    this.listboxHasVisualFocus = false;
    this.listboxNode.classList.remove('focus');
    this.option = null;
    this.setActiveDescendant(false);
  }

  // ComboboxAutocomplete Events

  filterOptions() {
    // do not filter any options if autocomplete is none
    if (this.isNone) {
      this.filter = '';
    }

    var option = null;
    var currentOption = this.option;
    var filter = this.filter.toLowerCase();

    this.filteredOptions = [];
    this.listboxNode.innerHTML = '';

    for (var i = 0; i < this.allOptions.length; i++) {
      option = this.allOptions[i];
      if (
        filter.length === 0 ||
        this.getLowercaseContent(option).indexOf(filter) === 0
      ) {
        this.filteredOptions.push(option);
        this.listboxNode.appendChild(option);
      }
    }

    // Use populated options array to initialize firstOption and lastOption.
    var numItems = this.filteredOptions.length;
    if (numItems > 0) {
      this.firstOption = this.filteredOptions[0];
      this.lastOption = this.filteredOptions[numItems - 1];

      if (currentOption && this.filteredOptions.indexOf(currentOption) >= 0) {
        option = currentOption;
      } else {
        option = this.firstOption;
      }
    } else {
      this.firstOption = null;
      option = null;
      this.lastOption = null;
    }

    return option;
  }

  setCurrentOptionStyle(option) {
    for (var i = 0; i < this.filteredOptions.length; i++) {
      var opt = this.filteredOptions[i];
      if (opt === option) {
        opt.setAttribute('aria-selected', 'true');
        if (
          this.listboxNode.scrollTop + this.listboxNode.offsetHeight <
          opt.offsetTop + opt.offsetHeight
        ) {
          this.listboxNode.scrollTop =
            opt.offsetTop + opt.offsetHeight - this.listboxNode.offsetHeight;
        } else if (this.listboxNode.scrollTop > opt.offsetTop + 2) {
          this.listboxNode.scrollTop = opt.offsetTop;
        }
      } else {
        opt.removeAttribute('aria-selected');
      }
    }
  }

  getPreviousOption(currentOption) {
    if (currentOption !== this.firstOption) {
      var index = this.filteredOptions.indexOf(currentOption);
      return this.filteredOptions[index - 1];
    }
    return this.lastOption;
  }

  getNextOption(currentOption) {
    if (currentOption !== this.lastOption) {
      var index = this.filteredOptions.indexOf(currentOption);
      return this.filteredOptions[index + 1];
    }
    return this.firstOption;
  }

  /* MENU DISPLAY METHODS */

  doesOptionHaveFocus() {
    return this.comboboxNode.getAttribute('aria-activedescendant') !== '';
  }

  isOpen() {
    return this.listboxNode.style.display === 'block';
  }

  isClosed() {
    return this.listboxNode.style.display !== 'block';
  }

  hasOptions() {
    return this.filteredOptions.length;
  }

  open() {
    this.listboxNode.style.display = 'block';
    this.comboboxNode.setAttribute('aria-expanded', 'true');
    this.buttonNode.setAttribute('aria-expanded', 'true');
  }

  close(force) {
    if (typeof force !== 'boolean') {
      force = false;
    }

    if (
      force ||
      (!this.comboboxHasVisualFocus &&
        !this.listboxHasVisualFocus &&
        !this.hasHover)
    ) {
      this.setCurrentOptionStyle(false);
      this.listboxNode.style.display = 'none';
      this.comboboxNode.setAttribute('aria-expanded', 'false');
      this.buttonNode.setAttribute('aria-expanded', 'false');
      this.setActiveDescendant(false);
      this.comboboxNode.parentNode.classList.add('focus');
    }
  }

  /* combobox Events */

  onComboboxKeyDown(event) {
    var flag = false,
      altKey = event.altKey;

    if (event.ctrlKey || event.shiftKey) {
      return;
    }

    switch (event.key) {
      case 'Enter':
        if (this.listboxHasVisualFocus) {
          this.setValue(this.option.textContent);
        }
        this.close(true);
        this.setVisualFocusCombobox();
        flag = true;
        break;

      case 'Down':
      case 'ArrowDown':
        if (this.filteredOptions.length > 0) {
          if (altKey) {
            this.open();
          } else {
            this.open();
            if (
              this.listboxHasVisualFocus ||
              (this.isBoth && this.filteredOptions.length > 1)
            ) {
              this.setOption(this.getNextOption(this.option), true);
              this.setVisualFocusListbox();
            } else {
              this.setOption(this.firstOption, true);
              this.setVisualFocusListbox();
            }
          }
        }
        flag = true;
        break;

      case 'Up':
      case 'ArrowUp':
        if (this.hasOptions()) {
          if (this.listboxHasVisualFocus) {
            this.setOption(this.getPreviousOption(this.option), true);
          } else {
            this.open();
            if (!altKey) {
              this.setOption(this.lastOption, true);
              this.setVisualFocusListbox();
            }
          }
        }
        flag = true;
        break;

      case 'Esc':
      case 'Escape':
        if (this.isOpen()) {
          this.close(true);
          this.filter = this.comboboxNode.value;
          this.filterOptions();
          this.setVisualFocusCombobox();
        } else {
          this.setValue('');
          this.comboboxNode.value = '';
        }
        this.option = null;
        flag = true;
        break;

      case 'Tab':
        this.close(true);
        if (this.listboxHasVisualFocus) {
          if (this.option) {
            this.setValue(this.option.textContent);
          }
        }
        break;

      case 'Home':
        this.comboboxNode.setSelectionRange(0, 0);
        flag = true;
        break;

      case 'End':
        var length = this.comboboxNode.value.length;
        this.comboboxNode.setSelectionRange(length, length);
        flag = true;
        break;

      default:
        break;
    }

    if (flag) {
      event.stopPropagation();
      event.preventDefault();
    }
  }

  isPrintableCharacter(str) {
    return str.length === 1 && str.match(/\S| /);
  }

  onComboboxKeyUp(event) {
    var flag = false,
      option = null,
      char = event.key;

    if (this.isPrintableCharacter(char)) {
      this.filter += char;
    }

    // this is for the case when a selection in the textbox has been deleted
    if (this.comboboxNode.value.length < this.filter.length) {
      this.filter = this.comboboxNode.value;
      this.option = null;
      this.filterOptions();
    }

    if (event.key === 'Escape' || event.key === 'Esc') {
      return;
    }

    switch (event.key) {
      case 'Backspace':
        this.setVisualFocusCombobox();
        this.setCurrentOptionStyle(false);
        this.filter = this.comboboxNode.value;
        this.option = null;
        this.filterOptions();
        flag = true;
        break;

      case 'Left':
      case 'ArrowLeft':
      case 'Right':
      case 'ArrowRight':
      case 'Home':
      case 'End':
        if (this.isBoth) {
          this.filter = this.comboboxNode.value;
        } else {
          this.option = null;
          this.setCurrentOptionStyle(false);
        }
        this.setVisualFocusCombobox();
        flag = true;
        break;

      default:
        if (this.isPrintableCharacter(char)) {
          this.setVisualFocusCombobox();
          this.setCurrentOptionStyle(false);
          flag = true;

          if (this.isList || this.isBoth) {
            option = this.filterOptions();
            if (option) {
              if (this.isClosed() && this.comboboxNode.value.length) {
                this.open();
              }

              if (
                this.getLowercaseContent(option).indexOf(
                  this.comboboxNode.value.toLowerCase()
                ) === 0
              ) {
                this.option = option;
                if (this.isBoth || this.listboxHasVisualFocus) {
                  this.setCurrentOptionStyle(option);
                  if (this.isBoth) {
                    this.setOption(option);
                  }
                }
              } else {
                this.option = null;
                this.setCurrentOptionStyle(false);
              }
            } else {
              this.close();
              this.option = null;
              this.setActiveDescendant(false);
            }
          } else if (this.comboboxNode.value.length) {
            this.open();
          }
        }

        break;
    }

    if (flag) {
      event.stopPropagation();
      event.preventDefault();
    }
  }

  onComboboxClick() {
    if (this.isOpen()) {
      this.close(true);
    } else {
      this.open();
    }
  }

  onComboboxFocus() {
    this.filter = this.comboboxNode.value;
    this.filterOptions();
    this.setVisualFocusCombobox();
    this.option = null;
    this.setCurrentOptionStyle(null);
  }

  onComboboxBlur() {
    this.removeVisualFocusAll();
  }

  onBackgroundPointerUp(event) {
    if (
      !this.comboboxNode.contains(event.target) &&
      !this.listboxNode.contains(event.target) &&
      !this.buttonNode.contains(event.target)
    ) {
      this.comboboxHasVisualFocus = false;
      this.setCurrentOptionStyle(null);
      this.removeVisualFocusAll();
      setTimeout(this.close.bind(this, true), 300);
    }
  }

  onButtonClick() {
    if (this.isOpen()) {
      this.close(true);
    } else {
      this.open();
    }
    this.comboboxNode.focus();
    this.setVisualFocusCombobox();
  }

  /* Listbox Events */

  onListboxPointerover() {
    this.hasHover = true;
  }

  onListboxPointerout() {
    this.hasHover = false;
    setTimeout(this.close.bind(this, false), 300);
  }

  // Listbox Option Events

  onOptionClick(event) {
    this.comboboxNode.value = event.target.textContent;
    this.close(true);
  }

  onOptionPointerover() {
    this.hasHover = true;
    this.open();
  }

  onOptionPointerout() {
    this.hasHover = false;
    setTimeout(this.close.bind(this, false), 300);
  }
}

// Initialize comboboxes

window.addEventListener('load', function () {
  var comboboxes = document.querySelectorAll('.combobox-list');

  for (var i = 0; i < comboboxes.length; i++) {
    var combobox = comboboxes[i];
    var comboboxNode = combobox.querySelector('input');
    var buttonNode = combobox.querySelector('button');
    var listboxNode = combobox.querySelector('[role="listbox"]');
    new ComboboxAutocomplete(comboboxNode, buttonNode, listboxNode);
  }
});
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

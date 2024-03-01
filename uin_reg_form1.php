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

///	$sup=dbconnect($_POST[$id]);
if(isset($_POST['login_button'])) {
	 if($_POST['registration_no']!='') {
		$sql = 'select * from register_users where user_name="'.$_POST['registration_no'].'"';
       // echo $sql;
		$result = execute_query($sql,dbconnect());
		if($result && mysqli_num_rows($result)!=0) {			
			$row = mysqli_fetch_array($result);
			if(isset($_POST['login_dob']) && $_POST['login_dob']==$row['password']) {
				$_SESSION['username'] = $row['user_name'];
				$_SESSION['session_id'] = randomstring();
				$_SESSION['startdate'] = date('Y-m-d');
				$time = localtime();
		        $time = $time[2].':'.$time[1].':'.$time[0];
				//echo $time;
		        $_SESSION['starttime']=$time;
				$sql = " INSERT INTO `session` (`user` ,`s_id` ,`s_start_date` ,`s_start_time`, `ip`)
				VALUES ('".$_SESSION['username']."', '".$_SESSION['session_id']."', '".$_SESSION['startdate']."', '".$_SESSION['starttime']."' , '".$_SERVER['REMOTE_ADDR']."')";
		        execute_query($sql,dbconnect());
                header('location: admission_form.php?id='.$row['sno']);
			}
			else {
                echo '<script>alert("Please Enter Valid User Password" )</script>';
				$response=1;
			}
		}
		else {
                echo '<script>alert("Please Enter Valid Registration no" )</script>';
				$response=1;
		}		 
	 }
	 else {
        echo '<script>alert("Please Enter Valid Registration no and  Password" )</script>';
		 $response=1;
	 }
 }

if(isset($_POST['pre_registration_form'])){	
		$sql = 'select * from register_users where mobile="'.$_POST['mobile'].'"';
		$result_email = execute_query($sql,dbconnect());
		if(mysqli_num_rows($result_email)!=0){
			$row_email = mysqli_fetch_array($result_email);
			if($row_email['mobile']==$_POST['mobile'] || $row_email['e_mail']==$_POST['email']){
				$msg .= '<li><h3>Mobile or email already registered| Please Login</h3></li>';
				$response = 1;
			}
			
		}
		
		if($msg==''){
			$sql = 'insert into register_users (full_name, father_name, mother_name, date_of_birth, mobile, e_mail, ip_address, timestamp, datestamp) values("'.$_POST['candidate_name'].'", "'.$_POST['father_name'].'", "'.$_POST['mother_name'].'", "'.$_POST['dob'].'", "'.$_POST['mobile'].'", "'.$_POST['e_mail'].'", "'.$_SERVER['REMOTE_ADDR'].'", "'.date("H:i:s").'", "'.date("Y-m-d").'")';
			execute_query($sql, dbconnect());
            $id = mysqli_insert_id($db);
            
			if(mysqli_error( dbconnect())){
				$msg .= '<li><h3>Error # 1 : Contact admin. '.$sql.'</h3></li>';
			}
			else{
				$sql = 'insert into new_student_info (sno, candidate_name, father_name, mother_name, dob, mobile, email,course_type, course_applying_for,category,aadhar,fee)
				 values("'.$id.'", "'.$_POST['candidate_name'].'", "'.$_POST['father_name'].'", "'.$_POST['mother_name'].'", "'.$_POST['dob'].'", "'.$_POST['mobile'].'", "'.$_POST['e_mail'].'","'.$_POST['course_type'].'","'.$_POST['course_appled_for'].'","'.$_POST['category'].'","'.$_POST['aadhar'].'","'.$_POST['fee'].'")';
				//echo $sql;
                 execute_query($sql, dbconnect());
                if(mysqli_error( dbconnect())){
                    $msg .= '<li><h3>Error # 1 : Contact admin. '.$sql.'</h3></li>';
                }
                // $reg_no = str_pad($id, 6, "0", STR_PAD_LEFT);
                // $year = date("Y");
				$reg_no = date('Y').str_pad($id,5, '0', STR_PAD_LEFT);
				$sql = 'update register_users set user_name="'.$reg_no.'", password="'.$_POST['dob'].'" where sno='.$id;
				execute_query($sql,dbconnect());
                if(mysqli_error( dbconnect())){
                    $msg .= '<li><h3>Error # 1 : Contact admin. '.$sql.'</h3></li>';
                }
                else{
					echo '<script>alert("Dear applicant, your detail have been saved successfully.- please note your application number for future reference-'.$reg_no.'. Also check you email and text message on registered email id and mobile no. For any further communication.")</script>';
                    $response=4;
                }
			}
			
		}
	
}	

if(isset($_POST['continue'])){
	
	
}

page_header();
?>


<?php
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
    form.setAttribute("action", "index.php");

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
	}
	if(val==1){
		console.log(val);
		document.getElementById("div_transaction_id").classList.remove("OAP_active");
		document.getElementById("div_dob").classList.remove("OAP_hidden");
		document.getElementById("div_dob").classList.add("OAP_active");
		document.getElementById("div_transaction_id").classList.add("OAP_hidden");
	}
}


</script>
<div class="panel panel-default " style="width:550px; margin-left:20px; float:left; font-size:18px; font-weight:bold; overflow-y: scroll; height: 340px; line-height: 36px; padding: 10px; color: #666;">
	<div class="bg-primary text-white"><a class=" text-white" >New Candidate Registration - Process</a></div>
	<div class="panel-body">
		<ul class="fa-ul"></ul>
		<table class="table table-condensed rounded" cellpadding="5" cellspacing="5">
			<tbody >
				<tr style="margin-left:10px;">
					<td><u>Step 1</u> - Click on Pre-Registration For Fees Paymen</td>
				</tr>
				<tr>
					<td><u>Step 2</u> - Online Fee Paymen</td>
				</tr>
				<tr>
					<td> <u>Step 3</u> - Fill complete Entrance Form with Transaction ID and Registration I</td>
				</tr>
				<tr>
					<td><u>Step 4</u> - Fill Important Details</td>
				</tr>
				<tr>
					<td><u>Step 5</u> - Upload Photo and Signature</td>
				</tr>
				<tr>
					<td><u>Step 6</u> -  Final Submission</td>
				</tr>
				<tr>
					<td><u>Step 7</u> -Take Print of Form for Future Reference</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>

<div id="container" class="ltr" style="width:550px; float:right; margin-right:25px; height: 340px;">
	<form id="loginform" name="login" class="wufoo page" autocomplete="off" enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
	<h2 >Online Admission Portal</h2>
	<?php echo $msg; ?>
	<table style="width:100%">
		<!--<tr>
			<td><input id="register" name="register" class="btTxt submit blink_me" type="button" onclick="register_now()" value="Click Here to Register" tabindex="100"/></td>
		</tr>-->
			<tr>
			<td><div class="form-check">
  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="1" checked onchange="toggleOAP(1)">
  <label class="form-check-label" for="flexRadioDefault1">
    If Your Pre-Registration is Complete and Payment is not Done
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="2" onchange="toggleOAP(2)">
  <label class="form-check-label" for="flexRadioDefault2">
   If Your Pre-Registration and Payment is Complete
Application No .* (after pre-registration) 
  </label>
</div></td>
		</tr>
		<tr>
			<td><label  class="desc" id="title2" for="Field2">Registration Number <span id="req_1" class="req">*</span></label></td>
		</tr>
	
		<tr>
			<td><input id="registration_no" name="registration_no" type="text" spellcheck="false" class="field text large" value="" maxlength="20" tabindex="1" onBlur="checkname('registration_no')" /><p class="instruct" id="instruct1"><small>This field is required.</small></p></td>
		</tr>
		<tr>
			<td>
				<div class="OAP_hidden" id="div_transaction_id">
				<label class="desc" for="transaction_id">Transaction ID <span class="req">*</span></label>
				<input id="transaction_id" name="transaction_id" type="text" spellcheck="false" class="field text large" value="" maxlength="20" tabindex="2" onBlur="checkname('transaction_id')"  /><p class="instruct" id="instruct3"><small>This field is required.</small></p>
				</div>
				<div class="OAP_active" id="div_dob">
				<label class="desc" for="dob">DOB <span class="req">*</span></label>
				<input id="login_dob" name="login_dob" type="date" spellcheck="false" class="field text large" value="" maxlength="20" tabindex="2" onBlur="checkname('dob')"  /><p class="instruct" id="instruct3"><small>This field is required.</small></p>
				</div>
			</td>
		</tr>
		
	</table>
	<button id="login_button" tabindex="3" name="login_button" class="btn btn-primary " type="submit" value="Login to Application Section">Login to Application Section</button>
        <li class="buttons"><div></div></li>
    </ul>
	</form>
</div>


<div style="clear: both;"></div>
<div class="col-md-12 row">
	<div class="col-md-7">
		<h1 id="register" name="register" class="  submit blink_me bg-danger text-white mx-auto"  onclick="register_now()" value="Step 1. Pre-Registration For Fees Payment-2023" tabindex="100">Step 1. Pre-Registration For U.I.N.-2023</h1>
	</div>
</div>
<div class="container col-md-10 mx-auto p-5  " style="background-color:skyblue; border-radius:12px; ">
	<div class="container d-flex justify-content-evenly" style="position:relative;">
		<a  class="backgr1 m-4 " href="e_receipt.php" style="text-align:center;background-color:whitesmoke; color:black; width:100%;	display:flex;align-items:center;" >
			
			<div style="background-color:aliceblue; width:100%; height:40px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;">Receive Print Of UIN Slip</div>	
		</a>
		<a  class="backgr2 m-4 " href="payment_status.php" style="text-align:center;background-color:whitesmoke; color:black; width:100%; display:flex;align-items:center;" >
			<div style="background-color:aliceblue; width:100%; height:40px; display:flex;align-items:center;justify-content:center;font-size:1.4rem; " >Search Application No./Payment Status</div>	
		</a>
		
	</div>
	<div class="container gridd">
		<a class="btnn btnn1" href="extenstion.pdf" style="background-image:url('css/demo_img/lastest_newss.jpeg');background-repeat:no-repeat;background-size:contain;background-position:center;grid-area:1/1/2/3" >
			<div style="background-color:whitesmoke; opacity:0.9; font-weight:700; width:100%; height:40px;display:flex;align-items:center;justify-content:center;font-size:1.2rem;">Registration Date has been extended to 10th July</div>	
		</a>

		<a class="btnn btnn2" href="instructions.pdf" style="background-image:url('css/demo_img/imp_ins.png');background-repeat:no-repeat;background-size:contain;background-position:center;"  >
			<div style="background-color:whitesmoke; opacity:0.9; font-weight:700; width:100%; height:40px;display:flex;align-items:center;justify-content:center;font-size:1.2rem;">Important Instructions</div>	
		</a>
		<a class="btnn btnn3" href="admission_procedure.pdf" style="background-image:url('css/demo_img/online_admission2.png');background-repeat:no-repeat;background-size:contain;background-position:center;" >
			<div style="background-color:whitesmoke; opacity:0.9; font-weight:700; width:100%; height:40px;display:flex;align-items:center;justify-content:center;font-size:1.2rem;">Online Admission Procedure</div>	
		</a>
		<a class="btnn btnn4" href="notice.pdf" style="background-image:url('css/demo_img/notice.jpeg');background-repeat:no-repeat;
		background-size:contain;background-position:center;"  >
			<div style="background-color:whitesmoke; opacity:0.9; font-weight:700; width:100%; height:40px;display:flex;align-items:center;justify-content:center;font-size:1.2rem;">Notice</div>	
		</a>
		<a class="btnn btnn5" href="disclaimer.pdf" style="background-image:url('css/demo_img/disclaimer2.png');background-repeat:no-repeat;
		background-size:contain;background-position:center;" >
			<div style="background-color:whitesmoke; opacity:0.9; font-weight:700; width:100%; height:40px;display:flex;align-items:center;justify-content:center;font-size:1.2rem;">Disclaimer</div>	
		</a>
		<a class="btnn btnn6" href="refund.pdf" style="background-image:url('css/demo_img/refund_policy2.png');background-repeat:no-repeat;
		background-size:contain;background-position:center;"  >
			<div style="background-color:whitesmoke; opacity:0.9; font-weight:700; width:100%; height:40px;display:flex;align-items:center;justify-content:center;font-size:1.2rem;">Refund Policy</div>	
		</a>
		<a class="btnn btnn7" href="terms.pdf" style="background-image:url('css/demo_img/tnc.jpeg');background-repeat:no-repeat;
		background-size:contain;background-position:center;" >
			<div style="background-color:whitesmoke; opacity:0.9; font-weight:700; width:100%; height:40px;display:flex;align-items:center;justify-content:center;font-size:1.2rem;">Terms and Conditions</div>	
		</a>
		<a class="btnn btnn8" href="elegibility.pdf" style="background-image:url('css/demo_img/ness.png');background-repeat:no-repeat;
		background-size:contain;background-position:center;" >
			<div style="background-color:whitesmoke; opacity:0.9; font-weight:700; width:100%; height:40px;display:flex;align-items:center;justify-content:center;font-size:1.2rem;">प्रवेश हेतु अनिवार्य अर्हता</div>	
		</a>
		<a class="btnn btnn6" href="add_class.php" style="background-image:url('css/demo_img/refund_policy2.png');background-repeat:no-repeat;
		background-size:contain;background-position:center;"  >
			<div style="background-color:whitesmoke; opacity:0.9; font-weight:700; width:100%; height:40px;display:flex;align-items:center;justify-content:center;font-size:1.2rem;">Add Class</div>	
		</a>
	</div>
	
</div>
	<div class="card  col-md-10 ">
		<h3 class="text-danger">हेल्प डेस्क :</h3>
		<table class="table table-condensed rounded" cellpadding="5" cellspacing="5">
			  
				<tr style="margin-left:10px;">
					<td><i>1. </i> <u>समय</u> - प्रात: 10 से सायं 6 बजे तक</td>
				</tr>
				<tr>
					<td><i>2. </i><u>लैण्ड लाईन</u> - 05362-240854</td>
				</tr>
				<tr>
					<td><i>3. </i> <u>मोबाईल</u> - 7007425931</td>
				</tr>
				<tr>
					<td><i>4. </i><u>ई-मेल</u> - knipss_sln@rediffmail.com</td>
				</tr>
				<tr>
					<td><i>5. </i><u>पता</u> - कमला नेहरू भौतिक एवं सामाजिक विज्ञान संस्थान, सुल्तानपुर , उत्तर प्रदेश, 228118</td>
				</tr>
		</table>
	</div>
<?php 
		break;
	}
	case 2:{
?>

<script>
function register_now1(){
    var method = "post"; // Set method to post by default if not specified.

    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", "index.php");

	var hiddenField = document.createElement("input");
	hiddenField.setAttribute("type", "hidden");
	hiddenField.setAttribute("name", "register1");
	hiddenField.setAttribute("value", "testing");

	form.appendChild(hiddenField);
    document.body.appendChild(form);
    form.submit();	
}</script>
<div id="container" width="70%">
	<div class="card">
		<div class="card-body col-md-11  " style="background-color:#E5E4E2;">
			
			<div class="row ">
				
				<section class="content-header">
					<h1 style="color: #000!important;">Registration 2023 <span>| </span>Unique Identification Number (UIN) </h1>
								 <br>
				</section>
				
				<form action="<?php echo $_SERVER['PHP_SELF'] ?>" class="wufoo leftLabel page1" name="admission_newadmission" enctype="multipart/form-data" method="post" onSubmit="" >
				<?php echo $msg; ?>	
					<div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                               <h3 style="font-size: 20px; font-weight: 600;text-align:center"> कमला नेहरू भौतिक एवं सामाजिक विज्ञान संस्थान, सुल्तानपुर, उत्तर प्रदेश</h3>
                          <h3 style="font-size: 16px; font-weight: 600;line-height:30px"> राष्ट्रीय शिक्षा नीति-2020 : स्नातक स्तर पर कला संकाय/ विज्ञान संकाय/ वाणिज्य संकाय के अन्तर्गत संचालित विषयों तथा परास्नातक स्तर पर विषय आधारित पाठ्यक्रमों में प्रवेश के लिए विद्यार्थी की पात्रता निम्रवत है –</h3>
                           
                            </div></div></div>
							<div class="row">
                    <div class="col-md-11 col-sm-12 col-xs-12">
                        <div class="form-group">

                      
                           <table style="width:100%;font-size:16px" class="table table-striped table-hover rounded">
                               
                               <thead><tr class="bg-primary text-white"><td rowspan="2" colspan="2"><strong> 1- प्रवेश का संकाय/</strong></td><td colspan="2" style="text-align:center"><strong>प्रवेश हेतु विद्यार्थी की पात्रता</strong></td></tr>
                                  <tr class="bg-primary text-white"><td style="text-align:center"><strong>विषय वर्ग</strong></td><td style="text-align:center"><strong>पात्रता</strong></td></tr>

                               </thead>

                                    <tbody>
                                        <tr><td>1</td><td>विज्ञान संकाय (स्नातक)</td><td>इंटरमीडिएट विज्ञान वर्ग</td><td>इंटरमीडिएट उत्तीर्ण</td></tr>
                                         <tr><td>2</td><td>कला संकाय (स्नातक)</td><td>इंटरमीडिएट कला वर्ग या विज्ञान वर्ग या वाणिज्य वर्ग कृषि वर्ग या व्यवसायिक वर्ग</td><td>इंटरमीडिएट उत्तीर्ण</td></tr>
											<tr><td>3</td><td>वाणिज्य संकाय (स्नातक)</td><td>इंटरमीडिएट वाणिज्य वर्ग या कला वर्ग या विज्ञान वर्ग कृषि वर्ग अथवा व्यवसायिक वर्ग</td><td>इंटरमीडिएट उत्तीर्ण</td></tr>
                                          <tr><td>4</td><td>एम०ए०</td><td>बीए तृतीय वर्ष के विषय/(स्नातक)के विषय</td><td>बी०ए०/(स्नातक)उत्तीर्ण</td></tr>

                                             <tr><td>5</td><td>एम.एस.सी</td><td>बीएससी तृतीय वर्ष के विषय</td><td>बी०एस-सी उत्तीर्ण</td></tr>
                                            <tr><td>6</td><td>एम०काम०</td><td>बी०काम०</td><td>बी०काम० उत्तीर्ण</td></tr>
                                    </tbody>
                                   </table>

                        </div>
                    </div>
                     
                     
                     
                <div class="col-md-7">
					<h1 id="register1" name="register1" class="  submit blink_me bg-danger text-white mx-auto"  onclick="register_now1()" value="testing" tabindex="100">
Step 1. Pre-Registration For U.I.N.-2023
</h1>
				</div>
					
				</form>
				
			</div>
		</div>
	</div>
</div>  
	
<?php

		break;
	}
	case 3:{
?>
<div id="container" width="70%">
	<div class="card">
		<div class="card-body col-md-11  " style="background-color:#E5E4E2;">
			
			<div class="row ">
				
				<section class="content-header">
					<h1 style="color: #000!important;">Registration <?php echo date('Y') ?> <span>| </span>Unique Identification Number (UIN) </h1>
								 <br>
				</section>
				
				<form action="<?php echo $_SERVER['PHP_SELF'] ?>" class="wufoo leftLabel page1" name="admission_newadmission" enctype="multipart/form-data" method="post" onSubmit="" >
				<?php echo $msg; ?>	
				<h2 style="color: #3D3E3E!important;">Step 1. Pre-Registration For U.I.N.-2023</h2><br>
	<div class=" card card-body col-md-11 my-auto mx-auto" style="border-top-color: #d2d6de; background-color:whitesmoke;" >
					
						<div class="row mt-1">							
							<div class="col-md-6">							
								<label>Candidate Name</label>
								<input type="text" name="candidate_name" id="candidate_name" class="form-control " value="<?php if(isset($_POST['candidate_name'])){echo $_POST['candidate_name'];}?>" tabindex="<?php echo $tabindex++;?>" required />
							</div>
							<div class="col-md-6">							
								<label>Father&#39;s Name</label>
								<input type="text" name="father_name" id="father_name" class="form-control " value="<?php if(isset($_POST['candidate_name'])){echo $_POST['father_name'];}?>" tabindex="<?php echo $tabindex++;?>" required />
							</div>
						</div>
						<div class="row mt-1">
							<div class="col-md-6">							
								<label>Mother&#39;s Name</label>
								<input type="text" name="mother_name" id="mother_name" class="form-control " value="<?php if(isset($_POST['candidate_name'])){echo $_POST['mother_name'];}?>" tabindex="<?php echo $tabindex++;?>" required />
							</div>
							<div class="col-md-6">							
								<label>Date of Birth</label>
								<script>DateInput('dob', false, 'YYYY-MM-DD', '<?php if(isset($_POST['dob'])){echo $_POST['dob'];}else{echo date("Y-m-d");}?>', <?php echo $tabindex++; $tabindex += 3; ?>)</script>
							</div>
							
						</div>
						<div class="row mt-1">
							<div class="col-md-6">							
								<label>Mobile</label>
								<input type="text" name="mobile" id="mobile" class="form-control " value="<?php if(isset($_POST['candidate_name'])){echo $_POST['mobile'];}?>" tabindex="<?php echo $tabindex++;?>" pattern=[0-9]{10} minlength="10" maxlength="10"  required />
							</div>
							<div class="col-md-6">							
								<label>E-Mail</label>
								<input type="email" name="e_mail" id="e_mail" class="form-control " value="<?php if(isset($_POST['candidate_name'])){echo $_POST['e_mail'];}?>" tabindex="<?php echo $tabindex++;?>" required />
							</div>
						</div>
						<div class="row mt-1">							
							<div class="col-md-6">							
								<label>Course Type</label>
								<select name="course_type" id="course_type" value="<?php echo $data['course_type']?>" class="form-control" required>
										<option disabled <?php echo isset($_GET['edit'])? "":' selected = "selected" '?>>---Select Your Course Type---</option>
										<?php 
											$sql  = 'select * from mst_course_type';
											$dept_list = execute_query( $sql);
											if($dept_list){
												while($list = mysqli_fetch_assoc($dept_list)){
													echo '<option  value = "'.$list['sno'].'" '.(isset($_GET['edit']) && $data['course_type'] == $list['sno'] ? ' selected = "selected" ':"").'>'.$list['course_type'].'</option>';
												}
											}
										?>
								</select>
							</div>
							<div class="col-md-6">							
								<label>Course Applying for</label>
								<select name="course_appled_for" id="course_appled_for" value="" class="form-control" required>
									
								</select>												
						</div>
						<div class="row mt-1">
							<div class="col-md-6">							
								<label>Category</label>
								<select name="category" id="category" class="form-control" tabindex="<?php echo $tabindex++;?>" required>
									<option value="GEN" <?php if(isset($_POST['category']) && $_POST['category']=="GEN"){ echo 'selected ';}?>>General</option>
									<option value="OBC" <?php if(isset($_POST['category']) && $_POST['category']=="OBC"){ echo 'selected ';}?>>OBC</option>
									<option value="SC" <?php if(isset($_POST['category']) && $_POST['category']=="SC"){ echo 'selected ';}?>>SC</option>
									<option value="ST" <?php if(isset($_POST['category']) && $_POST['category']=="ST"){ echo 'selected ';}?>>ST</option>
								</select>
							</div>
							<div class="col-md-6">							
								<label>Aadhar</label>
								<input type="text" name="aadhar" id="aadhar" class="form-control " value="<?php if(isset($_POST['candidate_name'])){echo $_POST['aadhar'];}?>" tabindex="<?php echo $tabindex++;?>"  pattern=[0-9]{12} minlength="12" maxlength="12" required />
							</div>
						</div>
						<div class="row mt-1">
							<div class="col-md-4">							
								<label>Fees of Unique Identification Number</label>
								<input type="number" name="fee" id="fee" class="form-control" value="100" style="pointer-events:none; " readonly tabindex="<?php echo $tabindex++;?>" required />
								&nbsp;
								
							</div>
							
							<div class="col-md-8"></div>
						</div>
						<div class="row mt-1">
							<div class="col-md-2">
							<button id="pre_registration_form" name="pre_registration_form" class=" btn btn-danger" type="submit" value="" onclick="confirm('Dear Applicant, please ensure that all information filled by you in this form is correct and complete.If any information is found incorrect or incomplete then you will not able to edit your details in future with this current registration.?');">Continue<button>
							</div>
						</div>
						
					</div>
					
				</form>
				
			</div>
		</div>
	</div>
</div>
<script>

	$(document).ready(function(){
		$("#course_type").change(function(){
			let selected_value = $("#course_type").val();
			//console.log(selected_value);

			$.ajax({
    			url: 'ajax_course_applied_for.php',
    			method: 'GET',
				data : 'selected_value= '+ selected_value,
    			success: function(data){
					$("#course_appled_for").html(data);
    			}
    		});
		 })
	})
</script>
<?php
		break;
	}
		
	case 4:{
		
?>
<div id="container" width="70%">
	<div class="card">
		<div class="card-body col-md-11  " style="background-color:#E5E4E2;">
			<div class="row ">
				<section class="content-header">
					<h1 style="color: #000!important;">Registration 2023 <span>| </span>Unique Identification Number (UIN) </h1>
									<br>
				</section>
				<section class="content-header" style="margin-top: -25px">
					<!-- <h4 style="font-size: 20px; font-weight: 600; color:green;">Your form has been successfully submitted.</h4> -->
					<h5 style="font-size: 15px; font-weight: 600; color:red;">Please fill all mandatory field</h5>
				</section>
				<form action="" class="wufoo leftLabel page1" name="admission_newadmission" enctype="multipart/form-data" method="post" onSubmit="" >	
					<?php   
						$sql = execute_query('select * from register_users where user_name = "'.$reg_no.'"',dbconnect());
						if($sql){
							$res = mysqli_fetch_assoc($sql); 
							//print_r($res);
							$res1= mysqli_fetch_assoc(execute_query('select * from new_student_info where sno= '.$res['sno'],dbconnect()));
							$course_name = mysqli_fetch_assoc(execute_query('select * from mst_course where sno = '.$res1['course_applying_for'],dbconnect()))['course_name'];
							

						}							
					?>
					<div class=" card card-body col-md-11 my-auto mx-auto" style="background-color:whitesmoke;">
						<div class="row mt-1">	
							<div class="col md-4">
								<h5 class="row d-flex"><strong>Registration No. :</strong></h5>
							</div>		
							<div class="col md-4 h5"><?php echo $reg_no ?></div>		
							<div class="col md-4"></div>		
						</div>
						<div class="row mt-1">	
							<div class="col md-4">
								<h5 class="row d-flex"><strong>Course Applied For :</strong></h5>
							</div>		
							<div class="col md-4 h5"><?php echo $course_name?></div>		
							<div class="col md-4"></div>		
						</div>
						<div class="row mt-1">	
							<div class="col md-4">
								<h5 class="row d-flex"><strong>Applicant's Name :</strong></h5>
							</div>		
							<div class="col md-4 h5"><?php echo $res1['candidate_name']?></div>		
							<div class="col md-4 "></div>		
						</div>
						<div class="row mt-1">	
							<div class="col md-4">
								<h5 class="row d-flex"><strong>Father Name :</strong></h5>
							</div>		
							<div class="col md-4 h5"><?php echo $res1['father_name']?></div>		
							<div class="col md-4 "></div>		
						</div>
						<div class="row mt-1">	
							<div class="col md-4">
								<h5 class="row d-flex"><strong>Mobile No :</strong></h5>
							</div>		
							<div class="col md-4 h5"><?php echo $res1['mobile']?></div>		
							<div class="col md-4 "></div>		
						</div>
						<div class="row mt-1">	
							<div class="col md-4">
								<h5 class="row d-flex"><strong>Email ID :</strong></h5>
							</div>		
							<div class="col md-4 h5"><?php echo $res1['email']?></div>		
							<div class="col md-4 "></div>		
						</div>
						<div class="row mt-1">	
							<div class="col md-4">
								<h5 class="row d-flex"><strong>Fees For Unique Identification Number :</strong></h5>
							</div>		
							<div class="col md-4 h5"><?php echo $res1['fee']?></div>		
							<div class="col md-4 "></div>		
						</div>
						<div class="row mt-1">
							<p style="color:red">
								NOTE: DEAR APPLICANT, PLEASE BE PATIENT AS THE FEE PAYMENT MAY TAKE FEW MINUTES OF YOUR TIME. PLEASE DON'T DISCONNECT THE SESSION OR CLOSE THE PROCESSING WINDOW.
							</p>
						</div>

					</div>
				</form>
			</div>
			<div class="row mt-1">
				<div class="col-md-2">
				<a href="<?php echo 'admission_form.php?id='.$res['sno'] ?>" class=" btn btn-danger" onclick="alert('Dear Applicant, please note your Registration No. <?php echo $reg_no ?>. Bank Transaction ID-17662194010  for any future communication');">Make Payment</a>
				
				</div>
			</div>
		</div>
	</div>
</div> 

<?php 
		break;
	}
}
	page_footer();
	ob_end_flush();
?>

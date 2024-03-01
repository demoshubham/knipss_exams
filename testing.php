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
                echo '<script>alert("Login Successful" )</script>';
				$response=4;
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
                $reg_no = str_pad($id, 6, "0", STR_PAD_LEFT);
                $year = date("Y");
				$reg_no = 'KNI'.$year.$reg_no;
				$sql = 'update register_users set user_name="'.$reg_no.'", password="'.$_POST['dob'].'" where sno='.$id;
				execute_query($sql,dbconnect());
                if(mysqli_error( dbconnect())){
                    $msg .= '<li><h3>Error # 1 : Contact admin. '.$sql.'</h3></li>';
                }
                else{
                    echo '<script>alert("Registration Successful. Your Registration no is : '.$reg_no.'" )</script>';
                    $response=1;
                }
			}
			
		}
	
}	

if(isset($_POST['continue'])){
	
	
}

page_header();
?>


<?php
//$response=3;
switch($response){
	case 1:{
?>	
<style>
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
    form.setAttribute("action", "testing.php");

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
	<div class="bg-primary text-white"><a class=" text-white" href="merit_result.php">ऑनलाइन मेरिट रिजल्ट</a></div>
	<div class="panel-body">
		<ul class="fa-ul"></ul>
		<table class="table table-condensed rounded" cellpadding="5" cellspacing="5">
			<tbody >
				  <tr class="pt-2">
					<td>  <h5>हेल्प डेस्क :</h5> </td>
				</tr>
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
			</tbody>
		</table>
	</div>
</div>

<input id="RadioButtonList1_1" type="radio" name="RadioButtonList1" value="1" >

<div id="container" class="ltr" style="width:550px; float:right; margin-right:25px; height: 340px;">
	<form id="loginform" name="login" class="wufoo page" autocomplete="off" enctype="multipart/form-data" method="post" action="testing.php">
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
	<div class="col-md-12">
		<h1 id="register" name="register" class="  submit blink_me bg-primary text-white mx-auto"  onclick="register_now()" value="Step 1. Pre-Registration For Fees Payment-2023" tabindex="100">Step 1. Pre-Registration For Fees Payment-2023</h1>
	</div>
</div>
<div class="container col-md-10 mx-auto  " style="background-color:whitesmoke;">
  <div class="row " >
    <div class="col   m-2 rounded-pill" style="background-color: orange; background-image: url(images/reg.jpg);background-position:cover;">
		<h4><a class=" text-white" href="extenstion.pdf">Registration Date has been extended to 10<sup>th</sup> July</a></h4>
    </div>
    <div class="col bg-primary m-2 rounded-pill"  style="background-color: orange; background-image: url(images/important.jpg);background-position:cover;">
      <h4><a class=" text-white" href="instructions.pdf">Important Instructions</a></h4>
    </div>
    <div class="col bg-primary m-2 rounded-pill"  style="background-color: orange; background-image: url(images/admission.jpg);background-position:cover;">
      <h4><a class=" text-white" href="admission_procedure.pdf">Online Admission Procedure</a></h4>
    </div>
  </div>
  <div class="row">
    <div class="col bg-primary m-2 rounded-pill p-3"  style="background-color: orange; background-image: url(images/notice.jpg);background-position:cover;">
      <h3><a class="text-white" href="notice.pdf">Notice</a></h3>
    </div>
    <div class="col bg-primary m-2 rounded-pill p-3"  style="background-color: orange; background-image: url(images/disclaimer.jpg);background-position:cover;">
      <h3><a class="text-white " href="disclaimer.pdf">Disclaimer</a></h3>
    </div>
    <div class="col bg-primary m-2 rounded-pill p-3"  style="background-color: orange; background-image: url(images/refund_policy.jpg);background-position:cover;">
     <h3><a class="text-white " href="refund.pdf">Refund Policy</a></h3>
    </div>
  </div>
  <div class="row">
    <div class="col bg-primary m-2 rounded-pill p-3"  style="background-color: orange; background-image: url(images/terms.jpg);background-position:cover;">
      <h3><a class=" text-white " href="terms.pdf">Terms and Conditions</a></h3>
    </div>
    <div class="col bg-primary m-2 rounded-pill p-3"  style="background-color: orange; background-image: url(images/entry.jpg);background-position:cover;">
      <h3><a class=" text-white" href="elegibility.pdf" >प्रवेश हेतु अनिवार्य अर्हता</a></h3>
    </div>
	
  </div>
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
    form.setAttribute("action", "testing.php");

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
					<h1 style="color: #000!important;">Registration 2022 <span>| </span>Unique Identification Number (UIN) </h1>
								 <br>
				</section>
				
				<form action="testing.php" class="wufoo leftLabel page1" name="admission_newadmission" enctype="multipart/form-data" method="post" onSubmit="" >
				<?php echo $msg; ?>	
					<div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                               <h3 style="font-size: 20px; font-weight: 600;text-align:center"> डॉ0 राममनोहर लोहिया अवध विश्वविद्यालय, अयोध्या</h3>
                          <h3 style="font-size: 16px; font-weight: 600;line-height:30px"> राष्ट्रीय शिक्षा नीति-2020 : स्नातक स्तर पर कला संकाय/ विज्ञान संकाय/ वाणिज्य संकाय के अन्तर्गत संचालित विषयों तथा परास्नातक स्तर पर विषय आधारित पाठ्यक्रमों में प्रवेश के लिए विद्यार्थी की पात्रता निम्रवत है –</h3>
                           
                            </div></div></div>
							<div class="row">
                    <div class="col-md-11 col-sm-12 col-xs-12">
                        <div class="form-group">

                      
                           <table style="width:100%;font-size:16px" class="table table-striped table-hover rounded">
                               
                               <thead><tr><td rowspan="2" colspan="2"><strong> 1- प्रवेश का संकाय/</strong></td><td colspan="2" style="text-align:center"><strong>प्रवेश हेतु विद्यार्थी की पात्रता</strong></td></tr>
                                  <tr><td style="text-align:center"><strong>विषय वर्ग</strong></td><td style="text-align:center"><strong>पात्रता</strong></td></tr>

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
                     
                     
                     
                <div class="col-md-12">
					<h1 id="register1" name="register1" class="  submit blink_me bg-primary text-white mx-auto"  onclick="register_now1()" value="testing" tabindex="100">
Step 1. Pre-Registration For Fees Payment-2023
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
				
				<form action="testing.php" class="wufoo leftLabel page1" name="admission_newadmission" enctype="multipart/form-data" method="post" onSubmit="" >
				<?php echo $msg; ?>	
				<h2 style="color: #3D3E3E!important;">Step 1. Pre-Registration For Fees Payment</h2><br>
	<div class=" card card-body col-md-11 my-auto mx-auto" style="border-top-color: #d2d6de; background-color:whitesmoke;" >
					
						<div class="row mt-1">							
							<div class="col-md-6">							
								<label>Candidate Name</label>
								<input type="text" name="candidate_name" id="candidate_name" class="form-control " value="<?php if(isset($_POST['candidate_name'])){echo $_POST['candidate_name'];}?>" tabindex="<?php echo $tabindex++;?>" />
							</div>
							<div class="col-md-6">							
								<label>Father&#39;s Name</label>
								<input type="text" name="father_name" id="father_name" class="form-control " value="<?php if(isset($_POST['candidate_name'])){echo $_POST['father_name'];}?>" tabindex="<?php echo $tabindex++;?>" />
							</div>
						</div>
						<div class="row mt-1">
							<div class="col-md-6">							
								<label>Mother&#39;s Name</label>
								<input type="text" name="mother_name" id="mother_name" class="form-control " value="<?php if(isset($_POST['candidate_name'])){echo $_POST['mother_name'];}?>" tabindex="<?php echo $tabindex++;?>" />
							</div>
							<div class="col-md-6">							
								<label>Date of Birth</label>
								<script>DateInput('dob', false, 'YYYY-MM-DD', '<?php if(isset($_POST['dob'])){echo $_POST['dob'];}else{echo date("Y-m-d");}?>', <?php echo $tabindex++; $tabindex += 3; ?>)</script>
							</div>
							
						</div>
						<div class="row mt-1">
							<div class="col-md-6">							
								<label>Mobile</label>
								<input type="text" name="mobile" id="mobile" class="form-control " value="<?php if(isset($_POST['candidate_name'])){echo $_POST['mobile'];}?>" tabindex="<?php echo $tabindex++;?>" />
							</div>
							<div class="col-md-6">							
								<label>E-Mail</label>
								<input type="text" name="e_mail" id="e_mail" class="form-control " value="<?php if(isset($_POST['candidate_name'])){echo $_POST['e_mail'];}?>" tabindex="<?php echo $tabindex++;?>" />
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
								<select name="category" id="category" class="form-control" tabindex="<?php echo $tabindex++;?>">
									<option value="GEN" <?php if(isset($_POST['category']) && $_POST['category']=="GEN"){ echo 'selected ';}?>>General</option>
									<option value="OBC" <?php if(isset($_POST['category']) && $_POST['category']=="OBC"){ echo 'selected ';}?>>OBC</option>
									<option value="SC" <?php if(isset($_POST['category']) && $_POST['category']=="SC"){ echo 'selected ';}?>>SC</option>
									<option value="ST" <?php if(isset($_POST['category']) && $_POST['category']=="ST"){ echo 'selected ';}?>>ST</option>
								</select>
							</div>
							<div class="col-md-6">							
								<label>Aadhar</label>
								<input type="text" name="aadhar" id="aadhar" class="form-control " value="<?php if(isset($_POST['candidate_name'])){echo $_POST['aadhar'];}?>" tabindex="<?php echo $tabindex++;?>" />
							</div>
						</div>
						<div class="row mt-1">
							<div class="col-md-4">							
								<label>Fees of Unique Identification Number</label>
								<input type="number" name="fee" id="fee" class="form-control" value="100" style="pointer-events:none;" tabindex="<?php echo $tabindex++;?>" />
								&nbsp;
								
							</div>
							
							<div class="col-md-8"></div>
						</div>
						<div class="row mt-1">
							<div class="col-md-2">
							<button id="pre_registration_form" name="pre_registration_form" class=" btn btn-primary" type="submit" value="">Continue<button>
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
<div id="content">    	
		<h2>Registration</h2>
			
</div>	

<?php
		break;
	}
}
page_footer();
ob_end_flush();
?>

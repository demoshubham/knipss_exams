<?php
ob_start();
date_default_timezone_set('Asia/Calcutta');
session_cache_limiter('nocache');
session_start();
include("settings.php");
include("get_computer.php");
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
if(isset($_POST['continue'])){
	$response=4;
}
///	$sup=dbconnect($_POST[$id]);
if(isset($_POST['login_button'])) {
	 if($_POST['username']!='' && $_POST['userpwd']!='') {
		$sql = 'select * from user where userid="'.$_POST['username'].'"';
		 //echo $sql;
		$result = execute_query($sql,dbconnect());
		if(mysqli_num_rows($result)!=0) {			
			$row = mysqli_fetch_array(execute_query($sql,dbconnect()));
			if($_POST['userpwd']==$row['pwd']) {
				$_SESSION['username'] = $row['userid'];
				$_SESSION['session_id'] = randomstring();
				$_SESSION['startdate'] = date('Y-m-d');
				$time = localtime();
		        $time = $time[2].':'.$time[1].':'.$time[0];
				//echo $time;
		        $_SESSION['starttime']=$time;
				$sql = " INSERT INTO `session_admin` (`user` ,`s_id` ,`s_start_date` ,`s_start_time`,`os` ,`browser` , `ip`)
				VALUES ('".$_SESSION['username']."', '".$_SESSION['session_id']."', '".$_SESSION['startdate']."', '".$_SESSION['starttime']."', '".getOS()."' , '".getBrowser()."' , '".$_SERVER['REMOTE_ADDR']."')";
		        execute_query($sql,dbconnect());
				header("Location: user_home.php");
			}
			else {
				$msg = '<li><h3>Please Enter Valid User Password</h3></li>';
				$response=1;
			}
		}
		else {
				$msg = '<li><h3>Please Enter Valid User Password</h3></li>';
				$response=1;
		}		 
	 }
	 else {
		$msg = '<li><h3>Please Enter Valid User Password</h3></li>';
		 $response=1;
	 }
 }

if(isset($_POST['register1'])){
	// code for check server side validation
	if(empty($_SESSION['captcha_code'] ) || strcasecmp($_SESSION['captcha_code'], $_POST['captcha']) != 0){  
		$msg="<span style='color:red'>The Validation code does not match!</span>";// Captcha verification is incorrect.		
		$response=2;
	}
	else{// Captcha verification is Correct. Final Code Execute here!	
		$sql = 'select * from register_users where mobile="'.$_POST['mobile'].'"';
		$result_email = execute_query($sql,dbconnect());
		if(mysqli_num_rows($result_email)!=0){
			$row_email = mysqli_fetch_array($result_email);
			if($row_email['email_activation']==1 && $row_email['mobile_activation']==1){
				$msg .= '<li><h3>Mobile already registered</h3></li>';
				$response=2;
			}
			else{
				$response=3;
				$id = $row_email['sno'];
			}
		}
		
		if($msg=='' && $response!=3){
			$sql = 'insert into register_users (full_name, father_name, mother_name, date_of_birth, mobile, e_mail, courses, ip_address, timestamp, datestamp) values("'.$_POST['candidate_name'].'", "'.$_POST['father_name'].'", "'.$_POST['mother_name'].'", "'.$_POST['dob'].'", "'.$_POST['mobile'].'", "'.$_POST['e_mail'].'", "'.$_POST['classsection'].'", "'.$_SERVER['REMOTE_ADDR'].'", "'.date("H:i:s").'", "'.date("Y-m-d").'")';
			execute_query($sql, dbconnect());
			if(mysqli_error()){
				$msg .= '<li><h3>Error # 1 : Contact admin. '.$sql.'</h3></li>';
			}
			else{
				$id = mysqli_insert_id($db);
				$sql = 'insert into student_info (sno, stu_name, father_name, mother_name, dob, mobile, e_mail1, class,category) values("'.$id.'", "'.$_POST['candidate_name'].'", "'.$_POST['father_name'].'", "'.$_POST['mother_name'].'", "'.$_POST['dob'].'", "'.$_POST['mobile'].'", "'.$_POST['e_mail'].'", "'.$_POST['classsection'].'","'.$_POST['category'].'")';
				execute_query($sql, dbconnect());
			}
			if($msg==''){
				$number = $_POST['mobile'];
				$otp = randomnumber();
				$sql = 'update register_users set mobile_activation="'.$id.'_'.$otp.'" where sno='.$id;
				execute_query($sql,dbconnect());
				$get_msg = "Dear, ".$_POST['candidate_name']." one time verification code for your college application is $otp. The code is valid for 4 hours only. Regards, KNIPSS Team.";
				send_sms($number,$get_msg);
				$response=3;
			}
			else{
				$response=2;
			}
		}
	}
}	

if(isset($_POST['continue'])){
	
	
}

page_header();
?>
<?php
switch($response){
	case 1:{
?>	
<div id="container" class="ltr" style="width:350px; margin-left:10px; float:left; font-size:12px; font-weight:bold; overflow-y: scroll; height: 340px; line-height: 24px; padding: 10px; color: #666;">

	<h3>प्रवेश हेतु अनिवार्य अर्हता :</h3>
	<ol style="list-style: decimal; margin: 15px;">
		<li>स्नातकोत्तर  स्तर पर प्रवेश हेतु अभियर्थियों को सम्बन्धित विषय में स्नातक स्तर पर त्रिवर्षीय पाठ्यक्रम उत्तीर्ण होना अनिवार्य है |</li>
		<li>स्नातकोत्तर  सूक्ष्म जीवविज्ञान ( माइक्रोबायोलॉजी) पाठ्यक्रम में प्रवेश हेतु वे अभियर्थी अर्ह होंगे जिन्होंने बी.एस-सी (जीवविज्ञान) की किसी भी शाखा से (जैव प्रद्योगिकी /रसायन विज्ञान /जीव रसायन विज्ञान /सूक्ष्म जीव विज्ञान )कम से कम २ वर्ष अध्ययन किया हो |</li>
	3. स्नातक स्तर पर प्रवेश हेतु वे ही छात्र /छात्रा अनुमन्य है जो इंटरमीडिएट या समकक्ष परीक्षा २०१४ अथवा बाद उत्तीर्ण हो|<br>
	अनिवार्य शैक्षिक अर्हता निम्न्वत है -<br>
	बी.ए.  :  इंटरमीडिएट या समकक्ष परीक्षा किसी भी वर्ग में उत्तीर्ण<br>
	बी.कॉम  :  इंटरमीडिएट या समकक्ष परीक्षा किसी भी वर्ग में उत्तीर्ण<br>
	बी.एस-सी (बायो ) : इंटरमीडिएट या समकक्ष परीक्षा जीव विज्ञान वर्ग में उत्तीर्ण<br>
	बी.एस-सी (गणित) : इंटरमीडिएट या समकक्ष परीक्षा गणित वर्ग में उत्तीर्ण<br>
	बी.एस-सी. (गृह विज्ञान) : इंटरमीडिएट या समकक्ष परीक्षा किसी भी वर्ग में उत्तीर्ण (केवल छात्राए )<br>
	बी.एस-सी. (कृषि ) : इंटरमीडिएट या समकक्ष परीक्षा किसी भी वर्ग में उत्तीर्ण<br>
	बी .बी .ए . : इंटरमीडिएट या समकक्ष परीक्षा किसी भी वर्ग में उत्तीर्ण<br>
	विधि त्रिवर्षीय : स्नातक परीक्षा किसी भी वर्ग में उत्तीर्ण<br>
	विधि पंचवर्षीय : इंटरमीडिएट या समकक्ष परीक्षा किसी भी वर्ग में उत्तीर्ण सम्बन्धित परीक्षा में सामान्य एवं अन्य पिछड़ी जाति के अभ्यर्थियों  के लिए न्यूनतम 45% तथा अनुसूचित जाति एवं जनजाति के अभ्यर्थियों   के लिए  न्यूनतम 40% अंक अनिवार्य है |
</div>
<div id="container" class="ltr" style="width:400px; float:left; margin-left:20px; height: 350px;">
	<form id="loginform" name="login" class="wufoo page" autocomplete="off" enctype="multipart/form-data" method="post" action="index.php">
	<h2>Online Admission Portal</h2>
	<?php echo $msg; ?>
	<table style="width:100%">
		<tr>
			<td><label  class="desc" id="title2" for="Field2">Username <span id="req_1" class="req">*</span></label></td>
		</tr>
		<tr>
			<td><input id="username" name="username" type="texts" spellcheck="false" class="field text large" value="" maxlength="20" tabindex="1" onBlur="checkname('username')" /><p class="instruct" id="instruct1"><small>This field is required.</small></p></td>
		</tr>
		<tr>
			<td><label class="desc">Password <span class="req">*</span></label></td>
		</tr>
		<tr>
			<td><input id="userpwd" name="userpwd" type="password" spellcheck="false" class="field text large" value="" maxlength="20" tabindex="2" onBlur="checkname('userpwd')"  /><p class="instruct" id="instruct2"><small>This field is required.</small></p></td>
		</tr>
		<tr>
			<td><input id="login_button" name="login_button" class="btTxt submit" type="submit" value="Login to Application Section"/></td>
		</tr>
		<tr>
			<td><input id="register" name="register" class="btTxt submit" type="button" value="Click Here to Register"/></td>
		</tr>
	</table>
        <li class="buttons"><div></div></li>
    </ul>
	</form>
</div>
<div id="container" class="ltr" style="width:350px; margin-left:10px; float:right; font-size:18px; font-weight:bold; overflow-y: scroll; height: 340px; line-height: 36px; padding: 10px; color: #666;">
    
    <h3 style="color:#F00;">प्रवेश प्रक्रिया 25 मई से प्रारम्भ होगी ।</h3><br>
	<h3>हेल्प डेस्क :</h3>
	<ul style="list-style: decimal; margin: 15px;">
		<li><u>समय</u> - प्रात: 10 से सायं 6 बजे तक</li>
		<li><u>लैण्ड लाईन</u> - 05362-240854</li>
		<li><u>मोबाईल</u> - 7007425931</li>
		<li><u>ई-मेल</u> - knipss_sln@rediffmail.com</li>
		<li><u>पता</u> - कमला नेहरू भौतिक एवं सामाजिक विज्ञान संस्थान, सुल्तानपुर , उत्तर प्रदेश, 228118</li>
	</ul>
</div>
<div style="clear: both;"></div>
<?php 
		break;
	}
	case 2:{
?>
<div id="content">    	
	<form action="index.php" class="wufoo leftLabel page1" name="admission_newadmission" enctype="multipart/form-data" method="post" onSubmit="" >
		<h2>Registeration</h2>
		<?php echo $msg; ?>
		<table width="100%">
			<tr>
				<td>Candidate Name</td>
				<td><input type="text" name="candidate_name" id="candidate_name" class="fieldtext large" value="<?php if(isset($_POST['candidate_name'])){echo $_POST['candidate_name'];}?>" tabindex="<?php echo $tabindex++;?>" /></td>
				<td>Father&#39;s Name</td>
				<td><input type="text" name="father_name" id="father_name" class="fieldtext large" value="<?php if(isset($_POST['candidate_name'])){echo $_POST['father_name'];}?>" tabindex="<?php echo $tabindex++;?>" /></td>
				<td>Mother&#39;s Name</td>
				<td><input type="text" name="mother_name" id="mother_name" class="fieldtext large" value="<?php if(isset($_POST['candidate_name'])){echo $_POST['mother_name'];}?>" tabindex="<?php echo $tabindex++;?>" /></td>
			</tr>
			<tr>
				<td>Date of Birth</td>
				<td><script>DateInput('dob', false, 'YYYY-MM-DD', '<?php if(isset($_POST['dob'])){echo $_POST['dob'];}else{echo date("Y-m-d");}?>', <?php echo $tabindex++; $tabindex += 3; ?>)</script></td>
				<td>Mobile</td>
				<td><input type="text" name="mobile" id="mobile" class="fieldtext large" value="<?php if(isset($_POST['candidate_name'])){echo $_POST['mobile'];}?>" tabindex="<?php echo $tabindex++;?>" /></td>
				<td>E-Mail</td>
				<td><input type="text" name="e_mail" id="e_mail" class="fieldtext large" value="<?php if(isset($_POST['candidate_name'])){echo $_POST['e_mail'];}?>" tabindex="<?php echo $tabindex++;?>" /></td>
			</tr>
			<tr>
				<td>Course Applying for</td>
				<td>
					<select class="select large" name="classsection" id="classsection" tabindex="<?php echo $tabindex++;?>">
					<option value=""></option>
					<?php
					$sql = 'select * from class_detail order by class_description';
					$res = execute_query($sql,dbconnect());
					while($row = mysqli_fetch_array($res)) {
						echo '<option value="'.$row['sno'].'" ';
						if(isset($_POST['classsection'])){
							if($_POST['classsection']==$row['sno']){
								echo ' selected ';
							}
						}
						echo '>'.$row['class_description'].'</option>';
					}
					echo '</select></div>';
					?>

				</td>
                <td class="label">Category</td>
				<td>
				<select name="category" id="category" class="select large" tabindex="<?php echo $tabindex++;?>">
				<option value="GEN" <?php if($_POST['category']=="GEN"){ echo 'selected ';}?>>General</option>
				<option value="OBC" <?php if($_POST['category']=="OBC"){ echo 'selected ';}?>>OBC</option>
				<option value="SC" <?php if($_POST['category']=="SC"){ echo 'selected ';}?>>SC</option>
				<option value="ST" <?php if($_POST['category']=="ST"){ echo 'selected ';}?>>ST</option>
				</select>								
				</td>
				<td>Enter the code</td>
				<td style="vertical-align: middle;"><input type="text" name="captcha" id="captcha" class="fieldtext small" value="" tabindex="<?php echo $tabindex++;?>" />
				&nbsp;
				<img src="captcha.php?rand=<?php echo rand();?>" id='captchaimg'>
				</td>
               </tr>
               <tr>
				<td><input id="register1" name="register1" class="btTxt submit" type="submit" value="Continue"/></td>
			</tr>
		</table>
	</form>
</div>
		
<?php

		break;
	}
	case 3:{
?>
<script type="application/javascript">
	function resend_email(){
		var id = $("#serial").val();
		var jqxhr = $.get( "verify.php?rqst=email&id="+id, function(data) {
			alert(data);
		})
		.fail(function() {
			alert("Unable to send email. Please retry.");
		})
	}
	function resend_mobile(){
		var id = $("#serial").val();
		var jqxhr = $.get( "verify.php?rqst=mob&id="+id, function(data) {
			alert("SMS Resent. "+data);
		})
		.fail(function() {
			alert("Unable to send SMS. Please retry.");
		})
	}
	
	function verifymobile(){
		var id = $("#serial").val();
		var mob_code = $("#mobile_activation").val();
		var jqxhr = $.get( "verify.php?rqst=vmob&id="+id+"&m="+mob_code, function(data) {
			verifymobile_response(data);
		})
		.fail(function() {
			alert("Unable to verify. Please retry.");
		})
	}
	
	function verifymobile_response(data){
		data = data.trim();
		if(data=='true'){
			//alert('Verified. ');
			var innerhtml = '<td colspan="3" style="color:#0F0; text-align:center;">Verified</td>'
			$("#mobile_activation_tr").html(innerhtml);
		}
		else{
			alert('Invalid Code. Please Retry. ');
		}
	}
	
	function verifyemail(){
		var id = $("#serial").val();
		var email_code = $("#email_activation").val();
		var jqxhr = $.get( "verify.php?rqst=vemail&id="+id+"&m="+email_code, function(data) {
			verifyemail_response(data);
		})
		.fail(function() {
			alert("Unable to verify. Please retry.");
		})
	}
	
	function verifyemail_response(data){
		data = data.trim();
		if(data=='true'){
			//alert('Verified. ');
			var innerhtml = '<td colspan="3" style="color:#0F0; text-align:center;">Verified</td>'
			$("#email_activation_tr").html(innerhtml);
		}
		else{
			alert('Invalid Code. Please Retry. ');
		}
	}
	
	function continue_registration(){
		
	}
$(document).ready(function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
});	
</script>
<div id="content">    	
	<form action="index.php" class="wufoo leftLabel page1" name="admission_newadmission" enctype="multipart/form-data" method="post" onSubmit="" >
		<h2>Registeration</h2>
		<?php echo $msg; ?>
		<table style="width:40%;">
			<tr id="mobile_activation_tr">
			<?php
			$sql = 'select * from register_users where mobile="'.$_POST['mobile'].'" and mobile_activation="1"';
			$result_email = execute_query($sql,dbconnect());
			if(mysqli_num_rows($result_email)!=0){
				echo '<td colspan="3" style="color:#0F0; text-align:center;">Verified</td>';
			}
			else{
			?>
				<td>Mobile Activation Code</td>
				<td><input type="text" name="mobile_activation" id="mobile_activation" class="fieldtext large" value="" tabindex="<?php echo $tabindex++;?>" /><br />
					<a href="#" style="font-size: 10px;" onClick="resend_mobile()">Click Here to Resend</a></td>
				<td><input id="verify_mobile" name="verify_mobile" class="btTxt submit" type="button" value="Verify" onClick="verifymobile()"/></td>
			<?php
			}
			?>
			</tr>
			<tr>
				<td colspan="3"><input id="continue" name="continue" class="btTxt submit" type="submit" value="Continue"/>
				<input type="hidden" name="serial" id="serial" value="<?php echo $id; ?>"></td>
			</tr>
		</table>
	</form>
</div>
<?php
		break;
	}
		
	case 4:{
?>
<div id="content">    	
		<h2>Registeration</h2>
		<?php echo $msg; ?>
			<?php
			$sql = 'select * from register_users where sno="'.$_POST['serial'].'" and mobile_activation=1';
			//echo $sql;
			$result_email = execute_query($sql,dbconnect());
			if(mysqli_num_rows($result_email)!=0){
				$user = mysqli_fetch_array($result_email);
				$reg_no = str_pad($_POST['serial'], 5, "0", STR_PAD_LEFT);
				$reg_no = '2017'.$reg_no;
				$pwd = randompassword();
				$sql = 'update register_users set user_name="'.$reg_no.'", password="'.$pwd.'" where sno='.$_POST['serial'];
				execute_query($sql,dbconnect());
				$msg = 'Dear '.$user['full_name'].', your registeration number is '.$reg_no.' and password is '.$pwd.'. Please login to complete your application.';
				send_sms($user['mobile'], $msg);

				$headers =  'MIME-Version: 1.0' . "\r\n"; 
				$headers .= 'From: KNIPSS Sultanpur <info@knipss.org>' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
				$msg = "<span style='font-size:14px;'>Dear ".$user['full_name'].",<br /><br />";
				$msg .= "Your registering is complete at Kamla Nehru Institute of Physical and Social Sciences' admission portal. <br /><br /> Your registeration number is <br /><br /><b><u><i>$reg_no</i></u></b> <br /><br />and password is <br /><br /><b><u><i>$pwd</i></u></b> <br /><br />Use the above details to login and proceed to admission form. <br /><br />--<br />Thanks &amp; Regards<br />KNIPSS Team.";
				mail($user['e_mail'],"College Registration", $msg, $headers);
			?>
		<table style="width:100%;">
			<tr>
				<td style="text-align: center;">Your registeration is complete. Your registeration number and password is sent to your mail id and on mobile. Please use the same to login and proceed to admission form. <br/><br/><a href="index.php">Click here to go to Login page.</a></td>
			</tr>
		</table>
		<?php }
			else{
		?>
		<table style="width:100%;">
			<tr>
				<td style="text-align: center;">Your registeration is failed. Please retry.</td>
			</tr>
		</table>
		
		<?php
		
			}
		?>	
	
<?php
		break;
	}
}
page_footer();
ob_end_flush();
?>

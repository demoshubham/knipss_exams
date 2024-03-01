<?php
ob_start();
date_default_timezone_set('Asia/Calcutta');
session_cache_limiter('nocache');
session_start();
include("settings.php");
include("get_computer.php");
$response=2;
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
		$sql = 'select * from register_users where user_name="'.$_POST['username'].'" and mobile_activation=1';
		 //echo $sql;
		$result = execute_query($sql,dbconnect());
		if(mysqli_num_rows($result)!=0) {			
			$row = mysqli_fetch_array(execute_query($sql,dbconnect()));
			if($_POST['userpwd']==$row['password']) {
				$_SESSION['username'] = $row['user_name'];
				$_SESSION['session_id'] = randomstring();
				$_SESSION['startdate'] = date('Y-m-d');
				$time = localtime();
		        $time = $time[2].':'.$time[1].':'.$time[0];
				//echo $time;
		        $_SESSION['starttime']=$time;
				$sql = " INSERT INTO `session` (`user` ,`s_id` ,`s_start_date` ,`s_start_time`,`os` ,`browser` , `ip`)
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

<?php 
		break;
	}
	case 2:{
?>
<div id="content">    	
	<form action="new_registration.php" class="wufoo leftLabel page1" name="admission_newadmission" enctype="multipart/form-data" method="post" onSubmit="" >
		<h2>Registration</h2>
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
				<option value="GEN" <?php if(isset($_POST['category'])){if($_POST['category']=="GEN"){ echo 'selected ';}}?>>General</option>
				<option value="OBC" <?php if(isset($_POST['category'])){if($_POST['category']=="OBC"){ echo 'selected ';}}?>>OBC</option>
				<option value="SC" <?php if(isset($_POST['category'])){if($_POST['category']=="SC"){ echo 'selected ';}}?>>SC</option>
				<option value="ST" <?php if(isset($_POST['category'])){if($_POST['category']=="ST"){ echo 'selected ';}}?>>ST</option>
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
			document.getElementById('continue').style.display = 'block';
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
</script>
<div id="content">    	
	<form action="new_registration.php" class="wufoo leftLabel page1" name="admission_newadmission" enctype="multipart/form-data" method="post" onSubmit="" >
		<h2>Registration</h2>
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
				<td>Mobile Activation Code (<?php echo $otp; ?>)</td>
				<td><input type="text" name="mobile_activation" id="mobile_activation" class="fieldtext large" value="" tabindex="<?php echo $tabindex++;?>" /><br />
					<a href="#" style="font-size: 10px;" onClick="resend_mobile()">Click Here to Resend</a></td>
				<td><input id="verify_mobile" name="verify_mobile" class="btTxt submit blink_me" type="button" value="Verify" onClick="verifymobile()"/></td>
			<?php
			}
			?>
			</tr>
			<tr>
				<td colspan="3"><input id="continue" name="continue" class="btTxt submit" type="submit" value="Continue" style="display: none;"/>
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
		<h2>Registration</h2>
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
				$msg = 'Dear '.$user['full_name'].', your Registration number is '.$reg_no.' and password is '.$pwd.'. Please login to complete your application.';
				send_sms($user['mobile'], $msg);

				$headers =  'MIME-Version: 1.0' . "\r\n"; 
				$headers .= 'From: KNIPSS Sultanpur <info@knipss.org>' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
				$msg = "<span style='font-size:14px;'>Dear ".$user['full_name'].",<br /><br />";
				$msg .= "Your registering is complete at Kamla Nehru Institute of Physical and Social Sciences' admission portal. <br /><br /> Your Registration number is <br /><br /><b><u><i>$reg_no</i></u></b> <br /><br />and password is <br /><br /><b><u><i>$pwd</i></u></b> <br /><br />Use the above details to login and proceed to admission form. <br /><br />--<br />Thanks &amp; Regards<br />KNIPSS Team.";
				mail($user['e_mail'],"College Registration", $msg, $headers);
			?>
		<table style="width:100%;">
			<tr>
				<td style="text-align: center;">Your Registration is complete. Your Registration number and password is sent to your mail id and on mobile. Please use the same to login and proceed to admission form. <br/><br/>
				Registration : <?php echo $reg_no; ?><br />Password : <?php echo $pwd; ?><br /><br /><a href="new_registration.php">Click here to go to Login page.</a></td>
			</tr>
		</table>
		<?php }
			else{
		?>
		<table style="width:100%;">
			<tr>
				<td style="text-align: center;">Your Registration is failed. Please retry.</td>
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

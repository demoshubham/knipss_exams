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
	 if($_POST['username']!='') {
		$sql = 'select * from declared_merit where registration_number="'.$_POST['username'].'"';
		$result = execute_query($sql,dbconnect());
		if(mysqli_num_rows($result)!=0) {			
			$row = mysqli_fetch_array(execute_query($sql,dbconnect()));
			$class = mysqli_fetch_array(execute_query("select * from class_detail where sno=".$row['class'], dbconnect()));
			if($row['status']==1){
				$status = '<h3 style="color:#6ac229; font-size:20px;">You are selected.</h3>';
				$counselling = date("d-m-Y", strtotime($row['counselling_date_from'])).' to '. date("d-m-Y", strtotime($row['counselling_date_to']));
			}
			elseif($row['status']==2){
				$status = '<h3 style="color:#f1b060; font-size:20px;">You are in waiting list. You will be notified once their is vacancy.</h3>';
				$counselling = 'Not Yet Available';
			}
			elseif($row['status']==3){
				$status = '<h3 style="color:#f160ea; font-size:20px;">Your application is incomplete. Please contact the concerned department.</h3>';
				$counselling = 'Not Yet Available';
			}
			$response=2;
		}
		else {
			$msg = '<li><h3 style="color:#F00;">Sorry. You are not selected.</h3></li>';
			$response=1;
		}		 
	 }
	 else {
		$msg = '<li><h3>Please Enter Valid Registration Number</h3></li>';
		 $response=1;
	 }
 }

page_header();
?>
<?php
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
</script>
<div id="container" class="ltr" style="width:96%; float:left; margin-left:20px; height: 350px;">
	<form id="loginform" name="login" class="wufoo page" autocomplete="off" enctype="multipart/form-data" method="post" action="merit_result.php">
	<h2>ऑनलाइन मेरिट रिजल्ट</h2>
	<?php echo $msg; ?>
	<table style="width:100%">
		<tr>
			<td><label  class="desc" id="title2" for="Field2">Registration Number <span id="req_1" class="req">*</span></label></td>
			<td><input id="username" name="username" type="texts" spellcheck="false" class="field text large" value="" maxlength="20" tabindex="1" onBlur="checkname('username')" /><p class="instruct" id="instruct1"><small>This field is required.</small></p></td>
			<td><input id="login_button" tabindex="3" name="login_button" class="btTxt submit" type="submit" value="Search Result"/></td>
		</tr>
	</table>
        <li class="buttons"><div></div></li>
    </ul>
	</form>
</div>

<div style="clear: both;"></div>
<?php 
		break;
	}
	case 2:{
?>
<div id="container" class="ltr" style="width:96%; float:left; margin-left:20px; height: 350px;">
	<form id="loginform" name="login" class="wufoo page" autocomplete="off" enctype="multipart/form-data" method="post" action="merit_result.php">
	<h2>ऑनलाइन मेरिट रिजल्ट</h2>
	<?php echo $msg; ?>
	<table style="width:100%">
		<tr>
			<td><label  class="desc" id="title2" for="Field2">Registration Number <span id="req_1" class="req">*</span></label></td>
			<td><input id="username" name="username" type="texts" spellcheck="false" class="field text large" value="" maxlength="20" tabindex="1" onBlur="checkname('username')" /><p class="instruct" id="instruct1"><small>This field is required.</small></p></td>
			<td><input id="login_button" tabindex="3" name="login_button" class="btTxt submit" type="submit" value="Search Result"/></td>
		</tr>
	</table>
	</form>
	<table>
		<tr>
			<td colspan="6"><?php echo $status; ?></td>
		</tr>
		<tr>
			<td><strong>Registration Number :</strong></td>
			<td><?php echo $row['registration_number'];?></td>
			<td><strong>Student Name :</strong></td>
			<td><?php echo $row['student_name'];?></td>
			<td><strong>Father Name :</strong></td>
			<td><?php echo $row['father_name'];?></td>
		</tr>
		<tr>
			<td><strong>Class :</strong></td>
			<td><?php echo $class['class_description'];?></td>
			<td><strong>Counselling Date From :</strong></td>
			<td colspan="3"><?php echo $counselling;?></td>
		</tr>
	</table>
</div>
<div style="clear: both;"></div>
<?php

		break;
	}
}
page_footer();
ob_end_flush();
?>

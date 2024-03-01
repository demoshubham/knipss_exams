<?php
date_default_timezone_set('Asia/Calcutta');
session_cache_limiter('nocache');
session_start();
$response=1;
$tabindex=1;
$msg='';
if(isset($_GET)){
	foreach($_GET as $k=>$v){
		$_GET[$k] = htmlspecialchars($v);
	}
}
else{
	die();
}
include("settings.php");

switch($_GET['rqst']){
	case 'email' : {
	
		$sql = 'select * from register_users where sno="'.$_GET['id'].'"';
		$user = mysqli_fetch_array(execute_query($sql,dbconnect()));
		$email_code = randomstring();
		$sql = 'update register_users set email_activation="'.$_GET['id'].'_'.$email_code.'" where sno='.$_GET['id'];
		execute_query($sql,dbconnect());
		$headers =  'MIME-Version: 1.0' . "\r\n"; 
		$headers .= 'From: KNIPSS Sultanpur <info@knipss.org>' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
		$msg = "<span style='font-size:14px;'>Dear ".$user['full_name'].",<br /><br />";
		$msg .= "Thank you for registering yourself at Kamla Nehru Institute of Physical and Social Sciences' admission portal. <br /><br /> Your one time verification code for email is <br /><br /><b><u><i>$email_code</i></u></b> <br /><br />Copy the above code and paste in the E-Mail Activation Code box. <br /><br />--<br />Thanks &amp; Regards<br />KNIPSS Team.";
		mail($user['e_mail'],"College Registration", $msg, $headers);
		return true;
		break;
	}
	case  'mob' : {
		$sql = 'select * from register_users where sno="'.$_GET['id'].'"';
		$user = mysqli_fetch_array(execute_query($sql,dbconnect()));
		$otp = randomnumber();
		$sql = 'update register_users set mobile_activation="'.$_GET['id'].'_'.$otp.'" where sno='.$_GET['id'];
		execute_query($sql,dbconnect());
		$get_msg = "Dear, ".$user['full_name']." one time verification code for your college application is $otp. The code is valid for 4 hours only. Regards, KNIPSS Team.";
		send_sms($user['mobile'],$get_msg);
		return true;
		break;
	}
	case 'vmob' :{
		$sql = 'select * from register_users where sno="'.$_GET['id'].'" and mobile_activation="'.$_GET['id'].'_'.$_GET['m'].'"';
		//echo $sql;
		$user = execute_query($sql,dbconnect());
		if(mysqli_num_rows($user)!=0){
			$sql = 'update register_users set mobile_activation=1 where sno='.$_GET['id'];
			execute_query($sql,dbconnect());
			echo 'true';
			return true;
		}
		else{
			echo 'false';
			return false;
		}
		break;
	}
	case 'vemail' :{
		$sql = 'select * from register_users where sno="'.$_GET['id'].'" and email_activation="'.$_GET['id'].'_'.$_GET['m'].'"';
		//echo $sql;
		$user = execute_query($sql,dbconnect());
		if(mysqli_num_rows($user)!=0){
			$sql = 'update register_users set email_activation=1 where sno='.$_GET['id'];
			execute_query($sql,dbconnect());
			echo 'true';
			return true;
		}
		else{
			echo 'false';
			return false;
		}
		break;
	}
}
?>
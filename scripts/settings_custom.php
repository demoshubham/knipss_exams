<?php
//require_once('mailer/class.phpmailer.php');
//require 'mailer/PHPMailerAutoload.php';


$sms_user = mysqli_fetch_array(execute_query($db, "select * from general_settings where `description`='sms_user'"));
$sms_user = $sms_user['value'];

$sms_pwd = mysqli_fetch_array(execute_query($db, "select * from general_settings where `description`='sms_password'"));
$sms_pwd = $sms_pwd['value'];



function send_mail($customer_name, $mailid, $msg, $subject){
	$msg = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
			<title>Backup2mail status</title>
			<style type="text/css">body { background: #000; color: #0f0; font-family: \'Courier New\', Courier; }</style>
		</head>
		<body><h3>'.$msg.'</h3></body></html>';

	$email = new PHPMailer();
	$email->From      = 'info@weknowtech.in';
	$email->FromName  = 'Weknow Technologies';
	$email->Subject   = $subject;
	$email->Body      = $msg;
	$email->AddAddress( $mailid, $customer_name);

	$email->isHTML(true);

	$email->Send();
	
}

function send_sms($number,$get_msg, $hindi=''){
    global $db;
	/*ACE Mind Settings
	
	$get_msg = urlencode($get_msg);
	$ch = curl_init();
	$url = "http://sms.acemindtech.com/api/mt/SendSMS?";
	global $sms_user;
	global $sms_pwd;
	$no=$number;
	$senderID="WEBPRO";
	$route = 22;
	$param = "user=$sms_user&password=$sms_pwd&senderid=$senderID&channel=Trans&DCS=0&flashsms=0&number=$no&text=$get_msg&route=$route$hindi";
	$url = $url.$param;
	//echo $url;
	curl_setopt($ch, CURLOPT_URL,  $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$buffer = curl_exec($ch);
	if(empty($buffer)){
	   return $buffer;
	}
	else{
	   return $buffer;
	}
	
	*/
	
	/*SMS World*/
	if (!isset($_POST['sms_message'])) {
		$_POST['sms_message'] = '';
	}
	$msg = '';
	//$sql = 'http://smsw.co.in/API/WebSMS/Http/v1.0a/index.php?format=json&route_id=route+id&callback=Any+Callback+URL&unique=0&sendondate=19-05-2020T07:38:04&msgtype=unicode';
	/*if($hindi!=''){
		$hindi = '&DCS=8';
	}
	else{
		$hindi = '&DCS=0';
	}*/
	$get_msg = urlencode($get_msg);
	$ch = curl_init();
	$url = "http://smsw.co.in/API/WebSMS/Http/v1.0a/index.php?";
	global $sms_user;
	global $sms_pwd;
	$no=$number;
	$senderID = mysqli_fetch_array(execute_query($db, "select * from general_settings where `description`='sms_sender_id'"));
	$senderID = $senderID['value'];


	$route = 39;
	$param = "username=$sms_user&password=$sms_pwd&sender=$senderID";
	$param = "username=$sms_user&password=$sms_pwd&sender=$senderID&to=$no&message=$get_msg&route_id=$route&reqid=1&format=json$hindi";
	$url = $url.$param;
	//echo $url.'<br><br>';
	//die();
	curl_setopt($ch, CURLOPT_URL,  $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$buffer = curl_exec($ch);
	if(empty($buffer)){
	   return $buffer;
	}
	else{
		$tot_credit = 0;
		$res = json_decode($buffer, true);
		//print_r($res);
		if(is_array($res)){
			$row = array();
			$comma=0;
			$i=1;
			$msg_id = $res['msg_id']; 
			$sender_id = $res['SenderId'];
			$message = $res['message']; 
			$sendondate = $res['sendondate']; 					
			$sql = 'insert into sms_report (msg_id, sendondate, originalnumber, message, textMessage, SenderId, billcredit, dlr_seq) value ';
			foreach($res['seq_id'] as $k=>$v){
				//$tot_credit += $res['billcredit'];
				if($comma==0){
					$comma=1;
					$sql .= '("'.$msg_id.'", "'.$sendondate.'", "'.$v['originalnumber'].'",  "'.$_POST['sms_message'].'", "'.$message.'", "'.$sender_id.'", "'.$v['billcredit'].'", "'.$k.'")';
				}
				else{
					$sql .= ', ("'.$msg_id.'", "'.$sendondate.'", "'.$v['originalnumber'].'",  "'.$_POST['sms_message'].'", "'.$message.'", "'.$sender_id.'", "'.$v['billcredit'].'", "'.$k.'")';

				}
				if($i%50==0){
					execute_query($db, $sql);
					//echo 'Count : '.$i.' >> '.$sql.'<br><br>';
					$sql = 'insert into sms_report (msg_id, sendondate, originalnumber, message, textMessage, SenderId, billcredit, dlr_seq) value ';
					$i++;
					$comma=0;
				}
				else{
					$i++;
				}
			}
			$msg .= '<span class="alert-success">SMS Sent. Total Numbers : '.($i-1).'</span>';
			//echo $sql;
			execute_query($db, $sql);
		}
		else{
			$msg .= '<span class="alert-failed">SMS Failed. '.$buffer.'</span>';
		}
		//echo $msg;
	   return $buffer;
	}
	
	/*Ashish Kalanoria
	
	$get_msg = urlencode($get_msg);
	$ch = curl_init();
	$url = "http://5.189.187.82/sendsms/bulk.php?";
	global $sms_user;
	global $sms_pwd;
	$no=$number;
	$senderID="UPDATE";
	$route = 22;
	$param = "username=$sms_user&password=$sms_pwd&sender=$senderID&mobile=$no&message=$get_msg&type=UNICODE";
	$url = $url.$param;
	//echo $url;
	curl_setopt($ch, CURLOPT_URL,  $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$buffer = curl_exec($ch);
	if(empty($buffer)){
	   return $buffer;
	}
	else{
	   return $buffer;
	}
	*/
	
}

function sms_delivery($msgid){
	$ch = curl_init();
	$url = "http://sms.acemindtech.com/API/WebSMS/Http/v1.0a/index.php?";
	$user="knipss";
	$pwd="knipss987";
	$senderID="KNIPSS";
	$param = "method=show_dlr&username=$user&password=$pwd&msg_id=$msgid&seq_id=1,2&limit=0,100&format=json";
	$url = $url.$param;
	echo $url.'<br>';
	curl_setopt($ch, CURLOPT_URL,  $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$buffer = curl_exec($ch);
	if(empty($buffer)){
	   return $buffer;
	}
	else{
	   return $buffer;
	}
}


?>
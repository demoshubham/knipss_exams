<?php
date_default_timezone_set('Asia/Calcutta');
session_cache_limiter('nocache');
session_start();
set_time_limit(0);
include("settings.php");
$tabindex=1;
$response=1;
$msg='';
$msg1 = '';
$class = '';
$date_from = '';
$date_to = '';
$link = dbconnect();
$sql = 'select declared_merit.registration_number, declared_merit.student_name, class_detail.class_description, counselling_date_from, counselling_date_to, register_users.mobile, declared_merit.status as status from declared_merit left JOIN class_detail on class_detail.sno = declared_merit.class left join register_users on register_users.user_name = declared_merit.registration_number WHERE declared_merit.sno>5125';
$result = execute_query($sql,$link);
$i=0;
while($row = mysqli_fetch_array($result)){
	if($row['status']==1){
		$msg = "Dear ".$row['student_name'].", you have been selected for counselling in ".$row['class_description']." at KNIPSS Sultanpur. You have to report in between ".date("d-m-Y", strtotime($row['counselling_date_from']))." to ".date("d-m-Y", strtotime($row['counselling_date_to'])).", 10 AM to 2:30 PM only along with the academic documents. Logon to our website (http://merit.knipss.com/merit_result.php) for details.";
	}
	elseif($row['status']==2){
		$msg = "Dear ".$row['student_name'].", you are in waiting list for ".$row['class_description']." at KNIPSS Sultanpur. Logon to our website (http://merit.knipss.com/merit_result.php) for details.";
	}
	elseif($row['status']==3){
		$msg = "Dear ".$row['student_name'].", your online admission application is incomplete. Please contact the concerned department between 31-07-2017 to 05-08-2017, 10 AM to 2:30 PM only.";
	}
	//echo $msg.'<br><br>';
	//$row['mobile'] = '955496977, 8858774777';
	send_sms($row['mobile'], $msg);
	$i++;
	//die();
}
echo $i.' Messages sent.';
?>
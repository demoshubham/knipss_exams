<?php
date_default_timezone_set('Asia/Calcutta');
session_cache_limiter('nocache');
session_start();
include("settings.php");
include("get_computer.php");
logvalidate('','');
$tabindex=1;
$response=1;
$msg='';
$link = dbconnect();

$today = date('Y-m-d', strtotime(date("Y-m-d") . ' -1 day'));
//$today = $today-1;
//$today = date("Y-m")."-$today";

$sql = 'select * from register_users';
$result = execute_query($sql,dbconnect());
$tot_reg = mysqli_num_rows($result);

$sql = 'select * from register_users where datestamp="'.$today.'"';
//echo $sql;
$result = execute_query($sql,dbconnect());
$tot_reg_today = mysqli_num_rows($result);

$sql = 'select * from register_users where mobile_activation="1"';
$result = execute_query($sql,dbconnect());
$tot_reg_verified = mysqli_num_rows($result);

$sql = 'select * from register_users where mobile_activation="1" and datestamp="'.$today.'"';
$result = execute_query($sql,dbconnect());
$tot_reg_verified_today = mysqli_num_rows($result);

$sql = 'select * from fees_invoice where status="Success"';
$result = execute_query($sql,dbconnect());
$tot_fees_paid = mysqli_num_rows($result);

$sql = 'select * from fees_invoice where status="Success" and txnreqdate like "'.$today.'%"';
$result = execute_query($sql,dbconnect());
$tot_fees_paid_today = mysqli_num_rows($result);

$sql = 'select sum(amount) as amount from fees_invoice where status="Success"';
$result = execute_query($sql,dbconnect());
$tot_fees_amount = mysqli_fetch_array($result);
$tot_fees_amount = $tot_fees_amount['amount']/100;

$sql = 'select sum(amount) as amount from fees_invoice where status="Success" and txnreqdate like "'.$today.'%"';
$result = execute_query($sql,dbconnect());
$tot_fees_amount_today = mysqli_fetch_array($result);
$tot_fees_amount_today = $tot_fees_amount_today['amount']/100;


echo "Report for : $today<br>
Reg : $tot_reg <br>
Reg Today : $tot_reg_today<br>
Verified : $tot_reg_verified<br>
Verified Today : $tot_reg_verified_today<br>
Fees Paid : $tot_fees_paid<br>
Fees Paid Today : $tot_fees_paid_today<br>
Amount Paid : $tot_fees_amount<br>
Amount Paid Today : $tot_fees_amount_today";

$get_msg = "Report for : $today
Reg : $tot_reg 
Reg Today : $tot_reg_today
Verified : $tot_reg_verified
Verified Today : $tot_reg_verified_today
Fees Paid : $tot_fees_paid
Fees Paid Today : $tot_fees_paid_today
Amount Paid : $tot_fees_amount
Amount Paid Today : $tot_fees_amount_today";

$number="9554969777";

echo send_sms($number,$get_msg);
?>
<?php
date_default_timezone_set('Asia/Calcutta');
session_cache_limiter('nocache');
session_start();
include("settings.php");
include("get_computer.php");
logvalidate('','');

$response_case=1;

$sql = ' INSERT INTO `fees_invoice` (`order_id` , `student_id` , `timestamp` , `date_time` , `amount` , `status`)
VALUES ("'.$_REQUEST['OrderId'].'" , "'.$_REQUEST['student_id'].'" , "'.time().'" , "'.date('Y-m-d H:i:s').'" , "'.$_REQUEST['amount'].'" , "Proceeded")';
execute_query($sql,dbconnect());

$sql = 'update `fees_invoice` set 
`status` = "Success", 
`txnrefno` = "Manual Cash Payment", 
`statuscode` = "S" , 
`statusdesc` = "Transaction is Successful", 
`txnreqdate` = "'.date("Y-m-d").'",
`responsecode` = "00",
`rrn` = "", 
`authzstatus` = "Manually Updated Cash Payment",
`amount_returned` = "'.$_POST['amount'].'"
where order_id="'.$_POST['OrderId'].'"';
execute_query($sql,dbconnect());
//echo $sql;

$sql = 'select * from fees_invoice where order_id="'.$_POST['OrderId'].'"';
//echo $sql;
$result_inv = mysqli_fetch_array(execute_query($sql,dbconnect()));


$sql = 'select * from register_users where sno="'.$result_inv['student_id'].'"';
//echo $sql;
$result_email = execute_query($sql,dbconnect());
$user = mysqli_fetch_array($result_email);

$reg_no = str_pad($user['sno'], 5, "0", STR_PAD_LEFT);
$reg_no = '2017'.$reg_no;
$pwd = randompassword();

$sql = 'update register_users set user_name="'.$reg_no.'", password="'.$pwd.'" where sno='.$user['sno'];
execute_query($sql,dbconnect());

$sql = 'update student_info set date_of_admission="'.date("Y-m-d").'", status=1 where sno='.$user['sno'];
//execute_query($sql,dbconnect());

$msg = 'Dear '.$user['full_name'].', your Registration number is '.$reg_no.' and password is '.$pwd.'. Please login to complete your application.';
//send_sms($user['mobile'], $msg);

$headers =  'MIME-Version: 1.0' . "\r\n"; 
$headers .= 'From: KNIPSS Sultanpur <info@knipss.org>' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
$msg = "<span style='font-size:14px;'>Dear ".$user['full_name'].",<br /><br />";
$msg .= "Your registering is complete at Kamla Nehru Institute of Physical and Social Sciences' admission portal. <br /><br /> Your Registration number is <br /><br /><b><u><i>$reg_no</i></u></b> <br /><br />and password is <br /><br /><b><u><i>$pwd</i></u></b> <br /><br />Use the above details to login and proceed to admission form. <br /><br />--<br />Thanks &amp; Regards<br />KNIPSS Team.";
mail($user['e_mail'],"College Registration", $msg, $headers);


$status = "Success";
$msg = 'Dear '.$user['full_name'].', your payment is complete and your Order ID is '.$_POST['OrderId'].'. Please save this message for future reference.';
//send_sms($user['mobile'], $msg);

$headers =  'MIME-Version: 1.0' . "\r\n"; 
$headers .= 'From: KNIPSS Sultanpur <info@knipss.org>' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
$msg = "<span style='font-size:14px;'>Dear ".$user['full_name'].",<br /><br />";
$msg .= "Your payment is complete at Kamla Nehru Institute of Physical and Social Sciences' admission portal. <br /><br /> Your Order Number is <br /><br /><b><u><i>".$_POST['OrderId']."</i></u></b> <br /><br />--<br />Thanks &amp; Regards<br />KNIPSS Team.";
mail($user['e_mail'],"College Registration", $msg, $headers);

page_header();
?>
<?php
switch($response_case){
	case 1:{
?>	
	<table>
		<tr>
		    <td colspan="6" style="text-align:center;">
		        <?php
                    	echo "<h3>Transaction Success. <a href='print_receipt.php?sid=".$user['sno']."' target='_blank'>Click Here to print receipt.</a><br /><br /><a href='new_admission.php?sid=".$user['sno']."'>Click Here to go Admission Form.</a><br /><br /><a href='user_home.php'>Click Here to go Home.</a></h3>";
		        ?>
		    </td>
		</tr>
	</table>

<?php
		break;
	}
}
page_footer();
?>

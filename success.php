<?php
date_default_timezone_set('Asia/Calcutta');
session_cache_limiter('nocache');
session_start();
include("settings.php");
include("get_computer.php");
logvalidate('','');
$response=1;
$response_case=1;

/*Remove this comment to re-enable payment gateway

include 'AWLMEAPI.php';
$obj = new AWLMEAPI();
$resMsgDTO = new ResMsgDTO();
$reqMsgDTO = new ReqMsgDTO();
$enc_key = "a6a545ec4e2ecb799feb94d6bed98abe";
$responseMerchant = $_REQUEST['merchantResponse'];
$response = $obj->parseTrnResMsg( $responseMerchant , $enc_key );
$response_case=1;

if($response->getStatusCode()=="F"){
	$status = "Failed";
}
else{
	$status = "Success";
}

$sql = 'update `fees_invoice` set 
`status` = "'.$status.'", 
`txnrefno` = "'.$response->getPgMeTrnRefNo().'", 
`statuscode` = "'.$response->getStatusCode().'" , 
`statusdesc` = "'.$response->getStatusDesc().'", 
`txnreqdate` = "'.$response->getTrnReqDate().'",
`responsecode` = "'.$response->getResponseCode().'",
`rrn` = "'.$response->getRrn().'", 
`authzstatus` = "'.$response->getAuthZCode().'",
`amount_returned` = "'.$response->getTrnAmt().'"
where order_id="'.$response->getOrderId().'"';
execute_query($sql,dbconnect());
//echo $sql;*/


$sql = 'update `fees_invoice` set 
`status` = "Success", 
`txnrefno` = "Manual Cash Payment", 
`statuscode` = "S" , 
`statusdesc` = "Transaction is Successful", 
`txnreqdate` = "'.date('Y-m-d').'",
`responsecode` = "00",
`rrn` = "", 
`authzstatus` = "Manually Updated Cash Payment",
`amount_returned` = "30000"
where sno="'.$_GET['id'].'"';
execute_query($sql,dbconnect());


$sql = 'select * from fees_invoice where sno="'.$_GET['id'].'"';
//echo $sql;
$result_inv = mysqli_fetch_array(execute_query($sql,dbconnect()));


$sql = 'select * from register_users where sno="'.$result_inv['student_id'].'"';
//echo $sql;
$result_email = execute_query($sql,dbconnect());
$user = mysqli_fetch_array($result_email);
$status = "Success";
$msg = 'Dear '.$user['full_name'].', your payment is complete and your Order ID is '.$result_inv['order_id'].'. Please save this message for future reference.';
//send_sms($user['mobile'], $msg);

$headers =  'MIME-Version: 1.0' . "\r\n"; 
$headers .= 'From: KNIPSS Sultanpur <info@knipss.org>' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
$msg = "<span style='font-size:14px;'>Dear ".$user['full_name'].",<br /><br />";
$msg .= "Your payment is complete at Kamla Nehru Institute of Physical and Social Sciences' admission portal. <br /><br /> Your Order Number is <br /><br /><b><u><i>".$result_inv['order_id']."</i></u></b> <br /><br />--<br />Thanks &amp; Regards<br />KNIPSS Team.";
//mail($user['e_mail'],"College Registration", $msg, $headers);

page_header();
?>
<?php
switch($response_case){
	case 1:{
?>	
	<table>
		<tr><!-- PG transaction reference number-->
			<td><label for="txnRefNo">Transaction Ref No. :</label></td>
			<td><?php echo $result_inv['order_id'];?></td>
			<!-- Merchant order number-->
			<td><label for="orderId">Order No. :</label></td>
			<td><?php echo $result_inv['order_id'];?> </td>
			<!-- Transaction amount-->
			<td><label for="amount">Amount :</label></td>
			<td><?php echo $result_inv['amount_returned']/100;?></td>
		</tr>
		<tr><!-- Transaction status code-->
			<td><label for="statusCode">Status Code :</label></td>
			<td><?php echo $result_inv['statuscode'];?></td>
			
			<!-- Transaction status description-->
			<td><label for="statusDesc">Status Desc :</label></td>
			<td><?php echo $result_inv['status'];?></td>
			
			<!-- Transaction date time-->
			<td><label for="txnReqDate">Transaction Request Date :</label></td>
			<td><?php echo $result_inv['txnreqdate'];?></td>
		</tr>
		<tr>
			<!-- Transaction response code-->
			<td><label for="responseCode">Response Code :</label></td>
			<td><?php echo $result_inv['responsecode'];?></td>
			
			<!-- Bank reference number-->
			<td><label for="statusDesc">RRN :</label></td>
			<td><?php echo $result_inv['rrn'];?></td>
			<!-- Authzcode-->
			<td><label for="authZStatus">AuthZCode :</label></td>	
			<td><?php echo $result_inv['authzstatus'];?></td>
		</tr>
		<tr>
		    <td colspan="6" style="text-align:center;">
		        <?php
                    	echo "<h3>Transaction Success. <a href='print_receipt.php' target='_blank'>Click Here to print receipt.</a><br /><br /><a href='user_home.php'>Click Here to go Home.</a></h3>";
	        
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

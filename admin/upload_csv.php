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
$table ='';
$mismatch=0;
if (isset ($_FILES['csv_file'])){
	$path = $_FILES['csv_file']['name'];
	$filename = $_FILES['csv_file']['tmp_name'];
	$myfile = fopen($filename, "r") or die("Unable to open file!");
	$content = fread($myfile,filesize($filename));
	$row = explode("\n", $content);
	$table = '<table style="overflow-x:scroll; width:100%;">';
	$i=1;
	$a=0;
	$head=0;
	$sms_master='';
	$mismatch_row = array();
	$mismatch_table='<table>';
	$col_to_print = array(3, 6, 9, 13, 16, 18, 19, 20, 21, 22, 23, 25, 26, 30, 36, 37, 38, 39, 40, 41);
	$ok = 'Transaction authorised successfully';
	foreach($row as $k=>$v){
		unset($invoice_status);
		$invoice_status['status']='';
		$table .= '<tr>';
		if($head==0){
			$table .= '<th>S.No.</th>';
		}
		else{
				$table .= '<td>'.($i++).'</td>';
		}
		$columns = explode(",",$v);
		$status=0;
		foreach($columns as $k1=>$v1){
			if($head==0){
				if(in_array($k1, $col_to_print)){
					$table .= '<th>'.$v1.' ('.$k1.')</th>';
				}
			}
			else{
				if(in_array($k1, $col_to_print)){
					if($k1==6){
						$sql = 'select * from fees_invoice where order_id="'.$v1.'"';
						//echo $sql;
						$invoice_status = mysqli_fetch_array(execute_query($sql,dbconnect()));
					}
					if($k1==36){
						$status = $v1;
					}
					$table .= '<td>'.$v1.'</td>';
				}
			}
		}
		$table .= '<td>'.$invoice_status['status'].'</td>';
		if(strtolower(trim($status))==strtolower(trim($ok))){
			if($invoice_status['status']!="Success"){
				$mismatch++;
				$table .= '<td style="color:#F00; font-size:24px;">Mismatch</td>';
				$mismatch_row[] = $columns;
				$mismatch_table .= '<tr>';
				foreach($columns as $k1=>$v1){
					if(in_array($k1, $col_to_print)){
						if($k1==6){
							$sql = 'select * from fees_invoice where order_id="'.$v1.'"';
							//echo $sql.'<br>';
							$invoice_status = mysqli_fetch_array(execute_query($sql,dbconnect()));
						}
						$mismatch_table .= '<td>'.$v1.'</td>';
					}
				}
				$sql = 'select student_info.sno as sno, register_users.user_name, student_info.stu_name, student_info.father_name, register_users.mobile from student_info join register_users on register_users.sno = student_info.sno where student_info.sno = '.$invoice_status['student_id'];
				//echo $sql.'<br>';
				$student_info = mysqli_fetch_array(execute_query($sql,dbconnect()));
				$mismatch_table .= '<td>'.$student_info['user_name'].'</td><td>'.$student_info['stu_name'].'</td><td>'.$student_info['father_name'].'</td><td>'.$student_info['mobile'].'</td></tr>';
				//$invoice_status['student_id'] = 
				$sql = 'update `fees_invoice` set 
				`status` = "Success", 
				`txnrefno` = "'.$columns[3].'", 
				`statuscode` = "S" , 
				`statusdesc` = "Transaction is Successful", 
				`txnreqdate` = "'.$columns[9].'",
				`responsecode` = "00",
				`rrn` = "'.$columns[26].'", 
				`authzstatus` = "Manually Updated",
				`amount_returned` = "'.$columns[37].'"
				where order_id="'.$columns[6].'"';
				execute_query($sql,dbconnect());

				
				$sql = 'select * from register_users where sno="'.$student_info['sno'].'"';
				//echo $sql;
				$result_email = execute_query($sql,dbconnect());
				$user = mysqli_fetch_array($result_email);
				
				$sms_msg = 'Dear '.$user['full_name'].', your payment is complete and your Order ID is '.$columns[6].'. Please save this message for future reference.';
				send_sms($user['mobile'], $sms_msg);
				
				$sms_master .= ' '.$user['full_name'].'('.$user['user_name'].'). ';

				$headers =  'MIME-Version: 1.0' . "\r\n"; 
				$headers .= 'From: KNIPSS Sultanpur <info@knipss.org>' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
				$mail_msg = "<span style='font-size:14px;'>Dear ".$user['full_name'].",<br /><br />";
				$mail_msg .= "Your payment is complete at Kamla Nehru Institute of Physical and Social Sciences' admission portal. <br /><br /> Your Order Number is <br /><br /><b><u><i>".$columns[6]."</i></u></b> <br /><br />--<br />Thanks &amp; Regards<br />KNIPSS Team.";
				mail($user['e_mail'],"College Registration", $mail_msg, $headers);
				
			}
		}	
		if($head==0){
			$table .= '<th>Registration Number</th>
			<th>Student Name</th>
			<th>Father Name</th>
			<th>Mobile</th>';
		}
		else{
			$sql = 'select register_users.user_name, student_info.stu_name, student_info.father_name, register_users.mobile from student_info join register_users on register_users.sno = student_info.sno where student_info.sno = '.$invoice_status['student_id'];
			//echo $sql.'<br>';
			$student_info = mysqli_fetch_array(execute_query($sql,dbconnect()));
			$table .= '<td>'.$student_info['user_name'].'</td>
			<td>'.$student_info['stu_name'].'</td>
			<td>'.$student_info['father_name'].'</td>
			<td>'.$student_info['mobile'].'</td>';
		}
		$table .= '</tr>';
		$head=1;
	}
	$table .= '</table>';
	if($sms_master!=''){
		$sms_master = 'Manullay Updated : '.$sms_master;
		$sms_response = send_sms("9554969777", $sms_master);
		echo 'Hello >>'.$sms_response;
	}
	fclose($myfile);
}



page_header();
?>
<?php
switch($response){
	case 1:{
?>	

<div style="width:100%; background:#027cd1; height:28px; text-align: right; color: #ffffff; font-size: 20px; font-weight: bold;">
	<div style="margin-right: 50px; float:right;"><a href="logout.php" style="color:#fff;">Logout </a>&nbsp;</div>
</div>
<div id="container" class="ltr" style="width:100%; float:none;">
	<h2> CSV Upload </h2>
	<form action="upload_csv.php" class="leftLabel page1 pure-form" name="admission_newadmission" enctype="multipart/form-data" method="post" onSubmit="" >
	<?php echo $msg;?>
	<table width="100%" style="border:1px solid;">	
		<tr>
			<td>Select File :</td>
			<td><input type="file" name="csv_file" ></td>
		</tr>
		<tr>
			<td colspan="2" style="text-align: center;"><input class="btTxt submit" type="submit" name="form_submit" value="Upload File"></td>
		</tr>
		<tr>
			<td colspan="2">Total Mismatch : <?php echo $mismatch; ?></td>
		</tr>
	</table>
	<?php echo $mismatch_table; ?>
	<?php echo $table; ?>
</div>

<?php
		break;
	}
}

page_footer();

?>
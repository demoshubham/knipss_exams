<?php 
include('settings.php');
include('Crypto.php');
$msg = '';
page_header();

// print_r($_POST);
	$postdata = json_encode($_POST);

	$workingKey='AAF3FEAB87C4667BA72858385FF73404';		//Working Key should be provided here.
	$encResponse=$_POST["encResp"];			//This is the response sent by the CCAvenue Server
	$rcvdString=decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
	$order_status="";
	$decryptValues=explode('&', $rcvdString);
	$dataSize=sizeof($decryptValues);

	for($i = 0; $i < $dataSize; $i++) 
	{
		$information=explode('=',$decryptValues[$i]);
		if($i==3)	$order_status=$information[1];
	}
	
	$table =  "<table class='table table-responsive table-hover table-striped'>";
	for($i = 0; $i < $dataSize; $i++) 
	{
		$information=explode('=',$decryptValues[$i]);
	    	// $table .=  '<tr><td>'.$information[0].'</td><td>'.urldecode($information[1]).'</td></tr>';
	    	$_POST[$information[0]] = $information[1];
	}
	

	if($order_status==="Success")
	{
		$msg .= "<div class='alert alert-success'>Thank you for banking with us. Your transaction is successful. Your Transction ID : ".$_POST['tracking_id'].".</div>";
	}
	else if($order_status==="Aborted")
	{
		$msg .= "<div class='alert alert-danger'>Transaction Aborted .We will keep you posted regarding the status of your order through e-mail</div>";
	
	}
	else if($order_status==="Failure")
	{
		$msg .= "<div class='alert alert-danger'>The transaction has been declined.</div>";
	}
	else
	{
		$msg .= "<div class='alert alert-info'>Security Error. Illegal access detected</div>";
	
	}

	$sql = 'select * from online_payment_eval where sno="'.$_POST['merchant_param5'].'"';
    $payment = mysqli_fetch_assoc(execute_query($sql));
    
    $sql = 'select * from student_info where sno="'.$payment['student_id'].'"';
    //echo $sql.'<br>';
    $student_info = mysqli_fetch_assoc(mysqli_query($erp_link,$sql));
    
    

    $table .= '
	<tr>
    	<th>Transaction Date </th>
		<td>'.$_POST['trans_date'].'</td>
		<th>Status</th>
		<td>'.$_POST['order_status'].'</td>
	</tr>
	<tr>
    	<th>Student Name</th>
		<td>'.$student_info['stu_name'].'</td>
		<th>Father Name</th>
		<td>'.$student_info['father_name'].'</td>
	</tr>
	<tr>
    	<th>Phone Number</th>
		<td>'.$student_info['mobile'].'</td>
		<th>Date of Birth</th>
		<td>'.$student_info['dob'].'</td>
	</tr>
	<tr>';
		echo '<th>Transaction ID</th>
		<td>'.$_POST['tracking_id'].'</td>
	</tr>
	<tr>';
		echo '<th>Status Message</th>
		<td>'.$payment['status_message'].'</td>
	</tr>
	
	';
	echo $msg;
	echo '<div class="alert alert-primary">Transction ID : '.$_POST['tracking_id'].'</div>';
	echo $table;

    $sql = 'update online_payment_eval set 
    tracking_id = "'.$_POST['tracking_id'].'", 
    bank_ref_no = "'.$_POST['bank_ref_no'].'", 
    order_status = "'.$_POST['order_status'].'", 
    failure_message = "'.$_POST['failure_message'].'", 
    payment_mode = "'.$_POST['payment_mode'].'", 
    card_name = "'.$_POST['card_name'].'", 
    status_code = "'.$_POST['status_code'].'", 
    status_message = "'.$_POST['status_message'].'", 
    delivery_name = "'.$_POST['delivery_name'].'", 
    delivery_address = "'.$_POST['delivery_address'].'", 
    delivery_city = "'.$_POST['delivery_city'].'", 
    delivery_state = "'.$_POST['delivery_state'].'", 
    delivery_zip = "'.$_POST['delivery_zip'].'", 
    delivery_country = "'.$_POST['delivery_country'].'", 
    delivery_tel = "'.$_POST['delivery_tel'].'", 
    vault = "'.$_POST['vault'].'", 
    offer_type = "'.$_POST['offer_type'].'", 
    offer_code = "'.$_POST['offer_code'].'", 
    discount_value = "'.$_POST['discount_value'].'", 
    mer_amount = "'.$_POST['mer_amount'].'", 
    eci_value = "'.$_POST['eci_value'].'", 
    retry = "'.$_POST['retry'].'", 
    response_code = "'.$_POST['response_code'].'", 
    billing_notes = "'.$_POST['billing_notes'].'", 
    trans_date = "'.$_POST['trans_date'].'", 
    bin_country = "'.$_POST['bin_country'].'", 
    trans_fee = "'.$_POST['trans_fee'].'", 
    service_tax = "'.$_POST['service_tax'].'", 
    edition_time = "'.date("Y-m-d H:i:s").'"
    where sno="'.$_POST['merchant_param4'].'"';
    //echo $sql;
    execute_query($sql);
    
    
    
	echo "</table><br>";
	if($order_status==="Success")
	{
		$sql="INSERT INTO `exam_copy_recheck`(`exam_roll_no`,`papercode`,`course` ,`mobile_no`, `bank_trans_no`,payment_status,creation_time) VALUES ('".$_POST['merchant_param1']."','".$_POST['merchant_param4']."','".$_POST['merchant_param2']."','".$_POST['merchant_param3']."','".$_POST['tracking_id']."','done','".date("d-m-Y H:i:s")."')";

        // $sql="INSERT INTO `exam_copy_recheck`(`exam_roll_no`,`papercode`,`course` ,`mobile_no`, `bank_trans_no`, `remark`) VALUES ('".$_POST['rollno']."','".$_POST['papercode']."','".$_POST['course']."','".$_POST['mobno']."','$bank_reference_no','".$_POST['remark']."')";
	
        $res=mysqli_query($db,$sql);
    
        
		// ,'".$_SESSION['username']."','".date("d-m-Y H:i:s")."'
		$res=mysqli_query($db,$sql);
		$appno=mysqli_insert_id($db);
	    // $sql = 'select * from register_users where user_name="'.$payment['registration_no'].'"';
	    // $register = mysqli_fetch_assoc(execute_query($sql));
	    
	    // $sql = 'update register_users set 
        // bank_trans_no = "'.$_POST['tracking_id'].'", 
        // payment_status = "'.$_POST['order_status'].'"
        // where sno="'.$register['sno'].'"';
        // //echo $sql;
        // execute_query($sql);
	    ?>
			<form action="print_anwer_sheet_view.php" method="POST">
				<input type="hidden" name="rollno" value="<?php echo $_POST['merchant_param1'];?>">
				<input type="hidden" name="course" value="<?php echo $_POST['merchant_param2'];?>">
				<input type="hidden" name="mobno" value="<?php echo $_POST['merchant_param3'];?>">
				<input type="hidden" name="papercode" value="<?php echo $_POST['merchant_param4'];?>">
				<input type="hidden" name="bankrefno" value="<?php echo $_POST['tracking_id'];?>">
				<input type="hidden" name="appno" value="<?php echo $appno;?>">
				<input type="submit" value="Continue to Complete your application form" name="submit" class="alert alert-success p-2">
			</form>
		<?php
	    // echo '<div class="alert alert-success"><a href="admission_form.php?id='.$register['sno'].'&pr=1">Continue to Complete your application form.</a></div>';
	}
	page_footer();
?>

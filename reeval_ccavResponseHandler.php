<?php 
include('settings.php');
include('Crypto.php');
$msg = '';
page_header();

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
    
    
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

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
    where sno="'.$_POST['merchant_param5'].'"';
    //echo $sql;
    $ress=mysqli_query($db,$sql);
    // if($ress){
    //     echo "updated";
    // }
    if(mysqli_error($db)){
		die("Error 201 : ".mysqli_error($db)." >> ".$sql);
	}
    
     $updatesql="UPDATE exam_copy_view SET bank_trans_no='".$_POST['tracking_id']."', payment_status='".$_POST['order_status']."' WHERE sno='".$_POST['merchant_param4']."'";

    $resi=mysqli_query($db,$updatesql);
    // if($resi){
    //     echo "Updated";
    // }
    
	echo "</table><br>";
	if($order_status==="Success")
	{

	    ?>
			<form action="print_anwer_sheet_view.php" method="POST">
				<input type="hidden" name="rollno" value="<?php echo $_POST['merchant_param1'];?>">
				<input type="hidden" name="course" value="<?php echo $_POST['merchant_param2'];?>">
				<input type="hidden" name="mobno" value="<?php echo $_POST['merchant_param3'];?>">
				<input type="hidden" name="examcopyviewsno" value="<?php echo $_POST['merchant_param4'];?>">
				<input type="hidden" name="bankrefno" value="<?php echo $_POST['tracking_id'];?>">
				<input type="hidden" name="paymentordersno" value="<?php echo $_POST['merchant_param5'];?>">
				<input type="submit" value="Continue to Complete your application form" name="submit" style="height:50px;border-radius:6px;" class="alert alert-success ">
			</form>
		<?php
	    // echo '<div class="alert alert-success"><a href="admission_form.php?id='.$register['sno'].'&pr=1">Continue to Complete your application form.</a></div>';
	}
	page_footer();
?>

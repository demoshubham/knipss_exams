<html>
<head>
<title> Custom Form Kit </title>
</head>
<body>
<center>

<?php include('settings.php')?>
<?php include('Crypto.php')?>
<?php 
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
	


	$sql = 'INSERT INTO `online_payment_eval` ( `tid`, `merchant_id`, `order_id`, `amount`, `currency`, `redirect_url`, `cancel_url`, `language`, `billing_name`, `billing_addres`, `billing_city`, `billing_state`, `billing_zip`, `billing_country`, `billing_tel`, `billing_email`, `merchant_param1`, `merchant_param2`, `merchant_param3`,`merchant_param4`, `student_id`,  `created_by`, `creation_time`) VALUES ("'.$_POST['tid'].'", "'.$_POST['merchant_id'].'", "'.$_POST['order_id'].'", "'.$_POST['amount'].'", "'.$_POST['currency'].'", "'.$_POST['redirect_url'].'", "'.$_POST['cancel_url'].'", "'.$_POST['language'].'", "'.$_POST['billing_name'].'", "'.$_POST['billing_address'].'", "'.$_POST['billing_city'].'", "'.$_POST['billing_state'].'", "'.$_POST['billing_zip'].'", "'.$_POST['billing_country'].'", "'.$_POST['billing_tel'].'", "'.$_POST['billing_email'].'", "'.$_POST['merchant_param1'].'", "'.$_POST['merchant_param2'].'", "'.$_POST['merchant_param3'].'","'.$_POST['merchant_param4'].'","'.$_POST['student_id'].'", NULL, "'.date('Y-m-d H:i:s').'");';
	execute_query($sql);
	$id = mysqli_insert_id($db);
	// print_r($_POST);
	//echo '<hr/><hr/><hr/><hr/>';
	$_POST['merchant_param5'] = $id;

	$merchant_data='';
	$working_key='AAF3FEAB87C4667BA72858385FF73404';//Shared by CCAVENUES
	$access_code='AVVS04KH35CK62SVKC';//Shared by CCAVENUES
	
	foreach ($_POST as $key => $value){
		$merchant_data.=$key.'='.urlencode($value).'&';
	}
	echo "<br><br>".$merchant_data;
	$encrypted_data=encrypt($merchant_data,$working_key); // Method for encrypting the data.

?>
  
<form method="post" name="redirect" action="https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction"> 

<?php
echo "<input type=hidden name=encRequest value=$encrypted_data>";
echo "<input type=hidden name=access_code value=$access_code>";
?>
</form>
</center>
<?php
// print_r($_POST);

?>
<script language='javascript'>document.redirect.submit();</script>
</body>
</html>


<?php
error_reporting(0);
	/**
	 * This Is the Kit File To Be Included For Transaction Request
	 */
	function dbconnect(){
		$connect = mysqli_connect("p:localhost", "cloudice", "clou@123", "cloudice_knionline_2023");
		if(!$connect){
			die('1.System error contact administrator');
		}
		return $connect;	
	}

/*Remove this comment to re-enable payment gateway


	include 'AWLMEAPI.php';
	
	//create an Object of the above included class
	$obj = new AWLMEAPI();

	//create an object of Request Message
	$reqMsgDTO = new ReqMsgDTO();

	/* Populate the above DTO Object On the Basis Of The Received Values 
	// PG MID
	$reqMsgDTO->setMid('WL0000000006449');
	// Merchant Unique order id
	$reqMsgDTO->setOrderId($_REQUEST['OrderId']);
	//Transaction amount in paisa format
	$reqMsgDTO->setTrnAmt($_REQUEST['amount']);
	//Transaction remarks
	$reqMsgDTO->setTrnRemarks("This txn has to be done ");
	// Merchant transaction type (S/P/R)
	$reqMsgDTO->setMeTransReqType($_REQUEST['meTransReqType']);
	// Merchant encryption key
	$reqMsgDTO->setEnckey('a6a545ec4e2ecb799feb94d6bed98abe');
	// Merchant transaction currency
	$reqMsgDTO->setTrnCurrency($_REQUEST['currencyName']);
	// Recurring period, if merchant transaction type is R
	$reqMsgDTO->setRecurrPeriod($_REQUEST['recurPeriod']);
	// Recurring day, if merchant transaction type is R
	$reqMsgDTO->setRecurrDay($_REQUEST['recurDay']);
	// No of recurring, if merchant transaction type is R
	$reqMsgDTO->setNoOfRecurring($_REQUEST['numberRecurring']);
	// Merchant response URl
	$reqMsgDTO->setResponseUrl('http://merit.knipss.com/success.php');
	// Optional additional fields for merchant
	/* 
	 * After Making Request Message Send It To Generate Request 
	 * The variable `$urlParameter` contains encrypted request message
	 
	 //Generate transaction request message
	$merchantRequest = "";
	
	$reqMsgDTO = $obj->generateTrnReqMsg($reqMsgDTO);
	
	if ($reqMsgDTO->getStatusDesc() == "Success"){
		$merchantRequest = $reqMsgDTO->getReqMsg();
	}*/
	$sql = ' INSERT INTO `fees_invoice` (`order_id` , `student_id` , `timestamp` , `date_time` , `amount` , `status`)
	VALUES ("'.$_REQUEST['OrderId'].'" , "'.$_REQUEST['student_id'].'" , "'.time().'" , "'.date('Y-m-d H:i:s').'" , "'.$_REQUEST['amount'].'" , "Proceeded")';
	execute_query($sql,dbconnect());
	$id = mysqli_insert_id($db);

//Remove header to restore payment gateway.

header('Location: success.php?id='.$id);
?>


<form action="https://ipg.in.worldline.com/doMEPayRequest" method="post" name="txnSubmitFrm">
	<h4 align="center">Redirecting To Payment Please Wait..</h4>
	<h4 align="center">Please Do Not Press Back Button OR Refresh Page</h4>
	<input type="hidden" size="200" name="merchantRequest" id="merchantRequest" value="<?php echo $merchantRequest; ?>"  />
	<input type="hidden" name="MID" id="MID" value="<?php echo $reqMsgDTO->getMid(); ?>"/>
</form>
<script  type="text/javascript">
	//submit the form to the worldline
	document.txnSubmitFrm.submit();
</script>
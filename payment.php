<?php
ob_start();
date_default_timezone_set('Asia/Calcutta');
session_cache_limiter('nocache');
session_start();
include("settings.php");

$response=1;
$tabindex=1;
$msg='';
if(isset($_POST)){
	foreach($_POST as $k=>$v){
		$_POST[$k] = htmlspecialchars($v);
	}
}
if(isset($_POST['register'])){
	$response=2;
}
if(isset($_POST['register1'])){
	$response=3;
}

page_header();
?>


<?php
// $response=4;
// $reg_no = 'KNI2023009030';
switch($response){
	case 1:{
?>	
<style>
	.backgr1{
		display:block;
		border-radius:12px;
		width:45%;
		height:150px;
		background-image:url("css/demo_img/first.jpg");
		background-repeat:no-repeat;
		background-size:cover;
		background-position:center;
		position:relative;
		box-shadow:3px 3px 5px #333;
		
	}
	.backgr2{
		border-radius:12px;
		display:block;
		width:45%;
		height:150px;
		background-image:url("css/demo_img/second.png");
		background-repeat:no-repeat;
		background-size:cover;
		background-position:center;
		position:relative;
		box-shadow:3px 3px 5px #333; 
	}
	
	.backgr1:before,
	.backgr1:after,
	.backgr2:before,
	.backgr2:after {
		content: "";
		position: absolute;
		display: block;
		box-sizing: border-box;
		top: 0;
		left: 0;
	}

	.backgr1:after {
		width: 70%;
		height: 90%;
		margin-top:10px;
		line-height: 50px;
		background: url('css/demo_img/print.png');
		background-repeat: no-repeat;
		background-size: contain;
		border-radius: 50%;
		/* background: #82d173; */
		/* mix-blend-mode: lighten; */
		transition: all 0.5s ease;
		transform-origin: center;
		transform: scale(0) rotate(0);
	
	}
	.backgr1:hover:after {
		border-radius: 0;
		transform: scale(1) rotate(180deg);
	}
	.backgr1:hover{
		box-shadow:0 0 0 transparent;
	}
	.backgr2:after {
		width: 70%;
		height: 90%;
		margin-top:10px;
		line-height: 50px;
		background: url('css/demo_img/search.png');
		background-repeat: no-repeat;
		background-size: contain;
		border-radius: 50%;
		/* background: #82d173; */
		/* mix-blend-mode: lighten; */
		transition: all 0.5s ease;
		transform-origin: center;
		transform: scale(0) rotate(0);
	}
	.backgr2:hover:after {
		border-radius: 0;
		transform: scale(1) rotate(180deg);
	}
	.backgr2:hover{
		box-shadow:0 0 0 transparent;
	}
	.gridd{
		display:grid;
		gap:1rem;
		grid-template-columns: 30% 30% 30%;
		grid-auto-row:100px;
		justify-content:center;
	}
	.btnn{
		border-radius:10px;
		/* font-size:0.8rem; */
		width:100%;
		height:100px;
		background-color:aliceblue;
		text-align:center;
		color:black; 
		width:100%; 
		box-shadow:3px 3px 5px #333;
		display:flex;
		align-items:center;
		position: relative;
	}
	.btnn:hover{
		box-shadow:0 0 0 transparent;
	}
	.btnn:after,.btnn:before{
		content: "";
		position: absolute;
		display: block;
		box-sizing: border-box;
		top: 0;
		left: 0;
	}
	.btnn1:after{
		width: 60%;
		height: 90%;
		margin-top:6px;
		line-height: 50px;
		background: url('css/demo_img/1on.png');
		background-repeat: no-repeat;
		background-size: contain;
		border-radius: 50%;
		transition: all 0.5s ease;
		transform-origin: center;
		transform: scale(0) rotate(0);
	}
	.btnn1:hover:after{
		border-radius: 0;
		transform: scale(1) rotate(180deg);
	}
	.btnn2:after{
		width: 65%;
		height: 90%;
		margin-top:6px;
		line-height: 50px;
		background: url('css/demo_img/2on.png');
		background-repeat: no-repeat;
		background-size: contain;
		border-radius: 50%;
		transition: all 0.5s ease;
		transform-origin: center;
		transform: scale(0) rotate(0);
	}
	.btnn2:hover:after{
		border-radius: 0;
		transform: scale(1) rotate(180deg);
	}
	.btnn3:after{
		width: 65%;
		height: 90%;
		margin-top:6px;
		line-height: 50px;
		background: url('css/demo_img/3on.png');
		background-repeat: no-repeat;
		background-size: contain;
		border-radius: 50%;
		transition: all 0.5s ease;
		transform-origin: center;
		transform: scale(0) rotate(0);
	}
	.btnn3:hover:after{
		border-radius: 0;
		transform: scale(1) rotate(180deg);
	}
	.btnn4:after{
		width: 65%;
		height: 90%;
		margin-top:6px;
		line-height: 50px;
		background: url('css/demo_img/4on.png');
		background-repeat: no-repeat;
		background-size: contain;
		border-radius: 50%;
		transition: all 0.5s ease;
		transform-origin: center;
		transform: scale(0) rotate(0);
	}
	.btnn4:hover:after{
		border-radius: 0;
		transform: scale(1) rotate(180deg);
	}
	.btnn5:after{
		width: 65%;
		height: 90%;
		margin-top:6px;
		line-height: 50px;
		background: url('css/demo_img/5on.png');
		background-repeat: no-repeat;
		background-size: contain;
		border-radius: 50%;
		transition: all 0.5s ease;
		transform-origin: center;
		transform: scale(0) rotate(0);
	}
	.btnn5:hover:after{
		border-radius: 0;
		transform: scale(1) rotate(180deg);
	}
	.btnn6:after{
		width: 65%;
		height: 90%;
		margin-top:6px;
		line-height: 50px;
		background: url('css/demo_img/6on.png');
		background-repeat: no-repeat;
		background-size: contain;
		border-radius: 50%;
		transition: all 0.5s ease;
		transform-origin: center;
		transform: scale(0) rotate(0);
	}
	.btnn6:hover:after{
		border-radius: 0;
		transform: scale(1) rotate(180deg);
	}
	.btnn7:after{
		width: 65%;
		height: 90%;
		margin-top:6px;
		line-height: 50px;
		background: url('css/demo_img/7on.png');
		background-repeat: no-repeat;
		background-size: contain;
		border-radius: 50%;
		transition: all 0.5s ease;
		transform-origin: center;
		transform: scale(0) rotate(0);
	}
	.btnn7:hover:after{
		border-radius: 0;
		transform: scale(1) rotate(180deg);
	}
	.btnn8:after{
		width: 65%;
		height: 90%;
		margin-top:6px;
		line-height: 50px;
		background: url('css/demo_img/8on.png');
		background-repeat: no-repeat;
		background-size: contain;
		border-radius: 50%;
		transition: all 0.5s ease;
		transform-origin: center;
		transform: scale(0) rotate(0);
	}
	.btnn8:hover:after{
		border-radius: 0;
		transform: scale(1) rotate(180deg);
	}
.marquee {
    top: 6em;
    position: relative;
    box-sizing: border-box;
    animation: marquee 15s linear infinite;
}

.marquee:hover {
    animation-play-state: paused;
}

/* Make it move! */
@keyframes marquee {
    0%   { top:  20em }
    100% { top: -20em }
}
.OAP_active{
	display: block;
}
.OAP_hidden{
	display: none;
}
</style>
<script type="text/javascript" language="javascript">
function register_now(){
    var method = "post"; // Set method to post by default if not specified.

    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", "uin_reg_form.php");

	var hiddenField = document.createElement("input");
	hiddenField.setAttribute("type", "hidden");
	hiddenField.setAttribute("name", "register");
	hiddenField.setAttribute("value", "testing");

	form.appendChild(hiddenField);
    document.body.appendChild(form);
    form.submit();	
}
function toggleOAP(val){
	console.log(val);
	if(val==2){
		console.log(val);
		document.getElementById("div_transaction_id").classList.remove("OAP_hidden");
		document.getElementById("div_dob").classList.remove("OAP_active");
		document.getElementById("div_transaction_id").classList.add("OAP_active");
		document.getElementById("div_dob").classList.add("OAP_hidden");
	}
	if(val==1){
		console.log(val);
		document.getElementById("div_transaction_id").classList.remove("OAP_active");
		document.getElementById("div_dob").classList.remove("OAP_hidden");
		document.getElementById("div_dob").classList.add("OAP_active");
		document.getElementById("div_transaction_id").classList.add("OAP_hidden");
	}
}


</script>


<div class="col-md-12 row">
	<div class="col-md-7">
		<h1 id="register" name="register" class="  submit blink_me bg-danger text-white mx-auto"  onclick="register_now()" value="Step 1. Pre-Registration For Fees Payment-2023" tabindex="100">Step 1. Pre-Registration For U.I.N.-2023</h1>
	</div>
</div>
<div class="container col-md-10 mx-auto p-5  " style="background-color:skyblue; border-radius:12px; ">
	<form method="POST" name="customerData" action="ccavRequestHandler.php">
		<table width="40%" height="100" border='1' align="center"><caption><font size="4" color="blue"><b>Integration Kit</b></font></caption></table>
			<table width="50%" height="100" border='1' align="center">
				<tr>
					<td>Parameter Name:</td><td>Parameter Value:</td>
				</tr>
				<tr>
					<td colspan="2"> Compulsory information</td>
				</tr>
				<tr>
					<td>TID	:</td><td><input type="text" name="tid" id="tid" readonly /></td>
				</tr>
				<tr>
					<td>Merchant Id	:</td><td><input type="text" name="merchant_id" value="2803639"/></td>
				</tr>
				<tr>
					<td>Order Id	:</td><td><input type="text" name="order_id" value="123654789"/></td>
				</tr>
				<tr>
					<td>Amount	:</td><td><input type="text" name="amount" value="10.00"/></td>
				</tr>
				<tr>
					<td>Currency	:</td><td><input type="text" name="currency" value="INR"/></td>
				</tr>
				<tr>
					<td>Redirect URL	:</td><td><input type="text" name="redirect_url" value="http://knipssexams.in/ccavResponseHandler.php"/></td>
				</tr>
			 	<tr>
			 		<td>Cancel URL	:</td><td><input type="text" name="cancel_url" value="http://knipssexams.in/ccavResponseHandler.php"/></td>
			 	</tr>
			 	<tr>
					<td>Language	:</td><td><input type="text" name="language" value="EN"/></td>
				</tr>
		     	<tr>
		     		<td colspan="2">Billing information(optional):</td>
		     	</tr>
		        <tr>
		        	<td>Billing Name	:</td><td><input type="text" name="billing_name" value="Charli"/></td>
		        </tr>
		        <tr>
		        	<td>Billing Address	:</td><td><input type="text" name="billing_address" value="Room no 1101, near Railway station Ambad"/></td>
		        </tr>
		        <tr>
		        	<td>Billing City	:</td><td><input type="text" name="billing_city" value="Indore"/></td>
		        </tr>
		        <tr>
		        	<td>Billing State	:</td><td><input type="text" name="billing_state" value="MH"/></td>
		        </tr>
		        <tr>
		        	<td>Billing Zip	:</td><td><input type="text" name="billing_zip" value="425001"/></td>
		        </tr>
		        <tr>
		        	<td>Billing Country	:</td><td><input type="text" name="billing_country" value="India"/></td>
		        </tr>
		        <tr>
		        	<td>Billing Tel	:</td><td><input type="text" name="billing_tel" value="9999999999"/></td>
		        </tr>
		        <tr>
		        	<td>Billing Email	:</td><td><input type="text" name="billing_email" value="test@test.com"/></td>
		        </tr>
		        <tr>
		        	<td colspan="2">Shipping information(optional)</td>
		        </tr>
		        <tr>
		        	<td>Shipping Name	:</td><td><input type="text" name="delivery_name" value="Chaplin"/></td>
		        </tr>
		        <tr>
		        	<td>Shipping Address	:</td><td><input type="text" name="delivery_address" value="room no.701 near bus stand"/></td>
		        </tr>
		        <tr>
		        	<td>shipping City	:</td><td><input type="text" name="delivery_city" value="Hyderabad"/></td>
		        </tr>
		        <tr>
		        	<td>shipping State	:</td><td><input type="text" name="delivery_state" value="Andhra"/></td>
		        </tr>
		        <tr>
		        	<td>shipping Zip	:</td><td><input type="text" name="delivery_zip" value="425001"/></td>
		        </tr>
		        <tr>
		        	<td>shipping Country	:</td><td><input type="text" name="delivery_country" value="India"/></td>
		        </tr>
		        <tr>
		        	<td>Shipping Tel	:</td><td><input type="text" name="delivery_tel" value="5555555555"/></td>
		        </tr>
		        <tr>
		        	<td>Merchant Param1	:</td><td><input type="text" name="merchant_param1" value="additional Info."/></td>
		        </tr>
		        <tr>
		        	<td>Merchant Param2	:</td><td><input type="text" name="merchant_param2" value="additional Info."/></td>
		        </tr>
				<tr>
					<td>Merchant Param3	:</td><td><input type="text" name="merchant_param3" value="additional Info."/></td>
				</tr>
				<tr>
					<td>Merchant Param4	:</td><td><input type="text" name="merchant_param4" value="additional Info."/></td>
				</tr>
				<tr>
					<td>Merchant Param5	:</td><td><input type="text" name="merchant_param5" value="additional Info."/></td>
				</tr>
				 
				 <tr>
		     		<td colspan="2">Payment information:</td>
		     	</tr>
				 <tr> <td> Payment Option: </td> 
		         	  <td> 
		         	  		<input class="payOption" type="radio" name="payment_option" value="OPTCRDC">Credit Card
		         	  		<input class="payOption" type="radio" name="payment_option" value="OPTDBCRD">Debit Card  <br/>
		         	  		<input class="payOption" type="radio" name="payment_option" value="OPTNBK">Net Banking 
		         	  		<input class="payOption" type="radio" name="payment_option" value="OPTCASHC">Cash Card <br/>
		         	  		<input class="payOption" type="radio" name="payment_option" value="OPTMOBP">Mobile Payments
		         	  		<input class="payOption" type="radio" name="payment_option" value="OPTEMI">EMI
						<input class="payOption" type="radio" name="payment_option" value="OPTWLT">Wallet
		         	   </td>
		         </tr>
		         
		         <!-- EMI section start -->
		         
		         <tr >
		         <td  colspan="2">
		          <div id="emi_div" style="display: none">
			         <table border="1" width="100%">
			         <tr> <td colspan="2">EMI Section </td></tr>
			         <tr> <td> Emi plan id: </td>
			            <td><input readonly="readonly" type="text" id="emi_plan_id"  name="emi_plan_id" value=""/> </td>
			         </tr>
			         <tr> <td> Emi tenure id: </td>
			            <td><input readonly="readonly" type="text" id="emi_tenure_id" name="emi_tenure_id" value=""/>  </td>
			         </tr>
			         <tr><td>Pay Through</td>
				         <td>
					         <select name="emi_banks"  id="emi_banks">
					         </select>
				         </td>
			        </tr>
			        <tr><td colspan="2">
				         <div id="emi_duration" class="span12">
		                	<span class="span12 content-text emiDetails">EMI Duration</span>
		                    <table id="emi_tbl" cellpadding="0" cellspacing="0" border="1" >
							</table> 
		                </div>
				        </td>
			        </tr>
			        <tr>
			        	 <td id="processing_fee" colspan="2">
			        	</td>
			        </tr>
			        </table>
		        </div>
		        </td>
		        </tr>
		        <!-- EMI section end -->
		         
		         
		         <tr> <td> Card Type: </td>
		             <td><input type="text" id="card_type" name="card_type" value="" readonly="readonly"/></td>
		         </tr>
		        
		        <tr> <td> Card Name: </td>
		             <td> <select name="card_name" id="card_name"> <option value="">Select Card Name</option> </select> </td>
		        </tr>
		        
		        <tr> <td> Data Accepted At </td>
		             <td><input type="text" id="data_accept" name="data_accept" readonly="readonly"/></td>
		        </tr>
		         
		         <tr> <td> Card Number: </td>
		            <td> <input type="text" id="card_number" name="card_number" value=""/>e.g. 4111111111111111 </td>
		         </tr>
		          <tr> <td> Expiry Month: </td>
		               <td> <input type="text" name="expiry_month" value=""/>e.g. 07 </td>
		         </tr>
		          <tr> <td> Expiry Year: </td>
		          	   <td> <input type="text" name="expiry_year" value=""/>e.g. 2027</td>
		         </tr>
		          <tr> <td> CVV Number:</td>
		               <td> <input type="text" name="cvv_number" value=""/>e.g. 328</td>
		         </tr>
		         <tr> <td> Issuing Bank:</td>
		            <td><input type="text" name="issuing_bank" value=""/>e.g. State Bank Of India</td>
		         </tr>
			 <tr> 
				<td> Mobile Number:</td>
		            	<td><input type="text" name="mobile_number" value=""/>e.g. 9770707070</td>
		         </tr>
			<tr> 
				<td> MMID:</td>
		            	<td><input type="text" name="mm_id" value=""/>e.g. 1234567</td>
		         </tr>
			<tr> 
				<td> OTP:</td>
		            	<td><input type="text" name="otp" value=""/>e.g. 123456</td>
		         </tr>
			 <tr> 
				<td> Promotions:</td>
		            	<td> <select name="promo_code" id="promo_code"> <option value="">All Promotions &amp; Offers</option> </select> </td>
		         </tr>
				 
		        <tr>
		        	<td></td><td><INPUT TYPE="submit" value="CheckOut"></td>
		        </tr>
	      	</table>
	      </form>
	
</div>

<?php 
		break;
	}
	case 2:{
?>

<script>
function register_now1(){
    var method = "post"; // Set method to post by default if not specified.

    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", "uin_reg_form.php");

	var hiddenField = document.createElement("input");
	hiddenField.setAttribute("type", "hidden");
	hiddenField.setAttribute("name", "register1");
	hiddenField.setAttribute("value", "testing");

	form.appendChild(hiddenField);
    document.body.appendChild(form);
    form.submit();	
}</script>
<div id="container" width="70%">
	<div class="card">
		<div class="card-body col-md-11  " style="background-color:#E5E4E2;">
			
			<div class="row ">
				
				<section class="content-header">
					<h1 style="color: #000!important;">Registration 2023 <span>| </span>Unique Identification Number (UIN) </h1>
								 <br>
				</section>
				
				<form action="<?php echo $_SERVER['PHP_SELF'] ?>" class="wufoo leftLabel page1" name="admission_newadmission" enctype="multipart/form-data" method="post" onSubmit="" >
				<?php echo $msg; ?>	
					<div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                               <h3 style="font-size: 20px; font-weight: 600;text-align:center"> कमला नेहरू भौतिक एवं सामाजिक विज्ञान संस्थान, सुल्तानपुर, उत्तर प्रदेश</h3>
                          <h3 style="font-size: 16px; font-weight: 600;line-height:30px"> राष्ट्रीय शिक्षा नीति-2020 : स्नातक स्तर पर कला संकाय/ विज्ञान संकाय/ वाणिज्य संकाय के अन्तर्गत संचालित विषयों तथा परास्नातक स्तर पर विषय आधारित पाठ्यक्रमों में प्रवेश के लिए विद्यार्थी की पात्रता निम्रवत है –</h3>
                           
                            </div></div></div>
							<div class="row">
                    <div class="col-md-11 col-sm-12 col-xs-12">
                        <div class="form-group">

                      
                           <table style="width:100%;font-size:16px" class="table table-striped table-hover rounded">
                               
                               <thead><tr class="bg-primary text-white"><td rowspan="2" colspan="2"><strong> 1- प्रवेश का संकाय/</strong></td><td colspan="2" style="text-align:center"><strong>प्रवेश हेतु विद्यार्थी की पात्रता</strong></td></tr>
                                  <tr class="bg-primary text-white"><td style="text-align:center"><strong>विषय वर्ग</strong></td><td style="text-align:center"><strong>पात्रता</strong></td></tr>

                               </thead>

                                    <tbody>
                                        <tr><td>1</td><td>विज्ञान संकाय (स्नातक)</td><td>इंटरमीडिएट विज्ञान वर्ग</td><td>इंटरमीडिएट उत्तीर्ण</td></tr>
                                         <tr><td>2</td><td>कला संकाय (स्नातक)</td><td>इंटरमीडिएट कला वर्ग या विज्ञान वर्ग या वाणिज्य वर्ग कृषि वर्ग या व्यवसायिक वर्ग</td><td>इंटरमीडिएट उत्तीर्ण</td></tr>
											<tr><td>3</td><td>वाणिज्य संकाय (स्नातक)</td><td>इंटरमीडिएट वाणिज्य वर्ग या कला वर्ग या विज्ञान वर्ग कृषि वर्ग अथवा व्यवसायिक वर्ग</td><td>इंटरमीडिएट उत्तीर्ण</td></tr>
                                          <tr><td>4</td><td>एम०ए०</td><td>बीए तृतीय वर्ष के विषय/(स्नातक)के विषय</td><td>बी०ए०/(स्नातक)उत्तीर्ण</td></tr>

                                             <tr><td>5</td><td>एम.एस.सी</td><td>बीएससी तृतीय वर्ष के विषय</td><td>बी०एस-सी उत्तीर्ण</td></tr>
                                            <tr><td>6</td><td>एम०काम०</td><td>बी०काम०</td><td>बी०काम० उत्तीर्ण</td></tr>
                                    </tbody>
                                   </table>

                        </div>
                    </div>
                     
                     
                     
                <div class="col-md-7">
					<h1 id="register1" name="register1" class="  submit blink_me bg-danger text-white mx-auto"  onclick="register_now1()" value="testing" tabindex="100">
Step 1. Pre-Registration For U.I.N.-2023
</h1>
				</div>
					
				</form>
				
			</div>
		</div>
	</div>
</div>  
	
<?php

		break;
	}
	case 3:{
?>
<div id="container" width="70%">
	<div class="card">
		<div class="card-body col-md-11  " style="background-color:#E5E4E2;">
			
			<div class="row ">
				
				<section class="content-header">
					<h1 style="color: #000!important;">Registration <?php echo date('Y') ?> <span>| </span>Unique Identification Number (UIN) </h1>
								 <br>
				</section>
				
				<form action="<?php echo $_SERVER['PHP_SELF'] ?>" class="wufoo leftLabel page1" name="admission_newadmission" enctype="multipart/form-data" method="post" onSubmit="" >
				<?php echo $msg; ?>	
				<h2 style="color: #3D3E3E!important;">Step 1. Pre-Registration For U.I.N.-2023</h2><br>
	<div class=" card card-body col-md-11 my-auto mx-auto" style="border-top-color: #d2d6de; background-color:whitesmoke;" >
					
						<div class="row mt-1">							
							<div class="col-md-6">							
								<label>Candidate Name</label>
								<input type="text" name="candidate_name" id="candidate_name" class="form-control " value="<?php if(isset($_POST['candidate_name'])){echo $_POST['candidate_name'];}?>" tabindex="<?php echo $tabindex++;?>" required />
							</div>
							<div class="col-md-6">							
								<label>Father&#39;s Name</label>
								<input type="text" name="father_name" id="father_name" class="form-control " value="<?php if(isset($_POST['candidate_name'])){echo $_POST['father_name'];}?>" tabindex="<?php echo $tabindex++;?>" required />
							</div>
						</div>
						<div class="row mt-1">
							<div class="col-md-6">							
								<label>Mother&#39;s Name</label>
								<input type="text" name="mother_name" id="mother_name" class="form-control " value="<?php if(isset($_POST['candidate_name'])){echo $_POST['mother_name'];}?>" tabindex="<?php echo $tabindex++;?>" required />
							</div>
							<div class="col-md-6">							
								<label>Date of Birth</label>
								<script>DateInput('dob', false, 'YYYY-MM-DD', '<?php if(isset($_POST['dob'])){echo $_POST['dob'];}else{echo date("Y-m-d");}?>', <?php echo $tabindex++; $tabindex += 3; ?>)</script>
							</div>
							
						</div>
						<div class="row mt-1">
							<div class="col-md-6">							
								<label>Mobile</label>
								<input type="text" name="mobile" id="mobile" class="form-control " value="<?php if(isset($_POST['candidate_name'])){echo $_POST['mobile'];}?>" tabindex="<?php echo $tabindex++;?>" pattern=[0-9]{10} minlength="10" maxlength="10"  required />
							</div>
							<div class="col-md-6">							
								<label>E-Mail</label>
								<input type="email" name="e_mail" id="e_mail" class="form-control " value="<?php if(isset($_POST['candidate_name'])){echo $_POST['e_mail'];}?>" tabindex="<?php echo $tabindex++;?>" required />
							</div>
						</div>
						<div class="row mt-1">							
							<div class="col-md-6">							
								<label>Course Type</label>
								<select name="course_type" id="course_type" value="<?php echo $data['course_type']?>" class="form-control" required>
										<option disabled <?php echo isset($_GET['edit'])? "":' selected = "selected" '?>>---Select Your Course Type---</option>
										<?php 
											$sql  = 'select * from mst_course_type';
											$dept_list = execute_query( $sql);
											if($dept_list){
												while($list = mysqli_fetch_assoc($dept_list)){
													echo '<option  value = "'.$list['sno'].'" '.(isset($_GET['edit']) && $data['course_type'] == $list['sno'] ? ' selected = "selected" ':"").'>'.$list['course_type'].'</option>';
												}
											}
										?>
								</select>
							</div>
							<div class="col-md-6">							
								<label>Course Applying for</label>
								<select name="course_appled_for" id="course_appled_for" value="" class="form-control" required>
									
								</select>												
						</div>
						<div class="row mt-1">
							<div class="col-md-6">							
								<label>Category</label>
								<select name="category" id="category" class="form-control" tabindex="<?php echo $tabindex++;?>" required>
									<option value="GEN" <?php if(isset($_POST['category']) && $_POST['category']=="GEN"){ echo 'selected ';}?>>General</option>
									<option value="OBC" <?php if(isset($_POST['category']) && $_POST['category']=="OBC"){ echo 'selected ';}?>>OBC</option>
									<option value="SC" <?php if(isset($_POST['category']) && $_POST['category']=="SC"){ echo 'selected ';}?>>SC</option>
									<option value="ST" <?php if(isset($_POST['category']) && $_POST['category']=="ST"){ echo 'selected ';}?>>ST</option>
								</select>
							</div>
							<div class="col-md-6">							
								<label>Aadhar</label>
								<input type="text" name="aadhar" id="aadhar" class="form-control " value="<?php if(isset($_POST['candidate_name'])){echo $_POST['aadhar'];}?>" tabindex="<?php echo $tabindex++;?>"  pattern=[0-9]{12} minlength="12" maxlength="12" required />
							</div>
						</div>
						<div class="row mt-1">
							<div class="col-md-4">							
								<label>Fees of Unique Identification Number</label>
								<input type="number" name="fee" id="fee" class="form-control" value="100" style="pointer-events:none; " readonly tabindex="<?php echo $tabindex++;?>" required />
								&nbsp;
								
							</div>
							
							<div class="col-md-8"></div>
						</div>
						<div class="row mt-1">
							<div class="col-md-2">
							<button id="pre_registration_form" name="pre_registration_form" class=" btn btn-danger" type="submit" value="" onclick="confirm('Dear Applicant, please ensure that all information filled by you in this form is correct and complete.If any information is found incorrect or incomplete then you will not able to edit your details in future with this current registration.?');">Continue</button>
							</div>
						</div>
						
					</div>
					
				</form>
				
			</div>
		</div>
	</div>
</div>
<script>

	$(document).ready(function(){
		$("#course_type").change(function(){
			let selected_value = $("#course_type").val();
			//console.log(selected_value);

			$.ajax({
    			url: 'ajax_course_applied_for.php',
    			method: 'GET',
				data : 'selected_value= '+ selected_value,
    			success: function(data){
					$("#course_appled_for").html(data);
    			}
    		});
		 })
	})
</script>
<?php
		break;
	}
		
	case 4:{
		
?>
<div id="container" width="70%">
	<div class="card">
		<div class="card-body col-md-11  " style="background-color:#E5E4E2;">
			<div class="row ">
				<section class="content-header">
					<h1 style="color: #000!important;">Registration 2023 <span>| </span>Unique Identification Number (UIN) </h1>
									<br>
				</section>
				<section class="content-header" style="margin-top: -25px">
					<!-- <h4 style="font-size: 20px; font-weight: 600; color:green;">Your form has been successfully submitted.</h4> -->
					<h5 style="font-size: 15px; font-weight: 600; color:red;">Please fill all mandatory field</h5>
				</section>
				<form action="" class="wufoo leftLabel page1" name="admission_newadmission" enctype="multipart/form-data" method="post" onSubmit="" >	
					<?php   
						$sql = execute_query('select * from register_users where user_name = "'.$reg_no.'"',dbconnect());
						if($sql){
							$res = mysqli_fetch_assoc($sql); 
							//print_r($res);
							$res1= mysqli_fetch_assoc(execute_query('select * from new_student_info where sno= '.$res['sno'],dbconnect()));
							$course_name = mysqli_fetch_assoc(execute_query('select * from mst_course where sno = '.$res1['course_applying_for'],dbconnect()))['course_name'];
							

						}							
					?>
					<div class=" card card-body col-md-11 my-auto mx-auto" style="background-color:whitesmoke;">
						<div class="row mt-1">	
							<div class="col md-4">
								<h5 class="row d-flex"><strong>Registration No. :</strong></h5>
							</div>		
							<div class="col md-4 h5"><?php echo $reg_no ?></div>		
							<div class="col md-4"></div>		
						</div>
						<div class="row mt-1">	
							<div class="col md-4">
								<h5 class="row d-flex"><strong>Course Applied For :</strong></h5>
							</div>		
							<div class="col md-4 h5"><?php echo $course_name?></div>		
							<div class="col md-4"></div>		
						</div>
						<div class="row mt-1">	
							<div class="col md-4">
								<h5 class="row d-flex"><strong>Applicant's Name :</strong></h5>
							</div>		
							<div class="col md-4 h5"><?php echo $res1['candidate_name']?></div>		
							<div class="col md-4 "></div>		
						</div>
						<div class="row mt-1">	
							<div class="col md-4">
								<h5 class="row d-flex"><strong>Father Name :</strong></h5>
							</div>		
							<div class="col md-4 h5"><?php echo $res1['father_name']?></div>		
							<div class="col md-4 "></div>		
						</div>
						<div class="row mt-1">	
							<div class="col md-4">
								<h5 class="row d-flex"><strong>Mobile No :</strong></h5>
							</div>		
							<div class="col md-4 h5"><?php echo $res1['mobile']?></div>		
							<div class="col md-4 "></div>		
						</div>
						<div class="row mt-1">	
							<div class="col md-4">
								<h5 class="row d-flex"><strong>Email ID :</strong></h5>
							</div>		
							<div class="col md-4 h5"><?php echo $res1['email']?></div>		
							<div class="col md-4 "></div>		
						</div>
						<div class="row mt-1">	
							<div class="col md-4">
								<h5 class="row d-flex"><strong>Fees For Unique Identification Number :</strong></h5>
							</div>		
							<div class="col md-4 h5"><?php echo $res1['fee']?></div>		
							<div class="col md-4 "></div>		
						</div>
						<div class="row mt-1">
							<p style="color:red">
								NOTE: DEAR APPLICANT, PLEASE BE PATIENT AS THE FEE PAYMENT MAY TAKE FEW MINUTES OF YOUR TIME. PLEASE DON'T DISCONNECT THE SESSION OR CLOSE THE PROCESSING WINDOW.
							</p>
						</div>

					</div>
				</form>
			</div>
			<div class="row mt-1">
				<div class="col-md-2">
				<a href="<?php echo 'admission_form.php?id='.$res['sno'] ?>" class=" btn btn-danger" onclick="alert('Dear Applicant, please note your Registration No. <?php echo $reg_no ?>. Bank Transaction ID-17662194010  for any future communication');">Make Payment</a>
				
				</div>
			</div>
		</div>
	</div>
</div> 

<?php 
		break;
	}
}
	page_footer();
	ob_end_flush();
?>

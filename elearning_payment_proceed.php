<?php
ob_start();
date_default_timezone_set('Asia/Calcutta');
session_cache_limiter('nocache');
session_start();
include("settings.php");

page_header();
$msg = '';
?>
<?php 

if(isset($_POST['submit_new']) && $_POST['submit_new'] != ''){
	
		$sql = 'insert into elearning_reg_student_info (`candidate_name`, `father_name`, `mother_name`, `dob`, `aadhar`, `email`, `mobile`,`course_name`, `category`, `religion`, `gender`, `w_number`, `parent_number`, `domicile`, `mother_tongue`, `blood_group`, `photo`, `signature`, `p_address`, `p_post`, `p_tehsil`, `p_thana`, `p_district`, `p_state`, `p_pin`, `c_address`, `c_post`, `c_tehsil`, `c_thana`, `c_district`, `c_state`, `c_pin`, `created_by`, `creation_time`) values("'.
		$_POST['candidate_name'].'", "'.
		$_POST['father_name'].'", "'.
		$_POST['mother_name'].'", "'.
		$_POST['dob'].'", "'.
		$_POST['aadhar'].'", "'.
		$_POST['email'].'", "'.
		$_POST['mobile'].'", "'.
		$_POST['course_name'].'", "'.
		$_POST['category'].'", "'.
		$_POST['religion'].'", "'.
		$_POST['gender'].'", "'.
		$_POST['w_number'].'", "'.
		$_POST['parent_number'].'", "'.
		$_POST['domicile'].'", "'.
		$_POST['mother_tongue'].'", "'.
		$_POST['blood_group'].'", "'.
		$_FILES['photo']['name'].'", "'.
		$_FILES['signature']['name'].'", "'.
		$_POST['p_address'].'", "'.
		$_POST['p_post'].'", "'.
		$_POST['p_tehsil'].'", "'.
		$_POST['p_thana'].'", "'.
		$_POST['p_district'].'", "'.
		$_POST['p_state'].'", "'.
		$_POST['p_pin'].'", "'.
		$_POST['c_address'].'", "'.
		$_POST['c_post'].'", "'.
		$_POST['c_tehsil'].'", "'.
		$_POST['c_thana'].'", "'.
		$_POST['c_district'].'", "'.
		$_POST['c_state'].'", "'.
		$_POST['c_pin'].'", "'.
		$_SESSION['username'].'", "'.
		date("Y-m-d H:i:s").
		'")';
		
		execute_query($sql);
		if(mysqli_errno($db)){
			$msg = '<li>Insertion Failed</li>' ;
		}
		else{
			$msg = '<li>Data Inserted</li>' ;
			$stu_id = mysqli_insert_id($db);
		}
		
// IMAGE UPLOAD 
		$photoname=$_FILES['photo']['name'];
		$signaturename=$_FILES['signature']['name'];
		
		$photo_upload="e_learning/photo/".$photoname;
		$signature_upload="e_learning/signature/".$signaturename;
		
		
		$res2=move_uploaded_file($_FILES['photo']['tmp_name'], $photo_upload);
		$res3=move_uploaded_file($_FILES['signature']['tmp_name'], $signature_upload);
		
		if(isset($sql) && isset($res2) && isset($res3)){
			// echo "DONE";
		}
}
if(isset($_POST['submit']) && $_POST['submit'] != ''){
	
		$sql = 'insert into elearning_reg_student_info (`candidate_name`, `father_name`, `mother_name`, `dob`, `aadhar`, `email`, `mobile`, `category`, `religion`, `gender`, `w_number`, `parent_number`, `domicile`, `mother_tongue`, `blood_group`, `p_address`, `p_post`, `p_tehsil`, `p_thana`, `p_district`, `p_state`, `p_pin`, `c_address`, `c_post`, `c_tehsil`, `c_thana`, `c_district`, `c_state`, `c_pin`, `creation_time`) values("'.
		$_POST['candidate_name'].'", "'.
		$_POST['father_name'].'", "'.
		$_POST['mother_name'].'", "'.
		$_POST['dob'].'", "'.
		$_POST['aadhar'].'", "'.
		$_POST['email'].'", "'.
		$_POST['mobile'].'", "'.
		//$_POST['course_name'].'", "'.
		$_POST['category'].'", "'.
		$_POST['religion'].'", "'.
		$_POST['gender'].'", "'.
		$_POST['w_number'].'", "'.
		$_POST['parent_number'].'", "'.
		$_POST['domicile'].'", "'.
		$_POST['mother_tongue'].'", "'.
		$_POST['blood_group'].'", "'.
		//$_POST['photo'].'", "'.
		//$_POST['signature'].'", "'.
		$_POST['p_address'].'", "'.
		$_POST['p_post'].'", "'.
		$_POST['p_tehsil'].'", "'.
		$_POST['p_thana'].'", "'.
		$_POST['p_district'].'", "'.
		$_POST['p_state'].'", "'.
		$_POST['p_pin'].'", "'.
		$_POST['c_address'].'", "'.
		$_POST['c_post'].'", "'.
		$_POST['c_tehsil'].'", "'.
		$_POST['c_thana'].'", "'.
		$_POST['c_district'].'", "'.
		$_POST['c_state'].'", "'.
		$_POST['c_pin'].'", "'.
		//$_SESSION['username'].'", "'.
		date("Y-m-d H:i:s").
		'")';
		
		execute_query($sql);
		if(mysqli_errno($db)){
			$msg .= '<li>Insertion Failed</li>' ;
		}
		else{
			$msg .= '<li>Data Inserted</li>' ;
			$stu_id = mysqli_insert_id($db);
		}
}


?>

	<style>
				.blinking-css{
	font-size: 20px;
	font-weight:bolder;
	color:aliceblue;
	animation: blink 0.7s linear infinite;
	}
	@keyframes blink{
	0%{opacity: 0;}
	50%{opacity: .5;}
	100%{opacity: 1;}
	}
	.bolding{
		font-weight:bolder;
	}
			</style>
<div id="container" width="70%">
	<div class="card">
		<div class="card-body col-md-11  " style="background-color:#E5E4E2;">
			<div class="row ">
				<section class="content-header">
					<h1 style="color: #000!important;">E-LEARNING FORM 2024 </h1>
									<br>
				</section>
<?php
	$sql2 = 'SELECT * FROM elearning_reg_student_info WHERE sno = "'.$stu_id.'"';
	$result2 = mysqli_query($db,$sql2);
	
	if(mysqli_num_rows($result2)>0){
		while($row=mysqli_fetch_assoc($result2)){
?>
				
				<form action="exam_ccavRequestHandler.php" class="wufoo leftLabel page1" name="admission_newadmission" enctype="multipart/form-data" method="post" onSubmit="" >	
					
					<div class=" card card-body col-md-11 my-auto mx-auto" style="background-color:whitesmoke;">
						<div class="row mt-1">	
							<div class="col md-4">
								<h5 class="row d-flex"><strong>Course Name :</strong></h5>
							</div>		
							<div class="col md-4 h5"><?php echo $row['course_name']?></div>		
							<div class="col md-4 "></div>		
						</div>
						<div class="row mt-1">
							<div class="col md-4">
								<h5 class="row d-flex"><strong>Applicant's Name :</strong></h5>
							</div>		
							<div class="col md-4 h5"><?php echo $row['candidate_name']?></div>		
							<div class="col md-4 "></div>		
						</div>
						<div class="row mt-1">	
							<div class="col md-4">
								<h5 class="row d-flex"><strong>Father Name :</strong></h5>
							</div>		
							<div class="col md-4 h5"><?php echo $row['father_name']?></div>		
							<div class="col md-4 "></div>		
						</div>
						<div class="row mt-1">	
							<div class="col md-4">
								<h5 class="row d-flex"><strong>Mobile No :</strong></h5>
							</div>		
							<div class="col md-4 h5"><?php echo $row['mobile']?></div>		
							<div class="col md-4 "></div>		
						</div>
						<div class="row mt-1">	
							<div class="col md-4">
								<h5 class="row d-flex"><strong>Email ID :</strong></h5>
							</div>		
							<div class="col md-4 h5"><?php echo $row['email']?></div>		
							<div class="col md-4 "></div>		
						</div>
						
						
					</div>
					<div class="row">
<?php
		}
	}
?>
			
<?php
$exit=0;
while($exit==0){
	$epin = randomstring();
	$sql = 'select * from online_payment_exams where tid="'.$epin.'"';
	$result = execute_query($sql);
	if(mysqli_num_rows($result) == 0){
		$exit=1;
	}
}
?>
<span style="display: none;">
TID	:<input type="hidden" name="tid" id="tid" readonly value="" />
Merchant Id	:<input type="hidden" name="merchant_id" value="2803639"/>
Order Id	:<input type="hidden" name="order_id" value=""/>
Amount	:<input type="hidden" name="amount" value=""/>
Currency	:<input type="hidden" name="currency" value="INR"/>
Redirect URL	:<input type="hidden" name="redirect_url" value="https://knipssexams.in/exam_ccavResponseHandler.php"/>
Cancel URL	:<input type="hidden" name="cancel_url" value="https://knipssexams.in/exam_ccavResponseHandler.php"/>
Language	:<input type="hidden" name="language" value="EN"/>
Billing Name	:<input type="hidden" name="billing_name" value=""/>
Billing Address	:<input type="hidden" name="billing_address" value=""/>
Billing City	:<input type="hidden" name="billing_city" value=">"/>
Billing State	:<input type="hidden" name="billing_state" value=""/>
Billing Zip	:<input type="hidden" name="billing_zip" value=""/>
Billing Country	:<input type="hidden" name="billing_country" value="India"/>
Billing Tel	:<input type="hidden" name="billing_tel" value=""/>
Billing Email	:<input type="hidden" name="billing_email" value=""/>
Merchant Param1	:<input type="hidden" name="merchant_param1" value=""/>
Merchant Param2	:<input type="hidden" name="merchant_param2" value=""/>
Merchant Param3	:<input type="hidden" name="merchant_param3" value=""/>
Student ID	:<input type="hidden" name="student_id" value=""/>

</span>
						
					</div>
					<div class="row">
						<div class="row mt-1">
							<p style="color:red">
								NOTE: DEAR APPLICANT, PLEASE BE PATIENT AS THE FEE PAYMENT MAY TAKE FEW MINUTES OF YOUR TIME. PLEASE DON'T DISCONNECT THE SESSION OR CLOSE THE PROCESSING WINDOW.
							</p>
						</div>

					</div>
				
			</div>
			<div class="row mt-1">
				<div class="col-md-3">
					<div class="text-center" style="font-size:25px; font-weight:500;">PAYABLE FEES ₹600/</div>
					<div class="text-center"><button type="submit" class="btn btn-danger">Make Payment</button></div>
				
				</div>
			</div>
			</form>
		</div>
	</div>
</div> 

<?php 

	page_footer();
	ob_end_flush();
?>

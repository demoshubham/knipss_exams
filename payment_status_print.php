<?php
include("settings.php");

if(isset($_GET['id']) && $_GET['id']!=''){
    $sql = 'select * from register_users where sno = '.$_GET['id'];
	$result = mysqli_query($db, $sql);
	//print_r($result);
	$details = mysqli_fetch_assoc($result);
}
page_header();
?>
<div id="container" width="70%">
	<form action="ccavRequestHandler.php" class="wufoo leftLabel page1" name="admission_newadmission" enctype="multipart/form-data" method="post" onSubmit="" >	
	<div class="card">
		<div class="card-body col-md-11  " style="background-color:#E5E4E2;">
			<div class="row ">
				<section class="content-header">
					<h1 style="color: #000!important;">Registration 2023 <span>| </span>Unique Identification Number (UIN) </h1>
									<br>
				</section>
				<section class="content-header" style="margin-top: -25px">
					<!-- <h4 style="font-size: 20px; font-weight: 600; color:green;">Your form has been successfully submitted.</h4> -->
					<h5 style="font-size: 15px; font-weight: 600; color:red;"></h5>
				</section>
				<?php   
					// $sql_user_app = 'select * from register_users where sno = "'.$details['sno'].'"';
						// $result_user_app = execute_query($sql_user_app);
						// if(mysqli_num_rows($result_user_app)!=0){
							// $row_user_app = mysqli_fetch_assoc($result_user_app);
							// $user_tran = $row_user_app['transaction_no'];
						// }
						// else{
							// $user_tran = '';
						// }						
				?>
				<div class=" card card-body col-md-11 my-auto mx-auto" style="background-color:whitesmoke;">
					<div class="row mt-1">	
						<div class="col md-4">
							<h5 class="row d-flex"><strong>Registration No. :</strong></h5>
						</div>		
						<div class="col md-4 h5"><?php echo $details['user_name'] ?></div>		
						<div class="col md-4"></div>		
					</div>
					
					<div class="row mt-1">	
						<div class="col md-4">
							<h5 class="row d-flex"><strong>Transaction No :</strong></h5>
						</div>		
						<div class="col md-4 h5"><?php echo $details['transaction_no'] ?></div>		
						<div class="col md-4"></div>		
					</div>
					<div class="row mt-1">	
						<div class="col md-4">
							<h5 class="row d-flex"><strong>Payment Status :</strong></h5>
						</div>		
						<div class="col md-4 h5"><?php echo $details['payment_status'] ?></div>		
						<div class="col md-4"></div>		
					</div>
					<div class="row mt-1">	
						<div class="col md-4">
							<h5 class="row d-flex"><strong>Applicant's Name :</strong></h5>
						</div>		
						<div class="col md-4 h5"><?php echo $details['full_name'] ?></div>		
						<div class="col md-4 "></div>		
					</div>
					<div class="row mt-1">	
						<div class="col md-4">
							<h5 class="row d-flex"><strong>Father Name :</strong></h5>
						</div>		
						<div class="col md-4 h5"><?php echo $details['father_name'] ?></div>		
						<div class="col md-4 "></div>		
					</div>
					<div class="row mt-1">	
						<div class="col md-4">
							<h5 class="row d-flex"><strong>Mobile No :</strong></h5>
						</div>		
						<div class="col md-4 h5"><?php echo $details['mobile'] ?></div>		
						<div class="col md-4 "></div>		
					</div>
					<div class="row mt-1">	
						<div class="col md-4">
							<h5 class="row d-flex"><strong>Email ID :</strong></h5>
						</div>		
						<div class="col md-4 h5"><?php echo $details['e_mail'] ?></div>		
						<div class="col md-4 "></div>		
					</div>
				</div>
			</div>
		</div>
	</div>
	</form>
</div>
<?php
page_footer();
?>			
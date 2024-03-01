<?php
set_time_limit(0);
//session_cache_limiter('nocache');
//session_start();
include("settings.php");
 page_header();
$response=1;
$msg='';
?>
<?php
if(isset($_POST['submit'])){
	$reg_no = (isset($_POST['application_no']) && ($_POST['application_no']) != '') ? $_POST['application_no'] : '';
	$dob = (isset($_POST['dob']) && ($_POST['dob']) != '') ? $_POST['dob'] : '';
	$sql = 'select sno from register_users where user_name = "'.$reg_no.'" && date_of_birth = "'.$dob.'" ';
	//echo $sql;
	$result = mysqli_query($db, $sql);
	//print_r($result);
	$row = mysqli_fetch_array($result);
	
	$sql1 = 'select uin_no from register_users where user_name = "'.$reg_no.'" && date_of_birth = "'.$dob.'" ';
	$result1 = mysqli_query($db, $sql1);
	$row1 = mysqli_fetch_assoc($result1);
	//print_r($row1);
  if($row && $row1['uin_no']!=''){
	header('location: uin_print.php?id='.$row['sno']);
  }
  // else if($row1!=''){
	// echo '<script>alert("Form Not Finel Submited")</script>';
  // }
  else{
	echo '<script>alert("Unvalid application number or dob / Form Not Finel Submited")</script>';
  }
}
?>
<html>
	<body id="public">
		<div id="container" width="70%">
			<div class="card">
				<div class="card-body col-md-11  " style="background-color:#E5E4E2;">
					<div class="row ">
						<section class="content-header">
							<h1 style="color: #000!important;">Registration 2023 <span>| </span>Unique Identification Number (UIN) </h1>
										 <br>
						</section>
						<section class="content-header" style="margin-top: -25px">
							<h3 style="font-size: 20px; font-weight: 600;">Print E-Receipt </h3>
						</section>
						<form action="" class="wufoo leftLabel page1" name="admission_newadmission" enctype="multipart/form-data" method="POST" onSubmit="" >	
							<div class=" card card-body col-md-11 my-auto mx-auto" style="border-top-color: #d2d6de; background-color:whitesmoke;" >
								<div class="row mt-1">							
									<div class="col-md-6">							
										<label>Application No. </label>
										<input type="text" name="application_no" id="application_no" class="form-control " value="" tabindex="" />
									</div>
									<div class="col-md-6">							
										<label>Date Of Birth (dd/mm/yyyy) </label>
										<input type="date" name="dob" id="dob" class="form-control " value="" tabindex="" />
									</div>
								</div>
								<div class="row mt-1">
									<div class="col-md-2">
									<button id="submit" name="submit" class=" btn btn-primary" type="submit" value="submit">Submit</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>  
	</body>
</html>	
<?php
page_footer();
?>
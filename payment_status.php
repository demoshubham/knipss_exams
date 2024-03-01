<?php
set_time_limit(0);
//session_cache_limiter('nocache');
//session_start();
include("settings.php");
//logvalidate($_SESSION['username'], $_SERVER['SCRIPT_FILENAME']);
page_header();
$response=1;
$msg='';
// if($_SESSION['username']!='sadmin'){
	// $_POST['stu_id'] = $_SESSION['username'];
// }
?>
<?php
if(isset($_POST['submit'])){
	$dob = (isset($_POST['dob']) && ($_POST['dob']) != '') ? $_POST['dob'] : '';
	$mob_no = (isset($_POST['mobile']) && ($_POST['mobile']) != '') ? $_POST['mobile'] : '';
	$sql = 'select sno from register_users where date_of_birth = "'.$dob.'" && mobile = "'.$mob_no.'"';
	//echo $sql;
	$result = mysqli_query($db, $sql);
	//print_r($result);
	$row = mysqli_fetch_array($result);
	
  if($row){
	header('location: payment_status_print.php?id='.$row['sno']);
  }
  else{
	echo '<script>alert("Error In Registration Number Or Date Of Birth")</script>';
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
							<h3 style="font-size: 20px; font-weight: 600;">Search Application No./Payment Status </h3>
						</section>
						<form action="payment_status.php" class="wufoo leftLabel page1" name="" enctype="multipart/form-data" method="post" onSubmit="" >	
							<div class=" card card-body col-md-11 my-auto mx-auto" style="border-top-color: #d2d6de; background-color:whitesmoke;" >
								<div class="row mt-1">							
									<div class="col-md-4">							
										<label>Candidate Name</label>
										<input type="text" name="applicant_name" id="applicant_name" class="form-control " value="" tabindex="" required />
									</div>
									<div class="col-md-4">							
										<label>Date Of Birth (dd/mm/yyyy) </label>
										<input type="date" name="dob" id="dob" class="form-control " value="" tabindex="" required />
									</div>
									<div class="col-md-4">							
										<label>Mobile No.</label>
										<input type="text" name="mobile" id="mobile" class="form-control " value="" tabindex="" required />
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
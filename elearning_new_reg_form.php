<?php
ob_start();
date_default_timezone_set('Asia/Calcutta');
session_cache_limiter('nocache');
session_start();
include("settings.php");

$response=1;
$tabindex=1;
$msg='';


page_header();

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
			$msg .= '<li>Insertion Failed</li>' ;
		}
		else{
			$msg .= '<li>Data Inserted</li>' ;
		}
		
// IMAGE UPLOAD 
		$photoname=$_FILES['photo']['name'];
		$signaturename=$_FILES['signature']['name'];
		
		$photo_upload="e_learning/photo/".$photoname;
		$signature_upload="e_learning/signature/".$signaturename;
		
		
		$res2=move_uploaded_file($_FILES['photo']['tmp_name'], $photo_upload);
		$res3=move_uploaded_file($_FILES['signature']['tmp_name'], $signature_upload);
		
		if(isset($sql) && isset($res2) && isset($res3)){
			echo "DONE";
		}
}



?>

<div id="container" width="70%">
	<div class="row ">
		<section class="content-header">
			<h1 style="color: #000!important;">E-Learning Form <span></span>(2023-24)</h1> <br>
		</section>
		<section class="content-header" style="margin-top: -25px">
			<h3 style="font-size: 20px; font-weight: 600;"></h3>
		</section>
		
		
<!---Student info section-------------------------------------------------------------------------------------------------------------------------------->
			
		<form action="elearning_payment_proceed.php"   id="examForm" class="wufoo leftLabel page1" name="admission_newadmission" enctype="multipart/form-data" method="post" onSubmit="" >
				<?php echo $msg; ?>	
				<div class=" card card-body col-md-11 my-auto mx-auto" style="border-top-color: #d2d6de; background-color:whitesmoke;" >
				
					<div class="row mt-1">							
						<div class="col-md-6">							
							<label>Candidate Name *</label>
							<input  type="text" name="candidate_name" id="candidate_name" class="form-control bolding bolding" value=""  tabindex="<?php echo $tabindex++;?>"   required  >
						</div>
						<div class="col-md-6">							
							<label>Father&#39;s Name*</label>
							<input  type="text" name="father_name" id="father_name" class="form-control bolding bolding " value="" tabindex="<?php echo $tabindex++;?>"    required    >
						</div>
					</div>
					<div class="row mt-1">
						<div class="col-md-6">							
							<label>Mother&#39;s Name</label>
							<input  type="text" name="mother_name" id="mother_name" class="form-control bolding bolding "  value="" tabindex="<?php echo $tabindex++;?>" required >
						</div>
						<div class="col-md-6">							
							<label>Date of Birth* </label>
							<input  type="date" id="dob" name="dob"  class="form-control bolding bolding" tabindex="<?php echo $tabindex++;?>" required >

							<script>
								// JavaScript code to populate the Date of Birth field and make it read-only
								document.addEventListener("DOMContentLoaded", function () {
									var dobInput = document.getElementById("dob");
									var defaultDate = '<?php echo $row['dob']; ?>';
									
									// Set the default value for the Date of Birth field
									dobInput.value = defaultDate;

									// Make the Date of Birth field read-only
									dobInput.readOnly = true;
								});
							</script>
						</div>
					</div>
					<div class="row mt-1">
						<div class="col-md-6">
							<label>Aadhar</label>
							<input  type="text" name="aadhar"  id="aadhar" class="form-control bolding bolding " value="" pattern=[0-9]{12} minlength="12" maxlength="12" tabindex="<?php echo $tabindex++;?>" required>
						</div>
						<div class="col-md-6">							
							<label>E-Mail</label>
							<input  type="text" name="email" id="email" class="form-control bolding bolding " value="" pattern=[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$  tabindex="<?php echo $tabindex++;?>" required >
						</div>
					</div>
					<div class="row mt-1">
						<div class="col-md-6">							
							<label>Mobile</label>
							<input  type="text" name="mobile" id="mobile" class="form-control bolding bolding " value="" pattern=[0-9]{10} minlength="10" maxlength="10" tabindex="<?php echo $tabindex++;?>" required>
						</div>
						<div class="col-md-6">
							
							<label for="selectOption">Blood Group</label>
								<select  name="blood_group" id="blood_group" class="form-control bolding bolding" tabindex="<?php echo $tabindex++;?>"    >
									<option value="N/A">N/A</option>
									<option value="N/A" >N/A</option>
									<option value="A+" >A+</option>
									<option value="A-" >A-</option>
									<option value="B+" >B+</option>
									<option value="B-" >B-</option>
									<option value="AB+" >AB+</option>
									<option value="AB-" >AB-</option>
									<option value="O+">O+</option>
									<option value="O-" >O-</option>
								</select>

							<script>
								function validateForm() {
									var selectedOption = document.getElementById('blood_group').value;
									if (selectedOption === "") {
										alert("Please select Blood Group");
										return false;
									}
									return true;
								}
							</script>
							
						</div>
					</div>
					<div class="row mt-1">							
						<div class="col-md-6"	>	
							<label>Course Applying for</label>
							<select name="course_name" id="" value="" class="form-control" tabindex="<?php echo $tabindex++;?>"     >
										<option value="" >---Select Your course ---</option>
										<?php 
											$sql  = 'select * from elearning_course';
											$dept_list = execute_query( $sql);
											while($list = mysqli_fetch_assoc($dept_list)){
												echo '<option  value = "'.$list['course_name'].'" ';
												// if(isset($_GET['id'])){
													// if(isset($stu_details['course_name'])){
														// if($stu_details['course_name'] == $list['sno']){
															// echo ' selected = "selected" ';
														// }
													// }
												// }
												echo '>'.$list['course_name'].'</option>';
											}
										?>
									</select>							
						</div>
						<div class="col-md-6">							
							<label>Category</label>
							<select  name="category" id="category" class="form-control bolding bolding" tabindex="<?php echo $tabindex++;?>"    >
							<option   <?php //echo isset($_GET['id'])? "":' selected = "selected" '?>>---Select Your Category---</option>
								<option value="GEN" >General</option>
								<option value="OBC" >OBC</option>
								<option value="SC" >SC</option>
								<option value="ST" >ST</option>
								<option value="EWS" >EWS</option>
							</select>
						</div>
					</div>
					<div class="row mt-1">
					<div class="col-md-6">


						<label for="selectOption">Religion</label>
								<select  id="selectOption" name="religion" class="form-control bolding bolding" tabindex="<?php echo $tabindex++;?>"    >
									<option value=""   selected>---Select Your Religion---</option>
									<option value="HINDU" >HINDU</option>
								<option value="MUSLIM" >MUSLIM</option>
								<option value="SIKH" >SIKH</option>
								<option value="CHRISTIAN" >CHRISTIAN</option>
								</select>

							<script>
								function validateForm() {
									var selectedOption = document.getElementById('selectOption').value;
									if (selectedOption === "") {
										alert("Please select religion");
										return false;
									}
									return true;
								}
							</script>
					</div>

						
						<div class="col-md-6">
							
							<label for="selectOption">Gender</label>
								<select id="selectOption" name="gender" class="form-control bolding bolding"   >
									<option value="">---Select Your Gender---</option>
									<option value="MALE" >MALE</option>
									<option value="FEMALE" >FEMALE</option>
								</select>
							
						</div>
					</div>
					<div class="row mt-1">
						<div class="col-md-6">	
							<label>Whatsapp Mobile No.</label>
							<input  type="text" name="w_number" id="caste" class="form-control bolding bolding " value="" pattern=[0-9]{10} minlength="10" maxlength="10" tabindex="<?php echo $tabindex++;?>" required />
							
						</div>
						<div class="col-md-6">							
							<label>PARENT'S Mobile No.</label>
							<input  type="text" name="parent_number" id="parent_income" class="form-control bolding bolding " pattern=[0-9]{10} minlength="10" maxlength="10" value="" tabindex="<?php echo $tabindex++;?>" required >
						</div>
					</div>
					<div class="row mt-1">
						
					
						<div class="col-md-6">
							
							<label for="selectOption">DOMICILE</label>
								<select name="domicile" id="domicile" value="" class="form-control" tabindex="<?php echo $tabindex++;?>"  >
										<option value="" >---Select Your Domicile ---</option>
										<?php 
											$sql  = 'select * from mst_domicile';
											$dept_list = execute_query( $sql);
											while($list = mysqli_fetch_assoc($dept_list)){
												echo '<option  value = "'.$list['sno'].'" ';
												if(isset($_GET['id'])){
													if(isset($stu_details['domicile'])){
														if($stu_details['domicile'] == $list['sno']){
															echo ' selected = "selected" ';
														}
													}
												}
												echo '>'.$list['domicile'].'</option>';
											}
										?>
									</select>

							<script>
								function validateForm() {
									var selectedOption = document.getElementById('domicile').value;
									if (selectedOption === "") {
										alert("Please select Domicile");
										return false;
									}
									return true;
								}
							</script>
							
						</div>
						<div class="col-md-6">							
							<label>MOTHER TONGUE</label>
							<select  name="mother_tongue" id="mother_tongue" class="form-control bolding bolding" tabindex="<?php echo $tabindex++;?>" >
								<option value="hindi" >Hindi</option>
								<option value="english" >English</option>
								
							</select>
						</div>
					</div>
					<div class="row mt-1">
						
						
					
						
						
					</div>
					<div class="row mt-1">
						
						
						
					</div>
					<div class="row mt-1">
						<div class="col-md-6">
						
							<label>Photo</label>
							<input  type="file" name="photo" id="parent_income" class="form-control bolding bolding " pattern=[0-9]{10} minlength="10" maxlength="10" value="" tabindex="<?php echo $tabindex++;?>" required >
							
						</div>
						
						<div class="col-md-6">
							<label>Signature</label>
							<input  type="file" name="signature" id="parent_income" class="form-control bolding bolding "  value="" tabindex="<?php echo $tabindex++;?>" required>

						</div>
						<div class="col-md-6">
							
						</div>
					</div>
					<div class="row mt-1">
						
						<div class="col-md-6">
							<!-- <label>Signature Upload</label>
							<input  type="file" name="signature" id="signature" class="form-control bolding bolding " value="" tabindex="" /> -->
						</div>
					</div>
					<!-- <div class="row mt-1">
						<div class="col-md-6">	
							<label>Transfer Certificate</label>
							<input  type="file" name="tc" id="tc" class="form-control bolding bolding " value="" />
						</div>
						<div class="col-md-6">	
							
						</div>
					</div> -->
					<div class="row mt-1">
						<div class="col-md-2">
						<!--
							<button id="submit" name="submit" class=" btn btn-primary" type="submit" value="submit">Submit</button>
						--->
						</div>
					</div>
				</div>
				
			</div></div>
			

<!-----Address Section--------------------------------------------------------------------------------------------------------------------->


			<div  name="info_table" id="info_table">
				<table width="100%" class="table table-striped-primary table-hover rounded ">	
					<tr class="bg-secondary text-white ">
						<th colspan="6" class="h5"><strong>Permanent Address</strong></th>
					</tr>
					<tr class="table-secondary">
						<input type="hidden" name="p_sno" value="<?php echo isset($_GET['id'])? $p_address_details['sno']: '' ?>"     >
						<th>House No./Village</th>
						<td><input type="text"  class="form-control" id="p_address" name="p_address" value="<?php echo isset($_GET['id'])? $data['p_address'] : '' ?>"  tabindex="<?php echo $tabindex++;?>" required ></td>
						<th>Post</th>
						<td><input type="text" class="form-control" id="p_post" name="p_post" value="<?php echo isset($_GET['id'])? $data['p_post'] : '' ?>"  value="<?php echo isset($_GET['id'])? $p_address_details['post']: '' ?>" tabindex="<?php echo $tabindex++;?>" required ></td>
						<th>Tahsil</th>
						<td><input type="text" class="form-control" id="p_tehsil" name="p_tehsil" value="<?php echo isset($_GET['id'])? $data['p_tehsil'] : '' ?>" tabindex="<?php echo $tabindex++;?>"  required ></td>
					</tr>
					<tr>
						<th>Thana</th>
						<td><input type="text" class="form-control" id="p_thana" name="p_thana" value="<?php echo isset($_GET['id'])? $data['p_thana'] : '' ?>" tabindex="<?php echo $tabindex++;?>" required ></td>
						<th>District</th>
						<td><input type="text" class="form-control" id="p_district" name="p_district" value="<?php echo isset($_GET['id'])? $data['p_district'] : '' ?>" tabindex="<?php echo $tabindex++;?>" required ></td>
						<th>State</th>
						<td><input type="text" class="form-control" id="p_state" name="p_state" value="<?php echo isset($_GET['id'])? $data['p_state'] : '' ?>" tabindex="<?php echo $tabindex++;?>" required ></td>
					</tr>
					<tr>
						
						<th>Pin</th>
						<td><input type="text" class="form-control"  id="p_pin" name="p_pin" pattern=[0-9]{6} minlength="6" maxlength="6" value="<?php echo isset($_GET['id'])? $data['p_pin'] : '' ?>"   required  ></td>
					</tr>
					<tr class="bg-secondary text-white">
						<th colspan="6" class="h5" >Correspondence Address <a href="javascript:copy_adr()" class="btn btn-danger" >Click Here to Copy</a></th>
					</tr>
					<tr class="table-secondary">
						<input type="hidden" name="c_sno" value="<?php echo isset($_GET['id'])? $c_address_details['sno']: '' ?>" required>
						<th>House No./Village</th>
						<td><input type="text" class="form-control" id="c_address" name="c_address" value="<?php echo isset($_GET['id'])? $c_address_details['address']: '' ?>" required ></td>
						<th>Post</th>
						<td><input type="text" class="form-control" id="c_post" name="c_post" value="<?php echo isset($_GET['id'])? $c_address_details['post']: '' ?>" required ></td>
						<th>Tahsil</th>
						<td><input type="text" class="form-control" id="c_tehsil" name="c_tehsil" value="<?php echo isset($_GET['id'])? $c_address_details['tehsil']: '' ?>"  required ></td>
						
					</tr>
					<tr>
						<th>Thana</th>
						<td><input type="text" class="form-control" id="c_thana" name="c_thana" value="<?php echo isset($_GET['id'])? $c_address_details['thana']: '' ?>" required ></td>
						<th>District</th>
						<td><input type="text" class="form-control" id="c_district" name="c_district" value="<?php echo isset($_GET['id'])? $c_address_details['district']: '' ?>" required ></td>
						<th>State</th>
						<td><input type="text" class="form-control" id="c_state" name="c_state" value="<?php echo isset($_GET['id'])? $c_address_details['state']: '' ?>" required></td>
					</tr>
					<tr>
						<th>Pin</th>
						<td><input type="text" class="form-control"  id="c_pin" name="c_pin" pattern=[0-9]{6} minlength="6" maxlength="6" value="<?php echo isset($_GET['id'])? $c_address_details['pin']: '' ?>" required ></td>
					</tr>
					
				</table>
			</div>
	
<!---Examination Section-------------------------------------------------------------------------------------------------------------------------->
					
				


					<input type="hidden" name="student_id" value="<?php echo $row['sno']; ?>" />
					
					<center><button type="submit" class="btn btn-danger" name="submit_new" value="submit_new">Proceed to Payment</button></center><br>
				</div>
			</div>

			
		</form>
<!--END Form-------------------------------------------------------------------------------------------------------------------------->
		<script type="text/javascript">
					function show_info() {

					
						 $("#info_table").toggle();
					
				}
				 function copy_adr(){
					 document.getElementById('c_address').value = document.getElementById('p_address').value;
					 document.getElementById('c_district').value = document.getElementById('p_district').value;
					 document.getElementById('c_state').value = document.getElementById('p_state').value;
					 document.getElementById('c_post').value = document.getElementById('p_post').value;
					 document.getElementById('c_pin').value = document.getElementById('p_pin').value;
					 document.getElementById('c_tehsil').value = document.getElementById('p_tehsil').value;
					 document.getElementById('c_thana').value = document.getElementById('p_thana').value;
				 }
				 
				 
				 
				</script>
	
	
	</div>
</div> 


<?php 

	page_footer();
	ob_end_flush();
?>

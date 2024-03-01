<?php
ob_start();
date_default_timezone_set('Asia/Calcutta');
session_cache_limiter('nocache');
session_start();
include("settings.php");

if(isset($_POST['student_id'])){
	$sql = 'select * from student_info where sno="'.$_POST['student_id'].'"';
	$student_info = $student = mysqli_fetch_assoc(mysqli_query($erp_link, $sql));
	
	$sql = 'select * from class_detail where sno="'.$student_info['class'].'"';
	$class = mysqli_query($erp_link, $sql);
	if(mysqli_num_rows($class)!=0){
		$class = mysqli_fetch_assoc($class);

	}
	else{
		$msg .= '<div class="alert alert-danger">Invalid Class Data</div>';

	}
	$papers = array();
	$i=1;

	if(($class['sort_no']=='BA_SEM' || $class['sort_no']=='BSC_SEM') && $class['year']=='1'){
		$sub1 = mysqli_fetch_assoc(mysqli_query($erp_link, "select * from add_subject where sno=".$student_info['sub1']));
		$sub2 = mysqli_fetch_assoc(mysqli_query($erp_link, "select * from add_subject where sno=".$student_info['sub2']));
		$sub3 = mysqli_fetch_assoc(mysqli_query($erp_link, "select * from add_subject where sno=".$student_info['sub3']));


		$sql = 'select * from add_subject_details where class_id="'.$class['sno'].'" and subject_id="'.$sub1['sno'].'"';
		$paper1 = mysqli_query($erp_link, $sql);
		while($row_paper1 = mysqli_fetch_assoc($paper1)){
			$papers[$i]['subject_name'] = $sub1['subject'];
			$papers[$i++][] = $row_paper1;
		}
		$papers[$i]['subject_name'] = $sub1['subject'];

		$sql = 'select * from add_subject_details where class_id="'.$class['sno'].'" and subject_id="'.$sub2['sno'].'"';
		$paper2 = mysqli_query($erp_link, $sql);
		while($row_paper2 = mysqli_fetch_assoc($paper2)){
			$papers[$i]['subject_name'] = $sub2['subject'];
			$papers[$i++][] = $row_paper2;
		}


		$sql = 'select * from add_subject_details where class_id="'.$class['sno'].'" and subject_id="'.$sub3['sno'].'"';
		$paper3 = mysqli_query($erp_link, $sql);
		while($row_paper3 = mysqli_fetch_assoc($paper3)){
			$papers[$i]['subject_name'] = $sub3['subject'];
			$papers[$i++][] = $row_paper3;
		}
		
		$sql = 'select add_subject2.subject, add_subject2.sno as subject_id from student_info_subject left join add_subject2 on add_subject2.sno = student_info_subject.subject_id where student_id="'.$student_info['sno'].'"';
		$result_vocational_subs = mysqli_query($erp_link, $sql);
		$vocational_subs = array();
		while($row_vocational_subs = mysqli_fetch_assoc($result_vocational_subs)){
			$sql = 'select * from add_subject_details where class_id="'.$student_info['class'].'" and type_status="2" and subject_id="'.$row_vocational_subs['subject_id'].'"';
			$result_subs = mysqli_query($erp_link, $sql);
			if(mysqli_num_rows($result_subs)!=0){
				while($row_subs = mysqli_fetch_assoc($result_subs)){
					$papers[$i]['subject_name'] = $row_vocational_subs['subject'];
					$papers[$i++][] = $row_subs;
				}
			}
			//$vocational_subs[$row_vocational_subs['subject_type']] = $row_vocational_subs['subject'];
		}

		//print_r($papers);
	}
	else{
		$sql = 'select * from add_subject_details where class_id="'.$class['sno'].'"';
		$paper1 = mysqli_query($erp_link, $sql);
		while($row_paper1 = mysqli_fetch_assoc($paper1)){
			if($row_paper1['type_status']=='1'){
				$sub_name = mysqli_fetch_assoc(mysqli_query($erp_link, "select * from add_subject where sno=".$row_paper1['subject_id']));	
			}
			elseif($row_paper1['type_status']=='2'){
				$sub_name = mysqli_fetch_assoc(mysqli_query($erp_link, "select * from add_subject2 where sno=".$row_paper1['subject_id']));
			}

			$papers[$i]['subject_name'] = $sub_name['subject'];
			$papers[$i++][] = $row_paper1;
		}


	}
	
	if(isset($_POST['code'])){
		$code = $_POST['code'];
	}
	else{
		$code = '';
	}
	if(isset($_POST['prev_uni'])){
		$prev_uni = $_POST['prev_uni'];
	}
	else{
		$prev_uni = '';
	}
	
	$sql = 'select * from exam_student_info where student_info_sno="'.$student['sno'].'"';
	$result_exam_student_info = mysqli_query($erp_link, $sql);
	
	// Generate examination form number	
	$sql = 'SELECT exam_form_no FROM `exam_student_info` ORDER BY exam_form_no DESC LIMIT 1';
	$result_last_exam_no = mysqli_query($erp_link, $sql);
	if(mysqli_num_rows($result_last_exam_no) ==0){
		$new_numeric_part = 202300001;
	}
	elseif(mysqli_num_rows($result_last_exam_no) != 0){
		$row_last_exam = mysqli_fetch_assoc($result_last_exam_no);
		$last_exam_form_no = $row_last_exam['exam_form_no'];
		
		$numeric_part = intval(substr($last_exam_form_no, 1));
		
		$new_numeric_part = $numeric_part + 1;
	}
		$exam_form_no = 'K'.$new_numeric_part;

		// echo $new_numeric_part;
		// echo '</br>';
		// echo $exam_form_no;

	if(mysqli_num_rows($result_exam_student_info)==0){
		$sql = 'insert into exam_student_info (student_info_sno, student_name, college_roll_no, exam_form_no, dob, mobile_no, uin_no, prev_univ, nss, status, created_by, creation_time) values ("'.$student['sno'].'", "'.$student['stu_name'].'", "'.$student['roll_no'].'", "'.$exam_form_no.'", "'.$student['dob'].'", "'.$student['mobile'].'", "'.$student['university_uin'].'", "'.$prev_uni.'", "'.$code.'", "0", "'.$_SERVER['REMOTE_ADDR'].'", "'.date("Y-m-d H:i:s").'")';
		mysqli_query($erp_link, $sql);
		if(mysqli_error($erp_link)){
			echo "Error : 101.25 ";
			echo mysqli_error($erp_link).' >> '.$sql;
		}
		else{
			$id = mysqli_insert_id($erp_link);
		}
	}
	else{
		$row_exam_student_info = mysqli_fetch_assoc($result_exam_student_info);
		$id = $row_exam_student_info['sno'];
		
		$sql = 'update exam_student_info set 
		prev_univ="'.$prev_uni.'",
		nss = "'.$code.'" 
		where sno="'.$id.'"';
		mysqli_query($erp_link, $sql);

		
		$sql = 'delete from exam_student_paper_info where exam_student_info_sno="'.$id.'"';
		mysqli_query($erp_link, $sql);

		$insertdata = array();
		$i=1;
		foreach($papers as $key=>$val){
			foreach($val as $k=>$v){
				if($k!=='subject_name'){
					$insertdata[$i++] = '("'.$id.'", "'.$v['type'].'", "'.$v['type_status'].'", "'.$v['class_id'].'", "'.$v['subject_id'].'", "'.$v['paper_code'].'", "'.$v['title_of_paper'].'", "'.$v['theory_practical'].'", "'.$v['credit'].'", "0", "'.$_SERVER['REMOTE_ADDR'].'", "'.date("Y-m-d H:i:s").'")';
				}
			}
		}
		if(isset($vocational_subs)){
			foreach($vocational_subs as $key=>$val){
				foreach($val as $k=>$v){
					if($k!=='subject_name'){
						$insertdata[$i++] = '("'.$id.'", "'.$v['type'].'", "'.$v['type_status'].'", "'.$v['class_id'].'", "'.$v['subject_id'].'", "'.$v['paper_code'].'", "'.$v['title_of_paper'].'", "'.$v['theory_practical'].'", "'.$v['credit'].'", "0", "'.$_SERVER['REMOTE_ADDR'].'", "'.date("Y-m-d H:i:s").'")';
					}
				}
			}	
		}
		$insertdata = implode(", ", $insertdata);
		$sql = 'insert into exam_student_paper_info (exam_student_info_sno, type, type_status, class_id, subject_id, paper_code, title_of_paper, theory_practical, credit, status, created_by, creation_time) values '.$insertdata;
		mysqli_query($erp_link, $sql);
		if(mysqli_error($erp_link)){
			echo "Error : 101.25 ";
			echo mysqli_error($erp_link).' >> '.$sql;
		}
		else{
			$id = mysqli_insert_id($erp_link);
		}
		

	}
}

page_header();
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
					<h1 style="color: #000!important;">EXAMINATION FORM 2023 </h1>
									<br>
				</section>
				
				<form action="exam_ccavRequestHandler.php" class="wufoo leftLabel page1" name="admission_newadmission" enctype="multipart/form-data" method="post" onSubmit="" >	
					
					<div class=" card card-body col-md-11 my-auto mx-auto" style="background-color:whitesmoke;">
						
						<div class="row mt-1">	
							<div class="col md-4">
								<h5 class="row d-flex"><strong>Applicant's Name :</strong></h5>
							</div>		
							<div class="col md-4 h5"><?php echo $student['stu_name']; ?></div>		
							<div class="col md-4 "></div>		
						</div>
						<div class="row mt-1">	
							<div class="col md-4">
								<h5 class="row d-flex"><strong>Father Name :</strong></h5>
							</div>		
							<div class="col md-4 h5"><?php echo $student['father_name']; ?></div>		
							<div class="col md-4 "></div>		
						</div>
						<div class="row mt-1">	
							<div class="col md-4">
								<h5 class="row d-flex"><strong>Mobile No :</strong></h5>
							</div>		
							<div class="col md-4 h5"><?php echo $student['mobile']; ?></div>		
							<div class="col md-4 "></div>		
						</div>
						<div class="row mt-1">	
							<div class="col md-4">
								<h5 class="row d-flex"><strong>Email ID :</strong></h5>
							</div>		
							<div class="col md-4 h5"><?php echo $student['e_mail1']; ?></div>		
							<div class="col md-4 "></div>		
						</div>
						<?php
						if(isset($_POST['prev_uni'])){
						?>
						<div class="row mt-1">	
							<div class="col md-4">
								<h5 class="row d-flex"><strong>Previous University :</strong></h5>
							</div>		
							<div class="col md-4 h5"><?php echo $_POST['prev_uni']; ?></div>		
							<div class="col md-4 "></div>		
						</div>
							
						<?php	
						}
						?>
						<div class="row mt-1">	
							<div class="col-md-12">
								<h5 class="row d-flex"><strong></strong></h5>
								<div class=" text-center text-white bg-secondary" style="font-size:1.5rem;font-weight:bolder">FEE BREAKUP</div>
							</div>	
							
							<div class="col md-4 h5">	</div>		
							<div class="col md-4 "></div>		
						</div>
						<div class="row">
							<div class="col-md-12">
								<?php
								$sql = 'SELECT * FROM `exam_fee_master` where class_id="'.$student['class'].'"';
								$fees = mysqli_fetch_assoc(mysqli_query($erp_link, $sql));
								echo '<table class="table table-bordered table-striped">
								<tr>
								<th>Exam Fees</th>
								<th>Marksheet Fees</th>
								<th>Enrollment Fees</th>
								<th>Game Fees</th>
								<th>Total</th>
								</tr>
								';
								$fees['total_fee'] -= $fees['enrolment_fee'];
								echo '<tr>
								<td>'.$fees['exam_fee'].'</td>
								<td>'.$fees['marksheet_fee'].'</td>';
								if(isset($_POST['prev_uni'])){
									if($_POST['prev_uni']!='Dr. Ram Manohar Lohia Avadh University'){
										echo '<td>'.$fees['enrolment_fee'].'</td>';		
										$fees['total_fee'] += $fees['enrolment_fee'];
									}
									else{
										echo '<td>0</td>';
									}
								}
								elseif($class['category']=='UG'){
									echo '<td>'.$fees['enrolment_fee'].'</td>';		
									$fees['total_fee'] += $fees['enrolment_fee'];
								}
								else{
									echo '<td>0</td>';
								}
								
								
								echo '
								<td>'.$fees['game_fee'].'</td>
								<td>'.$fees['total_fee'].'</td>
								</tr>';
								?>
							</div>
						</div>
					</div>
					<div class="row">
			
						
						<table class="table  table-bordered " width="100%">
							<tr class="bg-secondary text-white">
								<th width="7%" class="bolding">S. No.</th>
								<th width="13%" class="bolding">TYPE</th>
								<th width="20%" class="bolding">SUBJECT</th>
								<th width="15%" class="bolding">PAPER CODE </th>
								<th width="35%" class="bolding">PAPER NAME </th>
								<th width="10%" class="bolding">CREDIT</th>
							</tr>
							<?php
							if(($class['sort_no']=='BA_SEM' || $class['sort_no']=='BSC_SEM') && $class['year']=='1'){
							?>
								<?php
								$paper1 = $papers[1];
								//print_r($papers);
								$i=1;
								foreach($papers as $key=>$val){
									foreach($val as $k=>$v){
										if($k!=='subject_name'){
											echo '<tr><td class="bolding">'.$i++.'</td>
											<td class="bolding">'.$v['type'].'</td>
											<td class="bolding">'.$val['subject_name'].'</td>
											<td class="bolding">'.$v['paper_code'].'</td>
											<td class="bolding">'.$v['title_of_paper'].'</td>
											<td class="bolding">'.$v['credit'].'</td>
											</tr>';
										}
									}
								}

								?>
							
							<?php 
							} 
							else{
							?>
								<?php
								$paper1 = $papers[1];
								//print_r($paper1);
								$i=1;
								foreach($papers as $key=>$val){
									foreach($val as $k=>$v){
										if($k!=='subject_name'){
											echo '<tr>
											<td>'.$i++.'</td>
											<td>'.$v['type'].'</td>
											<td>'.$val['subject_name'].'</td>
											<td>'.$v['paper_code'].'</td>
											<td>'.$v['title_of_paper'].'</td>
											<td>'.$v['credit'].'</td></tr>
											';
										}
									}

								}
							}
							?>
						</table>
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
TID	:<input type="hidden" name="tid" id="tid" readonly value="<?php echo microtime(true)*10000; ?>" />
Merchant Id	:<input type="hidden" name="merchant_id" value="2803639"/>
Order Id	:<input type="hidden" name="order_id" value="<?php echo $epin; ?>"/>
Amount	:<input type="hidden" name="amount" value="<?php echo $fees['total_fee']; ?>"/>
Currency	:<input type="hidden" name="currency" value="INR"/>
Redirect URL	:<input type="hidden" name="redirect_url" value="https://knipssexams.in/exam_ccavResponseHandler.php"/>
Cancel URL	:<input type="hidden" name="cancel_url" value="https://knipssexams.in/exam_ccavResponseHandler.php"/>
Language	:<input type="hidden" name="language" value="EN"/>
Billing Name	:<input type="hidden" name="billing_name" value="<?php echo $student_info['stu_name']?>"/>
Billing Address	:<input type="hidden" name="billing_address" value="<?php echo $student_info['p_address']?>"/>
Billing City	:<input type="hidden" name="billing_city" value="<?php echo $student_info['p_district']?>"/>
Billing State	:<input type="hidden" name="billing_state" value="<?php echo $student_info['p_state']?>"/>
Billing Zip	:<input type="hidden" name="billing_zip" value="<?php echo $student_info['p_pin']?>"/>
Billing Country	:<input type="hidden" name="billing_country" value="India"/>
Billing Tel	:<input type="hidden" name="billing_tel" value="<?php echo $student_info['mobile']?>"/>
Billing Email	:<input type="hidden" name="billing_email" value="<?php echo $student_info['e_mail1']; ?>"/>
Merchant Param1	:<input type="hidden" name="merchant_param1" value="<?php echo $student_info['sno']; ?>"/>
Merchant Param2	:<input type="hidden" name="merchant_param2" value="<?php echo date("Y-m-d H:i:s"); ?>"/>
Merchant Param3	:<input type="hidden" name="merchant_param3" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>"/>
Student ID	:<input type="hidden" name="student_id" value="<?php echo $student_info['sno']; ?>"/>

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
				<div class="col-md-2">
				<button type="submit" class="btn btn-danger">Make Payment</button>
				
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

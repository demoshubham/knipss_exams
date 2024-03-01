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

///	$sup=dbconnect($_POST[$id]);
if(isset($_GET['id'])){	
	$erp_link = mysqli_connect("localhost", "root", "mysql", "cloudice_knipss_2023");
	$sql = 'select * from student_info where university_uin="'.$_GET['id'].'"';
	echo $sql;
	$student_info_data = mysqli_fetch_assoc(mysqli_query($erp_link , $sql));
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    
    <!-- Bootstrap CSS -->
    <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
    rel="stylesheet"
    
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
    crossorigin="anonymous"
    />
    
    <title>Candidate Confirmation Form !</title>

    <!-- css  -->
    <style>
      body {
        font-family: "Roboto", sans-serif;
        font-size: .8rem;
        /* line-height: 0.9; */
      }
      h1{
        font-size: 1.8rem !important;
      }
      h2{
        font-size: 1.5rem !important;
      }
      h3{
        font-size: 1.3rem !important;
      }
      h4{
        font-size: 1rem !important;
      }
      p{
        font-size: .6rem !important;
      }
      td{
		
        font-size: .6rem !important;
      }
      th{
        font-size: .6rem !important;
      }
      @media print {
        *{
          margin: 0px !important;
		  margin-block: 2px !important;
          padding: 2px !important;
          box-sizing: border-box !important;
        }
		.head-name{
			font-size:15.5px !important;
		}
       body{
        padding:1rem!important;
       }
        td{
          padding: 8px !important;
          /* margin: 10px !important; */
        }
		tr{
		}
        .print_no{
          display:none !important;
        }
        /*.blood{
		font-size:7.9px!important;
	 }*/
        .btn-print{
          display: none;
        }
        
      }

      @page{
        size: A4;
        margin-inline:0;
        padding: 0;
      }
    </style>
    <!-- <link rel="stylesheet" href="style.css" media="print"> -->
    <!-- googlefont -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,700&display=swap"
      rel="stylesheet"
    />
  </head>
  <body class="w-100 m-auto">
  
    <div class="" style="display:flex ; justify-content: center ;">
      <button class="btn btn-secondary btn-print" style="width: 5%;" onclick="print()">Print</button>
    </div>
	<img src="images/logo.png"  id="overlays" style=" z-index:-2;opacity:0.15;position: absolute;top: 50%;left: 50%;-ms-transform: translate(-50%, -50%);transform: translate(-50%, -50%); width:30%;" alt="overlay image" >


   <div class="container-fluid m-auto cont ">
      <div class="container-fluid border">
       <!-- <div class="row  d-flex align-items-center">
          <div class="col-2 ">
            <img src="images/logo.gif" alt="logo" class="img-fluid w-75 m-1" />
          </div>
          <div class="col-11">
            <h3 class="" style="text-align: center;"><b>Kamla Nehru Institute Of Physical & Social Sciences,Sultanpur, Uttar Pradesh<b></h3>
            <h4 style="text-align: center;"><b>An Autonomous Institute</b></h4>
          </div>
        </div>-->
		
		<table width="100%" style="margin:0px;">
			<tr>
				<th width="12%" rowspan="2"><img style="padding:15px; height:65px; width:65px; " src="images/logo.png" alt="logo" class="img-fluid d-block m-auto" /> </th>
				<th width="88%">
					<h4 class="" style="text-align: center; margin:0px; " ><span style="font-size:17px;white-space:nowrap;" class="head-name"><b>Kamla Nehru Institute Of Physical & Social Sciences,Sultanpur, Uttar Pradesh</b></span> <br>An Autonomous Institute And Accredited "A" Grade by NAAC</h4>
				</th>
			</tr>
		</table>
        <br>
        <!-- <hr> -->
        <div class="table-responsive m-2">
			<table  width="100%" class="table table-bordered border">
			  
				<tr>
					<th scope="col" COLSPAN="6" class="p-1"><center>EXAMINATION FORM - 2023</center></th>
				</tr>
				<tr>
					<th scope="col" width="17%">NAME OF COLLEGE:</th>
					<th scope="col"   colspan="3"></th>
					<th scope="col"  width="15%">FORM NO.</th>
					<th scope="col"  width="19%"></th>
				</tr>
				<tr>
					<th scope="col"  >COURSE APPLIED FOR:</th>
					<th scope="col"   colspan="3"></th>
					<th scope="col"   >STUDENT TYPE</th>
					<th scope="col"  ></th>
				</tr>
				<tr>
					<th scope="col" width="15%" >EXAM FEE</th>
					<th scope="col"  width="18%" ></th>
					<th scope="col"  width="15%">TRANSACTION NO.</th>
					<th scope="col" width="18%" ></th>
					<th scope="col" width="16%"  >TRANSACTION DATE:</th>
					<th scope="col" width="19%" ></th>
				</tr>
				<tr>
					<th scope="col"  >FEE BREAKUP :</th>
					<th scope="col"   colspan="5"></th>
					
				</tr>
				<tr>
					<th scope="col"  >STUDENT NAME</th>
					<th scope="col"   ><?php echo $student_info_data['stu_name']; ?></th>
					<th scope="col"  >FATHER'S/HUSBAND NAME</th>
					<th scope="col"  ><?php echo $student_info_data['father_name']; ?></th>
					<th scope="col"   >UIN NO. :&nbsp;<?php echo $student_info_data['university_uin']; ?></th>
					<th scope="col" rowspan="4"  width="19%">IMG</th>
				</tr>
				<tr>
					<th scope="col"  >MOTHER'S NAME</th>
					<th scope="col"   ><?php echo $student_info_data['mother_name']; ?></th>
					<th scope="col"  >DATE OF BIRTH</th>
					<th scope="col"  ><?php echo $student_info_data['dob']; ?></th>
					<th scope="col"   >GENDER :&nbsp;<?php 
					if($student_info_data['gender']==("M"||"m")){
						echo "Male"; 
					}
					elseif($student_info_data['gender']==("F"||"f")){
						echo "Female"; 
					}					
					?></th>
				</tr>
				<tr>
					<th scope="col" >CATEGORY</th>
					<th scope="col"   ><?php echo $student_info_data['category']; ?></th>
					<th scope="col" >SUB CATEGORY</th>
					<th scope="col"><?php echo $student_info_data['sub_category']; ?></th>
					<th scope="col" class="blood" >BLOOD GROUP: <?php echo $student_info_data['blood_group']; ?></th>
				</tr>
				<tr>
					<th scope="col" >AADHAR NUMBER</th>
					<th scope="col"   ><?php echo $student_info_data['aadhar']; ?></th>
					<th scope="col" >MOBILE</th>
					<th scope="col" ><?php echo $student_info_data['mobile']; ?></th>
					<th scope="col" >RELIGION: <?php echo $student_info_data['religion']; ?></th>
				</tr>
				<tr>
					<th scope="col" >PARENT'S INCOME</th>
					<th scope="col" ><?php echo $student_info_data['annual_income']; ?></th>
					<th scope="col" >DOMICILE</th>
					<th scope="col"  ><?php echo $student_info_data['p_state']; ?></th>
					<th scope="col"  >MOTHER TONGUE:</th>
					<th scope="col"  ><?php echo $student_info_data['mother_tongue']; ?></th>
				</tr>
				<tr>
					<th scope="col" >WEIGHTAGE</th>
					<th scope="col"   ><?php echo $student_info_data['waightage']; ?></th>
					<th scope="col" >APPLY FOR NSS</th>
					<th scope="col"  ><?php echo ''; ?></th>
					<th scope="col"  >FORM FILLED ON </th>
					<th scope="col"  ><?php echo ''; ?></th>
				</tr>
				<tr>
					<td scope="row" COLSPAN="6"><b>NAME AND COMPLETE MAILING ADDRESS OF CONDIDATE :&nbsp;</b><?php echo $student_info_data['stu_name']?>&nbsp;&nbsp;<b><?php echo $student_info_data['e_mail1']; ?></b></td>
				</tr>
				<tr>
					<td scope="row" COLSPAN="6"><b>HOUSE NO.:  STREET/VILLAGE: <br>POST OFFICE: DISTRICT/CITY : STATE:</b>&nbsp;&nbsp; <?php echo $student_info_data['p_address']?></td>
				</tr>
				<tr>
					<td scope="row" COLSPAN="6"><b>PREVIOUS YEAR EXAMINATION DETAIL</b></td>
				</tr>
				
				<tr>
					<th >EXAMINATION NAME</th>
					<th colspan="2"> BOARD / UNIVERSITY</th>
					<th >YEAR</th>
					<th>ROLL NO.</th>
					<th>MARKS(OBT./MAX.)</th>
					
				</tr>
				<tr>
						<?php
							if($data['course_type']=='2'){
								
								$a = 5;	
							}
							elseif ($data['course_applying_for'] == '52' || $data['course_applying_for'] == '53' || $data['course_applying_for'] == '54') {
								$a = 5;
							}
							else{
								$a = 3;
							}
							if ($data['course_applying_for'] == '52' || $data['course_applying_for'] == '53' || $data['course_applying_for'] == '54') {
								$a = 5;
							}

							for ($i = 1; $i < $a; $i++) {
								if ($i % 2 != 0) {
									echo '<tr class="table-secondary">';
								} else {
									echo '<tr>';
								}
								?>
								<!--<td><?php //echo $i; ?></td>-->
								<?php
								if ($i == 1) {
									echo '<td>High School<input disabled type="hidden" name="part_desc' . $i . '"  value="High School" required ></td>';
								} elseif ($i == 2) {
									echo '<td>Intermediate<input disabled type="hidden" name="part_desc' . $i . '"  value="Intermediate" required ></td>';
								} elseif ($i == 3 || $i == 4) {
									?>
									<td>
										<select disabled name="part_desc<?php echo $i; ?>" id="part_desc<?php echo $i; ?>" onBlur="tab_fill(1,8)" onFocus="getCurrent(<?php echo $i; ?>)">
											<option value="<?php echo isset($_POST['part_desc' . $i]) ? $_POST['part_desc' . $i] : ''; ?>"
													selected><?php if (isset($_POST['part_desc' . $i . ''])) {
													echo $_POST['part_desc' . $i . ''];
												} ?></option>

											<option value="B.Ed">B.Ed</option>
											<?php
											$sql = 'select * from class_detail ';
											$result = execute_query($sql);
											if ($result) {
												while ($name = mysqli_fetch_array($result)) {
													echo '<option value="' . $name['sno'] . '" ';
													echo '>' . $name['class_description'] . '</option>';
												}
											}
											?>
										</select>
									</td>
									<?php
								}
								?>
								<td>
									<input disabled name="part_desc<?php echo $i; ?>_board" type="text"
										   value="<?php echo isset($_GET['id']) ? (isset($_POST['part_desc' . $i . '_board']) ? $_POST['part_desc' . $i . '_board'] : '') : '' ?>"
										   class="form-control" maxlength="100" id="part_desc<?php echo $i; ?>_board"  <?php if($i<=3){ echo " required ";} ?> />
								</td>

								<td><input disabled name="part_desc<?php echo $i; ?>_college" type="text"
										   value="<?php if (isset($_POST['part_desc' . $i . '_college'])) {
											   echo $_POST['part_desc' . $i . '_college'];
										   } ?>" class="form-control" maxlength="100" id="part_desc<?php echo $i; ?>_college" <?php if($i<=3){ echo " required ";} ?>  /></td>

								<td><input disabled name="part_desc<?php echo $i; ?>_year" type="text"
										   value="<?php if (isset($_POST['part_desc' . $i . '_year'])) {
											   echo $_POST['part_desc' . $i . '_year'];
										   } ?>" class="form-control" maxlength="6" id="part_desc<?php echo $i; ?>_year"  <?php if($i<=3){ echo " required ";} ?> /></td>

								<td><input disabled name="part_desc<?php echo $i; ?>_rollno" type="text"
										   value="<?php if (isset($_POST['part_desc' . $i . '_rollno'])) {
											   echo $_POST['part_desc' . $i . '_rollno'];
										   } ?>" class="form-control"  id="part_desc<?php echo $i; ?>_rollno"  <?php if($i<=3){ echo " required ";} ?> />
								</td>

								<td width="10%">
									<select disabled name="" id="select<?php echo $i; ?>" class="form-control"
											onchange="toggleFields(<?php echo $i; ?>)">
										<option value="" selected>--select--</option>
										<option value="percentage" <?php if (isset($_POST['part_desc' . $i . '_obtmarks'])) {
											echo 'selected="selected"';
										} ?>>percentage
										</option>
										<option value="cgpa" <?php if (isset($_POST['part_desc' . $i . '_cgpa'])) {
											echo 'selected="selected"';
										} ?>>CGPA
										</option>
									</select>
								</td>

								<td><input disabled name="part_desc<?php echo $i; ?>_obtmarks" type="text"
										   value="<?php if (isset($_POST['part_desc' . $i . '_obtmarks'])) {
											   echo $_POST['part_desc' . $i . '_obtmarks'];
										   } ?>" placeholder="Obtained Marks" class="form-control" maxlength="6"
										   id="<?php echo $i ?>_obt"/></td>
								<td>
									<input disabled name="part_desc<?php echo $i; ?>_totmarks" type="text"
										   value="<?php if (isset($_POST['part_desc' . $i . '_totmarks'])) {
											   echo $_POST['part_desc' . $i . '_totmarks'];
										   } ?>" placeholder="Total Marks" class="form-control" maxlength="6"
										   onBlur="get_perc(<?php echo $i ?>)" id="<?php echo $i ?>_total"/></td>
								<td>
									<input disabled name="part_desc<?php echo $i; ?>_percentage" type="text"
										   value="<?php if (isset($_POST['part_desc' . $i . '_percentage'])) {
											   echo $_POST['part_desc' . $i . '_percentage'];
										   } ?>" placeholder="Percentage" class="form-control" maxlength="6"
										   id="<?php echo $i ?>_perc" OnBlur="get_division(<?php echo $i ?>)"/></td>
								<td>
									<input disabled name="part_desc<?php echo $i; ?>_cgpa" type="text"
										   value="<?php if (isset($_POST['part_desc' . $i . '_cgpa'])) {
											   echo $_POST['part_desc' . $i . '_cgpa'];
										   } ?>" class="form-control" placeholder="Enter CGPA" maxlength="10"
										   id="<?php echo $i ?>_cgpa"/></td>

								<td>
									<select disabled name="part_desc<?php echo $i; ?>_status"
											value="<?php if (isset($_POST['part_desc' . $i . '_status'])) {
												echo $_POST['part_desc' . $i . '_status'];
											} ?>" id="part_desc" onBlur="tab_fill(1,8)" onFocus="getCurrent(<?php echo $i; ?>)">
										<option value="Passed">Passed</option>
										<option value="Failed">Failed</option>
									</select>
								</td>
								<input disabled type="hidden" name="q_sno<?php echo $i; ?>"
									   value="<?php echo isset($_GET['id']) ? isset($_POST['q_sno' . $i]) ? $_POST['q_sno' . $i] : '' : '' ?>">
								</tr>
							<?php } ?>
				
				<tr>
					<td ></td>
					<td colspan="2" ></td>
					<td > </td>
					<td > </td>
					<td > </td>
					
				</tr>
			</table>
			<table class="table table-bordered">
				<tr>
					<th colspan="4"> SUBJECT / PAPER OPTED</th>
				</tr>
				<tr>
					<th width="8%">S. NO.</th>
					<th width="17%">TYPE</th>
					<th width="20%">SUBJECT</th>
					<th width="10%">PAPER CODE </th>
					<th width="35%" >PAPER NAME</th>
					<th width="10%" >CREDIT</th>
				</tr>
				<tr>
					<td >1</td>
					<td ></td>
					<td ></td>
					<td ></td>
					<td ></td>
					<td ></td>
				</tr>
				<tr>
					<td >2</td>
					<td ></td>
					<td ></td>
					<td ></td>
					<td ></td>
					<td ></td>
				</tr>
				
				<tr>
					<td >3</td>
					<td ></td>
					<td ></td>
					<td ></td>
					<td ></td>
					<td ></td>
				</tr>
				
				<tr>
					<td >4</td>
					<td ></td>
					<td ></td>
					<td ></td>
					<td ></td>
					<td ></td>
				</tr>
				<tr>
					<td >5</td>
					<td ></td>
					<td ></td>
					<td ></td>
					<td ></td>
					<td ></td>
				</tr>
				
				
			   
			</table>
        </div>
		<table  width="100% " >
			<tr >
				<td >
				  <hr><br>
				  <h4 align="center"><b>CERTIFICATION BY THE DEAN/HOD/PRINCIPAL</b></h4>
				  <hr>
				  <p>CERTIFIED THAT SHRI/KM/SMT. <B>SUNIL KUMAR PANDEY</b> IS BONAFIED STUDENT OF THE COLLEGE. ALL THE DOCUMENTS OF ELIGIBILITY MENTIONED IN <b>FORM NO. 220859052</b> HAVE BEEN CHECKED AND VERIFIED AND IT'S FOUND CORRECT. THE CANDIDATE IS ELIGIBLE FOR THE FUTURE EXAMINATION AND DURATION OF THE COURSE IS NOT EXCEEDING NOT MORE THAN SIX YEAR FOR UNDER GRADUATE COURSES AND FOUR YEARS FOR POST GRADUATE COURSES.</p>
				</td>	
			</tr>
			<tr>
				<th colspan=""2>DATE :</th>
			</tr>
			<tr>
				
				<td style="text-align:right; margi-right:10px;" >(DEAN/HOD/PRINCIPAL SIGNATURE WITH SEAL)<br><b>Kamla Nehru Institute Of Physical & Social Sciences,Sultanpur</b></td>
			</tr>
			<tr>
				<td >SIGNATURE OF OFFICE ASSISTANT<td>
			</tr>
			
		</table >
    </div>
</div>
	
     
  </body>
</html>

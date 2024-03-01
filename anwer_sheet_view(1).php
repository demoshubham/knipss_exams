<?php 
session_start();
include("settings.php");
include("exam_crosslist_marksheet_functions.php");
$msg='';

$grand_total_obt = 0;
$grand_total_max = 0;
$total_credit_earned = 0;
$total_credit_default  = 0;
$passing_status = 'PASSED';
$Cocurricular_count = 0;
$cocurricular_count = 0;
$total_credit_point_earned = 0;
$total_obt = 0;
$total_max = 0;	
$total_grade_credit_erned_point = 0;
$passing_status_reason = 'EVERY THING FINE';
$avg_credit = 0;
$backpaperArray = array();

if(isset($_POST['exam_roll_no'])){
	$sql = 'SELECT `exam_student_info`.`sno` as id,`exam_student_info`.`student_name`,`exam_student_info`.`student_info_sno`,`exam_student_info`.`exam_roll_no`,`exam_student_info`.`dob`,`exam_student_info`.`uin_no`,`exam_student_info`.`course_name`,`student_info`.`father_name`,`student_info`.`mother_name`,`student_info`.`photo_id`,student_info.p_pin ,student_info.p_state,student_info.p_district,student_info.p_address,student_info.mobile,student_info.e_mail1,student_info.sno as snoo FROM `exam_student_info` LEFT JOIN `student_info` ON `exam_student_info`.student_info_sno = `student_info`.sno where `exam_student_info`.`exam_roll_no` = "'.$_POST['exam_roll_no'].'" AND `exam_student_info`.`course_name` = "'.$_POST['result_course'].'" AND `exam_student_info`.`mobile_no` = "'.$_POST['mobile_no'].'"';
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
    
    <title>Answer Sheet View </title>

    <!-- css  -->
    <style>
      body {
        font-family: "Roboto", sans-serif;
        font-size: .8rem;
		margin:5px!important;
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
        font-size: .8rem !important;
      }
      td{
        font-size: .8rem !important;
      }
      th{
        font-size: .8rem !important;
      }
		@media print {
			
			td{
				font-size: 15px!important;
				padding: 5px!important;
				}
			th{
				
				font-size: 15px!important;
				padding: 5px!important;
			}
			.watermark {
				color: #ececec; 
				opacity: 0.2 !important;
				top: 30% !important;
				left: 10% !important;
				font-size: 3rem; 
			  }
			  table td{
			border:1px solid black!important;
			}
			.abc{
				border:1px solid black!important;
			}
			
			.marksheet-container {
				width: 100%;
				height: 100%;
				margin: 15px;
				 /* Ensure each container starts on a new page */
			}
			  #printButton {
				display: none;
			 }
			 #overlays1{
			width:60%!important;
			margin-bottom:!important;
			filter:grayscale(100%);
			margin-top:20px!important;
		}
			 
		}
		
		.look{
			padding:3px!important;
			margin:0px!important;
			font-size:11px;
		}
			
		
	  
		@page{
        size: A4;
        margin:10px;
        margin-right:25px!important;
		}
		.watermark {
		  position: absolute;
		  top: 50%;
		  left: 20%;
		  opacity: 0.8;
		  z-index: -100;
		  color: #aeabab ;
		  font-size: 6.1rem;
		  transform: rotate(-45deg);
		  font-weight: normal;
		  user-select: none;
		}
		

		.merge_column1 {
			position: absolute;
			top: 2%;
			left: 50%;
			-ms-transform: translate(-50%, -50%);
			transform: translate(-50%, -50%);
			background-color: white;
			padding-top: 0.1rem; padding-inline:0.1rem;
			/*padding-left : 20px;
			padding-right : 20px;*/
		}
		.look{
			padding-left:10px!important;
		}
		table td{
			border:1px solid black;
		}
		.abc{
			border:1px solid black;
		}
		#overlays1{
			width:40%;
			margin-top:200px;
			margin-right:50px!important;
			filter:grayscale(100%);
			
		}
	
		#main{
			margin:10px!important;
			padding:5px;
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
	<?php
		//echo $sql;
		$result =mysqli_query($erp_link,$sql);
		if(mysqli_num_rows($result)>0){
			$student_exists = 1;
		}
		else{
			$student_exists = 0;
		}
		if($student_exists==1){
		$i=1;
		while($row=mysqli_fetch_assoc($result)){
			echo '';
	?>
  <body class="w-100 m-auto" id="main">
 
	<form action="reeval_ccavRequestHandler.php" method="POST">
		<!-- <form action="print_anwer_sheet_view.php" method="POST"> -->


		<input type="hidden" name="rollno" value="<?php echo $_POST['exam_roll_no'];?>">
		<input type="hidden" name="course" value="<?php echo $_POST['result_course'];?>">
		<input type="hidden" name="mobno" value="<?php echo $_POST['mobile_no'];?>">
		
		<img src="images/kni_logo.png"  id="overlays" style=" z-index:-2;opacity:0.0;position: absolute;top: 50%;left: 50%;-ms-transform: translate(-50%, -50%);transform: translate(-50%, -50%); width:30%;" alt="overlay image" >
		<img src="images/logo_bg.png"  id="overlays1" style=" z-index:0;opacity:0.15;position: absolute;top: 40%;left: 50%;-ms-transform: translate(-50%, -50%);transform: translate(-50%, -50%); width:30%; " alt="overlay image" >
		<div  style="">
			<div class="container-fluid">
				
				<table width="100%" style="margin:0px;">
					<tr>
						<th width="12%" rowspan="2"><img style="padding:15px; height:65px; width:65px; " src="images/kni_logo.png" alt="logo" class="img-fluid d-block m-auto" /> </th>
						<th width="88%">
							<h4 class="" style="text-align: center; margin:0px; " ><span style="font-size:17px;white-space:nowrap;" class="head-name"><b>Kamla Nehru Institute Of Physical & Social Sciences,Sultanpur, Uttar Pradesh</b></span> <br>An Autonomous Institute And Accredited "A" Grade by NAAC<br><span style="font-size:14px;">(Affiliated to Dr. Rammanohar Lohia Avadh University, Ayodhya U.P.)</span></h4>
						</th>
					</tr>
				</table>
			
				<table class="table table-borderless" width="100%">
					<tr>
						<th width="20%" class="look">Name </th>
						<th width="30%" class="look">:	<?php echo strtoupper($row['student_name']);?> <?php //echo '--'.$row['id']; ?>	</th >
						<th width="20%" class="look">Roll NO.</th>
						<th width="30%" class="look">: <?php echo $row['exam_roll_no']; ?><?php //echo '--'.$row['dob']; ?></th >
						<!--<th width="20%" rowspan="5">
						
						<?php //echo $photo; ?>
						<img style="width:80px; height:65px; " src="<?php //echo $photo; ?>" alt="Student Image"></th>-->
					</tr>
					<tr>
						<th class="look">Father's Name</th>
						<th class="look">: <?php echo strtoupper($row['father_name']); ?></th >
						<th class="look">Course</th>
						<th class="look">: <?php
								$sql_class = 'select * from class_detail where sno = "'.$row['course_name'].'"';
								$row_class = mysqli_fetch_assoc(mysqli_query($erp_link,$sql_class));
								echo $row_class['class_description']; 
							?>
						</th >
					</tr>
					<tr>
						<!-- <th class="look">Mother's Name</th>
						<th class="look">: <?php echo strtoupper($row['mother_name']); ?></th > -->
						<th class="look">UIN NO.</th>
						<th class="look">: <?php echo $row['uin_no']; ?></th >
						<th class="look">College</th>
						<th  class="look">: K.N.I.P.S.S. Sultanpur</th >
					</tr>
				</table>	
				
				<table class="table text-center" style="border:1px solid black; ">
					<tr style="border:1px solid black; ">
						<th width="5%"  class="abc">SNo.</th>
						<th  width="30%"  class="abc">SUBJECT</th>
						<th  width="30%"  class="abc">PAPER CODE</th>
						<th width="30%"  class="abc">PAPER TITLE</th>
						<th width="5%"  class="abc">SELECT</th>
					</tr>
					<?php
						$paperCodeArray = array();
							$sql2 = 'SELECT * FROM exam_student_paper_info WHERE exam_student_info_sno = "'.$row['id'].'"';
							$result2 = mysqli_query($erp_link, $sql2);
							$i=1;
							while ($row2 = mysqli_fetch_assoc($result2)) {
								if (!in_array($row2['paper_code'], $paperCodeArray)) {
									$paperCodeArray[] = $row2['paper_code'];
									
									if($row2['type_status']==1){
										$sql_subject = 'select * from add_subject where sno = "'.$row2['subject_id'].'"';
									}else{
										$sql_subject = 'select * from add_subject2 where sno = "'.$row2['subject_id'].'"';
									}
									$row_subject = mysqli_fetch_assoc(mysqli_query($erp_link,$sql_subject));
									$_POST['papercodes']=$row2['paper_code'];
					?>
					<tr>
							<td><?php echo $i;?></td>
							<td><?php echo $row_subject['subject']; ?></td>
							<td><?php echo $row2['paper_code']; ?></td>
							<td><?php echo $row2['title_of_paper']; ?></td>
							<td><input type="radio" name="papercode" class="checkbox form-check-input" value="<?php echo $row2['paper_code']; ?>" onclick="getCheckboxValues()"></td>
					</tr>
						<?php
									
								}
								$i++;
							}
						?>
				</table>
				<div class="text-danger text-center lead">* Only One Paper can be selected.</div>
				<div class="lead"><input type="checkbox" class="form-check-input" name="abc" required>&nbsp;&nbsp;&nbsp; 
					<b> Check here to indicate that you have read and agree to the terms and Condition.</b>
				</div>
				<div id="result" style="font-size:1.5rem;text-align:center;color:red;"></div>
			</div>
		</div>
		
		<div class="text-center" style="position:relative;z-index:100;">
			<input type="submit" class="btn btn-primary m-5" value="Proceed to Pay" name="submit">
		</div>
	<?php	
	// this will find an unique random value
	$exit=0;
	while($exit==0){
		$epin = randomstring();
		$epin="evalview".$epin;
		$sql = 'select * from online_payment_eval where tid="'.$epin.'"';
		$result = execute_query($sql);
		if(mysqli_num_rows($result) == 0){
			$exit=1;
		}
	}	
	?>
	<span style="display:none;">
		TID	:<input type="hidden" name="tid" id="tid" readonly value="<?php echo microtime(true)*10000; ?>" />
		Merchant Id	:<input type="hidden" name="merchant_id" value="2803639"/>
		Order Id	:<input type="hidden" name="order_id" value="<?php echo $epin; ?>"/>
		Amount	:<input type="hidden" name="amount" value="1"/> 
		Currency	:<input type="hidden" name="currency" value="INR"/>
		Redirect URL	:<input type="hidden" name="redirect_url" value="https://knipssexams.in/reeval_ccavResponseHandler.php"/>
		Cancel URL	:<input type="hidden" name="cancel_url" value="https://knipssexams.in/reeval_ccavResponseHandler.php"/>
		Language	:<input type="hidden" name="language" value="EN"/>
		Billing Name	:<input type="hidden" name="billing_name" value="<?php echo $row['student_name']?>"/>
		Billing Address	:<input type="hidden" name="billing_address" value="<?php echo $row['p_address']?>"/>
		Billing City	:<input type="hidden" name="billing_city" value="<?php echo $row['p_district']?>"/>
		Billing State	:<input type="hidden" name="billing_state" value="<?php echo $row['p_state']?>"/>
		Billing Zip	:<input type="hidden" name="billing_zip" value="<?php echo $row['p_pin']?>"/>
		Billing Country	:<input type="hidden" name="billing_country" value="India"/>
		Billing Tel	:<input type="hidden" name="billing_tel" value="<?php echo $row['mobile']?>"/>
		Billing Email	:<input type="hidden" name="billing_email" value="<?php echo $row['e_mail1']; ?>"/>
		Merchant Param1	:<input type="hidden" name="merchant_param1" value="<?php echo $_POST['exam_roll_no'];?>"/>
		Merchant Param2	:<input type="hidden" name="merchant_param2" value="<?php echo $_POST['result_course'];?>"/>
		Merchant Param3	:<input type="hidden" name="merchant_param3" value="<?php echo $_POST['mobile_no'];?>"/>
		Merchant Param4	:<input type="hidden" id="pcode" name="merchant_param4" value="<?php echo $_POST['papercodes']; ?>"/>
		Student ID	:<input type="hidden" name="student_id" value="<?php echo $row['snoo']; ?>"/>

	</span>	
		
	<!-- 
		merchant_param1=exam_roll_no
	merchant_param2=result_course
	merchant_param3=mobile_no
	merchant_param4=papercode
	merchant_param5=remoteaddr
	-->
	</form>
  </body>
</html>
<?php
	}			
}else{
	
	
	?>
<script>


  alert("Roll number not found.");
  window.location.href = "re_evaluation_reg.php";
</script>

<?php
}
}
?>	

<script>

	// alert(totalPayableAmount);
	function getCheckboxValues() {
	var totalPayableAmount = 0;
	var selectedPaperCode = document.querySelector('input[name="papercode"]:checked').value;
		// console.log("Selected Paper Code: " + selectedPaperCode);

        // Set the value to the input field with id "pcode"
	document.getElementById("pcode").value = selectedPaperCode;
    var checkboxes = document.getElementsByClassName('checkbox');
    
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
            totalPayableAmount += 250; // Assuming each checkbox adds 3000 to the total
        }
    }
    
    document.getElementById('result').innerHTML = 'Total Payable Amount is ' + totalPayableAmount+' &#8377;';
	
    return totalPayableAmount; // Return the total payable amount
}
document.querySelector('form').addEventListener('submit', function(event) {
    var totalPayableAmount = getCheckboxValues();
	
    if (totalPayableAmount === 0) {
        alert('Please select at least one subject');
        event.preventDefault(); // Prevent form submission if no subjects are selected
    }
});


</script>


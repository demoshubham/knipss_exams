
<?php 
session_start();
include("settings.php");
include("exam_crosslist_marksheet_functions.php");
$msg='';
// print_r($_POST);

// echo $_SESSION['username'];
$bank_reference_no=uniqid();
if(isset($_POST['mobno'])){
     $sql="INSERT INTO `exam_copy_recheck`(`exam_roll_no`,`papercode`,`course` ,`mobile_no`, `bank_trans_no`, `remark`) VALUES ('".$_POST['rollno']."','".$_POST['papercode']."','".$_POST['course']."','".$_POST['mobno']."','$bank_reference_no','".$_POST['remark']."')";
    // ,'".$_SESSION['username']."','".date("d-m-Y H:i:s")."'
    $res=mysqli_query($db,$sql);
    // if($res){
    //     echo "datainserted";
    // }
    
}
$appno=mysqli_insert_id($db);

$_POST['exam_roll_no']=$_POST['rollno'];
$_POST['result_course']=$_POST['course'];
$_POST['mobile_no']=$_POST['mobno'];


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
	$sql = 'SELECT `exam_student_info`.`sno` as id,`exam_student_info`.`student_name`,`exam_student_info`.`student_info_sno`,`exam_student_info`.`exam_roll_no`,`exam_student_info`.`dob`,`exam_student_info`.`uin_no`,`exam_student_info`.`course_name`,`student_info`.`father_name`,`student_info`.`mother_name`,`student_info`.`photo_id` FROM `exam_student_info` LEFT JOIN `student_info` ON `exam_student_info`.student_info_sno = `student_info`.sno where `exam_student_info`.`exam_roll_no` = "'.$_POST['exam_roll_no'].'" AND `exam_student_info`.`course_name` = "'.$_POST['result_course'].'" AND `exam_student_info`.`mobile_no` = "'.$_POST['mobile_no'].'"';

    // print_r($_POST);
		
	//$sql = 'SELECT `exam_student_info`.`sno` as id,`exam_student_info`.`student_name`,`exam_student_info`.`student_info_sno`,`exam_student_info`.`exam_roll_no`,`exam_student_info`.`dob`,`exam_student_info`.`uin_no`,`exam_student_info`.`course_name`,`student_info`.`father_name`,`student_info`.`mother_name`,`student_info`.`photo_id` FROM `exam_student_info` LEFT JOIN `student_info` ON `exam_student_info`.student_info_sno = `student_info`.sno where `exam_student_info`.`exam_roll_no` = "'.$_POST['exam_roll_no'].'"';
	
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
    
    <title>Print Challenge EVALUATION OF ANSWER BOOK </title>

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
			  .printButton {
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
  <div class="row">
    <div class="col-12 text-center">
        <a href="answer_sheet_reevaluation.php" class="btn btn-primary printButton">Back</a>
        <div class="btn btn-primary printButton" onclick="window.print();">Click Here to Print</div>

    </div>
</div>

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
		
            <table class="table table-borderless" width="100%" >
				<tr class="abc">
					<th class="text-center abc" colspan="5"><span style="font-size:1rem;">CHALLENGE TO EVALUATION OF ANSWER BOOK ( 2023-2024)</span></th>
				</tr>
                <tr class="abc">
                    <th class="abc">APPLICATON NO.</th>
                    <th class="abc"><?php echo $appno;?></th>
                    
                </tr>
                <tr class="abc">
                    <th class="abc">Bank Reference Number.</th>
                    <th class="abc"><?php echo $bank_reference_no;?></th>
                </tr>
                <tr class="abc">
                    <th width="20%" class="look abc ">Roll NO.</th>
					<th width="30%" class="look abc"><?php echo $row['exam_roll_no']; ?><?php //echo '--'.$row['dob']; ?></th >	
                </tr>
                <tr class="abc">
					<th width="20%" class="look abc">Name </th>
					<th width="30%" class="look abc"><?php echo strtoupper($row['student_name']);?> <?php //echo '--'.$row['id']; ?>	</th >
				</tr>
               
				<tr class="abc">
					<th class="look abc">Father's Name</th>
					<th class="look abc"><?php echo strtoupper($row['father_name']); ?></th >
				</tr>
				<tr class="abc">
					<th width="20%" class="look abc">Mobile Number </th>
					<th width="30%" class="look abc"><?php echo $_POST['mobile_no'];?> <?php //echo '--'.$row['id']; ?>	</th >
				</tr>
                <tr class="abc">
                    <th class="look abc">Course</th>
					<th class="look abc"><?php
							$sql_class = 'select * from class_detail where sno = "'.$row['course_name'].'"';
							$row_class = mysqli_fetch_assoc(mysqli_query($erp_link,$sql_class));
							echo $row_class['class_description']; 
						?>
					</th >
                </tr>
				<!-- <tr class="abc">
					<th class="look abc">Mother's Name</th>
					<th class="look abc"><?php //echo strtoupper($row['mother_name']); ?></th >
				</tr> -->
                <tr class="abc">
                    <th class="look abc">UIN NO.</th>
					<th class="look abc"><?php echo $row['uin_no']; ?></th >
                </tr>
				<tr class="abc">
					<th class="look abc">College</th>
					<th colspan="3" class="look abc">K.N.I.P.S.S. Sultanpur</th >
				
				</tr>
			</table>	
			<div class=" text-center" style="font-size:1.1rem">PAPER SELECTED FOR INSPECTION</div>
				<table class="table text-center" style="border:1px solid black; ">
					
					<?php
						$paperCodeArray = array();
                        $sql2 = 'SELECT * FROM exam_student_paper_info WHERE exam_student_info_sno = "'.$row['id'].'" and paper_code="'.$_POST['papercode'].'"';
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
                                
                                ?>
					<tr>    
                        <th  width="30%"  class="abc">SUBJECT</th>
                        <td><?php echo $row_subject['subject']; ?></td>
					</tr>
					<tr>
                        
                        <th  width="30%"  class="abc">PAPER CODE</th>
                        <td><?php echo $row2['paper_code']; ?></td>
					</tr>
					<tr>
                        
                        <th width="30%"  class="abc">PAPER TITLE</th>
                        <td><?php echo $row2['title_of_paper']; ?></td>
					</tr>
                    <tr>
                        
                        <th  class="abc" colspan="2">YOUR REQUEST HAS BEEN SUBMITTED SUCCESSFULLY , ACTION SHOULD BE TAKEN AS PER UNIVERSITY NORMS.</th>
                        
					</tr>
						<?php
									
								}
								$i++;
							}
						?>
				</table>
            </div>
		</div>
    <div>
  </body>
</html>
<?php
	}			
}else{
	
	
	?>

<?php
}
}
?>	
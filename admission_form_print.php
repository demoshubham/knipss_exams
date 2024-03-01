<?php
include("settings.php");
$response=1;
if(isset($_GET['id']) && $_GET['id']!=''){
    $sql = 'select * from admission_student_info where sno = '.$_GET['id'];
	//echo $sql;
	$result = execute_query($sql);
	
    if(mysqli_num_rows($result)!=0){
        $details = mysqli_fetch_assoc($result);
		//print_r($_POST['$details']);
		if($details['uin']!=''){
			echo 'Form already filled';
			die();
		}
		
		$sql = 'select * from new_student_info where sno="'.$details['student_id'].'"';
		//echo $sql;
		$student_info = mysqli_fetch_assoc(execute_query($sql));

    }
	else{
		echo 'Invalid Request';
		die();
	}
	
    
}

if(isset($_GET['finalsubmit'])){
	$sql = 'SELECT *, substr(uin, 4) as uin_no FROM `admission_student_info` order by abs(uin_no) desc limit 1';
	$result_last_uin = execute_query($sql);
	if(mysqli_num_rows($result_last_uin)!=0){
		$row_last_uin = mysqli_fetch_assoc($result_last_uin);
	}
	$uin_s = $row_last_uin['uin_no']+1;
	$uin = 'KNI'.$uin_s;
		
  $sql = 'update admission_student_info set uin = "'.$uin . '" where sno = '.$_GET['finalsubmit'];
  //echo $sql;
  $sql = execute_query($sql);
	
	$sql = 'select * from admission_student_info where sno="'.$_GET['finalsubmit'].'"';
	$admit_data = mysqli_fetch_assoc(execute_query($sql));
	
	$sql = 'select * from new_student_info where sno="'.$admit_data['student_id'].'"';
	//echo $sql;
	$student_info = mysqli_fetch_assoc(execute_query($sql));
	
	
	
  //echo '<script>alert("Dear Applicant, please note your UIN No. '.$uin.'")</script>';
  
   $sql1 = 'update register_users set uin_no = "'.$uin . '" where sno = '.$student_info['reg_user_sno'];
  //echo $sql1;
  $sql = execute_query($sql1);
  header('location: uin_print.php?id='.$_GET['finalsubmit'].'&uin='.$uin);
  //echo '<script>alert("Dear Applicant, please note your UIN No. '.$uin.'")</script>';
 // header('location: uin_print.php?id='.$_GET['finalsubmit'].'&uin='.$uin);
}

switch($response){
  case 1:

//$result = mysqli_query($db, $query);

	if(isset($_GET['edit'])){
	$sql= 'select * from admission_student_info where sno = '.$_GET['id'];
	$qry = mysqli_query($db, $sql);
	$res = mysqli_fetch_assoc($qry);
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
        font-size: .8rem !important;
      }
      td{
        font-size: .8rem !important;
      }
      th{
        font-size: .8rem !important;
      }
      @media print {
        *{
          margin: 0 !important;
          padding: 0 !important;
          box-sizing: border-box !important;
        }
       
        td{
          padding: 8px !important;
          /* margin: 10px !important; */
        }
        .print_no{
          display:none !important;
        }
        .testing{
          margin-top: 55px !important;
          /* white-space: nowrap; */
        }
        .testing2{
          display:block !important;
          width:100% !important;
          text-align: center !important;
          /* margin:0 auto !important; */
          margin-left: 200px !important;
          
        }
		#overlays{
			width:60%!important;
			margin-bottom:!important;
		}
		

      }
      /* @page{
        size: A4;
        margin-inline:0;
        padding: 0;
      } */
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
  <img src="images/logo.png"  id="overlays" style=" z-index:0;opacity:0.15;position: absolute;top: 50%;left: 50%;-ms-transform: translate(-50%, -50%);transform: translate(-50%, -50%); width:30%;" alt="overlay image" >
    <div class="container-fluid m-auto cont ">
      <div class="container-fluid border">
        <table width="100%">
			<tr >
				<th width="15%" rowspan="3"><img style="height:80px; Width:80px;" src="images/logo.gif" alt="logo" class="img-fluid   m-1" /></th>
				<th width="85%"><h3 class="" style="text-align: center; margin:0px; "><strong>Kamla Nehru Institute of Physical & Social Sciences,Sultanpur, Uttar Pradesh</strong></h3></th>
			</tr>
			<tr>
				<th width="85%"><h4 style="text-align: center; margin-bottom:0px;"><b>An Autonomous Institute And Accredited "A" Grade by NAAC</b></h4></th>
			</tr>
			<tr>
				<th width="85%"></th>
			</tr>
		</table><br>
        <div class="container d-flex justify-content-center">
          <h5 class="testing2" style="text-decoration: underline;">Unique Identification Number –2023</h5>
        </div>
        <br>
        <!-- <hr> -->
        <div class="table-responsive">
          <table class="table table-bordered table-light">
            <thead>
              <tr>
                <th scope="col">APPLICATION NUMBER</th>
				<?php
				$sql_user_app = 'select * from register_users where sno = "'.$student_info['reg_user_sno'].'"';
				//echo $sql_user_app;
				$result_user_app = execute_query($sql_user_app);
						if(mysqli_num_rows($result_user_app)!=0){
							$row_user_app = mysqli_fetch_assoc($result_user_app);
							$user_app = $row_user_app['user_name'];
						}
						else{
							$user_app = '';
						}
				
				?>
                <th scope="col" colspan="2"><?php echo $user_app ?></th>
                <th scope="col">TRANSACTION ID</th>
				<?php
				$sql_user_app = 'select * from register_users where sno = "'.$student_info['reg_user_sno'].'"';
						$result_user_app = execute_query($sql_user_app);
						if(mysqli_num_rows($result_user_app)!=0){
							$row_user_app = mysqli_fetch_assoc($result_user_app);
							$user_tran = $row_user_app['transaction_no'];
						}
						else{
							$user_tran = '';
						}
				
				?>
                <th scope="col"><?php echo  $user_tran ?></th>
                
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">COURSE APPLIED FOR</th>
                <td colspan="4">
                  <?php
				 // echo 'select * from mst_course where sno='. $details['course_applying_for'];
                    echo mysqli_fetch_assoc(execute_query('select * from mst_course where sno="'. $details['course_applying_for'].'"'))['course_name'];?>
                </td>
              </tr>
              <tr>
                <th scope="row">APPLICANT NAME</th>
                <td colspan="3"><?php echo $details['candidate_name'] ?></td>
                <td><strong>Gender</strong> : <?php echo $details['gender'] ?></td>
              </tr>
              <tr>
                <th scope="row">FATHER'S NAME</th>
                <td colspan="2" ><?php echo $details['father_name'] ?></td>
                <th scope="row">MOTHER'S NAME</th>
                <td ><?php echo $details['mother_name'] ?></td>
              </tr>
                <tr>
                <th scope="row">DATE OF BIRTH</th>
                <td><?php echo $details['dob'] ?></td>
                <td><strong>RELIGION :</strong> <?php echo $details['religion'] ?></td>
                <th > CATEGORY :</th>
                <td > <?php echo $details['category'] ?></td>
                  
              </tr>
              <tr>
                <th scope="row">EMAIL</th>
                <td ><?php echo $details['email'] ?></td>
				<td ><strong>MOBILE:</strong> <?php echo $details['mobile'] ?> </td>
                <th scope="row">Whatsapp Number:</td>
                <td >   <?php echo $details['caste'] ?></td>
              </tr>
              <tr>
                <th scope="row">PARENT'S Mobile No:</th>
                <td colspan="2"><?php echo $details['parent_income'] ?></td>
                <th scope="row">DOMICILE :</td>
					<?php
				$sql_domicile = 'select * from mst_domicile where sno = "'.$details['domicile'].'"';
						$result_domicile = execute_query($sql_domicile);
						if(mysqli_num_rows($result_domicile)!=0){
							$row_domicile = mysqli_fetch_assoc($result_domicile);
							$domicile = $row_domicile['domicile'];
						}
						else{
							$domicile = '';
						}
				
				?>
                <td ><?php echo $domicile ?></th>
              </tr>
              <tr>
                <th scope="row">MOTHER TONGUE</th>
                <td colspan="2"><?php echo $details['mother_tongue'] ?></td>
                <th scope="row">WEIGHTAGE :</td>
                <td > <?php echo $details['weightage'] ?></th>
              </tr>
              <tr>
                <th scope="row">AADHAR CARD NUMBER</th>
                <td colspan="2"><?php echo $details['aadhar'] ?></td>
                <th scope="row">BLOOD GROUP</th>
                <td > <?php echo $details['blood_group'] ?></td>
              </tr>
            </tbody>
          </table>
        </div>

       <p class="edu_detail_head"><strong>EDUCATIONAL DETAILS</stron g></p>
       <div class="table-responsive">
         <table class="table table-bordered">
          <tr>
            <th scope="col">NAME OF EXAMINATION</th>
            <th scope="col" >COLLEGE/ SCHOOL NAME</th>
            <th scope="col">BOARD/UNIVERSITY</th>
            <th scope="col">YEAR OF PASSING</th>
            <th scope="col">ROLL NUMBER</th>
            <th scope="col">MAX MARKS</th>
            <th scope="col">OBTAINED MARKS</th>
            <th scope="col">PERCENTAGE/CGPA</th>
          </tr>
          <?php 
            $sql =execute_query('select * from admission_qualification where d_student_info_sno='.$details['sno']);
            if($sql){
              while($row = mysqli_fetch_assoc($sql)){
             ?>

          <tr>
            <td>
              <?php 
               if(is_numeric($row['name_of_examination'])){
                  echo mysqli_fetch_assoc(execute_query('select * from class_detail where sno = '.$row['name_of_examination']))['class_description'];
               }
               else{
                echo $row['name_of_examination'];
               }
            
            ?>
          </td>
            <td> <?php echo $row['college_name'] ?></td>
            <td> <?php echo $row['board_university_name'] ?></td>
            <td> <?php echo $row['year'] ?></td>
            <td><?php echo $row['roll_no'] ?></td>
            <td><?php echo $row['total_marks'] ?></td>
            <td><?php echo $row['obtained_marks'] ?></td>
            <td><?php if ($row['percentage'] != ''){
						echo $row['percentage'];
					}
				else{
						echo $row['cgpa'];
					}?>
			</td>
          </tr> 

          <?php
           }

          }
        
        ?>
         </table>
       </div>
       <!-- <div class="table-responsive">
        <table class="table table-bordered">
          <tr>
            <th>S.No</th>
            <th>Subject/Paper</th>
            <th>Obt Marks</th>
            <th>Max Marks</th>
          </tr>
          <tr>
            <td>1</td>
            <td>ENGLISH</td>
            <td>75</td>
            <td>100</td>
          </tr>
          <tr>
            <td>2</td>
            <td>PHYSICS</td>
            <td>75</td>
            <td>100</td>
          </tr>
          <tr>
            <td>3</td>
            <td>CHEMISTRY</td>
            <td>55</td>
            <td>100</td>
          </tr>
          <tr>
            <td>4</td>
            <td>BIOLOGY</td>
            <td>57</td>
            <td>100</td>
          </tr>
          <tr>
            <td>5</td>
            <td>OPTED(MATHEMATICS) IN HIGH SCHOOL</td>
            <td>71</td>
            <td>100</td>
          </tr>
          <tr>
            <td>6</td>
            <td>GENERAL HINDI</td>
            <td>63</td>
            <td>100</td>
          </tr>
        </table>
       </div> -->
       <div class="table-responsive">
        <table class="table table-bordered">
          <tr>
            <td class="col-4">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <tr>
                    <td>
                      <strong>APPLICATION PHOTOGRAPH</strong>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <img src="<?php echo  $details['photo'] ?>" alt="person Pic" class="img-fluid " style="width: 40%;">
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <strong> APPLICANT SIGNATURE</strong>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <img src="<?php echo $details['signature'] ?>" alt="signature" class="img-fluid" style="width: 80%; height: 60px;">
                    </td>
                  </tr>
                </table>
              </div>

            </td>
            <td class="col-8">
              <div class="table-responsive">
              <?php 
              $sql =execute_query('select * from admission_address where d_student_info_sno='.$details['sno'].' and type_of_address= "permanent"');
              if($sql){
                $address = mysqli_fetch_assoc($sql)

             ?>
                <table class="table table-bordered">
                  <tr>
                    <td>
                      <u> <strong> NAME AND COMPLETE MAILING ADDRESS OF APPLICANT </strong> </u>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <?php echo $details['candidate_name']. ' C/O '. $details['father_name']?>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <strong>ADDRESS.: <?php echo $address['address'] ?>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <strong>POST OFFICE :</strong> <?php echo $address['post'] ?> ,<strong>THANA : </strong> <?php echo $address['thana'] ?>, <strong>DISTRICT/CITY : </strong> <?php echo $address['district'] ?>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <strong>STATE :</strong> <?php echo $address['state'] ?> , <strong>PIN CODE: </strong><?php echo $address['pin'] ?>
                    </td>
                  </tr>
                </table>
                <?php
                }
                ?>
              </div>
            </td>
          </tr>
        </table>
       </div>

       <div class="table-responsive">
        <table class="table table-bordered">
          <tr>
            <td>
              <div class="print_no container d-flex justify-content-center">
				<a href="admission_form.php?edit=<?php echo $details['sno'].'&id='.$row_user_app['sno']?>" class="btn btn-success"> Go back to Edit</a>
					<input type="hidden" name="edit" value="<?php echo isset($_GET['edit'])? $res['sno']: '' ?>">
				<!-----
                <button type="button" class="btn  m-2  px-3 btn-success">Go back to Edit</button>
				------>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="form-check testing">
                <input class="form-check-input" type="checkbox"  id="final_check" name="final_check"  />
                <label class="form-check-label" for="flexCheckDefault" >
                  I HAVE CAREFULLY READ THE INSTRUCATIONS TO FILL THE FORM AND CHECKED ALL THE ENTERIES CAREFULLY.THEY ARE CORRECT TO BEST OF MY BEFIEF AND KNOWLEDGE . I WANT TO SUMBIT UNIQUE IDENTIFICATION NUMBER FORM.
                </label><br>
                <button type="button" class="btn btn-danger   m-2 px-3"  onclick="uin()">Final Submit</button>
              </div>
              
            </td>
          </tr>
        </table>
       </div>
      </div>
    </div>

    <script>
      function uin(){
		  finalcheck = document.getElementById('final_check').checked;
		  if(finalcheck == true){
			alert('Are you sure you want to submit. After final submit the form cannot be further modified');
			window.location.assign('<?php echo $_SERVER['PHP_SELF'].'?finalsubmit='.$details['sno'] ?>');
		  }
		  else{
			  alert('Please click on the checkbox');
		  }
        
      }

    </script>
    <script
    
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
<?php 
    break;
  case 2:


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
					<!-- <h5 style="font-size: 15px; font-weight: 600; color:red;">Please fill all mandatory field</h5> -->
				</section>
				<form action="" class="wufoo leftLabel page1" name="admission_newadmission" enctype="multipart/form-data" method="post" onSubmit="" >	
					<?php   
						$sql = execute_query('select * from register_users where sno = "'.$_GET['finalsubmit'].'"',dbconnect());
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
								<h5 class="row d-flex"><strong>UIN No. :</strong></h5>
							</div>		
							<div class="col md-4 h5"><?php echo $uin ?></div>		
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
				<a href="" class=" btn btn-primary" >Print</a>
				
				</div>
			</div>
		</div>
	</div>
</div> 


<?php 
break;
  }
  page_footer();
  ob_end_flush();
?>
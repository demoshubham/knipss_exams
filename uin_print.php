<?php
include("settings.php");

if(isset($_GET['id']) && $_GET['id']!=''){
    if(isset($_GET['uin'])){
        $sql = 'select * from register_users where uin_no="'.$_GET['uin'].'"';
    }
    else{
        $sql = 'select * from register_users where sno="'.$_GET['id'].'"';    
    }
    //echo $sql;
    $register = mysqli_fetch_assoc(execute_query($sql));
    
    $sql = 'select * from new_student_info where reg_user_sno="'.$register['sno'].'"';
    $stud_info2 = mysqli_fetch_assoc(execute_query($sql));
    
    $sql = execute_query('select * from admission_student_info where student_id = '.$stud_info2['sno']);
    if($sql){
        $details = mysqli_fetch_assoc($sql);
		
		$sql = 'select * from new_student_info where sno="'.$details['student_id'].'"';
		$student_info = mysqli_fetch_assoc(execute_query($sql));
    }
    
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
       body{
        padding:3rem!important;
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
        .btn-print{
          display: none;
        }
        #overlays{
          width:60%!important;
          margin-bottom:!important;
          top: 40%!important;
        }
        #overlays2{
        
          width:60%!important;
          top: 90%!important;
          left: 50%!important;
          -ms-transform: translate(-0%, -50%)!important;
          transform: translate(-50%, 50%)!important;
			
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
    <div class="container-fluid m-auto cont " style="page-break-after: always;">
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
				<th width="88%"><h4 class="" style="text-align: center; margin:0px; " ><span style="font-size:17px;"><b>Kamla Nehru Institute Of Physical & Social Sciences,Sultanpur, Uttar Pradesh</b></span> <br>An Autonomous Institute And Accredited "A" Grade by NAAC</h4></th>
			</tr>
		</table>
		<div class="row">
			<div class="container d-flex justify-content-center">
			  <p style="text-decoration: underline; text-align;center;">UNIQUE IDENTIFICATION NUMBER REGISTRATION - 2023 (COLLEGE COPY)</p>
			</div>
		</div>
        <br>
        <!-- <hr> -->
        <div class="table-responsive m-2">
          <table  width="100%" class="table table-striped table-hover rounded">
        
              <tr>
                <th scope="col" width="20%">UIN NO.:</th>
                <th scope="col"  width="20%"><?php echo $details['uin'] ?><?php //echo $_GET['uin'] ?></th>
                <th scope="col" width="20%">TRANSACTION ID</th>
				
                
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
				<th rowspan="3" colspan="2" width="20%"><img src="<?php echo  $details['photo'] ?>" alt="person Pic" class="img-fluid " style="width:120px; height: 100px; float: right; margin-right: 10px;" ></th>
              </tr>
              <tr>
                <td scope="row"><b>COURSE NAME:</b></td>
                <td colspan="3">
                  <?php
                    echo mysqli_fetch_assoc(execute_query('select * from mst_course where sno='. $details['course_applying_for']))['course_name'];
                  
                  ?>
                </td>
              </tr>
              <tr>
                <th >APPLICANT NAME</th>
                <td ><?php echo $details['candidate_name'] ?></td>
				<td scope="row"><b>DATE OF BIRTH</b></td>
                <td><?php echo date('d-m-Y',strtotime($details['dob'])) ?></td>
                
              </tr>
              <tr>
                <th scope="row">FATHER'S NAME</th>
                <td colspan="2" ><?php echo $details['father_name'] ?></td>
				<th>Gender</th>
                <td colspan="2"> <?php echo $details['gender'] ?></td>
                
              </tr>
                <tr>
				<th scope="row">MOTHER'S NAME</th>
                <td colspan="2"><?php echo $details['mother_name'] ?></td>
                <th>RELIGION : </th>
                <td colspan="2"><?php echo $details['religion'] ?></td>
              </tr>
              <tr>
				<th scope="row">EMAIL</th>
				<td colspan="2"><?php echo '******' . substr($details['email'], -12); ?></td>
				<th>MOBILE :</th>
				<td colspan="2"><?php echo '*******' . substr($details['mobile'], -3); ?></td>
			</tr>

			  <tr>
				<th >CATEGORY :</th>
				<td colspan="2"> <?php echo $details['category'] ?></td>
                 <th></th>
                 <th></th>
			  </tr>
            
           
          </table>
        </div>
	<table  width="100% " style="margin:10px">
		<tr >
			<td>
			  <hr><br>
			  <h4 align="center"><b>DECLARATION</b></h4>
			  <hr>
			  <p>I, <strong><?php echo $details['candidate_name'] ?></strong> HEREBY DECLARE THAT ALL STATEMENTS MADE IN THIS APPLICATION ARE TRUE AND CORRECT TO THE BEST OF MY KNOWLEDGE AND BELIEF. IN CASE IF ANY INFORMATION IS BEING FOUND FALSE OR INCORRECT OR ANY IRREGULARITY IS BEING DETECTED ANY STAGE, MY CANDIDATURE IS LIABLE TO BE CANCELLED AND ACTION MAY BE INITIATED AGAINST ME. I UNDERSTAND THAT, IF MY APPLICATION IS FOUND INCOMPLETE IN ANY MANNER, THE SAME WILL BE REJECTED.</p>
			</td>

			
		</tr>
		<tr>
			<th style="text-align:right; margi-right:10px;"><img src="<?php echo $details['signature'] ?>" alt="signature" class="img-fluid" style="width: 20%; height: 60px;"><br>SIGNATURE OF APPLICANT</th>
		</tr>
		<tr>
			<th><hr>PRINTED ON: <?php echo date('d-m-Y')?></th>
		</tr>
		<tr>
			<td><hr><br><h4 align="center"><b>DISCLAIMER</b></h4>
		<hr>
		<h6>It is mandatory to submit UIN registration along with admission fee receipt (Duplicate Copy) in the Account Section.</h6></td>
		</tr>
	</table >
    </div>
</div>

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
		<img src="images/logo.png"  id="overlays2" style=" z-index:-2;opacity:0.2;position: absolute;top: 180%;left: 50%;-ms-transform: translate(-180%, -50%);transform: translate(-50%, -50%); width:30%;" alt="overlay image" >
		<table width="100%" style="margin:0px;">
			<tr>
				<th width="12%" rowspan="2"><img style="padding:15px; height:65px; width:65px; " src="images/logo.png" alt="logo" class="img-fluid d-block m-auto" /> </th>
				<th width="88%"><h4 class="" style="text-align: center; margin:0px; " ><span style="font-size:17px;"><b>Kamla Nehru Institute Of Physical & Social Sciences,Sultanpur, Uttar Pradesh</b></span> <br>An Autonomous Institute And Accredited "A" Grade by NAAC</h4></th>
			</tr>
		</table>
		<div class="row">
			<div class="container d-flex justify-content-center">
			  <p style="text-decoration: underline; text-align;center;">UNIQUE IDENTIFICATION NUMBER REGISTRATION - 2023 (STUDENT COPY)</p>
			</div>
		</div>
        <br>
        <!-- <hr> -->
        <div class="table-responsive m-2">
          <table  width="100%" class="table table-striped table-hover rounded">
        
              <tr>
                <th scope="col" width="20%">UIN NO.:</th>
                <th scope="col"  width="20%"><?php echo $details['uin'] ?><?php //echo $_GET['uin'] ?></th>
                <th scope="col" width="20%">TRANSACTION ID</th>
                <th scope="col"><?php echo  $user_tran ?></th>
				<th rowspan="3" colspan="2" width="20%"><img src="<?php echo  $details['photo'] ?>" alt="person Pic" class="img-fluid " style="width:120px; height: 100px; float: right; margin-right: 10px;" ></th>
              </tr>
              <tr>
                <td scope="row"><b>COURSE NAME:</b></td>
                <td colspan="3">
                  <?php
                    echo mysqli_fetch_assoc(execute_query('select * from mst_course where sno='. $details['course_applying_for']))['course_name'];
                  
                  ?>
                </td>
              </tr>
              <tr>
                <th >APPLICANT NAME</th>
                <td ><?php echo $details['candidate_name'] ?></td>
				<td scope="row"><b>DATE OF BIRTH</b></td>
                <td><?php echo date('d-m-Y',strtotime($details['dob'])) ?></td>
                
              </tr>
              <tr>
                <th scope="row">FATHER'S NAME</th>
                <td colspan="2" ><?php echo $details['father_name'] ?></td>
				<th>Gender</th>
                <td colspan="2"> <?php echo $details['gender'] ?></td>
                
              </tr>
                <tr>
				<th scope="row">MOTHER'S NAME</th>
                <td colspan="2"><?php echo $details['mother_name'] ?></td>
                <th>RELIGION : </th>
                <td colspan="2"><?php echo $details['religion'] ?></td>
              </tr>
            <tr>
				<th scope="row">EMAIL</th>
				<td colspan="2"><?php echo '******' . substr($details['email'], -12); ?></td>
				<th>MOBILE :</th>
				<td colspan="2"><?php echo '*******' . substr($details['mobile'], -3); ?></td>
			</tr>

			  <tr>
				<th >CATEGORY :</th>
				<td colspan="2"> <?php echo $details['category'] ?></td>
                 <th></th>
                 <th></th>
			  </tr>
            
           
          </table>
        </div>
	<table  width="100% " style="margin:10px">
		<tr >
			<td>
			  <hr><br>
			  <h4 align="center"><b>DECLARATION</b></h4>
			  <hr>
			  <p>I, <strong><?php echo $details['candidate_name'] ?></strong> HEREBY DECLARE THAT ALL STATEMENTS MADE IN THIS APPLICATION ARE TRUE AND CORRECT TO THE BEST OF MY KNOWLEDGE AND BELIEF. IN CASE IF ANY INFORMATION IS BEING FOUND FALSE OR INCORRECT OR ANY IRREGULARITY IS BEING DETECTED ANY STAGE, MY CANDIDATURE IS LIABLE TO BE CANCELLED AND ACTION MAY BE INITIATED AGAINST ME. I UNDERSTAND THAT, IF MY APPLICATION IS FOUND INCOMPLETE IN ANY MANNER, THE SAME WILL BE REJECTED.</p>
			</td>

			
		</tr>
		<tr>
			<th style="text-align:right; margi-right:10px;"><img src="<?php echo $details['signature'] ?>" alt="signature" class="img-fluid" style="width: 20%; height: 60px;"><br>SIGNATURE OF APPLICANT</th>
		</tr>
		<tr>
			<th><hr>PRINTED ON: <?php echo date('d-m-Y')?></th>
		</tr>
		<tr>
			<td><hr><br><h4 align="center"><b>DISCLAIMER</b></h4>
		<hr>
		<h6>It is mandatory to submit UIN registration along with admission fee receipt (Duplicate Copy) in the Account Section.</h6></td>
		</tr>
	</table >
    </div>
</div>
	
     
  </body>
</html>

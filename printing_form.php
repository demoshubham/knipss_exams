<?php
date_default_timezone_set('Asia/Calcutta');
session_cache_limiter('nocache');
session_start();
include("settings.php");
include("get_computer.php");
logvalidate('','');
$sql = "select * from register_users where user_name='".$_SESSION['username']."'";
$student=mysqli_fetch_array(execute_query($sql,dbconnect()));
$_GET['id'] = $student['sno'];
if(isset($_GET['id'])){
	$sql= 'select * from student_info where sno="'.$_GET['id'].'"';
	$stu_id=mysqli_fetch_array(execute_query($sql,dbconnect()));
	
	$sql = "select * from register_users where sno=".$_GET['id'];
	$student=mysqli_fetch_array(execute_query($sql,dbconnect()));
}
$sql_sec = 'select * from class_detail where sno="'.$stu_id['class'].'"';
$res_sec = mysqli_fetch_array(execute_query($sql_sec,dbconnect()));

$sql="select * from add_subject where sno=".$stu_id['sub1']."";
$sub1 = mysqli_fetch_array(execute_query($sql,dbconnect()));

$sql="select * from add_subject where sno=".$stu_id['sub2']."";
$sub2 = mysqli_fetch_array(execute_query($sql,dbconnect()));

$sql="select * from add_subject where sno=".$stu_id['sub3']."";
$sub3 = mysqli_fetch_array(execute_query($sql,dbconnect()));

$sql="select * from fees_invoice where student_id=".$stu_id['sno']." and status='Success'";
//echo $sql;
$inv_id = execute_query($sql,dbconnect());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<style type="text/css">
	@media print {
		input#btnPrint {
			display: none;
		}	
	}
	body{width: 200mm; height: 280mm; font-family: Calibri; font-size: 12px;}
	td, th{height:30px; padding-left: 5px;}
	tr:nth-child(odd) {background: #ccc;}
	.label{font-weight: bold;}
	#container{margin-left: 20px; width: 185mm; border: 1px solid; border-radius: 10px; padding: 5px;}
</style>
<script language="javascript" type="text/javascript">
//window.print();
</script>
</head>

<div id="container" class="ltr" style="float:none;">
	<h1 style="text-align: center; border: 0px solid; margin-top: 0px;">
	<div style="margin: 0px; float: left;"><img src="images/clogo.gif" height="100"></div>
	Kamla Nehru Institute Of Physical & Social Sciences, Sultanpur (U.P.)</h1>
	<h2 style="text-align: center;"><?php if($stu_id['status']!=1){ echo 'Unverified  &nbsp;'; }?>Admission Form</h2>
		<table width="100%" border="0">
			<tr>
				<th width="35%" colspan="2">Registration Number :</td>
				<th width="20%"><?php echo $student['user_name'];?></th>
				<td width="20%">&nbsp;</td>
				<td colspan="2" rowspan="4" align="right" style="background: #fff; text-align: center;"><img style="height:150px;width:125px;" src="user_images/<?php echo $stu_id['sno'];?>.jpg"></td>
			</tr>
			<tr>
				<td class="label">Course</td>
				<td class="highlight"><?php if(isset($stu_id['class'])){echo get_class_detail($stu_id['class']) ['class_description']; } ?>
				</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr >
				<td class="label">
				 Subjects
				</td>
				<td class="highlight">
					1).&nbsp;<?php if(isset($stu_id['sub1'])){echo get_subject_detail($stu_id['sub1']) ['subject']; } ?>
				</td>
				<td class="highlight">
					2).&nbsp;<?php if(isset($stu_id['sub2'])){echo get_subject_detail($stu_id['sub2']) ['subject']; } ?>
				</td>
				<td class="highlight">					
					3).&nbsp;<?php if(isset($stu_id['sub3'])){echo get_subject_detail($stu_id['sub3']) ['subject']; } ?>
				</td>
				
			</tr>
			<tr>
				<td class="label">Student Name</td>
				<td class="highlight"><?php if(isset($stu_id['stu_name'])){echo $stu_id['stu_name']; } ?></td>
				<td class="label">Father Name</td>
				<td class="highlight"><?php if(isset($stu_id['father_name'])){echo $stu_id['father_name']; } ?></td>
			</tr>
			<tr>
				<td class="label">Gender</td>
				<td class="highlight"> <?php if($stu_id['gender']=="M"){
						 		echo 'Male';
							 }
							else{ 
								echo 'Female';
							}
					?>
				</td>
				<td class="label">Date of Birth</td>
				<td class="highlight"><?php echo date("d-m-Y", strtotime($stu_id['dob']))?></td>
			</tr>
			<tr>
				<td class="label">Mother Name</td>
				<td class="highlight"><?php if(isset($stu_id['mother_name'])){echo $stu_id['mother_name']; } ?></td>
				<td class="label">Category</td>

				<td class="highlight">
				<?php if($stu_id['category']=="GEN"){ echo 'GENERAL ';}?>
				 <?php if($stu_id['category']=="OBC"){ echo 'OBC ';}?>
				 <?php if($stu_id['category']=="SC"){ echo 'SC';}?>
				 <?php if($stu_id['category']=="ST"){ echo 'ST';}?>
				</select>								
				</td>
			</tr>
			<tr>
				<td class="label">Religion</td>
				<td class="highlight">
				
				<?php if($stu_id['religion']=="HINDU"){ echo 'HINDU';}?>
				<?php if($stu_id['religion']=="MUSLIM"){ echo 'MUSLIM ';}?>
				<?php if($stu_id['religion']=="HINDSIKH"){ echo 'SIKH';}?>
				<?php if($stu_id['religion']=="CHRISTIAN"){ echo 'CHRISTIAN';}?>
				<?php if($stu_id['religion']=="OTHER"){ echo 'OTHER';}?>
												
				</td>
				<td class="label">Caste</td>
				<td class="highlight"><?php if(isset($stu_id['caste'])){echo $stu_id['caste']; } ?></td>
			</tr>
			<tr>
				<td class="label">Nationality</td>
				<td class="highlight">
				<?php if(isset($stu_id['nationality'])){echo $stu_id['nationality']; } ?>								
				</td>
				<td class="label">Minority</td>
				<td class="highlight">
				<?php if($stu_id['minority']=="NO"){ echo 'NO';}?>
				<?php if($stu_id['minority']=="YES"){ echo 'YES';}?>
				</td>
			</tr>
			<tr>
            </li>
				<td class="label">Address/Village</td>
				<td class="highlight"><?php if(isset($stu_id['perm_address'])){echo $stu_id['perm_address']; } ?></td>
				<td class="label">Post</td>
				<td class="highlight"><?php if(isset($stu_id['p_post'])){echo $stu_id['p_post']; } ?></td>
			</tr>
			<tr>
				<td class="label">District</td>
				<td class="highlight"><?php if(isset($stu_id['p_district'])){echo $stu_id['p_district']; } ?></td>
				<td class="label">State</td>
				<td class="highlight"><?php if(isset($stu_id['p_state'])){echo $stu_id['p_state']; } ?>
			</tr>
			<tr>
				<td class="label">Email</td>
				<td class="highlight"><?php if(isset($stu_id['e_mail1'])){echo $stu_id['e_mail1']; } ?></td>
				<td class="label">Mobile No.</td>
				<td class="highlight"><?php if(isset($stu_id['mobile'])){echo $stu_id['mobile']; } ?></td>
			</tr>
			<tr>
				<td class="label">Pin</td>
				<td class="highlight"><?php if(isset($stu_id['p_pin'])){echo $stu_id['p_pin']; } ?>
				</td>
				<td class="label">Alternate Mobile</td>
				<td class="highlight"><?php if(isset($stu_id['p_mobile'])){echo $stu_id['p_mobile']; } ?>
				</td>
			</tr>
			<tr>
			<td class="label">Father Occupation</td>
			<td class="highlight"><?php if(isset($stu_id['f_occupation'])){echo $stu_id['f_occupation']; } ?>
			</td>
			<td class="label">Mother Occupation </td>
			<td class="highlight"><?php if(isset($stu_id['m_occupation'])){echo $stu_id['m_occupation']; } ?>
			</td>
			</tr>

			<tr>
			<td class="label">Father Qualification</td>
			<td class="highlight"><?php if(isset($stu_id['f_qualification'])){echo $stu_id['f_qualification']; } ?>
			</td>
			<td class="label">Mother Qualification</td>
			<td class="highlight"><?php if(isset($stu_id['m_qualification'])){echo $stu_id['m_qualification']; } ?>
			</td>
			</tr>
		</table>
		<table>
			<tr>
				<th>S.No</th>
				<th>Name Of Examination</th>
				<th>Board/University Name</th>
				<th>College Name</th>
				<th>Year</th>
				<th>Roll No</th>
				<th>Obtained Marks</th>
				<th>Total Marks</th>
				<th>%</th> 
				<th>Division</th>
				<th>Status</th>                 
			</tr>
			<?php
			   $i=1;
			   $tab=8;
			   $sql = 'SELECT * from qual_detail where student_id="'.$stu_id['sno'].'"';
			   $result_trans = execute_query($sql,dbconnect());
			   while($row = mysqli_fetch_array($result_trans)){
			   ?>
				<tr><td class="highlight"><?php echo $i; ?></td>
					<td class="highlight"><?php echo $row['exam_name']; ?></td>
					<td class="highlight"><?php echo $row['board']; ?></td>
					<td class="highlight"><?php echo $row['univ_name']; ?></td>
					<td class="highlight"><?php echo $row['year']; ?></td>
					<td class="highlight"><?php echo $row['roll_no']; ?></td>
				    <td class="highlight"><?php echo $row['obt_marks']; ?></td>
					<td class="highlight"><?php echo $row['tot_marks']; ?></td>
					<td class="highlight"><?php echo $row['percentage']; ?></td>
					<td class="highlight"><?php echo $row['division']; ?></td>
					<td class="highlight">
                    <?php if($row['status']=="Passed"){ echo 'Passed';}?>
					<?php if($stu_id['status']=="Failed"){ echo 'Failed';}?>
					</td>
				</tr>
				<?php
					$i++;
				 }
				 ?>
			</table>
            <table>
        	<tr>
            	<td class="label highlight" colspan="3"><b>Weightage  
                 Passed Qualifying Exam From  </b>   		
                 <?php if($stu_id['prev_univ']=="awadh"){ echo 'Dr.R.M.L.Awadh University';}?>
                 <?php if($stu_id['prev_univ']=="knipss"){ echo 'KNIPSS';}?>
                 </td>
            </tr>
            <tr>
            	<td class="label highlight" colspan="3"><b>NCC-</b>       
                <?php if($stu_id['ncc']=="NCC"){ echo 'Yes';} else{ echo 'No';}?>
                &nbsp;&nbsp;&nbsp;&nbsp;<b>NSS-</b>       
                <?php if($stu_id['nss']=="NSS"){ echo 'Yes';} else{ echo 'No';}?>
                &nbsp;&nbsp;&nbsp;&nbsp;<b>SCOUT & GUIDE-</b>        
                <?php  if($stu_id['scout']=="SCOUT"){ echo 'Yes';} else{ echo 'No';} ?>
                &nbsp;&nbsp;&nbsp;&nbsp;<b>SPORTS-</b>       
                <?php if($stu_id['sports']=="SPORTS"){ echo 'Yes';} else{ echo 'No';}?>
                &nbsp;&nbsp;&nbsp;&nbsp;<b>PH-</b>       
                <?php if($stu_id['ph']=="PH"){ echo 'Yes';} else{ echo 'No';}?>
                &nbsp;&nbsp;&nbsp;&nbsp;<b>FF-</b>        
                <?php if($stu_id['ff']=="FF"){ echo 'Yes';} else{ echo 'No';}?>
				</td>
          </tr> 
          <tr>
                <td class="label highlight" colspan="3"><b>Dept. Of KNIPSS/Dr. RMLA University Employees/Teachers-</b>       
                	<?php  if($stu_id['dept']=="YES"){ echo 'Yes';} else{ echo 'No';}?>
                </td>
          </tr>
          <tr>
          		<td class="label highlight" colspan="3">
                <b>DECLARATION-
                I hereby declare that all information given above are true to the best of my knowledge.If any information given by me is found false,my admission is liable to be cancelled.</b></td>
         </tr>
         <tr>
			<?php
			 $case=0;
			if(mysqli_num_rows($inv_id)==0){
				echo '<td colspan="2" rowspan="3"><h2>Fees Not Deposited.</h2></td>';
			}
			elseif(mysqli_num_rows($inv_id)>1){
				echo '<td colspan="2" rowspan="3"><h2>Multiple Payments.</h2></td>';
			}
			else{
				$case=1;
				$inv_id = mysqli_fetch_array($inv_id);
				echo '<td>Order ID : <strong>'.$inv_id['order_id'].'</strong></td>
				<td>Form Submitted on : <strong>'.date("d-m-Y", strtotime($stu_id['date_of_admission'])).'</strong></td>';
			}

			?>					
				<td class="label highlight" style="text-align:right;" rowspan="3" width="10%"><img height="50" width="200" src="user_images/<?php echo $stu_id['sno'];?>_sign.jpg"><input name="profile_name" value="" type="hidden"><br />Student's Signature
                </td>
          </tr>
          <?php
			if($case==1){
				echo '<tr></tr>
				<tr><td>Amount : <strong>'.($inv_id['amount']/100).'</strong></td>
				<td>Deposited On : <strong>'.date("d-m-Y H:i:s", strtotime($inv_id['txnreqdate'])).'</strong></td>
				</tr>';
			}		
		  ?>
		  </table>
		</div>
</body>
</html>
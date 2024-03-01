<?php
date_default_timezone_set('Asia/Calcutta');
session_cache_limiter('nocache');
session_start();
include("settings.php");
include("get_computer.php");
logvalidate('','');
if(!isset($_GET['sid'])){
	if(isset($_POST['id'])){
		$_GET['sid'] = $_POST['student_id'];
	}
}
//print_r($_POST);
if(isset($_GET['sid'])){
	$sql = 'select * from register_users where sno="'.$_GET['sid'].'"';
	//echo $sql;
	$register_user = mysqli_fetch_array(execute_query($sql,dbconnect()));

	$sql = 'select * from student_info where sno="'.$register_user['sno'].'"';
	$stu_id = mysqli_fetch_array(execute_query($sql,dbconnect()));
	$sql='select * from class_detail where sno='.$stu_id['class'];
	$get_class_details=mysqli_fetch_array(execute_query($sql,dbconnect()));
	if($stu_id['status']==1){
		 $response=2;
	}
	else{
		$response=1;
	}
	$sql = 'select * from fees_invoice where student_id="'.$stu_id['sno'].'" and status="Success"';
	//echo $sql;
	$inv_result = execute_query($sql,dbconnect());
	if(mysqli_num_rows($inv_result)==0){
		$response=3;
	}
	else{
		$inv_row = mysqli_fetch_array($inv_result);
	}
}
$tabindex=1;
$msg='';
$verify=0;
if(isset($_POST['save_form'])){
	//print_r($_POST);
	if($_POST['student_name']==''){
		$msg .= '<li class="error">Please enter Student name.</li>';
	}
	if($_POST['father_name']==''){
		$msg .= '<li class="error">Please enter Father Name.</li>';
	}
	if($_POST['mother_name']==''){
		$msg .= '<li class="error">Please enter Mother Name.</li>';
	}
	if($_POST['dob']==''){
		$msg .= '<li class="error">Please enter Date of Birth.</li>';
	}
	if($_POST['p_address']==''){
		//$msg .= '<li class="error">Please enter Correspondence Address.</li>';
	}
	if($_POST['p_district']==''){
		//$msg .= '<li class="error">Please enter Correspondence Disrict.</li>';
	}
	if($_POST['p_post']==''){
		//$msg .= '<li class="error">Please enter Correspondence Post.</li>';
	}
	if($_POST['p_state']==''){
		//$msg .= '<li class="error">Please enter Correspondence State.</li>';
	}
	if($_POST['p_pin']==''){
		//$msg .= '<li class="error">Please enter Correspondence Pin.</li>';
	}
	if($_POST['mobileno']==''){
		$msg .= '<li class="error">Please enter Mobile Number.</li>';
	}
	if($_POST['caste']==''){
		//$msg .= '<li class="error">Please enter Caste.</li>';
	}
	if($_POST['dob']==''){
		$_POST['dob']='1990-01-01';
	}
	$sql='select * from class_detail where sno='.$_POST['classsection'];
	//echo $sql;
	$class_details=mysqli_fetch_array(execute_query($sql,dbconnect()));
	if($class_details['category']=='PG'){
		if($_POST['grad_year']==''){
			$msg .= '<li class="error">Please enter Graduation Year Details.</li>';
		}
		if($_POST['grad_board']==''){
			$msg .= '<li class="error">Please enter Graduation Board Details.</li>';
		}
		if($_POST['grad_roll_no']==''){
			$msg .= '<li class="error">Please enter Graduation Roll No. Details.</li>';
		}
		if($_POST['grad_college']==''){
			//$msg .= '<li class="error">Please enter Graduation College Details.</li>';
		}
		if($_POST['grad_obt']==''){
			$msg .= '<li class="error">Please enter Graduation Marks Obtained Details.</li>';
		}
		if($_POST['grad_total']==''){
			$msg .= '<li class="error">Please enter Graduation Total Marks Details.</li>';
		}
		if($_POST['grad_exam_name']==''){
			$msg .= '<li class="error">Please enter Graduation Details.</li>';
		}
		if($_POST['sub1']==''){
			//$msg .= '<li class="error">Please Select Subject.</li>';
		}
	}
	if($class_details['category']=='UG'){
		if($_POST['inter_year']==''){
			$msg .= '<li class="error">Please enter Intermediate Year Details.</li>';
		}
		if($_POST['inter_board']==''){
			$msg .= '<li class="error">Please enter Intermediate Board Details.</li>';
		}
		if($_POST['inter_roll_no']==''){
			$msg .= '<li class="error">Please enter Intermediate Roll No. Details.</li>';
		}
		if($_POST['inter_college']==''){
			//$msg .= '<li class="error">Please enter Intermediate College Details.</li>';
		}
		if($_POST['inter_obt']==''){
			$msg .= '<li class="error">Please enter Intermediate Marks Obtained Details.</li>';
		}
		if($_POST['inter_total']==''){
			$msg .= '<li class="error">Please enter Intermediate Total Marks Details.</li>';
		}
		if($_POST['sub1']=='' || $_POST['sub2']=='' || $_POST['sub3']==''){
			//$msg .= '<li class="error">Please Select Subjects.</li>';
		}
	}
	$sql='select * from student_info where sno="'.$_POST['student_id'].'"';
	$details=mysqli_fetch_array(execute_query($sql,dbconnect()));
	if($details['photo_id']==''){
		//$msg .= '<li class="error">Please Upload Your Photo.</li>';
	}
	if($details['signature_id']==''){
		//$msg .= '<li class="error">Please Upload Your Signature.</li>';
	}
	if(!isset($_POST['ncc'])){
		$_POST['ncc'] = '';
	}
	if(!isset($_POST['nss'])){
		$_POST['nss'] = '';
	}
	if(!isset($_POST['scout'])){
		$_POST['scout'] = '';
	}
	if(!isset($_POST['sports'])){
		$_POST['sports'] = '';
	}
	if(!isset($_POST['ph'])){
		$_POST['ph'] = '';
	}
	if(!isset($_POST['ff'])){
		$_POST['ff'] = '';
	}
	if(!isset($_POST['dept'])){
		$_POST['dept'] = '';
	}
	$sql="update student_info set 
	stu_name='".$_POST['student_name']."', 
	father_name='".$_POST['father_name']."', 
	mother_name='".$_POST['mother_name']."',
	nationality='".$_POST['nationality']."', 
	minority='".$_POST['minority']."',
	perm_address='".$_POST['p_address']."',
	p_district='".$_POST['p_district']."',
	p_state='".$_POST['p_state']."',
	p_mobile='".$_POST['p_mobile']."', 
	p_pin='".$_POST['p_pin']."',
	p_post='".$_POST['p_post']."', 
	e_mail1='".$_POST['p_email']."',
	dob='".$_POST['dob']."',
	caste='".$_POST['caste']."',
	p_state='".$_POST['p_state']."', 
	f_occupation='".$_POST['f_occupation']."',
	m_occupation='".$_POST['m_occupation']."',
	f_qualification='".$_POST['f_qualification']."',
	m_qualification='".$_POST['m_qualification']."',
	gender='".$_POST['gender']."', 
	category='".$_POST['category']."',
	sub1='".$_POST['sub1']."',
	sub2='".$_POST['sub2']."',
	sub3='".$_POST['sub3']."',
	religion='".$_POST['religion']."',
	prev_univ='".$_POST['prev_univ']."',
	ncc='".$_POST['ncc']."',
	nss='".$_POST['nss']."',
	scout='".$_POST['scout']."',
	sports='".$_POST['sports']."',
	ph='".$_POST['ph']."',
	ff='".$_POST['ff']."',
	dept='".$_POST['dept']."',
	sub1='".$_POST['sub1']."',
	sub2='".$_POST['sub2']."',
	sub3='".$_POST['sub3']."',
	class='".$_POST['classsection']."'
	 where sno='".$_POST['student_id']."'";
	execute_query($sql,dbconnect());
	//echo $sql;
	$sql="update register_users set courses='".$_POST['classsection']."'
	 where sno='".$_POST['student_id']."'";
	 execute_query($sql,dbconnect());
	 //echo $sql;
	 $sql = 'select * from register_users where sno="'.$_GET['sid'].'"';
	$register_user = mysqli_fetch_array(execute_query($sql,dbconnect()));

	$sql = 'select * from student_info where sno="'.$register_user['sno'].'"';
	$stu_id = mysqli_fetch_array(execute_query($sql,dbconnect()));
	$sql='select * from class_detail where sno='.$stu_id['class'];
	$get_class_details=mysqli_fetch_array(execute_query($sql,dbconnect()));
	 execute_query($sql,dbconnect());
	if(mysqli_error()){
		$msg .= '<h3>Error # 1. '.mysqli_error().' >> '.$sql;
	}

	$sql='delete from qual_detail where student_id="'.$_POST['student_id'].'"';
	execute_query($sql,dbconnect());
	if(mysqli_error()){
		$msg .= '<h3>Error # 2. '.mysqli_error().' >> '.$sql;
	}
	$sql = 'INSERT INTO `qual_detail` (`exam_name`, `year`, `board`, `roll_no`,`univ_name`, `student_id`, `obt_marks`, `tot_marks`,`percentage`, `status`, `division`) VALUES ("High School","'.$_POST['high_school_year'].'","'.$_POST['high_school_board'].'","'.$_POST['high_school_roll_no'].'","'.$_POST['high_school_college'].'","'.$_POST['student_id'].'","'.$_POST['high_school_obt'].'","'.$_POST['high_school_total'].'","'.$_POST['high_school_perc'].'","'.$_POST['high_school_status'].'","'.$_POST['high_school_division'].'")';
	execute_query($sql,dbconnect());
	$sql = 'INSERT INTO `qual_detail` (`exam_name`, `year`, `board`, `roll_no`,`univ_name`, `student_id`, `obt_marks`, `tot_marks`,`percentage`, `status`, `division`) VALUES ("Intermediate","'.$_POST['inter_year'].'","'.$_POST['inter_board'].'","'.$_POST['inter_roll_no'].'","'.$_POST['inter_college'].'","'.$_POST['student_id'].'","'.$_POST['inter_obt'].'","'.$_POST['inter_total'].'","'.$_POST['inter_perc'].'","'.$_POST['inter_status'].'","'.$_POST['inter_division'].'")';
	//echo $sql;
	execute_query($sql,dbconnect());
	if($get_class_details['category']=='PG'){
		$sql = 'INSERT INTO `qual_detail` (`exam_name`, `year`, `board`, `roll_no`,`univ_name`, `student_id`, `obt_marks`, `tot_marks`,`percentage`, `status`, `division`,`medium`) VALUES ("'.$_POST['grad_exam_name'].'","'.$_POST['grad_year'].'","'.$_POST['grad_board'].'","'.$_POST['grad_roll_no'].'","'.$_POST['grad_college'].'","'.$_POST['student_id'].'","'.$_POST['grad_obt'].'","'.$_POST['grad_total'].'","'.$_POST['grad_perc'].'","'.$_POST['grad_status'].'","'.$_POST['grad_division'].'","grad")';
		execute_query($sql,dbconnect());
	}
	$response=1;
	if($msg==''){
		$msg .= '<li class="error">Data saved succesfully.</li>';
		$verify = 1;
	}
	else{
		$verify = 0;
	}
}
if(isset($_POST['submit'])){
	if($_POST['verify_data']==1){
		$response=2;
	}
	if($_POST['verify_data']==0){
		$msg .= '<li class="error">You Have One or more errors on this page.</li>';
		$response=1;
	}
}
if(isset($_POST['submit1'])){
	$response=1;
}
if(isset($_POST['submit2'])){
	if($_POST['declaration']=='Yes'){
		$sql='update student_info set status="1" , declaration="'.$_POST['declaration'].'", date_of_admission="'.date("Y-m-d").'"  where sno='.$_POST['student_id'];
		execute_query($sql,dbconnect());
		if($_POST['stu_category']=='GEN' || $_POST['stu_category']=='OBC'){
			$sql='insert into fee_invoice(student_id,tot_amount,approval_date) values("'.$_POST['student_id'].'", "400","'.date("Y-m-d").'")';
			execute_query($sql,dbconnect());
			//echo $sql;
		}
		else{
			$sql='insert into fee_invoice(student_id,tot_amount) values("'.$_POST['student_id'].'", "300")';
			execute_query($sql,dbconnect());
		}
		$response=2;
		$sql = 'select * from register_users where sno="'.$_GET['sid'].'"';
		$register_user = mysqli_fetch_array(execute_query($sql,dbconnect()));

		$sql = 'select * from student_info where sno="'.$register_user['sno'].'"';
		$stu_id = mysqli_fetch_array(execute_query($sql,dbconnect()));
	}
	else{
		$msg .= '<li class="error">Please Select the Declaration.</li>';
		$response=2;
		}
}
page_header();
?>
<?php
switch($response){
	case 1:{
?>	
<script type="text/javascript" language="javascript">
function get_subject(class_name){
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			var v = xmlhttp.responseText;
			//alert(v);
			var v = v.split('#');
			document.getElementById('sub1').innerHTML=v[0];
			<?php 
			if(isset($stu_id['sub1'])){
				echo "document.getElementById('sub1').value = '".$stu_id['sub1']."';";
			}
			if(isset($_POST['sub1'])){
				echo "document.getElementById('sub1').value = '".$_POST['sub1']."';";
			}
			?>
			//alert(v[2]);
			if(v[1]!='PG' && v[2]!='self'){
				document.getElementById('sub2').innerHTML=v[0]+'<option value=""></option>';
				<?php 
				if(isset($stu_id['sub2'])){
					echo "document.getElementById('sub2').value = '".$stu_id['sub2']."';";
				}
				if(isset($_POST['sub2'])){
					echo "document.getElementById('sub2').value = '".$_POST['sub2']."';";
				}
				?>
				if(class_name == 3|| class_name == 6 || class_name == 9 || class_name == 35){
					document.getElementById('sub3').innerHTML='';
				}
				else {
					document.getElementById('sub3').innerHTML=v[0];
					<?php 
					if(isset($stu_id['sub3'])){
						echo "document.getElementById('sub3').value = '".$stu_id['sub3']."';";
					}
					if(isset($_POST['sub3'])){
						echo "document.getElementById('sub3').value = '".$_POST['sub3']."';";
					}
					?>
				}
			}
			else{
				document.getElementById('sub2').innerHTML='';
				document.getElementById('sub3').innerHTML='';
			}
		}
	}
	xmlhttp.open("GET","get_subject.php?q="+class_name,true);
	xmlhttp.send();
}
	
$(document).ready(function() {
	$("#classsection").val("<?php echo $stu_id['class'];?>");
	get_subject(<?php echo $stu_id['class'];?>);
});
	
function upload_photo(){
	$(".pure-form").submit();
}
function upload_sign(){
	$(".pure-form1").submit();
}
function get_perc(value) {
	var obtmarks='',totmarks='', percentage='';
	obtmarks = value.concat("_obt")
	obtmarks = parseFloat(document.getElementById(obtmarks).value);
	totmarks = value.concat("_total");
	totmarks = parseFloat(document.getElementById(totmarks).value);
	percentage = value.concat("_perc");
	document.getElementById(percentage).value = Math.round((obtmarks/totmarks)*100);
}
function get_division(value){
	var percentage='';
	percentage = value.concat('_perc');
	//alert(percentage);
	percentage= parseFloat(document.getElementById(percentage).value);
	division= value.concat('_division');
	if(percentage>=60){
		document.getElementById(division).value ='FIRST';
	}
	else if(percentage<60 && percentage>=45){
		document.getElementById(division).value ='SECOND';
	}
	else if(percentage<45){
		document.getElementById(division).value ='THIRD';
	}
}

</script>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/script1.js"></script>
<script type="text/javascript" src="js/jquery.form.min.js"></script>
<div style="width:100%; background:#027cd1; height:28px; text-align: right; color: #ffffff; font-size: 20px; font-weight: bold;">
	<div style="float:left; margin-left:15px;"><a href='print_receipt.php' target='_blank' style="color:#fff;">Print Receipt</a></div>
	<div style="margin-right: 50px; float:right;">Registeration Number-<?php echo $register_user['user_name'];?>&nbsp; | &nbsp; <a href="logout.php" style="color:#fff;">Logout </a>&nbsp;</div>
</div>
<div id="container" class="ltr" style="width:100%; float:none;">
		<h2> Admission Form</h2>
        <form action="upload_photo.php" class="leftLabel page1 pure-form" name="admission_newadmission" enctype="multipart/form-data" method="post" onSubmit="" >
		<?php echo $msg;?>
		<table width="100%" style="border:1px solid;">
			<tr>
				<td width="15%">&nbsp;</td>
				<td width="20%">&nbsp;</td>
				<td width="20%">&nbsp;</td>
				<td width="20%">&nbsp;</td>
				<td rowspan="7" align="right">
                	<table width="50%">
                    	<tr>
                        	<td>
                                <div style="height:225px; width:200px;  border:1px solid; text-align:center; float:left;" id="profile">
                                    <img height="225" width="200" src="user_images/<?php echo $stu_id['sno'];?>.jpg"><input name="profile_name" value="" type="hidden">
                                </div>
							</td>
						</tr>
                        <tr>
                        	<td>
                                <div class="progress">
                                    <div class="bar"></div >
                                    <div class="percent">0%</div >
                                    <div class="status"></div >
                                </div>
							</td>
						</tr>
                        <tr>
                        	<td>
                                <input type="file" name="new_image" id="new_image">
                                <input type="submit" name="submit_file" value="Upload Photo" style="width:200px;" />
							</td>
						</tr>
                        </form>
                        <form action="upload_sign.php" class="signform" name="admission_newadmission" enctype="multipart/form-data" method="post" onSubmit="" >
                    	<tr>
                        	<td>
                                <div style="height:50px; width:200px;  border:1px solid; text-align:center; float:left;" id="profile">
                                    <img height="50" width="200" src="user_images/<?php echo $stu_id['sno'];?>_sign.jpg"><input name="profile_name" value="" type="hidden">
                                </div>
							</td>
						</tr>
                        <tr>
                        	<td>
                                <div class="progress_sign">
                                    <div class="bar_sign"></div >
                                    <div class="percentsign">0%</div >
                                    <div class="status_sign"></div >
                                </div>
							</td>
						</tr>
                        <tr>
                        	<td>
                                <input type="file" name="new_image_sign" id="new_image_sign">
                                <input type="submit" name="submit_file_sign" value="Upload Sign" style="width:200px;" />
							</td>
						</tr>
					</table>
				</td>
			</tr>
			</form>
			<form action="new_admission.php" name="admission_newadmission" enctype="multipart/form-data" method="post" onSubmit="" >
			<tr>
				<td>Select Course</td>
				<td>
					<select class="select large" name="classsection" id="classsection" onChange='get_subject(this.value)' tabindex="<?php echo $tabindex++;?>">
					<option value=""></option>
					<?php
					$sql = 'select * from class_detail order by class_description';
					$res = execute_query($sql,dbconnect());
					while($row = mysqli_fetch_array($res)) {
						echo '<option value="'.$row['sno'].'" >'.$row['class_description'].'</option>';
					}
					echo '</select></div>';
					?>

				</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr id="add_subjects" >
				<td>
					Select subjects *
				</td>
				<td>
					<select name="sub1" class="listmenu large" id="sub1"><option value=""></option></select>
				</td>
				<td>
					<select name="sub2" class="listmenu large" id="sub2"><option value=""></option></select>
				</td>
				<td>					
					<select name="sub3" class="listmenu large" id="sub3"><option value=""></option></select
				></td>
				
			</tr>
			<tr>
				<td>Student Name</td>
				<td><input type="text" name="student_name" id="student_name" class="fieldtextmedium large"  value="<?php echo $stu_id['stu_name']; ?>" tabindex="<?php echo $tabindex++;?>"/></td>
				<td class="label">Father Name</td>
				<td><input type="text" name="father_name" id="father_name" class="fieldtextmedium large" value="<?php echo $stu_id['father_name']?>" tabindex="<?php echo $tabindex++;?>"/></td>
			</tr>
			<tr>
				<td>Gender</td>
				<td><select name="gender" id="gender" class="select large" tabindex="<?php echo $tabindex++;?>">
				<option value="M" <?php if($stu_id['gender']=="M"){ echo 'selected ';}?>>Male</option>
				<option value="F" <?php if($stu_id['gender']=="F"){ echo 'selected ';}?>>Female</option>
				</select></td>
				<td class="label">Date of Birth</td>
				<td><script>DateInput('dob', false, 'YYYY-MM-DD', '<?php echo $stu_id['dob']; ?>', <?php echo $tabindex++; $tabindex += 3; ?>)</script></td>
			</tr>
			<tr>
				<td>Mother Name</td>
				<td><input type="text" name="mother_name" id="mother_name" class="fieldtextmedium large" value="<?php echo $stu_id['mother_name']?>" tabindex="<?php echo $tabindex++;?>"/></td>
				<td class="label">Category</td>
				<td>
				<select name="category" id="category" class="select large" tabindex="<?php echo $tabindex++;?>">
				<option value="GEN" <?php if($stu_id['category']=="GEN"){ echo 'selected ';}?>>General</option>
				<option value="OBC" <?php if($stu_id['category']=="OBC"){ echo 'selected ';}?>>OBC</option>
				<option value="SC" <?php if($stu_id['category']=="SC"){ echo 'selected ';}?>>SC</option>
				<option value="ST" <?php if($stu_id['category']=="ST"){ echo 'selected ';}?>>ST</option>
				</select>								
				</td>
			</tr>
			<tr>
				<td>Religion</td>
				<td>
				<select name="religion" id="religion" class="select large" tabindex="<?php echo $tabindex++;?>">
				<option value="HINDU" <?php if($stu_id['religion']=="HINDU"){ echo 'selected ';}?>>HINDU</option>
				<option value="MUSLIM" <?php if($stu_id['religion']=="MUSLIM"){ echo 'selected ';}?>>MUSLIM</option>
				<option value="SIKH" <?php if($stu_id['religion']=="HINDSIKH"){ echo 'selected ';}?>>SIKH</option>
				<option value="CHRISTIAN" <?php if($stu_id['religion']=="CHRISTIAN"){ echo 'selected ';}?>>CHRISTIAN</option>
				<option value="OTHER" <?php if($stu_id['religion']=="OTHER"){ echo 'selected ';}?>>OTHER</option>
				</select>								
				</td>
				<td class="label">Caste</td>
				<td><input type="text" name="caste" id="caste" class="fieldtextmedium large" value="<?php echo $stu_id['caste'];?>" tabindex="<?php echo $tabindex++;?>"/></td>
			</tr>
			<tr>
				<td>Nationality</td>
				<td>
                <select name="nationality" id="nationality" tabindex="<?php echo $tabindex++;?>" class="large">
                    <option value="INDIAN" <?php if($stu_id['nationaliity']=='INDIAN'){ echo 'selected="selected"';}?>>INDIAN</option>
                    <option value="OTHERS"  <?php if($stu_id['nationality']=='OTHERS'){ echo 'selected="selected"';}?>>OTHERS</option>
                </select>							
				</td>
				<td class="label">Minority</td>
				<td><select name="minority" id="minority" tabindex="<?php echo $tabindex++;?>" class="large">
				<option value="NO" <?php if($stu_id['minority']=='NO'){ echo 'selected="selected"';}?>>NO</option>
				<option value="YES"  <?php if($stu_id['minority']=='YES'){ echo 'selected="selected"';}?>>YES</option>
				</td>
			</tr>
			<tr>
            </li>
				<td>Address/Village</td>
				<td><input type="text" id="p_address" name="p_address" value="<?php echo $stu_id['perm_address']; ?>"  tabindex="<?php echo $tabindex++;?>" class="large"></td>
				<td class="label">Post</td>
				<td><input class="fieldtextmedium large" id="p_post" name="p_post" value="<?php echo $stu_id['p_post']; ?>"  tabindex="<?php echo $tabindex++;?>"></td>
			</tr>
			<tr>
				<td>District</td>
				<td><input class="fieldtextmedium large" id="p_district" name="p_district" value="<?php echo $stu_id['p_district']; ?>" tabindex="<?php echo $tabindex++;?>" ></td>
				<td class="label">State</td>
				<td><input class="fieldtextmedium large" id="p_state" name="p_state" value="<?php echo $stu_id['p_state']; ?>"  tabindex="<?php echo $tabindex++;?>">
			</tr>
			<tr>
				<td>Email</td>
				<td><input class="fieldtextmedium" style="text-transform:none;" id="p_email" name="p_email" value="<?php echo $stu_id['e_mail1']; ?>" tabindex="<?php echo $tabindex++;?>"></td>
				<td class="label">Mobile No.</td>
				<td><input type="text" readonly name="mobileno" id="mobileno" class="fieldtextmedium large" value="<?php echo $stu_id['mobile']?>" tabindex="<?php echo $tabindex++;?>"/></td>
			</tr>
			<tr>
				<td>Pin</td>
				<td><input class="fieldtextmedium large" id="p_pin" name="p_pin" value="<?php echo $stu_id['p_pin']; ?>" tabindex="<?php echo $tabindex++;?>">
				</td>
				<td class="label">Alternate Mobile</td>
				<td><input name="p_mobile" class="fieldtextmedium large" id="p_mobile" value="<?php echo $stu_id['p_mobile']; ?>" tabindex="<?php echo $tabindex++;?>">
				</td>
			</tr>
			<tr>
			<td>Father Occupation</td>
			<td><input type="text" name="f_occupation" id="f_occupation" class="fieldtextmedium large" value="<?php echo $stu_id['f_occupation']; ?>" tabindex="<?php echo $tabindex++;?>"/>
			</td>
			<td class="label">Mother Occupation </td>
			<td><input type="text" name="m_occupation" id="m_occupation" class="fieldtextmedium large" value="<?php echo $stu_id['m_occupation']; ?>" tabindex="<?php echo $tabindex++;?>"/>
			</td>
			</tr>

			<tr>
			<td>Father Qualification</td>
			<td><input type="text" name="f_qualification" id="f_qualification" class="fieldtextmedium large" value="<?php echo $stu_id['f_qualification']; ?>" tabindex="<?php echo $tabindex++;?>"/>
			</td>
			<td class="label">Mother Qualification</td>
			<td><input type="text" name="m_qualification" id="m_qualification" class="fieldtextmedium large" value="<?php echo $stu_id['m_qualification']; ?>" tabindex="<?php echo $tabindex++;?>"/>
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
				<th>Percentage</th> 
				<th>Division</th>
				<th>Status</th>                 
			</tr>
			<tr>
            <?php 
				$sql = 'SELECT * from qual_detail where student_id="'.$stu_id['sno'].'" and exam_name="High School"';
			   	$result_trans = execute_query($sql,dbconnect());
				$row_high=mysqli_fetch_array(execute_query($sql,dbconnect()));
			?>
            	<td>1</td>
                <td>High School</td>
                <td><input type="text" name="high_school_board" value="<?php echo $row_high['board']?>" tabindex="<?php echo $tabindex++;?>"></td>
                <td><input type="text" name="high_school_college" value="<?php echo $row_high['univ_name']?>" tabindex="<?php echo $tabindex++;?>"></td>
                <td><input type="text" name="high_school_year" value="<?php echo $row_high['year']?>" maxlength="12" 
					class="fieldtextmedium" style="width:50px;" tabindex="<?php echo $tabindex++;?>"></td>
                <td><input type="text" name="high_school_roll_no" maxlength="12" 
					class="fieldtextmedium" style="width:50px;" value="<?php echo $row_high['roll_no']?>" tabindex="<?php echo $tabindex++;?>"></td>
                <td><input type="text" name="high_school_obt" maxlength="12" 
					class="fieldtextmedium" style="width:50px;" value="<?php echo $row_high['obt_marks']?>" tabindex="<?php echo $tabindex++;?>" id="high_school_obt"></td>
                <td><input type="text" name="high_school_total" maxlength="12" 
					class="fieldtextmedium" style="width:50px;" value="<?php echo $row_high['tot_marks']?>" tabindex="<?php echo $tabindex++;?>" onBlur="get_perc('high_school')" id="high_school_total"></td>
                <td><input type="text" name="high_school_perc" maxlength="12" 
					class="fieldtextmedium" style="width:50px;" value="<?php echo $row_high['percentage']?>" tabindex="<?php echo $tabindex++;?>" id="high_school_perc" OnBlur="get_division('high_school')" readonly/></td>
                <td><input type="text" name="high_school_division" maxlength="12" class="fieldtextmedium" style="width:50px;" value="<?php echo $row_high['division']?>" tabindex="<?php echo $tabindex++;?>" id="high_school_division" readonly/></td>
                <td><select name="high_school_status" tabindex="<?php echo $tabindex++;?>">
						<option value="Passed">Passed</option>
						<option value="Failed">Failed</option>
					</select>
				</td>
           </tr>
            <?php 
				$sql = 'SELECT * from qual_detail where student_id="'.$stu_id['sno'].'" and exam_name="Intermediate"';
	//echo $sql;
			   	$result_trans = execute_query($sql,dbconnect());
				$row_inter=mysqli_fetch_array(execute_query($sql,dbconnect()));
			?>
           <tr>
            	<td>2</td>
                <td>Intermediate</td>
                <td><input type="text" name="inter_board" value="<?php echo $row_inter['board']?>" tabindex="<?php echo $tabindex++;?>"></td>
                <td><input type="text" name="inter_college" value="<?php echo $row_inter['univ_name']?>" tabindex="<?php echo $tabindex++;?>"></td>
               <?php if($get_class_details['category']=='UG'){?>
				<td>
              <select name="inter_year" id="inter_year" tabindex="<?php echo $tabindex++;?>">
               <option value="<?php echo $row_inter['year']; ?>" selected><?php echo $row_inter['year']?></option>
               <option value="2017">2017</option>
               <option value="2016">2016</option>
               <option value="2015">2015</option>
               <option value="2014">2014</option></select></td>
                <?php }
				else{?>
                <td><input name="inter_year" tabindex="<?php echo $tabindex++;?>" type="text"  value="<?php echo $row_inter['year']?>"   maxlength="12" 
					class="fieldtextmedium" style="width:50px;"  id="inter_year" /></td>
                    <?php
                }?>
               
                    <input type="hidden" value=<?php echo $get_class_details['category']; ?> id="class_category" >
                <td><input type="text" name="inter_roll_no" maxlength="12" 
					class="fieldtextmedium" style="width:50px;" value="<?php echo $row_inter['roll_no']?>" tabindex="<?php echo $tabindex++;?>"></td>
                <td><input type="text" name="inter_obt" maxlength="12" 
					class="fieldtextmedium" style="width:50px;" value="<?php echo $row_inter['obt_marks']?>" tabindex="<?php echo $tabindex++;?>" id="inter_obt"></td>
                <td><input type="text" name="inter_total" maxlength="12" 
					class="fieldtextmedium" style="width:50px;" value="<?php echo $row_inter['tot_marks']?>" tabindex="<?php echo $tabindex++;?>" onBlur="get_perc('inter')" id="inter_total"></td>
                <td><input type="text" name="inter_perc" maxlength="12" 
					class="fieldtextmedium" style="width:50px;" value="<?php echo $row_inter['percentage']?>" tabindex="<?php echo $tabindex++;?>" id="inter_perc" OnBlur="get_division('inter')" readonly/></td>
                <td><input type="text" name="inter_division" maxlength="12" 
					class="fieldtextmedium" style="width:50px;" value="<?php echo $row_inter['division']?>" tabindex="<?php echo $tabindex++;?>" id="inter_division" readonly/></td>
                <td><select name="inter_status" tabindex="<?php echo $tabindex++;?>">
						<option value="Passed">Passed</option>
						<option value="Failed">Failed</option>
					</select>
				</td>
           </tr>
           <?php if($get_class_details['category']=='PG'){
			   $sql = 'SELECT * from qual_detail where student_id="'.$stu_id['sno'].'" and medium="grad"';
			   $result_trans = execute_query($sql,dbconnect());
			   $row_grad=mysqli_fetch_array(execute_query($sql,dbconnect()));
		   ?>
           <tr>
           		<td>3</td>
                <td><select name="grad_exam_name" tabindex="<?php echo $tabindex++;?>">
                        <option value="<?php echo $row_grad['exam_name']; ?>" selected><?php echo $row_grad['exam_name']; ?></option>
                       	<option value="B.A">B.A</option>
                        <option value="B.SC(BIO)">B.SC(BIO)</option>
                        <option value="B.SC(MATH)">B.SC(MATH)</option>
                        <option value="B.SC(HOME SC.)">B.SC(HOME SC.)</option>
                        <option value="B.COM">B.COM</option>
                        <option value="B.A.LLB">B.A.LLB</option>
                        <option value="LLB">LLB</option>
                        <option value="B.Ed">B.Ed</option>
                        <option value="Others">Others</option>
                    </select>
				</td>
                <td><input type="text" name="grad_board" value="<?php echo $row_grad['board']; ?>" tabindex="<?php echo $tabindex++;?>"></td>
                <td><input type="text" name="grad_college" value="<?php echo $row_grad['univ_name']; ?>" tabindex="<?php echo $tabindex++;?>"></td>
               <?php if($get_class_details['category']=='UG'){?>
				<td><select name="grad_year" id="grad_year" tabindex="<?php echo $tabindex++;?>"><option value="<?php echo $row['year']; ?>" selected><?php echo $row_grad['year']; ?></option><option value="2017">2017</option><option value="2016">2016</option><option value="2015">2015</option><option value="2014">2014</option></select></td>
                <?php }
				else{?>
                <td><input name="grad_year" tabindex="<?php echo $tabindex++;?>" type="text"  value="<?php echo $row_grad['year']; ?>"   maxlength="12" 
					class="fieldtextmedium" style="width:50px;"  id="grad_year" /></td>
                    <?php
                }?>
               
                    <input type="hidden" value=<?php echo $get_class_details['category']; ?> id="class_category" >
                <td><input type="text" name="grad_roll_no" maxlength="12" 
					class="fieldtextmedium" style="width:50px;" value="<?php echo $row_grad['roll_no']; ?>" tabindex="<?php echo $tabindex++;?>"></td>
                <td><input type="text" name="grad_obt" maxlength="12" 
					class="fieldtextmedium" style="width:50px;" value="<?php echo $row_grad['obt_marks']; ?>" tabindex="<?php echo $tabindex++;?>" id="grad_obt"></td>
                <td><input type="text" name="grad_total" maxlength="12" 
					class="fieldtextmedium" style="width:50px;" value="<?php echo $row_grad['tot_marks']; ?>" onBlur="get_perc('grad')"  tabindex="<?php echo $tabindex++;?>" id="grad_total"></td>
                <td><input type="text" name="grad_perc" maxlength="12" 
					class="fieldtextmedium" style="width:50px;" value="<?php echo $row_grad['percentage']; ?>" tabindex="<?php echo $tabindex++;?>" id="grad_perc" OnBlur="get_division('grad')" readonly/></td>
                <td><input type="text" name="grad_division" maxlength="12" 
					class="fieldtextmedium" style="width:50px;" value="<?php echo $row_grad['division']; ?>" tabindex="<?php echo $tabindex++;?>" id="grad_division" readonly/></td>
                <td><select name="grad_status" tabindex="<?php echo $tabindex++;?>">
						<option value="Passed">Passed</option>
						<option value="Failed">Failed</option>
					</select>
				</td>
           </tr>
           	<?php }
			?>
		</table>
        <table>
        	<tr>
            	<td class="label"><b>Weightage  
                 Passed Qualifying Exam From  </b>   		
                 <select name="prev_univ" class="listmenu" id="prev_univ"  onFocus="fnTXTFocus(this.id)" tabindex="80" >
                 	<option value=""></option>
                    <option value="awadh" <?php if(isset($stu_id['prev_univ'])){ if($stu_id['prev_univ']=="awadh"){ echo 'selected';}}?>>Dr.R.M.L.Awadh University</option>
                    <option value="knipss" <?php if(isset($stu_id['prev_univ'])){ if($stu_id['prev_univ']=="knipss"){ echo 'selected';}}?>>KNIPSS</option>
                 </select>
                 </td>
            </tr>
            <tr>
            	<td class="label"><b>NCC</b>       
                <input type="checkbox"  id="weightage"  name="ncc" value="NCC" <?php if($stu_id['ncc']=="NCC"){ echo 'checked';}?> style="vertical-align:bottom;" tabindex="81"/>
                &nbsp;&nbsp;&nbsp;&nbsp;<b>NSS</b>       
                <input type="checkbox"  id="weightage"  name="nss" value="NSS" <?php if($stu_id['nss']=="NSS"){ echo 'checked';} ?> style="vertical-align:bottom;" tabindex="82" />
                &nbsp;&nbsp;&nbsp;&nbsp;<b>SCOUT & GUIDE</b>        
                <input type="checkbox"  id="weightage"  name="scout" value="SCOUT" <?php  if($stu_id['scout']=="SCOUT"){ echo 'checked';} ?> style="vertical-align:bottom;" tabindex="83" />
                &nbsp;&nbsp;&nbsp;&nbsp;<b>SPORTS</b>       
                <input type="checkbox"  id="weightage"  name="sports" value="SPORTS" <?php if($stu_id['sports']=="SPORTS"){ echo 'checked';}?> style="vertical-align:bottom;" tabindex="84" />
                &nbsp;&nbsp;&nbsp;&nbsp;<b>PH</b>       
                <input type="checkbox"  id="weightage"  name="ph" value="PH" <?php if($stu_id['ph']=="PH"){ echo 'checked';}?> style="vertical-align:bottom;" tabindex="85"/>
                &nbsp;&nbsp;&nbsp;&nbsp;<b>FF</b>        
                <input type="checkbox"  id="weightage"  name="ff" value="FF" <?php if($stu_id['ff']=="FF"){ echo 'checked';}?> style="vertical-align:bottom;" tabindex="86" />
				</td>
                </tr> 
                <tr>
                	<td class="label"><b>Dept. Of KNIPSS/Dr. RMLA University Employees/Teachers</b>       
                	<input type="checkbox" class="fieldtextmedium"  id="weightage"  name="dept" value="YES" <?php  if($stu_id['dept']=="YES"){ echo 'checked';}?> style="vertical-align:bottom;" tabindex="87" /></td>
               </tr>
				</table>
<li id="supplier_id" class="notranslate"> <input type="submit" class="btTxt submit" name="save_form" value="Save Form" onClick="return confirmSubmit()"/></li>
<li id="supplier_id" class="notranslate"> <input type="submit" class="btTxt submit" name="submit" value="Final Submit" onClick="return confirmSubmit()"/></li>
<div><input type="hidden" name="id" id="id" value="<?php echo $i;?>" /><input type="hidden" name="student_id" id="student_id" value="<?php echo $stu_id['sno'];?>" />
<input type="hidden" name="verify_data" id="verify_data" value="<?php echo $verify; ?>" /></div>
</form>
<div style="clear:both;"></div>
</div></div>


<?php
		break;
	}
	case 2 :{
	
	?>
<div style="width:100%; background:#027cd1; height:28px; text-align: right; color: #ffffff; font-size: 20px; font-weight: bold;">
	<div style="float:left; margin-left:15px;"><a href='print_receipt.php' target='_blank' style="color:#fff;">Print Receipt</a></div>
	<div style="margin-right: 50px; float:right;">Registeration Number-<?php echo $register_user['user_name'];?>&nbsp; | &nbsp; <a href="logout.php" style="color:#fff;">Logout </a>&nbsp;</div>
</div>
<div id="container" class="ltr" style="width:100%; float:none;">
	<h2><?php if($stu_id['status']!=1){ echo 'Verify '; }?>Admission Form</h2>
    <h2>Your Registeration Number is-<?php echo $register_user['user_name'];?></h2>
    <form>
       <?php echo $msg;
	   	// print_r ($_POST); ?>
	   	<?php
		if($stu_id['status']==1){
			echo '<li class="error"><h2>Admission for submitted successfully. Please print application form from the bottom of the page.</h2></li>';
		}
		else{
			echo '<li class="error"><h2>Please verify your data carefully. You will not be able to modify it later.</h2></li>';
		}
		?>
	</form>
		<table width="100%">
			<tr>
				<td width="15%">&nbsp;</td>
				<td width="20%">&nbsp;</td>
				<td width="20%">&nbsp;</td>
				<td width="20%">&nbsp;</td>
				<td colspan="2" rowspan="7" align="right">
					<div style="height:225px; width:200px;  border:1px solid; text-align:center; float:left;" id="profile">
                                    <img height="225" width="200" src="user_images/<?php echo $stu_id['sno'];?>.jpg"><input name="profile_name" value="" type="hidden">
					</div>
                    <div style="height:50px; width:200px;  border:1px solid; text-align:center; float:left;" id="profile">
                                    <img height="50" width="200" src="user_images/<?php echo $stu_id['sno'];?>_sign.jpg"><input name="profile_name" value="" type="hidden">
					</div>
			</td>
			</tr>
			<form action="new_admission.php" class="wufoo leftLabel page1" name="admission_newadmission" enctype="multipart/form-data" method="post" onSubmit="" >
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
				<td class="highlight"><?php if(isset($stu_id['p_mobile'])){echo $stu_id['p_mobile']; } ?></td>
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
				<th>Percentage</th> 
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
				<tr><td class="label highlight"><?php echo $i; ?></td>
					<td class="label highlight"><?php echo $row['exam_name']; ?></td>
					<td class="label highlight"><?php echo $row['board']; ?></td>
					<td class="label highlight"><?php echo $row['univ_name']; ?></td>
					<td class="label highlight"><?php echo $row['year']; ?></td>
					<td class="label highlight"><?php echo $row['roll_no']; ?></td>
				    <td class="label highlight"><?php echo $row['obt_marks']; ?></td>
					<td class="label highlight"><?php echo $row['tot_marks']; ?></td>
					<td class="label highlight"><?php echo $row['percentage']; ?></td>
					<td class="label highlight"><?php echo $row['division']; ?></td>
					<td class="label highlight">
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
            	<td class="label highlight"><b>Weightage  
                 Passed Qualifying Exam From  </b>   		
                 <?php if($stu_id['prev_univ']=="awadh"){ echo 'Dr.R.M.L.Awadh University';}?>
                 <?php if($stu_id['prev_univ']=="knipss"){ echo 'KNIPSS';}?>
                 </td>
            </tr>
            <tr>
            	<td class="label highlight"><b>NCC-</b>       
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
                <td class="label highlight"><b>Dept. Of KNIPSS/Dr. RMLA University Employees/Teachers-</b>       
                	<?php  if($stu_id['dept']=="YES"){ echo 'Yes';} else{ echo 'No';}?>
                </td>
          </tr>
          <tr>
          		<td class="label highlight">
                <b>DECLARATION-
                I hereby declare that all information given above are true to the best of my knowledge.If any information given by me is found false,my admission is liable to be cancelled.</b>
                <?php 
				if($stu_id['status']==1){
					echo '&nbsp;<b><em><u>Agreed.</u></em></b>';
				}
				else{
				?>
                <input type="checkbox"  id="weightage"  name="declaration" value="Yes" <?php if($stu_id['declaration']=="Yes"){ echo 'checked';}?> style="vertical-align:bottom;"/> 
                <?php } ?>
                </td>
		  </table>
            <?php 
			if($stu_id['status']==1){
				echo '<input type="button" class="btTxt submit" name="submit4" value="Print Application Form" onclick="window.open(\'printing_form.php\');"  />';
			}
			else{
				echo '<input type="submit" class="btTxt submit" name="submit1" value="Go Back And Edit" onClick="return confirmSubmit()"/>
				<input type="submit" class="btTxt submit" name="submit2" value="Final Submit" onClick="return confirmSubmit()"/>';
			}?>

			<div><input type="hidden" name="id" id="id" value="<?php echo $stu_id['sno'];?>" /><input type="hidden" name="student_id" id="student_id" value="<?php echo $stu_id['sno'];?>" />
			<input type="hidden" name="stu_category" id="stu_category" value="<?php echo $stu_id['category'];?>" /></div>
		</div>
   </div>
    <?php 
		?>
    <?php	
		break;
	}
	case 3 :{
	?>
<div style="width:100%; background:#027cd1; height:28px; text-align: right; color: #ffffff; font-size: 20px; font-weight: bold;">
	<div style="margin-right: 50px; float:right;">Registeration Number-<?php echo $register_user['user_name'];?>&nbsp; | &nbsp; <a href="logout.php" style="color:#fff;">Logout </a>&nbsp;</div>
</div>
<div id="container" class="ltr" style="width:100%; float:none;">
		<h2> Fees Payment </h2>
        <form action="success.php" class="leftLabel page1 pure-form" name="admission_newadmission" enctype="multipart/form-data" method="post" onSubmit="" >
		<?php echo $msg;?>
		<table width="100%" style="border:1px solid;">	
		<tr>
				<td class="label">Student Name</td>
				<td class="highlight"><?php if(isset($stu_id['stu_name'])){echo $stu_id['stu_name']; } ?></td>
				<td class="label">Father Name</td>
				<td class="highlight"><?php if(isset($stu_id['father_name'])){echo $stu_id['father_name']; } ?></td>
			</tr>
			<tr>
				<td class="label">Category</td>

				<td class="highlight">
				<?php if($stu_id['category']=="GEN"){ echo 'GENERAL ';}?>
				 <?php if($stu_id['category']=="OBC"){ echo 'OBC ';}?>
				 <?php if($stu_id['category']=="SC"){ echo 'SC';}?>
				 <?php if($stu_id['category']=="ST"){ echo 'ST';}?>
				<td class="label">Fees Amount</td>
				<td class="highlight">
				<?php 
				$amount=0;
				if($stu_id['category']=='SC' || $stu_id['category']=='ST'){
					echo 'Rs.200/-';
					$amount = 200;
				} 
				else{
					echo 'Rs.300/-';
					$amount = 300;
				}?>
				
				<input type="hidden" value="M<?php echo $stu_id['sno'].time();?>" id="OrderId" name="OrderId">
				<input type="hidden" value="<?php echo $amount*100;?>" id="amount" name="amount">
				<input type="hidden" value="INR" id="currencyName" name="currencyName">
				<input type="hidden" value="S" id="meTransReqType" name="meTransReqType">
				<input type="hidden" value="<?php echo $stu_id['sno']; ?>" id="student_id" name="student_id">
				</td>
			</tr>
			<tr>
				<td colspan="4" align="center"><input type="submit" class="btTxt submit" name="submit_fees" value="Proceed for Cash  Payment" onClick="return confirmSubmit()"/></td>
			</tr>
		</table>	
	<?php
		break;
	}
}
page_footer();
?>

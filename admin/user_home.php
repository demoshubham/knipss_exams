<?php
date_default_timezone_set('Asia/Calcutta');
session_cache_limiter('nocache');
session_start();
include("settings.php");
include("get_computer.php");
logvalidate('','');
$tabindex=1;
$response=1;
$msg='';
$link = dbconnect();
page_header();
if(isset($_GET['sid'])){
	$sql = 'update student_info set status=NULL, date_of_admission=NULL where sno='.$_GET['sid'];
	execute_query($sql,dbconnect());
	
	$sql = 'select * from student_info where sno='.$_GET['sid'];
	$student = mysqli_fetch_array(execute_query($sql,dbconnect()));
	$msg = 'Dear '.$student['stu_name'].', your admission form has been reopened for editing. Use your Registration Number and Password to login. - KNIPSS Team';
	send_sms($student['mobile'], $msg);
	//echo $sql;
}
?>
<?php
switch($response){
	case 1:{
?>	
<script type="text/javascript" language="javascript">
</script>
<script type="text/javascript" src="js/jquery.form.min.js"></script>
<div style="width:100%; background:#027cd1; height:28px; text-align: right; color: #ffffff; font-size: 20px; font-weight: bold;">
	<div style="margin-right: 50px; float:left;">
		<a href="upload_csv.php" style="color:#fff; margin-left: 20px;">Upload CSV</a>&nbsp;|&nbsp;
		<a href="new_registration.php" style="color:#fff;">New Admission</a>&nbsp;|&nbsp;
		<a href="verify_otp.php" style="color:#fff;">Verify OTP</a>&nbsp;|&nbsp;
		<a href="send_sms.php" style="color:#fff;">Send SMS</a>&nbsp;|&nbsp;
		<a href="fill_details.php" style="color:#fff;">Fill Details</a>
	</div>
	<div style="margin-right: 50px; float:right;">Welcome <?php echo $_SESSION['username']; ?>&nbsp; | &nbsp; <a href="logout.php" style="color:#fff;">Logout </a>&nbsp;</div>
</div>
<div id="container" class="ltr" style="width:100%; float:none;">
		<h2> Admission Form Report</h2>
			<form action="user_home.php" name="admission_newadmission" enctype="multipart/form-data" method="post" onSubmit="" >
			<table>
			<tr>
				<td colspan="2">Select Filter :
					<select name="date_filter_type">
						<option value=""></option>
						<option value="reg_date">Registeration Date</option>
						<option value="fees_date">Fees Deposition Date</option>
						<option value="form_deposition">Form Deposition Date</option>
					</select></td>
				<td>Date From</td>
				<td><script>DateInput('reg_date_from', false, 'YYYY-MM-DD', '<?php echo date("Y-m-01"); ?>', <?php echo $tabindex++; $tabindex += 3; ?>)</script></td>
				<td>Date To</td>
				<td><script>DateInput('reg_date_to', false, 'YYYY-MM-DD', '<?php echo date("Y-m-d"); ?>', <?php echo $tabindex++; $tabindex += 3; ?>)</script></td>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td>Student Name</td>
				<td><input type="text" name="full_name" tabindex="<?php echo $tabindex++;?>"></td>
				<td>Father Name</td>
				<td><input type="text" name="father_name" tabindex="<?php echo $tabindex++;?>"></td>
				<td>Mobile Number</td>
				<td><input type="text" name="mobile" tabindex="<?php echo $tabindex++;?>"></td>
				<td>Class</td>
				<td><select name="student_class">
					<option value="all">All</option>
					<?php
					$sql = 'select * from class_detail';
					$result = execute_query($sql,dbconnect());
					while($row = mysqli_fetch_array($result)){
						echo '<option value="'.$row['sno'].'">'.$row['class_description'].'</option>';
					}
					?>
				</select></td>
			</tr>
			<tr>
				<td>Order Id</td>
				<td><input type="text" name="order_id" tabindex="<?php echo $tabindex++;?>"></td>
				<td>Transaction Ref No.</td>
				<td><input type="text" name="txnrefno" tabindex="<?php echo $tabindex++;?>"></td>
				<td>Transaction Status</td>
				<td><select name="status" tabindex="<?php echo $tabindex++;?>">
						<option value="All">All</option>
						<option value="Success">Success</option>
						<option value="Failed">Failed</option>
					</select></td>
				<td>Multiple Transaction</td>
				<td><input type="checkbox" name="multiple_trans" id="multiple_trans" tabindex="<?php echo $tabindex++;?>"></td>
			</tr>
			<tr><td colspan="4" style="text-align:right;"><input type="submit" class="btTxt submit" name="search_form" value="Search with Filter"/></td>
			<td colspan="4" style="text-alignleft;"><input type="button" class="btTxt submit" name="export_result" onClick="window.open('report_export.php', '_blank');" value="Export Results to Excel"/></td></tr>
		</table>
		</form>
		<table>
			<tr>
				<th colspan="15" style="text-align: center;">
				<?php
				if(!isset($_SESSION['user_admin_sql'])){
					$_SESSION['user_admin_sql'] = 'select student_info.sno as sno, user_name, password, stu_name, student_info.father_name, class_description, student_info.mobile, date_of_admission, datestamp, count(*) c from student_info left join class_detail on class_detail.sno = class left join register_users on register_users.sno = student_info.sno where 1=1 ';
					$_SESSION['filter']='';
				}
				if(isset($_POST['order_id'])){
					$_SESSION['filter']='';
					$_SESSION['user_admin_sql'] = 'select student_info.sno as sno, user_name, password, stu_name, student_info.father_name, class_description, student_info.mobile, date_of_admission, datestamp, count(*) c  from student_info left join class_detail on class_detail.sno = class left join register_users on register_users.sno = student_info.sno left join fees_invoice on student_info.sno = fees_invoice.student_id where 1=1 ';
					if($_POST['date_filter_type']!=''){
						$_SESSION['filter'] = '';
						switch($_POST['date_filter_type']){
							case 'reg_date' :{
								$_SESSION['user_admin_sql'] .= ' and datestamp>="'.$_POST['reg_date_from'].'" and datestamp<="'.$_POST['reg_date_to'].'"';
								$_SESSION['filter'] .= "&nbsp; Reg. Date From : ".$_POST['reg_date_from']." To : ".$_POST['reg_date_to'];
								break;
							}
							case 'fees_date' :{
								$_SESSION['user_admin_sql'] = 'select student_info.sno as sno, user_name, password, stu_name, student_info.father_name, class_description, student_info.mobile, date_of_admission, datestamp from fees_invoice left join student_info on student_info.sno = fees_invoice.student_id left join class_detail on class_detail.sno = student_info.class left join register_users on register_users.sno = student_info.sno where 1=1 and fees_invoice.status="Success" ';
								
								$_SESSION['user_admin_sql'] .= ' and txnreqdate>="'.$_POST['reg_date_from'].'" and txnreqdate<="'.$_POST['reg_date_to'].'"';
								$_SESSION['filter'] .= "&nbsp; Fees. Date From : ".$_POST['reg_date_from']." To : ".$_POST['reg_date_to'];
								break;
							}
							case 'form_deposition' :{
								$_SESSION['user_admin_sql'] .= ' and date_of_admission>="'.$_POST['reg_date_from'].'" and date_of_admission<="'.$_POST['reg_date_to'].'"';
								$_SESSION['filter'] .= "&nbsp; Form. Date From : ".$_POST['reg_date_from']." To : ".$_POST['reg_date_to'];
								break;
							}
						}
					}
					if($_POST['full_name']!=''){
						$_SESSION['user_admin_sql'] .= ' and stu_name like "%'.$_POST['full_name'].'%"';
						$_SESSION['filter'] .= "&nbsp; Student Name Like : <strong><em><u>%".$_POST['full_name']."%</u></em></strong>";
								
					}
					if($_POST['father_name']!=''){
						$_SESSION['user_admin_sql'] .= ' and student_info.father_name like "%'.$_POST['father_name'].'%"';
						$_SESSION['filter'] .= "&nbsp; Father Name Like : <strong><em><u>%".$_POST['father_name']."%</u></em></strong>";
					}
					if($_POST['mobile']!=''){
						$_SESSION['user_admin_sql'] .= ' and student_info.mobile like "%'.$_POST['mobile'].'%"';
						$_SESSION['filter'] .= "&nbsp; Mobile Number Like : <strong><em><u>%".$_POST['mobile']."%</u></em></strong>";
					}
					if($_POST['student_class']!='all'){
						$_SESSION['user_admin_sql'] .= ' and class="'.$_POST['student_class'].'"';
						$sql = 'select * from class_detail where sno='.$_POST['student_class'];
						$class_temp = mysqli_fetch_array(execute_query($sql,dbconnect()));
						$_SESSION['filter'] .= "&nbsp; Student Class : <strong><em><u>".$class_temp['class_description']."</u></em></strong>";
					}
					if($_POST['order_id']!=''){
						$_SESSION['user_admin_sql'] = 'select student_info.sno as sno, user_name, password, stu_name, student_info.father_name, class_description, student_info.mobile, date_of_admission, datestamp from fees_invoice left join student_info on student_info.sno = fees_invoice.student_id left join class_detail on class_detail.sno = student_info.class left join register_users on register_users.sno = student_info.sno where 1=1 and fees_invoice.order_id="'.$_POST['order_id'].'" ';
						$_SESSION['filter'] = "&nbsp; Order ID : ".$_POST['order_id'];
						
					}
					if($_POST['status']!='All'){
						$_SESSION['user_admin_sql'] .= ' and fees_invoice.status="'.$_POST['status'].'" ';
						if(isset($_POST['multiple_trans'])){
							$_SESSION['user_admin_sql'] .= ' group by fees_invoice.student_id having c>1';
							$_SESSION['filter'] = "&nbsp; Having Multiple Transaction";
						}
						$_SESSION['filter'] = "&nbsp; Transaction Status : ".$_POST['status'];
					}
					
				}
				//echo $_SESSION['user_admin_sql'];
				$res_page = execute_query($_SESSION['user_admin_sql'],$link);
				$count = mysqli_num_rows($res_page);
				if(isset($_POST['order_id'])){
					$_SESSION['filter'] .= "&nbsp; Total : <strong><em><u>$count</u></em></strong>";
				}
				$pages = ceil($count/100);
				if(!isset($_GET['pgid'])){
					$_GET['pgid']=1;
				}
				if($pages>10){
					for($i=1;$i<=$pages;$i++){
						if($i==$_GET['pgid']){
							echo '<span style="color:#F00; text-decoration: none; font-size: 20px;">'.$i.'</span>&nbsp;|&nbsp;';
						}
						else{
							echo '<a href="user_home.php?pgid='.$i.'" style="color:#fff; text-decoration: none; font-size: 20px;">'.$i.'</a>&nbsp;|&nbsp;';
						}
					}
				}
				else{
					for($i=1;$i<=$pages;$i++){
						if($i==$_GET['pgid']){
							echo '<span style="color:#F00; text-decoration: none; font-size: 20px;">'.$i.'</span>&nbsp;|&nbsp;';
						}
						else{
							echo '<a href="user_home.php?pgid='.$i.'" style="color:#fff; text-decoration: none; font-size: 20px;">'.$i.'</a>&nbsp;|&nbsp;';
						}
					}
				}
				?>
				</th>
			</tr>
			<tr>
				<th colspan="15" style="color: #FFF;"><h3><?php echo $_SESSION['filter']; ?></h3></th>
			</tr>
			<tr>
				<th>S.No.</th>
				<th>Registeration Number</th>
				<th>Password</th>
				<th>Student Name</th>
				<th>Father Name</th>
				<th>Class</th>
				<th>Mobile No.</th>
				<th>Status</th>
				<th>Order Id</th>
				<th>Reg. Date</th>
				<th>Fee Deposit</th>
				<th>Form Submission</th>
				<th colspan="3">&nbsp;</th>
			</tr>
			<?php
			if(isset($_GET['pgid'])){
				if($_GET['pgid']==1){
					$limit = ' limit 0, 100';
					$start=1;
					$i=1;
				}
				else{
					$start = ($_GET['pgid']*100)-100;
					$limit = ' limit '.$start.', 100';
					$i=$start+1;
				}
			}
			else{
				$start=1;
				$limit = ' limit 0, 100';
				$i=1;
			}
			$sql = $_SESSION['user_admin_sql'].$limit;
			//echo $sql.'@';
			$result = execute_query($sql,$link);
			$row_inv['txnreqdate']='';
			while($row = mysqli_fetch_array($result)){
				$sql = 'select * from register_users where sno="'.$row['sno'].'"';
				$reg_user = mysqli_fetch_array(execute_query($sql,$link));
				$sql = 'select * from fees_invoice where student_id="'.$row['sno'].'"';
				$res_inv_temp = execute_query($sql,$link);
				$res_inv_temp_row = mysqli_num_rows($res_inv_temp);
				$orderid = '';
				if($res_inv_temp_row==0){
					$status = '<span style="color:#F00;">Only Registered</span>';
					$row_inv['txnreqdate']='';
				}
				else{
					$sql = 'select * from fees_invoice where student_id="'.$row['sno'].'"';
					$res_inv = execute_query($sql,$link);
					$stat = 0;
					if(mysqli_num_rows($res_inv)>=1){
						while($row_inv_order = mysqli_fetch_array($res_inv)){
							if($row_inv_order['status']=="Success"){
								$orderid .= '<span style="color:#0F0;">'.$row_inv_order['order_id'].'</span><br>';
								$status = '<span style="color:#0F0;">Fees Paid</span>';
								$row_inv['txnreqdate'] = $row_inv_order['txnreqdate'];
								$stat=1;
							}
							else{
								$orderid .= $row_inv_order['order_id'].'<br>';
							}
						}
						if($stat==0){
							$status = '<span style="color:#00F;">Proceeded</span>';
						}
					}
					else{
						$status = '';
						$row_inv['txnreqdate']='';
					}
				}
				if($row['date_of_admission']!=''){
					$status = '<span style="color:#fbff00; font-size:16px;">Form Submitted</span>';
					$edit = '<span"><a style="color:#F00; font-size:16px;" href="'.$_SERVER['PHP_SELF'].'?sid='.$row['sno'].'" onClick="return confirm(\'You are reopening User ID : '.$row['user_name'].'. Are you sure ?\')">Re-open</a></span>';
				}
				else{
					$edit='';
				}
				//echo $sql.'<br>';
				echo '<tr>
				<td>'.$i++.'</td>
				<td>'.$reg_user['user_name'].'</td>
				<td>'.$reg_user['password'].'</td>
				<td>'.$row['stu_name'].'</td>
				<td>'.$row['father_name'].'</td>
				<td>'.$row['class_description'].'</td>
				<td>'.$row['mobile'].'</td>
				<td>'.$status.'</td>
				<td>'.$orderid.'</td>
				<td>'.$reg_user['datestamp'].'</td>
				<td>'.$row_inv['txnreqdate'].'</td>
				<td>'.$row['date_of_admission'].'</td>
				<td><a href="printing_form.php?id='.$row['sno'].'" target="_blank">View</a></td>
				<td>'.$edit.'</td>
				<td><a href="new_admission.php?sid='.$row['sno'].'" target="_blank">Manual Admission</a></td>
				</tr>';
			}
			?>
		</table>
<div style="clear:both;"></div>
</div>


<?php
		break;
	}
}
page_footer();
?>

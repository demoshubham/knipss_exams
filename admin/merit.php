<?php
date_default_timezone_set('Asia/Calcutta');
session_cache_limiter('nocache');
session_start();
set_time_limit(0);
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
		<a href="send_sms.php" style="color:#fff;">Send SMS</a>
	</div>
	<div style="margin-right: 50px; float:right;">Welcome <?php echo $_SESSION['username']; ?>&nbsp; | &nbsp; <a href="logout.php" style="color:#fff;">Logout </a>&nbsp;</div>
</div>
<div id="container" class="ltr" style="width:100%; float:none;">
		<h2> Admission Form Report</h2>
			<form action="merit.php" name="admission_newadmission" enctype="multipart/form-data" method="post" onSubmit="" >
			<table>
			<tr>
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
			<tr><td colspan="4" style="text-align:right;"><input type="submit" class="btTxt submit" name="search_form" value="Search with Filter"/></td>
			<td colspan="4" style="text-alignleft;"><input type="button" class="btTxt submit" name="export_result" onClick="window.open('merit_export.php', '_blank');" value="Export Results to Excel"/></td></tr>
		</table>
		</form>
		<table>
			<?php
			if(!isset($_SESSION['user_admin_sql'])){
				$_SESSION['user_admin_sql'] = 'select student_info.sno as sno, user_name, password, stu_name, student_info.father_name, class_description, student_info.mobile, date_of_admission, datestamp, ncc, scout, ph, ff, dept, sports, nss, student_info.category from fees_invoice left join student_info on student_info.sno = fees_invoice.student_id left join class_detail on class_detail.sno = student_info.class left join register_users on register_users.sno = student_info.sno where 1=1 and fees_invoice.status="Success"';
							
				//select student_info.sno as sno, user_name, password, stu_name, student_info.father_name, student_info.category, class_description, student_info.mobile, date_of_admission, datestamp, ncc, scout, ph, ff, dept, sports, nss from student_info left join class_detail on class_detail.sno = class left join register_users on register_users.sno = student_info.sno where x1=1 ';
				$_SESSION['filter']='';
			}
			if(isset($_POST['student_class'])){
				$_SESSION['filter']='';
				$_SESSION['user_admin_sql'] = 'select student_info.sno as sno, user_name, password, stu_name, student_info.father_name, class_description, student_info.mobile, date_of_admission, datestamp, ncc, scout, ph, ff, dept, sports, nss, student_info.category from fees_invoice left join student_info on student_info.sno = fees_invoice.student_id left join class_detail on class_detail.sno = student_info.class left join register_users on register_users.sno = student_info.sno where 1=1 and fees_invoice.status="Success" ';
				if($_POST['student_class']!='all'){
					$_SESSION['user_admin_sql'] .= ' and class="'.$_POST['student_class'].'"';
					$sql = 'select * from class_detail where sno='.$_POST['student_class'];
					$class_temp = mysqli_fetch_array(execute_query($sql,dbconnect()));
					$_SESSION['filter'] .= "&nbsp; Student Class : <strong><em><u>".$class_temp['class_description']."</u></em></strong>";
				}
			}
			//$_SESSION['user_admin_sql'] .= ' and (datestamp>="2017-07-10" or date_of_admission>="2017-07-10")';
			echo $_SESSION['user_admin_sql'];
			$res_page = execute_query($_SESSION['user_admin_sql'],$link);
			$count = mysqli_num_rows($res_page);
			$_SESSION['filter'] .= "&nbsp; Total : <strong><em><u>$count</u></em></strong>";
			if(isset($_POST['order_id'])){
				
			}
			$pages = ceil($count/100);
			if(!isset($_GET['pgid'])){
				$_GET['pgid']=1;
			}
			?>
			<tr>
				<th colspan="15" style="color: #FFF;"><h3><?php echo $_SESSION['filter']; ?></h3></th>
			</tr>
			<tr>
				<th>S.No.</th>
				<th>Registeration Number</th>
				<th>Student Name</th>
				<th>Father Name</th>
				<th>Category</th>
				<th>Class</th>
				<th>Mobile No.</th>
				<th>Status</th>
				<th>Reg. Date</th>
				<th>Fee Deposit</th>
				<th>Form Submission</th>
				<th>Last Class</th>
				<th>Marks Obtained</th>
				<th>Total Marks</th>
				<th>Percentage</th>
				<th>NCC</th>
				<th>Scout</th>
				<th>PH</th>
				<th>FF</th>
				<th>Sports</th>
				<th>NSS</th>
				<th>KNIPSS</th>
				<th>Total Weightage</th>
				<th>Final</th>
			</tr>
			<?php
			if(isset($_GET['pgid'])){
				if($_GET['pgid']==1){
					$limit = '';
					$start=1;
					$i=1;
				}
				else{
					$start = ($_GET['pgid']*100)-100;
					$limit = '';
					$i=$start+1;
				}
			}
			else{
				$start=1;
				$limit = '';
				$i=1;
			}
			$sql = $_SESSION['user_admin_sql'].$limit;
			//echo $sql.'@';
			$result = execute_query($sql,$link);
			$row_inv['txnreqdate']='';
			$prev_univ = array('K N  I P S S SULTANPUR', 'K N I P S S', 'K N I P S S COLLAGE', 'K N I P S S SULTANPR', 'K N I P S S SULTANPU', 'K N I P S S SULTANPUR', 'K N I P S S SULTANPUR UP', 'K N I P S SULTANPUR', 'K N I P SS SULTANPUR', 'K N I PS S SULTANPUR', 'K N I PSS SULTANPUR', 'K N I SULTANPUR', 'K NI PSS SULTANPUR', 'K. N. I. P. S. S. SULTANPUR', 'K. N. I. P. S.S. SULTANPUR', 'K.N.I P.S.S', 'K.N.I. P.S.S. SULTANPUR', 'K.N.I.P.S.S', 'K.n.i.p.s.s Sultanpur', 'K.N.I.P.S.S.', 'K.N.I.P.S.S. SULTANPUE', 'K.N.I.P.S.S. SULTANPUR', 'K.N.I.P.S.S. SULTANPUR UP', 'K.NI.P.S.S. Sultanpur', 'KAMAL NEHARU INSTITUTE AND SOCIAL SCIENCE', 'Kamla Nehru Institute Of Phisical And Social Sciences', 'kamla nehru institute of physical & social sciences sultanpur', 'Kamla Nehru Institute Of Physical And Social Sciences', 'KNI PSS SULTANPUR', 'KNIPSS', 'KNIPSS  SULTANPUR', 'knipss sln', 'knipss slt', 'KNIPSS SULTANPUR', 'KNIPSS SULTANPUR U.P.', 'KNIPSS, SULTANPUR', 'KNIPSS,SULTANPUR');
			//print_r($prev_univ);
			while($row = mysqli_fetch_array($result)){
				$merit=0;
				$weight=0;
				$sql = 'select * from register_users where sno="'.$row['sno'].'"';
				//echo $sql.'<br>';
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
								$merit=1;
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
					$merit=1;
					$status = '<span style="color:#fbff00; font-size:16px;">Form Submitted</span>';
					$edit = '<span"><a style="color:#F00; font-size:16px;" href="'.$_SERVER['PHP_SELF'].'?sid='.$row['sno'].'" onClick="return confirm(\'You are reopening User ID : '.$row['user_name'].'. Are you sure ?\')">Re-open</a></span>';
				}
				else{
					$edit='';
				}
				
				if($merit==1){
					$sql = 'SELECT * FROM `qual_detail` where student_id="'.$row['sno'].'" and medium="grad" order by abs(year) desc limit 1';
					//echo $sql.'<br>';
					$qual = execute_query($sql,dbconnect());
					if(mysqli_num_rows($qual)==1){
						$qual = mysqli_fetch_array($qual);
						if(in_array($qual['univ_name'], $prev_univ)){
							//echo 'in array<br>';
							$row['dept'] = '5';
						}
						else{
							$row['dept']='';
						}
						//$row['dept'] = in_array($qual['univ_name'], $prev_univ);
						if(!is_numeric($qual['tot_marks'])){
							$qual['tot_marks']='';
							$percent='';
						}
						else{
							$percent = round($qual['obt_marks']*100/$qual['tot_marks'],3);
						}
					}
					else{
						unset($qual);
						$qual['tot_marks']='';
						$qual['obt_marks']='';
						$qual['exam_name']='';
						$percent = '';
						$msg = 'Invalid Data';
					}
					if($row['ncc']!=''){
						$row['ncc'] = '3';
					}
					if($row['scout']!=''){
						$row['scout'] = '3';
					}
					if($row['ph']!=''){
						$row['ph'] = '3';
					}
					if($row['ff']!=''){
						$row['ff'] = '2';
					}
					if($row['sports']!=''){
						$row['sports'] = '2';
					}
					if($row['nss']!=''){
						$row['nss'] = '2';
					}
					//echo $sql.'<br>';
					$tot=0;
					$weight = $row['ncc']+$row['scout']+$row['ph']+$row['ff']+$row['sports']+$row['nss']+$row['dept']; 
					$tot = $percent+$row['ncc']+$row['scout']+$row['ph']+$row['ff']+$row['sports']+$row['nss']+$row['dept'];
					echo '<tr>
					<td>'.$i++.'</td>
					<td>'.$reg_user['user_name'].'</td>
					<td>'.$row['stu_name'].'</td>
					<td>'.$row['father_name'].'</td>
					<td>'.$row['category'].'</td>
					<td>'.$row['class_description'].'</td>
					<td>'.$row['mobile'].'</td>
					<td>'.$status.'</td>
					<td>'.$reg_user['datestamp'].'</td>
					<td>'.$row_inv['txnreqdate'].'</td>
					<td>'.$row['date_of_admission'].'</td>
					<td>'.$qual['exam_name'].'</td>
					<td>'.$qual['obt_marks'].'</td>
					<td>'.$qual['tot_marks'].'</td>
					<td>'.$percent.'</td>
					<td>'.$row['ncc'].'</td>
					<td>'.$row['scout'].'</td>
					<td>'.$row['ph'].'</td>
					<td>'.$row['ff'].'</td>
					<td>'.$row['sports'].'</td>
					<td>'.$row['nss'].'</td>
					<td>'.$row['dept'].'</td>
					<td>'.$weight.'</td>
					<td>'.$tot.'</td>
					</tr>';
					//die();
			
				}
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

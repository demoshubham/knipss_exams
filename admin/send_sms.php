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
$table ='';
$mismatch=0;
$buffer = '';
$i=0;
if(isset($_POST['form_submit'])){
	if($_POST['number']!=''){
		$buffer = send_sms($_POST['number'], $_POST['sms_message']);
		$i++;
	}
	else{
		if($_POST['class']=='all'){
			$sql = 'select * from register_users';
		}
		else{
			$sql = 'select * from register_users where courses="'.$_POST['class'].'"';
		}
		$i=1;
		$number='9554969777';
		//echo $sql;
		$result = execute_query($sql,dbconnect());
		while($row=mysqli_fetch_array($result)){
			if($i%100==0){
				$buffer .= send_sms($number, $_POST['sms_message']).'<br>';
				//echo $number.'<br>';
				$number = '9554969777';
			}
			$i++;
			$number .= ', '.$row['mobile'];
		}
	}
}

page_header();
?>
<?php
switch($response){
	case 1:{
?>	

<div style="width:100%; background:#027cd1; height:28px; text-align: right; color: #ffffff; font-size: 20px; font-weight: bold;">
	<div style="margin-right: 50px; float:right;"><a href="logout.php" style="color:#fff;">Logout </a>&nbsp;</div>
</div>
<div id="container" class="ltr" style="width:100%; float:none;">
	<h2> Send SMS </h2>
	<form action="send_sms.php" class="leftLabel page1 pure-form" name="admission_newadmission" enctype="multipart/form-data" method="post" onSubmit="" >
	<?php echo $msg;?>
	<table width="100%" style="border:1px solid;">	
		<tr>
			<td colspan="5">Buffer Output : <?php echo $buffer; ?> | Total : <?php echo $i; ?></td>
		</tr>
		<tr>
			<td>Enter Number : </td>
			<td><input type="text" name="number"></td>
			<td><h3>OR</h3></td>
			<td>Select Class : </td>
			<td>
				<select name="class">
					<option value="all">All</option>
					<?php
					$sql = 'select * from class_detail';
					$result = execute_query($sql,dbconnect());
					while($row = mysqli_fetch_array($result)){
						echo '<option value="'.$row['sno'].'">'.$row['class_description'].'</option>';
					}
			
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2">Message (160 Characters = 1 Message) :</td>
			<td colspan="3"><textarea name="sms_message" rows="10" cols="50"></textarea></td>
		</tr>
		<tr>
			<td colspan="2" style="text-align: center;"><input class="btTxt submit" type="submit" name="form_submit" value="Send SMS"></td>
		</tr>
	</table>
</div>

<?php
		break;
	}
}

page_footer();

?>
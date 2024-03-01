<?php
date_default_timezone_set('Asia/Calcutta');
session_cache_limiter('nocache');
session_start();
include("settings.php");
include("get_computer.php");
$tabindex=1;
$response=1;
$msg='';
$link = dbconnect();

if(isset($_POST['searc_reg'])){
	$tot_student_data = array();
	$sql = 'select * from register_users where 1=1';
	if($_POST['searc_reg']!=''){
		$sql .= ' and user_name in ('.$_POST['searc_reg'].')';
	}
	//echo $sql;
	$result = execute_query($sql,dbconnect());
	while($row = mysqli_fetch_array($result)){
		$stu = mysqli_fetch_array(execute_query("select * from student_info where sno=".$row['sno'], dbconnect()));
		$tot_student_data[]['merit'] = $row;
		$tot_student_data[]['student'] = $stu;
	}
	echo json_encode($tot_student_data);
}
?>
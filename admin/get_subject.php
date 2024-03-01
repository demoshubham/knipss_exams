<?php
session_start();
include("settings.php");
$sql = 'select * from class_detail where sno='.$_GET['q'];
//echo $sql;
$class = mysqli_fetch_array(execute_query($sql,dbconnect()));
$sql = "select * from subject_fees where class_id=".$_GET['q'];
$result = execute_query($sql,dbconnect());
//echo $sql;
$val = '';
while($row = mysqli_fetch_array($result)){
	$sql_sub="select * from add_subject where sno=".$row['subject_id']."";
	$result1=mysqli_fetch_array(execute_query($sql_sub,dbconnect()));
	$val .= '<option value="'.$result1['sno'].'">'.$result1['subject'].'</option>';
}
echo $val.'#'.$class['category'].'#'.$class['type'];
?>
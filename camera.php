<?php
session_start();

date_default_timezone_set('Asia/Calcutta');

include("settings.php");
$sql = 'select * from register_users where user_name="'.$_SESSION['username'].'"';
$register_user = mysqli_fetch_array(execute_query($sql,dbconnect()));

$sql = 'select * from student_info where sno="'.$register_user['sno'].'"';
$stu_id = mysqli_fetch_array(execute_query($sql,dbconnect()));
 

$name = date('YmdHis');
$newname="user_images/".$stu_id['sno'].".jpg";
$file = file_put_contents( $newname, file_get_contents('php://input') );
if (!$file) {
	print "ERROR: Failed to write data to $filename, check permissions\n";
	exit();
}
else
{
}

$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . '/' . $newname;
print "$newname";

?>

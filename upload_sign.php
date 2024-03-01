<?php
session_start();
include("settings.php");
if (isset ($_FILES['new_image_sign'])){
	$sql = 'select * from register_users where user_name="'.$_SESSION['username'].'"';
	$register_user = mysqli_fetch_array(execute_query($sql,dbconnect()));

	$sql = 'select * from student_info where sno="'.$register_user['sno'].'"';
	$stu_id = mysqli_fetch_array(execute_query($sql,dbconnect()));

	
	$imagename = $stu_id['sno']."_sign.jpg";
	$source = $_FILES['new_image_sign']['tmp_name'];
	$target = "user_images/".$imagename;
	move_uploaded_file($source, $target);

	$imagepath = $imagename;
	$save = "user_images/" . $imagepath; //This is the new file you saving
	$file = "user_images/" . $imagepath; //This is the original file

	list($width, $height) = getimagesize($file) ;

	$modwidth = 500;

	$diff = $width / $modwidth;

	$modheight = $height / $diff;
	$tn = imagecreatetruecolor($modwidth, $modheight) ;
	$image = imagecreatefromjpeg($file) ;
	imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ;

	imagejpeg($tn, $save, 100) ;
	$sql='update student_info set signature_id="'.$imagename.'" where sno='.$stu_id['sno'];
	execute_query($sql,dbconnect());
	/*
	$save = "images/sml_" . $imagepath; //This is the new file you saving
	$file = "images/" . $imagepath; //This is the original file

	list($width, $height) = getimagesize($file) ;

	$modwidth = 80;

	$diff = $width / $modwidth;

	$modheight = $height / $diff;
	$tn = imagecreatetruecolor($modwidth, $modheight) ;
	$image = imagecreatefromjpeg($file) ;
	imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ;

	imagejpeg($tn, $save, 100) ; */
	echo $imagepath;
	//echo "Thumbnail: <img src='images/sml_".$imagepath."'>";

}
?>
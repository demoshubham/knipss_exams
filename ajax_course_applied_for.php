<?php
include("settings.php");
 

if (isset($_GET['selected_value']) && !isset($_GET['id']) ){
    $sql = "SELECT * FROM mst_course WHERE course_type = " . $_GET['selected_value'] . " AND status = 0";
	$result = execute_query($sql);
	$msg = '<option disabled selected>---Select Your Course applying for---</option>';
	//x`$data_to_send = array();
	if ($result){
		while($row_type = mysqli_fetch_assoc($result)){
			$msg .= '<option value="'.$row_type['sno'].'" >'.$row_type['course_name'].'</option>';
		}
	}
	//$msg .= '</select>';
	echo $msg;
}

if(isset($_GET['selected_value']) && isset($_GET['id'])){
	
	$sql1 = execute_query('select * from new_student_info where sno='.$_GET['id']);
	if($sql1){
		$data = mysqli_fetch_assoc($sql1);
	}
	$sql = "SELECT * FROM mst_course WHERE course_type = " . $_GET['selected_value'] . " AND status = 0";
	$result = execute_query($sql);
	$msg = '<option disabled selected>---Select Your Course applying for---</option>';
	//x`$data_to_send = array();
	if ($result){
		while($row_type = mysqli_fetch_assoc($result)){ 
			$msg .= '<option value="'.$row_type['sno'].'" '.(isset($data['course_applying_for']) && $data['course_applying_for']==$row_type['sno']? 'selected="selected"':'').'  >'.$row_type['course_name'].'</option>';
		}
	}
	//$msg .= '</select>';
	echo $msg;
}

?>
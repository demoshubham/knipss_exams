<?php
date_default_timezone_set('Asia/Calcutta');
$time = mktime(true);
include("settings.php");

$q = htmlspecialchars(urldecode(strtoupper($_REQUEST["term"])), ENT_QUOTES);
if (!$q) return;

if(isset($_REQUEST['id'])){
	$id = $_REQUEST['id'];
}
else {
	$id='';
}
$data = array();

if($id=='villages'){
	$sql = 'select * from location_village where parent='.$q;
	$result = execute_query($sql);
	while($row = mysqli_fetch_assoc($result)){
		$data[] = array("id"=>$row['sno'], "location_name"=>$row['location_name']);
	}
}
elseif($id=='unit_dist'){
	// $arrydivisions = $_SESSION['divisions'];
	// $arraydivision = implode(',',$arrydivisions);
	$sql= 'SELECT district_id, unit_name, department FROM `transaction_new_project` left join invoice_new_project on invoice_new_project.sno = invoice_id where department="'.$_POST['val'].'" and unit_name in ('.implode(", ", $_SESSION['divisions']).') group by district_id';
	// echo $sql;
	$result = execute_query($sql);
	while($row = mysqli_fetch_assoc($result)){
		$sql = 'select * from uprnss_district where sno="'.$row['district_id'].'"';
		$district = mysqli_fetch_assoc(execute_query($sql));
		$data[] = array("id"=>$row['district_id'], "district_name"=>$district['district_name_english']);
	}
}
elseif($id=='dist'){
	
	$sql= 'SELECT district_id, department FROM `transaction_new_project` left join invoice_new_project on invoice_new_project.sno = invoice_id where department="'.$_POST['val'].'" group by district_id';
	//echo $sql;
	$result = execute_query($sql);
	while($row = mysqli_fetch_assoc($result)){
		$sql = 'select * from uprnss_district where sno="'.$row['district_id'].'"';
		$district = mysqli_fetch_assoc(execute_query($sql));
		$data[] = array("id"=>$row['district_id'], "district_name"=>$district['district_name_english']);
	}
}
elseif($id=='proj'){
	$sql = 'SELECT project_qun, sno, district_id FROM `transaction_new_project` WHERE district_id="'.$_POST['val'].'"';
	//echo $sql;
	$result = execute_query($sql);
	while($row = mysqli_fetch_assoc($result)){
		$data[] = array("id"=>$row['sno'], "project_qun"=>$row['project_qun']);
	}
}
elseif($id=='proj_detail'){
	$sql = 'select * from uprnss_project_temp where sno="'.$_POST['val'].'"';
	$project = mysqli_fetch_assoc(execute_query($sql));
	foreach($project as $k=>$v){
		$data[$k] = $v;
	}
	
}

if(empty($data)!=true){
	echo json_encode($data);
}
?>
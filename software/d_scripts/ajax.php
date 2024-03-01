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
elseif($id=='villages_selected'){
	$sql = 'select location_village.sno as sno, location_village.location_name as location_name from plv_users_villages left join location_village on location_village.sno = village_id where user_id='.$_GET['plv_id'];
	$result = execute_query($sql);
	while($row = mysqli_fetch_assoc($result)){
		$data[] = array("id"=>$row['sno'], "location_name"=>$row['location_name']);
	}
}
elseif($id=='dist'){
	$sql = 'SELECT uprnss_district.sno as sno, uprnss_district.district_name_english as district_name FROM `uprnss_project_temp` left join uprnss_district on uprnss_district .sno = district_id where division_id in ('.implode(",", $_SESSION['divisions']).') and department_id="'.$_POST['val'].'" group by district_id';
	//echo $sql;
	$result = execute_query($sql);
	while($row = mysqli_fetch_assoc($result)){
		$data[] = array("id"=>$row['sno'], "district_name"=>$row['district_name']);
	}
}

elseif($id=='proj'){
	$sql = 'SELECT uprnss_project_temp.sno as sno, uprnss_project_temp.project_name_hindi as project_name_hindi FROM `uprnss_project_temp` left join uprnss_district on uprnss_district .sno = district_id where (status="0" or status is null) and division_id in ('.implode(",", $_SESSION['divisions']).') and department_id="'.$_POST['dept'].'" and district_id="'.$_POST['val'].'"';
	//echo $sql;
	$result = execute_query($sql);
	while($row = mysqli_fetch_assoc($result)){
		$data[] = array("id"=>$row['sno'], "project_name_hindi"=>$row['project_name_hindi']);
	}
}
elseif($id=='proj_detail'){
	$sql = 'select * from uprnss_project_temp where sno="'.$_POST['val'].'"';
	$project = mysqli_fetch_assoc(execute_query($sql));
	foreach($project as $k=>$v){
		$data[$k] = $v;
	}
	
}
elseif($id=='sub_dep'){
	$sql = 'SELECT * FROM uprnss_sub_department where department_id="'.$_POST['val'].'" ';
	// echo $sql;
	$result = execute_query($sql);
	while($row = mysqli_fetch_assoc($result)){
		$data[] = array("id"=>$row['sno'], "sub_department_hindi"=>$row['sub_department_hindi']);
	}
}

if(empty($data)!=true){
	echo json_encode($data);
}
?>
<?php
date_default_timezone_set('Asia/Calcutta');
$time = mktime(true);
include("settings.php");

$q = htmlspecialchars(urldecode(strtoupper($_GET["term"])), ENT_QUOTES);
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

if(empty($data)!=true){
	echo json_encode($data);
}
?>
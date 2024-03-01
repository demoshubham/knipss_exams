<?php
if(isset($_SESSION['db_name'])){
	$db = mysqli_connect("p:localhost", "root", "mysql", $_SESSION['db_name']);
	if(!$db){
		die('1:System error contact administrator');
	}
}
else{
	$db = mysqli_connect("p:localhost", "root", "mysql", "cloudice_kniexam");
	if(!$db){
		die('1:System error contact administrator. '.mysqli_error($connect));
	}
}

/*$sql = 'SELECT DATABASE();';
$result = mysqli_fetch_assoc(mysqli_query($db, $sql));
print_r($result);
*/
	mysqli_query($db, 'SET character_set_results=utf8'); 
	mysqli_query($db, 'SET names utf8'); 
	mysqli_query($db, 'SET character_set_client=utf8'); 
	mysqli_query($db, 'SET character_set_connection=utf8'); 
	mysqli_query($db, 'SET character_set_results=utf8'); 
	mysqli_query($db, 'SET collation_connection=utf8_general_ci'); 

function execute_query($link='', $query){
	if($link==''){
		global $db;
	}
	else{
		$db = $link;	
	}
	
	$result = mysqli_query($db, $query);
	return $result;
}

function connect(){
	global $db;
	return $db;
}

function selected_dbconnect($dbname){

	$connect = mysqli_connect("localhost","root", "mysql", $dbname);

	if(!$connect){

		die('1.System error contact administrator');

	}

	return $connect;

}



function dbconnect_tc(){

	$connect = mysqli_connect("localhost","root", "mysql", $_SESSION['db_name_tc']);

	if(!$connect){

		die('1.System error contact administrator');

	}

	return $connect;	

}



function insert_id($db=''){
	global $db;
	return mysqli_insert_id($db);
}

function select_data($table, $fields, $where='', $join='', $join_on='', $union='', $union_cols=''){
	
}

function update_data($table, $fields, $values, $where){
	
}

function delete_data($table, $fields, $values, $where){
	
}

?>
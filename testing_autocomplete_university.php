 <?php
 /*
 //for only input box suggession
include("settings.php");

// university list
// echo $_GET["prev_uni_keyword"];
if (!empty($_GET["prev_uni_keyword"])) {
	$sql = 'select * from university_list where university like "'.$_GET["prev_uni_keyword"].'%"';
	$res = mysqli_query($db, $sql);
	$print = '<ul id="prev_uni">';
	if($res){
		while($row = mysqli_fetch_assoc($res)){
			$print .= '<li onclick="select_prev_uni(\''.$row['university'].'\')" >'.$row['university'].'</li>';

		}
	}
	$print	 .= '</ul>';
	echo $print;
}
*/
?>
<?php
/*
//for input box suggession and also all data comes in option box when click input box

include("settings.php");

if (!empty($_GET["prev_uni_keyword"])) {
	//$sql = 'select * from university_list where university like "'.$_GET["prev_uni_keyword"].'%"';
	$sql = 'SELECT * FROM `university_list` where university like "'.$_GET["prev_uni_keyword"].'%" ORDER BY `university` ASC';
	$res = mysqli_query($db, $sql);
	$print = '<ul id="prev_uni">';
	if($res){
		while($row = mysqli_fetch_assoc($res)){
			$print .= '<li onclick="select_prev_uni(\''.$row['university'].'\')" >'.$row['university'].'</li>';
		}
	}
	$print	 .= '</ul>';
	echo $print;
} 
else {
	//$sql = 'select * from university_list';
	$sql = 'SELECT * FROM `university_list` ORDER BY `university` ASC ';
	
	$res = mysqli_query($db, $sql);
	$print = '<ul id="prev_uni">';
	if($res){
		while($row = mysqli_fetch_assoc($res)){
			$print .= '<li onclick="select_prev_uni(\''.$row['university'].'\')" >'.$row['university'].'</li>';
		}
	}
	$print	 .= '</ul>';
	echo $print;
}
*/
?>
<?php
include("settings.php");

if (!empty($_GET["prev_uni_keyword"])) {
    $keyword = $_GET["prev_uni_keyword"];
    $sql = 'SELECT * FROM university_list WHERE university LIKE "%' . $keyword . '%"ORDER BY `university_code` ASC';
    $res = mysqli_query($db, $sql);
    $print = '<ul id="prev_uni">';
    if ($res) {
        while ($row = mysqli_fetch_assoc($res)) {
            $print .= '<li onclick="select_prev_uni(\'' . $row['university'] . '\')" >' . $row['university'] . '</li>';
        }
    }
    $print .= '</ul>';
    echo $print;
} else {
    $sql = 'SELECT * FROM university_list ORDER BY `university_code` ASC';
    $res = mysqli_query($db, $sql);
    $print = '<ul id="prev_uni">';
    if ($res) {
        while ($row = mysqli_fetch_assoc($res)) {
            $print .= '<li onclick="select_prev_uni(\'' . $row['university'] . '\')" >' . $row['university'] . '</li>';
        }
    }
    $print .= '</ul>';
    echo $print;
}
?>



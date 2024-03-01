<?php 

function dbconnect(){
	$connect = mysql_connect("localhost","root","mysql");
	if(!$connect){
		die('1.System error contact administrator');
	}
	$db = mysql_select_db("sms_default",$connect);
	if(!$db){
		die('2.System error contact administrator');
	}
	return $connect;	
}

function page_header() {
echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>School Management Software</title>
<link href="styles.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="scripts/calendar.js"></script>
<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>
</head>
<body>';
}

function page_footer() {
	echo '
	<div id="content3">
	   	<p class="footer">
	   		Copyright by <strong><a href="www.webprotechnologies.com">Webpro Technologies</a></strong> <br/>
</p>
	</div>
<script type="text/javascript">
<!--
swfobject.registerObject("FlashID");
//-->
</script>
</body>
</html>';
}

function page_left($id){
	
	$sql='select * from nav where code="'.$id.'" and display="back"';
	$row = mysql_fetch_array(mysql_query($sql,dbconnect()));
	echo '
             
       <div id="content1">
        <div id="main">
        <div id="top"></div>
        <div id="center">
		<div id="module">
		
		 <div style="float:left; margin-left:1px; font-size:13px; background:url(images/box.gif) no-repeat; width:113px; height:111px; text-align:center; color:#FFF; padding-top:25px;">
         <a href="'.$row['link'].'" style="color:#F00; text-decoration:none;  font-family: Georgia, Times New Roman, Times, serif; font-weight:bold;">Back</a> </div>'; subnav($id);
		 echo '
		</div>
		</div>
		</div>
         <div id="bottom"></div>
          </div>
          <div class="clear"></div>
          </div>';
}

function left_start() {
	echo '
	 <div id="content1">
        <div id="main">
        <div id="top"></div>
        <div id="center">
		<div id="module">';
}


function left_table() {
	echo '
	 <div id="content1">
        <div id="main">
        <div id="top"></div>
        <div id="center">
		<div id="table1">';
}
function left_end() {
	echo '
		
		</div>
		</div>
         <div id="bottom"></div>
          </div>
          <div class="clear"></div>
          </div>';
}
function nav($id){
	$sql = "select * from nav where code='".$id."' and display!='back'";
	$result = mysql_query($sql,dbconnect());
echo ' <div id="content1">
        <div id="main">
        <div id="top"></div>
        <div id="center">
		<div id="module">
	 <div style="float:left; margin:1px; font-size:13px; background:url(images/box.gif) no-repeat; width:113px; height:111px; text-align:center; color:#FFF; ">
         <a href="login.php" style="color:#F00; text-decoration:none;  font-family: Georgia, Times New Roman, Times, serif; font-weight:bold;">Home</a>
		 </div>';
	while($row = mysql_fetch_array($result)){
		echo '
		 <div style="float:left; margin:1px; font-size:13px; background:url(images/box.gif) no-repeat; width:110px; height:111px; text-align:center; color:#FFF; padding-top:25px;">
         <a href="'.$row['link'].'" style="color:#F00; text-decoration:none;  font-family: Georgia, Times New Roman, Times, serif; font-weight:bold;">'.$row['display'].'</a>
		 </div>';
	}	
echo '	 <div style="float:left; margin:1px; font-size:13px; background:url(images/box.gif) no-repeat; width:113px; height:111px; text-align:center; color:#FFF;">
         <a href="signout.php" style="color:#F00; text-decoration:none;  font-family: Georgia, Times New Roman, Times, serif; font-weight:bold;">Sign Out</a>
		 </div></div>
		</div>
		</div>
         <div id="bottom"></div>
          </div>
          <div class="clear"></div>
          </div>';
	
}
function subnav($id){
	$sql = "select * from nav where code='".$id."' and display !='back'";
	$result = mysql_query($sql,dbconnect());
	while($row = mysql_fetch_array($result)){
		echo '
		
		 <div style="float:left; margin:1px; font-size:13px; background:url(images/box.gif) no-repeat; width:110px; height:111px; text-align:center; color:#FFF; padding-top:25px;">
         <a href="'.$row['link'].'" style="color:#F00; text-decoration:none;  font-family: Georgia, Times New Roman, Times, serif; font-weight:bold;">'.$row['display'].'</a>
		 </div>';
	}
	echo '
	     <div style="float:left; margin:1px; font-size:13px; background:url(images/box.gif) no-repeat; width:113px; height:111px; text-align:center; color:#FFF; padding-top:25px;">
         <a href="signout.php" style="color:#F00; text-decoration:none;  font-family: Georgia, Times New Roman, Times, serif; font-weight:bold;">Sign Out</a>
		 </div>';
}



function randomstring(){
	$length=16;
	$chars='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	$char_length=(strlen($chars)-1);
	$string=$chars{rand(0,$char_length)};
	for($i=1;$i<$length;$i=strlen($string)){
		$r=$chars{rand(0,$char_length)};
		if($r!=$string{$i-1}){
			$string .= $r;
		}
	}
	return $string;	
}
?>

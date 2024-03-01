<?php 
ob_start();
error_reporting(E_ALL);
//error_reporting(0);
/*if($_SERVER["HTTPS"] != "on")
{
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
}*/
$erp_link = mysqli_connect("cloudice.in", "cloudice", "C3o6D4c3@741#", "cloudice_knipss_2023");

$db = mysqli_connect("p:localhost", "knipssexams", "Knip@13579", "knipssex_2023");
function show_db(){
	$connect = mysqli_connect("p:localhost", "knipssexams", "Knip@13579", "knipssex_2023");
	if(!$connect){
		die('1.System error contact administrator');
	}
	return $connect;
}

function connect(){
	$servername="localhost";
	$username1="root";
	$password="mysql";
	$dbname='cloudice_kniexam';
	$conn=new PDO ("mysql:host=$servername;dbname=$dbname",$username1,$password);
	return $conn;
}

function dbconnect(){
	$connect = mysqli_connect("p:localhost", "knipssexams", "Knip@13579", "knipssex_2023");
	if(!$connect){
		die('1.System error contact administrator');
	}
	return $connect;	
}

function execute_query($query){
	global $db;
	$result = mysqli_query($db, $query);
	return $result;
}

function page_header() {
echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome To College!</title>

<link rel="stylesheet" href="css/bootstrap.min.css">
<link href="css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/form.css" rel="stylesheet">

<link href="css/style.css"  rel="stylesheet" type="text/css" media="all" />
<link href="scripts/index.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/form.css" rel="stylesheet">
<link rel="stylesheet" href="themes/base/jquery.ui.all.css">
<link rel="stylesheet" href="css/demos.css">
<link rel="stylesheet" type="text/css" href="css/component.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="js/jquery-1.8.0.js"></script>
<script src="js/jquery-ui.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-switch.js"></script>
<script src="js/popper.js"></script>


<script src="ui/jquery.ui.core.js"></script>
<script src="ui/jquery.ui.widget.js"></script>
<script src="ui/jquery.ui.position.js"></script>
<script src="ui/jquery.ui.autocomplete.js"></script>
<script src="ui/jquery.effects.core.js"></script>
<script src="ui/jquery.effects.blind.js"></script>
<script src="ui/jquery.effects.bounce.js"></script>
<script src="ui/jquery.effects.clip.js"></script>
<script src="ui/jquery.effects.drop.js"></script>
<script src="ui/jquery.effects.fold.js"></script>
<script src="ui/jquery.effects.slide.js"></script>
<script src="ui/jquery.ui.datepicker.js"></script>
<script type="text/javascript" src="javascript/form_validator.js"></script>
<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>
<script src="scripts/wufoo.js"></script>
<script src="javascript/bpopup.js"></script>
<script type="text/javascript" src="scripts/calendar.js"></script>


<script src="scripts/wufoo.js"></script>

<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
function checkname(component) {
	var compo = document.getElementById(component).value; 
    if(compo=="") {
		document.getElementById("ima").style.display="block"
		document.getElementById("ima1").style.display="none"
	}
	else {
		document.getElementById("ima").style.display="none"
		document.getElementById("ima1").style.display="block"
	}
}
function checkpwd(component) {		
    var compo = document.getElementById(component).value;
	if(compo=="") {
		document.getElementById("pwd").style.display="block"
		document.getElementById("pwd1").style.display="none"
	}
	else {
		document.getElementById("pwd").style.display="none"
		document.getElementById("pwd1").style.display="block"
	}
}
function load_wind(id){
	window.location = id;
}
</script>
</head>

<body id="public">
<div id="wrapper">
<div id="content">
<div id="headerbg" style="">
	<div id="logo">
	<img src="images/logo.gif" height="100">
	</div>';
	$sql = 'select * from general_setting where `desc` = "college_name"';
	$col_name = mysqli_fetch_array(execute_query($sql,dbconnect()));
	echo '<h1 style="width:70%; text-align:center; border-bottom:0px; text-decoration: underline; float:left; color:#027cd1; font-size:25px; margin-top:1rem;font-weight:bolder;">'.$col_name['value'].'</h1>';

	
echo '
	<div id="clogo">
		
	</div>
</div>
<div class="clear"></div>
</div>
';
}

function page_footer() {
	echo '
	<div id="content3" >
	   	<p class="footer" style="width:100%; background:#027cd1; text-align: center; color: #ffffff; font-size: 20px; font-weight: bold;">
	   		Copyright &copy; '.date('Y').'		
		</p>
	</div>
<script type="text/javascript">
<!--
swfobject.registerObject("FlashID");
//-->
</script>
</div>
</body>
</html>';
	ob_flush();

}

function nav_index($id){
	$sql = "select * from nav where code='".$id."' and display!='back'";
	$result = execute_query($sql,dbconnect());
	while($row = mysqli_fetch_array($result)){
		echo '
			<div id="icon" >
			<a href="'.$row['link'].'"  style="width:80px;" >'.$row['display'].'</a>
			</div>
		';
	}
}
function logout(){
	date_default_timezone_set('Asia/Calcutta');
	$_SESSION['enddate']=date('y-m-d');
	$time = localtime();
	$time = $time[2].':'.$time[1].':'.$time[0];
	$_SESSION['endtime']=$time;
	$sql = "update session set s_end_time='".$_SESSION['endtime']."' where s_id='".$_SESSION['id']."' and user='".$_SESSION['uname']."'";
	//execute_query($sql,dbconnect());
	session_destroy();
	session_unset();
	session_write_close();
	echo '<div id="container" class="ltr">
	<center><h2>Logged Out Succesfully. <a href="index.php">Click Here</a> to continue or close this window</center>
	</div>';
}

function logvalidate($uid, $page){
	if(!isset($_SESSION['session_id'])){
		session_destroy();
		session_unset();
		session_write_close();
		header("Location: index.php");
	}
	else{
		$sql = 'select * from register_users where user_name="'.$_SESSION['username'].'"';
		$result = execute_query($sql,dbconnect());
		if(mysqli_num_rows($result)!=0){
			$sql = 'select * from session where s_id="'.$_SESSION['session_id'].'" and user="'.$_SESSION['username'].'" and s_start_date="'.date("Y-m-d").'" order by sno desc limit 1';
			$result1 = execute_query($sql,dbconnect());
			if(mysqli_num_rows($result1)==0){
				session_destroy();
				session_unset();
				session_write_close();
				header("Location: index.php");
			}
		}
		else{
			session_destroy();
			session_unset();
			session_write_close();
			header("Location: index.php");
		}
	}
}
function get_school_name(){
	$sql='select * from general_setting';
	$school_name=mysqli_fetch_array(execute_query($sql,dbconnect()));
	return $school_name;
	}

function page_header_store(){
echo'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome To College!</title>
<link href="css/style.css"  rel="stylesheet" type="text/css" media="all" />
<link href="scripts/index.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/form.css" rel="stylesheet">
<link rel="stylesheet" href="themes/base/jquery.ui.all.css">
<link rel="stylesheet" href="css/demos.css">
<link rel="stylesheet" type="text/css" href="css/component.css" />

<script type="text/javascript" src="scripts/calendar.js"></script>
<script src="jquery-1.8.0.js"></script>
<script src="ui/jquery.ui.core.js"></script>
<script src="ui/jquery.ui.widget.js"></script>
<script src="ui/jquery.ui.position.js"></script>
<script src="ui/jquery.ui.autocomplete.js"></script>
<script src="ui/jquery.effects.core.js"></script>
<script src="ui/jquery.effects.blind.js"></script>
<script src="ui/jquery.effects.bounce.js"></script>
<script src="ui/jquery.effects.clip.js"></script>
<script src="ui/jquery.effects.drop.js"></script>
<script src="ui/jquery.effects.fold.js"></script>
<script src="ui/jquery.effects.slide.js"></script>
<script src="ui/jquery.ui.datepicker.js"></script>
<script type="text/javascript" src="javascript/form_validator.js"></script>
<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>
<script src="scripts/wufoo.js"></script>
<script src="javascript/bpopup.js"></script>
<script type="text/javascript" language="javascript">
$(document).ready( 
	function() {
		// Add the "focus" value to class attribute
		$("input").focusin( 
			function() {
				$(this).addClass("focus");
			}
		);
		$("select").focusin( 
			function() {
				$(this).addClass("focus");
			}
		);
		$(":checkbox").focusin( 
			function() {
				$(this).addClass("focus");
			}
		);
		// Remove the "focus" value to class attribute
		$("input").focusout( 
			function() {
				$(this).removeClass("focus");
			}
		);
		$("select").focusout( 
			function() {
				$(this).removeClass("focus");
			}
		);
		$(":checkbox").focusout( 
			function() {
				$(this).removeClass("focus");
			}
		);
	}
);

</script>';
}
function page_footer_store(){
	$sql = 'select * from general_setting where `desc` = "college_name"';
	$col_name = mysqli_fetch_array(execute_query($sql,dbconnect()));

echo'   <div id="footerstick" style="float:left; background:#FFF;" class="noprint">
        <div id="container" class="ltr">
                <div id="bottomicon">
                   <a href="'.returnlink("index.php",false).'"><img style="width:50px;" src="images/back.png" /> </a>
                </div>
                <div id="bottomicon">
                    <a href="index.php"><img alt="Back To Home Page" src="images/home.png" height="50px" width="50px"></a>
                </div>
				<div id="bottomicon">
                    <a href="signout.php" style="text-decoration:none;" height="50px" width="50px"><img src="images/signout.png" style="width:50px;" /></a>
                </div>
                <img src="images/logo.gif" height="30" style="float:left; margin:10px;" />
                <a href="" height="30" style="float:right; margin:10px; font-size:20px;" />'.$col_name['value'].'</a>
        </div>
        <p style="bottom:13px; position:fixed; color:#FFF; text-align:center; width:80%;">Copyright &copy; 2017</p>        
    </div>
</div>
</body></html>';
	ob_flush();
}


function page_left($id){
	
	$sql='select * from nav where code="'.$id.'" and display="back"';
	$row = mysqli_fetch_array(execute_query($sql,dbconnect()));
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
function menu_content($id){			
	
		$sql='select * from nav where code="'.$id.'" and display!="back"';
	    $res = execute_query($sql,dbconnect());
		while($row = mysqli_fetch_array($res)) {
			
           echo '<a href="'.$row['link'].'" style="text-decoration:none">'.$row['display'].'</a>';
		}
		
}
function left_start($id) {	
	
echo ' <div  style=" float:left; position:fixed; top:10px; left:10px; " id="'.$id.'" class="sdmenu">
        <div>
        <span>Menu';
		$sql='select * from nav where code="'.$id.'" and display="back"';
	    $row = mysqli_fetch_array(execute_query($sql,dbconnect()));
		echo '<a href="'.$row['link'].'" style="text-decoration:none">'.strtoupper($row['display']).'</a>';menu_content($id);
		echo '</div></div>';	
	echo '
	 <div id="content1">
        <div id="main">
        <div id="top"></div>
        <div id="center">
		<div id="module">';
}


function left_table($id) {
	echo ' <div  style=" float:left; position:fixed; top:90px; left:10px; " id="'.$id.'" class="sdmenu">
        <div>
        <span>Menu';
		$sql='select * from nav where code="'.$id.'" and display="back"';
	    $row = mysqli_fetch_array(execute_query($sql,dbconnect()));
		echo '<a href="'.$row['link'].'" style="text-decoration:none">'.strtoupper($row['display']).'</a>';menu_content($id);
		echo '</div></div>';	
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
	$result = execute_query($sql,dbconnect());
echo ' <div id="content1">
        <div id="main">
        <div id="top"></div>
        <div id="center">
		<div id="module">
	 <div style="float:left; margin:1px; font-size:13px; background:url(images/box.gif) no-repeat; width:113px; height:111px; text-align:center; color:#FFF; ">
         <a href="index.php" style="color:#F00; text-decoration:none;  font-family: Georgia, Times New Roman, Times, serif; font-weight:bold;">Home</a>
		 </div>';
	while($row = mysqli_fetch_array($result)){
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
	$result = execute_query($sql,dbconnect());
	while($row = mysqli_fetch_array($result)){
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
	$string=$chars[rand(0,$char_length)];
	for($i=1;$i<$length;$i=strlen($string)){
		$r=$chars[rand(0,$char_length)];
		if($r!=$string[$i-1]){
			$string .= $r;
		}
	}
	return $string;	
}

function randompassword(){
	$length=8;
	$chars='abcdefghijklmnopqrstuvwxyz0123456789';
	$char_length=(strlen($chars)-1);
	$string=$chars[rand(0,$char_length)];
	for($i=1;$i<$length;$i=strlen($string)){
		$r=$chars[rand(0,$char_length)];
		if($r!=$string[$i-1]){
			$string .= $r;
		}
	}
	return $string;	
}

function randomnumber(){
	$length=9;
	$chars='0123456789';
	$char_length=(strlen($chars)-1);
	$string=$chars[rand(0,$char_length)];
	for($i=1;$i<$length;$i=strlen($string)){
		$r=$chars[rand(0,$char_length)];
		if($r!=$string[$i-1]){
			$string .= $r;
		}
	}
	return $string;	
}

function get_fees_type($class, $month, $id){
	$sql = 'select * from general_setting where `desc`="session_start_date"';
	$session = mysqli_fetch_array(execute_query($sql,dbconnect()));
	$session_start_date = $session['value'];
	$m = strtoupper(date("F",strtotime($month)));
	//echo $m;
	$date_diff = date("m",strtotime($month)) - date("m", strtotime($session_start_date));
	//$date_diff = date("m",(strtotime($month) - strtotime($session_start_date)));
	//$date_diff--;	
	
	$sql = "select * from fee_structure where class=".$class." and type=".$id;
	//echo $sql;
	$result_fees = execute_query($sql,dbconnect());
	$row_fees = mysqli_fetch_array($result_fees);
	$sql = "select * from fee_type where sno = ".$id;
	//echo $sql;
	$row_fees_type = mysqli_fetch_array(execute_query($sql,dbconnect()));
	$row_fees_type['recurring_duration'] = strtoupper($row_fees_type['recurring_duration']);
	if(is_numeric($row_fees_type['recurring_duration'])){
		if($date_diff%$row_fees_type['recurring_duration'] == 0){
			$fees = $row_fees['amount'];
		}
		else{
			$fees = 0;
		}
	}
	else{
		if($m == $row_fees_type['recurring_duration']){
			$fees = $row_fees['amount'];
		}
		else{
			$fees = 0;
		}
		
	}
	return $fees;
}

function meani() { 
?>
 
   <li  class="notranslate">       <select name="med_pl" id="med_pl" onchange="showUser(this.value)" />
       <option value="" selected="selected"></option>
       <option value="sale">Sale wise</option>
       <option value="day">Day wise</option>
       <option value="month">Month Wise</option>
    
    </div><div id="txtHint"><b>Person info will be listed here.</b></div>

       
<?php  

}?>

<?php 
 $nwords = array(    "zero", "one", "two", "three", "four", "five", "six", "seven",
  	                     "eight", "nine", "ten", "eleven", "twelve", "thirteen",
  	                     "fourteen", "fifteen", "sixteen", "seventeen", "eighteen",
                     "nineteen", "twenty", 30 => "thirty", 40 => "forty",
  	                     50 => "fifty", 60 => "sixty", 70 => "seventy", 80 => "eighty",
  	                     90 => "ninety" );
  	 function int_to_words($x)
  	 {
  	     global $nwords;
  	     if(!is_numeric($x))
 	     {
  	         $w = '#';
  	     }else if(fmod($x, 1) != 0)
  	     {
  	         $w = '#';
  	     }else{
  	         if($x < 0)
  	         {
  	             $w = 'minus ';
  	             $x = -$x;
  	         }else{
  	             $w = '';
  	         }
  	         if($x < 21)
 	         {
  	             $w .= $nwords[$x];
  	         }else if($x < 100)
  	         {
  	             $w .= $nwords[10 * floor($x/10)];

  	             $r = fmod($x, 10);
  	             if($r > 0)
  	             {
  	                 $w .= '-'. $nwords[$r];
  	             }
  	         } else if($x < 1000)
  	         {
  	             $w .= $nwords[floor($x/100)] .' hundred';
  	             $r = fmod($x, 100);
  	             if($r > 0)
  	             {
  	                 $w .= ' and '. int_to_words($r);
  	             }
  	         } else if($x < 1000000)
  	         {
  	             $w .= int_to_words(floor($x/1000)) .' thousand';
  	             $r = fmod($x, 1000);
  	             if($r > 0)
  	             {
  	                 $w .= ' ';
  	                 if($r < 100)
  	                 {
  	                     $w .= 'and ';
  	                 }
  	                 $w .= int_to_words($r);
  	             }
 	         } else {
  	             $w .= int_to_words(floor($x/1000000)) .' million';
  	             $r = fmod($x, 1000000);
  	             if($r > 0)
  	             {
  	                 $w .= ' ';
  	                 if($r < 100)
  	                 {
  	                     $word .= 'and ';
 	                 }
  	                 $w .= int_to_words($r);
  	             }
  	         }
  	     }
  	     return $w;
  	 }
	 function convert_num_to_string($number){
   $no = round($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'One', '2' => 'Two',
    '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
    '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
    '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
    '13' => 'Thirteen', '14' => 'Fourteen',
    '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
    '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
    '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
    '60' => 'Sixty', '70' => 'Seventy',
    '80' => 'Eighty', '90' => 'Ninety');
   $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
     $words[$point = $point % 10] : '';
 	echo $result;
	//echo $result;
}

function gen_fees(){
	$msg ='';
	set_time_limit(0);
	$i=0;
	$sql = "select * from general_setting where `desc`='session_start_date'";
	$row_settings = mysqli_fetch_array(execute_query($sql,dbconnect()));
	$date = $row_settings['value'];
	while(date("Y-m",strtotime($date)) <= date("Y-m")){
		$date_check = date("Y-m",strtotime($date));	
		$sql = "select * from student_info";
		$result_student = execute_query($sql,dbconnect());
		while($row_student = mysqli_fetch_array($result_student)){
			$sql = "select * from fee_invoice where stud_id=".$row_student['sno']." and `date` like '".$date_check."%'";
			$result_invoice = execute_query($sql,dbconnect());
			if(mysqli_num_rows($result_invoice) == 0){
				$sql = "select * from section where sno=".$row_student['class'];
				$result_class = execute_query($sql,dbconnect());
				if(mysqli_num_rows($result_class) == 1){
					$row_class = mysqli_fetch_array($result_class);
					$sql = "select * from fee_structure where class=".$row_class['sno'];
					$result_fees = execute_query($sql,dbconnect());
					if(mysqli_num_rows($result_fees)>0){
						calculate_fees($row_student['sno'], $row_class['sno'], $date, $row_settings['value']);
					}
					else {
						$msg .= '<li>Fee structure not defined for class '.$row_class['class_desc'].' </li>';
					}
				}
				else {
					$msg .= '<li>Invalid Class '.$row_student['class'].' </li>';
				}
			}
		}
		$date = date("Y-m-d",strtotime(date("Y-m-d", strtotime($date)) . " +1 month"));
	}	
}

function calculate_fees($stud_id, $class, $date, $session_start_date){
	$date_diff = date("m",(strtotime($date) - strtotime($session_start_date)));
	$date_diff--;
	$sql = "insert into fee_invoice (stud_id, tot_amount, amount_due, `date`) values 
	('".$stud_id."', 0,0,'".$date."')";
	execute_query($sql,dbconnect());
	
	$sql = "select * from fee_invoice order by sno desc limit 1";
	$invoice_no = mysqli_fetch_array(execute_query($sql,dbconnect()));
	
	$sql = "select * from fee_structure where class=".$class;
	$result_fees = execute_query($sql,dbconnect());
	while($row_fees = mysqli_fetch_array($result_fees)){
		$sql = "select * from fee_type where sno = ".$row_fees['type'];
		$row_fees_type = mysqli_fetch_array(execute_query($sql,dbconnect()));
		if($date_diff%$row_fees_type['recurring_duration'] == 0){
			$sql = "insert into fee_trans (fee_type, invoice_no, amount, amount_due, `date`) values
			(".$row_fees_type['sno'].", ".$invoice_no['sno'].", ".$row_fees['amount'].", ".$row_fees['amount'].", '$date')";
			execute_query($sql,dbconnect());
			$sql = "update fee_invoice set tot_amount = tot_amount+".$row_fees['amount'].", amount_due = amount_due+".$row_fees['amount']." where sno=".$invoice_no['sno'];
			execute_query($sql,dbconnect());
		}
	}

}

function get_fees($stud_id, $date){
	//echo $date;
	$fees['tot_fees']=0;
	$fees['print']='';
	$sql = 'select * from general_setting where `desc`="session_start_date"';
	$session = mysqli_fetch_array(execute_query($sql,dbconnect()));
	$session_start_date = $session['value'];
	$month = trim(strtoupper(date("F",strtotime($date))));
	$date_diff = date("m",strtotime($date)) - date("m", strtotime($session_start_date));
	if($date_diff<0){
		$date_diff = $date_diff+12;
	}
	
	$sql = "select * from student_info where sno=".$stud_id;
	$student = mysqli_fetch_array(execute_query($sql,dbconnect()));
	
	$sql = "select * from fee_structure join fee_type on fee_structure.type = fee_type.sno where fee_type.parent=0 and class=".$student['class']." order by type";
	$result_fees = execute_query($sql,dbconnect());
	while($row_fees = mysqli_fetch_array($result_fees)){
		if(is_numeric($row_fees['recurring_duration'])){
			if($date_diff%$row_fees['recurring_duration'] == 0){
				if(($_SESSION['old_admission']==1 && $row_fees['type']==1) || ($student['oa']==1 && $row_fees['type']==1)){
					$fees['print'] .= '<td>NA<br />';
				}
				elseif(($_SESSION['new_admission']==1 && $row_fees['type']==7) || ($student['oa']==0 && $row_fees['type']==7)){
					$fees['print'] .= '<td>NA<br />';
				}
				else{
					$fees['tot_fees'] += $row_fees['amount'];
					$fees['print'] .= '<td>'.$row_fees['amount'].'<br />';
				}
			}
			else{
				$fees['print'] .= '<td>&nbsp;';
			}
		}
		else{
			$row_fees['recurring_duration'] = strtoupper(trim($row_fees['recurring_duration']));
			//$row_fees_type['recurring_duration']=$month;
			if($row_fees['recurring_duration'] == $month){
				$fees['tot_fees'] += $row_fees['amount'];
				$fees['print'] .= '<td>'.$row_fees['amount'].'<br />';
			}
			else{
				$fees['print'] .= '<td>&nbsp;';
			}
		}
		$sql = "select * from fee_type join fee_structure on fee_type.sno = fee_structure.type where parent = ".$row_fees['type']." and class=".$student['class'];
		$result_fees_type = execute_query($sql,dbconnect());
		if(mysqli_num_rows($result_fees_type)>0){
			while($row_fees_type = mysqli_fetch_array($result_fees_type)){
				if(is_numeric($row_fees_type['recurring_duration'])){
					if($date_diff%$row_fees_type['recurring_duration'] == 0){
						if($_SESSION['old_admission']==1 && $row_fees['type']==1){
							$fees['print'] .= 'NA';
						}
						elseif($_SESSION['new_admission']==1 && $row_fees['type']==7){
							$fees['print'] .= '<td>NA<br />';
						}
						else{
							$fees['tot_fees'] += $row_fees['amount'];
							$fees['print'] .= $row_fees['amount'].'';
						}
					}
					else{
						$fees['print'] .= '&nbsp;';
					}
				}
				else{
					$row_fees_type['recurring_duration'] = strtoupper(trim($row_fees_type['recurring_duration']));
					//$row_fees_type['recurring_duration']=$month;
					if($row_fees_type['recurring_duration'] == $month){
						$fees['tot_fees'] += $row_fees_type['amount'];
						$fees['print'] .= $row_fees_type['desc'].' Fees<br>'.$row_fees_type['amount'].'</td>';
					}
					else{
						$fees['print'] .= '&nbsp;';
					}
				}
			}
			$fees['print'] .= '</td>';
		}
	}
	$fees['print'] .= '<td>'.$fees['tot_fees'].'</td>';
	return $fees;

}
function get_fees_con($stud_id, $date, $type){
	//echo $date;
	$fees['tot_fees']=0;
	$fees['print']='';
	$sql = 'select * from general_setting where `desc`="session_start_date"';
	$session = mysqli_fetch_array(execute_query($sql,dbconnect()));
	$session_start_date = $session['value'];
	$date_diff = date("m",strtotime($date)) - date("m", strtotime($session_start_date));
	if($date_diff<0){
		$date_diff = $date_diff+12;
	}
	
	$sql = "select * from student_info where sno=".$stud_id;
	$student = mysqli_fetch_array(execute_query($sql,dbconnect()));
	$sql = 'select * from student_convey_fee where student_id="'.$student['sno'].'" and `type`="'.$type.'"';
	$row_fees_type = mysqli_fetch_array(execute_query($sql,dbconnect()));
	$sql = "select * from route where sno = ".$row_fees_type['route_id'];
	$result_fees = execute_query($sql,dbconnect());
	while($row_fees = mysqli_fetch_array($result_fees)){
		//echo $date.'-'.$date_diff.'--'.$row_fees_type['recurring_duration'].'--'.$row_fees['type'].'<br>';
				$fees['tot_fees'] += $row_fees['rate'];
				$fees['print'] .= '<td>'.$row_fees['rate'].'</td>';
	}
	$fees['print'] .= '<td>'.$fees['tot_fees'].'</td>';
	return $fees;

}

function get_pending_fees_con($id, $doa,$type){
	$sql = 'select * from general_setting where `desc`="current_date"';
	$cur = mysqli_fetch_array(execute_query($sql,dbconnect()));
	$cur_date = $cur['value'];
	
	$fees=0;
	$fee_test=0;
	while($doa<=$cur_date){
		$sql='select * from fee_invoice_convey where student_id="'.$id.'" and `payment_date`="'.$doa.'" and `type`="'.$type.'"';
		$stud_inv = execute_query($sql,dbconnect());
		if(mysqli_num_rows($stud_inv)==0){
			$fee_test = get_fees_con($id,$doa,$type);
			$fees += $fee_test['tot_fees'];
			//echo $fees.'<br>';
			//echo $i++.'.'.get_fees($row['sno'],$doa).'<br>';
		}
		else{
			while($row_inv = mysqli_fetch_array($stud_inv)){
				if($row_inv['amount_due']!=0){
					$fees += $row_inv['amount_due'];
				}
			}
		}
		$doa = date("Y-m-d",strtotime(date("Y-m-d", strtotime($doa)) . " +1 month"));
		//break;
	}	
	return $fees;
}

function get_pending_fees($id, $doa, $cur_date=0){
	if($cur_date==0){
		$sql = 'select * from general_setting where `desc`="current_date"';
		$cur = mysqli_fetch_array(execute_query($sql,dbconnect()));
		$cur_date = $cur['value'];	
	}
	//echo $doa.'--'.$cur_date.'<br>';
	$fees=0;
	$fee_test=0;
	while($doa<=$cur_date){
		$sql='select * from fee_invoice_trans where student_id="'.$id.'" and `payment_date`="'.$doa.'"';
		if($id==726){
			//echo $sql.'<br>';
		}
		$stud_inv = execute_query($sql,dbconnect());
			$fee_test = get_fees($id,$doa);
			$fees += $fee_test['tot_fees'];
			//echo $fees.'<br>';
			//echo $i++.'.'.get_fees($row['sno'],$doa).'<br>';
			while($row_inv = mysqli_fetch_array($stud_inv)){
				if($row_inv['amount_due']!=0){
					$fees += $row_inv['amount_due'];
				}

			}
		$doa = date("Y-m-d",strtotime(date("Y-m-d", strtotime($doa)) . " +1 month"));
		
		//break;
	}	
	return $fees;
}

function returnlink($defaulturl='index.php', $override=false){
	// initialise variables
	$c = 0;
	$url = '';
	
	// check that the history container exists
	// if so check it has something in it and set $url
	if(isset($_SESSION['history'])){
		$c = count($_SESSION['history']);
	    $url = ($c > 0) ? $_SESSION['history'][$c-1] : '';
    } 

	// check for use $defaulturl conditions
	// $c may still be > 0 if the page was accessed directly
	// but $url will be blank
	if($override || $c == 0 || $url == ''){
		return $defaulturl;
	}
	else{
		return $url;  
	} 
}

function sethistory(){
	// make sure the container array exists
	// the paranoid will also check here that sessions are even being used 
	if(!isset($_SESSION['history'])){
	  $_SESSION['history'] = array();
	}
	
	// make an easier to use reference to the container
	$h =& $_SESSION['history'];

	// get the referring page and this page
	// we need to construct matching strings
	// put the referring page straight in the array
	$h[] = $from = $_SERVER['HTTP_REFERER']; 
	$here = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	
	// find out how many elements we have
	$count = count($h);
	
	//don't waste memory - trim off old entries
	while($count>20){
		array_shift($h);
		$count--;
	}
	
	// don't want to get stuck in a reference loop
	// this can be falsely triggered by pages that link to each other 
	// but hopefully rarely and the button will still behave rationally
	// also catches use of the browser 'Back' button/key
	// remove last two items to rewind history state
	while($count > 1 && $h[$count-2] == $here){
		array_pop($h);
		array_pop($h);
		$count -= 2; 
	}
	
	// don't want to get stuck on one page either
	// for pages that process themselves or are returned to after process script
	// remove last item to rewind history state
	while($count > 0 && $h[$count-1] == $here){
		array_pop($h);
		$count--;
	}
	// all done
	return;
}

function get_class_name($id){
	$sql = 'select * from section join class on section.class_desc = class.sno where section.sno='.$id;
	$row = mysqli_fetch_array(execute_query($sql,dbconnect()));
	return $row;
}

function get_student_info($id){
	$sql = 'select * from student_info where sno='.$id;
	$stud = mysqli_fetch_array(execute_query($sql,dbconnect()));
	$class = get_class_name($stud['class']);
	$stud['class_name'] = $class['class_desc'];
	return $stud;
}
function get_cgpa($grade){
	if($grade=='A1'){
		$grade_point=10;
	}
	if($grade=='A2'){
		$grade_point=9;
		
	}
	if($grade=='B1'){
		$grade_point=8;
		
	}
	if($grade=='B2'){
		$grade_point=7;
		
	}
	if($grade=='C1'){
		$grade_point=6;
		
	}
	if($grade=='C2'){
		$grade_point=5;
		
	}
	if($grade=='D'){
		$grade_point=4;
		
	}
	if($grade=='E1'){
		$grade_point=3;
		
	}
	if($grade=='E2'){
		$grade_point=2;
	}
	return $grade_point;
}
function get_class_detail($id){
	$sql = 'select * from class_detail where sno='.$id;
	//echo $sql;
	$sub = mysqli_fetch_array(execute_query($sql,dbconnect()));
	return $sub;
}
function get_subject_detail($id){
	if($id==''){
		return;
	}
	$sql = 'select * from add_subject where sno='.$id;
	$result = execute_query($sql,dbconnect());
	$sub=mysqli_fetch_array($result);
	return $sub;
}
function send_sms($number,$get_msg){
	/*$msg = array(
	0 => substr($get_msg,0,158),
	1 => substr($get_msg,159,158),
	2 => substr($get_msg,318,158),
	3 => substr($get_msg,477,158));
	foreach($msg as $k => $v){
	   if(!empty($v)){*/
		   $ch = curl_init();
		   $user="20142140";
		   $pwd="9554969777";
		   $no=$number;
		   $senderID="KNIPSS";
		   $param = "uname=$user&pass=$pwd&send=$senderID&dest=$no&msg=".$get_msg;
		   //echo $param.'<br>';
		   curl_setopt($ch,CURLOPT_URL,  "http://103.247.98.91/API/SendMsg.aspx");
		   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		   curl_setopt($ch, CURLOPT_POST, 1);
		   curl_setopt($ch,CURLOPT_POSTFIELDS,$param);
		   $buffer = curl_exec($ch);
		   if(empty($buffer)){
			   //echo "<script>alert('Buffer Is Empty);</script>";
			   return $buffer;
		   }
		   else{
			   //echo "<script>alert('$buffer');</script>";
			   return $buffer;
		   }
	   /*}
	}*/
}

function get_grade($total,$marks){
	if($marks!=0){
		$per=($marks*100/$total);
		if(90< $per && $per<=100){
			return A1;
		}
		else if(80<$per && $per<=90){
			return A2;
		}
		else if(70<$per && $per<=80){
			return B1;
		}
		else if(60<$per && $per<=70){
			return B2;
		}
		else if(50<$per && $per<=60){
			return C1;
		}
		else if(40<=$per && $per<=50){
			return C2;
		}
		else if(33<=$per && $per<=39){
			return D;
		}
		else if(21<=$per && $per<=32){
			return E1;
		}
		else if(00<=$per && per<=20){
			return E2;
		}
	}
}
function integerToRoman($integer)
{
 // Convert the integer into an integer (just to make sure)
 $integer = intval($integer);
 $result = '';
 
 // Create a lookup array that contains all of the Roman numerals.
 $lookup = array('M' => 1000,
 'CM' => 900,
 'D' => 500,
 'CD' => 400,
 'C' => 100,
 'XC' => 90,
 'L' => 50,
 'XL' => 40,
 'X' => 10,
 'IX' => 9,
 'V' => 5,
 'IV' => 4,
 'I' => 1);
 
 foreach($lookup as $roman => $value){
  // Determine the number of matches
  $matches = intval($integer/$value);
 
  // Add the same number of characters to the string
  $result .= str_repeat($roman,$matches);
 
  // Set the integer to be the remainder of the integer and the value
  $integer = $integer % $value;
 }
 
 // The Roman numeral should be built, return it
 return $result;
}
function get_position($srno){
}
?>
<?php
error_reporting(E_ALL & ~E_DEPRECATED);
sethistory();
date_default_timezone_set('Asia/Calcutta');
error_reporting(0);
sethistory();

function connect(){
	return dbconnect();
}

function dbconnect(){
	$connect = mysqli_connect("localhost","cloudice_knipss", "Knip@13579", $_SESSION['db_name']);
	if(!$connect){
		die('1.System error contact administrator');
	}
	return $connect;	
}

function execute_query($con, $sql, $misc1='', $misc2=''){
	if (strpos($sql, 'insert') !== false) {
		$db_name = $_SESSION['db_name'].'_bk';
		$connect = mysqli_connect("localhost","cloudice_knipss_bk", "Knip@13579", $db_name);
		if($connect){
			mysqli_query($connect, $sql);
		}
	}
	if (strpos($sql, 'update') !== false) {
		$db_name = $_SESSION['db_name'].'_bk';
		$connect = mysqli_connect("localhost","cloudice_knipss_bk", "Knip@13579", $db_name);
		if($connect){
			mysqli_query($connect, $sql);
		}
	}
	if (strpos($sql, 'delete') !== false) {
		$db_name = $_SESSION['db_name'].'_bk';
		$connect = mysqli_connect("localhost","cloudice_knipss_bk", "Knip@13579", $db_name);
		if($connect){
			mysqli_query($connect, $sql);
		}
	}
	return mysqli_query($con, $sql);

}



function page_header() {
echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome To KNITPG COLLEGE!</title>
<script type="text/javascript" src="scripts/calendar.js"></script>

<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/form.css" rel="stylesheet">


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
<div id="logo">
  <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="500" height="130" id="FlashID" title="webpro technologies">
    <param name="movie" value="images/logo.swf" />
    <param name="quality" value="high" />
    <param name="wmode" value="transparent" />
    <param name="swfversion" value="8.0.35.0" />
    <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you dont want users to see the prompt. -->
    <param name="expressinstall" value="Scripts/expressInstall.swf" />
    <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
    <!--[if !IE]>-->
    <object type="application/x-shockwave-flash" data="images/logo.swf" width="500" height="130">
      <!--<![endif]-->
      <param name="quality" value="high" />
      <param name="wmode" value="transparent" />
      <param name="swfversion" value="8.0.35.0" />
      <param name="expressinstall" value="Scripts/expressInstall.swf" />
      <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
      <div>
        <h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
        <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" width="112" height="33" /></a></p>
	  </div>
    <!--[if !IE]>-->
    </object>
    <!--<![endif]-->
  </object>
</div>
<div id="clogo">
	<img src="images/clogo.gif">
</div>

<div class="clear"></div>
';
}

function page_footer() {
	echo '
	  <div id="footerstick" style="float:left; background:#FFF;">
        <p style="bottom:13px; position:fixed; color:#FFF; text-align:center; width:900px;">
        	Copyright by <strong><a href="http://www.webprotechnologies.com" style="color:#FFF">Webpro Technologies</a></strong> <br/>
        </p>        
  </div>
</body></html>
<script type="text/javascript">
<!--
swfobject.registerObject("FlashID");
//-->
</script>
</div>	
</body>
</html>';
}

function page_header_store(){
echo'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome To KNITPG College!</title>
<link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
<link href="scripts/index.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/form.css" rel="stylesheet">
<link rel="stylesheet" href="themes/base/jquery.ui.all.css">
<link rel="stylesheet" href="css/demos.css">

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
<script src="javascript/bpopup.js"></script>';
}
function total_price($id, $rate){
	$query = "SELECT * FROM stock_available where sno=".$id; 
	$result = execute_query(connect(), $query);
	$row = mysqli_fetch_array($result);
	if($row['relative']!=0){
		if($rate == 0){
			$rate += total_price($row['relative'],0);
		}
		$purchase = $rate+$row['purchase_price'];
		$excise = $purchase+($purchase*($row['excise']/100));
		$vat = $excise+($excise*($row['vat']/100));
		$mrp = round($vat,2);
		return $mrp;
	}
	else {
		$excise = $row['purchase_price']+($row['purchase_price']*($row['excise']/100));
		$vat = $excise+($excise*($row['vat']/100));
		$rate += $vat;
		$mrp = round($rate,2);
		return $mrp;
	}
}
function page_footer_store(){
echo'   <div id="footerstick" style="float:left; background:#FFF;">
        <div id="container" class="ltr">
                <div id="bottomicon">
                   <a href="'.returnlink("login.php",false).'"><img style="width:50px;" src="images/back.png" /> </a>
                </div>
                <div id="bottomicon">
                    <a href="login.php"><img alt="Back To Home Page" src="images/home.png" height="50px" width="50px"></a>
                </div>
                <div id="bottomicon">
                    <a href="counsellor_report.php">View Report</a>
                </div>
                <div id="bottomicon">
                    <a href="manufacture_plate.php"><img src="images/store3.gif" height="50px" width="50px"></a>
                </div>
                <div id="bottomicon">
                    <a href="manufacture_plate_negative.php"><img src="images/store4.gif" height="50px" width="50px"></a>
                </div>
				<div id="bottomicon">
                    <a href="signout.php" style="text-decoration:none;" height="50px" width="50px"><img src="images/signout.png" style="width:50px;" /></a>
                </div>
                <img src="images/logo.gif" height="30" style="float:left; margin:10px;" />
                <img src="images/clogo.gif" height="30"  style="float:right; margin:10px;" />
        </div>
        <p style="bottom:13px; position:fixed; color:#FFF; text-align:center; width:900px;">
        	Copyright by <strong><a href="http://www.webprotechnologies.com" style="color:#FFF">Webpro Technologies</a></strong> <br/>
        </p>        
    </div>
</div>
</body></html>';
}

function nav($id){
	$sql = "select * from nav where code='".$id."' and display!='back'";
	$result = execute_query(connect(), $sql);
	while($row = mysqli_fetch_array($result)){
		echo '
			<div id="icon" >
			<a href="'.$row['link'].'"  style="width:80px;" >'.$row['display'].'</a>
			</div>
		';
	}
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

function logout(){
	date_default_timezone_set('Asia/Calcutta');
	$_SESSION['enddate']=date('y-m-d');
	$time = localtime();
	$time = $time[2].':'.$time[1].':'.$time[0];
	$_SESSION['endtime']=$time;
	/*$sql = "update session set s_end_time='".$_SESSION['endtime']."' where s_id='".$_SESSION['id']."' and user='".$_SESSION['uname']."'";
	execute_query(connect(), $sql);*/
	session_destroy();
	session_unset();
	session_write_close();
	echo '<div id="container" class="ltr">
	<center><h2>Logged Out Succesfully. <a href="login.php">Click Here</a> to continue or close this window</center>
	</div>';
}
function logvalidate($uid, $page){
	if(!isset($_SESSION['session_id'])){
		header("Location: login.php");
	}
	else{
		$sql = 'select * from user where userid="'.$_SESSION['username'].'" and pwd="'.$_SESSION['userpwd'].'"';
		$result = execute_query(connect(), $sql);
		if(mysqli_num_rows($result)!=0){
			echo '';
		}
		else{
			session_destroy();
			session_unset();
			session_write_close();
			header("Location: login.php");
		}
	}
}
function add_stock($desc, $unit_price, $unit, $opening){
	$sql = 'select * from stock_available where description="'.$desc.'"';
	$result = execute_query(connect(), $sql);
	if(mysqli_num_rows($result)==0){
		$sql = "insert into stock_available (description, purchase_price, unit, available_quantity, vat, excise, company, sale_price, manufacturing_ratio, warranty, opening) values
		('$desc', '$unit_price', '$unit', 0, 0, 0, 0, 0, 0, 0, '$opening')";
		execute_query(connect(), $sql);
		$sql = 'select * from stock_available order by sno desc limit 1';
		$row_stock = mysqli_fetch_array(execute_query(connect(), $sql));
		$sql = 'select * from store';
		$comma=0;
		$result = execute_query(connect(), $sql);
		return $row_stock['sno'];
	}
	else {
		$row = mysqli_fetch_array($result);
		$sql = "update stock_available set
		purchase_price = '$unit_price',
		unit = '$unit',
		opening = '$opening'
		where sno=".$row['sno'];
		execute_query(connect(), $sql);
		return $row['sno'];
	}
}

function add_customer($name, $address, $mobile, $tin, $sno, $balance){
	$name = trim($name);
	$address = trim($address);
	$mobile = trim($mobile);
	$tin = trim($tin);
	if($sno==''){
		$sql = 'select * from customer where sup_name = "'.$name.'" and address = "'.$address.'" and mobile="'.$mobile.'" and tin = "'.$tin.'"';
		$result = execute_query(connect(), $sql);
		if(mysqli_num_rows($result)==0){
			$sql = 'insert into customer (sup_name, address, mobile, opening, tin) values
			("'.$name.'", "'.$address.'", "'.$mobile.'", "'.$balance.'", "'.$tin.'")';
			execute_query(connect(), $sql);
			$sql = 'select * from customer order by sno desc limit 1';
			$supplier = mysqli_fetch_array(execute_query(connect(), $sql));
			return $supplier['sno'];
		}
		else {
			$supplier = mysqli_fetch_array($result);
			return $supplier['sno'];
		}
	}
	else {
		$sql = 'update customer set 
		sup_name = "'.$name.'", 
		address = "'.$address.'", 
		mobile="'.$mobile.'", 
		tin = "'.$tin.'"';
		if($balance!=0){
			$sql .= ', opening = "'.$balance.'"';
		}
		$sql .= ' where sno='.$sno;
		execute_query(connect(), $sql);
		return $sno;
	}
}

function total_sale($sno){
	$sql = 'select sum(amount) as amount from stock_sale where part_id='.$sno;
	$row = mysqli_fetch_array(execute_query(connect(), $sql));
	return $row['amount'];
}

function total_purchase($sno){
	$sql = 'select sum(amount) as amount from stock_purchase where part_id='.$sno;
	$row = mysqli_fetch_array(execute_query(connect(), $sql));
	return $row['amount'];
}

function stock_transfer($id, $from, $to, $qty){
	if($from == 0){
		$sql = 'select * from store_available where part_id='.$id.' and storeid in ('.$to.')';
		$result = execute_query(connect(), $sql);
		if(mysqli_num_rows($result)==0){
			$sql = 'insert into store_available (part_id, qty, storeid) values ('.$id.', 0, '.$to.')';
			execute_query(connect(), $sql);
			
		}
		$sql = 'update store_available set qty = qty+'.$qty.' where part_id='.$id.' and storeid='.$to;
		execute_query(connect(), $sql);
		
	}
	elseif($to == 0){
		$sql = 'select * from store_available where part_id='.$id.' and storeid in ('.$from.')';
		$result = execute_query(connect(), $sql);
		if(mysqli_num_rows($result)==0){
			$sql = 'insert into store_available (part_id, qty, storeid) values ('.$id.', 0, '.$from.')';
			execute_query(connect(), $sql);
			
		}
		$sql = 'update store_available set qty = qty-'.$qty.' where part_id='.$id.' and storeid='.$from;
		execute_query(connect(), $sql);
		
	}
	else {
		$sql = 'select * from store_available where part_id='.$id.' and storeid in ('.$from.','.$to.')';
		$result = execute_query(connect(), $sql);
		if(mysqli_num_rows($result)==0){
			$sql = 'insert into store_available (part_id, qty, storeid) values ('.$id.', 0, '.$from.'), ('.$id.', 0, '.$to.')';
			execute_query(connect(), $sql);
			
		}
	
		$sql = 'select * from store_available where part_id='.$id.' and storeid in ('.$from.','.$to.')';
		$result = execute_query(connect(), $sql);
		if(mysqli_num_rows($result)==1){
			$row = mysqli_fetch_array($result);
			if($row['storeid']==$from){
				$sql = 'insert into store_available (part_id, qty, storeid) values ('.$id.', 0, '.$from.')';
				execute_query(connect(), $sql);
			}
			else {
				$sql = 'insert into store_available (part_id, qty, storeid) values ('.$id.', 0, '.$to.')';
				execute_query(connect(), $sql);
			}				
		}
	
		$sql = 'select * from store_available where part_id='.$id.' and storeid in ('.$from.','.$to.')';
		$result = execute_query(connect(), $sql);
		if(mysqli_num_rows($result)==2){
			$sql = 'update store_available set qty = qty-'.$qty.' where part_id='.$id.' and storeid='.$from;
			execute_query(connect(), $sql);
			$sql = 'update store_available set qty = qty+'.$qty.' where part_id='.$id.' and storeid='.$to;
			execute_query(connect(), $sql);
		}
	}
}

function sethistory(){
	// make sure the container array exists
	// the paranoid will also check here that sessions are even being used 
	if(!isset($_SESSION['history'])){
	  $_SESSION['history'] = array();
	}
	$_SERVER['HTTP_REFERER'] = !isset($_SERVER['HTTP_REFERER']) ? '' : $_SERVER['HTTP_REFERER'];
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

function get_ledger($sno){
	$sql = 'select * from customer where sno='.$sno;
	$row = mysqli_fetch_array(execute_query(connect(), $sql));
	return $row['sup_name']; 
}

function get_cust_balace($from,$to,$id){
	if($from!='' && $to!=''){
			$sql_trans = 'select sum(amount) as trans from customer_transactions where timestamp<"'.$from.'" and type in ("PAYMENT","sale") and cust_id='.$id;
			$dr_trans = mysqli_fetch_array(execute_query(connect(), $sql_trans));
			$sql_trans = 'select sum(amount) as trans from customer_transactions where timestamp<"'.$from.'" and type in ("RECIEPT","purchase") and cust_id='.$id;
			$cr_trans = mysqli_fetch_array(execute_query(connect(), $sql_trans));
			$sql_journal = 'select sum(amount) as journal from journal_entry where timestamp<"'.$from.'" and `by`='.$id;
			$journal_cr = mysqli_fetch_array(execute_query(connect(), $sql_journal));
			$sql_journal = 'select sum(amount) as journal from journal_entry where timestamp<"'.$from.'" and `to`='.$id;
			$journal_dr = mysqli_fetch_array(execute_query(connect(), $sql_journal));
			$tot_journal = $journal_dr['journal'] - $journal_cr['journal'];
			$sql = 'select * from customer where sno='.$id;
			$customer = mysqli_fetch_array(execute_query(connect(), $sql));
			$cust_opening = $customer['opening']+$dr_trans['trans'] - $cr_trans['trans'] + $tot_journal;
			$sql_trans = 'select sum(amount) as trans from customer_transactions where timestamp>="'.$from.'" and timestamp<="'.$to.'" and type in ("PAYMENT","sale") and cust_id='.$id;
			$dr_trans = mysqli_fetch_array(execute_query(connect(), $sql_trans));
			$sql_trans = 'select sum(amount) as trans from customer_transactions where timestamp>="'.$from.'" and timestamp<="'.$to.'" and type in ("RECIEPT","purchase") and cust_id='.$id;
			$cr_trans = mysqli_fetch_array(execute_query(connect(), $sql_trans));
			$sql_journal = 'select sum(amount) as journal from journal_entry where timestamp>="'.$from.'" and timestamp<="'.$to.'" and `by`='.$id;
			$journal_cr = mysqli_fetch_array(execute_query(connect(), $sql_journal));
			$sql_journal = 'select sum(amount) as journal from journal_entry where timestamp>="'.$from.'" and timestamp<="'.$to.'" and `to`='.$id;
			$journal_dr = mysqli_fetch_array(execute_query(connect(), $sql_journal));
			$tot_journal = $journal_dr['journal'] - $journal_cr['journal'];
			$cust_balanace = $cust_opening+$dr_trans['trans'] - $cr_trans['trans'] + $journal_dr['journal'] - $journal_cr['journal'];
			return $cust_balanace;
		}
		elseif($from!=''){
			$sql_trans = 'select sum(amount) as trans from customer_transactions where timestamp<"'.$from.'" and type in ("PAYMENT","sale") and cust_id='.$id;
			$dr_trans = mysqli_fetch_array(execute_query(connect(), $sql_trans));
			$sql_trans = 'select sum(amount) as trans from customer_transactions where timestamp<"'.$from.'" and type in ("RECIEPT","purchase") and cust_id='.$id;
			$cr_trans = mysqli_fetch_array(execute_query(connect(), $sql_trans));
			$sql_journal = 'select sum(amount) as journal from journal_entry where timestamp<"'.$from.'" and `by`='.$id;
			$journal_cr = mysqli_fetch_array(execute_query(connect(), $sql_journal));
			$sql_journal = 'select sum(amount) as journal from journal_entry where timestamp<"'.$from.'" and `to`='.$id;
			$journal_dr = mysqli_fetch_array(execute_query(connect(), $sql_journal));
			$tot_journal = $journal_dr['journal'] - $journal_cr['journal'];
			$sql = 'select * from customer where sno='.$id;
			$customer = mysqli_fetch_array(execute_query(connect(), $sql));
			$cust_opening = $customer['opening']+$dr_trans['trans'] - $cr_trans['trans'] + $tot_journal;
			$sql_trans = 'select sum(amount) as trans from customer_transactions where timestamp>="'.$from.'" and type in ("PAYMENT","sale") and cust_id='.$id;
			$dr_trans = mysqli_fetch_array(execute_query(connect(), $sql_trans));
			$sql_trans = 'select sum(amount) as trans from customer_transactions where timestamp>="'.$from.'" and type in ("RECIEPT","purchase") and cust_id='.$id;
			$cr_trans = mysqli_fetch_array(execute_query(connect(), $sql_trans));
			$sql_journal = 'select sum(amount) as journal from journal_entry where timestamp>="'.$from.'" and `by`='.$id;
			$journal_cr = mysqli_fetch_array(execute_query(connect(), $sql_journal));
			$sql_journal = 'select sum(amount) as journal from journal_entry where timestamp>="'.$from.'" and `to`='.$id;
			$journal_dr = mysqli_fetch_array(execute_query(connect(), $sql_journal));
			$tot_journal = $journal_dr['journal'] - $journal_cr['journal'];
			$cust_balanace = $cust_opening+$dr_trans['trans'] - $cr_trans['trans'] + $journal_dr['journal'] - $journal_cr['journal'];
			return $cust_balanace;
		}
		elseif($to!=''){
			$sql = 'select * from customer where sno='.$id;
			$customer = mysqli_fetch_array(execute_query(connect(), $sql));
			$cust_opening = $customer['opening'];
			$sql_trans = 'select sum(amount) as trans from customer_transactions where timestamp<="'.$to.'" and type in ("PAYMENT","sale") and cust_id='.$id;
			$dr_trans = mysqli_fetch_array(execute_query(connect(), $sql_trans));
			$sql_trans = 'select sum(amount) as trans from customer_transactions where timestamp<="'.$to.'" and type in ("RECIEPT","purchase") and cust_id='.$id;
			$cr_trans = mysqli_fetch_array(execute_query(connect(), $sql_trans));
			$sql_journal = 'select sum(amount) as journal from journal_entry where timestamp<="'.$to.'" and `by`='.$id;
			$journal_cr = mysqli_fetch_array(execute_query(connect(), $sql_journal));
			$sql_journal = 'select sum(amount) as journal from journal_entry where timestamp<="'.$to.'" and `to`='.$id;
			$journal_dr = mysqli_fetch_array(execute_query(connect(), $sql_journal));
			$tot_journal = $journal_dr['journal'] - $journal_cr['journal'];
			$cust_balanace = $cust_opening+$dr_trans['trans'] - $cr_trans['trans'] + $journal_dr['journal'] - $journal_cr['journal'];
			return $cust_balanace;
		}
		else{
			$sql = 'select * from customer where sno='.$id;
			$customer = mysqli_fetch_array(execute_query(connect(), $sql));
			$cust_opening = $customer['opening'];
			$sql_trans = 'select sum(amount) as trans from customer_transactions where type in ("PAYMENT","sale") and cust_id='.$id;
			$dr_trans = mysqli_fetch_array(execute_query(connect(), $sql_trans));
			$sql_trans = 'select sum(amount) as trans from customer_transactions where type in ("RECIEPT","purchase") and cust_id='.$id;
			$cr_trans = mysqli_fetch_array(execute_query(connect(), $sql_trans));
			$sql_journal = 'select sum(amount) as journal from journal_entry where `by`='.$id;
			$journal_cr = mysqli_fetch_array(execute_query(connect(), $sql_journal));
			$sql_journal = 'select sum(amount) as journal from journal_entry where `to`='.$id;
			$journal_dr = mysqli_fetch_array(execute_query(connect(), $sql_journal));
			$tot_journal = $journal_dr['journal'] - $journal_cr['journal'];
			$cust_balanace = $cust_opening+$dr_trans['trans'] - $cr_trans['trans'] + $journal_dr['journal'] - $journal_cr['journal'];
			//echo $cust_opening.'+'.$dr_trans['trans'].' - '.$cr_trans['trans'].' + '.$journal_dr['journal'].' - '.$journal_cr['journal'];
			//echo $cust_balanace;
			return $cust_balanace;
		}	
}

function barcode_to_name($code){
	$sql = 'select * from barcode_detector where barcode="'.$code.'"';
	$row = mysqli_fetch_array(execute_query(connect(), $sql));
	$sql = 'select * from stock_available where sno='.$row['p_id'];
	$row = mysqli_fetch_array(execute_query(connect(), $sql));
	return $row['description'];
}

function check_stock_balance($stock, $date_from, $date_to, $party){
	$total=0;
	if($date_from!=0 && $date_to!=0){
		$date = ' and part_dateofpurchase>="'.$date_from.'" and part_dateofpurchase<="'.$date_to.'"';
		$recieve = ' and recieve_date>="'.$date_from.'" and recieve_date<="'.$date_to.'"';
		$issue = ' and issue_date>="'.$date_from.'" and issue_date<="'.$date_to.'"';
	}
	elseif($date_from!=0){
		$date = ' and part_dateofpurchase<"'.$date_from.'"';
		$recieve = ' and recieve_date<"'.$date_from.'"';
		$issue = ' and issue_date<"'.$date_from.'"';
	}
	else{
		$date = '';
	}
	$sql = 'select * from stock_available where sno='.$stock;
	$row = mysqli_fetch_array(execute_query(connect(), $sql));
	$sql = 'select sum(qty) as sale from stock_sale where part_id='.$stock.$date;
	$sale = mysqli_fetch_array(execute_query(connect(), $sql));
	$sql = 'select sum(qty) as issue from issue_stock where part_id='.$stock.$issue;
	$issue = mysqli_fetch_array(execute_query(connect(), $sql));
	$sql = 'select sum(quantity) as to_oi from transactions_oi where type="TO" and part_id='.$stock;
	$to_oi = mysqli_fetch_array(execute_query(connect(), $sql));
	$sql = 'select sum(qty) as purchase from stock_purchase where part_id='.$stock.$date;
	$purchase = mysqli_fetch_array(execute_query(connect(), $sql));
	$sql = 'select sum(qty) as recieve from recieve_stock where part_id='.$stock.$recieve;
	$recieve = mysqli_fetch_array(execute_query(connect(), $sql));
	$sql = 'select sum(quantity) as from_oi from transactions_oi where type="FROM" and part_id='.$stock;
	$from_oi = mysqli_fetch_array(execute_query(connect(), $sql));
	$total = round(($purchase['purchase']+$recieve['recieve']+$from_oi['from_oi'])-($sale['sale']+$issue['issue']+$to_oi['to_oi']),2);
	if($date_to!=0){
		$opening = check_stock_balance($stock,$date_from,0,0);
	}
	else{
		$opening[1]=0;
	}
	$val[] = $total;
	$val[] = $row['opening'];
	$val[] = $total+$row['opening'];
	return $val;
}

function store_balance($store, $prod, $date_from){
	$sql = 'select * from stock_available where sno='.$prod;
	$row_stock = mysqli_fetch_array(execute_query(connect(), $sql));
	$row_store['sno'] = $store;
	$sql = 'SELECT sum(stock_sale.qty) as qty FROM `stock_sale` join sale_invoice on stock_sale.invoice_no = sale_invoice.sno where part_id='.$row_stock['sno'].' and storeid='.$row_store['sno'].' and part_dateofpurchase<="'.$date_from.'"';
	$sale = mysqli_fetch_array(execute_query(connect(), $sql));
	$sql = 'SELECT sum(stock_purchase.qty) as qty FROM `stock_purchase` join purchase_invoice on stock_purchase.invoice_no = purchase_invoice.sno where part_id='.$row_stock['sno'].' and storeid='.$row_store['sno'].' and part_dateofpurchase<="'.$date_from.'"';
	$purchase = mysqli_fetch_array(execute_query(connect(), $sql));
	$sql = 'SELECT sum(qty) as qty FROM `recieve_stock` where part_id='.$row_stock['sno'].' and storeid='.$row_store['sno'].' and recieve_date<="'.$date_from.'"';
	$recieve = mysqli_fetch_array(execute_query(connect(), $sql));
	$sql = 'SELECT sum(qty) as qty FROM `issue_stock` where part_id='.$row_stock['sno'].' and storeid='.$row_store['sno'].' and issue_date<="'.$date_from.'"';
	$issue = mysqli_fetch_array(execute_query(connect(), $sql));
	$sql = 'SELECT sum(quantity_sent) as qty FROM `transaction` where from_store='.$row_store['sno'].' and part_id='.$row_stock['sno'].' and timestamp<="'.$date_from.'"';
	$to = mysqli_fetch_array(execute_query(connect(), $sql));
	$sql = 'SELECT sum(quantity_sent) as qty FROM `transaction` where to_store='.$row_store['sno'].' and part_id='.$row_stock['sno'].' and timestamp<="'.$date_from.'"';
	$from = mysqli_fetch_array(execute_query(connect(), $sql));
	$sql = 'select * from warranty where store_id='.$row_store['sno'].' and product_id='.$row_stock['sno'].' and timestamp<="'.$date_from.'"';
	$warranty = mysqli_num_rows(execute_query(connect(), $sql));
	
	$tot = ($from['qty']+$recieve['qty']+$purchase['qty'])-($to['qty']+$issue['qty']+$sale['qty']+$warranty);
	
	if($row_store['sno']==1){
		$sql = 'SELECT sum(quantity) as qty FROM  `transactions_oi` where timestamp<'.(strtotime($date_from)+86400).' and part_id='.$row_stock['sno'].' and type="TO"';
		$to_oi = mysqli_fetch_array(execute_query(connect(), $sql));
		$sql = 'SELECT sum(quantity) as qty FROM  `transactions_oi` where timestamp<'.(strtotime($date_from)+86400).' and part_id='.$row_stock['sno'].' and type="FROM"';
		$from_oi = mysqli_fetch_array(execute_query(connect(), $sql));
		$tot = $tot - $to_oi['qty'] + $from_oi['qty'];
		$open = $row_stock['opening'];
	}
	else{
		$open = 0;
	}
	$tot = $tot+$open;
	return $tot;
	
}

function get_store($id){
	$sql = 'select * from store where sno='.$id;
	$row = mysqli_fetch_array(execute_query(connect(), $sql));
	return $row['name'];
}

function get_pl_balance($from,$to,$id){
	$sql = 'select * from customer where parent="'.$id.'"';
	$res = execute_query(connect(), $sql);
	$tot=0;
	while($row = mysqli_fetch_array($res)){
		$tot += get_cust_balace($from,$to,$row['sno']);
	}
	$tot += get_cust_balace($from,$to,$id);
	return $tot;
}

function get_pl_parent($id){
	if(is_numeric($id)){
		$sql = 'select * from customer where sno="'.$id.'"';
		$res = mysqli_fetch_array(execute_query(connect(), $sql));
		$var = get_pl_parent($res['parent']);
		return $var;
	}
	else{
		return $id;
	}
}

function cash_in_hand($df, $dt, $id){
	if($id=='CASH IN HAND'){
		$sql = 'select * from pl_heads where description="CASH IN HAND"';
		$opening = mysqli_fetch_array(execute_query(connect(), $sql));
		$i=0;
		$sale_date = $dt;
		$sql = 'SELECT sum(payment) as payment, sum(reciept) as reciept FROM `rojnamcha` where timestamp<="'.date("Y-m-d",strtotime($sale_date)-86400).'"';
		$prev = execute_query(connect(), $sql);
		$prev=mysqli_fetch_array($prev);
		$bal_opening = $prev['reciept']-$prev['payment'];
		$tot_opening = $opening['opening']+$bal_opening;	
		$sql = "SELECT *, customer_transactions.amount as final_amount, customer_transactions.sno as serial_no FROM `customer_transactions` join rojnamcha on rojnamcha.timestamp = customer_transactions.timestamp where rojnamcha.timestamp = '".$sale_date."' and type in ('RECIEPT','PAYMENT')";
		//$sql = "SELECT * FROM `customer_transactions` where type in ('RECIEPT','PAYMENT')";
		$result = execute_query(connect(), $sql);
		$tot_reciept = 0;
		$tot_payment = 0;
		$tot_reciept += $tot_opening;
		$i=1;
		while($row = mysqli_fetch_array($result)){
			$sql = 'select * from customer where sno='.$row['cust_id'];
			$cust = mysqli_fetch_array(execute_query(connect(), $sql));
			if($row['type']=='RECIEPT'){
				$tot_reciept += $row['final_amount'];
			}
			if($row['type']=='PAYMENT'){
				$tot_payment += $row['final_amount'];
			}
		}
		$val = $tot_reciept-$tot_payment;
		return $val;
	}
	else{
		$val = get_cust_balace($df,$dt,$id);
		return $val;
	}
}

function get_product($id){
	$sql = 'select * from stock_available where sno='.$id;
	$result = execute_query(connect(), $sql);
	$row = mysqli_fetch_array($result);
	return $row['description'];
}

function get_child($id){
	$sql = 'select * from customer where parent='.$id;
	$res = execute_query(connect(), $sql);
	$num = mysqli_num_rows($res);
	return $num;
}
?>

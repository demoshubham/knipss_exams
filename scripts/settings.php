<?php
$time_track = array();
$time_track[] = microtime(true);
set_time_limit(0);
error_reporting(E_ALL);
// error_reporting(0);
// if($_SERVER["HTTPS"] != "on")
// {
//     header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
//     exit();
// }
session_cache_limiter('nocache');
session_start();
date_default_timezone_set('Asia/Kolkata');

include("settings_dbase.php");

sethistory();
date_default_timezone_set('Asia/Calcutta');

function dbconnect(){
	global $db;	
	return $db;
}

function page_header_start($title='CloudICE ERP') {
	global $software_type;
	global $time_track;
	global $db;	
	
	$time_track[] = microtime(true);
	$sql = 'select * from general_settings where `description`="company"';
	$company = mysqli_fetch_array(execute_query($db, $sql));
	$company = explode(" ", $company['value']);
	$company_name = '';
	foreach($company as $k=>$v){
		$company_name .= '<span>'.substr($v, 0, 1).'</span>'.substr($v, 1).' ';
		//echo $v.'<br>';
	}
	$current_file_name = basename($_SERVER['PHP_SELF']);
	if(isset($_SESSION['session_id'])) {
		$sql = 'select * from navigation where hyper_link="'.$current_file_name.'"';
		//echo $sql;
		$file = mysqli_fetch_array(execute_query($db, $sql));
		logvalidate($file['sno']);
		$title = $file['link_description'];
		$GLOBALS['title'] = $title;
	}
	else{
		$file['color']='';
		logvalidate();
	}
	global $time_track;
	$time_track[] = microtime(true);
	$time_track[] = microtime(true);
	echo '
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="images/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>'.$title.'</title>

	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta name="viewport" content="width=device-width" />
	
    <!--     Fonts and icons     -->
    <link href="fa/css/all.min.css" rel="stylesheet">
    <script src="fa/js/fontawesome.min.js"></script>
    <link href="css/pe-icon-7-stroke.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <!-- Bootstrap core CSS     -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="dataTables/datatables.min.css">
	<script src="js/jquery.3.2.1.min.js" type="text/javascript"></script>
	<script src="js/jquery-ui.js" type="text/javascript"></script>
	<script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-switch.js"></script>
	<script src="js/calendar.js" language="javascript" type="text/javascript"></script>
	<script src="js/bpopup.js" language="javascript" type="text/javascript"></script>
	<script src="js/jquery/jquery.ba-throttle-debouce.min.js" type="text/javascript"></script>
	<script src="js/jquery/jquery.multiselect.js" language="javascript"></script>

    <!-- Animation library for notifications   -->
    <link href="css/animate.min.css" rel="stylesheet"/>

    
    <link href="css/jquery-ui.css" rel="stylesheet" />
	<!--<link href="css/styles.css" rel="stylesheet" type="text/css" media="all" />-->
	<link href="css/pagination.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/jquery.multiselect.css" rel="stylesheet" type="text/css" media="all" />
	<!--  Light Bootstrap Table core CSS    -->
	<link href="css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>
	
	<!-- CORE FILES FOR PERFECT SCROLLBAR FUNCTIONALITY -->
	<!-- The Perfect Scrollbar CSS files -->
	<link href="css/perfect-scrollbar.css" rel="stylesheet">
	<!-- The Perfect Scrollbar JS files -->
	<script src="js/perfect-scrollbar.js"></script>

    <style type="text/css">
        .nav_style li:hover{
            background-color: #b2b8ae;
        }
    </style>
    <style type="text/css">
        .daterclass{
            padding: 5px;
            border: 2px solid lightblue;
        }
        .daterclass tr td{
          
        }

    </style>

	<script type="text/javascript" language="javascript">
		var software_type="'.$software_type.'";
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
				$(\'[data-toggle="tooltip"]\').tooltip(); 
			}
		);

		$(function() {
			var options = {
				source: function (request, response){
					$.getJSON("scripts/ajax.php?id=nav",request, response);
				},
				position: {
					my: "left top",
					at: "left bottom",
					collision: "flip"
				},
				minLength: 1,
				select: function( event, ui ) {
					log( ui.item ?
						"Selected: " + ui.item.value + " aka " + ui.item.label :
						"Nothing selected, input was " + this.value );
				},
				select: function( event, ui ) {
					window.open(ui.item.hyper_link, "_self");
					return false;
				}
			};
		$("input#shortcut_command").on("keydown.autocomplete", function() {
			$(this).autocomplete(options);
		});
		});


	</script>
	<script language="javascript" type="text/javascript">
		function check_prev_date(form_date){
			calculate_total(1);
			var cur_date = "'.date("Y-m-d").'";
			var warn = 0;
			$(".noblank").each(function(index, element){
				if($(element).val()==""){
					$( element ).css( "backgroundColor", "yellow" );
					warn = 1;
				}
				else{
					$( element ).css( "backgroundColor", "white" );
				}
			});
			if(warn!=0){
				alert("Please enter all complusory blocks");
				return false;
			}

			if(cur_date>form_date){
				var response = confirm("Entry date is old than today. Do you want to proceed. ?");
			}
			else{
				var response = confirm("Are you sure?");
			}
			return response;
		}
	</script>
	<!--<link href="jquery/jquery-ui.css" rel="stylesheet" type="text/css" media="screen" />-->
	<style>
		#wrapper{
			border: 5px solid #'.$file['color'].';
		}
	</style>';
?>
	<script>
	$(".dropdown dt a").on('click', function() {
		$(".dropdown dd ul").slideToggle('fast');
	});

	$(".dropdown dd ul li a").on('click', function() {
		$(".dropdown dd ul").hide();
	});

	function getSelectedValue(id) {
	  return $("#" + id).find("dt a span.value").html();
	}

	$(document).bind('click', function(e) {
	  var $clicked = $(e.target);
	  if (!$clicked.parents().hasClass("dropdown")) $(".dropdown dd ul").hide();
	});

	$('.mutliSelect input[type="checkbox"]').on('click', function() {

	  var title = $(this).closest('.mutliSelect').find('input[type="checkbox"]').val(),
		title = $(this).val() + ",";

	  if ($(this).is(':checked')) {
		var html = '<span title="' + title + '">' + title + '</span>';
		$('.multiSel').append(html);
		$(".hida").hide();
	  } else {
		$('span[title="' + title + '"]').remove();
		var ret = $(".hida");
		$('.dropdown dt a').append(ret);

	  }
	});		
		

// defining flags
var isCtrl = false;
var isAlt = false;
// helpful function that outputs to the container
// the magic :)

<?php
	$current_file_name = basename($_SERVER['PHP_SELF']);
	global $client_details;
	$client_details['last_renewal'] = date("Y-m-d", strtotime("+1 Year", strtotime($client_details['last_renewal']))); 
	$expiry_days = date("d", strtotime($client_details['last_renewal']) - strtotime(date("Y-m-d")));
	if(isset($_SESSION['username'])){
		$user = $_SESSION['username'];
		$sql = 'select * from session where user="'.$user.'" order by s_start_date desc, s_start_time desc';
		$last = execute_query($db, $sql);
		if(mysqli_num_rows($last)!=0){
			$last = mysqli_fetch_array($last);
			$last = $last['s_start_date'].' '.$last['s_start_time'];
		}
		else{
			$last = '';
		}
		$sql = 'select * from general_settings where `description`="session_timeout"';
		$timeout = mysqli_fetch_array(execute_query($db, $sql));
		if($timeout['value']>0){
			$timeout = $timeout['value']*60;
			$difference = time()-$timeout;
			$sql = 'select * from session where user!="'.$_SESSION['username'].'" and last_active>'.$difference;
			$session = execute_query($db, $sql);
			if(mysqli_num_rows($session)!=0){
				$other = mysqli_num_rows($session);
			}
			else{
				$other = 0;
			}
		}
		
	}
	else{
		$user='Guest';
		$last='';
		$other='';
	}
		
	if($current_file_name=='index.php'){
	?>
			$(document).ready(function(){
				/*$.notify({
					icon: 'pe-7s-gift',
					message: "Welcome <b><?php echo $user; ?></b>. Last Login: <b><?php echo $last; ?></b>. Currently active at <b><?php echo $other; ?></b> other location"

				},{
					type: 'success',
					timer: 2000
				});*/

			});

	<?php
	}
	?>
	</script>

<?php
}


function page_header_end(){
	$current_file_name = basename($_SERVER['PHP_SELF']);
	if($current_file_name!='index.php'){
		$class = 'sidebar-mini';
	}
	else{
		$class = '';
	}
	echo '
</head>

<body class="'.$class.'">
    <div class="wrapper">';
	$time_track[] = microtime(true);
}

function page_sidebar($id=''){
	global $db;
?>
		<div class="sidebar" data-color="blue" data-image="images/sidebar-5.jpg">
		<!--

			Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
			Tip 2: you can also add an image using data-image tag
		-->
			<div class="sidebar-wrapper">
				<div class="logo">
					<a href="#" class="simple-text logo-mini"><img src="images/college_log.png" style="height: 30px;"></a>
					<a href="#" class="simple-text  logo-normal">CloudICE&trade; ERP</a>
				</div>

				<ul class="nav">
					<li routerlinkactive="active" class="nav-item active"><a class="nav-link" href="index.php"><i class="fa fa-chart-pie"></i><p>Dashboard</p></a>
				<?php
					$sql = 'select * from navigation where (parent is null or parent="" or parent="P") and hyper_link!="index.php" order by abs(sort_no), sub_parent, link_description';
					$result = execute_query($db, $sql);
					$sub_parent = '';
					while($row = mysqli_fetch_array($result)){
						if($row['hyper_link']==basename($_SERVER['PHP_SELF'])){
							$active = ' active';
						}
						else{
							$active = '';
						}
						if($_SESSION['username']!='sadmin'){
							if($row['parent']=='P'){
								$sql = 'select group_concat(sno) as sno from navigation where parent="'.$row['sno'].'" order by abs(sort_no), sub_parent, link_description';
								$row_sub = mysqli_fetch_assoc(execute_query($db, $sql));
								
								$sql = 'select * from user_access where user_id="'.$_SESSION['usersno'].'" and file_name in ('.$row_sub['sno'].')';
								//echo $sql.'<br><br>';
								$result_child_count = execute_query($db, $sql);
								
								if(mysqli_num_rows($result_child_count)!=0){
									echo '
									<li routerlinkactive="active" class="nav-item'.$active.'">
										<!----><a data-toggle="collapse" data-target="#parent'.$row['sno'].'" class="nav-link" href="#parent'.$row['sno'].'" ><i class="'.$row['icon_image'].'"></i><p>'.$row['link_description'].'<b class="caret"></b></p></a>
										<!---->
										<div class="collapse" id="parent'.$row['sno'].'">
											<ul class="nav">';

									$sql = 'select * from navigation where parent="'.$row['sno'].'" order by abs(sort_no), sub_parent, link_description';
									$result_sub = execute_query($db, $sql);
									while($row_sub = mysqli_fetch_assoc($result_sub)){
										$sql = 'select * from user_access where user_id="'.$_SESSION['usersno'].'" and file_name="'.$row_sub['sno'].'"';
										//echo $sql;
										$result_access = execute_query($db, $sql);
										if(mysqli_num_rows($result_access)==1){
											echo '<li routerlinkactive="active'.$active.'" class="nav-item"><a class="nav-link" href="'.$row_sub['hyper_link'].'"><i class="'.$row_sub['icon_image'].'" style="font-size:20px; margin-left:15px; margin-right:0px;"></i><span class="sidebar-mini"></span><span class="sidebar-normal">'.$row_sub['link_description'].'</span></a>
											</li>';
										}
									}
									echo '
											</ul>
										</div>
										<!---->
									</li>';
								}
								
							}
							else{
								$sql = 'select * from user_access where user_id="'.$_SESSION['usersno'].'" and file_name="'.$row['sno'].'"';
								//echo $sql;
								$result_access = execute_query($db, $sql);
								if(mysqli_num_rows($result_access)==1){
									echo '<li routerlinkactive="active" class="nav-item'.$active.'"><a class="nav-link" href="'.$row['hyper_link'].'"><i class="'.$row['icon_image'].'"></i><p>'.$row['link_description'].'</p></a></li>';						
								}
							}
						}
						else{
							if($row['parent']!="P"){
								echo '<li routerlinkactive="active" class="nav-item'.$active.'"><a class="nav-link" href="'.$row['hyper_link'].'"><i class="'.$row['icon_image'].'"></i><p>'.$row['link_description'].'</p></a></li>';						
							}
							else{
								echo '
								<li routerlinkactive="active" class="nav-item'.$active.'">
									<!----><a data-toggle="collapse" data-target="#parent'.$row['sno'].'" class="nav-link" href="#parent'.$row['sno'].'" ><i class="'.$row['icon_image'].'"></i><p>'.$row['link_description'].'<b class="caret"></b></p></a>
									<!---->
									<div class="collapse" id="parent'.$row['sno'].'">
										<ul class="nav">';

								$sql = 'select * from navigation where parent="'.$row['sno'].'" order by abs(sort_no), sub_parent, link_description';
								$result_sub = execute_query($db, $sql);
								while($row_sub = mysqli_fetch_assoc($result_sub)){
									echo '<li routerlinkactive="active'.$active.'" class="nav-item"><a class="nav-link" href="'.$row_sub['hyper_link'].'"><i class="'.$row_sub['icon_image'].'" style="font-size:20px; margin-left:15px; margin-right:0px;"></i><span class="sidebar-mini"></span><span class="sidebar-normal">'.$row_sub['link_description'].'</span></a>
											</li>';
								}
								echo '
										</ul>
									</div>
									<!---->
								</li>';
							}	

						}
					}

				?>
				</ul>
			</div>
		</div>
		<div class="main-panel">
			<nav class="navbar navbar-expand-lg ">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <a class="navbar-brand page-title" href="#" style="font-size:24px; color:#F83A3D"><?php echo $GLOBALS['title']; ?></a>
                    </div>
                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end">
                        <ul class="nav navbar-nav mr-auto">
                            <li><form class="navbar-form navbar-left navbar-search-form" role="search">
                                <div class="input-group">
                                    <i class="fab fa-sistrix"></i>
                                    <input type="text" value="" class="form-control" placeholder="Search... (Shortcut : Ctrl+/)" id="shortcut_command">
                                </div>
								</form></li>
                        </ul>
                        <ul class="navbar-nav">
                           	<li class="nav-item dropdown"> 
                                <a class="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#"><button class="btn btn-info"><i class="fa fa-user-lock"></i> <?php echo $_SESSION['username']; ?></button></a>&nbsp;|&nbsp; 
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="#">Profile</a>
                                    <a class="dropdown-item" href="#">Activity Log</a>
                                    <div class="divider"></div>
                                    <a class="dropdown-item" href="signout.php"><i class="fas fa-sign-out-alt"></i>Signout</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo returnlink("index.php",false); ?>"><button class="btn btn-danger"><i class="fa fa-backward"></i> Back</button></a>
							</li>
						</ul>
                    </div>
                </div>
            </nav>
			<div class="content">
				<div class="container-fluid">
		
<?php	

	$time_track[] = microtime(true);
}
function page_footer_start() {
	
?>
				</div>
			</div>
			<footer class="footer">
				<div class="container-fluid ">
					<nav class="pull-left">
						<ul>
							<li>
								<a href="#">
									Home
								</a>
							</li>
						</ul>
					</nav>
					<p class="copyright text-center">
                        ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script>
                        <a href="http://www.weknowtech.in" target="_blank"><img src="images/logo-15.png" class="img-rounded"> Weknow Technologies</a>
                    </p>
				</div>
			</footer>
	    </div>
	</div>
<?php
}
function page_footer_end() {
	global $client_details;
?>
	<!--  Notifications Plugin    -->
    <script src="js/bootstrap-notify.js"></script>
    <script src="js/light-bootstrap-dashboard.js"></script>
    <script src="dataTables/datatables.min.js"></script>
	<script>
	// Initialize the plugin
	const demo1 = document.querySelector('.sidebar-wrapper');
	const ps = new PerfectScrollbar(demo1);
	</script>

    
    <!--  Google Maps Plugin    -->
   <!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>-->


<script>
	$(document).ready(function() {
		// action on key up
		$(document).keyup(function(e) {
			if(e.which == 17) {
				isCtrl = false;
			}
		});
		$(document).keyup(function(e) {
			if(e.which == 18) {
				isAlt = false;
			}
		});
		// action on key down 17, 18, 82
		$(document).keydown(function(e) {
			if(e.which == 17) {
				isCtrl = true; 
			}
			if(e.which == 18) {
				isAlt = true; 
			}
			if(e.which == 191 && isCtrl) { 
				//console.log($("#shortcut_command"));
				$("#shortcut_command").focus();				
			} 
			if(e.which == 89 && isCtrl && isAlt) {
				if(form_type=='sale'){
					if($("#supplier_sno").val()==''){
						alert("Please select a customer.");
						$("#supplier").focus();
						return;
					}
					var current = $("#current").val();
					var part = "part_desc"+current;
					var parent_tr = $("input[name="+part+"_product]").closest('tr');
					if(parent_tr.css("background-color")=='rgb(255, 0, 0)'){
						parent_tr.css("background-color", "#cccccc");
						$("#part_desc"+current+"_return_flag").val("0");
					}
					else{
						parent_tr.css("background-color", "#FF0000");
						$("#part_desc"+current+"_return_flag").val("1");
					}
				}
			} 
		});

	});
	</script>
<?php
	echo '	
</body>
</html>';
}

function pagecount($sql, $script, $active){
	global $db;
	$result = execute_query($db, $sql);
	$count = mysqli_num_rows($result);
	$page = ceil($count/50);
	if($active>1 && $active<$page){
		$print = '<a href="'.$script.'">&lt;&lt;</a> | <a href="'.$script.'?pg='.($active-1).'"> &lt;</a> |';
	}
	else{
		$print = '';
	}
	for($i=1;$i<=$page;$i++){
		if($active==$i){
			$print .= $i.' | ';
		}
		else{
			$print .= '<a href="'.$script.'?pg='.$i.'">'.$i.'</a> | ';
		}
	}
	return $print;
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
	$length=6;
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

function logout(){

	date_default_timezone_set('Asia/Calcutta');

	$_SESSION['enddate']=date('y-m-d');

	$time = localtime();

	$time = $time[2].':'.$time[1].':'.$time[0];

	$_SESSION['endtime']=$time;

	$sql = "update session set s_end_time='".$_SESSION['endtime']."' where s_id='".$_SESSION['id']."' and user='".$_SESSION['username']."'";

	execute_query($db, $sql);

	session_destroy();

	session_unset();

	session_write_close();
	
	("Location: index.php");
	//echo 'Redirect2';

	echo '<div id="container" class="ltr">

	<center><h2>Logged Out Succesfully. <a href="index.php">Click Here</a> to continue or close this window</center>

	</div>';

}

function logout_validate(){

	$ti = time()-$_SESSION['timestart'];

	if($ti>$_SESSION['logout_in_sec']){

		header("Location: signout.php");
		//echo 'Redirect3';

	}

	else{

		$_SESSION['timestart']=time();

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
	if(!isset($_SERVER['HTTP_REFERER'])){
		$_SERVER['HTTP_REFERER']='';
	}
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

function logvalidate($fileid=''){
	global $db;
	$fileid = basename($_SERVER['PHP_SELF']);
	
	$sql = 'select * from navigation where hyper_link="'.$fileid.'"';
	//echo $sql;
	$file = mysqli_fetch_assoc(execute_query($db, $sql));
	$fileid = $file['sno'];
	
	if(basename($_SERVER['PHP_SELF'])=='index.php'){
		return true;
	}
	if(!isset($_SESSION['session_id'])){
		header("Location: index.php");
		//echo 'Redirect5';
	}
	$current_time = time();
	$sql = 'select * from general_settings where `description`="session_timeout"';
	$timeout = mysqli_fetch_array(execute_query($db, $sql));
	if($timeout['value']>0){
		$sql = 'select * from session where s_id="'.$_SESSION['session_id'].'"';
		//echo $sql;
		$session = mysqli_fetch_array(execute_query($db, $sql));
		$timeout = $timeout['value']*60;
		$difference = $current_time-$session['last_active'];
		if($difference>$timeout){
			//echo 'Redirect6';
			logout();
		}
	}
	if($_SESSION['username']=='sadmin'){
		$sql = 'update session set last_active="'.time().'" where s_id="'.$_SESSION['session_id'].'"';
		execute_query($db, $sql);
		return true;
	}
	$sql = 'select * from navigation where sno="'.$fileid.'"';
	$result_parent = execute_query($db, $sql);
	$row_parent = mysqli_fetch_array($result_parent);
	if($row_parent['parent']=="P"){
		$sql = 'update session set last_active="'.time().'" where s_id="'.$_SESSION['session_id'].'"';
		execute_query($db, $sql);
		return true;
	}
	if($fileid!='index.php' && $fileid!=''){
		$sql = 'select * from user_access where user_id="'.$_SESSION['usersno'].'" and file_name="'.$fileid.'"';
		//echo $sql;
		$result_access = execute_query($db, $sql);
		if(mysqli_num_rows($result_access)!=1){
			header("Location: index.php");
			//echo 'Redirect1';
		}
	}
	$sql = 'update session set last_active="'.time().'" where s_id="'.$_SESSION['session_id'].'"';
	//echo $sql;
	execute_query($db, $sql);
}

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
	 } else if($x < 100000)
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
		 $w .= int_to_words(floor($x/100000)) .' lakh';
		 $r = fmod($x, 100000);
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

function get_days($purchase_date,$reference_date){
	$date1 = new DateTime("$reference_date");
	$date2 = new DateTime("$purchase_date");
	$interval = $date1->diff($date2);
	return $interval->y . " years, " . $interval->m." months, ".$interval->d." days "; 
}

function gen_epin_alpha2(){

	$length=3;

	$chars='ABCDEFGHIJKLMNOPQRSTUVWXYZ';

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

function gen_epin_number2(){

	$length=3;

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



function gen_epin_alpha(){

	$length=5;

	$chars='ABCDEFGHIJKLMNOPQRSTUVWXYZ';

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

function gen_epin_number(){

	$length=4;

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

function gen_epin(){
	$length=9;
	$chars='ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
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

function calc_fees($class, $sub1, $sub2, $sub3, $gender,$category, $cur_month=0){

	$self=0;

	$r = calc_sub_fees_new($class, $sub1, $sub2, $sub3);

	$link = connect();

	$sql = "select * from class_detail where sno=".$class;

	$class_detail = mysqli_fetch_array(execute_query(connect(), $sql,$link));

	$sql = "select * from fees_detail where class_id=".$class." and head_id!='computer' and head_id!='self' and head_id!='tour'";

	$result_heads = execute_query(connect(), $sql,$link);

	$i=1;

	$head_tot = 0;

	$sci=0;

	$fem=0;

	

	if($class_detail['type']!='SELF'){

		while($row_heads = mysqli_fetch_array($result_heads)){

			//$sql = "select * from head_type where sno = ".$row_heads['head_id'];

			//$head = mysqli_fetch_array(execute_query(connect(), $sql,$link));

			if($row_heads['head_id']==14){

				$row_heads['fee_amount'] = (float)$row_heads['fee_amount']*(float)$r['c'];

			}

			$head_tot += (float)$row_heads['fee_amount'];

			$i++;

		}

		if($gender=='F'){

			$sql = 'select * from fees_detail where class_id='.$class.' and head_id=1';

			$female = mysqli_fetch_array(execute_query(connect(), $sql));

			if($class_detail['type']!='SELF'){

				$head_tot -= (float)$female['fee_amount'];

			}

		}

		$final_fees = ((float)$head_tot+(float)$r['fees']+(float)$self);

	}

	else{

		while($row_heads = mysqli_fetch_array($result_heads)){

			$head_tot += (float)$row_heads['fee_amount'];

			$i++;

		}

		$final_fees = (float)$head_tot+(float)$r['fees'];

	}

	return $final_fees;

}



function calc_fees_sc($class, $sub1, $sub2, $sub3, $gender,$category, $cur_month=0){

	$self=0;

	$r = calc_sub_fees_new_sc($class, $sub1, $sub2, $sub3);

	$link = connect();

	$sql = "select * from class_detail where sno=".$class;

	$class_detail = mysqli_fetch_array(execute_query(connect(), $sql,$link));

	$sql = "select * from fees_detail4 where class_id=".$class." and head_id!='computer' and head_id!='self' and head_id!='tour'";

	$result_heads = execute_query(connect(), $sql,$link);

	$i=1;

	$head_tot = 0;

	$sci=0;

	$fem=0;

	while($row_heads = mysqli_fetch_array($result_heads)){

		//$sql = "select * from head_type where sno = ".$row_heads['head_id'];

		//$head = mysqli_fetch_array(execute_query(connect(), $sql,$link));

		if($row_heads['head_id']==14){

			$row_heads['fee_amount'] = $row_heads['fee_amount']*$r['c'];

		}

		$head_tot += $row_heads['fee_amount'];

		$i++;

	}

	if($gender=='F'){

		$sql = 'select * from fees_detail4 where class_id='.$class.' and head_id=1';

		$female = mysqli_fetch_array(execute_query(connect(), $sql));

	}

	else{

		$female['fee_amount']=0;

	}

	

		$final_fees = ($head_tot+$r['fees']+$self-$female['fee_amount']);

		return $final_fees;

}





function calc_fees_new($class,$sub1,$sub2,$sub3,$gender){

	$r = calc_sub_fees_new($class, $sub1, $sub2, $sub3);

	echo '<table border=1>';

	$link = connect();

	$sql = "select * from class_detail where sno=".$class;

	$class_detail = mysqli_fetch_array(execute_query(connect(), $sql,$link));

	$sql = "select * from fees_detail where class_id=".$class;

	$result_heads = execute_query(connect(), $sql,$link);

	$i=1;

	$head_tot = 0;

	$sci=0;

	$fem=0;

	while($row_heads = mysqli_fetch_array($result_heads)){

		$sql = "select * from head_type where sno = ".$row_heads['head_id'];

		$head = mysqli_fetch_array(execute_query(connect(), $sql,$link));

		if($head['sno']==14){

			$row_heads['fee_amount'] = $row_heads['fee_amount']*$r['c'];

		}

		echo "<tr><td>$i</td>

		<td>".$head['fee_type']."</td>

		<td>".$row_heads['fee_amount']."</td>

		</tr>";

		$head_tot += $row_heads['fee_amount'];

		$i++;

	}

	echo '<tr><th></th><th>Total</th><th>'.$head_tot.'</th></tr></table>';

	if($gender=='F'){

		$sql = 'select * from fees_detail where class_id='.$class.' and head_id=1';

		$female = mysqli_fetch_array(execute_query(connect(), $sql));

	}

	else{

		$female['fee_amount']=0;

	}

	

	echo '

	<table>


		<tr>

			<th>Head Fees:'.$head_tot.'</th>

		</tr>

		<tr>

			<th>Subject Fees:'.$r['fees'].'</th>

		</tr>

		<tr>

			<th>Self:'.$self.'</th>

		</tr>

		<tr>

			<th>Female Disount: '.$female['fee_amount'].'</th>

		</tr>';

	echo '

	<tr><th>Grand Total:'.(($head_tot+$r['fees']+$self)-$female['fee_amount']).'</th>

	</tr></table>';

	

}

function calc_sub_fees_new($class,$sub1, $sub2, $sub3){

	$link = connect();

	$sql = 'select sum(fees) as fees, count(*) c from subject_fees where class_id='.$class.' and subject_id in ("'.$sub1.'", "'.$sub2.'", "'.$sub3.'") and fees!="" and fees!=0 and fees!="Practical Fees"';

	//echo $sql.'<br>';

//	die();

	$row = mysqli_fetch_array(execute_query(connect(), $sql,$link));

	return $row;

}

function calc_sub_fees_new_sc($class,$sub1, $sub2, $sub3){

	$link = connect();

	$sql = 'select sum(fees) as fees, count(*) c from subject_fees4 where class_id='.$class.' and subject_id in ("'.$sub1.'", "'.$sub2.'", "'.$sub3.'") and fees!="" and fees!=0 and fees!="Practical Fees"';

	$row = mysqli_fetch_array(execute_query(connect(), $sql,$link));

	return $row;

}

function calc_sub_fees($class,$sub){

	$link=connect();

	$sql = 'select * from subject_fees where class_id="'.$class.'" and subject_id="'.$sub.'" and fees!="" and fees!=0';

	//echo $sql.'<br>';

	$row = mysqli_fetch_array(execute_query(connect(), $sql,$link));

	return $row;

}



function calc_sub_fees_second($class,$sub1, $sub2, $sub3){

	$link = connect();

	$sql = 'select sum(fees) as fees, count(*) c from subject_fees2 where class_id='.$class.' and subject_id in ("'.$sub1.'", "'.$sub2.'", "'.$sub3.'") and fees!="" and fees!=0 and fees!="Practical Fees"';

//	die();

	$row = mysqli_fetch_array(execute_query(connect(), $sql,$link));

	return $row;

}

function calc_second_fees_gen($class,$sub1,$sub2,$sub3,$gender,$category){

	$self=0;

	$r = calc_sub_fees_second($class, $sub1, $sub2, $sub3);

	$link = connect();

	$sql = "select * from class_detail where sno=".$class;

	$class_detail = mysqli_fetch_array(execute_query(connect(), $sql,$link));

	$sql = "select * from fees_detail2 where class_id=".$class." and head_id!='computer' and head_id!='self' and head_id!='tour'";

	//echo $sql;

	$result_heads = execute_query(connect(), $sql,$link);

	$i=1;

	$head_tot = 0;

	$sci=0;

	$fem=0;

	while($row_heads = mysqli_fetch_array($result_heads)){

		//$sql = "select * from head_type where sno = ".$row_heads['head_id'];

		//$head = mysqli_fetch_array(execute_query(connect(), $sql,$link));

		if($row_heads['head_id']==14){

			$row_heads['fee_amount'] = $row_heads['fee_amount']*$r['c'];

		}

		$head_tot += $row_heads['fee_amount'];

		$i++;

	}

	if($gender=='F'){

		$sql = 'select * from fees_detail2 where class_id='.$class.' and head_id=1';

		$female = mysqli_fetch_array(execute_query(connect(), $sql));

		if($class_detail['type']!='SELF'){

		$head_tot -= $female['fee_amount'];

		}

	}

		$final_fees = ($head_tot+$r['fees']+$self);

		return $final_fees;

}





function calc_sub_fees_second_sc($class,$sub1, $sub2, $sub3){

	$link = connect();

	$sql = 'select sum(fees) as fees, count(*) c from subject_fees3 where class_id='.$class.' and subject_id in ("'.$sub1.'", "'.$sub2.'", "'.$sub3.'") and fees!="" and fees!=0 and fees!="Practical Fees"';

//	die();

	$row = mysqli_fetch_array(execute_query(connect(), $sql,$link));

	return $row;

}





function calc_second_fees_sc($class,$sub1,$sub2,$sub3,$gender,$category){

	$self=0;

	$r = calc_sub_fees_second_sc($class, $sub1, $sub2, $sub3);

	$link = connect();

	$sql = "select * from class_detail where sno=".$class;

	$class_detail = mysqli_fetch_array(execute_query(connect(), $sql,$link));

	$sql = "select * from fees_detail3 where class_id=".$class." and head_id!='computer' and head_id!='self' and head_id!='tour'";

	$result_heads = execute_query(connect(), $sql,$link);

	$i=1;

	$head_tot = 0;

	$sci=0;

	$fem=0;

	while($row_heads = mysqli_fetch_array($result_heads)){

		//$sql = "select * from head_type where sno = ".$row_heads['head_id'];

		//$head = mysqli_fetch_array(execute_query(connect(), $sql,$link));

		if($row_heads['head_id']==14){

			$row_heads['fee_amount'] = $row_heads['fee_amount']*$r['c'];

		}

		$head_tot += $row_heads['fee_amount'];

		$i++;

	}

	if($gender=='F'){

		$sql = 'select * from fees_detail3 where class_id='.$class.' and head_id=1';

		$female = mysqli_fetch_array(execute_query(connect(), $sql));

		if($class_detail['type']!='SELF'){

		$head_tot -= $female['fee_amount'];

		}

	}

		$final_fees = ($head_tot+$r['fees']+$self);

		return $final_fees;

}



function get_max_discount($class){

	$sql = 'select sum(fee_amount) as discount from fees_detail where class_id="'.$class.'" and head_id in ("8", "9")';

	$discount = mysqli_fetch_assoc(execute_query(connect(), $sql));

	return $discount['discount'];

}



function get_invoice_prefix($fees_serial, $table, $session){

	$sql = 'select class_id, '.$table.'.type as fee_type, class_detail.type as type, fee_session from '.$session.'.'.$table.' left join class_detail on class_detail.sno = class_id where '.$table.'.sno='.$fees_serial;

	//echo $sql;

	$row = mysqli_fetch_assoc(execute_query(connect(), $sql));

	

	if($row['class_id']>=66 && $row['class_id']<=75){

		$prefix = $row['fee_session'].'/BALLB/';

	}

	elseif($row['fee_type']=='fees'){

		if($row['type']=='SELF'){

			$prefix = $row['fee_session'].'/SFC/';

		}

		else{

			$prefix = $row['fee_session'].'/AIDED/';

		}

	}

	elseif($row['fee_type']=='self'){

		$prefix = $row['fee_session'].'/SF/';

	}

	elseif($row['fee_type']=='vocational'){

		$prefix = $row['fee_session'].'/VF/';

	}

	elseif($row['fee_type']=='due'){

		$prefix = $row['fee_session'].'/DUE/';

	}

	elseif($row['fee_type']=='computer'){

		$prefix = $row['fee_session'].'/COMP/';

	}

	elseif($row['fee_type']=='tour'){

		$prefix = $row['fee_session'].'/TOUR/';

	}

	elseif($row['fee_type']=='breakage'){

		$prefix = $row['fee_session'].'/BREAK/';

	}

	return $prefix;

}



function generate_invoice_no($fees_type, $date){
	$link = mysqli_connect("p:localhost", "knipssexams", "Knip@13579", $_SESSION['db_name']);
	$_POST['report_type'] = $fees_type;
	$time = strtotime($date);
	$month = date("m",$time);
	$current_year = date("Y",$time);
	$fy = $current_year;
	if($month>=1 && $month<=3){
		$fy = $fy-1;
	}
	$from_year = $current_year-1;
	$to_year = $current_year+1;
	$where=' and fee_session="'.$fy.'"';
	if($_POST['report_type']=='aided'){
		$where .= ' and class_detail.type!="SELF"';
		$fee_type = '("fees" , "due")';
	}
	elseif($_POST['report_type']=='self'){
		$fee_type = '("self")';
	}
	elseif($_POST['report_type']=='computer'){
		$fee_type = '("computer")';
	}
	elseif($_POST['report_type']=='vocational'){
		$fee_type = '("vocational")';
	}
	elseif($_POST['report_type']=='tour'){
		$fee_type = '("tour")';
	}
	elseif($_POST['report_type']=='breakage'){
		$fee_type = '("breakage")';
	}
	elseif($_POST['report_type']=='sfc'){
		$where .= ' and class_detail.type="SELF"';
		$fee_type = '("fees" , "due")';
	}
	$sql = 'select fees_serial, info, receipt_number, fee_session, timestamp, fee_type, dbname from (';							
	while($from_year<=($to_year+1)){
		$sql_chk = 'SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = "cloudice_knipss_'.$from_year.'"';
		$result = execute_query($link, $sql_chk);
		$db = 'cloudice_knipss_'.$from_year;
		$from_year++;
		if(mysqli_num_rows($result)==1){
			//echo 'Exists : '.$from_year.'<br>';
			if($sql!='select fees_serial, info, receipt_number, fee_session, timestamp, fee_type, dbname from ('){
				$sql .= ' union all ';
			}
			$sql .= '(select fee_invoice.sno as fees_serial, "1" as info, receipt_number, fee_session, timestamp, fee_invoice.type as fee_type, "'.$db.'" as dbname from `'.$db.'`.fee_invoice left join `'.$db.'`.class_detail on class_detail.sno = fee_invoice.class_id where fee_invoice.type IN '.$fee_type.' '.$where.')
			union all 
			(select fee_invoice2.sno as fees_serial, "2" as info, receipt_number, fee_session, timestamp, fee_invoice2.type as fee_type, "'.$db.'" as dbname from `'.$db.'`.fee_invoice2 left join `'.$db.'`.class_detail on class_detail.sno = fee_invoice2.class_id where fee_invoice2.type IN '.$fee_type.' '.$where.')
			union all 
			(select fee_invoice3.sno as fees_serial, "3" as info, receipt_number, fee_session, timestamp, fee_invoice3.type as fee_type, "'.$db.'" as dbname from `'.$db.'`.fee_invoice3 left join `'.$db.'`.class_detail on class_detail.sno = fee_invoice3.class_id where fee_invoice3.type IN '.$fee_type.' '.$where.') ';
			/*union all 
			(select student_info3.sno as sno, stu_name, father_name,mother_name,gender,date_of_admission,student_info3.category,class, sub1, sub2, sub3, form_no, roll_no, tot_amount, cancel_date, remarks, fee_invoice4.sno as fees_serial, "4" as info, receipt_number, fee_session, timestamp, fee_invoice4.type as fee_type, "'.$db.'" as dbname from `'.$db.'`.fee_invoice4 left join `'.$db.'`.student_info3 on student_info3.sno = fee_invoice4.student_id) ';*/
		}
	}
	$sql .= ') as t1';
	$sql .= ' order by abs(receipt_number) desc limit 1';
	//echo $sql.'<br><br>';
	$result = execute_query($link, $sql);
	if(mysqli_num_rows($result)==1){
		$row = mysqli_fetch_assoc($result);
		$invoice_no = $row['receipt_number']+1;
	}
	else{
		$invoice_no = 1;
	}
	return $invoice_no;
	//echo $invoice_no;
}



function generate_ex_invoice_no($fees_type, $date){

	$link = mysqli_connect("p:localhost", "knipssexams", "Knip@13579", $_SESSION['db_name']);

	$time = strtotime($date);

	$month = date("m",$time);

	$current_year = date("Y",$time);



	$fy = $current_year;

	if($month>=1 && $month<=3){

		$fy = $fy-1;

	}

	$fee_type = $fees_type;

	$from_year = $current_year-1;

	$to_year = $current_year+1;

	

	$where=' and fee_session="'.$fy.'"';

	

	$sql = 'select fees_serial, info, receipt_number, fee_session, timestamp, fee_type, dbname from (';							

	while($from_year<=($to_year+1)){

		$sql_chk = 'SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = "knipss_college_'.$from_year.'"';

		$result = execute_query($link, $sql_chk);

		$db = 'knipss_college_'.$from_year;

		$from_year++;

		if(mysqli_num_rows($result)==1){

			//echo 'Exists : '.$from_year.'<br>';

			if($sql!='select fees_serial, info, receipt_number, fee_session, timestamp, fee_type, dbname from ('){

				$sql .= ' union all ';

			}

			$sql .= '(select fee_invoice4.sno as fees_serial, "4" as info, receipt_number, fee_session, timestamp, fee_invoice4.type as fee_type, "'.$db.'" as dbname from `'.$db.'`.fee_invoice4 left join `'.$db.'`.class_detail on class_detail.sno = fee_invoice4.class_id where fee_invoice4.type="'.$fee_type.'" '.$where.') ';



			/*union all 



			(select student_info3.sno as sno, stu_name, father_name,mother_name,gender,date_of_admission,student_info3.category,class, sub1, sub2, sub3, form_no, roll_no, tot_amount, cancel_date, remarks, fee_invoice4.sno as fees_serial, "4" as info, receipt_number, fee_session, timestamp, fee_invoice4.type as fee_type, "'.$db.'" as dbname from `'.$db.'`.fee_invoice4 left join `'.$db.'`.student_info3 on student_info3.sno = fee_invoice4.student_id) ';*/



		}

	}



	$sql .= ') as t1';



	$sql .= ' order by abs(receipt_number) desc limit 1';

	echo $sql.'<br><br>';

	$result = execute_query($link, $sql);

	if(mysqli_num_rows($result)==1){

		$row = mysqli_fetch_assoc($result);

		$invoice_no = $row['receipt_number']+1;

	}

	else{

		$invoice_no = 1;

	}

	return $invoice_no;

	//echo $invoice_no;



}

function get_subject_detail($id){

	if($id==''){

		return;

	}

	$sql = 'select * from add_subject where sno='.$id;

	$result = execute_query(connect(), $sql);

	$sub=mysqli_fetch_array($result);

	return $sub;

}

function get_other_subject_detail($id){

	if($id==''){

		return;

	}

	$sql = 'select * from add_subject2 where sno='.$id;

	$result = execute_query(connect(), $sql);

	$sub=mysqli_fetch_array($result);

	return $sub;

}



function get_class_detail($id){

	$sql = 'select * from class_detail where sno='.$id;

	//echo $sql;

	$sub = mysqli_fetch_array(execute_query(connect(), $sql));

	return $sub;

}

function get_count($id){

	$sql='select(select count(*) c from student_info where class="'.$id.'" and status=2 and sno not in(select student_id from student_info2)) as total';

	$result=execute_query(connect(), $sql);

	$count=mysqli_fetch_array($result);

	$sql='select(select count(*) c from student_info2 where class="'.$id.'" and status=2)  as total';

	$result1=execute_query(connect(), $sql);

	$count1=mysqli_fetch_array($result1);

	$tot_count['total'] = $count['total']+$count1['total'];

	//print_r($tot_count);

	return $tot_count;

	}

function get_admission_count_old($id, $df='', $dt=''){
	if($df!='' && $dt!=''){
		$date_filter = ' and counselling_date>="'.$df.'" and counselling_date<="'.$dt.'"';
	}
	else{
		$date_filter='';
	}
	//echo 'select count(*) c from student_info where class="'.$id.'" and status=5 and sno in (select student_id from student_info2 where 1=1 '.$date_filter.') <br>';
	$sql = 'select 
	(select count(*) c from student_info where class="'.$id.'" and status=2 and sno not in (select student_id from student_info2) '.$date_filter.') as total,
	(select count(*) c  from student_info where class="'.$id.'" and status=2  and sno not in (select student_id from student_info2) and gender="M"  '.$date_filter.') as total_m, 
	(select count(*) c from student_info where class="'.$id.'" and status=2  and sno not in (select student_id from student_info2) and gender="F"  '.$date_filter.') as total_f, 
	(select count(*) c  from student_info where class="'.$id.'" and status=2 and category="GEN" and minority in ("NO", "")  and sno not in (select student_id from student_info2)  '.$date_filter.') as total_gen,
	(select count(*) c  from student_info where class="'.$id.'" and status=2 and category="GEN" and gender="M" and minority in ("NO", "")  and sno not in (select student_id from student_info2) '.$date_filter.') as total_gen_m, 
	(select count(*) c  from student_info where class="'.$id.'" and status=2 and category="GEN" and gender="F" and minority in ("NO", "")  and sno not in (select student_id from student_info2) '.$date_filter.') as total_gen_f,
	(select count(*) c  from student_info where class="'.$id.'" and status=2 and category="OBC" and minority in ("NO", "")  and sno not in (select student_id from student_info2) '.$date_filter.')as total_obc,
	(select count(*) c  from student_info where class="'.$id.'" and status=2 and category="OBC" and gender="M" and minority in ("NO", "")  and sno not in (select student_id from student_info2) '.$date_filter.')as total_obc_m,
	(select count(*) c from student_info where class="'.$id.'" and status=2 and category="OBC" and gender="F" and minority in ("NO", "")  and sno not in (select student_id from student_info2) '.$date_filter.')as total_obc_f,
	(select count(*) c  from student_info where class="'.$id.'" and status=2 and category ="SC" and minority in ("NO", "") and sno not in (select student_id from student_info2) '.$date_filter.')as total_sc,
	(select count(*) c  from student_info where class="'.$id.'" and status=2 and category="SC" and minority in ("NO", "") and gender="M"  and sno not in (select student_id from student_info2) '.$date_filter.')as total_sc_m,
	(select count(*) c  from student_info where class="'.$id.'" and status=2 and category="SC" and minority in ("NO", "") and gender="F"  and sno not in (select student_id from student_info2) '.$date_filter.')as total_sc_f,
	(select count(*) c  from student_info where class="'.$id.'" and status=2 and category ="ST" and minority in ("NO", "") and sno not in (select student_id from student_info2) '.$date_filter.') as total_st,
	(select count(*) c  from student_info where class="'.$id.'" and status=2 and category="ST" and minority in ("NO", "") and gender="M"  and sno not in (select student_id from student_info2) '.$date_filter.') as total_st_m,
	(select count(*) c  from student_info where class="'.$id.'" and status=2 and category="ST" and minority in ("NO", "") and gender="F"  and sno not in (select student_id from student_info2) '.$date_filter.')as total_st_f, 
	(select count(*) c from student_info where class="'.$id.'" and status=2 and sno not in (select student_id from student_info2) and minority="YES" '.$date_filter.') as total_yes,
	(select count(*) c  from student_info where class="'.$id.'" and status=2 and minority="YES" and gender="M"  and sno not in (select student_id from student_info2) '.$date_filter.') as total_yes_m, 
	(select count(*) c  from student_info where class="'.$id.'" and status=2 and minority="YES" and gender="F"  and sno not in (select student_id from student_info2) '.$date_filter.') as total_yes_f, 
	(select count(*) c from student_info where class="'.$id.'" and status=2 and sno not in (select student_id from student_info2) and minority in ("NO", "") '.$date_filter.') as total_no, 
	(select count(*) c  from student_info where class="'.$id.'" and status=2 and minority in ("NO", "") and gender="M"  and sno not in (select student_id from student_info2) '.$date_filter.') as total_no_m, 
	(select count(*) c  from student_info where class="'.$id.'" and status=2 and minority in ("NO", "") and gender="F"  and sno not in (select student_id from student_info2) '.$date_filter.') as total_no_f,
	(select count(*) c from student_info where class="'.$id.'" and status=3 and sno not in (select student_id from student_info2) '.$date_filter.') as total_cancel_no, 
	(select count(*) c  from student_info where class="'.$id.'" and status=3 and gender="M"  and sno not in (select student_id from student_info2) '.$date_filter.') as total_cancel_no_m, 
	(select count(*) c  from student_info where class="'.$id.'" and status=3 and gender="F"  and sno not in (select student_id from student_info2) '.$date_filter.') as total_cancel_no_f, 
	(select count(*) c from student_info where class="'.$id.'" and status=5 and sno in (select student_id from student_info2 where 1=1 '.$date_filter.')) as total_change_subject';
	if($id==33){
		//echo $sql.'<br><br><br><br>';
	}
	
	//echo $sql.'<br><br><br><br>';
	$result=execute_query(connect(), $sql);
	$count=mysqli_fetch_array($result);
	$sql = 'select 
	(select count(*) c from student_info2 where class="'.$id.'" and status=2  '.$date_filter.') as total,
	(select count(*) c  from student_info2 where class="'.$id.'" and status=2 and gender="M" '.$date_filter.') as total_m,
	(select count(*) c from student_info2 where class="'.$id.'" and status=2   and gender="F" '.$date_filter.') as total_f, 
	(select count(*) c  from student_info2 where class="'.$id.'" and status=2 and category="GEN" and minority in ("NO", "") '.$date_filter.') as total_gen,
	(select count(*) c  from student_info2 where class="'.$id.'" and status=2 and category="GEN" and gender="M" and minority in ("NO", "") '.$date_filter.' ) as total_gen_m,
	(select count(*) c  from student_info2 where class="'.$id.'" and status=2 and category="GEN" and gender="F" and minority in ("NO", "") '.$date_filter.' ) as total_gen_f,
	(select count(*) c  from student_info2 where class="'.$id.'" and status=2 and category="OBC" and minority in ("NO", "") '.$date_filter.')as total_obc,
	(select count(*) c  from student_info2 where class="'.$id.'" and status=2 and category="OBC" and gender="M" and minority in ("NO", "") '.$date_filter.')as total_obc_m,
	(select count(*) c from student_info2 where class="'.$id.'" and status=2 and category="OBC" and gender="F" and minority in ("NO", "")  '.$date_filter.')as total_obc_f,
	(select count(*) c  from student_info2 where class="'.$id.'" and status=2 and category="SC" and minority in ("NO", "") '.$date_filter.') as total_sc,
	(select count(*) c  from student_info2 where class="'.$id.'" and status=2 and category="SC" and minority in ("NO", "") and gender="M" '.$date_filter.') as total_sc_m,
	(select count(*) c  from student_info2 where class="'.$id.'" and status=2 and category="SC" and minority in ("NO", "") and gender="F" '.$date_filter.') as total_sc_f,
	(select count(*) c  from student_info2 where class="'.$id.'" and status=2 and category="ST" and minority in ("NO", "") '.$date_filter.') as total_st,
	(select count(*) c  from student_info2 where class="'.$id.'" and status=2 and category="ST" and minority in ("NO", "") and gender="M" '.$date_filter.') as total_st_m,
	(select count(*) c  from student_info2 where class="'.$id.'" and status=2 and category="ST" and minority in ("NO", "") and gender="F" '.$date_filter.') as total_st_f, 
	(select count(*) c from student_info2 where class="'.$id.'" and status=2 and minority="YES"  '.$date_filter.') as total_yes, 
	(select count(*) c  from student_info2 where class="'.$id.'" and status=2 and minority="YES" and gender="M"  '.$date_filter.') as total_yes_m, 
	(select count(*) c  from student_info2 where class="'.$id.'" and status=2 and minority="YES" and gender="F"  '.$date_filter.') as total_yes_f,
	(select count(*) c from student_info2 where class="'.$id.'" and status=2 and minority in ("NO", "")  '.$date_filter.') as total_no, 
	(select count(*) c  from student_info2 where class="'.$id.'" and status=2 and minority in ("NO", "") and gender="M" '.$date_filter.' ) as total_no_m, 
	(select count(*) c  from student_info2 where class="'.$id.'" and status=2 and minority in ("NO", "") and gender="F"  '.$date_filter.') as total_no_f';
	$result1=execute_query(connect(), $sql);
	$count1=mysqli_fetch_array($result1);
	if($id==33){
		//echo $sql.'<br><br><br><br>';
	}
	//$tot_count=$count1;
	//echo $sql.'<br><br><br><br>';
	$tot_count['total'] = $count['total']+$count1['total'];
	$tot_count['total_m'] = $count['total_m']+$count1['total_m'];
	$tot_count['total_f']=$count['total_f']+$count1['total_f'];
	$tot_count['total_gen']=$count['total_gen']+$count1['total_gen'];
	$tot_count['total_gen_m']=$count['total_gen_m']+$count1['total_gen_m'];
	$tot_count['total_gen_f']=$count['total_gen_f']+$count1['total_gen_f'];
	$tot_count['total_obc']=$count['total_obc']+$count1['total_obc'];
	$tot_count['total_obc_m']=$count['total_obc_m']+$count1['total_obc_m'];
	$tot_count['total_obc_f']=$count['total_obc_f']+$count1['total_obc_f'];
	$tot_count['total_sc']=$count['total_sc']+$count1['total_sc'];
	$tot_count['total_sc_m']=$count['total_sc_m']+$count1['total_sc_m'];
	$tot_count['total_sc_f']=$count['total_sc_f']+$count1['total_sc_f'];
	$tot_count['total_st']=$count['total_st']+$count1['total_st'];
	$tot_count['total_st_m']=$count['total_st_m']+$count1['total_st_m'];
	$tot_count['total_st_f']=$count['total_st_f']+$count1['total_st_f'];
	$tot_count['total_yes']=$count['total_yes']+$count1['total_yes'];
	$tot_count['total_yes_m']=$count['total_yes_m']+$count1['total_yes_m'];
	$tot_count['total_yes_f']=$count['total_yes_f']+$count1['total_yes_f'];
	$tot_count['total_cancel_no']=$count['total_cancel_no'];
	$tot_count['total_cancel_no_m']=$count['total_cancel_no_m'];
	$tot_count['total_cancel_no_f']=$count['total_cancel_no_f'];
	$tot_count['total_change_subject']=$count['total_change_subject'];
	$tot_count['total_no']=$count['total_no']+$count1['total_no'];
	$tot_count['total_no_m']=$count['total_no_m']+$count1['total_no_m'];
	$tot_count['total_no_f']=$count['total_no_f']+$count1['total_no_f'];
	return $tot_count;
}


function get_admission_count($id, $df='', $dt=''){
	$tot_count['total'] = 0;
	$tot_count['total_m'] = 0;
	$tot_count['total_f'] = 0;
	$tot_count['total_gen'] = 0;
	$tot_count['total_gen_m'] = 0;
	$tot_count['total_gen_f'] = 0;
	$tot_count['total_obc'] = 0;
	$tot_count['total_obc_m'] = 0;
	$tot_count['total_obc_f'] = 0;
	$tot_count['total_sc'] = 0;
	$tot_count['total_sc_m'] = 0;
	$tot_count['total_sc_f'] = 0;
	$tot_count['total_st'] = 0;
	$tot_count['total_st_m'] = 0;
	$tot_count['total_st_f'] = 0;
	$tot_count['total_yes'] = 0;
	$tot_count['total_yes_m'] = 0;
	$tot_count['total_yes_f'] = 0;
	$tot_count['total_cancel_no'] = 0;
	$tot_count['total_cancel_no_m'] = 0;
	$tot_count['total_cancel_no_f'] = 0;
	$tot_count['total_change_subject'] = 0;
	$tot_count['total_change_subject_m'] = 0;
	$tot_count['total_change_subject_f'] = 0;
	$tot_count['total_no'] = 0;
	$tot_count['total_no_m'] = 0;
	$tot_count['total_no_f'] = 0;

	if($df!='' && $dt!=''){
		$date_filter = ' and counselling_date>="'.$df.'" and counselling_date<="'.$dt.'"';
	}
	else{
		$date_filter='';
	}
	
	/*Data from student_info i.e. new admission or uin admission*/
	
	$sql = '(SELECT count(*) c, gender, category, minority, status FROM `student_info` where status in (2,3,5) and class="'.$id.'" '.$date_filter.' group by gender, category, minority, status)
	
	union all 
	
	(SELECT count(*) c, gender, category, minority, status FROM `student_info2` where status in (2,3,5) and type="admission" and class="'.$id.'" '.$date_filter.' group by gender, category, minority, status)';
	if($id==110){
		//echo $sql.'<br><br><br><br>';
	}
	//echo $sql.'<br><br><br><br>';
	
	$result=execute_query(connect(), $sql);
	while($count=mysqli_fetch_array($result)){		
		if($count['minority']=='YES'){
			$tot_count['total_yes'] += $count['c'];
			$tot_count['total'] += $count['c'];
			if($count['gender']=='M'){
				$tot_count['total_yes_m'] += $count['c'];
				$tot_count['total_m'] += $count['c'];
			}
			else{
				$tot_count['total_yes_f'] += $count['c'];
				$tot_count['total_f'] += $count['c'];	
			}
		}
		else{
			if($count['gender']=='M'){
				$tot_count['total_m'] += $count['c'];	
			}
			if($count['gender']=='F'){
				$tot_count['total_f'] += $count['c'];	
			}
			if($count['category']=='GEN'){
				$tot_count['total_gen'] += $count['c'];	
				if($count['gender']=='M'){
					$tot_count['total_gen_m'] += $count['c'];
				}
				else{
					$tot_count['total_gen_f'] += $count['c'];
				}
			}
			if($count['category']=='OBC'){
				$tot_count['total_obc'] += $count['c'];	
				if($count['gender']=='M'){
					$tot_count['total_obc_m'] += $count['c'];
				}
				else{
					$tot_count['total_obc_f'] += $count['c'];
				}
			}
			if($count['category']=='SC'){
				$tot_count['total_sc'] += $count['c'];	
				if($count['gender']=='M'){
					$tot_count['total_sc_m'] += $count['c'];
				}
				else{
					$tot_count['total_sc_f'] += $count['c'];
				}
			}
			if($count['category']=='ST'){
				$tot_count['total_st'] += $count['c'];	
				if($count['gender']=='M'){
					$tot_count['total_st_m'] += $count['c'];
				}
				else{
					$tot_count['total_st_f'] += $count['c'];
				}
			}
			if($count['status']=='3'){
				$tot_count['total_cancel_no'] += $count['c'];
				if($count['gender']=='M'){
					$tot_count['total_cancel_no_m'] += $count['c'];
				}
				else{
					$tot_count['total_cancel_no_f'] += $count['c'];
				}
			}
			if($count['status']=='5'){
				//$tot_count['total_change_subject'] += $count['c'];	
				$tot_count['total'] += $count['c'];
			}
			else{
				$tot_count['total'] += $count['c'];

			}
		}
	}
	
	
	$sql = 'SELECT count(*) c, student_info2.gender as gender FROM `student_info2` left join student_info on student_info.sno = student_info2.student_id where student_info2.class!=student_info.class and student_info2.type="subject_change" and student_info2.class='.$id.' group by gender';
	if($id==3){
		//echo $sql.'<br><br><br><br>';
	}
	$result_change = execute_query(connect(), $sql);
	while($row_change = mysqli_fetch_assoc($result_change)){
		$tot_count['total_change_subject'] += $row_change['c'];	
		if($row_change['gender']=='M'){
			$tot_count['total_change_subject_m'] += $row_change['c'];
			$tot_count['total_m'] += $row_change['c'];
		}
		else{
			$tot_count['total_change_subject_f'] += $row_change['c'];
			$tot_count['total_f'] += $row_change['c'];
		}
		$tot_count['total'] += $row_change['c'];
		
	}
	
	
	
	return $tot_count;
}



function get_sub_count($class,$subject, $df='', $dt=''){
	if($df!='' && $dt!=''){
		$date_filter = ' and counselling_date>="'.$df.'" and counselling_date<="'.$dt.'"';
	}
	else{
		$date_filter='';
	}
	
	$tot_count_sub['total'] = 0;
	$tot_count_sub['total_m'] = 0;
	$tot_count_sub['total_f'] = 0;
	$tot_count_sub['total_gen'] = 0;
	$tot_count_sub['total_gen_m'] = 0;
	$tot_count_sub['total_gen_f'] = 0;
	$tot_count_sub['total_obc'] = 0;
	$tot_count_sub['total_obc_m'] = 0;
	$tot_count_sub['total_obc_f'] = 0;
	$tot_count_sub['total_sc_st'] = 0;
	$tot_count_sub['total_sc_st_m'] = 0;
	$tot_count_sub['total_sc_st_f'] = 0;
	$tot_count_sub['total_minority'] = 0;
	$tot_count_sub['total_minority_m'] = 0;
	$tot_count_sub['total_minority_f'] = 0;
	
	

	/*$sql = 'select(select  GROUP_CONCAT(student_id SEPARATOR ", ") as total_id from student_info2 where (sub1="'.$subject.'" or sub2="'.$subject.'" or sub3="'.$subject.'") and class="'.$class.'") as total,(select   GROUP_CONCAT(student_id SEPARATOR ", ") as total_id_m from student_info2 where (sub1="'.$subject.'" or sub2="'.$subject.'" or sub3="'.$subject.'") and class="'.$class.'" and gender="M") as total_m,(select   GROUP_CONCAT(student_id SEPARATOR ", ") as total_id_f from student_info2 where (sub1="'.$subject.'" or sub2="'.$subject.'" or sub3="'.$subject.'") and class="'.$class.'" and gender="F") as total_f, (select   GROUP_CONCAT(student_id SEPARATOR ", ") as total_id_gen from student_info2 where (sub1="'.$subject.'" or sub2="'.$subject.'" or sub3="'.$subject.'") and class="'.$class.'" and category="GEN") as total_gen, (select   GROUP_CONCAT(student_id SEPARATOR ", ") as total_id_gen_m from student_info2 where (sub1="'.$subject.'" or sub2="'.$subject.'" or sub3="'.$subject.'") and class="'.$class.'" and category="GEN" and gender="M") as total_gen_m,(select   GROUP_CONCAT(student_id SEPARATOR ", ") as total_id_gen_f from student_info2 where (sub1="'.$subject.'" or sub2="'.$subject.'" or sub3="'.$subject.'") and class="'.$class.'" and category="GEN" and gender="F") as total_gen_f,(select   GROUP_CONCAT(student_id SEPARATOR ", ") as total_id_obc from student_info2 where (sub1="'.$subject.'" or sub2="'.$subject.'" or sub3="'.$subject.'") and class="'.$class.'" and category="OBC")as total_obc,(select   GROUP_CONCAT(student_id SEPARATOR ", ") as total_id_obc_m from student_info2 where (sub1="'.$subject.'" or sub2="'.$subject.'" or sub3="'.$subject.'") and class="'.$class.'" and category="OBC" and gender="M")as total_obc_m,(select   GROUP_CONCAT(student_id SEPARATOR ", ") as total_id_obc_f from student_info2 where (sub1="'.$subject.'" or sub2="'.$subject.'" or sub3="'.$subject.'") and class="'.$class.'" and category="OBC" and gender="F")as total_obc_f,(select   GROUP_CONCAT(student_id SEPARATOR ", ") as total_id_sc_st from student_info2 where (sub1="'.$subject.'" or sub2="'.$subject.'" or sub3="'.$subject.'") and class="'.$class.'" and category in ("SC","ST"))as total_sc_st,(select   GROUP_CONCAT(student_id SEPARATOR ", ") as total_id_sc_st_m from student_info2 where (sub1="'.$subject.'" or sub2="'.$subject.'" or sub3="'.$subject.'") and class="'.$class.'" and category in ("SC","ST") and gender="M")as total_sc_st_m,(select   GROUP_CONCAT(student_id SEPARATOR ", ") as total_id_sc_st_f from student_info2 where (sub1="'.$subject.'" or sub2="'.$subject.'" or sub3="'.$subject.'") and class="'.$class.'" and category in ("SC","ST") and gender="F")as total_sc_st_f, (select GROUP_CONCAT(student_id SEPARATOR ", ") as total_id_minority from student_info2 where (sub1="1" or sub2="1" or sub3="1") and class="2" and minority="YES") as total_minority, (select GROUP_CONCAT(student_id SEPARATOR ", ") as total_id_minority_m from student_info2 where (sub1="1" or sub2="1" or sub3="1") and class="2" and minority="YES" and gender="M") as total_minority_m, (select GROUP_CONCAT(student_id SEPARATOR ", ") as total_id_minority_f from student_info2 where (sub1="1" or sub2="1" or sub3="1") and class="2" and minority="YES" and gender="F") as total_minority_f';

	//echo $sql.'<br><br>';

	//$result=execute_query(connect(), $sql);

	//$count_sub=mysqli_fetch_array($result);

	

	$sql = 'select 

	(select count(*) c from student_info where (sub1="'.$subject.'" or sub2="'.$subject.'" or sub3="'.$subject.'") and class="'.$class.'" and status="2" and sno not in (select student_id from student_info2)) as total,(select count(*) c  from student_info where (sub1="'.$subject.'" or sub2="'.$subject.'" or sub3="'.$subject.'") and class="'.$class.'" and status="2"  and sno not in (select student_id from student_info2) and gender="M") as total_m,(select count(*) c from student_info where (sub1="'.$subject.'" or sub2="'.$subject.'" or sub3="'.$subject.'") and class="'.$class.'" and status="2"  and sno not in (select student_id from student_info2) and gender="F") as total_f, (select count(*) c  from student_info where (sub1="'.$subject.'" or sub2="'.$subject.'" or sub3="'.$subject.'") and class="'.$class.'" and status="2" and category="GEN"  and sno not in (select student_id from student_info2)) as total_gen,(select count(*) c  from student_info where (sub1="'.$subject.'" or sub2="'.$subject.'" or sub3="'.$subject.'") and class="'.$class.'" and status="2" and category="GEN" and gender="M"  and sno not in (select student_id from student_info2)) as total_gen_m,(select count(*) c  from student_info where (sub1="'.$subject.'" or sub2="'.$subject.'" or sub3="'.$subject.'") and class="'.$class.'" and status="2" and category="GEN" and gender="F"  and sno not in (select student_id from student_info2)) as total_gen_f,(select count(*) c  from student_info where (sub1="'.$subject.'" or sub2="'.$subject.'" or sub3="'.$subject.'") and class="'.$class.'" and status="2" and category="OBC"  and sno not in (select student_id from student_info2))as total_obc,(select count(*) c  from student_info where (sub1="'.$subject.'" or sub2="'.$subject.'" or sub3="'.$subject.'") and class="'.$class.'" and status="2" and category="OBC" and gender="M"  and sno not in (select student_id from student_info2))as total_obc_m,(select count(*) c from student_info where (sub1="'.$subject.'" or sub2="'.$subject.'" or sub3="'.$subject.'") and class="'.$class.'" and status="2" and category="OBC" and gender="F"  and sno not in (select student_id from student_info2))as total_obc_f,(select count(*) c  from student_info where (sub1="'.$subject.'" or sub2="'.$subject.'" or sub3="'.$subject.'") and class="'.$class.'" and status="2" and category in ("SC","ST")  and sno not in (select student_id from student_info2))as total_sc_st,(select count(*) c  from student_info where (sub1="'.$subject.'" or sub2="'.$subject.'" or sub3="'.$subject.'") and class="'.$class.'" and status="2" and category in ("SC","ST") and gender="M"  and sno not in (select student_id from student_info2))as total_sc_st_m,(select count(*) c  from student_info where (sub1="'.$subject.'" or sub2="'.$subject.'" or sub3="'.$subject.'") and class="'.$class.'" and status="2" and category in ("SC","ST") and gender="F"  and sno not in (select student_id from student_info2))as total_sc_st_f,(select count(*) c  from student_info where (sub1="'.$subject.'" or sub2="'.$subject.'" or sub3="'.$subject.'") and class="'.$class.'" and status="2" and minority="YES" and sno not in (select student_id from student_info2))as total_minority,(select count(*) c  from student_info where (sub1="'.$subject.'" or sub2="'.$subject.'" or sub3="'.$subject.'") and class="'.$class.'" and status="2" and minority="YES" and gender="M" and sno not in (select student_id from student_info2))as total_minority_m,(select count(*) c  from student_info where (sub1="'.$subject.'" or sub2="'.$subject.'" or sub3="'.$subject.'") and class="'.$class.'" and status="2" and minority="YES" and gender="F" and sno not in (select student_id from student_info2))as total_minority_f';
	
	*/
	
	
	$sql = '(SELECT count(*) c, gender, category, minority, status FROM `student_info` where status in (2) and class="'.$class.'"  '.$date_filter.' and (sub1="'.$subject.'" or sub2="'.$subject.'" or sub3="'.$subject.'") group by gender, category, minority, status)
	
	union all 
	
	(SELECT count(*) c, gender, category, minority, status FROM `student_info2` where status in (2) and type in ("subject_change", "admission") and class="'.$class.'"  '.$date_filter.' and (sub1="'.$subject.'" or sub2="'.$subject.'" or sub3="'.$subject.'") group by gender, category, minority, status)';
	
	if($class==110 && $subject==1){
		//echo $sql.'<br><br>';
	}

	$result1=execute_query(connect(), $sql);

	while($count_sub1=mysqli_fetch_array($result1)){
		$tot_count_sub['total'] += $count_sub1['c'];
		if($count_sub1['gender']=='M'){
			$tot_count_sub['total_m'] += $count_sub1['c'];	
		}
		else{
			$tot_count_sub['total_f'] += $count_sub1['c'];	
		}
		if($count_sub1['category']=='GEN'){
			$tot_count_sub['total_gen'] += $count_sub1['c'];
			if($count_sub1['gender']=='M'){
				$tot_count_sub['total_gen_m'] += $count_sub1['c'];
			}
			else{
				$tot_count_sub['total_gen_f'] += $count_sub1['c'];
			}
		}
		if($count_sub1['category']=='OBC'){
			$tot_count_sub['total_obc'] += $count_sub1['c'];
			if($count_sub1['gender']=='M'){
				$tot_count_sub['total_obc_m'] += $count_sub1['c'];
			}
			else{
				$tot_count_sub['total_obc_f'] += $count_sub1['c'];
			}
		}
		if($count_sub1['category']=='SC' || $count_sub1['category']=='ST'){
			$tot_count_sub['total_sc_st'] += $count_sub1['c'];
			if($count_sub1['gender']=='M'){
				$tot_count_sub['total_sc_st_m'] += $count_sub1['c'];
			}
			else{
				$tot_count_sub['total_sc_st_f'] += $count_sub1['c'];
			}
		}
	}
	

	/*$sql = 'select 

	(select count(*) c from student_info2 where (sub1="'.$subject.'" or sub2="'.$subject.'" or sub3="'.$subject.'") and class="'.$class.'" and status="2") as total,(select count(*) c from student_info2 where (sub1="'.$subject.'" or sub2="'.$subject.'" or sub3="'.$subject.'") and class="'.$class.'" and status="2" and gender="M") as total_m,(select count(*) c from student_info2 where (sub1="'.$subject.'" or sub2="'.$subject.'" or sub3="'.$subject.'") and class="'.$class.'"  and status="2" and gender="F") as total_f,(select count(*) c from student_info2 where (sub1="'.$subject.'" or sub2="'.$subject.'" or sub3="'.$subject.'") and class="'.$class.'" and status="2" and category="GEN") as total_gen,(select count(*) c from student_info2 where (sub1="'.$subject.'" or sub2="'.$subject.'" or sub3="'.$subject.'") and class="'.$class.'" and status="2" and category="GEN" and gender="M") as total_gen_m,(select count(*) c from student_info2 where (sub1="'.$subject.'" or sub2="'.$subject.'" or sub3="'.$subject.'") and class="'.$class.'" and category="GEN" and gender="F") as total_gen_f,(select count(*) c from student_info2 where (sub1="'.$subject.'" or sub2="'.$subject.'" or sub3="'.$subject.'") and class="'.$class.'" and status="2" and category="OBC")as total_obc,(select count(*) c from student_info2 where (sub1="'.$subject.'" or sub2="'.$subject.'" or sub3="'.$subject.'") and class="'.$class.'" and status="2" and category="OBC" and gender="M")as total_obc_m,(select count(*) c from student_info2 where (sub1="'.$subject.'" or sub2="'.$subject.'" or sub3="'.$subject.'") and class="'.$class.'" and status="2" and category="OBC" and gender="F")as total_obc_f,(select count(*) c from student_info2 where (sub1="'.$subject.'" or sub2="'.$subject.'" or sub3="'.$subject.'") and class="'.$class.'" and status="2" and category in ("SC","ST"))as total_sc_st,(select count(*) c from student_info2 where (sub1="'.$subject.'" or sub2="'.$subject.'" or sub3="'.$subject.'") and class="'.$class.'" and status="2" and category in ("SC","ST") and gender="M")as total_sc_st_m,(select  count(*) c from student_info2 where (sub1="'.$subject.'" or sub2="'.$subject.'" or sub3="'.$subject.'") and class="'.$class.'" and status="2" and category in ("SC","ST") and gender="F")as total_sc_st_f,(select  count(*) c from student_info2 where (sub1="'.$subject.'" or sub2="'.$subject.'" or sub3="'.$subject.'") and class="'.$class.'" and status="2" and minority="YES")as total_minority,(select  count(*) c from student_info2 where (sub1="'.$subject.'" or sub2="'.$subject.'" or sub3="'.$subject.'") and class="'.$class.'" and status="2" and minority="YES" and gender="F")as total_minority_f,(select  count(*) c from student_info2 where (sub1="'.$subject.'" or sub2="'.$subject.'" or sub3="'.$subject.'") and class="'.$class.'" and status="2" and minority="YES" and gender="M")as total_minority_m';*/
	
	return $tot_count_sub;

}

function convert_num_to_string($number){

   $no = round($number);

   $point = round($number - $no, 2) * 100;

   $hundred = null;

   $digits_1 = strlen($no);

   $i = 0;

   $str = array();

   $words = array('0' => '', '1' => 'one', '2' => 'two',

    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',

    '7' => 'seven', '8' => 'eight', '9' => 'nine',

    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',

    '13' => 'thirteen', '14' => 'fourteen',

    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',

    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',

    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',

    '60' => 'sixty', '70' => 'seventy',

    '80' => 'eighty', '90' => 'ninety');

   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');

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









function fees_bifucation($row){
	$category=$row['category'];
	$tot[0]=0;
	for($td=1; $td<=60; $td++){
		$tot[]=0;
	}
	$print='';
	$tot_fees=0;
	$class = mysqli_fetch_array(execute_query(connect(), "select * from class_detail where sno=".$row['class']));
	$sql= "select * from head_type";
	$result_head = execute_query(connect(), $sql);
	$i=1;
	if($class['type']!='self'){
		$print .= '<td>'.$row['stu_name'].'</td>
		<td>'.$class['class_description'].'</td>
		<td>'.$row['roll_no'].'</td>
		<td>'.$category.'</td>
		<td>'.$row['gender'].'</td>
		<td>'.date("d-m-Y",$row['timestamp']).'</td>';
		$sql = 'select * from fee_invoice where class_id="'.$row['class'].'" and student_id="'.$row['student_serial'].'" and amount_paid is not NULL and type='."'fees'";
		//echo $sql.'<br>';
		$amount_paid = mysqli_fetch_array(execute_query(connect(), $sql));
		$amount_paid = $amount_paid['amount_paid'];
		//echo $row['category'].'--'.$row['annual_income'].'<br>';
		if($row['annual_income']>=200000){
			$row['category']='GEN';
		}
		if($row['category']=='GEN' || $row['category']=='OBC'){
			$sql='select * from fees_detail where class_id='.$row['class'];
			$fees_bifur = execute_query(connect(), $sql);
			while($row_fees_bifur = mysqli_fetch_array($fees_bifur)){
				$fees_breakup[$row_fees_bifur['head_id']] = $row_fees_bifur['fee_amount'];
			}
		}
		if($row['category']=='SC' || $row['category']=='ST'){
			$sql='select * from fees_detail4 where class_id='.$row['class'];
			$fees_bifur = execute_query(connect(), $sql);
			while($row_fees_bifur = mysqli_fetch_array($fees_bifur)){
				$fees_breakup[$row_fees_bifur['head_id']] = $row_fees_bifur['fee_amount'];
			}
		}
		if($row['category']=="SC" || $row['category']=="ST"){
			$fees_amount = calc_fees_sc($row['class'],$row['sub1'],$row['sub2'],$row['sub3'],$row['gender'],$row['category']);
			$total2=0;
			while($row_head = mysqli_fetch_array($result_head)){
				$sql = "select * from fees_detail4 where class_id=".$row['class']." and head_id=".$row_head['sno'];
				$fee['fee_amount'] = $fees_breakup[$row_head['sno']];
				if($row_head['sno']==1){
					if($row['gender']=='F'){
						$sql='select * from class_detail where sno='.$row['class'];
						$self_fees=mysqli_fetch_array(execute_query(connect(), $sql));
						if($self_fees['type']=='SELF'){
							$print .= '<td>'.$fee['fee_amount'].'</td>';
							$tot_fees += $fee['fee_amount'];
							$tot[$row_head['sno']]+=$fee['fee_amount']; 
						}
						else{
							$print .= '<td>-</td>';
						}	
					}
					else {
						$print .= '<td>'.$fee['fee_amount'].'</td>';
						$tot_fees += $fee['fee_amount'];
						$tot[$row_head['sno']]+=$fee['fee_amount'];
					}
				}
				elseif($row_head['sno']>=2 and $row_head['sno']<=8){
					if($row_head['sno']==4){
						$print .= '<td>'.$tot_fees.'</td>';
						$tot[50]+=$tot_fees;
					}
					$print .= '<td>'.$fee['fee_amount'].'</td>';
					$tot_fees += $fee['fee_amount'];			
					$tot[$row_head['sno']]+=$fee['fee_amount'];
					if($row_head['sno']>=4){
						$total2+=$fee['fee_amount'];
					}
				}
				elseif($row_head['sno']==9){
					$sql="select * from class_detail where sno=".$row['class'];
					$class_id = mysqli_fetch_array(execute_query(connect(), $sql));
					if($class_id['category']=='PG' || $class_id['type']=='PG'){
						if($row['other_univ']=='awadh'){
							$print .= '<td>0</td>';
						}
						else{
							$print .= '<td>'.$fee['fee_amount'].'</td>';
						    $tot_fees += $fee['fee_amount'];			
							$tot[$row_head['sno']]+=$fee['fee_amount'];
							$total2+=$fee['fee_amount'];
						}
					}
					else{
						$print .= '<td>'.$fee['fee_amount'].'</td>';
						$tot_fees += $fee['fee_amount'];			
						$tot[$row_head['sno']]+=$fee['fee_amount'];
						$total2+=$fee['fee_amount'];
					}
				}
				elseif($row_head['sno']>=10 and $row_head['sno']<=13){
					$print .= '<td>'.$fee['fee_amount'].'</td>';
					$tot_fees += $fee['fee_amount'];			
					$tot[$row_head['sno']]+=$fee['fee_amount'];
					$total2+=$fee['fee_amount'];
				}
				elseif($row_head['sno']==14){
					$sub_count = calc_sub_fees_new($row['class'], $row['sub1'], $row['sub2'], $row['sub3']);
					$prac_caution = $fee['fee_amount']*$sub_count['c'];
					$print .= '<td>'.$prac_caution.'</td>';
					$tot_fees += $prac_caution;
					$tot[$row_head['sno']]+=$prac_caution;
					$total2+=$prac_caution;
				}
				elseif($row_head['sno']>=15 and $row_head['sno']<=16){
					$print .= '<td>'.$fee['fee_amount'].'</td>';
					$tot_fees += $fee['fee_amount'];			
					$tot[$row_head['sno']]+=$fee['fee_amount'];
					$total2+=$fee['fee_amount'];
				}
				elseif($row_head['sno']==17){
					if($class['category']=='PG'){
						//if($fee['fee_amount']!=0 && $row['other_univ']!='awadh'){
							$print .= '<td>'.$fee['fee_amount'].'</td>';
							$tot_fees += $fee['fee_amount'];
							$tot[$row_head['sno']]+=$fee['fee_amount'];
							$total2+=$fee['fee_amount'];
						//}
						//else{
							//$print .= '<td>0</td>';
						//}
					}
					else{
						$print .= '<td>'.$fee['fee_amount'].'</td>';
						$tot_fees += $fee['fee_amount'];
						$tot[$row_head['sno']]+=$fee['fee_amount'];	
						$total2+=$fee['fee_amount'];
					}
				}
				elseif($row_head['sno']>=18 and $row_head['sno']<=26){
					$print .= '<td>'.$fee['fee_amount'].'</td>';
					$tot_fees += $fee['fee_amount'];			
					$tot[$row_head['sno']]+=$fee['fee_amount'];
					$total2+=$fee['fee_amount'];
					if($row_head['sno']==21){
						$sql = 'select * from subject_fees4 where class_id='.$row['class'].' and fees!="" limit 1';
						$lab_fees=mysqli_fetch_array(execute_query(connect(), $sql));
						$sub_count = calc_sub_fees_new_sc($row['class'], $row['sub1'], $row['sub2'], $row['sub3']);
						$lab_fees['fees'] = $lab_fees['fees']*$sub_count['c'];
						$print .= '<td>'.$lab_fees['fees'].'</td>';
						$tot_fees += $lab_fees['fees'];
						$tot[22]+=$lab_fees['fees'];
						$total2+=$lab_fees['fees'];
					}
				}
				elseif($row_head['sno']==27){
					$self=0;
					$sub1 = calc_sub_fees($row['class'],$row['sub1']);
					$sub2 = calc_sub_fees($row['class'],$row['sub2']);
					$sub3 = calc_sub_fees($row['class'],$row['sub3']);
					$self += $fee['fee_amount'];
					$print .= '<td>'.$self.'</td>';
					$tot_fees += $self;
					$tot[$row_head['sno']]+=$self;
					$total2+=$self;
				}
				elseif($row_head['sno']>=28){
					$print .= '<td>'.$fee['fee_amount'].'</td>';
					$tot_fees += $fee['fee_amount'];			
					$tot[$row_head['sno']]+=$fee['fee_amount'];
					$total2+=$fee['fee_amount'];
					if($row_head['sno']==29){
						$tot[52]+=$total2;
						$print .= '<td>'.$total2.'</td>';
					}
				}
			}

		}
		else{
			$fees_amount = calc_fees($row['class'],$row['sub1'],$row['sub2'],$row['sub3'],$row['gender'],$row['category']);
			//echo $row['stu_name'].'--'.$fees_amount.'<br>';
			$total2=0;
			while($row_head = mysqli_fetch_array($result_head)){
				$sql = "select * from fees_detail where class_id=".$row['class']." and head_id=".$row_head['sno'];
				$fee['fee_amount'] = $fees_breakup[$row_head['sno']];
				if($row_head['sno']==1){
					if($row['gender']=='F'){
						$sql='select * from class_detail where sno='.$row['class'];
						$self_fees=mysqli_fetch_array(execute_query(connect(), $sql));
						if($self_fees['type']=='SELF'){
							$print .= '<td>'.$fee['fee_amount'].'</td>';
							$tot_fees += $fee['fee_amount'];
							$tot[$row_head['sno']]+=$fee['fee_amount']; 
						}
						else{
							$print .= '<td>-</td>';
						}	
					}
					else {
						$print .= '<td>'.$fee['fee_amount'].'</td>';
						$tot_fees += $fee['fee_amount'];
						$tot[$row_head['sno']]+=$fee['fee_amount'];
					}
					
				}
				elseif($row_head['sno']>=2 and $row_head['sno']<=8){
					if($row_head['sno']==4){
						$print .= '<td>'.$tot_fees.'</td>';
						$tot[50]+=$tot_fees;
					}
					$print .= '<td>'.$fee['fee_amount'].'</td>';
					$tot_fees += $fee['fee_amount'];			
					$tot[$row_head['sno']]+=$fee['fee_amount'];
					if($row_head['sno']>=4){
						$total2+=$fee['fee_amount'];
					}
				}
				elseif($row_head['sno']==9){
					$sql="select * from class_detail where sno=".$row['class'];
					$class_id = mysqli_fetch_array(execute_query(connect(), $sql));
					if($class_id['category']=='PG' || $class_id['type']=='PG' || $class_id['sort_no']=='LLB'){
						if($row['other_univ']=='awadh'){
							$print .= '<td>0</td>';
						}
						else{
							$print .= '<td>'.$fee['fee_amount'].'</td>';
							$tot_fees += $fee['fee_amount'];			
							$tot[$row_head['sno']]+=$fee['fee_amount'];
							$total2+=$fee['fee_amount'];
						}
					}
					else{
						$print .= '<td>'.$fee['fee_amount'].'</td>';
						$tot_fees += $fee['fee_amount'];			
					$tot[$row_head['sno']]+=$fee['fee_amount'];
						$total2+=$fee['fee_amount'];
					}
				}
				elseif($row_head['sno']>=10 and $row_head['sno']<=13){
					$print .= '<td>'.$fee['fee_amount'].'</td>';
					$tot_fees += $fee['fee_amount'];			
					$tot[$row_head['sno']]+=$fee['fee_amount'];
					$total2+=$fee['fee_amount'];
				}
				elseif($row_head['sno']==14){
					$sub_count = calc_sub_fees_new($row['class'], $row['sub1'], $row['sub2'], $row['sub3']);
					$prac_caution = $fee['fee_amount']*$sub_count['c'];
					$print .= '<td>'.$prac_caution.'</td>';
					$tot_fees += $prac_caution;
					$tot[$row_head['sno']]+=$prac_caution;
					$total2+=$prac_caution;
				}
				elseif($row_head['sno']>=15 and $row_head['sno']<=16){
				$print .= '<td>'.$fee['fee_amount'].'</td>';
					$tot_fees += $fee['fee_amount'];			
					$tot[$row_head['sno']]+=$fee['fee_amount'];
					$total2+=$fee['fee_amount'];
				}
				elseif($row_head['sno']==17){
					if($class['category']=='PG'){
						//if($fee['fee_amount']!=0 && $row['other_univ']!='awadh'){
							$print .= '<td>'.$fee['fee_amount'].'</td>';
							$tot_fees += $fee['fee_amount'];
							$tot[$row_head['sno']]+=$fee['fee_amount'];
							$total2+=$fee['fee_amount'];
						//}
						//else{
							//$print .= '<td>0</td>';
						//}
					}
					else{
						$print .= '<td>'.$fee['fee_amount'].'</td>';
						$tot_fees += $fee['fee_amount'];
						$tot[$row_head['sno']]+=$fee['fee_amount'];	
						$total2+=$fee['fee_amount'];
					}
				}
				elseif($row_head['sno']>=18 and $row_head['sno']<=26){
					$print .= '<td>'.$fee['fee_amount'].'</td>';
					$tot_fees += $fee['fee_amount'];			
					$tot[$row_head['sno']]+=$fee['fee_amount'];
					$total2+=$fee['fee_amount'];
					if($row_head['sno']==21){
						$sql = 'select * from subject_fees where class_id='.$row['class'].' and fees!="" limit 1';
						//echo $sql.'<br>';
						$lab_fees=mysqli_fetch_array(execute_query(connect(), $sql));
						$sub_count = calc_sub_fees_new($row['class'], $row['sub1'], $row['sub2'], $row['sub3']);
						$lab_fees['fees'] = $lab_fees['fees']*$sub_count['c'];
						$print .= '<td>'.$lab_fees['fees'].'</td>';
						$tot_fees += $lab_fees['fees'];
						$tot[22]+=$lab_fees['fees'];
						$total2+=$lab_fees['fees'];
					}
				}
				elseif($row_head['sno']==27){
					$self=0;
					$sub1 = calc_sub_fees($row['class'],$row['sub1']);
					$sub2 = calc_sub_fees($row['class'],$row['sub2']);
					$sub3 = calc_sub_fees($row['class'],$row['sub3']);
					$self += $fee['fee_amount'];
					$print .= '<td>'.$self.'</td>';
					$tot_fees += $self;
					$tot[$row_head['sno']]+=$self;
					$total2+=$self;
				}
				elseif($row_head['sno']>=28){
					$print .= '<td>'.$fee['fee_amount'].'</td>';
					$tot_fees += $fee['fee_amount'];			
					$tot[$row_head['sno']]+=$fee['fee_amount'];
					$total2+=$fee['fee_amount'];
					if($row_head['sno']==29){
						$tot[52]+=$total2;
						$print .= '<td>'.$total2.'</td>';
					}
				}
			}

		}
		$print .= '<td>'.$tot_fees.'</td>';
		if($amount_paid!=$tot_fees){
			if($amount_paid>$tot_fees){
				$print .= '<td>'.($amount_paid-$tot_fees).'</td>';
			}
			else{
				$print .= '<td>0</td><td>ERROR</td>';
			}
		}
	
		$print_extra = '<td>'.$amount_paid.'</td>';
		$tot[30]+=$tot_fees;
		$tot[31]+=$amount_paid;
	}
	$final[] = $print.$print_extra;
	$final[] = $tot;
	$final[] = $print;
	return $final;
}



function fees_bifurcation_second($row){

	$category=$row['category'];

	$tot[0]=0;

	for($td=1; $td<=60; $td++){

		$tot[]=0;

	}

	$print='';

	$tot_fees=0;

	$sql= "select * from head_type";

	$result_head = execute_query(connect(), $sql);

	if($row['annual_income']>=200000){

		$row['category']='GEN';

	}

	if($row['category']=='GEN' || $row['category']=='OBC'){

		$sql='select * from fees_detail2 where class_id='.$row['class'];

		$fees_bifur = execute_query(connect(), $sql);

		while($row_fees_bifur = mysqli_fetch_array($fees_bifur)){

			$fees_breakup[$row_fees_bifur['head_id']] = $row_fees_bifur['fee_amount'];

		}

	}

	if($row['category']=='SC' || $row['category']=='ST'){

		$sql='select * from fees_detail3 where class_id='.$row['class'];

		$fees_bifur = execute_query(connect(), $sql);

		while($row_fees_bifur = mysqli_fetch_array($fees_bifur)){

			$fees_breakup[$row_fees_bifur['head_id']] = $row_fees_bifur['fee_amount'];

		}

	}

	$class = mysqli_fetch_array(execute_query(connect(), "select * from class_detail where sno=".$row['class']));

	if($class['type']!='self'){

		$print.='<td>'.$row['stu_name'].'</td>

		<td>'.$class['class_description'].'</td>

		<td>'.$row['roll_no'].'</td>

		<td>'.$category.'</td>

		<td>'.$row['gender'].'</td>

		<td>'.date("d-m-Y",$row['timestamp']).'</td>';

		

		

		if($row['category']=="SC" || $row['category']=="ST"){

			$fees_amount = calc_second_fees_sc($row['class'],$row['sub1'],$row['sub2'],$row['sub3'],$row['gender'],$row['category']);

			$total2=0;

			while($row_head = mysqli_fetch_array($result_head)){

				//$sql = "select * from fees_detail3 where class_id=".$row['class']." and head_id=".$row_head['sno'];

				$fee['fee_amount'] = $fees_breakup[$row_head['sno']];

				if($row_head['sno']==1){

					if($row['gender']=='F'){

						//$sql='select * from class_detail where sno='.$row['class'];

						//$self_fees=mysqli_fetch_array(execute_query(connect(), $sql));

						$self_fees = $class;

						if($self_fees['type']=='SELF'){

							$print.= '<td>'.$fee['fee_amount'].'</td>';

							$tot_fees += $fee['fee_amount'];

							$tot[$row_head['sno']]+=$fee['fee_amount']; 

						}

						else{

							$print.= '<td>-</td>';

						}	

					}

					else {

						$print.= '<td>'.$fee['fee_amount'].'</td>';

						$tot_fees += $fee['fee_amount'];

						$tot[$row_head['sno']]+=$fee['fee_amount'];

					}

				}

				elseif($row_head['sno']>=2 and $row_head['sno']<=8){

					if($row_head['sno']==4){

						$print.='<td>'.$tot_fees.'</td>';

						$tot[50]+=$tot_fees;

					}

					$print.='<td>'.$fee['fee_amount'].'</td>';

					$tot_fees += $fee['fee_amount'];			

					$tot[$row_head['sno']]+=$fee['fee_amount'];

					if($row_head['sno']>=4){

						$total2+=$fee['fee_amount'];

					}

				}

				elseif($row_head['sno']==9){

					//$sql="select * from class_detail where sno=".$row['class'];

					$class_id = $class; //mysqli_fetch_array(execute_query(connect(), $sql));

					if($class_id['category']=='PG' || $class_id['type']=='PG'){

						$print.= '<td>'.$fee['fee_amount'].'</td>';

						$tot_fees += $fee['fee_amount'];			

						$tot[$row_head['sno']]+=$fee['fee_amount'];

						$total2+=$fee['fee_amount'];

						

					}

					else{

						$print.= '<td>'.$fee['fee_amount'].'</td>';

						$tot_fees += $fee['fee_amount'];			

						$tot[$row_head['sno']]+=$fee['fee_amount'];

						$total2+=$fee['fee_amount'];

					}

				}

				elseif($row_head['sno']>=10 and $row_head['sno']<=13){

					$print.='<td>'.$fee['fee_amount'].'</td>';

					$tot_fees += $fee['fee_amount'];			

					$tot[$row_head['sno']]+=$fee['fee_amount'];

					$total2+=$fee['fee_amount'];

				}

				elseif($row_head['sno']==14){

					$sub_count = calc_sub_fees_second_sc($row['class'], $row['sub1'], $row['sub2'], $row['sub3']);

					$prac_caution = $fee['fee_amount']*$sub_count['c'];

					$print.='<td>'.$prac_caution.'</td>';

					$tot_fees += $prac_caution;

					$tot[$row_head['sno']]+=$prac_caution;

					$total2+=$prac_caution;

				}

				elseif($row_head['sno']>=15 and $row_head['sno']<=16){

					$print.='<td>'.$fee['fee_amount'].'</td>';

					$tot_fees += $fee['fee_amount'];			

					$tot[$row_head['sno']]+=$fee['fee_amount'];

					$total2+=$fee['fee_amount'];

				}

				elseif($row_head['sno']==17){

					if($class['category']=='PG'){

						//if($fee['fee_amount']!=0 && $row['otder_univ']!='awadh'){

							$print.= '<td>'.$fee['fee_amount'].'</td>';

							$tot_fees += $fee['fee_amount'];

							$tot[$row_head['sno']]+=$fee['fee_amount'];

							$total2+=$fee['fee_amount'];

						//}

						//else{

							//echo '<td>0</td>';

						//}

					}

					else{

						$print.='<td>'.$fee['fee_amount'].'</td>';

						$tot_fees += $fee['fee_amount'];

						$tot[$row_head['sno']]+=$fee['fee_amount'];	

						$total2+=$fee['fee_amount'];

					}

				}

				elseif($row_head['sno']>=18 and $row_head['sno']<=26){

					$print.='<td>'.$fee['fee_amount'].'</td>';

					$tot_fees += $fee['fee_amount'];			

					$tot[$row_head['sno']]+=$fee['fee_amount'];

					$total2+=$fee['fee_amount'];

					if($row_head['sno']==21){

						$sql = 'select * from subject_fees3 where class_id='.$row['class'].' and fees!="" limit 1';

						$lab_fees=mysqli_fetch_array(execute_query(connect(), $sql));

						$sub_count = calc_sub_fees_second_sc($row['class'], $row['sub1'], $row['sub2'], $row['sub3']);

						$lab_fees['fees'] = $lab_fees['fees']*$sub_count['c'];

						$print.='<td>'.$lab_fees['fees'].'</td>';

						$tot_fees += $lab_fees['fees'];

						$tot[22]+=$lab_fees['fees'];

						$total2+=$lab_fees['fees'];

					}

				}

				elseif($row_head['sno']==27){

					$self=0;

					$sub1 = calc_sub_fees($row['class'],$row['sub1']);

					$sub2 = calc_sub_fees($row['class'],$row['sub2']);

					$sub3 = calc_sub_fees($row['class'],$row['sub3']);

					$self += $fee['fee_amount'];

					$print.='<td>'.$self.'</td>';

					$tot_fees += $self;

					$tot[$row_head['sno']]+=$self;

					$total2+=$self;

				}

				elseif($row_head['sno']>=28){

					$print.='<td>'.$fee['fee_amount'].'</td>';

					$tot_fees += $fee['fee_amount'];			

					$tot[$row_head['sno']]+=$fee['fee_amount'];

					$total2+=$fee['fee_amount'];

					if($row_head['sno']==29){

						$tot[52]+=$total2;

						$print.='<td>'.$total2.'</td>';

					}

				}

			}

		}

		else{

			$fees_amount = calc_second_fees_gen($row['class'],$row['sub1'],$row['sub2'],$row['sub3'],$row['gender'],$row['category']);

			$total2=0;

			while($row_head = mysqli_fetch_array($result_head)){

				//$sql = "select * from fees_detail2 where class_id=".$row['class']." and head_id=".$row_head['sno'];

				$fee['fee_amount'] = $fees_breakup[$row_head['sno']];

				if($row_head['sno']==1){

					if($row['gender']=='F'){

						//$sql='select * from class_detail where sno='.$row['class'];

						$self_fees= $class; //mysqli_fetch_array(execute_query(connect(), $sql));

						if($self_fees['type']=='SELF'){

							$print.='<td>'.$fee['fee_amount'].'</td>';

							$tot_fees += $fee['fee_amount'];

							$tot[$row_head['sno']]+=$fee['fee_amount']; 

						}

						else{

							$print.='<td>-</td>';

						}	

					}

					else {

						$print.='<td>'.$fee['fee_amount'].'</td>';

						$tot_fees += $fee['fee_amount'];

						$tot[$row_head['sno']]+=$fee['fee_amount'];

					}

					

				}

				elseif($row_head['sno']>=2 and $row_head['sno']<=8){

					if($row_head['sno']==4){

						$print.='<td>'.$tot_fees.'</td>';

						$tot[50]+=$tot_fees;

					}

					$print.='<td>'.$fee['fee_amount'].'</td>';

					$tot_fees += $fee['fee_amount'];			

					$tot[$row_head['sno']]+=$fee['fee_amount'];

					if($row_head['sno']>=4){

						$total2+=$fee['fee_amount'];

					}

				}

				elseif($row_head['sno']==9){

					//$sql="select * from class_detail where sno=".$row['class'];

					$class_id = $class; //mysqli_fetch_array(execute_query(connect(), $sql));

					if($class_id['category']=='PG' || $class_id['type']=='PG'){

						if($row['other_univ']=='awadh'){

							$print.='<td>0</td>';

						}

						else{

							$print.='<td>'.$fee['fee_amount'].'</td>';

							$tot_fees += $fee['fee_amount'];			

							$tot[$row_head['sno']]+=$fee['fee_amount'];

							$total2+=$fee['fee_amount'];

						}

					}

					else{

						$print.='<td>'.$fee['fee_amount'].'</td>';

						$tot_fees += $fee['fee_amount'];			

						$tot[$row_head['sno']]+=$fee['fee_amount'];

						$total2+=$fee['fee_amount'];

					}

				}

				elseif($row_head['sno']>=10 and $row_head['sno']<=13){

					$print.='<td>'.$fee['fee_amount'].'</td>';

					$tot_fees += $fee['fee_amount'];			

					$tot[$row_head['sno']]+=$fee['fee_amount'];

					$total2+=$fee['fee_amount'];

				}

				elseif($row_head['sno']==14){

					$sub_count = calc_sub_fees_second($row['class'], $row['sub1'], $row['sub2'], $row['sub3']);

					$prac_caution = $fee['fee_amount']*$sub_count['c'];

					$print.='<td>'.$prac_caution.'</td>';

					$tot_fees += $prac_caution;

					$tot[$row_head['sno']]+=$prac_caution;

					$total2+=$prac_caution;

				}

				elseif($row_head['sno']>=15 and $row_head['sno']<=16){

					$print.='<td>'.$fee['fee_amount'].'</td>';

					$tot_fees += $fee['fee_amount'];			

					$tot[$row_head['sno']]+=$fee['fee_amount'];

					$total2+=$fee['fee_amount'];

				}

				elseif($row_head['sno']==17){

					if($class['category']=='PG'){

						//if($fee['fee_amount']!=0 && $row['otder_univ']!='awadh'){

							$print.='<td>'.$fee['fee_amount'].'</td>';

							$tot_fees += $fee['fee_amount'];

							$tot[$row_head['sno']]+=$fee['fee_amount'];

							$total2+=$fee['fee_amount'];

						//}

						//else{

							//echo '<td>0</td>';

						//}

					}

					else{

						$print.='<td>'.$fee['fee_amount'].'</td>';

						$tot_fees += $fee['fee_amount'];

						$tot[$row_head['sno']]+=$fee['fee_amount'];	

						$total2+=$fee['fee_amount'];

					}

				}

				elseif($row_head['sno']>=18 and $row_head['sno']<=26){

					$print.='<td>'.$fee['fee_amount'].'</td>';

					$tot_fees += $fee['fee_amount'];			

					$tot[$row_head['sno']]+=$fee['fee_amount'];

					$total2+=$fee['fee_amount'];

					if($row_head['sno']==21){

						$sql = 'select * from subject_fees2 where class_id='.$row['class'].' and fees!="" limit 1';

						$lab_fees=mysqli_fetch_array(execute_query(connect(), $sql));

						$sub_count = calc_sub_fees_second($row['class'], $row['sub1'], $row['sub2'], $row['sub3']);

						$lab_fees['fees'] = $lab_fees['fees']*$sub_count['c'];

						$print.='<td>'.$lab_fees['fees'].'</td>';

						$tot_fees += $lab_fees['fees'];

						$tot[22]+=$lab_fees['fees'];

						$total2+=$lab_fees['fees'];

						//echo $sql.'<br>';

					}

				}

				elseif($row_head['sno']==27){

					$self=0;

					$sub1 = calc_sub_fees($row['class'],$row['sub1']);

					$sub2 = calc_sub_fees($row['class'],$row['sub2']);

					$sub3 = calc_sub_fees($row['class'],$row['sub3']);

					$self += $fee['fee_amount'];

					$print.='<td>'.$self.'</td>';

					$tot_fees += $self;

					$tot[$row_head['sno']]+=$self;

					$total2+=$self;

				}

				elseif($row_head['sno']>=28){

					$print.='<td>'.$fee['fee_amount'].'</td>';

					$tot_fees += $fee['fee_amount'];			

					$tot[$row_head['sno']]+=$fee['fee_amount'];

					$total2+=$fee['fee_amount'];

					if($row_head['sno']==29){

						$tot[52]+=$total2;

						$print.= '<td>'.$total2.'</td>';

					}

				}

	  

			}

		}



		$sql = 'select * from fee_invoice3 where class_id="'.$row['class'].'" and student_id="'.$row['student_serial'].'" and amount_paid is not NULL and type='."'fees'";

		//echo $sql.'<br>';

		$amount_paid = mysqli_fetch_array(execute_query(connect(), $sql));

		$amount_paid = $amount_paid['amount_paid'];



		if($amount_paid>$tot_fees){

			$excess = $amount_paid-$tot_fees;

			$print .= '<td>'.$excess.'</td>';

			$tot_fees += $excess;

			$tot[30] += $excess;

		}

		else{

			$print .= '<td>0</td>';

			$tot[30] += 0;

		}

		$print.='<td>'.$tot_fees.'</td>';

		$print_extra='<td>'.$amount_paid.'</td>';

		//$tot[49]+=$prac;

		$tot[31]+=$tot_fees;

		$tot[32]+=$amount_paid;

		if($amount_paid!=$tot_fees){

			$print .= '<td>ERROR</td>';

		}

	}

	$final[] = $print.$print_extra;

	$final[] = $tot;

	$final[] = $print;

	return $final;

}



function fees_bifucation_sfc($row){

	$category=$row['category'];

	$tot[0]=0;

	for($td=1; $td<=60; $td++){

		$tot[]=0;

	}

	$print='';

	$tot_fees=0;

	

	$class = mysqli_fetch_array(execute_query(connect(), "select * from class_detail where sno=".$row['class']));

	$sql= "select * from head_type_self";

	$result_head = execute_query(connect(), $sql);

	$fees_amount = calc_fees($row['class'],$row['sub1'],$row['sub2'],$row['sub3'],$row['gender'],$row['category']);



	$i=1;

	$print .= '<td>'.$row['stu_name'].'</td>

	<td>'.$class['class_description'].'</td>

	<td>'.$row['roll_no'].'</td>

	<td>'.$category.'</td>

	<td>'.$row['gender'].'</td>

	<td>'.date("d-m-Y",$row['timestamp']).'</td>';

	$sql = 'select * from fee_invoice where class_id="'.$row['class'].'" and student_id="'.$row['student_serial'].'" and amount_paid is not NULL and type="fees"';

	//echo $sql.'<br>';

	$amount_paid = mysqli_fetch_array(execute_query(connect(), $sql));

	$final_fees = $amount_paid['tot_amount'];

	$amount_paid = $amount_paid['amount_paid'];	

	$amount_balance = $fees_amount - $amount_paid;

	//echo $row['category'].'--'.$row['annual_income'].'<br>';

	$total2=0;

	while($row_head = mysqli_fetch_array($result_head)){

		$sql = "select * from fees_detail where class_id=".$row['class']." and head_id=".$row_head['sno'];

		$fee = mysqli_fetch_assoc(execute_query(connect(), $sql));

		//$fee['fee_amount'] = $fees_breakup[$row_head['sno']];

		if($row_head['sno']==8 || $row_head['sno']==9){

			if($amount_balance>$fee['fee_amount']){

				$amount_balance-=$fee['fee_amount'];

				$fee['fee_amount'] = 0;

			}

			else{

				$fee['fee_amount']-=$amount_balance;

				$amount_balance = 0;

			}

		}

		$print .= '<td>'.$fee['fee_amount'].'</td>';

		$tot_fees += $fee['fee_amount'];			

		$tot[$row_head['sno']]=$fee['fee_amount'];

		$total2+=$fee['fee_amount'];

		if($row_head['sno']==3){

			$print .= '<td>'.$tot_fees.'</td>';

			$tot['sub_tot']=$tot_fees;

		}

	}

	$tot['tot']=$tot_fees;

	$tot['tot_deposited']=$amount_paid;

	$tot['tot_fees']=$fees_amount;

	$tot['tot_discount']=($fees_amount-$final_fees);

	$tot['error']='0';

	

	$print .= '<td>'.$tot_fees.'</td><td>'.$amount_paid.'</td><td>'.$final_fees.'</td><td>'.($fees_amount-$final_fees).'</td>';

	if($amount_paid!=$tot_fees){

		if($amount_paid>$tot_fees){

			$print .= '<td>'.($amount_paid-$tot_fees).'</td>';

		}

		else{

			$print .= '<td>0</td><td>ERROR</td>';

			$tot['error'] = $row['roll_no'];

		}

	}



	$final[] = $print;

	$final[] = $tot;

	$final[] = $print;

	return $final;

}



function fees_bifucation_sfc_new($row){

	$category=$row['category'];

	$tot[0]=0;

	for($td=1; $td<=60; $td++){

		$tot[]=0;

	}

	$print='';

	$tot_fees=0;

	

	$class = mysqli_fetch_array(execute_query(connect(), "select * from class_detail where sno=".$row['class']));

	$sql= "select * from head_type_self";

	$result_head = execute_query(connect(), $sql);

	$fees_amount = calc_fees($row['class'],$row['sub1'],$row['sub2'],$row['sub3'],$row['gender'],$row['category']);



	$i=1;

	$print .= '<td>'.$row['stu_name'].'</td>

	<td>'.$class['class_description'].'</td>

	<td>'.$row['roll_no'].'</td>

	<td>'.$category.'</td>

	<td>'.$row['gender'].'</td>

	<td>'.date("d-m-Y",$row['timestamp']).'</td>';

	$sql = 'select * from fee_invoice where class_id="'.$row['class'].'" and student_id="'.$row['student_serial'].'" and amount_paid is not NULL and type="fees"';

	//echo $sql.'<br>';

	$amount_paid = mysqli_fetch_array(execute_query(connect(), $sql));

	$final_fees = $amount_paid['tot_amount'];

	$amount_paid = $amount_paid['amount_paid'];	

	$amount_balance = $fees_amount - $amount_paid;

	//echo $row['category'].'--'.$row['annual_income'].'<br>';

	$total2=0;

	while($row_head = mysqli_fetch_array($result_head)){

		$sql = "select * from fees_detail where class_id=".$row['class']." and head_id=".$row_head['sno'];

		$fee = mysqli_fetch_assoc(execute_query(connect(), $sql));

		//$fee['fee_amount'] = $fees_breakup[$row_head['sno']];

		//if($row_head['sno']==8 || $row_head['sno']==9){

		//$sh = $fee['fee_amount'];

			if($amount_paid > $fee['fee_amount']){

				//echo 'prea'.$fee['fee_amount'].'-'.$amount_paid.'<br/>';

				$amount_paid-=$fee['fee_amount'];

				//$fee['fee_amount'] = 0;

			}

			else{

				//echo 'preb<br/>';

				$fee['fee_amount']=$amount_paid;

				$amount_paid = 0;

			}

		//$sh .= '-'.$fee['fee_amount'];

		//echo $sh.'<br/>';

		//}

		$print .= '<td>'.$fee['fee_amount'].'</td>';

		$tot_fees += $fee['fee_amount'];			

		$tot[$row_head['sno']]=$fee['fee_amount'];

		$total2+=$fee['fee_amount'];

		if($row_head['sno']==3){

			$print .= '<td>'.$tot_fees.'</td>';

			$tot['sub_tot']=$tot_fees;

		}

	}

	$tot['tot']=$tot_fees;

	$tot['tot_deposited']=$tot_fees;

	$tot['tot_fees']=$fees_amount;

	$tot['tot_discount']=($fees_amount-$final_fees);

	$tot['error']='0';

	

	$print .= '<td>'.$tot_fees.'</td><td>'.$fees_amount.'</td><td>'.($fees_amount-$final_fees).'</td>';

	/**if($amount_paid['amount_paid']!=$tot_fees){

		if($amount_paid['amount_paid']>$tot_fees){

			$print .= '<td>'.($amount_paid['amount_paid']-$tot_fees).'</td>';

		}

		else{

			$print .= '<td>0</td><td>ERROR</td>';

			$tot['error'] = $row['roll_no'];

		}

	}**/



	$final[] = $print;

	$final[] = $tot;

	$final[] = $print;

	return $final;

}



function fees_bifurcation_second_sfc($row){

	$category=$row['category'];

	$tot[0]=0;

	for($td=1; $td<=60; $td++){

		$tot[]=0;

	}

	$print='';

	$tot_fees=0;

	

	$class = mysqli_fetch_array(execute_query(connect(), "select * from class_detail where sno=".$row['class']));

	$sql= "select * from head_type_self";

	$result_head = execute_query(connect(), $sql);

	

	$i=1;

	$print .= '<td>'.$row['stu_name'].'</td>

	<td>'.$class['class_description'].'</td>

	<td>'.$row['roll_no'].'</td>

	<td>'.$category.'</td>

	<td>'.$row['gender'].'</td>

	<td>'.date("d-m-Y",$row['timestamp']).'</td>';

	

	if($row['annual_income']>=200000){

		$category='GEN';

	}

	

	if($category=='SC' || $category=='ST'){

		$fees_amount = calc_second_fees_sc($row['class'],$row['sub1'],$row['sub2'],$row['sub3'],$row['gender'],$row['category']);

	}

	else{

		$fees_amount = calc_second_fees_gen($row['class'],$row['sub1'],$row['sub2'],$row['sub3'],$row['gender'],$row['category']);

	}



	$sql = 'select * from fee_invoice3 where class_id="'.$row['class'].'" and student_id="'.$row['student_serial'].'" and amount_paid is not NULL and type="fees"';

	//echo $sql.'<br>';

	$amount_paid = mysqli_fetch_array(execute_query(connect(), $sql));

	$amount_paid = $amount_paid['amount_paid'];

	$amount_balance = $fees_amount - $amount_paid;

	//echo $row['category'].'--'.$row['annual_income'].'<br>';

	$total2=0;

	while($row_head = mysqli_fetch_array($result_head)){

		if($category=='SC' || $category=='ST'){

			$sql = "select * from fees_detail3 where class_id=".$row['class']." and head_id=".$row_head['sno'];	

		}

		else{

			$sql = "select * from fees_detail2 where class_id=".$row['class']." and head_id=".$row_head['sno'];	

		}

		

		//echo $sql;

		//die();

		$fee = mysqli_fetch_assoc(execute_query(connect(), $sql));

		//$fee['fee_amount'] = $fees_breakup[$row_head['sno']];

		if($row_head['sno']==8 || $row_head['sno']==9){

			if($amount_balance>$fee['fee_amount']){

				$amount_balance-=$fee['fee_amount'];

				$fee['fee_amount'] = 0;

			}

			else{

				$fee['fee_amount']-=$amount_balance;

				$amount_balance = 0;

			}

		}

		$print .= '<td>'.$fee['fee_amount'].'</td>';

		$tot_fees += $fee['fee_amount'];			

		$tot[$row_head['sno']]=$fee['fee_amount'];

		$total2+=$fee['fee_amount'];

		if($row_head['sno']==3){

			$print .= '<td>'.$tot_fees.'</td>';

			$tot['sub_tot']=$tot_fees;

		}

	}

	$tot['tot']=$tot_fees;

	$tot['tot_deposited']=$amount_paid;

	$tot['tot_fees']=$fees_amount;

	$tot['tot_discount']=($fees_amount-$amount_paid);

	

	$print .= '<td>'.$tot_fees.'</td><td>'.$amount_paid.'</td><td>'.$fees_amount.'</td><td>'.($fees_amount-$amount_paid).'</td>';

	if($amount_paid!=$tot_fees){

		if($amount_paid>$tot_fees){

			$print .= '<td>'.($amount_paid-$tot_fees).'</td>';

		}

		else{

			$print .= '<td>0</td><td>ERROR</td>';

		}

	}



	$final[] = $print;

	$final[] = $tot;

	$final[] = $print;

	return $final;

}



function fees_bifurcation_second_sfc_new($row){
	$category=$row['category'];
	$tot[0]=0;
	for($td=1; $td<=60; $td++){
		$tot[]=0;
	}
	$print='';
	$tot_fees=0;
	$class = mysqli_fetch_array(execute_query(connect(), "select * from class_detail where sno=".$row['class']));
	$sql= "select * from head_type_self";
	$result_head = execute_query(connect(), $sql);

	$i=1;
	
	$print .= '<td>'.$row['stu_name'].'</td>
	<td>'.$class['class_description'].'</td>
	<td>'.$row['roll_no'].'</td>
	<td>'.$category.'</td>
	<td>'.$row['gender'].'</td>
	<td>'.date("d-m-Y",$row['timestamp']).'</td>';

	if($row['annual_income']>=200000){
		$category='GEN';
	}

	if($category=='SC' || $category=='ST'){
		$fees_amount = calc_second_fees_sc($row['class'],$row['sub1'],$row['sub2'],$row['sub3'],$row['gender'],$row['category']);
	}
	else{
		$fees_amount = calc_second_fees_gen($row['class'],$row['sub1'],$row['sub2'],$row['sub3'],$row['gender'],$row['category']);
	}

	$sql_pre = 'select * from fee_invoice where class_id="'.$row['class'].'" and student_id="'.$row['student_serial'].'" and amount_paid is not NULL and type IN ("fees")';
	$amount_paid_pre = mysqli_fetch_array(execute_query(connect(), $sql_pre));

	$sql_pre3 = 'select SUM(`amount_paid`) as amount from fee_invoice3 where class_id="'.$row['class'].'" and student_id="'.$row['student_serial'].'" and amount_paid is not NULL and type IN ("due","fees") and `sno`<"'.$row['fees_serial'].'"';
	$amount_paid_pre3 = mysqli_fetch_array(execute_query(connect(), $sql_pre3));

	$amount_paid_pre = $amount_paid_pre['amount_paid']+$amount_paid_pre3['amount'];

	$sql = 'select * from fee_invoice3 where sno="'.$row['fees_serial'].'" and class_id="'.$row['class'].'" and student_id="'.$row['student_serial'].'" and amount_paid is not NULL and type IN ("fees","due")';
	//echo '#######'.$sql.'<br>';
	$amount_paid = mysqli_fetch_array(execute_query(connect(), $sql));
	$amount_paid = $amount_paid['amount_paid'];
	$amount_balance = $fees_amount - $amount_paid;
	$total2=0;
	while($row_head = mysqli_fetch_array($result_head)){
		$sql = "select * from fees_detail where class_id=".$row['class']." and head_id=".$row_head['sno'];
		if($row['class']=='65'){
			echo $sql.'<br>';
		}
		$fee = mysqli_fetch_assoc(execute_query(connect(), $sql));
		if ($amount_paid_pre > 0) {
			if ($amount_paid_pre > $fee['fee_amount']) {
				$amount_paid_pre -= $fee['fee_amount'];
				$fee['fee_amount'] = 0;
			}	
			else{
				$fee['fee_amount'] -= $amount_paid_pre;
				if ($amount_paid > $fee['fee_amount']) {
					$amount_paid -= $fee['fee_amount'];
				}
				else{
					$fee['fee_amount'] = $amount_paid;
					$amount_paid = 0;
				}
				$amount_paid_pre = 0;
			}		
		}
		else{			
			if ($amount_paid > $fee['fee_amount']) {
				$amount_paid -= $fee['fee_amount'];
			}
			elseif ($amount_paid > 0) {
				$fee['fee_amount'] = $amount_paid; 
				$amount_paid = 0;
			}	
			else{
				$fee['fee_amount'] = 0;
				$amount_paid = 0;
			}
		}
		$print .= '<td>'.$fee['fee_amount'].'</td>';
		$tot_fees += $fee['fee_amount'];			
		$tot[$row_head['sno']]=$fee['fee_amount'];
		$total2+=$fee['fee_amount'];
		if($row_head['sno']==3){
			$print .= '<td>'.$tot_fees.'</td>';
			$tot['sub_tot']=$tot_fees;
		}
	}
	$tot['tot_deposited']=$tot_fees;
	$print .= '<td>'.$tot_fees.'</td>';
	$final[] = $print;
	$final[] = $tot;
	$final[] = $print;
	return $final;
}



function vetan_sanday_second($sample, $class_data){
	$result = array();
	$i=0;
	foreach($class_data as $class=>$class_name){
		$male_count= $sample[$class]['M']['GEN']+$sample[$class]['M']['OBC'];
		$female_count=$sample[$class]['F']['GEN']+$sample[$class]['F']['OBC'];
		$sc_count=$sample[$class]['M']['SC']+$sample[$class]['F']['SC']+$sample[$class]['M']['ST']+$sample[$class]['F']['ST'];

		$total_count = $male_count+$female_count+$sc_count;

		$sql_tut = 'select * from fees_detail2 where head_id=1 and class_id='.$class;
		$tut_fees = mysqli_fetch_array(execute_query(connect(), $sql_tut));
		$tut_fee = $tut_fees['fee_amount'];
		$tot_tut_fee = $tut_fee*$male_count;

		$sql_tut_sc = 'select * from fees_detail3 where head_id=1 and class_id='.$class;
		$tut_fees_sc = mysqli_fetch_array(execute_query(connect(), $sql_tut_sc));
		$tut_fee_sc = $tut_fees_sc['fee_amount'];
		$tot_tut_fee_sc = $tut_fee_sc*$sample[$class]['M']['SC'];

		$sql_adm = 'select * from fees_detail2 where head_id=2 and class_id='.$class;
		$admin_fee = mysqli_fetch_array(execute_query(connect(), $sql_adm));
		$admin_fee = $admin_fee['fee_amount'];
		$tot_admin_fee = $admin_fee*$male_count+$admin_fee*$female_count;

		$sql_adm_sc = 'select * from fees_detail3 where head_id=2 and class_id='.$class;
		$admin_fee_sc = mysqli_fetch_array(execute_query(connect(), $sql_adm_sc));
		$admin_fee_sc = $admin_fee_sc['fee_amount'];
		$tot_admin_fee_sc = $admin_fee_sc * $sc_count;

		$sql_da = 'select * from fees_detail2 where head_id=3 and class_id='.$class;
		$da_fee = mysqli_fetch_array(execute_query(connect(), $sql_da));
		$da_fee = $da_fee['fee_amount'];
		$tot_da_fee = $da_fee*$male_count+$da_fee*$female_count;

		$sql_da_sc = 'select * from fees_detail3 where head_id=3 and class_id='.$class;
		$da_fee_sc = mysqli_fetch_array(execute_query(connect(), $sql_da_sc));
		$da_fee_sc = $da_fee_sc['fee_amount'];
		$tot_da_fee_sc = $da_fee_sc*$sc_count;

		$result[$i]['tot_male'] = $male_count;
		$result[$i]['tot_female'] = $female_count;
		$result[$i]['tot_count'] = $total_count;
		$result[$i]['tot_tut'] = $tot_tut_fee+$tot_tut_fee_sc;
		$result[$i]['tot_admin'] = $tot_admin_fee+$tot_admin_fee_sc;
		$result[$i]['tot_da']  = $tot_da_fee+$tot_da_fee_sc;
		$result[$i]['tot_sc'] = $sc_count;
		$result[$i]['class_name'] = $class_name;
		$result[$i]['male_count'] = $male_count;
		$result[$i]['female_count'] = $female_count;
		$result[$i]['sc_count'] = $sc_count;
		$i++;
	}
	return $result;
}

function get_self_fees($roll){

	$sql='select sno from student_info where sno="'.$roll.'"';

	$details=mysqli_fetch_array(execute_query(connect(), $sql));

	$sql='select tot_amount from fee_invoice where student_id='.$details['sno'].' and type="self"';

	$self=mysqli_fetch_array(execute_query(connect(), $sql));

	return $self;

	}

function get_vocational_fees($roll){

	$sql='select sno from student_info where sno="'.$roll.'"';

	$details=mysqli_fetch_array(execute_query(connect(), $sql));

	$sql='select tot_amount from fee_invoice where student_id='.$details['sno'].' and type="vocational"';

	$self=mysqli_fetch_array(execute_query(connect(), $sql));

	return $self;

}


function get_comp_fees($roll){

	$sql='select sno from student_info where sno="'.$roll.'"';

	$details=mysqli_fetch_array(execute_query(connect(), $sql));

	$sql='select tot_amount from fee_invoice where student_id='.$details['sno'].' and type="computer"';

	$comp=mysqli_fetch_array(execute_query(connect(), $sql));

	return $comp;

	}

function get_tour_fees($roll){

	$sql='select sno from student_info where sno="'.$roll.'"';

	$details=mysqli_fetch_array(execute_query(connect(), $sql));

	$sql='select tot_amount from fee_invoice where student_id='.$details['sno'].' and type="tour"';

	$tour=mysqli_fetch_array(execute_query(connect(), $sql));

	return $tour;

	}

function get_comp_fees_second($roll , $e_pin){

	$sql='select sno from student_info where sno="'.$roll.'"';

	$details=mysqli_fetch_array(execute_query(connect(), $sql));

	$sql='select tot_amount from fee_invoice3 where student_id='.$details['sno'].' and type="computer" and `e_pin`="'.$e_pin.'"';
	$res_comp = execute_query(connect(), $sql);
	if(mysqli_num_rows($res_comp)!=0){
		$comp=mysqli_fetch_array($res_comp);
		return $comp;
	}
	
	$sql='select tot_amount from fee_invoice where student_id='.$details['sno'].' and type="computer" and `e_pin`="'.$e_pin.'"';
	$res_comp = execute_query(connect(), $sql);
	if(mysqli_num_rows($res_comp)!=0){
		$comp=mysqli_fetch_array($res_comp);
		return $comp;
	}

	return $comp;

}

function get_tour_fees_second($roll , $e_pin){

	$sql='select sno from student_info where sno="'.$roll.'"';

	$details=mysqli_fetch_array(execute_query(connect(), $sql));

	$sql='select tot_amount from fee_invoice3 where student_id='.$details['sno'].' and type="tour" and `e_pin`="'.$e_pin.'"';

	$tour=mysqli_fetch_array(execute_query(connect(), $sql));

	return $tour;

}

function get_self_fees_second($roll , $e_pin){

	$sql='select sno from student_info where sno="'.$roll.'"';

	$details=mysqli_fetch_array(execute_query(connect(), $sql));

	$sql='select tot_amount from fee_invoice3 where student_id='.$details['sno'].' and type="self" and `e_pin`="'.$e_pin.'"';

	$tour=mysqli_fetch_array(execute_query(connect(), $sql));

	return $tour;

}

function get_breakage_fees($roll , $e_pin){


	$sql='select sno from student_info where sno="'.$roll.'"';

	$details=mysqli_fetch_array(execute_query(connect(), $sql));

	$sql='select tot_amount from fee_invoice3 where student_id='.$details['sno'].' and type="breakage" and `e_pin`="'.$e_pin.'"';

	$breakage=mysqli_fetch_array(execute_query(connect(), $sql));

	return $breakage;

}



/*function send_sms($number,$get_msg, $hindi=''){

	$get_msg = urlencode($get_msg);

	$ch = curl_init();

	$url = "http://sms.acemindtech1.com/API/WebSMS/Http/v1.0a/index.php?";

	$user="knipss";

	$pwd="knipss987";

	$no=$number;

	$senderID="KNIPSS";

	$route = 44;

	$param = "username=$user&password=$pwd&sender=$senderID&to=$no&message=$get_msg&reqid=1&format=json&route_id=$route$hindi";

	$url = $url.$param;

	curl_setopt($ch, CURLOPT_URL,  $url);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$buffer = curl_exec($ch);

	if(empty($buffer)){

	   return $buffer;

	}

	else{

	   return $buffer;

	}

}*/

function fileExists($fileName, $caseSensitive = false) {

    if(file_exists($fileName)) {
        return $fileName;
    }
    if($caseSensitive) return false;

    // Handle case insensitive requests            
    $directoryName = dirname($fileName);
    $fileArray = glob($directoryName . '/*', GLOB_NOSORT);
    $fileNameLowerCase = strtolower($fileName);
    foreach($fileArray as $file) {
        if(strtolower($file) == $fileNameLowerCase) {
            return $file;
        }
    }
    return false;
}

?>
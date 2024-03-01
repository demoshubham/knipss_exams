<?php 
session_cache_limiter('nocache');
session_start();
include("setting.php");
logvalidate($_SESSION['username'], $_SERVER['SCRIPT_FILENAME']);

page_header_store();page_left('fees');
left_table();
?>


<body id="public">
<div id="wrapper">
	<div id="content">
    <div id="container">
    	<form action="fees_payment.php" class="fees_payment" name="fees_payment" enctype="multipart/form-data" method="post" onSubmit="" >
<h2> Fees  Payment</h2>

<li id="supplier_id" class="notranslate"><label  class="desc"  for="name" class="desc" >Fees Payment<span class="name">*</label>
<?php  echo '
<select class="select" name="classsection" id="classsection" onchange="hide_show(\'classsection\',\'1\')">
<option value=""></option>';

     $sql = 'select * from section';
	 $res = mysql_query($sql,dbconnect());
	 while($row = mysql_fetch_array($res)) {
		 
		 $sql1 = 'select * from class where sno="'.$row['class_desc'].'"';
		 $result = mysql_fetch_array(mysql_query($sql1,dbconnect()));
		 
		 echo '<option value="'.$row['sno'].'" >'.$result['class_desc'].' '.$row['section'].'</option>';
	 }
	echo '</select>';
?>

<div id="hide1"> <img src="images/help.png" alt="help" /></div>
<div id="show1" style="display:none"> <img src="images/tick.png" alt="help" /></div>
</div>

<li id="supplier_id" class="notranslate"> <div><input type="submit" class="btTxt submit" name="submit" value="Submit" onClick="return confirmSubmit()"/></div>
</div>



<table id="treport" cellpadding="1" cellspacing="1" border="1" bordercolor="#000000">
  <tr>
   <th>S.No</th>
    <th>Name</th>
    <th>Fathers Name</th>
    <th>Mothers Name</th>
    <th>Address</th>
    <th>Mobile No.</th>
    <th>DOB</th>
    <th>Fathers Occupation</th>
    <th>Edit</th>
    </tr>
  
<?php 
 $sql = 'select * from student_info where class="'.$_POST['classsection'].'"';
 $result = mysql_query($sql,dbconnect());
 //echo $sql;
  while($row = mysql_fetch_array($result)) {
	  echo '
	        <tr><th>'.++$i.'</th>
			    <td>'.$row['sname'].'</td>
				<td>'.$row['fname'].'</td>
				<td>'.$row['mname'].'</td>
				<td>'.$row['address'].'</td>
				<td>'.$row['phone'].'</td>
				<td>'.$row['dob'].'</td>
				<td>'.$row['foccupation'].'</td>
				<td><a href="fees_payment.php?id='.$row['sno'].'">Edit</a></td></tr>';
  }
  
  ?>
</table>
</form></div</div>
<?php 
page_footer_store();?>
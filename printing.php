<?php 
date_default_timezone_set('Asia/Calcutta');
session_cache_limiter('nocache');
session_start();
include("settings.php");
include("get_computer.php");
logvalidate('','');
$sql = "select * from register_users where user_name='".$_SESSION['username']."'";
$student=mysqli_fetch_array(execute_query($sql,dbconnect()));
$_GET['id'] = $student['sno'];
if(isset($_GET['id'])){
	$sql= 'select * from student_info where sno="'.$_GET['id'].'"';
	$stu_details=mysqli_fetch_array(execute_query($sql,dbconnect()));
	
	$sql = "select * from register_users where sno=".$_GET['id'];
	$student=mysqli_fetch_array(execute_query($sql,dbconnect()));
}
	$sql_sec = 'select * from class_detail where sno="'.$stu_details['class'].'"';
	$res_sec = mysqli_fetch_array(execute_query($sql_sec,dbconnect()));

	$sql="select * from add_subject where sno=".$stu_details['sub1']."";
	$sub1 = mysqli_fetch_array(execute_query($sql,dbconnect()));

	$sql="select * from add_subject where sno=".$stu_details['sub2']."";
	$sub2 = mysqli_fetch_array(execute_query($sql,dbconnect()));

	$sql="select * from add_subject where sno=".$stu_details['sub3']."";
	$sub3 = mysqli_fetch_array(execute_query($sql,dbconnect()));
	$sql="select * from fee_invoice where student_id=".$stu_details['sno']."";
	echo $sql;
	$inv_id = mysqli_fetch_array(execute_query($sql,dbconnect()));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="pop.css" TYPE="text/css" REL="stylesheet" media="all">
<style type="text/css">
@media print {
input#btnPrint {
display: none;
	}	
}
table, tr, td {font-size:14px; border:none; font-weight:bold;}
h3{ font-size:16px;}
</style>
<script language="javascript" type="text/javascript">
//window.print();
</script>
</head>
<body>
	<div id="newdiv" style="page-break-after:avoid; margin-bottom:50px;">
     <h5 style="text-align:center; text-decoration:underline;">Challan (Office Copy)</h5>
        <table border="1">
        	<tr>
            	<td align="right" style="width:150px;"><img src="images/clogo.gif" style="height:45px;"></td>
              	<td align="left"><h3 style="text-align:center">Kamla Nehru Institute Of Physical & Social Sciences<br>						Sultanpur - 228118(U.P.)</h3></td>
					
		    </tr>
        </table>
        <div style="margin:15px 0px 0px 20px;">
			<table width="100%">
            <tr><td>Invoice No-<b><?php echo $inv_id['sno']; ?></b></td>
                <td>Receipt generated on-<b><?php echo date("d-m-Y",strtotime($inv_id['approval_date'])); ?></b></td>
            </tr>
    		<tr><td style="text-align:left; white-space: wrap;"><b>Registeration No.:</b>&nbsp;</td><td><?php echo $student['user_name']; ?></td ></tr> 
              <tr><td><b> Full Name</b></td><td><?php echo $stu_details['stu_name'];?></td></tr>
              <tr><td><b>Course</b></td><td><?php echo $res_sec['class_description'];?></td></tr>
              <tr><td><b>Category: </b></td><td><?php echo $stu_details['category'];?></td></tr>
             
              <tr><td><b>Subjects:</b></td>
              <td style="text-align:left; white-space: wrap;">
			  <?php echo $sub1['subject'];?>, <?php echo $sub2['subject'];?>, <?php echo $sub3['subject'];?></td></tr>
              <tr><td><B>Fees Amount :</B></td><td>Rs.<?php echo $inv_id['tot_amount']; ?></td></tr>
              <tr><td>&nbsp;</td></tr>
			</table>
		</div>
		<div style="float:right; padding-right:20px;margin-top:-15px;"><b>(Cashier's Signature)</b></div>
	</div>
    <div id="newdiv" style="page-break-after:avoid; margin-bottom:50px;">
      <h5 style="text-align:center; text-decoration:underline;">Challan (Office Copy)</h5>
        <table border="1">
        	<tr>
            	<td align="right" style="width:150px;"><img src="images/clogo.gif" style="height:45px;"></td>
              	<td align="left"><h3 style="text-align:center">Kamla Nehru Institute Of Physical & Social Sciences<br>						Sultanpur - 228118(U.P.)</h3></td>
					
		    </tr>
        </table>
        <div style="margin:15px 0px 0px 20px;">
			
				
			
			<table width="100%">
            <tr>
                	<td>Invoice No-<b><?php echo $inv_id['sno']; ?></b>
                    </td>
                	<td>Receipt generated on-<b><?php echo date("d-m-Y",strtotime($inv_id['approval_date'])); ?></b>
                    </td>
                    
                </tr>
    			<tr>
        			<td style="text-align:left; white-space: wrap;"><b>Registeration No.:</b>&nbsp;</td><td> <?php echo $student['user_name']; ?></td >
        		</tr> 
              <tr><td><b> Full Name</b></td><td><?php echo $stu_details['stu_name'];?></td></tr>
              
              <tr><td><b>Course</b></td><td><?php echo $res_sec['class_description'];?></td></tr>
              <tr><td><b>Category: </b></td><td><?php echo $stu_details['category'];?></td></tr>
              
              <tr><td><b>Subjects:</b></td>
              <td style="text-align:left; white-space: wrap;">
			  <?php echo $sub1['subject'];?>, <?php echo $sub2['subject'];?>, <?php echo $sub3['subject'];?></td></tr>
              <tr><td><B>Fees Amount :</B></td><td>Rs.<?php echo $inv_id['tot_amount']; ?></td></tr>
              <tr><td>&nbsp;</td></tr>
			</table>
		</div>
		<div style="float:right; padding-right:20px;margin-top:-15px;"><b>(Cashier's Signature)</b></div>
	</div>
    <div id="newdiv" style="page-break-after:avoid; margin-bottom:50px;">
      <h5 style="text-align:center; text-decoration:underline;">Challan (Student Copy)</h5>
        <table border="1">
        	<tr>
            	<td align="right" style="width:150px;"><img src="images/clogo.gif" style="height:45px;"></td>
              	<td align="left"><h3 style="text-align:center">Kamla Nehru Institute Of Physical & Social Sciences<br>						Sultanpur - 228118(U.P.)</h3></td>
			</tr>
        </table>
        <div style="margin:15px 0px 0px 20px;">
			<table width="100%">
            <tr>
                	<td>Invoice No-<b><?php echo $inv_id['sno']; ?></b>
                    </td>
                	<td>Receipt generated on- <b><?php echo date("d-m-Y",strtotime($inv_id['approval_date'])); ?></b>
                    </td>
                    
                </tr>
    			<tr>
        			<td style="text-align:left; white-space:nowrap;"><b>Registeration No.:</b>&nbsp; </td><td><?php echo $student['user_name']; ?></td >
        		</tr> 
              <tr><td><b> Full Name</b></td><td><?php echo $stu_details['stu_name'];?></td></tr>
             
              <tr><td><b>Course</b></td><td><?php echo $res_sec['class_description'];?></td></tr>
              <tr><td><b>Category: </b></td><td><?php echo $stu_details['category'];?></td></tr>
             
              <tr><td><b>Subjects:</b></td>
              <td style="text-align:left; white-space: wrap;">
			  <?php echo $sub1['subject'];?>, <?php echo $sub2['subject'];?>, <?php echo $sub3['subject'];?></td></tr>
              <tr><td><B>Fees Amount :</B></td><td>Rs.<?php echo $inv_id['tot_amount']; ?></td></tr>
              <tr><td>&nbsp;</td></tr>
			</table>
		</div>
		<div style="float:right; padding-right:20px;margin-top:-15px;"><b>(Cashier's Signature)</b></div>
	</div>


    <div><input type="button" id="btnPrint" onclick="window.print();" value="Print Page" /></div>
</body>
</html>
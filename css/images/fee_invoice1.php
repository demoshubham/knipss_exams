<?php 
session_cache_limiter('nocache');
session_start();
include("setting.php");
logvalidate($_SESSION['username'], $_SERVER['SCRIPT_FILENAME']);


 function fee_invoice_genrate($datestart) { 
	 
	  if($datestart == date("Y-m-d")) {echo $datestart.'h'; 
		  
		  $dateto = strtotime(date("Y-m-d", strtotime($datestart) . " +1 month"));
	      $dateto = date("Y-m-d",$dateto);		  
		  
		  $sql1 = 'select * from student_info';
		  $res1 = mysql_query($sql1,dbconnect());
		  while($row = mysql_fetch_array($res1)) {
			  
			$sql_fee = 'select * from fee_struct where class_id="'.$row['class'].'" and fees_type="1"';
		    $res2 = mysql_query($sql_fee,dbconnect());
			
			 if(mysql_fetch_array($res2)!=0) {			
			 
			      $fee = mysql_fetch_array(mysql_query($sql_fee,dbconnect()));
			      $amount = $fee['amount']/$fee['recur_duration'];
			
			      $sql2 = 'insert into fee_invoice(stud_id,fee_type,amount,amount_paid,recur_duration,fee_struct_id,discount,advance_payment,last_payment_date,date_to,class,status,create_by) 
 			               values("'.$row['sno'].'","1","'.$amount.'","'.$amount.'",1,"'.$fee['sno'].'","0","0","'.$datestart.'","'.$date_to.'","'.$row['class'].'","0","'.$_SESSION['username'].'")';
						   mysql_query($sql2,dbconnect());			               
			 }
			 else {
				 
				   $sql3 = 'select * from section where sno="'.$row['class'].'"';
				   $section = mysql_fetch_array(mysql_query($sql3,dbconnect()));
				   
				   $sql4 = 'select * from class where sno="'.$section['class_desc'].'"';
				   $class = mysql_fetch_array(mysql_query($sql4,dbconnect()));
				 
				   $msg .='<h5>'.$row['sname'].' fee not Generated because '.$class['class_desc'].' '.$section['section'].' Fees not Decided</h5> \n';
			 }
		  }	
		  $msg .='<h6>Please Select The Class Fees Reopen This Form.</h6>';	  
	  }
	  else {
		  $msg = '<h5>This Month Fees Generated.</h5>';
	  } 
	  return $msg; 
 }
page_header_store();page_left('fees');
?>

<?php 
 switch ($response) {
	 case $response==1: {
?>		 

<?php  
left_table();
?>
<body id="public">
<div id="wrapper">
	<div id="content">
    <div id="container">
    	<form action="fees_payment.php" class="fees_payment" name="fees_payment" enctype="multipart/form-data" method="post" onSubmit="" >
<h2> Fees  Payment</h2>

<?php 
    $sql = 'select * from fee_invoice order by sno desc limit 1';
	$res = mysql_fetch_array(mysql_query($sql,dbconnect())); 
		
    if($res['last_payment_date']!='') {
        $dateincre = strtotime(date("Y-m-d", strtotime($res['last_payment_date'])) . " +1 month");
	    $datestart = date("Y-m-d",$dateincre);
	 }
     
	 else {
		 
		 $sql_date = 'select * from feedate order by sno desc limit 1';
		 $res_date = mysql_fetch_array(mysql_query($sql_date,dbconnect()));		 
		 $datestart=$res_date['feedate']; 
	 }
   
      if($datestart == date("Y-m-d")) {
         $msg = fee_invoice_genrate($datestart); 		 
      } 
	  echo $msg;
	  $curdate = date("Y-m");	  
	  
	  $sql1 = 'select * from student_info';
	  $res1 = mysql_query($sql1,dbconnect()); 
	
	  $sql2 = 'select * from fee_invoice where last_payment_date like "'.$curdate.'%"'; 
	  $res2 = mysql_query($sql2,dbconnect());
	  
	  if(mysql_num_rows($res1)>mysql_num_rows($res2)) {
		  
		  $result2 = mysql_fetch_array($res2);
		  $datestart = $result2['last_payment_date'];
		  $msg = survivor_invoice($res1,$curdate,$datestart);		  
	  }
	  else {
		    $msg = '<h5>This Month Fees Generated.</h5>';
	  }
	  echo $msg;
?>
</div>
</form></div</div>	


<?php 
   break;
	 }
 }
  function survivor_invoice($res1,$curdate,$datestart) {
	  
	  while($row = mysql_fetch_array($res1)) {
		  
		  $sql2 = 'select * from fee_invoice where stud_id="'.$row['sno'].'" and last_payment_date like "'.$curdate.'%"'; 
	      $res2 = mysql_query($sql2,dbconnect());
	      
		   if(mysql_num_rows($res2)==0) {
			   
			   $sql_fee = 'select * from fee_struct where class_id="'.$row['class'].'" and fees_type="1"';
		       $res2 = mysql_query($sql_fee,dbconnect());
			
			    if(mysql_fetch_array($res2)!=0) {			
			 
			        $fee = mysql_fetch_array(mysql_query($sql_fee,dbconnect()));
			        $amount = $fee['amount']/$fee['recur_duration'];
			
			         $sql2 = 'insert into fee_invoice(stud_id,fee_type,amount,amount_paid,fee_struct_id,discount,advance_payment,last_payment_date,class,status) 
 			                  values("'.$row['sno'].'","1","'.$amount.'","'.$amount.'","'.$fee['sno'].'","0","0","'.$datestart.'","'.$row['class'].'","0")';
						      mysql_query($sql2,dbconnect()); echo $sql2.'<br />';
								               
			    }
			    else {
				 
				     $sql3 = 'select * from section where sno="'.$row['class'].'"';
				     $section = mysql_fetch_array(mysql_query($sql3,dbconnect()));
				   
				     $sql4 = 'select * from class where sno="'.$section['class_desc'].'"';
				     $class = mysql_fetch_array(mysql_query($sql4,dbconnect()));
				 
				     $msg .='<h5>'.++$i.'.  '.$row['sname'].' fee not Generated because '.$class['class_desc'].' '.$section['section'].' Fees not Decided.</h5> ';
			    }
		   }		  
	  }
	  $msg .='<h6>Please Select The Class Fees Reopen This Form.</h6>';	 
	  return $msg;
  } 
?>
<?php  
page_footer_store();?>
<?php
set_time_limit(0);
session_cache_limiter('nocache');
session_start();
include("settings.php");
logvalidate($_SESSION['username'], $_SERVER['SCRIPT_FILENAME']);
page_header();
$response=1;
$msg='';
if($_SESSION['username']!='sadmin'){
	$_POST['stu_id'] = $_SESSION['username'];
}
?>

<script type="text/javascript" language="javascript">
function admission_report() {
	window.open("admission_report_print.php");
}
</script>

<body id="public">
	<div id="container" class="ltr" style="width:100%; float:none;">   	
                <form action="view_report.php" class="wufoo leftLabel page1" name="feesdeposit" enctype="multipart/form-data" method="post" onSubmit="" >
                <h2> Student Report </h2>
                <table width="100%">
                	<tr>
                    	<td>Class</td>
                    	<td><select name="stud_class">
                    	<option value="ALL">ALL</option>
                        <?php
						$sql = 'select * from class_detail order by sort_no, year';
						$result = execute_query($sql,dbconnect());
						while($row = mysqli_fetch_array($result)){
							echo '<option value="'.$row['sno'].'" ';
							if(isset($_POST['stud_class'])){
								if($_POST['stud_class']==$row['sno']){
									echo ' selected';
								}
							}
							echo '>'.$row['class_description'].'</option>';
						}
						?>
                    	</select></td>
                     	<td>Select Subject </td>
       					<td><select name="subject" class="listmenu" id="subject" >
                    		<option value="" selected="selected"></option>
                    	<?php
                    	$sql = 'select * from add_subject';
                    	$res = execute_query($sql,dbconnect());
                    	while($row = mysqli_fetch_array($res)) {
                        	echo '<option value="'.$row['sno'].'">'.$row['subject'].'</option> ';
                    	}
                    ?>
             			</select></td>
                    </tr>
                    <tr>
                    	<td>From Date</td>
                    	<td><script type="text/javascript" language="javascript">
                        DateInput('from_date', false, 'YYYY-MM-DD', '<?php if(isset($_POST['from_date'])){echo $_POST['from_date'];}
                        else{echo date("Y-m-d"); $_POST['from_date']=date("Y-m-d");} ?>')
                    	</script>
                        </td>
                   		<td>To Date</td>
                    	<td><script type="text/javascript" language="javascript">
                        DateInput('to_date', false, 'YYYY-MM-DD', '<?php if(isset($_POST['to_date'])){echo $_POST['to_date'];}
                        else{echo date("Y-m-d"); $_POST['to_date']=date("Y-m-d");} ?>')
                    	</script></td>
                    </tr>
                    <tr>
                    	<td colspan="4"><input type="submit" class="btTxt submit" name="save" value="Submit" style=" margin-top:0px; margin-left:25px;"/></td>
                    </tr> 
                    </table>
				<?php
				if(isset($_POST['stud_class'])){
					$sql = "select * from student_info  where 1=1 ";
					if($_POST['stud_class']!='ALL'){
						$sql .= ' and class='.$_POST['stud_class'];
					}
					if($_POST['subject']!=''){
						$sql .= ' and (student_info.sub1="'.$_POST['subject'].'" or student_info.sub2="'.$_POST['subject'].'" or student_info.sub3="'.$_POST['subject'].'" )';
					}
					if($_POST['date_type']=='admit'){
						$sql .= ' and FROM_UNIXTIME(timestamp)>="'.$_POST['from_date'].' 00:00:00" and FROM_UNIXTIME(timestamp)<="'.$_POST['to_date'].' 23:59:59"';
					}
					else{
						$sql .= ' and date_of_admission>="'.$_POST['from_date'].'" and date_of_admission<="'.$_POST['to_date'].'"';
					}
					
					//echo $sql;
					$result = execute_query($sql,dbconnect());
                ?>
                	
                    <table width="100%">
                    <tr style="background:#333; color:#FFF; text-align:center; font-size:13px;">
                        <th>S.No.</th>
                        <th>Student Name</th>
                        <th>Father's Name</th>
                        <th>Mother's Name</th>
                        <th>Admission Date</th>
                        <th>Class</th>
                       	<th>Gender</th>
                       	<th>Category</th>
                        <th>Subject 1</th>
                        <th>Subject 2</th>
                        <th>Subject 3</th>
                        <th>Fees</th>
                    </tr>
					<?php
                    $i=1;
                    while($row = mysqli_fetch_array($result)){
						echo '<tr>
						<td>'.$i++.'</td>
						<td>'.$row['stu_name'].'</td>
						<td>'.$row['father_name'].'</td>
						<td>'.$row['mother_name'].'</td>
						<td>'.$row['date_of_admission'].'</td>
						<td>'.$row['class_description'].'</td>
						<td>'.$row['gender'].'</td>
						<td>'.$row['category'].'</td>
						<td>'.get_subject_detail($row['sub1'])['subject'].'</td>
						<td>'.get_subject_detail($row['sub2'])['subject'].'</td>
						<td>'.get_subject_detail($row['sub3'])['subject'].'</td>
						<td>'.$row['tot_amount'].'</td>
						<td>'.get_self_fees($roll)['tot_amount'].'</td>
						<td>'.get_comp_fees($roll)['tot_amount'].'</td>
						<td>'.get_tour_fees($roll)['tot_amount'].'</td>
						<td><a href="edit_admission.php?id='.$row['sno'].'" >Details</a></td>
						<td><a href="scholar_detail.php?id='.$row['sno'].'" >View</a></td></tr>';
						$tot_fees+=$row['tot_amount'];
						$tot_sf+=get_self_fees($roll)['tot_amount'];
						$tot_comp+=get_comp_fees($roll)['tot_amount'];
						$tot_tour+=get_tour_fees($roll)['tot_amount'];
						
						
					}
                    ?>
                    <tr><td colspan="13" style="text-align:right"><b>TOTAL</td>
                    <td><b><?php echo $tot_fees?></td>
                	<td><b><?php echo $tot_sf?></td>
                	<td><b><?php echo $tot_comp?></td>
                	<td><b><?php echo $tot_tour?></td>
                	</tr>
                    </table>
                    <?php } ?>
                    </ul>
                </form>
 		</div>
      </div>
		<?php
        page_footer();
        ?>
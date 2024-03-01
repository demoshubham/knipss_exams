<?php
include("d_scripts/settings.php");
$msg='';
$tab=1;
page_header_start();
page_header_end();
page_sidebar();
?>
<html>
	<head>
	</head>
	<body>
		<div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center"></h4></br>
						 <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" id="" name="">
					<?php echo $msg; ?> 
                    <h3>Date Filter</h3>
                    <div class="col-md-12">
                        <!-- first row -->
                        <div class="row">
                            <div class=" col-md-3 ">
								<label>From Date</label>
                                <input type="date" id="from_date" name="from_date" value="<?php echo (isset($_POST['from_date'])) ? $_POST['from_date'] : date('Y-m-d'); ?>" class="form-control"/>
							</div>
							<div class=" col-md-3 ">
								<label>To Date</label>
								<input type="date" name="to_date" id="to_date" value="<?php echo (isset($_POST['to_date'])) ? $_POST['to_date'] : date('Y-m-d'); ?>" class="form-control" />
							</div>
                        </div>
						<div>
							<button type="submit" name = "submit" value="save" class="btn btn-success mt-2 ms-4">Search</button> 
							<!--<input type="reset"  value="Reset" class="btn btn-danger mt-2 ms-5" /> -->
						</div>
					</div>
			   </form>
                    </div>
                    <div class="card-body">
					<table class="table table-striped table-hover" id="general_stat_table">
						<thead>
							<tr class="bg-primary text-white">
								<td>S.No.</td>
								<td>UIN</td>
								<td>Candidate Name</td>
								<td>Father Name</td>
								<td>Roll Number</td>
								<td>Date of Birth</td>
								<td>Gender</td>
								<td>Mobile No</td>
								<td>Course Type</td>
								<td>Course Applied</td>
								<td>Edit</td>
								<!---
								<td>Delete</td>
								--->
							</tr>
						</thead>
						<?php
							$query = 'select * from admission_student_info';
							$result = execute_query($query);
							$i=1;
							while($row = mysqli_fetch_assoc($result)){
								$sql1 = 'select * from mst_course_type where sno = "'.$row['course_type'].'"';
									$result1 = execute_query($sql1);
									if(mysqli_num_rows($result1)!=0){
										$row1 = mysqli_fetch_assoc($result1);
										$course_t = $row1['course_type'];
									}
									else{
										$course_t = '';
									}
									
									$sql12 = 'select * from mst_course where sno = "'.$row['course_applying_for'].'"';
									$result12 = execute_query($sql12);
									if(mysqli_num_rows($result12)!=0){
										$row12 = mysqli_fetch_assoc($result12);
										$course = $row12['course_name'];
									}
									else{
										$course = '';
									}
								echo '<tr align="center">
									<td>'.$i++.'</td>
									<td>'.$row['uin'].'</td>
									<td>'.$row['candidate_name'].'</td>
									<td>'.$row['father_name'].'</td>
									<td>'.$row['college_roll_no'].'</td>
									<td>'.$row['dob'].'</td>
									<td>'.$row['gender'].'</td>
									<td>'.$row['mobile'].'</td>
									<td>'.$course_t.'</td>
									<td>'.$course.'</td>
									<td><a href="../uin_report_edit.php?edit='.$row['sno'].'&&id='.$row['sno'].'" onClick="return confirm(\'Are you sure? \');" <h3 style="color: #3066ec;"> Edit</h3></a></td>
									<!---
									<td><a href="admission_form.php?del='.$row['sno'].'" onClick="return confirm(\'Are you sure? \');" <h3 style="color:red;"></h3>Delete</a></td>
									--->
										</tr>'	;
								}
							?>
					</table>
					</div>
                </div>
            </div>
		</div>
	</body>
</html>	
<?php
page_footer_start();
?>
    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="js/light-bootstrap-dashboard.js?v=1.4.0"></script>
<script>

$('select[multiple]').multiselect({
	search: true,
	selectAll: true
});
	
$(document).ready( function () {
    /*$('#general_stat_table').DataTable({
		paging: false,
		fixedHeader: true,
		colReorder: true
		});
	});	*/

	
	var t = $('#general_stat_table').DataTable({
		paging: false
    });
 
    
});
	
</script>

    
<?php		
page_footer_end();
?>
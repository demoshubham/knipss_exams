<?php 
include("d_scripts/settings.php");
page_header_start();
$response=1;
$msg='';
page_header_end();
page_sidebar();
if(!isset($_POST['from_date'])){
	$_POST['from_date'] = date("Y-m-d");
	$_POST['to_date'] = date("Y-m-d");
}
?>
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
                                <input type="date" id="from_date" name="from_date" value="<?php echo (isset($_POST['from_date'])) ? $_POST['from_date'] : ''; ?>" class="form-control"/>
							</div>
							<div class=" col-md-3 ">
								<label>To Date</label>
								<input type="date" name="to_date" id="to_date" value="<?php echo (isset($_POST['to_date'])) ? $_POST['to_date'] : date('Y-m-d'); ?>" class="form-control" />
							</div>
                        </div>
						<div>
							<button type="submit" name = "submit" value="save" class="btn btn-primary mt-2 ms-2">Submit </button> 
							<!--<input type="reset"  value="Reset" class="btn btn-danger mt-2 ms-5" /> -->
						</div>
					</div>
			   </form>
                    </div>
                    <div class="card-body">
					<table class="table table-striped table-hover table-bordered" id="general_stat_table">
						<tr class="bg-primary text-white " align="center">
							<td>S.No.</td>
							<td>Full Name</td>
							<td>User Name</td>
							<td>Date of Birth</td>
							<td>Transaction No</td>
							<td>Father Name</td>
							<td>Mobile No</td>
							<td>Date of Registration</td>
							<td>Order ID</td>
							<td>Payment Status</td>
							<td>UIN</td>
							<!----
							<td>Edit</td>
							<td>Delete</td>
							-->
						</tr>
						<?php
						$sql1 = 'SELECT * FROM register_users WHERE datestamp  >= "'.$_POST['from_date'].'" AND datestamp  <= "'.$_POST['to_date'].'"';
						$result = execute_query($sql1);
						$i=1;
						while($row = mysqli_fetch_assoc($result)){
							$sql = 'select * from new_student_info where reg_user_sno="'.$row['sno'].'"';
							$student_info = mysqli_fetch_assoc(execute_query($sql));
							
							$sql = 'select * from online_payment where student_id="'.$student_info['sno'].'"';
							$result_trans = execute_query($sql);
							$rows = mysqli_num_rows($result_trans);
							if($rows==0){
								$rows=1;
							}
							$r1 = '';
							$r2 = '';
							
							echo '<tr align="center" class="firstrow">
							<td rowspan="'.$rows.'" style="border-top:1px solid #f90;">'.$i++.'</td>
							<td rowspan="'.$rows.'" style="border-top:1px solid #f90;">'.$row['full_name'].'</td>
							<td rowspan="'.$rows.'" style="border-top:1px solid #f90;">'.$row['user_name'].'</td>
							<td rowspan="'.$rows.'" style="border-top:1px solid #f90;">'.date("d-m-Y", strtotime($row['date_of_birth'])).'</td>
							<td rowspan="'.$rows.'" style="border-top:1px solid #f90;">'.$row['transaction_no'].'</td>
							<td rowspan="'.$rows.'" style="border-top:1px solid #f90;">'.$row['father_name'].'</td>
							<td rowspan="'.$rows.'" style="border-top:1px solid #f90;">'.$row['mobile'].'</td>
							<td rowspan="'.$rows.'" style="border-top:1px solid #f90;">'.date("d-m-Y", strtotime($row['datestamp'])).'</td>';
							while($row_trans = mysqli_fetch_assoc($result_trans)){
								if($row_trans['order_status']=='Success'){
									$col = 'background:#00ff00;';
								}
								elseif($row_trans['order_status']=='Aborted'){
									$col = 'background:#f90;';
								}
								elseif($row_trans['order_status']=='Failure'){
									$col = 'background:#f00;';
								}
								else{
									$col = '';
								}
								if($r1==''){
									$r1 .= '<td style="border-top:1px solid #f90;">'.$row_trans['order_id'].'</td>';	
									$r1 .= '<td style="'.$col.' border-top:1px solid #f90;">'.($row_trans['order_status']==''?'Initiated':$row_trans['order_status']).'</td>';		
								}
								else{
									$r2 .= '<tr><td>'.$row_trans['order_id'].'</td>';	
									$r2 .= '<td style="'.$col.' border-top:1px solid #f90;">'.($row_trans['order_status']==''?'Initiated':$row_trans['order_status']).'</td></tr>';		
									
								}
								
							}
							echo $r1;
							
							echo '
							<td rowspan="'.$rows.'" style="border-top:1px solid #f90;">'.$row['uin_no'].'</td>
							<!---
							<td><a href="register_users_report.php?edit='.$row['sno'].'" onClick="return confirm(\'Are you sure? \');" <h3 style="color: #3066ec;"> 	Edit</h3></a></td>
							<td><a href="register_users_report.php?del='.$row['sno'].'" onClick="return confirm(\'Are you sure? \');" <h3 style="color:red;"></h3>Delete</a></td>
							--->
							</tr>'	;
							echo $r2;
						}
						?>
					</table>
					</div>
                </div>
            </div>
		</div>
	</body>
</html>	
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
page_footer_start(); 
page_footer_end(); 

?>
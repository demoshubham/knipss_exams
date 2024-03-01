<?php 
include("d_scripts/settings.php");
require 'vendor/autoload.php';

class MyReadFilter implements \PhpOffice\PhpSpreadsheet\Reader\IReadFilter {

    public function readCell($columnAddress, $row, $worksheetName = '') {
        // Read title row and rows 20 - 30
        if ($row == 1 || ($row >= 20 && $row <= 30)) {
            return true;
        }
        return false;
    }
}


if(isset($_POST['submit'])){
	if($_FILES['import_file']['name']!=''){
		//print_r($_FILES);
		$inputFileName = $_FILES['import_file']['tmp_name'];

		/**  Identify the type of $inputFileName  **/
		$inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);

		/**  Create a new Reader of the type that has been identified  **/
		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);

		/**  Load $inputFileName to a Spreadsheet Object  **/
		$spreadsheet = $reader->load($inputFileName);

		/**  Convert Spreadsheet Object to an Array for ease of use  **/
		$orders = $spreadsheet->getActiveSheet()->toArray();
		
		//print_r($orders);
		$txt = '';
		$txt .= '<table border="1">';
		$details = array();
		$i=1;
		foreach($orders as $k=>$v){
			$txt .= '<tr><td>'.$k.'</td>';
			$details[$v[2]] = $v;
			$txt .= '<td>'.$v[2].'</td>';
			$i++;
			foreach($v as $key=>$val){
				if($val==''){
					$val = 'No Data';
				}
				//$txt .= '<td>'.$val.'</td>';
			}
			$txt .= '</tr>';
		}
		$txt .= '</table>';
	}
}

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
							<div class=" col-md-3 ">
								<label>Order ID</label>
								<input type="text" name="order_id" id="order_id" class="form-control" />
							</div>
                       		<div class="col-3">
                       			<label>Import Excel</label>
                       			<input type="file" name="import_file" id="import_file" class="form-control">
                       		</div>
							<div class="col-3">
								<button type="submit" name = "submit" value="save" class="btn btn-primary mt-2 ms-2">Submit </button> 
								<!--<input type="reset"  value="Reset" class="btn btn-danger mt-2 ms-5" /> -->
							</div>
						</div>
						
					</div>
			   </form>
                    </div>
                    <div class="card-body">
					<table class="table table-striped table-hover table-bordered" id="general_stat_table">
						<tr class="bg-primary text-white " align="center">
							<td>S.No.</td>
							<td>Full Name</td>
							<td>Father Name</td>
							<td>Date of Birth</td>
							<td>Transaction No</td>
							<td>Mobile No</td>
							<td>Date of Registration</td>
							<td>UIN</td>
							<td>Order ID</td>
							<td>Payment Status</td>
							<td>CCAvenue Status</td>
							<!----
							<td>Edit</td>
							<td>Delete</td>
							-->
						</tr>
						<?php
						if($_POST['order_id']!=''){
						    $i=1;
						    $sql = 'select * from online_payment_exams where order_id="'.$_POST['order_id'].'"';
							$result_trans = execute_query($sql);
							$rows = mysqli_num_rows($result_trans);
							if($rows==0){
								$rows=1;
							}
							$r1 = '';
							$r2 = '';
							while($row_trans = mysqli_fetch_assoc($result_trans)){
							    $sql1 = 'SELECT * FROM student_info WHERE sno='.$row_trans['student_id'];
    						    $result = execute_query($sql1);
    						    $row = mysqli_fetch_assoc($result);
							    echo '<tr align="center" class="firstrow">
    							<td rowspan="'.$rows.'" style="border-top:1px solid #f90;">'.$i++.'</td>
    							<td rowspan="'.$rows.'" style="border-top:1px solid #f90;">'.$row['full_name'].'</td>
    							<td rowspan="'.$rows.'" style="border-top:1px solid #f90;">'.$row['user_name'].'</td>
    							<td rowspan="'.$rows.'" style="border-top:1px solid #f90;">'.$row['date_of_birth'].'</td>
    							<td rowspan="'.$rows.'" style="border-top:1px solid #f90;">'.$row['transaction_no'].'</td>
    							<td rowspan="'.$rows.'" style="border-top:1px solid #f90;">'.$row['mobile'].'</td>
    							<td rowspan="'.$rows.'" style="border-top:1px solid #f90;">'.date("d-m-Y", strtotime($row['datestamp'])).'</td>
    							<td rowspan="'.$rows.'" style="border-top:1px solid #f90;">'.$row['uin_no'].'</td>';
							    $chk = '';
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
								if($details[$row_trans['order_id']][36]=='Shipped'){
									$col2 = 'background:#00ff00;'; 
									if($row_trans['order_status']!='Success'){
									    $sql = 'update online_payment_exams set order_status="Success" where sno="'.$row_trans['sno'].'"';
									    execute_query($sql);
									    $sql = 'update online_payment_exams set 
                                        tracking_id = "'.$details[$row_trans['order_id']][0].'", 
                                        bank_ref_no = "'.$details[$row_trans['order_id']][48].'", 
                                        order_status = "Success", 
                                        failure_message = "", 
                                        payment_mode = "'.$details[$row_trans['order_id']][6].'", 
                                        card_name = "'.$details[$row_trans['order_id']][8].'", 
                                        status_code = "", 
                                        status_message = "'.$details[$row_trans['order_id']][35].'", 
                                        delivery_name = "'.$details[$row_trans['order_id']][17].'", 
                                        delivery_address = "'.$details[$row_trans['order_id']][18].'", 
                                        delivery_city = "'.$details[$row_trans['order_id']][19].'", 
                                        delivery_state = "'.$details[$row_trans['order_id']][20].'", 
                                        delivery_zip = "'.$details[$row_trans['order_id']][21].'", 
                                        delivery_country = "'.$details[$row_trans['order_id']][22].'", 
                                        delivery_tel = "'.$details[$row_trans['order_id']][23].'", 
                                        trans_date = "'.$details[$row_trans['order_id']][3].'", 
                                        trans_fee = "'.$details[$row_trans['order_id']][14].'", 
                                        service_tax = "'.$details[$row_trans['order_id']][15].'", 
                                        edition_time = "'.date("Y-m-d H:i:s").'"
                                        where sno="'.$row_trans['sno'].'"';
									    execute_query($sql);
										$chk = 'Executed : <input type="checkbox" name="chk_'.$row_trans['sno'].'" value="'.$row_trans['sno'].'" style="border:2px solid #00f;">';
									}
									/*$chk .= $sql = 'update online_payment_exams set 
                                        tracking_id = "'.$details[$row_trans['order_id']][0].'", 
                                        bank_ref_no = "'.$details[$row_trans['order_id']][48].'", 
                                        order_status = "Success", 
                                        failure_message = "", 
                                        payment_mode = "'.$details[$row_trans['order_id']][6].'", 
                                        card_name = "'.$details[$row_trans['order_id']][8].'", 
                                        status_code = "", 
                                        status_message = "'.$details[$row_trans['order_id']][35].'", 
                                        delivery_name = "'.$details[$row_trans['order_id']][17].'", 
                                        delivery_address = "'.$details[$row_trans['order_id']][18].'", 
                                        delivery_city = "'.$details[$row_trans['order_id']][19].'", 
                                        delivery_state = "'.$details[$row_trans['order_id']][20].'", 
                                        delivery_zip = "'.$details[$row_trans['order_id']][21].'", 
                                        delivery_country = "'.$details[$row_trans['order_id']][22].'", 
                                        delivery_tel = "'.$details[$row_trans['order_id']][23].'", 
                                        trans_date = "'.$details[$row_trans['order_id']][3].'", 
                                        trans_fee = "'.$details[$row_trans['order_id']][14].'", 
                                        service_tax = "'.$details[$row_trans['order_id']][15].'", 
                                        edition_time = "'.date("Y-m-d H:i:s").'"
                                        where sno="'.$row_trans['sno'].'"';
                                        execute_query($sql);
                                        $sql = 'update online_payment_exams set order_status="Success" where sno="'.$row_trans['sno'].'"';
									    execute_query($sql);*/
								}
								elseif($details[$row_trans['order_id']][36]=='Awaited'){
									$col2 = 'background:#f90;';
								}
								else{
									$col2 = '';
								}
								if($r1==''){
									$r1 .= '<td style="border-top:1px solid #f90;">'.$row_trans['order_id'].'</td>';	
									$r1 .= '<td style="'.$col.' border-top:1px solid #f90;">'.($row_trans['order_status']==''?'Initiated':$row_trans['order_status']).'</td>';
									$r1 .= '<td style="'.$col2.' border-top:1px solid #f90;">'.$details[$row_trans['order_id']][36].'</td>';	
								}
								else{
									$r2 .= '<tr><td>'.$row_trans['order_id'].'</td>';	
									$r2 .= '<td style="'.$col.' border-top:1px solid #f90;">'.($row_trans['order_status']==''?'Initiated':$row_trans['order_status']).'</td>';		
									$r2 .= '<td style="'.$col2.' border-top:1px solid #f90;">'.$details[$row_trans['order_id']][36].'</td></tr>';	
									
								}
    							echo $r1;
    							
    							echo '
    							<td>'.$chk.'</td>
    							<!---
    							<td><a href="register_users_report.php?edit='.$row['sno'].'" onClick="return confirm(\'Are you sure? \');" <h3 style="color: #3066ec;"> 	Edit</h3></a></td>
    							<td><a href="register_users_report.php?del='.$row['sno'].'" onClick="return confirm(\'Are you sure? \');" <h3 style="color:red;"></h3>Delete</a></td>
    							--->
    							</tr>'	;
    							echo $r2;
							}
						}
						else{
						    
    						
    						$sql1 = 'SELECT * FROM exam_student_info WHERE creation_time  >= "'.$_POST['from_date'].'" AND creation_time  <= "'.$_POST['to_date'].'"';
    						//echo $sql1;
    						$result = mysqli_query($erp_link, $sql1);
    						$i=1;
    						while($row = mysqli_fetch_assoc($result)){
    							$sql = 'select * from student_info where sno="'.$row['student_info_sno'].'"';
    							$student_info = mysqli_fetch_assoc(mysqli_query($erp_link, $sql));
    							
    							$sql = 'select * from online_payment_exams where student_id="'.$student_info['sno'].'"';
    							$result_trans = execute_query($sql);
    							$rows = mysqli_num_rows($result_trans);
    							if($rows==0){
    								$rows=1;
    							}
    							$r1 = '';
    							$r2 = '';
    							
    							echo '<tr align="center" class="firstrow">
    							<td rowspan="'.$rows.'" style="border-top:1px solid #f90;">'.$i++.'</td>
    							<td rowspan="'.$rows.'" style="border-top:1px solid #f90;">'.$student_info['stu_name'].'</td>
    							<td rowspan="'.$rows.'" style="border-top:1px solid #f90;">'.$student_info['father_name'].'</td>
    							<td rowspan="'.$rows.'" style="border-top:1px solid #f90;">'.$student_info['dob'].'</td>
    							<td rowspan="'.$rows.'" style="border-top:1px solid #f90;">'.$row['transaction_id'].'</td>
    							<td rowspan="'.$rows.'" style="border-top:1px solid #f90;">'.$student_info['mobile'].'</td>
    							<td rowspan="'.$rows.'" style="border-top:1px solid #f90;">'.date("d-m-Y", strtotime($row['creation_time'])).'</td>
    							<td rowspan="'.$rows.'" style="border-top:1px solid #f90;">'.$row['uin_no'].'</td>';
    							while($row_trans = mysqli_fetch_assoc($result_trans)){
    								$chk = '';
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
    								if($details[$row_trans['order_id']][36]=='Shipped'){
    									$col2 = 'background:#00ff00;'; 
    									if($row_trans['order_status']!='Success'){
    									    $sql = 'update online_payment_exams set order_status="Success" where sno="'.$row_trans['sno'].'"';
    									    execute_query($sql);
    									    
    									    $sql = 'update online_payment_exams set 
                                            tracking_id = "'.$details[$row_trans['order_id']][0].'", 
                                            bank_ref_no = "'.$details[$row_trans['order_id']][48].'", 
                                            order_status = "Success", 
                                            failure_message = "", 
                                            payment_mode = "'.$details[$row_trans['order_id']][6].'", 
                                            card_name = "'.$details[$row_trans['order_id']][8].'", 
                                            status_code = "", 
                                            status_message = "'.$details[$row_trans['order_id']][35].'", 
                                            delivery_name = "'.$details[$row_trans['order_id']][17].'", 
                                            delivery_address = "'.$details[$row_trans['order_id']][18].'", 
                                            delivery_city = "'.$details[$row_trans['order_id']][19].'", 
                                            delivery_state = "'.$details[$row_trans['order_id']][20].'", 
                                            delivery_zip = "'.$details[$row_trans['order_id']][21].'", 
                                            delivery_country = "'.$details[$row_trans['order_id']][22].'", 
                                            delivery_tel = "'.$details[$row_trans['order_id']][23].'", 
                                            trans_date = "'.$details[$row_trans['order_id']][3].'", 
                                            trans_fee = "'.$details[$row_trans['order_id']][14].'", 
                                            service_tax = "'.$details[$row_trans['order_id']][15].'", 
                                            edition_time = "'.date("Y-m-d H:i:s").'"
                                            where sno="'.$row_trans['sno'].'"';
                                            //echo $sql;
                                            execute_query($sql);
                                            if(mysqli_error($db)){
                                                die("Error : ".mysqli_error($db)." >> ".$sql);
                                            }
                                            
                                            $sql = 'update exam_student_info set 
                                            transaction_id="'.$details[$row_trans['order_id']][0].'",
                                            order_status="Success"
                                            where sno='.$row['sno'];
                                            //echo $sql;
                                            mysqli_query($erp_link, $sql);
                                            if(mysqli_error($db)){
                                                die("Error : ".mysqli_error($db)." >> ".$sql);
                                            }
                                            
    									    
    										$chk = '<input type="checkbox" name="chk_'.$row_trans['sno'].'" value="'.$row_trans['sno'].'" style="border:2px solid #00f;">';
    									}
    									
    								}
    								elseif($details[$row_trans['order_id']][36]=='Awaited'){
    									$col2 = 'background:#f90;';
    								}
    								else{
    									$col2 = '';
    								}
    								if($r1==''){
    									$r1 .= '<td style="border-top:1px solid #f90;">'.$row_trans['order_id'].'</td>';	
    									$r1 .= '<td style="'.$col.' border-top:1px solid #f90;">'.($row_trans['order_status']==''?'Initiated':$row_trans['order_status']).'</td>';
    									$r1 .= '<td style="'.$col2.' border-top:1px solid #f90;">'.$details[$row_trans['order_id']][36].'</td>';	
    								}
    								else{
    									$r2 .= '<tr><td>'.$row_trans['order_id'].'</td>';	
    									$r2 .= '<td style="'.$col.' border-top:1px solid #f90;">'.($row_trans['order_status']==''?'Initiated':$row_trans['order_status']).'</td>';		
    									$r2 .= '<td style="'.$col2.' border-top:1px solid #f90;">'.$details[$row_trans['order_id']][36].'</td></tr>';	
    									
    								}
    							}
    							echo $r1;
    							
    							echo '
    							<td>'.$chk.'</td>
    							<!---
    							<td><a href="register_users_report.php?edit='.$row['sno'].'" onClick="return confirm(\'Are you sure? \');" <h3 style="color: #3066ec;"> 	Edit</h3></a></td>
    							<td><a href="register_users_report.php?del='.$row['sno'].'" onClick="return confirm(\'Are you sure? \');" <h3 style="color:red;"></h3>Delete</a></td>
    							--->
    							</tr>'	;
    							echo $r2;
    						}
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
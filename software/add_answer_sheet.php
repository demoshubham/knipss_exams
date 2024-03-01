<?php 
include("d_scripts/settings.php");

$response=1;
$msg='';
page_header_start();
page_header_end();
page_sidebar();

?>
	<div id="container">	
		<div class="card card-body">
			<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
				<div class="row" style="background-color:#fff;">
					<div class="col-md-4">
						<div class="form-group">
							<label for="">Answer Sheet Status</label>
							<select name="status" id="status" class="form-control">
								<option value="" <?= ($_POST['status'] ?? '') === '' ? 'selected' : '' ?>>--Selected--</option>
								<option value="0" <?= ($_POST['status'] ?? '') === '0' ? 'selected' : '' ?>>No Uploaded</option>
								<option value="1" <?= ($_POST['status'] ?? '') === '1' ? 'selected' : '' ?>>Uploaded</option>
							</select>

						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group mt-3">
							<input type="submit" value="Search" name="search" class="btn btn-primary">
						</div>
					</div>
					
				</div>
			</form>
		</div>
		<div class="card card-body">
			<?php
			if(isset($_SESSION['answersheetcheck'])){
				echo $_SESSION['answersheetcheck'];
				unset($_SESSION['answersheetcheck']);
			}
			?>
			<table  class="table table-striped table-hover table-sm rounded ">
				
				<tr class="bg-primary text-white" >
					<th>S.No.</th>
					<th>Application No.</th>
					<th>Exam Roll No.</th>
					<th>Course</th>
					<th>Paper Code</th>
					<th>Mobile No.</th>
					<th>Bank Transfer No. </th>
					<th>Date of Form Submission</th>
					<th>View </th>
					<th>Upload Answer Sheet</th>
					<th>Status</th>
				</tr>
				<?php
					$serial_no = 1;
					// SELECT `sno`, `exam_roll_no`, `course`, `papercode`, `mobile_no`, `bank_trans_no`, `file_path`, `file_upload_status`, `created_by`, `creation_time`, `edited_by`, `edition_time`, `admin_remark` FROM `exam_copy_view` WHERE 1
					$sql = 'select * from exam_copy_view WHERE 1=1 and payment_status="Success"  ';

					if(isset($_POST['status']) and $_POST['status']!=""){
						$sql.= 'and file_upload_status="'.$_POST['status'].'"';
					}
					// echo $sql;
					// $sql = 'select * from exam_copy_view WHERE file_upload_status="0"';
					$res = execute_query( $sql);
					if($res){
						if(mysqli_num_rows($res)>0){
							while($row = mysqli_fetch_assoc($res)){

								//course name
								$sql_class = 'select * from class_detail where sno = "'.$row['course'].'"';
								$row_class = mysqli_fetch_assoc(mysqli_query($erp_link,$sql_class)); 
	
					?>
					<tr>
						<td><?php echo $serial_no++; ?></td>
						<td><?php echo $row['sno'] ?></td>
						<td><?php echo $row['exam_roll_no'] ?></td>
						<td><?php echo $row_class['class_description'] ?></td>
						<td><?php echo $row['papercode'] ?></td>
						<td><?php echo $row['mobile_no'] ?></td>
						<td><?php echo $row['bank_trans_no'] ?></td>
						<td><?php echo date("d-m-Y",strtotime($row['creation_time'])) ?></td>
						
						<td>
							<form action="answer_sheet_view_report.php" method="POST">
								<input type="hidden" name="mobno" value="<?php echo $row['mobile_no']?>">
								<input type="hidden" name="rollno" value="<?php echo $row['exam_roll_no']?>">
								<input type="hidden" name="course" value="<?php echo $row['course']?>">
								<input type="hidden" name="bankrefno" value="<?php echo $row['bank_trans_no']?>">
								<input type="hidden" name="papercode" value="<?php echo $row['papercode']?>">
								<input type="hidden" name="sno" value="<?php echo $row['sno']?>">
								<input type="submit" value="View" class="btn btn-success btn-sm " style="width:120px;margin:auto;">
							</form>
						</td>
						<td>
						<?php 
								if($row['file_upload_status']=="1"){
									?>
										<form action="edit_add_answer_sheet.php" method="POST">
											<input type="hidden" name="mobno" value="<?php echo $row['mobile_no']?>">
											<input type="hidden" name="rollno" value="<?php echo $row['exam_roll_no']?>">
											<input type="hidden" name="course" value="<?php echo $row_class['class_description'];?>">
											<input type="hidden" name="papercode" value="<?php echo $row['papercode']?>">
											<input type="hidden" name="bankrefno" value="<?php echo $row['bank_trans_no']?>">
											<input type="hidden" name="date" value="<?php echo date("d-m-Y",strtotime($row['creation_time']));?>">
											<input type="hidden" name="sno" value="<?php echo $row['sno']?>">
											<input type="submit" name="upload" value="Edit Answer Sheet" class="btn btn-danger btn-sm" style="width:120px;margin:auto;">
										</form>
									<?php
								}else{
									?>
										<form action="edit_add_answer_sheet.php" method="POST">
											<input type="hidden" name="mobno" value="<?php echo $row['mobile_no']?>">
											<input type="hidden" name="rollno" value="<?php echo $row['exam_roll_no']?>">
											<input type="hidden" name="course" value="<?php echo $row_class['class_description'];?>">
											<input type="hidden" name="papercode" value="<?php echo $row['papercode']?>">
											<input type="hidden" name="bankrefno" value="<?php echo $row['bank_trans_no']?>">
											<input type="hidden" name="date" value="<?php echo date("d-m-Y",strtotime($row['creation_time']));?>">
											<input type="hidden" name="sno" value="<?php echo $row['sno']?>">
											<input type="submit" name="upload" value="Upload Answer Sheet" class="btn btn-warning btn-sm" style="width:150px;margin:auto;">
										</form>
									<?php
								}
							?>
							
						</td>
						<td>
							<?php
							if($row['file_upload_status']=="1"){
								?>
									<a href="<?php echo $row['file_path']?>">Answer Sheet</a>
								<?php
							}else{
								?>
									Not Uploaded Yet!
								<?php
							}
							?>
						</td>
	
						
				
					</tr>
					
					<?php 
						}
						}else{
							echo "<tr><td colspan='10' style='font-size:1.3rem;color:red;text-align:center;'>No data found!</td></tr>";
						}
				}
				
				?>
			</table>	
		</div>
	</div>	
	
	
	
	
<?php 
page_footer_start(); 
page_footer_end(); 

?>
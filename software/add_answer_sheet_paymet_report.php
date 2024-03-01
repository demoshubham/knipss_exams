<?php 
include("d_scripts/settings.php");
page_header_start();
$response=1;
$msg='';
page_header_end();
page_sidebar();
// if(!isset($_POST['from_date'])){
// 	$_POST['from_date'] = date("Y-m-d");
// 	$_POST['to_date'] = date("Y-m-d");
// }
?>
           <div class="row">
                <div class="card">
                    <div class="text-center lead p-3">Payment Status For Answer Sheet View</div>
					<table class="table table-striped table-hover table-bordered" id="general_stat_table">
						<tr class="bg-primary text-white " align="center">
							<td>S.No.</td>
							<td>Full Name</td>
							<td>Father Name</td>
							<td>Date of Birth</td>
							<td>Mobile No</td>
							<td>Exam Roll No.</td>
							<td>Subject</td>
                            <th>Paper Code</th>
                            <th>Paper Name</th>
							<td>Transaction No</td>
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
					     $sql1 = 'select * from exam_copy_view WHERE 1=1  ';

						// $sql1 = 'SELECT * FROM register_users WHERE datestamp  >= "'.$_POST['from_date'].'" AND datestamp  <= "'.$_POST['to_date'].'"';
						$result = execute_query($sql1);
						$i=1;
						while($row = mysqli_fetch_assoc($result)){
                           $sql = 'SELECT `exam_student_info`.`sno` as id,`exam_student_info`.`student_name`,`exam_student_info`.`student_info_sno`,`exam_student_info`.`exam_roll_no`,`exam_student_info`.`dob`,`exam_student_info`.`uin_no`,`exam_student_info`.`course_name`,`student_info`.`father_name`,`student_info`.`mother_name`,`student_info`.`photo_id`,student_info.p_pin ,student_info.p_state,student_info.p_district,student_info.p_address,student_info.mobile,student_info.e_mail1,student_info.sno as snoo FROM `exam_student_info` LEFT JOIN `student_info` ON `exam_student_info`.student_info_sno = `student_info`.sno where `exam_student_info`.`exam_roll_no` = "'.$row['exam_roll_no'].'" AND `exam_student_info`.`course_name` = "'.$row['course'].'" AND `exam_student_info`.`mobile_no` = "'.$row['mobile_no'].'"';

							$student_info = mysqli_fetch_assoc(mysqli_query($erp_link,$sql));



                            // paper info

                         
						    
						$paperCodeArray = array();
                        $sql2 = 'SELECT * FROM exam_student_paper_info WHERE exam_student_info_sno = "'.$student_info['id'].'" and paper_code="'.$row['papercode'].'"';
                        $result2 = mysqli_query($erp_link, $sql2);
                        $row2 = mysqli_fetch_assoc($result2);
                            if (!in_array($row2['paper_code'], $paperCodeArray)) {
                                $paperCodeArray[] = $row2['paper_code'];
                                
                                if($row2['type_status']==1){
                                    $sql_subject = 'select * from add_subject where sno = "'.$row2['subject_id'].'"';
                                }else{
                                    $sql_subject = 'select * from add_subject2 where sno = "'.$row2['subject_id'].'"';
                                }
                                $row_subject = mysqli_fetch_assoc(mysqli_query($erp_link,$sql_subject));
                                $sub=$row_subject['subject'];
                                $papercode=$row2['paper_code'];
                                $title=$row2['title_of_paper'];
                            } else{
                                $sub="";
                                $papercode="";
                                $title="";
                            }  
                             
					
						
							
							$sql = 'select * from online_payment_eval where student_id="'.$student_info['snoo'].'"';
							$result_trans = execute_query($sql);
							$rows = mysqli_num_rows($result_trans);
							if($rows==0){
								$rows=1;
							}
							$r1 = '';
							$r2 = '';

							echo '<tr align="center" class="firstrow">
							<td rowspan="'.$rows.'" style="border-top:1px solid #f90;">'.$i++.'</td>
							<td rowspan="'.$rows.'" style="border-top:1px solid #f90;">'.$student_info['student_name'].'</td>
							<td rowspan="'.$rows.'" style="border-top:1px solid #f90;">'.$student_info['father_name'].'</td>
							<td rowspan="'.$rows.'" style="border-top:1px solid #f90;">'.date("d-m-Y", strtotime($student_info['dob'])).'</td>
							<td rowspan="'.$rows.'" style="border-top:1px solid #f90;">'.$row['mobile_no'].'</td>
							<td rowspan="'.$rows.'" style="border-top:1px solid #f90;">'.$student_info['exam_roll_no'].'</td>
							<td rowspan="'.$rows.'" style="border-top:1px solid #f90;">'.$sub.'</td>
							<td rowspan="'.$rows.'" style="border-top:1px solid #f90;">'.$papercode.'</td>
							<td rowspan="'.$rows.'" style="border-top:1px solid #f90;">'.$title.'</td>
							<td rowspan="'.$rows.'" style="border-top:1px solid #f90;">'.$row['bank_trans_no'].'</td>
							<td rowspan="'.$rows.'" style="border-top:1px solid #f90;">'.date("d-m-Y", strtotime($row['creation_time'])).'</td>';
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
							<td rowspan="'.$rows.'" style="border-top:1px solid #f90;">'.$student_info['uin_no'].'</td>
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
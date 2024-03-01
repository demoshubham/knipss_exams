<?php
function get_head_name($id){
	global $db;
	$sql = execute_query($db, 'select * from d_fees_head_master where sno='.$id);
	if($sql){
		$row = mysqli_fetch_assoc($sql);
	}	
	return $row['head_name'];
}
function get_pending_fees($id, $doa, $cur_date=0){
	global $db;
	if($cur_date==0){
		$sql = 'select * from general_settings where `description`="current_date"';
		$cur = mysqli_fetch_array(execute_query($db, $sql));
		$cur_date = $cur['value'];	
	}
	//echo $doa.'--'.$cur_date.'<br>';
	$fees=0;
	$fee_test=0;
	while($doa<=$cur_date){
		$sql='select * from d_fee_invoice_trans where student_id="'.$id.'" and `payment_date`="'.$doa.'"';
		if($id!=726){
			//echo $sql.'<br>';
		}
		$stud_inv = execute_query($db, $sql);
			$fee_test = get_fees($id,$doa);
			//echo $fee_test['tot_fees'].'<br>';
			$fees += $fee_test['tot_fees'];
			//echo $fee_test['tot_fees'].'--'.$fees.'<br>';
			//echo $i++.'.'.get_fees($row['sno'],$doa).'<br>';
			while($row_inv = mysqli_fetch_array($stud_inv)){
				if($row_inv['amount_due']!=0){
					//$fees += $row_inv['amount_due'];
				}
			}
		$doa = date("Y-m-d",strtotime(date("Y-m-d", strtotime($doa)) . " +1 month"));
		
		//break;
	}	
	return $fees;
}

function get_pending_fees_new($id, $doa='', $cur_date=0){
	global $db;
	$sql = 'select * from d_student_info where sno='.$id;
	$new_stud = $student = mysqli_fetch_assoc(execute_query($db, $sql));
	//echo $sql;
	$sql = 'select * from d_section where sno='.$student['class'];
	$section = mysqli_fetch_assoc(execute_query($db, $sql));
	
	
	$_GET['vfs'] = $section['sno'];		  
						  
	$sql = 'select * from general_settings where description="session_start_date"';
	$session_start = mysqli_fetch_assoc(execute_query($db, $sql))['value'];

	$sql = 'select * from general_settings where description="current_date"';
	$session_end = mysqli_fetch_assoc(execute_query($db, $sql))['value'];
	
	if($doa!=''){
		$original_session_start = $session_start;
		$original_session_end = $session_end;
		$session_start = $doa;
		$session_end = date("Y-m-d", strtotime($session_start."+1 month"));
	}

	if($new_stud['old_admission']==1){
		$student_type = ' and (d_fees_structure.student_type!="new_admission" or d_fees_structure.student_type is null)';
	}
	else{
		$student_type = ' and (d_fees_structure.student_type!="old_admission" or d_fees_structure.student_type is null)';
	}

	$sql = 'SELECT d_fees_structure.sno as sno, d_fees_structure.class_id, d_fees_structure.head_id, d_fees_structure.recurring_duration, d_fees_structure.amount, d_fees_structure.status, d_class.class_desc, head_name, student_type FROM `d_fees_structure` left join d_section on d_section.sno = d_fees_structure.class_id left join d_class on d_class.sno = d_section.class_desc left join d_fees_head_master on d_fees_head_master.sno = head_id where class_id='.$_GET['vfs'].$student_type;

	//echo $sql;						  
	$result = execute_query($db, $sql);
	$print = array();
	$head = array();
	if($result){
		while($row = mysqli_fetch_assoc($result)){
			$class_name = $row['class_desc'];
			$class_id = $row['class_id'];
			if($row['student_type']==''){
				$row['student_type']=0;
			}
			$print[$row['head_id']][$row['student_type']][$row['recurring_duration']] = $row['amount'];
		}
	}

	foreach($print as $k=>$v){
		$head[$k] = $v;
	}
	$recurring = 12;
	$tot = array();
	$tot_paid = 0;
	$tot_paid_bank = 0;
	$tot_paid_cash = 0;
	while($session_end>$session_start){
		$paid = 0;
		$paid_cash = 0;
		$paid_bank = 0;
		$paid_details = '';
		$month = date("m", strtotime($session_start));
		$month_words = strtolower(date("M", strtotime($session_start)));
		foreach($head as $k=>$v){
			foreach($v as $key=>$val){
				if($key==='new_admission'){
					$student_type= ' and (student_type="new_admission"  or student_type is null)';
					$k_tot = 'new';
				}
				elseif($key==='old_admission'){
					$student_type= ' and (student_type="old_admission"  or student_type is null)';
					$k_tot = 'old';
				}
				else{
					$student_type = '';
					$k_tot = '';
				}
				$discount_value = 0;
				if(!isset($tot[$k.$k_tot])){
					$tot[$k.$k_tot]=0;
					$tot[$k.$k_tot.'_discount']=0;
				}
				$sql = 'SELECT d_fees_structure.sno as sno, d_fees_structure.class_id, d_fees_structure.head_id, d_fees_structure.recurring_duration, d_fees_structure.amount, d_fees_structure.status, class_desc, head_name, student_type FROM `d_fees_structure` left join d_class on d_class.sno = class_id left join d_fees_head_master on d_fees_head_master.sno = head_id where class_id='.$_GET['vfs'].$student_type.' and head_id='.$k;
				//echo $sql.'<br>';
				$result_head_val = execute_query($db, $sql);
				
				if($result_head_val && mysqli_num_rows($result_head_val)!=0){
					$row_head_val = mysqli_fetch_assoc($result_head_val);
					$name = date("Ym_", strtotime($session_start)).$k;
					
					if(is_numeric($row_head_val['recurring_duration'])){
						if($doa!='' && $row_head_val['recurring_duration']!=1){
							$month_array = array();
							$month_array[] = $original_session_start;
							switch($row_head_val['recurring_duration']){
								case 2:{
									for($xi=$doa; $xi<=$original_session_end; ){
										$xi = date("Y-m-d", strtotime($xi."+2 month"));
										$month_array[] = $xi;
									}
									break;
								}
								case 3:{
									for($xi=$doa; $xi<=$original_session_end; ){
										$xi = date("Y-m-d", strtotime($xi."+3 month"));
										$month_array[] = $xi;
									}
									break;
								}
								case 6:{
									for($xi=$doa; $xi<=$original_session_end; ){
										$xi = date("Y-m-d", strtotime($xi."+12 month"));
										$month_array[] = $xi;
									}
									break;
								}
							}
							//echo $doa.'@@<br>';
							//print_r($month_array);
							if(!in_array($doa, $month_array)){
								goto skip;
							}
						}

						if($recurring%$row_head_val['recurring_duration']==0){
							$sql = '(select discount_value, student_type from d_discount_structure where discount_type="class" and discount_id="'.$_GET['vfs'].'" and head_id='.$k.' and "'.date("Y-m-01", strtotime($session_start)).'" between date_from and date_to ) union all (select discount_value, student_type from d_discount_structure where discount_type="head" and discount_id='.$k.' and "'.date("Y-m-01", strtotime($session_start)).'" between date_from and date_to ) union all (select discount_value, student_type from d_discount_structure where discount_type="student" and discount_id='.$new_stud['sno'].' and head_id='.$k.' and "'.date("Y-m-01", strtotime($session_start)).'" between date_from and date_to )';
							//echo $sql.'<br>';
							$result_discount = execute_query($db, $sql);
							if(mysqli_num_rows($result_discount)!=0){
								while($row_discount = mysqli_fetch_assoc($result_discount)){
									$discount_value = 0;
									if($row_discount['student_type']!=''){
										//echo '<br>'.$row_discount['student_type'].'--'.$student['old_admission'].'<br>';
										if($row_discount['student_type']=='old_admission' && $new_stud['old_admission']==1){

										}
										elseif($row_discount['student_type']=='new_admission' && $new_stud['old_admission']==0){

										}
										else{
											$row_discount['discount_value']=0;		
										}
									}
									$discount_symbol = strpos($row_discount['discount_value'], "%");
									if($discount_symbol===false){
										$discount_value += $row_discount['discount_value'];	
									}
									else{
										$temp_disc_val = str_replace("%", "", $row_discount['discount_value']);
										$temp_amt = ($row_head_val['amount']*$temp_disc_val)/100;
										$discount_value += $temp_amt;	
									}
									//echo 'Head: '.$k.' >> '.$session_start.' >> '.$discount_value.'<br>';
									$tot[$k.$k_tot.'_discount'] += $discount_value;
								}
							}
							$sql = 'select "" as sno, group_concat(d_fees_invoice.invoice_no) as invoice_no, sum(d_fees_invoice_trans.amount_payable) as amount_payable, sum(d_fees_invoice_trans.amount_paid) as amount_paid, mode_of_payment from d_fees_invoice_trans left join d_fees_invoice on d_fees_invoice.sno = d_fees_invoice_trans.invoice_no where d_fees_invoice.student_id="'.$new_stud['sno'].'" and month_year="'.date("Ym", strtotime($session_start)).'" and head_id='.$k;
							//echo $sql.'<br>';
							$result_paid = execute_query($db, $sql);
							if($result_paid){
							$row_paid = mysqli_fetch_assoc($result_paid);
							
							if($row_paid['amount_paid']!='' && $row_paid['amount_payable']!='0'){
								$paid += $row_paid['amount_paid'];
								if($row_paid['mode_of_payment']=='cash'){
									$paid_cash += $row_paid['amount_paid'];
								}
								else{
									$paid_bank += $row_paid['amount_paid'];
								}
								$paid_details .= $row_paid['sno'];
								if($row_paid['amount_paid'] < ($row_head_val['amount']-$discount_value)){
									$bal = ($row_head_val['amount']-$discount_value) - $row_paid['amount_paid'];
									//echo ' Balance : '.$bal.' <input type="checkbox" name="col_'.$name.'" id="col_'.$name.'" value="'.$bal.'" onchange="amount_payable(this.id)"></td>';	
								}
								else{
									//echo ' Full Paid ';	
								}									
							}
							else{
								//echo ' <input type="checkbox" name="col_'.$name.'" id="col_'.$name.'" value="'.($row_head_val['amount']-$discount_value).'" onchange="amount_payable(this.id)"></td>';	

							}
							$tot[$k.$k_tot] += $row_head_val['amount'];

					}}
					}
					else{
						$sql = 'SELECT d_fees_structure.sno as sno, d_fees_structure.class_id, d_fees_structure.head_id, d_fees_structure.recurring_duration, d_fees_structure.amount, d_fees_structure.status, class_desc, head_name FROM `d_fees_structure` left join d_class on d_class.sno = class_id left join d_fees_head_master on d_fees_head_master.sno = head_id where class_id='.$_GET['vfs'].' and head_id='.$k.' and recurring_duration="'.$month_words.'"';
						$result_month = execute_query($db, $sql);
						if(mysqli_num_rows($result_month)!=0){
							$sql = '(select discount_value from d_discount_structure where discount_type="class" and discount_id="'.$_GET['vfs'].'" and head_id='.$k.' and "'.date("Y-m-01", strtotime($session_start)).'" between date_from and date_to ) union all (select discount_value from d_discount_structure where discount_type="head" and discount_id='.$k.' and "'.date("Y-m-01", strtotime($session_start)).'" between date_from and date_to ) union all (select discount_value from d_discount_structure where discount_type="student" and discount_id='.$new_stud['sno'].' and head_id='.$k.' and "'.date("Y-m-01", strtotime($session_start)).'" between date_from and date_to )';
							$result_discount = execute_query($db, $sql);
							if(mysqli_num_rows($result_discount)!=0){
								while($row_discount = mysqli_fetch_assoc($result_discount)){
									$discount_symbol = strpos($row_discount['discount_value'], "%");
									if($discount_symbol===false){
										$discount_value += $row_discount['discount_value'];	
									}
									else{
										$temp_disc_val = str_replace("%", "", $row_discount['discount_value']);
										$temp_amt = ($row_head_val['amount']*$temp_disc_val)/100;
										$discount_value += $temp_amt;	
									}
									$tot[$k.$k_tot.'_discount'] += $discount_value;
								}
							}
							$sql = 'select group_concat("<li><a href=\'d_nf_fee_receipt.php?id=", d_fees_invoice.sno, "\' target=\'_blank\'>Receipt No.", d_fees_invoice.invoice_no, "</a> | <a href=\'d_nf_pendingfees.php?id='.$_GET['id'].'&del=", d_fees_invoice.sno, "\' onClick=\'return confirm(\"Are you sure?\");\' style=\'color:#f00;\'>(Delete)</a></li>" SEPARATOR \' \') as sno, group_concat(d_fees_invoice.invoice_no) as invoice_no, sum(d_fees_invoice_trans.amount_payable) as amount_payable, sum(d_fees_invoice_trans.amount_paid) as amount_paid, mode_of_payment from d_fees_invoice_trans left join d_fees_invoice on d_fees_invoice.sno = d_fees_invoice_trans.invoice_no where d_fees_invoice.student_id="'.$new_stud['sno'].'" and month_year="'.date("Ym", strtotime($session_start)).'" and head_id='.$k;

							$result_paid = execute_query($db, $sql);
							$row_paid = mysqli_fetch_assoc($result_paid);
							if($row_paid['amount_paid']!='' && $row_paid['amount_payable']!='0'){
								$paid += $row_paid['amount_paid'];
								if($row_paid['mode_of_payment']=='cash'){
									$paid_cash += $row_paid['amount_paid'];
								}
								else{
									$paid_bank += $row_paid['amount_paid'];
								}
								
								$paid_details .= $row_paid['sno'];
								if($row_paid['amount_paid'] < ($row_head_val['amount']-$discount_value)){
									$bal = ($row_head_val['amount']-$discount_value) - $row_paid['amount_paid'];
									//echo ' Balance : '.$bal.' <input type="checkbox" name="col_'.$name.'" id="col_'.$name.'" value="'.$bal.'" onchange="amount_payable(this.id)"></td>';	
								}
								else{
									//echo ' Full Paid ';	
								}									
							}
							else{
								//echo ' <input type="checkbox" name="col_'.$name.'" id="col_'.$name.'" value="'.($row_head_val['amount']-$discount_value).'" onchange="amount_payable(this.id)"></td>';	

							}
							$tot[$k.$k_tot] += $row_head_val['amount'];
						}
					}
					skip:
				}
			}
		}
		$recurring--;
		$tot_paid += $paid;
		$tot_paid_cash += $paid_cash;
		$tot_paid_bank += $paid_bank;
		//echo '<td>Rs.'.$paid.'<ul>'.$paid_details.'</ul></td></tr>';
		$session_start = date("Y-m-d", strtotime($session_start."+1 month"));
	}
	$total_fees=0;
	$total_discount=0;
	foreach($head as $k=>$v){
		foreach($v as $key=>$val){
			if($key==='new_admission'){
				$k_tot = 'new';
			}
			elseif($key==='old_admission'){
				$k_tot = 'old';
			}
			else{
				$k_tot = '';
			}
			$total_fees += $tot[$k.$k_tot];
			$total_discount += $tot[$k.$k_tot.'_discount'];
		}
	}
	if($doa==''){
		$sql = 'SELECT * FROM `d_fees_invoice` WHERE student_id='.$id.' order by entry_date desc limit 1';
		$result_last_payment = execute_query($db, $sql);
		if(mysqli_num_rows($result_last_payment)==1){
			$row_last_payment = mysqli_fetch_assoc($result_last_payment);
			if($row_last_payment['date_to']==''){
				$row_last_payment['date_to'] = $row_last_payment['date_from']."01";
			}
			else{
				$row_last_payment['date_to'] .= "01";	
			}

			//echo $row_last_payment['date_to'].'<br>';
			$pending_month = date("M-Y", strtotime($row_last_payment['date_to']."+1 month"));
			$month = date("Y-m-d", strtotime($row_last_payment['date_to']."+1 month"));
			//echo $pending_month;
		}
		else{
			$pending_month = date("M-Y", strtotime($session_start));
			$month = $session_start;
		}
		
		//echo $_POST['month'];
		$fees = get_pending_fees_new($id, $month);
		$pending_fees = $fees['total_fees']-$fees['amount_paid'];
		//print_r($fees);
	}
	else{
		$pending_month = '';
		$pending_fees = '';
	}
	
	$fees = array("total_fees"=>$total_fees, "total_discount"=>$total_discount, "amount_paid"=>$tot_paid, "cash_amount"=>$tot_paid_cash, "bank_amount"=>$tot_paid_bank, "pending_month"=>$pending_month, "pending_fees"=>$pending_fees);
	//print_r($fees);
	return $fees;

	
	
	
	
	
}

?>
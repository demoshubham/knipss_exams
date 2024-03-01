<?php
session_cache_limiter('nocache');
session_start();
include ("settings.php");

set_time_limit(0);

ini_set("log_errors", 1);
ini_set("error_log", "php-error.log");


//error_reporting(0);
$sql_main = $_SESSION['user_admin_sql'];
//echo $sql;
$balance=0;
$i=2;
$amount=0;
$amount_due=0;
$repeat = 0;
$link=dbconnect();

include("phpexcel/PHPExcel.php");
$objPHPExcel = new PHPExcel();

while($repeat<4){
	$objPHPExcel->createSheet();
	$objPHPExcel->setActiveSheetIndex($repeat);
	switch($repeat){
		case 0:{
			$objPHPExcel->getActiveSheet()->setTitle("All");
			$sql_main_new = $sql_main;
			break;
		}
		case 1:{
			$sql_main_new = $sql_main.' and student_info.category="GEN"';
			$objPHPExcel->getActiveSheet()->setTitle("GEN");
			break;
		}
		case 2:{
			$sql_main_new = $sql_main.' and student_info.category="OBC"';
			$objPHPExcel->getActiveSheet()->setTitle("OBC");
			break;
		}
		case 3:{
			$sql_main_new = $sql_main.' and student_info.category in ("SC", "ST")';
			$objPHPExcel->getActiveSheet()->setTitle("SC");
			break;
		}
	}
	$result = execute_query($sql_main_new,dbconnect());

	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(15);

	$objPHPExcel->getActiveSheet()->setCellValue('A1', 'S.No.');
	$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Registration Number');
	$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Student Name');
	$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Father Name');
	$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Category ');
	$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Class');
	$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Mobile No.');
	$objPHPExcel->getActiveSheet()->setCellValue('H1', 'Status');
	$objPHPExcel->getActiveSheet()->setCellValue('I1', 'Reg. Date');
	$objPHPExcel->getActiveSheet()->setCellValue('J1', 'Fee Deposit');
	$objPHPExcel->getActiveSheet()->setCellValue('K1', 'Form Submission');
	$objPHPExcel->getActiveSheet()->setCellValue('L1', 'Last Class');
	$objPHPExcel->getActiveSheet()->setCellValue('M1', 'Marks Obtained');
	$objPHPExcel->getActiveSheet()->setCellValue('N1', 'Total Marks');
	$objPHPExcel->getActiveSheet()->setCellValue('O1', 'Percentage');
	$objPHPExcel->getActiveSheet()->setCellValue('P1', 'NCC');
	$objPHPExcel->getActiveSheet()->setCellValue('Q1', 'Scout');
	$objPHPExcel->getActiveSheet()->setCellValue('R1', 'PH');
	$objPHPExcel->getActiveSheet()->setCellValue('S1', 'FF');
	$objPHPExcel->getActiveSheet()->setCellValue('T1', 'Department');
	$objPHPExcel->getActiveSheet()->setCellValue('U1', 'Sports');
	$objPHPExcel->getActiveSheet()->setCellValue('V1', 'NSS');
	$objPHPExcel->getActiveSheet()->setCellValue('W1', 'Total Weightage');
	$objPHPExcel->getActiveSheet()->setCellValue('X1', 'Final');

	$objPHPExcel->getActiveSheet()->setAutoFilter('A1:U1');
	$i=1;
	$a=2;
	$row_inv['txnreqdate']='';

		if(isset($_GET['pgid'])){
			if($_GET['pgid']==1){
				$limit = '';
				$start=1;
				$i=1;
			}
			else{
				$start = ($_GET['pgid']*100)-100;
				$limit = '';
				$i=$start+1;
			}
		}
		else{
			$start=1;
			$limit = '';
			$i=1;
		}
		$prev_univ = array('K N  I P S S SULTANPUR', 'K N I P S S', 'K N I P S S COLLAGE', 'K N I P S S SULTANPR', 'K N I P S S SULTANPU', 'K N I P S S SULTANPUR', 'K N I P S S SULTANPUR UP', 'K N I P S SULTANPUR', 'K N I P SS SULTANPUR', 'K N I PS S SULTANPUR', 'K N I PSS SULTANPUR', 'K N I SULTANPUR', 'K NI PSS SULTANPUR', 'K. N. I. P. S. S. SULTANPUR', 'K. N. I. P. S.S. SULTANPUR', 'K.N.I P.S.S', 'K.N.I. P.S.S. SULTANPUR', 'K.N.I.P.S.S', 'K.n.i.p.s.s Sultanpur', 'K.N.I.P.S.S.', 'K.N.I.P.S.S. SULTANPUE', 'K.N.I.P.S.S. SULTANPUR', 'K.N.I.P.S.S. SULTANPUR UP', 'K.NI.P.S.S. Sultanpur', 'KAMAL NEHARU INSTITUTE AND SOCIAL SCIENCE', 'Kamla Nehru Institute Of Phisical And Social Sciences', 'kamla nehru institute of physical & social sciences sultanpur', 'Kamla Nehru Institute Of Physical And Social Sciences', 'KNI PSS SULTANPUR', 'KNIPSS', 'KNIPSS  SULTANPUR', 'knipss sln', 'knipss slt', 'KNIPSS SULTANPUR', 'KNIPSS SULTANPUR U.P.', 'KNIPSS, SULTANPUR', 'KNIPSS,SULTANPUR');
		$row_inv['txnreqdate']='';
		while($row = mysqli_fetch_array($result)){
			$merit=0;
			$weight=0;
			$sql = 'select * from register_users where sno="'.$row['sno'].'"';
			$reg_user = mysqli_fetch_array(execute_query($sql,$link));
			$sql = 'select * from fees_invoice where student_id="'.$row['sno'].'"';
			$res_inv_temp = execute_query($sql,$link);
			$res_inv_temp_row = mysqli_num_rows($res_inv_temp);
			$orderid = '';
			if($res_inv_temp_row==0){
				$status = 'Only Registered';
				$row_inv['txnreqdate']='';
			}
			else{
				$sql = 'select * from fees_invoice where student_id="'.$row['sno'].'"';
				$res_inv = execute_query($sql,$link);
				$stat = 0;
				if(mysqli_num_rows($res_inv)>=1){
					while($row_inv_order = mysqli_fetch_array($res_inv)){
						if($row_inv_order['status']=="Success"){
							$orderid .= '<span style="color:#0F0;">'.$row_inv_order['order_id'].'</span><br>';
							$status = 'Fees Paid';
							$row_inv['txnreqdate'] = $row_inv_order['txnreqdate'];
							$stat=1;
							$merit=1;
						}
						else{
							$orderid .= $row_inv_order['order_id'].'<br>';
						}
					}
					if($stat==0){
						$status = 'Proceeded';
					}
				}
				else{
					$status = '';
					$row_inv['txnreqdate']='';
				}
			}
			if($row['date_of_admission']!=''){
				$merit=1;
				$status = 'Form Submitted';
				$edit = '<span"><a style="color:#F00; font-size:16px;" href="'.$_SERVER['PHP_SELF'].'?sid='.$row['sno'].'" onClick="return confirm(\'You are reopening User ID : '.$row['user_name'].'. Are you sure ?\')">Re-open</a></span>';
			}
			else{
				$edit='';
			}

			if($merit==1){
				$sql = 'SELECT * FROM `qual_detail` where student_id="'.$row['sno'].'" and medium="grad" order by abs(year) desc limit 1';
					//echo $sql.'<br>';
				$qual = execute_query($sql,dbconnect());
				if(mysqli_num_rows($qual)==1){
					$qual = mysqli_fetch_array($qual);
					if(in_array($qual['univ_name'], $prev_univ)){
						//echo 'in array<br>';
						$row['dept'] = '5';
					}
					else{
						$row['dept']='';
					}
					if(!is_numeric($qual['tot_marks'])){
						$qual['tot_marks']='';
						$percent='';
					}
					else{
						$percent = round($qual['obt_marks']*100/$qual['tot_marks'],3);
					}
				}
				else{
					unset($qual);
					$qual['tot_marks']='';
					$qual['obt_marks']='';
					$qual['exam_name']='';
					$percent = '';
					$msg = 'Invalid Data';
				}
				if($row['ncc']!=''){
					$row['ncc'] = '3';
				}
				if($row['scout']!=''){
					$row['scout'] = '3';
				}
				if($row['ph']!=''){
					$row['ph'] = '3';
				}
				if($row['ff']!=''){
					$row['ff'] = '2';
				}
				if($row['dept']=='YES'){
					//$row['dept'] = '5';
				}
				if($row['sports']!=''){
					$row['sports'] = '2';
				}
				if($row['nss']!=''){
					$row['nss'] = '2';
				}
				//echo $sql.'<br>';
				$weight = $row['ncc']+$row['scout']+$row['ph']+$row['ff']+$row['sports']+$row['nss']+$row['dept']; 
				$tot = $percent+$row['ncc']+$row['scout']+$row['ph']+$row['ff']+$row['sports']+$row['nss']+$row['dept'];
				
				$percent = "=(M".$a."*100/N".$a.")";
				$weight = "=sum(P".$a.":V".$a.")";
				$tot="=O".$a."+W".$a;
					
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$a, $i++);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$a, $reg_user['user_name']);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$a, $row['stu_name']);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$a, $row['father_name']);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$a, $row['category']);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$a, $row['class_description']);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$a, $row['mobile']);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$a, $status);
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$a, $reg_user['datestamp']);
				$objPHPExcel->getActiveSheet()->setCellValue('J'.$a, $row_inv['txnreqdate']);
				$objPHPExcel->getActiveSheet()->setCellValue('K'.$a, $row['date_of_admission']);
				$objPHPExcel->getActiveSheet()->setCellValue('L'.$a, $qual['exam_name']);
				$objPHPExcel->getActiveSheet()->setCellValue('M'.$a, $qual['obt_marks']);
				$objPHPExcel->getActiveSheet()->setCellValue('N'.$a, $qual['tot_marks']);
				$objPHPExcel->getActiveSheet()->setCellValue('O'.$a, $percent);
				$objPHPExcel->getActiveSheet()->setCellValue('P'.$a, $row['ncc']);
				$objPHPExcel->getActiveSheet()->setCellValue('Q'.$a, $row['scout']);
				$objPHPExcel->getActiveSheet()->setCellValue('R'.$a, $row['ph']);
				$objPHPExcel->getActiveSheet()->setCellValue('S'.$a, $row['ff']);
				$objPHPExcel->getActiveSheet()->setCellValue('T'.$a, $row['dept']);
				$objPHPExcel->getActiveSheet()->setCellValue('U'.$a, $row['sports']);
				$objPHPExcel->getActiveSheet()->setCellValue('V'.$a, $row['nss']);
				$objPHPExcel->getActiveSheet()->setCellValue('W'.$a, $weight);
				$objPHPExcel->getActiveSheet()->setCellValue('X'.$a, $tot);
				$a++;
			}
		}
		$repeat++;
}
$objPHPExcel->getProperties()->setCreator("WebPro Technologies");
$objPHPExcel->getProperties()->setLastModifiedBy("WebPro Technologies");
$objPHPExcel->getProperties()->setTitle("Customer Ledger");
$objPHPExcel->getProperties()->setSubject("Customer Ledger");
$objPHPExcel->getProperties()->setDescription("Customer Ledger");

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

// redirect output to client browser
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Report.xlsx"');
header('Cache-Control: max-age=0');

ob_end_clean();
$objWriter->save('php://output'); 



?>
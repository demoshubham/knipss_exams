<?php
session_cache_limiter('nocache');
session_start();
include ("settings.php");


ini_set("log_errors", 1);
ini_set("error_log", "php-error.log");


//error_reporting(0);
$sql = $_SESSION['user_admin_sql'];
//echo $sql;
$result = execute_query($sql,dbconnect());
$balance=0;
$i=2;
$amount=0;
$amount_due=0;

$link=dbconnect();

include("phpexcel/PHPExcel.php");
$objPHPExcel = new PHPExcel();
$objPHPExcel->createSheet();

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);



$objPHPExcel->getActiveSheet()->setCellValue('A1', 'S.No.');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Registration Number');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Password');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Student Name');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Father Name');
$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Class');
$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Mobile No.');
$objPHPExcel->getActiveSheet()->setCellValue('H1', 'Status');
$objPHPExcel->getActiveSheet()->setCellValue('I1', 'Order ID');
$objPHPExcel->getActiveSheet()->setCellValue('J1', 'Reg. Date');
$objPHPExcel->getActiveSheet()->setCellValue('K1', 'Fee Deposit');
$objPHPExcel->getActiveSheet()->setCellValue('L1', 'Form Submission');

$i=1;
$a=2;
$row_inv['txnreqdate']='';


while($row = mysqli_fetch_array($result)){
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
					$orderid .= $row_inv_order['order_id']." (Fees Paid)\n";
					$status = 'Fees Paid';
					$row_inv['txnreqdate'] = $row_inv_order['txnreqdate'];
					$stat=1;
				}
				else{
					$orderid .= $row_inv_order['order_id']."\n";
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
		$status = 'Form Submitted';
	}
	else{
		$edit='';
	}
	//echo $sql.'<br>';
	$objPHPExcel->getActiveSheet()->setCellValue('A'.$a, $i);
	$objPHPExcel->getActiveSheet()->setCellValue('B'.$a, $reg_user['user_name']);
	$objPHPExcel->getActiveSheet()->setCellValue('C'.$a, $reg_user['password']);
	$objPHPExcel->getActiveSheet()->setCellValue('D'.$a, $row['stu_name']);
	$objPHPExcel->getActiveSheet()->setCellValue('E'.$a, $row['father_name']);
	$objPHPExcel->getActiveSheet()->setCellValue('F'.$a, $row['class_description']);
	$objPHPExcel->getActiveSheet()->setCellValue('G'.$a, $row['mobile']);
	$objPHPExcel->getActiveSheet()->setCellValue('H'.$a, $status);
	$objPHPExcel->getActiveSheet()->setCellValue('I'.$a, $orderid);
	$objPHPExcel->getActiveSheet()->setCellValue('J'.$a, $reg_user['datestamp']);
	$objPHPExcel->getActiveSheet()->setCellValue('K'.$a, $row_inv['txnreqdate']);
	$objPHPExcel->getActiveSheet()->setCellValue('L'.$a, $row['date_of_admission']);
	
	$objPHPExcel->getActiveSheet()->getStyle('I'.$a.':D'.$objPHPExcel->getActiveSheet()->getHighestRow())
    ->getAlignment()->setWrapText(true); 
	
	$i++;
	$a++;
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
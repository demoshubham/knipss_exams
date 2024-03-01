<?php 
include("d_scripts/settings.php");

missing_tid();
function missing_tid(){
	$sql = 'select * from online_payment where order_status="Success" and tracking_id is not null';
	$result = execute_query($sql);
	echo '<table border="1">';
	$i=1;
	while($row = mysqli_fetch_assoc($result)){
		$sql = 'select * from register_users where sno="'.$row['student_id'].'"';
		$register_user = mysqli_fetch_assoc(execute_query($sql));
		echo '<tr>
		<td>'.$i++.'</td>
		<td>'.$register_user['user_name'].'</td>
		<td>'.$register_user['transaction_no'].'</td>
		<td>'.$register_user['payment_status'].'</td>
		<td>===</td>
		<td>'.$row['sno'].'</td>
		<td>'.$row['order_id'].'</td>
		<td>'.$row['billing_name'].'</td>
		<td>'.$row['order_status'].'</td>
		<td>'.$row['tracking_id'].'</td>
		</tr>';
	}
}

?>
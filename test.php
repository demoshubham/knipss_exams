<?php
ob_start();
date_default_timezone_set('Asia/Calcutta');
session_cache_limiter('nocache');
session_start();
include("settings.php");

incorrect_uin();

function incorrect_uin(){
	$sql = 'select * from register_users where uin_no is not null';
	$result = execute_query($sql);
	$i=1;
	echo '<table border="1">';
	while($row = mysqli_fetch_assoc($result)){
		$sql = 'select * from new_student_info where reg_user_sno="'.$row['sno'].'"';
		$stud_info = mysqli_fetch_assoc(execute_query($sql));
		
		$sql = 'select * from admission_student_info where student_id="'.$stud_info['sno'].'"';
		$result_admit = execute_query($sql);
		
		if(mysqli_num_rows($result_admit)==0){
		    $sql = 'update register_users set uin_no=NULL where sno="'.$row['sno'].'"';
		    //execute_query($sql);
			echo '<tr>
			<td>'.$i++.'</td>
			<td>'.$row['user_name'].'</td>
			<td>'.$sql.'</td>
			</tr>';
			
			
		}
		else{
		    $row_admit = mysqli_fetch_assoc($result_admit);
			if($row['uin_no']!=$row_admit['uin']){
			    $sql = 'select * from admission_student_info where uin="'.$row['uin_no'].'"';
			    $row_admin2 = mysqli_fetch_assoc(execute_query($sql));
			    
			    if($row_admit['uin']==''){
			        $col = '#f90;';
			    }
			    else{
			        $col = '';
			    }

    		    echo '<tr>
    			<td>'.$i++.'</td>
    			<td>'.$row['full_name'].'</td>
    			<td>'.$row['user_name'].'</td>
    			<td>'.$row['uin_no'].'</td>
    			<td>@@@@@@@</td>
    			<td>'.$row_admit['sno'].'</td>
    			<td>'.$row_admit['uin'].'</td>
    			<td style="background:'.$col.';">'.$row_admit['candidate_name'].'</td>
    			<td>>>>>>>>>></td>
    			<td>'.$row_admin2['sno'].'</td>
    			<td>'.$row_admin2['candidate_name'].'</td>
    			<td>'.$row_admin2['uin'].'</td>
    			</tr>';
			}
			
			echo '
			</tr>';
		}
	}
	echo '</table>';
}

?>
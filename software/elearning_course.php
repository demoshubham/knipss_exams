<?php 
include("d_scripts/settings.php");
$response=1;
$msg='';
$tab=1;
page_header_start();
page_header_end();
page_sidebar();

?>
<?php 
if(isset($_POST['course_name']) && $_POST['course_name'] != ''){
	if(isset($_POST['edit']) && $_POST['edit']!= ''){
		$sql = 'update elearning_course set 
			course_name="' . $_POST['course_name'] . '",
			course_price="' . $_POST['course_price'] . '",
			edited_by="' . $_SESSION['username'] . '",
			edition_time="' . date("Y-m-d H:i:s") . '"
			where sno=' . $_POST['edit'];
	
		execute_query( $sql);
		if(mysqli_errno($db)){
			$msg .= '<li>Updation Failed</li>' ;
		}
		else{
			$msg .= '<li>Data Updated</li>' ;
			$_GET['name']  = '';
		}
		
	}
	else{
		$sql = 'insert into elearning_course(course_name,course_price,created_by, creation_time) values("'.
		$_POST['course_name'].'", "'.
		$_POST['course_price'].'", "'.
		$_SESSION['username'].'", "'.
		date("Y-m-d H:i:s").
		'")';
		
		execute_query($sql);
		if(mysqli_errno($db)){
			$msg .= '<li>Insertion Failed</li>' ;
		}
		else{
			$msg .= '<li>Data Inserted</li>' ;
		}

	}
}

if (isset($_GET['edit'])) {
	$sql = 'select * from elearning_course where sno=' . $_GET['edit'];
	$data = mysqli_fetch_assoc(execute_query($sql));
}

if(isset($_GET['del']) and $_GET['del']!='') {
		$sql = 'delete from elearning_course where sno=' . $_GET['del'];
		$data = execute_query( $sql);
		if(mysqli_errno($db)){
			$msg .= '<h6 class="alert alert-danger">Deletion Failed.</h6>';
		}
		else{
			$msg .= '<h6 class="alert alert-danger">Data deleted.</h6>';			
		}
		$_GET['del'] = '';
}


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
								<label>Course Name</label>
                                <input type="text" name="course_name" id="course_name" value="<?php echo isset($_GET['edit'])?$data['course_name']:""?>" class="form-control">
							</div>
							<div class=" col-md-3 ">
								<label>Course Price</label>
								<input type="text" name="course_price" id="course_price" value="<?php echo isset($_GET['edit'])?$data['course_price']:""?>" class="form-control">
							</div>
                        </div>
						<div>
							<button type="submit" class="btn btn-primary " name="save" value="">Submit </button>
							<input type = "hidden" name = "edit" value="<?php echo isset($_GET['edit'])? $_GET['edit']: ""?>">	
							<!--<input type="reset"  value="Reset" class="btn btn-danger mt-2 ms-5" /> -->
						</div>
					</div>
			   </form>
                    </div>
                    <div class="card-body">
					<table class="table table-striped table-hover text-center" id="general_stat_table">
						<thead>
							<tr class="bg-primary text-white">
								<th>S.No.</th>
								<th>Course Type</th>
								<th>Course Name</th>
								<th class="text-center ">Edit|Delete</th>
							</tr>
						</thead>
						<?php
							$serial_no = 1;
							$sql = 'select * from elearning_course';
							$res = execute_query( $sql);
							if($res){
								while($row = mysqli_fetch_assoc($res)){

						?>
						<tr>
							<td><?php echo $serial_no++ ?></td>
							<td><?php echo $row['course_name'] ?></td>
							<td><?php echo $row['course_price'] ?></td>
							<td class="text-center ">
								<a href="<?php echo $_SERVER['PHP_SELF'] . '?edit=' . $row['sno']; ?>" alt="Edit" data-toggle="tooltip" title="Edit"><span class="far fa-edit" aria-hidden="true"></span></a>&nbsp;&nbsp;&nbsp;
								<a href="<?php echo $_SERVER['PHP_SELF'] . '?del=' . $row['sno']; ?>" onclick="return confirm('Are you sure?');" style="color:#f00" alt="Delete"><span class="far fa-trash-alt" aria-hidden="true" data-toggle="tooltip" title="Delete"></span></a>
							</td>
						</tr>
						<?php 
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
<?php
page_footer_start();
?>
    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
 
<?php		
page_footer_end();
?>
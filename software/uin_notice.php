<?php 
include("d_scripts/settings.php");

$response=1;
$msg='';
page_header_start();
page_header_end();
page_sidebar();
?>
<?php 
if(isset($_POST['notice']) && $_POST['notice'] != ''){
	if(isset($_POST['edit']) && $_POST['edit']!= ''){
		$sql = 'update uin_notice set 
			notice="' . $_POST['notice'] . '"
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
		
		$fileName=$_FILES["u_file"]["name"];
		$fileTmpName=$_FILES["u_file"]["tmp_name"];  
		$newFileName=$fileName;
		$uploadPath="upload/".$newFileName;
		if(move_uploaded_file($fileTmpName,$uploadPath)){
		   $msg .='<p class="alert alert-success">File Upload  Successfully </p>';   
		}
		
		// $sql = 'insert into uin_notice(notice, file) values("'.
		// $_POST['notice'].'",'".$newFileName."')';
		
		$sql="INSERT INTO `uin_notice`(`notice`,`file`,`date`) VALUES ('".$_POST['notice']."','".$newFileName."','".date("Y-m-d h:i:sa")."')";
		
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
	$sql = 'select * from uin_notice where sno=' . $_GET['edit'];
	$data = mysqli_fetch_assoc(execute_query($sql));
}

if(isset($_GET['del']) and $_GET['del']!='') {
		$sql = 'delete from uin_notice where sno=' . $_GET['del'];
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


<style>
form div.row:nth-child(odd) {
  background: #eeeeee;
  border-radius: 5px;
  margin-bottom:5px;
  margin-top:5px;
  padding:5px;
}
form div.row label{
	color:#000000;
}
</style>

<div id="container">	
		<div class="card card-body">    
        	<div class="row d-flex my-auto">  
				<form action="" class="wufoo leftLabel page1" name="" enctype="multipart/form-data" method="POST" onSubmit="" >
				<?php echo $msg.'</br>' ?>
				<div class="col-md-12" >
					<div class="bg-primary text-white p-2"><h3>Add Notice</h3></div>
						
						
							<table width="100%" class="table table-striped  table-hover rounded">
								<tr >
									
									<th width="25%">Announcement / Notice Update</th>
									<th width="25%"><input type="text" name="notice" id="notice" value="<?php echo isset($_GET['edit'])?$data['notice']:""?>" class="form-control"></th>
									<th width="25%">Upload Document</th>
									<th width="25%"><input type="file" name="u_file" id="u_file" value="<?php echo isset($_GET['edit'])?$data['u_file']:""?>" class="form-control"></th>
									
								</tr>
								
							</table>
							<button type="submit" class="btn btn-primary " name="save" value="">Submit </button>
							<input type = "hidden" name = "edit" value="<?php echo isset($_GET['edit'])? $_GET['edit']: ""?>">	
								
						</div>
				</form>	
			</div>
		</div>
	
	<div class="card card-body">
			<table  class="table table-striped table-hover rounded">
				<tr class="bg-primary text-white ">
					<th>S.No.</th>
					<th>Announcement / Notice Update</th>
					<th>Edit</th>
					<th class="text-center ">Delete</th>
					
				</tr>
				<?php
					$serial_no = 1;
					$sql = 'select * from uin_notice';
					$res = execute_query( $sql);
					if($res){
						while($row = mysqli_fetch_assoc($res)){

				?>
				<tr>
				
				<!-----
					<td><a href="upload/B.Tech 3rd Year_Syllabus 2022-23.pdf" download>Alok</a></td>
				---->
					<td><?php echo $serial_no++ ?></td>
					<td><?php echo $row['notice'] ?></td>
					<td class="text-center ">
						<a href="<?php echo $_SERVER['PHP_SELF'] . '?edit=' . $row['sno']; ?>" alt="Edit" data-toggle="tooltip" title="Edit"><span class="far fa-edit" aria-hidden="true"></span></a>&nbsp;&nbsp;&nbsp;
					</td>
					<td>
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
	
	
	
	
<?php 
page_footer_start(); 
page_footer_end(); 

?>
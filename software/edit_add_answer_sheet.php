<?php 
include("d_scripts/settings.php");

$allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf'];
if(isset($_POST['submit']) && $_POST['submit'] != ''){
    
    $errors = [];
    $fileName=$_FILES["u_file"]["name"];
    $fileTmpName=$_FILES["u_file"]["tmp_name"];
    $fileSize=$_FILES["u_file"]['size'];
    $newFileName=$fileName;
    
    if ($_FILES["u_file"]["size"] > 5 * 1024 * 1024) {
        $errors[] = "File is too large. Maximum file size allowed is 5MB.";
    }

    // Allowed file extensions
    
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Check if the file extension is allowed
    if (!in_array($fileExtension, $allowedExtensions)) {
        $errors[] = "Only JPG, JPEG, PNG, and PDF files are allowed.";
    }
    
    if (empty($errors)) {

        // $check="SELECT * FROM exam_copy_view WHERE file_upload_status='1' and sno='{$_POST['sno']}'";
        // $rescheck=mysqli_query($db,$check);
        // if(mysqli_num_rows($rescheck)>0){
        //     $rowcheck=mysqli_fetch_assoc($rescheck);
        //     if (file_exists($rowcheck['file_path'])) {
        //         if (unlink($rowcheck['file_path'])) {
        //             $msg .= '<h6 class="alert  alert-danger">file deleted done.</h6>';
        //         }else{
        //             $msg .= '<h6 class="alert  alert-primary">Could not find the file.</h6> ';
        //         }
        //     }
        // }

        // Set the upload directory
        $uploadDir = "upload/recheck_answer_sheet";

        // Create the upload directory if it doesn't exist
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $uploadPath="upload/recheck_answer_sheet/".$_POST['sno'].".".$fileExtension;
        if(mysqli_errno($db)){
            $msg .= '<h6 class="alert  alert-danger">Insertion Failed.</h6>' ;
        }
        else{
            $msg .= '<h6 class="alert  alert-success">Data Inserted.</h6>' ;
            if(move_uploaded_file($fileTmpName,$uploadPath)){
                $sql2="UPDATE exam_copy_view SET file_path = '$uploadPath', file_upload_status='1' WHERE sno='{$_POST['sno']}'";
                execute_query($sql2);
                $msg .='<p class="alert alert-success">File Upload  Successfully </p>';   
                }      
        }
    }else{
        $msg .= '<h6 class="alert  alert-danger">Due to Some Error Insertion Failed.</h6>' ;
    }
    $_SESSION['answersheetcheck']=$msg;
header("location: add_answer_sheet.php");
}

$response=1;
$msg='';
page_header_start();
page_header_end();
page_sidebar();


?>

<?php
if(isset($_POST['upload'])){
?>
	<div class="bg-white p-4">
		<div class="header  bg-primary text-white p-1 " style="border-radius:10px;">
			<h3>Upload Answer Sheet</h3>
		</div>
		<?php 
		?>
		<form action="<?php echo $_SERVER['PHP_SELF'];?>" class="mx-3" method="POST" enctype="multipart/form-data">
			<div class="row" style="background-color:#fff;">
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Exam Roll No.</label>
						<input type="text" class="form-control" id=""  value="<?php echo $_POST['rollno']?>" readonly>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Course</label>
						<input type="text" class="form-control" id=""  value="<?php echo $_POST['course']?>" readonly>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Paper Code</label>
						<input type="text" class="form-control" id=""  value="<?php echo $_POST['papercode']?>" readonly>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Mobile No.</label>
						<input type="text" class="form-control" id=""  value="<?php echo $_POST['mobno']?>" readonly>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Bank Transfer No.</label>
						<input type="text" class="form-control" id=""  value="<?php echo $_POST['bankrefno']?>" readonly>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Date of Form Submission</label>
						<input type="text" class="form-control" id=""  value="<?php echo $_POST['date']?>" readonly>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Upload Answer Sheet</label>
						<input type="file" name="u_file" class="form-control" id="">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for=""></label>
						<input type="hidden" name="sno" id="sno" value="<?php echo $_POST['sno']?>" >
						<button type="submit" class="form-control btn btn-primary btn-lg" id="" name="submit" Value="Submit"  >Upload File</button>
					</div>
				</div>
			</div>
			
		</form>
	</div>
<?Php
}
?>
	
	
	
	
<?php 
page_footer_start(); 
page_footer_end(); 

?>
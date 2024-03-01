<?php
include("d_scripts/settings.php");

 
$msg='';
$msg1='';
$tab=1;


if(isset($_POST['submit'])){
	if(isset($_POST['s_no'])){
		$currentDate = date('Y-m-d');
		$query='update `gallery` set
		photo="'.$_FILES['photo']['name'].'" ,photo_type="'.$_POST['photo_type'].'",upload_date="'.date('Y-m-d').'",title_name="'.$_POST['title_name'].'"
		where s_no="'.$_POST['s_no'].'"';
	}
	else{
		$query="INSERT INTO `gallery`(`photo`,`photo_type`,`upload_date`,`title_name`) values('".$_FILES['photo']['name']."','".$_POST['photo_type']."','".date('Y-m-d')."','".$_POST['title_name']."')";
	}
		$result=mysqli_query($conn,$query);
		if(mysqli_error($conn)){
			$msg .= "Some Issues. >> ".mysqli_error($conn)." >> ".$query;
		}
		else{
			$msg .= "Data Inserted Successfully";
		}
		move_uploaded_file ($_FILES['photo']['tmp_name'], "../images/".$_FILES['photo']['name']);
}
else{
	
	$_POST['destination'] = '';
	$_POST['edit_sno'] = '';
}


page_header_start();
page_header_end();
page_sidebar();

	
?>
					
   <form id="sale_form" name="sale_form" class="" autocomplete="off" enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="">

	
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center"></h4></br>
                    </div>
						<?php echo $msg; ?>
                    <div class="card-body">
						<div class="row" id="">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label >Destination</label>
                                    <input type="text" name="destination" id="destination" class="form-control" placeholder="" value="<?php echo $_POST['destination']; ?>" tabindex="<?php echo $tab++; ?>">
                                </div>
                            </div>
                        </div>
						<div id="test"></div>
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<button type="submit" name="submit" class="btn btn-success">Submit</button>
									<input type="hidden" id="edit_sno" name="edit_sno" value="<?php echo $_POST['edit_sno']; ?>">
								</div>
							</div>
						</div>
					</div>
                </div>
            </div>
        </div>
    </form>

	
<?php
page_footer_start();
?>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="js/light-bootstrap-dashboard.js?v=1.4.0"></script>
<script>

$('select[multiple]').multiselect();
</script>

    
<?php		
page_footer_end();
?>
<?php
include("d_scripts/settings.php");
 
$msg='';
$msg1='';
$tab=1;

	
	if(isset($_GET['del'])){
			$sql = 'delete from booking where sno="'.$_GET['del'].'"';
			mysqli_query($db, $sql);
			if(mysqli_error($db)){
				$msg1 .= '<h3 style="color:#ff0000;">Error in deleting . '.mysqli_error($db).' >> '.$sql.'</h3>';
			}
			else{
				$msg1 .= '<h3 style="color:#00ff00;">Deleted</h3>';
			}
		}
		 
		
		if(isset($_GET['edit'])){
		$sql= 'select * from booking where sno="'.$_GET['edit'].'"';
		$row = mysqli_fetch_assoc(mysqli_query($db, $sql));	
		}


page_header_start();
page_header_end();
page_sidebar();


?>
	
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body text-center">
					<div class="row">
						<div class="col-md-12">
							<h5>Booking</h5>
						</div>
					<?php echo $msg1; ?>
					</div>
					<div class="row">
						<div class="col-md-12">
							<table class="table table-striped">
								<thead>
									<tr>
										<th scope="col">S No.</th>
										<th scope="col">Picup-Location</th>
										<th scope="col">Drop-Location</th>
										<th scope="col">Total Distance</th>
										<th scope="col">Total Cost</th>
										<th scope="col">Edit</th>
										<th scope="col">Delete</th>
									</tr>
								</thead>
								<?php
								$sql = 'select * from booking';
								$result = execute_query($sql);
								$i=1;
								while($row = mysqli_fetch_assoc($result)){
									echo '<tr>
									<td>'.$i++.'</td>
									<td>'.$row['u_pickup_point'].'</td>
									<td>'.$row['u_drop_point'].'</td>
									<td>'.$row['tot_distance'].'</td>
									<td>'.$row['tot_cost'].'</td>
									
									<td><a href="users.php?edit='.$row['sno'].'" onClick="return confirm(\'Are you sure?\');">Edit</a></td>
									<td><a href="users.php?del='.$row['sno'].'" onClick="return confirm(\'Are you sure? \');" > Delete </a></td>';
								}
								?>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
<?php
	
page_footer_start();
page_footer_end();
?>
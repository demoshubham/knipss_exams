<?php
ob_start();
date_default_timezone_set('Asia/Calcutta');
session_cache_limiter('nocache');
session_start();
include("settings.php");



page_header();

?>
<!DOCTYPE html>
<html>
<head>
<style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  width: 300px;
  background-color: #f1f1f1;
}

li a {
  display: block;
  color: #000;
  padding: 10px 16px;
  text-decoration: none;
  font-size:20px;
  text-align:left;
}



li a:hover:not(.active) {
  background-color: blue;
  color: white;
}
li a.active {
  background-color: blue;
  color: white;
}
</style>
</head>
<body>

	<div class="d-flex justify-content-center " style="gap:1rem;">
		
		<div id="container" width="70%">
			
			<div style=" width:95%;"><br>
					
				<div class=" card card-body col-md-12 my-auto mx-auto" style="border-top-color: #d2d6de; background-color:whitesmoke;" >
					
					<div class="row mt-1">							
						<div class="col-md-12">							
							<div class="text-center" style="font-size:1.5rem;">Online Application of Inspection of Answer Book <br>ऑनलाइन उत्तर पुस्तिकाएं अवलोकित कराये जाने हेतु आवेदन <br><center><a href="re_evaluation_instruction.php" style="text-decoration:none;" class="btn btn-success mt-1">Click To Proceed</a><br></div>
						</div>
						
					</div>
					
				</div><br>
				<div class=" card card-body col-md-12 my-auto mx-auto" style="border-top-color: #d2d6de; background-color:whitesmoke;" >
					
					<div class="row mt-1">							
						<div class="col-md-12">							
							<div class="text-center" style="font-size:1.5rem;">Challenge to Evaluation  of Answer Book<br>मूल्यांकन को चुनौती  <br><center><a  class="btn btn-success mt-1"  href="challenge_evaluation_instruction.php" style="text-decoration:none;">Click To Proceed</a></center><br></div>
						</div>
						
					</div>
					
				</div><br>
				
			</div>		
		</div>
		
	</div>
</body>
</html>


<?php 

	page_footer();
	ob_end_flush();
?>

<?php
/*if($_SERVER["HTTPS"] != "on")
{
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
}*/
$db = mysqli_connect("p:localhost", "root", "mysql", "knipssex_2023");
if (!$db) {
    die('Could not connect: ' . mysqli_error());
}
else{
$msg_db = '';
}
function execute_query($db,$sql){
	return mysqli_query($db,$sql);
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8" />
		<meta
		  name="viewport"
		  content="width=device-width, initial-scale=1, shrink-to-fit=no"
		/>
		<title>KNIPSS</title>
		<!-- Bootstrap CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

		<!-- font awesome -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

		<style>
			*{
				margin:0px;
				padding:0px;
				box-sizing:border-box;
				scrollbar-width: 5px!important;
				/* border:1px solid red; */
			}
			
			.row{
				/* border:3px solid red; */
				/* display: flex; */
				/* justify-content: center; */

			}
			.logo-cont{
				/* width: 10%;   */
			}
			.logo{
				padding:15px; 
				width:160px; 
				height:auto; 
			}
			.head-wrap{
				width: 76%;  
				flex: 0 0 76%;
				max-width: 76%;
			}
			.main-head{
				font-size:40px;
				
			}
			.sub-head{
				font-size:28px;
				
			}
			.sub-sub-head{
				font-size:20px;
				
			}
			.announce{
				font-size:24px;
				text-align:center;
			}
		  .wrapp {
			margin:auto;
			width:80%;
			display: flex;
			justify-content: center;
			align-items: center;
			align-content: center;
			flex-wrap: wrap;
		  }
		  .btnn {
			/* max -width: 100px; */
			min-width: 100px;
			width: 250px;
			height: 4rem;
			display: flex;
			justify-content: center;
			align-items: center;
			align-content: center;
			flex-wrap: wrap;
			background-color: #940404;
			color: white;
			box-shadow: 2px 4px 5px #222;
			margin: 5px;
			border-radius: 5px;
		  }
		  .btnn:hover {
			color: #222;
			text-decoration: none;
		  }

		  /* animaiton notice row */
		 


		 /* @media only screen and (max-width: 600px) and (min-width: 400px) {...}  */
			@media (max-width: 1325px) {
				.logo{
				padding:15px; 
				width:130px; 
				height:auto; 
				}	
				
			}
		 	@media (max-width: 1355px) {
				.main-head{
					font-size: 38px;
					padding:0px;
					
				}
				.sub-head{
					font-size:26px;
					padding:0px;
					
				}
				.sub-sub-head{
					font-size:18px;
					padding:0px;
					
				}
				
			}
			@media (max-width: 1289px) {
				.main-head{
					font-size: 36px;
					
				}
				
			}
			@media (max-width: 1223px) {
				.main-head{
					font-size: 32px;
					
				}
				
			}
			@media (max-width: 1075px) {
				.logo{
				padding:15px; 
				width:120px; 
				height:auto; 
				}	
				
			}
			@media (max-width: 1092px) {
				.main-head{
					font-size: 30px;
					
				}
				.sub-head{
					font-size:22px;
					
				}
				.sub-sub-head{
					font-size:16px;
					
				}
			
			}
			@media (max-width: 992px) {
				.logo{
				padding:15px; 
				width:110px; 
				height:auto; 
				}	
				
			}
			@media (max-width: 1027px) {
				.main-head{
					font-size: 28px;
					
				}
				.sub-head{
					font-size:20px;
					
				}
				.sub-sub-head{
					font-size:16px;
					
				}
			
			}	
			@media (max-width: 961px) {
				.logo{
				padding:15px; 
				width:105px; 
				height:auto; 
				}	
				.main-head{
					font-size: 26px;
					
				}
				.sub-head{
					font-size:20px;
					
				}
				.sub-sub-head{
					font-size:14px;
					
				}
			
			}
			@media (max-width: 867px) {
				.logo{
				padding:15px; 
				width:100px; 
				height:auto; 
				}	
				
			}
			@media (max-width: 895px) {
				.main-head{
					font-size: 24px;
					
				}
				
			}
			
			@media (max-width: 829px) {
				.logo{
				width:90px; 
				height:auto; 
				}	
				.main-head{
					font-size: 20px;
					
				}
				.sub-head{
					font-size:18px;
					
				}
				.sub-sub-head{
					font-size:12px;
					
				}
			
			}		
			@media (max-width: 742px) {
				.marq{
					font-size:12px !important;
				}
				.logo{
					padding:5px;
					/* margin:0px; */
					width:85px;
					height:auto;
				}
				.sub-head{
					font-size:14px;
					
				}
				.sub-sub-head{
					font-size:12px;
					
				}
			}
			@media (max-width: 698px) {
				.head-wrap{
					width:450px;
				}
				.logo{
					padding:2px;
					/* margin:0px; */
					width:80px;
					height:auto;
				}
				.main-head{
					font-size: 16px;
					
				}
			}
				@media (max-width: 575px) {
					.head-wrap{
						width:410px;
					}
					.logo{
						padding:2px;
						/* margin:0px; */
						width:70px;
						height:auto;
					}
					.main-head{
						font-size: 15px;
						
					}
					.sub-head{
						font-size:13px;
						word-spacing: -1px;
						
					}
					.sub-sub-head{
						font-size:11px;
						
					}
					
					
				}	
				@media (max-width: 534px) {
					.logo{
						padding:1px;
						/* margin:0px; */
						width:40px;
						height:auto;
					}
					.head-wrap{
						width:390px;
					}
					.logo{
						padding:2px;
						/* margin:0px; */
						width:70px;
						height:auto;
					}
					.main-head{
						word-spacing: -1px;
						font-size: 13px;
						
					}
					.sub-head{
						font-size:11px;
						
					}
					.sub-sub-head{
						font-size:9px;
						
					}
				
			
				}
				@media (max-width: 534px) {
					.announce{
						font-size:20px;
					}
					.logo{
						padding:1px;
						/* margin:0px; */
						width:40px;
						height:auto;
					}
					.head-wrap{
						width:390px;
					}
					.logo{
						padding:2px;
						/* margin:0px; */
						width:60px;
						height:auto;
					}
					.main-head{
						word-spacing: -1px;
						font-size: 12px;
						
					}
					.sub-head{
						font-size:10px;
						
					}
					.sub-sub-head{
						font-size:8px;
						
					}
				
			
				}
				@media (max-width: 426px) {
					
					.head-wrap{
						width:350px;
					}
					.logo{
						padding:2px;
						/* margin:0px; */
						width:50px;
						height:auto;
					}
					.main-head{
						word-spacing: -2px;
						font-size: 11px;
						
					}
					.sub-head{
						font-size:9px;
						
					}
					.sub-sub-head{
						font-size:8px;
						
					}
					.announce{
						font-size:18px;
					}
				}												
				@media (max-width: 384px) {
					
					.logo{
						padding:2px;
						/* margin:0px; */
						width:40px;
						height:auto;
					}
					.main-head{
						word-spacing: -1px;
						font-size: 10px;
					}
					.sub-head{
						font-size:8px;
						
					}
					.sub-sub-head{
						font-size:7px;
						
					}
					.announce{
						font-size:16px;
					}
				}	
				@media (max-width: 360px) {
					.padding-x-y{
						padding:0 2px !important;
					}
					.logo{
						padding:1px;
						/* margin:0px; */
						width:28px;
						height:auto;
					}
					
				}	
				@media (max-width: 340px) {
					
					.logo{
						padding:2px;
						/* margin:0px; */
						width:26px;
						height:auto;
					}
					.main-head{
						word-spacing: -1px;
						font-size: 9px;
					}
					.sub-head{
						font-size:7px;
						
					}
					.sub-sub-head{
						font-size:6px;
						
					}
				}	


				
		</style>

    
	</head>
	<body>
		<div class="col-md-12 " style="background-color:darkblue;">
			<div class="row">
				<div class="col-md-2">
			
                                  
				</div>
				<div class="col-md-8">
					<div class="mt-2 marq  " style="color:whitesmoke; padding-bottom:15px;"> 
                        <marquee ><b>कमला नेहरू इन्स्टीट्यूट की स्थापना का मकसद महज़ एक तालीमी इदारा क़ायम करना नहीं है, बल्कि इस पूरे इलाके की ग़ुरबत की लड़ाई इसी इदारे से उसी दोहरे निश्चय के साथ लड़़ना है, जिस अज़़्म के साथ इस इलाके के बाशिन्दों ने सन् 1857 की जंगे आज़ादी लड़ी थी। ”.....आर्थिक आज़ादी के लिए जंग का मरकज़ कमला नेहरू इन्स्टीट्यूट है।“<b></marquee>
                    </div>
				</div>
				<div class="col-md-2 pt-2" align="right">
				<a href="software/index.php" class=" text-white p-2 pt-2">
				 Admin Login
				</a>
                                  
				</div>
			</div>
		</div>

		<div class="container-fluid px-1 padding-x-y overflow-hidden d-flex justify-content-between bg-primary text-white ">
			<div class="logo-cont" >
				<img  class="logo" src="images/logo.png" alt="logo" class="img-fluid d-block m-auto" />
			</div>

			<div class="head-wrap text-center " >
				<div class="main-head" ><b>Kamla Nehru Institute of Physical and Social Sciences <br> Sultanpur U.P. India </b></div>
				<div class="sub-head" style="color: yellow"><b>An Autonomous Institute And Accredited "A" Grade by NAAC</b></div>
			  <!--
				<h4 style="color: #31708f">
					Affiliated to Dr. Ram Manohar Lohia Avadh University Ayodhya U.P.
				</h4> 
				<img src="images/Title.gif" alt="title" class="img-fluid" />
			  -->
			  
				<div class="sub-sub-head" style="color: black"><b>Affiliated to Dr. Ram Manohar Lohia Avadh University Ayodhya U.P.</b></div>
			</div>

			<div class="logo-cont">
				<img  class="logo"  src="images/right-logo.png" alt="" class="img-fluid d-block m-auto" />
			</div>
		</div>
 
		<div   class="container-fluid img-fluid col-md-12" style=" width: 100%; height: 60vh; background-color: aliceblue;background-image: url(images/bg7.jpg);      background-repeat: no-repeat; background-position: center;  background-size: cover; " >
			<div class="row p-1 " style="height:100%">
				
				<div class="col-10 col-sm-8 col-md-6 m-auto  bg-light text-danger m-auto" style="margin:10px; min-height:90%; max-height:90%; border-radius:20px; overflow-y: auto ;padding-inline:0!important; position:relative!important;" >
					<div class="announce bg-primary text-white " style="position:sticky;top:0px;right:0;left:0;z-index:2;">
							<u><b>Announcement / Notice-Board</b></u>
					</div>
					<table class="table table-striped table-hover table-sm"  >
					<!--	<tr>
							<th width="10%" style="width:10% ;font-size:1.8rem;padding:0 0 0 1.5rem;	line-height:35px; background-color:#222; color:aliceblue;" class="bg-secondary">
							</th>
							<th style="text-align:center;font-size:1.2rem;">Notice-Board</th>
							
						</tr>-->
						<?php 
							$id = 1;
							$sql = 'select * from uin_notice order by sno desc ';
							$result = mysqli_query($db, $sql);
							//print_r($result);
							if($result){
								while($row = mysqli_fetch_assoc($result)){
						?>			<tr style="" class="notice-row" >
										
										<td style="width:10% ;font-size:1.8rem;padding:0 0 0 1.5rem;line-height:35px; background-color:#222; color:aliceblue;" class="bg-secondary"><?php echo "&#x203A;";
														$id++; ?></td>
										
										<td style="width:80%;line-height:35px" class="m-right">
										
											<a style = "text-decoration:none;display:block; color:#000;font-weight:700;" href="software/upload/<?php echo $row['file'] ;?>" target="_blank" >
												<?php echo $row['notice'] ;?>
												<?php 
													if($id<=4){
														echo '<img style="height:25px;" id="gif" src="images/new_gif.gif" alt="new gif ">';
													}
												?>
											</a>
										</td>


										<td style="width:10%";>
											<a style = "text-decoration:none;display:block;line-height:35px; color:#000;" href="software/upload/<?php echo $row['file'] ;?>" target="_blank" download >
												<i class="fas fa-file-download"></i>	
											</a>
										</td>
										
									</tr>
						<?php			
								}
							}
						?>
					
					</table>
					<script>
						let freq=<?php echo $id;?>
						let gif=document.querySelector("#gif");
;
						console.log("hello");
						if(freq>=1){
							gif.style.display:"none";
						}
					</script>
					
				</div>
			</div>
		
		</div>
		<div class="container-fluid">
			<div class="row wrapp text-center">
				<a href="uin_reg_form.php" class="btnn bg-primary text-white">
				  <h4 class=""> Unique Identity Number (UIN)</h4>
				</a>
				<a href="exam_reg_form.php" class="btnn bg-primary text-white">
				  <h4>Examination Form</h4>
				</a>
				<a href="admit_card_search.php" class="btnn bg-primary text-white">
				  <h4>Admit Card<img style="height:25px;" id="gif" src="images/new_gif.gif" alt="new gif "></h4>
				</a>
				<!--<a href="#" class="btnn bg-primary text-white">-->
				<a href="exam_result.php" class="btnn bg-primary text-white">
				  <h4>Result</h4>
				</a>
				<a href="elearning_reg_form.php" class="btnn bg-primary text-white">
				  <h4>Online Practical</h4>
				</a>
				<a href="answer_sheet_reevaluation.php" class="btnn bg-primary text-white">
				  <h4>Answer sheet Re-Evaluation</h4>
				</a>
			</div>
		</div><br>
		<div class=" row my-auto">
			<div class="card  col-md-12 " style="background-color:whitesmoke; font-weight:bold;">
				<h3 class="text-danger pl-1">हेल्प डेस्क :</h3>
				<div class="container">
					<div class="row">
						<div class="col-sm-6 col-md-3"> <i>1. </i> <u>समय</u> - प्रात: 10 से सायं 6 बजे तक </div>
						<div class="col-sm-6 col-md-3"><i>2. </i> <u>मोबाईल</u> -  9554969773 & 7052984802</div>
						<div class="col-sm-6 col-md-3"><i>3. </i><u>ई-मेल</u> - knipssexams@gmail.com</div>
						<div class="col-sm-6 col-md-3"><i>4. </i><u>पता</u> - कमला नेहरू भौतिक एवं सामाजिक विज्ञान संस्थान, सुल्तानपुर , उत्तर प्रदेश, 228118</div>
					</div>
				</div>
				<!-- <table class="table table-condensed rounded" cellpadding="5" cellspacing="5">
					  
						<tr style="margin-left:10px;">
							<td><i>1. </i> <u>समय</u> - प्रात: 10 से सायं 6 बजे तक</td>
							<td><i>2. </i> <u>मोबाईल</u> - 7052984802 , 7052984808</td>
							<td><i>3. </i><u>ई-मेल</u> - knipssexams@gmail.com</td>
						
							<td colspan="2"><i>4. </i><u>पता</u> - कमला नेहरू भौतिक एवं सामाजिक विज्ञान संस्थान, सुल्तानपुर , उत्तर प्रदेश, 228118</td>
						</tr>
					
				</table> -->
			</div>
		</div>

		<!-- bootstrap -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
		<!-- bootstrap -->

		<!-- <script
		  src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
		  integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
		  crossorigin="anonymous"
		></script>
		<script
		  src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
		  integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
		  crossorigin="anonymous"
		></script>
		<script
		  src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
		  integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
		  crossorigin="anonymous"
		></script> -->
	</body>
</html>

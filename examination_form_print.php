

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    
    <!-- Bootstrap CSS -->
    <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
    rel="stylesheet"
    
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
    crossorigin="anonymous"
    />
    
    <title>Candidate Confirmation Form !</title>

    <!-- css  -->
    <style>
      body {
        font-family: "Roboto", sans-serif;
        font-size: .8rem;
        /* line-height: 0.9; */
      }
      h1{
        font-size: 1.8rem !important;
      }
      h2{
        font-size: 1.5rem !important;
      }
      h3{
        font-size: 1.3rem !important;
      }
      h4{
        font-size: 1rem !important;
      }
      p{
        font-size: .6rem !important;
      }
      td{
		
        font-size: .6rem !important;
      }
      th{
        font-size: .6rem !important;
      }
      @media print {
        *{
          margin: 0px !important;
		  margin-block: 2px !important;
          padding: 2px !important;
          box-sizing: border-box !important;
        }
		.head-name{
			font-size:15.5px !important;
		}
       body{
        padding:1rem!important;
       }
        td{
          padding: 8px !important;
          /* margin: 10px !important; */
        }
		tr{
		}
        .print_no{
          display:none !important;
        }
        /*.blood{
		font-size:7.9px!important;
	 }*/
        .btn-print{
          display: none;
        }
        
      }

      @page{
        size: A4;
        margin-inline:0;
        padding: 0;
      }
    </style>
    <!-- <link rel="stylesheet" href="style.css" media="print"> -->
    <!-- googlefont -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,700&display=swap"
      rel="stylesheet"
    />
  </head>
  <body class="w-100 m-auto">
  
    <div class="" style="display:flex ; justify-content: center ;">
      <button class="btn btn-secondary btn-print" style="width: 5%;" onclick="print()">Print</button>
    </div>
	<img src="images/logo.png"  id="overlays" style=" z-index:-2;opacity:0.15;position: absolute;top: 50%;left: 50%;-ms-transform: translate(-50%, -50%);transform: translate(-50%, -50%); width:30%;" alt="overlay image" >


   <div class="container-fluid m-auto cont ">
      <div class="container-fluid border">
       <!-- <div class="row  d-flex align-items-center">
          <div class="col-2 ">
            <img src="images/logo.gif" alt="logo" class="img-fluid w-75 m-1" />
          </div>
          <div class="col-11">
            <h3 class="" style="text-align: center;"><b>Kamla Nehru Institute Of Physical & Social Sciences,Sultanpur, Uttar Pradesh<b></h3>
            <h4 style="text-align: center;"><b>An Autonomous Institute</b></h4>
          </div>
        </div>-->
		
		<table width="100%" style="margin:0px;">
			<tr>
				<th width="12%" rowspan="2"><img style="padding:15px; height:65px; width:65px; " src="images/logo.png" alt="logo" class="img-fluid d-block m-auto" /> </th>
				<th width="88%">
					<h4 class="" style="text-align: center; margin:0px; " ><span style="font-size:17px;white-space:nowrap;" class="head-name"><b>Kamla Nehru Institute Of Physical & Social Sciences,Sultanpur, Uttar Pradesh</b></span> <br>An Autonomous Institute And Accredited "A" Grade by NAAC</h4>
				</th>
			</tr>
		</table>
        <!-- <hr> -->
        <div class="table-responsive ">
			<table  width="100%" class="table table-bordered border">
			  
				<tr>
					<th scope="col" COLSPAN="6" class="p-1"><center>EXAMINATION FORM - 2023</center></th>
				</tr>
				<tr>
					<th scope="col" width="17%">NAME OF COLLEGE:</th>
					<th scope="col"   colspan="3"></th>
					<th scope="col"  width="15%">EXAM FORM NO.</th>
					<th scope="col"  width="19%"></th>
				</tr>
				<tr>
					<th scope="col"  >COURSE APPLIED FOR:</th>
					<th scope="col"   colspan="3"></th>
					<th scope="col"   >STUDENT TYPE</th>
					<th scope="col"  ></th>
				</tr>
				<tr>
					<th scope="col" width="15%" >EXAM FEE</th>
					<th scope="col"  width="18%" ></th>
					<th scope="col"  width="15%">TRANSACTION NO.</th>
					<th scope="col" width="18%" ></th>
					<th scope="col" width="16%"  >TRANSACTION DATE:</th>
					<th scope="col" width="19%" ></th>
				</tr>
				<tr>
					<th scope="col"  >FEE BREAKUP :</th>
					<th scope="col"   colspan="5"></th>
					
				</tr>
				<tr>
					<th scope="col"  >STUDENT NAME</th>
					<th scope="col"   ></th>
					<th scope="col"  >FATHER'S/HUSBAND NAME</th>
					<th scope="col"  ></th>
					<th scope="col"   >UIN NO. :</th>
					<th scope="col" rowspan="4"  width="19%">IMG</th>
				</tr>
				<tr>
					<th scope="col"  >MOTHER'S NAME</th>
					<th scope="col"   ></th>
					<th scope="col"  >DATE OF BIRTH</th>
					<th scope="col"  ></th>
					<th scope="col"   >GENDER :</th>
				</tr>
				<tr>
					<th scope="col" >CATEGORY</th>
					<th scope="col"   ></th>
					<th scope="col" >SUB CATEGORY</th>
					<th scope="col"></th>
					<th scope="col" class="blood" >BLOOD GROUP: Not Known</th>
				</tr>
				<tr>
					<th scope="col" >ADHAR NUMBER</th>
					<th scope="col"   ></th>
					<th scope="col" >MOBILE</th>
					<th scope="col" ></th>
					<th scope="col" >RELIGION:</th>
				</tr>
				<tr>
					<th scope="col" >PARENT'S INCOME</th>
					<th scope="col" ></th>
					<th scope="col" >DOMICILE</th>
					<th scope="col"  ></th>
					<th scope="col"  >MOTHER TONGUE:</th>
					<th scope="col"  ></th>
				</tr>
				<tr>
					
					<th scope="col" >APPLY FOR NSS</th>
					<th scope="col" colspan="5" ></th>
					
				</tr>
				<tr>
					<td scope="row" COLSPAN="6"><b>NAME AND COMPLETE MAILING ADDRESS OF CONDIDATE:</b></td>
				</tr>
				<tr>
					<td scope="row" COLSPAN="6">HOUSE NO.:  STREET/VILLAGE: <br>POST OFFICE: DISTRICT/CITY : STATE:</td>
				</tr>
				<tr>
					<td scope="row" COLSPAN="6"><b>PREVIOUS YEAR EXAMINATION DETAIL</b></td>
				</tr>
				
				<tr>
					<th >EXAMINATION NAME</th>
					<th colspan="2"> BOARD / UNIVERSITY</th>
					<th >YEAR</th>
					<th>ROLL NO.</th>
					<th>MARKS(OBT./MAX.)</th>
					
				</tr>
				
				<tr>
					<td ></td>
					<td colspan="2" ></td>
					<td > </td>
					<td > </td>
					<td > </td>
					
				</tr>
			</table>
			<table class="table table-bordered">
				<tr>
					<th colspan="4"> SUBJECT / PAPER OPTED</th>
				</tr>
				<tr>
					<th width="8%">S. NO.</th>
					<th width="17%">TYPE</th>
					<th width="20%">SUBJECT</th>
					<th width="10%">PAPER CODE </th>
					<th width="35%" >PAPER NAME</th>
					<th width="10%" >CREDIT</th>
				</tr>
				<tr>
					<td >1</td>
					<td ></td>
					<td ></td>
					<td ></td>
					<td ></td>
					<td ></td>
				</tr>
				<tr>
					<td >2</td>
					<td ></td>
					<td ></td>
					<td ></td>
					<td ></td>
					<td ></td>
				</tr>
				
				<tr>
					<td >3</td>
					<td ></td>
					<td ></td>
					<td ></td>
					<td ></td>
					<td ></td>
				</tr>
				
				<tr>
					<td >4</td>
					<td ></td>
					<td ></td>
					<td ></td>
					<td ></td>
					<td ></td>
				</tr>
				<tr>
					<td >5</td>
					<td ></td>
					<td ></td>
					<td ></td>
					<td ></td>
					<td ></td>
				</tr>
				
				
			   
			</table>
        </div>
		<table  width="100% " >
			<tr >
				<td >
				  <hr>
				  <h4 align="center"><b>DISCLAIMER</b></h4>
				  <hr>
				  <p>I, <b>Student Name</b>Son/Daughter/Wife of <b>Father's Name </b> ,as a bonafied student of the (039) K.N.I.P.S.S. SULTANPUR , hereby declarethat all the statement/Particulars made/furnished in this Examination Form No. <b>FORM NUMBER</b> are true, complete and correct to the best of my knowledge and belief . I also declare and fully understand that my candidature for the examination is strictly abide with the rules and regulation of the University and in the event of any information furnished being found false or incorrect at any stage in future, my application/condidature is liable to the summarily rejected and the University/College may additionally take legal action in this regard against me , as deemed fit. </p>
				</td>	
			</tr>
			<tr>
				<th colspan=""2>DATE :</th>
			</tr>
			<tr>
				
				<td style="text-align:right; margi-right:10px;" >VERIFIED BY-(DEAN/HOD/PRINCIPAL SIGNATURE WITH SEAL)<br><b><span >KNIPSS,Sultanpur</span></b></td>
			</tr>
			<tr>
				<td >SIGNATURE OF STUDENT<td>
			</tr>
			<tr>
				<td >FORM FILLED ON:<td>
			</tr>
			
		</table >
    </div>
</div>
	
     
  </body>
</html>

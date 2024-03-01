
<?php 
session_start();
include("settings.php");
include("exam_crosslist_marksheet_functions.php");
$msg='';
if(isset($_POST['loginfor']) and $_POST['loginfor']=="viewanswerbook"){
    $sql="SELECT * FROM `exam_copy_view` WHERE sno='".$_POST['appno']."' and bank_trans_no='".$_POST['bankrefno']."' and exam_roll_no='".$_POST['rollno']."'";
    $res=mysqli_query($db,$sql);

    if(mysqli_num_rows($res)>0){
        $rows=mysqli_fetch_assoc($res);  
    ?>
    <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
      integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
      crossorigin="anonymous"
    />
   <style>
        *{
            margin:0;
            padding:0;
        }
        .top-bar {
            background: #333;
            color: #fff;
            padding: 1rem;
        }

        .btn {
            background: coral;
            color: #fff;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 0.7rem 2rem;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .page-info {
            margin-left: 1rem;
        }

        .error {
            background: orangered;
            color: #fff;
            padding: 1rem;
        }

        @media print{
            *{
                display:none;
            }
        }

   </style>
    <title>PDF Viewer</title>
  </head>
  <script>
    // Disable right-click context menu
    document.addEventListener('contextmenu', function (e) {
        e.preventDefault();
    });

    // Disable keyboard shortcuts for save (Ctrl+S or Command+S)
    window.addEventListener('keydown', function (e) {
        if ((e.ctrlKey || e.metaKey) && e.keyCode === 83) {
            e.preventDefault();
            alert("Downloading is disabled for this document.");
        }
    });

  </script>
  <body>
    <div class="top-bar">
      <button class="btn" id="prev-page">
        <i class="fas fa-arrow-circle-left"></i> Prev Page
      </button>
      <button class="btn" id="next-page">
        Next Page <i class="fas fa-arrow-circle-right"></i>
      </button>
      <span class="page-info">
        Page <span id="page-num"></span> of <span id="page-count"></span>
      </span>
    </div>

    <canvas id="pdf-render"></canvas>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.min.js" integrity="sha512-Z8CqofpIcnJN80feS2uccz+pXWgZzeKxDsDNMD/dJ6997/LSRY+W4NmEt9acwR+Gt9OHN0kkI1CTianCwoqcjQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        const url = '<?php echo "software/".$rows['file_path'];?>';

        let pdfDoc = null,
          pageNum = 1,
          pageIsRendering = false,
          pageNumIsPending = null;

        const scale = 1.0; // Adjust the scale factor here
        const canvas = document.querySelector('#pdf-render');
        const ctx = canvas.getContext('2d');

        const renderPage = num => {
          pageIsRendering = true;
          pdfDoc.getPage(num).then(page => {
            const viewport = page.getViewport({ scale });
            canvas.height = viewport.height;
            canvas.width = viewport.width;
            const renderCtx = {
              canvasContext: ctx,
              viewport
            };
            page.render(renderCtx).promise.then(() => {
              pageIsRendering = false;
              if (pageNumIsPending !== null) {
                renderPage(pageNumIsPending);
                pageNumIsPending = null;
              }
            });
            document.querySelector('#page-num').textContent = num;
          });
        };

        const queueRenderPage = num => {
          if (pageIsRendering) {
            pageNumIsPending = num;
          } else {
            renderPage(num);
          }
        };

        const showPrevPage = () => {
          if (pageNum <= 1) {
            return;
          }
          pageNum--;
          queueRenderPage(pageNum);
        };

        const showNextPage = () => {
          if (pageNum >= pdfDoc.numPages) {
            return;
          }
          pageNum++;
          queueRenderPage(pageNum);
        };

        pdfjsLib.getDocument(url).promise.then(pdfDoc_ => {
          pdfDoc = pdfDoc_;
          document.querySelector('#page-count').textContent = pdfDoc.numPages;
          renderPage(pageNum);
        }).catch(err => {
          const div = document.createElement('div');
          div.className = 'error';
          div.appendChild(document.createTextNode(err.message));
          document.querySelector('body').insertBefore(div, canvas);
          document.querySelector('.top-bar').style.display = 'none';
        });

        document.querySelector('#prev-page').addEventListener('click', showPrevPage);
        document.querySelector('#next-page').addEventListener('click', showNextPage);

    </script>
  </body>
</html>



        <!-- <!DOCTYPE html> 
            <html> 
            
            <head> 
                <title>PDF in HTML</title> 
                <style>
                    body, html {
                        height: 100%;
                        margin: 0;
                        overflow: hidden; /* Prevent scrollbars */
                    }

                    object {
                        width: 100%;
                        height: 100vh;
                    }
                </style>
            </head> 
            <script>
                // Disable right-click context menu
                document.addEventListener('contextmenu', function (e) {
                    e.preventDefault();
                });

                // Disable keyboard shortcuts for save (Ctrl+S or Command+S)
                window.addEventListener('keydown', function (e) {
                    if ((e.ctrlKey || e.metaKey) && e.keyCode === 83) {
                        e.preventDefault();
                        alert("Downloading is disabled for this document.");
                    }
                });
            </script>
            <body> 
                <center> 
                    
                    <object data= 
                    "<?php //echo "software/".$rows['file_path']?>" 
                            width="90%"
                            height="100%"> 
                    </object>  -->
                    <!-- <object data="<?php echo "software/".$rows['file_path']?>" width="90%" height="100%" type="application/pdf" 
                            allow="fullscreen=false, print=false, download=false">
                    </object>  -->
                <!-- </center> 
            </body> 
            
            </html> --> 
            <!-- <!DOCTYPE html>  -->
<!-- <html> 

<head> 
	<title>PDF in HTML</title> 
</head> 

<body> 
	<center> 
		<h1 style="color: green">GeeksforGeeks</h1> 
		<h3>Embedding the PDF file Using Iframe Tag</h3> 
		<iframe src= 
"<?php //echo "software/".$rows['file_path']?>"
				width="800"
				height="500"> 
		</iframe> 
	</center> 
</body> 

</html> -->


    <?php
    }else{
        ?>
        <script>
                alert("Invalid Input ! please fill the form properly");
                window.location.href = "re_evalucation_reprint_application_view_scanned.php";
        </script>
        <?php
    }


}else{
    $sql="SELECT * FROM `exam_copy_view` WHERE sno='".$_POST['appno']."' and bank_trans_no='".$_POST['bankrefno']."' and exam_roll_no='".$_POST['rollno']."'";

    $res=mysqli_query($db,$sql);

    if(mysqli_num_rows($res)>0){
        $rows=mysqli_fetch_assoc($res);  

        $appno=$_POST['appno'];
        $bank_reference_no=$_POST['bankrefno'];
        
        $_POST['exam_roll_no']=$_POST['rollno'];
        $_POST['result_course']=$rows['course'];
        $_POST['mobile_no']=$rows['mobile_no'];
        
        
        if(isset($_POST['exam_roll_no'])){
            $sql = 'SELECT `exam_student_info`.`sno` as id,`exam_student_info`.`student_name`,`exam_student_info`.`student_info_sno`,`exam_student_info`.`exam_roll_no`,`exam_student_info`.`dob`,`exam_student_info`.`uin_no`,`exam_student_info`.`course_name`,`student_info`.`father_name`,`student_info`.`mother_name`,`student_info`.`photo_id` FROM `exam_student_info` LEFT JOIN `student_info` ON `exam_student_info`.student_info_sno = `student_info`.sno where `exam_student_info`.`exam_roll_no` = "'.$_POST['exam_roll_no'].'" AND `exam_student_info`.`course_name` = "'.$_POST['result_course'].'" AND `exam_student_info`.`mobile_no` = "'.$_POST['mobile_no'].'"';
                
            //$sql = 'SELECT `exam_student_info`.`sno` as id,`exam_student_info`.`student_name`,`exam_student_info`.`student_info_sno`,`exam_student_info`.`exam_roll_no`,`exam_student_info`.`dob`,`exam_student_info`.`uin_no`,`exam_student_info`.`course_name`,`student_info`.`father_name`,`student_info`.`mother_name`,`student_info`.`photo_id` FROM `exam_student_info` LEFT JOIN `student_info` ON `exam_student_info`.student_info_sno = `student_info`.sno where `exam_student_info`.`exam_roll_no` = "'.$_POST['exam_roll_no'].'"';
            
        ?>
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
            
            <title>Print Answer Sheet View</title>
        
            <!-- css  -->
            <style>
            body {
                font-family: "Roboto", sans-serif;
                font-size: .8rem;
                margin:5px!important;
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
                font-size: .8rem !important;
            }
            td{
                font-size: .8rem !important;
            }
            th{
                font-size: .8rem !important;
            }
                @media print {
                    
                    td{
                        font-size: 15px!important;
                        padding: 5px!important;
                        }
                    th{
                        
                        font-size: 15px!important;
                        padding: 5px!important;
                    }
                    .watermark {
                        color: #ececec; 
                        opacity: 0.2 !important;
                        top: 30% !important;
                        left: 10% !important;
                        font-size: 3rem; 
                    }
                    table td{
                    border:1px solid black!important;
                    }
                    .abc{
                        border:1px solid black!important;
                    }
                    
                    .marksheet-container {
                        width: 100%;
                        height: 100%;
                        margin: 15px;
                        /* Ensure each container starts on a new page */
                    }
                    .printButton {
                        display: none;
                    }
                    #overlays1{
                    width:60%!important;
                    margin-bottom:!important;
                    filter:grayscale(100%);
                    margin-top:20px!important;
                }
                    
                }
                
                .look{
                    padding:3px!important;
                    margin:0px!important;
                    font-size:11px;
                }
                    
                
            
                @page{
                size: A4;
                margin:10px;
                margin-right:25px!important;
                }
                .watermark {
                position: absolute;
                top: 50%;
                left: 20%;
                opacity: 0.8;
                z-index: -100;
                color: #aeabab ;
                font-size: 6.1rem;
                transform: rotate(-45deg);
                font-weight: normal;
                user-select: none;
                }
                
        
                .merge_column1 {
                    position: absolute;
                    top: 2%;
                    left: 50%;
                    -ms-transform: translate(-50%, -50%);
                    transform: translate(-50%, -50%);
                    background-color: white;
                    padding-top: 0.1rem; padding-inline:0.1rem;
                    /*padding-left : 20px;
                    padding-right : 20px;*/
                }
                .look{
                    padding-left:10px!important;
                }
                table td{
                    border:1px solid black;
                }
                .abc{
                    border:1px solid black;
                }
                #overlays1{
                    width:40%;
                    margin-top:200px;
                    margin-right:50px!important;
                    filter:grayscale(100%);
                    
                }
            
                #main{
                    margin:10px!important;
                    padding:5px;
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
            <?php
                //echo $sql;
                $result =mysqli_query($erp_link,$sql);
                if(mysqli_num_rows($result)>0){
                    $student_exists = 1;
                }
                else{
                    $student_exists = 0;
                }
                if($student_exists==1){
                $i=1;
                while($row=mysqli_fetch_assoc($result)){
                    echo '';
            ?>
        
        <body class="w-100 m-auto" id="main">
        <div class="row">
            <div class="col-12 text-center">
                <a href="answer_sheet_reevaluation.php" class="btn btn-primary printButton">Back</a>
                <div class="btn btn-primary printButton" onclick="window.print();">Click Here to Print</div>
        
            </div>
        </div>
        
            
                <!--<div style="text-align:center">
                    <button id="printButton" onclick="printAndRemoveButton()" class=" btn btn-danger btn-sm text-center" >Print</button>
                    </div>
        
                <div class="" style="display:flex ; justify-content: center ;">
                    <button class="btn btn-secondary btn-print" style="width: 5%;" onclick="print()">Print</button>
                    </div>-->
            <img src="images/kni_logo.png"  id="overlays" style=" z-index:-2;opacity:0.0;position: absolute;top: 50%;left: 50%;-ms-transform: translate(-50%, -50%);transform: translate(-50%, -50%); width:30%;" alt="overlay image" >
            <img src="images/logo_bg.png"  id="overlays1" style=" z-index:0;opacity:0.15;position: absolute;top: 40%;left: 50%;-ms-transform: translate(-50%, -50%);transform: translate(-50%, -50%); width:30%; " alt="overlay image" >
            <div  style="">
                <div class="container-fluid">
                    
                    <table width="100%" style="margin:0px;">
                    <tr>
                        <th width="12%" rowspan="2"><img style="padding:15px; height:65px; width:65px; " src="images/kni_logo.png" alt="logo" class="img-fluid d-block m-auto" /> </th>
                        <th width="88%">
                            <h4 class="" style="text-align: center; margin:0px; " ><span style="font-size:17px;white-space:nowrap;" class="head-name"><b>Kamla Nehru Institute Of Physical & Social Sciences,Sultanpur, Uttar Pradesh</b></span> <br>An Autonomous Institute And Accredited "A" Grade by NAAC<br><span style="font-size:14px;">(Affiliated to Dr. Rammanohar Lohia Avadh University, Ayodhya U.P.)</span></h4>
                        </th>
                    </tr>
                </table>
                
                    <table class="table table-borderless" width="100%" >
                        <tr class="abc">
                            <th class="text-center abc" colspan="5"><span style="font-size:1rem;">ONLINE APPLICATION FOR INSPECTION OF ANSWER BOOK 2023-2024</span></th>
                        </tr>
                        <tr class="abc">
                            <th class="abc">APPLICATON NO.</th>
                            <th class="abc"><?php echo $appno;?></th>
                            
                        </tr>
                        <tr class="abc">
                            <th class="abc">Bank Reference Number.</th>
                            <th class="abc"><?php echo $bank_reference_no;?></th>
                        </tr>
                        <tr class="abc">
                            <th width="20%" class="look abc ">Roll NO.</th>
                            <th width="30%" class="look abc"><?php echo $row['exam_roll_no']; ?><?php //echo '--'.$row['dob']; ?></th >	
                        </tr>
                        <tr class="abc">
                            <th width="20%" class="look abc">Name </th>
                            <th width="30%" class="look abc"><?php echo strtoupper($row['student_name']);?> <?php //echo '--'.$row['id']; ?>	</th >
                        </tr>
                        <tr class="abc">
                            <th width="20%" class="look abc">Mobile Number </th>
                            <th width="30%" class="look abc"><?php echo $_POST['mobile_no'];?> <?php //echo '--'.$row['id']; ?>	</th >
                        </tr>
                        <tr class="abc">
                            <th class="look abc">Father's Name</th>
                            <th class="look abc"><?php echo strtoupper($row['father_name']); ?></th >
                        </tr>
                        <tr class="abc">
                            <th class="look abc">Course</th>
                            <th class="look abc"><?php
                                    $sql_class = 'select * from class_detail where sno = "'.$row['course_name'].'"';
                                    $row_class = mysqli_fetch_assoc(mysqli_query($erp_link,$sql_class));
                                    echo $row_class['class_description']; 
                                ?>
                            </th >
                        </tr>
                        <!-- <tr class="abc">
                            <th class="look abc">Mother's Name</th>
                            <th class="look abc"><?php //echo strtoupper($row['mother_name']); ?></th >
                        </tr> -->
                        <tr class="abc">
                            <th class="look abc">UIN NO.</th>
                            <th class="look abc"><?php echo $row['uin_no']; ?></th >
                        </tr>
                        <tr class="abc">
                            <th class="look abc">College</th>
                            <th colspan="3" class="look abc">K.N.I.P.S.S. Sultanpur</th >
                        
                        </tr>
                    </table>	
                    <div class=" text-center" style="font-size:1.1rem">PAPER SELECTED FOR INSPECTION</div>
                        <table class="table text-center" style="border:1px solid black; ">
                            
                            <?php
                                $paperCodeArray = array();
                                $sql2 = 'SELECT * FROM exam_student_paper_info WHERE exam_student_info_sno = "'.$row['id'].'" and paper_code="'.$rows['papercode'].'"';
                                $result2 = mysqli_query($erp_link, $sql2);
                                $i=1;
                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                    if (!in_array($row2['paper_code'], $paperCodeArray)) {
                                        $paperCodeArray[] = $row2['paper_code'];
                                        
                                        if($row2['type_status']==1){
                                            $sql_subject = 'select * from add_subject where sno = "'.$row2['subject_id'].'"';
                                        }else{
                                            $sql_subject = 'select * from add_subject2 where sno = "'.$row2['subject_id'].'"';
                                        }
                                        $row_subject = mysqli_fetch_assoc(mysqli_query($erp_link,$sql_subject));
                                        
                                        ?>
                            <tr>    
                                <th  width="30%"  class="abc">SUBJECT</th>
                                <td><?php echo $row_subject['subject']; ?></td>
                            </tr>
                            <tr>
                                
                                <th  width="30%"  class="abc">PAPER CODE</th>
                                <td><?php echo $row2['paper_code']; ?></td>
                            </tr>
                            <tr>
                                
                                <th width="30%"  class="abc">PAPER TITLE</th>
                                <td><?php echo $row2['title_of_paper']; ?></td>
                            </tr>
                                <?php
                                            
                                        }
                                        $i++;
                                    }
                                ?>
                        </table>
                    </div>
                </div>
            <div>
        </body>
        </html>
        <?php
            }			
        }else{
            
            
            ?>
        
        <?php
        }
        }
    }else{
        ?>
        <script>
                alert("Invalid Input ! please fill the form properly");
                window.location.href = "re_evalucation_reprint_application_view_scanned.php";
        </script>
        <?php

    }



}

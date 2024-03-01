<?php
set_time_limit(0);
//session_cache_limiter('nocache');
//session_start();
include("settings.php");
include("exam_crosslist_marksheet_functions.php");
 page_header();
$response=1;
$msg='';
// print_r($_POST);
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
<?php
// print_r($_POST);

echo $sql="SELECT * FROM `exam_copy_view` WHERE sno = '{$_POST['appno']}' and payment_status='Success'";

$res=mysqli_query($db,$sql);
if(mysqli_num_rows($res)>0){
    $rows=mysqli_fetch_assoc($res);

    $sql = 'SELECT `exam_student_info`.`sno` as id,`exam_student_info`.`student_name`,`exam_student_info`.`student_info_sno`,`exam_student_info`.`mobile_no`,`exam_student_info`.`exam_roll_no`,`exam_student_info`.`dob`,`exam_student_info`.`uin_no`,`exam_student_info`.`course_name`,`student_info`.`father_name`,`student_info`.`mother_name`,`student_info`.`photo_id` FROM `exam_student_info` LEFT JOIN `student_info` ON `exam_student_info`.student_info_sno = `student_info`.sno where `exam_student_info`.`exam_roll_no` = "'.$rows['exam_roll_no'].'" AND `exam_student_info`.`course_name` = "'.$rows['course'].'" AND `exam_student_info`.`mobile_no` = "'.$rows['mobile_no'].'"';
    
    $result =mysqli_query($erp_link,$sql);
    $row=mysqli_fetch_assoc($result);
    // print_r($row);
    
    
    ?>
    <div class="d-flex justify-content-center " style="gap:1rem;">
    <ul>
      <li><a  href="challenge_evaluation_instruction.php" >Instructions</a></li>
      <li><a href="challenge_notification.php">Notification</a></li>
      <li><a href="challenge_evaluation_reg.php" class="active">Click To Registration</a></li>
      <li><a href="#about">Reprint Application</a></li>
      <li><a href="#about">View Scanned Copy</a></li>
      <li><a href="#about">Check Payment Status</a></li>
      <li><a href="index.php">Go to Home</a></li>
    </ul>
    <div id="container" width="70%">
        <div class="row ">
            <section class="content-header">
                <h1 style="color: #000!important;">Challenge to Evaluation of Answer Book</h1> <br>
            </section>
            <section class="content-header" style="margin-top: -25px">
                <h3 style="font-size: 20px; font-weight: 600;"></h3>
            </section>
            
            
    <!---Student info section-------------------------------------------------------------------------------------------------------------------------------->
                
            <form action="confirm_challenge_answer_sheet_view.php" id="examForm" class="wufoo leftLabel page1" name="admission_newadmission" enctype="multipart/form-data" method="post" onSubmit="" >
                <input type="hidden" name="rollno" value="<?php echo $_POST['rollno'];?>">
                <input type="hidden" name="course" value="<?php echo $rows['course'];?>">
                <input type="hidden" name="mobno" value="<?php echo $row['mobile_no'];?>">
                <input type="hidden" name="appno" value="<?php echo $_POST['appno'];?>">
                <input type="hidden" name="papercode" value="<?php echo $rows['papercode'];?>">
                    <?php //echo $msg; ?>	
                    <div style=" width:95%;">
                        <div class="text-start" style="font-size:1.5rem;">Student Registration</div>
                        <div class=" card card-body col-md-12 my-auto mx-auto" style="border-top-color: #d2d6de; background-color:whitesmoke;" >
                        <div class="row">
                            <table>
                                <tr>
                                    <td style="width: 10%;">Roll No.</td>
                                    <td style="width: 15%;"><?php echo $_POST['rollno'];?></td>
                                    <!-- Assuming $row contains the data fetched from the database -->
                                    <td style="width: 10%;">Name</td>
                                    <td style="width: 25%;"><?php echo strtoupper($row['student_name']);?></td>
                                    <td style="width: 20%;">Father's Name</td>
                                    <td style="width: 30%;"><?php echo strtoupper($row['father_name']); ?></td>
                                </tr>
    
                                <tr>
                                    
                                    <td>Mobile No.</td>
                                    <td><?php echo $row['mobile_no']; ?></td>
                                    <td>Course</td>
                                    <td colspan="4">
                                    <?php
                                    $sql_class = 'select * from class_detail where sno = "'.$row['course_name'].'"';
                                    $row_class = mysqli_fetch_assoc(mysqli_query($erp_link,$sql_class));
                                    echo $row_class['class_description']; 
                                    ?>
                                    </td>
                                </tr>
    
    
                                
                                
                                    
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
                                        <td    class="abc">SUBJECT</td>
                                        <td><?php echo $row_subject['subject']; ?></td>
                                        <td   class="abc">PAPER TITLE</td>
                                        <td><?php echo $row2['title_of_paper']; ?></td>
                                        <td    class="abc">PAPER CODE</td>
                                        <td><?php echo $row2['paper_code']; ?></td>
                                    </tr>
                                        <?php
                                                    
                                                }
                                                $i++;
                                            }
                                        ?>
    
                                <tr>
                                    <td colspan="6"><textarea name="remark" id="remark" cols="50"  rows="5" class="form-control" placeholder="Your Message (Optional)"></textarea></td>
                                </tr>
                                <tr>
                                    <td colspan="6">
                                        <div style="display:flex;justify-content:flex-start;align-items:center;">
    
                                            <input type="checkbox" name="check" id="" style="margin-left:1rem;" required> &nbsp;&nbsp;&nbsp;&nbsp;<div style="">Check here to indicate that you have read and agree to the Terms and Conditions</div>
                                        </div>
                                        </td>
                                </tr>
                            </table>
    
                        </div>
                        <div class="row mt-1">
                            <div  style="font-size:1.3rem;text-align:center;color:red;"0>Total Payable Amount is 250 &#8377; Only</div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-md-12">	
                                <label></label>						
                                <center><button name = "submit" value="save" target="_blank" class="btn btn-primary mt-1" >Confirm & Proceed to Pay</button></center><br>
                            </div>
                            <div class="col-md-4">	
                            </div>
                        </div>
                    </div>
                    
                </div>     
                    </div>
                </div>
    
                
            </form>
        </div>
    </div> 
    </div>
    
    
    
    </body>
    </html>
    
    
    <?php 
}else{
    ?>
    <script>
        alert("Invalid Application Number !!! ");
        window.location.href = "challenge_evaluation_reg.php";
    </script>
    <?php
}


	page_footer();
	ob_end_flush();
?>


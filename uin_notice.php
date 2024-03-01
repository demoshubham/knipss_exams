<?php
set_time_limit(0);
session_cache_limiter('nocache');
session_start();
include("settings.php");
logvalidate($_SESSION['username'], $_SERVER['SCRIPT_FILENAME']);
page_header();
$response=1;
$msg='';
if($_SESSION['username']!='sadmin'){
	$_POST['stu_id'] = $_SESSION['username'];
}
?>

<?php



    if(isset($_POST['submit'])){
        if(isset($_POST['edit']) && $_POST['edit'] != ''){
            $sql = 'update uin_report set 
                    report = "'.$_POST['report'].'" 
                     where sno = '.$_POST['edit'];
            //echo $sql;
            mysqli_query($conn, $sql);
            if(mysqli_errno($conn)){
                echo "Updation failed".mysqli_errno($conn).mysqli_error($conn);
            }
            else{
                //echo "Successfully updated";
            }
        }
        else{
            //inserting value to database
            $sql = 'insert into uin_report(report)  values("'.$_POST['report'].'")';
            //echo $sql;
            mysqli_query($conn,$sql);
            if(mysqli_errno($conn)){
                echo "Insertion failed".mysqli_errno($conn).mysqli_error($conn);
            }
            else{
              //  echo "Data inserted";
            }
        }
        
    
    }
    if(isset($_GET['del'])){
        $sql = 'delete from uin_report where sno = '.$_GET['del'];
        echo $sql;
        $res = mysqli_query($conn,$sql);
        if(mysqli_errno($conn)){
            echo "Deletion failed:".mysqli_error($conn);
        }
        else{
            echo "<h2>successfully deleted</h2>";
        }
    }
    
    if(isset($_GET['edit'])){
        $sql = 'select * from uin_report where sno = '.$_GET['edit'];
        $qry = mysqli_query($conn, $sql);
        $res = mysqli_fetch_assoc($qry);
    }
    



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>

    <!-- bootstrap  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- css -->
    <style>
        .cont{
            height:50vh;
            display:flex;
            justify-content:center;
            align-items:center;
        }
        form{
            padding:30px;
            border-radius:10px;
            background-color:aliceblue;
            width:400px;
            box-shadow:4px 3px 20px #222;
        }
    </style>

</head>
<body>
    <div class="cont">
        <form method="post" action="">
        <div class="form-group">
            <label for="report" class="lead">Enter Report here</label>
            <input type="text" name="report" class="form-control" value="<?php echo isset($_GET['edit'])? $res['report']: '' ?>" id=""  placeholder="Enter Report">
            
        </div>
        
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
        
    <div class="container">
		<table class='table'>
			<tr>
				<th>sno</th>
				<th>report</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
			<?php 
				$id = 1;
				$sql = 'select * from uin_report';
				$result = mysqli_query($conn, $sql);
				print_r($result);
				if($result){
					while($row = mysqli_fetch_assoc($result)){
						echo '<tr>
							<td>'.$id++.'</td>
							<td>'.$row['report'].'</td>
							<td><a href="uin_report.php?edit='.$row['sno'].'"> Edit</a></td>
							<td><a href="uin_report.php?del='.$row['sno'].'"> Del</a></td>
						</tr>';
					}
				}
				
			
			
			?>
		
		</table>
	</div>
	


    <!-- bootstrap script -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
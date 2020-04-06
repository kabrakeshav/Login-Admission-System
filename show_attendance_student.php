<?php 
session_start();
if(!isset($_SESSION["sess_user"]) && !isset($_SESSION['id']) && !isset($_SESSION['password'])){
	header("location:login_admin.php");
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>SHOW ATTENDANCE STUDENT</title>
		<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
        <link href='custom.css' rel='stylesheet' type='text/css'>

        <style type="text/css">
            body{
                background: lightpink;
            }
        </style>
	</head>


	<body>
		<form action="show_attendance_student.php" method="post">
		    <b>Date : </b>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;<input style="width: 300px; height: 40px;" type="date" name="dt" value="<?php echo date('Y-m-d'); ?>"><br><br>
		    <button type="submit" value="Attend" name="Attend" class="btn btn-primary">Show Attendance</button>
		</form>


	<?php
		if(isset($_POST['Attend'])){
			$xid = $_SESSION['id'];
			$xname = $_SESSION['sess_user'];
			$dt = $_POST['dt'];

	    	$con=mysqli_connect('localhost','root','') or die(mysqli_error());
	    	mysqli_select_db($con,'attendance') or die("cannot select DB");

	    	$query=mysqli_query($con, "SELECT * FROM attendance_info WHERE id=$xid AND name='$xname' AND attend_date='$dt'");
	    	$q=mysqli_query($con, "SELECT * FROM attendance_info WHERE id=$xid AND name='$xname' AND attend_date='$dt'");
	        $numrows=mysqli_num_rows($query);

	        if($numrows!=0)
	        {
	        	$rows_temp=mysqli_fetch_assoc($q);
				echo "<table align='center' border='2px' style='line-height=60px;'>";
					echo "<tr>";
						echo "<br><br> <b>NAME :</b>&nbsp;";echo $_SESSION['sess_user'];
						echo "&emsp;<b>*******</b> &ensp;<b>ID :</b>&nbsp;";echo $_SESSION['id'];
						echo "<br><br><b>Branch :</b>&nbsp;";echo $rows_temp['branch'];
						echo "&emsp;<b>*******</b> &ensp;<b>Sem :</b>&nbsp;";echo $rows_temp['sem'];
						echo "<br><b> Date :</b> $dt";
					echo "</tr>";
					echo "<tr>";
						echo "<th>Lecture Number</th>";
						echo "<th>Lecturer Name</th>";
						echo "<th>Subject Name</th>";
					echo "</tr>";
					while($rows=mysqli_fetch_assoc($query))
					{
						echo "<tr>";
							echo "<td>"; echo $rows['lecture_num']; echo"</td>";
							echo "<td>";echo $rows['lecturer_name'];echo"</td>";
							echo "<td>";echo $rows['subject_name'];echo"</td>";
							echo "<td>";echo $rows['topic_covered'];echo"</td>";
						echo "</tr>";
					}
				echo "</table>";
			}else{
				echo "No Records found !!!";
			}
		}
		?>

	</body>
</html>
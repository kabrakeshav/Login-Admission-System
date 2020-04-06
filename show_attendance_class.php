<?php 
session_start();
if(!isset($_SESSION["sess_user"]) && !isset($_SESSION['id']) && !isset($_SESSION['password'])){
	header("location:login_admin.php");
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>SHOW ATTENDANCE</title>
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
		<form action="show_attendance_class.php" method="post">
        <input type="submit" name="back_button" value="Back">
      </form>
      <?php
          if(isset($_POST["back_button"])){
            if($_SESSION['designation']=='admin')
                header("Location: member_admin.php");
            if($_SESSION['designation']=='faculty')
                header("Location: member_faculty.php");
          }
      ?>

		
		<form action="show_attendance_class.php" method="post">
			<b>Course Selected : </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		      <select style="width: 300px; height: 40px;" name="course">
		        <option value="btech">B.Tech.</option>
		        <option value="other">Other</option>
		        <option value="other">Other</option>
		    </select>
		    <br><br>
		    <b>Branch : </b>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;&ensp;&nbsp;
		    <select style="width: 300px; height: 40px;" name="branch">
		        <option value="a">A</option>
		        <option value="b">B</option>
		        <option value="c">C</option>
		        <option value="cse">Computer Science Enginnering</option>
		        <option value="me">Mechanical Enginnering</option>
		        <option value="ce">Civil Enginnering</option>
		        <option value="ee">Electrical Enginnering</option>
		    </select>
		    <br><br>
		    <b>Semester of Studying : </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		    <select style="width: 300px; height: 40px;" name="sem">
		        <option value="1">I</option>
		        <option value="2">II</option>
		        <option value="3">III</option>
		        <option value="4">IV</option>
		        <option value="5">V</option>
		        <option value="6">VI</option>
		        <option value="7">VII</option>
		        <option value="8">VIII</option>
		    </select>
		    <br><br>
		    <b>Date : </b>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;<input style="width: 300px; height: 40px;" type="date" name="dt" value="<?php echo date('Y-m-d'); ?>"><br><br>
		    <b>Lecture No. : </b>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;<input type="number" name="lect_num" style="width: 300px; height: 40px;" min="1" max="6" placeholder="Enter Lecture Number" onKeyDown="return false"><br><br>
		    <button type="submit" value="submit" name="submit" class="btn btn-primary">Show Attendance</button>
		</form>


	<?php
    	if(isset($_POST['submit'])){
    		$con=mysqli_connect('localhost','root','') or die(mysqli_error());
			mysqli_select_db($con,'attendance') or die("cannot select DB");

			$xbranch = $_POST['branch'];
			$xsem = $_POST['sem'];
			$dt = $_POST['dt'];
			$lect_no = $_POST['lect_num'];
			if($lect_no == '')
				$lect_no = 1;

			$query=mysqli_query($con, "SELECT * FROM attendance_info WHERE branch='$xbranch' AND sem=$xsem AND lecture_num=$lect_no AND attend_date='$dt'");
			$q=mysqli_query($con, "SELECT * FROM attendance_info WHERE branch='$xbranch' AND sem=$xsem AND lecture_num=$lect_no AND attend_date='$dt'");
			$numrows=mysqli_num_rows($query);

			if($numrows!=0)
	        {
	        	$rows_temp=mysqli_fetch_assoc($q);
				echo "<table align='center' border='2px' style='line-height=60px;'>";
					echo "<tr>";
						echo "<br><br><b>Branch :</b> $xbranch  &ensp; <b>*******</b> &ensp;<b>Sem :</b> $xsem";
						echo "<br><b> Lecture Number :</b> $lect_no";
						echo "<br><b> Lecturer Name :</b>&nbsp;";echo $rows_temp['lecturer_name'];
						echo "<br><b> Subject Name :</b>&nbsp;";echo $rows_temp['subject_name'];
						echo "<br><b> Topic Covered :</b>&nbsp;";echo $rows_temp['topic_covered'];
						echo "<br><b> Date :</b> $dt";
					echo "</tr>";
					echo "<tr>";
						echo "<th>ID</th>";
						echo "<th>Name of Present Student(s)</th>";
					echo "</tr>";
					while($rows=mysqli_fetch_assoc($query))
					{
						echo "<tr>";
							echo "<td>"; echo $rows['id']; echo"</td>";
							echo "<td>";echo $rows['name'];echo"</td>";
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
<?php 
session_start();
if(!isset($_SESSION["sess_user"]) && !isset($_SESSION['id']) && !isset($_SESSION['password'])){
	header("location:login_admin.php");
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>WRITE ATTENDANCE</title>
		<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
        <link href='custom.css' rel='stylesheet' type='text/css'>

        <style type="text/css">
            body{
                background: lightpink;
            }
            input.Checkbox { 
	            width: 50px; 
	            height: 20px; 
        } 
        </style>
	</head>


	<body>
		<a href="member_faculty.php">Back</a>

		<form action="write_attendance.php" method="post">
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
		    <b>Lecturer Name : </b>&emsp;&emsp;&emsp;&emsp;&ensp;&nbsp;<input type="text" name="lect_name" style="width: 300px; height: 40px;" placeholder="Enter Lecturer Name" value="<?php echo($_SESSION['sess_user'])?>" disabled><br><br>
		    <b>Subject Name : </b>&emsp;&emsp;&emsp;&emsp;&ensp;&nbsp;<input type="text" name="sub_name" style="width: 300px; height: 40px;" placeholder="Enter Subject Name"><br><br>
		    <b>Topic Covered : </b>&emsp;&emsp;&emsp;&emsp;&ensp;&nbsp;<input type="text" name="topic" style="width: 300px; height: 40px;" placeholder="Topic Covered in Lecture"><br><br>
		    <button type="submit" value="submit" name="submit" class="btn btn-primary">Write Attendance</button>
		</form>

    <?php
    if(isset($_POST['submit'])){
    	$con=mysqli_connect('localhost','root','') or die(mysqli_error());
		mysqli_select_db($con,'student_register') or die("cannot select DB");

		$xbranch = $_POST['branch'];
		$xsem = $_POST['sem'];
		$dt = $_POST['dt'];
		$lect_no = $_POST['lect_num'];
		$lect_name = $_SESSION['sess_user'];
		$sub_name = $_POST['sub_name'];
		$topic = $_POST['topic'];

		if(!empty($lect_no) && !empty($lect_name)){
			$query=mysqli_query($con, "SELECT * FROM student_info WHERE branch='$xbranch' AND sem=$xsem");
			$numrows=mysqli_num_rows($query);

			if($numrows!=0)
	        {
	        	echo "<form action='write_attendance.php' method='post'>";
				echo "<table align='center' border='2px' style='line-height=60px;'>";
				echo "<tr>";
					echo "<br><br><b>Branch :</b> $xbranch  &ensp; <b>*******</b> &ensp;<b>Sem :</b> $xsem";
					echo "<br><b> Lecture Number :</b> $lect_no";
					echo "<br><b> Lecturer Name :</b> $lect_name";
					echo "<br><b> Subject Name :</b> $sub_name";
					echo "<br><b> Topic Covered :</b> $topic";
					echo "<br><b> Date :</b> $dt";
				echo "</tr>";
				echo "<tr>";
					echo "<th>ID</th>";
					echo "<th>First Name</th>";
					echo "<th>Last Name</th>";
					echo "<th> Present </th>";
				echo "</tr>";
					while($rows=mysqli_fetch_assoc($query)){
						echo "<tr>";
							echo "<td>";echo $rows['id'];echo"</td>";
							echo "<td>";echo $rows['fname'];echo"</td>";
							echo "<td>";echo $rows['lname'];echo"</td>";
							$xx = $rows['id']."  ".$rows['fname']."  ".$rows['lname']."  ".$xsem."  ".$xbranch."  ".$lect_no."  ".$lect_name."  ".$sub_name."  ".$topic."  ".$dt;
							echo "<td>";echo "<input class='Checkbox' type='checkbox' value='$xx' name='checkbox_attendance[]' >";echo "</td>";
						echo "</tr>";
					}
					echo "<td> <input type='submit' name='Attend' value='Attend' > </td>";
				echo "</table>";
				echo "</form>";

			}else{
				echo "No Student found !!!";
			}
		}
	}

    	if(isset($_POST['Attend'])){
    		$conn=mysqli_connect('localhost','root','') or die(mysqli_error());
			mysqli_select_db($conn,'attendance') or die("cannot select DB");

			if(!empty($_POST['checkbox_attendance'])){
    			foreach ($_POST['checkbox_attendance'] as $check) {
    				$s_temp = explode("  ", $check);
    				$lecture_temp = $s_temp[5];
    				$ddt_temp = $s_temp[9];
    				break;
    			}
    		}

    		$l = (int)$lecture_temp;
			$q1 = mysqli_query($conn, "SELECT * FROM attendance_info WHERE lecture_num=$l AND attend_date='$ddt_temp'");
			$numrows=mysqli_num_rows($q1);

			if($numrows==0)
			{

	    		if(!empty($_POST['checkbox_attendance'])){
	    			foreach ($_POST['checkbox_attendance'] as $check) {
	    				// echo $check;
	    				$str_arr = explode("  ", $check);
	    				$idd = $str_arr[0];
	    				$ffname = $str_arr[1];
	    				$llname = $str_arr[2];
	    				$semm = $str_arr[3];
	    				$branchh = $str_arr[4];
	    				$lecture = $str_arr[5];
	    				$lecturer = $str_arr[6];
	    				$subject = $str_arr[7];
	    				$topic = $str_arr[8];
	    				$ddt = $str_arr[9];

	    				$nname = $ffname." ".$llname;


	    				$q = "INSERT INTO attendance_info(id, name, branch, sem, lecture_num, lecturer_name, subject_name,topic_covered, attend_date) VALUES ('$idd','$nname','$branchh','$semm','$lecture','$lecturer','$subject','$topic', '$ddt')";
	    				$status = mysqli_query($conn, $q);

			    	}
	    			mysqli_close($conn);
	    			if($status == 0){
				    	echo "Problem while writting in Database... Try again...";
				    }
				    if($status == 1){
				        echo "Attendance written succesfully ...";
					}
				}else{
					echo "No student was selected ...";
				}
			}else{
				echo "<br> Attendance for this Date and Lecture already written ...";
			}
    	}

    ?>	    
	</body>
</html>
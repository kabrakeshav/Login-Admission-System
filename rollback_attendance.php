<?php 
session_start();
if(!isset($_SESSION["sess_user"]) && !isset($_SESSION['id']) && !isset($_SESSION['designation'])){
    header("location:login_admin.php");
}
?>


<html>
    <head>
        <title>ROLL-BACK ATTENDANCE</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
        <link href='custom.css' rel='stylesheet' type='text/css'>

        <style>
          body{
            background: lightpink;
          }
    	</style>
    </head>

    <body>
    	<a href="member_faculty.php">Back</a>

    	<form action="rollback_attendance.php" method="post">
			<b>Course Selected : </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		      <select style="width: 300px; height: 40px;" name="course">
		        <option value="btech">B.Tech.</option>
		        <option value="other">Other</option>
		        <option value="other">Other</option>
		    </select>
		    <br><br>
		    <b>Branch : </b>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;&nbsp;&nbsp;&nbsp;
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
		    <b>Subject Name : </b>&emsp;&emsp;&emsp;&emsp;&ensp;&ensp;&nbsp;<input type="text" name="sub_name" style="width: 300px; height: 40px;" placeholder="Enter Subject Name"><br><br>
		    <button type="submit" value="submit" name="submit" class="btn btn-danger">Roll-Back Attendance</button>
		</form>


		<?php
			if(isset($_POST['submit'])){
	    		$con=mysqli_connect('localhost','root','') or die(mysqli_error());
				mysqli_select_db($con,'attendance') or die("cannot select DB");

				$xbranch = $_POST['branch'];
				$xsem = $_POST['sem'];
				$dt = $_POST['dt'];
				$lect_no = $_POST['lect_num'];
				$lecturer = $_SESSION['sess_user'];
				$subj_name = $_POST['sub_name'];

				$qq = "SELECT * FROM attendance_info WHERE attend_date='$dt' AND branch='$xbranch' AND sem=$xsem AND lecture_num=$lect_no AND lecturer_name='$lecturer' AND subject_name='$subj_name'";
				$check = mysqli_query($con, $qq);

				if(mysqli_num_rows($check) > 0) {

					$q = "DELETE FROM attendance_info WHERE attend_date='$dt' AND branch='$xbranch' AND sem=$xsem AND lecture_num=$lect_no AND lecturer_name='$lecturer' AND subject_name='$subj_name'";
					$status = mysqli_query($con, $q);

					if($status == 0){
				    	echo "Error... Try again...";
				    }
				    if($status == 1){
				        echo "Attendance Roll-Backed Succesfully ...";
					}
				}else{
					echo "No records were found !!!";
				}
			}
		?>

    </body>
</html>
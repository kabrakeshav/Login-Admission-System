<?php 
session_start();
if(!isset($_SESSION["sess_user"]) && !isset($_SESSION['id']) && !isset($_SESSION['password'])){
	header("location:login_admin.php");
}
?>

<!-- ---------------------------------------------------------------------------------------------- -->
<!DOCTYPE html>
<html>

	<head>
        <title>ADMIN PANEL</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
        <link href='custom.css' rel='stylesheet' type='text/css'>

        <style type="text/css">
            body{
                background: lightpink;
            }
            .avatar {
			    vertical-align: middle;
			    width: 40px;
			    height: 40px;
			    border-radius: 50%;
			    margin-left: 5px;
			    margin-right: 30px;
			}
			div.align-right {
			    text-align: right;
			    color:darkgreen;
			    font-size: 30px;
			}
        </style>
    </head>

	<body>
		<div id="container">
	        <img src="avatar.png" alt="Avatar" class="avatar" align="right">
	        <div class="align-right">
	    		<h2 style="margin-top: 30px;" title="Current Username"><?php $user=$_SESSION['sess_user']; echo "$user"?>
			</div>
		</div>
		<div class="align-right">
			<a href="logout.php" style="margin-right: 30px;" class="btn btn-danger">Logout</a>
		</div>

		<a href="change_password_admin.php">Change Your Password</a>
		<hr>
		<a href="add_admin.php">Add a new Admin</a><br>
		<a href="remove_admin.php">Remove an Admin</a><br>
		<hr>
		<a href="student_reg.php">Student Registration</a><br>
		<a href="faculty_reg.php">Faculty Registration</a>
		<hr>
		<a href="show_attendance_class.php">Show Attendance (of a class)</a>
		<hr>
		<a href="view_student.php">View Student(s)</a><br>
		<a href="view_faculty.php">View Faculty(s)</a>
		<hr>
		<a href="write_notice.php">Write a Notice</a><br>
		<a href="show_notice.php">Read Notices</a>

	</body>

</html>
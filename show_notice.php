<?php 
session_start();
if(!isset($_SESSION["sess_user"]) && !isset($_SESSION['id']) && !isset($_SESSION['password'])){
    header("location:login_admin.php");
}
?>

<html>
	<head>
			<title>WRITE NOTICE</title>
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
    <form action="show_notice.php" method="post">
    	<button type="submit" value="submit" name="submit" class="btn btn-primary">View Notices</button>
    </form>

    <?php
		if(isset($_POST['submit'])){
			$con = mysqli_connect('localhost', 'root');
        	mysqli_select_db($con, 'notices');

        	if(mysqli_connect_errno()){
          		$msg = "DB-Failed to load !<br>".mysqli_connect_errno();
        	}
        	$query=mysqli_query($con, "SELECT * FROM notice_board ORDER BY date DESC");
        	$numrows=mysqli_num_rows($query);

        	if($numrows!=0)
	        {
	        	echo "<table align='center' border='2px' style='line-height=60px;'>";
	        	echo "<tr>";
					echo "<th>ID of Post</th>";
					echo "<th>Subject</th>";
					echo "<th>Description</th>";
					echo "<th>Posted By (Author)</th>";
					echo "<th>Author ID</th>";
					echo "<th>Date of Posting</th>";
				echo "</tr>";
				while($rows=mysqli_fetch_assoc($query))
				{
					echo "<tr>";
						echo "<td>"; echo $rows['id']; echo"</td>";
						echo "<td>"; echo $rows['subject']; echo"</td>";
						echo "<td>"; echo $rows['description']; echo"</td>";
						echo "<td>"; echo $rows['author_name']; echo"</td>";
						echo "<td>"; echo $rows['author_id']; echo"</td>";
						echo "<td>"; echo $rows['date']; echo"</td>";
					echo "</tr>";
				}
	        	echo "</table>";
	        }
		}
	?>



</body>
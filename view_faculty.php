<?php 
session_start();
if(!isset($_SESSION["sess_user"]) && !isset($_SESSION['id']) && !isset($_SESSION['password'])){
	header("location:login_admin.php");
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>View Faculty</title>
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
		<a href="member_admin.php">Back</a><br><br>

		<form action="view_faculty.php" method="post">
			<b>Department : </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<select style="width: 300px; height: 40px;" name="dept">
	  			<option value="ash">Applied Science and Humanities</option>
	  			<option value="cse">Computer Science Enginnering</option>
	  			<option value="me">Mechanical Enginnering</option>
	  			<option value="ce">Civil Enginnering</option>
	  			<option value="ee">Electrical Enginnering</option>
			</select>
			<br><br>
			<b>Select which fields you want to see : </b><br>
				<input type="checkbox" name="id" value="id" onclick="return false" checked> ID &emsp;&emsp;&emsp;&ensp;
				<input type="checkbox" name="post_dept" value="post_dept"> Post in Department &emsp;&emsp;&emsp;&ensp;
				<input type="checkbox" name="qualification" value="qualification"> Highest Qualification &emsp;&emsp;&emsp;&ensp;
				<input type="checkbox" name="fname" value="fname"> First Name &emsp;
				<input type="checkbox" name="lname" value="lname"> Last Name &emsp;
				<input type="checkbox" name="father_name" value="father_name"> Father Name &emsp;
				<input type="checkbox" name="mother_name" value="mother_name"> Mother Name &emsp;
				<input type="checkbox" name="gender" value="gender"> Gender &emsp;
				<input type="checkbox" name="DOB" value="DOB"> DOB &emsp;
				<br>
				<input type="checkbox" name="address" value="address"> Address &emsp;
				<input type="checkbox" name="state" value="state"> State &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;&nbsp;
				<input type="checkbox" name="district" value="district"> District &emsp;&emsp;&ensp;&emsp;&emsp;&ensp;&emsp;&emsp;&ensp;&emsp;&emsp;&nbsp;
				<input type="checkbox" name="pin" value="pin"> PIN &emsp;&emsp;&emsp;&emsp;
				<input type="checkbox" name="mob_1" value="mob_1"> Mobile-1 &emsp;&ensp;
				<input type="checkbox" name="mob_2" value="mob_2"> Mobile-2 &emsp;&emsp;&emsp;
				<input type="checkbox" name="image" value="image"> Image Link

				<br><br>

			<button type="submit" value="submit" name="submit" class="btn btn-primary">See Details</button>
			<br><br>
			<hr><br>
		</form>


		<?php
			if(isset($_POST['submit'])){
				$con=mysqli_connect('localhost','root','') or die(mysqli_error());
	    		mysqli_select_db($con,'faculty_register') or die("cannot select DB");

	    		$xdept = $_POST['dept'];


				$id='';
				$post_dept='';
				$qualification='';
				$fname='';
				$lname='';
				$father_name='';
				$mother_name='';
				$gender='';
				$DOB='';
				$address='';
				$state='';
				$district='';
				$pin='';
				$mob_1='';
				$mob_2='';
				$image='';

				if(isset($_POST['id'])){
					$id = $_POST['id'];
				}
				if(isset($_POST['post_dept'])){
					$post_dept = $_POST['post_dept'];
				}
				if(isset($_POST['qualification'])){
					$qualification = $_POST['qualification'];
				}
				if(isset($_POST['fname'])){
					$fname = $_POST['fname'];
				}
				if(isset($_POST['lname'])){
					$lname = $_POST['lname'];
				}
				if(isset($_POST['father_name'])){
					$father_name = $_POST['father_name'];
				}
				if(isset($_POST['mother_name'])){
					$mother_name = $_POST['mother_name'];
				}
				if(isset($_POST['gender'])){
					$gender = $_POST['gender'];
				}
				if(isset($_POST['DOB'])){
					$DOB = $_POST['DOB'];
				}
				if(isset($_POST['address'])){
					$address = $_POST['address'];
				}
				if(isset($_POST['state'])){
					$state = $_POST['state'];
				}
				if(isset($_POST['district'])){
					$district = $_POST['district'];
				}
				if(isset($_POST['pin'])){
					$pin = $_POST['pin'];
				}
				if(isset($_POST['mob_1'])){
					$mob_1 = $_POST['mob_1'];
				}
				if(isset($_POST['mob_2'])){
					$mob_2 = $_POST['mob_2'];
				}
				if(isset($_POST['image'])){
					$image = $_POST['image'];
				}

				$query=mysqli_query($con, "SELECT * FROM faculty_info WHERE dept='$xdept'");
				$numrows=mysqli_num_rows($query);

	        if($numrows!=0)
	        {

				echo "<table align='center' border='2px' style='line-height=60px;'>";
				echo "<tr>";
					echo "<b>Department :</b> $xdept";
				echo "</tr>";
				echo "<tr>";
					if($id!='') echo "<th>ID</th>";
					if($post_dept!='') echo "<th>Post in Department</th>";
					if($qualification!='') echo "<th>Highest Qualification</th>";
					if($fname!='')  echo "<th>First Name</th>";
					if($lname!='') echo "<th>Last Name</th>";
					if($father_name!='') echo "<th>Father Name</th>";
					if($mother_name!='') echo "<th>Mother Name</th>";
					if($gender!='') echo "<th>Gender</th>";
					if($DOB!='') echo "<th>DOB</th>";
					if($address!='') echo "<th>Address</th>";
					if($state!='') echo "<th>State</th>";
					if($district!='') echo "<th>District</th>";
					if($pin!='') echo "<th>PIN</th>";
					if($mob_1!='') echo "<th>Mobile-1</th>";
					if($mob_2!='') echo "<th>Mobile-2</th>";
					if($image!='') echo "<th>Image Link</th>";
				echo "</tr>";
					while($rows=mysqli_fetch_assoc($query))
					{
						echo "<tr>";
							if($id!=''){ echo "<td>"; echo $rows['id']; echo"</td>";}
							if($post_dept!=''){ echo "<td>";echo $rows['post_dept'];echo"</td>";}
							if($qualification!=''){ echo "<td>";echo $rows['qualification'];echo"</td>";}
							if($fname!=''){ echo "<td>";echo $rows['fname'];echo"</td>";}
							if($lname!=''){ echo "<td>";echo $rows['lname'];echo"</td>";}
							if($father_name!=''){ echo "<td>";echo $rows['father_name'];echo"</td>";}
							if($mother_name!=''){ echo "<td>";echo $rows['mother_name'];echo"</td>";echo"</td>";}
							if($gender!=''){ echo "<td>";echo $rows['gender'];echo"</td>";}
							if($DOB!=''){ echo "<td>";echo $rows['dob'];echo"</td>";}
							if($address!=''){ echo "<td>";echo $rows['address'];echo"</td>";}
							if($state!=''){ echo "<td>";echo $rows['state'];echo"</td>";}
							if($district!=''){ echo "<td>";echo $rows['district'];echo"</td>";}
							if($pin!=''){ echo "<td>";echo $rows['pin'];echo"</td>";}
							if($mob_1!=''){ echo "<td>";echo $rows['mob_1'];echo"</td>";}
							if($mob_2!=''){ echo "<td>";echo $rows['mob_2'];echo"</td>";}
							if($image!=''){ echo "<td>";echo $rows['image'];echo"</td>";}

							echo "<td><form action='modify_faculty.php' method='POST'><input type='hidden' name='Id' value='".$rows['id']."'/><input type='submit' name='submit' value='Update' /></form></td>";

							echo "<td><form action='remove_faculty.php' method='POST'><input type='hidden' name='Id' value='".$rows['id']."'/><input type='submit' name='submit' value='Remove' /></form></td>";

						echo "</tr>";
					}
				echo "</table>";
				// echo "<a href='remove_faculty.php'> Remove a Faculty";
			}else{
				echo "No Faculty found !!!";
			}
	}
?>

	</body>
</html>
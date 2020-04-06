<?php 
session_start();
if(!isset($_SESSION["sess_user"]) && !isset($_SESSION['id']) && !isset($_SESSION['password'])){
	header("location:login_admin.php");
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>View Student</title>
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

		<form action="view_student.php" method="post">
        <input type="submit" name="back_button" value="Back">
	      </form>
	      <?php
	          if(isset($_POST['back_button'])){
	            if($_SESSION['designation']=='admin')
	                header("Location: member_admin.php");
	            if($_SESSION['designation']=='faculty')
	                header("Location: member_faculty.php");
	          }
	      ?>

	      <br><br>
		<form action="view_student.php" method="post">
			<b>Course Selected : </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		      <select style="width: 300px; height: 40px;" name="course">
		        <option value="btech">B.Tech.</option>
		        <option value="other">Other</option>
		        <option value="other">Other</option>
		    </select>
		    <br><br>
		    <b>Branch Selected : </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
			<b>Select which fields you want to see : </b><br>
				<input type="checkbox" name="id" value="id" onclick="return false" checked> ID &emsp;&emsp;&emsp;&ensp;
				<input type="checkbox" name="mode_admission" value="mode_admission"> Mode of Admission &emsp;
				<input type="checkbox" name="fname" value="fname"> First Name &emsp;
				<input type="checkbox" name="lname" value="lname"> Last Name &emsp;
				<input type="checkbox" name="father_name" value="father_name"> Father Name &emsp;
				<input type="checkbox" name="mother_name" value="mother_name"> Mother Name &emsp;
				<input type="checkbox" name="gender" value="gender"> Gender &emsp;
				<input type="checkbox" name="DOB" value="DOB"> DOB &emsp;
				<input type="checkbox" name="category" value="category"> Category <br>
				<input type="checkbox" name="address" value="address"> Address &emsp;
				<input type="checkbox" name="state" value="state"> State &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;
				<input type="checkbox" name="district" value="district"> District &emsp;&emsp;&ensp;
				<input type="checkbox" name="pin" value="pin"> PIN &emsp;&emsp;&emsp;&emsp;
				<input type="checkbox" name="father_mob" value="father_mob"> Father Mobile &emsp;
				<input type="checkbox" name="mother_mob" value="mother_mob"> Mother Mobile &emsp;
				<input type="checkbox" name="self_mob" value="self_mob"> Self Mobile &emsp;&emsp;&emsp;
				<input type="checkbox" name="image" value="image"> Image Link

				<br><br>

			<button type="submit" value="submit" name="submit" class="btn btn-primary">See Details</button>
			<br><br>
			<hr><br>
		</form>


		<?php
			if(isset($_POST['submit'])){
				$con=mysqli_connect('localhost','root','') or die(mysqli_error());
	    		mysqli_select_db($con,'student_register') or die("cannot select DB");

	    		$xbranch = $_POST['branch'];
	    		$xsem = $_POST['sem'];


				$id='';
				$mode_admission='';
				$fname='';
				$lname='';
				$father_name='';
				$mother_name='';
				$gender='';
				$DOB='';
				$category='';
				$address='';
				$state='';
				$district='';
				$pin='';
				$father_mob='';
				$mother_mob='';
				$self_mob='';
				$image='';

				if(isset($_POST['id'])){
					$id = $_POST['id'];
				}
				if(isset($_POST['mode_admission'])){
					$mode_admission = $_POST['mode_admission'];
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
				if(isset($_POST['category'])){
					$category = $_POST['category'];
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
				if(isset($_POST['father_mob'])){
					$father_mob = $_POST['father_mob'];
				}
				if(isset($_POST['mother_mob'])){
					$mother_mob = $_POST['mother_mob'];
				}
				if(isset($_POST['self_mob'])){
					$self_mob = $_POST['self_mob'];
				}
				if(isset($_POST['image'])){
					$image = $_POST['image'];
				}

				$query=mysqli_query($con, "SELECT * FROM student_info WHERE branch='$xbranch' AND sem=$xsem");
				$numrows=mysqli_num_rows($query);

	        if($numrows!=0)
	        {

				echo "<table align='center' border='2px' style='line-height=60px;'>";
				echo "<tr>";
					echo "<b>Branch :</b> $xbranch  &ensp; <b>*******</b> &ensp;<b>Sem :</b> $xsem";
				echo "</tr>";
				echo "<tr>";
					if($id!='') echo "<th>ID</th>";
					if($mode_admission!='') echo "<th>Mode of Admission</th>";
					if($fname!='')  echo "<th>First Name</th>";
					if($lname!='') echo "<th>Last Name</th>";
					if($father_name!='') echo "<th>Father Name</th>";
					if($mother_name!='') echo "<th>Mother Name</th>";
					if($gender!='') echo "<th>Gender</th>";
					if($DOB!='') echo "<th>DOB</th>";
					if($category!='') echo "<th>Category</th>";
					if($address!='') echo "<th>Address</th>";
					if($state!='') echo "<th>State</th>";
					if($district!='') echo "<th>District</th>";
					if($pin!='') echo "<th>PIN</th>";
					if($father_mob!='') echo "<th>Father Mobile</th>";
					if($mother_mob!='') echo "<th>Mother Mobile</th>";
					if($self_mob!='') echo "<th>Self Mobile</th>";
					if($image!='') echo "<th>Image Link</th>";
				echo "</tr>";
					while($rows=mysqli_fetch_assoc($query))
					{
						echo "<tr>";
							if($id!=''){ echo "<td>"; echo $rows['id']; echo"</td>";}
							if($mode_admission!=''){ echo "<td>";echo $rows['mode_admission'];echo"</td>";}
							if($fname!=''){ echo "<td>";echo $rows['fname'];echo"</td>";}
							if($lname!=''){ echo "<td>";echo $rows['lname'];echo"</td>";}
							if($father_name!=''){ echo "<td>";echo $rows['father_name'];echo"</td>";}
							if($mother_name!=''){ echo "<td>";echo $rows['mother_name'];echo"</td>";echo"</td>";}
							if($gender!=''){ echo "<td>";echo $rows['gender'];echo"</td>";}
							if($DOB!=''){ echo "<td>";echo $rows['dob'];echo"</td>";}
							if($category!=''){ echo "<td>";echo $rows['category'];echo"</td>";}
							if($address!=''){ echo "<td>";echo $rows['address'];echo"</td>";}
							if($state!=''){ echo "<td>";echo $rows['state'];echo"</td>";}
							if($district!=''){ echo "<td>";echo $rows['district'];echo"</td>";}
							if($pin!=''){ echo "<td>";echo $rows['pin'];echo"</td>";}
							if($father_mob!=''){ echo "<td>";echo $rows['father_mob'];echo"</td>";}
							if($mother_mob!=''){ echo "<td>";echo $rows['mother_mob'];echo"</td>";}
							if($self_mob!=''){ echo "<td>";echo $rows['self_mob'];echo"</td>";}
							if($image!=''){ echo "<td>";echo $rows['image'];echo"</td>";}

							echo "<td><form action='modify_student.php' method='POST'><input type='hidden' name='Id' value='".$rows['id']."'/><input type='submit' name='submit' value='Update' /></form></td>";
							echo "<td><form action='remove_student.php' method='POST'><input type='hidden' name='Id' value='".$rows['id']."'/><input type='submit' name='submit' value='Remove' /></form></td>";

						echo "</tr>";
					}
				echo "</table>";
				// echo "<a href='remove_student.php'> Remove a Student";

			}else{
				echo "No Student found !!!";
			}
	}
?>

	</body>
</html>
<?php 
session_start();
if(!isset($_SESSION["sess_user"]) && !isset($_SESSION['id'])){
    header("location:login_admin.php");
}
?>

<?php
	$msg = '';
	if(isset($_POST["submit"]))
	{
		$con=mysqli_connect('localhost','root','') or die(mysqli_error());
		mysqli_select_db($con,'student_register') or die("cannot select DB");

		$x = $_POST['Id'];
		$query=mysqli_query($con, "SELECT * FROM student_info WHERE id=$x");
		$numrows=mysqli_num_rows($query);

		if($numrows!=0)
    	{
    		$rows=mysqli_fetch_assoc($query);

    		$course = $rows['course'];
    		$sems = $rows['sem'];
    		$branch = $rows['branch'];
    		$mode_admission = $rows['mode_admission'];

    		$fname = $rows['fname'];
    		$lname = $rows['lname'];
    		$father_name = $rows['father_name'];
    		$mother_name = $rows['mother_name'];
    		$gender = $rows['gender'];

    		$dob = $rows['dob'];
    		$category = $rows['category'];
    		$image = $rows['image'];

    		$address = $rows['address'];
    		$state = $rows['state'];
    		$district = $rows['district'];
    		$pin = $rows['pin'];
    		$father_mob = $rows['father_mob'];
    		$mother_mob = $rows['mother_mob'];
    		$self_mob = $rows['self_mob'];
    	}
		mysqli_close($con);
	}

  if(isset($_POST['upload'])){

    $con = mysqli_connect('localhost', 'root');
    mysqli_select_db($con, 'student_register');

    if(mysqli_connect_errno()){
      $msg = "DB-Failed to load !<br>".mysqli_connect_errno();
    }

    /* Taking form-entries to vars */

    $xid = $_POST['idd'];

    $image = $_FILES['image']['name'];
    $target = "image_stud/".basename($_FILES['image']['name']);

    $course = $_POST['course'];
    $branch = $_POST['branch'];
    $sem = $_POST['sem'];
    $mode_admission = $_POST['mode_admission'];

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $father_name = $_POST['father_name'];
    $mother_name = $_POST['mother_name'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $category = $_POST['category'];
    // ////

    // ////
    $address = $_POST['address'];
    $state = $_POST['state'];
    $district = $_POST['district'];
    $pin = $_POST['pin'];
    $father_mob = $_POST['father_mob'];
    $mother_mob = $_POST['mother_mob'];
    $self_mob = $_POST['self_mob'];



    // /* *********************** DATABASE PROCESS ************************ */
    if(!empty($course) && !empty($branch) && !empty($sem) && !empty($mode_admission)&& !empty($fname)&& !empty($lname) && !empty($father_name) && !empty($mother_name)&& !empty($gender)&& !empty($dob) && !empty($address)&& !empty($state)&& !empty($district)&& !empty($pin)&& !empty($father_mob)&& !empty($mother_mob)&& !empty($self_mob) && !empty($image)) {
      $q = "UPDATE student_info SET course='$course',branch='$branch',sem=$sem,mode_admission='$mode_admission',fname='$fname',lname='$lname',father_name='$father_name',mother_name='$mother_name',gender='$gender',dob='$dob',address='$address',state='$state',district='$district',pin=$pin,father_mob='$father_mob',mother_mob='$mother_mob',self_mob='$self_mob',image='$image' WHERE id=$xid";
      $status = mysqli_query($con, $q);

      if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
          // $msg = "Image Uploaded...";
      }
      
      mysqli_close($con);
      if($status == 0){
        $msg = "DB PROBLEM !!!";
      }
      if($status == 1){
        $msg = "Updated successfully...";
      }
    }
    else{
      $msg = "please enter all the required fields !"; //form incomplete
  }

}
?>


<!DOCTYPE html>
<html>
	<head>
		<title>Modify Student Details</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
        <link href='custom.css' rel='stylesheet' type='text/css'>

        <style>
			body{
				background: lightpink;
			}
			table {
				font-family: arial, sans-serif;
				border-collapse: collapse;
				width: 90%;
			}

			td, th {
				border: 1px solid red;
				text-align: left;
				padding: 8px;
				width: 100px;
			}
    	</style>
	</head>
	<body>
		<a href="view_student.php">Back</a>

		<?php if($msg != '') : ?>
        <div><?php echo $msg; ?></div>
      <?php endif; ?>

		<form action="modify_student.php" id="theForm" method="post" enctype="multipart/form-data">

    <div class="controls" style="margin-left: 50px; margin-top: 30px">
      <b style="background: yellow;"><u>PERSONAL DETAILS</u></b><br><br>

      <input type="hidden" id="theForm" type="text" name="idd" value="<?php echo $x;?>" class="form-control">

      <b>Course Selected : </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <select style="width: 300px; height: 40px;" name="course">
        <option value="btech" <?php if($course=='btech') echo "Selected"; ?>>B.Tech.</option>
        <option value="other" <?php if($mode_admission=='other') echo "Selected"; ?>>Other</option>
        <option value="other" <?php if($mode_admission=='other') echo "Selected"; ?>>Other</option>
    </select>
    <br><br>
    <b>Branch Selected : </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <select style="width: 300px; height: 40px;" name="branch">
        <option value="a" <?php if($branch=='a') echo "Selected"; ?>>A</option>
        <option value="b" <?php if($branch=='b') echo "Selected"; ?>>B</option>
        <option value="c" <?php if($branch=='c') echo "Selected"; ?>>C</option>
        <option value="cse" <?php if($branch=='cse') echo "Selected"; ?>>Computer Science Enginnering</option>
        <option value="me" <?php if($branch=='me') echo "Selected"; ?>>Mechanical Enginnering</option>
        <option value="ce" <?php if($branch=='ce') echo "Selected"; ?>>Civil Enginnering</option>
        <option value="ee" <?php if($branch=='ee') echo "Selected"; ?>>Electrical Enginnering</option>
    </select>
    <br><br>
    <b>Semester of Studying : </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <select style="width: 300px; height: 40px;" name="sem">
        <option value="1" <?php if($sems=='1') echo "Selected"; ?>>I</option>
        <option value="2" <?php if($sems=='2') echo "Selected"; ?>>II</option>
        <option value="3" <?php if($sems=='3') echo "Selected"; ?>>III</option>
        <option value="4" <?php if($sems=='4') echo "Selected"; ?>>IV</option>
        <option value="5" <?php if($sems=='5') echo "Selected"; ?>>V</option>
        <option value="6" <?php if($sems=='6') echo "Selected"; ?>>VI</option>
        <option value="7" <?php if($sems=='7') echo "Selected"; ?>>VII</option>
        <option value="8" <?php if($sems=='8') echo "Selected"; ?>>VIII</option>
    </select>
    <br><br>
    <b>Mode of Admission : </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <select style="width: 300px; height: 40px;" name="mode_admission">
        <option value="dir" <?php if($mode_admission=='dir') echo "Selected"; ?>>Direct</option>
        <option value="mngmt" <?php if($mode_admission=='mngmt') echo "Selected"; ?>>Management</option>
        <option value="" <?php if($mode_admission=='') echo "Selected"; ?>>other</option>
        <option value="" <?php if($mode_admission=='') echo "Selected"; ?>>other</option>
        <option value="" <?php if($mode_admission=='') echo "Selected"; ?>>other</option>
        <option value="" <?php if($mode_admission=='') echo "Selected"; ?>>other</option>
    </select>
    <br><br>

    <b>Photo of Student : </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="file" name="image"><br><br>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <b>First Name : </b><input value="<?php echo("$fname")?>" id="theForm" type="text" name="fname" class="form-control" data-error="Firstname is required.">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <b>Last Name : </b><input value="<?php echo("$lname")?>" id="theForm" type="text" name="lname" class="form-control" placeholder="Enter Username" >
                </div>
            </div>
        </div>
        <div class="row">
          <div class="col-md-4">
                <div class="form-group">
                    <b>Mother's Name : </b><input value="<?php echo("$mother_name")?>" id="theForm" type="text" name="mother_name" class="form-control" placeholder="Enter Username" >
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <b>Father's Name : </b><input value="<?php echo("$father_name")?>" id="theForm" type="text" name="father_name" class="form-control" placeholder="Enter Username" >
                </div>
            </div>
        </div>

      <b>Gender : </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="gender" value="male" <?php if($gender=='male') echo "Checked"; ?>> Male&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="radio" name="gender" value="female" <?php if($gender=='female') echo "Checked"; ?>> Female&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="radio" name="gender" value="other" <?php if($gender=='other') echo "Checked"; ?>> Other <br><br>

      <b>Date of Birth : </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input style="width: 300px; height: 40px;" value="<?php echo("$dob")?>" type="date" name="dob"><br><br>
      <b>Category : </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <select style="width: 300px; height: 40px;" name="category">
        <option value="gen" <?php if($category=='gen') echo "Selected"; ?>>General</option>
        <option value="obc" <?php if($category=='obc') echo "Selected"; ?>>OBC</option>
        <option value="sc" <?php if($category=='sc') echo "Selected"; ?>>SC</option>
        <option value="st" <?php if($category=='st') echo "Selected"; ?>>ST</option>
        <option value="other" <?php if($category=='other') echo "Selected"; ?>>other</option>
    </select>
    <br><br>

    <hr>
    <b style="background: yellow;">EDUCATIONAL DETAILS</b><br><br>

    <table>
      <tr>
          <th>Name</th>
          <th>Year</th>
          <th>Board</th>
          <th>Percentage</th>
        </tr>
        <tr>
          <td>X</td>
          <td><input type="number" min="1900" max="2099" step="1" value="2019" /></td>
          <td>
            <select>
              <option value="rbse">RBSE, Ajmer</option>
              <option value="cbse">CBSE</option>
              <option value="icse">ICSE</option>
              <option value="other">other state board</option>
              <option value="dasa">Dasa</option>
          </select>
          </td>
          <td><input type="number" max="100" step="1" value="70" /></td>
        </tr>
      <tr>
        <td>XII</td>
          <td><input type="number" min="1900" max="2099" step="1" value="2019" /></td>
          <td>
            <select>
              <option value="rbse">RBSE, Ajmer</option>
              <option value="cbse">CBSE</option>
              <option value="icse">ICSE</option>
              <option value="other">other state board</option>
              <option value="dasa">Dasa</option>
          </select>
          </td>
          <td><input type="number" max="100" step="1" value="70" /></td>
        </tr>
      <tr>
          <td>Diploma</td>
          <td><input type="number" min="1900" max="2099" step="1" value="2019" /></td>
          <td>
            <select>
              <option value="rbse">RBSE, Ajmer</option>
              <option value="cbse">CBSE</option>
              <option value="icse">ICSE</option>
              <option value="other">other state board</option>
              <option value="dasa">Dasa</option>
          </select>
          </td>
          <td><input type="number" max="100" step="1" value="70" /></td>
        </tr>
    </table><br><br>
    <hr>

    <b style="background: yellow;">JEE DETAILS</b><br><br>
    <table>
      <tr>
        <th>Exam Name</th>
        <th>Roll No.</th>
        <th>Marks</th>
        <th>Rank</th>
      </tr>
      <tr>
        <td>JEE-MAINS</td>
        <td><input type="text" name=""></td>
        <td><input type="number" name=""></td>
        <td><input type="number" name=""></td>
      </tr>
      <tr>
        <td>JEE-ADVANCED</td>
        <td><input type="text" name=""></td>
        <td><input type="number" name=""></td>
        <td><input type="number" name=""></td>
      </tr>
    </table><br><br>

    <hr>

    <b style="background: yellow;">CONTACT/ ADDRESS</b><br><br>
    <div class="row">
            <div class="col-md-11">
                <div class="form-group">
                    <b>Address : </b><input value="<?php echo("$address")?>" id="theForm" type="text" name="address" class="form-control" placeholder="Address">
                </div>
            </div>
        </div>
        <div class="row">
          <div class="col-md-4">
                <div class="form-group">
                    <b>State : </b><input value="<?php echo("$state")?>" id="theForm" type="text" name="state" class="form-control" placeholder="State Name" data-error="Firstname is required.">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <b>District : </b><input value="<?php echo("$district")?>" id="theForm" type="text" name="district" class="form-control" placeholder="District Name" data-error="Firstname is required.">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <b>PIN : </b><input value="<?php echo("$pin")?>" id="theForm" type="number" name="pin" class="form-control" placeholder="PIN-Code" data-error="Firstname is required.">
                </div>
            </div>
        </div>
        <div class="row">
          <div class="col-md-4">
                <div class="form-group">
                    <b>Father's Mobile : </b><input value="<?php echo("$father_mob")?>" id="theForm" type="tel" name="father_mob" class="form-control" >
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <b>Mother's Mobile : </b><input value="<?php echo("$mother_mob")?>" id="theForm" type="tel" name="mother_mob" class="form-control" >
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <b>Self Mobile : </b><input value="<?php echo("$self_mob")?>" id="theForm" type="tel" name="self_mob" class="form-control" >
                </div>
            </div>
        </div>
        <br>

        
        <button type="submit" style="width: 550px; height: 50px;margin-left: 350px" name="upload" value="Upload Image" class="btn btn-primary">Update Datails</button>
    </div>


</form>

	</body>
</html>



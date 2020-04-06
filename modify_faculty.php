<?php 
session_start();
if(!isset($_SESSION["sess_user"]) && !isset($_SESSION['id'])){
    header("location:login_admin.php");
}
?>

<?php

    if(isset($_POST["submit"]))
    {
        $con=mysqli_connect('localhost','root','') or die(mysqli_error());
        mysqli_select_db($con,'faculty_register') or die("cannot select DB");

        $x = $_POST['Id'];
        $query=mysqli_query($con, "SELECT * FROM faculty_info WHERE id=$x");
        $numrows=mysqli_num_rows($query);

        if($numrows!=0)
        {
            $rows=mysqli_fetch_assoc($query);

            $dept = $rows['dept'];
            $post_dept = $rows['post_dept'];
            $qualification = $rows['qualification'];

            $fname = $rows['fname'];
            $lname = $rows['lname'];
            $father_name = $rows['father_name'];
            $mother_name = $rows['mother_name'];
            $gender = $rows['gender'];

            $dob = $rows['dob'];
            $image = $rows['image'];

            $address = $rows['address'];
            $state = $rows['state'];
            $district = $rows['district'];
            $pin = $rows['pin'];
            $mob_1 = $rows['mob_1'];
            $mob_2 = $rows['mob_2'];

        }
        mysqli_close($con);
    }

  $msg = '';
  if(isset($_POST['upload'])){

    $con = mysqli_connect('localhost', 'root');
    mysqli_select_db($con, 'faculty_register');

    if(mysqli_connect_errno()){
      $msg = "DB-Failed to load !<br>".mysqli_connect_errno();
    }

    /* Taking form-entries to vars */
    $xid = $_POST['idd'];

    $image = $_FILES['image']['name'];
    $target = "image_faculty/".basename($_FILES['image']['name']);

    $dept = $_POST['dept'];
    $post_dept = $_POST['post_dept'];
    $qualification = $_POST['qualification'];

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $father_name = $_POST['father_name'];
    $mother_name = $_POST['mother_name'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    ////

    ////
    $address = $_POST['address'];
    $state = $_POST['state'];
    $district = $_POST['district'];
    $pin = $_POST['pin'];
    $mob_1 = $_POST['mob_1'];
    $mob_2 = $_POST['mob_2'];



    // /* *********************** DATABASE PROCESS ************************ */
    if(!empty($dept) && !empty($post_dept) && !empty($qualification) && !empty($image) && !empty($fname)&& !empty($lname)&& !empty($father_name)&& !empty($mother_name)&& !empty($gender)&& !empty($dob) && !empty($address)&& !empty($state)&& !empty($district)&& !empty($pin)&& !empty($mob_1)&& !empty($mob_2)) {
      $q = "UPDATE faculty_info SET dept='$dept',post_dept='$post_dept', qualification='$qualification', image='$image', fname='$fname', lname='$lname', father_name='$father_name', mother_name='$mother_name', gender='$gender', dob='$dob', address='$address', state='$state', district='$district', pin=$pin, mob_1='$mob_1', mob_2='$mob_2' WHERE id=$xid";

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

<!-- ----------------------------------------------------------------------------------------------- -->

<html>
    <head>
        <title>FACULTY REGISTRATION</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
        <link href='custom.css' rel='stylesheet' type='text/css'>

        <style>
        	body{
        		background: lightpink;
        	}
        	/* ****************** */
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
        <a href="view_faculty.php">Back</a>

        <?php if($msg != '') : ?>
        <div><?php echo $msg; ?></div>
      <?php endif; ?>

        <form id="theForm" method="post" action="modify_faculty.php" enctype="multipart/form-data">


    <div class="controls" style="margin-left: 50px; margin-top: 30px">
        
    	<b style="background: yellow;"><u>PERSONAL DETAILS</u></b><br><br>
        <input type="hidden" id="theForm" type="text" name="idd" value="<?php echo $x;?>" class="form-control">

		<b>Department : </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<select style="width: 300px; height: 40px;" name="dept">
  			<option value="ash" <?php if($dept=='ash') echo "Selected"; ?>>Applied Science and Humanities</option>
  			<option value="cse" <?php if($dept=='cse') echo "Selected"; ?>>Computer Science Enginnering</option>
  			<option value="me" <?php if($dept=='me') echo "Selected"; ?>>Mechanical Enginnering</option>
  			<option value="ce" <?php if($dept=='ce') echo "Selected"; ?>>Civil Enginnering</option>
  			<option value="ee" <?php if($dept=='ee') echo "Selected"; ?>>Electrical Enginnering</option>
		</select>
		<br><br>
    <b>Post in Dept : </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <select style="width: 300px; height: 40px;" name="post_dept">
        <option value="hod" <?php if($post_dept=='hod') echo "Selected"; ?>>Head of Department</option>
        <option value="sen_proff" <?php if($post_dept=='sen_proff') echo "Selected"; ?>>Senior Professor</option>
        <option value="proff" <?php if($post_dept=='proff') echo "Selected"; ?>>Professor</option>
        <option value="ass_proff" <?php if($post_dept=='ass_proff') echo "Selected"; ?>>Assistant Professsor</option>
        <option value="other" <?php if($post_dept=='other') echo "Selected"; ?>>Other</option>
    </select>
    <br><br>
    <b>Highest Qualification : </b>&nbsp;&nbsp;&nbsp;
    <select style="width: 300px; height: 40px;" name="qualification">
        <option value="btech" <?php if($qualification=='btech') echo "Selected"; ?>>B.Tech.</option>
        <option value="mtech" <?php if($qualification=='mtech') echo "Selected"; ?>>M.Tech.</option>
        <option value="msc" <?php if($qualification=='msc') echo "Selected"; ?>>M.Sc.</option>
        <option value="phd" <?php if($qualification=='phd') echo "Selected"; ?>>PhD</option>
        <option value="other" <?php if($qualification=='other') echo "Selected"; ?>>Other</option>
    </select>
    <br><br>

		<b>Photo of Faculty : </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="file" name="image"><br><br>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <b>First Name : </b><input value="<?php echo("$fname")?>" id="theForm" type="text" name="fname" class="form-control" placeholder="Enter Username" data-error="Firstname is required.">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <b>Last Name : </b><input value="<?php echo("$lname")?>" id="theForm" type="text" name="lname" class="form-control" placeholder="Enter Username" data-error="Firstname is required.">
                </div>
            </div>
        </div>
        <div class="row">
        	<div class="col-md-4">
                <div class="form-group">
                    <b>Mother's Name : </b><input value="<?php echo("$mother_name")?>" id="theForm" type="text" name="mother_name" class="form-control" placeholder="Enter Username" data-error="Firstname is required.">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <b>Father's Name : </b><input value="<?php echo("$father_name")?>" id="theForm" type="text" name="father_name" class="form-control" placeholder="Enter Username" data-error="Firstname is required.">
                </div>
            </div>
        </div>

    	<b>Gender : </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="gender" value="male" <?php if($gender=='male') echo "Checked"; ?>> Male&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    	<input type="radio" name="gender" value="female" <?php if($gender=='female') echo "Checked"; ?>> Female&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    	<input type="radio" name="gender" value="other" <?php if($gender=='other') echo "Checked"; ?>> Other <br><br>

    	<b>Date of Birth : </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input style="width: 300px; height: 40px;" value="<?php echo("$dob")?>" type="date" name="dob"><br><br>
    	

		<hr>
		

		<b style="background: yellow;">CONTACT/ ADDRESS</b><br><br>
		<div class="row">
            <div class="col-md-11">
                <div class="form-group">
                    <b>Address : </b><input value="<?php echo("$address")?>" id="theForm" type="text" class="form-control" placeholder="Address" name="address">
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
        	<div class="col-md-6">
                <div class="form-group">
                    <b>Mobile 1 : </b><input value="<?php echo("$mob_1")?>" id="theForm" type="tel" name="mob_1" class="form-control" >
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <b>Mobile 2 : </b><input value="<?php echo("$mob_2")?>" id="theForm" type="tel" name="mob_2" class="form-control" >
                </div>
            </div>
        </div>
        <br>

        
        <button type="submit" style="width: 550px; height: 50px;margin-left: 350px" name="upload" value="Upload Image" class="btn btn-primary">Update Details</button>
    </div>


</form>
    </body>
</html>
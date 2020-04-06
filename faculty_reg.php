<?php

  $msg = '';
  if(isset($_POST['upload'])){

    $con = mysqli_connect('localhost', 'root');
    mysqli_select_db($con, 'faculty_register');

    if(mysqli_connect_errno()){
      $msg = "DB-Failed to load !<br>".mysqli_connect_errno();
    }

    /* Taking form-entries to vars */

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
      $q = "INSERT INTO faculty_info(dept, post_dept, qualification, image, fname, lname, father_name, mother_name, gender, dob, address, state, district, pin, mob_1, mob_2) VALUES ('$dept','$post_dept','$qualification', '$image', '$fname','$lname','$father_name','$mother_name','$gender','$dob','$address','$state','$district','$pin','$mob_1','$mob_2')";

      $status = mysqli_query($con, $q);

      if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
          // $msg = "Image Uploaded...";
      }

      mysqli_close($con);
      if($status == 0){
        $msg = "Dear ".ucwords($fname).", you are already registered !!!";
      }
      if($status == 1){
        $msg = "Registed successfully...";
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

        <a href="member_admin.php">Back</a>

        <?php if($msg != '') : ?>
        <div><?php echo $msg; ?></div>
      <?php endif; ?>

        <form id="theForm" method="post" action="faculty_reg.php" enctype="multipart/form-data">

    <div class="controls" style="margin-left: 50px; margin-top: 30px">
    	<b style="background: yellow;"><u>PERSONAL DETAILS</u></b><br><br>

		<b>Department : </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<select style="width: 300px; height: 40px;" name="dept">
  			<option value="ash">Applied Science and Humanities</option>
  			<option value="cse">Computer Science Enginnering</option>
  			<option value="me">Mechanical Enginnering</option>
  			<option value="ce">Civil Enginnering</option>
  			<option value="ee">Electrical Enginnering</option>
		</select>
		<br><br>
    <b>Post in Dept : </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <select style="width: 300px; height: 40px;" name="post_dept">
        <option value="hod">Head of Department</option>
        <option value="sen_proff">Senior Professor</option>
        <option value="proff">Professor</option>
        <option value="ass_proff">Assistant Professsor</option>
        <option value="other">Other</option>
    </select>
    <br><br>
    <b>Highest Qualification : </b>&nbsp;&nbsp;&nbsp;
    <select style="width: 300px; height: 40px;" name="qualification">
        <option value="btech">B.Tech.</option>
        <option value="mtech">M.Tech.</option>
        <option value="msc">M.Sc.</option>
        <option value="phd">PhD</option>
        <option value="other">Other</option>
    </select>
    <br><br>

		<b>Photo of Faculty : </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="file" name="image"><br><br>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <b>First Name : </b><input id="theForm" type="text" name="fname" class="form-control" placeholder="Enter Username" data-error="Firstname is required.">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <b>Last Name : </b><input id="theForm" type="text" name="lname" class="form-control" placeholder="Enter Username" data-error="Firstname is required.">
                </div>
            </div>
        </div>
        <div class="row">
        	<div class="col-md-4">
                <div class="form-group">
                    <b>Mother's Name : </b><input id="theForm" type="text" name="mother_name" class="form-control" placeholder="Enter Username" data-error="Firstname is required.">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <b>Father's Name : </b><input id="theForm" type="text" name="father_name" class="form-control" placeholder="Enter Username" data-error="Firstname is required.">
                </div>
            </div>
        </div>

    	<b>Gender : </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="gender" value="male"> Male&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    	<input type="radio" name="gender" value="female"> Female&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    	<input type="radio" name="gender" value="other"> Other <br><br>

    	<b>Date of Birth : </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input style="width: 300px; height: 40px;" type="date" name="dob"><br><br>
    	

		<hr>
		

		<b style="background: yellow;">CONTACT/ ADDRESS</b><br><br>
		<div class="row">
            <div class="col-md-11">
                <div class="form-group">
                    <b>Address : </b><input id="theForm" type="text" class="form-control" placeholder="Address" name="address">
                </div>
            </div>
        </div>
        <div class="row">
        	<div class="col-md-4">
                <div class="form-group">
                    <b>State : </b><input id="theForm" type="text" name="state" class="form-control" placeholder="State Name" data-error="Firstname is required.">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <b>District : </b><input id="theForm" type="text" name="district" class="form-control" placeholder="District Name" data-error="Firstname is required.">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <b>PIN : </b><input id="theForm" type="number" name="pin" class="form-control" placeholder="PIN-Code" data-error="Firstname is required.">
                </div>
            </div>
        </div>
        <div class="row">
        	<div class="col-md-6">
                <div class="form-group">
                    <b>Mobile 1 : </b><input id="theForm" type="tel" name="mob_1" class="form-control" >
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <b>Mobile 2 : </b><input id="theForm" type="tel" name="mob_2" class="form-control" >
                </div>
            </div>
        </div>
        <br>

        
        <button type="submit" style="width: 550px; height: 50px;margin-left: 350px" name="upload" value="Upload Image" class="btn btn-primary">Submit</button>
    </div>


</form>
    </body>
</html>
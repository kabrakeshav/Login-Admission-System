<?php 
session_start();
if(!isset($_SESSION["sess_user"]) && !isset($_SESSION['id']) && !isset($_SESSION['designation'])){
    header("location:login_admin.php");
}
?>


<?php

  $msg = '';
  if(isset($_POST['upload'])){

    $con = mysqli_connect('localhost', 'root');
    mysqli_select_db($con, 'student_register');

    if(mysqli_connect_errno()){
      $msg = "DB-Failed to load !<br>".mysqli_connect_errno();
    }

    /* Taking form-entries to vars */

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
    ////

    ////
    $address = $_POST['address'];
    $state = $_POST['state'];
    $district = $_POST['district'];
    $pin = $_POST['pin'];
    $father_mob = $_POST['father_mob'];
    $mother_mob = $_POST['mother_mob'];
    $self_mob = $_POST['self_mob'];



    // /* *********************** DATABASE PROCESS ************************ */
    if(!empty($course) && !empty($branch) && !empty($sem) && !empty($mode_admission)&& !empty($fname)&& !empty($lname)&& !empty($image) && !empty($father_name) && !empty($mother_name)&& !empty($gender)&& !empty($dob) && !empty($address)&& !empty($state)&& !empty($district)&& !empty($pin)&& !empty($father_mob)&& !empty($mother_mob)&& !empty($self_mob)) {
      $q = "INSERT INTO `student_info`(course, branch, sem, mode_admission, fname, lname, image, father_name, mother_name, gender, dob, category, address, state, district, pin, father_mob, mother_mob, self_mob) VALUES ('$course','$branch','$sem','$mode_admission','$fname','$lname', '$image', '$father_name','$mother_name','$gender','$dob','$category','$address','$state','$district','$pin','$father_mob','$mother_mob','$self_mob')";
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
        <title>STUDENT REGISTRATION</title>
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
      <form action="student_reg.php" method="post">
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

      <?php if($msg != '') : ?>
        <div><?php echo $msg; ?></div>
      <?php endif; ?>

    <form action="student_reg.php" id="theForm" method="post" enctype="multipart/form-data">

    <div class="controls" style="margin-left: 50px; margin-top: 30px">
      <b style="background: yellow;"><u>PERSONAL DETAILS</u></b><br><br>

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
    <b>Mode of Admission : </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <select style="width: 300px; height: 40px;" name="mode_admission">
        <option value="dir">Direct</option>
        <option value="mngmt">Management</option>
        <option value="">other</option>
        <option value="">other</option>
        <option value="">other</option>
        <option value="">other</option>
    </select>
    <br><br>

    <b>Photo of Student : </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="file" name="image" ><br><br>
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
      <b>Category : </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <select style="width: 300px; height: 40px;" name="category">
        <option value="gen">General</option>
        <option value="obc">OBC</option>
        <option value="sc">SC</option>
        <option value="st">ST</option>
        <option value="other">other</option>
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
                    <b>Address : </b><input id="theForm" type="text" name="address" class="form-control" placeholder="Address">
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
          <div class="col-md-4">
                <div class="form-group">
                    <b>Father's Mobile : </b><input id="theForm" type="tel" name="father_mob" class="form-control" >
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <b>Mother's Mobile : </b><input id="theForm" type="tel" name="mother_mob" class="form-control" >
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <b>Self Mobile : </b><input id="theForm" type="tel" name="self_mob" class="form-control" >
                </div>
            </div>
        </div>
        <br>

        
        <button type="submit" style="width: 550px; height: 50px;margin-left: 350px" name="upload" value="Upload Image" class="btn btn-primary">Submit</button>
    </div>


</form>
    </body>
</html>
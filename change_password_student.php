<?php 
session_start();
if(!isset($_SESSION["sess_user"]) && !isset($_SESSION['id'])){
    header("location:login_admin.php");
} else {}
?>

<html>
    <head>
        <title>Change Password</title>
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

        <a href="member_student.php">Back</a>
    <form method="post" action="" role="form">

    <div class="controls" style="padding: 180px; margin-left: 300px">

        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    Current Password : <input type="password" name="pass" class="form-control" placeholder="Enter Password">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    New Password : <input type="password" name="new_pass" class="form-control" placeholder="Enter New Password">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    Confirm Password : <input type="password" name="conf_pass" class="form-control" placeholder="Enter New Password">
                </div>
            </div>
        </div>

        <button type="submit" value="LOGIN" name="submit" class="btn btn-primary">Update</button>
    </div>
    </form>

    <?php
    if(isset($_POST["submit"])){

    if(!empty($_POST['pass']) && !empty($_POST['new_pass']) && !empty($_POST['conf_pass'])) {
    $id = $_SESSION['id'];
    $pass = $_POST['pass'];
    $new_pass = $_POST['new_pass'];
    $conf_pass = $_POST['conf_pass'];

    if($new_pass == $conf_pass)
    {
        $con=mysqli_connect('localhost','root','') or die(mysqli_error());
        mysqli_select_db($con,'student_register') or die("cannot select DB");

        $query=mysqli_query($con, "SELECT * FROM student_info");
        $numrows=mysqli_num_rows($query);

        $flag = 0;
        if($numrows!=0)
        {
            while($row=mysqli_fetch_assoc($query)) 
            {
                $dbuserid=$row['id'];
                $dbuserpassword=$row['password'];

                if($id==$dbuserid && $pass==$dbuserpassword){
                    $flag = 1;
                    $q = "UPDATE student_info SET password='$new_pass' WHERE id=$id";
                    $status = mysqli_query($con, $q);
                    if($status == 1){
                        echo "Updated successfully...";
                    }else{
                        echo "Problem while updating DB! Try again!!";
                    }
                }
            }
            if($flag == 0){
                echo "No Such Student Exist...";
            }
        }
    }else{
        echo "Password fields not match !!";
    }

    } else {
        echo "All fields are mandatory!";
}
}
    ?>

    </body>
</html>
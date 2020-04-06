<?php 
session_start();
if(!isset($_SESSION["sess_user"]) && !isset($_SESSION["password"])){
    header("location:login_admin.php");
} else {}
?>

<html>
    <head>
        <title>REMOVE ADMIN</title>
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

    <a href="member_admin.php">Back</a>
    <form method="post" action="" role="form">

    <div class="controls" style="padding: 180px; margin-left: 300px">

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    Enter Your Password : <input type="password" name="pass" class="form-control" placeholder="Enter your password">
                </div>
            </div>
        </div>
        <hr>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    Id : <input type="integer" name="id" class="form-control" placeholder="Enter id of admin">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    User Name : <input id="form_name" type="text" name="user" class="form-control" placeholder="Enter Username">
                </div>
            </div>
        </div>

        <button type="submit" value="LOGIN" name="submit" class="btn btn-danger">Remove Admin</button>
    </div>
    </form>

    <?php
    if(isset($_POST["submit"])){

    if(!empty($_POST['pass']) && !empty($_POST['id']) && !empty($_POST['user'])) {
        $pass = $_POST['pass'];
        $spass = $_SESSION['password'];

        $user = $_POST['user'];
        $id = $_POST['id'];

        if($pass == $spass)
        {
        $con=mysqli_connect('localhost','root','') or die(mysqli_error());
        mysqli_select_db($con,'admin_user_college') or die("cannot select DB");

        $query=mysqli_query($con, "SELECT * FROM users");
        $numrows=mysqli_num_rows($query);

        $flag = 0;
        if($numrows!=0)
        {
            while($row=mysqli_fetch_assoc($query)) 
            {
                $dbuserid = $row['id'];
                $dbusername=$row['name'];

                if($user == $dbusername && $id==$dbuserid){
                    $flag = 1;
                    $q = "DELETE FROM users WHERE id=$dbuserid AND name='$dbusername'";
                    $status = mysqli_query($con, $q);
                    if($status == 1){
                        echo "Removed successfully...";
                    }else{
                        echo "Problem while deleting from DB! Try again!!";
                    }
                }
            }
            if($flag == 0){
                echo "No such admin found !!!";
            }
        }
    }else{
        echo "Password not matched !!!";
    }
}
    } else {
        echo "All fields are mandatory!";
}
    ?>

    </body>
</html>
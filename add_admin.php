<?php 
session_start();
if(!isset($_SESSION["sess_user"]) && !isset($_SESSION["password"])){
    header("location:login_admin.php");
} else {}
?>

<html>
    <head>
        <title>ADD ADMIN</title>
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
                    User Name : <input id="form_name" type="text" name="user" class="form-control" placeholder="Enter Username">
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    Password : <input type="password" name="pass" class="form-control" placeholder="Enter Password">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    Confirm Password : <input type="password" name="conf_pass" class="form-control" placeholder="Re-Enter Password">
                </div>
            </div>
        </div>

        <button type="submit" value="LOGIN" name="submit" class="btn btn-primary">Add Admin</button>
    </div>
    </form>

    <?php
    if(isset($_POST["submit"])){

    if(!empty($_POST['user']) && !empty($_POST['pass']) && !empty($_POST['conf_pass'])) {
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $conf_pass = $_POST['conf_pass'];

    if($pass == $conf_pass) {
        $con=mysqli_connect('localhost','root','') or die(mysqli_error());
        mysqli_select_db($con,'admin_user_college') or die("cannot select DB");

        $query=mysqli_query($con, "SELECT * FROM users");
        $numrows=mysqli_num_rows($query);

        $flag = 0;
        if($numrows!=0)
        {
            while($row=mysqli_fetch_assoc($query)) 
            {
                $dbusername=$row['name'];

                if($user == $dbusername){
                    $flag = 1;
                    echo "This user-name already exist! Try another!!";
                }
            }
            if($flag == 0){
                $q = "INSERT INTO users(name, password) VALUES ('$user', '$pass')";
                $status = mysqli_query($con, $q);
                if($status == 1){
                    echo "Registed successfully...";
                }else{
                    echo "Problem while adding in DB! Try again!!";
                }
            }
        }
    } else {
        echo "Entries in 'password' and 'confirm-password' was not matched !!";
    }

    } else {
        echo "All fields are mandatory!";
}
}
    ?>

    </body>
</html>
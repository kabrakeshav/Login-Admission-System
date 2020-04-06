<?php 
session_start();
if(!isset($_SESSION["sess_user"]) && !isset($_SESSION["password"])){
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
            $fname = $rows['fname'];
        }
        mysqli_close($con);
    }



    if(isset($_POST["delete"])){
        $xid = $_POST['idd'];
        $xfname = $_POST['ffname'];

    if(!empty($_POST['pass']) && !empty($_POST['idd']) && !empty($_POST['ffname'])) {
        $pass = $_POST['pass'];
        $spass = $_SESSION['password'];

        // $user = $_POST['user'];
        // $id = $_POST['id'];

        if($pass == $spass)
        {
        $con=mysqli_connect('localhost','root','') or die(mysqli_error());
        mysqli_select_db($con,'faculty_register') or die("cannot select DB");

        $query=mysqli_query($con, "SELECT * FROM faculty_info");
        $numrows=mysqli_num_rows($query);

        $flag = 0;
        if($numrows!=0)
        {
            // while($row=mysqli_fetch_assoc($query)) 
            // {
            //     $dbuserid = $row['id'];
            //     $dbusername=$row['fname'];

            //     if($user == $dbusername && $id==$dbuserid){
                    $flag = 1;
                    $q = "DELETE FROM faculty_info WHERE id=$xid AND fname='$xfname'";
                    $status = mysqli_query($con, $q);
                    if($status == 1){
                        echo "Removed successfully from DB... Go to 'image_faculty' folder to delete photo...";
                    }else{
                        echo "Problem while deleting from DB! Try again!!";
                    }
            //     }
            // }
            if($flag == 0){
                echo "No such faculty found !!!";
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


<html>
    <head>
        <title>REMOVE FACULTY</title>
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
        <a href="view_faculty.php">Back</a>

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
        <input type="hidden" id="theForm" type="text" name="idd" value="<?php echo $x;?>" class="form-control">
        <input type="hidden" id="theForm" type="text" name="ffname" value="<?php echo $fname;?>" class="form-control">

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    Id : <input value="<?php if(!empty($x)) echo("$x");?>" type="integer" name="id" class="form-control" placeholder="Enter ID of faculty">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    Faculty Name : <input value="<?php if(!empty($x)) echo("$fname");?>" id="form_name" type="text" name="user" class="form-control" placeholder="Enter First-Name of Faculty">
                </div>
            </div>
        </div>

        <button type="submit" value="delete" name="delete" class="btn btn-danger">Remove Faculty</button>
    </div>
    </form>


    </body>
</html>
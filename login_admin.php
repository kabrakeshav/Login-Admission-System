<html>
    <head>
        <title>LOGIN</title>
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

    <form method="post" action="" role="form">

    <div class="controls" style="padding: 180px; margin-left: 300px">

        <input type="radio" name="designation" value="admin"> ADMIN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" name="designation" value="faculty"> FACULTY&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" name="designation" value="student"> STUDENT 


        <div class="row">
            <div class="col-md-6">
                <hr>
                <div class="form-group">
                    User Name : 
                    <input id="form_name" type="text" name="user" class="form-control" placeholder="Enter Full Username">
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    Password : 
                    <input type="password" name="pass" class="form-control" id="pwd" placeholder="Enter Password">
                </div>
            </div>
        </div>

        <button type="submit" value="LOGIN" name="submit" class="btn btn-primary">Login</button>
    </div>
    </form>

    <?php
    if(isset($_POST["submit"])){

    if(!empty($_POST['user']) && !empty($_POST['pass']) && !empty($_POST['designation'])) {
    $designation = $_POST['designation'];
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    $con=mysqli_connect('localhost','root','') or die(mysqli_error());

    if($designation == "admin")
    {
        mysqli_select_db($con,'admin_user_college') or die("cannot select DB");

        $query=mysqli_query($con, "SELECT * FROM users WHERE name='".$user."' AND password='".$pass."'");
        $numrows=mysqli_num_rows($query);

        if($numrows!=0)
        {
            while($row=mysqli_fetch_assoc($query)) 
            {
                $dbusername=$row['name'];
                $dbpassword=$row['password'];
                $dbid = $row['id'];
            }

            if($user == $dbusername && $pass == $dbpassword)
            {
                session_start();
                $_SESSION['sess_user']=$user;
                $_SESSION['id']=$dbid;
                $_SESSION['password'] = $dbpassword;
                $_SESSION['designation'] = 'admin';

                /* Redirect browser */
                header("Location: member_admin.php");
            }
        } else {
        echo "The username or password found to be incorrect!";
        }
    }

    if($designation == "faculty")
    {
        mysqli_select_db($con,'faculty_register') or die("cannot select DB");
        $str_arr = explode(" ", $user);
        $f_user = $str_arr[0];
        $l_user = $str_arr[1];

        $query=mysqli_query($con, "SELECT * FROM faculty_info WHERE fname='".$f_user."' AND lname='".$l_user."' AND password='".$pass."'");
        $numrows=mysqli_num_rows($query);

        if($numrows!=0)
        {
            while($row=mysqli_fetch_assoc($query)) 
            {
                $dbuser_f_name=$row['fname'];
                $dbuser_l_name=$row['lname'];
                $dbpassword=$row['password'];
                $dbid = $row['id'];
            }

            if($f_user == $dbuser_f_name && $l_user == $dbuser_l_name && $pass == $dbpassword)
            {
                session_start();
                $_SESSION['sess_user']=$user;
                $_SESSION['id'] = $dbid;
                $_SESSION['password'] = $pass;
                $_SESSION['designation'] = 'faculty';

                /* Redirect browser */
                header("Location: member_faculty.php");
            }
        } else {
        echo "The username or password found to be incorrect!";
        }
    }

    if($designation == "student")
    {
        mysqli_select_db($con,'student_register') or die("cannot select DB");
        $str_arr = explode(" ", $user);
        $f_user = $str_arr[0];
        $l_user = $str_arr[1];

        $query=mysqli_query($con, "SELECT * FROM student_info WHERE fname='".$f_user."' AND lname='".$l_user."' AND password='".$pass."'");
        $numrows=mysqli_num_rows($query);

        if($numrows!=0)
        {
            while($row=mysqli_fetch_assoc($query)) 
            {
                $dbuser_f_name=$row['fname'];
                $dbuser_l_name=$row['lname'];
                $dbpassword=$row['password'];
                $dbid = $row['id'];
            }

            if($f_user == $dbuser_f_name && $l_user == $dbuser_l_name && $pass == $dbpassword)
            {
                session_start();
                $_SESSION['sess_user']=$user;
                $_SESSION['id'] = $dbid;
                $_SESSION['designation'] = 'student';

                /* Redirect browser */
                header("Location: member_student.php");
            }
        } else {
        echo "The username or password found to be incorrect!";
        }
    }

    } else {
        echo "All fields are mandatory!";
}
}
    ?>

    </body>
</html>
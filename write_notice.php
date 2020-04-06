<?php 
session_start();
if(!isset($_SESSION["sess_user"]) && !isset($_SESSION['id']) && !isset($_SESSION['password'])){
    header("location:login_admin.php");
}
?>

<?php

  $msg = '';
  if(isset($_POST['upload'])){

        $con = mysqli_connect('localhost', 'root');
        mysqli_select_db($con, 'notices');

        if(mysqli_connect_errno()){
          $msg = "DB-Failed to load !<br>".mysqli_connect_errno();
        }

        $xid = $_SESSION['id'];
        $xuser = $_SESSION['sess_user'];
        $subject = $_POST['subject'];
        $description = $_POST['description'];

        if(!empty($subject) && !empty($description)){
            $q = "INSERT INTO notice_board(author_name, author_id, subject, description) VALUES ('$xuser', '$xid', '$subject', '$description')";
            $status = mysqli_query($con, $q);

            mysqli_close($con);
            if($status == 0){
                $msg = "Problem while uploading notice... Try again";
              }
              if($status == 1){
                $msg = "Notice uploaded successfully...";
              }
        }
        else{
            $msg = "please enter all the required fields !"; //form incomplete
        }

    }
?>






<html>
	<head>
			<title>WRITE NOTICE</title>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
			<link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
			<link href='custom.css' rel='stylesheet' type='text/css'>

			<style>
				body{
					background: lightpink;
				}
			</style>
	</head>

<body>
    <?php if($msg != '') : ?>
        <div><?php echo $msg; ?></div>
    <?php endif; ?>

	<form action="write_notice.php" id="theForm" method="post" enctype="multipart/form-data">
		<div class="col-md-7">
            <div class="form-group">
                <b>Subject : </b><input id="theForm" type="text" name="subject" class="form-control" placeholder="Enter subject of notice">
            </div>
        </div>
        <div class="col-md-7">
            <div class="form-group">
                <b>Description : </b><textarea rows="10" id="theForm" name="description" class="form-control" placeholder="Enter body of notice"></textarea>
            </div>
        </div>

        <button type="submit" style="width: 550px; height: 50px;margin-left: 350px" name="upload" value="Upload Image" class="btn btn-primary">Submit</button>
	</form>

</body>
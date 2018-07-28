<!DOCTYPE html>
<html>
<?php
session_start();
?>
    <head>
        <meta charset="UTF-8">
        <title>CKC-OGS</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <style>
          .panel > .panel-heading{
            background-color: #3e3e3e ;
            color: #fff;
          }
          h3{
            text-align: center;
          }
          body,html{
            background-image: url("img/bg.png");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            height:100%;
          }
        </style>
    </head>
    <body class="skin-black">
        <div class="container" style="margin-top:30px">
          <div class="col-md-4 col-md-offset-4">
          <center><img src="img/logo.png" width="150px" height="150px" class="" alt="Cinque Terre"></center>
            <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title"><strong>CKC - Online Grading System</strong></h3></div>
            <div class="panel-body">
              <form role="form" method="post">
                <div class="form-group">
                  <label for="txt_username">Username</label>
                  <input type="text" class="form-control" style="border-radius:0px" name="txt_username" placeholder="Enter Username">
                </div>
                <div class="form-group">
                  <label for="txt_password">Password</label>
                  <input type="password" class="form-control" style="border-radius:0px" name="txt_password" placeholder="Enter Password">
                </div>
                <button type="submit" class="btn btn-sm btn-primary" name="btn_login">Log in</button>
              </form>
            </div>
        </div>
<?php
include "pages/connection.php";
if(isset($_POST['btn_login']))
{ 
  $u = mysqli_real_escape_string($con,$_POST['txt_username']);
  $p = mysqli_real_escape_string($con,$_POST['txt_password']);

  $query = mysqli_query($con,"SELECT * FROM tbl_user_account WHERE username='$u'");
  $row = mysqli_fetch_assoc($query);
  if ($row['u_code']==1):
    $_SESSION['role'] = "Administrator";
    $_SESSION['userid'] = $row['user_id'];
    header ('location: pages/dashboard/dashboard.php');
  elseif ($row['u_code']==3):
    $_SESSION['role'] = "Teacher";
    $_SESSION['userid'] = $row['user_id'];
    header ('location: pages/student/student.php');
  elseif ($row['u_code']==2):
    $_SESSION['role'] = "Student";
    $_SESSION['userid'] = $row['user_id'];
    header ('location: pages/grade/grade.php');
  else:
    echo "<div class='alert alert-danger' role='alert'>
            Invalid Username or Password!
          </div>";
  endif;             
}
?>
          </div>
        </div>
    </body>
</html>
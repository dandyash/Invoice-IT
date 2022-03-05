<?php
session_start();
error_reporting(0);

include("connection.php");
if(isset($_POST['submit']))
{
$ret=mysqli_query($conn,"SELECT * FROM admin_master WHERE admin_un='".$_POST['admin_un']."' and admin_pass='".$_POST['admin_pass']."'");
$num=mysqli_fetch_array($ret);
if($num>0)
{
$extra="index.php";
$_SESSION['login']=$_POST['admin_un'];
$_SESSION['id']=$num['admin_id']; 
$host=$_SERVER['HTTP_HOST'];
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
exit();
}
else
{
$_SESSION['errmsg']="Invalid username or password";
$extra="login.php";
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
exit();
}
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentelella Alela! | </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="POST">
              <h1>Login Form</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" name="admin_un" autocomplete="off" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" name="admin_pass" autocomplete="off" required="" />
              </div>
              <div>
                <button type="submit" class="form-control btn-primary"  name="submit">Log in</button>
              <!--<a class="reset_pass" href="#">Lost your password?</a>-->
              </div>

              <div class="clearfix"></div>

            

                
              </div>
            </form>
          </section>
        </div>

      </div>
    </div>
  </body>
</html>

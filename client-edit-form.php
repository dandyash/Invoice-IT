<?php
session_start();

include('connection.php');
include('check-login.php');
check_login();

if(isset($_GET['id']));
{
$id=$_GET['id'];
$q = "SELECT u_name, u_addr, u_phn, u_email, u_gstn_no, city_id, state_id, country_id from client_master where u_id=$id";

$res = mysqli_query($conn,$q);

while($row=mysqli_fetch_assoc($res))
{
  $name = $row['u_name'];
  $add = $row['u_addr'];
  $co = $row['country_id'];
  $s = $row['state_id'];
  $ci = $row['city_id'];
  $ph = $row['u_phn'];
  $mail = $row['u_email'];
  $gst = $row['u_gstn_no'];
}

}
?>
<?php
include('connection.php');
if(isset($_POST['submit'])) {
   $name = $_POST['name'];
   $adr = $_POST['address'];

   $phn = $_POST['phone'];
   $country = $_POST['country'];
   $state = $_POST['state'];
   $city = $_POST['city'];
   $mail = $_POST['email'];
   $gstn = $_POST['gstn'];

   
    $query = "UPDATE client_master SET u_name = '$name' , u_addr = '$adr' ,u_phn = '$phn' , u_email = '$mail' , u_gstn_no = '$gstn'  WHERE u_id=$id";
    $result1 = mysqli_query($conn, $query);
    if ($result1) {
        echo "<script>alert('Successfully Updated.');</script>";
        header("location:index.php");
        
    }
   
  
    else{
    echo $query; 
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
    
    <title>Invoice </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="../vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="../vendors/starrr/dist/starrr.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <title>Edit Info </title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
    <link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
    <link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/plugins.css">
    <link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
    
    <script type="text/javascript">
function valid()
{
 if(document.registration.password.value!= document.registration.password_again.value)
{
alert("Password and Confirm Password Field do not match  !!");
document.registration.password_again.focus();
return false;
}
return true;
}

</script>
    

  </head>

  <body style="background: white " class="nav-md">
    <div class="container body">
      <div class="main_container">
            <!-- sidebar menu -->
          <?php include "sidebar-menu.php"; ?>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
        <!-- /top navigation -->
<?php include('header.php'); ?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Client Form</h3>
              </div>

         <!--     <div class="title_right">
                <div class="col-md-5 col-sm-5  form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>  -->
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Client Edit Form <small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      
                                          </ul>
                    <div class="clearfix"></div>
                  </div>
        <!-- start: REGISTER BOX -->
        <div class="x_content">
                    <br />
                    <form id="registration" data-parsley-validate class="form-horizontal form-label-left"  method="post" action="" onSubmit="return valid();">
                    
              <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Full  Name    <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                <input type="text" class="form-control" name="name" value="<?php echo $name; ?>" placeholder="Full Name" autocomplete="off">
                                <span class="text-danger"><?php if (isset($nameErr)){echo $nameErr;}?></span>
              </div>
            </div>
              <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">   Address    <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                <input type="text" class="form-control" name="address" value="<?php echo $add ?>" placeholder="Address" autocomplete="off">
                                <span class="text-danger"><?php if (isset($addErr)){echo $addErr;}?></span>
              </div>
            </div>
                            <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Country Name    <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <select name="country" id="country" class="form-control">
                            <?php
                             
                             $c=mysqli_query($conn,"select * from countries where country_id=$co") or die("error");
                             while($row=mysqli_fetch_array($c))
                             //$row=mysqli_fetch_array($q)
                                
                             echo "<option value='$co'>$row[country_name]</option>";
                         
                        
                        ?></select>
                        </div>
                      </div>
                  
     
                     <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">State Name    <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                    <select name="state" id="state" class="form-control">
                            <?php
                             
                             $c=mysqli_query($conn,"select * from states where state_id=$s") or die("error");
                             while($row=mysqli_fetch_array($c))
                             //$row=mysqli_fetch_array($q)
                                
                             echo "<option value='$s'>
                             $row[state_name]</option>";
                         
                        
                        ?></select> 
                        </div>
                        </div>      
                                                
                                        
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">City     <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 "> 
                        <select name="city" id="city" class="form-control">
                            <?php
                             
                             $c=mysqli_query($conn,"select * from cities where city_id=$ci") or die("error");
                             while($row=mysqli_fetch_array($c))
                             //$row=mysqli_fetch_array($q)
                                
                             echo "<option value='$ci'>
                             $row[city_name]</option>";
                         
                        
                        ?></select>
                    </div>
                </div>

                        <div>
              
                            
                             <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">
                          Phone Number    <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                                <input type="text" class="form-control" placeholder="Phone number" value="<?php echo $ph; ?>" name="phone" minlength="10" maxlength="10" autocomplete="off">
                                <span class="text-danger"><?php if (isset($phnErr)){echo $phnErr;}?></span>
                            </div>
                           </div> 

           
              <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">
                          Email    <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                <span class="input-icon">
                  <input type="text" autocomplete="off" class="form-control" name="email" id="email" value="<?php echo $mail;?>" onBlur="userAvailability()"  placeholder="Email" >
                   </span>
                   <span id="user-availability-status1" style="font-size:12px;"></span>
                                <span class="text-danger"><?php if (isset($mailErr)){echo $mailErr;}?></span>
              </div>
            </div>

              <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">
                          GST Number    <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                                <input type="text" class="form-control" name="gstn" id="gstn" placeholder="GST no"  autocomplete="off" minlength="15" maxlength="15"value="<?php echo $gst;?>" > 
                                <span class="text-danger"><?php if (isset($bgroupErr)){echo $bgroupErr;}?></span>
                            </div>
                        </div>

                <span class="text-danger"><?php if (isset($msg)){echo $msg  ;}?></span>
                <button type="submit" class="btn btn-primary pull-right" id="submit" name="submit">
                  Update <i class="fa fa-arrow-circle-right"></i>
                </button>
              </div>
            </fieldset>
          </form>



        </div>

      </div>
    </div>
    
    <script>
      jQuery(document).ready(function() {
        Main.init();
        Login.init();
      });
      document.getElementById("blood").value = "<?php echo $bgroup; ?>";
            document.getElementById("area").value = "<?php echo $area; ?>";
            document.getElementById("dob").value = "<?php echo $daob; ?>";
            document.getElementById("rg-"+"<?php echo $gen; ?>").checked = true;
    </script>

        <script>
    $(document).ready(function()
{
    
  $("#country").change(function()
  {
    var id=$(this).val();
    var dataString = 'id='+ id;
    $("#state").find('option').remove();
    $(".city").find('option').remove();
    $.ajax
    ({
      type: "POST",
      url: "get_state.php",
      data: dataString,
      cache: false,
      success: function(html)
      {
        $("#state").html(html);
      } 
    });
  });
    $("#state").change(function()
  {
    var id=$(this).val();
    var dataString = 'id='+ id;
  
    $.ajax
    ({
      type: "POST",
      url: "get_city.php",
      data: dataString,
      cache: false,
      success: function(html)
      {
        $("#city").html(html);
      } 
    });
       
  });
}); 
 
    </script>
    
  <script>
function userAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'email='+$("#email").val(),
type: "POST",
success:function(data){
$("#user-availability-status1").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script> 
    

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
   <script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="../vendors/google-code-prettify/src/prettify.js"></script>
    <!-- jQuery Tags Input -->
    <script src="../vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    <!-- Switchery -->
    <script src="../vendors/switchery/dist/switchery.min.js"></script>
    <!-- Select2 -->
    <script src="../vendors/select2/dist/js/select2.full.min.js"></script>
    <!-- Parsley -->
    <script src="../vendors/parsleyjs/dist/parsley.min.js"></script>
    <!-- Autosize -->
    <script src="../vendors/autosize/dist/autosize.min.js"></script>
    <!-- jQuery autocomplete -->
    <script src="../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    <!-- starrr -->
    <script src="../vendors/starrr/dist/starrr.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
  </body>
  <!-- end: BODY -->
</html>
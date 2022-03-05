<?php 
session_start();
include('connection.php');
include('check-login.php');
check_login();

  $q = mysqli_query($conn, "SELECT * FROM client_master");
  $client_counter = 0;
  while ($row = Mysqli_fetch_array($q)) {
    $client_counter = $client_counter + 1;
  }
  $q1 = mysqli_query($conn,"SELECT * from invoice_master");
  $invoice_counter =0;
  while($row1 = Mysqli_fetch_array($q1))
  {
    $invoice_counter = $invoice_counter + 1;
  }
  $q2 = mysqli_query($conn,"SELECT * from product_master");
  $product_counter =0;
  while($row2 = Mysqli_fetch_array($q2))
  {
    $product_counter = $product_counter + 1;
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
  <link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>TPES</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
  
    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
                <!-- sidebar menu -->
     <?php include "sidebar-menu.php"; ?>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            
        <!-- top navigation -->
        <?php include "header.php"; ?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          
          <!-- /top tiles -->

          <div class="row">
            <div class="col-md-12 col-sm-12 ">
              <div class="dashboard_graph">

                <div class="row x_title">
          

          <div class="row">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <div class="">
              <div class="x_panel tile overflow_hidden" style="text-align: center;">
                <div class="x_content">
                  <button type="button" style="width: 60px; height: 60px; border-radius: 50px; color: white; background: #0e4052; border-color: transparent;" ><i class="fa fa-user fa-2x" aria-hidden="true"></i></button>
                  <h1>Total Clients : <?php echo $client_counter; ?></h1> 
                  <h1><a href="client-edit.php" class="btn btn-primary" style="color: white; background: #0e4052; border-color: transparent;">Manage Clients</a></h1>
                </div>
              </div>
            </div>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <div class="">
              <div class="x_panel tile overflow_hidden" style="text-align: center;">
                <div class="x_content">
                  <button type="button" style="width: 60px; height: 60px; border-radius: 50px; color: white; background: #0e4052; border-color: transparent;" ><i class="fa fa-user fa-2x" aria-hidden="true"></i></button>
                  <h1>Total Invoices : <?php echo $invoice_counter; ?></h1> 
                  <h1><a href="view-invoice.php" class="btn btn-primary" style="color: white; background: #0e4052; border-color: transparent;">Manage Invoices</a></h1>
                </div>
              </div>
            </div>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <div class="">
              <div class="x_panel tile overflow_hidden" style="text-align: center;">
                <div class="x_content">
                  <button type="button" style="width: 60px; height: 60px; border-radius: 50px; color: white; background: #0e4052; border-color: transparent;" ><i class="fa fa-user fa-2x" aria-hidden="true"></i></button>
                  <h1>Total Products : <?php echo $product_counter; ?></h1> 
                  <h1><a href="product-edit.php" class="btn btn-primary" style="color: white; background: #0e4052; border-color: transparent;">Manage Product</a></h1>
                </div>
              </div>
            </div>
                      

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="../vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="../vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="../vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="../vendors/Flot/jquery.flot.js"></script>
    <script src="../vendors/Flot/jquery.flot.pie.js"></script>
    <script src="../vendors/Flot/jquery.flot.time.js"></script>
    <script src="../vendors/Flot/jquery.flot.stack.js"></script>
    <script src="../vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="../vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="../vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="../vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
  
  </body>
</html>

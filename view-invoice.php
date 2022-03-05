<?php
session_start();

include("connection.php");
include('check-login.php');
check_login();



$total = 0;
$q = mysqli_query($conn,"SELECT * FROM invoice_master");
while ($row = mysqli_fetch_array($q)) {
    $total = $total + $row['grand_total'];
    $last_invoice_date = $row['issue_date'];
}
$quantity = 0;
$q = mysqli_query($conn,"SELECT * FROM sub_invoice_master");
while ($row1 = mysqli_fetch_array($q)) {
    $quantity = $quantity + $row1['quantity'];
}
$avg_cost = $quantity / $total;
$date = date('Y');
//echo $date;
$q = mysqli_query($conn,"SELECT * FROM company_master");
while ($row2 = mysqli_fetch_array($q)) {
    $com_date = date_create($row2['company_year']);
    $com_birthdate = $row2['company_year'];
}
$com_year = date_format($com_date,"Y");
$year = $date - $com_year;
//find the yearly average
$avg = $total/$year;
//find the month average
 $date1 = $com_birthdate;
 $date2 = date('Y-m-d');
 $d1=new DateTime($date2); 
 $d2=new DateTime($date1);                                  
 $Months = $d2->diff($d1); 
 $howeverManyMonths = (($Months->y) * 12) + ($Months->m);
//echo $howeverManyMonths;
 $month_avg =$total / $howeverManyMonths;
?>
<html>
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
       
   <?php include "header.php"; ?>

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>Manage Invoice</h3>
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
                                <h2> Manage Invoice <small></small></h2>
                                <ul class="nav navbar-right panel_toolbox">

                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <form method="post" action="">
                                <h3>Total Earnings (USD) : <?php echo $total; ?></h3> 
                                <h3>Total Images : <?php echo $quantity; ?></h3> 
                                <h3>Last Invoice Date : <?php echo $last_invoice_date; ?></h3> 
                                <h3>Average Cost Per Image : <?php echo number_format($avg_cost,2); ?></h3> 
                                <h3>Company Total Years : <?php echo $year; ?></h3> 
                                <h3>Company Yearly Average : <?php echo $avg; ?></h3>
                                <h3>Company Monthly Average : <?php echo $month_avg ; ?></h3>
                            </form>
                            <table class="table table-hover" id="sample-table-1">
                                <a  class="btn btn-success" href="invoice_excel.php">Export to Excel</a>
                                <thead>
                                <tr>
                                    <th>Invoice No <a href="view-invoice.php?invoice=0 "><i class="fa fa-arrow-up"></i></a>&nbsp;<a href="view-invoice.php?invoice=1 "><i class="fa fa-arrow-down"></i></a> </th>
                                    <th>Client Name <a href="view-invoice.php?name=0 "><i class="fa fa-arrow-up"></i></a>&nbsp; <a href="view-invoice.php?name=1 "><i class="fa fa-arrow-down"></i></a></th>
                                    <th>Client Issue Date <a href="view-invoice.php?idate=0 "><i class="fa fa-arrow-up"></i></a>&nbsp; <a href="view-invoice.php?idate=1 "><i class="fa fa-arrow-down"></i></a></th>
                                    <th>Client Due Date <a href="view-invoice.php?ddate=0 "><i class="fa fa-arrow-up"></i></a>&nbsp; <a class="" href="view-invoice.php?ddate=1 "><i class="fa fa-arrow-down"></i></a></th>


                                    <th>Action</th>
                                </tr>
                                </thead>
                                <?php

                                if(!isset($_GET['invoice']) && !isset($_GET['name']) && !isset($_GET['idate']) && !isset($_GET['ddate']) )
                                {
                                $query="SELECT * from invoice_master i JOIN client_master c on i.u_id = c.u_id";
                                $sql=mysqli_query($conn,$query);
                                }
                                elseif(isset($_GET['invoice']))
                                {

                                    if ($_GET['invoice'] == 1)
                                    {
                                        $query = "SELECT * from invoice_master i JOIN client_master c on i.u_id = c.u_id ORDER BY i.invoice_no DESC ";
                                        $sql = mysqli_query($conn, $query);

                                    }
                                    else
                                    {
                                        $query = "SELECT * from invoice_master i JOIN client_master c on i.u_id = c.u_id ";
                                        $sql = mysqli_query($conn, $query);

                                    }
                                }
                                elseif(isset($_GET['name']))
                                {

                                    if ($_GET['name'] == 1)
                                    {
                                        $query = "SELECT * from invoice_master i JOIN client_master c on i.u_id = c.u_id ORDER BY c.u_name DESC ";
                                        $sql = mysqli_query($conn, $query);

                                    }
                                    else
                                    {
                                            $query = "SELECT * from invoice_master i JOIN client_master c on i.u_id = c.u_id ";
                                        $sql = mysqli_query($conn, $query);

                                    }
                                }
                                elseif(isset($_GET['idate']))
                                {

                                    if ($_GET['idate'] == 1)
                                    {
                                        $query = "SELECT * from invoice_master i JOIN client_master c on i.u_id = c.u_id ORDER BY i.issue_date DESC ";
                                        $sql = mysqli_query($conn, $query);

                                    }
                                    else
                                    {
                                        $query = "SELECT * from invoice_master i JOIN client_master c on i.u_id = c.u_id ";
                                        $sql = mysqli_query($conn, $query);

                                    }
                                }
                                elseif(isset($_GET['ddate']))
                                {

                                    if ($_GET['ddate'] == 1)
                                    {
                                        $query = "SELECT * from invoice_master i JOIN client_master c on i.u_id = c.u_id ORDER BY i.due_date DESC ";
                                        $sql = mysqli_query($conn, $query);

                                    }
                                    else
                                    {
                                        $query = "SELECT * from invoice_master i JOIN client_master c on i.u_id = c.u_id ";
                                        $sql = mysqli_query($conn, $query);

                                    }
                                }
                                $row=mysqli_num_rows($sql);
                                if($row!=0)
                                {
                                    while($res=mysqli_fetch_assoc($sql))
                                    {   
                                        $user_id_no = $res['u_id'];

                                        $length = strlen((string)$user_id_no);
                                        if ($length == 1) {
                                            $user_id = "00".$user_id_no;
                                        }
                                        elseif ($length == 2) {
                                            $user_id = "0".$user_id_no;    
                                        }
                                        else{
                                            $user_id = $user_id_no;
                                        }
                                        $invoice_number = $res['invoice_no'];
                                        $length1 = strlen((string)$invoice_number);
                                        $no_of_digit = 5;
                                        for ($i=$length1; $i < $no_of_digit; $i++) { 
                                            $invoice_number = "0".$invoice_number; 
                                        }
                                        echo"
								<tr>
								<td>TPESID".$user_id.$invoice_number."</td>
								<td>".$res['u_name']."</td>
								<td>".$res['issue_date']."</td>
								<td>".$res['due_date']."</td>
								<td><a class='btn btn-outline-primary' href ='demo_pdf.php?id=$res[invoice_id]' target='_blank'>Preview Invoice</a>
                                 <a class='btn btn-outline-primary' href ='download_pdf.php?id=$res[invoice_id]' target='_blank'>Send Invoice</a> 
                                </td>

								</tr>
							";
                                    }
                                }
                                else
                                {
                                    echo "<p>No records found</p>";
                                }
                                ?>
                            </table>
                            </form>
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
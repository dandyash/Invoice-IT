<?php
session_start();
include('connection.php');
include('check-login.php');
check_login();
if(isset($_GET['view']));
{
    $id=$_GET['view'];
    $q = "SELECT * from invoice_master i JOIN client_master c ON i.u_id=c.u_id where i.invoice_id='$id'";

    $res = mysqli_query($conn,$q);

    while ($row = mysqli_fetch_array($res)) {
        $name = $row['u_name'];
        $invoiceno = $row['invoice_no'];
        $user_id_no = $row['u_id'];

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
                                        $invoice_number = $row['invoice_no'];
                                        $length1 = strlen((string)$invoice_number);
                                        $no_of_digit = 5;
                                        for ($i=$length1; $i < $no_of_digit; $i++) { 
                                            $invoice_number = "0".$invoice_number; 
                                        }
    }
    $invoice = "TPESID".$user_id.$invoice_number;


}
if (isset($_GET['success'])) {
    echo "<script>alert('All Edited Successfully !!');</script>";
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

<body style="background: white " class="nav-md" >
<div class="container body">
    <div class="main_container">
                <?php include "sidebar-menu.php"; ?>
                <!-- /sidebar menu -->

                <!-- /menu footer buttons -->
       <?php include 'header.php'; ?>
        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>View Details</h3>
                    </div>


                </div>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 ">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>View Details<small></small></h2>
                                <ul class="nav navbar-right panel_toolbox">

                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <!-- start: REGISTER BOX -->
                            <div class="x_content">
                                <br />
                                <form id="registration" data-parsley-validate class="form-horizontal form-label-left"  method="post" action="edit_product.php" >



                                   
                                        <h3><label class="" for="first-name">Client  Name:</label>
                                        <label class="" for="first-name"><?php echo "$name"; ?></label>
                                        </h3>
                                        <br><h3>
                                        <label class="" for="first-name"> Invoice Number: </label>
                                        <label class="" for="first-name"><?php echo "$invoice"; ?></label></h3>
                                    </div>

                            </div>
                            <table class="table table-hover" id="sample-table-1">
                                <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Description</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Final Price</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                $query="SELECT * from sub_invoice_master si JOIN product_master p ON si.product_id=p.product_id JOIN invoice_master i ON si.invoice_id=i.invoice_id JOIN client_master c ON i.u_id=c.u_id where si.invoice_id='$id'";                                $sql=mysqli_query($conn,$query);
                                $row=mysqli_num_rows($sql);
                                
                                if($row!=0)
                                {
                                    $_SESSION['counter'] = 1;

                                    while($res=mysqli_fetch_assoc($sql))
                                    {
                                        ?>
								<tr>
								<td>
                                    <select name="product_<?php echo $_SESSION['counter'];?>" id="product_<?php echo $_SESSION['counter'];?>" class="form-control-sm form-control" onload="product_selection(<?php echo $_SESSION['counter'];?>)">
                    <option value="Select area">Select a Product</option>
                                      <?php

                                      $c=mysqli_query($conn,"select * from product_master") or die("error");
                                      while($row=mysqli_fetch_array($c))
                                        {
                                        echo "<option value='$row[product_id]'>
                               $row[product_name]</option>";
                                        }
                                      ?></select>
                                      <input type='hidden' class='form-control' id='product_id_<?php echo $_SESSION['counter']; ?>' name='product_id_<?php echo $_SESSION['counter']; ?>' value='<?php echo $res['product_id']; ?>'>
                                            </td>
								<td>
                                <input type='hidden' class='form-control' name='sub_invoice_<?php echo $_SESSION['counter']; ?>' value='<?php echo $res['sub_invoice_id']; ?>' placeholder='Product quantity' autocomplete='off'>
					            <input type='text' class='form-control' name='description_<?php echo $_SESSION['counter']; ?>' value='<?php echo $res['description']; ?>' placeholder='Product Name' autocomplete='off'>
								</td>
								<td>
								<input type='text' class='form-control' id='quantity_<?php echo $_SESSION['counter'];?>' name='quantity_<?php echo $_SESSION['counter'];?>' value='<?php echo $res['quantity'];?>' placeholder='Product quantity' autocomplete='off' onchange="finalAmount(<?php echo $_SESSION['counter'];?>);grandtotal()">
								</td>
								<td>
								<input type='text' class='form-control' id='unit_price_<?php echo $_SESSION['counter'];?>' name='unit_price_<?php echo $_SESSION['counter'];?>' value='<?php echo $res['unit_price'];?>' placeholder='Product quantity' autocomplete='off' onchange="finalAmount(<?php echo $_SESSION['counter'];?>);grandtotal()">
								</td>
								<td>
								<input type='text' class='form-control' id='final_price_<?php echo $_SESSION['counter']; ?>' name='final_price_<?php echo $_SESSION['counter']; ?>' value='<?php echo $res['final_price'];?>' placeholder='Product quantity' autocomplete='off' readonly>
								</td>
                                <td>
                                <a href='view-more.php?view=<?php echo $id;?>&delete=<?php echo $res['sub_invoice_id'];?>' class='btn btn-danger'>Delete</a>
                                </td>
								</tr>
								
                               
								
						<?php 
                            $_SESSION['counter'] = $_SESSION['counter'] + 1;
                                    }?>
                                    <input type='hidden' class='form-control' name='invoice_view' value='<?php echo $id;?>'>
                                    <input type='hidden' class='form-control' id='product_counter' name='product_counter' value='<?php echo $_SESSION['counter'];?>'>
                                    </tbody>
                                    <thead>
        <td></td>
        <td></td>
        <td></td>
        <td><label>Sub Total</label><br><br><br><label>PayPal Charges</label><br><br><br><label>Grand Total</label></td>
        <?php $total_q = mysqli_query($conn,"SELECT * FROM invoice_master WHERE invoice_id='$id'"); 
        while($row1 = mysqli_fetch_array($total_q)){
          $sub_total = $row1['sub_total'];
          $_SESSION['sub_total'] = $sub_total;
          $_SESSION['paypal_charges'] = $row1['paypal_charges'];
          ?>
        <td><input type="text" name="sub_total" class="form-control" id="sub_total" value="<?php echo $row1['sub_total']; ?>" readonly><br><input type="text" class="form-control" name="paypal_charges" id="paypal_charges" value="<?php echo $row1['paypal_charges']; ?>" onchange="grandtotal()"><br><input type="text" name="grand_total" id="grand_total" class="form-control" value="<?php echo $row1['grand_total']; ?>" readonly></td>
      <?php } ?>
    </thead>
                                    </table>
                                    <a href='add_product.php?id=<?php echo $id;?>'  class='btn btn-primary pull-right'>
                                    Add
                                    </a>
                                     </tbody>
                            </table>
								    <button type='submit' class='btn btn-primary pull-right' name='submit'>
                                    Update
                                    </button>
                                <?php }
                                else
                                {
                                    echo "
                                         </tbody>
                                        </table>
                                        <h3>No records found</h3>
                                    <a href='add_product.php?id=$id'  class='btn btn-primary pull-right'>
                                    Add
                                    </a>";

                                }
                                ?>



                            </fieldset>
                            </form>

                            <?php 
                                if (isset($_GET['delete'])) {
        $del_id = $_GET['delete'];
    $fp = mysqli_query($conn,"SELECT final_price FROM sub_invoice_master WHERE sub_invoice_id='$del_id'");
    while ($d = mysqli_fetch_array($fp)) {
        $digit = $d['final_price'];
    }
    $edited_sub_total = $_SESSION['sub_total'] - $digit;
    $edited_total = $edited_sub_total * $_SESSION['paypal_charges'] / 100 ;
    $edited_grand_total = $edited_sub_total + $edited_total;
    //echo $edited_sub_total;
    $up = mysqli_query($conn,"UPDATE invoice_master SET sub_total='$edited_sub_total' , grand_total='$edited_grand_total'");
    $del = mysqli_query($conn,"DELETE FROM sub_invoice_master WHERE sub_invoice_id = '$del_id'");
    if ($del && $up ) {
        ?>
            <script>
    window.onload = function() {
    //considering there aren't any hashes in the urls already
    if(!window.location.hash) {
        //setting window location
        window.location = window.location + '#loaded';
        //using reload() method to reload web page
        window.location.reload();
    }
}
</script>
    <?php
    }
    
}
                             ?>

                        </div>

                    </div>
                </div>
                <script src="vendor/jquery/jquery.min.js"></script>
                <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
                <script src="vendor/modernizr/modernizr.js"></script>
                <script src="vendor/jquery-cookie/jquery.cookie.js"></script>
                <script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
                <script src="vendor/switchery/switchery.min.js"></script>
                <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
                <script src="assets/js/main.js"></script>
                <script src="assets/js/login.js"></script>
                <script src="//cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
                <script src="//cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
                <script src="//cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
                <script src="//cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
                <script src="assets/js/main.js"></script>


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
                    var i;
                    var c = Number(document.getElementById("product_counter").value);
                    for (i = 1; i < c; i++) {
                        var pro_select = document.getElementById("product_"+i);
                        var pro_id = document.getElementById("product_id_"+i);
                        pro_select.value = pro_id.value;
                    }
                </script>
                <script>
                     var result = "<?php echo $sub_total; ?>";
      function finalAmount(counter){
        
        var s = document.getElementById("sub_total");
        var f1  = Number(document.getElementById("final_price_"+counter).value);
        var q = Number(document.getElementById("quantity_"+counter).value);
        var u = Number(document.getElementById("unit_price_"+counter).value);
        var f = document.getElementById("final_price_"+counter);
        f.value = q * u;
        var h = Number(document.getElementById("final_price_"+counter).value);
        result = Number(result) - f1 + h;
        s.value = Number(result);
      
      
      }
      var percentage = 0;
      function grandtotal(){
        var st = Number(document.getElementById("sub_total").value);
        var pc = Number(document.getElementById("paypal_charges").value);
        percentage = st * pc / 100;
        var gt = document.getElementById("grand_total");
        gt.value = st + percentage;
      }

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
<!-- end: BODY -->
</html>
<?php 
session_start();
include "connection.php";

STATIC $counter = 1;


//echo $date;
$id = $_GET['id'];

if(isset($_POST['submit']))
{


$hf = $_POST['hidden_field'];
$sub_total = $_POST['sub_total'];
$paypal_charges = $_POST['paypal_charges'];
$grand_total = $_POST['grand_total'];


  for($i=1 ; $i<=$hf ; $i++)
  {

$product = $_POST['product_'.$i];    
$description = $_POST['description_'.$i];
$quantity = $_POST['quantity_'.$i];
$unit_price = $_POST['unit_price_'.$i];
$final_price = $_POST['final_price_'.$i];

    $qy1 = "Insert Into sub_invoice_master (invoice_id, product_id, description, quantity, unit_price, final_price) values ('$id', '$product', '$description', '$quantity', '$unit_price' ,'$final_price');";
    $query2 = mysqli_query($conn,$qy1);
    


  }
if($query2)
{
$qw = "update invoice_master set sub_total = '$sub_total' , paypal_charges = '$paypal_charges' , grand_total = '$grand_total' where invoice_id = '$id' ";
$qe = mysqli_query($conn,$qw);
  if($qe)
  {
   header("location:update_pdf.php?id=".$id."");
      
  }

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
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
            <!-- /menu profile quick info -->

            <!-- sidebar menu -->
          <?php include "sidebar-menu.php"; ?>
            <!-- /sidebar menu -->
<?php include('header.php'); ?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Invoice Details Entry Form</h3>
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
                    <h2>INVOICE <small>Details Entry Form </small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                                          </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" method="post" data-parsley-validate class="form-horizontal form-label-left">
                      <table class="table table-hover">
    <thead>
      <th>Product</th>
      <th>Description</th>
      <th>Quantity</th>
      <th>Unit Price</th>
      <th>Final Price of Product</th>
    </thead>
    <tbody>
      <tr>
      <td>                           
          <select name="product_<?php echo $counter;?>" id="product_<?php echo $counter;?>" class="form-control-sm form-control">
                      <option value="Select area">Select a Product</option>
                                        <?php

                                        $c=mysqli_query($conn,"select * from product_master") or die("error");
                                        while($row=mysqli_fetch_array($c))
                                            //$row=mysqli_fetch_array($q)

                                            echo "<option value='$row[product_id]'>
                                 $row[product_name]</option>";

                                        ?></select>
              </td>
      <td><input type="text" id="description_1" name="description_1"/></td>
      <td><input type="text" id="quantity_1" name="quantity_1" onchange="finalAmount(1);grandtotal();" /></td>
      <td><input type="text" id="unit_price_1" name="unit_price_1" onchange="finalAmount(1);grandtotal();" /></td>
      <td><input type="text" id="final_price_1" name="final_price_1" readonly/>
          <input type="hidden" name="hidden_field" id="hidden_field" value="1"></td>
    </tr>
    </tbody>
    <thead>
        <td></td>
        <td></td>
        <td></td>
        <td><label>Sub Total</label><br><br><label>PayPal Charges</label><br><br><label>Grand Total</label></td>
        <?php $total_q = mysqli_query($conn,"SELECT * FROM invoice_master WHERE invoice_id='$id'"); 
        while($row1 = mysqli_fetch_array($total_q)){
          $sub_total = $row1['sub_total'];?>
        <td><input type="text" name="sub_total" id="sub_total" value="<?php echo $row1['sub_total']; ?>" readonly><br><br><input type="text" name="paypal_charges" id="paypal_charges" value="<?php echo $row1['paypal_charges']; ?>" onchange="grandtotal()"><br><br><input type="text" name="grand_total" id="grand_total" value="<?php echo $row1['grand_total']; ?>" readonly></td>
      <?php } ?>
    </thead>
  </table>
  <br>


     <br>




                      <div class="ln_solid"></div>
                      <div class="item form-group">
                        <div class="col-md-6 col-sm-6 offset-md-3">
                          <button class="btn btn-danger" type="button">Cancel</button>
						  <button class="btn btn-danger" type="reset">Reset</button>
                          <button type="submit" name="submit" class="btn btn-success">Update Invoice</button>
                           <button type="button" name="submit" class="btn btn-primary" onclick="addFunction()">Add Product</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>


        <!-- /page content -->

        <!-- footer content -->
            <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script type="text/javascript">
      var result = 0;
      function finalAmount(counter){
        
        var s = document.getElementById("sub_total");
        var s1 = Number(document.getElementById("sub_total").value);
        var s2 = "<?php echo $sub_total; ?>";
        var f1  = Number(document.getElementById("final_price_"+counter).value);
        var q = Number(document.getElementById("quantity_"+counter).value);
        var u = Number(document.getElementById("unit_price_"+counter).value);
        var f = document.getElementById("final_price_"+counter);
        f.value = q * u;
        var h = Number(document.getElementById("final_price_"+counter).value);
        result = result - f1 + h;
        s.value = Number(s2) + result;
      
      
      }
      var percentage = 0;
      function grandtotal(){
        var st = Number(document.getElementById("sub_total").value);
        var pc = Number(document.getElementById("paypal_charges").value);
        percentage = st * pc / 100;
        var gt = document.getElementById("grand_total");
        gt.value = st + percentage;
      }
      let count = 1;
      function addFunction(){
        count++;
        var x = document.getElementById("hidden_field");
        x.value = count;
        markup = "<tr><td><select name='product_"+count+"' id='product_"+count+"' class='form-control-sm form-control'><option value='Select area'>Select a Product</option><?php
$q1 = 'select * from product_master';
$query = mysqli_query($conn,$q1);
while($row = mysqli_fetch_array($query))
{
    echo "<option value='$row[product_id]'>$row[product_name]</option>";
}
         ?></select></td>      <td><input type='text' id='description_"+count+"' name='description_"+count+"'/></td><td><input type='text' id='quantity_"+count+"' name='quantity_"+count+"' onchange='finalAmount("+count+");grandtotal();' /></td><td><input type='text' id='unit_price_"+count+"' name='unit_price_"+count+"' onchange='finalAmount("+count+");grandtotal();' /></td><td><input type='text' id='final_price_"+count+"' name='final_price_"+count+"' readonly/></td></tr>";
        tableBody = $("table tbody"); 
        tableBody.append(markup); 
      }
    </script>
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
</html>

<!DOCTYPE html>
<?php 
include "connection.php";
?>
<html>
<head>
	<title></title>
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
<body style="background: white;">
	<table  cellspacing="0" class="form-control-sm form-control">
		<tr>
			<th>Product</th>
			<th>Description</th>
			<th>Quantity</th>
			<th>Unit Price</th>
			<th>Final Price of Product</th>
		</tr>
		<tr>
			<td>                           
				<select name="product" id="product" class="form-control-sm form-control"s tyle="							width: 200px;">
                    <option value="Select area">Select a Product</option>
                                      <?php

                                      $c=mysqli_query($conn,"select * from product_master") or die("error");
                                      while($row=mysqli_fetch_array($c))
                                          //$row=mysqli_fetch_array($q)

                                          echo "<option value='$row[product_id]'>
                               $row[product_name]</option>";

                                      ?></select>
            </td>
			<td><input type="text" name="xyz"/></td>
			<td><input type="text" name="xvr"/></td>
			<td><input type="text" name="xvr"/></td>
			<td><input type="text" name="xvr"/></td>
		</tr>
	</table>
	 <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Select Product <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                           <select name="product" id="product" class="form-control-sm form-control">
                                      <option value="Select area">Select a Product</option>
                                      <?php

                                      $c=mysqli_query($conn,"select * from product_master") or die("error");
                                      while($row=mysqli_fetch_array($c))
                                          //$row=mysqli_fetch_array($q)

                                          echo "<option value='$row[product_id]'>
                               $row[product_name]</option>";

                                      ?></select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Description<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="text" id="Description" name="description" required="required" class="form-control">
                        </div>
                      </div>
                       <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Quantity<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="text" id="quantity" name="quantity" required="required" class="form-control">
                        </div>
                      </div>
                       <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Unit Price<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="text" id="unit_price" name="unit_price" required="required" class="form-control">
                        </div>
                      </div>
</body>
</html>
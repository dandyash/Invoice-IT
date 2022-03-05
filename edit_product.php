<?php
session_start();
include 'connection.php';
if(isset($_POST['submit'])) {
    for ($i=1; $i < $_SESSION['counter']; $i++) {
        
    $product = $_POST['product_'.$i];
    $description = $_POST['description_'.$i];
    $quantity = $_POST['quantity_'.$i];
    $unit = $_POST['unit_price_'.$i];
    $final = $_POST['final_price_'.$i];
    $sub_id = $_POST['sub_invoice_'.$i];


    $query = "UPDATE sub_invoice_master SET product_id = '$product', description = '$description' , quantity = '$quantity', unit_price = '$unit' , final_price = '$final' WHERE sub_invoice_id=$sub_id";
    $result1 = mysqli_query($conn, $query);

    echo $query;


    }
    $sub_total = $_POST['sub_total'];
    $grand_total = $_POST['grand_total'];
    $paypal_charges =$_POST['paypal_charges'];
     $id = $_POST['invoice_view'];
   if($result1)
   {
$qw = "update invoice_master set sub_total = '$sub_total' , paypal_charges = '$paypal_charges' , grand_total = '$grand_total' where invoice_id = '$id' ";
$qe = mysqli_query($conn,$qw);    
    echo $qw;

        if($qe)
            {
               
            header('location:update_pdf.php?id='.$id);

    //header('location:view-more.php?view='.$id.'&success=true');

            }
   }


}
?>
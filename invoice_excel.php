<?php
include'connection.php';
$sql="Select * from invoice_master i JOIN client_master c ON i.u_id=c.u_id";
$res=mysqli_query($conn,$sql);
$html='<table><tr><td>Invoice NO</td><td>Client Name</td><td>Issue Date</td><td>Due Date</td><td>Pay Pal Charges</td><td>Grand Total</td></tr>';
while($row=mysqli_fetch_assoc($res)){

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

    $html.='<tr><td>TPESID'.$user_id.$invoice_number.'</td><td>'.$row['u_name'].'</td><td>'.$row['issue_date'].'</td><td>'.$row['due_date'].'</td><td>'.$row['paypal_charges'].'</td><td>'.$row['grand_total'].'</td></tr>';
}
$html.='</table>';
header('Content-Type:application/xls');
header('Content-Disposition:attachment;filename=Invoice List.xls');
echo $html;
?>
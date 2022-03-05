<?php
include'connection.php';
$sql="Select product_name from product_master";
$res=mysqli_query($conn,$sql);
$html='<table><tr><td>Product Name</td></tr>';
while($row=mysqli_fetch_assoc($res)){
	$html.='<tr><td>'.$row['product_name'].'</td></tr>';
}
$html.='</table>';
header('Content-Type:application/xls');
header('Content-Disposition:attachment;filename=Product List.xls');
echo $html;
?>
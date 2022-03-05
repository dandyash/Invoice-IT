<?php
include'connection.php';
$sql="Select u_name,u_addr,u_phn,u_email,u_gstn_no,city_name,state_name,country_name from client_master c JOIN countries co on c.country_id=co.country_id  JOIN states  s on c.state_id=s.state_id  JOIN cities  ci on c.city_id=ci.city_id";
$res=mysqli_query($conn,$sql);
$html='<table><tr><td>Name</td><td>Address</td><td>Phone No.</td><td>Email</td><td>Gst No.</td><td>City Name</td><td>State Name</td><td>Country_name</td></tr>';
while($row=mysqli_fetch_assoc($res)){
	$html.='<tr><td>'.$row['u_name'].'</td><td>'.$row['u_addr'].'</td><td>'.$row['u_phn'].'</td><td>'.$row['u_email'].'</td><td>'.$row['u_gstn_no'].'</td><td>'.$row['city_name'].'</td><td>'.$row['state_name'].'</td><td>'.$row['country_name'].'</td></tr>';
}
$html.='</table>';
header('Content-Type:application/xls');
header('Content-Disposition:attachment;filename=Client Details.xls');
echo $html;
?>
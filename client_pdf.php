<?php
session_start();
include('check-login.php');
check_login();

include 'C:\xampp\htdocs\mpdf\vendor\autoload.php';
include 'connection.php';

$q1 = "select * from company_master";
$query = mysqli_query($conn,$q1);

while($row=mysqli_fetch_array($query))
{
	$c_logo =$row['company_logo'];

}



	


		 
		


	
    
	


$mpdf = new \Mpdf\Mpdf();

$data = " <!DOCTYPE html>
		 <html>
		 <head>
		 	<style>html,body{font-family:DejaVuSans}#company,#billship{margin-bottom:30px}#billship,#company,#items{width:100%;border-collapse:collapse} #company td,#billship td,#items td,#items th{padding:10px}#company td{vertical-align:top}#bigi{margin-bottom:20px;font-size:28px;font-we ight:700;color:#258ec7}#co-addr{font-size:.95em;color:#888}#co-right img{max-width:180px;height:auto}#billship td{width:33%}#items th{text-align:left;background:#98c5dc;padding:20px 10px}#items td{background:#e4eff5;border-bottom:1px solid #c8d2d7}.idesc{color:#6099b6}#items tr.ttl td{background:#98c5dc;border-bottom:none;font-weight:700}.right{text-align:right}#notes{background:#e4eff5;padding:10px;margin-top:30px}
		 	</style>
		 </head>
		 <body>
		 	<div id='invoice'>
		 		<div id='bigi' style='text-align:center;'>TPES-Client List</div>
		 		<table id='company'>
		 			<tr>
		 				
		 				<td id='co-right' class='right'>
		 					<img src='C:/xampp/htdocs/gentelella-master/production/images/".$c_logo."'>
		 				</td>
		 			</tr>
		 		</table>
		 		<table id='items'>
		 			<tr class='ídsec'>
						<th>Client Name	</th>
		 				<th>Client Address</th>
		 				<th>Client Email</th>
		 				<th>Client Phone No.</th>
		 				<th>Client city</th>
		 				<th>Client State</th>
		 				<th>Client Country</th>
		 				<th>Client Gst No</th>


		 	</tr>
";
		 	$mpdf->writeHTML($data);

	$q = mysqli_query($conn,"Select u_name,u_addr,u_phn,u_email,u_gstn_no,city_name,state_name,country_name from client_master c JOIN countries co on c.country_id=co.country_id  JOIN states  s on c.state_id=s.state_id  JOIN cities  ci on c.city_id=ci.city_id");
		 	while ($row1 = mysqli_fetch_array($q)) {
		 	
		 	$data1 =  "<tr class='idsec'>
		 	<td>".$row1['u_name']."</td>
		 	<td>".$row1['u_addr']."</td>
		 	<td>".$row1['u_phn']."</td>
		 	<td>".$row1['u_email']."</td>
		 	<td>".$row1['city_name']."</td>
		 	<td>".$row1['state_name']."</td>
		 	<td>".$row1['country_name']."</td>
		 	<td>".$row1['u_gstn_no']."</td>
		 	</tr>";
		 	$mpdf->writeHTML($data1);
			}
	

		 			
		 		$data2 = "</table>
		 		
		 </body>
		 </html> ";
$mpdf->writeHTML($data2);
$mpdf->output();
?>
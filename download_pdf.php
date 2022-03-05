<?php
session_start();
include('check-login.php');
check_login();
include 'C:\xampp\htdocs\mpdf\vendor\autoload.php';
include 'connection.php';
include 'send_mail.php';


$q1 = "select * from company_master co join countries c on co.country_id = c.country_id join states s on co.state_id = s.state_id join cities ci on co.city_id = ci.city_id";
$query = mysqli_query($conn,$q1);

while($row=mysqli_fetch_array($query))
{
	$c_name = $row['company_name'];
	$c_add = $row['company_address'];
	
	$country_name = $row['country_name'];
	$state_name = $row['state_name'];
	$city_name = $row['city_name'];
	$c_email = $row['company_email'];
	$c_pincode = $row['company_pincode'];
	$c_website = $row['company_website'];
	$c_logo =$row['company_logo'];

}

if (isset($_GET['id'])) {

	$id = $_GET['id'];

	$q = mysqli_query($conn,"SELECT * FROM invoice_master i JOIN client_master c ON i.u_id = c.u_id JOIN countries cc ON c.country_id = cc.country_id JOIN states s ON c.state_id=s.state_id JOIN cities ccc ON c.city_id=ccc.city_id WHERE i.invoice_id = '$id'");

	while ($row1 = mysqli_fetch_array($q)) {
		$u_id = $row1['u_id'];
		$u_name = $row1['u_name'];
		$_SESSION['u_name'] = $row1['u_name'];
		$u_add = $row1['u_addr'];
		$u_phn = $row1['u_phn'];
		$u_country = $row1['country_name'];
		$u_state = $row1['state_name'];
		$u_city = $row1['city_name'];
		$invoice_no = $row1['invoice_no'];
		$issue_date = $row1['issue_date'];
		$due_date = $row1['due_date'];
		$paypal = $row1['paypal_charges'];
		$sub_total = $row1['sub_total'];
		$grand_total = $row1['grand_total'];
		$_SESSION['u_email'] = $row1['u_email'];

	}
    $user_id_no = $u_id;
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
    $invoice_number = $invoice_no;
    $length1 = strlen((string)$invoice_number);
    $no_of_digit = 5;
    for ($i=$length1; $i < $no_of_digit; $i++) { 
        $invoice_number = "0".$invoice_number; 
    }

	$q1 = mysqli_query($conn,"SELECT * FROM sub_invoice_master si JOIN product_master p ON si.product_id = p.product_id WHERE si.invoice_id = '$id' ");
	
	$c = 0;
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
		 		<div id='bigi' style='text-align:center;'>SALES INVOICE</div>
		 		<table id='company'>
		 			<tr>
		 				<td id='co-left'>
		 					<div id='co-addr'>
		 						".$c_name."<br>
		 						".$c_add."".$city_name."-".$c_pincode."<br>
		 						(".$state_name.") ".$country_name.".<br>
		 						Website:".$c_website."<br>
		 						Email:".$c_email."<br>
		 					</div>
		 				</td>
		 				<td id='co-right' class='right'>
		 					<img src='C:/xampp/htdocs/gentelella-master/production/images/".$c_logo."'>
		 				</td>
		 			</tr>
		 		</table>
		 		<table id='billship'>
		 			<tr>
		 				<td>
		 					<strong>BILL TO</strong><br>
		 					".$u_name."<br>
		 					".$u_add."<br>
		 					".$u_city.",".$u_state.",<br>
		 					".$u_country."
		 				</td>
		 				
		 				<td>
		 					<strong>Invoice #:</strong>TPESID".$user_id.$invoice_number."<br>
		 					<strong>Date:</strong>".$issue_date."<br>
		 					<strong>Due Date:</strong>".$due_date."<br>
		 					<strong>Project ID #:</strong>".$u_id."<br>
		 				</td>
		 			</tr>
		 		</table>
		 		<table id='items'>
		 			<tr>
		 				<th>ITEM</th>
		 				<th>QUANTITY</th>
		 				<th>UNIT PRICE</th>
		 				<th>AMOUNT</th>
		 			</tr>";
	$mpdf->writeHTML($data);
	while ($row2 = mysqli_fetch_assoc($q1)){	 		
	$data1="<tr>
						<td>
		 					<div>".$row2['product_name']."</div>
		 					<small class='idesc'>".$row2['description']."</small>
		 				</td>
		 				<td>".$row2['quantity']."</td>
		 				<td>".$row2['unit_price']."</td>
		 				<td>".$row2['final_price']."</td>
		 	</tr>";
	
	$mpdf->writeHTML($data1);
	$c++;
		}
	
	
	if ($c == 3) {
	$data2 = "<tr>
						<td>
		 					<div></div>
		 					<small class='idesc'></small>
		 					<br>
		 					<br>
		 					<br>
		 					<br>
		 					<br>
		 					<br>
		 					<br>
		 					<br>
		 					<br>	
		 				</td>
		 				<td></td>
		 				<td></td>
		 				<td></td>
		 	</tr>";	
	$mpdf->writeHTML($data2);	 	
	}
	elseif ($c == 2) {
		$data2 = "<tr>
						<td>
		 					<div></div>
		 					<small class='idesc'></small>
		 					<br>
		 					<br>
		 					<br>
		 					<br>
		 					<br>
		 					<br>
		 					<br>
		 					<br>
		 					<br>	
		 					<br><br>
		 					<br>
		 				</td>
		 				<td></td>
		 				<td></td>
		 				<td></td>
		 	</tr>";	
	$mpdf->writeHTML($data2);	 	
	}
	elseif ($c == 1) {
		$data2 = "<tr>
						<td>
		 					<div></div>
		 					<small class='idesc'></small>
		 					<br>
		 					<br>
		 					<br>
		 					<br>
		 					<br>
		 					<br>
		 					<br>
		 					<br>
		 					<br>	
		 					<br><br>
		 					<br><br><br>
		 					<br>
		 				</td>
		 				<td></td>
		 				<td></td>
		 				<td></td>
		 	</tr>";	
	$mpdf->writeHTML($data2);	 	
	}
	$data3=	"

		 			<tr class='ttl'>
		 				<td class='right' colspan='3'><b>SUB-TOTAL:<br><br>PayPal CHARGES (%):<br><br>GRAND-TOTAL:<b></td>
		 				<td>".$sub_total."<br><br>".$paypal."<br><br>".$grand_total."</td>

		 			</tr>
		 		</table>
		 		<div id='notes'>PayPal Payment Link: <a target='_blank' href='https://paypal.me/jupiteritech/".$grand_total.".usd' >Click Here</a><br></div>
		 	</div>
		 </body>
		 </html> ";
$mpdf->writeHTML($data3);
$filename = "TPESID".$user_id.$invoice_number.".pdf";
$_SESSION['filename'] = $filename;
$mpdf->output("C:/xampp/htdocs/gentelella-master/production/invoice/".$filename,'F');
sendmail();
?>
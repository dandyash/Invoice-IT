
<?php
include('connection.php');
include('check-login.php');
check_login();
$query = mysqli_query($conn,"select * from invoice_master i join client_master c on i.u_id=c.u_id where i.invoice_id = '23'");
while($row=mysqli_fetch_array($query))
{
	$email =$row['u_email'];
	$cli_name = $row['u_name'];
	$u_id = $row['u_id'];
	$invoice_no = $row['invoice_no'];
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
    $filename = "TPESID".$user_id.$invoice_number.".pdf";

function sendmail()
{

$name        = ;
$email       = $email;
$to          = "$name <$email>";
$from        = "medtechpro2020@gmail.com";
$subject     = "Here is your attachment";
$mainMessage = "Hi, here's the file of Your Result.";
$fileatt     = "invoice/TPESID00100004.pdf";
$fileatttype = "application/pdf";
$fileattname = $filename;
$headers = "From: $from";

// File
$file = fopen($fileatt, 'rb');
$data = fread($file, filesize($fileatt));
fclose($file);

// This attaches the file
$semi_rand     = md5(time());
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
$headers      .= "\nMIME-Version: 1.0\n" .
"Content-Type: multipart/mixed;\n" .
" boundary=\"{$mime_boundary}\"";
$message = "This is a multi-part message in MIME format.\n\n" .
"-{$mime_boundary}\n" .
"Content-Type: html/pdf/text/plain; charset=\"iso-8859-1\n" .
"Content-Transfer-Encoding: 7bit\n\n" .
$mainMessage  . "\n\n";

$data = chunk_split(base64_encode($data));
$message .= "--{$mime_boundary}\n" .
"Content-Type: {$fileatttype};\n" .
" name=\"{$fileattname}\"\n" .
"Content-Disposition: attachment;\n" .
" filename=\"{$fileattname}\"\n" .
"Content-Transfer-Encoding: base64\n\n" .
$data . "\n\n" .
"-{$mime_boundary}-\n";

// Send the email
if(mail($to, $subject, $message, $headers)) {

    echo "<script>alert('The Mail Was Successfully Sent');</script>";
   // header('location:index.php');

}
else {

    echo "<script>alert('The Mail Was not Sent');</script>";

}
}
?>
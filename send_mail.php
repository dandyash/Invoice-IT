
<?php

function sendmail()
{

$name        = $_SESSION['u_name'];
$email       = $_SESSION['u_email'];
$to          = "$name <$email>";
$from        = "medtechpro2020@gmail.com";
$subject     = "Here is your attachment";
$mainMessage = "Hi, here's the file of Your Result.";
$fileatt     = "invoice/".$_SESSION['filename'];
$fileatttype = "application/pdf";
$fileattname = $_SESSION['filename'];
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
    header('location:index.php');

}
else {

    echo "<script>alert('The Mail Was not Sent');</script>";

}
}
?>
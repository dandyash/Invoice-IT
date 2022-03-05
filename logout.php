<?php
session_start();
include('connection.php');
$_SESSION['login']=="";



session_unset();
//session_destroy();
$_SESSION['errmsg']="You have successfully logout";
?>
<script language="javascript">
document.location="login.php";
</script>
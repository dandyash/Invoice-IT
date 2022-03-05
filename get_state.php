<?php
require "connection.php";

if($_POST['id'])
{
	$id=$_POST['id'];
        
    $s=mysqli_query($conn,"SELECT * FROM states WHERE country_id=$id") or die("error");
    
	?><option selected="selected">Select State :</option><?php
	while($row=mysqli_fetch_array($s))
	{
		?>
        	<option value="<?php echo $row['state_id']; ?>"><?php echo $row['state_name']; ?></option>
        <?php
	}
}
?>
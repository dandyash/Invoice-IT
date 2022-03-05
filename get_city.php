<?php
require "connection.php";

if($_POST['id'])
{
	$id=$_POST['id'];
        
    $s=mysqli_query($conn,"SELECT * FROM cities WHERE state_id=$id") or die("error");
    
	?><option selected="selected">Select City --</option><?php
	while($row=mysqli_fetch_array($s))
	{
		?>
        	<option value="<?php echo $row['city_id']; ?>"><?php echo $row['city_name']; ?></option>
        <?php
	}
}
?>
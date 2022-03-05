<?php
require "connection.php";

if($_POST['id'])
{
	$id=$_POST['id'];
        
    $s=mysqli_query($conn,"SELECT * FROM area_master WHERE city_id=$id") or die("error");
    
	?><option selected="selected">Select Area --</option><?php
	while($row=mysqli_fetch_array($s))
	{
		?>
        	<option value="<?php echo $row['area_id']; ?>"><?php echo $row['area_name']; ?></option>
        <?php
	}
}
?>
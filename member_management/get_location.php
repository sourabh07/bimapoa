<?php
@mysql_connect('localhost', 'root', '') or die("Unable to connect to MySql Server");
@mysql_select_db('ambush2006') or die("Unable to select database");
$region_id = $_POST['region_id'];

$selectEmail = "Select * from location where region_id ='".$region_id."'";
$resultEmail=mysql_query($selectEmail) or die(mysql_error());
?>
<?php
?>
<option>---Select Location---</option>
<?php  
while($row_region = mysql_fetch_array($resultEmail))
{?>
	<option value="<?php echo $row_region['location_id'] ?>"><?php echo $row_region ['location_name'];?></option>
<?php }
?>

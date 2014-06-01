<?php
@mysql_connect('ambush2006.db.11283971.hostedresource.com', 'ambush2006', 'Velociter@1985') or die("Unable to connect to MySql Server");
@mysql_select_db('ambush2006') or die("Unable to select database");
$area_id = $_POST['area_id'];

$selectEmail = "Select * from region where area_id ='".$area_id."'";
$resultEmail=mysql_query($selectEmail) or die(mysql_error());
?>
<?php 
?>
<option>---Select Region---</option>
<?php 
while($row_region = mysql_fetch_array($resultEmail))
{?>
	<option value="<?php echo $row_region['region_id'] ?>"><?php echo $row_region['region_name'];?></option>
<?php }
?>

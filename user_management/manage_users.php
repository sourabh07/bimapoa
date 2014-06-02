<?php

include '../common_include_in.php';
include '../include/header_in.php';?>

<?php
include '../include/top_navigation_in.php';

$userobj = new Users();

if($_POST['submitted']){
	if ($userobj->RegisterUserForm()) {
		$userobj->RedirectToURL("manage_users.php");
	}
}

if(isset($_SESSION['user_type']))
{
	$user_type = $_SESSION['user_type'];
}
else
{
	header("Location: ../index.php");
}

?>
<div class="container-fluid" id="content"><?php include '../include/left_navigation_in.php';?>
<div id="main">
<div class="container-fluid">
<div class="page-header">
<div class="pull-left">
<h1>Manage User</h1>
</div>

</div>
<div class="breadcrumbs">
<ul>
	<li><a href="../dashboard.php">Home</a> <i class="icon-angle-right"></i>
	</li>
	<li><a href="#">Manage User</a></li>
</ul>
<div class="close-bread"><a href="#"><i class="icon-remove"></i> </a></div>
</div>
<div class="row-fluid">
<div class="span12">

<div class="box box-color box-bordered blue">
<div class="box-title">
<h3><i class="icon-table"></i> User Details</h3>
<?php if($user_type == "Admin")
{
	?>
<button class="btn btn-mini btn-warning pull-right"
	style="margin-right: 10px;"
	onclick="window.location.href='add_user.php'">Add</button>


<button class="btn btn-mini btn-warning pull-right"
	style="margin-right: 10px;"
	onclick="window.location.href='../download_log.php?sampleFile=uploads/log/log_user.txt'">Download Log</button>

	<?php
}
else
{
}
?></div>
<div class="box-content nopadding">
<table
	class="table table-nomargin table-striped dataTable dataTable-reorder  dataTable-scroll-x dataTable-scroll-y">
	<thead>
		<tr>
			<th class='hidden-1024'>Sr/No</th>
			<th class='hidden-1024'>Full Name</th>
			<th class='hidden-1024'>User Email</th>
			<th class='hidden-1024'>User Name</th>
			<th class='hidden-1024'>Password</th>
			<th class='hidden-1024'>User Type</th>
			<th class='hidden-1024'>Actions</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$qrystring = "";
	$i=1;
	if(isset($_POST['full_name']) && isset($_POST['user_type']) && $_POST['user_type']!='' &&  $_POST['full_name']!='')
	{
		$qrystring = "select * from users  where full_name='".$_POST['full_name']."' or user_type='".$_POST['user_type']."'";
	}
	else if(isset($_POST['full_name']) && $_POST['full_name']!='')
	{
		$qrystring = "select * from users where full_name='".$_POST['full_name']."'";
	}
	else if(isset($_POST['user_type']) &&  $_POST['user_type']!='')
	{
		$qrystring = "select * from users where user_type='".$_POST['user_type']."'";
	}
	else
	{
		$qrystring = "select * from users";
	}
	$result_user = mysql_query($qrystring);
	while($row_user    = mysql_fetch_array($result_user))
	{
		$result_city = mysql_query("select * from city where city_id='".$row_user['city_id']."'");
		$row_city    = mysql_fetch_array($result_city);

		?>
		<tr>
			<td class='hidden-1024'><?php echo $i ?></td>
			<td class='hidden-1024'><?php echo $row_user['full_name'] ?></td>
			<td class='hidden-1024'><?php echo $row_user['user_email'] ?></td>
			<td class='hidden-1024'><?php echo $row_user['username'] ?></td>
			<td class='hidden-1024'><?php echo $row_user['password'] ?></td>
			<td class='hidden-1024'><?php echo $row_user['user_type'] ?></td>

			<?php if($user_type == "Admin")
			{
				?>
			<td class='hidden-1024'>
			<button class="btn btn-mini btn-warning"
				onclick="window.location.href = 'update_user_form.php?user_id=<?php echo $row_user['user_id'];?>';">
			<i class="icon-edit"></i></button>
			<?php
			$CurrentStatus = $row_user['status'];
			$user_id = $row_user['user_id'];
			if($CurrentStatus == '1')
			{
				?> <a class="btn btn-small btn-inverse"
				href="change_status.php?user_id=<?php echo $user_id?>&current_status=<?php echo $CurrentStatus?> ">
			Deactivate</a> <?php 
			}
			else if($CurrentStatus == '0')
			{
				?> <a class="btn btn-mini btn-warning"
				href="change_status.php?user_id=<?php echo $user_id?>&current_status=<?php echo $CurrentStatus?> ">
			Activate</a> <?php 
			}
			?> <?php
			}
			?>
		</tr>
		<?php
		$i++;
	}
	?>
	</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
</div>











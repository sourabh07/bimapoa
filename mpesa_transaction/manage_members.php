<?php 

include '../common_include_in.php';
include '../include/header_in.php';?>

<?php 
include '../include/top_navigation_in.php';

$memberobj = new Members();

if($_POST['submitted']){
	if ($memberobj->RegisterMember()) {
		$memberobj->RedirectToURL("manage_members.php");
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
<div class="container-fluid" id="content">
	<?php include '../include/left_navigation_in.php';?>
	<div id="main">
		<div class="container-fluid">
			<div class="page-header">
				<div class="pull-left">
					<h1>Manage Member</h1>
				</div>

			</div>
			<div class="breadcrumbs">
				<ul>
					<li><a href="../dashboard.php">Home</a> <i class="icon-angle-right"></i>
					</li>
					<li><a href="#">Manage Member</a>
					</li>
				</ul>

				<div class="close-bread">
					<a href="#"><i class="icon-remove"></i> </a>
				</div>
			</div>

			<div class="row-fluid">
				<div class="span12">

					<div class="box box-color box-bordered blue">
						<div class="box-title">
							<h3>
								<i class="icon-table"></i> Upload CSV
							</h3>
						</div>
						<div class="box-content nopadding">
							<form action="upload.php" method="post"
								enctype="multipart/form-data">
								<br /> <input type="file" name="data" /> <input type="submit"
									name="submit" value="Upload">
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12">

					<div class="box box-color box-bordered blue">
						<div class="box-title">
							<h3>
								<i class="icon-table"></i> Member Details
							</h3>

							<?php if($user_type == "Admin")
							{
								?>
							<button class="btn btn-mini btn-warning pull-right"
								style="margin-right: 10px;"
								onclick="window.location.href='add_member.php'">Add</button>

							<?php 
							}
							else
							{

							}
							?>

						</div>
						<div class="box-content nopadding">
							<table
								class="table table-nomargin table-striped dataTable dataTable-reorder  dataTable-scroll-x dataTable-scroll-y">
								<thead>
									<tr>
										<th class='hidden-350'>Member Name</th>
										<th class='hidden-1024'>Policy No</th>
										<th class='hidden-1024'>National ID</th>
										<!-- <th class='hidden-1024'>Payment Type</th> -->
										<th class='hidden-450'>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$qrystring = "";
									if(isset($_POST['policy_no']) && isset($_POST['national_id']) && $_POST['national_id']!='' &&  $_POST['policy_no']!='')
									{
										$qrystring = "select * from bimapoa_members  where policy_no='".$_POST['policy_no']."' or national_id='".$_POST['national_id']."'";
									}
									else if(isset($_POST['policy_no']) && $_POST['policy_no']!='')
									{
										$qrystring = "select * from bimapoa_members where policy_no='".$_POST['policy_no']."'";
									}
									else if(isset($_POST['national_id']) &&  $_POST['national_id']!='')
									{
										$qrystring = "select * from bimapoa_members where national_id='".$_POST['national_id']."'";
									}
									else
									{
										$qrystring = "select * from bimapoa_members";
									}
									$result_member = mysql_query($qrystring);
									while($row_member    = mysql_fetch_array($result_member))
									{
										$result_city = mysql_query("select * from city where city_id='".$row_member['city_id']."'");
										$row_city    = mysql_fetch_array($result_city);

										?>
									<tr>
										<td class='hidden-350'><?php echo $row_member['member_name']?>
										</td>
										<td class='hidden-1024'><?php echo $row_member['policy_no']?>
										</td>
										<td class='hidden-1024'><?php echo $row_member['national_id']?>
										</td>
										<!-- <td class='hidden-1024'><?php echo $row_member['payment_type']?>
										</td> -->
										<?php if($user_type == "Admin")
										{
											?>

										<td class='hidden-450'><button
												class="btn btn-mini btn-warning"
												onclick="window.location.href='update_member_form.php?member_id=<?echo $row_member['member_id'];?>';">
												<i class="icon-edit"></i>
											</button>
											<button class="btn btn-small btn-inverse"
												onclick="window.location.href='delete_member.php?member_id=<?echo $row_member['member_id'];?>';">
												<i class="icon-trash"></i>
											</button></td>
										<?php 
										}
										else
										{
											?>
										<td class='hidden-450'>No action to perform</td>
										<?php 
										}
										?>
									</tr>
									<?php      
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

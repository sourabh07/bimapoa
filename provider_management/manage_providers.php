<?php 

include '../common_include_in.php';
include '../include/header_in.php';?>

<?php 
include '../include/top_navigation_in.php';

$memberobj = new Agents();

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
					<h1>Manage Provider</h1>
				</div>

			</div>
			<div class="breadcrumbs">
				<ul>
					<li><a href="../dashboard.php">Home</a> <i class="icon-angle-right"></i>
					</li>
					<li><a href="#">Manage Provider</a>
					</li>
				</ul>

				<div class="close-bread">
					<a href="#"><i class="icon-remove"></i> </a>
				</div>
			</div>

			<!-- 	<div class="row-fluid">
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
			</div> -->
			<div class="row-fluid">
				<div class="span12">

					<div class="box box-color box-bordered blue">
						<div class="box-title">
							<h3>
								<i class="icon-table"></i> Provider Details
							</h3>

							<?php /* if($user_type == "Admin")
							{ */
?>
							<!--<button class="btn btn-mini btn-warning pull-right"
								style="margin-right: 10px;"
								onclick="window.location.href='add_provider.php'">Add</button>-->

							<?php 
							/* }
							 else
							{

							}
 */							?>
<!--							 <button class="btn btn-mini btn-warning pull-right"
								style="margin-right: 10px;"
								onclick="window.location.href='provider_export_data.php'">Export
								CSV</button> -->
						</div>

						<div class="box-content nopadding">
							<table
								class="table table-nomargin table-striped dataTable dataTable-reorder  dataTable-scroll-x dataTable-scroll-y">
								<thead>
									<tr>
										<th class='hidden-350'>Sr/No</th>
										<th class='hidden-1024'>Provider Name</th>
										<th class='hidden-1024'>Address</th>
										<th class='hidden-1024'>Provider Code</th>
										<!-- <th class='hidden-1024'>Phone</th> -->
										<?php if($user_type == "Admin") 
										{
											?>
										<th class='hidden-450'>Actions</th>
										<?php 
										}
										?>
									</tr>
								</thead>
								<tbody>
									<?php 
									$qrystring = "";
									if(isset($_POST['provider_code']) && isset($_POST['provider_name']) && $_POST['provider_name']!='' &&  $_POST['provider_code']!='')
									{
										$qrystring = "select * from providers  where provider_code='".$_POST['provider_code']."' or provider_name='".$_POST['provider_name']."'";
									}
									else if(isset($_POST['provider_code']) && $_POST['provider_code']!='')
									{
										$qrystring = "select * from providers where provider_code='".$_POST['provider_code']."'";
									}
									else if(isset($_POST['provider_name']) &&  $_POST['provider_name']!='')
									{
										$qrystring = "select * from providers where provider_name='".$_POST['provider_name']."'";
									}
									else
									{
										$qrystring = "select * from providers";
									}
									$i = 1;
									$result_provider = mysql_query($qrystring);

									while($row_provider    = mysql_fetch_array($result_provider))
									{
										$result_city = mysql_query("select * from city where city_id='".$row_provider['city_id']."'");
										$row_city    = mysql_fetch_array($result_city);
										?>
									<!-- provider_name,provider_code,contact_person,contact_no,bank_name,account_name,account_no,iifc_code -->
									<tr>
										<td class='hidden-350'><?php echo $i?>
										</td>
										<td class='hidden-1024'><?php echo $row_provider['provider_name']?>
										</td>
										<td class='hidden-1024'><?php echo $row_provider['address']?>
										</td>
										<td class='hidden-1024'><?php echo $row_provider['provider_code']?>
										</td>
										<!-- <td class='hidden-1024'><?php echo $row_provider['phone']?>
										</td> -->


										<?php if($user_type == "Admin")
										{
											?>

										<td class='hidden-450'>
<!--                                                                                    <button
												class="btn btn-mini btn-warning"
												onclick="window.location.href='update_provider_form.php?provider_id=<?php echo $row_provider['provider_id'];?>';">
												<i class="icon-edit"></i>
											</button>-->
											<?php 
											$CurrentStatus = $row_provider['status'];
											$provider_code = $row_provider['provider_code'];
											if($CurrentStatus == '1')
											{
												?> <a class="btn btn-small btn-inverse"
											href="change_status.php?provider_code=<?php echo $provider_code?>&current_status=<?php echo $CurrentStatus?> ">
												Deactivate</a> <?php 
											}
											else if($CurrentStatus == '0')
											{
												?> <a class="btn btn-mini btn-warning"
											href="change_status.php?provider_code=<?php echo $provider_code?>&current_status=<?php echo $CurrentStatus?> ">
												Activate</a> <?php 
											}
											?></td>
										<?php 
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

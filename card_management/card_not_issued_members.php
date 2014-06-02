<?php 

include '../common_include_in.php';
$memberobj = new Members();
include '../include/header_in.php';
include '../include/top_navigation_in.php';
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
					<h1>Card Issued Data</h1>
				</div>

			</div>
			<div class="breadcrumbs">
				<ul>
					<li><a href="../dashboard.php">Home</a> <i class="icon-angle-right"></i>
					</li>
					<li><a href="#">Manage Card Issued Data</a>
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
								<i class="icon-table"></i> Card Issued Member Details
							</h3>

						</div>
						<div class="box-content nopadding">
							<table
								class="table table-nomargin table-striped dataTable dataTable-reorder  dataTable-scroll-x dataTable-scroll-y">
								<thead>
									<tr>
										<th class='hidden-1024'>Sr/No</th>
										<th class='hidden-1024'>Policy No</th>
										<th class='hidden-1024'>National ID</th>
										<th class='hidden-1024'>Membership No</th>
										<th class='hidden-1024'>Membership Name</th>
										<th class='hidden-1024'>Contract Effective Date</th>
										<th class='hidden-1024'>Contract Expiry Date</th>
										<th class='hidden-1024'>Status</th>
										<th class='hidden-1024'>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$i = 1;
									$query = "select * from bimapoa_members where card_issued != 'Y' AND relation = 'SELF'";
									$result_mpesa = mysql_query($query);
									while($row_member=mysql_fetch_array($result_mpesa))
									{
										?>
									<tr>
										<td class='hidden-1024'><?php echo $i?>
										</td>
										<td class='hidden-1024'><?php echo $row_member['policy_no']?>
										</td>
										<td class='hidden-1024'><?php echo $row_member['national_id']?>
										</td>
										<td class='hidden-1024'><?php echo $row_member['membership_no']?>
										</td>
										<td class='hidden-1024'><?php echo $row_member['membership_name']?>
										</td>
										<td class='hidden-1024'><?php echo $row_member['contract_effective_date']?>
										</td>
										<td class='hidden-1024'><?php echo $row_member['contract_expiry_date']?>
										</td>
										<td class='hidden-1024'><?php echo $row_member['card_issued']?>
										</td>
										<td><button class="btn btn-mini btn-warning"
												onclick="window.location.href='update_customer_form.php?customer_id=<?echo $row_customer['customer_id'];?>';">
												<i class="icon-edit"></i>
											</button>
											<button class="btn btn-small btn-inverse"
												onclick="window.location.href='delete_customer.php?customer_id=<?echo $row_customer['customer_id'];?>';">
												<i class="icon-trash"></i>
											</button></td>
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
<?php mysql_close();?>
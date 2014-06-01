<?php 
session_start();
$db = mysql_connect('ambush2006.db.11283971.hostedresource.com', 'ambush2006', 'Velociter@1985') or die("Could not connect.");
$linkcon = mysql_select_db("ambush2006",$db) or die("Not Found Table");
$query = "select * from one_time_payment";
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
					<h1>Self Transactions</h1>
				</div>

			</div>
			<div class="breadcrumbs">
				<ul>
					<li><a href="../dashboard.php">Home</a> <i class="icon-angle-right"></i>
					</li>
					<li><a href="#">Manage Self Member</a>
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
								<i class="icon-table"></i> M-Pesa Transaction Details
							</h3>
<button class="btn btn-mini btn-warning pull-right"
									style="margin-right: 10px;" onclick="window.location.href=''">Export
									CSV</button>
						</div>
						<div class="box-content nopadding">
							<table
								class="table table-nomargin table-striped dataTable dataTable-reorder  dataTable-scroll-x dataTable-scroll-y">
								<thead>
									<tr>
										<th class='hidden-1024'>Sr/No</th>
										<th class='hidden-1024'>Member Name</th>
										<th class='hidden-1024'>Policy No</th>
										<th class='hidden-1024'>National ID</th>
										<th class='hidden-1024'>Amount</th>
										<th class='hidden-1024'>No of Installments</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$i = 1;
									$query = "select * from one_time_payment";
									$result_mpesa = mysql_query($query);
									while($row_member   =   mysql_fetch_array($result_mpesa))
									{
										$result_member_name = mysql_query("select * from bimapoa_members where policy_no='".$row_member['policy_no']."' AND relation = 'SELF'");
										$row_member_name    = mysql_fetch_array($result_member_name);
									//id,IPN_Id,mpesa_originator,mpesa_destination,mpesa_timestamp,mpesa_text,mpesa_user,mpesa_password,mpesa_code,mpesa_account,mpesa_msisdn,mpesa_transaction_date,mpesa_transaction_time,mpesa_amount,mpesa_sender,date_record_created,processed	?>
									<tr>
										<td class='hidden-1024'><?php echo $i?>
										</td>
										<td class='hidden-1024'><?php echo $row_member_name['membership_name']?>
										</td>
										<td class='hidden-1024'><?php echo $row_member['policy_no']?>
										</td>
										<td class='hidden-1024'><?php echo $row_member_name['national_id']?>
										</td>
										<td class='hidden-1024'><?php echo $row_member['mpesa_transaction_amount']?>
										</td>
										<td class='hidden-1024'><?php echo $i?>
										</td>

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
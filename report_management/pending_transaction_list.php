<?php
session_start();
include '../common_include_in.php';
$memberobj = new Members();
/* $db = mysql_connect('ambush2006.db.11283971.hostedresource.com', 'ambush2006', 'Velociter@1985') or die("Could not connect.");
 $linkcon = mysql_select_db("ambush2006",$db) or die("Not Found Table"); */
$memberobj->connect();
$query = "select * from one_time_payment";
?>
<!doctype html>
<html>
<head>
	<meta charset="utf8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />

	<!-- Bootstrap -->
        <link rel="stylesheet" href="../css/bootstrap.min.css">
	<!-- Bootstrap responsive -->
	<link rel="stylesheet" href="../css/bootstrap-responsive.min.css">
	<!-- jQuery UI -->
	<link rel="stylesheet" href="../css/plugins/jquery-ui/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="../css/plugins/jquery-ui/smoothness/jquery.ui.theme.css">
	<!-- dataTables -->
	<link rel="stylesheet" href="../css/plugins/datatable/TableTools.css">
	<!-- chosen -->
	<link rel="stylesheet" href="../css/plugins/chosen/chosen.css">
	<!-- Theme CSS -->
	<link rel="stylesheet" href="../css/style.css">
	<!-- Color CSS -->
	<link rel="stylesheet" href="../css/themes.css">

	<!-- jQuery -->
	<script src="../js/jquery.min.js"></script>
	<!-- jQuery UI -->
	<script src="../js/plugins/jquery-ui/jquery.ui.core.min.js"></script>
	<script src="../js/plugins/jquery-ui/jquery.ui.widget.min.js"></script>
	<script src="../js/plugins/jquery-ui/jquery.ui.mouse.min.js"></script>
	<script src="../js/plugins/jquery-ui/jquery.ui.resizable.min.js"></script>
	<!-- slimScroll -->
	<script src="../js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<!-- Bootstrap -->
	<script src="../js/bootstrap.min.js"></script>
	<!-- Bootbox -->
	<script src="../js/plugins/bootbox/jquery.bootbox.js"></script>
	<!-- dataTables -->
	<script src="../js/plugins/datatable/jquery.dataTables.min.js"></script>
	<script src="../js/plugins/datatable/TableTools.min.js"></script>
	<script src="../js/plugins/datatable/ColReorder.min.js"></script>
	<script src="../js/plugins/datatable/ColVis.min.js"></script>
	<!-- Chosen -->
	<script src="../js/plugins/chosen/chosen.jquery.min.js"></script>

	<!-- Theme framework -->
	<script src="../js/eakroko.min.js"></script>
	<!-- Theme scripts -->
	<script src="../js/application.min.js"></script>
	<!-- Just for demonstration -->
	<script src="../js/demonstration.min.js"></script>
	<!-- Favicon -->
	<link rel="shortcut icon" href="../img/favicon.ico" />
	<!-- Apple devices Homescreen icon -->
	<link rel="apple-touch-icon-precomposed" href="../img/apple-touch-icon-precomposed.png" />

</head>

<?php
include '../include/top_navigation_in.php';
if (isset($_SESSION['user_type'])) {
	$user_type = $_SESSION['user_type'];
} else {
	header("Location: ../index.php");
}
?>
<div class="container-fluid" id="content">
<?php include '../include/left_navigation_in.php'; ?>
	<div id="main">
		<div class="container-fluid">
			<div class="page-header">
				<div class="pull-left">
					<h1>Pending Installments</h1>
				</div>

			</div>
			<div class="breadcrumbs">
				<ul>
					<li><a href="../dashboard.php">Home</a> <i class="icon-angle-right"></i>
					</li>
					<li><a href="#">Manage Pending Installments</a>
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
								<i class="icon-table"></i> M-Pesa Pending Installments Details
							</h3>
                                                    
                                                    
                                                    <button class="btn btn-mini btn-warning pull-right"
								style="margin-right: 10px;"
								onclick="window.location.href = 'pending_export_data.php'">Export
								CSV</button>

						</div>
						<div class="box-content nopadding">
							<table
								class="table table-nomargin table-striped dataTable dataTable-reorder  dataTable-scroll-x dataTable-scroll-y">
								<thead>
									<tr>
										<th class='hidden-1024'>Sr/No</th>
										<th class='hidden-1024'>Installment Pending Amount</th>
										<th class='hidden-1024'>No Of Installments Pending</th>
										<th class='hidden-1024'>Policy No</th>
										<th class='hidden-1024'>Contract Effective Date</th>
										<th class='hidden-1024'>Contract Expiry Date</th>
										<th class='hidden-1024'>Transaction Date</th>
										<th class='hidden-1024'>Termination Due Date</th>
										<th class='hidden-1024'>Membership Number</th>
										<th class='hidden-1024'>Membership Name</th>
										<th class='hidden-1024'>CHW Code</th>
										<th class='hidden-1024'>Terminated On</th>
										<?php if ($user_type == "Admin") {
											?>
										<th class='hidden-1024'>Action</th>
										<?php } ?>
									</tr>
								</thead>
								<tbody>
								<?php
								$i = 1;
								$query = "select * from mpesa";
								$result_mpesa = mysql_query($query);
								while ($row_member = mysql_fetch_array($result_mpesa)) {
									$result_member_name = mysql_query("select * from bimapoa_members where policy_no='" . $row_member['mpesa_account'] . "' AND relation = 'SELF'");
									$row_member_name = mysql_fetch_array($result_member_name);
									//id,IPN_Id,mpesa_originator,mpesa_destination,mpesa_timestamp,mpesa_text,mpesa_user,mpesa_password,mpesa_code,mpesa_account,mpesa_msisdn,mpesa_transaction_date,mpesa_transaction_time,mpesa_amount,mpesa_sender,date_record_created,processed
									$count = $memberobj->row_count('mpesa', "mpesa_account = '" . $row_member['mpesa_account'] . "'");

									if ($row_member['mpesa_amount'] != 8000) {
										if (($row_member['mpesa_amount'] == 4000 && $count == 1) || ($row_member['mpesa_amount'] == 800 && $count != 12)) {
											/* 	if($row_member['mpesa_amount'] == 800 && $count == 12)
											 { */
											if ($row_member['mpesa_amount'] == 4000) {
												$format = 'Y-m-d';
												$newDateTermination = date( $format, strtotime ( '+90 day' . $row_member_name['date_signed'] ) );
												$amountRemaining = 8000 - (4000 * ($count));
												$installmentsRemaining = 2 - $count;
											} elseif ($row_member['mpesa_amount'] == 800) {
												$format = 'Y-m-d';
												$newDateTermination = date( $format, strtotime ( '+30 day' . $row_member_name['date_signed'] ) );
												$amountRemaining = 9600 - (800 * ($count));
												$installmentsRemaining = 12 - $count;
											}
											?>
									<tr <?php if($row_member_name['status']=='T'){ ?>
										style="color: red;" <?php }?>>
										<td class='hidden-1024'><?php echo $i ?>
										</td>
										<td class='hidden-1024'><?php echo $amountRemaining; ?>
										</td>
										<td class='hidden-1024'><?php echo $installmentsRemaining ?>
										</td>
										<td class='hidden-1024'><?php echo $row_member['mpesa_account'] ?>
										</td>
										<td class='hidden-1024'><?php echo $row_member_name['contract_effective_date'] ?>
										</td>
										<td class='hidden-1024'><?php echo $row_member_name['contract_expiry_date'] ?>
										</td>
										<td class='hidden-1024'><?php echo $row_member_name['date_signed'] ?>
										</td>
										<td class='hidden-1024'><?php echo $newDateTermination;?>
										</td>
										<td class='hidden-1024'><?php echo $row_member_name['membership_no'] ?>
										</td>
										<td class='hidden-1024'><?php echo $row_member_name['membership_name'] ?>
										</td>
										<td class='hidden-1024'><?php echo $row_member_name['chw_code'] ?>
										</td>
										<td class='hidden-1024'><?php echo $row_member_name['terminated_date'] ?>
										</td>
										<?php
										if ($user_type == "Admin") {
											?>
										<td class='hidden-1024'><?php
										$CurrentStatus = $row_member_name['status'];
										$policy_no = $row_member['mpesa_account'];
										if ($CurrentStatus == 'Y') {
											?> <a class="btn btn-small btn-inverse"
											href="termination_date.php?policy_no=<?php echo $policy_no ?>&current_status=<?php echo $CurrentStatus ?> ">
												Terminate</a> <?php
										} else if ($CurrentStatus == 'T') {
											?> <a class="btn btn-mini btn-warning"
											href="change_status.php?policy_no=<?php echo $policy_no ?>&current_status=<?php echo $CurrentStatus ?> ">
												Re-Activate</a> <?php
										}
										?>
										</td>
										<?php }
										?>
									</tr>
									<?php
									$i++;
										}
									}
									/* } */ else {

									}
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
								<?php mysql_close(); ?>
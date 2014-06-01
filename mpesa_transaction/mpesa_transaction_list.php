<?php 
session_start();
$db = mysql_connect('ambush2006.db.11283971.hostedresource.com', 'ambush2006', 'Velociter@1985') or die("Could not connect.");
$linkcon = mysql_select_db("ambush2006",$db) or die("Not Found Table");

$query = "select * from mpesa";

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
					<h1>M-Pesa Transactions</h1>
				</div>

			</div>
			<div class="breadcrumbs">
				<ul>
					<li><a href="../dashboard.php">Home</a> <i class="icon-angle-right"></i>
					</li>
					<li><a href="#">Manage M-Pesa Transactions </a>
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
								<i class="icon-table"></i> M-Pesa Transactions Details
							</h3>
							<button class="btn btn-mini btn-warning pull-right"
								style="margin-right: 10px;" onclick="window.location.href='mpesa_export_data.php'">Export
								CSV</button>
						</div>
						<div class="box-content nopadding">
							<table
								class="table table-nomargin table-striped dataTable dataTable-reorder  dataTable-scroll-x dataTable-scroll-y">
								<thead>
									<tr>
										<th class='hidden-1024'>Sr/No</th>
                                                                                <th class='hidden-1024'>Policy No</th>
<!--										<th class='hidden-1024'>IPNID</th>-->
										<th class='hidden-1024'>M-Pesa Code</th>
                                                                                
										<th class='hidden-1024'>Transaction Date</th>
										<th class='hidden-1024'>M-Pesa Amount</th>
										
									</tr>
								</thead>
								<tbody>
									<?php 
									$i = 1;
									$result_mpesa = mysql_query($query);
									while($row_member   =   mysql_fetch_array($result_mpesa))
									{
									//id,IPN_Id,mpesa_originator,mpesa_destination,mpesa_timestamp,mpesa_text,mpesa_user,mpesa_password,mpesa_code,mpesa_account,mpesa_msisdn,mpesa_transaction_date,mpesa_transaction_time,mpesa_amount,mpesa_sender,date_record_created,processed	?>
									<tr>
										<td class='hidden-1024'><?php echo $i;?>
										</td>
                                                                                <td class='hidden-1024'><?php echo $row_member['mpesa_account']?>
										</td>
                                                                                <td class='hidden-1024'><?php echo $row_member['mpesa_code']?>
										</td>
										
										<td class='hidden-1024'><?php echo $row_member['mpesa_transaction_date']?>
										</td>
										<td class='hidden-1024'><?php echo $row_member['mpesa_amount']?>
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
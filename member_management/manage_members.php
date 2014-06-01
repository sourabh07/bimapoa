<?php
include '../common_include_in.php';
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
$memberobj = new Members();
if ($_POST['submitted']) {
	if ($memberobj->RegisterMember()) {
		$memberobj->RedirectToURL("manage_members.php");
	}
}

if (isset($_SESSION['user_type'])) {
	$user_type = $_SESSION['user_type'];
} else {
    header("Location: ../index.php");
}
?>
<body>
	<?php include '../include/top_navigation_in.php'; ?>
<div class="container-fluid" id="content">
	<?php include '../include/left_navigation_in.php'; ?>
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
								<i class="icon-table"></i> Member Details
							</h3>

							<?php /*  if($user_type == "Admin")
							{ */
?>
							<button class="btn btn-mini btn-warning pull-right"
								style="margin-right: 10px;"
								onclick="window.location.href = 'add_member.php'">Add</button>

							<?php
							/* }
							 else
							{

							} */
							?>
							<button class="btn btn-mini btn-warning pull-right"
								style="margin-right: 10px;"
								onclick="window.location.href = 'member_export_data.php'">Export
								CSV</button>
						</div>
						<div class="box-content nopadding">
							<table
								class="table table-nomargin table-striped dataTable dataTable-reorder  dataTable-scroll-x dataTable-scroll-y">
								<thead>
									<tr>
										<th class='hidden-350'>Sr/No</th>
										<th class='hidden-1024'>Scheme</th>
										<th class='hidden-1024'>Policy No</th>
										<th class='hidden-1024'>Contract Effective Date</th>
										<th class='hidden-1024'>Contract Expiry Date</th>
										<th class='hidden-1024'>Membership No</th>
										<th class='hidden-1024'>Membership Name</th>
										<th class='hidden-1024'>DOB</th>
										<th class='hidden-1024'>Sex</th>
										<th class='hidden-1024'>Relation</th>
										<th class='hidden-1024'>National ID</th>
										<th class='hidden-1024'>Area</th>
										<th class='hidden-1024'>Region</th>
										<th class='hidden-1024'>Location</th>
										<th class='hidden-1024'>Selected Provider Code</th>
										<th class='hidden-1024'>CHW Code</th>
										<th class='hidden-1024'>Signed Date</th>
										<th class='hidden-1024'>Date Captured</th>
										<th class='hidden-1024'>Card Issued</th>
										<th class='hidden-1024'>Status</th>
										<th class='hidden-1024'>Terminate Date</th>
										<th class='hidden-1024'>Payment Type</th>
										<?php
										if ($user_type == "Admin") {
                                            ?>
										<th class='hidden-450'>Actions</th>
										<?php }
										?>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = '1';
									$qrystring = "";
									if (isset($_POST['policy_no']) && isset($_POST['national_id']) && $_POST['national_id'] != '' && $_POST['policy_no'] != '') {
                                        $qrystring = "select * from bimapoa_members  where policy_no='" . $_POST['policy_no'] . "' or national_id='" . $_POST['national_id'] . "'";
                                    } else if (isset($_POST['policy_no']) && $_POST['policy_no'] != '') {
                                        $qrystring = "select * from bimapoa_members where policy_no='" . $_POST['policy_no'] . "'";
                                    } else if (isset($_POST['national_id']) && $_POST['national_id'] != '') {
                                        $qrystring = "select * from bimapoa_members where national_id='" . $_POST['national_id'] . "'";
                                    } else {
                                        $qrystring = "select * from bimapoa_members";
                                    }
                                    $result_member = mysql_query($qrystring);
                                    while ($row_member = mysql_fetch_array($result_member)) {
                                        $result_area = mysql_query("select * from area where area_id='" . $row_member['area'] . "'");
                                        $row_area = mysql_fetch_array($result_area);

                                        $result_region = mysql_query("select * from region where region_id='" . $row_member['region'] . "'");
                                        $row_region = mysql_fetch_array($result_region);


                                        $result_location = mysql_query("select * from location where location_id='" . $row_member['location'] . "'");
                                        $row_location = mysql_fetch_array($result_location);
                                        ?>
                                        
									<tr <?php if($row_member['status']=='T'){ ?>style="color:red;"<?php }?>>
										<td class='hidden-350'><?php echo $i ?>
										</td>
										<td class='hidden-1024'><?php echo $row_member['scheme'] ?>
										</td>
										<td class='hidden-1024'><?php echo $row_member['policy_no'] ?>
										</td>
										<td class='hidden-1024'><?php echo $row_member['contract_effective_date'] ?>
										</td>
										<td class='hidden-1024'><?php echo $row_member['contract_expiry_date'] ?>
										</td>
										<td class='hidden-1024'><?php echo $row_member['membership_no'] ?>
										</td>
										<td class='hidden-1024'><?php echo $row_member['membership_name'] ?>
										</td>
										<td class='hidden-1024'><?php echo $row_member['dob'] ?>
										</td>
										<td class='hidden-1024'><?php echo $row_member['sex'] ?>
										</td>
										<td class='hidden-1024'><?php echo $row_member['relation'] ?>
										</td>
										<td class='hidden-1024'><?php echo $row_member['national_id'] ?>
										</td>
										<td class='hidden-1024'><?php 
										if(is_numeric($row_member['area']))
										{
										   echo $row_area['name']; 
										}else{
											echo $row_member['area'];
										}
										?>
										</td>
										<td class='hidden-1024'><?php 
										if(is_numeric($row_member['region']))
										{
											echo $row_region['region_name'];
										}else{
											echo $row_member['region'];
										}
										?>
										</td>
										<td class='hidden-1024'><?php 
										if(is_numeric($row_member['location']))
										{
											echo $row_location['location_name'];
										}else{
											echo $row_member['location'];
										}
										?>
										</td>
										<td class='hidden-1024'><?php echo $row_member['selected_provider_code'] ?>
										</td>
										<td class='hidden-1024'><?php echo $row_member['chw_code'] ?>
										</td>
										<td class='hidden-1024'><?php echo $row_member['date_signed'] ?>
										</td>
										<td class='hidden-1024'><?php echo $row_member['date_captured'] ?>
										</td>
										<td class='hidden-1024'><?php echo $row_member['card_issued'] ?>
										</td>
										<td class='hidden-1024'><?php echo $row_member['status'] ?>
										</td>
										<td class='hidden-1024'><?php echo $row_member['terminated_date'] ?>
										</td>
										<td class='hidden-1024'><?php 
										if($row_member['payment_type'] != '' && $row_member['relation'] == "SELF")
										{
											
										echo $row_member['payment_type']; 
										
										}else{
											$querympesa = mysql_query("select * from mpesa where mpesa_account='".$row_member['policy_no']."'");
											$fetchmytra = mysql_fetch_array($querympesa);
											
											if($fetchmytra['mpesa_amount'] == '8000'  && $row_member['relation'] == "SELF")
											{
												echo "Full";
											}else if($fetchmytra['mpesa_amount'] == '4000'  && $row_member['relation'] == "SELF")
											{
												echo "Two";
											}else if($fetchmytra['mpesa_amount'] == '800'  && $row_member['relation'] == "SELF")
											{
												echo "Monthly";
											}
											
										}
										
										?>
										</td>
										<?php
										if ($user_type == "Admin") {

$count = $memberobj ->row_count('bimapoa_members', 'policy_no = "'.$row_member['policy_no'].'"');


     ?>
										<td class='hidden-450'><?php
										if ($row_member['relation'] == "SELF") {
                                                    ?>
											<button class="btn btn-mini btn-warning"
												onclick="window.location.href = 'update_member_form.php?member_id=<?echo $row_member['member_id'];?>';">
												<i class="icon-edit"></i>
											</button> 
											<button class="btn btn-small btn-inverse"
												onclick="window.location.href = 'documents.php?member_id=<?echo $row_member['member_id'];?>';">
												<i>View Documents</i>
											</button>
											<?php }
											?>
											
											<?php 
											if($count != '6' && $row_member['relation'] == "SELF")
											{
												?>
												
												
												
												<?php 
											}
											
											?>
											</td>
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
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-38620714-4']);
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>
</html>
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

$userobj = new Users();

$policy_no = $_GET['policy_no'];
$current_status = $_GET['current_status']
?>
<script
src="../js/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Datepicker -->
<link
    rel="stylesheet" href="../css/plugins/datepicker/datepicker.css">

<?php include '../include/top_navigation_in.php';?>
<div class="container-fluid" id="content">
<?php include '../include/left_navigation_in.php';?>
	<div id="main">
		<div class="container-fluid">
			<div class="page-header">
				<div class="pull-left">
					<h1>Add Termination Date</h1>
				</div>
			</div>
			<div class="breadcrumbs">
				<ul>
					<li><a href="more-login.html">Home</a> <i class="icon-angle-right"></i>
					</li>
					<li><a href="add_user.php">Add Termination Date</a>
					</li>
				</ul>
				<div class="close-bread">
					<a href="#"><i class="icon-remove"></i> </a>
				</div>
			</div>
			<div align="left">
				<span class='error'><?php echo ucwords($userobj->GetErrorMessage()); ?>
				</span>
			</div>
			<div class="row-fluid">
				<div class="span12">
					<div class="box box-color box-bordered">
						<div class="box-title">
							<h3>
								<i class="icon-user"></i> Add Termination Date
							</h3>
						</div>
						<div class="box-content nopadding">
							<form class="form-horizontal form-bordered" method="get"
								action="change_status.php">
								<div class="control-group">
									<label for="textfield" class="control-label">Termination Date</label>
									<div class="controls">
										<input type="text" name="termination_date"
											class="input-xlarge datepick" id="termination_date" />
											<input type="hidden" name="policy_no" value="<?php echo $policy_no ?>">
											<input type="hidden" name="current_status" value="<?php echo $current_status ?>">
									</div>
								</div>
								<div class="control-group">
									<div class="controls">
										<input type="submit" name="submitted" value="Submit"
											class="btn btn-primary" /> <input type="button" name="cancel"
											value="Cancel" class="btn btn-primary"
											onclick="window.location.href='manage_users.php'" /> <input
											type="hidden" name="form_name" id="form_name"
											value="add_group" />
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>







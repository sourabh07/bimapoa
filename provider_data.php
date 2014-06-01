<!doctype html>
<html>
<head>
<meta charset="utf8">
<meta name="viewport"
	content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<!-- Apple devices fullscreen -->
<meta name="apple-mobile-web-app-capable" content="yes" />
<!-- Apple devices fullscreen -->
<meta names="apple-mobile-web-app-status-bar-style"
	content="black-translucent" />
<title>Africa Medilink</title>
<!-- Bootstrap -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<!-- Bootstrap responsive -->
<link rel="stylesheet" href="css/bootstrap-responsive.min.css">
<!-- jQuery UI -->
<link rel="stylesheet"
	href="css/plugins/jquery-ui/smoothness/jquery-ui.css">
<link rel="stylesheet"
	href="css/plugins/jquery-ui/smoothness/jquery.ui.theme.css">
<!-- dataTables -->
<link rel="stylesheet" href="css/plugins/datatable/TableTools.css">
<!-- chosen -->
<link rel="stylesheet" href="css/plugins/chosen/chosen.css">
<!-- Theme CSS -->
<link rel="stylesheet" href="css/style.css">
<!-- Color CSS -->
<link rel="stylesheet" href="css/themes.css">
<!-- jQuery -->
<script src="js/jquery.min.js"></script>
<!-- jQuery UI -->
<script src="js/plugins/jquery-ui/jquery.ui.core.min.js"></script>
<script src="js/plugins/jquery-ui/jquery.ui.widget.min.js"></script>
<script src="js/plugins/jquery-ui/jquery.ui.mouse.min.js"></script>
<script src="js/plugins/jquery-ui/jquery.ui.resizable.min.js"></script>
<!-- slimScroll -->
<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<!-- Bootstrap -->
<script src="js/bootstrap.min.js"></script>
<!-- Bootbox -->
<script src="js/plugins/bootbox/jquery.bootbox.js"></script>
<!-- dataTables -->
<script src="js/plugins/datatable/jquery.dataTables.min.js"></script>
<script src="js/plugins/datatable/TableTools.min.js"></script>
<script src="js/plugins/datatable/ColReorder.min.js"></script>
<script src="js/plugins/datatable/ColVis.min.js"></script>
<script src="js/plugins/datatable/FixedColumns.min.js"></script>
<script src="js/plugins/datatable/dataTables.scroller.min.js"></script>
<!-- Chosen -->
<script src="js/plugins/chosen/chosen.jquery.min.js"></script>
<!-- Theme framework -->
<script src="js/eakroko.min.js"></script>
<!-- Theme scripts -->
<script src="js/application.min.js"></script>
<!-- Just for demonstration -->
<script src="js/demonstration.min.js"></script>
<!-- Favicon -->
<link rel="shortcut icon" href="img/favicon.ico" />
<!-- Apple devices Homescreen icon -->
<link rel="apple-touch-icon-precomposed"
	href="img/apple-touch-icon-precomposed.png" />
</head>
<body>
	<div id="navigation">
		<div class="container-fluid">
			<a href="#" id="brand">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
			<a href="#" class="toggle-nav" rel="tooltip" data-placement="bottom"
				title="Toggle navigation"><i class="icon-reorder"></i> </a>
			<ul class='main-nav'>
				<li class="active"><a href="#" data-toggle="dropdown"
					class='dropdown-toggle'> <i class="icon-edit"></i> <span>Beneficiary
							Data</span> <span class="caret"></span>
				</a>
					<ul class="dropdown-menu">
						<li><a href="#">Groups</a></li>
						<li><a href="#">Families</a></li>
						<li><a href="#">Members</a></li>
					</ul></li>
				<li><a href="#" data-toggle="dropdown" class='dropdown-toggle'> <i
						class="icon-edit"></i> <span>Sales Agent</span> <span
						class="caret"></span>
				</a>
					<ul class="dropdown-menu">
						<li><a href="#">Region wise</a></li>
						<li><a href="#">Performance</a></li>
					</ul></li>
				<li><a href="#" data-toggle="dropdown" class='dropdown-toggle'> <i
						class="icon-th-large"></i> <span>Payment Report</span> <span
						class="caret"></span>
				</a>
					<ul class="dropdown-menu">
						<li><a href="#">Payment pending</a></li>
						<li><a href="#">Payment recieved</a></li>
					</ul></li>
				<li><a href="#" data-toggle="dropdown" class='dropdown-toggle'> <i
						class="icon-table"></i> <span>Provider Report</span> <span
						class="caret"></span>
				</a>
					<ul class="dropdown-menu">
						<li><a href="#">Region wise</a></li>
						<li><a href="#">Visits & Utilization</a></li>
					</ul></li>
				<li><a href="#" data-toggle="dropdown" class='dropdown-toggle'> <i
						class="icon-th-large"></i> <span>Invoices & Payouts</span> <span
						class="caret"></span>
				</a>
					<ul class="dropdown-menu">
						<li><a href="#">Group Invoice Generation</a></li>
						<li><a href="#">Provider payouts</a></li>
						<li><a href="#">Sales Agent Incentive payout</a></li>
						<li><a href="#">NHIF payout</a></li>
						<li><a href="#">Xplico payout</a></li>
						<li><a href="#">AML payout</a></li>
						<li class="dropdown-submenu"><a href="#" data-toggle="dropdown"
							class="dropdown-toggle">Jawabu payout</a>
							<ul class="dropdown-menu">
								<li><a href="#">Admin</a></li>
								<li><a href="#">Xplico</a></li>
								<li><a href="#">NHIF</a></li>
							</ul></li>
					</ul></li>

			</ul>
			<div class="user">
				<ul class="icon-nav">

					<li><a href="lockscreen/lock_screen.html" class='lock-screen'
						rel='tooltip' title="Lock screen" data-placement="bottom"><i
							class="icon-lock"></i> </a></li>
				</ul>
				<div class="dropdown">
					<a href="#" class='dropdown-toggle' data-toggle="dropdown">John Doe
						<img src="img/demo/user-avatar.jpg" alt="">
					</a>
					<ul class="dropdown-menu pull-right">
						<li><a href="userprofile.html">Edit profile</a></li>
						<li><a href="#">Account settings</a></li>
						<li><a href="login.html">Sign out</a></li>
					</ul>
				</div>
			</div>
			<a href="#" class='toggle-mobile'><i class="icon-reorder"></i> </a>
		</div>
	</div>
	<div class="container-fluid" id="content">
		<div id="left">
			<form action="http://www.eakroko.de/flat/search-results.html"
				method="GET" class='search-form'>
				<div class="search-pane">
					<input type="text" name="search" placeholder="Search here...">
					<button type="submit">
						<i class="icon-search"></i>
					</button>
				</div>
			</form>
			<div class="subnav">
				<div class="subnav-title">
					<a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Enrollment</span>
					</a>
				</div>
				<ul class="subnav-menu">
					<li><a href="group_data.html">Group Data</a></li>
					<li><a href="beneficiary_data.html">Beneficiary Data</a></li>
					<li><a href="sales_agent.html">Sales Agent</a></li>
					<li><a href="provider_data.html">Provider Data</a></li>
				</ul>
			</div>
			<div class="subnav">
				<div class="subnav-title">
					<a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Payment
							received</span> </a>
				</div>
				<ul class="subnav-menu">
					<li><a href="group_payment.html">Group payment</a></li>
					<li><a href="individual_payments.html">Individual payments</a>
					</li>
				</ul>
			</div>
			<div class="subnav">
				<div class="subnav-title">
					<a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Claims</span>
					</a>
				</div>
				<ul class="subnav-menu">
					<li><a href="outpatient.html">Outpatient</a></li>
					<li><a href="inpatient.html">Inpatient</a></li>
				</ul>
			</div>
			<div class="subnav">
				<div class="subnav-title">
					<a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>System
							user & rights</span> </a>
				</div>
				<ul class="subnav-menu">
					<li><a href="system_user_rights.html">Overview</a></li>

				</ul>

			</div>
		</div>
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Manage Provider</h1>
					</div>
					<div class="pull-right">

						<ul class="stats">
							<li class='blue'><i class="icon-shopping-cart"></i>
								<div class="details">
									<span class="big">175</span> <span>New orders</span>
								</div>
							</li>
							<li class='green'><i class="icon-money"></i>
								<div class="details">
									<span class="big">$324,12</span> <span>Balance</span>
								</div>
							</li>
							<li class='orange'><i class="icon-calendar"></i>
								<div class="details">
									<span class="big">February 22, 2013</span> <span>Wednesday,
										13:56</span>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div class="breadcrumbs">
					<ul>
						<li><a href="../dashboard.php">Home</a> <i
							class="icon-angle-right"></i>
						</li>
						<li><a href="#">Manage Provider</a>
						</li>
					</ul>
					<div class="close-bread">
						<a href="#"><i class="icon-remove"></i> </a>
					</div>
				</div>

				<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered red">
							<div class="box-title">
								<h3>
									<i class="icon-table"></i> Provider Details
								</h3>
								<button class="btn btn-mini btn-warning pull-right"
									style="margin-right: 10px;"
									onclick="window.location.href='add_provider.php'">Add</button>
							</div>
							<div class="box-content nopadding">
								<table
									class="table table-nomargin table-bordered dataTable dataTable-scroll-x dataTable-scroll-y">
									<thead>
										<tr>
											<!-- <th>Select</th> -->
											<th>Provider Name</th>
											<th>Address</th>
											<!-- <th>DOB</th> -->
											<th>P.O Box</th>
											<th>Attach Price List</th>
											<th>Quality Assessment Status</th>
											<th>Data Of Contract</th>
											<!-- <th>IP</th>
										<th>OP</th> -->
											<th>Attach Contract</th>
											<th>Contact Person</th>
											<th>Contact No</th>
											<th>Bank Name</th>
											<th>Bank Branch</th>
											<th>Account Name</th>
											<th>Account Number</th>
											<th>IIFC Code</th>
											<th>Provider Code</th>
											<th>Action</th>
										</tr>
									</thead>
									<?php 
									$result_provider = mysql_query("select * from provider");
									while($row_provider = mysql_fetch_array($result_provider))
									{
										$result_city = mysql_query("select * from city where city_id='".$row_provider['city_id']."'");
										$row_city    = mysql_fetch_array($result_city);

										?>
									<tbody>
										<tr>
											<td><?php echo $row_provider['provider_name']?></td>
											<td><?php echo $row_provider['provider_address']?></td>
											<td><?php echo $row_provider['provider_pobox_no']?></td>
											<td><?php echo $row_provider['attach_price_list']?></td>
											<td><?php echo $row_provider['quality_assessment_status']?></td>
											<td><?php echo $row_provider['data_of_contract']?></td>
											<!-- <td><?php echo $row_provider['IP']?></td>
										<td><?php echo $row_provider['OP']?></td> -->
											<td><?php echo $row_provider['attach_contract']?></td>
											<td><?php echo $row_provider['contact_person']?></td>
											<td><?php echo $row_provider['contact_no']?></td>
											<td><?php echo $row_provider['bank_name']?></td>
											<td><?php echo $row_provider['bank_branch']?></td>
											<td><?php echo $row_provider['account_name']?></td>
											<td><?php echo $row_provider['account_no']?></td>
											<td><?php echo $row_provider['iifc_code']?></td>
											<td><?php echo $row_provider['provider_code']?></td>
											<td><button class="btn btn-mini btn-warning"
													onclick="window.location.href='update_provider_form.php?provider_id=<?echo $row_provider['provider_id'];?>';">
													<i class="icon-edit"></i>
												</button>
												<button class="btn btn-small btn-inverse"
													onclick="window.location.href='delete_provider.php?provider_id=<?echo $row_provider['provider_id'];?>';">
													<i class="icon-trash"></i>
												</button></td>
										</tr>
									</tbody>
									<?php }?>
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


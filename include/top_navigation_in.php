<?php
if(isset($_SESSION['user_type']))
{
	$user_type = $_SESSION['user_type'];
}
else
{
	header("Location: ../index.php");
}
?>

<div id="navigation">
	<div class="container-fluid">
		<a href="../dashboard.php" id="brand"> <!-- <img
			src="../PDF_CON_Astha/images/111.jpg" height="150" width="120"
			style="alignment-adjust: middle;" /> -->
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</a> <a href="#" class="toggle-nav" rel="tooltip"
			data-placement="bottom" title="Toggle navigation"><i
			class="icon-reorder"></i> </a>
<?php if($user_type != "Provider")
	{
		?>
		<ul class='main-nav'>

			<li><a href="#" data-toggle="dropdown" class='dropdown-toggle'> <i
					class="icon-edit"></i> <span>Reports</span> <span class="caret"></span>
			</a>
				<ul class="dropdown-menu">
					<li><a href="../report_management/data_not_found.php">Pending Member Data</a></li>
					<li><a href="../report_management/transaction_not_found.php">Pending Payment Data</a></li>
					<li><a href="../report_management/pending_transaction_list.php">Pending Installments</a></li>
				</ul></li>
		</ul>
		<?php 
	}
		?>
		<div class="user">
			<ul class="icon-nav">

				<!-- <li><a href="lockscreen/lock_screen.html" class='lock-screen'
					rel='tooltip' title="Lock screen" data-placement="bottom"><i
						class="icon-lock"></i> </a>
				</li> -->
			</ul>

			<div class="dropdown">
				<a href="#" class='dropdown-toggle' data-toggle="dropdown"><img
					src="../img/logo.png" alt=""> </a>
				<ul class="dropdown-menu pull-right">
					<li><a href="../user_management/profile.php">Edit Profile</a>
					</li>
					<li><a href="../user_management/change_password.php">Change
							Password</a>
					</li>
					<li><a href="../logout.php">Sign Out</a>
					</li>
				</ul>
			</div>


		</div>
		<a href="#" class='toggle-mobile'><i class="icon-reorder"></i> </a>
	</div>
</div>

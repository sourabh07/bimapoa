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

<?php if($user_type == "Provider")
{
	?>
<div id="left">
<div class="subnav">
<div class="subnav-title"><a href="#" class='toggle-subnav'><i
	class="icon-angle-down"></i><span>Enrollment</span> </a></div>
<ul class="subnav-menu">

	<li><a href="../member_management/manage_members.php">Member Management</a>
	</li>

</ul>
</div>
</div>
	<?php
}
else {

	?>


<div id="left"><?php 
if($user_type =="Admin")
{
	?>
<div class="subnav">
<div class="subnav-title"><a href="#" class='toggle-subnav'><i
	class="icon-angle-down"></i><span>System User</span> </a></div>
<ul class="subnav-menu">
	<li><a href="../user_management/manage_users.php">User Management</a></li>
</ul>
</div>
	<?php
}
else
{

}
?>

<div class="subnav">
<div class="subnav-title"><a href="#" class='toggle-subnav'><i
	class="icon-angle-down"></i><span>Sales Agent</span> </a></div>
<ul class="subnav-menu">
	<li><a href="../agent_management/manage_agents.php">Agent Management</a>
	</li>
</ul>
</div>
<div class="subnav">
<div class="subnav-title"><a href="#" class='toggle-subnav'><i
	class="icon-angle-down"></i><span>Providers</span> </a></div>
<ul class="subnav-menu">
	<li><a href="../provider_management/manage_providers.php">Provider
	Management</a></li>
</ul>
</div>

<div class="subnav">
<div class="subnav-title"><a href="#" class='toggle-subnav'><i
	class="icon-angle-down"></i><span>Enrollment</span> </a></div>
<ul class="subnav-menu">

	<li><a href="../member_management/manage_members.php">Member Management</a>
	</li>
	<li><a href="../installment_management/manage_full_payment.php">Full
	Payment</a></li>
	<li><a href="../installment_management/manage_two_installments.php">Two
	Installments</a></li>
	<li><a href="../installment_management/manage_monthly_installments.php">Monthly
	Installments</a></li>
</ul>
</div>

<div class="subnav">
<div class="subnav-title"><a href="#" class='toggle-subnav'><i
	class="icon-angle-down"></i><span>All Transaction</span> </a></div>
<ul class="subnav-menu">
	<li><a href="../mpesa_transaction/mpesa_transaction_list.php">
	Transaction Management</a></li>
	<!-- <li><a href="../mpesa_transaction/pending_transaction_list.php">Pending
					Transactions</a>
			</li> -->
</ul>
</div>


<?php
if ($user_type == "Admin") {
	?>
<div class="subnav">
<div class="subnav-title"><a href="#" class='toggle-subnav'><i
	class="icon-angle-down"></i><span>Upload Data</span> </a></div>
<ul class="subnav-menu">
	<li><a href="../upload_data.php">CSV Upload</a></li>
</ul>
</div>
	<?php
}
?></div>
<?php }?>
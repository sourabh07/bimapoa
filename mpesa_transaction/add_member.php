<?php 
include '../common_include_in.php';
include '../include/header_in.php';
$memberobj = new Members();
if($_POST['submitted']){
	if ($memberobj->RegisterMember()) {
		$memberobj->RedirectToURL("manage_users.php");
	}
}
?>
<?php include '../include/top_navigation_in.php';?>
<div class="container-fluid" id="content">
	<?php include '../include/left_navigation_in.php';?>
	<div id="main">
		<div class="container-fluid">
			<div class="page-header">
				<div class="pull-left">
					<h1>Add Member</h1>
				</div>

			</div>
			<div class="breadcrumbs">
				<ul>
					<li><a href="../dashboard.php">Home</a> <i class="icon-angle-right"></i>
					</li>
					<li><a href="#">Add Member</a>
					</li>
				</ul>
				<div class="close-bread">
					<a href="#"><i class="icon-remove"></i> </a>
				</div>
			</div>
			<div align="left">
				<span class='error'><?php echo ucwords($memberobj->GetErrorMessage()); ?>
				</span>
			</div>
			<div class="row-fluid">
				<div class="span12">
					<div class="box box-color box-bordered">
						<div class="box-title">
							<h3>
								<i class="icon-user"></i> Add Member
							</h3>
						</div>
						<div class="box-content nopadding">
							<form class="form-horizontal form-bordered" method="post"
								action="<?php echo $memberobj->GetSelfScript(); ?>">
								<div class="control-group">
									<label for="textfield" class="control-label">Full Name</label>
									<div class="controls">
										<input type="hidden" class='spmhidip'
											name='<?php echo $memberobj->GetSpamTrapInputName(); ?>' /> <input
											type="text" name="member_name"
											value="<?php echo $memberobj->SafeDisplay('member_name');?>"
											id="group_name" />
									</div>
								</div>
								<div class="control-group">
									<label for="textfield" class="control-label">Policy Number</label>
									<div class="controls">
										<input type="text" name="policy_no"
											value="<?php echo $memberobj->SafeDisplay('policy_no');?>"
											id="address" />
									</div>
								</div>
								<div class="control-group">
									<label for="textfield" class="control-label">National ID</label>
									<div class="controls">
										<input type="text" name="national_id"
											value="<?php echo $memberobj->SafeDisplay('national_id');?>"
											id="address" />
									</div>
								</div>



								<div class="control-group">
									<label for="textfield" class="control-label">Payment Type</label>
									<div class="controls">
										<select name="payment_type" id="payment_type">
											<option>---Select Payment Type---</option>
											<option value="One Time">One Time</option>
											<option value="Two Time">Two Installment</option>
											<option value="Monthly">Monthly Installment</option>
										</select>
									</div>
								</div>
								<div class="control-group">
									<div class="controls">
										<input type="submit" name="submitted" value="submit" /> <input
											type="button" name="cancel" value="Cancel"
											onclick="window.location.href='manage_members.php'" /> <input
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







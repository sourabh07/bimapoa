<?php
include '../common_include_in.php';
include '../include/header_in.php';
$memberobj = new Members();
if($_POST['updated']){
	if ($memberobj->UpdateMember()) {
		$memberobj->RedirectToURL("manage_members.php");
	}
}
$id = $_GET['member_id'];
$result=  mysql_query("select * from bimapoa_members where member_id='".$id."'");
$row=  mysql_fetch_array($result);
include '../include/top_navigation.php';?>
<div class="container-fluid" id="content">
	<?php include '../include/left_navigation_in.php';?>
	<div id="main">
		<div class="container-fluid">
			<div class="page-header">
				<div class="pull-left">
					<h1>Update Member</h1>
				</div>

			</div>
			<div class="breadcrumbs">
				<ul>
					<li><a href="more-login.html">Home</a> <i class="icon-angle-right"></i>
					</li>
					<li><a href="add_group.php">Update Member</a><i
						class="icon-angle-right"></i>
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
								<i class="icon-user"></i> Update Member
							</h3>
						</div>
						<div class="box-content nopadding">
							<form class="form-horizontal form-bordered" method="post"
								action="<?php echo $memberobj->GetSelfScript(); ?>">
								<div class="control-group">
									<label for="textfield" class="control-label">Full Name</label>
									<div class="controls">
										<input type="text" name="member_name"
											value="<?php echo $row['member_name'];?>" id="member_name" />
										<input type="hidden" name="member_id"
											value="<?php echo $row['member_id'];?>" id="member_id" />
									</div>
								</div>
								<div class="control-group">
									<label for="textfield" class="control-label">Policy Number</label>
									<div class="controls">
										<input type="text" name="policy_no"
											value="<?php echo $row['policy_no'];?>" id="address" />
									</div>
								</div>
								<div class="control-group">
									<label for="textfield" class="control-label">National ID</label>
									<div class="controls">
										<input type="text" name="national_id"
											value="<?php echo $row['national_id'];?>" id="address" />
									</div>
								</div>
								<div class="control-group">
									<div class="controls">
										<input type="submit" name="updated" value="submit" /> <input
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

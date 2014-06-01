<?php
include '../common_include_in.php';
include '../include/header_in.php';
 $userobj = new Users();
if($_POST['updated']){
	if ($userobj->UpdateUser()) {
		$userobj->RedirectToURL("manage_users.php");
	}
} 
$id = $_SESSION['user_id'];
$result=  mysql_query("select * from users where user_id='".$id."'");
$row=  mysql_fetch_array($result);
include '../include/top_navigation_in.php';?>
<div class="container-fluid" id="content">
	<?php include '../include/left_navigation_in.php';?>
	<div id="main">
		<div class="container-fluid">
			<div class="page-header">
				<div class="pull-left">
					<h1>Change Password</h1>
				</div>
<!--				<div class="pull-right">

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
				</div>-->
			</div>
			<div class="breadcrumbs">
				<ul>
					<li><a href="../dashboard.php">Home</a> <i class="icon-angle-right"></i>
					</li>
					<li><a href="#">Change Password</a>
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
								<i class="icon-user"></i> Change Password
							</h3>
						</div>
						<div class="box-content nopadding">
							<form class="form-horizontal form-bordered" method="post"
								action="change_password_action.php">
								<div class="control-group">
									<label for="textfield" class="control-label">Old Password</label>
									<div class="controls">
										<input type="hidden" class='spmhidip'
											name='<?php echo $userobj->GetSpamTrapInputName(); ?>' /> <input
											type="text" name="oldpassword"
											 id="oldpassword" /> <input
											type="hidden" name="user_id" value="<?php echo $id?>"
											id="user_id" />
									</div>
								</div>
								<div class="control-group">
									<label for="textfield" class="control-label">New Password</label>
									<div class="controls">
										<input type="text" name="newpassword"
											 id="newpassword" />
									</div>
								</div>
								
								<div class="control-group">
									<label for="textfield" class="control-label">Confirm Password </label>
									<div class="controls">
										<input type="text" name="confirmpassword"
											 id="confirmpassword" />
									</div>
								</div>
								
								<div class="control-group">
									<div class="controls">
										<input type="submit" name="submit" value="Submit" class="btn btn-primary" /> <input
											type="button" name="cancel" value="Cancel" class="btn btn-primary"
											onclick="window.location.href='manage_users.php'" /><input
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

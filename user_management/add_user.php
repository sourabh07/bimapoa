<?php 
include '../common_include_in.php';
include '../include/header_in.php';
$userobj = new Users();
if($_POST['submitted']){
	if ($userobj->RegisterForm()){
		$userobj->RedirectToURL("manage_users.php");
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
					<h1>Add User</h1>
				</div>
			</div>
			<div class="breadcrumbs">
				<ul>
					<li><a href="more-login.html">Home</a> <i class="icon-angle-right"></i>
					</li>
					<li><a href="add_user.php">Add User</a>
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
								<i class="icon-user"></i> Add User
							</h3>
						</div>
						<div class="box-content nopadding">
							<form class="form-horizontal form-bordered" method="post"
								action="<?php echo $userobj->GetSelfScript(); ?>">
								<div class="control-group">
									<label for="textfield" class="control-label">* Full Name</label>
									<div class="controls">
										<input type="hidden" class='spmhidip'
											name='<?php echo $userobj->GetSpamTrapInputName(); ?>' /> <input
											type="text" name="full_name"
											value="<?php echo $userobj->SafeDisplay('full_name');?>"
											id="full_name" />
									</div>
								</div>
								<div class="control-group">
									<label for="textfield" class="control-label">* User Email</label>
									<div class="controls">
										<input type="text" name="user_email"
											value="<?php echo $userobj->SafeDisplay('user_email');?>"
											id="user_email" />
									</div>
								</div>
								<div class="control-group">
									<label for="textfield" class="control-label">* Password</label>
									<div class="controls">
										<input type="password" name="password"
											value="<?php echo $userobj->SafeDisplay('password');?>"
											id="password" />
									</div>
								</div>
								<div class="control-group">
									<label for="textfield" class="control-label">* User Type</label>
									<div class="controls">
										<!-- <input type="text" name="user_type"
											value="<?php echo $userobj->SafeDisplay('user_type');?>"
											id="user_type" /> -->
										<select name="user_type" id="user_type">
<!--											<option>---Select User Type---</option>-->
											<option>Admin</option>
											<option>Staff</option>
										</select>
									</div>
								</div>
								<div class="control-group">
									<label for="textfield" class="control-label">Role</label>
									<div class="controls">
										<input type="text" name="role"
											value="<?php echo $userobj->SafeDisplay('role');?>" id="role" />
									</div>
								</div>
								<div class="control-group">
									<label for="textfield" class="control-label">* Mobile No</label>
									<div class="controls">
										<input type="text" name="mobile" maxlength="10"
											value="<?php echo $userobj->SafeDisplay('mobile');?>"
											id="mobile" />
									</div>
								</div>



								<div class="control-group">
									<label for="textfield" class="control-label">Designation</label>
									<div class="controls">
										<input type="text" name="designation" maxlength="10"
											value="<?php echo $userobj->SafeDisplay('designation');?>"
											id="designation" />
									</div>
								</div>

								<div class="control-group">
									<label for="textfield" class="control-label">Gender</label>
									<div class="controls">
										<select name="gender" id="gender">
<!--											<option>---Select Sex---</option>-->
											<option value="Female">Female</option>
											<option value="Male">Male</option>
										</select>
									</div>
								</div>

								<!-- 	<div class="control-group">
									<label for="textfield" class="control-label">Gender</label>
									<div class="controls">
										<input type="text" name="gender" maxlength="10"
											value="<?php echo $userobj->SafeDisplay('gender');?>"
											id="gender" />
									</div>
								</div> -->

								<div class="control-group">
									<div class="controls">
										<input type="submit" name="submitted" value="Submit"  class="btn btn-primary"/> <input
											type="button" name="cancel" value="Cancel" class="btn btn-primary"
											onclick="window.location.href='manage_users.php'"/> <input
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







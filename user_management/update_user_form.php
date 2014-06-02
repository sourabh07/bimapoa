<?php
include '../common_include_in.php';
include '../include/header_in.php';
$userobj = new Users();
if($_POST['updated']){
	if ($userobj->UpdateUser()) {
		$userobj->RedirectToURL("manage_users.php");
	}
}
$id = $_GET['user_id'];
$result=  mysql_query("select * from users where user_id='".$id."'");
$row=  mysql_fetch_array($result);
include '../include/top_navigation_in.php';?>
<div class="container-fluid" id="content"><?php include '../include/left_navigation_in.php';?>
<div id="main">
<div class="container-fluid">
<div class="page-header">
<div class="pull-left">
<h1>Update User</h1>
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
				</div>--></div>
<div class="breadcrumbs">
<ul>
	<li><a href="more-login.html">Home</a> <i class="icon-angle-right"></i>
	</li>
	<li><a href="add_group.php">Update User</a></li>
</ul>
<div class="close-bread"><a href="#"><i class="icon-remove"></i> </a></div>
</div>
<div align="left"><span class='error'><?php echo ucwords($userobj->GetErrorMessage()); ?>
</span></div>
<div class="row-fluid">
<div class="span12">
<div class="box box-color box-bordered">
<div class="box-title">
<h3><i class="icon-user"></i> Update User</h3>
</div>
<div class="box-content nopadding">
<form class="form-horizontal form-bordered" method="post"
	action="<?php echo $userobj->GetSelfScript(); ?>">
<div class="control-group"><label for="textfield" class="control-label">*
Full Name</label>
<div class="controls"><input type="hidden" class='spmhidip'
	name='<?php echo $userobj->GetSpamTrapInputName(); ?>' /> <input
	type="text" name="full_name" value="<?php echo $row['full_name']?>"
	id="full_name" /> <input type="hidden" name="user_id"
	value="<?php echo $id?>" id="user_id" /></div>
</div>
<div class="control-group"><label for="textfield" class="control-label">*
Email ID</label>
<div class="controls"><input type="text" name="user_email"
	value="<?php echo $row['user_email']?>" id="user_email" /></div>
</div>
<!--								<div class="control-group">
									<label for="textfield" class="control-label">Password</label>
									<div class="controls">
										<input type="password" name="password" readonly="readonly"
											value="<?php echo $row['password']?>" id="password" />
									</div>
								</div>-->
<div class="control-group"><label for="textfield" class="control-label">*
User Type</label>
<div class="controls"><input type="text" name="user_type"
	value="<?php echo $row['user_type']?>" id="user_type" /></div>
</div>

<div class="control-group">
<div class="controls"><input type="submit" name="updated" value="submit"
	class="btn btn-primary" /> <input type="button" name="cancel"
	value="Cancel" class="btn btn-primary"
	onclick="window.location.href='manage_users.php'" /> <input
	type="hidden" name="form_name" id="form_name" value="add_group" /></div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

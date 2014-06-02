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
<script>
 function check_provider(value)
    {
        $.ajax({
            type: "POST",
            url: "get_provider.php",
            data: "provider_code=" + value,
            success: function(result) {
                // alert(result);
                if (result != "error")
                {
                    document.getElementById('provider_name').value = result;
                }
            }
        });
    }
    </script>

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
									<label for="textfield" class="control-label">* Username</label>
									<div class="controls">
										<input type="text" name="username"
											value="<?php echo $userobj->SafeDisplay('username');?>"
											id="username" />
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
										<select name="user_type" id="user_type" onChange="disp_div(this.value)">
											<option value="Admin">Admin</option>
											<option value="Provider">Provider</option>
											<option value="Staff">Staff</option>
										</select>
									</div>
								</div>
								
									<div class="control-group" style = "display: none;" id="provider_code_div">
									<label for="textfield" class="control-label">* Provider Code</label>
									<div class="controls">
										<select name="provider_code"
											id="provider_code"
											onchange="check_provider(this.value)">
											<option>---Select Provider Code---</option>
											<?php echo $userobj->getProviders(); ?>
										</select>&nbsp;&nbsp; Provider Name &nbsp;&nbsp;<input
											type="text" name="provider_name" id="provider_name" value=""
											readonly="readonly">
									</div>
								</div>
								
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
<script>
function start()
{
        var f=document.getElementById("provider_code_div");
        f.style.display = 'none';
}
function disp_div(value)
{
       var f=document.getElementById("provider_code_div");
				if(value === "Provider")
				{      
					f.style.display = 'block';
				}
				else
				{
					   f.style.display = 'none';
				}
				
}      
</script>







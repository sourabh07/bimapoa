<?php
include '../common_include_in.php';
include '../include/header_in.php';
$providerobj = new Providers();
if($_POST['updated']){
	if ($providerobj->UpdateProvider()) {
		$providerobj->RedirectToURL("manage_providers.php");
	}
}
$id = $_GET['provider_id'];
$result=  mysql_query("select * from providers where provider_id='".$id."'");
$row=  mysql_fetch_array($result);
include '../include/top_navigation_in.php';?>
<div class="container-fluid" id="content">
	<?php include '../include/left_navigation_in.php';?>
	<div id="main">
		<div class="container-fluid">
			<div class="page-header">
				<div class="pull-left">
					<h1>Update Provider</h1>
				</div>

			</div>
			<div class="breadcrumbs">
				<ul>
					<li><a href="../dashboard.php">Home</a> <i class="icon-angle-right"></i>
					</li>
					<li><a href="add_group.php">Update Provider</a><i
						class="icon-angle-right"></i>
					</li>
				</ul>
				<div class="close-bread">
					<a href="#"><i class="icon-remove"></i> </a>
				</div>
			</div>
			<div align="left">
				<span class='error'><?php echo ucwords($providerobj->GetErrorMessage()); ?>
				</span>
			</div>
			<div class="row-fluid">
				<div class="span12">
					<div class="box box-color box-bordered">
						<div class="box-title">
							<h3>
								<i class="icon-user"></i> Update Provider
							</h3>
						</div>
						<div class="box-content nopadding">
							<form class="form-horizontal form-bordered" method="post"
								action="<?php echo $providerobj->GetSelfScript(); ?>">
									<div class="control-group">
									<label for="textfield" class="control-label">Provider Name</label>
									<div class="controls">
										<input type="hidden" class='spmhidip'
											name='<?php echo $providerobj->GetSpamTrapInputName(); ?>' />
										<input type="text" name="provider_name"
											value="<?php echo $row['provider_name'];?>"
											id="provider_name" />
											<input type="hidden" name="provider_id" value="<?php echo $row['provider_id'];?>" />
									</div>
								</div>
								<div class="control-group">
									<label for="textfield" class="control-label">Address</label>
									<div class="controls">
										<input type="text" name="address"
											value="<?php echo $row['address'];?>"
											id="provider_code" />
									</div>
								</div>

<!--								<div class="control-group">
									<label for="textfield" class="control-label">Provider Code</label>
									<div class="controls">
										<input type="text" name="provider_code"
											value="<?php echo $row['provider_code'];?>"
											id="contact_person" />
									</div>
								</div>-->


								<div class="control-group">
									<label for="textfield" class="control-label">Phone</label>
									<div class="controls">
                                                                            <input type="text" name="phone" maxlength="10"
											value="<?php echo $row['phone'];?>"
											id="contact_no" />
									</div>
								</div>
<!--								<div class="control-group">
									<label for="textfield" class="control-label">Bank Name</label>
									<div class="controls">
										<input type="text" name="bank_name"
											value="<?php echo $row['bank_name'];?>"
											id="bank_name" />
									</div>
								</div>

								<div class="control-group">
									<label for="textfield" class="control-label">Account Name</label>
									<div class="controls">
										<input type="text" name="account_name"
											value="<?php echo $row['account_name'];?>"
											id="account_name" />
									</div>
								</div>



								<div class="control-group">
									<label for="textfield" class="control-label">Account Number</label>
									<div class="controls">
										<input type="text" name="account_no"
											value="<?php echo $row['account_no'];?>"
											id="account_no" />
									</div>
								</div>


								<div class="control-group">
									<label for="textfield" class="control-label">IIFC Code</label>
									<div class="controls">
										<input type="text" name="iifc_code"
											value="<?php echo $row['iifc_code'];?>"
											id="iifc_code" />
									</div>
								</div>-->
								<div class="control-group">
									<div class="controls">
										<input type="submit" name="updated" value="Submit" class="btn btn-primary"/> <input
											type="button" name="cancel" value="Cancel" class="btn btn-primary"
											onclick="window.location.href='manage_providers.php'" /> <input
											type="hidden" name="form_name" id="form_name"
											value="add_provider" />
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

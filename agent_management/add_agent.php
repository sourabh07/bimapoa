<?php 
include '../common_include_in.php';
include '../include/header_in.php';
$agentobj = new Agents();
if($_POST['submitted']){
	if ($agentobj->RegisterAgent()) {
		$agentobj->RedirectToURL("manage_agents.php");
	}
}
?>
<?php include '../include/top_navigation.php';?>

<!-- Datepicker -->
    <script src="../js/plugins/datepicker/bootstrap-datepicker.js"></script>
        <!-- Datepicker -->
        <link rel="stylesheet" href="../css/plugins/datepicker/datepicker.css">

<div class="container-fluid" id="content">
	<?php include '../include/left_navigation_in.php';?>
	<div id="main">
		<div class="container-fluid">
			<div class="page-header">
				<div class="pull-left">
					<h1>Add Agent</h1>
				</div>

			</div>
			<div class="breadcrumbs">
				<ul>
					<li><a href="../dashboard.php">Home</a> <i class="icon-angle-right"></i>
					</li>
					<li><a href="#">Add Agent</a>
					</li>
				</ul>
				<div class="close-bread">
					<a href="#"><i class="icon-remove"></i> </a>
				</div>
			</div>
			<div align="left">
				<span class='error'><?php echo ucwords($agentobj->GetErrorMessage()); ?>
				</span>
			</div>
			<div class="row-fluid">
				<div class="span12">
					<div class="box box-color box-bordered">
						<div class="box-title">
							<h3>
								<i class="icon-user"></i> Add Agent
							</h3>
						</div>
						<div class="box-content nopadding">
							<form class="form-horizontal form-bordered" method="post"
								action="<?php echo $agentobj->GetSelfScript(); ?>">
								<div class="control-group">
									<label for="textfield" class="control-label">* Agent Name</label>
									<div class="controls">
										<input type="hidden" class='spmhidip' 
											name='<?php echo $agentobj->GetSpamTrapInputName(); ?>' /> <input
											type="text" name="name"
											value="<?php echo $agentobj->SafeDisplay('name');?>"
											id="group_name" />
									</div>
								</div>
								<div class="control-group">
									<label for="textfield" class="control-label">* Date Created</label>
									<div class="controls">
                                                                            <input type="text" name="date_created" class="input-xlarge datepick" 
											value="<?php echo $agentobj->SafeDisplay('date_created');?>"
											id="address" />
									</div>
								</div>
<!--								<div class="control-group">
									<label for="textfield" class="control-label">Agent code</label>
									<div class="controls">
										<input type="text" name="agent_code"
											value="<?php echo $agentobj->SafeDisplay('agent_code');?>"
											id="address" />
									</div>
								</div>-->

								<div class="control-group">
									<label for="textfield" class="control-label">* Phone Number</label>
									<div class="controls">
                                                                            <input type="text" name="phone" maxlength="10"
											value="<?php echo $agentobj->SafeDisplay('phone');?>"
											id="address" />
									</div>
								</div>


								<div class="control-group">
									<div class="controls">
										<input type="submit" name="submitted" value="Submit" class="btn btn-primary"/> <input
											type="button" name="cancel" value="Cancel" class="btn btn-primary"
											onclick="window.location.href='manage_agents.php'" /> <input
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







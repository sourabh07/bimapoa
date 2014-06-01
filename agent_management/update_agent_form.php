<?php
include '../common_include_in.php';
include '../include/header_in.php';
$agentobj = new Agents();
if($_POST['updated']){
	if ($agentobj->UpdateAgent()) {
		$agentobj->RedirectToURL("manage_agents.php");
	}
}
$id = $_GET['agent_id'];
$result=  mysql_query("select * from agent where agent_id='".$id."'");
$row=  mysql_fetch_array($result);
include '../include/top_navigation.php';?>

<script src="../js/plugins/datepicker/bootstrap-datepicker.js"></script>
        <!-- Datepicker -->
        <link rel="stylesheet" href="../css/plugins/datepicker/datepicker.css">

<div class="container-fluid" id="content">
	<?php include '../include/left_navigation_in.php';?>
	<div id="main">
		<div class="container-fluid">
			<div class="page-header">
				<div class="pull-left">
					<h1>Update Agent</h1>
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
					<li><a href="more-login.html">Home</a> <i class="icon-angle-right"></i>
					</li>
					<li><a href="add_group.php">Update Agent</a><i
						class="icon-angle-right"></i>
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
								<i class="icon-user"></i> Update Agent
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
											type="text" name="name" value="<?=$row['name'];?>"
											id="group_name" /> <input type="hidden" name="agent_id"
											value="<?php echo $id;?>">
									</div>
								</div>
<!--								<div class="control-group">
									<label for="textfield" class="control-label">Date Created</label>
									<div class="controls">
										<input type="text" name="date_created" class="input-xlarge datepick" 
											value="<?=$row['date_created'];?>" id="lname" />
									</div>
								</div>-->
								<!--  <div class="control-group">
									<label for="textfield" class="control-label">DOB</label>
									<div class="controls">
										<input type="text" name="dob" value="<?=$row['dob'];?>"
											id="address" />
									</div>
								</div>-->

<!--								<div class="control-group">
									<label for="textfield" class="control-label">Agent code</label>
									<div class="controls">
										<input type="text" name="agent_code" 
											value="<?=$row['agent_code'];?>" id="address" />
									</div>
								</div>-->
								<div class="control-group">
									<label for="textfield" class="control-label">* Phone Number</label>
									<div class="controls">
                                                                            <input type="text" name="phone" maxlength="10"
											value="<?php echo $row['phone'];?>" id="national_id" />
									</div>
								</div>
							

								<div class="control-group">
									<div class="controls">
										<input type="submit" name="updated" value="Submit"  class="btn btn-primary"/> <input
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

<?php 

include '../common_include_in.php';
include '../include/header_in.php';?>

<?php 
include '../include/top_navigation_in.php';

$agentobj = new Agents();

if($_POST['submitted']){
	if ($agentobj->RegisterAgents()) {
		$agentobj->RedirectToURL("manage_agents.php");
	}
}

if(isset($_SESSION['user_type']))
{
	$user_type = $_SESSION['user_type'];
}
else
{
	header("Location: ../index.php");
}


?>
<div class="container-fluid" id="content">
	<?php include '../include/left_navigation_in.php';?>
	<div id="main">
		<div class="container-fluid">
			<div class="page-header">
				<div class="pull-left">
					<h1>Manage Agent</h1>
				</div>
			</div>
			<div class="breadcrumbs">
				<ul>
					<li><a href="../dashboard.php">Home</a> <i class="icon-angle-right"></i>
					</li>
					<li><a href="#">Manage Agent</a>
					</li>
				</ul>
				<div class="close-bread">
					<a href="#"><i class="icon-remove"></i> </a>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12">

					<div class="box box-color box-bordered blue">
						<div class="box-title">
							<h3>
								<i class="icon-table"></i> Agent Details
							</h3>
							<button class="btn btn-mini btn-warning pull-right"
								style="margin-right: 10px;"
								onclick="window.location.href='add_agent.php'">Add</button>

							<!--                                                 <!--   <button class="btn btn-mini btn-warning pull-right"
								style="margin-right: 10px;"
								onclick="window.location.href='agent_export_data.php'">Export CSV</button>-->
                                                        
                                                         <button class="btn btn-mini btn-warning pull-right"
								style="margin-right: 10px;"
								onclick="window.location.href = '../download_log.php?sampleFile=uploads/log/log_agent.txt'">Download
								Log</button>
						</div>
						<div class="box-content nopadding">
							<table
								class="table table-nomargin table-striped dataTable dataTable-reorder  dataTable-scroll-x dataTable-scroll-y">
								<thead>
									<tr>
										<th class='hidden-350'>Sr/No</th>
										<th class='hidden-1024'>Agent Name</th>
										<th class='hidden-1024'>Date Created</th>
										<th class='hidden-450'>Agent Code</th>
										<!-- 	<th class='hidden-1024'>Phone</th> -->
										<?php if($user_type == "Admin") 
										{
											?>
										<th class='hidden-450'>Actions</th>
										<?php 
										}
										?>

									</tr>
								</thead>
								<tbody>
									<?php 
									$i = 1;
									$qrystring = "";
									if(isset($_POST['name']) && isset($_POST['agent_code']) && $_POST['agent_code']!='' &&  $_POST['name']!='')
									{
										$qrystring = "select * from agent  where agent_id='".$_POST['name']."' or agent_code='".$_POST['agent_code']."'";
									}
									else if(isset($_POST['name']) && $_POST['name']!='')
									{
										$qrystring = "select * from agent where agent_id='".$_POST['name']."'";
									}
									else if(isset($_POST['agent_code']) &&  $_POST['agent_code']!='')
									{
										$qrystring = "select * from agent where agent_code='".$_POST['agent_code']."'";
									}
									else
									{
										$qrystring = "select * from agent";
									}

									$result_agent = mysql_query($qrystring);
									while($row_agent    = mysql_fetch_array($result_agent))
									{
										$result_city = mysql_query("select * from city where city_id='".$row_agent['city_id']."'");
										$row_city    = mysql_fetch_array($result_city);

										?>
									<tr>
										<td class='hidden-350'><?php echo $i?></td>
										<td class='hidden-350'><?php echo $row_agent['name']?></td>
										<td class='hidden-1024'><?php echo $row_agent['date_created']?>
										</td>
										<td class='hidden-1024'><?php echo $row_agent['agent_code']?>
										</td>
										<!-- <td class='hidden-1024'><?php echo $row_agent['phone']?>
										</td> -->
										<?php if($user_type == "Admin") 
										{
											?>
										<td class='hidden-450'>
											<button class="btn btn-mini btn-warning"
												onclick="window.location.href='update_agent_form.php?agent_id=<?php echo $row_agent['agent_id'];?>';">
												<i class="icon-edit"></i>
											</button> <?php 
											$CurrentStatus = $row_agent['status'];
											$agent_code = $row_agent['agent_code'];
											if($CurrentStatus == '1')
											{
												?> <a class="btn btn-small btn-inverse"
											href="change_status.php?agent_code=<?php echo $agent_code?>&current_status=<?php echo $CurrentStatus?> ">
												Deactivate</a> <?php 
											}
											else if($CurrentStatus == '0')
											{
												?> <a class="btn btn-mini btn-warning"
											href="change_status.php?agent_code=<?php echo $agent_code?>&current_status=<?php echo $CurrentStatus?> ">
												Activate</a> <?php 
											}
											?>
										</td>
										<?php
										}
											
										?>
									</tr>
									<?php      
									$i++;
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>







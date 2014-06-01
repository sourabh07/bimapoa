<?php 

include '../common_include_in.php';
include '../include/header_in.php';?>

<?php 
include '../include/top_navigation_in.php';
$memberobj = new Members();
?>

  <script
	src="../js/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Datepicker -->
<link
	rel="stylesheet" href="../css/plugins/datepicker/datepicker.css">
	<?php include '../include/left_navigation_in.php';?>
	<div id="main">
		<div class="container-fluid">
			<div class="page-header">
				<div class="pull-left">
					<h1> Manage Full Payment</h1>
				</div>

			</div>
			<div class="breadcrumbs">
				<ul>
					<li><a href="../dashboard.php">Home</a> <i class="icon-angle-right"></i>
					</li>
					<li><a href="#"> Manage Full Payment </a>
					</li>
				</ul>

				<div class="close-bread">
					<a href="#"><i class="icon-remove"></i> </a>
				</div>
			</div>
           <div class="row-fluid">
			<div class="span12">
			
								<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
								<input  placeholder="Form Date"  class="input-xlarge datepick" name="mpesa_transaction_date_from" style="margin-top:20px;" />
								<input  placeholder="To Date" class="input-xlarge datepick" name="mpesa_transaction_date_to"  style="margin-top:20px;"/>
								<input  type="submit" name="search" value="Search" style="margin-top:20px;">
								</form>
								</div>
								</div>
			<div class="row-fluid">
				<div class="span12">

					<div class="box box-color box-bordered blue">
						<div class="box-title">
							<h3>
								<i class="icon-table"></i> Full Payment Details
							</h3>
                                                     <button class="btn btn-mini btn-warning pull-right"
								style="margin-right: 10px;"
								onclick="window.location.href='export_full_payment_data.php'">Export CSV</button>
						</div>
						<div class="box-content nopadding">
                                               </div>
					</div>
				</div>
			</div>
			
			
			<div class="row-fluid">
				<div class="span12">

				
				
				
					<div class="box box-color box-bordered blue">
				

						<div class="box-content nopadding">
							<table
								class="table table-nomargin table-striped dataTable dataTable-reorder  dataTable-scroll-x dataTable-scroll-y">
								
								<thead>
									<tr>  
                                        <th class='hidden-350'>Sr/No</th>
										<th class='hidden-1024'>Member Name</th>
										<th class='hidden-1024'>Policy No</th>
										<th class='hidden-1024'>National ID</th>
										<th class='hidden-1024'>Transaction Amount</th>
										<th class='hidden-1024'>Transaction Date</th>
<!--									<th class='hidden-450'>Action</th>-->
								</tr>
								</thead>
								<tbody>
									<?php 
										
									
                                    $i=1;
									$qrystring = "";
									
									if(!empty($_POST['mpesa_transaction_date_from']) && !empty($_POST['mpesa_transaction_date_to']))
									{
										
										
										list($m1,$d1,$y1) = explode('/', $_POST['mpesa_transaction_date_from']);
										
										$from = $y1."-".$m1."-".$d1;
										
										list($m2,$d2,$y2) = explode('/', $_POST['mpesa_transaction_date_to']);
										
										$to = $y2."-".$m2."-".$d2;
										
									    $qrystring ="select * from one_time_payment where mpesa_transaction_date BETWEEN '".$from."' AND '".$to."'";
										
									
									}
									
									else
									{
									if(isset($_POST['policy_no']) && isset($_POST['national_id']) && $_POST['national_id']!='' &&  $_POST['policy_no']!='')
									{
										$qrystring = "select * from one_time_payment  where policy_no='".$_POST['policy_no']."' or national_id='".$_POST['national_id']."'";
									}
									else if(isset($_POST['policy_no']) && $_POST['policy_no']!='')
									{
										$qrystring = "select * from one_time_payment where policy_no='".$_POST['policy_no']."'";
									}
									else if(isset($_POST['national_id']) &&  $_POST['national_id']!='')
									{
										$qrystring = "select * from one_time_payment where national_id='".$_POST['national_id']."'";
									}
									else
									{
										$qrystring = "select * from one_time_payment";
									}
									
									$qrystring = "select * from one_time_payment";
									}
									$result_member = mysql_query($qrystring);
									while($row_member    = mysql_fetch_array($result_member))
									{
										$result_member_name = mysql_query("select * from bimapoa_members where policy_no='".$row_member['policy_no']."' AND relation = 'SELF'");
										$row_member_name    = mysql_fetch_array($result_member_name);
   
									
									?>
									<tr> 
                                                                            
                                        <td class='hidden-350'><?php echo $i?>
										</td>
										<td class='hidden-1024'><?php echo $row_member_name['membership_name']?>
										</td>
										<td class='hidden-1024'><?php echo $row_member['policy_no']?>
										</td>
										<td class='hidden-1024'><?php echo $row_member_name['national_id']?>
										</td>
										
										<td class='hidden-1024'>8000</td>
										
										<td class='hidden-1024'><?php echo $row_member['mpesa_transaction_date']?>
										</td>

<!--										<td class='hidden-450'><button
												class="btn btn-mini btn-warning"
												onclick="window.location.href='update_member_form.php?member_id=<?echo $row_member['member_id'];?>';">
												<i class="icon-edit"></i>
											</button>
											<button class="btn btn-small btn-inverse"
												onclick="window.location.href='delete_member.php?member_id=<?echo $row_member['member_id'];?>';">
												<i class="icon-trash"></i>
											</button></td>-->

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

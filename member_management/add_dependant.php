<?php
include '../common_include_in.php';
include '../include/header_in.php';

$memberobj = new Members();
$policy_no = $_GET['policy_no'];
$count = $memberobj->row_count('bimapoa_members', 'policy_no = "'.$policy_no.'"');
//echo "select * from bimapoa_members where policy_no ='".$policy_no."' and relation='Spouse'";
$countspouseqry = mysql_query("select * from bimapoa_members where policy_no ='".$policy_no."' and relation='Spouse'");
$countspouse  = mysql_num_rows($countspouseqry);

?>
<?php include '../include/top_navigation_in.php'; ?>
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
    function check_policy_no(value)
    {
        $.ajax({
            type: "POST",
            url: "get_policy_no.php",
            data: "policy_no=" + value,
            success: function(result) {
                // alert(result);
                if (result == "error")
                {
                    document.getElementById('policy_no').value = '';
                }
            }
        });
    }
    </script>
<script
	src="../js/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Datepicker -->
<link
	rel="stylesheet" href="../css/plugins/datepicker/datepicker.css">
<div class="container-fluid" id="content">
	<?php include '../include/left_navigation_in.php'; ?>
	<div id="main">
		<div class="container-fluid">
			<div class="page-header">
				<div class="pull-left">
					<h1>Add Dependant</h1>
				</div>

			</div>
			<div class="breadcrumbs">
				<ul>
					<li><a href="../dashboard.php">Home</a> <i class="icon-angle-right"></i>
					</li>
					<li><a href="#">Add Dependant</a>
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
								<i class="icon-user"></i> Add Dependant
							</h3>
						</div>
						<div class="box-content nopadding">
							<form class="form-horizontal form-bordered" method="post"
								action="add_dependant_action.php"
								enctype="multipart/form-data">
								<?php 
								/* if($countspouse == 0 && $count!=6){ 
								<div class="control-group">
									<label for="textfield" class="control-label">Dependant Member
										Name</label>
									<div class="controls">
										<input type="text" name="dep_mem_name_s"
											value="" id="dep_mem_name" /> <input type="hidden"
											name="policy_no" value="<?php echo $policy_no ?>">
									</div>
								</div>

								<div class="control-group">
									<label for="textfield" class="control-label">Member DOB</label>
									<div class="controls">
										<input type="text" name="dep_dob_s"
											class="input-xlarge datepick" id="address" />
									</div>
								</div>

								<div class="control-group">
									<label for="textfield" class="control-label">Relation</label>
									<div class="controls">
										<select name="dep_relation_s" id="day">
										
											<option value="Spouse">Spouse</option>
											<option value="Daughter">Daughter</option>
											<option value="Son">Son</option>
										</select>
									</div>
								</div>
								<div class="control-group">
									<label for="textfield" class="control-label">Dependant Image</label>
									<div class="controls">
										<input type="file" name="dep_image_s"
											id="dep_image" />
									</div>
								</div>
								
								 }*/ 
								?>
								<?php 
								for($i = 1; $i <= (6-$count); $i++)
								{
								?>
								<div class="control-group">
									<label for="textfield" class="control-label">Dependant Member
										Name</label>
									<div class="controls">
										<input type="text" name="dep_mem_name[]"
											value="" id="dep_mem_name" /> <input type="hidden"
											name="policy_no" value="<?php echo $policy_no ?>">
									</div>
								</div>

								<div class="control-group">
									<label for="textfield" class="control-label">Member DOB</label>
									<div class="controls">
										<input type="text" name="dep_dob[]"
											class="input-xlarge datepick" id="address" />
									</div>
								</div>

								<div class="control-group">
									<label for="textfield" class="control-label">Relation</label>
									<div class="controls">
									<select name="dep_relation[]" id="day">
										<?php 
										if($countspouse<1 && $i<2)
										{ 
										?>
											<option value="Spouse">Spouse</option>
										<?php }?>
											<option value="Daughter">Daughter</option>
											<option value="Son">Son</option>
										</select>
									</div>
								</div>
								<div class="control-group">
									<label for="textfield" class="control-label">Dependant Image</label>
									<div class="controls">
										<input type="file" name="dep_image[]"
											id="dep_image" />
									</div>
								</div>
								<?php 
								}
								?>
								<div class="control-group">
									<div class="controls">
										<input type="submit" name="submitted" value="Submit"
											class="btn btn-primary" /> <input type="button" name="cancel"
											value="Cancel" class="btn btn-primary"
											onclick="window.location.href = 'manage_members.php'" /> <input
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

<script type="text/javascript">
   
    function removeElement(divNum) {
        var d = document.getElementById('myDiv');
        var olddiv = document.getElementById(divNum);
        d.removeChild(olddiv);
    }



    function check_agent(value)
    {

        $.ajax({
            type: "POST",
            url: "get_agent.php",
            data: "agent_code=" + value,
            success: function(result) {
                // alert(result);
                if (result != "error")
                {
                    document.getElementById('agent_name').value = result;
                }
            }
        });
    }

    function getRegion(value)
    {
        //alert(value);
        $.ajax({
            type: "POST",
            url: "get_region.php",
            data: "area_id=" + value,
            success: function(result) {

                document.getElementById('region').innerHTML = result;

            }
        });
    }

    function getLocation(value)
    {
        //alert(value);
        $.ajax({
            type: "POST",
            url: "get_location.php",
            data: "region_id=" + value,
            success: function(result) {

                document.getElementById('location').innerHTML = result;

            }
        });
    }

</script>





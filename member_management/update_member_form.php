<?php
include '../common_include_in.php';
include '../include/header_in.php';
$memberobj = new Members();
if ($_POST['updated']) {
	if ($memberobj->UpdateMember()) {
		$memberobj->RedirectToURL("manage_members.php");
	}
}
$id = $_GET['member_id'];
$result = mysql_query("select * from bimapoa_members where member_id='" . $id . "'");
$row = mysql_fetch_array($result);
include '../include/top_navigation_in.php';
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
    }</script>
<div class="container-fluid"
	id="content">
	<?php include '../include/left_navigation_in.php'; ?>

	<!-- Datepicker -->
	<script src="../js/plugins/datepicker/bootstrap-datepicker.js"></script>
	<!-- Datepicker -->
	<link rel="stylesheet" href="../css/plugins/datepicker/datepicker.css">
	<div id="main">
		<div class="container-fluid">
			<div class="page-header">
				<div class="pull-left">
					<h1>Update Member</h1>
				</div>

			</div>
			<div class="breadcrumbs">
				<ul>
					<li><a href="../dashboard.php">Home</a> <i class="icon-angle-right"></i>
					</li>
					<li><a href="add_group.php">Update Member</a><i
						class="icon-angle-right"></i>
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
								<i class="icon-user"></i> Update Member
							</h3>
						</div>
						<div class="box-content nopadding">
							<form class="form-horizontal form-bordered" method="post"
								enctype="multipart/form-data"
								action="<?php echo $memberobj->GetSelfScript(); ?>">
								<div class="control-group">
									<label for="textfield" class="control-label">Primary Member
										Name</label>
									<div class="controls">
										<input type="text" name="membership_name"
											value="<?php echo $row['membership_name']; ?>"
											id="membership_name" /> <input type="hidden" name="member_id"
											value="<?php echo $row['member_id']; ?>">
									</div>
								</div>
								<div class="control-group">
									<label for="textfield" class="control-label">Policy Number </label>
									<div class="controls">
										<input readonly type="text" name="policy_no"
											value="<?php echo $row['policy_no']; ?>" id="policy_no" />
									</div>
								</div>

								<div class="control-group">
									<label for="textfield" class="control-label">National ID </label>
									<div class="controls">
										<input type="text" name="national_id"
											value="<?php echo $row['national_id']; ?>" id="national_id" />
									</div>
								</div>

								<div class="control-group">
									<label for="textfield" class="control-label">Membership Number
									</label>
									<div class="controls">
										<input readonly type="text" name="membership_no"
											value="<?php echo $row['membership_no']; ?>"
											id="membership_no" />
									</div>
								</div>
								<div class="control-group">
									<label for="textfield" class="control-label">Phone Number</label>
									<div class="controls">
										<input type="text" name="phone" maxlength="10"
											value="<?php echo $row['phone'] ?>" id="membership_name" />
									</div>
								</div>

								<div class="control-group">
									<label for="textfield" class="control-label"> Emergency Phone
										Number</label>
									<div class="controls">
										<input type="text" name="emergency_phone" maxlength="10"
											value="<?php echo $row['emergency_phone']; ?>"
											id="membership_name" />
									</div>
								</div>
								<div class="control-group">
									<label for="textfield" class="control-label">DOB</label>
									<div class="controls">
										<input type="text" name="dob" class="input-xlarge "
											value="<?php echo $row['dob'];?>" /> * Please Write Date with
										following format : [Year-Month-Day]->[1980-12-24]
									</div>
								</div>
								<div class="control-group">
									<label for="textfield" class="control-label">Gender</label>
									<div class="controls">
										<select name="sex" id="sex">
										<?php
										if ($row['sex'] == "Male")
										{
											?>
											<option value="Female">Female</option>
											<option value="Male" selected>Male</option>
											<?php }
											else {
												?>
											<option value="Female" selected>Female</option>
											<option value="Male">Male</option>
											<?php
											}
											?>

										</select>
									</div>
								</div>


								<div class="control-group">
									<label for="textfield" class="control-label">Relation</label>
									<div class="controls">
										<select name="relation" id="relation">
										<?php
										if ($row['relation'] == "SELF") {
											?>
											<option value="SELF" selected>SELF</option>
											<option value="Spouse">Spouse</option>
											<option value="Daughter">Daughter</option>
											<option value="Son">Son</option>
											<?php
										}
										?>
										<?php
										if ($row['relation'] == "Spouse") {
											?>
											<option value="SELF">SELF</option>
											<option value="Spouse" selected>Spouse</option>
											<option value="Daughter">Daughter</option>
											<option value="Son">Son</option>
											<?php
										}
										?>
										<?php
										if ($row['relation'] == "Daughter") {
											?>
											<option value="SELF">SELF</option>
											<option value="Spouse">Spouse</option>
											<option value="Daughter" selected>Daughter</option>
											<option value="Son">Son</option>
											<?php
										}
										?>
										<?php
										if ($row['relation'] == "Son") {
											?>
											<option value="SELF">SELF</option>
											<option value="Spouse">Spouse</option>
											<option value="Daughter">Daughter</option>
											<option value="Son" selected>Son</option>
											<?php
										}
										?>

										</select>
									</div>
								</div>


								<div class="control-group">
									<label for="textfield" class="control-label">Area</label>
									<div class="controls">
										<select name="area" id="area"
											onchange="getRegion(this.value);">
											<?php
											$resultArea = mysql_query("select * from bimapoa_members where member_id='" . $id . "'");
											$rowArea = mysql_fetch_array($resultArea);
											$resultAreaName = mysql_query("select * from area where area_id='" . $rowArea['area'] . "'");
											$rowAreaName = mysql_fetch_array($resultAreaName);
											?>

											<?php echo $memberobj->getSelectedAreaList($rowArea['area']); ?>
										</select>
									</div>
								</div>

								<div class="control-group">
									<label for="textfield" class="control-label">Region</label>
									<div class="controls">
										<select name="region" id="region"
											onchange="getLocation(this.value);">
											<?php
											$resultRegion = mysql_query("select * from bimapoa_members where member_id='" . $id . "'");
											$rowRegion = mysql_fetch_array($resultRegion);
											$resultRegionName = mysql_query("select * from region where area_id='" . $rowRegion['area'] . "' AND region_id='" . $rowRegion['region'] . "'");
											$rowRegionName = mysql_fetch_array($resultRegionName);
											?>
											<?php echo $memberobj->getSelectedRegionList($rowRegion['region']); ?>
										</select>
									</div>
								</div>


								<div class="control-group">
									<label for="textfield" class="control-label">Location</label>
									<div class="controls">
										<select name="location" id="location">
										<?php
										$resultLocation = mysql_query("select * from bimapoa_members where member_id='" . $id . "'");
										$rowLocation = mysql_fetch_array($resultLocation);
										$resultLocationName = mysql_query("select * from location where area_id='" . $rowLocation['area'] . "' AND region_id='" . $rowLocation['region'] . "'AND location_id='" . $rowLocation['location'] . "'");
										$rowLocationName = mysql_fetch_array($resultLocationName);
										?>
										<?php echo $memberobj->getSelectedLocationList($rowLocation['location']); ?>
										</select>
									</div>
								</div>


								<div class="control-group">
									<label for="textfield" class="control-label">Provider Code</label>
									<div class="controls">
										<select name="selected_provider_code"
											id="selected_provider_code"
											onchange="check_provider(this.value)">
											<?php

											$qryprovider = mysql_query("select * from providers where provider_code='".$row['selected_provider_code']."'");
											$fetchprovider = mysql_fetch_array($qryprovider);
											?>
											<?php echo $memberobj->getProviders($row['selected_provider_code']); ?>

										</select>&nbsp;&nbsp; Provider Name &nbsp;&nbsp;<input
											readonly type="text" name="provider_name" id="provider_name"
											value="<?php echo $fetchprovider['provider_name'];?>">
									</div>
								</div>


								<div class="control-group">
									<label for="textfield" class="control-label">CHW Code</label>
									<div class="controls">
										<select name="chw_code" id="chw_code"
											onchange="check_agent(this.value)">
											<?php

											$qryagent = mysql_query("select * from agent where agent_code='".$row['chw_code']."'");
											$fetchagent = mysql_fetch_array($qryagent);
											?>
											<?php echo $memberobj->getAgents($rowChw['chw_code']); ?>
										</select>&nbsp;&nbsp; Agent Name &nbsp;&nbsp;<input readonly
											type="text" name="agent_name" id="agent_name"
											value="<?php echo $fetchagent['name'];?>">
									</div>

								</div>


								<div class="control-group">
									<label for="textfield" class="control-label">Transaction Date</label>
									<div class="controls">
										<input type="text" name="transaction_date"
											class="input-xlarge "
											value="<?php echo $row['date_signed']; ?>" id="address" /> *
										Please Write Date with following format :
										[Year-Month-Day]->[1980-12-24]
									</div>
								</div>
								<?php
								$trans_no = mysql_query("select * from mpesa where mpesa_account='".$row['policy_no']."' AND mpesa_transaction_date	='".$row['date_signed']."'");
								$fetch_trans = mysql_fetch_array($trans_no);
								?>

								<div class="control-group">
									<label for="textfield" class="control-label">Transaction No</label>
									<div class="controls">
										<input type="text" name="transaction_no"
											value="<?php echo $fetch_trans['mpesa_code']; ?>"
											id="address" />
									</div>
								</div>



								<div class="control-group">
									<label for="textfield" class="control-label">Payment Type</label>
									<div class="controls">
										<select name="payment_type" id="payment_type">
										<?php
										if ($row['payment_type'] == "Monthly") {
											?>
											<option value="Monthly" selected>800</option>
											<option value="Two">4000</option>
											<option value="Full">8000</option>
											<?php
										}
										if ($row['payment_type'] == "Two") {
											?>
											<option value="Monthly">800</option>
											<option value="Two" selected>4000</option>
											<option value="Full">8000</option>
											<?php
										}if ($row['payment_type'] == "Full") {
											?>
											<option value="Monthly">800</option>
											<option value="Two">4000</option>
											<option value="Full" selected>8000</option>
											<?php
										}else{?>
											<option value="Monthly">800</option>
											<option value="Two">4000</option>
											<option value="Full">8000</option>
											<?php }
											?>
										</select>
									</div>
								</div>
								<?php
								$query_doc = mysql_query("select * from documents where policy_no='".$row['policy_no']."' and membership_no='".$row['membership_no']."'");
								$fetchresultdoc = mysql_fetch_array($query_doc);
								?>
								<div class="control-group">
									<label for="textfield" class="control-label">Upload Document
										First</label>
									<div class="controls">
										<input type="file" name="upload_file1" id="upload_file1" /> <img
											src="../uploads/<?=$fetchresultdoc['document1'];?>"
											width='100' height='100'> <input type="hidden"
											name="old_file1" value="<?=$fetchresultdoc['document1'];?>">

									</div>
								</div>
								<div class="control-group">
									<label for="textfield" class="control-label">Upload Document
										Second</label>
									<div class="controls">
										<input type="file" name="upload_file2" id="upload_file2" /> <img
											src="../uploads/<?=$fetchresultdoc['document2'];?>"
											width='100' height='100'> <input type="hidden"
											name="old_file2" value="<?=$fetchresultdoc['document2'];?>">

									</div>
								</div>
								<div class="control-group">
									<label for="textfield" class="control-label">Upload Document
										Third</label>
									<div class="controls">
										<input type="file" name="upload_file3" id="upload_file3" /> <img
											src="../uploads/<?=$fetchresultdoc['document3'];?>"
											width='100' height='100'> <input type="hidden"
											name="old_file3" value="<?=$fetchresultdoc['document3'];?>">

									</div>
								</div>
								<div class="control-group">
									<label for="textfield" class="control-label">Primary Member
										Image</label>
									<div class="controls">
										<input type="file" name="upload_image" id="upload_image" />
										<?php
										$query_img = mysql_query("select * from bimapoa_members where policy_no='".$row['policy_no']."' and membership_no='".$row['membership_no']."'");
										$fetchresultimg = mysql_fetch_array($query_img);
										?>
										<img src="../uploads/<?=$fetchresultimg['upload_file'];?>"
											width='100' height='100'> <input type="hidden"
											name="old_image_self"
											value="<?=$fetchresultimg['upload_file'];?>">

									</div>
								</div>
								<?php
								//echo "select * from bimapoa_members where policy_no='".$row['policy_no']."' and relation<>'SELF'";
								$depquery = mysql_query("select * from bimapoa_members where policy_no='".$row['policy_no']."' and relation<>'SELF'");
								while($fetchresultdep = mysql_fetch_array($depquery)){
									?>
								<div class="control-group">
									<label for="textfield" class="control-label">Dependant Member
										Name</label>
									<div class="controls">
										<input type="text" name="dep_mem_name[]"
											value="<?php echo $fetchresultdep['membership_name']; ?>"
											id="dep_mem_name" /> <input type="hidden" name="dep_mem_no[]"
											value="<?php echo $fetchresultdep['membership_no'];?>">

									</div>
								</div>
								<div class="control-group">
									<label for="textfield" class="control-label">Member DOB</label>
									<div class="controls">
									<?php
									//echo $fetchresultdep['dob'];
									list($y,$m,$d) = explode('-', $fetchresultdep['dob']);
									$year = $y;
									$month = $m;
									$days = $d;
									?>
										<select name="day[]" id="day">
										<?php
										for($i=1;$i <= 31;$i++){
											if($days == $i){
												?>
											<option value="<?php echo $i;?>" selected>
											<?php echo $i;?>
											</option>
											<?php }else{ ?>
											<option value="<?php echo $i;?>">
											<?php echo $i;?>
											</option>
											<?php }}?>
										</select> &nbsp;&nbsp;
										<?php
										$mons = array(1 => "Jan", 2 => "Feb", 3 => "Mar", 4 => "Apr", 5 => "May", 6 => "Jun", 7 => "Jul", 8 => "Aug", 9 => "Sep", 10 => "Oct", 11 => "Nov", 12 => "Dec");
										?>
										<select name="month[]" id="month">
										<?php
										for($i=1;$i<=12;$i++){
											if($i==$month){
												?>
											<option value="<?php echo $i;?>" selected>
											<?php echo $mons[$i];?>
											</option>
											<?php }else{?>
											<option value="<?php echo $i;?>">
											<?php echo $mons[$i];?>
											</option>
											<?php }}?>
										</select> &nbsp;&nbsp; <select name="year[]" id="year">
										<?php
										for($i=1944;$i < 2014;$i++){
											if($year == $i){
												?>
											<option value="<?php echo $i;?>" selected>
											<?php echo $i;?>
											</option>
											<?php }else{?>
											<option value="<?php echo $i;?>">
											<?php echo $i;?>
											</option>
											<?php }}?>
										</select>
									</div>
								</div>
								<div class="control-group">
									<label for="textfield" class="control-label">Relation</label>
									<div class="controls">
									<?php
									$relationarray = array(1=>'Spouse',2=>'Daughter',3=>'Son');


									?>
									<?php if($fetchresultdep['relation']=='Spouse'){?>
										<select name="dep_relation[]" id="day">
											<option value="Spouse">Spouse</option>
										</select>
										<?php }else{?>
										<select name="dep_relation[]" id="day">
										<?php for($i=1;$i<=3;$i++){
											if($relationarray[$i]==$fetchresultdep['relation']){
												?>
											<option value="<?php echo $relationarray[$i];?>">
											<?php echo $relationarray[$i]; ?>
											</option>
											<?php }else if($relationarray[$i]!='Spouse'){?>
											<option value="<?php echo $relationarray[$i];?>">
											<?php echo $relationarray[$i]; ?>
											</option>
											<?php }}?>

										</select>
										<?php }?>
									</div>
								</div>
								<div class="control-group">
									<label for="textfield" class="control-label">Dependant Image</label>
									<div class="controls">
										<input type="file" name="dep_image[]" id="dep_image" />
										<?php
										$query_img = mysql_query("select * from dep_images where policy_no='".$fetchresultdep['policy_no']."' and membership_no='".$fetchresultdep['membership_no']."'");
										$fetchresultimg = mysql_fetch_array($query_img);
										?>
										<img src="../uploads/<?=$fetchresultimg['image'];?>"
											width='100' height='100'> <input type="hidden"
											name="old_image[]" value="<?=$fetchresultimg['image'];?>">
										<div align="right">
											<a class="btn btn-small btn-inverse"
												href="delete_dep_member.php?membership_no=<?=$fetchresultdep['membership_no'];?>">
												<i>Delete Dependant</i> </a>
										</div>
									</div>
								</div>



								<?php }
								$count = $memberobj ->row_count('bimapoa_members', 'policy_no = "'.$row['policy_no'].'"');

								?>
								<div class="control-group">
									<div class="controls">
										<input type="submit" name="updated" value="submit"
											class="btn btn-primary" /> <input type="button" name="cancel"
											value="Cancel" class="btn btn-primary"
											onclick="window.location.href = 'manage_members.php'" />

											<?php
											if($count != 6)
											{
												?>
										<input type="button" name="add_dependant"
											value="Add Another Dependant" class="btn btn-primary"
											onclick="window.location.href = 'add_dependant.php?policy_no=<?echo $row['policy_no'];?>'" />
											<?php
											}
											?>

										<input type="hidden" name="form_name" id="form_name"
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
    function addElement() {
        var ni = document.getElementById('myDiv');
        var numi = document.getElementById('theValue');
        var num = (document.getElementById('theValue').value - 1) + 2;
        if (num <= 5)
        {
            numi.value = num;
            var newdiv = document.createElement('div');
            var divIdName = 'my' + num + 'Div';
            newdiv.setAttribute('id', divIdName);
            newdiv.innerHTML = '<input type=\'hidden\' value=\'0\' id=\'theValue\' /><div class="control-group"><label for="textfield" class="control-label">Dependant Member Name</label><div class="controls"><input type="text" name="dep_mem_name[]" value="" id="dep_mem_name' + num + '" /></div></div><div class="control-group"><label for="textfield" class="control-label">Member DOB</label><div class="controls"><select name="day[]" id="day"><option value="1">1</option>	<option value="2">2</option>	<option value="3">3</option>	<option value="4">4</option>	<option value="5">5</option>	<option value="6">6</option>	<option value="7">7</option>	<option value="8">8</option>	<option value="9">9</option>	<option value="10">10</option>	<option value="11">11</option>	<option value="12">12</option>	<option value="13">13</option>	<option value="14">14</option>	<option value="15">15</option>	<option value="16">16</option>	<option value="17">17</option>	<option value="18">18</option>	<option value="19">19</option>	<option value="20">20</option>	<option value="21">21</option>	<option value="22">22</option>	<option value="23">23</option>	<option value="24">24</option>	<option value="25">25</option>	<option value="26">26</option>	<option value="27">27</option>	<option value="28">28</option>	<option value="29">29</option>	<option value="30">30</option>	<option value="31">31</option></select>   &nbsp;&nbsp;<select name="month[]" id="month">	<option value="1">January</option>	<option value="2">February</option>	<option value="3">March</option>	<option value="4">April</option>	<option value="5">May</option>	<option value="6">June</option>	<option value="7">July</option>	<option value="8">August</option>	<option value="9">September</option>	<option value="10">October</option>	<option value="11">November</option>	<option value="12">December</option></select> &nbsp;&nbsp;   <select name="year[]" id="year"><option value="1944">1944</option>	<option value="1945">1945</option>	<option value="1946">1946</option>	<option value="1947">1947</option>	<option value="1948">1948</option>	<option value="1949">1949</option>	<option value="1950">1950</option>	<option value="1951">1951</option>	<option value="1952">1952</option>	<option value="1953">1953</option>	<option value="1954">1954</option>	<option value="1955">1955</option>	<option value="1956">1956</option>	<option value="1957">1957</option>	<option value="1958">1958</option>	<option value="1959">1959</option>	<option value="1960">1960</option>	<option value="1961">1961</option>	<option value="1962">1962</option>	<option value="1963">1963</option>	<option value="1964">1964</option>	<option value="1965">1965</option>	<option value="1966">1966</option>	<option value="1967">1967</option>	<option value="1968">1968</option>	<option value="1969">1969</option>	<option value="1970">1970</option>	<option value="1971">1971</option>	<option value="1972">1972</option>	<option value="1973">1973</option>	<option value="1974">1974</option>	<option value="1975">1975</option>	<option value="1976">1976</option>	<option value="1977">1977</option>	<option value="1978">1978</option>	<option value="1979">1979</option>	<option value="1980">1980</option>	<option value="1981">1981</option>	<option value="1982">1982</option>	<option value="1983">1983</option>	<option value="1984">1984</option>	<option value="1985">1985</option>	<option value="1986">1986</option>	<option value="1987">1987</option>	<option value="1988">1988</option>	<option value="1989">1989</option>	<option value="1990">1990</option>	<option value="1991">1991</option>	<option value="1992">1992</option>	<option value="1993">1993</option>	<option value="1994">1994</option>	<option value="1995">1995</option>	<option value="1996">1996</option>	<option value="1997">1997</option>	<option value="1998">1998</option>	<option value="1999">1999</option>	<option value="2000">2000</option>	<option value="2001">2001</option>	<option value="2002">2002</option>	<option value="2003">2003</option>	<option value="2004">2004</option>	<option value="2005">2005</option>	<option value="2006">2006</option>	<option value="2007">2007</option>	<option value="2008">2008</option>	<option value="2009">2009</option>	<option value="2010">2010</option>	<option value="2011">2011</option>	<option value="2012">2012</option>	<option value="2013">2013</option>	<option value="2014">2014</option></select>     </div></div><div class="control-group"><label for="textfield" class="control-label">Relation</label><div class="controls"><select name="dep_relation[]" id="day"><option selected>---Select Relation---</option>	<option value="Spouse">Spouse</option>	<option value="Daughter">Daughter</option>	<option value="Son">Son</option></select></div></div> <a class=\"content_body\" href=\'javascript:void(0)\' onclick=\'removeElement(\"' + divIdName + '\")\'>Remove</a>'
            ni.appendChild(newdiv);
        }
        else
        {
            alert("Cannot add more dependant");
        }
    }

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


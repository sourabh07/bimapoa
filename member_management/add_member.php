<?php
include '../common_include_in.php';
include '../include/header_in.php';
$memberobj = new Members();
if ($_POST['submitted']) {
	if ($memberobj->RegisterMember()) {
		$memberobj->RedirectToURL("manage_users.php");
	}
}
?>
<?php include '../include/top_navigation_in.php'; ?>

<!-- Datepicker -->
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
              //alert(result);
                if (result == "error")
                {
                    alert ("Policy number already present. . . ");
                    document.getElementById('policy_no').value = '';
                }
            }
        });
        //alert ("Policy number already present. . . ");
    }
    
    

    
    function check_national_id(value)
    {
        
        $.ajax({
            type: "POST",
            url: "get_national_id.php",
            data: "national_id=" + value,
            success: function(result) {
                // alert(result);
                if (result == "error")
                {
                    alert ("National ID already present. . . ");
                    document.getElementById('national_id').value = '';
                }
            }
        });
        
        //alert ("Policy number already present. . . ");
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
					<h1>Add Member</h1>
				</div>

			</div>
			<div class="breadcrumbs">
				<ul>
					<li><a href="../dashboard.php">Home</a> <i class="icon-angle-right"></i>
					</li>
					<li><a href="#">Add Member</a>
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
								<i class="icon-user"></i> Add Member
							</h3>
						</div>
						<div class="box-content nopadding">
							<form class="form-horizontal form-bordered" method="post"
								action="<?php echo $memberobj->GetSelfScript(); ?>"
								enctype="multipart/form-data">
								<div class="control-group">
									<label for="textfield" class="control-label">* Primary Member
										Name</label>
									<div class="controls">
										<input type="text" name="membership_name" 
											value="<?php echo $memberobj->SafeDisplay('membership_name'); ?>"
											id="membership_name" />
									</div>
								</div>
								<div class="control-group">
									<label for="textfield" class="control-label">* Policy Number</label>
									<div class="controls">
                                                                            <input type="text" name="policy_no" required="" pattern="[A-Z0-9]{9,10}" maxlength="10"											value="<?php echo $memberobj->SafeDisplay('policy_no'); ?>"
											id="policy_no" onblur="check_policy_no(this.value);" />
										&nbsp;&nbsp;&nbsp; Policy number should be in between
										APN000000 to APN0002000

									</div>
								</div>


								<div class="control-group">
									<label for="textfield" class="control-label">* National ID</label>
									<div class="controls">
										<input type="text" name="national_id" pattern="[A-Z0-9]{8,9,10}"  maxlength="10"
											value="<?php echo $memberobj->SafeDisplay('national_id'); ?>"
											id="national_id" onblur="check_national_id(this.value);" />
										&nbsp;&nbsp;&nbsp;

									</div>
								</div>



								<div class="control-group">
									<label for="textfield" class="control-label">* Phone Number</label>
									<div class="controls">
										<input type="text" name="phone" maxlength="10"
											value="<?php echo $memberobj->SafeDisplay('phone'); ?>"
											id="membership_name" />
									</div>
								</div>


								<div class="control-group">
									<label for="textfield" class="control-label"> Emergency Phone
										Number</label>
									<div class="controls">
										<input type="text" name="emergency_phone" maxlength="10"
											value="<?php echo $memberobj->SafeDisplay('emergency_phone'); ?>"
											id="membership_name" />
									</div>
								</div>


								<div class="control-group">
									<label for="textfield" class="control-label">* Gender</label>
									<div class="controls">
										<select name="sex" id="sex">
											<option value="Female">Female</option>
											<option value="Male">Male</option>
										</select>
									</div>
								</div>

								<div class="control-group">
									<label for="textfield" class="control-label">DOB</label>
									<div class="controls">
										<input type="text" name="dob" class="input-xlarge datepick"
											id="dob" />
									</div>
								</div>

								<div class="control-group">
									<label for="textfield" class="control-label">* Relation</label>
									<div class="controls">
										<select name="relation" id="relation">
											<option value="SELF">SELF</option>
										</select>
									</div>
								</div>


								<div class="control-group">
									<label for="textfield" class="control-label">* Area</label>
									<div class="controls">
										<select name="area" id="area"
											onchange="getRegion(this.value);">
											<option>---Select Area---</option>
											<?php echo $memberobj->getAreaList(); ?>
										</select>
									</div>
								</div>

								<div class="control-group">
									<label for="textfield" class="control-label">* Region</label>
									<div class="controls">
										<select name="region" id="region"
											onchange="getLocation(this.value);">
											<option>---Select Region---</option>
										</select>
									</div>
								</div>

								<div class="control-group">
									<label for="textfield" class="control-label">* Location</label>
									<div class="controls">
										<select name="location" id="location">
											<option>---Select Location---</option>
										</select>
									</div>
								</div>


								<div class="control-group">
									<label for="textfield" class="control-label">* Provider Code</label>
									<div class="controls">
										<select name="selected_provider_code"
											id="selected_provider_code"
											onchange="check_provider(this.value)">
											<option>---Select Provider Code---</option>
											<?php echo $memberobj->getProviders(); ?>
										</select>&nbsp;&nbsp; Provider Name &nbsp;&nbsp;<input
											type="text" name="provider_name" id="provider_name" value=""
											readonly="readonly">
									</div>
								</div>


								<div class="control-group">
									<label for="textfield" class="control-label">* CHW Code</label>
									<div class="controls">
										<select name="chw_code" id="chw_code"
											onchange="check_agent(this.value)">
											<option>---Select Agent Code---</option>
											<?php echo $memberobj->getAgents(); ?>
										</select>&nbsp;&nbsp; Agent Name &nbsp;&nbsp;<input
											type="text" name="agent_name" id="agent_name" value=""
											readonly="readonly">
									</div>

								</div>


								<div class="control-group">
									<label for="textfield" class="control-label">Transaction Date</label>
									<div class="controls">
										<input type="text" name="transaction_date"
											class="input-xlarge datepick"
											value="<?php echo $memberobj->SafeDisplay('transaction_date'); ?>"
											id="address" />
									</div>
								</div>


								<div class="control-group">
									<label for="textfield" class="control-label">* Transaction No</label>
									<div class="controls">
										<input type="text" name="transaction_no"
											value="<?php echo $memberobj->SafeDisplay('transaction_no'); ?>"
											id="address" />
									</div>
								</div>
								<div class="control-group">
									<label for="textfield" class="control-label">* Payment Type</label>
									<div class="controls">
										<select name="payment_type" id="payment_type">
											<option value="Monthly">800</option>
											<option value="Two">4000</option>
											<option value="Full">8000</option>
										</select>
									</div>
								</div>
								<div class="control-group">
									<label for="textfield" class="control-label">Document 1</label>
									<div class="controls">
										<input type="file" name="upload_file1" id="upload_file" />
									</div>
								</div>
								<div class="control-group">
									<label for="textfield" class="control-label">Document 2</label>
									<div class="controls">
										<input type="file" name="upload_file2" id="upload_file" />
									</div>
								</div>
								<div class="control-group">
									<label for="textfield" class="control-label">Document 3</label>
									<div class="controls">
										<input type="file" name="upload_file3" id="upload_file" />
									</div>
								</div>

                                                            <input type="hidden" value="0" name="childcount" id="childcount">
                                                            <input type="hidden" value="0" name="spousecount" id="spousecount">
                                                            
								<div class="control-group">
									<label for="textfield" class="control-label">Primary Member
										Image</label>
									<div class="controls">
										<input type="file" name="upload_image" id="upload_file" />
									</div>
								</div>

								<!--     <div class="control-group"><label for="textfield" class="control-label">Dependant Member Name</label><div class="controls"><input type="text" name="dep_mem_name[]" value="" id="dep_mem_name'+num+'" /></div></div><div class="control-group"><label for="textfield" class="control-label">Member DOB</label><div class="controls"><select name="day[]" id="day"><option selected>---Select Day---</option>	<option value="1">1</option>	<option value="2">2</option>	<option value="3">3</option>	<option value="4">4</option>	<option value="5">5</option>	<option value="6">6</option>	<option value="7">7</option>	<option value="8">8</option>	<option value="9">9</option>	<option value="10">10</option>	<option value="11">11</option>	<option value="12">12</option>	<option value="13">13</option>	<option value="14">14</option>	<option value="15">15</option>	<option value="16">16</option>	<option value="17">17</option>	<option value="18">18</option>	<option value="19">19</option>	<option value="20">20</option>	<option value="21">21</option>	<option value="22">22</option>	<option value="23">23</option>	<option value="24">24</option>	<option value="25">25</option>	<option value="26">26</option>	<option value="27">27</option>	<option value="28">28</option>	<option value="29">29</option>	<option value="30">30</option>	<option value="31">31</option></select>   &nbsp;&nbsp;<select name="month[]" id="month">	<option>---Select Month---</option>	<option value="1">January</option>	<option value="2">February</option>	<option value="3">March</option>	<option value="4">April</option>	<option value="5">May</option>	<option value="6">June</option>	<option value="7">July</option>	<option value="8">August</option>	<option value="9">September</option>	<option value="10">October</option>	<option value="11">November</option>	<option value="12">December</option></select> &nbsp;&nbsp;   <select name="year[]" id="year">	<option>---Select Year---</option>	<option value="1944">1944</option>	<option value="1945">1945</option>	<option value="1946">1946</option>	<option value="1947">1947</option>	<option value="1948">1948</option>	<option value="1949">1949</option>	<option value="1950">1950</option>	<option value="1951">1951</option>	<option value="1952">1952</option>	<option value="1953">1953</option>	<option value="1954">1954</option>	<option value="1955">1955</option>	<option value="1956">1956</option>	<option value="1957">1957</option>	<option value="1958">1958</option>	<option value="1959">1959</option>	<option value="1960">1960</option>	<option value="1961">1961</option>	<option value="1962">1962</option>	<option value="1963">1963</option>	<option value="1964">1964</option>	<option value="1965">1965</option>	<option value="1966">1966</option>	<option value="1967">1967</option>	<option value="1968">1968</option>	<option value="1969">1969</option>	<option value="1970">1970</option>	<option value="1971">1971</option>	<option value="1972">1972</option>	<option value="1973">1973</option>	<option value="1974">1974</option>	<option value="1975">1975</option>	<option value="1976">1976</option>	<option value="1977">1977</option>	<option value="1978">1978</option>	<option value="1979">1979</option>	<option value="1980">1980</option>	<option value="1981">1981</option>	<option value="1982">1982</option>	<option value="1983">1983</option>	<option value="1984">1984</option>	<option value="1985">1985</option>	<option value="1986">1986</option>	<option value="1987">1987</option>	<option value="1988">1988</option>	<option value="1989">1989</option>	<option value="1990">1990</option>	<option value="1991">1991</option>	<option value="1992">1992</option>	<option value="1993">1993</option>	<option value="1994">1994</option>	<option value="1995">1995</option>	<option value="1996">1996</option>	<option value="1997">1997</option>	<option value="1998">1998</option>	<option value="1999">1999</option>	<option value="2000">2000</option>	<option value="2001">2001</option>	<option value="2002">2002</option>	<option value="2003">2003</option>	<option value="2004">2004</option>	<option value="2005">2005</option>	<option value="2006">2006</option>	<option value="2007">2007</option>	<option value="2008">2008</option>	<option value="2009">2009</option>	<option value="2010">2010</option>	<option value="2011">2011</option>	<option value="2012">2012</option>	<option value="2013">2013</option>	<option value="2014">2014</option></select>     </div></div><div class="control-group"><label for="textfield" class="control-label">Relation</label><div class="controls"><select name="dep_relation[]" id="day"><option selected>---Select Relation---</option>	<option value="Spouse">Spouse</option>	<option value="Daughter">Daughter</option>	<option value="Son">Son</option></select></div></div>-->

								<div class="control-group">
									<input type="hidden" value="0" id="theValue" /><a
										title="Click Here To Add Additional Fields"
										style="text-decoration: none;" href="javascript:void(0);"
										onClick="addElement();">+ Add Dependants</a>
								</div>
                                                                <div class="control-group">
									<input type="hidden" value="0" id="theValue1" /><a
										title="Click Here To Add Additional Fields"
										style="text-decoration: none;" href="javascript:void(0);"
                                                                                onClick="addSpouseElement();">+ Add Spouse</a>
								</div>
								<div style="line-height: 27px;" id="myDiv"></div>
								<div class="control-group">
									<div class="controls">
										<input type="submit" name="submitted" value="Submit"
											class="btn btn-primary" /> <input type="button" name="cancel"
											value="Cancel" class="btn btn-primary"
											onclick="window.location.href = 'manage_members.php'" /> <input
											type="hidden" name="form_name" id="form_name"
											value="add_group" />
											<?php
											//SELECT `membership_no` FROM bimapoa_members ORDER BY `membership_no` DESC LIMIT 1;
											$insertid = mysql_query("SELECT * FROM bimapoa_members ORDER BY member_id DESC LIMIT 1");
											$row_member = mysql_fetch_array($insertid);
											$number1 = $row_member['membership_no'];
											$number = preg_replace("/[^0-9]/", '', $number1);
											?>
										<input type="hidden" name="last_rec_num" id="last_rec_num"
											value="<?=$number;?>">
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
        
        var spousecount = document.getElementById('spousecount').value;
        var countchild = document.getElementById('childcount').value;
        var count = 5;
        if(spousecount == 0)
        {
            count = 4;
        }
        else if(spousecount == 1)
        {
            count = 3;
        }
        //alert(count);
        if (countchild <= count)
        {
            
            var countchild = document.getElementById('childcount').value;
            var totalchild = parseInt(countchild) + 1;
            document.getElementById('childcount').value = totalchild;
            numi.value = num;
            var newdiv = document.createElement('div');
            var divIdName = 'my' + num + 'Div';
            newdiv.setAttribute('id', divIdName);
            newdiv.innerHTML = '<input type=\'hidden\' value=\'0\' id=\'theValue\' /><div class="control-group"><label for="textfield" class="control-label">Dependant Member Name</label><div class="controls"><input type="text" name="dep_mem_name[]" value="" id="dep_mem_name' + num + '" /></div></div><div class="control-group"><label for="textfield" class="control-label">Member DOB</label><div class="controls"><select name="day[]" id="day"><option value="1">1</option>	<option value="2">2</option>	<option value="3">3</option>	<option value="4">4</option>	<option value="5">5</option>	<option value="6">6</option>	<option value="7">7</option>	<option value="8">8</option>	<option value="9">9</option>	<option value="10">10</option>	<option value="11">11</option>	<option value="12">12</option>	<option value="13">13</option>	<option value="14">14</option>	<option value="15">15</option>	<option value="16">16</option>	<option value="17">17</option>	<option value="18">18</option>	<option value="19">19</option>	<option value="20">20</option>	<option value="21">21</option>	<option value="22">22</option>	<option value="23">23</option>	<option value="24">24</option>	<option value="25">25</option>	<option value="26">26</option>	<option value="27">27</option>	<option value="28">28</option>	<option value="29">29</option>	<option value="30">30</option>	<option value="31">31</option></select>   &nbsp;&nbsp;<select name="month[]" id="month">	<option value="1">January</option>	<option value="2">February</option>	<option value="3">March</option>	<option value="4">April</option>	<option value="5">May</option>	<option value="6">June</option>	<option value="7">July</option>	<option value="8">August</option>	<option value="9">September</option>	<option value="10">October</option>	<option value="11">November</option>	<option value="12">December</option></select> &nbsp;&nbsp;   <select name="year[]" id="year"><option value="1944">1944</option>	<option value="1945">1945</option>	<option value="1946">1946</option>	<option value="1947">1947</option>	<option value="1948">1948</option>	<option value="1949">1949</option>	<option value="1950">1950</option>	<option value="1951">1951</option>	<option value="1952">1952</option>	<option value="1953">1953</option>	<option value="1954">1954</option>	<option value="1955">1955</option>	<option value="1956">1956</option>	<option value="1957">1957</option>	<option value="1958">1958</option>	<option value="1959">1959</option>	<option value="1960">1960</option>	<option value="1961">1961</option>	<option value="1962">1962</option>	<option value="1963">1963</option>	<option value="1964">1964</option>	<option value="1965">1965</option>	<option value="1966">1966</option>	<option value="1967">1967</option>	<option value="1968">1968</option>	<option value="1969">1969</option>	<option value="1970">1970</option>	<option value="1971">1971</option>	<option value="1972">1972</option>	<option value="1973">1973</option>	<option value="1974">1974</option>	<option value="1975">1975</option>	<option value="1976">1976</option>	<option value="1977">1977</option>	<option value="1978">1978</option>	<option value="1979">1979</option>	<option value="1980">1980</option>	<option value="1981">1981</option>	<option value="1982">1982</option>	<option value="1983">1983</option>	<option value="1984">1984</option>	<option value="1985">1985</option>	<option value="1986">1986</option>	<option value="1987">1987</option>	<option value="1988">1988</option>	<option value="1989">1989</option>	<option value="1990">1990</option>	<option value="1991">1991</option>	<option value="1992">1992</option>	<option value="1993">1993</option>	<option value="1994">1994</option>	<option value="1995">1995</option>	<option value="1996">1996</option>	<option value="1997">1997</option>	<option value="1998">1998</option>	<option value="1999">1999</option>	<option value="2000">2000</option>	<option value="2001">2001</option>	<option value="2002">2002</option>	<option value="2003">2003</option>	<option value="2004">2004</option>	<option value="2005">2005</option>	<option value="2006">2006</option>	<option value="2007">2007</option>	<option value="2008">2008</option>	<option value="2009">2009</option>	<option value="2010">2010</option>	<option value="2011">2011</option>	<option value="2012">2012</option>	<option value="2013">2013</option>	<option value="2014">2014</option></select>     </div></div><div class="control-group"><label for="textfield" class="control-label">Relation</label><div class="controls"><select name="dep_relation[]" id="day"><option value="Daughter">Daughter</option>	<option value="Son">Son</option></select></div></div>  <div class="control-group"><label for="textfield" class="control-label">Dependant Image</label><div class="controls"><input type="file" name="dep_image[]" id="dep_image"/></div> <a class=\"content_body\" href=\'javascript:void(0)\' onclick=\'removeElement(\"' + divIdName + '\")\'>Remove</a>'
            ni.appendChild(newdiv);
        }
        else
        {
            alert("Cannot add more dependant");
        }
    }

    function removeElement(divNum) {
    
        var childcount = document.getElementById('childcount').value;
        var subtractchild = parseInt(childcount) - 1;
        document.getElementById('childcount').value = subtractchild;
        var d = document.getElementById('myDiv');
        var olddiv = document.getElementById(divNum);
        d.removeChild(olddiv);
    }

function addSpouseElement() {
        var ni = document.getElementById('myDiv');
        var numi = document.getElementById('theValue');
        var num = (document.getElementById('theValue').value - 1) + 2;
        var childcount = parseInt(document.getElementById('childcount').value);
        var spousecount = document.getElementById('spousecount').value;
        
        if (spousecount == 0 && childcount < 5)
        {
            document.getElementById('spousecount').value=parseInt(1);
            numi.value = num;
            var newdiv = document.createElement('div');
            var divIdName = 'my' + num + 'Div';
            newdiv.setAttribute('id', divIdName);
            newdiv.innerHTML = '<input type=\'hidden\' value=\'0\' id=\'theValue\' /><div class="control-group"><label for="textfield" class="control-label">Dependant Member Name</label><div class="controls"><input type="text" name="dep_mem_name[]" value="" id="dep_mem_name' + num + '" /></div></div><div class="control-group"><label for="textfield" class="control-label">Member DOB</label><div class="controls"><select name="day[]" id="day"><option value="1">1</option>	<option value="2">2</option>	<option value="3">3</option>	<option value="4">4</option>	<option value="5">5</option>	<option value="6">6</option>	<option value="7">7</option>	<option value="8">8</option>	<option value="9">9</option>	<option value="10">10</option>	<option value="11">11</option>	<option value="12">12</option>	<option value="13">13</option>	<option value="14">14</option>	<option value="15">15</option>	<option value="16">16</option>	<option value="17">17</option>	<option value="18">18</option>	<option value="19">19</option>	<option value="20">20</option>	<option value="21">21</option>	<option value="22">22</option>	<option value="23">23</option>	<option value="24">24</option>	<option value="25">25</option>	<option value="26">26</option>	<option value="27">27</option>	<option value="28">28</option>	<option value="29">29</option>	<option value="30">30</option>	<option value="31">31</option></select>   &nbsp;&nbsp;<select name="month[]" id="month">	<option value="1">January</option>	<option value="2">February</option>	<option value="3">March</option>	<option value="4">April</option>	<option value="5">May</option>	<option value="6">June</option>	<option value="7">July</option>	<option value="8">August</option>	<option value="9">September</option>	<option value="10">October</option>	<option value="11">November</option>	<option value="12">December</option></select> &nbsp;&nbsp;   <select name="year[]" id="year"><option value="1944">1944</option>	<option value="1945">1945</option>	<option value="1946">1946</option>	<option value="1947">1947</option>	<option value="1948">1948</option>	<option value="1949">1949</option>	<option value="1950">1950</option>	<option value="1951">1951</option>	<option value="1952">1952</option>	<option value="1953">1953</option>	<option value="1954">1954</option>	<option value="1955">1955</option>	<option value="1956">1956</option>	<option value="1957">1957</option>	<option value="1958">1958</option>	<option value="1959">1959</option>	<option value="1960">1960</option>	<option value="1961">1961</option>	<option value="1962">1962</option>	<option value="1963">1963</option>	<option value="1964">1964</option>	<option value="1965">1965</option>	<option value="1966">1966</option>	<option value="1967">1967</option>	<option value="1968">1968</option>	<option value="1969">1969</option>	<option value="1970">1970</option>	<option value="1971">1971</option>	<option value="1972">1972</option>	<option value="1973">1973</option>	<option value="1974">1974</option>	<option value="1975">1975</option>	<option value="1976">1976</option>	<option value="1977">1977</option>	<option value="1978">1978</option>	<option value="1979">1979</option>	<option value="1980">1980</option>	<option value="1981">1981</option>	<option value="1982">1982</option>	<option value="1983">1983</option>	<option value="1984">1984</option>	<option value="1985">1985</option>	<option value="1986">1986</option>	<option value="1987">1987</option>	<option value="1988">1988</option>	<option value="1989">1989</option>	<option value="1990">1990</option>	<option value="1991">1991</option>	<option value="1992">1992</option>	<option value="1993">1993</option>	<option value="1994">1994</option>	<option value="1995">1995</option>	<option value="1996">1996</option>	<option value="1997">1997</option>	<option value="1998">1998</option>	<option value="1999">1999</option>	<option value="2000">2000</option>	<option value="2001">2001</option>	<option value="2002">2002</option>	<option value="2003">2003</option>	<option value="2004">2004</option>	<option value="2005">2005</option>	<option value="2006">2006</option>	<option value="2007">2007</option>	<option value="2008">2008</option>	<option value="2009">2009</option>	<option value="2010">2010</option>	<option value="2011">2011</option>	<option value="2012">2012</option>	<option value="2013">2013</option>	<option value="2014">2014</option></select>     </div></div><div class="control-group"><label for="textfield" class="control-label">Relation</label><div class="controls"><select name="dep_relation[]" id="day"><option value="Spouse">Spouse</option></select></div></div>  <div class="control-group"><label for="textfield" class="control-label">Dependant Image</label><div class="controls"><input type="file" name="dep_image[]" id="dep_image"/></div> <a class=\"content_body\" href=\'javascript:void(0)\' onclick=\'removeSpouseElement(\"' + divIdName + '\")\'>Remove Spouse</a>'
            ni.appendChild(newdiv);
        }
        else
        {
            alert("Cannot add more then one Spouse");
        }
    }

    function removeSpouseElement(divNum) {
    
        var spousecount = document.getElementById('spousecount').value;
        var subtractspouse = parseInt(spousecount) - 1;
        document.getElementById('spousecount').value = subtractspouse;
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





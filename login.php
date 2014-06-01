<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Wed Me Good</title>
<link href="<?php echo theme_url() ?>css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo theme_url(); ?>js/jquery-1.9.1.js"></script>
<script type="text/javascript">
function validRegister()
 {
		var email = document.getElementById("email").value;
		var pass = document.getElementById("pass").value;
		var reg = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/

		var cnt = 0;
		if(email == '')
		{
			document.getElementById("emailError").innerHTML='Please enter email address.';
			cnt++;
		}
		else if(!reg.test(email))
		{
			document.getElementById("emailError").innerHTML='please enter valid email address.';
			cnt++;
		}
		else
		{
			document.getElementById("emailError").innerHTML='';
		}
		if(pass == '')
		{
			document.getElementById("passError").innerHTML='Please enter password.';
			cnt++;
		}
		else
		{
			document.getElementById("passError").innerHTML='';
		}
		if(cnt > 0)
		{
			return false;
		}
		else
		{
			return true;
		}
}

function submit()
{
 alert();	
}

</script>
</head>

<body>
<div class="css">
  <div class="main"> 
    <?php   
	if(isset($res) && isset($url))
	{
		 
	?>
    <script>
		window.parent.location.href ='<?php echo $url;?>';
		window.parent.TINY.box.hide();
    </script>
    
<?php  	}
	
	 ?>
    <!--********************menu close**********************--> 
    
    <!--********************center start**********************-->
    
    <div id="">
      <div class="center-img-fancy">
        <div class="" style="margin-top:40px;">
        
          <div class="login">
            <div class="login-1">
              <div class="log">Log In</div>
              
                 <?php //echo form_open(base_url().''); ?>
                 
                 <form action="" method="post" name="form" onsubmit="return validRegister()">
                 
                 <?php if(isset($error_message)){ echo $error_message;}   ?>
                     <input type="hidden" name="prev_url" value="<?php echo $_SERVER['HTTP_REFERER'];?>" />
                <div class="input-main">
                  <div class="email-main">
                    <div class="email">Email</div>
                    <input type="text" class="text-input" id="email" name="email"/>
                    <div id="emailError" style="color:#f00; float:right; padding-right:13px;">&nbsp;</div>
                  </div>
                  <div class="email-main mt25">	
                    <div class="email">Password</div>
                    <input type="password" class="text-input"  id="pass" name="password"/>
                    <div id="passError" style="color:#f00; float:right; padding-right:13px;">&nbsp;</div>
                  </div>
                  <a href="<?=base_url()?>user/forget">
                  <div class="password"> Forgot Password? </div>
                  </a>
                  <div class="button-main">  
                   <input type="submit" n class="button-1" value="Login" name="submit" onclick="return submit();"/>
                      <?php $_SESSION['prev_url']=$_SERVER['HTTP_REFERER'];?>
					  <?php //echo form_submit(array('class'=>'button-1','value'=>'Login','name'=>'submit','onclick'=>'return validRegister()'));?>
                     <img src="<?php echo theme_url() ?>images/face.jpg" align="left" style="margin-left:5px;" />
                    <input type="button" class="button-2" value="Login with Facebook"  onclick="goToFacebookLogin()"  />
                  </div>
                </div>
              </form>
            </div>
            
            <div class="login-3"> <img src="<?php echo theme_url() ?>images/real-wedding-images/line-2.jpg" /> </div>
            <div class="login-2">
              <div class="log">New User ? Sign Up Now</div>
              
                <div class="input-main">
                  <div class="email-main">
                    <div class="email">Email</div>
                    <input type="text" class="text-input" name="email" id="reg_email" />
                    <div id="email_error" style="color:#f00; float:right; padding-right:13px;">&nbsp;</div>
                  </div>
                  <div class="email-main mt25">
                    <div class="email">Password</div>
                    <input type="password" class="text-input" name="password" id="reg_password" />
                    <div id="pass_error" style="color:#f00; float: right; padding-right:13px;">&nbsp;</div>
                  </div>
                  <div class="email-main mt25">
                                            <div class="email">Country</div>
                                            <select name="country" id="country" class="select"  onchange="return checkCountry();">
                                                <option value="India">India</option>
                                                <option value="Other">Other</option>
                                            </select>
                                            <div id="pass_error" style="color:#f00; float: right; padding-right:13px;">&nbsp;</div>
                                        </div> 
                                        <div class="email-main mt25" id="city_div">
                                            <div class="email">City</div>
                                            <select name="city" id="city" class="select" >
                                                <option disabled="disabled" style="background-color:#3E3E3E"><font color="#000000"><i>-Top Metropolitan Cities-</i></font></option>
                                                <option>Ahmedabad</option> 
                                                <option>Bengaluru/Bangalore</option>
                                                <option>Chandigarh</option>
                                                <option>Chennai</option>
                                                <option>Delhi</option>
                                                <option>Gurgaon</option>
                                                <option>Hyderabad/Secunderabad</option>
                                                <option>Kolkatta</option>
                                                <option>Mumbai</option>
                                                <option>Noida</option>
                                                <option>Pune</option>
                                                <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Andhra Pradesh-</i></font></option>
                                                <option>Anantapur</option>
                                                <option>Guntakal</option>
                                                <option>Guntur</option>
                                                <option>Hyderabad/Secunderabad</option>
                                                <option>kakinada</option>
                                                <option>kurnool</option>
                                                <option>Nellore</option>
                                                <option>Nizamabad</option>
                                                <option>Rajahmundry</option>
                                                <option>Tirupati</option>
                                                <option>Vijayawada</option>
                                                <option>Visakhapatnam</option>
                                                <option>Warangal</option>
                                                <option>Andra Pradesh-Other</option>
                                                <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Arunachal Pradesh-</i></font></option>
                                                <option>Itanagar</option>
                                                <option>Arunachal Pradesh-Other</option>
                                                <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Assam-</i></font></option>
                                                <option>Guwahati</option>
                                                <option>Silchar</option>
                                                <option>Assam-Other</option>
                                                <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Bihar-</i></font></option>
                                                <option>Bhagalpur</option>
                                                <option>Patna</option>
                                                <option>Bihar-Other</option>
                                                <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Chhattisgarh-</i></font></option>
                                                <option>Bhillai</option>
                                                <option>Bilaspur</option>
                                                <option>Raipur</option>
                                                <option>Chhattisgarh-Other</option>
                                                <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Goa-</i></font></option>
                                                <option>Panjim/Panaji</option>
                                                <option>Vasco Da Gama</option>
                                                <option>Goa-Other</option>
                                                <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Gujarat-</i></font></option>
                                                <option>Ahmedabad</option>
                                                <option>Anand</option>
                                                <option>Ankleshwar</option>
                                                <option>Bharuch</option>
                                                <option>Bhavnagar</option>
                                                <option>Bhuj</option>
                                                <option>Gandhinagar</option>
                                                <option>Gir</option>
                                                <option>Jamnagar</option>
                                                <option>Kandla</option>
                                                <option>Porbandar</option>
                                                <option>Rajkot</option>
                                                <option>Surat</option>
                                                <option>Vadodara/Baroda</option>
                                                <option>Valsad</option>
                                                <option>Vapi</option>
                                                <option>Gujarat-Other</option>
                                                <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Haryana-</i></font></option>
                                                <option>Ambala</option>
                                                <option>Chandigarh</option>
                                                <option>Faridabad</option>
                                                <option>Gurgaon</option>
                                                <option>Hisar</option>
                                                <option>Karnal</option>
                                                <option>Kurukshetra</option>
                                                <option>Panipat</option>
                                                <option>Rohtak</option>
                                                <option>Haryana-Other</option>
                                                <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Himachal Pradesh-</i></font></option>
                                                <option>Dalhousie</option>
                                                <option>Dharmasala</option>
                                                <option>Kulu/Manali</option>
                                                <option>Shimla</option>
                                                <option>Himachal Pradesh-Other</option>
                                                <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Jammu and Kashmir-</i></font></option>
                                                <option>Jammu</option>
                                                <option>Srinagar</option>
                                                <option>Jammu and Kashmir-Other</option>
                                                <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Jharkhand-</i></font></option>
                                                <option>Bokaro</option>
                                                <option>Dhanbad</option>
                                                <option>Jamshedpur</option>
                                                <option>Ranchi</option>
                                                <option>Jharkhand-Other</option>
                                                <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Karnataka-</i></font></option>
                                                <option>Bengaluru/Bangalore</option>
                                                <option>Belgaum</option>
                                                <option>Bellary</option>
                                                <option>Bidar</option>
                                                <option>Dharwad</option>
                                                <option>Gulbarga</option>
                                                <option>Hubli</option>
                                                <option>Kolar</option>
                                                <option>Mangalore</option>
                                                <option>Mysoru/Mysore</option>
                                                <option>Karnataka-Other</option>
                                                <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Kerala-</i></font></option>
                                                <option>Calicut</option>
                                                <option>Cochin</option>
                                                <option>Ernakulam</option>
                                                <option>Kannur</option>
                                                <option>Kochi</option>
                                                <option>Kollam</option>
                                                <option>Kottayam</option>
                                                <option>Kozhikode</option>
                                                <option>Palakkad</option>
                                                <option>Palghat</option>
                                                <option>Thrissur</option>
                                                <option>Trivandrum</option>
                                                <option>Kerela-Other</option>
                                                <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Madhya Pradesh-</i></font></option>
                                                <option>Bhopal</option>
                                                <option>Gwalior</option>
                                                <option>Indore</option>
                                                <option>Jabalpur</option>
                                                <option>Ujjain</option>
                                                <option>Madhya Pradesh-Other</option>
                                                <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Maharashtra-</i></font></option>
                                                <option>Ahmednagar</option>
                                                <option>Aurangabad</option>
                                                <option>Jalgaon</option>
                                                <option>Kolhapur</option>
                                                <option>Mumbai</option>
                                                <option>Mumbai Suburbs</option>
                                                <option>Nagpur</option>
                                                <option>Nasik</option>
                                                <option>Navi Mumbai</option>
                                                <option>Pune</option>
                                                <option>Solapur</option>
                                                <option>Maharashtra-Other</option>
                                                <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Manipur-</i></font></option>
                                                <option>Imphal</option>
                                                <option>Manipur-Other</option>
                                                <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Meghalaya-</i></font></option>
                                                <option>Shillong</option>
                                                <option>Meghalaya-Other</option>
                                                <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Mizoram-</i></font></option>
                                                <option>Aizawal</option>
                                                <option>Mizoram-Other</option>
                                                <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Nagaland-</i></font></option>
                                                <option>Dimapur</option>
                                                <option>Nagaland-Other</option>
                                                <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Orissa-</i></font></option>
                                                <option>Bhubaneshwar</option>
                                                <option>Cuttak</option>
                                                <option>Paradeep</option>
                                                <option>Puri</option>
                                                <option>Rourkela</option>
                                                <option>Orissa-Other</option>
                                                <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Punjab-</i></font></option>
                                                <option>Amritsar</option>
                                                <option>Bathinda</option>
                                                <option>Chandigarh</option>
                                                <option>Jalandhar</option>
                                                <option>Ludhiana</option>
                                                <option>Mohali</option>
                                                <option>Pathankot</option>
                                                <option>Patiala</option>
                                                <option>Punjab-Other</option>
                                                <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Rajasthan-</i></font></option>
                                                <option>Ajmer</option>
                                                <option>Jaipur</option>
                                                <option>Jaisalmer</option>
                                                <option>Jodhpur</option>
                                                <option>Kota</option>
                                                <option>Udaipur</option>
                                                <option>Rajasthan-Other</option>
                                                <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Sikkim-</i></font></option>
                                                <option>Gangtok</option>
                                                <option>Sikkim-Other</option>
                                                <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Tamil Nadu-</i></font></option>
                                                <option>Chennai</option>
                                                <option>Coimbatore</option>
                                                <option>Cuddalore</option>
                                                <option>Erode</option>
                                                <option>Hosur</option>
                                                <option>Madurai</option>
                                                <option>Nagerkoil</option>
                                                <option>Ooty</option>
                                                <option>Salem</option>
                                                <option>Thanjavur</option>
                                                <option>Tirunalveli</option>
                                                <option>Trichy</option>
                                                <option>Tuticorin</option>
                                                <option>Vellore</option>
                                                <option>Tamil Nadu-Other</option>
                                                <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Tripura-</i></font></option>
                                                <option>Agartala</option>
                                                <option>Tripura-Other</option>
                                                <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Union Territories-</i></font></option>
                                                <option>Chandigarh</option>
                                                <option>Dadra & Nagar Haveli-Silvassa</option>
                                                <option>Daman & Diu</option>
                                                <option>Delhi</option>
                                                <option>Pondichery</option>
                                                <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Uttar Pradesh-</i></font></option>
                                                <option>Agra</option>
                                                <option>Aligarh</option>
                                                <option>Allahabad</option>
                                                <option>Bareilly</option>
                                                <option>Faizabad</option>
                                                <option>Ghaziabad</option>
                                                <option>Gorakhpur</option>
                                                <option>Kanpur</option>
                                                <option>Lucknow</option>
                                                <option>Mathura</option>
                                                <option>Meerut</option>
                                                <option>Moradabad</option>
                                                <option>Noida</option>
                                                <option>Varanasi/Banaras</option>
                                                <option>Uttar Pradesh-Other</option>
                                                <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Uttaranchal-</i></font></option>
                                                <option>Dehradun</option>
                                                <option>Roorkee</option>
                                                <option>Uttaranchal-Other</option>
                                                <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-West Bengal-</i></font></option>
                                                <option>Asansol</option>
                                                <option>Durgapur</option>
                                                <option>Haldia</option>
                                                <option>Kharagpur</option>
                                                <option>Kolkatta</option>
                                                <option>Siliguri</option>
                                                <option>West Bengal - Other</option>

                                            </select>
                                            <div id="pass_error" style="color:#f00; float: right; padding-right:13px;">&nbsp;</div>
                                        </div>
                                        <div class="email-main mt25" id="city_other_div">
                                            <div class="email">City</div>
                                            <input name="city_other" id="city_other" class="text-input" />
                                            <div id="pass_error" style="color:#f00; float: right; padding-right:13px;">&nbsp;</div>
                                        </div>  
                 <!-- <a href="#">
                  <div class="password"> Forgot Password? </div>
                  </a>
-->                  <div class="button-main"> <a href="">
                    <input type="button" class="button-1" value="Continue" onclick="chkRegister(); return false;"  />
                    </a> <img src="<?php echo theme_url() ?>images/face.jpg" align="left" style="margin-left:5px;" />
                    <input type="button" class="button-2" value="Connect with Facebook" onclick="goToFacebookRegister()"  />
                  </div>
                </div>
             </div>
          </div>
        </div>
      </div>
    </div>
    <!--********************center close**********************--> 
  </div>
</div>
</div>
<script type="text/javascript">
    
    function checkCountry()
            {
                var country = $('#country').val();

                //alert(country);

                if (country === 'Other')
                {
                    $('#city_div').hide();
                    $('#city_other_div').show();
                } else {
                    $('#city_div').show();
                    $('#city_other_div').hide();
                }

            }
            $(document).ready(function() {
                $('#city_other_div').hide();
            });
    
    
function chkRegister()
{
	var email = $('#reg_email').val();
	var pass = $('#reg_password').val();
        var country = $('#country').val();
        var city = $('#city').val();
        var city_other = $('#city_other').val();
	var error = 0;

	if(email == '')
	{
				document.getElementById('email_error').innerHTML = 'Please enter email';			
				error++;
	}
	else
	{
				document.getElementById('email_error').innerHTML = '';			
	}

	if(pass == '')
	{
			document.getElementById('pass_error').innerHTML = 'Please enter password';	
			error++;	
	}
	else
	{
			document.getElementById('pass_error').innerHTML = '';		
	}	


	if(error == 0)
	{
		$.post('<?php echo base_url(); ?>user/register/',
		{
			email:email,
			pass:pass,
                        country:country,
                        city:city,
                        city_other:city_other,
			type:'direct',
			action:'register'
		},function(data)
		{
			console.log(data);
			var output = data.split('<sep>');
			if(output[0] == 'success')
			{
				
				console.log('<?php echo base_url()  ?>user/verify/'+output[1]+'/'+output[2]);
			window.parent.location.href ='<?php echo base_url()  ?>user/verify/'+output[1]+'/'+output[2];
			window.parent.TINY.box.hide();
			}
			else if(output[0] == 'email_error')
			{
				document.getElementById('email_error').innerHTML=output[1];	
			}
			});
	}
}

function goToFacebookLogin()
{
		window.parent.location.href ='<?php echo base_url().'user/fb_login';  ?>';
		window.parent.TINY.box.hide();
}

function goToFacebookRegister()
{
		window.parent.location.href ='<?php echo base_url().'user/fb_register';  ?>';
		window.parent.TINY.box.hide();
}


</script>
</body>
</html>

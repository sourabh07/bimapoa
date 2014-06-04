<?php 
include_once 'common_include_out.php';
$loginobject = new Login();
?>
<!doctype html>
<html>
<head>
<meta charset="utf8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<!-- Apple devices fullscreen -->
<meta name="apple-mobile-web-app-capable" content="yes" />
<!-- Apple devices fullscreen -->
<meta name="apple-mobile-web-app-status-bar-style"
	content="black-translucent" />
<title>BIMA-POA</title>

<!-- Bootstrap -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<!-- Bootstrap responsive -->
<link rel="stylesheet" href="css/bootstrap-responsive.min.css">
<!-- Theme CSS -->
<link rel="stylesheet" href="css/style.css">
<!-- Color CSS -->
<link rel="stylesheet" href="css/themes.css">


<!-- jQuery -->
<script src="js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="js/bootstrap.min.js"></script>
<script src="js/eakroko.js"></script>

<!-- Favicon -->
<link rel="shortcut icon" href="img/favicon.ico" />
<!-- Apple devices Homescreen icon -->
<link rel="apple-touch-icon-precomposed"
	href="img/apple-touch-icon-precomposed.png" />

</head>

<body class='login'>
	<div class="wrapper">
		<h1>
                    <!--<a href="index.html"><img src="report_management/image/111.jpg"> </a>-->
		</h1>
		<div class="login-body">
			<h2>SIGN IN</h2>
			<form action="<?php $loginobject->Login();?>" method='POST'>
<!--				<input type="hidden" class='spmhidip'
					name='<?php // echo $loginobject->GetSpamTrapInputName(); ?>' />-->
				<div>
					<span class='error'><?php //echo $loginobject->GetErrorMessage(); ?>
					</span>
				</div>
				<div class="email">
					<input type="text" name='username' value="<?php echo $loginobject->SafeDisplay('username');?>" placeholder="Email address" class='input-block-level'>
				</div>
				<div class="pw">
					<input type="password" name="password" placeholder="Password"
						class='input-block-level'>
				</div>
				<div class="submit">
					<input type="submit" name="submitted" value="Sign me in"
						class='btn btn-primary'>
				</div>
			</form>
			<div class="forget">
				<a href="#"><span>Forgot password?</span> </a>
			</div>
		</div>
	</div>
	<script type="text/javascript">

	var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-38620714-4']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>

</html>

<?php 
include './common_include_out.php';
include './include/header.php';

if(isset($_SESSION['user_type']))
{
	$user_type = $_SESSION['user_type']; 
}
else
{
	$this->RedirectToURL("index.php");
}
?>
<body>
	<?php include 'include/top_navigation.php';?>
	<div class="container-fluid" id="content">
		<?php include 'include/left_navigation.php';?>
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Dashboard</h1>
					</div>
				</div>
				<div class="breadcrumbs">
					<ul>
						<li><a href="dashboard.php">Home</a> <i class="icon-angle-right"></i>
						</li>
						<li><a href="dashboard.php">Dashboard</a>
						</li>
					</ul>
					<div class="close-bread">
						<a href="#"><i class="icon-remove"></i> </a>
					</div>
				</div>

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


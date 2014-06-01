<?php 
include 'common_include_out.php';
include 'include/header.php';?>

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
					<div class="pull-right">

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
					</div>
				</div>
				<div class="breadcrumbs">
					<ul>
						<li><a href="more-login.html">Home</a> <i class="icon-angle-right"></i>
						</li>
						<li><a href="index.html">Dashboard</a>
						</li>
					</ul>
					<div class="close-bread">
						<a href="#"><i class="icon-remove"></i> </a>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6">
						<div class="box">
							<div class="box-title">
								<h3>
									<i class="icon-bolt"></i>Server load
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-refresh"><i
										class="icon-refresh"></i> </a> <a href="#"
										class="btn btn-mini content-remove"><i class="icon-remove"></i>
									</a> <a href="#" class="btn btn-mini content-slideUp"><i
										class="icon-angle-down"></i> </a>
								</div>
							</div>
							<div class="box-content">
								<div class="flot flot-line"></div>
							</div>
						</div>
					</div>
					<div class="span6">
						<div class="box">
							<div class="box-title">
								<h3>
									<i class="icon-comment"></i>Message Center
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-refresh"><i
										class="icon-refresh"></i> </a> <a href="#"
										class="btn btn-mini content-remove"><i class="icon-remove"></i>
									</a> <a href="#" class="btn btn-mini content-slideUp"><i
										class="icon-angle-down"></i> </a>
								</div>
							</div>
							<div class="box-content nopadding scrollable" data-height="350"
								data-visible="true" data-start="bottom">
								<ul class="messages">
									<li class="left">
										<div class="image">
											<img src="img/demo/user-1.jpg" alt="">
										</div>
										<div class="message">
											<span class="caret"></span> <span class="name">Jane Doe</span>
											<p>Lorem ipsum aute ut ullamco et nisi ad.</p>
											<span class="time"> 12 minutes ago </span>
										</div>
									</li>
									<li class="right">
										<div class="image">
											<img src="img/demo/user-2.jpg" alt="">
										</div>
										<div class="message">
											<span class="caret"></span> <span class="name">John Doe</span>
											<p>Lorem ipsum aute ut ullamco et nisi ad. Lorem ipsum
												adipisicing nisi Excepteur eiusmod ex culpa laboris. Lorem
												ipsum est ut...</p>
											<span class="time"> 12 minutes ago </span>
										</div>
									</li>
									<li class="left">
										<div class="image">
											<img src="img/demo/user-1.jpg" alt="">
										</div>
										<div class="message">
											<span class="caret"></span> <span class="name">Jane Doe</span>
											<p>Lorem ipsum aute ut ullamco et nisi ad. Lorem ipsum
												adipisicing nisi!</p>
											<span class="time"> 12 minutes ago </span>
										</div>
									</li>
									<li class="typing"><span class="name">John Doe</span> is typing
										<img src="img/loading.gif" alt="">
									</li>
									<li class="insert">
										<form id="message-form" method="POST" action="#">
											<div class="text">
												<input type="text" name="text" placeholder="Write here..."
													class="input-block-level">
											</div>
											<div class="submit">
												<button type="submit">
													<i class="icon-share-alt"></i>
												</button>
											</div>
										</form>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6">
						<div class="box">
							<div class="box-title">
								<h3>
									<i class="icon-globe"></i>User regions
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-refresh"><i
										class="icon-refresh"></i> </a> <a href="#"
										class="btn btn-mini content-remove"><i class="icon-remove"></i>
									</a> <a href="#" class="btn btn-mini content-slideUp"><i
										class="icon-angle-down"></i> </a>
								</div>
							</div>
							<div class="box-content">
								<div id="vmap"></div>
							</div>
						</div>
					</div>
					<div class="span6">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="icon-user"></i>Address Book
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-refresh"><i
										class="icon-refresh"></i> </a> <a href="#"
										class="btn btn-mini content-remove"><i class="icon-remove"></i>
									</a> <a href="#" class="btn btn-mini content-slideUp"><i
										class="icon-angle-down"></i> </a>
								</div>
							</div>
							<div class="box-content nopadding scrollable" data-height="300"
								data-visible="true">
								<table class="table table-user table-nohead">
									<tbody>
										<tr class="alpha">
											<td class="alpha-val"><span>B</span>
											</td>
											<td colspan="2"></td>
										</tr>
										<tr>
											<td class='img'><img src="img/demo/user-1.jpg" alt=""></td>
											<td class='user'>Bi Doe</td>
											<td class='icon'><a href="#" class='btn'><i
													class="icon-search"></i> </a></td>
										</tr>
										<tr>
											<td class='img'><img src="img/demo/user-2.jpg" alt=""></td>
											<td class='user'>Boo Doe</td>
											<td class='icon'><a href="#" class='btn'><i
													class="icon-search"></i> </a></td>
										</tr>
										<tr class="alpha">
											<td class="alpha-val"><span>D</span>
											</td>
											<td colspan="3"></td>
										</tr>
										<tr>
											<td class='img'><img src="img/demo/user-3.jpg" alt=""></td>
											<td class='user'>Dan Doe</td>
											<td class='icon'><a href="#" class='btn'><i
													class="icon-search"></i> </a></td>
										</tr>
										<tr>
											<td class='img'><img src="img/demo/user-4.jpg" alt=""></td>
											<td class='user'>Dane Doe</td>
											<td class='icon'><a href="#" class='btn'><i
													class="icon-search"></i> </a></td>
										</tr>
										<tr class="alpha">
											<td class="alpha-val"><span>H</span>
											</td>
											<td colspan="3"></td>
										</tr>
										<tr>
											<td class='img'><img src="img/demo/user-3.jpg" alt=""></td>
											<td class='user'>Hilda N. Ervin</td>
											<td class='icon'><a href="#" class='btn'><i
													class="icon-search"></i> </a></td>
										</tr>
										<tr class="alpha">
											<td class="alpha-val"><span>J</span>
											</td>
											<td colspan="3"></td>
										</tr>
										<tr>
											<td class='img'><img src="img/demo/user-5.jpg" alt=""></td>
											<td class='user'>John Doe</td>
											<td class='icon'><a href="#" class='btn'><i
													class="icon-search"></i> </a></td>
										</tr>
										<tr>
											<td class='img'><img src="img/demo/user-6.jpg" alt=""></td>
											<td class='user'>John Doe</td>
											<td class='icon'><a href="#" class='btn'><i
													class="icon-search"></i> </a></td>
										</tr>
										<tr class="alpha">
											<td class="alpha-val"><span>L</span>
											</td>
											<td colspan="3"></td>
										</tr>
										<tr>
											<td class='img'><img src="img/demo/user-5.jpg" alt=""></td>
											<td class='user'>Laura J. Brown</td>
											<td class='icon'><a href="#" class='btn'><i
													class="icon-search"></i> </a></td>
										</tr>
										<tr>
											<td class='img'><img src="img/demo/user-6.jpg" alt=""></td>
											<td class='user'>Lilly J. Tooley</td>
											<td class='icon'><a href="#" class='btn'><i
													class="icon-search"></i> </a></td>
										</tr>
										<tr class="alpha">
											<td class="alpha-val"><span>M</span>
											</td>
											<td colspan="3"></td>
										</tr>
										<tr>
											<td class='img'><img src="img/demo/user-1.jpg" alt=""></td>
											<td class='user'>Maxi Doe</td>
											<td class='icon'><a href="#" class='btn'><i
													class="icon-search"></i> </a></td>
										</tr>
										<tr>
											<td class='img'><img src="img/demo/user-2.jpg" alt=""></td>
											<td class='user'>Max Doe</td>
											<td class='icon'><a href="#" class='btn'><i
													class="icon-search"></i> </a></td>
										</tr>
										<tr class="alpha">
											<td class="alpha-val"><span>O</span>
											</td>
											<td colspan="3"></td>
										</tr>
										<tr>
											<td class='img'><img src="img/demo/user-1.jpg" alt=""></td>
											<td class='user'>Oxx Doe</td>
											<td class='icon'><a href="#" class='btn'><i
													class="icon-search"></i> </a></td>
										</tr>
										<tr>
											<td class='img'><img src="img/demo/user-2.jpg" alt=""></td>
											<td class='user'>Osam Doe</td>
											<td class='icon'><a href="#" class='btn'><i
													class="icon-search"></i> </a></td>
										</tr>
										<tr class="alpha">
											<td class="alpha-val"><span>P</span>
											</td>
											<td colspan="3"></td>
										</tr>
										<tr>
											<td class='img'><img src="img/demo/user-1.jpg" alt=""></td>
											<td class='user'>Petra Doe</td>
											<td class='icon'><a href="#" class='btn'><i
													class="icon-search"></i> </a></td>
										</tr>
										<tr>
											<td class='img'><img src="img/demo/user-2.jpg" alt=""></td>
											<td class='user'>Per Doe</td>
											<td class='icon'><a href="#" class='btn'><i
													class="icon-search"></i> </a></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6">
						<div class="box">
							<div class="box-title">
								<h3>
									<i class="icon-calendar"></i>My calendar
								</h3>
							</div>
							<div class="box-content nopadding">
								<div class="calendar"></div>
							</div>
						</div>
					</div>
					<div class="span6">
						<div class="box box-color box-bordered green">
							<div class="box-title">
								<h3>
									<i class="icon-bullhorn"></i>Feeds
								</h3>
								<div class="actions">
									<a href="#"
										class="btn btn-mini custom-checkbox checkbox-active">Automatic
										refresh<i class="icon-check-empty"></i>
									</a>
								</div>
							</div>
							<div class="box-content nopadding scrollable" data-height="400"
								data-visible="true">
								<table class="table table-nohead" id="randomFeed">
									<tbody>
										<tr>
											<td><span class="label"><i class="icon-plus"></i> </span> <a
												href="#">John Doe</a> added a new photo</td>
										</tr>
										<tr>
											<td><span class="label label-success"><i class="icon-user"></i>
											</span> New user registered</td>
										</tr>
										<tr>
											<td><span class="label label-info"><i
													class="icon-shopping-cart"></i> </span> New order received</td>
										</tr>
										<tr>
											<td><span class="label label-warning"><i class="icon-comment"></i>
											</span> <a href="#">John Doe</a> commented on <a href="#">News
													#123</a></td>
										</tr>
										<tr>
											<td><span class="label label-success"><i class="icon-user"></i>
											</span> New user registered</td>
										</tr>
										<tr>
											<td><span class="label label-info"><i
													class="icon-shopping-cart"></i> </span> New order received</td>
										</tr>
										<tr>
											<td><span class="label label-warning"><i class="icon-comment"></i>
											</span> <a href="#">John Doe</a> commented on <a href="#">News
													#123</a></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
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


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
						<h1>Upload Data</h1>
					</div>
				</div>
				<div class="breadcrumbs">
					<ul>
						<li><a href="dashboard.php">Home</a> <i class="icon-angle-right"></i>
						</li>
						<li><a href="">CSV Upload</a>
						</li>
					</ul>
					<div class="close-bread">
						<a href="#"><i class="icon-remove"></i> </a>
					</div>
				</div>

				Instruction : Kindly upload member data first.
				<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="icon-th-list"></i> Member Upload
								</h3>
							</div>
							<div class="box-content nopadding">
								<form action="upload_members.php" method="post"
									class="form-horizontal form-bordered"
									enctype="multipart/form-data">
									<div class="control-group">
										<label for="textfield" class="control-label">Upload File</label>
										<div class="controls">
											<input type="file" name="data" />
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label"></label>
										<div class="controls">
											<a href="download.php?sampleFile=bimapoa_members.csv"
												class="btn btn-primary">Download Sample</a> <input
												class="btn btn-primary" type="submit" name="submit"
												value="Upload"> At the time of uploading data, your CSV file
											should be in given sample format and date format should be
											like (yyyy-mm-dd).

										</div>
									</div>
								</form>
							</div>

						</div>
					</div>
				</div>

				<br /> <br />
				<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="icon-th-list"></i> M-Pesa Upload
								</h3>
							</div>
							<div class="box-content nopadding">
								<form action="upload_transactions.php" method="post"
									class="form-horizontal form-bordered"
									enctype="multipart/form-data">
									<div class="control-group">
										<label for="textfield" class="control-label">Upload File</label>
										<div class="controls">
											<input type="file" name="data" />
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label"></label>
										<div class="controls">
											<a href="download.php?sampleFile=MpesaCSV.csv"
												class="btn btn-primary">Download Sample</a> <input
												class="btn btn-primary" type="submit" name="submit"
												value="Upload"> At the time of uploading data, your CSV file
											should be in given sample format and date format should be
											like (yyyy-mm-dd).
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>

				<br /> <br />
				<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="icon-th-list"></i> Agent Upload
								</h3>
							</div>
							<div class="box-content nopadding">
								<form action="upload_agent.php" method="post"
									class="form-horizontal form-bordered"
									enctype="multipart/form-data">
									<div class="control-group">
										<label for="textfield" class="control-label">Upload File</label>
										<div class="controls">
											<input type="file" name="data" />
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label"></label>
										<div class="controls">
											<a href="download.php?sampleFile=agent.csv"
												class="btn btn-primary">Download Sample</a> <input
												class="btn btn-primary" type="submit" name="submit"
												value="Upload"> At the time of uploading data, your CSV file
											should be in given sample format and date format should be
											like (yyyy-mm-dd).
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>

				<br /> <br />
				<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="icon-th-list"></i>Provider Upload
								</h3>
							</div>
							<div class="box-content nopadding">
								<form action="upload_providers.php" method="post"
									class="form-horizontal form-bordered"
									enctype="multipart/form-data">
									<div class="control-group">
										<label for="textfield" class="control-label">Upload File</label>
										<div class="controls">
											<input type="file" name="data" />
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label"></label>
										<div class="controls">
											<a href="download.php?sampleFile=providers.csv"
												class="btn btn-primary">Download Sample</a> <input
												class="btn btn-primary" type="submit" name="submit"
												value="Upload"> At the time of uploading data, your CSV file
											should be in given sample format and date format should be
											like (yyyy-mm-dd).

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
</body>
</html>


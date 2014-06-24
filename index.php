<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>DSU Password Cracking</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="/css/bootstrap.min.css" media="screen">
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="../bower_components/html5shiv/dist/html5shiv.js"></script>
	<script src="../bower_components/respond/dest/respond.min.js"></script>
	<![endif]-->
	<script src="/js/jquery.min.js"></script>
	<script type="text/javascript">
		$(function () {
			$('#usageChart').highcharts({
				title: {
					text: 'Resource Utilization',
					x: -20 //center
				},
				subtitle: {
					text: 'Updated every 30 minutes',
					x: -20
				},
				xAxis: {
					categories: ['1:00AM', '1:30AM', '2:00AM', '2:30AM', '3:00AM']
				},
				yAxis: {
					title: {
						text: 'Percentage'
					},
					plotLines: [
						{
							value: 0,
							width: 1,
							color: '#808080'
						}
					]
				},
				tooltip: {
					valueSuffix: '°C'
				},
				legend: {
					layout: 'vertical',
					align: 'right',
					verticalAlign: 'middle',
					borderWidth: 0
				},
				series: [
					{
						name: 'GPU',
						data: [7.0, 6.9, 9.5, 80.0, 18.2]
					},
					{
						name: 'CPU',
						data: [90.0, 0.8, 75.0, 11.3, 17.0]
					},
					{
						name: 'Hard Drive',
						data: [10.0, 0.6, 3.5, 8.4, 13.5]
					},
					{
						name: 'Memory',
						data: [3.9, 4.2, 5.7, 30.0, 11.9]
					}
				]
			});
		});


	</script>
</head>
<body>
<div class="navbar navbar-default ">
	<div class="container">
		<div class="navbar-header">
			<a href="/" class="navbar-brand">DSU Password Cracking</a>
			<button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<div class="navbar-collapse collapse" id="navbar-main">
			<ul class="nav navbar-nav">
				<li class="active">
					<a href="/">Home</a>
				</li>
				<?php
				session_start();
				if (!$_SESSION['loggedIn']) {
					?>
					<li>
						<a href="login.php">Login</a>
					</li>
				<?php
				} else {
					?>
					<li>
						<a href="console/">Console Home</a>
					</li>
					<li>
						<a href="console/newjob">Create Job</a>
					</li>
					<li>
						<a href="console/viewjobs">View Jobs</a>
					</li>
				<?php
				}
				?>
				<li>
					<a href="/utilization">Utilization</a>
				</li>
				<li>
					<a href="/help">Help</a>
				</li>
			</ul>
			<?php
			if ($_SESSION['loggedIn']) {
				?>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="/logout.php">Logout</a></li>
				</ul>
			<?php
			}
			?>
		</div>
	</div>
</div>
<div class="body-container">
	<h1>Welcome to the DSU Password Cracking Box</h1>

	<p>This interface provides the capability to upload password hashes for cracking.
		You can either run GPU based attack on our six Radeon R9 290x's
		or run a rainbow table attack utilizing our ~8TBs of Rainbow Tables.
	</p>

	<p>Click on login to get started.

	<p>

	<div id="usageChart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
</div>


<script src="/js/bootstrap.min.js"></script>
<script src="/js/highcharts.js"></script>
</body>
</html>


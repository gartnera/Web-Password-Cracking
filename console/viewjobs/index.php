<?php require('access.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<title>DSU Password Cracking</title>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<link rel="stylesheet" href="/css/bootstrap.min.css" media="screen"/>
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="../bower_components/html5shiv/dist/html5shiv.js"></script>
	<script src="../bower_components/respond/dest/respond.min.js"></script>
	<![endif]-->
	<script src="/js/jquery.min.js"></script>
	<script src="/js/viewjobs.js"></script>
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
				<li>
					<a href="/">Home</a>
				</li>
				<li>
					<a href="/console/">Console Home</a>
				</li>
				<li>
					<a href="/console/newjob/">Create Job</a>
				</li>
				<li class="active">
					<a href="/console/viewjobs/">View Jobs</a>
				</li>
				<li>
					<a href="/utilization">Utilization</a>
				</li>
				<li>
					<a href="/help">Help</a>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="/logout.php">Logout</a></li>
			</ul>
		</div>
	</div>
</div>
<div class="body-container">
	<table class="table">
		<thead>
		<tr>
			<th class="width-1">&nbsp;</th>
			<th>Date</th>
			<!--<th>Time</th> -->
			<th>Attack Type</th>
			<th>Hash Type</th>
			<th>Attack Method</th>
			<th>Status</th>
			<th class="width-1">&nbsp;</th>
		</tr>
		</thead>
		<tbody>
		<?php require('getData.php'); ?>

		</tbody>
	</table>
	<p class="center">Click on a job to see the hashes/results</p>
</div>


<script src="/js/bootstrap.min.js"></script>
</body>
</html>

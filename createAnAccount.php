<?php if (!empty($_POST)) require('createAnAccountBackend.php'); ?>
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
	<script src="/js/newUser.js"></script>
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
				<li class="active">
					<a href="login.php">Login</a>
				</li>
				<li>
					<a href="/utilization">Utilization</a>
				</li>
				<li>
					<a href="/help">Help</a>
				</li>
		</div>
	</div>
</div>
<div class="body-container">
	<form class="form-horizontal"  method="post">
		<fieldset>
			<div class="form-group">
				<label for="inputEmail" class="col-lg-2 control-label">Email</label>
				<div class="col-lg-6">
					<input type="text" class="form-control" name="email" placeholder="Email">
					<span class="help-block">You will be required to confirm this address</span>
				</div>
				<label class="col-lg-2 form-error" id="error-invalid-email">Invalid Email</label>
			</div>
			<div class="form-group">
				<label for="inputPassword" class="col-lg-2 control-label">Password</label>

				<div class="col-lg-6">
					<input type="password" class="form-control" name="password" placeholder="Password">
				</div>
				<label class="col-lg-2 form-error" id="error-password-length">Password length less than 10</label>
			</div>
			<div class="form-group">
				<label for="confirm-password" class="col-lg-2 control-label">Password Confirmation</label>

				<div class="col-lg-6">
					<input type="password" class="form-control" name="confirm-password" placeholder="Password">
				</div>
				<label class="col-lg-2 form-error" id="error-password-mismatch">Passwords don't match</label>
			</div>
			<div class="form-group">
				<label for="advisor" class="col-lg-2 control-label">Teacher/Advisor</label>

				<div class="col-lg-6">
					<select class="form-control" name="advisor" id="advisor">
						<option>Tom Halverson</option>
						<option>Josh Pauli</option>
						<option>Kyle Cronin</option>
					</select>
					<span class="help-block">This person will have to confirm you can access the system. Please don't submit a request without speaking to them first. <br />Currently all requests go to Alex Gartner</span>

				</div>
			</div>
			<div class="form-group">
				<div class="col-lg-6 col-lg-offset-2">
					<h2>Capcha Here</h2>
				</div>
			</div>
			<div class="form-group">
				<div class="col-lg-6 col-lg-offset-2">
					<button class="btn btn-default">Cancel</button>
					<button type="submit" value="send" class="btn btn-primary">Create account</button>
				</div>
			</div>

		</fieldset>
	</form>
</div>


<script src="/js/bootstrap.min.js"></script>
</body>
</html>

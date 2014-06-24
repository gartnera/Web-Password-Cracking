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
	<?php
	$null_input = false;
	$failed_auth = false;
	session_start();

	if (!isset($_SESSION['loggedIn'])) {
		$_SESSION['loggedIn'] = false;
	}

	if (isset($_POST['email']) && isset($_POST['password'])) {
		try {
			$db = new PDO("mysql:host=localhost;dbname=cracking", "cracking", "DATABASE_PASSWORD");
			$query = $db->prepare("SELECT id, hash, salt, isSuperUser, emailConfirmed, managerConfirmed FROM users WHERE email = :email");
			//TODO: also grab managerConfirmed and emailConfirmed and check those b4
			$query->bindParam(':email', $_POST['email']);
			$query->setFetchMode(PDO::FETCH_ASSOC);
			$query->execute();

			$row = $query->fetch();

			$passwordHash = hash("sha512", $row['salt'] . $_POST['password']);

			if ($passwordHash == $row['hash']) {
				if ($row['emailConfirmed'] == 1) {
					if ($row['managerConfirmed'] == 1) {
						$_SESSION['loggedIn'] = true;
						$_SESSION['uid'] = $row['id'];
						$_SESSION['isSuperUser'] = boolval($row['isSuperUser']);
						header('Location: console/');
					}
					else
						$manager_not_confirmed = true;
				}
				else
					$email_not_confirmed = true;
			}
			else {
				$failed_auth = true;
			}
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}
	}
	else {
		//$null_input = true;
	}

	if ($failed_auth)
		echo '<p class="center">Incorrect email or password</p>';
	else if ($null_input)
		echo '<p class="center">Please specify email and password</p>';
	if ($email_not_confirmed)
		echo '<p class="center">Your email address has not been confirmed</p>';
	if ($manager_not_confirmed)
		echo '<p class="center">Your teacher/advisor has not confirmed your account</p>';

	?>
	<form class="form-horizontal" method="post">
		<fieldset>
			<div class="form-group">
				<label for="inputEmail" class="col-lg-2 control-label">Email</label>

				<div class="col-lg-6">
					<input type="text" class="form-control" name="email" placeholder="Email">
				</div>
			</div>
			<div class="form-group">
				<label for="inputPassword" class="col-lg-2 control-label">Password</label>

				<div class="col-lg-6">
					<input type="password" class="form-control" name="password" placeholder="Password">
				</div>
			</div>
			<div class="form-group">
				<div class="col-lg-6 col-lg-offset-2">
					<button class="btn btn-default">Cancel</button>
					<button type="submit" value="send" class="btn btn-primary">Submit</button>
				</div>
			</div>

			<div class="form-group">
				<div class="col-lg-6 col-lg-offset-2">
					<a href="createAnAccount.php">Create an account</a>
				</div>
			</div>
		</fieldset>
	</form>
</div>


<script src="/js/bootstrap.min.js"></script>
</body>
</html>

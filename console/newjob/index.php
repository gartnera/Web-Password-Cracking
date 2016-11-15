<?php require('../../includes/access.php');
	  require('../../includes/newJob.php');
/*
	  print_r($_POST);
	  echo "<br />";
	  print_r($data);
echo $attack_type_invalid;
echo $hash_type_invalid;
echo $hashes_invalid;
echo $attack_method_invalid;
echo $mask_invalid;
echo $dictionary_invalid;
*/
?>
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
	<script src="/js/newjob.js"></script>
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
				<li class="active">
					<a href="/console/newjob/">Create Job</a>
				</li>
				<li>
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
	<div class="internal-body">
		<?php if ($job_created_successfully) echo '<h3 class="center">Job created successfully</h3>'; ?>
		<form class="form-horizontal" method="post" >
			<fieldset>
				<div class="form-group">
					<label for="attack_type" class="control-label">Attack Type</label>
					<div class="radio">
						<input type="radio" name="attack_type" class="attack_type" value="0" checked=""/>
						Hashcat
					</div>
					<div class="radio">
						<input type="radio" name="attack_type" class="attack_type" value="1"/>
						Rainbow Table
					</div>
				</div>
				<div class="form-group">
					<label for="hash_type" class="control-label">Hash Type</label>
					<select class="form-control" id="hash_type" name="hash_type">
						<option>1Password, agilekeychain</option>
						<option>1Password, cloudkeychain</option>
						<option>AIX {smd5}</option>
						<option>AIX {ssha1}</option>
						<option>AIX {ssha256}</option>
						<option>AIX {ssha512}</option>
						<option>bcrypt, Blowfish(OpenBSD)</option>
						<option>Cisco-ASA MD5</option>
						<option>Cisco-IOS SHA256</option>
						<option>Cisco-PIX MD5</option>
						<option>Citrix Netscaler</option>
						<option>descrypt, DES(Unix), Traditional DES</option>
						<option>DNSSEC (NSEC3)</option>
						<option>Domain Cached Credentials2, mscash2</option>
						<option>Domain Cached Credentials, mscash</option>
						<option>Double MD5</option>
						<option>Double SHA1</option>
						<option>Drupal7</option>
						<option>GOST R 34.11-94</option>
						<option>GRUB 2</option>
						<option>Half MD5</option>
						<option>HMAC-MD5 (key = $pass)</option>
						<option>HMAC-MD5 (key = $salt)</option>
						<option>HMAC-SHA1 (key = $pass)</option>
						<option>HMAC-SHA1 (key = $salt)</option>
						<option>HMAC-SHA256 (key = $pass)</option>
						<option>HMAC-SHA256 (key = $salt)</option>
						<option>HMAC-SHA512 (key = $pass)</option>
						<option>HMAC-SHA512 (key = $salt)</option>
						<option>IKE-PSK MD5</option>
						<option>IKE-PSK SHA1</option>
						<option>IPMI2 RAKP HMAC-SHA1</option>
						<option>Kerberos 5 AS-REQ Pre-Auth etype 23</option>
						<option>Lastpass</option>
						<option>LM</option>
						<option>MD4</option>
						<option>md5apr1, MD5(APR), Apache MD5</option>
						<option>MD5</option>
						<option>MD5(Chap), iSCSI CHAP authentication</option>
						<option>md5crypt, MD5(Unix), FreeBSD MD5, Cisco-IOS MD5</option>
						<option>md5($pass.$salt)</option>
						<option>md5($salt.$pass)</option>
						<option>md5($salt.unicode($pass))</option>
						<option>md5(sha1($pass))</option>
						<option>md5(unicode($pass).$salt)</option>
						<option>MySQL323</option>
						<option>MySQL4.1/MySQL5</option>
						<option>NetNTLMv1-VANILLA / NetNTLMv1+ESS</option>
						<option>NetNTLMv2</option>
						<option>NTLM</option>
						<option>Oracle 7-10g, DES(Oracle)</option>
						<option>OSX v10.8 / v10.9</option>
						<option>Password Safe SHA-256</option>
						<option>phpass, MD5(Wordpress), MD5(phpBB3), MD5(Joomla)</option>
						<option>RipeMD160</option>
						<option>Samsung Android Password/PIN</option>
						<option>SAP CODVN B (BCODE)</option>
						<option>SAP CODVN F/G (PASSCODE)</option>
						<option>SHA1</option>
						<option>sha1(LinkedIn)</option>
						<option>sha1(md5($pass))</option>
						<option>sha1($pass.$salt)</option>
						<option>sha1($salt.$pass)</option>
						<option>sha1($salt.unicode($pass))</option>
						<option>sha1(unicode($pass).$salt)</option>
						<option>SHA256</option>
						<option>sha256crypt, SHA256(Unix)</option>
						<option>sha256($pass.$salt)</option>
						<option>sha256($salt.$pass)</option>
						<option>sha256($salt.unicode($pass))</option>
						<option>sha256(unicode($pass).$salt)</option>
						<option>SHA-3(Keccak)</option>
						<option>SHA512</option>
						<option>sha512crypt, SHA512(Unix)</option>
						<option>sha512($pass.$salt)</option>
						<option>sha512($salt.$pass)</option>
						<option>sha512($salt.unicode($pass))</option>
						<option>sha512(unicode($pass).$salt)</option>
						<option>Sybase ASE</option>
						<option>TrueCrypt 5.0+ (see below)</option>
						<option>WBB3, Woltlab Burning Board 3</option>
						<option>Whirlpool</option>
						<option>WPA/WPA2</option>
					</select>
				</div>
				<div class="form-group">
					<label for="hashes" class="control-label">Hash(es)</label>
					<textarea class="form-control" rows="6" id="hashes" name="hashes"></textarea>
				</div>

				<div class="form-group">
					<label class="control-label">Attack Method</label>

					<div class="radio">
						<input type="radio" name="attack_method" class="attack_method" value="0" checked=""/>
						Brute force
					</div>
					<div class="radio">
						<input type="radio" name="attack_method" class="attack_method" value="1"/>
						Mask
					</div>
					<div class="radio">
						<input type="radio" name="attack_method" class="attack_method" value="2"/>
						Dictionary
					</div>
				</div>
				<!-- Brute Force
			Nothing, just submit
			-->


				<!-- Mask -->

				<div id="mask-options" class="form-group" style="display:none">
					<label for="mask" class="control-label">Mask</label>
					<input type="text" class="form-control" id="mask" name="mask" placeholder="?u?l?l?l?l?l?l?l?d?s"/>
					<span
						class="help-block">All characters: ?a Decimals: ?d Upper case: ?u Lower Case: ?l Special: ?s</span>
				</div>

				<!---->

				<!-- Dictionary -->
				<div id="dictionary-options" class="form-group" style="display:none">
					<label for="dictionary_file" class="control-label">Dictionary</label>
					<select class="form-control" id="dictionary_file" name="dictionary_file">
						<option>RockYou</option>
						<option>Top 10K</option>
					</select>
				</div>
				<!---->
				<div class="form-group">
					<button class="btn btn-default">Cancel</button>
					<button type="submit" value="send" class="btn btn-primary">Submit</button>
				</div>


			</fieldset>
		</form>
	</div>
</div>

<script src="/js/bootstrap.min.js"></script>
</body>
</html>

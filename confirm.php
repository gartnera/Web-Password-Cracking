<?php

$db = new PDO("mysql:host=localhost;dbname=cracking", "cracking", "DATABASE_PASSWORD");
$challenge = $db->quote($_SERVER['QUERY_STRING']);
$result = $db->query("select id, uid, conType from confirmation where challenge=$challenge")->fetch(PDO::FETCH_ASSOC);

if (empty($result))
	die('Invalid Identifier');

$uid = $result['uid'];
$id = $result['id'];

if ($result['conType'] == 'E'){
	$db->query("update users set emailConfirmed=1 where id=$uid");
	echo 'User email confirmed';
}
else if($result['conType'] == 'M'){
	$db->query("update users set managerConfirmed=1 where id=$uid");
	echo 'Manager confirmation successful. <script>setTimeout(function(){window.close()},1000)</script>';
	//TODO: send email to user informing them of manager acceptance
}
else
	die('Invalid Confirmation');

$db->query("delete from confirmation where id=$id");



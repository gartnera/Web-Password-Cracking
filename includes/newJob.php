<?php
include('verifyHashes.php');

$attack_type_invalid = false;
$hash_type_invalid = false;
$hashes_invalid = false;
$attack_method_invalid = false;
$mask_invalid = false;
$dictionary_invalid = false;

$data = array();

if (!isset($_POST['attack_type']))
	return;

$attack_type = $_POST['attack_type'];
if ($attack_type == "0") {
	$data['attack_type'] = "0";
}
else if ($attack_type == "1") {
	$data['attack_type'] = "1";
}
else {
	$attack_type_invalid = true;
	return;
}
//TODO: enum?

$hash_type = $_POST['hash_type'];
$id = HashValidator::validateHashType($hash_type);
if ($id != -1) {
	$data['hash_type'] = $id;

	$hashes = preg_split('/[\ |\r\n|\n]+/', $_POST['hashes']);
	if (HashValidator::verifyHashes($id, $hashes)) {
		$data['hashes'] = $hashes;
	}
	else {
		$hashes_invalid = true;
	}
}
else {
	$hash_type_invalid = true;
}

$attack_method = $_POST['attack_method'];
if ($attack_method == "0") {
	$data['attack_method'] = 0;
}
else if ($attack_method == "1") {
	$data['attack_method'] = 1;
}
else if ($attack_method == "2") {
	$data['attack_method'] = 2;
}
else {
	$attack_method_invalid = true;
}

if ($data['attack_method'] == 1) {
	if (isset($_POST['mask'])) {
		$mask = $_POST['mask'];
		//TODO: replace with escapeshellargs
		if (!preg_match('/^(\?[a|d|u|l|s])+$/', $mask)) {

			$mask_invalid = true;
		}
		else
			$data['mask'] = $mask;
	}
	else {
		$mask_invalid = true;
	}

}

else if ($data['attack_method'] == 2) {
	if (isset($_POST['mask'])) {
		$dict = $_POST['dictionary'];
		if (!HashValidator::validateDictionary($dict)) {
			$dictionary_invalid = true;
		}
		else
			$data['dictionary'] = $dict;

	}
	else {
		$dictionary_invalid = true;
	}
}

if ($attack_type_invalid || $hash_type_invalid || $hashes_invalid || $attack_method_invalid || $mask_invalid || $dictionary_invalid) {
	return;
}
else {
	try {
		$db = new PDO("mysql:host=localhost;dbname=cracking", "cracking", "DATABASE_PASSWORD");
		$query = $db->prepare("INSERT INTO attack (hashType, attackType, attackMethod, mask, dictionary, uid)
								VALUES (:hashType, :attackType, :attackMethod, :mask, :dictionary, :uid)");

		$query->bindValue(":hashType", $data['hash_type']);
		$query->bindValue(":attackType", $data['attack_type']);
		$query->bindValue(":attackMethod", $data['attack_method']);
		if (isset($data['mask']))
			$query->bindValue(":mask", $data['mask']);
		else
			$query->bindValue(":mask", null, PDO::PARAM_INT);
		if (isset($data['dictionary']))
			$query->bindValue(":dictionary", $data['dictionary']);
		else
			$query->bindValue(":dictionary", null, PDO::PARAM_INT);
		$query->bindValue(":uid", $_SESSION['uid']);
		if ($query->execute()) {

			$jobId = $db->lastInsertId();

			$query = $db->prepare("INSERT INTO hash (jobId, hash) values (:jobId, :hash)");
			$query->bindValue(":jobId", $jobId);
			foreach ($data['hashes'] as $hash) {
				$query->bindValue(":hash", $hash);
				$query->execute();
			}
			$job_created_successfully = true;
		}
		else echo "error occurred";

	} catch (PDOException $e) {
		error_log($e->getMessage());
	}
}
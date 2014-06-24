<?php
include_once('constants.php');

function tdise($str, $status = null, $class = null, $colspan = null)
{
	if ($status == null){
		echo '<td>'.$str.'</td>';
	}
	else if ($status == 'P')
		echo '<td class="tr-pending '. $class. '" colspan="'.$colspan . '">'.$str.'</td>';
	else if ($status == 'F')
		echo '<td class="tr-failed '. $class. '" colspan="'.$colspan . '">'.$str.'</td>';
	else if ($status == 'S')
		echo '<td class="tr-success '. $class. '" colspan="'.$colspan . '">'.$str.'</td>';
	else if ($status == 'T')
		echo '<td class="tr-partial '. $class. '" colspan="'.$colspan . '">'.$str.'</td>';
	else if ($status == 'R')
		echo '<td class="tr-running '. $class. '" colspan="'.$colspan . '">'.$str.'</td>';
}


function trise($status, $class = null)
{
	if ($status == 'P')
		echo '<tr class="tr-pending '. $class. '">';
	else if ($status == 'F')
		echo '<tr class="tr-failed '. $class. '">';
	else if ($status == 'S')
		echo '<tr class="tr-success '. $class. '">';
	else if ($status == 'T')
		echo '<tr class="tr-partial '. $class. '">';
	else if ($status == 'R')
		echo '<tr class="tr-running '. $class. '">';
}

try {
	$db = new PDO("mysql:host=localhost;dbname=cracking", "cracking", "DATABASE_PASSWORD");

	$query = $db->prepare("SELECT id, createTime, attackType, hashType, attackMethod, status, mask, dictionary FROM attack where uid=:uid");
	$query->bindValue(":uid", $_SESSION['uid']);
	$query->execute();
	$jobs = $query->fetchAll(PDO::FETCH_ASSOC);

	foreach ($jobs as $row) {
		$status = $row['status'];
		$statusText = Constants::$status[$status];

		$timeParts = explode(' ', $row['createTime']);
		trise($status, "hash-meta");
		echo "<td>&nbsp;</td>";
		tdise($timeParts[0]);
		//tdise($timeParts[1]);

		tdise(Constants::$attack_types[$row['attackType']]);
		tdise(Constants::$hash_cat_types[$row['hashType']]);
		tdise(Constants::$attack_methods[$row['attackMethod']]);
		tdise($statusText); //TODO: bring back button
		echo "<td>&nbsp;</td>";
		echo "</tr>";

		$query = $db->prepare("SELECT hash, password FROM hash where jobId=:id");
		$query->bindValue(":id", $row['id']);
		$query->execute();

		$results = $query->fetchAll(PDO::FETCH_ASSOC);


		echo '<tr class="hidden hash-view">';
		//TODO: decrease font size
		$gen = '';
		foreach ($results as $row){
			$gen .= $row['hash']."<br />";
		}
		echo '<td>&nbsp;</td>';
		tdise($gen, $status,"left-hash",3);
		$gen = '';
		foreach ($results as $row){
			$gen .= $row['password'].'<br />';
		}
		tdise($gen, $status,"right-hash",2);
		echo '<td>&nbsp;</td></tr>';

	}


} catch (PDOException $e) {
	echo $e->getMessage();
}

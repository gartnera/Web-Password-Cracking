#!/usr/bin/php
<?php
/**
 * @param PDO $db
 * @param string $jobId
 * @return filename
 */
function loadHashesIntoFile($db, $jobId)
{
	$filename = '/var/hashes/' . $jobId;

	//if we're re-running
	if (file_exists($filename))
		return $filename;

	//otherwise load in hashes
	$query = $db->prepare("SELECT hash FROM hash where jobId = :id and password=0");
	$query->bindValue(":id", $jobId);
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_ASSOC);

	$output = '';
	$count = 0;
	foreach ($results as $row) {
		$output .= $row['hash'] . "\n";
		++$count;
	}

	file_put_contents($filename, $output);
	return array($filename, $count);
}

/**
 * @param PDO $db
 * @param string $jobId
 * @param string $status
 */
function changeJobStatus($db, $jobId, $status)
{
	$query = $db->prepare("UPDATE attack SET status=:status where id=:jobid");
	$query->bindValue(":status", $status);
	$query->bindValue(":jobid", $jobId);
	$query->execute();
}

//TODO: move to globals
function connectToDatabase()
{
	return new PDO("mysql:host=localhost;dbname=cracking", "cracking", "DATABASE_PASSWORD");
}

$db = connectToDatabase();
while (1) {
	$hashCatCmd = '/opt/hashcat/hc --quiet --remove';
	try {
		if (!$db)
			$db = connectToDatabase();
		$query = $db->prepare("SELECT id, uid, attackType, hashType, hashType, attackMethod, mask, dictionary FROM attack WHERE status = 'P' ORDER BY createTime");
		$query->execute();
		$job = $query->fetch(PDO::FETCH_ASSOC);

		if (empty($job)) {
			$db = null;
			sleep(30);
			continue;
		}

		$id = $job['id'];

		$timeLimit = $db->query("select hourLimit from users where id=" . $id)->fetchColumn(0);

		$loadResult = loadHashesIntoFile($db, $id);
		$filename = $loadResult[0];
		$hashCount = $loadResult[1];

		if ($job['attackType'] == 0) {
			$hashCatCmd .= ' ' . $filename;
			//$hashCatCmd .= ' -o /var/hashcatOutput/' . $id;
			$hashCatCmd .= ' -m ' . $job['hashType'];
			//$hashCatCmd .= ' --runtime '. $timeLimit; //only available on oclHashcat

			if ($job['attackMethod'] == 0) {
				//Brute Force
				$hashCatCmd .= ' -a3 ?a?a?a?a?a?a?a?a?a?a?a?a?a';
			}
			else if ($job['attackMethod'] == 1) {
				//User defined mask
				$hashCatCmd .= ' -a3 ' . $job['mask'];
			}
			else if ($job['attackMethod'] == 2) {
				$hashCatCmd .= ' ' . $job['dictionary'];
			}

			//change job status to pending
			changeJobStatus($db, $id, 'R');
			//disconnect from database
			$db = null;

			//Run hashcat. This is where the magic happens.
			$output = shell_exec($hashCatCmd);

			$db = connectToDatabase();

			preg_match("/To restore Session use Parameter -s ([0-9]+)/", $output, $matches);
			if (!empty($matches)) {
				//TODO: make sure to restore to end of queue
				$restoreId = $matches[1];

			}

			//find the results
			preg_match_all('/(.*):(.*)/', $output, $matches, PREG_SET_ORDER);
			if (empty($matches)) {
				changeJobStatus($db, $id, 'F');
			}
			else {
				//TODO: consider updating by job id rather than hash
				$query =$db->prepare("UPDATE hash SET password=:password WHERE hash=:hash");

				$count = 0;
				foreach ($matches as $hash) {
					//0=full string, 1=hash, 2=pass
					echo $hash[0];
					$query->bindValue(":password", $hash[2]);
					$query->bindValue(":hash", $hash[1]);
					$query->execute();
					++$count;
				}
				if ($count == $hashCount)
					changeJobStatus($db, $id, 'S');
				else
					changeJobStatus($db, $id, 'T');
			}

		}


		else if ($job['attackType'] == 1) {
		echo "Rainbow table not implemented";
		changeJobStatus($db, $id, 'F');
	}


	}
catch
(PDOException $e) {
	error_log($e->getMessage());
}
}

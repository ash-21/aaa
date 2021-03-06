<?php
/**
 * @author    Md Sakib Anwar 	Roll : 16
 */
session_start();
require_once('singleton_database.php');
$userID = $_SESSION['userID'];

$database_object = singleton_database::getInstance();
$conn = $database_object->getDatabase();

$query1 = <<<SQL
call make_intervals(date_sub(now(),interval 1 day),now(),1,'HOUR');
SQL;

$query = <<<SQL
select time(interval_start) as date,(select count(*) from appointments where time(appointmentTime) between time(interval_start) and time(interval_end) and userID ='{$userID}' ) as number from time_intervals  group by time(interval_start);
SQL;

$data = array();

if($conn->query($query1)){
	$result= $conn->query($query);
	while ($row= $result->fetch_assoc())
	{
		$data[] = $row;
	}
}

echo json_encode($data);
$conn->close();
?>

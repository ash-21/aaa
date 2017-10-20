<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'asdfzxcv';
$db = 'aaaDatabase';


$conn =new mysqli($dbhost,$dbuser,$dbpass,$db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$query1 = <<<SQL
	set @temp = (select min(appointmentTime) from appointments);
SQL;

$query2 = <<<SQL
	call make_intervals(@temp,now(),1,'MONTH');
SQL;

$query = <<<SQL
	select interval_start as date,count(*) as number from time_intervals,appointments where appointmentTime between interval_start and interval_end group by interval_start;
SQL;

$data = array();

if($conn->query($query1) && $conn->query($query2)){
	$result= $conn->query($query);
	while ($row= $result->fetch_assoc())
    {
    	$data[] = $row;
    	//echo $data[0]['interval_start']."<========>";
    	//echo $data[0]['count(*)']."\n";
    }
}

echo json_encode($data);
$conn->close();
?>
<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'asdfzxcv';
$db = 'aaaDatabase';


$conn =new mysqli($dbhost,$dbuser,$dbpass,$db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$query = <<<SQL
	select profession,count(*) as number from users group by profession;
SQL;

$data = array();

if($result= $conn->query($query)){
	while ($row= $result->fetch_assoc())
    {
    	$data[] = $row;
    }
}

echo json_encode($data);
$conn->close();
?>

<?php
require_once('singleton_database.php');

$database_object = singleton_database::getInstance();

$conn = $database_object->getDatabase();
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

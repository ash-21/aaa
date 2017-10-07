<html>
<body>

<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'asdfzxcv';
$db = 'aaaDatabase';


$conn =new mysqli($dbhost,$dbuser,$dbpass,$db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$userName = addslashes($_POST['userName']);
$profession = addslashes($_POST['profession']);

if($userName && $profession){
$query = <<<SQL
	select name,email
	from users
	where name = '{$userName}' 
	and 
	profession = '{$profession}'
SQL;
}

if(!$userName && $profession){
$query = <<<SQL
	select name,email
	from users
	where
	profession = '{$profession}'
SQL;
}

if($userName && !$profession){
$query = <<<SQL
	select name,email
	from users
	where name = '{$userName}' 
SQL;
}
if ($result= $conn->query($query))
  {
  while ($row= $result->fetch_assoc())
    {
    	printf("%s------%s</br>",$row['name'],$row['email']);
    }
  $result->free();
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}

$conn->close();

?>

</body>
</html>


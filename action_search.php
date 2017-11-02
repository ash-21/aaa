<?php
session_start();
$clientID = $_SESSION['clientID'];


require_once('iterator_table.php');
require_once('singleton_database.php');
require_once('factory_page.php');

$header_factory_object = new search_header_factory;

$database_object = singleton_database::getInstance();
$conn = $database_object->getDatabase();

$userName = addslashes($_POST['userName']);
$profession = addslashes($_POST['profession']);

$table_builder_object = null;

if($userName && $profession){
	$query = <<<SQL
	select *
	from users
	where lower(name) like lower('%{$userName}%') 
	and 
	lower(profession) like lower('%{$profession}%')
SQL;
}

if(!$userName && $profession){
	$query = <<<SQL
	select *
	from users
	where
	lower(profession) like lower('%{$profession}%')
SQL;
}

if($userName && !$profession){
	$query = <<<SQL
	select *
	from users
	where lower(name) like lower('%{$userName}%') 
SQL;
}

$page = null;
$page = $header_factory_object->print_page(null);

if ($result= $conn->query($query)){
	$table_builder_object = new search_table_builder($result,null);
	$page .= $table_builder_object->get_page();
	$result->free();
} else {
	echo "Error: " . $query . "<br>" . $conn->error;
}

$conn->close();
$page .= "</html>";
echo "{$page}";
?>

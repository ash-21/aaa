/**
 * Gets information from search form and checks it from database and shows the result in a html page
 * @author    Sayeed Md Ashraful Islam 	Roll : 48
 */
<?php
session_start();
$clientID = $_SESSION['clientID'];


require_once('iterator_table.php');
require_once('singleton_database.php');
require_once('page_decorator.php');

$header_decorator_object = new search_header_decorator;

$database_object = singleton_database::getInstance();
$conn = $database_object->getDatabase();

$userName = addslashes($_POST['userName']);
$profession = addslashes($_POST['profession']);

$table_decorator_object = null;

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
$page = $header_decorator_object->decorate_page($page);

if ($result= $conn->query($query)){
	$table_decorator_object = new search_table_builder($result,null);
	$page .= $table_decorator_object->get_page();
	$result->free();
} else {
	echo "Error: " . $query . "<br>" . $conn->error;
}

$conn->close();
$page .= "</html>";
echo "{$page}";
?>

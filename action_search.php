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


print "<!DOCTYPE html>
<html>
<title>Appointment Assistance</title>
<meta charset=\"UTF-8\">
<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
<link rel=\"stylesheet\" href=\"https://www.w3schools.com/w3css/4/w3.css\">
<link rel=\"stylesheet\" href=\"https://fonts.googleapis.com/css?family=Lato\">
<link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css\">
<style>
body, html {
    height: 75%;
    font-family: \"Lato\", sans-serif;
	    }

.menu {
    display: none;
}
.mySlides {display: none}
</style>
<body>

<!-- Navbar (sit on top) -->
<div class=\"w3-top\">
  <div class=\"w3-bar w3-white w3-wide w3-padding w3-card-2\">
    <a href=\"index.html\" class=\"w3-bar-item w3-button\"><b>A</b>utomated <b>A</b>ppointment<b> A</b>ssistant</a>
    <!-- Float links to the right. Hide them on small screens -->
    <div class=\"w3-right w3-hide-small\">
      <a href=\"search.html\" class=\"w3-bar-item w3-button\">Search</a>
      <a href=\"index.html\" class=\"w3-bar-item w3-button\">Log Out</a>
    </div>
  </div>
</div>

<!-- Page content -->
<div class=\"w3-content\" style=\"max-width:2000px;margin-top:46px\">

 <!-- The Contact Section -->

  <div class=\"w3-container w3-content w3-padding-64\" style=\"max-width:800px\" id=\"contact\">
  
<div class=\"w3-twothird\">
        <table class=\"w3-table w3-striped w3-white\">
          <tbody>
          <tr>
          <td></td>
          <td>Name</td>
          <td>Email</td>
          <td>Number</td>
          <td>Work Address</td>
          </tr>";
/****************************************/

if ($result= $conn->query($query))
  {
  while ($row= $result->fetch_assoc())
    {
    	print "<tr>
            <td><i class=\"fa fa-user w3-text-blue w3-large\"></i></td>
            <td>{$row['name']}</td>
            <td><i>{$row['email']}</i></td>
            <td><i>{$row['phone']}</i></td>
            <td><i>{$row['workAddress']}</i></td>
          </tr>";
    }
  $result->free();
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}

$conn->close();

/**************************************/
          
print " </tbody>
        </html>";

?>



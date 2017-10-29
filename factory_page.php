<?php
interface factory_page{
	public function print_page();
}

class header_factory implements factory_page{
	public function print_page(){
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
		<div class=\"w3-content \" style=\"max-width:2000px;margin-top:46px\">

		<!-- Page Container -->
		<div class=\"w3-content w3-padding-64 w3-margin-top\" style=\"max-width:1400px;\">

		<!-- The Grid -->
		<div class=\"w3-row-padding\">

		<!-- Left Column -->
		<div class=\"w3-third\">

		<div class=\"w3-white w3-text-grey w3-card-4\">
		<div class=\"w3-container\"> ";

	}
}

class search_header_factory implements factory_page{
	public function print_page(){
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
		
		<div class=\"w3-twothird\">";
	}
}

class login_body_factory implements factory_page{
	public function print_page(){
		print "
		<!----------------------------->
		<!----------------------------->
		<hr>

		</div>
		</div><br>

		<!-- End Left Column -->
		</div>

		<!-- Right Column -->
		<div class=\"w3-twothird\">

		<div class=\"w3-container w3-card-2 w3-white w3-margin-bottom\">
		<h2 class=\"w3-text-grey w3-padding-16\"><i class=\"fa fa-suitcase fa-fw w3-margin-right w3-xxlarge w3-text-teal\"></i>Appointments</h2>
		<div class=\"w3-container\">";
	}

}

class login_tail_factory implements factory_page{
	public function print_page(){
		print "
		<!----------------------------->
		<!----------------------------->
		<hr>
		</div>
		</div>

		<!-- End Right Column -->
		</div>

		<!-- End Grid -->
		</div>

		<!-- End Page Container -->
		</div>

		<footer class=\"w3-container w3-teal w3-center w3-margin-top\">
		<p>Find me on social media.</p>
		<i class=\"fa fa-facebook-official w3-hover-opacity\"></i>
		<i class=\"fa fa-instagram w3-hover-opacity\"></i>
		<i class=\"fa fa-snapchat w3-hover-opacity\"></i>
		<i class=\"fa fa-pinterest-p w3-hover-opacity\"></i>
		<i class=\"fa fa-twitter w3-hover-opacity\"></i>
		<i class=\"fa fa-linkedin w3-hover-opacity\"></i>
		<p>Powered by <a href=\"https://www.w3schools.com/w3css/default.asp\" target=\"_blank\">w3.css</a></p>
		</footer>

		</body>
		</html>" ;
	}
}

?>
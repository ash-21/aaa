<?php
/**
 * Shows this page when there is an error in logging in 
 * @author       Sayeed Md Ashraful Islam 	Roll : 48
 * @author page  Mahfida Jerin 	Roll : 26
 */
 
interface page_decorator{
	public function decorate_page($page);
}

class header_decorator implements page_decorator{
	private $state = null;
	public function set_state($state){
		$this->state = $state;
	}
	public function decorate_page($page){
		$page .= "<!DOCTYPE html>
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
		<a href=\"action_login_client.php\" class=\"w3-bar-item w3-button\"><b>A</b>utomated <b>A</b>ppointment<b> A</b>ssistant</a>
		<!-- Float links to the right. Hide them on small screens -->
		<div class=\"w3-right w3-hide-small\">";

		if(get_class($this->state)==='client_logged_in') $page .= "<a href=\"search.html\" class=\"w3-bar-item w3-button\">Search</a>";
		if(get_class($this->state)==='user_logged_in') $page .= "<a href=\"user_data.html\" class=\"w3-bar-item w3-button\">Data Visualization</a>";
		
		$page .= "<a href=\"logout.php\" class=\"w3-bar-item w3-button\">Log Out</a>
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
		<div class=\"w3-quarter\">

		<div class=\"w3-white w3-text-grey w3-card-4\">
		<div class=\"w3-container\"> ";

		return $page;
	}
}

class search_header_decorator implements page_decorator{
	public function decorate_page($page){
		$page .= "<!DOCTYPE html>
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
		<a href=\"action_login_client.php\" class=\"w3-bar-item w3-button\"><b>A</b>utomated <b>A</b>ppointment<b> A</b>ssistant</a>
		<!-- Float links to the right. Hide them on small screens -->
		<div class=\"w3-right w3-hide-small\">
		<a href=\"search.html\" class=\"w3-bar-item w3-button\">Search</a>
		<a href=\"logout.php\" class=\"w3-bar-item w3-button\">Log Out</a>
		</div>
		</div>
		</div>

		<!-- Page content -->
		<div class=\"w3-content\" style=\"max-width:2000px;margin-top:46px\">

		<!-- The Contact Section -->

		<div class=\"w3-container w3-content w3-padding-64\" style=\"max-width:800px\" id=\"contact\">
		
		<div class=\"w3-twothird\">";
		
		return $page;
	}
}

class login_body_decorator implements page_decorator{
	public function decorate_page($page){
		$page .= "
		<!----------------------------->
		<!----------------------------->
		<hr>

		</div>
		</div><br>

		<!-- End Left Column -->
		</div>

		<!-- Right Column -->
		<div class=\"w3-threequarter\">

		<div class=\"w3-container w3-card-2 w3-white w3-margin-bottom\">
		<h2 class=\"w3-text-grey w3-padding-16\"><i class=\"fa fa-suitcase fa-fw w3-margin-right w3-xxlarge w3-text-teal\"></i>Appointments</h2>
		<div class=\"w3-container\">";
		
		return $page;
	}

}

class login_tail_decorator implements page_decorator{
	public function decorate_page($page){
		$page .= "
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
		<p class=\"w3-medium\">Powered by <a href=\"https://www.facebook.com\" target=\"_blank\">Ashraf Mahfida Sakib</a></p>
		</footer>

		</body>
		</html>" ;
		
		return $page;
	}
}

class error_header_decorator implements page_decorator{
	public function decorate_page($page){
		$page .= "<!DOCTYPE html>
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
		<a href=\"data.html\" class=\"w3-bar-item w3-button\">Data Visualization</a>
		<a href=\"signup.html\" class=\"w3-bar-item w3-button\">Sign Up</a>
		<a href=\"login.html\" class=\"w3-bar-item w3-button\">Log In</a>
		</div>
		</div>
		</div>

		<!-- Page content -->
		<div class=\"w3-content\" style=\"max-width:2000px;margin-top:46px\">
		<!-- The Contact Section -->
		<div class=\"w3-container w3-content w3-padding-64\" style=\"max-width:950px\" id=\"contact\"> ";
		
		return $page;
	}
}

class error_footer_decorator implements page_decorator{
	public function decorate_page($page){
		$page .="
		<h2 class=\"w3-padding-64 w3-wide w3-center\">CONTACT</h2>
		<p class=\"w3-opacity w3-center\"><i>Any advice? Drop a note!</i></p>
		<div class=\"w3-row w3-padding-32\">
		<div class=\"w3-col m6 w3-large w3-margin-bottom\">
		<i class=\"fa fa-map-marker\" style=\"width:30px\"></i> Dhaka, Bangladesh<br>
		<i class=\"fa fa-phone\" style=\"width:30px\"></i> Phone: +8801521212121<br>
		<i class=\"fa fa-envelope\" style=\"width:30px\"></i> Email: automatedappointmentassistance@gmail.com<br>
		</div>
		<div class=\"w3-col m6\">
		<form action=\"/action_page.php\" target=\"_blank\">
		<div class=\"w3-row-padding\" style=\"margin:0 -16px 8px -16px\">
		<div class=\"w3-half\">
		<input class=\"w3-input w3-border\" type=\"text\" placeholder=\"Name\" required name=\"Name\">
		</div>
		<div class=\"w3-half\">
		<input class=\"w3-input w3-border\" type=\"text\" placeholder=\"Email\" required name=\"Email\">
		</div>
		</div>
		<input class=\"w3-input w3-border\" type=\"text\" placeholder=\"Message\" required name=\"Message\">
		<button class=\"w3-button w3-black w3-section w3-right\" type=\"submit\">SEND</button>
		</form>
		</div>
		</div>
		</div>
		</div>

		<!-- Footer -->
		<footer class=\"w3-container w3-padding-64 w3-center w3-opacity w3-light-grey w3-xlarge\">
		<i class=\"fa fa-facebook-official w3-hover-opacity\"></i>
		<i class=\"fa fa-instagram w3-hover-opacity\"></i>
		<i class=\"fa fa-snapchat w3-hover-opacity\"></i>
		<i class=\"fa fa-pinterest-p w3-hover-opacity\"></i>
		<i class=\"fa fa-twitter w3-hover-opacity\"></i>
		<i class=\"fa fa-linkedin w3-hover-opacity\"></i>
		<p class=\"w3-medium\">Powered by <a href=\"https://www.facebook.com\" target=\"_blank\">Ashraf Mahfida Sakib</a></p>
		</footer>

		</body>
		</html>";
		
		return $page;
	}
}

?>

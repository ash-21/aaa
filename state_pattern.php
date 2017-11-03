<?php
/**
 * Describe the different state a user of the website can be in and their behaviour
 * @author    Md Sakib Anwar 	Roll : 16
 */

abstract class state{
	public abstract function show_page();
}

class not_logged_in extends state{
	public function show_page(){

	}
}

class database_error extends state{
	public function __construct(){
		$this->show_page();
	}
	public function show_page(){
		print "<script>
		var wrong = \"database\";
		window.location='error_page.php?name=' + wrong;
		</script>";
	}
}

class user_logged_in extends state{
	private $row;
	public function __construct($row_id){
		$this->row = $row_id;
	}
	public function show_page(){
		$page = null;
		$page .= "<h2><strong>{$this->row['name']}</strong></h2>
		<p><i class=\"fa fa-address-card fa-fw w3-margin-right w3-large w3-text-teal\"></i>{$this->row['userID']}</p>
		<p><i class=\"fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-teal\"></i>{$this->row['profession']}</p>
		<p><i class=\"fa fa-home fa-fw w3-margin-right w3-large w3-text-teal\"></i>{$this->row['workAddress']}</p>
		<p><i class=\"fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal\"></i>{$this->row['email']}</p>
		<p><i class=\"fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal\"></i>{$this->row['phone']}</p>";
		
		return $page;
	}
}

class client_logged_in extends state{
	private $row;
	public function __construct($row_id){
		$this->row = $row_id;
	}
	public function show_page(){
		$page = null;
		$page .= "<h2><strong>{$this->row['name']}</strong></h2>
		<p><i class=\"fa fa-address-card fa-fw w3-margin-right w3-large w3-text-teal\"></i>{$this->row['clientID']}</p>
		<p><i class=\"fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal\"></i>{$this->row['email']}</p>
		<p><i class=\"fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal\"></i>{$this->row['phone']}</p>";
		
		return $page;
	}
}


class wrong_password extends state{
	public function __construct(){
		$this->show_page();
	}

	public function show_page(){
		print "<script>
		var wrong = \"password\";
		window.location='error_page.php?name=' + wrong;
		</script>";
	}
}

class wrong_email extends state{
	public function __construct(){
		$this->show_page();
	}

	public function show_page(){
		print "<script>
		var wrong = \"email\";
		window.location='error_page.php?name=' + wrong;
		</script>";
	}
}

class successful_signup extends state{
	public function __construct(){
		$this->show_page();
	}
	public function show_page(){
		print "<script>
		window.location='index.html';
		</script>";
	}
}

class unsuccessful_signup extends state{
	public function __construct(){
		$this->show_page();
	}
	public function show_page(){
		print "<script>
		var wrong = \"signup\";
		window.location='error_page.php?name=' + wrong;
		</script>";
	}
}
?>

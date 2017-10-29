<?php
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
			window.location='database_error.html';
			</script>";
		}
	}

	class logged_in extends state{
		private $row;
		public function __construct($row_id){
			$this->row = $row_id;
			$this->show_page();
		}
		public function show_page(){
			print "<h2><strong>{$this->row['name']}</strong></h2>";
			print "<p><i class=\"fa fa-address-card fa-fw w3-margin-right w3-large w3-text-teal\"></i>{$this->row['userID']}</p>";
			print "<p><i class=\"fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-teal\"></i>{$this->row['profession']}</p>";
			print "<p><i class=\"fa fa-home fa-fw w3-margin-right w3-large w3-text-teal\"></i>{$this->row['workAddress']}</p>";
			print "<p><i class=\"fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal\"></i>{$this->row['email']}</p>";
			print "<p><i class=\"fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal\"></i>{$this->row['phone']}</p>";
		}
	}

	class wrong_password extends state{
		public function __construct(){
			$this->show_page();
		}

		public function show_page(){
			print "<script>
			window.location='error_wrong_password.html';
			</script>";
		}
	}

	class wrong_email extends state{
		public function __construct(){
			$this->show_page();
		}

		public function show_page(){
			print "<script>
			window.location='error_wrong_email.html';
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
			window.location='errorSignup.html';
			</script>";
		}
	}
?>
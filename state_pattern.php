<?php
	abstract class state{
		public abstract function show_page();
	}

	class not_logged_in extends state{
		public function show_page(){

		}
	}

	class logged_in extends state{

		public function show_page(){

		}
	}

	class wrong_password extends state{
		public function __construct(){
			$this->show_page();
		}

		public function show_page(){
			
		}
	}

	class wrong_email extends state{
		public function __construct(){
			$this->show_page();
		}

		public function show_page(){
			
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
<?php
class singleton_database {
	var $conn;
	public static function getInstance() {
		static $instance = null;         
		if (null === $instance) {
			$instance = new singleton_database;
		}
		return $instance;
	}
	protected function __construct() {
		$this->$conn =new mysqli('localHost','root','asdfzxcv','aaaDatabase');
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
	}
      
	private function __clone() {
	}
      
	private function __wakeup() {
	}
	
	public function getDatabase() {
		return $this->$conn;
	}
}
   
?>

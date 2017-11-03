<?php

/**
 * Builds a single connection to the database and uses it throughout the session
 * @author    Md Sakib Anwar 	Roll : 16
 */

class singleton_database {
	private $conn;
	public static function getInstance() {
		static $instance = null;         
		if (null === $instance) {
			$instance = new singleton_database;
		}
		return $instance;
	}
	protected function __construct() {
		$this->conn =new mysqli('localHost','root','asdfzxcv','aaaDatabase');
		if ($this->conn->connect_error) {
			die("Connection failed: " . $this->conn->connect_error);
		}
	}
	
	private function __clone() {
	}
	
	private function __wakeup() {
	}
	
	public function getDatabase() {
		return $this->conn;
	}
}

?>

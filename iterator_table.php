<?php

require_once('null_pattern.php');
require_once('user_client_profile.php');

class iterator_table{
	private $result = null;
	private $row = null;

	public function __construct($result_id){
		$this->result = $result_id;
	}

	public function has_next(){
		if($this->row = $this->result->fetch_assoc()) {
			return TRUE;
		}
		return FALSE;
	}

	public function next(){
		return $this->row;
	}

}

interface table_builder{
	public function start_table();
	public function end_table();
	public function build_row($row,$appointment);
}

class profile_table_builder implements table_builder{
	private $table_type;
	private $iterator;
	private $count = 0;
	private $null_object_factory;
	private $prev_app;
	private $next_app;
	private $appointment_array;

	public function __construct($table_type_id,$result){
		$appointment_array = array();

		if($table_type_id==='client'){
			$this->table_type = 'User Name';
		}
		else if($table_type_id==='user'){
			$this->table_type = 'Client Name';
		}
		$this->iterator = new iterator_table($result);
		while($this->iterator->has_next()===TRUE){
			$this->appointment_array[] = $this->iterator->next();
			$this->count++;
		}
		$this->start_table();
	}

	public function start_table(){
		print "<table class=\"w3-table w3-striped w3-white\">
		<tbody>
		<tr>
		<td></td>
		<td><span class=\"w3-tag w3-teal w3-round\">{$this->table_type}</span></td>
		<td><span class=\"w3-tag w3-teal w3-round\">Email</span></td>
		<td><span class=\"w3-tag w3-teal w3-round\">Appointment Time</span></td>
		<td><span class=\"w3-tag w3-teal w3-round\">Description</span></td>
		<td></td>
		</tr>
		</tbody><tbody>";
		$this->get_appointment_list();
	}

	public function get_appointment_list(){
		$appointment_object_list = array();
		for ($i=0;$i<$this->count;$i++) { 
			$row = $this->appointment_array[$i];
			$appointment_object_list[$i] = new appointment($row['appointmentID'],$row['userID'],$row['clientID'],$row['appointmentTime'],$row['description']);
			if($i!=0) $appointment_object_list[$i] = $appointment_object_list[$i]->add_previous_appointment($this->appointment_array[$i-1]['appointmentID']);
			if($i-1!=$this->count) $appointment_object_list[$i] = $appointment_object_list[$i]->add_next_appointment($this->appointment_array[$i+1]['appointmentID']);
			$this->build_row($row,$appointment_object_list[$i]);
		}
		$this->end_table();
	}

	public function end_table(){
		print "</tbody></table><p>Number of result: {$this->count}</p>";
	}

	public function build_row($row_id,$appointment){
		print "<form action=\"/remove_appointment.php\" method=\"POST\">
		<tr>
		<td><i class=\"w3-text-blue w3-large\"></i></td>
		<td><i>{$row_id['name']}</i></td>
		<td><i>{$row_id['email']}</i></td>
		<td><i>{$appointment->time}</i></td>
		<td><i>{$appointment->description}</i></td>
		<input type=\"hidden\" name=\"appointmentID\" value=\"{$appointment->appointmentID}\">
		<input type=\"hidden\" name=\"prev_appointment\" value=\"{$appointment->previous_appointment}\">
		<input type=\"hidden\" name=\"next_appointment\" value=\"{$appointment->next_appointment}\">";		
		if($this->table_type==='User Name') print "<input type=\"hidden\" name=\"clientID\" value=\"{$appointment->clientID}\">";
		else print "<input type=\"hidden\" name=\"userID\" value=\"{$appointment->userID}\">";
		print "<td> 
		<input class=\"btn btn-success\" type=\"submit\" name=\"up\" value=\"↑\" >
		<input class=\"btn btn-success\" type=\"submit\" name=\"down\" value=\"↓\" >
		<input class=\"btn btn-success\" type=\"submit\" name=\"delete\" value=\"X\" >
		</td>
		</tr>
		</form>";
	}
}

class search_table_builder implements table_builder{
	private $iterator;
	private $count = 0;

	public function __construct($result){
		$this->start_table();
		$this->iterator = new iterator_table($result);

		while($this->iterator->has_next()===TRUE){
			$this->build_row($this->iterator->next());
			$this->count++;
		}

		$this->end_table();
	}

	public function start_table(){
		print "<table class=\"w3-table w3-striped w3-white\">
		<tbody>
		<tr>
		<td style=\"background-color:#00B7EB;\"></td>
		<th style=\"background-color:#00B7EB;\">Name</th>
		<th style=\"background-color:#00B7EB;\">Email</th>
		<th style=\"background-color:#00B7EB;\">Number</th>
		<th style=\"background-color:#00B7EB;\">Work Address</th>
		<th style=\"background-color:#00B7EB;\">View Profile</th>
		</tr>";
	}

	public function end_table(){
		print "</tbody></table><p>Number of result: {$this->count}</p>";
	}

	public function build_row($row,$not_important){
		print "<form action=\"/profile_client.php\" method=\"POST\">
		<tr>
		<td><i class=\"fa fa-user w3-text-blue w3-large\"></i></td>
		<td>{$row['name']}</a></td>
		<td><i>{$row['email']}</i></td>
		<td><i>{$row['phone']}</i></td>
		<td><i>{$row['workAddress']}</i></td>
		<input type=\"hidden\" name=\"id\" value=\"{$row['userID']}\">
		<td> 
		<input class=\"btn btn-success\" type=\"submit\" value=\"GO!\" >
		</td>
		</tr>
		</form>";
	}

}

?>

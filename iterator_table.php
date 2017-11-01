<?php
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
	public function build_row($row);
}

class profile_table_builder implements table_builder{
	private $table_type;
	private $iterator;
	private $count = 0;

	public function __construct($table_type_id,$result){
		if($table_type_id==='client'){
			$this->table_type = 'User Name';
		}
		else if($table_type_id==='user'){
			$this->table_type = 'Client Name';
		}
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
		<td></td>
		<td><span class=\"w3-tag w3-teal w3-round\">{$this->table_type}</span></td>
		<td><span class=\"w3-tag w3-teal w3-round\">Email</span></td>
		<td><span class=\"w3-tag w3-teal w3-round\">Appointment Time</span></td>
		<td><span class=\"w3-tag w3-teal w3-round\">Description</span></td>
		<td></td>
		</tr>
		</tbody><tbody>";
	}

	public function end_table(){
		print "</tbody></table><p>Number of result: {$this->count}</p>";
	}

	public function build_row($row_id){
		print "<form action=\"/remove_appointment.php\" method=\"POST\">
		<tr>
		<td><i class=\"w3-text-blue w3-large\"></i></td>
		<td><i>{$row_id['name']}</i></td>
		<td><i>{$row_id['email']}</i></td>
		<td><i>{$row_id['appointmentTime']}</i></td>
		<td><i>{$row_id['description']}</i></td>
		<input type=\"hidden\" name=\"appointmentID\" value=\"{$row_id['appointmentID']}\">";
		if($this->table_type==='User Name') print "<input type=\"hidden\" name=\"clientID\" value=\"{$row_id['clientID']}\">";
		else print "<input type=\"hidden\" name=\"userID\" value=\"{$row_id['userID']}\">";
		print "<td> 
		<input class=\"btn btn-success\" type=\"submit\" value=\"X\" >
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

	public function build_row($row){
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

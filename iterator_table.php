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

	public function __construct($table_type_id,$result){
		if($table_type_id==='client'){
			$this->table_type = 'User ID';
		}
		else if($table_type_id==='user'){
			$this->table_type = 'Client ID';
		}
		$this->start_table();
		$this->iterator = new iterator_table($result);

		while($this->iterator->has_next()===TRUE){
			$this->build_row($this->iterator->next());
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
		</tr>
		</tbody><tbody>";
	}

	public function end_table(){
		print "</tbody></table>";
	}

	public function build_row($row_id){
		print "<tr>
		<td><i class=\"w3-text-blue w3-large\"></i></td>
		<td><i>{$row_id['name']}</i></td>
		<td><i>{$row_id['email']}</i></td>
		<td><i>{$row_id['appointmentTime']}</i></td>
		</tr>";
	}

}

class search_table_builder implements table_builder{
	private $iterator;

	public function __construct($result){
		$this->start_table();
		$this->iterator = new iterator_table($result);

		while($this->iterator->has_next()===TRUE){
			$this->build_row($this->iterator->next());
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
		print "</tbody></table>";
	}

	public function build_row($row){
		print "<form action=\"/profileClient.php\" method=\"POST\">
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
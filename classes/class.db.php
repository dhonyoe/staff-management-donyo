<?php

class database {

	public $con = false;
    	public $result = false;
    	public $num_rows = null;
    	public $valid_resource = false;

   	function __construct() {
		$this->con = mysqli_connect(LOCALHOST, USERNAME, PASSWORD, DBNAME);
        }
    	function connect() {
		return $this->con;
	}
    	function clean_post($a) {
		foreach($a as $key=>$value) {

			$cleaned_value = mysqli_real_escape_string($this->con, $value);
		    	$cleaned_value = str_replace("'", "", $cleaned_value);
			$cleaned_value = str_replace("(", "", $cleaned_value);
		    	$cleaned_value = str_replace(")", "", $cleaned_value);
		    	$cleaned_value = str_replace("<", "", $cleaned_value);
		    	$cleaned_value = str_replace(">", "", $cleaned_value);
		    	$cleaned_value = str_replace("&", "", $cleaned_value);
		    	$cleaned_value = str_replace(";", "", $cleaned_value);
		    	$cleaned_post["$key"] = $cleaned_value;
	    	}
	    	return $cleaned_post;
    	}

    	function select($sql) {
	    	$this->result = $this->query($sql, "select");
	    	return $this->result;
    	}
	function select_display($sql = '') {
		$this->result = $this->query($sql, "all");
	}
	function update_text($table = '', $conditions = '') {
		$sql = "UPDATE `$table` SET $conditions";
		$this->result = $this->query($sql, "insert");
		return $this->result;
	}

    	function query($sql = '', $type = '') {

        	if(trim($sql) != '') {
			if( $type == "insert") {
            			$this->result = mysqli_query($this->con, "$sql");
			}
			else if($type == "select") {
				$this->result = mysqli_query($this->con, "$sql");
				while(@$rows = mysqli_fetch_array($this->result)) {
					$this->result = @$rows["0"];
				}
			}
			else if($type == "all") {
				return $this->result = mysqli_query($this->con, "$sql");
				break;
			}

			if( $this->result ) {
				return true;
			} else {
				return false;
			}
        	} else {
            		return false;
        	}
    	}

    	function delete($table = '', $conditions = '') {
		$sql = "DELETE FROM $table WHERE $conditions";
		$this->result = $this->query($sql, "all");
		return $this->result;
    	}

    	function insert($table = '', $data = array()) {

        	if(trim($table) == '' || !is_array($data) || count($data) == 0 ) {
            		return false;
        	}

	        $sql = $this->create_insert_sql($table, $data);
        	$this->result = $this->query($sql, "insert");

		return $this->result;
    	}

    	function get_results() {
        	$result = array();
        	while ($row = mysql_fetch_array($this->resource)) {
            		$result[] = $row;
        	}
	        return $result;
    	}

	function get_result() {
		return $this->result;
	}

    	function get_one_result() {
       		return mysqli_fetch_array($this->result);
    	}

	function get_one_result_display() {
		return mysqli_fetch_assoc($this->result);
	}

    	function get_number_of_results() {
        	return $this->num_rows;
    	}
    
    	function get_db_instance() {
        	return $this;
    	}
    
    	function set_number_of_results() {
    		$this->num_rows = mysqli_num_rows($this->resource);
    	}
    	function create_insert_sql($table = '', $_data = array() ) {

		$_data = $this->clean_post($_data);

	    	$sql = "INSERT INTO `$table` (";

	    	$column = '';
	    	$values = '';
	    	$i = 0;

	    	foreach ( $_data as $field => $value) {

			if( $field == 'action' || $field == 're_password' || $field == 'table') {
				$column .= '';
			    	$values .= '';
		    	} else {

		    		if ($i == 0) {
		    			$column .= "`$field`";
					$values .= "'$value'";
		    		} else {
			       		$column .= ", `$field`";
			        	$values .= ", '$value'";
				}
				$i++;
		    	}
	    	}
	    	$sql .= "$column) VALUES ($values)";

	    	return $sql;
    	}
	function check_token($table = '', $hash = '', $id = '') {

		session_start();
		$sql = "SELECT id FROM $table";
		$this->select_display($sql);

		$status = false;
		while($rows = $this->get_one_result_display()) {

			if( $hash == md5($rows["id"].$_SESSION["tsa_gong"]) && $rows["id"] == $id ) {
				$status = true;
			}
		}
		return $status;
	}
	function check_value($table = '', $field = '', $value = '') {
			
		$sql = "SELECT count(id) FROM $table WHERE $field = '$value'";
		return $this->result = $this->select($sql);
	}
	function match_encryption($table_name, $idh) {

		$sql = "SELECT id FROM $table_name";
		$this->select_display($sql);
		
		while($rows = $this->get_one_result_display() ) {
			if($idh == md5($rows["id"].$_SESSION["tsa_gong"]) || $idh == md5($rows["id"].$_SESSION["tsa_gong2"]) ) {
				$id = $rows["id"];
			}
		}
		return $id;
	}
}

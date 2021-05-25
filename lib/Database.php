<?php 

/**
 * Database class
 */
class Database{
	
	public $host  = DB_HOST;
	public $user  = DB_USER;
	public $pass  = DB_PASS;
	public $name  = DB_NAME;

	public $link;
	public $error;

	// autorun database connection
	function __construct()
	{
		return $this->connectDB();
	}

	// connect database
	private function connectDB(){
		$this->link = new mysqli($this->host,$this->user,$this->pass,$this->name);
		if (!$this->link) {
			$this->error = 'Connection fail'.$this->link->connect_error();
			return false;
		}
	}

	// Insert data
	public function insert($query){
		$insert_row = $this->link->query($query) or die($this->link->error.__LINE__);
		if ($insert_row) {
			return $insert_row;
		}else{
			return false;
		}
	}

	// Select data
	public function select($query){
		$select_row = $this->link->query($query) or die($this->link->error.__LINE__);
		if ($select_row->num_rows > 0) {
			return $select_row;
		}else{
			return false;
		}
	}


	// Delete data
	public function delete($query){
		$delete_row = $this->link->query($query) or die($this->link->error.__LINE__);
		if ($delete_row) {
			return $delete_row;
		}else{
			return false;
		}
	}



}
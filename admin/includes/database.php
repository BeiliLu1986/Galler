<?php 

require_once("new_config.php");

class Database {

	public $connection;

	function __construct(){

		$this->open_db_connection();
	}

	public function open_db_connection(){

		//$this->connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		//Creating an object
		$this->connection = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

		//if(mysqli_connect_errno()){
		if($this->connection->connect_errno){

			//die("Database conenction failed badly" . mysqli_error());
			die("Database conenction failed badly" . $this->connection->connect_errno);
		}
	}


	public function query($sql){

		//$result = mysqli_query($this->connection,$sql);
		$result = $this->connection->query($sql);

		$this->confirm_query($result);

		return $result;

	}


	private function confirm_query($result){

		if(!$result){

			die("Query Failed" . $this->connection->error);
		}

	}

	// Clean up the data before go to the database
	public function escape_string($string){

		//$escape_string = mysqli_real_escape_string($this->connection,$string);
		$escape_string = $this->connection->real_escape_string($string);

		return $escape_string;

	}


	public function the_insert_id(){

	return $this->connection->insert_id;

    }

}


$database = new Database();


?>
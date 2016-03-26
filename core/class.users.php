<?php

class Users extends Rest {  

	private function table() { 
		return $this->tableName("users");
	}

	function insertDataIntoDB ($name, $password) {
		if ( isset($name) && isset($password) && !is_null($name) && !is_null($password) ) {

			$name 		= $this->test_input($name);
			$password 	= $this->test_input($password);

					$query = "INSERT INTO " . $this->table() . "
						(name, password) VALUES
						('".$name ."','".$password."');";
			$this->dbConnect("query", $query);
			print("User is inserted in $this->table(). \n");
			unset($_POST);
			
		} else {
			
		}
	}

	function __construct () {
		$query = "CREATE TABLE IF NOT EXISTS " . $this->table() . " (
						id INT NOT NULL AUTO_INCREMENT,
						name VARCHAR(32) NOT NULL,
						password VARCHAR(32) NOT NULL,
						PRIMARY KEY (id)
						);";
		if ($this->tableExists("users") ) { 
			//print("Table $this->table is already exists. \n");
			} else {
				$this->dbConnect("exec", $query);
				print("Created $this->table(). \n");
		 	} 
	}

	function __destruct() {
		
	}
}


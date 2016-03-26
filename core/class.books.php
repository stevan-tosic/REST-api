<?php

class Books extends Rest {
	private function table() { 
		return $this->tableName("books");
	}

	function insertBookData($n,$a,$y,$l,$o) {
		$query = "INSERT INTO " . $this->table() . " (name, author, year_of_publish, language, origin_lang) VALUES (?,?,?,?,?)";
		$statement = $this->dbConnect("prepare", $query);
		return $statement->execute(array($n,$a,$y,$l,$o));
	}
 	
 	function updateBookData($n,$a,$y,$l,$o,$id) {
 		$id = $id + 1;
 		$query = "UPDATE ". $this->table() ." SET name = '{$n}', author = '{$a}', year_of_publish = {$y}, language = '{$l}', origin_lang = '{$o}' WHERE id = {$id}";
 		$statement = $this->dbConnect("prepare", $query);
 		return $statement->execute();
 	}
 	function deleteBookData($id) {
 		$query = "DELETE FROM ". $this->table() ." WHERE id = {$id}";
 		$statement = $this->dbConnect("prepare", $query);
 		return $statement->execute();
 	}
	function getTableData($offset = 0) {
		$query = "SELECT * FROM " . $this->table() . " LIMIT 10 OFFSET " . $offset . ";";
	    return ($this->dbConnect("query", $query)->fetchAll());
	}
	function numOfTableRows() {
		$query = "SELECT count(id) FROM " . $this->table() . ";";
	    return ($this->dbConnect("query", $query)->fetchColumn());
	}
	
	function getAuthor($find){
		$data = $this->getTableData();

		foreach ($data as $books) {
				if ($books['id'] == $find) {
				return $books['author'];
				}
		}	
	}
	function getDataPerPage($page = 1) {
		$page = ($page - 1) * 10;
		$data = $this->getTableData($page);

		return $data;
	}
	function method_GET_response ($get, $action) {
		if ((!empty($get)) && (is_numeric($get)) )  {
			$data = $this->$action($get);
			if (empty($data)) {
				$this->deliver_response(200, "data not found", NULL);
			} else {
				$this->deliver_response(200, "data found", $data);
			} 
			/*} else {
			$this->deliver_response(400, "Invalid Request", NULL);
		*/}
	}
	
	function deliver_response($status, $status_message, $data) {
		header("HTTP/1.1 $status $status_message");

		$response['status'] 		= $status;
		$response['status_message'] = $status_message;
		$response['data']			= $data;

		$json_response = json_encode($response);

		echo $json_response; 
	}


	function __construct () {
		$query = "	CREATE TABLE IF NOT EXISTS " . $this->table() . " (
					id INT NOT NULL AUTO_INCREMENT,
					name VARCHAR(32) NOT NULL,
					author VARCHAR(32) NOT NULL,
					year_of_publish YEAR NOT NULL,
					language VARCHAR(32) NOT NULL,
					origin_lang VARCHAR(32) NOT NULL,
					PRIMARY KEY (id)
					);";
		if ( $this->tableExists("books") ) { 
			//print("Table $this->table is already exists. \n");
			} else {
				$this->dbConnect("exec", $query);
				print("Created $this->table(). \n");
		 	} 
	}
}


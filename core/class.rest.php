<?php

class Rest {
	protected $prefix			= "REST_";
	protected $charset_collate 	= "utf8_general_ci";
 	private $db_name 			= "hiremei1_db";
 	private $user				= "hiremei1";
 	private $password			= "046NzZdt3m";


	protected function dbConnect($action, $query) {
		try {
			$db = new PDO("mysql:dbname=" . $this->db_name . "; host=127.0.0.1", $this->user, $this->password);
			$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );//Error Handling
	        $result = $db->$action($query);
	        if ($action === "query") {
	        $result->setFetchMode(PDO::FETCH_ASSOC);
	    	}
	    } catch (PDOException $e) {
	        echo $e->getMessage();
	    }
	    return $result;
	}

	protected function tableExists($tableName) {
 		$this->table = $this->prefix . $tableName;
	    $query = "SELECT COUNT(*) FROM information_schema.tables WHERE table_name = '{$this->table}'";
	    $result = $this->dbConnect("query", $query)->fetchColumn();
	    if ( (int)$result === 0) { 
	    	return false;         
	    } else {
	    	return true;
	    }
	}

	protected function tableName($name) {
		return ($this->prefix . $name);
	}

	protected function test_input ($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

}

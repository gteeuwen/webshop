<?php
//==========================================================================
//This class is responsible for selecting data for all direct sql database interactions.
//==========================================================================
class Crud{
	private $conn;
	private $lasterror;
	private $multiple_queries = false;

	public function __construct(){
		try {
			$this->conn = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASSWORD);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $exception) {
			exit('Failed to connect to database!');
		}
	}
	
	public function destruct(){
		unset($this->conn);
	}
		
	//Inserts data into sql database
	public function insert($query, $parameters = null){
		$stmt = $this->query($query, $parameters);
		if($stmt){
			return $this->conn->lastInsertId();
		}
		return false;
	}
	
	//Selects data from sql database
	public function select($query, $parameters = null){
		$stmt = $this->query($query, $parameters);
		if($stmt){
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		return false;
	}

	//Updates data in sql database
	public function update($query, $parameters = null){
		$stmt = $this->query($query, $parameters);
		if($stmt){
			return $stmt->rowCount();
		}
		return false;
	}
	
	//Deletes data from sql database
	public function delete($query, $parameters = null){
		$stmt = $this->query($query, $parameters);
		if($stmt){
			return $stmt->rowCount();
		}
		return false;
	}
		
	//Performs the query
	protected function query($query, $parameters){
		try{
			$stmt = $this->conn->prepare($query);
			$this->bindParameters($stmt, $parameters);
			$stmt->execute();
			return $stmt;
		}catch(PDOException $e){
			if($this->multiple_queries){
				$this->conn->rollBack();
			}
			$this->lasterror = $e;
			return false;
		}
	}
	
	//Iniatilises a transaction that will handle multiple_queries if all are succesfull.
	public function startMultipleQueries(){
		$this->multiple_queries = true;
		$this->conn->beginTransaction();
	}
	
	//End a multiple query transaction
	public function endMultipleQueries(){
		$this->conn->commit();
	}
	
	//Binds parameters to values to prevent abuse of sql database
	protected function bindParameters($stmt, $parameters){
        if(isset($parameters)){
			foreach ($parameters as $parameter=>$value){
				$stmt->bindValue(':'.$parameter, $value);
			}
		}
	}
}
?>
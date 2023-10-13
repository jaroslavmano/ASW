<?php
class SQL{
	private $conn;
	private $host;
	private $dbname;
	private $user;
	private $password;
	public $QueryData;
	public $LastID;
	
	public function __construct($host, $dbname, $user, $password){
		$this->host = $host;
		$this->dbname = $dbname;
		$this->user = $user;
		$this->password = $password;
	}
	
	public function Connection(){
	try {
	  $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname",$this->user,$this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") );
	  // set the PDO error mode to exception
	  $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//mysqli_set_charset("UTF8",$this->conn);
	  return true;
	} catch(PDOException $e) {
	  echo "Connection failed: " . $e->getMessage();
	}

	}
	
	public function Query($query, $parms = null){
		$sqlQuery = $this->conn->prepare($query);
		
		// SET PARMS IF IS SET
		if(!empty($parms) && is_array($parms)){
			for($i = 0;$i < count($parms);$i++){
				$sqlQuery->bindParam($parms[$i]["code"],$parms[$i]["value"]);
			}
		}
		
		// CONTROLL USE
		if($sqlQuery->execute()){
			if(strtok($query, " ") == "SELECT"){
				$data = $sqlQuery->fetchAll();
				if(count($data) >= 1){
					$this->QueryData = $data;
					return true;
				} else{
					return false;
				}
			} elseif (strtok($query, " ") == "INSERT"){
				$this->LastID = $this->conn->lastInsertId();
				return true;
			}else{
				return true;
			}
		}else{
			global $log;
			$log->AddLogDB("MYSQL", "Nepovedlo se provedení query");
			return false;
		}
		
	}
	
}

?>
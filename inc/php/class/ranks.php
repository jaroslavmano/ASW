<?php
class Ranks{
	private $id;
	
	public function __construct($id = null){
		
		if(!empty($id)){
			$this->id = $id;
		}
		
	}
	
	public function Get(){
		global $db;
		
		$sqlSelect = $db->Query("SELECT * FROM ".constant("db_prefix")."ranks");
		
		if($sqlSelect){
			return $db->QueryData;
		} else {
			return false;
		}
	}
	
	public function Info(){
		global $db;
		
		$params = array(array("code"=>":id","value"=>$this->id));
		$sqlSelect = $db->Query("SELECT * FROM ".constant("db_prefix")."ranks WHERE Rank_ID = :id LIMIT 1",$params);


		if($sqlSelect){
			return $db->QueryData;
		} else {
			return false;
		}
	}
	public function Create($name,$short,$desc){
		global $db;
		
		$params = array(array("code"=>":name","value"=>$name),array("code"=>":desc","value"=>$desc),array("code"=>":short","value"=>$short));
		$sqlSelect = $db->Query("INSERT INTO ".constant("db_prefix")."ranks (Rank_Name, Rank_Description, Rank_Short) VALUES(:name, :desc, :short);",$params);
		
		if($sqlSelect){
			return $db->LastID;
		} else {
			return false;
		}
	}
	
	public function Update($name,$short,$desc){
		global $db;
		
		$params = array(array("code"=>":name","value"=>$name),array("code"=>":desc","value"=>$desc),array("code"=>":short","value"=>$short),array("code"=>":id","value"=>$this->id));
		$sqlSelect = $db->Query("UPDATE ".constant("db_prefix")."ranks SET Rank_Name=:name,Rank_Description=:desc,Rank_Short=:short WHERE Rank_ID = :id",$params);
		
		if($sqlSelect){
			return true;
		} else {
			return false;
		}
	}
	public function Users(){
		global $db;
		
		$params = array(array("code"=>":id","value"=>$this->id));
		$sqlSelect = $db->Query("SELECT * FROM ".constant("db_prefix")."users WHERE User_RankID = :id",$params);
		
		if($sqlSelect){
			return $db->QueryData;
		} else {
			return false;
		}
	}
	public function Remove(){
		global $db;
		
		$params = array(array("code"=>":id","value"=>$this->id));
		$sqlSelect = $db->Query("DELETE FROM ".constant("db_prefix")."ranks WHERE Rank_ID = :id",$params);
		
		if($sqlSelect){
			return true;
		} else {
			return false;
		}
	}
}

?>
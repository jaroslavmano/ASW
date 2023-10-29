<?php

// CLASS Tags

class Tags{
	private $id;
	
	public function __construct($id = null){
		if(!empty($id)){
			$this->id = $id;	
		}
	}
	
	public function GetTag(){
		global $db;
		
		$sqlSelect = $db->Query("SELECT * FROM ".constant("db_prefix")."module_tags");
		
		if($sqlSelect){
			return $db->QueryData;
		} else {
			return false;
		}
		
	}
	public function Info(){
		global $db;

		$params = array(array("code"=>":id","value"=>$this->id));
		$sqlSelect = $db->Query("SELECT * FROM ".constant("db_prefix")."module_tags WHERE Tag_ID = :id LIMIT 1",$params);


		if($sqlSelect){
			return $db->QueryData[0];
		} else {
			return false;
		}
		
	}
	public function UsersTags(){
		global $db;
		
		$sqlSelect = $db->Query("SELECT * FROM ".constant("db_prefix")."module_usertags");
		
		if($sqlSelect){
			return $db->QueryData;
		}
		
	}

	
	public function Create($name,$short, $color, $text, $discordID){
		global $db;
		
		$params = array(array("code"=>":name","value"=>$name),array("code"=>":short","value"=>$short),array("code"=>":color","value"=>$color),array("code"=>":text","value"=>$text),array("code"=>":discordID","value"=>$discordID));
		$sqlSelect = $db->Query("INSERT INTO ".constant("db_prefix")."module_tags (Tag_Name, Tag_Short, Tag_Color, Tag_TextColor,Tag_DiscordID) VALUES(:name, :short, :color, :text,:discordID);",$params);
		
		if($sqlSelect){
			return $db->LastID;
		} else {
			return false;
		}
	}
	
	public function Update($name,$short, $color,$text,$discordID){
		global $db;

        $params = array(
            array("code"=>":name","value"=>$name),
            array("code"=>":short","value"=>$short),
            array("code"=>":color","value"=>$color),
            array("code"=>":text","value"=>$text),
            array("code"=>":discordID","value"=>$discordID),
            array("code"=>":id","value"=>$this->id));
		$sqlSelect = $db->Query("UPDATE ".constant("db_prefix")."module_tags SET Tag_Name=:name,Tag_Short=:short,Tag_Color=:color, Tag_TextColor=:text, Tag_DiscordID=:discordID WHERE Tag_ID=:id",$params);
		
		if($sqlSelect){
			return true;
		} else {
			return false;
		}
	}

	public function Remove(){
		global $db;
		
		$params = array(array("code"=>":id","value"=>$this->id));
		$sqlSelect = $db->Query("DELETE FROM ".constant("db_prefix")."module_tags WHERE Tag_ID = :id",$params);
		
		if($sqlSelect){
			return true;
		} else {
			return false;
		}
	}
	
}


?>
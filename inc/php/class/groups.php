<?php

// CLASS GROUPS

class Groups{
	private $id;
	
	public function __construct($id = null){
		if(!empty($id)){
			$this->id = $id;	
		}
	}
	
	public function GetGroups(){
		global $db;
		
		$sqlSelect = $db->Query("SELECT * FROM ".constant("db_prefix")."groups");
		
		if($sqlSelect){
			return $db->QueryData;
		} else {
			return false;
		}
		
	}
	public function InfoGroup(){
		global $db;
		
		$params = array(array("code"=>":id","value"=>$this->id));
		$sqlSelect = $db->Query("SELECT * FROM ".constant("db_prefix")."groups WHERE Group_ID = :id LIMIT 1",$params);

		if($sqlSelect){
			return $db->QueryData;
		} else {
			return false;
		}
		
	}
	public function UsersGroup(){
		global $db;
		
		$sqlSelect = $db->Query("SELECT * FROM ".constant("db_prefix")."groups");
		
		if($sqlSelect){
			return $db->QueryData;
		}
		
	}
	public function PermissionGroup(){
		global $db;
		
		$sqlSelect = $db->Query("SELECT * FROM ".constant("db_prefix")."groups");
		
		if($sqlSelect){
			return $db->QueryData;
		}
		
	}
	public function GroupPermissions(){
		global $db;
		
		$params = array(array("code"=>":id","value"=>$this->id));
		$sqlSelect = $db->Query("SELECT Group_Permissions FROM ".constant("db_prefix")."groups WHERE Group_ID = :id LIMIT 1",$params);
		
		if($sqlSelect){
			//print_r($db->QueryData);
			$permissions = array();
			$groupPerm = new Permissions();
			$perms = $groupPerm->DecodeCodePremission($db->QueryData[0]["Group_Permissions"]);
			//print_r($perms);


            if(!empty($perms) && $perms[0] >= 0){
                foreach($perms as $perm){
                    $permData = $groupPerm->GetPermission($perm);
                    $permissions[] = $permData[0]["Permission_Index"];
                }
            }
			return $permissions;
		}
		
	}
	
	public function CreateGroup($name,$desc){
		global $db;
		
		$params = array(array("code"=>":name","value"=>$name),array("code"=>":desc","value"=>$desc));
		$sqlSelect = $db->Query("INSERT INTO ".constant("db_prefix")."groups (Group_Name, Group_Description) VALUES(:name, :desc);",$params);
		
		if($sqlSelect){
			return $db->LastID;
		} else {
			return false;
		}
	}
	
	public function UpdateGroup($name,$desc){
		global $db;
		
		$params = array(array("code"=>":name","value"=>$name),array("code"=>":desc","value"=>$desc),array("code"=>":id","value"=>$this->id));
		$sqlSelect = $db->Query("UPDATE ".constant("db_prefix")."groups SET Group_Name=:name,Group_Description=:desc WHERE Group_ID = :id",$params);
		
		if($sqlSelect){
			return true;
		} else {
			return false;
		}
	}
	public function UpdateGroupPermission($perm){
		global $db;
		
		$params = array(array("code"=>":perm","value"=>$perm),array("code"=>":id","value"=>$this->id));
		$sqlSelect = $db->Query("UPDATE ".constant("db_prefix")."groups SET Group_Permissions=:perm WHERE Group_ID = :id",$params);
		
		if($sqlSelect){
			return true;
		} else {
			return false;
		}
	}
	public function Remove(){
		global $db;
		
		$params = array(array("code"=>":id","value"=>$this->id));
		$sqlSelect = $db->Query("DELETE FROM ".constant("db_prefix")."groups WHERE Group_ID = :id",$params);
		
		if($sqlSelect){
			return true;
		} else {
			return false;
		}
	}
	
}


?>
<?php
class User{
	public $id;
	public $UserData;
	private $DiscordID;
	
	public function __construct($id = "", $discordID = ""){
		if(!empty($id)){
			$this->id = $id;
		}
		if(!empty($discordID)){
			$this->DiscordID = $discordID;
		}
		
	}
	
	public function GetUsers(){
		global $db;
		
		$sqlSelect = $db->Query("SELECT * FROM ".constant("db_prefix")."users");
		
		if($sqlSelect){
			return $db->QueryData;
		} else {
			return false;
		}
	}
	
	public function InfoUser(){
		global $db;
		if(!empty($this->id)){
			$params = array(array("code"=>":id","value"=>$this->id));
			$sqlSelect = $db->Query("SELECT * FROM ".constant("db_prefix")."users WHERE User_ID = :id LIMIT 1",$params);
		} elseif(!empty($this->DiscordID)){
			$params = array(array("code"=>":id","value"=>$this->DiscordID));
			$sqlSelect = $db->Query("SELECT * FROM ".constant("db_prefix")."users WHERE User_DiscordID = :id LIMIT 1",$params);
		} else {
            $sqlSelect = false;
        }

		if($sqlSelect){
			$this->id = $db->QueryData[0]["User_ID"];
			$this->UserData = $db->QueryData;
			return $db->QueryData;
		} else {
			return false;
		}
		
	}
	public function LastUserID(){
		global $db;
		$sqlSelect = $db->Query("SELECT User_ID FROM ".constant("db_prefix")."users ORDER BY User_ID DESC LIMIT 1");

		if($sqlSelect){
			return $db->QueryData[0]["User_ID"];
		} else {
			return false;
		}
		
	}
	public function UserGroups(){
		global $db;
		$params = array(array("code"=>":id","value"=>$this->id));
		$sqlSelect = $db->Query("SELECT UG_GroupID FROM ".constant("db_prefix")."usergroups WHERE UG_UserID = :id",$params);
		
		if($sqlSelect){
			$groups = array();
			//print_r($db->QueryData);
			foreach($db->QueryData as $group){
				$groups[] = $group["UG_GroupID"];
			}
			return $groups;
		} else {
			return false;
		}
	}

    public function UserTags(){
        global $db;
        $params = array(array("code"=>":id","value"=>$this->id));
        $sqlSelect = $db->Query("SELECT UT_TagID FROM ".constant("db_prefix")."module_usertags WHERE UT_UserID = :id",$params);

        if($sqlSelect){
            $tags = array();
            //print_r($db->QueryData);
            foreach($db->QueryData as $tag){
                $tags[] = $tag["UT_TagID"];
            }
            return $tags;
        } else {
            return false;
        }
    }
	public function CreateUser($name,$username, $bday, $userID){
		global $db;
		
		$params = array(array("code"=>":name","value"=>$name),array("code"=>":user","value"=>$username),array("code"=>":bday","value"=>strtotime($bday)),array("code"=>":id","value"=>$userID));
		$sqlSelect = $db->Query("INSERT INTO ".constant("db_prefix")."users (User_ID, User_Username, User_name, User_BirthDate) VALUES(:id , :user, :name, :bday);",$params);
		
		if($sqlSelect){
			return $db->LastID;
		} else {
			return false;
		}
	}
	public function UserUpdateBasic($name, $username, $bday, $display_bday = 0, $alergy = null){
		global $db;
		
		if($display_bday == "on"){
			$display_bday = 1;
		} else {
			$display_bday = 0;
		}

        if(empty($username)){
            $info = $this->InfoUser();
            $username = $info[0]["User_Username"];
        }
		
		$params = array(array("code"=>":name","value"=>$name),array("code"=>":user","value"=>$username),array("code"=>":dbday","value"=>$display_bday),array("code"=>":bday","value"=>strtotime($bday)),array("code"=>":alergy","value"=>$alergy),array("code"=>":id","value"=>$this->id));
		$sqlSelect = $db->Query("UPDATE ".constant("db_prefix")."users SET User_Name=:name,User_Username=:user,User_DisplayBDay=:dbday, User_BirthDate=:bday,User_Allergies= :alergy WHERE User_ID = :id",$params);
		
		if($sqlSelect){
			return true;
		} else {
			return false;
		}
	}
	public function UserUpdateContact($phone, $mail, $adress, $discord){
		global $db;

        if(empty($discord)){
            $info = $this->InfoUser();
            $discord = $info[0]["User_DiscordID"];
        }
		
		$params = array(array("code"=>":phone","value"=>$phone),array("code"=>":mail","value"=>$mail),array("code"=>":adress","value"=>$adress),array("code"=>":discord","value"=>$discord),array("code"=>":id","value"=>$this->id));
		$sqlSelect = $db->Query("UPDATE ".constant("db_prefix")."users SET User_Phone=:phone,User_Mail=:mail,User_Adress=:adress,User_DiscordID= :discord WHERE User_ID = :id",$params);
		
		if($sqlSelect){
			return true;
		} else {
			return false;
		}
	}
	public function UserUpdateGame($rank, $guns){
		global $db;

        if(empty($rank)){
            $info = $this->InfoUser();
            $rank = $info[0]["User_RankID"];
        }

		$params = array(array("code"=>":rank","value"=>$rank), array("code"=>":guns","value"=>$guns), array("code"=>":id","value"=>$this->id));
		$sqlSelect = $db->Query("UPDATE ".constant("db_prefix")."users SET User_RankID=:rank,User_Guns=:guns WHERE User_ID = :id",$params);
		
		if($sqlSelect){
			return true;
		} else {
			return false;
		}
	}
	public function UserUpdateGroups($groups){
		global $db;
		$return = 0;
		$params = array(array("code"=>":id","value"=>$this->id));
		$sqlSelect = $db->Query("DELETE FROM ".constant("db_prefix")."usergroups WHERE UG_UserID = :id",$params);
		
		if($sqlSelect){
				foreach($groups as $group){
					$params = array(array("code"=>":userID","value"=>$this->id),array("code"=>":groupID","value"=>$group));
					$sqlSelect = $db->Query("INSERT INTO ".constant("db_prefix")."usergroups (UG_UserID, UG_GroupID) VALUES (:userID,:groupID)",$params);
					if(!$sqlSelect){
						$return++;
					}
				}
			if($return == 0){
				return true;
			} else{
				return false;
			}
		} else {
			return false;
		}
	}
    public function UserUpdateTags($tags){
        global $db;
        $return = 0;
        $params = array(array("code"=>":id","value"=>$this->id));
        $sqlSelect = $db->Query("DELETE FROM ".constant("db_prefix")."module_usertags WHERE UT_UserID = :id",$params);

        if($sqlSelect){
            foreach($tags as $tag){
                $params = array(array("code"=>":userID","value"=>$this->id),array("code"=>":tagID","value"=>$tag));
                $sqlSelect = $db->Query("INSERT INTO ".constant("db_prefix")."module_usertags (UT_UserID, UT_TagID) VALUES (:userID,:tagID)",$params);
                if(!$sqlSelect){
                    $return++;
                }
            }
            if($return == 0){
                return true;
            } else{
                return false;
            }
        } else {
            return false;
        }
    }
	public function UserUpdatePicture($picture){
		global $db;
		
		$info = $this->InfoUser();
		if(isset($info[0]["User_Picture"])){
			unlink($_SERVER["DOCUMENT_ROOT"]."/thonet/data/users/".$info[0]["User_Picture"]);
		}
		
		$params = array(array("code"=>":picture","value"=>$picture),array("code"=>":id","value"=>$this->id));
		$sqlSelect = $db->Query("UPDATE ".constant("db_prefix")."users SET User_Picture=:picture WHERE User_ID = :id",$params);
		
		if($sqlSelect){
			return true;
		} else {
			return false;
		}
	}
	
	public function Remove(){
		global $db;
		
		$params = array(array("code"=>":id","value"=>$this->id));
		$sqlSelect = $db->Query("DELETE FROM ".constant("db_prefix")."users WHERE User_ID = :id",$params);
		
		if($sqlSelect){
			return true;
		} else {
			return false;
		}
	}
	
}

?>
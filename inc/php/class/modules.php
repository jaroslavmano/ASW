<?php

class Module{
	
	public function __constructor(){
		
	}

    public function VerifyModule($moduleShort){
        global $db;

        $params = array(array("code"=>":module","value"=>$moduleShort));
        $sqlSelect = $db->Query("SELECT Module_Active FROM ".constant("db_prefix")."module WHERE Module_Short = :module",$params);

        if($sqlSelect){
            return $db->QueryData[0][0];
        } else {
            return false;
        }
    }
	public function GetModules(){
		global $db;
		
		$sqlSelect = $db->Query("SELECT * FROM ".constant("db_prefix")."module WHERE Module_Active > 0");

		if($sqlSelect){
			return $db->QueryData;
		} else {
			return false;
		}
	}
}

?>
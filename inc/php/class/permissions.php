<?php
class Permissions{
	
	private $module;
	
	public function __construct($module = null){
		if(isset($module)){
			$this->module = $module;	
		}
	}
	function GetMainPermissions(){
		global $db;

		$params = array(array("code"=>":module","value"=>$this->module));
		$sqlSelect = $db->Query("SELECT * FROM ".constant("db_prefix")."permission WHERE ISNULL(Permission_Required) AND Permission_Module = :module",$params);

		if($sqlSelect){
			return $db->QueryData;
		} else {
			return false;
		}
	}
	
	function GetSubPerrmisions($idPerm){
		global $db;

		$params = array(array("code"=>":IDperm","value"=>$idPerm),array("code"=>":module","value"=>$this->module));
		$sqlSelect = $db->Query("SELECT * FROM ".constant("db_prefix")."permission WHERE Permission_Required = :IDperm AND Permission_Module = :module",$params);

		if($sqlSelect){
			return $db->QueryData;
		} else {
			return false;
		}
	}
	function GetPermission($id){
		global $db;

		$params = array(array("code"=>":id","value"=>$id));
		$sqlSelect = $db->Query("SELECT * FROM ".constant("db_prefix")."permission WHERE Permission_ID = :id",$params);

		if($sqlSelect){
			//print_r($db->QueryData);
			return $db->QueryData;
		} else {
			return false;
		}
	}
	function GetPermissionCode($idPerm){
		$code = 0;
		
		foreach($idPerm as $id){
			$code += pow(2,$id);
		}
		return $code;
	}
	function DecodeCodePremission($permissions){
    global $db;
    $idsPermissions = array();

    $sqlSelect = $db->Query("SELECT Permission_ID FROM ".constant("db_prefix")."permission ORDER BY Permission_ID DESC LIMIT 1");
    $select = $db->QueryData;
    $currentIndex = $select[0]["Permission_ID"];
    do{
        $num = pow(2,$currentIndex);
        if($permissions > $num){
            $idsPermissions[] = $currentIndex;
            $permissions -= $num;
            $currentIndex--;
            $again =true;
        } elseif ($num == $permissions){
            $idsPermissions[] = $currentIndex;
            $again = false;
        } else {
            $currentIndex--;
            $again = true;
        }

    }while($again);
    return $idsPermissions;
}
}


?>
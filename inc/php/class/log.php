<?php

class Log{
	
	public function __conctructor(){}
	
	public function AddLogDB($id,$msg = null){
		//INSERT INTO `thonet_log` (`ID`, `Log_ID`, `Log_Time`) VALUES (NULL, 't', '344');
		global $db;
		
		$test = array(array("code"=>":id","value"=>$id),array("code"=>":date","value"=>strtotime(date("now"))),array("code"=>":msg","value"=>$msg));
		
		$sqlSelect = $db->Query("INSERT INTO ".constant("db_prefix")."log (Log_ID, Log_Time,Log_Descript) VALUES (:id, :date, :msg);",$test);
		
	}
	public function AddDebugDB($msg){
		//INSERT INTO `thonet_log` (`ID`, `Log_ID`, `Log_Time`) VALUES (NULL, 't', '344');
		global $db;
		
		$test = array(array("code"=>":id","value"=>"DEBUG"), array("code"=>":date","value"=>strtotime("now")), array("code"=>":msg","value"=>$msg));
		
		$sqlSelect = $db->Query("INSERT INTO ".constant("db_prefix")."log (Log_ID, Log_Time,Log_Descript) VALUES (:id, :date, :msg);",$test);
		
	}
}
?>
<?php
class system_class{

	public $SystemSettings = array();
	public $Menu = array();
	public $LastID;
	private $db;
	
	public function __cunstruct(){
		
	}
	
	// SET SYSTEM SETTING
	public function GetSettings(){
		global $db;
		
		$sqlSelect = $db->Query("SELECT * FROM ".constant("db_prefix")."system");
		
		if($sqlSelect !== false){
			foreach($db->QueryData as $data){
				$this->SystemSettings[$data["System_ID"]] = $data["System_Value"];
			}
		} else {
			echo "Nepovedlo se načíst data GetSettings"; 
		}
		
	}
	public function UpdateSettings($data, $files){
		global $db;
		$updateData;
		//$params = array();
		$return = array();
		$sql;
		
		foreach($data as $key=>$value)
		{
			if($this->SystemSettings[$key] != $value){
				$sqlSelect = $db->Query("UPDATE ".constant("db_prefix")."system SET System_Value= '".$value."' WHERE System_ID = '".$key."'");

				if($sqlSelect !== true){
					$return[$key] = false;
				}
			}
		}
		foreach($files as $key=>$value)
		{
			if($value["error"] == 0){
				$File_Name = basename($_FILES[$key]["name"]);
				$File_Check = getimagesize($_FILES[$key]["tmp_name"]);
				$File_Size = $_FILES[$key]["size"];
				$File_Temp = $_FILES[$key]["tmp_name"];
				$target_dir = "/inc/data/system/";

				$returnPicture = ControlFile($File_Name, $File_Check, $target_dir, $File_Size, $File_Temp);
				
				if($returnPicture === true){
					if(isset($this->SystemSettings[$key])){
						unlink("./".$this->SystemSettings[$key]);
					}
					$sqlSelect = $db->Query("UPDATE ".constant("db_prefix")."system SET System_Value= '".$target_dir.$File_Name."' WHERE System_ID = '".$key."'");

					if($sqlSelect !== true){
						$return[$key] = false;
					}
				} else {
					foreach($returnPicture as $returndata){
						$_SESSION["msg"] .= $returndata;
					}
				}
				
			}
			
		}
		//$sqlSelect = $db->Query("UPDATE ".constant("db_prefix")."system SET System_Value = :$key WHERE System_ID = :".$key."ID",$params);
		
		if(empty($return)){
			$this->GetSettings();
			return true;
		} else {
			print_r($return);
			return false;
		}
		
		print_r($files);
		
	}
	
	// GET SETTINGS SYSTEM
	public function GetByModule($module = "GEN"){
		global $db;
		
		$params = array(array("code"=>":module","value"=>$module));
		$sqlSelect = $db->Query("SELECT * FROM ".constant("db_prefix")."system WHERE System_Module =:module",$params);
		
		if($sqlSelect !== false){
			return $db->QueryData;
		} else {
			echo "Nepovedlo se načíst data GetSettings"; 
		}
		
	}
	
	public function GetMenu(){
		if(isset($this->SystemSettings["link_text_1"]) && $this->SystemSettings["link_href_1"]) {$this->Menu[] = array($this->SystemSettings["link_text_1"],$this->SystemSettings["link_href_1"]);}
		if(isset($this->SystemSettings["link_text_2"]) && $this->SystemSettings["link_href_2"]) {$this->Menu[] = array($this->SystemSettings["link_text_2"],$this->SystemSettings["link_href_2"]);}
		if(isset($this->SystemSettings["link_text_2"]) && $this->SystemSettings["link_href_3"]) {$this->Menu[] = array($this->SystemSettings["link_text_3"],$this->SystemSettings["link_href_3"]);}
		if(isset($this->SystemSettings["link_text_2"]) && $this->SystemSettings["link_href_4"]) {$this->Menu[] = array($this->SystemSettings["link_text_4"],$this->SystemSettings["link_href_4"]);}
	
	}
	public function GetMessage($idMessage){
		global $db;
		
		$params = array(array("code"=>":id","value"=>$idMessage));
		$sqlSelect = $db->Query("SELECT * FROM ".constant("db_prefix")."messages WHERE Message_ID = :id LIMIT 1",$params);
		
		
		if($sqlSelect){
			switch($db->QueryData[0]["Message_Type"]){
				case 1:
					$color = "gray-800";
					$type = "OZNÁMENÍ";
					break;
				case 2:
					$color = "red-500";
					$type = "NASTALA CHYBA!";
					break;
				case 3:
					$color = "green-500";
					$type = "ÚSPĚŠNĚ!";
					break;
				default:
					$color = "yellow-800";
					$type = "NEZNÁMÝ STAV!";
					break;
			}
			return '		
				<div class="p-4 mb-4 mt-4 text-sm text-'.$color.' border-2 border-'.$color.' rounded-lg bg-red-50 dark:bg-gray-800 container mx-auto" role="alert">
  			<span class="font-medium">'.$type.'</span> '.$db->QueryData[0]["Message_Description"].' (ID: '.$db->QueryData[0]["Message_ID"].')
		</div>';
		} else {
			return '		
				<div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 container mx-auto" role="alert">
  			<span class="font-medium">Nepodařilo se načíst hlášku!</span> Kontaktujte prosím vývojáře.
		</div>';
		}
	}
	
	
}

?>
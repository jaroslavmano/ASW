<?php

// NASTAVOVÁNÍ STRÁNEK
function IncludePage($page = null, $module = false, $save=false) {
	global $system;
    global $modules;
	global $log;
	global $loginUser;
	global $LoginPermission;
	global $nowPath;
	
    $page = preg_replace("[^a-z0-9]", "", $page);

    if($save){
        $include = "./inc/php/save/$page.php";
    }else{
        $include = "./inc/php/pages/$page.php";
    }
	
    if (file_exists($include)){
			include($include);
    } else {
        echo "<h1>Error 404. Stránka neexistuje.</h1>";
    }
}
function AddMsg($MessageID){
	global $system;
			if(empty($_SESSION["msg"])){
				$_SESSION["msg"] = $system->GetMessage($MessageID);
			}else {
				$_SESSION["msg"] .= $system->GetMessage($MessageID);
			}
}
function ControlFile($fileName, $fileCheck, $filePath, $fileSize, $File_Temp){
	global $system;
	global $log;
	global $loginUser;
	global $LoginPermission;
	global $nowPath;
	
		$ControlUpload = 1;
		$target_file = $nowPath. $filePath  .  $fileName;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		$errMSG = array();


		// Check if file already exists
		if (file_exists($target_file)) {
			AddMsg("SY207");
		  	$ControlUpload = 0;
		}

		// Check file size
			//31457280 = 30 MB
			//20971520 = 20 MB
		if ($fileSize > 31457280) {
			AddMsg("SY208");
			$ControlUpload = 0;
		}

		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif"&& $imageFileType != "mp4" && $imageFileType != "mov" && $imageFileType != "wav") {
			AddMsg("SY209");
			$ControlUpload = 0;
		}

		if (!$ControlUpload == 0) {
		  if (move_uploaded_file($File_Temp, $target_file)) {
			  return true;
		  } else {
			  AddMsg("SY210");
		  }
		}
		
	}

?>
<?php

if(!empty($_GET["type"])){
	switch ($_GET["type"]){
			
		case "user":
			if(in_array("users_remove",$LoginPermission)){
				if($_GET["id"] == $loginUser->UserData[0]["User_ID"]){
					$_SESSION["msg"] = $system->GetMessage("US202");
				}else {
					$user = new User($_GET["id"]);
					if($user->Remove()){
						$_SESSION["msg"] = $system->GetMessage("US005");
					} else {
						$_SESSION["msg"] = $system->GetMessage("US201");
					}
				}
			}
			echo'<meta http-equiv="refresh" content="0;url=?page=users"> ';
			break;
		case "group":
			if(in_array("groups_remove",$LoginPermission)){
				$groups = new Groups($_GET["id"]);
				if(count($groups->GetGroups()) <= 1){
					$_SESSION["msg"] = $system->GetMessage("SG207");
				}else {
					
					if($groups->Remove()){
						$_SESSION["msg"] = $system->GetMessage("SG004");
					} else {
						$_SESSION["msg"] = $system->GetMessage("SG206");
					}
				}
			}
			echo'<meta http-equiv="refresh" content="0;url=?page=groups"> ';
			break;
		case "rank":
			if(in_array("ranks_remove",$LoginPermission)){
				$r = new Ranks($_GET["id"]);
				if($r->Remove()){
					$_SESSION["msg"] = $system->GetMessage("RA003");
				} else {
					$_SESSION["msg"] = $system->GetMessage("RA203");
				}
			}
			echo'<meta http-equiv="refresh" content="0;url=?page=ranks"> ';
			break;
	}
} else {
	echo'<meta http-equiv="refresh" content="0;url=?page=main"> ';
}


?>
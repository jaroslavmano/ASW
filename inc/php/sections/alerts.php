	<?
	if(isset($_SESSION["msg"]) && empty($_POST)){
		if(is_array($_SESSION["msg"])){
			foreach($_SESSION["msg"] as $msg){
				echo $_SESSION["msg"];
			}
		} else {
			echo $_SESSION["msg"];
		}
		unset($_SESSION["msg"]);
	}
	?>
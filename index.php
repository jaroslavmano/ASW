<?php require("./config/init.php"); ?>
<?php
if(isset($_GET["discordID"]) || isset($_SESSION["ID"])){
	if(isset($_GET["discordID"])){
		$loginUser = new User('',$_GET["discordID"]);
		if($loginUser->InfoUser() == false){
            echo "Neplatné";
			//echo '<meta http-equiv="refresh" content="0;url=login.php">';
		}
		$_SESSION["ID"] = $loginUser->id; 
	}
	$LoginPermission = array();
	$loginUser = new User($_SESSION["ID"]);
	$loginUser->InfoUser(); 
	$groups = $loginUser->UserGroups();
	if(is_array($groups)){
		foreach($groups as $group){
			$groupClass = new Groups($group);
			$LoginPermission = array_unique(array_merge($LoginPermission, $groupClass->GroupPermissions()));	
		}
	}else if (!empty($groups)){
		$groupClass = new Groups($groups);
		$LoginPermission = array_unique(array_merge($LoginPermission, $groupClass->GroupPermissions()));	
	}
} else {
	echo '<meta http-equiv="refresh" content="0;url=login.php">';
}
?>
<!doctype html>
<html>
<head>
	<title><?=$system->SystemSettings["system_name"]?></title>
	<meta name="author" content="Jaroslav Maňo">
  	<meta charset="UTF-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://cdn.tailwindcss.com"></script>
	  <script>
		tailwind.config = {
		  theme: {
			extend: {
			  colors: {
				clifford: '#da373d',
			  }
			}
		  }
		}
	  </script>
	<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
	<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        .hodnoceni {
            display: block;
        }

        .hodnoceni input {
            display: none;
        }

        .hodnoceni label {
            font-size: 50px;
            cursor: pointer;
            color: <?=$system->SystemSettings["star_color"]?>;
        }

        .hodnoceni label:before {
            content: "\2606"; /* Plná hvězda */
        }

        .hodnoceni input:checked ~ label:before {
            content: "\2605"; /* Prázdná hvězda */

        }
        .custom-radio {
            display: inline-block;
            cursor: pointer;

            position: relative;
            padding-left: 30px;
            margin-right: 10px;
        }

        .custom-radio input {
            display: none;
        }

        .custom-radio label {
            position: absolute;
            top: 0;
            left: 0;
            width: 25px;
            height: 25px;
            border: 2px solid #000;
            border-radius: 50%;
            background-color: <?=$system->SystemSettings["radio_check"]?>;
            cursor: pointer;
        }

        .custom-radio input:checked + label::after {
            content: "\2713";
            display: block;
            text-align: center;
            line-height: 25px;
            font-size: 18px;
        }
    </style>
</head>
<body class="bg-[<?=$system->SystemSettings["bg_page"]?>] font-mono ">

	<?php
    include("./inc/php/sections/header.php");
	if(isset($_SESSION["msg"])){
		echo $_SESSION["msg"];
		unset($_SESSION["msg"]);
	}

		$module = '';
		if(isset( $_GET["module"])){$module =  $_GET["module"];}
		if(isset($_GET["save"])){
			IncludePage($_GET["save"], $module, true);
		}else if(isset($_GET["page"])){
			IncludePage($_GET["page"], $module);
		} else {
			IncludePage("main");
		}
	?>
	<?php include("./inc/php/sections/footer.php");?>
</body>
</html>

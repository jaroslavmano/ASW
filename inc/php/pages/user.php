<?php
	if(!in_array("users_createedit",$LoginPermission) && (isset($_GET["id"]) && ($_GET["id"] != $loginUser->id))){
		if(isset($_GET["status"])){

			echo'<meta http-equiv="refresh" content="0;url=?page=users"> ';
		} else {
			echo'<meta http-equiv="refresh" content="0;url=?page=main"> ';
		}
	} 
	if(!isset($_GET["id"]) && !in_array("users_createedit",$LoginPermission)){
		if(isset($_GET["status"])){
			echo'<meta http-equiv="refresh" content="0;url=?page=users"> ';
		} else {
			echo'<meta http-equiv="refresh" content="0;url=?page=main"> ';
		}
	}
    if(isset($_GET["id"])){
        $users = new User($_GET["id"]);
    } else {
        $users = new User();

    }
if(isset($_POST["SaveInfoUser"])){
	if(isset($_GET["id"])){
		$result = $users->UserUpdateBasic($_POST["name"], (isset($_POST["username"])?$_POST["username"]:""), $_POST["date"],isset($_POST["display_bday"]),$_POST["alergy"]);
		if($result === true){
			AddMsg("US002");
			unset($_POST);
		} else {
			AddMsg("US203");
		}
	} else {
		$result = $users->CreateUser($_POST["name"], $_POST["username"], $_POST["date"], $_POST["id"]);
		
		if(isset($result) && $result !== false){
			$_SESSION["msg"] .= $system->GetMessage("US001");
			echo'<meta http-equiv="refresh" content="0;url=?page=user&status=edit&id='.$_POST["id"].'&msg=1"> ';
			//header("Refresh:0; url=?page=group&id=".$result);
		} else {
			AddMsg("US204");
		}
	}
}
	if(isset($_POST["SaveContactUser"])){
		$result = $users->UserUpdateContact($_POST["phone"], $_POST["mail"], $_POST["adress"], (isset($_POST["discord"])?$_POST["discord"]:""));
		if($result === true){
			AddMsg("US003");
			unset($_POST);
		} else {
			AddMsg("US205");
		}
	}
	if(isset($_POST["SaveGameUser"])){
		$result = $users->UserUpdateGame((isset($_POST["rank"])?$_POST["rank"]:""), (isset($_POST["guns"])?$_POST["guns"]:""));
		if($result === true){
			AddMsg("US004");
			unset($_POST);
		} else {
			AddMsg("US206");
		}
	}
	if(isset($_POST["SavePictureUser"])){
		$File_Name = basename($_FILES["File"]["name"]);
		$File_Check = getimagesize($_FILES["File"]["tmp_name"]);
		$File_Size = $_FILES["File"]["size"];
		$File_Temp = $_FILES["File"]["tmp_name"];

        $target_dir = "inc/data/users/";


        $type = strtolower(pathinfo($File_Name,PATHINFO_EXTENSION));
        $fileNewName = tempnam("", 'userPhoto_');
        $File_New = str_replace("/tmp/","",$fileNewName).".$type";

		$returnPicture = ControlFile($File_New, $File_Check, $target_dir, $File_Size, $File_Temp);
		
		if($returnPicture === true){
			$result = $users->UserUpdatePicture($File_New);
			if($result === true){
				AddMsg("US006");
				unset($_POST);
			} else {
				AddMsg("US207");
			}
		}
	}
	if(isset($_POST["SaveGroupsUser"])){
		unset($_POST["SaveGroupsUser"]);
		$result = $users->UserUpdateGroups($_POST["groups"]);
		if($result === true){
			$_SESSION["msg"] = $system->GetMessage("US007");
			unset($_POST);
		} else {
			echo $system->GetMessage("US208");
		}
	}
    if(isset($_POST["SaveTagsUser"])){
        unset($_POST["SaveTagsUser"]);
        $result = $users->UserUpdateTags($_POST["tags"]);
        if($result === true){
            $_SESSION["msg"] = $system->GetMessage("US008");
            unset($_POST);
        } else {
            echo $system->GetMessage("US209");
        }
    }
$UserInfo = $users->InfoUser();
if($UserInfo === false && isset($_GET["id"])){
	echo'<meta http-equiv="refresh" content="0;url=?page=users"> ';
}
if(isset($_GET["status"])){
	$statusPage = "Správa uživatele";
	$bckLink = "?page=users";
} else {
	$statusPage = "Úprava účtu";
	$bckLink = "?page=profile";
}
if(isset($_GET["id"])){
	$type =1;
	$title = $statusPage." | ".$UserInfo[0]["User_Name"];
} else {
	$type =0;
	$title = "Vytvoření uživatele";
}
if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
   $click = "CTRL";
} else {
    $click = "COMMAND";
}
?>
<?php // History menu ?>
<div class="w-max text-left">
  <nav aria-label="breadcrumb">
    <ol class="flex w-full flex-wrap items-center rounded-md bg-opacity-60 py-2 px-4">
      <li class="flex cursor-pointer items-center font-sans text-sm font-normal leading-normal text-[<?=$system->SystemSettings["map_color"]?>] antialiased transition-colors duration-300 hover:text-[<?=$system->SystemSettings["map_color:hover"]?>]">
        <a class="opacity-60" href="/">
          <span><?=$system->SystemSettings["system_name"]?></span>
        </a>
        <span class="pointer-events-none mx-2 select-none font-sans text-sm font-normal leading-normal text-zinc-400 antialiased">
          /
        </span>
      </li>
      <li class="flex cursor-pointer items-center font-sans text-sm font-normal leading-normal text-[<?=$system->SystemSettings["map_color"]?>] antialiased transition-colors duration-300 hover:text-[<?=$system->SystemSettings["map_color:hover"]?>]">
        <a class="opacity-60" href="?page=main">
          <span><?=constant("HOME PAGE");?></span>
        </a>
        <span class="pointer-events-none mx-2 select-none font-sans text-sm font-normal leading-normal text-zinc-400 antialiased">
          /
        </span>
      </li>
		<?php
		if(isset($_GET["status"])){
		?>
      <li class="flex cursor-pointer items-center font-sans text-sm font-normal leading-normal text-[<?=$system->SystemSettings["map_color"]?>] antialiased transition-colors duration-300 hover:text-[<?=$system->SystemSettings["map_color:hover"]?>]">
        <a class="opacity-60" href="?page=users">
          Správa uživatelů
        </a>
        <span class="pointer-events-none mx-2 select-none font-sans text-sm font-normal leading-normal text-zinc-400 antialiased">
          /
        </span>
      </li>
		<?php
		} else {
		?>
      <li class="flex cursor-pointer items-center font-sans text-sm font-normal leading-normal text-[<?=$system->SystemSettings["map_color"]?>] antialiased transition-colors duration-300 hover:text-[<?=$system->SystemSettings["map_color:hover"]?>]">
        <a class="opacity-60" href="?page=profile">
          Profil
        </a>
        <span class="pointer-events-none mx-2 select-none font-sans text-sm font-normal leading-normal text-zinc-400 antialiased">
          /
        </span>
      </li>
		<?php
		}
		?>
      <li class="flex cursor-pointer items-center font-sans text-sm font-normal leading-normal text-[<?=$system->SystemSettings["map_color:active"]?>] antialiased transition-colors duration-300 hover:text-[<?=$system->SystemSettings["map_color:hover"]?>]">
        <a class="font-medium transition-colors" href="">
          <?=$title?>
        </a>
      </li>
    </ol>
  </nav>
</div>

<h1 class="text-center text-4xl text-[<?=$system->SystemSettings["color_2"]?>] font-bold mt-6 mb-6"><?=$title?></h1>
<hr class="w-[10%] mx-auto ">
<div class="text-center p-4">
<a href="<?=$bckLink?>" class="text-[<?=$system->SystemSettings["link_color"]?>] hover:text-[<?=$system->SystemSettings["link_color:hover"]?>]"><ion-icon name="chevron-back" class="inline-block align-middle text-xl"></ion-icon> <?=constant("BACK");?></a>
	<?php
	if(isset($_SESSION["msg"]) && empty($_POST)){
		echo $_SESSION["msg"];
		unset($_SESSION["msg"]);
	}
	?>
</div>

<?php
if($type == 0){
	echo '<div class="container mx-auto">';
} else {
	echo '<div class="md:grid md:grid-cols-2 md:gap-1 container mx-auto">';
}
?>
	<div class=" container mx-auto px-4 py-5 ">
		<form method="post" action="">
			<h1 class="text-xl text-[<?=$system->SystemSettings["color_2"]?>] font-bold">Obecné informace</h1>
			<div class="pl-3 space-y-4">
				<?php
				if(in_array("users_createedit",$LoginPermission)){
				?>
				<div class="grid grid-cols-1 gap-6">
					<div class="col-span-3 sm:col-span-2">
						<label for="username" class="block text-sm font-medium text-[<?=$system->SystemSettings["color_1"]?>]">ID:</label>
						<div class="mt-1 flex rounded-md shadow-sm">
							<input type="number" name="id" maxlength="10" class="block w-full flex-1 rounded-md text-[<?=$system->SystemSettings["input_color"]?>] bg-[<?=$system->SystemSettings["input_bg"]?>] p-2 sm:text-sm" placeholder="<?=$users->LastUserID()+1;?>" <?=($type == 1)?"value='".$UserInfo[0]["User_ID"]."' disabled":"" ?> required />
						</div>
					</div>
				</div>
				<?php
				}
				?>
				<div class="grid grid-cols-1 gap-6">
					<div class="col-span-3 sm:col-span-2">
						<label for="name" class="block text-sm font-medium text-[<?=$system->SystemSettings["color_1"]?>]">JMÉNO A PŘIJMENÍ:</label>
						<div class="mt-1 flex rounded-md shadow-sm">
							<input type="text" name="name" maxlength="30" class="block w-full flex-1 rounded-md text-[<?=$system->SystemSettings["input_color"]?>] bg-[<?=$system->SystemSettings["input_bg"]?>] p-2 sm:text-sm" placeholder="Jméno Přijmení" <?=($type == 1)?"value='".$UserInfo[0]["User_Name"]."'":""?> required />
						</div>
					</div>
				</div>
				<?php
				if(in_array("users_createedit",$LoginPermission)){
				?>
				<div class="grid grid-cols-1 gap-6">
					<div class="col-span-3 sm:col-span-2">
						<label for="username" class="block text-sm font-medium text-[<?=$system->SystemSettings["color_1"]?>]">Přezdívka:</label>
						<div class="mt-1 flex rounded-md shadow-sm">
							<input type="text" name="username" maxlength="10" class="block w-full flex-1 rounded-md text-[<?=$system->SystemSettings["input_color"]?>] bg-[<?=$system->SystemSettings["input_bg"]?>] p-2 sm:text-sm" placeholder="Přezdívka" <?=($type == 1)? "value='".$UserInfo[0]["User_Username"]."'":""?> required />
						</div>
					</div>
				</div>
				<?php
				}
				?>
				<div class="grid grid-cols-1 gap-6">
					<div class="col-span-3 sm:col-span-2">
						<label for="date" class="block text-sm font-medium text-[<?=$system->SystemSettings["color_1"]?>]">Datum narození:</label>
						<div class="mt-1 flex rounded-md shadow-sm">
							<input type="date" name="date" maxlength="10" class="block w-full flex-1 rounded-md text-[<?=$system->SystemSettings["input_color"]?>] bg-[<?=$system->SystemSettings["input_bg"]?>] p-2 sm:text-sm"  <?=($type == 1)?"value='".date("Y-m-d",$UserInfo[0]["User_BirthDate"])."'":"" ?> required />
						</div>
					</div>
				</div>
				<?php
				if($type == 1){
				?>
				<div class="flex items-center mb-2">
					<input name="display_bday" id="display_bday" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" <?=($UserInfo[0]["User_DisplayBDay"] == 1)? "checked":"" ?> />
					<label for="display_bday" class="ml-2 text-sm font-medium text-[<?=$system->SystemSettings["color_3"]?>]">
						Zobrazení datumu narození ostatním.
					</label>
            	</div>
				<div class="grid grid-cols-1 gap-6">
					<div class="col-span-3 sm:col-span-2">
						<label for="alergy" class="block text-sm font-medium text-[<?=$system->SystemSettings["color_1"]?>]">Alergie:</label>
						<div class="mt-1 flex rounded-md shadow-sm">
							<textarea id="alergy" name="alergy" rows="3" class="block w-full flex-1 rounded-md text-[<?=$system->SystemSettings["input_color"]?>] bg-[<?=$system->SystemSettings["input_bg"]?>] p-2 sm:text-sm" /><?=($type == 1)?$UserInfo[0]["User_Allergies"]:""?></textarea>
						</div>
					</div>
				</div>
				<?php } ?>
            </div>
			<div class="px-4 py-3 text-right sm:px-6">
				<button type="submit" name="SaveInfoUser" class="justify-center rounded-md border border-transparent py-2 px-4 text-sm font-medium shadow-sm bg-[<?=$system->SystemSettings["button_bg"]?>]  text-[<?=$system->SystemSettings["button_color"]?>] align-middle inline-block rounded-md p-3 hover:text-[<?=$system->SystemSettings["button_color:hover"]?>] hover:bg-[<?=$system->SystemSettings["button_bg:hover"]?>] hover:cursor-pointer"><ion-icon name="save" class="inline-block align-middle"></ion-icon>  <?=constant("SAVE");?></button>
	 		</div>
		</form>
	</div>

	<?php
	if($type == 1){
	?>
	<div class="space-y-6 container mx-auto px-4 py-5 ">
		<form method="post" action="">
			<h1 class="text-xl text-[<?=$system->SystemSettings["color_2"]?>] font-bold">Kontaktní Informace:</h1>
			<div class="pl-3 space-y-4">
				<div class="grid grid-cols-1 gap-6">
					<div class="col-span-3 sm:col-span-2">
						<label for="phone" class="block text-sm font-medium text-white">Telefon:</label>
						<div class="mt-1 flex rounded-md shadow-sm">
							<input type="tel" name="phone" maxlength="15" class="block w-full flex-1 rounded-md text-[<?=$system->SystemSettings["input_color"]?>] bg-[<?=$system->SystemSettings["input_bg"]?>] p-2 sm:text-sm" placeholder="Admin" <?=($type == 1)?"value='".$UserInfo[0]["User_Phone"]."'":"" ?> required />
						</div>
					</div>
				</div>
				<div class="grid grid-cols-1 gap-6">
					<div class="col-span-3 sm:col-span-2">
						<label for="mail" class="block text-sm font-medium text-white">E-mail:</label>
						<div class="mt-1 flex rounded-md shadow-sm">
							<input type="mail" name="mail" maxlength="50" class="block w-full flex-1 rounded-md text-[<?=$system->SystemSettings["input_color"]?>] bg-[<?=$system->SystemSettings["input_bg"]?>] p-2 sm:text-sm" placeholder="Admin" <?=($type == 1)?"value='".$UserInfo[0]["User_Mail"]."'":"" ?> required />
						</div>
					</div>
				</div>
				<div class="grid grid-cols-1 gap-6">
					<div class="col-span-3 sm:col-span-2">
						<label for="adress" class="block text-sm font-medium text-white">Adresa:</label>
						<div class="mt-1 flex rounded-md shadow-sm">
							<input type="mail" name="adress" maxlength="50" class="block w-full flex-1 rounded-md text-[<?=$system->SystemSettings["input_color"]?>] bg-[<?=$system->SystemSettings["input_bg"]?>] p-2 sm:text-sm" <?=($type == 1)? "value='".$UserInfo[0]["User_Adress"]."'":"" ?> required />
						</div>
					</div>
				</div>
				<?php
				if(in_array("users_createedit",$LoginPermission)){
				?>
				<div class="grid grid-cols-1 gap-6">
					<div class="col-span-3 sm:col-span-2">
						<label for="discord" class="block text-sm font-medium text-white">DiscordID:</label>
						<div class="mt-1 flex rounded-md shadow-sm">
							<input type="text" name="discord" maxlength="20" class="block w-full flex-1 rounded-md text-[<?=$system->SystemSettings["input_color"]?>] bg-[<?=$system->SystemSettings["input_bg"]?>] p-2 sm:text-sm" <?=($type == 1)? "value='".$UserInfo[0]["User_DiscordID"]."'":"" ?> required />
						</div>
					</div>
				</div>
				<?php
				}
				?>
            </div>
			<div class="px-4 py-3 text-right sm:px-6">
				<button type="submit" name="SaveContactUser" class="justify-center rounded-md border border-transparent py-2 px-4 text-sm font-medium shadow-sm bg-[<?=$system->SystemSettings["button_bg"]?>]  text-[<?=$system->SystemSettings["button_color"]?>] align-middle inline-block rounded-md p-3 hover:text-[<?=$system->SystemSettings["button_color:hover"]?>] hover:bg-[<?=$system->SystemSettings["button_bg:hover"]?>] hover:cursor-pointer"><ion-icon name="save" class="inline-block align-middle"></ion-icon>  <?=constant("SAVE");?></button>
	 		</div>
		</form>
	</div>
	<div class="space-y-6 container mx-auto px-4 py-5 ">
		<form method="post" action="">
			<h1 class="text-xl text-[<?=$system->SystemSettings["color_2"]?>] font-bold">Herní informace</h1>
			<?php
				if(in_array("users_createedit",$LoginPermission)){
			?>
			<div class="pl-3 space-y-4">
				<div class="grid grid-cols-1 gap-6">
					<div class="col-span-3 sm:col-span-2">
						<label for="rank" class="block text-sm font-medium text-white">Rank:</label>
						<div class="flex justify-center mt-2 mb-2">
								<?php
									$ranks = new Ranks();
									
									$ranklist = $ranks->Get();
									
									if($ranklist !== false){
										echo '<select id="rank" name="rank" class=" block w-full flex-1 rounded-md text-['.$system->SystemSettings["input_color"].'] bg-['.$system->SystemSettings["input_bg"].'] p-2 sm:text-sm" required >';
										
										foreach($ranklist as $rank){
											$add="";
											if($rank["Rank_ID"] == $UserInfo[0]["User_RankID"]){
												$add="selected";
											}
											echo '<option value="'.$rank["Rank_ID"].'" '.$add.'>'.$rank["Rank_Name"].'</option>';
										}
										echo '</select>';
									} else {
										echo $system->GetMessage("RA200");
									}
									
					
								?>
						</div>
					</div>
				</div>
            </div>
			<?php
				}
			?>
			<div class="pl-3 space-y-4">
				<div class="grid grid-cols-1 gap-6">
					<div class="col-span-3 sm:col-span-2">
						<label for="guns" class="block text-sm font-medium text-white">Zbraně:</label>
						<div class="mt-1 flex rounded-md shadow-sm">
							<textarea id="guns" name="guns" rows="3" class="block w-full flex-1 rounded-md text-[<?=$system->SystemSettings["input_color"]?>] bg-[<?=$system->SystemSettings["input_bg"]?>] p-2 sm:text-sm"   required /><?=($type == 1)? $UserInfo[0]["User_Guns"]:"" ?></textarea>
						</div>
					</div>
				</div>
            </div>
            <div class="grid grid-cols-1 gap-6">
                <div class="col-span-3 sm:col-span-2">
                    <label for="since" class="block text-sm font-medium text-[<?=$system->SystemSettings["color_1"]?>]">Datum narození:</label>
                    <div class="mt-1 flex rounded-md shadow-sm">
                        <input type="date" name="since" id="since" class="block w-full flex-1 rounded-md text-[<?=$system->SystemSettings["input_color"]?>] bg-[<?=$system->SystemSettings["input_bg"]?>] p-2 sm:text-sm"  <?=($type == 1)?"value='".date("Y-m-d",$UserInfo[0]["User_BirthDate"])."'":"" ?> required />
                    </div>
                </div>
            </div>
			<div class="px-4 py-3 text-right sm:px-6">
				<button type="submit" name="SaveGameUser" class="justify-center rounded-md border border-transparent py-2 px-4 text-sm font-medium shadow-sm bg-[<?=$system->SystemSettings["button_bg"]?>]  text-[<?=$system->SystemSettings["button_color"]?>] align-middle inline-block rounded-md p-3 hover:text-[<?=$system->SystemSettings["button_color:hover"]?>] hover:bg-[<?=$system->SystemSettings["button_bg:hover"]?>] hover:cursor-pointer"><ion-icon name="save" class="inline-block align-middle"></ion-icon>  <?=constant("SAVE");?></button>
	 		</div>
		</form>
	</div>
	<div class="space-y-6 container mx-auto px-4 py-5 ">
		<form method="post" action="" enctype="multipart/form-data">
			<h1 class="text-xl text-[<?=$system->SystemSettings["color_2"]?>] font-bold">Fotka:</h1>
			<div class="pl-3 space-y-4">
				<div class="grid grid-cols-2 gap-6">
					<div class="col-span-1">
						<label for="phone" class="block text-sm font-medium text-[<?=$system->SystemSettings["color_1"]?>]">Aktuální fotka:</label>
						<div class="mt-1 flex rounded-md shadow-sm">
							<img src="./inc/data/users/<?=(isset($UserInfo[0]["User_Picture"]))?$UserInfo[0]["User_Picture"]:"/smile.png"?>" class="h-24 w-24" />
						</div>
					</div>
					<div class="col-span-1">
						<label for="File" class="block text-sm font-medium text-[<?=$system->SystemSettings["color_1"]?>]">Nahrát nový obrázek:</label>
						<div class="mt-1 flex rounded-md shadow-sm">
							<input class="block w-full flex-1 rounded-md text-[<?=$system->SystemSettings["input_color"]?>] bg-[<?=$system->SystemSettings["input_bg"]?>] p-2 sm:text-sm" id="File" name="File" type="file">
						</div>
					</div>
				</div>
            </div>
			<div class="px-4 py-3 text-right sm:px-6">
				<button type="submit" name="SavePictureUser" class="justify-center rounded-md border border-transparent py-2 px-4 text-sm font-medium shadow-sm bg-[<?=$system->SystemSettings["button_bg"]?>]  text-[<?=$system->SystemSettings["button_color"]?>] align-middle inline-block rounded-md p-3 hover:text-[<?=$system->SystemSettings["button_color:hover"]?>] hover:bg-[<?=$system->SystemSettings["button_bg:hover"]?>] hover:cursor-pointer"><ion-icon name="save" class="inline-block align-middle"></ion-icon>  <?=constant("SAVE");?></button>
	 		</div>
		</form>
	</div>
	<?php
	if(in_array("users_createedit",$LoginPermission)){
	?>
	<div class="space-y-6 container mx-auto px-4 py-5 ">
		<form method="post" action="">
			<h1 class="text-xl text-[<?=$system->SystemSettings["color_2"]?>] font-bold">Skupiny</h1>
			<div class="pl-3 space-y-4">
			  	<div class="relative flex w-full">
                    <?php
                    $groups = new Groups();
									
                    $groupslist = $groups->GetGroups();
                    if($groupslist !== false){


                        echo '<select id="group" name="groups[]" class=" block w-full flex-1 rounded-md text-['.$system->SystemSettings["input_color"].'] bg-['.$system->SystemSettings["input_bg"].'] p-2 sm:text-sm" required multiple>';
									foreach($groupslist as $groupInfo){

											$add="";
											if(!empty($users->UserGroups()) && in_array($groupInfo["Group_ID"],$users->UserGroups())){
												$add="selected";
											}
											echo '<option value="'.$groupInfo["Group_ID"].'" '.$add.'>'.$groupInfo["Group_Name"].'</option>';
										}
										echo '</select>';
									} else {
										echo $system->GetMessage("RA200");
									}
								?>
			  	</div>
				<label class="block text-sm text-[<?=$system->SystemSettings["color_3"]?>]">Můžete vybrat pomocí <?=$click?> + kliknutí na skupinu. Tímto způsobem můžete vybrat víc skupin.</label>
            </div>
			<div class="px-4 py-3 text-right sm:px-6">
				<button type="submit" name="SaveGroupsUser" class="justify-center rounded-md border border-transparent py-2 px-4 text-sm font-medium shadow-sm bg-[<?=$system->SystemSettings["button_bg"]?>]  text-[<?=$system->SystemSettings["button_color"]?>] align-middle inline-block rounded-md p-3 hover:text-[<?=$system->SystemSettings["button_color:hover"]?>] hover:bg-[<?=$system->SystemSettings["button_bg:hover"]?>] hover:cursor-pointer"><ion-icon name="save" class="inline-block align-middle"></ion-icon>  <?=constant("SAVE");?></button>
	 		</div>
		</form>
	</div>
	<?php
	}
    if(in_array("tag_reassignment",$LoginPermission) && $modules->VerifyModule("TAG") == 1){
            ?>
            <div class="space-y-6 container mx-auto px-4 py-5 ">
                <form method="post" action="">
                    <h1 class="text-xl text-[<?=$system->SystemSettings["color_2"]?>] font-bold">Tagy</h1>
                    <div class="pl-3 space-y-4">
                        <div class="relative flex w-full">
                            <?php
                            $tags = new Tags();

                            $tagslist = $tags->GetTag();

                            if($tagslist !== false){
                                echo '<select id="tag" name="tags[]" class=" block w-full flex-1 rounded-md text-['.$system->SystemSettings["input_color"].'] bg-['.$system->SystemSettings["input_bg"].'] p-2 sm:text-sm" required multiple>';

                                foreach($tagslist as $tagInfo){
                                    $add="";
                                    $utags = $users->UserTags();
                                    if($utags != false && in_array($tagInfo["Tag_ID"],$utags)){
                                        $add="selected";
                                    }
                                    echo '<option value="'.$tagInfo["Tag_ID"].'" '.$add.'>'.$tagInfo["Tag_Name"].'</option>';
                                }
                                echo '</select>';
                            } else {
                                echo $system->GetMessage("RA200");
                            }


                            ?>
                        </div>
                        <label class="block text-sm text-[<?=$system->SystemSettings["color_3"]?>]">Můžete vybrat pomocí <?=$click?> + kliknutí na skupinu. Tímto způsobem můžete vybrat víc skupin.</label>
                    </div>
                    <div class="px-4 py-3 text-right sm:px-6">
                        <button type="submit" name="SaveTagsUser" class="justify-center rounded-md border border-transparent py-2 px-4 text-sm font-medium shadow-sm bg-[<?=$system->SystemSettings["button_bg"]?>]  text-[<?=$system->SystemSettings["button_color"]?>] align-middle inline-block rounded-md p-3 hover:text-[<?=$system->SystemSettings["button_color:hover"]?>] hover:bg-[<?=$system->SystemSettings["button_bg:hover"]?>] hover:cursor-pointer"><ion-icon name="save" class="inline-block align-middle"></ion-icon>  <?=constant("SAVE");?></button>
                    </div>
                </form>
            </div>
            <?php
        }
    }
	?>
</div>
<?php
$user= "";
if(!isset($_GET["id"])){
	$user = $loginUser;
	$userInfo = $user->InfoUser();
	$title = "Profil";
	$type = true;
	$basicURL = "?page=profile";
	$bckLink = "?page=main";
} else {
		$user = $loginUser;
		$userInfoLocal = $user->InfoUser();
	if(isset($userInfoLocal[0]["User_ID"]) && $_GET["id"] == $userInfoLocal[0]["User_ID"]){
		$userInfo = $userInfoLocal;
		$type = true;
	} else {
		$user = new User($_GET["id"]);
		$type = false;
		$userInfo = $user->InfoUser();
	}
	$title = "Profil | ".$userInfo[0]["User_Username"];
	$basicURL = "?page=profile&id=".$_GET["id"];
	$bckLink = "?page=members";
}
	if(!in_array("users_display",$LoginPermission) && $_GET["id"] != $userInfo[0]["User_ID"] && isset($_GET["id"])){
		echo'<meta http-equiv="refresh" content="0;url=?page=main"> ';
	}
?>

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
      <li class="flex cursor-pointer items-center font-sans text-sm font-normal leading-normal text-[<?=$system->SystemSettings["map_color:active"]?>] antialiased transition-colors duration-300 hover:text-[<?=$system->SystemSettings["map_color:hover"]?>]">
        <a class="font-medium transition-colors" href="<?=$basicURL?>">
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
</div>
<section class="container mx-auto pb-5 pt-5 mt-6 mb-6">
<div>
  <div class="md:grid md:grid-cols-3 md:gap-6">
    <div class="md:col-span-1">
      <div class="px-4 sm:px-0">
        <?php //Profilová fotka ?>
		  <div class="grid grid-cols-3 auto-cols-auto gap-5">
			  <img src="./inc/data/users/<?=(isset($userInfo[0]["User_Picture"]))? $userInfo[0]["User_Picture"]:"/smile.png"?>" class="rounded-full ">
			  <div class="col-span-2 text-left">
			  	<h1 class="text-3xl md:text-2xl lg:text-2xl text-[<?=$system->SystemSettings["color_2"]?>]"><?=$userInfo[0]["User_Username"]?> | <span class="text-xl"> <?=$userInfo[0]["User_ID"]?></span></h1>
				 <h2 class="text-2xl md:text-xl lg:text-xl text-[<?=$system->SystemSettings["color_3"]?>]">(<?=$userInfo[0]["User_Name"]?>)</h2>
				<h3 class="text-2xl md:text-xl lg:text-xl text-[<?=$system->SystemSettings["color_1"]?>]">
                    <?php
                    if(isset($userInfo[0]["User_RankID"]) && !empty($userInfo[0]["User_RankID"])){
                        $rank = new Ranks($userInfo[0]["User_RankID"]);
                        $rankInfo = $rank->Info();
                        if($rankInfo){
                            echo $rankInfo[0]["Rank_Name"];
                        }
                    }
					?>
                </h3>
			  </div>
		  </div>
		  <?php
			/*<section class="mt-5 mb-5 leading-8">
		  <span class="bg-blue-100 text-blue-800 text-base font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">Zdravotník</span>
<span class="bg-gray-100 text-gray-800 text-base font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">Střelec</span>
<span class="bg-red-100 text-red-800 text-base font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Rekrut</span>
		  </section>*/
	?>
	 <div class="space-y-2 px-2 pt-2 pb-3 bg-[<?=$system->SystemSettings["menu/foot_bg"]?>] mt-4 rounded-lg">
      <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
	<?php
			$normalClass="text-[".$system->SystemSettings["color_3"]."]";
		  $hoverClass=" hover:bg-[".$system->SystemSettings["menu/foot_bg:hover"]."] hover:text-[".$system->SystemSettings["menu/foot_color:hover"]."]";
		  $activeClass=" bg-[".$system->SystemSettings["menu/foot_bg:active"]."] text-[".$system->SystemSettings["menu/foot_color:active"]."]";
		 
		 if((!isset($_GET["id"]) || $type) || in_array("users_display_basic",$LoginPermission)){ 
				 
	
	?>
      <a href="<?=$basicURL?>&section=basic" class="<?=((!isset($_GET["section"]) || ($_GET["section"] == "basic"))?$activeClass:$normalClass)?> <?=$hoverClass?> block px-3 py-2 rounded-md text-base font-medium"><ion-icon name="person" class="inline-block align-middle"></ion-icon> Osobní Informace</a>
	<?php }
	if((!isset($_GET["id"]) || $type) || in_array("users_display_contact",$LoginPermission)){ 
	?>
      <a href="<?=$basicURL?>&section=contact" class="<?=((isset($_GET["section"]) && ($_GET["section"] == "contact"))?$activeClass:$normalClass)?> <?=$hoverClass?> block px-3 py-2 rounded-md text-base font-medium"><ion-icon name="phone-portrait" class="inline-block align-middle"></ion-icon> Kontaktní Informace</a>
	<?php }
	if((!isset($_GET["id"]) || $type) || in_array("users_display_game",$LoginPermission)){ 
	?>
      <a href="<?=$basicURL?>&section=game" class="<?=((isset($_GET["section"]) && ($_GET["section"] == "game"))?$activeClass:$normalClass)?> <?=$hoverClass?> block px-3 py-2 rounded-md text-base font-medium"><ion-icon name="game-controller" class="inline-block align-middle"></ion-icon> Herní Informace</a>
	<?php } ?>
		 
    </div>
      </div>
    </div>
    <div class="mt-5 md:col-span-2 md:mt-0">
        <div class="shadow m-3 rounded-lg overflow-hidden sm:m-1">
			<?php if((!isset($_GET["id"]) || $type)){
			?>
	      <div class="bg-[<?=$system->SystemSettings["main_panel_bg"]?>] px-4 py-3 text-right sm:px-6">
            <a href="?page=user&id=<?=$userInfo[0]["User_ID"]?>" class="justify-center rounded-md border border-transparent py-2 px-4 text-sm font-medium shadow-sm bg-[<?=$system->SystemSettings["button_bg"]?>]  text-[<?=$system->SystemSettings["button_color"]?>] align-middle inline-block rounded-md p-3 hover:text-[<?=$system->SystemSettings["button_color:hover"]?>] hover:bg-[<?=$system->SystemSettings["button_bg:hover"]?>] hover:cursor-pointer"><ion-icon name="pencil" class="inline-block align-middle"></ion-icon>  Upravit informace</a>
          </div>
			<?php }
			if((!isset($_GET["section"]) || $_GET["section"] == "basic") && ((!isset($_GET["id"]) || $type) || in_array("users_display_basic",$LoginPermission))){
			?>
          	<div class="space-y-6 bg-[<?=$system->SystemSettings["profile_bg"]?>] px-4 py-5 sm:p-6">
            <div class="grid grid-cols-3 gap-6">
              <div class="col-span-3 sm:col-span-2">
                <label for="username" class="block text-sm font-medium text-[<?=$system->SystemSettings["color_1"]?>]">Přezdívka:</label>
                <div class="mt-1 flex rounded-md shadow-sm">
                  <input type="text" name="username" class="block w-full flex-1 rounded-md text-[<?=$system->SystemSettings["input_color"]?>] bg-[<?=$system->SystemSettings["input_bg"]?>] p-2 sm:text-sm" value="<?=$userInfo[0]["User_Username"]?>" readonly disabled />
                </div>
              </div>
            </div>
            <div class="grid grid-cols-3 gap-6">
              <div class="col-span-3 sm:col-span-2">
                <label for="name" class="block text-sm font-medium text-[<?=$system->SystemSettings["color_1"]?>]">Jméno:</label>
                <div class="mt-1 flex rounded-md shadow-sm">
                  <input type="text" name="name" class="block w-full flex-1 rounded-md text-[<?=$system->SystemSettings["input_color"]?>] bg-[<?=$system->SystemSettings["input_bg"]?>] p-2 sm:text-sm" value="<?=$userInfo[0]["User_Name"]?>" readonly disabled />
                </div>
              </div>
            </div>
			 <?php
				if((!isset($_GET["id"]) || $type) || $userInfo[0]["User_DisplayBDay"]){
			?>
            <div class="grid grid-cols-3 gap-6">
              <div class="col-span-3 sm:col-span-2">
                <label for="bday" class="block text-sm font-medium text-[<?=$system->SystemSettings["color_1"]?>]">Datum narození:</label>
                <div class="mt-1 flex rounded-md shadow-sm">
                  <input type="text" name="bday" class="block w-full flex-1 rounded-md text-white bg-[<?=$system->SystemSettings["input_bg"]?>] p-2 sm:text-sm" value="<?=date("d/m/Y",$userInfo[0]["User_BirthDate"])?>" readonly disabled />
                </div>
              </div>
            </div>
			  <?php } ?>
            <div>
              <label for="alergies" class="block text-sm font-medium text-[<?=$system->SystemSettings["color_1"]?>]">Alergie</label>
              <div class="mt-1">
                <textarea name="alergies" rows="3" class="block w-full flex-1 rounded-md text-[<?=$system->SystemSettings["input_color"]?>] bg-[<?=$system->SystemSettings["input_bg"]?>] p-2 sm:text-sm" readonly disabled><?=$userInfo[0]["User_Allergies"]?></textarea>
              </div>
              <p class="mt-2 text-sm text-[<?=$system->SystemSettings["color_3"]?>]">Za vyplněné údaje zodpovídát uživatel.</p>
            </div>
          </div>
			<?php }
			if((isset($_GET["section"]) && $_GET["section"] == "contact") && ((!isset($_GET["id"]) || $type) || in_array("users_display_contact",$LoginPermission))){
			?>
          <div class="space-y-6 bg-[<?=$system->SystemSettings["profile_bg"]?>] px-4 py-5 sm:p-6">
            <div class="grid grid-cols-3 gap-6">
              <div class="col-span-3 sm:col-span-2">
                <label for="phone" class="block text-sm font-medium text-[<?=$system->SystemSettings["color_1"]?>]">Telefon:</label>
                <div class="mt-1 flex rounded-md shadow-sm">
                  <input type="text" name="cphone" class="block w-full flex-1 rounded-md text-[<?=$system->SystemSettings["input_color"]?>] bg-[<?=$system->SystemSettings["input_bg"]?>] p-2 sm:text-sm" value="<?=$userInfo[0]["User_Phone"]?>" readonly disabled />
                </div>
              </div>
            </div>
            <div class="grid grid-cols-3 gap-6">
              <div class="col-span-3 sm:col-span-2">
                <label for="mail" class="block text-sm font-medium text-[<?=$system->SystemSettings["color_1"]?>]">E-mail:</label>
                <div class="mt-1 flex rounded-md shadow-sm">
                  <input type="text" name="mail" class="block w-full flex-1 rounded-md text-[<?=$system->SystemSettings["input_color"]?>] bg-[<?=$system->SystemSettings["input_bg"]?>] p-2 sm:text-sm" value="<?=$userInfo[0]["User_Mail"]?>" readonly disabled />
                </div>
              </div>
            </div>
          <div class="grid grid-cols-3 gap-6">
              <div class="col-span-3 sm:col-span-2">
                <label for="adress" class="block text-sm font-medium text-[<?=$system->SystemSettings["color_1"]?>]">Bydliště:</label>
                <div class="mt-1 flex rounded-md shadow-sm">
                  <input type="text" name="adress" class="block w-full flex-1 rounded-md text-[<?=$system->SystemSettings["input_color"]?>] bg-[<?=$system->SystemSettings["input_bg"]?>] p-2 sm:text-sm" value="<?=$userInfo[0]["User_Adress"]?>" readonly disabled />
                </div>
              </div>
            </div>
          <div class="grid grid-cols-3 gap-6">
              <div class="col-span-3 sm:col-span-2">
                <label for="discord" class="block text-sm font-medium text-[<?=$system->SystemSettings["color_1"]?>]">Discord ID:</label>
                <div class="mt-1 flex rounded-md shadow-sm">
                  <input type="text" name="discord" class="block w-full flex-1 rounded-md text-[<?=$system->SystemSettings["input_color"]?>] bg-[<?=$system->SystemSettings["input_bg"]?>] p-2 sm:text-sm" value="<?=$userInfo[0]["User_DiscordID"]?>" readonly disabled />
                </div>
              </div>
            </div>
          </div>
			<?php }
			if((isset($_GET["section"]) && $_GET["section"] == "game") && ((!isset($_GET["id"]) || $type) || in_array("users_display_game",$LoginPermission))){
			?>
          <div class="space-y-6 bg-[<?=$system->SystemSettings["profile_bg"]?>] px-4 py-5 sm:p-6">
            <div>
              <label for="guns" class="block text-sm font-medium text-[<?=$system->SystemSettings["color_1"]?>]">Zbraně</label>
              <div class="mt-1">
                <textarea id="about" name="guns" rows="3" class="block w-full flex-1 rounded-md text-[<?=$system->SystemSettings["input_color"]?>] bg-[<?=$system->SystemSettings["input_bg"]?>] p-2 sm:text-sm" readonly disabled><?=$userInfo[0]["User_Guns"]?></textarea>
              </div>
            </div>
          </div>
			<?php }
			?>
        </div>

    </div>
  </div>
</div>
	</section>


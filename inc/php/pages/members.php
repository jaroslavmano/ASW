<?php
if(!in_array("display_members",$LoginPermission)){
	echo'<meta http-equiv="refresh" content="0;url=?page=main"> ';
}

$ranksClass = new Ranks();
$ranks = $ranksClass->Get();
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
        <a
          class="font-medium text-blue-gray-900 transition-colors"
          href="?page=members"
        >
          Členové
        </a>
      </li>
    </ol>
  </nav>
</div>

<h1 class="text-center text-4xl text-[<?=$system->SystemSettings["color_2"]?>] font-bold mt-6 mb-6">Členové</h1>
<hr class="w-[10%] mx-auto ">
<div class="text-center p-4">
<a href="?pages=main" class="text-[<?=$system->SystemSettings["link_color"]?>] hover:text-[<?=$system->SystemSettings["link_color:hover"]?>]"><ion-icon name="chevron-back" class="inline-block align-middle text-xl"></ion-icon> <?=constant("BACK");?></a>
</div>
<?php
	if(is_array($ranks)){
?>
			<?php
			foreach($ranks as $rank){
			?>
			<section class="container mx-auto pb-5 pt-5 mt-6 mb-6">
			<h2 class="text-left text-3xl text-[<?=$system->SystemSettings["color_2"]?>] font-middle mx-3 my-6"><?=$rank["Rank_Name"]?> / <?=$rank["Rank_Short"]?></h2>
			<p class="text-left text-lg text-[<?=$system->SystemSettings["color_1"]?>] font-middle mx-3 my-6"><?=$rank["Rank_Description"]?></p>
			<div>
  				<div class="lg:grid lg:grid-cols-2 lg:gap-8">
					<?php
					$rankInfo = new Ranks($rank["Rank_ID"]);
					$rankUsers = $rankInfo->Users();
					if(is_array($rankUsers)){
						foreach($rankUsers as $user){
							$userCLS = new User($user["User_ID"]);
							$userInfo = $userCLS->InfoUser();
							?>
						<div class="lg:col-span-1 container  mb-2">
							<div class="p-3 w-[90%] sm:px-0 bg-black rounded-lg mx-auto my-4 md:my-0 md:w-[100%]">
							<?php //Profilová fotka ?>
								<div class="grid grid-cols-4 auto-cols-auto gap-2 m-4 md:gap-5 h-full place-items-center">
									<img src="./inc/data/users/<?=((isset($userInfo[0]["User_Picture"]))?$userInfo[0]["User_Picture"]:"smile.png")?>" class="rounded-full h-24 w-24">
									<div class="col-span-2 text-left">
										<h1 class="md:text-2xl sm:text-xl text-[<?=$system->SystemSettings["color_1"]?>]"><?=$userInfo[0]["User_Username"]?> | <?=$userInfo[0]["User_ID"]?></h1>
										<p class="md:text-xl sm:text-lg text-[<?=$system->SystemSettings["color_3"]?>]">(<?=$userInfo[0]["User_Name"]?>)</p>
                                        <p>
                                            <?php
                                            if(in_array("tag_display",$LoginPermission) && $modules->VerifyModule("TAG") == 1){
                                                echo '<section class="mt-5 mb-5 leading-8">';
                                                $tags = $userCLS->UserTags();
                                                if(!empty($tags)){
                                                    foreach ($tags as $tag){
                                                        $tagClass = new Tags($tag);
                                                        $tagInfo = $tagClass->Info();
                                                        if(isset($tagInfo["Tag_Name"])){
                                                            echo '
                             <p class=" bg-['.$tagInfo["Tag_Color"].'] text-['.$tagInfo["Tag_TextColor"].'] font-medium px-2 py-0.5 text-center my-0.5 rounded">'.$tagInfo["Tag_Short"].'</p>';
                                                        }
                                                    }
                                                }
                                                echo '</section>';
                                            }
                                            ?>
                                        </p>
									</div>
									<div> 
										<a href="?page=profile&id=<?=$userInfo[0]["User_ID"]?>" class="justify-center rounded-md border border-transparent py-2 px-4 text-sm font-medium shadow-sm bg-[<?=$system->SystemSettings["button_bg"]?>]  text-[<?=$system->SystemSettings["button_color"]?>] align-middle inline-block rounded-md p-3 hover:text-[<?=$system->SystemSettings["button_color:hover"]?>] hover:bg-[<?=$system->SystemSettings["button_bg:hover"]?>] hover:cursor-pointer"><ion-icon name="search-outline" class="inline-block align-middle"></ion-icon>  Zobrazit</a>
									</div>
								</div>
							</div>
						</div>
							<?php
						}
					} else {
						echo $system->GetMessage("US200");
					}
					?>
				</div>
			</div>

			<?php
			}
			?>
<?php
	} else {
		echo $system->GetMessage("RA200");
	}
?>
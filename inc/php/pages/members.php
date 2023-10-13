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
									<img src="./inc/data/users/<?=((isset($userInfo[0]["User_Picture"]))?$userInfo[0]["User_Picture"]:"smile.png")?>" class="rounded-full ">
									<div class="col-span-2 text-left">
										<h1 class="md:text-2xl sm:text-xl text-[<?=$system->SystemSettings["color_1"]?>]"><?=$userInfo[0]["User_Username"]?> | <?=$userInfo[0]["User_ID"]?></h1>
										<p class="md:text-xl sm:text-lg text-[<?=$system->SystemSettings["color_3"]?>]">(<?=$userInfo[0]["User_Name"]?>)</p>
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
                /*<section class="mt-5 mb-5 leading-8 text-center">
		  							<span class="bg-blue-100 text-blue-800 text-base space-y-0.5 font-medium m-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">Zdravotník</span>
									<span class="bg-gray-100 text-gray-800 text-base font-medium space-y-0.5 m-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">Střelec</span>
									<span class="bg-red-100 text-red-800 text-base font-medium m-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Rekrut</span>
		  						</section> */
                ?>

			<?php
			}
			?>
<?php
	} else {
		echo $system->GetMessage("RA200");
	}
?>
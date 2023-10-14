<?php
	if(!in_array("ranks_createedit",$LoginPermission)){
		echo'<meta http-equiv="refresh" content="0;url=?page=ranks"> ';
	}
    if(isset($_GET["id"])){
        $ranks = new Ranks($_GET["id"]);
    } else {
        $ranks = new Ranks();
    }
if(isset($_POST["SaveInfoGroup"])){
	if(isset($_GET["id"])){
		$result = $ranks->Update($_POST["name"],$_POST["short"], $_POST["descript"]);
		if($result === true){
			$_SESSION["msg"] = $system->GetMessage("RA002");
			unset($_POST);
			$ranks = new Ranks($_GET["id"]);
			//echo'<meta http-equiv="refresh" content="0;url=?page=rank&id='.$result.'&msg=1"> ';
		} else {
			echo $system->GetMessage("RA202");
		}
	} else {
		echo $type;
		$result = $ranks->Create($_POST["name"],$_POST["short"], $_POST["descript"]);
		
		if($result !== false && isset($result)){
			$_SESSION["msg"] = $system->GetMessage("RA001");
			echo'<meta http-equiv="refresh" content="0;url=?page=rank&id='.$result.'&msg=1"> ';
			//header("Refresh:0; url=?page=group&id=".$result);
		} else {
			echo $system->GetMessage("RA201");
		}
	}
}
$rankInfo = $ranks->Info();
if($rankInfo === false && isset($_GET["id"])){
	//echo'<meta http-equiv="refresh" content="0;url=?page=ranks"> ';
}
if(isset($_GET["id"])){
	$type =1;
	$title = "Úprava ranku | ".$rankInfo[0]["Rank_Name"];
} else {
	$type =0;
	$title = "Tvorba ranku";
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
      <li class="flex cursor-pointer items-center font-sans text-sm font-normal leading-normal text-[<?=$system->SystemSettings["map_color"]?>] antialiased transition-colors duration-300 hover:text-[<?=$system->SystemSettings["map_color:hover"]?>]">
        <a class="opacity-60" href="?page=ranks">
          Správa ranků
        </a>
        <span class="pointer-events-none mx-2 select-none font-sans text-sm font-normal leading-normal text-zinc-400 antialiased">
          /
        </span>
      </li>
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
<a href="?page=ranks" class="text-[<?=$system->SystemSettings["link_color"]?>] hover:text-[<?=$system->SystemSettings["link_color:hover"]?>]"><ion-icon name="chevron-back" class="inline-block align-middle text-xl"></ion-icon> <?=constant("BACK");?></a>
	<?php
	if(isset($_SESSION["msg"]) && empty($_POST)){
		echo $_SESSION["msg"];
		unset($_SESSION["msg"]);
	}
	?>
</div>

	<div class="space-y-6 container mx-auto px-4 py-5 ">
		<form method="post" action="">
			<h1 class="text-xl text-[<?=$system->SystemSettings["color_2"]?>] font-bold">Informace o ranku</h1>
			<div class="pl-3 space-y-4">
				<div class="grid grid-cols-1 gap-6">
					<div class="col-span-3 sm:col-span-2">
						<label for="name" class="block text-sm font-medium text-[<?=$system->SystemSettings["color_1"]?>]"><?=constant("NAME");?>:</label>
						<div class="mt-1 flex rounded-md shadow-sm">
							<input type="text" name="name" maxlength="30" class="block w-full flex-1 rounded-md text-[<?=$system->SystemSettings["input_color"]?>] bg-[<?=$system->SystemSettings["input_bg"]?>] p-2 sm:text-sm" placeholder="Admin" <?=($type == 1)? "value='".$rankInfo[0]["Rank_Name"]."'":"" ?> required />
						</div>
					</div>
				</div>
				<div class="grid grid-cols-1 gap-6">
					<div class="col-span-3 sm:col-span-2">
						<label for="short" class="block text-sm font-medium text-[<?=$system->SystemSettings["color_1"]?>]"><?=constant("SHORT");?>:</label>
						<div class="mt-1 flex rounded-md shadow-sm">
							<input type="text" name="short" maxlength="4" class="block w-full flex-1 rounded-md text-[<?=$system->SystemSettings["input_color"]?>] bg-[<?=$system->SystemSettings["input_bg"]?>] p-2 sm:text-sm" placeholder="ASW" <?=($type == 1)? "value='".$rankInfo[0]["Rank_Short"]."'":"" ?> required />
						</div>
					</div>
				</div>
				<div class="grid grid-cols-1 gap-6">
					<div class="col-span-3 sm:col-span-2">
						<label for="descript" class="block text-sm font-medium text-[<?=$system->SystemSettings["color_1"]?>]"><?=constant("DESCRIPTION");?>:</label>
						<div class="mt-1 flex rounded-md shadow-sm">
							<textarea id="descript" name="descript" rows="3" class="block w-full flex-1 rounded-md text-[<?=$system->SystemSettings["input_color"]?>] bg-[<?=$system->SystemSettings["input_bg"]?>] p-2 sm:text-sm"   required /><?=($type == 1)? $rankInfo[0]["Rank_Description"]:"" ?></textarea>
						</div>
					</div>
				</div>
            </div>
			<div class="px-4 py-3 text-right sm:px-6">
				<button type="submit" name="SaveInfoGroup" class="justify-center rounded-md border border-transparent py-2 px-4 text-sm font-medium shadow-sm bg-[<?=$system->SystemSettings["button_bg"]?>]  text-[<?=$system->SystemSettings["button_color"]?>] align-middle inline-block rounded-md p-3 hover:text-[<?=$system->SystemSettings["button_color:hover"]?>] hover:bg-[<?=$system->SystemSettings["button_bg:hover"]?>] hover:cursor-pointer"><ion-icon name="save" class="inline-block align-middle"></ion-icon>  <?=constant("SAVE");?></button>
	 		</div>
		</form>
	</div>
<?php
	if(!in_array("stats_ratinggame",$LoginPermission) || $modules->VerifyModule("STA") == 0 || !isset($_GET["id"])){
		echo'<meta http-equiv="refresh" content="0;url=?page=history"> ';
	}
    $user = $loginUser;
    $userInfo = $user->InfoUser();

    $stats = new Stats($_GET["id"],$userInfo[0]["User_ID"]);
    $game = new Games($_GET["id"]);
    if($stats->Controll() === false){
        echo'<meta http-equiv="refresh" content="0;url=?page=history"> ';
    }

    $igame = $game->Info();

    $title = "Hodnocení akce | ".$igame["Game_Name"]." <small>".date("d.m.Y",$igame["Game_Date"])."</small>";

if(isset($_POST["SaveStats"])){
    if(isset($_GET["id"])){
        $p = isset($_POST["player"])?$_POST["player"]:"";
        $g = isset($_POST["ground"])?$_POST["ground"]:"";
        $t = isset($_POST["team"])?$_POST["team"]:"";
        $c = isset($_POST["complete"])?$_POST["complete"]:"";
        $ch = isset($_POST["cheater"])?$_POST["cheater"]:"";
        $m = isset($_POST["managment"])?$_POST["managment"]:"";
        $k = isset($_POST["kill"])?$_POST["kill"]:"";
        $d = isset($_POST["death"])?$_POST["death"]:"";


		$result = $stats->CreateAnonymous($p,$g,$t,$c,$ch,$m);
        $result2 = $stats->CreateStats($k,$d);
        unset($_POST);

        if($result && $result2){
			$_SESSION["msg"] = $system->GetMessage("STA001");
		} else {
            $_SESSION["msg"] = $system->GetMessage("STA200");
		}
        echo'<meta http-equiv="refresh" content="0;url=?page=history"> ';

    }
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
        <a class="opacity-60" href="?page=history">
            <?=EVENTS?>
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
<a href="?page=history" class="text-[<?=$system->SystemSettings["link_color"]?>] hover:text-[<?=$system->SystemSettings["link_color:hover"]?>]"><ion-icon name="chevron-back" class="inline-block align-middle text-xl"></ion-icon> <?=constant("BACK");?></a>
	<?php
	if(isset($_SESSION["msg"]) && empty($_POST)){
		echo $_SESSION["msg"];
		unset($_SESSION["msg"]);
	}
	?>
</div>
	<div class="space-y-6 container mx-auto px-4 py-5 ">
		<form method="post" action="">
			<div class="pl-3 space-y-4">
                <?php if(in_array("stats_ratingplayers",$LoginPermission)){?>
				<div class="grid grid-cols-1 gap-6">
					<div class="col-span-3 sm:col-span-2">
						<label for="name" class="block text-sm font-medium text-[<?=$system->SystemSettings["color_1"]?>]">Hodnocení ostatních hráčů: <small class="text-[<?=$system->SystemSettings["color_3"]?>]">* data jsou anonimizována</small></label>
						<div class="mt-1 flex rounded-md shadow-sm">
                            <div class="hodnoceni text-center justify-center content-center">
                                <input type="radio" id="player1" name="player" value="5">
                                <label for="player1"></label>
                                <input type="radio" id="player2" name="player" value="4">
                                <label for="player2"></label>
                                <input type="radio" id="player3" name="player" value="3">
                                <label for="player3"></label>
                                <input type="radio" id="player4" name="player" value="2">
                                <label for="player4"></label>
                                <input type="radio" id="player5" name="player" value="1" checked>
                                <label for="player5"></label>
                            </div>
                        </div>
					</div>
				</div>
                <?php } if(in_array("stats_ratingground",$LoginPermission)){?>
                    <div class="grid grid-cols-1 gap-6">
                        <div class="col-span-3 sm:col-span-2">
                            <label for="name" class="block text-sm font-medium text-[<?=$system->SystemSettings["color_1"]?>]">Hodnocení hřiště: <small class="text-[<?=$system->SystemSettings["color_3"]?>]">* data jsou anonimizována</small></label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <div class="hodnoceni">
                                    <input type="radio" id="ground5" name="ground" value="5">
                                    <label for="ground5"></label>
                                    <input type="radio" id="ground4" name="ground" value="4">
                                    <label for="ground4"></label>
                                    <input type="radio" id="ground3" name="ground" value="3">
                                    <label for="ground3"></label>
                                    <input type="radio" id="ground2" name="ground" value="2">
                                    <label for="ground2"></label>
                                    <input type="radio" id="ground1" name="ground" value="1" checked>
                                    <label for="ground1"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }  if(in_array("stats_ratingteam",$LoginPermission)){?>
                    <div class="grid grid-cols-1 gap-6">
                        <div class="col-span-3 sm:col-span-2">
                            <label for="name" class="block text-sm font-medium text-[<?=$system->SystemSettings["color_1"]?>]">Hodnocení členů týmu na akci: <small class="text-[<?=$system->SystemSettings["color_3"]?>]">* data jsou anonimizována</small></label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <div class="hodnoceni">
                                    <input type="radio" id="team1" name="team" value="5">
                                    <label for="team1"></label>
                                    <input type="radio" id="team2" name="team" value="4">
                                    <label for="team2"></label>
                                    <input type="radio" id="team3" name="team" value="3">
                                    <label for="team3"></label>
                                    <input type="radio" id="team4" name="team" value="2">
                                    <label for="team4"></label>
                                    <input type="radio" id="team5" name="team" value="1" checked>
                                    <label for="team5"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }  if(in_array("stats_ratingmanagment",$LoginPermission)){?>
                    <div class="grid grid-cols-1 gap-6">
                        <div class="col-span-3 sm:col-span-2">
                            <label for="name" class="block text-sm font-medium text-[<?=$system->SystemSettings["color_1"]?>]">Hodnocení vedení člena týmu: <small class="text-[<?=$system->SystemSettings["color_3"]?>]">* data jsou anonimizována</small></label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <div class="hodnoceni">
                                    <input type="radio" id="managment1" name="managment" value="5">
                                    <label for="managment1"></label>
                                    <input type="radio" id="managment" name="managment" value="4">
                                    <label for="managment2"></label>
                                    <input type="radio" id="managment3" name="managment" value="3">
                                    <label for="managment3"></label>
                                    <input type="radio" id="managment4" name="managment" value="2">
                                    <label for="managment4"></label>
                                    <input type="radio" id="managment5" name="managment" value="1" checked>
                                    <label for="managment5"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }  if(in_array("stats_ratingcomplete",$LoginPermission)){?>
                    <div class="grid grid-cols-1 gap-6">
                        <div class="col-span-3 sm:col-span-2">
                            <label for="name" class="block text-sm font-medium text-[<?=$system->SystemSettings["color_1"]?>]">Celkové hodnocení akce: <small class="text-[<?=$system->SystemSettings["color_3"]?>]">* data jsou anonimizována</small></label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <div class="hodnoceni">
                                    <input type="radio" id="complete1" name="complete" value="5">
                                    <label for="complete1"></label>
                                    <input type="radio" id="complete2" name="complete" value="4">
                                    <label for="complete2"></label>
                                    <input type="radio" id="complete3" name="complete" value="3">
                                    <label for="complete3"></label>
                                    <input type="radio" id="complete4" name="complete" value="2">
                                    <label for="complete4"></label>
                                    <input type="radio" id="complete5" name="complete" value="1" checked>
                                    <label for="complete5"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }  if(in_array("stats_ratingcheater",$LoginPermission)){?>
                    <div class="grid grid-cols-1 gap-6">
                        <div class="col-span-3 sm:col-span-2">
                            <label for="name" class="block text-sm font-medium text-[<?=$system->SystemSettings["color_1"]?>]">Byli na hřišti podvodníci? <small class="text-[<?=$system->SystemSettings["color_3"]?>]">* data jsou anonimizována</small></label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <label class="custom-radio text-[<?=$system->SystemSettings["color_1"]?>]">
                                    <input type="radio" name="cheater" value="1">
                                    <label></label> Ano
                                </label>
                                <label class="custom-radio text-[<?=$system->SystemSettings["color_1"]?>]">
                                    <input type="radio" name="cheater" value="0" checked>
                                    <label></label> Ne
                                </label>
                            </div>
                        </div>
                    </div>
                <?php }  if(in_array("stats_kill",$LoginPermission)){?>
                    <div class="grid grid-cols-1 gap-6">
                        <div class="col-span-3 sm:col-span-2">
                            <label for="name" class="block text-sm font-medium text-[<?=$system->SystemSettings["color_1"]?>]">Počet zabití:</label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <input type="number" name="kill" maxlength="3" class="block w-full flex-1 rounded-md text-[<?=$system->SystemSettings["input_color"]?>] bg-[<?=$system->SystemSettings["input_bg"]?>] p-2 sm:text-sm" required />
                            </div>
                        </div>
                    </div>
                <?php }  if(in_array("stats_death",$LoginPermission)){?>
                    <div class="grid grid-cols-1 gap-6">
                        <div class="col-span-3 sm:col-span-2">
                            <label for="name" class="block text-sm font-medium text-[<?=$system->SystemSettings["color_1"]?>]">Počet úmrtí:</label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <input type="number" name="death" maxlength="3" class="block w-full flex-1 rounded-md text-[<?=$system->SystemSettings["input_color"]?>] bg-[<?=$system->SystemSettings["input_bg"]?>] p-2 sm:text-sm" required />
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
			<div class="px-4 py-3 text-right sm:px-6">
				<button type="submit" name="SaveStats" class="justify-center rounded-md border border-transparent py-2 px-4 text-sm font-medium shadow-sm bg-[<?=$system->SystemSettings["button_bg"]?>]  text-[<?=$system->SystemSettings["button_color"]?>] align-middle inline-block rounded-md p-3 hover:text-[<?=$system->SystemSettings["button_color:hover"]?>] hover:bg-[<?=$system->SystemSettings["button_bg:hover"]?>] hover:cursor-pointer"><ion-icon name="save" class="inline-block align-middle"></ion-icon>  <?=constant("SAVE");?></button>
	 		</div>
		</form>
	</div>
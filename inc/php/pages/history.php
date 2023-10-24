<?php
if(!in_array("gam_history",$LoginPermission)){
	echo'<meta http-equiv="refresh" content="0;url=?page=main"> ';
}

$games = new Games();
$gameArray = $games->GetHistoryGames();

?>
<style>
    .hidden-div {
        display: none;
        background-color: lightblue;
        padding: 20px;
        transition: max-height 0.5s ease-in-out, opacity 0.5s ease-in-out;
        max-height: 0;
        opacity: 0;
    }
</style>
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
          href="?page=calendar"
        >
          <?=EVENTS?>
        </a>
      </li>
    </ol>
  </nav>
</div>

<h1 class="text-center text-4xl text-[<?=$system->SystemSettings["color_2"]?>] font-bold mt-6 mb-6"><?=EVENTS?></h1>
<hr class="w-[10%] mx-auto ">
<div class="text-center p-4">
<a href="?pages=main" class="text-[<?=$system->SystemSettings["link_color"]?>] hover:text-[<?=$system->SystemSettings["link_color:hover"]?>]"><ion-icon name="chevron-back" class="inline-block align-middle text-xl"></ion-icon> <?=constant("BACK");?></a>
</div>


<?php
	if(is_array($gameArray) && !empty($gameArray)){
?>
<div class="w-[90%] md:w-full relative overflow-x-auto shadow-md container mx-auto mt-5 mb-5">
    <input type="text" id="vyhledavaci-input" class="h-15 mt-5 mb-5 px-2 py-5 block w-full flex-1 rounded-md text-[<?=$system->SystemSettings["input_color"]?>] bg-[<?=$system->SystemSettings["input_bg"]?>] p-2 sm:text-sm" placeholder="Vyhledat podle názvu a data">

    <table id="data-tabulka" class="w-full text-sm text-left text-[<?=$system->SystemSettings["color_1"]?>]">
        <tbody>
			<?php
			foreach($gameArray as $game){
			?>
        <tbody>
        <tr class="bg-[<?=$system->SystemSettings["table_body_bg"]?>] text-[<?=$system->SystemSettings["table_body_color"]?>] border-b border-[<?=$system->SystemSettings["table_body_border"]?>]">
            <td class="px-6 py-4">
                <h2 class="font-bold text-xl text-[<?=$system->SystemSettings["table_head_color"]?>] uppercase "><?=$game["Game_Name"]?></h2>
                <?=date("d.m.Y",$game["Game_Date"])?>
            </td>
            <td class="px-6 py-4 min-w-full">
                <p class="text-[<?=$system->SystemSettings["table_body_color"]?>]"><span class="font-bold text-gray-500 text-md">Zahájení:</span> <?=date("H:i",$game["Game_Date"])?></p>
                <p class="text-[<?=$system->SystemSettings["table_body_color"]?>]"><span class="font-bold text-gray-500 text-md">Místo:</span> <?=(!empty($game["Game_Location"]) && substr($game["Game_Location"], 0, 4) === "http")?"<a class='text-[".$system->SystemSettings["link_color"]."] hover:text-[".$system->SystemSettings["link_color:hover"]."] hover:underline' href='".$game["Game_Location"]."'>odkaz</a>":$game["Game_Location"]?></p>
                <p class="text-[<?=$system->SystemSettings["table_body_color"]?>]"><span class="font-bold text-gray-500 text-md">Limity:</span> <?=$game["Game_Limits"]?></p>
                <p class="text-[<?=$system->SystemSettings["table_body_color"]?>]"><span class="font-bold text-gray-500 text-md">Web:</span> <?=!empty($game["Game_Location"])?"<a class='text-[".$system->SystemSettings["link_color"]."] hover:text-[".$system->SystemSettings["link_color:hover"]."] hover:underline' href='".$game["Game_Web"]."'>odkaz</a>":""?></p>
                <p class="text-[<?=$system->SystemSettings["table_body_color"]?>]"><span class="font-bold text-gray-500 text-md">Popis:</span> <?=$game["Game_Descript"]?></p>
            </td>
            <?php
            if($modules->VerifyModule("STA") == 1 && in_array("stats_display",$LoginPermission)){
                $stats = new Stats($game["Game_ID"]);
                $average  = $stats->GetAnonymous("Complete")
                ?>
            <td class="px-6 py-4">
                <div class="grid grid-cols-1 gap-6">
                    <div class="col-span-3 sm:col-span-2">
                        <label for="name" class="block text-sm font-medium text-[<?=$system->SystemSettings["color_1"]?>]">Celokvé hodnocení</label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <div class="hodnoceni">
                                <input type="radio" id="id<?=$game["Game_ID"]?>1" name="com<?=$game["Game_ID"]?>" <?=($average == 5)?"checked":""?> disabled>
                                <label for="id<?=$game["Game_ID"]?>1"></label>
                                <input type="radio" id="id<?=$game["Game_ID"]?>2" name="com<?=$game["Game_ID"]?>" <?=($average == 4)?"checked":""?> disabled>
                                <label for="id<?=$game["Game_ID"]?>2"></label>
                                <input type="radio" id="id<?=$game["Game_ID"]?>3" name="com<?=$game["Game_ID"]?>" <?=($average == 3)?"checked":""?> disabled>
                                <label for="id<?=$game["Game_ID"]?>3"></label>
                                <input type="radio" id="id<?=$game["Game_ID"]?>4" name="com<?=$game["Game_ID"]?>" <?=($average == 2)?"checked":""?> disabled>
                                <label for="id<?=$game["Game_ID"]?>4"></label>
                                <input type="radio" id="id<?=$game["Game_ID"]?>5" name="com<?=$game["Game_ID"]?>" <?=($average == 1)?"checked":""?> disabled>
                                <label for="id<?=$game["Game_ID"]?>5"></label>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                if(in_array("stats_displaydetail",$LoginPermission)){
                    ?>
                    <span onclick="OpenDetail(<?=$game["Game_ID"]?>)" class="font-medium my-3 text-[<?=$system->SystemSettings["link_color"]?>] hover:text-[<?=$system->SystemSettings["link_color:hover"]?>] hover:underline cursor-pointer" id="OpenDetailButton-<?=$game["Game_ID"]?>"><ion-icon name="caret-down" class="inline-block align-middle"></ion-icon> Otevřít detail</span>
                    <span onclick="CloseDetail(<?=$game["Game_ID"]?>)" class="font-medium my-3 text-[<?=$system->SystemSettings["link_color"]?>] hover:text-[<?=$system->SystemSettings["link_color:hover"]?>] hover:underline cursor-pointer hidden" id="CloseDetailButton-<?=$game["Game_ID"]?>"><ion-icon name="caret-up" class="inline-block align-middle"></ion-icon> Zavřít detail</span>
                    <div id="detail-<?=$game["Game_ID"]?>" class="hidden overflow-hidden transition-all duration-500 ease-in-out">
                        <div class="grid grid-cols-1 gap-6 mt-3">

                            <?php
                            $sta = array(
                                    array("letter" => "P", "name" => "Players", "label"=>"Průměrné hodnocení hráčů"),
                                    array("letter" => "G", "name" => "Ground" , "label"=>"Průměrné hodnocení hřiště"),
                                    array("letter" => "T", "name" => "Team", "label"=>"Průměrné hodnocení členů týmu"),
                                    array("letter" => "M", "name" => "Managment", "label"=>"Průměrné hodnocení vedení týmu")
                            );
                            for($i = 0; $i < 4; $i++){
                            ?>
                            <div class="col-span-3 sm:col-span-2">
                                <label for="name" class="block text-sm font-medium text-[<?=$system->SystemSettings["color_1"]?>]"><?=$sta[$i]["label"]?></label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <div class="hodnoceni">
                                        <?php
                                        $p = $stats->GetAnonymous($sta[$i]["name"]);
                                        ?>
                                        <input type="radio" id="id<?=$sta[$i]["letter"].$game["Game_ID"]?>1" <?=($p == 5)?"checked":""?> disabled>
                                        <label for="id<?=$sta[$i]["letter"].$game["Game_ID"]?>1"></label>
                                        <input type="radio" id="id<?=$sta[$i]["letter"].$game["Game_ID"]?>2" <?=($p == 4)?"checked":""?> disabled>
                                        <label for="id<?=$sta[$i]["letter"].$game["Game_ID"]?>2"></label>
                                        <input type="radio" id="id<?=$sta[$i]["letter"].$game["Game_ID"]?>3" <?=($p == 3)?"checked":""?> disabled>
                                        <label for="id<?=$sta[$i]["letter"].$game["Game_ID"]?>3"></label>
                                        <input type="radio" id="id<?=$sta[$i]["letter"].$game["Game_ID"]?>4" <?=($p == 2)?"checked":""?> disabled>
                                        <label for="id<?=$sta[$i]["letter"].$game["Game_ID"]?>4"></label>
                                        <input type="radio" id="id<?=$sta[$i]["letter"].$game["Game_ID"]?>5" <?=($p == 1)?"checked":""?> disabled>
                                        <label for="id<?=$sta[$i]["letter"].$game["Game_ID"]?>5"></label>
                                    </div>
                                </div>
                            </div>
                            <?php
                                $p="";
                            }
                            ?>
                            <div class="col-span-3 sm:col-span-2">
                                <label for="name" class="block text-sm font-medium text-[<?=$system->SystemSettings["color_1"]?>]">Průměrně hodnocení podvodníků na hřišti</label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <div class="hodnoceni">
                                        <?php
                                        $p = $stats->GetAnonymous("Cheater");
                                        ?>
                                       <span><?=($p == 1)?"Ano":"Ne"?></span>
                                    </div>
                                </div>
                            </div>
                            <?php $bckData = $stats->GetStatsNanAAll(); ?>
                            <div class="col-span-3 sm:col-span-2">
                                <label for="name" class="block text-sm font-medium text-[<?=$system->SystemSettings["color_1"]?>]">Průměrně počet zabití</label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <div class="hodnoceni">
                                        <span><?=$bckData["k"]?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-3 sm:col-span-2">
                                <label for="name" class="block text-sm font-medium text-[<?=$system->SystemSettings["color_1"]?>]">Průměrně počet úmrtí</label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <div class="hodnoceni">
                                        <span><?=$bckData["d"]?></span>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                    <?php
                }
                ?>
            </td>
            <?php
            }
            $user = $loginUser;
            $userInfo = $user->InfoUser();
            if($modules->VerifyModule("STA") == 1 && in_array("stats_ratinggame",$LoginPermission)){
                $stats = new Stats($game["Game_ID"],$userInfo[0]["User_ID"]);
                ?>
            <td class="px-6 py-4 text-center">
                <?php
                if($games->ControllAttendanceComplete($userInfo[0]["User_ID"],$game["Game_ID"]) && $stats->Controll()){
                ?>
                    <a href="?page=ratingevent&id=<?=$game["Game_ID"]?>" class="justify-center rounded-md border border-transparent py-2 px-4 text-sm font-medium shadow-sm bg-[<?=$system->SystemSettings["button_bg"]?>]  text-[<?=$system->SystemSettings["button_color"]?>] align-middle inline-block rounded-md p-3 hover:text-[<?=$system->SystemSettings["button_color:hover"]?>] hover:bg-[<?=$system->SystemSettings["button_bg:hover"]?>] hover:cursor-pointer"><ion-icon name="star" class="inline-block align-middle"></ion-icon>  <?=constant("RATING");?></a>
                <?php
                }
                ?>
            </td>
            <?php
            }
            ?>
        </tr>
			<?php
			}
			?>
        </tbody>
    </table>
</div>

        <script>
            const input = document.getElementById("vyhledavaci-input");
            const tabulka = document.getElementById("data-tabulka");
            const radky = tabulka.getElementsByTagName("tr");

            input.addEventListener("keyup", function() {
                const hledanyText = input.value.toLowerCase();

                for (let i = 0; i < radky.length; i++) {
                    const radek = radky[i];
                    const nazev = radek.getElementsByTagName("td")[0];

                    if (nazev) {
                        const textNazvu = nazev.textContent.toLowerCase();
                        if (textNazvu.includes(hledanyText)) {
                            radek.style.display = "";
                        } else {
                            radek.style.display = "none";
                        }
                    }
                }
            });

            function OpenDetail(id){

                detail = document.getElementById("detail-"+id);
                openButton = document.getElementById("OpenDetailButton-"+id);
                closeButton = document.getElementById("CloseDetailButton-"+id);

                detail.classList.remove("hidden");
                detail.classList.add('animate__animated', 'animate__fadeIn');
                openButton.classList.add("hidden");
                closeButton.classList.remove("hidden");

            }
            function CloseDetail(id){
                detail = document.getElementById("detail-"+id);
                openButton = document.getElementById("OpenDetailButton-"+id);
                closeButton = document.getElementById("CloseDetailButton-"+id);

                detail.classList.add('animate__animated', 'animate__fadeOut');
                setTimeout(function() {
                    detail.classList.add('hidden');
                    detail.classList.remove('animate__fadeOut');
                }, 1000);

                openButton.classList.remove("hidden");
                closeButton.classList.add("hidden");
            }
        </script>
<?php
	} else {
        echo $system->GetMessage("GAM200");
	}
?>
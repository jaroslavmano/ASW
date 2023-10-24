<?php
    $bck = "games";
    if(!in_array("gam_create",$LoginPermission) && (!isset($_GET["id"]) || empty($_GET["id"]) )){
        echo'<meta http-equiv="refresh" content="0;url=?page=games"> ';
    } elseif ((!in_array("gam_edit",$LoginPermission) && !in_array("gam_matching",$LoginPermission)) && isset($_GET["id"])){
        echo'<meta http-equiv="refresh" content="0;url=?page=game"> ';
    }

    if(isset($_GET["id"])){
        $game = new Games($_GET["id"]);
    } else {
        $game = new Games();
    }

    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        $click = "CTRL";
    } else {
        $click = "COMMAND";
    }

if(isset($_POST["SaveIGame"])){
	if(isset($_GET["id"])){
		$result = $game->Update($_POST["game"],strtotime($_POST["date"]),$_POST["limits"],$_POST["location"],$_POST["tickets"],$_POST["web"],$_POST["descript"]);
		if($result === true){
			$_SESSION["msg"] = $system->GetMessage("GAM002");
			unset($_POST);
            $game = new Games($_GET["id"]);
			//echo'<meta http-equiv="refresh" content="0;url=?page=game&id='.$_GET["id"].'&msg=1"> ';
		} else {
			echo $system->GetMessage("GAM202");
		}
	} else {
		echo $type;
		$result = $game->Create($_POST["game"],strtotime($_POST["date"]),$_POST["limits"],$_POST["location"],$_POST["tickets"],$_POST["web"],$_POST["descript"]);
		
		if($result !== false && isset($result)){
			$_SESSION["msg"] = $system->GetMessage("GAM001");
			echo'<meta http-equiv="refresh" content="0;url=?page=game&id='.$result.'&msg=1"> ';
			//header("Refresh:0; url=?page=group&id=".$result);
		} else {
			echo $system->GetMessage("GAM201");
		}
	}
}

if(isset($_POST["SaveGroupsGame"])){
    unset($_POST["SaveGroupsGame"]);
    $result = $game->GameUpdateGroups($_POST["groups"]);
    if($result === true){
        $_SESSION["msg"] = $system->GetMessage("GAM004");
        unset($_POST);
    } else {
        echo $system->GetMessage("GAM204ß");
    }
}

$info = $game->Info();
if($info === false && isset($_GET["id"])){
	echo'<meta http-equiv="refresh" content="0;url=?page=games"> ';
}
if(isset($_GET["id"])){
	$type =1;
	$title = "Úprava hry | ".$info["Game_Name"] . " (".date("d.m.Y", $info["Game_Date"]).")";
} else {
	$type =0;
	$title = "Tvorba nové hry";
}
?>
<style>
    .autocomplete-items {
        border: 1px solid #d4d4d4;
        border-top: none;
        background: #d4d4d4;
        max-height: 150px;
        overflow-y: auto;
        position: absolute;
        top: 60px;
        left: 20px;
        width: 90%;
    }
    .autocomplete-item {
        padding: 10px;
        text-align: left;
        cursor: pointer;
    }
    .autocomplete-item:hover {
        background-color: gray;
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
      <li class="flex cursor-pointer items-center font-sans text-sm font-normal leading-normal text-[<?=$system->SystemSettings["map_color"]?>] antialiased transition-colors duration-300 hover:text-[<?=$system->SystemSettings["map_color:hover"]?>]">
        <a class="opacity-60" href="?page=<?=$bck?>">
          Správa her
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
<a href="?page=<?=$bck?>" class="text-[<?=$system->SystemSettings["link_color"]?>] hover:text-[<?=$system->SystemSettings["link_color:hover"]?>]"><ion-icon name="chevron-back" class="inline-block align-middle text-xl"></ion-icon> <?=constant("BACK");?></a>
	<?php
	if(isset($_SESSION["msg"]) && empty($_POST)){
		echo $_SESSION["msg"];
		unset($_SESSION["msg"]);
	}
	?>
</div>

	<div class="space-y-6 container mx-auto px-4 py-5 ">
        <?php if(in_array("gam_edit",$LoginPermission)){ ?>
		<form method="post" action="">
			<h1 class="text-xl text-[<?=$system->SystemSettings["color_2"]?>] font-bold">Informace o hře</h1>
			<div class="pl-3 space-y-4">
				<div class="grid grid-cols-1 gap-6 block relative">
					<div class="col-span-3 sm:col-span-2">
						<label for="name" class="block text-sm font-medium text-[<?=$system->SystemSettings["color_1"]?>]"><?=constant("NAME");?>:</label>
						<div class="mt-1 flex rounded-md shadow-sm">
							<input type="text" name="game" id="game" autocomplete="off" maxlength="30" <?=!isset($_GET["id"])?'onkeyup="showOptions()"':""?> class="block w-full flex-1 rounded-md text-[<?=$system->SystemSettings["input_color"]?>] bg-[<?=$system->SystemSettings["input_bg"]?>] p-2 sm:text-sm" placeholder="Kosovo" <?=($type == 1)? "value='".$info["Game_Name"]."'":"" ?> required />
						</div>
					</div>
                    <?=!isset($_GET["id"])?'<div id="autocomplete-list" class="autocomplete-items" style="display: none;"></div>':""?>
				</div>
				<div class="grid grid-cols-1 gap-6">
					<div class="col-span-3 sm:col-span-2">
						<label for="short" class="block text-sm font-medium text-[<?=$system->SystemSettings["color_1"]?>]"><?=constant("DATE");?>:</label>
						<div class="mt-1 flex rounded-md shadow-sm">
							<input type="datetime-local" name="date" class="block w-full flex-1 rounded-md text-[<?=$system->SystemSettings["input_color"]?>] bg-[<?=$system->SystemSettings["input_bg"]?>] p-2 sm:text-sm" placeholder="ASW" <?=($type == 1)? "value='".date("Y-m-d H:i",$info["Game_Date"])."'":"" ?> required />
						</div>
					</div>
				</div>
                <div class="grid grid-cols-1 gap-6">
                    <div class="col-span-3 sm:col-span-2">
                        <label for="short" class="block text-sm font-medium text-[<?=$system->SystemSettings["color_1"]?>]"><?=constant("LIMITS_GUNS");?>:</label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <input type="text" name="limits" id="limits" class="block w-full flex-1 rounded-md text-[<?=$system->SystemSettings["input_color"]?>] bg-[<?=$system->SystemSettings["input_bg"]?>] p-2 sm:text-sm"  <?=($type == 1)? "value='".$info["Game_Limits"]."'":"" ?> required />
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-6">
                    <div class="col-span-3 sm:col-span-2">
                        <label for="short" class="block text-sm font-medium text-[<?=$system->SystemSettings["color_1"]?>]"><?=constant("LOCATION");?>:</label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <input type="text" maxlength="800" name="location" id="location" class="block w-full flex-1 rounded-md text-[<?=$system->SystemSettings["input_color"]?>] bg-[<?=$system->SystemSettings["input_bg"]?>] p-2 sm:text-sm" placeholder="Buď Text nebo odkaz" <?=($type == 1)? "value='".$info["Game_Location"]."'":"" ?> required />
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-6">
                    <div class="col-span-3 sm:col-span-2">
                        <label for="short" class="block text-sm font-medium text-[<?=$system->SystemSettings["color_1"]?>]"><?=constant("TICKETS");?>:</label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <input type="text" maxlength="800" name="tickets" class="block w-full flex-1 rounded-md text-[<?=$system->SystemSettings["input_color"]?>] bg-[<?=$system->SystemSettings["input_bg"]?>] p-2 sm:text-sm" placeholder="Buď Text nebo odkaz" <?=($type == 1)? "value='".$info["Game_Tickets"]."'":"" ?> required />
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-6">
                    <div class="col-span-3 sm:col-span-2">
                        <label for="short" class="block text-sm font-medium text-[<?=$system->SystemSettings["color_1"]?>]">Web:</label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <input type="text" maxlength="800" name="web" class="block w-full flex-1 rounded-md text-[<?=$system->SystemSettings["input_color"]?>] bg-[<?=$system->SystemSettings["input_bg"]?>] p-2 sm:text-sm" placeholder="Odkaz" <?=($type == 1)? "value='".$info["Game_Web"]."'":"" ?> />
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-6">
                    <div class="col-span-3 sm:col-span-2">
                        <label for="short" class="block text-sm font-medium text-[<?=$system->SystemSettings["color_1"]?>]">Popis:</label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <textarea id="descript" name="descript" rows="3" class="block w-full flex-1 rounded-md text-[<?=$system->SystemSettings["input_color"]?>] bg-[<?=$system->SystemSettings["input_bg"]?>] p-2 sm:text-sm" /><?=($type == 1)?$info["Game_Descript"]:""?></textarea>
                        </div>
                    </div>
                </div>
            </div>
			<div class="px-4 py-3 text-right sm:px-6">
				<button type="submit" name="SaveIGame" class="justify-center rounded-md border border-transparent py-2 px-4 text-sm font-medium shadow-sm bg-[<?=$system->SystemSettings["button_bg"]?>]  text-[<?=$system->SystemSettings["button_color"]?>] align-middle inline-block rounded-md p-3 hover:text-[<?=$system->SystemSettings["button_color:hover"]?>] hover:bg-[<?=$system->SystemSettings["button_bg:hover"]?>] hover:cursor-pointer"><ion-icon name="save" class="inline-block align-middle"></ion-icon>  <?=constant("SAVE");?></button>
	 		</div>
		</form>
        <?php
        }
        if(in_array("gam_matching",$LoginPermission) && isset($_GET["id"])){
        ?>
            <div class="space-y-6 container mx-auto px-4 py-5 ">
                <form method="post" action="">
                    <h1 class="text-xl text-[<?=$system->SystemSettings["color_2"]?>] font-bold">Platí Skupiny:</h1>
                    <div class="pl-3 space-y-4">
                        <div class="relative flex w-full">
                            <?php
                            $groups = new Groups();

                            $groupslist = $groups->GetGroups();

                            if($groupslist !== false){
                                echo '<select id="groups" name="groups[]" class=" block w-full flex-1 rounded-md text-['.$system->SystemSettings["input_color"].'] bg-['.$system->SystemSettings["input_bg"].'] p-2 sm:text-sm" required multiple>';

                                foreach($groupslist as $groupInfo){
                                    $add="";
                                    if(in_array($groupInfo["Group_ID"],$game->GameGroups())){
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
                        <button type="submit" name="SaveGroupsGame" class="justify-center rounded-md border border-transparent py-2 px-4 text-sm font-medium shadow-sm bg-[<?=$system->SystemSettings["button_bg"]?>]  text-[<?=$system->SystemSettings["button_color"]?>] align-middle inline-block rounded-md p-3 hover:text-[<?=$system->SystemSettings["button_color:hover"]?>] hover:bg-[<?=$system->SystemSettings["button_bg:hover"]?>] hover:cursor-pointer"><ion-icon name="save" class="inline-block align-middle"></ion-icon>  <?=constant("SAVE");?></button>
                    </div>
                </form>
            </div>
        <?php
        }
        ?>
	</div>

<?php
if(!isset($_GET["id"])){

?>
<script>
    const input1 = document.getElementById('game');
    const input2 = document.getElementById('limits');
    const input3 = document.getElementById('location');
    const suggestions = document.getElementById('autocomplete-list');

    // Simulace návrhů pro první input
    const suggestionsData = <?=$game->GetGamesBasicInfo()?>;

    // Funkce pro zobrazení návrhů z druhého indexu vnořeného pole
    function showSecondSuggestions(data) {
        suggestions.innerHTML = '';
        data.forEach(subArray => {
            const firstItem = subArray[0];
            const li = document.createElement('div');
            li.textContent = firstItem;
            li.className += "autocomplete-item";
            li.addEventListener('click', () => {
                input1.value = firstItem;
                input2.value = subArray[1];
                input3.value = subArray[2];
                suggestions.style.display = 'none';
            });
            suggestions.appendChild(li);
        });
        suggestions.style.display = 'block';
    }

    // Naslouchání událostem pro první input
    input1.addEventListener('input', () => {
        const value = input1.value.toLowerCase();
        const filteredSuggestions = suggestionsData
            .filter(subArray => subArray[0].toLowerCase().includes(value));
        showSecondSuggestions(filteredSuggestions);
    });


    // Nemáme návrhy pro druhý input, takže nemáme pro něj žádný kód
</script>
<?php
}
    ?>
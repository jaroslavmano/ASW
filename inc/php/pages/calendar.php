<?php
if(!in_array("gam_calendar",$LoginPermission)){
	echo'<meta http-equiv="refresh" content="0;url=?page=main"> ';
}
$user = $loginUser;
$groups = $user->UserGroups();
$games = new Games();
$gameArray = $games->GamesByGroups($groups, true);

if(isset($_POST["SaveAcceptGame"]) && isset($_POST["id"])){
    $result = $games->AddAttendance("1",$user->id,$_POST["id"]);

    if($result){
        $_SESSION["msg"] = $system->GetMessage("GAM005");
    } else {
        $_SESSION["msg"] = $system->GetMessage("GAM205");
    }
    unset($_POST);
    echo'<meta http-equiv="refresh" content="0;url=?page=calendar"> ';
}
if(isset($_POST["SaveDeclimeGame"]) && isset($_POST["id"]) && $_POST["reason"]){
    $result = $games->AddAttendance("2",$user->id,$_POST["id"],$_POST["reason"]);

    if($result){
        $_SESSION["msg"] = $system->GetMessage("GAM005");
    } else {
        $_SESSION["msg"] = $system->GetMessage("GAM205");
    }
    unset($_POST);
    echo'<meta http-equiv="refresh" content="0;url=?page=calendar"> ';
}
if(isset($_POST["SaveResetGame"]) && isset($_POST["id"])){
    $result = $games->RemoveAttendance($user->id,$_POST["id"]);

    if($result){
        $_SESSION["msg"] = $system->GetMessage("GAM006");
    } else {
        $_SESSION["msg"] = $system->GetMessage("GAM206");
    }
    unset($_POST);
    echo'<meta http-equiv="refresh" content="0;url=?page=calendar"> ';
}
?>
    <style>
        /* Styly pro modální okno */
        .modal {
            display: none;
            z-index: 10;
            position: absolute;
            top:0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            width: 80%;
            border-radius: 10px 10px 0 0;
            padding: 20px;
            text-align: center;
            position: absolute;
            bottom: 0%;
            left: 50%;
            transform: translate(-50%, -0%);
        }

        #closeModal {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }

    </style>
    <!-- Modální okno -->
    <div id="myModal" class="modal">
        <div class="modal-content bg-[<?=$system->SystemSettings["menu/foot_bg"]?>] text-[<?=$system->SystemSettings["table_body_color"]?>]">
            <span id="closeModal">Zavřít</span>
            <h2>Neúčast na akci</h2>
            <form method="post" action="">
                <input name="id" id="gameid" type="hidden" value="">
                <div class="grid grid-cols-1 gap-6">
                    <div class="col-span-3 sm:col-span-2">
                        <label for="reason" class="block text-sm font-medium text-[<?=$system->SystemSettings["color_1"]?>]">Důvod neúčasti: <small>(max 100 znaků)</small></label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <textarea id="reason" name="reason" rows="3" class="block w-full flex-1 rounded-md text-[<?=$system->SystemSettings["input_color"]?>] bg-[<?=$system->SystemSettings["input_bg"]?>] p-2 sm:text-sm" required /></textarea>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 text-right sm:px-6">
                    <button type="submit" name="SaveDeclimeGame" class="justify-center rounded-md border border-transparent py-2 px-4 text-sm font-medium shadow-sm bg-[<?=$system->SystemSettings["button_bg"]?>]  text-[<?=$system->SystemSettings["button_color"]?>] align-middle inline-block rounded-md p-3 hover:text-[<?=$system->SystemSettings["button_color:hover"]?>] hover:bg-[<?=$system->SystemSettings["button_bg:hover"]?>] hover:cursor-pointer"><ion-icon name="save" class="inline-block align-middle"></ion-icon>  <?=constant("SAVE");?></button>
                </div>
            </form>
        </div>
    </div>

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
          <?=CALENDAR?>
        </a>
      </li>
    </ol>
  </nav>
</div>

<h1 class="text-center text-4xl text-[<?=$system->SystemSettings["color_2"]?>] font-bold mt-6 mb-6"><?=CALENDAR?></h1>
<hr class="w-[10%] mx-auto ">
<div class="text-center p-4">
<a href="?pages=main" class="text-[<?=$system->SystemSettings["link_color"]?>] hover:text-[<?=$system->SystemSettings["link_color:hover"]?>]"><ion-icon name="chevron-back" class="inline-block align-middle text-xl"></ion-icon> <?=constant("BACK");?></a>
</div>


<?php
	if(is_array($gameArray) && !empty($gameArray)){
?>
<div class="w-[90%] md:w-full relative overflow-x-auto shadow-md container mx-auto mt-5 mb-5">
    <table class="w-full text-sm text-left text-[<?=$system->SystemSettings["color_1"]?>]">
        <tbody>
			<?php
			foreach($gameArray as $game){
                $game = new Games($game);
                $info = $game->Info();
                $controlButtons = $game->ControllAttendance($user->id);
			?>
        <tbody>
        <tr class="bg-[<?=$system->SystemSettings["table_body_bg"]?>] text-[<?=$system->SystemSettings["table_body_color"]?>] border-b border-[<?=$system->SystemSettings["table_body_border"]?>]">
            <td class="px-6 py-4">
                <h2 class="font-bold text-xl text-[<?=$system->SystemSettings["table_head_color"]?>] uppercase "><?=$info["Game_Name"]?></h2>
                <?=date("d.m.Y",$info["Game_Date"])?>
            </td>
            <td class="px-6 py-4 min-w-full">
                <p class="text-[<?=$system->SystemSettings["table_body_color"]?>]"><span class="font-bold text-gray-500 text-md">Zahájení:</span> <?=date("H:i",$info["Game_Date"])?></p>
                <p class="text-[<?=$system->SystemSettings["table_body_color"]?>]"><span class="font-bold text-gray-500 text-md">Místo:</span> <?=(!empty($info["Game_Location"]) && substr($info["Game_Location"], 0, 4) === "http")?"<a class='text-[".$system->SystemSettings["link_color"]."] hover:text-[".$system->SystemSettings["link_color:hover"]."] hover:underline' href='".$info["Game_Location"]."'>odkaz</a>":$info["Game_Location"]?></p>
                <p class="text-[<?=$system->SystemSettings["table_body_color"]?>]"><span class="font-bold text-gray-500 text-md">Vstupné:</span> <?=(!empty($info["Game_Tickets"]) && substr($info["Game_Tickets"], 0, 4) === "http")?"<a class='text-[".$system->SystemSettings["link_color"]."] hover:text-[".$system->SystemSettings["link_color:hover"]."] hover:underline' href='".$info["Game_Tickets"]."'>odkaz</a>":$info["Game_Tickets"]?></p>
                <p class="text-[<?=$system->SystemSettings["table_body_color"]?>]"><span class="font-bold text-gray-500 text-md">Web:</span> <?=(!empty($info["Game_Web"]))?"<a class='text-[".$system->SystemSettings["link_color"]."] hover:text-[".$system->SystemSettings["link_color:hover"]."] hover:underline' href='".$info["Game_Web"]."'>odkaz</a>":""?></p>
                <p class="text-[<?=$system->SystemSettings["table_body_color"]?>]"><span class="font-bold text-gray-500 text-md">Limity:</span> <?=$info["Game_Limits"]?></p>
                <p class="text-[<?=$system->SystemSettings["table_body_color"]?>]"><span class="font-bold text-gray-500 text-md">Popis:</span> <?=(!empty($info["Game_Descript"]))?$info["Game_Tickets"]:""?></p>
            </td>
            <td class="px-6 py-4 text-center">
                <?php if($controlButtons == false && in_array("gam_attendance",$LoginPermission)){ ?>
                <button onclick="AcceptGame('<?=$info["Game_ID"]?>')" class="justify-center mt-2 mb-2 rounded-md border border-transparent py-2 px-4 text-sm font-medium shadow-sm bg-[<?=$system->SystemSettings["accept_button_bg"]?>] text-[<?=$system->SystemSettings["accept_button_text"]?>]  align-middle inline-block rounded-md p-3 hover:bg-[<?=$system->SystemSettings["accept_button_bg:hover"]?>] hover:cursor-pointer  focus:outline-none focus:ring-2 focus:bg-gray-900 focus:ring-offset-2"><ion-icon name="checkmark" class="inline-block align-middle md hydrated" role="img" aria-label="checkmark"></ion-icon>  Potvrdit účast</button>
                <button  onclick="DeclimeGame('<?=$info["Game_ID"]?>')" class="justify-center mt-2 mb-2 rounded-md border border-transparent py-2 px-4 text-sm font-medium shadow-sm bg-[<?=$system->SystemSettings["declime_button_bg"]?>] text-[<?=$system->SystemSettings["declime_button_text"]?>] align-middle inline-block rounded-md p-3 hover:bg-[<?=$system->SystemSettings["declime_button_bg:hover"]?>] hover:cursor-pointer  focus:outline-none focus:ring-2 focus:bg-red-700 focus:ring-offset-2"><ion-icon name="close" class="inline-block align-middle md hydrated" role="img" aria-label="close"></ion-icon>  Odmítnout účast</button>
                <?php } elseif( in_array("gam_attendance",$LoginPermission)) {
                    $typ = ($controlButtons["GA_Answer"]==1)?"POTVRZENA":"ODMÍTNUTA";
                    echo "<p>Vaše účast je: ".$typ."</p>";

                    if(in_array("gam_reset",$LoginPermission)){
                    ?>
                    <button onclick="ResetGame('<?=$info["Game_ID"]?>')" class="justify-center mt-2 mb-2 rounded-md border border-transparent py-2 px-4 text-sm font-medium shadow-sm bg-[<?=$system->SystemSettings["reset_button_bg"]?>]  text-[<?=$system->SystemSettings["reset_button_text"]?>]  align-middle inline-block rounded-md p-3 hover:bg-[<?=$system->SystemSettings["reset_button_bg:hover"]?>] hover:cursor-pointer  focus:outline-none focus:ring-2 focus:bg-gray-900 focus:ring-offset-2"><ion-icon name="refresh" class="inline-block align-middle md hydrated" role="img" aria-label="refresh"></ion-icon>  Vártit účast</button>
                <?php }
                } ?>

            </td>
        </tr>
			<?php
			}
			?>
        </tbody>
    </table>
</div>

        <script>
            <?php
            if(in_array("gam_attendance",$LoginPermission)){
            ?>
            var modal = document.getElementById('myModal');
            var closeModalButton = document.getElementById('closeModal');
            modal.style.display = 'none';

            closeModalButton.addEventListener('click', function() {
                modal.style.display = 'none';
            });

            function AcceptGame(id) {
                // Vytvoření formuláře
                var form = document.createElement('form');
                form.setAttribute('method', 'post');
                form.style.display = 'none';

                var idInput = document.createElement('input');
                idInput.setAttribute('type', 'hidden');
                idInput.setAttribute('name', 'id');
                idInput.setAttribute('value', id);

                form.appendChild(idInput);

                var typeInput = document.createElement('input');
                typeInput.setAttribute('type', 'hidden');
                typeInput.setAttribute('name', 'SaveAcceptGame');
                typeInput.setAttribute('value', true);
                form.appendChild(typeInput);

                // Přidání formuláře do těla dokumentu
                document.body.appendChild(form);

                // Odeslání formuláře
                form.submit();
            };
            function DeclimeGame(id){
                var sendMessageButton = document.getElementById('sendMessage');
                var GameInput = document.getElementById('gameid');
                GameInput.value = id;
                modal.style.display = 'block';
            }
            <?php } ?>
            <?php
            if(in_array("gam_reset",$LoginPermission)){
            ?>
            function ResetGame(id) {
                var form = document.createElement('form');
                form.setAttribute('method', 'post');
                form.style.display = 'none';

                var idInput = document.createElement('input');
                idInput.setAttribute('type', 'hidden');
                idInput.setAttribute('name', 'id');
                idInput.setAttribute('value', id);

                form.appendChild(idInput);

                var typeInput = document.createElement('input');
                typeInput.setAttribute('type', 'hidden');
                typeInput.setAttribute('name', 'SaveResetGame');
                typeInput.setAttribute('value', true);
                form.appendChild(typeInput);

                // Přidání formuláře do těla dokumentu
                document.body.appendChild(form);

                // Odeslání formuláře
                form.submit();
            };
            <?php } ?>
        </script>
<?php
	} else {
        echo $system->GetMessage("GAM200");
	}
?>
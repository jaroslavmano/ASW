<?php
if(!in_array("gam_history",$LoginPermission)){
	echo'<meta http-equiv="refresh" content="0;url=?page=main"> ';
}

$games = new Games();
$gameArray = $games->GetHistoryGames();

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
            </td>
            <td class="px-6 py-4 text-center">
            </td>
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
        </script>
<?php
	} else {
        echo $system->GetMessage("GAM200");
	}
?>
<?php
if(!in_array("gam_displayanswers",$LoginPermission) || !isset($_GET["id"])){
	echo'<meta http-equiv="refresh" content="0;url=?page=games"> ';
}
$user = $loginUser;
$adminUser = $user->InfoUser();
if(isset($_POST["SaveChangeStatusGame"]) && isset($_POST["id"]) && $_POST["type"]){
    $game = new Games();
    $result = $game->ChangeStatusAttendance($_GET["id"],$_POST["id"],$_POST["type"],$adminUser[0]["User_ID"]);

    if($result){
        $_SESSION["msg"] = $system->GetMessage("GAM007");
    } else {
        $_SESSION["msg"] = $system->GetMessage("GAM207");
    }
    unset($_POST);
    echo'<meta http-equiv="refresh" content="0;url=?page=gameattendance&id='.$_GET["id"].'"> ';
}
$gamesClass = new Games($_GET["id"]);
$info = $gamesClass->Info();
$attendance = $gamesClass->GetAttendance();
?>
<div class="w-max text-left">
  <nav aria-label="breadcrumb">
    <ol class="flex w-full flex-wrap items-center rounded-md bg-opacity-60 py-2 px-4">
      <li class="flex cursor-pointer items-center font-sans text-sm font-normal leading-normal text-[<?=$system->SystemSettings["map_color"]?>] antialiased transition-colors duration-300 hover:text-[<?=$system->SystemSettings["map_color:hover"]?>]">
        <a class="opacity-60" href="">
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
            <a
                    class="font-medium text-blue-gray-900 transition-colors"
                    href="?page=games"
            >
                <?=constant("GAMES");?>
            </a>
          <span class="pointer-events-none mx-2 select-none font-sans text-sm font-normal leading-normal text-zinc-400 antialiased">
          /
        </span>
        </li>
        <li class="flex cursor-pointer items-center font-sans text-sm font-normal leading-normal text-[<?=$system->SystemSettings["map_color:active"]?>] antialiased transition-colors duration-300 hover:text-[<?=$system->SystemSettings["map_color:hover"]?>]">
            <a
                    class="font-medium text-blue-gray-900 transition-colors"
                    href="?page=gameattendance"
            >
                <?=constant("ATTEND");?>
            </a>
        </li>
    </ol>
  </nav>
</div>
<h1 class="text-center text-4xl text-[<?=$system->SystemSettings["color_2"]?>] font-bold mt-6 mb-6"><?=constant("ATTEND");?> | <?=$info["Game_Name"]?> <small>(<?=date("d.m.Y",$info["Game_Date"])?>)</small></h1>
<hr class="w-[10%] mx-auto ">
<div class="text-center p-4">
<a href="?pages=games" class="text-[<?=$system->SystemSettings["link_color"]?>] hover:text-[<?=$system->SystemSettings["link_color:hover"]?>]"><ion-icon name="chevron-back" class="inline-block align-middle text-xl"></ion-icon> <?=constant("BACK");?></a>
</div>

<?php
	if(is_array($attendance)){
?>
<div class="w-[90%] md:w-full relative overflow-x-auto shadow-md container mx-auto mt-5 mb-5">
    <table class="w-full text-sm text-left text-[<?=$system->SystemSettings["color_1"]?>]">
        <thead class="text-xs text-[<?=$system->SystemSettings["table_head_color"]?>] uppercase bg-[<?=$system->SystemSettings["table_head_bg"]?>]">
            <tr>
                <th scope="col" class="px-6 py-3">
                    <?=constant("USER");?>
                </th>
                <th scope="col" class="px-6 py-3">
                    <?=constant("ATTEND");?>
                </th>
                <th scope="col" class="px-6 py-3">
                   <?=constant("LASTEDIT");?>
                </th>
                <th scope="col" class="px-6 py-3">
                    <?=constant("STATUS");?>
                </th>
                <th scope="col" class="px-6 py-3">
                    <?=constant("ACTION");?>
                </th>
            </tr>
        </thead>
        <tbody>
			<?php
			foreach($attendance as $row){
                $user = new User($row["GA_UserID"]);
                $uinfo = $user->InfoUser();
                if(isset($row["GA_AdminUserID"])){
                    $user = new User($row["GA_AdminUserID"]);
                    $ainfo = $user->InfoUser()[0];
                    $aname = $ainfo["User_Username"]." | ". $ainfo["User_ID"];
                } else {
                    $aname = "";
                }
			?>
            <tr class="bg-[<?=$system->SystemSettings["table_body_bg"]?>] text-[<?=$system->SystemSettings["table_body_color"]?>] border-b border-[<?=$system->SystemSettings["table_body_border"]?>]">
                <td class="px-6 py-4">
                    <?=$uinfo[0]["User_Username"]?> | <?=$uinfo[0]["User_ID"]?>
                </td>
                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                    <?=($row["GA_Answer"]==1)?"POTVRZENA":"ODMÍTNUTA"?> <small><?=($row["GA_Answer"]==2)?"(".$row["GA_Apologies"].")":""?></small>
                </th>
                <td class="px-6 py-4">
                    <?=date("d.m.Y H:i",$row["GA_StatusChange"])?>
                </td>
                <td class="px-6 py-4">
                    <?=($row["GA_Status"]==1)?"POTVRZENO":(($row["GA_Status"]==2)?"ZAMÍTNUTO":"ZATÍM NESCHVÁLENO")?> <small><?=($row["GA_Status"] > 0)?"(".$aname.")":""?></small>
                </td>
                <td class="px-6 py-4">
                    <?php
                    if(in_array("gam_manageanswers",$LoginPermission) && $row["GA_Answer"]==1){
                        echo '
							<button onclick="ChangeStatus('.$uinfo[0]["User_ID"].',1)"  class="font-medium text-['.$system->SystemSettings["link_color"].'] hover:text-['.$system->SystemSettings["link_color:hover"].'] hover:underline"><ion-icon name="checkmark-circle" class="inline-block align-middle text-xl"></ion-icon> POTVRDIT</a>
							<br>
							<button onclick="ChangeStatus('.$uinfo[0]["User_ID"].',2)"  class="font-medium text-['.$system->SystemSettings["link_color"].'] hover:text-['.$system->SystemSettings["link_color:hover"].'] hover:underline"><ion-icon name="close-circle" class="inline-block align-middle text-xl"></ion-icon> ZAMÍTNOUT</a>

							';
                    }
                    ?>
                </td>
            </tr>
			<?php
			}
			?>
        </tbody>
    </table>
</div>
<?php
        if(in_array("gam_manageanswers",$LoginPermission)){
            ?>
            <script>

                function ChangeStatus(id, type) {
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
                    typeInput.setAttribute('name', 'type');
                    typeInput.setAttribute('value', type);

                    form.appendChild(typeInput);

                    var typeInput = document.createElement('input');
                    typeInput.setAttribute('type', 'hidden');
                    typeInput.setAttribute('name', 'SaveChangeStatusGame');
                    typeInput.setAttribute('value', true);
                    form.appendChild(typeInput);

                    // Přidání formuláře do těla dokumentu
                    document.body.appendChild(form);

                    // Odeslání formuláře
                    form.submit();
                };
            </script>
            <?php
        }
	} else {
		echo $system->GetMessage("GAM208");
	}
?>
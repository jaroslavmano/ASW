<?php
if(!in_array("groups_manage",$LoginPermission)){
	echo'<meta http-equiv="refresh" content="0;url=?page=main"> ';
}

$groupClass = new Groups();
$groups = $groupClass->GetGroups();
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
      <li class="flex cursor-pointer items-center font-sans text-sm font-normal leading-normal text-[<?=$system->SystemSettings["map_color:active"]?>] antialiased transition-colors duration-300 hover:text-[<?=$system->SystemSettings["map_color:hover"]?>]">
        <a
          class="font-medium text-blue-gray-900 transition-colors"
          href="?page=groups"
        >
          <?=constant("GROUPS");?>
        </a>
      </li>
    </ol>
  </nav>
</div>

<h1 class="text-center text-4xl text-[<?=$system->SystemSettings["color_2"]?>] font-bold mt-6 mb-6"><?=constant("GROUPS");?></h1>
<hr class="w-[10%] mx-auto ">
<div class="text-center p-4">
<a href="?pages=main" class="text-[<?=$system->SystemSettings["link_color"]?>] hover:text-[<?=$system->SystemSettings["link_color:hover"]?>]"><ion-icon name="chevron-back" class="inline-block align-middle text-xl"></ion-icon> <?=constant("BACK");?></a>
</div>
<div class="text-right mr-[5%]">
<?php
	if(in_array("groups_createedit",$LoginPermission)){
		echo '
		<a href="?page=group" class="rounded-md border border-transparent py-2 px-4 text-sm font-medium shadow-sm bg-['.$system->SystemSettings["button_bg"].']  text-['.$system->SystemSettings["button_color"].'] align-middle inline-block rounded-md p-3 hover:text-['.$system->SystemSettings["button_color:hover"].'] hover:bg-['.$system->SystemSettings["button_bg:hover"].'] hover:cursor-pointer"><ion-icon name="add" class="inline-block align-middle"></ion-icon>  '.constant("CREATENEWGROUP").'</a>
		';
		
	}
?>
</div>

<?php
	if(is_array($groups)){
?>
<div class="w-[90%] md:w-full relative overflow-x-auto shadow-md container mx-auto mt-5 mb-5">
    <table class="w-full text-sm text-left text-[<?=$system->SystemSettings["color_1"]?>]">
        <thead class="text-xs text-[<?=$system->SystemSettings["table_head_color"]?>] uppercase bg-[<?=$system->SystemSettings["table_head_bg"]?>]">
            <tr>
                <th scope="col" class="px-6 py-3">
                    <?=constant("ID");?>
                </th>
                <th scope="col" class="px-6 py-3">
                    <?=constant("NAME");?>
                </th>
                <th scope="col" class="px-6 py-3">
                   <?=constant("DESCRIPTION");?>
                </th>
                <th scope="col" class="px-6 py-3">
                    <?=constant("ACTION");?>
                </th>
            </tr>
        </thead>
        <tbody>
			<?php
			foreach($groups as $group){
			?>
            <tr class="bg-[<?=$system->SystemSettings["table_body_bg"]?>] text-[<?=$system->SystemSettings["table_body_color"]?>] border-b border-[<?=$system->SystemSettings["table_body_border"]?>]">
                <td class="px-6 py-4">
                    <?=$group["Group_ID"]?>
                </td>
                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                    <?=$group["Group_Name"]?>
                </th>
                <td class="px-6 py-4">
                     <?=$group["Group_Description"]?>
                </td>
                <td class="px-6 py-4">
					<?php
						if(in_array("groups_createedit",$LoginPermission)){
							echo '
							<a href="?page=group&id='.$group["Group_ID"].'" class="font-medium text-['.$system->SystemSettings["link_color"].'] hover:text-['.$system->SystemSettings["link_color:hover"].'] hover:underline"><ion-icon name="cog" class="inline-block align-middle text-xl"></ion-icon> '.constant("MANAGE").'</a>
							';
						}
						if(in_array("groups_remove",$LoginPermission) && count($groupClass->GetGroups()) > 1){
							echo '
							<a href="?save=remove&type=group&id='.$group["Group_ID"].'" class="font-medium text-['.$system->SystemSettings["link_color"].'] hover:text-['.$system->SystemSettings["link_color:hover"].'] hover:underline"><ion-icon name="trash" class="inline-block align-middle text-xl"></ion-icon> Smazat</a>
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
	} else {
		$log->AddLogDB("SG200");
		echo $system->GetMessage("SG200");
	}
?>
<?php
// NASTAVENÍ MODULŮ

$tag = ($modules->VerifyModule("TAG") == 1)?true:false;
$gam = ($modules->VerifyModule("GAM") == 1)?true:false;


?>
<div class="w-max text-left">
  <nav aria-label="breadcrumb">
    <ol class="flex w-full flex-wrap items-center rounded-md bg-blue-gray-50 bg-opacity-60 py-2 px-4">
      <li class="flex cursor-pointer items-center font-sans text-sm font-normal leading-normal text-[<?=$system->SystemSettings["map_color"]?>] antialiased transition-colors duration-300 hover:text-[<?=$system->SystemSettings["map_color:hover"]?>]">
        <a class="opacity-60" href="/">
          <span><?=$system->SystemSettings["system_name"]?></span>
        </a>
        <span class="pointer-events-none mx-2 select-none font-sans text-sm font-normal leading-normal text-zinc-400 antialiased">
          /
        </span>
      </li>
      <li class="flex cursor-pointer items-center font-sans text-sm font-normal leading-normal text-[<?=$system->SystemSettings["map_color:active"]?>] antialiased transition-colors duration-300 hover:text-[<?=$system->SystemSettings["map_color:hover"]?>]">
        <a
          class="font-medium text-blue-gray-900 transition-colors"
          href="#"
        >
          <?=constant("HOME PAGE");?>
        </a>
      </li>
    </ol>
  </nav>
</div>
<div class="container relative mx-auto mt-5 mb-5 ">
  <div class="grid grid-cols-1 m-3 md:grid-cols-2 md:m-2 lg:grid-cols-3 lg:m-1 gap-5">
	  <?=((in_array("display_members",$LoginPermission))?'<a href="?page=members" class="flex justify-center align-middle text-center text-4xl text-['.$system->SystemSettings["color_1"].'] border-2 border-neutral-700 rounded-xl p-6 bg-black">Členové</a>':'')?>
      <?=(($gam && in_array("gam_calendar",$LoginPermission))?'<a href="?page=calendar" class="flex justify-center align-middle text-center text-4xl text-['.$system->SystemSettings["color_1"].'] border-2 border-neutral-700 rounded-xl p-6 bg-black">Kalendář</a>':'')?>
      <?=(($gam && in_array("gam_history",$LoginPermission))?'<a href="?page=history" class="flex justify-center align-middle text-center text-4xl text-['.$system->SystemSettings["color_1"].'] border-2 border-neutral-700 rounded-xl p-6 bg-black">Akce</a>':'')?>



      <?=((in_array("users_manage",$LoginPermission))?'<a href="?page=users" class="flex justify-center align-middle text-center text-4xl text-['.$system->SystemSettings["color_1"].'] border-2 border-neutral-700 rounded-xl p-6 bg-black">Správa uživatelů</a>':'')?>
      <?=((in_array("ranks_manage",$LoginPermission))?'<a href="?page=ranks" class="flex justify-center align-middle text-center text-4xl text-['.$system->SystemSettings["color_1"].'] border-2 border-neutral-700 rounded-xl p-6 bg-black">Správa ranků</a>':'')?>
      <?=((in_array("settings_system",$LoginPermission))?'<a href="?page=settings" class="flex justify-center align-middle text-center text-4xl text-['.$system->SystemSettings["color_1"].'] border-2 border-neutral-700 rounded-xl p-6 bg-black">Správa systému</a>':'')?>
      <?=((in_array("groups_manage",$LoginPermission))?'<a href="?page=groups" class="flex justify-center align-middle text-center p-4 text-4xl text-['.$system->SystemSettings["color_1"].'] border-2 border-neutral-700 rounded-xl p-6 bg-black">Správa skupin</a>':'')?>
      <?=(($tag && in_array("tag_manage",$LoginPermission))?'<a href="?page=tags" class="flex justify-center align-middle text-center text-4xl text-['.$system->SystemSettings["color_1"].'] border-2 border-neutral-700 rounded-xl p-6 bg-black">Správa Tagů</a>':'')?>
      <?=(($gam && in_array("gam_manage",$LoginPermission))?'<a href="?page=games" class="flex justify-center align-middle text-center text-4xl text-['.$system->SystemSettings["color_1"].'] border-2 border-neutral-700 rounded-xl p-6 bg-black">Správa Her</a>':'')?>

  </div>
</div>
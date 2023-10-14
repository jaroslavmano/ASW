<nav class="flex items-center justify-between bg-[<?=$system->SystemSettings["main_panel_bg"]?>] text-[<?=$system->SystemSettings["color_1"]?>] p-2" aria-label="Global">
      <div class="flex lg:flex-1">
        <a href="#" class="-m-1.5 p-1.5">
          <span class="sr-only"><?=$system->SystemSettings["system_name"]?></span>
          <img class="h-12" src="<?=$system->SystemSettings["system_logo"]?>" alt="">
        </a>
      </div>
      <div class="hidden lg:flex text-4xl text-[<?=$system->SystemSettings["main_panel_color"]?>]">
        <a id="time"><?=date("H:i:s")?></a>
      </div>
      <div class="flex flex-1 justify-end gap-x-8 p-1">
        <a href="?page=profile" class="text-lg text-[<?=$system->SystemSettings["main_panel_color"]?>] font-semibold leading-6 hover:text-[<?=$system->SystemSettings["main_panel_color:hover"]?>]"><span class="hidden md:inline"><?=$loginUser->UserData[0]["User_Name"]?></span> <ion-icon name="person-circle" class="inline-block align-middle text-xl"></ion-icon></a>
		<a href="?page=logout" class="text-lg font-semibold text-[<?=$system->SystemSettings["main_panel_color"]?>] hover:text-[<?=$system->SystemSettings["main_panel_color:hover"]?>] leading-6"><ion-icon name="log-out" class="inline-block align-middle text-xl"></ion-icon></a>
      </div>
    </nav>
<nav class="bg-[<?=$system->SystemSettings["menu/foot_bg"]?>]">
  <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
    <div class="flex h-16 items-center justify-between">
      <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
        <!-- Mobile menu button-->
      </div>
      <div class="flex flex-1 items-center justify-center sm:items-stretch">
			<button type="button" id="menu-button" class="md:hidden inline-flex items-center justify-center rounded-md text-[<?=$system->SystemSettings["color_3"]?>] p-2 hover:text-[<?=$system->SystemSettings["menu/foot_color:hover"]?>] hover:bg-[<?=$system->SystemSettings["menu/foot_bg:hover"]?>">
				<?php // ICON FOR OPEN MENU ?>
          		<ion-icon name="menu" id="openmenu"></ion-icon>
				<?php // ICON FOR OPEN MENU ?>
          		<ion-icon name="close" class="hidden" id="closemenu"></ion-icon>
        </button>
        <div class="hidden md:ml-6 md:block">
          <div class="flex gap-x-8">
			 <?php
	
			foreach($system->Menu as $link){
				$currentPage = '';
				if(strpos($_SERVER["REQUEST_URI"], $link[1]) !== false){
					$class = 'bg-['.$system->SystemSettings["menu/foot_bg:active"].'] text-['.$system->SystemSettings["menu/foot_color:active"].'] hover:bg-['.$system->SystemSettings["menu/foot_bg:hover"].'] hover:text-['.$system->SystemSettings["menu/foot_color:hover"].'] transition-colors duration-300 px-3 py-2 rounded-md text-sm font-medium';
					$currentPage = 'aria-current="page"';
				} else {
					$class = 'text-['.$system->SystemSettings["color_3"].'] hover:bg-['.$system->SystemSettings["menu/foot_bg:hover"].'] hover:text-['.$system->SystemSettings["menu/foot_color:hover"].'] px-3 py-2 rounded-md text-sm font-medium transition-colors duration-300';
				}
				
			echo '<a href="'.$link[1].'" class="'.$class.'" '.$currentPage.'>'.$link[0].'</a>';
			}
	
			?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Mobile menu, show/hide based on menu state. -->
  <div class="hidden" id="mobile-menu">
    <div class="space-y-1 px-2 pt-2 pb-3">
      <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
			 <?php
	
			foreach($system->Menu as $link){
				if(strpos($_SERVER["REQUEST_URI"], $link[1]) !== false){
					$class = 'bg-['.$system->SystemSettings["menu/foot_bg:active"].'] text-['.$system->SystemSettings["menu/foot_color:active"].'] hover:bg-['.$system->SystemSettings["menu/foot_bg:hover"].'] hover:text-['.$system->SystemSettings["menu/foot_color:hover"].']  block px-3 py-2 rounded-md text-base font-medium';
					$currentPage = 'aria-current="page"';
				} else {
					$class = 'text-['.$system->SystemSettings["color_3"].'] hover:bg-['.$system->SystemSettings["menu/foot_bg:hover"].'] hover:text-['.$system->SystemSettings["menu/foot_color:hover"].']  block px-3 py-2 rounded-md text-base font-medium';
				}
				
			echo '<a href="'.$link[1].'" class="'.$class.'" '.$currentPage.'>'.$link[0].'</a>';
			}
	
			?>
    </div>
  </div>
</nav>
	<script>
	function updateTime(){
		var currentTime = new Date()
		var hours = currentTime.getHours()
		var minutes = currentTime.getMinutes()
		var sec = currentTime.getSeconds()
		if (hours < 10){
			hours = "0" + hours
		}
		if (minutes < 10){
			minutes = "0" + minutes
		}
		if (sec < 10){
			sec = "0" + sec
		}
		var t_str = hours + ":" + minutes + ":" + sec;
		document.getElementById('time').innerHTML = t_str;
	}
    
	setInterval(updateTime, 1000);
		const button = document.querySelector('#menu-button'); // Hamburger Icon
const menu = document.querySelector('#mobile-menu'); // Menu
		const close = document.querySelector('#closemenu'); // Menu
		const open = document.querySelector('#openmenu'); // Menu

button.addEventListener('click', () => {
  menu.classList.toggle('hidden');
	close.classList.toggle('hidden');
	open.classList.toggle('hidden');
});
	</script>
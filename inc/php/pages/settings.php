<?php
	if(!in_array("settings_system",$LoginPermission)){
		echo'<meta http-equiv="refresh" content="0;url=?page=main"> ';
	}
if(isset($_POST["SaveSettings"])){
	if($system->UpdateSettings($_POST, $_FILES)){
		$_SESSION["msg"] .= $system->GetMessage("SY001");
	} else {
		$_SESSION["msg"] .= $system->GetMessage("SY206");
	}
	unset($_POST, $_FILES);
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
      <li class="flex cursor-pointer items-center font-sans text-sm font-normal leading-normal text-[<?=$system->SystemSettings["map_color:active"]?>] antialiased transition-colors duration-300 hover:text-[<?=$system->SystemSettings["map_color:hover"]?>]">
        <a class="font-medium transition-colors" href="">
          Nastavení Systému
        </a>
      </li>
    </ol>
  </nav>
</div>

<h1 class="text-center text-4xl text-[<?=$system->SystemSettings["color_2"]?>] font-bold mt-6 mb-6">Nastavení Systému</h1>
<hr class="w-[10%] mx-auto ">
<div class="text-center p-4">
<a href="?page=main" class="text-[<?=$system->SystemSettings["link_color"]?>] hover:text-[<?=$system->SystemSettings["link_color:hover"]?>]"><ion-icon name="chevron-back" class="inline-block align-middle text-xl"></ion-icon> <?=constant("BACK");?></a>
	<?php
	if(isset($_SESSION["msg"]) && empty($_POST)){
		echo $_SESSION["msg"];
		unset($_SESSION["msg"]);
	}
	?>
</div>
	<div class="space-y-6 container mx-auto px-4 py-5">
		<form method="post" action="" enctype="multipart/form-data">
			<div class="container mx-auto mt-4">
			  <!-- Tabs -->
				<?php
				$modulesDATA =array();
				$modules = new Module();
				$listModules = $modules->GetModules();
				if($listModules !== false){
					foreach($listModules as $module){
						$modulesDATA[] = array("Module_Short"=>$module["Module_Short"],"Module_PermissionDisplay"=>$module["Module_PermissionDisplay"]);
					}
					?>
					  <ul id="tabs" class="inline-flex pt-2 px-1 text-[<?=$system->SystemSettings["color_1"]?>] w-full border-b border-[<?=$system->SystemSettings["color_2"]?>]">
						<?php
							foreach($modulesDATA as $module){
								$addClass ="";
								if($module["Module_Short"] == "GEN"){
									$addClass = "border-b-4 text-[".$system->SystemSettings["color_2"]."] border-[".$system->SystemSettings["color_2"]."] -mb-px ";
								}
								echo '<li class="px-4 font-semibold '.$addClass.'py-2 rounded-t"><a href="#'.$module["Module_Short"].'">'.$module["Module_PermissionDisplay"].'</a></li>';
							}
						?>
					  </ul>

				  <!-- Tab Contents -->
				  <div id="tab-contents">
					<?php
					foreach($modulesDATA as $module){
						$addClass ="";
						if($module["Module_Short"] != "GEN"){$addClass = "hidden ";}
						echo '<div id="'.$module["Module_Short"].'" class="'.$addClass.'p-4">';
						
							$settings = new system_class();
							$data = $settings->GetByModule($module["Module_Short"]);
							if($data !== false){
								echo '<div class="">';
                                if(isset($data) && !empty($data)){
                                    foreach($data as $setting){
                                        ?>
                                            <div class="grid grid-cols-1 gap-6 m-3">
                                                <div class="col-span-3 sm:col-span-2">
                                                    <label for="<?=$setting["System_ID"]?>" class="block text-sm font-medium text-[<?=$system->SystemSettings["color_1"]?>]"><?=$setting["System_ID"]?>: 													<span class="relative inline-flex flex-col group items-center"> <ion-icon name="help-circle" class="text-md"></ion-icon>
                                                            <div class="absolute bottom-0 inline-flex flex-col items-center hidden mb-6 group-hover:flex">
                                                                <span class="relative z-10 p-2 text-xs leading-none text-white whitespace-no-wrap bg-black shadow-lg rounded"><?=$setting["Comment"]?></span>
                                                                <div class="w-3 h-3 -mt-2 rotate-45 bg-black"></div>
                                                            </div>
                                                        </span></label>
                                                    <div class="mt-1 flex rounded-md shadow-sm">
                                                        <?php
                                                            switch($setting["System_Typ"]){
                                                                case 1:
                                                                    $type = "text";
                                                                    break;
                                                                case 2:
                                                                    $type = "number";
                                                                    break;
                                                                case 3:
                                                                    $type = "file";
                                                                    break;
                                                                case 4:
                                                                    $type = "color";
                                                                    break;
                                                                default:
                                                                    $type = "text";
                                                                    break;
                                                            }

                                                        ?>
                                                        <input type="<?=$type?>" name="<?=$setting["System_ID"]?>" value="<?=$setting["System_Value"]?>"  name="<?=$setting["System_ID"]?>" maxlength="50" class="block flex-1 w-full rounded-md text-[<?=$system->SystemSettings["input_color"]?>] bg-[<?=$system->SystemSettings["input_bg"]?>]  <?=(($setting["System_Typ"] != 4)?'p-2':'')?> sm:text-sm" <?=(($setting["System_Request"] == 1)?'required':'')?> />
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                    }
                                }
							} else{
								echo $system->GetMessage("PER01");
							}

					  ?>
					  </div>
					<div class="px-4 py-3 text-right sm:px-6">
						<button type="submit" name="SaveSettings" class="justify-center rounded-md border border-transparent py-2 px-4 text-sm font-medium shadow-sm bg-[<?=$system->SystemSettings["button_bg"]?>]  text-[<?=$system->SystemSettings["button_color"]?>] align-middle inline-block rounded-md p-3 hover:text-[<?=$system->SystemSettings["button_color:hover"]?>] hover:bg-[<?=$system->SystemSettings["button_bg:hover"]?>] hover:cursor-pointer"><ion-icon name="save" class="inline-block align-middle"></ion-icon>  <?=constant("SAVE");?></button>
					</div>
					 <?php
					echo '</div>';
					}
						 
					?>
				  </div>
					<?php
				}
				else {
					echo $system->GetMessage("MO001");
				}
				?>
			</div>
		</form>
	</div>
<script>
let tabsContainer = document.querySelector("#tabs");

let tabTogglers = tabsContainer.querySelectorAll("a");
console.log(tabTogglers);

tabTogglers.forEach(function(toggler) {
  toggler.addEventListener("click", function(e) {
    e.preventDefault();

    let tabName = this.getAttribute("href");

    let tabContents = document.querySelector("#tab-contents");

    for (let i = 0; i < tabContents.children.length; i++) {
      
      tabTogglers[i].parentElement.classList.remove("border-b-4","text-[<?=$system->SystemSettings["color_2"]?>]", "border-[<?=$system->SystemSettings["color_2"]?>]", "-mb-px");  tabContents.children[i].classList.remove("hidden");
      if ("#" + tabContents.children[i].id === tabName) {
        continue;
      }
      tabContents.children[i].classList.add("hidden");
      
    }
    e.target.parentElement.classList.add("border-b-4", "text-[<?=$system->SystemSettings["color_2"]?>]", "border-[<?=$system->SystemSettings["color_2"]?>]", "-mb-px");
  });
});
	function ControlChild(id){
		
		var childDiv = document.getElementById("child/"+id);
		
		var inputs = childDiv.getElementsByTagName('input');
		for (var index = 0; index < inputs.length; ++index) {
    		inputs[index].checked = false;
		}
		
		
	}
</script>
<?php
	if(!in_array("groups_createedit",$LoginPermission)){
		echo'<meta http-equiv="refresh" content="0;url=?page=groups"> ';
	}
if(isset($_GET["id"])){
	$groups = new Groups($_GET["id"]);
} else {
	$groups = new Groups();
}
if(isset($_POST["SaveInfoGroup"])){
	if(isset($_GET["id"])){
		$result = $groups->UpdateGroup($_POST["name"], $_POST["descript"]);
		if($result === true){
			$_SESSION["msg"] = $system->GetMessage("SG001");
			unset($_POST);
			$groups = new Groups($_GET["id"]);
			echo'<meta http-equiv="refresh" content="0;url=?page=group&id='.$result.'&msg=1"> ';
		} else {
			echo $system->GetMessage("SG203");
		}
	} else {
		echo $type;
		$result = $groups->CreateGroup($_POST["name"], $_POST["descript"]);
		
		if($result !== false && isset($result)){
			$_SESSION["msg"] = $system->GetMessage("SG002");
			echo'<meta http-equiv="refresh" content="0;url=?page=group&id='.$result.'&msg=1"> ';
			//header("Refresh:0; url=?page=group&id=".$result);
		} else {
			$log->AddLogDB("SG205", "ID: ".$_GET["id"]);
			echo $system->GetMessage("SG204");
		}
	}
}
if(isset($_POST["EditPermissions"])){
	unset($_POST["EditPermissions"]);
	$per = new Permissions();
	$code = $per->GetPermissionCode(array_keys($_POST));
	$update = $groups->UpdateGroupPermission($code);
	if($update){
		$_SESSION["msg"] = $system->GetMessage("SG003");
	} else {
		$_SESSION["msg"] = $system->GetMessage("SG205");
	}
	unset($_POST);
}

$groupInfo = $groups->InfoGroup();
if(isset($_GET["id"])){
	$type =1;
	$title = constant("SETTINGGROUP") ." | ".$groupInfo[0]["Group_Name"];
} else {
	$type =0;
	$title = constant("CREATEGROUP");
}
if($groupInfo === false && isset($_GET["id"])){
	echo'<meta http-equiv="refresh" content="0;url=?page=groups"> ';
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
        <a class="opacity-60" href="?page=groups">
          <?=constant("GROUPS");?>
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
<a href="?page=groups" class="text-[<?=$system->SystemSettings["link_color"]?>] hover:text-[<?=$system->SystemSettings["link_color:hover"]?>]"><ion-icon name="chevron-back" class="inline-block align-middle text-xl"></ion-icon> <?=constant("BACK");?></a>
	<?php
	if(isset($_SESSION["msg"]) && empty($_POST)){
		echo $_SESSION["msg"];
		unset($_SESSION["msg"]);
	}
	?>
</div>

	<div class="space-y-6 container mx-auto px-4 py-5 ">
		<form method="post" action="">
			<h1 class="text-xl text-[<?=$system->SystemSettings["color_2"]?>] font-bold"><?=constant("INFOGROUP");?></h1>
			<div class="pl-3 space-y-4">
				<div class="grid grid-cols-1 gap-6">
					<div class="col-span-3 sm:col-span-2">
						<label for="name" class="block text-sm font-medium text-[<?=$system->SystemSettings["color_1"]?>]"><?=constant("NAME");?>:</label>
						<div class="mt-1 flex rounded-md shadow-sm">
							<input type="text" name="name" maxlength="10" class="block w-full flex-1 rounded-md text-[<?=$system->SystemSettings["input_color"]?>] bg-[<?=$system->SystemSettings["input_bg"]?>] p-2 sm:text-sm" placeholder="Admin" <?=($type == 1)?"value='".$groupInfo[0]["Group_Name"]."'":""?> required />
						</div>
					</div>
				</div>
				<div class="grid grid-cols-1 gap-6">
					<div class="col-span-3 sm:col-span-2">
						<label for="descript" class="block text-sm font-medium text-[<?=$system->SystemSettings["color_1"]?>]"><?=constant("DESCRIPTION");?>:</label>
						<div class="mt-1 flex rounded-md shadow-sm">
							<textarea id="descript" name="descript" rows="3" class="block w-full flex-1 rounded-md text-[<?=$system->SystemSettings["input_color"]?>] bg-[<?=$system->SystemSettings["input_bg"]?>] p-2 sm:text-sm"   required /><?=($type == 1)? $groupInfo[0]["Group_Description"]:"" ?></textarea>
						</div>
					</div>
				</div>
            </div>
			<div class="px-4 py-3 text-right sm:px-6">
				<button type="submit" name="SaveInfoGroup" class="justify-center rounded-md border border-transparent py-2 px-4 text-sm font-medium shadow-sm bg-[<?=$system->SystemSettings["button_bg"]?>]  text-[<?=$system->SystemSettings["button_color"]?>] align-middle inline-block rounded-md p-3 hover:text-[<?=$system->SystemSettings["button_color:hover"]?>] hover:bg-[<?=$system->SystemSettings["button_bg:hover"]?>] hover:cursor-pointer"><ion-icon name="save" class="inline-block align-middle"></ion-icon>  <?=constant("SAVE");?></button>
	 		</div>
		</form>
	</div>

	<?php
	if($type == 1){
	?>
	<div class="space-y-6 container mx-auto px-4 py-5">
		<form method="post" action="">
			<h1 class="text-xl text-[<?=$system->SystemSettings["color_2"]?>] font-bold"><?=constant("GROUPPERMISSIONS");?></h1>
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
						
							$permisssions = new Permissions($module["Module_Short"]);
							$groupPerm = $permisssions->DecodeCodePremission($groupInfo[0]["Group_Permissions"]);
							$data = $permisssions->GetMainPermissions();
							if($data !== false){
								echo '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 grid-flow-rows gap-1">';
								foreach($data as $permission){
									unset($sub,$check,$childs);
									$sub = "";
									if(in_array($permission["Permission_ID"], $groupPerm)) {$check = "checked";}else {$check ="";}
									$subperms = $permisssions->GetSubPerrmisions($permission["Permission_Index"]);
									if($subperms !== false){
										$sub .= '<div class="pl-6 m-4" id="child/'.$permission["Permission_Index"].'">';
										foreach($subperms as $subperm){
											$childs[] = $subperm["Permission_Index"];
											$subcheck ="";
											if(in_array($subperm["Permission_ID"], $groupPerm)) {$subcheck = "checked";}
											$onclick = "ControlParent('".$subperm["Permission_Required"]."')";
											$sub .= '
											<div class="flex items-center mb-2">
													<input '.$subcheck.' onClick="'.$onclick.'" id="'.$subperm["Permission_Index"].'" name="'.$subperm["Permission_ID"].'" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
													<label for="'.$subperm["Permission_Index"].'" class="ml-2 text-sm font-medium text-['.$system->SystemSettings["color_1"].']">'.$subperm["Permission_Name"].'
													<span class="relative inline-flex flex-col group items-center"> <ion-icon name="help-circle" class="text-md"></ion-icon>
														<div class="absolute bottom-0 inline-flex flex-col items-center hidden mb-6 group-hover:flex">
                    										<span class="relative z-10 p-2 text-xs leading-none text-white whitespace-no-wrap bg-black shadow-lg rounded">'.$subperm["Permission_Description"].'</span>
															<div class="w-3 h-3 -mt-2 rotate-45 bg-black"></div>
														</div>
													</span>
            								</div>
											';
										}
										$sub .= '</div>';
									}
									?>
									<div class="block items-center mb-4">
											<input <?=$check?> id="<?=$permission["Permission_Index"]?>" onClick="ControlChild('<?=$permission["Permission_Index"]?>')" name="<?=$permission["Permission_ID"]?>" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
											<label for="<?=$permission["Permission_Index"]?>" class="ml-2 text-sm font-medium text-[<?=$system->SystemSettings["color_1"]?>]"><?=$permission["Permission_Name"]?>
													<span class="relative inline-flex flex-col group items-center"> <ion-icon name="help-circle" class="text-md"></ion-icon>
														<div class="absolute bottom-0 inline-flex flex-col items-center hidden mb-6 group-hover:flex">
                    										<span class="relative z-10 p-2 text-xs leading-none text-white whitespace-no-wrap bg-black shadow-lg rounded"><?=$permission["Permission_Description"]?></span>
															<div class="w-3 h-3 -mt-2 rotate-45 bg-black"></div>
														</div>
													</span>
										</label>
										<?=(isset($sub))?$sub:""?>
									</div>
									<?php

								}
								echo '</div>';
							} else{
								echo $system->GetMessage("PER01");
							}

					  ?>
					<div class="px-4 py-3 text-right sm:px-6">
						<button type="submit" name="EditPermissions" class="justify-center rounded-md border border-transparent py-2 px-4 text-sm font-medium shadow-sm bg-[<?=$system->SystemSettings["button_bg"]?>]  text-[<?=$system->SystemSettings["button_color"]?>] align-middle inline-block rounded-md p-3 hover:text-[<?=$system->SystemSettings["button_color:hover"]?>] hover:bg-[<?=$system->SystemSettings["button_bg:hover"]?>] hover:cursor-pointer"><ion-icon name="save" class="inline-block align-middle"></ion-icon>  <?=constant("SAVE");?></button>
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

document.getElementById("default-tab").click();
	function ControlParent(id){
		var Info = document.getElementById(id).checked;
		
		if(!Info){
			document.getElementById(id).checked = true;
		}
		
	}
	function ControlChild(id){
		
		var childDiv = document.getElementById("child/"+id);
		
		var inputs = childDiv.getElementsByTagName('input');
		for (var index = 0; index < inputs.length; ++index) {
    		inputs[index].checked = false;
		}
		
		
	}
</script>
	<?php
	}
	?>
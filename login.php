<?php require("./config/init.php"); ?>
<!doctype html>
<html>
<head>
	<title><?=$system->SystemSettings["system_name"]?> / Login Page</title>
	
	<meta name="author" content="Jaroslav Maňo">
  	<meta charset="UTF-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	
	<script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            clifford: '#da373d',
          }
        }
      }
    }
  </script>
	<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</head>
<body class="font-mono text-white flex h-screen items-center justify-center  bg-cover bg-center bg-[url('<?=$system->SystemSettings["login_background"]?>')] bg-blend-multiply">
	<a href="<?=$system->SystemSettings["system_main_website"]?>" class="absolute font-bold top-0 text-[<?=$system->SystemSettings["login_color"]?>] left-0 p-4 text-lg hover:text-[<?=$system->SystemSettings["login_color:hover"]?>] hover:cursor-pointer md:p-6 md:text-xl lg:p-8 lg:text-2xl"><ion-icon name="chevron-back-outline"></ion-icon> ZPĚT NA HLAVNÍ STRÁNKU</a>
	<section class="mx-auto  w-[70%] md:w-[50%] lg:w-[40%]">
		<header class="m-auto text-center content-center">
			<img src="<?=$system->SystemSettings["system_logo"]?>" class="w-[80%] mx-auto my-4">
			<a href="./login/process.php?action=login" class="bg-[<?=$system->SystemSettings["login_button_bg"]?>] text-[<?=$system->SystemSettings["login_button_color"]?>] align-middle inline-block rounded-md p-3 text-2xl hover:bg-[<?=$system->SystemSettings["login_button_bg:hover"]?>] hover:text-[<?=$system->SystemSettings["login_button_color:hover"]?>] hover:cursor-pointer md:text-3xl lg:text-4xl "><ion-icon name="logo-discord" class="inline-block align-middle"></ion-icon> Přihlásit se!</a>	
		</header>
		<footer class="m-auto text-center text-[<?=$system->SystemSettings["login_color"]?>] mt-5 text-xl ">
			<?=((!empty($system->SystemSettings["social_discord"]))?'<a href="'.$system->SystemSettings["social_discord"].'" class="hover:text-blue-700 hover:cursor-pointer text-xl" style="font-size: 2rem;"><ion-icon class="text-xl" name="logo-discord"></ion-icon></a>':'')?>
			<?=((!empty($system->SystemSettings["social_twitter"]))?'<a href="'.$system->SystemSettings["social_twitter"].'" class="hover:text-blue-400 hover:cursor-pointer" style="font-size: 2rem;"><ion-icon  name="logo-twitter"></ion-icon></a>':'')?>
			<?=((!empty($system->SystemSettings["social_twitch"]))?'<a href="'.$system->SystemSettings["social_twitch"].'" class="hover:text-purple-500 hover:cursor-pointer" style="font-size: 2rem;"><ion-icon name="logo-twitch"></ion-icon></a>':'')?>
			<?=((!empty($system->SystemSettings["social_tiktok"]))?'<a href="'.$system->SystemSettings["social_tiktok"].'" class="hover:text-black hover:cursor-pointer" style="font-size: 2rem;"><ion-icon name="logo-tiktok"></ion-icon></a>':'')?>
			
			<?=((!empty($system->SystemSettings["social_facebook"]))?'<a href="'.$system->SystemSettings["social_facebook"].'" class="hover:text-blue-700 hover:cursor-pointer " style="font-size: 2rem;" ><ion-icon  name="logo-facebook"></ion-icon></a>':'')?>
			
			<?=((!empty($system->SystemSettings["social_instagram"]))?'<a href="'.$system->SystemSettings["social_instagram"].'" class="hover:text-pink-600 hover:cursor-pointer" style="font-size: 2rem;"><ion-icon name="logo-instagram"></ion-icon></a>':'')?>
			
			<?=((!empty($system->SystemSettings["social_youtube"]))?'<a href="'.$system->SystemSettings["social_youtube"].'" class="hover:text-red-500 hover:cursor-pointer" style="font-size: 2rem;"><ion-icon name="logo-youtube"></ion-icon></a>':'')?>
		</footer>
	</section>
</body>
</html>
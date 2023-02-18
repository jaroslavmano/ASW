<!doctype html>
<html>
<head>
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
<body class="font-mono text-white flex h-screen items-center justify-center  bg-cover bg-center bg-[url('./data/temp/Promo.2022-1.2.mov')] bg-blend-multiply">
	<a href="https://thehiddenones.cz" class="absolute font-bold top-0 left-0 p-4 text-lg hover:text-black hover:cursor-pointer md:p-6 md:text-xl lg:p-8 lg:text-2xl"><ion-icon name="chevron-back-outline"></ion-icon> ZPĚT NA HLAVNÍ STRÁNKU</a>
	<section class="mx-auto  w-[70%] md:w-[50%] lg:w-[40%]">
		<header class="m-auto text-center content-center">
			<img src="./data/temp/logo.png" class="rounded-full w-[100%] mx-auto">
			<a class="bg-sky-500 rounded-md p-3 text-2xl hover:bg-sky-700 hover:cursor-pointer md:text-3xl lg:text-4xl"><ion-icon name="logo-discord"></ion-icon> Přihlásit se!</a>	
		</header>
		<footer class="m-auto text-center mt-5 text-lg">
			<a class="hover:text-blue-700 hover:cursor-pointer"><ion-icon  name="logo-discord"></ion-icon></a>
			<a class="hover:text-blue-400 hover:cursor-pointer"><ion-icon name="logo-twitter"></ion-icon></a>
			<a class="hover:text-purple-500 hover:cursor-pointer"><ion-icon name="logo-twitch"></ion-icon></a>
			<a class="hover:text-black hover:cursor-pointer"><ion-icon name="logo-tiktok"></ion-icon></a>
			<a class="hover:text-blue-700 hover:cursor-pointer"><ion-icon name="logo-facebook"></ion-icon></a>
			<a class="hover:text-pink-600 hover:cursor-pointer"><ion-icon name="logo-instagram"></ion-icon></a>
			<a class="hover:text-red-500 hover:cursor-pointer"><ion-icon name="logo-youtube"></ion-icon></a>
		</footer>
	</section>
</body>
</html>
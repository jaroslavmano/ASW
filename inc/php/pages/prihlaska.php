<!doctype html>
<html>
<head>
	<title>THO.net / Přihláška</title>
	
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
<body class="bg-neutral-900 font-mono ">
	<? include("../sections/header.php");?>

<div class="w-max text-left">
  <nav aria-label="breadcrumb">
    <ol class="flex w-full flex-wrap items-center rounded-md bg-blue-gray-50 bg-opacity-60 py-2 px-4">
      <li class="flex cursor-pointer items-center font-sans text-sm font-normal leading-normal text-zinc-400 antialiased transition-colors duration-300 hover:text-amber-300">
        <a class="opacity-60" href="#">
          <span>THO.net</span>
        </a>
        <span class="pointer-events-none mx-2 select-none font-sans text-sm font-normal leading-normal text-zinc-400 antialiased">
          /
        </span>
      </li>
      <li class="flex cursor-pointer items-center font-sans text-sm font-normal leading-normal text-zinc-400 antialiased transition-colors duration-300 hover:text-amber-300">
        <a class="opacity-60" href="../index.php">
          <span>Main Page</span>
        </a>
        <span class="pointer-events-none mx-2 select-none font-sans text-sm font-normal leading-normal text-zinc-400 antialiased">
          /
        </span>
      </li>
  <li class="flex cursor-pointer items-center font-sans text-sm font-normal leading-normal text-zinc-400 antialiased transition-colors duration-300 hover:text-amber-300">
        <a class="opacity-60" href="nabory.php">
          <span>Nábory</span>
        </a>
        <span class="pointer-events-none mx-2 select-none font-sans text-sm font-normal leading-normal text-zinc-400 antialiased">
          /
        </span>
      </li>
      <li class="flex cursor-pointer items-center font-sans text-sm font-normal leading-normal text-amber-500 antialiased transition-colors duration-300 hover:text-amber-300">
        <a
          class="font-medium text-blue-gray-900 transition-colors"
          href="../prihlaska.php">
          Přihláška | Pavel Gugula
        </a>
      </li>
    </ol>
  </nav>
</div>

		<div class="md:grid md:grid-cols-2 md:gap-1 container mx-auto">
          <div class="space-y-6 container mx-auto px-4 py-5 ">
			  <h1 class="text-4xl text-amber-500 font-bold">Osobní informace</h1>
			  <div class="pl-3 space-y-4">
			             <div class="grid grid-cols-1 gap-6">
              <div class="col-span-3 sm:col-span-2">
                <label for="mail" class="block text-sm font-medium text-white">Email:</label>
                <div class="mt-1 flex rounded-md shadow-sm">
                  <input type="text" name="mail" class="block w-full flex-1 rounded-md border-gray-300 text-amber-200 bg-black p-2 focus:border-gray-300 focus:ring-indigo-500 sm:text-sm" value="pavelgugu@gmail.com" readonly />
                </div>
              </div>
            </div>
            <div class="grid grid-cols-1 gap-6">
              <div class="col-span-3 sm:col-span-2">
                <label for="mail" class="block text-sm font-medium text-white">Jméno a Přijmení:</label>
                <div class="mt-1 flex rounded-md shadow-sm">
                  <input type="text" name="mail" class="block w-full flex-1 rounded-md border-gray-300 text-amber-200 bg-black p-2 focus:border-gray-300 focus:ring-indigo-500 sm:text-sm" value="Pavel Gugula" readonly />
                </div>
              </div>
            </div>
            <div class="grid grid-cols-1 gap-6">
              <div class="col-span-3 sm:col-span-2">
                <label for="mail" class="block text-sm font-medium text-white">Přezdívka:</label>
                <div class="mt-1 flex rounded-md shadow-sm">
                  <input type="text" name="mail" class="block w-full flex-1 rounded-md border-gray-300 text-amber-200 bg-black p-2 focus:border-gray-300 focus:ring-indigo-500 sm:text-sm" value="PetrHraje" readonly />
                </div>
              </div>
            </div>
            <div class="grid grid-cols-1 gap-6">
              <div class="col-span-3 sm:col-span-2">
                <label for="mail" class="block text-sm font-medium text-white">Datum narození:</label>
                <div class="mt-1 flex rounded-md shadow-sm">
                  <input type="date" name="mail" class="block w-full flex-1 rounded-md border-gray-300 text-amber-200 bg-black p-2 focus:border-gray-300 focus:ring-indigo-500 sm:text-sm" value="03.02.2000" readonly />
                </div>
              </div>
            </div>
            <div class="grid grid-cols-1 gap-6">
              <div class="col-span-3 sm:col-span-2">
                <label for="mail" class="block text-sm font-medium text-white">Kraj:</label>
                <div class="mt-1 flex rounded-md shadow-sm">
                  <input type="text" name="mail" class="block w-full flex-1 rounded-md border-gray-300 text-amber-200 bg-black p-2 focus:border-gray-300 focus:ring-indigo-500 sm:text-sm" value="Středočeský" readonly />
                </div>
              </div>
            </div>
            <div class="grid grid-cols-1 gap-6">
              <div class="col-span-3 sm:col-span-2">
                <label for="mail" class="block text-sm font-medium text-white">Alergie:</label>
                <div class="mt-1 flex rounded-md shadow-sm">
					<textarea id="about" name="about" rows="3" class="block w-full flex-1 rounded-md border-gray-300 text-amber-200 bg-black p-2 focus:border-gray-300 focus:ring-indigo-500 sm:text-sm"  placeholder="Zde budou vypsány alergie" readonly>Nějaký dlouhý seznam velmi vážných reakcí</textarea>
                </div>
              </div>
            </div>
			  </div>
			</div>
          <div class="space-y-6 container mx-auto px-4 py-5 sm:p-6">
			  <h1 class="text-4xl text-amber-500 font-bold">AirSoft Informace</h1>
			  <div class="pl-3 space-y-4">
            <div class="grid grid-cols-1 gap-6">
              <div class="col-span-3 sm:col-span-2">
                <label for="mail" class="block text-sm font-medium text-white">Doba hraní:</label>
                <div class="mt-1 flex rounded-md shadow-sm">
                  <input type="text" name="mail" class="block w-full flex-1 rounded-md border-gray-300 text-amber-200 bg-black p-2 focus:border-gray-300 focus:ring-indigo-500 sm:text-sm" value="6 let" readonly />
                </div>
              </div>
            </div>
            <div class="grid grid-cols-1 gap-6">
              <div class="col-span-3 sm:col-span-2">
                <label for="mail" class="block text-sm font-medium text-white">Hraji:</label>
                <div class="mt-1 flex rounded-md shadow-sm">
                  <input type="text" name="mail" class="block w-full flex-1 rounded-md border-gray-300 text-amber-200 bg-black p-2 focus:border-gray-300 focus:ring-indigo-500 sm:text-sm" value="občasně" readonly />
                </div>
              </div>
            </div>
            <div class="grid grid-cols-1 gap-6">
              <div class="col-span-3 sm:col-span-2">
                <label for="mail" class="block text-sm font-medium text-white">Oblíbené hřiště:</label>
                <div class="mt-1 flex rounded-md shadow-sm">
                  <input type="text" name="mail" class="block w-full flex-1 rounded-md border-gray-300 text-amber-200 bg-black p-2 focus:border-gray-300 focus:ring-indigo-500 sm:text-sm" value="Točná" readonly />
                </div>
              </div>
            </div>
            <div class="grid grid-cols-1 gap-6">
              <div class="col-span-3 sm:col-span-2">
                <label for="mail" class="block text-sm font-medium text-white">Preferace pohonu:</label>
                <div class="mt-1 flex rounded-md shadow-sm">
                  <input type="text" name="mail" class="block w-full flex-1 rounded-md border-gray-300 text-amber-200 bg-black p-2 focus:border-gray-300 focus:ring-indigo-500 sm:text-sm" value="Manuál" readonly />
                </div>
              </div>
            </div>
            <div class="grid grid-cols-1 gap-6">
              <div class="col-span-3 sm:col-span-2">
                <label for="mail" class="block text-sm font-medium text-white">Vlastněné/používané zbraně:</label>
                <div class="mt-1 flex rounded-md shadow-sm">
                  <input type="text" name="mail" class="block w-full flex-1 rounded-md border-gray-300 text-amber-200 bg-black p-2 focus:border-gray-300 focus:ring-indigo-500 sm:text-sm" value="ratatatata" readonly />
                </div>
              </div>
            </div>
	            <div class="grid grid-cols-1 gap-6">
              <div class="col-span-3 sm:col-span-2">
                <label for="mail" class="block text-sm font-medium text-white">Dřívější zkušenosti s týmem:</label>
                <div class="mt-1 flex rounded-md shadow-sm">
                  <input type="text" name="mail" class="block w-full flex-1 rounded-md border-gray-300 text-amber-200 bg-black p-2 focus:border-gray-300 focus:ring-indigo-500 sm:text-sm" value="Žádné" readonly />
                </div>
              </div>
            </div>
	            <div class="grid grid-cols-1 gap-6">
              <div class="col-span-3 sm:col-span-2">
                <label for="mail" class="block text-sm font-medium text-white">Očekávání od týmu:</label>
                <div class="mt-1 flex rounded-md shadow-sm">
                  <input type="text" name="mail" class="block w-full flex-1 rounded-md border-gray-300 text-amber-200 bg-black p-2 focus:border-gray-300 focus:ring-indigo-500 sm:text-sm" value="Žádné" readonly />
                </div>
              </div>
            </div>	  
			  
			  </div>
			</div>
          <div class="space-y-6 container mx-auto px-4 py-5 ">
			  <h1 class="text-4xl text-amber-500 font-bold">Quiz</h1>
			  <div class="pl-3 space-y-4">
			             <div class="grid grid-cols-1 gap-6">
              <div class="col-span-3 sm:col-span-2">
                <label for="mail" class="block text-sm font-medium text-white">Airsoftová zbraň je zbraň kategorie? (2b.):</label>
                <div class="mt-1 flex rounded-md shadow-sm">
                  <input type="text" name="mail" class="block w-full flex-1 rounded-md border-gray-300 text-amber-200 bg-black p-2 focus:border-gray-300 focus:ring-indigo-500 sm:text-sm" value="B" readonly />
                </div>
              </div>
            </div>
            <div class="grid grid-cols-1 gap-6">
              <div class="col-span-3 sm:col-span-2">
                <label for="mail" class="block text-sm font-medium text-white">Vlastnit airsoftovou zbraň mohu od: (1b.)</label>
                <div class="mt-1 flex rounded-md shadow-sm">
                  <input type="text" name="mail" class="block w-full flex-1 rounded-md border-gray-300 text-amber-200 bg-black p-2 focus:border-gray-300 focus:ring-indigo-500 sm:text-sm" value="15 let" readonly />
                </div>
              </div>
            </div>
            <div class="grid grid-cols-1 gap-6">
              <div class="col-span-3 sm:col-span-2">
                <label for="mail" class="block text-sm font-medium text-white">Jakými částmi AS zbraně (AEG) projde kulička, než je vystřelena? (3b.):</label>
                <div class="mt-1 flex rounded-md shadow-sm">
                  <input type="text" name="mail" class="block w-full flex-1 rounded-md border-gray-300 text-amber-200 bg-black p-2 focus:border-gray-300 focus:ring-indigo-500 sm:text-sm" value="Mechabox, hop-up komora, hlaveň" readonly />
                </div>
              </div>
            </div>
            <div class="grid grid-cols-1 gap-6">
              <div class="col-span-3 sm:col-span-2">
                <label for="mail" class="block text-sm font-medium text-white">Pokud chci zvýšit dostřel, co udělám? (2b.)</label>
                <div class="mt-1 flex rounded-md shadow-sm">
                  <input type="text" name="mail" class="block w-full flex-1 rounded-md border-gray-300 text-amber-200 bg-black p-2 focus:border-gray-300 focus:ring-indigo-500 sm:text-sm" value="Ratatata" readonly />
                </div>
              </div>
            </div>
            <div class="grid grid-cols-1 gap-6">
              <div class="col-span-3 sm:col-span-2">
                <label for="mail" class="block text-sm font-medium text-white">Pokud chci zvýšit přesnost, co udělám? (2b.):</label>
                <div class="mt-1 flex rounded-md shadow-sm">
                  <input type="text" name="mail" class="block w-full flex-1 rounded-md border-gray-300 text-amber-200 bg-black p-2 focus:border-gray-300 focus:ring-indigo-500 sm:text-sm" value="Opřu si zbraň a uklidním se" readonly />
                </div>
              </div>
            </div>
            <div class="grid grid-cols-1 gap-6">
              <div class="col-span-3 sm:col-span-2">
                <label for="mail" class="block text-sm font-medium text-white">Pokud se dostanu velmi blízko k nepříteli a zásah je jasný, co udělám?:</label>
                <div class="mt-1 flex rounded-md shadow-sm">
				<input type="text" name="mail" class="block w-full flex-1 rounded-md border-gray-300 text-amber-200 bg-black p-2 focus:border-gray-300 focus:ring-indigo-500 sm:text-sm" value="Vytáhnu nůž a dám 'knife kill'" readonly />
                </div>
              </div>
            </div>
			  </div>
			</div>
          <div class="space-y-6 container mx-auto px-4 py-5 sm:p-6">
			  <h1 class="text-4xl text-amber-500 font-bold">Modelové situace</h1>
			  <div class="pl-3 space-y-4">
            <div class="grid grid-cols-1 gap-6">
              <div class="col-span-3 sm:col-span-2">
                <label for="mail" class="block text-sm font-medium text-white">Někdo si zlomí nohu, co udělám?</label>
                <div class="mt-1 flex rounded-md shadow-sm">
				<input type="text" name="mail" class="block w-full flex-1 rounded-md border-gray-300 text-amber-200 bg-black p-2 focus:border-gray-300 focus:ring-indigo-500 sm:text-sm" value="Zařvu máš bebí" readonly />
                </div>
              </div>
            </div>
<div class="grid grid-cols-1 gap-6">
              <div class="col-span-3 sm:col-span-2">
                <label for="mail" class="block text-sm font-medium text-white"> Někdo spadne z výšky, leží, hýbe se minimálně, nevstává, co udělám?</label>
                <div class="mt-1 flex rounded-md shadow-sm">
                	<textarea id="about" name="about" rows="3" class="block w-full flex-1 rounded-md border-gray-300 text-amber-200 bg-black p-2 focus:border-gray-300 focus:ring-indigo-500 sm:text-sm" readonly>Nechám ho tak, jak je. Jdu hrát dál. Ať si sám poradí</textarea>
				
                </div>
              </div>
            </div>
<div class="grid grid-cols-1 gap-6">
              <div class="col-span-3 sm:col-span-2">
                <label for="mail" class="block text-sm font-medium text-white">Jdeš po lese, parťák zakopne a probodne si hřebíkem/klackem nohu, co udělám?</label>
                <div class="mt-1 flex rounded-md shadow-sm">
				<input type="text" name="mail" class="block w-full flex-1 rounded-md border-gray-300 text-amber-200 bg-black p-2 focus:border-gray-300 focus:ring-indigo-500 sm:text-sm" value="Neudělám nic, jdu hrát dál. Měl být opatrnější." readonly />
                </div>
              </div>
            </div>
<div class="grid grid-cols-1 gap-6">
              <div class="col-span-3 sm:col-span-2">
                <label for="mail" class="block text-sm font-medium text-white">Co udělám když se někdo řízne o rezavý předmět, či o nějaký objekt, při kterém hrozí otrava krve?</label>
                <div class="mt-1 flex rounded-md shadow-sm">
                	<textarea id="about" name="about" rows="3" class="block w-full flex-1 rounded-md border-gray-300 text-amber-200 bg-black p-2 focus:border-gray-300 focus:ring-indigo-500 sm:text-sm" readonly>Nebudu řešit něčí zranění, abych nedostal nějakou nemoc. Maximálně ho upozorním, že by s tím měl něco dělat</textarea>
                </div>
              </div>
            </div>
<div class="grid grid-cols-1 gap-6">
              <div class="col-span-3 sm:col-span-2">
                <label for="mail" class="block text-sm font-medium text-white">Co udělám když se někdo řízne například do tepny, či části těla, kde hrozí ohrožení života (vykrvácení)? </label>
                <div class="mt-1 flex rounded-md shadow-sm">
				<input type="text" name="mail" class="block w-full flex-1 rounded-md border-gray-300 text-amber-200 bg-black p-2 focus:border-gray-300 focus:ring-indigo-500 sm:text-sm" value="Budu koukat jak krvácí" readonly />
                </div>
              </div>
            </div>
<div class="grid grid-cols-1 gap-6">
              <div class="col-span-3 sm:col-span-2">
                <label for="mail" class="block text-sm font-medium text-white">Někdo vdechne cizí předmět co udělám? (popiš jak se dělá Heimlichův manévr) </label>
                <div class="mt-1 flex rounded-md shadow-sm">
				<input type="text" name="mail" class="block w-full flex-1 rounded-md border-gray-300 text-amber-200 bg-black p-2 focus:border-gray-300 focus:ring-indigo-500 sm:text-sm" value="Vezmu ho klackem po zádech" readonly />
                </div>
              </div>
            </div>
			  </div>
			</div>
	</div>
	<div class="container mx-auto">
	 <?php //Správa Přihlášky ?>
	      <h1 class="text-4xl text-amber-500 font-bold container">Správa přihlašky</h1>
<label for="countries" class="block mt-2 mb-2 text-sm font-medium text-gray-900 dark:text-white">Akce s přihláškou</label>
<select id="countries" class="rounded-md h-[40px] w-[70%] border-gray-300 text-amber-200 bg-black p-2 focus:border-gray-300 focus:ring-indigo-500 sm:text-sm ">
  <option selected>Vyberte Akci</option>
  <option value="US">Zamítnou</option>
  <option value="CA">Přijmout</option>
  <option value="FR">Probíhá pohovor</option>
  <option value="DE">Rozhodování</option>
</select>
<div class="px-4 py-3 text-right sm:px-6">            <button type="submit" class="justify-center rounded-md border border-transparent py-2 px-4 text-sm font-medium shadow-sm bg-gray-900 text-amber-500 align-middle inline-block rounded-md p-3 hover:bg-black hover:cursor-pointer  focus:outline-none focus:ring-2 focus:bg-gray-900 focus:ring-offset-2"><ion-icon name="refresh" class="inline-block align-middle"></ion-icon>  Aktualizovat stav přihlášky</button>

            
	 </div>
<div class="relative overflow-x-auto shadow-md container mx-auto mt-5 mb-5">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-white uppercase bg-black">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Datum
                </th>
                <th scope="col" class="px-6 py-3">
                    Stav přihlášky
                </th>
                <th scope="col" class="px-6 py-3">
                    Upravil
                </th>
            </tr>
        </thead>
        <tbody>
            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                <td class="px-6 py-4">
                    25.01.2023 v 10:31
                </td>
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    Vytvořeno
                </th>
                <td class="px-6 py-4">
                    Gugula
                </td>
            </tr>
        </tbody>
    </table>
</div>
	</div>
         
	<? include("../sections/footer.php");?>
</body>
</html>

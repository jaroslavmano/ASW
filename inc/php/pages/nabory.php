<!doctype html>
<html>
<head>
	<title>THO.net / Nabory</title>
	
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
      <li class="flex cursor-pointer items-center font-sans text-sm font-normal leading-normal text-amber-500 antialiased transition-colors duration-300 hover:text-amber-300">
        <a
          class="font-medium text-blue-gray-900 transition-colors"
          href="../nabory.php"
        >
          Nábory
        </a>
      </li>
    </ol>
  </nav>
</div>

<h1 class="text-center text-5xl text-amber-500 font-bold mt-6 mb-6">NÁBORY</h1>
	
<div class="w-[90%] md:w-full relative overflow-x-auto shadow-md container mx-auto mt-5 mb-5">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-white uppercase bg-black">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Přijetí formuláře
                </th>
                <th scope="col" class="px-6 py-3">
                    Jméno
                </th>
                <th scope="col" class="px-6 py-3">
                    Přezdívka
                </th>
               <th scope="col" class="px-6 py-3">
                    Stav
                </th>
                <th scope="col" class="px-6 py-3">
                    Akce
                </th>
            </tr>
        </thead>
        <tbody>
            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                <td class="px-6 py-4">
                    25.01.2023 v 10:31
                </td>
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    Pavel Gugulu
                </th>
                <td class="px-6 py-4">
                    Gugula
                </td>
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    Čeká na reakci
                </th>
                <td class="px-6 py-4">
                    <a href="../prihlaska.php" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Zobrazit</a>
                </td>
            </tr>
            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                <td class="px-6 py-4">
                    Datum
                </td>
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    Jméno Přijmení
                </th>
                <td class="px-6 py-4">
                    Přezdívka
                </td>
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    Rozhodování
                </th>
                <td class="px-6 py-4">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500">Zobrazit</a>
                </td>
            </tr>
            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                <td class="px-6 py-4">
                    Datum
                </td>
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    Jméno Přijmení
                </th>
                <td class="px-6 py-4">
                    Přezdívka
                </td>
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    Přijat
                </th>
                <td class="px-6 py-4">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 ">Zobrazit</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
</body>
</html>

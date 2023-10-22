<!DOCTYPE html>
<html lang="en">
<head>
  <!--
    All this code is copyright Autopoietico, 2020-2022.
      -This code includes a bit of snippets found on stackoverflow.com and others
    I'm not a javascript expert, I use this project to learn how to code, and how to design web pages, is a funny hobby to do, but if I
    gain something in the process is a plus.
    Feel free to alter this code to your liking, but please do not re-host it, do not profit from it and do not present it as your own.
  -->
  <!--<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7835978513866271"
  crossorigin="anonymous"></script>-->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  {{-- SEO Data --}}
  <meta name="description" content="Find your best composition, counter the enemy comp, and find the best hero for every map in Overwatch">
	<meta name="keywords" content="overwatch, best, heroes, counters, synergies, pick, overpicker, composition, overpick, heropicker, maps, tiers, characters, champions, carry, ranked, attack, defense, builder, build, comp">
  <meta property="og:locale" content="en_US" />
  <meta property="og:type" content="website" />
  <meta name="twitter:card" content="summary" />
  <meta name="twitter:creator" content="@autopoietico" />
  <meta property="og:url" content="https://overpicker.win/" />
  <meta property="og:site_name" content="OverPicker" />
  <meta property="og:title" content="Overpicker - Overwatch tool made to build Composition based in Counter and Synergies" />
  <meta property="og:description" content="Find your best composition, counter the enemy comp, and find the best hero for every map in Overwatch." />
  <meta property="og:image" content="https://overpicker.win/public/images/resources/overpicker-front.png" />
  <meta property="og:width" content="927" />
  <meta property="og:height" content="991" />
  <meta property="twitter:title" content="Overpicker - Overwatch tool made to build Composition based in Counter and Synergies" />
  <meta property="twitter:image" content="https://overpicker.win/public/images/resources/overpicker-front.png" />
  {{-- Title --}}
  <title>OverPicker {{$title}} </title>
  {{-- Fonts --}}
  <link href="https://fonts.googleapis.com/css?family=Abel|Fjalla+One|Poppins&display=swap" rel="stylesheet">
  {{-- Styles --}}
  @vite('resources/css/app.css')
  {{-- Boostrap Icons --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body class="abel bg-[#1C2E37] text-white my-0 mx-auto w-11/12 relative">
  <x-home.header/>
  @yield('content')
  <x-home.footer :dates=$dates/>
</body>
</html>
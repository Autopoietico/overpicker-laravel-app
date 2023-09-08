@extends('layouts.home')
<header class="mt-4 grid grid-rows-3 justify-items-center ">
  <div class="select-none">
    <h1 class="fjalla-n text-5xl uppercase"><a href="/">Overpicker</a></h1>
    <h2 class="abel text-base text-right"><a href="about">By Autopoietico</a></h2>
  </div>
  <div class="header-tip text-slate-400 m-auto text-center uppercase select-none">
    <p class="poppins text-xs text-white mb-2 border-b-2 border-white">SPEND MORE TIME FOCUSING ON YOUR SURROUNDINGS, STOP TUNNEL VISIONING INDIVIDUAL HEROES.</p>
    <span class="fjalla text-base uppercase">Git Gud</span>
  </div>
  <nav class="w-full pt-5 border-t-2">
    <ol class="grid grid-flow-col gap-x-3 fjalla text-3xl uppercase justify-center">
      <li><a href="/tiers">Tiers</a></li>
      <li><a href="/sources">Sources</a></li>
      <li><a href="/about">About</a></li>
    </ol>
  </nav>
</header>
<section>
  <div class="text-2xl text-center mb-10 border-b-2 border-white">
    <p>Find your best composition, counter the enemy comp, and find the best hero for every map in Overwatch</p>
  </div>
</section>
<section>
  <div class="poppins font-bold text-center text-1xl">
    <span class="text-sky-600">Ally Team</span>
    <span>/</span>
    <span class="text-red-600">Enemy Team</span>
  </div>
</section>
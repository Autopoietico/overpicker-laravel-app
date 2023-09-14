@extends('layouts.home')
<header class="mt-4 grid gap-y-5 justify-items-center">
  <div class="select-none">
    <h1 class="fjalla-n text-5xl uppercase"><a href="/">Overpicker</a></h1>
    <h2 class="abel text-base text-right"><a href="about">By Autopoietico</a></h2>
  </div>
  <div class="header-tip text-slate-400 m-auto text-center uppercase select-none">
    <p class="poppins text-xs text-white mb-2 border-b-2 border-white">SPEND MORE TIME FOCUSING ON YOUR SURROUNDINGS, STOP TUNNEL VISIONING INDIVIDUAL HEROES.</p>
    <span class="fjalla text-base uppercase">Git Gud</span>
  </div>
  <nav class="w-full pt-1 border-t-2">
    <ol class="grid grid-flow-col gap-x-3 fjalla text-3xl uppercase justify-center">
      <li><a href="/tiers">Tiers</a></li>
      <li><a href="/sources">Sources</a></li>
      <li><a href="/about">About</a></li>
    </ol>
  </nav>
</header>
<section class="mt-7">
  <div class="text-2xl text-center mb-8 border-t-2 border-b-2 border-white">
    <p>Find your best composition, counter the enemy comp, and find the best hero for every map in Overwatch</p>
  </div>
</section>
<section>
  <div class="poppins font-bold text-center text-1xl">
    <span class="text-sky-600">Ally Team</span>
    <span>/</span>
    <span class="text-red-600">Enemy Team</span>
  </div>
  <div class="calculator">
    <div class="text-center underline mb-5">Clear All</div>
    <div class="checkbox-panel grid grid-flow-row grid-cols-2 justify-center">
      <label class="flex"><input for="cbrole-lock" type="checkbox" /><span class="mx-1">Role Lock</span></label>
      <label class="flex"><input for="cbtier-mode" type="checkbox" /><span class="mx-1">Tier Mode</span></label>
      <label class="flex"><input for="cbmap-pools" type="checkbox" /><span class="mx-1">Map Pools</span></label>
      <label class="flex"><input for="cbhero-rotation" type="checkbox" /><span class="mx-1">Hero Rotation</span></label>
      <label class="flex"><input for="cbhero-icons" type="checkbox" /><span class="mx-1">Hero Icons</span></label>
    </div>
    <div class="grid text-center mt-2">
      <span class="font-bold">Tier: </span>
      <select id="tier-select" class="bg-[#1C2E37] border border-white rounded-md">
        <option value="top-500">Top 500</option>
        <option value="grandmaster">Grandmaster</option>
        <option value="master">Master</option>
        <option value="diamond">Diamond</option>
        <option value="platinum">Platinum</option>
        <option value="gold">Gold</option>
        <option value="silver">Silver</option>
        <option value="bronze">Bronze</option>
        <option value="all-ranks">All Ranks</option>
        <option value="community-ranking">Community Ranking</option>
      </select>
      <span class="font-bold">Map: </span>
      <select id="tier-select" class="bg-[#1C2E37] border border-white rounded-md">
        <option value="top-500">Top 500</option>
        <option value="grandmaster">Grandmaster</option>
        <option value="master">Master</option>
        <option value="diamond">Diamond</option>
        <option value="platinum">Platinum</option>
        <option value="gold">Gold</option>
        <option value="silver">Silver</option>
        <option value="bronze">Bronze</option>
        <option value="all-ranks">All Ranks</option>
        <option value="community-ranking">Community Ranking</option>
      </select>
      <span class="font-bold">Point: </span>
      <select id="tier-select" class="bg-[#1C2E37] border border-white rounded-md">
        <option value="top-500">Top 500</option>
        <option value="grandmaster">Grandmaster</option>
        <option value="master">Master</option>
        <option value="diamond">Diamond</option>
        <option value="platinum">Platinum</option>
        <option value="gold">Gold</option>
        <option value="silver">Silver</option>
        <option value="bronze">Bronze</option>
        <option value="all-ranks">All Ranks</option>
        <option value="community-ranking">Community Ranking</option>
      </select>
      <span class="font-bold">A/D: </span>
      <select id="tier-select" class="bg-[#1C2E37] border border-white rounded-md">
        <option value="top-500">Top 500</option>
        <option value="grandmaster">Grandmaster</option>
        <option value="master">Master</option>
        <option value="diamond">Diamond</option>
        <option value="platinum">Platinum</option>
        <option value="gold">Gold</option>
        <option value="silver">Silver</option>
        <option value="bronze">Bronze</option>
        <option value="all-ranks">All Ranks</option>
        <option value="community-ranking">Community Ranking</option>
      </select>
    </div>
  </div>
</section>
<footer class="grid gap-y-1 justify-items-center">
  <nav class="w-full border-t-2">
    <ol class="grid grid-flow-col gap-x-4 text-2xl justify-center">
      <li><a href="tiers">Tiers</a></li>
      <li><a href="sources">Sources</a></li>
      <li><a href="about">About</a></li>
    </ol>
  </nav>
  <div class="mt-6 select-none">
    <h1 class="fjalla-n text-5xl uppercase"><a href="/">Overpicker</a></h1>
    <h2 class="abel text-base text-right"><a href="about">By Autopoietico</a></h2>
  </div>
  <div class="mt-6 h-fit w-full grid grid-flow-col place-content-between">
    <span>Last Update: 2023-09-14</span>
    <span>CC(2023)</span>
  </div>
  <div class="mt-3 grid grid-flow-col gap-x-5">
    <a href="https://discord.gg/PBfMUzz" title="OW Picker Discord" target="_blank"><img class="w-12" src="{{ asset('images/social/discord-brands.svg') }}" alt="Discord Icon" /></a>
    <a href="https://paypal.me/car930" title="Paypal Account" target="_blank"><img class="w-12" src="{{ asset('images/social/paypal-brands.svg') }}" alt="PayPal Icon" /></a>
  </div>
</footer>
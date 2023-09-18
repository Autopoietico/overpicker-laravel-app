@extends('layouts.home')
@section('content')
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
    <div class="mt-5">
      <div class="text-2xl text-center">
        <strong class="text-sky-600">Ally Team</strong>
        <span>-</span>
        <span>Score 0</span>
      </div>
      <div class="mt-2 grid grid-flow-col gap-x-1 justify-center">
        <figure class="text-center grid grid-flow-row bg-color-text">
          <figcaption class="text-xs">Blank Hero</figcaption>
          <img src="images\assets\blank-hero.png" alt="Blank hero space" class="h-14 justify-self-center">
          0
          <div class="border-b-2"></div>
        </figure>
        <figure class="text-center grid grid-flow-row bg-color-text">
          <figcaption class="text-xs">Blank Hero</figcaption>
          <img src="images\assets\blank-hero.png" alt="Blank hero space" class="h-14 justify-self-center">
          0
          <div class="border-b-2"></div>
        </figure>
        <figure class="text-center grid grid-flow-row bg-color-text">
          <figcaption class="text-xs">Blank Hero</figcaption>
          <img src="images\assets\blank-hero.png" alt="Blank hero space" class="h-14 justify-self-center">
          0
          <div class="border-b-2"></div>
        </figure>
        <figure class="text-center grid grid-flow-row bg-color-text">
          <figcaption class="text-xs">Blank Hero</figcaption>
          <img src="images\assets\blank-hero.png" alt="Blank hero space" class="h-14 justify-self-center">
          0
          <div class="border-b-2"></div>
        </figure>
        <figure class="text-center grid grid-flow-row bg-color-text">
          <figcaption class="text-xs">Blank Hero</figcaption>
          <img src="images\assets\blank-hero.png" alt="Blank hero space" class="h-14 justify-self-center">
          0
          <div class="border-b-2"></div>
        </figure>
      </div>
      <div class="mt-5 text-sm">
        Filter:
        <input id="blue-hero-filter" type="text" name="filter" placeholder="Genji">
      </div>
      <div class="mt-5 grid grid-flow-row justify-items-center">
        <figure class="grid grid-flow-col w-fit items-center mt-2">
          <img src="images/assets/tank.png" alt="Tank role icon" class="h-11">
          <figcaption class="text-3xl poppins font-bold uppercase">Tank</figcaption>
        </figure>
        <div class="flex flex-wrap justify-center mt-2">
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Wrecking Ball</figcaption>
            <img src="images\heroes\tank\wrecking-ball-profile.png" alt="Wrecking Ball web icon" class="h-14 justify-self-center">
            90
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
        </div>
      </div>
      <div class="mt-5 grid grid-flow-row justify-items-center border-t-2">
        <figure class="grid grid-flow-col w-fit items-center mt-2">
          <img src="images/assets/damage.png" alt="Damage role icon" class="h-11">
          <figcaption class="text-3xl poppins font-bold uppercase">Damage</figcaption>
        </figure>
        <div class="flex flex-wrap justify-center mt-2">
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Wrecking Ball</figcaption>
            <img src="images\heroes\tank\wrecking-ball-profile.png" alt="Wrecking Ball web icon" class="h-14 justify-self-center">
            90
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
        </div>
      </div>
      <div class="mt-5 grid grid-flow-row justify-items-center border-t-2">
        <figure class="grid grid-flow-col w-fit items-center mt-2">
          <img src="images/assets/support.png" alt="Support role icon" class="h-11">
          <figcaption class="text-3xl poppins font-bold uppercase">Support</figcaption>
        </figure>
        <div class="flex flex-wrap justify-center mt-2">
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Wrecking Ball</figcaption>
            <img src="images\heroes\tank\wrecking-ball-profile.png" alt="Wrecking Ball web icon" class="h-14 justify-self-center">
            90
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
        </div>
      </div>
    </div>
    <div class="mt-10 border-t-2 border-white">
      <div class="mt-2 text-2xl text-center">
        <strong class="text-red-600">Enemy Team</strong>
        <span>-</span>
        <span>Score 0</span>
      </div>
      <div class="mt-2 grid grid-flow-col gap-x-1 justify-center">
        <figure class="text-center grid grid-flow-row bg-color-text">
          <figcaption class="text-xs">Blank Hero</figcaption>
          <img src="images\assets\blank-hero.png" alt="Blank hero space" class="h-14 justify-self-center">
          0
          <div class="border-b-2"></div>
        </figure>
        <figure class="text-center grid grid-flow-row bg-color-text">
          <figcaption class="text-xs">Blank Hero</figcaption>
          <img src="images\assets\blank-hero.png" alt="Blank hero space" class="h-14 justify-self-center">
          0
          <div class="border-b-2"></div>
        </figure>
        <figure class="text-center grid grid-flow-row bg-color-text">
          <figcaption class="text-xs">Blank Hero</figcaption>
          <img src="images\assets\blank-hero.png" alt="Blank hero space" class="h-14 justify-self-center">
          0
          <div class="border-b-2"></div>
        </figure>
        <figure class="text-center grid grid-flow-row bg-color-text">
          <figcaption class="text-xs">Blank Hero</figcaption>
          <img src="images\assets\blank-hero.png" alt="Blank hero space" class="h-14 justify-self-center">
          0
          <div class="border-b-2"></div>
        </figure>
        <figure class="text-center grid grid-flow-row bg-color-text">
          <figcaption class="text-xs">Blank Hero</figcaption>
          <img src="images\assets\blank-hero.png" alt="Blank hero space" class="h-14 justify-self-center">
          0
          <div class="border-b-2"></div>
        </figure>
      </div>
      <div class="mt-5 text-sm">
        Filter:
        <input id="blue-hero-filter" type="text" name="filter" placeholder="Genji">
      </div>
      <div class="mt-5 grid grid-flow-row justify-items-center">
        <figure class="grid grid-flow-col w-fit items-center mt-2">
          <img src="images/assets/tank.png" alt="Tank role icon" class="h-11">
          <figcaption class="text-3xl poppins font-bold uppercase">Tank</figcaption>
        </figure>
        <div class="flex flex-wrap justify-center mt-2">
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Wrecking Ball</figcaption>
            <img src="images\heroes\tank\wrecking-ball-profile.png" alt="Wrecking Ball web icon" class="h-14 justify-self-center">
            90
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
        </div>
      </div>
      <div class="mt-5 grid grid-flow-row justify-items-center border-t-2">
        <figure class="grid grid-flow-col w-fit items-center mt-2">
          <img src="images/assets/damage.png" alt="Damage role icon" class="h-11">
          <figcaption class="text-3xl poppins font-bold uppercase">Damage</figcaption>
        </figure>
        <div class="flex flex-wrap justify-center mt-2">
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Wrecking Ball</figcaption>
            <img src="images\heroes\tank\wrecking-ball-profile.png" alt="Wrecking Ball web icon" class="h-14 justify-self-center">
            90
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
        </div>
      </div>
      <div class="mt-5 grid grid-flow-row justify-items-center border-t-2">
        <figure class="grid grid-flow-col w-fit items-center mt-2">
          <img src="images/assets/support.png" alt="Support role icon" class="h-11">
          <figcaption class="text-3xl poppins font-bold uppercase">Support</figcaption>
        </figure>
        <div class="flex flex-wrap justify-center mt-2">
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Wrecking Ball</figcaption>
            <img src="images\heroes\tank\wrecking-ball-profile.png" alt="Wrecking Ball web icon" class="h-14 justify-self-center">
            90
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
          <figure class="text-center grid grid-flow-row mr-1">
            <figcaption class="text-xs">Doomfist</figcaption>
            <img src="images\heroes\tank\doomfist-profile.png" alt="Doomfist web icon" class="h-14 justify-self-center">
            100
            <div class="border-b-2"></div>
          </figure>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
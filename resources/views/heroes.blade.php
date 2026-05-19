@extends('layouts.home')
@section('content')
    <section class="mt-12 flex justify-center sm:mt-16">
        <div class="text-2xl font-black text-center max-w-4xl sm:text-4xl">
            <h1 class="font-normal text-4xl fjalla sm:text-6xl uppercase">
                Overwatch Heroes Tier List
            </h1>
        </div>
    </section>
    <section class="mb-10 text-center sm:text-left text-sm max-w-4xl m-auto">
        <div class="mt-6 pb-2 border-b-2 border-dashed sm:mt-8">
            <p class="sm:text-lg">
                All Overwatch heroes ranked by their competitive performance. Tiers are based on
                <b>{{ $topRankName }}</b> leaderboard data. Click any hero to see their full guide:
                counters, synergies, best maps, and tier by rank.
            </p>
        </div>

        @foreach ($tierValues as $tier)
            @php
                $tierValue     = $tier[0];
                $tierComponent = $tier[1];

                $roles = [
                    'Tank'    => ['ring' => 'group-hover:ring-sky-400',  'icon' => 'images/assets/tank.webp'],
                    'Damage'  => ['ring' => 'group-hover:ring-red-400',  'icon' => 'images/assets/damage.webp'],
                    'Support' => ['ring' => 'group-hover:ring-green-400','icon' => 'images/assets/support.webp'],
                ];

                $heroesInTier = array_filter($tiers, fn($h) => $h['value'] == $tierValue);
                $rolesPresent = array_unique(array_column(array_values($heroesInTier), 'role'));
                $multipleRoles = count($rolesPresent) > 1;
            @endphp

            <div class="mt-10 text-center">
                {!! $tierComponent !!}

                @foreach ($roles as $roleName => $roleData)
                    @php
                        $roleHeroes = array_filter($tiers, fn($h) => $h['value'] == $tierValue && $h['role'] == $roleName);
                    @endphp

                    @if (count($roleHeroes) > 0)
                        @if ($multipleRoles)
                            <div class="flex items-center justify-center gap-2 mt-5 mb-2 opacity-60">
                                <img src="{{ $roleData['icon'] }}" alt="{{ $roleName }}" class="w-5 h-5">
                                <span class="text-xs uppercase tracking-widest abel">{{ $roleName }}</span>
                            </div>
                        @endif
                        <div class="flex flex-wrap gap-3 justify-center {{ $multipleRoles ? 'mt-1' : 'mt-4' }}">
                            @foreach ($roleHeroes as $heroItem)
                                <a href="/heroes/{{ $heroItem['slug'] }}"
                                   class="flex flex-col items-center w-16 sm:w-20 rounded-lg p-1 hover:bg-[#3a5a6e] transition-colors group">
                                    <img src="{{ $heroItem['img'] ?? 'images/assets/blank-hero.webp' }}"
                                         alt="{{ $heroItem['name'] }}"
                                         class="w-14 sm:w-16 rounded-lg group-hover:ring-2 {{ $roleData['ring'] }}">
                                    <span class="text-xs abel font-medium mt-1 w-full text-center truncate">{{ $heroItem['name'] }}</span>
                                </a>
                            @endforeach
                        </div>
                    @endif
                @endforeach
            </div>
        @endforeach
    </section>
@endsection

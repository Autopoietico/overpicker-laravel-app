@extends('layouts.home')
@section('content')
    <section class="mt-12 flex justify-center sm:mt-16 px-4">
        <div class="text-center max-w-4xl">
            <h1 class="font-normal text-4xl fjalla sm:text-6xl uppercase tracking-wider text-slate-100">
                Overwatch Heroes Tier List
            </h1>
        </div>
    </section>

    <section class="mb-20 text-left text-sm max-w-4xl m-auto px-4">
        <div class="glass-panel p-6 sm:p-8 rounded-3xl border border-white/10 mt-8 shadow-2xl relative overflow-hidden">
            <div class="absolute -top-10 -left-10 w-28 h-28 bg-[#294452]/20 rounded-full blur-2xl pointer-events-none"></div>
            <p class="text-sm sm:text-base text-slate-300 leading-relaxed poppins">
                All Overwatch heroes ranked by their competitive performance. Tiers are based on
                <span class="text-amber-400 font-bold border-b border-amber-450/30 pb-0.5">{{ $topRankName }}</span> leaderboard data. Click any hero to see their full guide:
                counters, synergies, best maps, and tier by rank.
            </p>
        </div>

        @foreach ($tierValues as $tier)
            @php
                $tierValue     = $tier[0];
                $tierComponent = $tier[1];

                $roles = [
                    'Tank'    => ['ring' => 'group-hover:ring-sky-500/50 shadow-sky-500/10',  'icon' => 'images/assets/tank.webp'],
                    'Damage'  => ['ring' => 'group-hover:ring-red-500/50 shadow-rose-500/10',  'icon' => 'images/assets/damage.webp'],
                    'Support' => ['ring' => 'group-hover:ring-emerald-500/50 shadow-emerald-500/10','icon' => 'images/assets/support.webp'],
                ];

                $heroesInTier = array_filter($tiers, fn($h) => $h['value'] == $tierValue);
                $rolesPresent = array_unique(array_column(array_values($heroesInTier), 'role'));
                $multipleRoles = count($rolesPresent) > 1;
            @endphp

            <div class="mt-10 text-center glass-panel p-8 rounded-3xl border border-white/10 shadow-xl relative group-tier">
                <div class="tier-header-wrapper mb-6 flex flex-col items-center justify-center">
                    {!! $tierComponent !!}
                </div>

                @foreach ($roles as $roleName => $roleData)
                    @php
                        $roleHeroes = array_filter($tiers, fn($h) => $h['value'] == $tierValue && $h['role'] == $roleName);
                    @endphp

                    @if (count($roleHeroes) > 0)
                        @if ($multipleRoles)
                            <div class="flex items-center justify-center gap-2 mt-8 mb-4 bg-white/5 border border-white/5 px-4 py-1.5 rounded-full w-fit mx-auto shadow-md">
                                <img src="{{ $roleData['icon'] }}" alt="{{ $roleName }} Icon" class="w-4 h-4">
                                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 poppins">{{ $roleName }}</span>
                            </div>
                        @endif
                        <div class="flex flex-wrap gap-4 sm:gap-6 justify-center {{ $multipleRoles ? 'mt-3' : 'mt-8' }}">
                            @foreach ($roleHeroes as $heroItem)
                                <a href="/heroes/{{ $heroItem['slug'] }}"
                                   class="flex flex-col items-center w-16 sm:w-20 rounded-2xl p-1.5 hover:bg-white/5 border border-transparent hover:border-white/10 transition-all duration-300 group glass-card-hover">
                                    <img src="{{ $heroItem['img'] ?? 'images/assets/blank-hero.webp' }}"
                                         alt="{{ $heroItem['name'] }}"
                                         class="w-14 sm:w-16 rounded-xl group-hover:scale-105 transition-transform duration-300 group-hover:ring-2 {{ $roleData['ring'] }} shadow-md border border-white/5">
                                    <span class="text-[11px] poppins font-medium text-slate-400 mt-2 w-full text-center truncate group-hover:text-slate-200 transition-colors">{{ $heroItem['name'] }}</span>
                                </a>
                            @endforeach
                        </div>
                    @endif
                @endforeach
            </div>
        @endforeach
    </section>
@endsection

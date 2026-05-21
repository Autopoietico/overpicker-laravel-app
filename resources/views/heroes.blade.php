@extends('layouts.home')
@section('content')
    <section class="mt-12 flex justify-center sm:mt-16 px-4">
        <div class="text-center max-w-4xl">
            <h1 class="font-normal text-4xl fjalla sm:text-6xl uppercase tracking-wider text-slate-100">
                Overwatch Heroes
            </h1>
        </div>
    </section>

    <section class="mb-20 text-left text-sm max-w-4xl m-auto px-4">
        <div class="glass-panel p-6 sm:p-8 rounded-3xl border border-white/10 mt-8 shadow-2xl relative overflow-hidden">
            <div class="absolute -top-10 -left-10 w-28 h-28 bg-[#294452]/20 rounded-full blur-2xl pointer-events-none"></div>
            <p class="text-sm sm:text-base text-slate-300 leading-relaxed poppins">
                All Overwatch heroes organized by role. Tier badges are based on
                <span class="text-amber-400 font-bold border-b border-amber-450/30 pb-0.5">{{ $topRankName }}</span> leaderboard data. Click any hero to see their full guide:
                counters, synergies, best maps, and tier by rank.
            </p>
        </div>

        @foreach ($roleGroups as $roleName => $roleData)
            <div class="mt-10 glass-panel p-6 sm:p-8 rounded-3xl border border-white/10 shadow-xl">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-white/10">
                    <img src="{{ $roleData['icon'] }}" alt="{{ $roleName }}" class="w-6 h-6">
                    <h2 class="fjalla uppercase text-2xl tracking-wider text-slate-100">{{ $roleName }}</h2>
                    <span class="text-slate-500 poppins text-sm ml-1">{{ count($roleData['heroes']) }} heroes</span>
                </div>

                <div class="flex flex-wrap gap-4 sm:gap-5 justify-center">
                    @foreach ($roleData['heroes'] as $heroItem)
                        <a href="/heroes/{{ $heroItem['slug'] }}"
                           class="flex flex-col items-center w-16 sm:w-20 rounded-2xl p-1.5 hover:bg-white/5 border border-transparent hover:border-white/10 transition-all duration-300 group glass-card-hover relative">
                            <div class="relative">
                                <img src="{{ $heroItem['img'] ?? 'images/assets/blank-hero.webp' }}"
                                     alt="{{ $heroItem['name'] }}"
                                     class="w-14 sm:w-16 rounded-xl group-hover:scale-105 transition-transform duration-300 group-hover:ring-2 {{ $roleData['ring'] }} shadow-md border border-white/5">
                                <span class="absolute -top-1.5 -right-1.5 text-[10px] font-bold poppins px-1.5 py-0.5 rounded-md border bg-[#0d1a20]/90 {{ $heroItem['tier']['text'] }} {{ $heroItem['tier']['border'] }}">
                                    {{ $heroItem['tier']['letter'] }}
                                </span>
                            </div>
                            <span class="text-[11px] poppins font-medium text-slate-400 mt-2 w-full text-center truncate group-hover:text-slate-200 transition-colors">{{ $heroItem['name'] }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endforeach
    </section>
@endsection

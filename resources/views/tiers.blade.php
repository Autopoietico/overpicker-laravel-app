@extends('layouts.home')
@section('content')
    <section class="mt-12 flex justify-center sm:mt-16">
        <div class="text-2xl font-black text-center max-w-4xl sm:text-4xl">
            <h1 class="font-normal text-4xl fjalla sm:text-6xl uppercase">
                Overwatch Competitive Tier List
            </h1>
        </div>
    </section>
    <section class="mb-10 text-center sm:text-left text-sm max-w-4xl m-auto">
        <div class="glass-panel p-5 rounded-2xl border border-white/10 mt-6 shadow-lg">
            <p class="sm:text-lg text-slate-200 leading-relaxed">
                Compare hero tier rankings across all competitive ranks — from <strong>GrandMaster</strong> to <strong>Bronze</strong>.
                Select your rank below to see which heroes dominate your bracket.
            </p>
        </div>

        <div class="mt-8 w-full">
            <div class="glass-panel p-3 sm:p-4 rounded-2xl border border-white/10 grid grid-cols-5 sm:flex sm:flex-nowrap justify-center sm:justify-between gap-1.5 sm:gap-2 shadow-xl">

                {{-- All Ranks tab (roulette icon) --}}
                <button
                    id="all-ranks-tab"
                    onclick="showAllRanks(this)"
                    class="rank-tab flex flex-col items-center justify-center flex-1 min-w-0 gap-1.5 px-1 sm:px-2 py-2 sm:py-2.5 rounded-xl transition-all duration-300 bg-[#294452] border border-amber-400/40 text-amber-400 shadow-md shadow-amber-400/5 hover:scale-105"
                >
                    <img id="roulette-icon" src="{{ asset($allRanks[0]['icon']) }}" alt="All ranks" class="w-7 h-7 sm:w-8 sm:h-8 invert" style="transition: opacity 0.15s">
                    <span class="text-[9px] sm:text-[10px] font-bold uppercase tracking-wider poppins text-slate-100 truncate max-w-full">All Ranks</span>
                </button>

                {{-- Community tab --}}
                @if (count($communityHeroes) > 0)
                    <button
                        onclick="showRank('community', this)"
                        class="rank-tab flex flex-col items-center justify-center flex-1 min-w-0 gap-1.5 px-1 sm:px-2 py-2 sm:py-2.5 rounded-xl transition-all duration-300 border border-white/5 bg-[#294452]/20 hover:bg-[#294452]/60 hover:scale-105"
                    >
                        <img src="{{ asset('images/ranks/community-icon.svg') }}" alt="Community" class="w-7 h-7 sm:w-8 sm:h-8">
                        <span class="text-[9px] sm:text-[10px] font-bold uppercase tracking-wider poppins text-slate-400 truncate max-w-full">Community</span>
                    </button>
                @endif

                @foreach ($allRanks as $index => $rankData)
                    <button
                        onclick="showRank('{{ $rankData['name'] }}', this)"
                        class="rank-tab flex flex-col items-center justify-center flex-1 min-w-0 gap-1.5 px-1 sm:px-2 py-2 sm:py-2.5 rounded-xl transition-all duration-300 border border-white/5 bg-[#294452]/20 hover:bg-[#294452]/60 hover:scale-105"
                    >
                        <img src="{{ asset($rankData['icon']) }}" alt="{{ $rankData['name'] }}" class="w-7 h-7 sm:w-8 sm:h-8 invert">
                        <span class="text-[9px] sm:text-[10px] font-bold uppercase tracking-wider poppins text-slate-400 truncate max-w-full">{{ $rankData['name'] }}</span>
                    </button>
                @endforeach
            </div>
        </div>

        {{-- All Ranks section --}}
        @if (count($allRanksHeroes) > 0)
            <div data-rank="all">
                @foreach ($tierValues as $tier)
                    @php
                        $tierValue    = $tier[0];
                        $tierComponent = $tier[1];
                        $heroesInTier = array_filter($allRanksHeroes, fn($h) => $h['value'] == $tierValue);
                        $roles = [
                            'Tank'    => '\images\assets\tank.webp',
                            'Damage'  => '\images\assets\damage.webp',
                            'Support' => '\images\assets\support.webp',
                        ];
                    @endphp
                    @if (count($heroesInTier) > 0)
                        <div class="mt-12 text-center glass-panel p-6 rounded-3xl border border-white/10 shadow-lg mb-8">
                            <div class="tier-header-wrapper mb-4">
                                {!! $tierComponent !!}
                            </div>
                            <div class="overflow-x-auto rounded-2xl border border-white/10 shadow-xl mt-4">
                                <table class="w-full text-left border-collapse">
                                    <thead>
                                        <tr class="bg-[#294452]/80 border-b border-white/10 text-slate-100 fjalla text-lg tracking-wider uppercase">
                                            <th class="p-4 text-center w-24">Hero</th>
                                            <th class="p-4 text-center w-24 border-l border-r border-white/10">Role</th>
                                            <th class="p-4 text-left hidden sm:table-cell">Description</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-white/5">
                                        @foreach ($roles as $roleName => $roleIcon)
                                            @foreach ($heroesInTier as $hero)
                                                @if ($hero['role'] == $roleName)
                                                    <tr class="hover:bg-white/5 transition-all duration-150 odd:bg-white/[0.02]">
                                                        <td class="p-4">
                                                            <a href="/heroes/{{ $hero['slug'] }}" class="flex flex-col items-center justify-center group/hero">
                                                                <img src="{{ $hero['img'] ?? 'images/assets/blank-hero.webp' }}"
                                                                    alt="{{ $hero['name'] }} profile" class="w-14 h-14 rounded-xl shadow-md border border-white/5 group-hover/hero:scale-105 group-hover/hero:border-white/20 transition-all duration-200">
                                                                <h4 class="text-xs poppins font-semibold text-slate-200 mt-2 w-20 text-center truncate group-hover/hero:text-amber-400 transition-colors">
                                                                    {{ $hero['name'] }}
                                                                </h4>
                                                            </a>
                                                        </td>
                                                        <td class="p-4 border-l border-r border-white/5">
                                                            <div class="flex flex-col items-center justify-center">
                                                                <img src="{{ $roleIcon }}" alt="{{ $roleName }} Icon" class="w-8 h-8 rounded-lg">
                                                                <h4 class="text-[10px] font-bold uppercase tracking-wider text-slate-400 poppins mt-1">{{ $roleName }}</h4>
                                                            </div>
                                                        </td>
                                                        <td class="p-4 align-middle hidden sm:table-cell">
                                                            <p class="text-slate-300 text-sm leading-relaxed poppins">{{ $hero['description'] }}</p>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif

        {{-- Community section --}}
        @if (count($communityHeroes) > 0)
            <div data-rank="community" style="display:none">
                @foreach ($tierValues as $tier)
                    @php
                        $tierValue     = $tier[0];
                        $tierComponent = $tier[1];
                        $heroesInTier  = array_filter($communityHeroes, fn($h) => $h['value'] == $tierValue);
                        $roles = [
                            'Tank'    => '\images\assets\tank.webp',
                            'Damage'  => '\images\assets\damage.webp',
                            'Support' => '\images\assets\support.webp',
                        ];
                    @endphp
                    @if (count($heroesInTier) > 0)
                        <div class="mt-12 text-center glass-panel p-6 rounded-3xl border border-white/10 shadow-lg mb-8">
                            <div class="tier-header-wrapper mb-4">
                                {!! $tierComponent !!}
                            </div>
                            <div class="overflow-x-auto rounded-2xl border border-white/10 shadow-xl mt-4">
                                <table class="w-full text-left border-collapse">
                                    <thead>
                                        <tr class="bg-[#294452]/80 border-b border-white/10 text-slate-100 fjalla text-lg tracking-wider uppercase">
                                            <th class="p-4 text-center w-24">Hero</th>
                                            <th class="p-4 text-center w-24 border-l border-r border-white/10">Role</th>
                                            <th class="p-4 text-left hidden sm:table-cell">Description</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-white/5">
                                        @foreach ($roles as $roleName => $roleIcon)
                                            @foreach ($heroesInTier as $hero)
                                                @if ($hero['role'] == $roleName)
                                                    <tr class="hover:bg-white/5 transition-all duration-150 odd:bg-white/[0.02]">
                                                        <td class="p-4">
                                                            <a href="/heroes/{{ $hero['slug'] }}" class="flex flex-col items-center justify-center group/hero">
                                                                <img src="{{ $hero['img'] ?? 'images/assets/blank-hero.webp' }}"
                                                                    alt="{{ $hero['name'] }} profile" class="w-14 h-14 rounded-xl shadow-md border border-white/5 group-hover/hero:scale-105 group-hover/hero:border-white/20 transition-all duration-200">
                                                                <h4 class="text-xs poppins font-semibold text-slate-200 mt-2 w-20 text-center truncate group-hover/hero:text-amber-400 transition-colors">
                                                                    {{ $hero['name'] }}
                                                                </h4>
                                                            </a>
                                                        </td>
                                                        <td class="p-4 border-l border-r border-white/5">
                                                            <div class="flex flex-col items-center justify-center">
                                                                <img src="{{ $roleIcon }}" alt="{{ $roleName }} Icon" class="w-8 h-8 rounded-lg">
                                                                <h4 class="text-[10px] font-bold uppercase tracking-wider text-slate-400 poppins mt-1">{{ $roleName }}</h4>
                                                            </div>
                                                        </td>
                                                        <td class="p-4 align-middle hidden sm:table-cell">
                                                            <p class="text-slate-300 text-sm leading-relaxed poppins">{{ $hero['description'] }}</p>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif

        @foreach ($allRanks as $index => $rankData)
            <div data-rank="{{ $rankData['name'] }}" style="display:none">
                @foreach ($tierValues as $tier)
                    @php
                        $tierValue     = $tier[0];
                        $tierComponent = $tier[1];
                        $heroesInTier  = array_filter($rankData['heroes'], fn($h) => $h['value'] == $tierValue);
                        $roles = [
                            'Tank'    => '\images\assets\tank.webp',
                            'Damage'  => '\images\assets\damage.webp',
                            'Support' => '\images\assets\support.webp',
                        ];
                    @endphp

                    @if (count($heroesInTier) > 0)
                        <div class="mt-12 text-center glass-panel p-6 rounded-3xl border border-white/10 shadow-lg mb-8">
                            <div class="tier-header-wrapper mb-4">
                                {!! $tierComponent !!}
                            </div>
                            <div class="overflow-x-auto rounded-2xl border border-white/10 shadow-xl mt-4">
                                <table class="w-full text-left border-collapse">
                                    <thead>
                                        <tr class="bg-[#294452]/80 border-b border-white/10 text-slate-100 fjalla text-lg tracking-wider uppercase">
                                            <th class="p-4 text-center w-24">Hero</th>
                                            <th class="p-4 text-center w-24 border-l border-r border-white/10">Role</th>
                                            <th class="p-4 text-left hidden sm:table-cell">Description</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-white/5">
                                        @foreach ($roles as $roleName => $roleIcon)
                                            @foreach ($heroesInTier as $hero)
                                                @if ($hero['role'] == $roleName)
                                                    <tr class="hover:bg-white/5 transition-all duration-150 odd:bg-white/[0.02]">
                                                        <td class="p-4">
                                                            <a href="/heroes/{{ $hero['slug'] }}" class="flex flex-col items-center justify-center group/hero">
                                                                <img src="{{ $hero['img'] ?? 'images/assets/blank-hero.webp' }}"
                                                                    alt="{{ $hero['name'] }} profile" class="w-14 h-14 rounded-xl shadow-md border border-white/5 group-hover/hero:scale-105 group-hover/hero:border-white/20 transition-all duration-200">
                                                                <h4 class="text-xs poppins font-semibold text-slate-200 mt-2 w-20 text-center truncate group-hover/hero:text-amber-400 transition-colors">
                                                                    {{ $hero['name'] }}
                                                                </h4>
                                                            </a>
                                                        </td>
                                                        <td class="p-4 border-l border-r border-white/5">
                                                            <div class="flex flex-col items-center justify-center">
                                                                <img src="{{ $roleIcon }}" alt="{{ $roleName }} Icon" class="w-8 h-8 rounded-lg">
                                                                <h4 class="text-[10px] font-bold uppercase tracking-wider text-slate-400 poppins mt-1">{{ $roleName }}</h4>
                                                            </div>
                                                        </td>
                                                        <td class="p-4 align-middle hidden sm:table-cell">
                                                            <p class="text-slate-300 text-sm leading-relaxed poppins">{{ $hero['description'] }}</p>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endforeach
    </section>

    <script>
        const rouletteIcons = @json(array_map(fn($r) => asset($r['icon']), $allRanks));
        const rouletteImg   = document.getElementById('roulette-icon');
        let rouletteIndex   = 0;

        setInterval(() => {
            rouletteImg.style.opacity = '0';
            setTimeout(() => {
                rouletteIndex = (rouletteIndex + 1) % rouletteIcons.length;
                rouletteImg.src = rouletteIcons[rouletteIndex];
                rouletteImg.style.opacity = '1';
            }, 150);
        }, 500);

        function activateTab(btn) {
            document.querySelectorAll('.rank-tab').forEach(el => {
                el.classList.remove('bg-[#294452]', 'border-amber-400/40', 'text-amber-400', 'shadow-md', 'shadow-amber-400/5');
                el.classList.add('border-white/5', 'bg-[#294452]/20');
                const span = el.querySelector('span');
                span.classList.remove('text-slate-100');
                span.classList.add('text-slate-400');
            });
            btn.classList.add('bg-[#294452]', 'border-amber-400/40', 'text-amber-400', 'shadow-md', 'shadow-amber-400/5');
            btn.classList.remove('border-white/5', 'bg-[#294452]/20');
            const span = btn.querySelector('span');
            span.classList.remove('text-slate-400');
            span.classList.add('text-slate-100');
        }

        function showAllRanks(btn) {
            document.querySelectorAll('[data-rank]').forEach(el => el.style.display = 'none');
            document.querySelector('[data-rank="all"]').style.display = 'block';
            activateTab(btn);
        }

        function showRank(rank, btn) {
            document.querySelectorAll('[data-rank]').forEach(el => el.style.display = 'none');
            document.querySelector('[data-rank="' + rank + '"]').style.display = 'block';
            activateTab(btn);
        }
    </script>
@endsection

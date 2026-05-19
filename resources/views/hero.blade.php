@extends('layouts.home')
@section('content')

    @php
        $roleIcon = match($heroInfo['general_rol']) {
            'Tank'    => asset('images/assets/tank.webp'),
            'Damage'  => asset('images/assets/damage.webp'),
            'Support' => asset('images/assets/support.webp'),
            default   => null,
        };

        function scoreColor(int $score): string {
            if ($score >= 15)  return 'bg-emerald-600';
            if ($score >= 5)   return 'bg-lime-600';
            if ($score >= -4)  return 'bg-sky-700';
            if ($score >= -14) return 'bg-amber-600';
            return 'bg-rose-700';
        }
    @endphp

    {{-- ─── Hero Header ──────────────────────────────────────────────── --}}
    <section class="mt-10 sm:mt-14 max-w-4xl m-auto">
        <div class="flex flex-col sm:flex-row gap-6 items-center sm:items-start">

            {{-- Art image --}}
            <div class="flex-shrink-0">
                @php $artSrc = $heroImg['art-img'] ?? $heroImg['profile-img'] ?? null; @endphp
                <img src="{{ $artSrc ? asset($artSrc) : asset('images/assets/blank-hero.webp') }}"
                     alt="{{ $heroInfo['name'] }} art"
                     class="w-40 sm:w-56 rounded-xl shadow-lg">
            </div>

            {{-- Info --}}
            <div class="flex-1 text-center sm:text-left">
                <h1 class="fjalla font-normal text-4xl sm:text-6xl uppercase">{{ $heroInfo['name'] }}</h1>

                <div class="flex items-center justify-center sm:justify-start gap-2 mt-2">
                    @if ($roleIcon)
                        <img src="{{ $roleIcon }}" alt="{{ $heroInfo['general_rol'] }}" class="w-6 h-6">
                    @endif
                    <span class="text-base font-semibold text-gray-300">{{ $heroInfo['general_rol'] }}</span>
                    @if (!empty($heroInfo['secondary_rol']))
                        <span class="text-xs text-gray-400 border border-gray-600 rounded px-2 py-0.5">{{ $heroInfo['secondary_rol'] }}</span>
                    @endif
                </div>

                @if (!empty($heroInfo['description']))
                    <p class="mt-4 text-sm sm:text-base text-gray-200 leading-relaxed">{{ $heroInfo['description'] }}</p>
                @endif

                <div class="flex justify-center sm:justify-start gap-4 mt-4 text-xs text-gray-400">
                    @if ($heroInfo['health'] > 0)
                        <span><span class="text-green-400 font-semibold">HP</span> {{ $heroInfo['health'] }}</span>
                    @endif
                    @if ($heroInfo['armor'] > 0)
                        <span><span class="text-orange-400 font-semibold">Armor</span> {{ $heroInfo['armor'] }}</span>
                    @endif
                    @if ($heroInfo['shields'] > 0)
                        <span><span class="text-sky-400 font-semibold">Shields</span> {{ $heroInfo['shields'] }}</span>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- ─── Tier by Rank ─────────────────────────────────────────────── --}}
    <section class="mt-12 max-w-4xl m-auto">
        <h2 class="fjalla font-normal text-2xl sm:text-3xl border-b-2 border-dashed pb-2 mb-5">
            How good is {{ $heroInfo['name'] }} by rank?
        </h2>
        <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-7 gap-3">
            @foreach ($tiersByRank as $rankEntry)
                <div class="flex flex-col items-center bg-[#243d4a] rounded-xl p-3 gap-1">
                    <img src="{{ asset($rankEntry['rankIcon']) }}" alt="{{ $rankEntry['rankName'] }}" class="w-10 h-10">
                    <span class="text-xs text-gray-400 text-center leading-tight">{{ $rankEntry['rankName'] }}</span>
                    <span class="fjalla text-2xl font-normal {{ $rankEntry['tierColor'] }}">{{ $rankEntry['tierLetter'] }}</span>
                </div>
            @endforeach
        </div>
    </section>

    {{-- ─── Synergies ────────────────────────────────────────────────── --}}
    <section class="mt-12 max-w-4xl m-auto">
        <h2 class="fjalla font-normal text-2xl sm:text-3xl border-b-2 border-dashed pb-2 mb-5">
            Synergies
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

            <div>
                <h3 class="text-base font-semibold text-emerald-400 mb-3">Best teammates for {{ $heroInfo['name'] }}</h3>
                <div class="flex flex-col gap-2">
                    @foreach ($topSynergies as $ally)
                        <a href="/heroes/{{ $ally['slug'] }}"
                           class="flex items-center gap-3 bg-[#243d4a] rounded-lg p-2 hover:bg-[#2f4f60] transition-colors">
                            <img src="{{ $ally['img'] ? asset($ally['img']) : asset('images/assets/blank-hero.webp') }}"
                                 alt="{{ $ally['name'] }}" class="w-12 rounded-lg flex-shrink-0">
                            <span class="flex-1 text-sm font-medium">{{ $ally['name'] }}</span>
                            <span class="text-xs font-bold px-2 py-1 rounded {{ scoreColor($ally['score']) }}">
                                {{ $ally['score'] > 0 ? '+' : '' }}{{ $ally['score'] }}
                            </span>
                        </a>
                    @endforeach
                </div>
            </div>

            <div>
                <h3 class="text-base font-semibold text-rose-400 mb-3">Avoid pairing {{ $heroInfo['name'] }} with</h3>
                <div class="flex flex-col gap-2">
                    @foreach ($antiSynergies as $ally)
                        <a href="/heroes/{{ $ally['slug'] }}"
                           class="flex items-center gap-3 bg-[#243d4a] rounded-lg p-2 hover:bg-[#2f4f60] transition-colors">
                            <img src="{{ $ally['img'] ? asset($ally['img']) : asset('images/assets/blank-hero.webp') }}"
                                 alt="{{ $ally['name'] }}" class="w-12 rounded-lg flex-shrink-0">
                            <span class="flex-1 text-sm font-medium">{{ $ally['name'] }}</span>
                            <span class="text-xs font-bold px-2 py-1 rounded {{ scoreColor($ally['score']) }}">
                                {{ $ally['score'] > 0 ? '+' : '' }}{{ $ally['score'] }}
                            </span>
                        </a>
                    @endforeach
                </div>
            </div>

        </div>
    </section>

    {{-- ─── Counters ─────────────────────────────────────────────────── --}}
    <section class="mt-12 max-w-4xl m-auto">
        <h2 class="fjalla font-normal text-2xl sm:text-3xl border-b-2 border-dashed pb-2 mb-5">
            Counters
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

            <div>
                <h3 class="text-base font-semibold text-lime-400 mb-3">{{ $heroInfo['name'] }} counters</h3>
                <div class="flex flex-col gap-2">
                    @foreach ($heroCounters as $target)
                        <a href="/heroes/{{ $target['slug'] }}"
                           class="flex items-center gap-3 bg-[#243d4a] rounded-lg p-2 hover:bg-[#2f4f60] transition-colors">
                            <img src="{{ $target['img'] ? asset($target['img']) : asset('images/assets/blank-hero.webp') }}"
                                 alt="{{ $target['name'] }}" class="w-12 rounded-lg flex-shrink-0">
                            <span class="flex-1 text-sm font-medium">{{ $target['name'] }}</span>
                            <span class="text-xs font-bold px-2 py-1 rounded {{ scoreColor($target['score']) }}">
                                {{ $target['score'] > 0 ? '+' : '' }}{{ $target['score'] }}
                            </span>
                        </a>
                    @endforeach
                </div>
            </div>

            <div>
                <h3 class="text-base font-semibold text-amber-400 mb-3">{{ $heroInfo['name'] }} is countered by</h3>
                <div class="flex flex-col gap-2">
                    @foreach ($counteredBy as $threat)
                        <a href="/heroes/{{ $threat['slug'] }}"
                           class="flex items-center gap-3 bg-[#243d4a] rounded-lg p-2 hover:bg-[#2f4f60] transition-colors">
                            <img src="{{ $threat['img'] ? asset($threat['img']) : asset('images/assets/blank-hero.webp') }}"
                                 alt="{{ $threat['name'] }}" class="w-12 rounded-lg flex-shrink-0">
                            <span class="flex-1 text-sm font-medium">{{ $threat['name'] }}</span>
                            <span class="text-xs font-bold px-2 py-1 rounded {{ scoreColor($threat['score']) }}">
                                {{ $threat['score'] > 0 ? '+' : '' }}{{ $threat['score'] }}
                            </span>
                        </a>
                    @endforeach
                </div>
            </div>

        </div>
    </section>

    {{-- ─── Maps ─────────────────────────────────────────────────────── --}}
    <section class="mt-12 mb-12 max-w-4xl m-auto">
        <h2 class="fjalla font-normal text-2xl sm:text-3xl border-b-2 border-dashed pb-2 mb-5">
            Maps
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

            <div>
                <h3 class="text-base font-semibold text-emerald-400 mb-3">Best maps for {{ $heroInfo['name'] }}</h3>
                <div class="flex flex-col gap-2">
                    @foreach ($bestMaps as $mapName => $mapScore)
                        <div class="flex items-center justify-between bg-[#243d4a] rounded-lg px-4 py-3">
                            <span class="text-sm font-medium">{{ $mapName }}</span>
                            <span class="text-xs font-bold px-2 py-1 rounded {{ scoreColor($mapScore) }}">
                                {{ $mapScore > 0 ? '+' : '' }}{{ $mapScore }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>

            <div>
                <h3 class="text-base font-semibold text-rose-400 mb-3">Worst maps for {{ $heroInfo['name'] }}</h3>
                <div class="flex flex-col gap-2">
                    @foreach ($worstMaps as $mapName => $mapScore)
                        <div class="flex items-center justify-between bg-[#243d4a] rounded-lg px-4 py-3">
                            <span class="text-sm font-medium">{{ $mapName }}</span>
                            <span class="text-xs font-bold px-2 py-1 rounded {{ scoreColor($mapScore) }}">
                                {{ $mapScore > 0 ? '+' : '' }}{{ $mapScore }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section>

@endsection

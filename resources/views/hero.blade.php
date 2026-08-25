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
            if ($score >= 15)  return 'bg-emerald-600/90 text-white border border-emerald-500/20';
            if ($score >= 5)   return 'bg-emerald-500/20 text-emerald-300 border border-emerald-550/20';
            if ($score >= -4)  return 'bg-white/10 text-slate-300';
            if ($score >= -14) return 'bg-rose-500/20 text-rose-300 border border-rose-550/20';
            return 'bg-rose-600/90 text-white border border-rose-500/20';
        }
    @endphp

    {{-- ─── Hero Header ──────────────────────────────────────────────── --}}
    <section class="mt-12 max-w-4xl m-auto px-4">
        <div class="glass-panel p-6 sm:p-8 rounded-3xl border border-white/10 shadow-xl flex flex-col sm:flex-row gap-8 items-center sm:items-start relative overflow-hidden">
            <div class="absolute -top-12 -left-12 w-32 h-32 bg-[#294452]/20 rounded-full blur-2xl pointer-events-none"></div>

            {{-- Art image --}}
            <div class="flex-shrink-0 relative group">
                @php $artSrc = $heroImg['art-img'] ?? $heroImg['profile-img'] ?? null; @endphp
                <img src="{{ $artSrc ? asset($artSrc) : asset('images/assets/blank-hero.webp') }}"
                     alt="{{ $heroInfo['name'] }} art"
                     class="w-40 sm:w-48 rounded-2xl shadow-lg border border-white/10 group-hover:scale-[1.02] transition-transform duration-300">
            </div>

            {{-- Info --}}
            <div class="flex-1 text-center sm:text-left relative z-10">
                <h1 class="fjalla font-normal text-4xl sm:text-5xl uppercase tracking-wide text-slate-100">{{ $heroInfo['name'] }}</h1>

                <div class="flex items-center justify-center sm:justify-start gap-2.5 mt-3">
                    @if ($roleIcon)
                        <img src="{{ $roleIcon }}" alt="{{ $heroInfo['general_rol'] }}" class="w-5 h-5">
                    @endif
                    <span class="text-sm font-semibold uppercase tracking-wider text-slate-300 poppins">{{ $heroInfo['general_rol'] }}</span>
                    @if (!empty($heroInfo['secondary_rol']))
                        <span class="text-[10px] font-bold text-amber-400 border border-amber-450/30 bg-amber-450/5 rounded-full px-2.5 py-0.5 uppercase tracking-wide poppins">{{ $heroInfo['secondary_rol'] }}</span>
                    @endif
                </div>

                @if (!empty($heroInfo['description']))
                    <p class="mt-5 text-sm text-slate-350 leading-relaxed poppins">{{ $heroInfo['description'] }}</p>
                @endif

                <div class="flex justify-center sm:justify-start gap-6 mt-6 pt-5 border-t border-white/5 text-xs text-slate-400 uppercase tracking-wider font-semibold poppins">
                    @if ($heroInfo['health'] > 0)
                        <div class="flex items-center gap-1.5">
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 shadow-sm shadow-emerald-500/50"></span>
                            <span>HP <strong class="text-slate-200 ml-0.5">{{ $heroInfo['health'] }}</strong></span>
                        </div>
                    @endif
                    @if ($heroInfo['armor'] > 0)
                        <div class="flex items-center gap-1.5">
                            <span class="w-2.5 h-2.5 rounded-full bg-amber-500 shadow-sm shadow-amber-500/50"></span>
                            <span>Armor <strong class="text-slate-200 ml-0.5">{{ $heroInfo['armor'] }}</strong></span>
                        </div>
                    @endif
                    @if ($heroInfo['shields'] > 0)
                        <div class="flex items-center gap-1.5">
                            <span class="w-2.5 h-2.5 rounded-full bg-sky-500 shadow-sm shadow-sky-500/50"></span>
                            <span>Shields <strong class="text-slate-200 ml-0.5">{{ $heroInfo['shields'] }}</strong></span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- ─── Tier by Rank ─────────────────────────────────────────────── --}}
    <section class="mt-12 max-w-4xl m-auto px-4">
        <h2 class="fjalla font-normal text-2xl sm:text-3xl border-b border-white/10 pb-3 mb-6 uppercase tracking-wide text-slate-200">
            Performance by Competitive Rank
        </h2>
        <div class="grid grid-cols-4 sm:grid-cols-8 gap-2.5 sm:gap-3">
            @foreach ($tiersByRank as $rankEntry)
                <div class="flex flex-col items-center bg-white/5 border border-white/5 hover:border-white/10 hover:bg-[#294452]/20 rounded-2xl p-3 sm:p-4 gap-1.5 sm:gap-2 transition-all duration-300 group">
                    <img src="{{ asset($rankEntry['rankIcon']) }}" alt="{{ $rankEntry['rankName'] }}" class="w-8 h-8 sm:w-10 sm:h-10 invert opacity-75 group-hover:opacity-100 group-hover:scale-105 transition-all duration-300">
                    <span class="text-[10px] font-bold text-slate-400 text-center leading-tight uppercase tracking-wider poppins">{{ $rankEntry['rankName'] }}</span>
                    <span class="fjalla text-2xl sm:text-3xl {{ $rankEntry['tierColor'] }} mt-0.5 sm:mt-1">{{ $rankEntry['tierLetter'] }}</span>
                </div>
            @endforeach
        </div>
    </section>

    {{-- ─── Synergies ────────────────────────────────────────────────── --}}
    <section class="mt-12 max-w-4xl m-auto px-4">
        <div class="flex items-baseline justify-between border-b border-white/10 pb-3 mb-6">
            <h2 class="fjalla font-normal text-2xl sm:text-3xl uppercase tracking-wide text-slate-200">Synergies</h2>
            <a href="/synergies?hero={{ urlencode($heroInfo['name']) }}"
               class="text-xs text-amber-400 hover:text-amber-300 transition-colors fjalla uppercase tracking-wider font-semibold">
                Full Chart &rarr;
            </a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

            <div>
                <h3 class="text-sm font-semibold uppercase tracking-wider poppins text-emerald-400 mb-4 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    Best teammates for {{ $heroInfo['name'] }}
                </h3>
                <div class="flex flex-col gap-2">
                    @foreach ($topSynergies as $ally)
                        <a href="/heroes/{{ $ally['slug'] }}"
                           class="flex items-center gap-4 bg-white/5 hover:bg-white/10 border border-white/5 rounded-2xl p-3 hover:border-white/10 hover:-translate-y-[1px] transition-all duration-200 group">
                            <img src="{{ $ally['img'] ? asset($ally['img']) : asset('images/assets/blank-hero.webp') }}"
                                 alt="{{ $ally['name'] }}" class="w-11 h-11 rounded-xl flex-shrink-0 shadow border border-white/5 group-hover:scale-[1.02] transition-transform">
                            <span class="flex-1 text-sm font-semibold text-slate-200 poppins">{{ $ally['name'] }}</span>
                            <span class="text-xs font-bold w-12 h-8 flex items-center justify-center rounded-lg shadow {{ scoreColor($ally['score']) }}">
                                {{ $ally['score'] > 0 ? '+' : '' }}{{ $ally['score'] }}
                            </span>
                        </a>
                    @endforeach
                </div>
            </div>

            <div>
                <h3 class="text-sm font-semibold uppercase tracking-wider poppins text-rose-450 mb-4 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-rose-450"></span>
                    Avoid pairing {{ $heroInfo['name'] }} with
                </h3>
                <div class="flex flex-col gap-2">
                    @foreach ($antiSynergies as $ally)
                        <a href="/heroes/{{ $ally['slug'] }}"
                           class="flex items-center gap-4 bg-white/5 hover:bg-white/10 border border-white/5 rounded-2xl p-3 hover:border-white/10 hover:-translate-y-[1px] transition-all duration-200 group">
                            <img src="{{ $ally['img'] ? asset($ally['img']) : asset('images/assets/blank-hero.webp') }}"
                                 alt="{{ $ally['name'] }}" class="w-11 h-11 rounded-xl flex-shrink-0 shadow border border-white/5 group-hover:scale-[1.02] transition-transform">
                            <span class="flex-1 text-sm font-semibold text-slate-200 poppins">{{ $ally['name'] }}</span>
                            <span class="text-xs font-bold w-12 h-8 flex items-center justify-center rounded-lg shadow {{ scoreColor($ally['score']) }}">
                                {{ $ally['score'] > 0 ? '+' : '' }}{{ $ally['score'] }}
                            </span>
                        </a>
                    @endforeach
                </div>
            </div>

        </div>
    </section>

    {{-- ─── Counters ─────────────────────────────────────────────────── --}}
    <section class="mt-12 max-w-4xl m-auto px-4">
        <div class="flex items-baseline justify-between border-b border-white/10 pb-3 mb-6">
            <h2 class="fjalla font-normal text-2xl sm:text-3xl uppercase tracking-wide text-slate-200">Counters</h2>
            <a href="/counters?hero={{ urlencode($heroInfo['name']) }}"
               class="text-xs text-amber-400 hover:text-amber-300 transition-colors fjalla uppercase tracking-wider font-semibold">
                Full Chart &rarr;
            </a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

            <div>
                <h3 class="text-sm font-semibold uppercase tracking-wider poppins text-emerald-400 mb-4 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    {{ $heroInfo['name'] }} counters
                </h3>
                <div class="flex flex-col gap-2">
                    @foreach ($heroCounters as $target)
                        <a href="/heroes/{{ $target['slug'] }}"
                           class="flex items-center gap-4 bg-white/5 hover:bg-white/10 border border-white/5 rounded-2xl p-3 hover:border-white/10 hover:-translate-y-[1px] transition-all duration-200 group">
                            <img src="{{ $target['img'] ? asset($target['img']) : asset('images/assets/blank-hero.webp') }}"
                                 alt="{{ $target['name'] }}" class="w-11 h-11 rounded-xl flex-shrink-0 shadow border border-white/5 group-hover:scale-[1.02] transition-transform">
                            <span class="flex-1 text-sm font-semibold text-slate-200 poppins">{{ $target['name'] }}</span>
                            <span class="text-xs font-bold w-12 h-8 flex items-center justify-center rounded-lg shadow {{ scoreColor($target['score']) }}">
                                {{ $target['score'] > 0 ? '+' : '' }}{{ $target['score'] }}
                            </span>
                        </a>
                    @endforeach
                </div>
            </div>

            <div>
                <h3 class="text-sm font-semibold uppercase tracking-wider poppins text-amber-450 mb-4 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-amber-450"></span>
                    {{ $heroInfo['name'] }} is countered by
                </h3>
                <div class="flex flex-col gap-2">
                    @foreach ($counteredBy as $threat)
                        <a href="/heroes/{{ $threat['slug'] }}"
                           class="flex items-center gap-4 bg-white/5 hover:bg-white/10 border border-white/5 rounded-2xl p-3 hover:border-white/10 hover:-translate-y-[1px] transition-all duration-200 group">
                            <img src="{{ $threat['img'] ? asset($threat['img']) : asset('images/assets/blank-hero.webp') }}"
                                 alt="{{ $threat['name'] }}" class="w-11 h-11 rounded-xl flex-shrink-0 shadow border border-white/5 group-hover:scale-[1.02] transition-transform">
                            <span class="flex-1 text-sm font-semibold text-slate-200 poppins">{{ $threat['name'] }}</span>
                            <span class="text-xs font-bold w-12 h-8 flex items-center justify-center rounded-lg shadow {{ scoreColor($threat['score']) }}">
                                {{ $threat['score'] > 0 ? '+' : '' }}{{ $threat['score'] }}
                            </span>
                        </a>
                    @endforeach
                </div>
            </div>

        </div>
    </section>

    {{-- ─── Maps ─────────────────────────────────────────────────────── --}}
    <section class="mt-12 mb-20 max-w-4xl m-auto px-4">
        <div class="flex items-baseline justify-between border-b border-white/10 pb-3 mb-6">
            <h2 class="fjalla font-normal text-2xl sm:text-3xl uppercase tracking-wide text-slate-200">Maps</h2>
            <a href="/maps"
               class="text-xs text-amber-400 hover:text-amber-300 transition-colors fjalla uppercase tracking-wider font-semibold">
                Full Chart &rarr;
            </a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

            <div>
                <h3 class="text-sm font-semibold uppercase tracking-wider poppins text-emerald-400 mb-4 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    Best maps for {{ $heroInfo['name'] }}
                </h3>
                <div class="flex flex-col gap-2">
                    @foreach ($bestMaps as $mapName)
                        <a href="/maps?map={{ urlencode($mapName) }}"
                           class="flex items-center bg-white/5 hover:bg-white/10 border border-white/5 rounded-2xl px-5 py-4 hover:border-white/10 hover:-translate-y-[1px] transition-all duration-200 group">
                            <span class="text-sm font-semibold text-slate-200 poppins flex-1">{{ $mapName }}</span>
                            <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider group-hover:text-amber-400 transition-colors poppins">View Map &rarr;</span>
                        </a>
                    @endforeach
                </div>
            </div>

            <div>
                <h3 class="text-sm font-semibold uppercase tracking-wider poppins text-rose-450 mb-4 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-rose-450"></span>
                    Worst maps for {{ $heroInfo['name'] }}
                </h3>
                <div class="flex flex-col gap-2">
                    @foreach ($worstMaps as $mapName)
                        <a href="/maps?map={{ urlencode($mapName) }}"
                           class="flex items-center bg-white/5 hover:bg-white/10 border border-white/5 rounded-2xl px-5 py-4 hover:border-white/10 hover:-translate-y-[1px] transition-all duration-200 group">
                            <span class="text-sm font-semibold text-slate-200 poppins flex-1">{{ $mapName }}</span>
                            <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider group-hover:text-amber-400 transition-colors poppins">View Map &rarr;</span>
                        </a>
                    @endforeach
                </div>
            </div>

        </div>
    </section>

@endsection

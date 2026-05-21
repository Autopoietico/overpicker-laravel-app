@extends('layouts.home') @section('content')
    <section class="relative mt-7 flex justify-center">
        <div class="text-2xl font-black text-center mb-8 max-w-4xl sm:text-4xl">
            <h1 class="fjalla uppercase text-4xl sm:text-5xl tracking-wide leading-tight">Overwatch Hero Picker & Team Composition Calculator</h1>
        </div>
    </section>

    <section class="mb-10">
        <div class="poppins font-bold text-center text-xl sm:text-2xl md:text-3xl">
            <span class="text-sky-500 tracking-wide uppercase">Ally Team</span>
            <span class="text-slate-400/60 mx-2">/</span>
            <span class="text-rose-500 tracking-wide uppercase">Enemy Team</span>
        </div>
        <div class="calculator mt-4"></div>
    </section>

    {{-- SEO Content Section --}}
    <section class="max-w-4xl mx-auto mb-12 px-4">
        <h2 class="text-2xl sm:text-3xl font-bold text-center mb-6 fjalla uppercase tracking-wider">What is Overpicker?</h2>
        <div class="glass-panel rounded-2xl p-6 sm:p-8 border border-white/10 shadow-2xl">
            <p class="text-slate-200 text-base sm:text-lg mb-6 leading-relaxed">
                Overpicker is an advanced <strong>Overwatch hero picker</strong> designed to help players build the perfect
                team composition.
                Whether you're looking to counter the enemy team, find synergistic hero combinations, or simply pick the
                best hero for your map,
                Overpicker has you covered.
            </p>
            <ul class="space-y-4 mt-6">
                <li class="flex items-start">
                    <i class="bi bi-check-circle-fill text-amber-400 mt-1 mr-3"></i>
                    <span><strong class="text-slate-100">Hero Selection Tool</strong> - Quickly find the best heroes based on your team and enemy
                        composition.</span>
                </li>
                <li class="flex items-start">
                    <i class="bi bi-check-circle-fill text-amber-400 mt-1 mr-3"></i>
                    <span><strong class="text-slate-100">Tierlist System</strong> - Discover the best heroes for every competitive rank based on
                        high-level performance data.</span>
                </li>
                <li class="flex items-start">
                    <i class="bi bi-check-circle-fill text-amber-400 mt-1 mr-3"></i>
                    <span><strong class="text-slate-100">Counter Scoring Matrix</strong> - Identify which heroes hard counter the enemy picks and
                        gain the advantage.</span>
                </li>
                <li class="flex items-start">
                    <i class="bi bi-check-circle-fill text-amber-400 mt-1 mr-3"></i>
                    <span><strong class="text-slate-100">Synergy Scoring System</strong> - Discover powerful hero combinations that work well
                        together.</span>
                </li>
            </ul>
        </div>
    </section>
    <script defer src="js/calculator.js" type="module"></script>
@endsection

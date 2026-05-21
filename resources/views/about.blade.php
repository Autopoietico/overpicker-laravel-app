@extends('layouts.home') @section('content')
<section class="mt-12 flex justify-center sm:mt-16">
    <div class="text-2xl font-black text-center max-w-4xl sm:text-4xl">
        <h1 class="fjalla uppercase text-4xl sm:text-5xl tracking-wide leading-tight">
            About Overpicker
        </h1>
        <p class="text-slate-400 text-lg sm:text-xl font-normal mt-4 poppins max-w-2xl mx-auto">
            Overpicker is a hero composition calculator inspired by jazzmasta25's 
            <a href="https://heropicker.com/" target="_blank" rel="noopener noreferrer" class="text-amber-400 hover:underline decoration-amber-400">Hero Picker</a>.
        </p>
    </div>
</section>

<section class="mb-16 text-center sm:text-left text-sm max-w-4xl m-auto px-4 mt-12 grid grid-cols-1 md:grid-cols-2 gap-6">
    {{-- Left column --}}
    <div class="space-y-6">
        <div class="glass-panel p-6 rounded-2xl border border-white/10 shadow-lg">
            <h2 class="font-normal text-2xl fjalla uppercase tracking-wider text-slate-100 mb-3">The Creator</h2>
            <p class="sm:text-lg text-slate-350 leading-relaxed poppins">
                I'm a casual Overwatch player who loves statistics, team compositions, and tracking hero performance across different maps, situations, and metas. I'm from Colombia and bilingual in Spanish and English.
            </p>
        </div>

        <div class="glass-panel p-6 rounded-2xl border border-white/10 shadow-lg">
            <h2 class="font-normal text-2xl fjalla uppercase tracking-wider text-slate-100 mb-3">Overwatch Experience</h2>
            <p class="sm:text-lg text-slate-350 leading-relaxed poppins">
                I've been playing competitive Overwatch since <strong>Season 8</strong> of the original game. I've experienced every rank from Bronze up to my current rank at <strong>Diamond I</strong> (peaking around 3.9k SR). I'm primarily a Tank main but play all roles. My mains are <strong>D.Va/Zarya</strong>, <strong>Tracer/Soldier</strong>, and <strong>Ana/Illari</strong>.
            </p>
        </div>
    </div>

    {{-- Right column --}}
    <div class="space-y-6">
        <div class="glass-panel p-6 rounded-2xl border border-white/10 shadow-lg">
            <h2 class="font-normal text-2xl fjalla uppercase tracking-wider text-slate-100 mb-3">Social Links</h2>
            <p class="italic text-slate-400 mb-4 poppins">Mostly in Spanish</p>
            <div class="grid grid-cols-2 gap-3 text-slate-200">
                <a href="https://twitter.com/AutopoieticoLP" class="flex items-center gap-2 hover:text-amber-400 transition-colors" target="_blank" rel="noopener noreferrer">
                    <i class="bi bi-twitter"></i> Twitter
                </a>
                <a href="https://www.youtube.com/user/SrAutopoietico/" class="flex items-center gap-2 hover:text-amber-400 transition-colors" target="_blank" rel="noopener noreferrer">
                    <i class="bi bi-youtube"></i> Youtube
                </a>
                <a href="https://www.instagram.com/autopoietico/" class="flex items-center gap-2 hover:text-amber-400 transition-colors" target="_blank" rel="noopener noreferrer">
                    <i class="bi bi-instagram"></i> Instagram
                </a>
                <a href="https://www.reddit.com/user/autopoietico" class="flex items-center gap-2 hover:text-amber-400 transition-colors" target="_blank" rel="noopener noreferrer">
                    <i class="bi bi-reddit"></i> Reddit
                </a>
                <a href="https://www.twitch.tv/autopoietico" class="flex items-center gap-2 hover:text-amber-400 transition-colors" target="_blank" rel="noopener noreferrer">
                    <i class="bi bi-twitch"></i> Twitch
                </a>
            </div>
            <div class="mt-4 pt-4 border-t border-white/5 space-y-1 text-slate-350">
                <p><strong>Battletag:</strong> Autopoietico#1428</p>
                <p><strong>Discord:</strong> Autopoietico#1640</p>
            </div>
        </div>

        <div class="glass-panel p-6 rounded-2xl border border-white/10 shadow-lg">
            <h2 class="font-normal text-2xl fjalla uppercase tracking-wider text-slate-100 mb-3">Support the Project</h2>
            <p class="italic text-slate-400 mb-4 poppins">If you'd like to support the ongoing development of Overpicker:</p>
            <a href="https://paypal.me/car930" class="inline-flex items-center gap-2 bg-[#294452] border border-amber-400/40 text-amber-400 hover:bg-[#294452]/80 transition-all px-4 py-2 rounded-xl font-bold shadow-md shadow-amber-400/5 hover:scale-105" target="_blank" rel="noopener noreferrer">
                <i class="bi bi-paypal"></i> PayPal Donation
            </a>
        </div>
    </div>

    {{-- Bottom Full Width --}}
    <div class="md:col-span-2 glass-panel p-6 rounded-2xl border border-white/10 shadow-lg space-y-4">
        <h2 class="font-normal text-2xl fjalla uppercase tracking-wider text-slate-100 mb-3">Data Sources</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-slate-350 poppins">
            <p class="leading-relaxed">
                <strong>Tiers, Map Types and Maps:</strong> <br>
                Official pick/win rates from <a href="https://overwatch.blizzard.com/en-us/rates/" class="text-amber-450 hover:underline" target="_blank" rel="noopener noreferrer">overwatch.blizzard.com/en-us/rates/</a>
            </p>
            <p class="leading-relaxed">
                <strong>Map Points, Synergies &amp; Counters:</strong> <br>
                Based on continuous tracking and analysis of live high-level competitive matches.
            </p>
            <div class="md:col-span-2 pt-4 border-t border-white/5 leading-relaxed">
                <strong>Original Concept:</strong> <br>
                Overpicker is heavily inspired by and builds upon the original concept created by <strong>Jazzmasta25</strong> at <a href="https://www.heropicker.com/" class="text-amber-450 hover:underline" target="_blank" rel="noopener noreferrer">heropicker.com</a>.
            </div>
        </div>
    </div>
</section>
@endsection

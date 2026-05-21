@extends('layouts.home') @section('content')
<section class="mt-12 flex justify-center sm:mt-16">
    <div class="text-2xl font-black text-center max-w-4xl sm:text-4xl">
        <h1 class="fjalla uppercase text-4xl sm:text-5xl tracking-wide leading-tight">
            Data & Content Sources
        </h1>
        <p class="text-slate-400 text-lg sm:text-xl font-normal mt-4 poppins max-w-2xl mx-auto">
            Overpicker is built on top of competitive data, expert analysis, and community theorycrafting.
        </p>
    </div>
</section>

<section class="mb-16 text-center sm:text-left text-sm max-w-4xl m-auto px-4 mt-12 grid grid-cols-1 md:grid-cols-2 gap-6">
    {{-- Left block: Tiers & Aggregators --}}
    <div class="glass-panel p-6 rounded-2xl border border-white/10 shadow-lg space-y-4">
        <h2 class="font-normal text-2xl fjalla uppercase tracking-wider text-slate-100">
            Tiers & Statistics
        </h2>
        <p class="text-slate-350 leading-relaxed poppins sm:text-base">
            Hero tier lists are dynamically generated and adjusted using competitive rank statistics from 
            <a href="https://www.overbuff.com/heroes" class="text-amber-400 hover:underline" target="_blank" rel="noopener noreferrer">Overbuff</a>,
            evaluating pick rates and win rates across every skill bracket.
        </p>
        <p class="text-slate-355 leading-relaxed poppins sm:text-base">
            We integrate data from the 
            <a href="https://t500-aggregator.aryankothari.dev/" target="_blank" rel="noopener noreferrer" class="text-amber-400 hover:underline">Top 500 Aggregator</a>
            to assess pickrate trends and hero viability at the highest competitive tier.
        </p>
        <p class="text-slate-400 leading-relaxed poppins sm:text-sm pt-4 border-t border-white/5">
            <strong>Community & High-Level Input:</strong> <br>
            Tiers are cross-referenced with analysis from Top 500 players and guides creators like 
            <a href="https://www.youtube.com/@KarQ" target="_blank" rel="noopener noreferrer" class="text-slate-200 hover:text-amber-400 transition-colors font-semibold">KarQ</a>, 
            <a href="https://www.youtube.com/@Flats_OW" target="_blank" rel="noopener noreferrer" class="text-slate-200 hover:text-amber-400 transition-colors font-semibold">Flats</a>, 
            <a href="https://www.youtube.com/@YourOverwatch" target="_blank" rel="noopener noreferrer" class="text-slate-200 hover:text-amber-400 transition-colors font-semibold">Freedo</a>, 
            <a href="https://www.youtube.com/@Kajor1" target="_blank" rel="noopener noreferrer" class="text-slate-200 hover:text-amber-400 transition-colors font-semibold">Kajor</a>, and 
            <a href="https://www.youtube.com/@Toniki" target="_blank" rel="noopener noreferrer" class="text-slate-200 hover:text-amber-400 transition-colors font-semibold">Toniki</a>.
        </p>
    </div>

    {{-- Right block: Synergies & Counters --}}
    <div class="glass-panel p-6 rounded-2xl border border-white/10 shadow-lg space-y-4">
        <h2 class="font-normal text-2xl fjalla uppercase tracking-wider text-slate-100">
            Synergies & Counters
        </h2>
        <div class="space-y-3 text-slate-350 poppins sm:text-base leading-relaxed">
            <p>
                <a href="https://www.youtube.com/playlist?list=PLgRMcvKNkYFyD7RyWlNmvYF0NWcKei5z7" class="text-amber-400 hover:underline font-semibold" target="_blank" rel="noopener noreferrer">1 Tip for Every Hero Series (KarQ)</a> - Excellent resource detailing specific hero counters and game mechanics.
            </p>
            <p>
                <a href="https://www.youtube.com/playlist?list=PLfv7DSFO1b69Kb4vzlakeE5MiGL3UKnSh" class="text-amber-400 hover:underline font-semibold" target="_blank" rel="noopener noreferrer">Thought Process Series (SVB)</a> - Offers analytical breakdowns on hero synergies and composition setups.
            </p>
            <p>
                <a href="https://docs.google.com/document/d/11_VDsXLCrBwogQLaXgoNNbNel3kQkZ6txfT81H7iau0/edit?usp=sharing" class="text-amber-400 hover:underline font-semibold" target="_blank" rel="noopener noreferrer">All Existing Compositions in Overwatch (Shielder_OW)</a> - A detailed summary of core team compositions.
            </p>
            <p>
                <a href="https://www.youtube.com/watch?v=WfLzVVsHUGI&list=PLxTGkfX26YAguJHHTDFqwuwqLPzBqKXOh" class="text-amber-400 hover:underline font-semibold" target="_blank" rel="noopener noreferrer">KarQ Synergy Tier Lists</a> - Visual mappings of hero pairings and dual combos.
            </p>
        </div>
        <p class="text-slate-400 leading-relaxed poppins sm:text-sm pt-4 border-t border-white/5">
            <strong>Theorycrafting & Coaching:</strong> <br>
            Influenced by coaches like <a href="https://www.youtube.com/c/StormcrowProductions" class="text-slate-200 hover:text-amber-400 font-semibold" target="_blank" rel="noopener noreferrer">Spillo</a>, <a href="https://www.youtube.com/@Kajor1/" class="text-slate-200 hover:text-amber-400 font-semibold" target="_blank" rel="noopener noreferrer">Kajor</a>, and <a href="https://www.youtube.com/@YourOverwatch" class="text-slate-200 hover:text-amber-400 font-semibold" target="_blank" rel="noopener noreferrer">Freedo</a>.
        </p>
    </div>

    {{-- Bottom Full Width --}}
    <div class="md:col-span-2 glass-panel p-6 rounded-2xl border border-white/10 shadow-lg space-y-4">
        <h2 class="font-normal text-2xl fjalla uppercase tracking-wider text-slate-100">
            Original Concept
        </h2>
        <p class="text-slate-350 leading-relaxed poppins sm:text-base">
            Overpicker was originally inspired by <strong>Jazzmasta25</strong>'s <a href="https://heropicker.com/" target="_blank" rel="noopener noreferrer" class="text-amber-400 hover:underline">Hero Picker</a>. While the calculation logic and data parameters have been custom built for this version, the layout and interactive structure pays homage to the original tool.
        </p>
    </div>
</section>
@endsection

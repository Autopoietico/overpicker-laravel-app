@extends('layouts.home')
@section('content')
<section class="mt-12 flex flex-col items-center px-4 sm:mt-16 max-w-5xl mx-auto">
    <div class="text-center max-w-4xl">
        <h1 class="fjalla uppercase text-4xl sm:text-5xl tracking-wide leading-tight mb-8">
            Competitive Match Tracker
        </h1>
        <div class="glass-panel p-2 rounded-3xl border border-white/10 shadow-xl overflow-hidden mb-12">
            <img src="{{ asset('images/assets/trackers-hero.webp') }}" alt="Overwatch Tracker Dashboard screenshot"
                class="rounded-2xl w-full shadow-lg">
        </div>
    </div>
</section>

<section class="mb-20 px-4 max-w-4xl mx-auto space-y-12">
    <!-- Intro Card -->
    <div class="glass-panel p-6 sm:p-8 rounded-3xl border border-white/10 shadow-lg poppins">
        <h2 class="fjalla text-2xl uppercase tracking-wider text-slate-200 mb-4">Tracker Origin & Support</h2>
        <p class="text-slate-350 leading-relaxed text-sm sm:text-base">
            This tracking system was originally designed by Reddit user 
            <a href="https://www.reddit.com/user/LeCorbuisoverrated/" target="_blank" rel="noopener noreferrer" class="text-amber-400 hover:text-amber-300 font-medium underline">LeCorbuisoverrated</a>. 
            While the original sheet has been discontinued, we continue to maintain and update the template configuration with new maps, game modes, and heroes as they join the roster.
        </p>
        <div class="mt-4 p-4 bg-amber-400/5 border border-amber-400/25 rounded-2xl text-xs sm:text-sm text-amber-300 leading-relaxed">
            <strong class="font-bold uppercase tracking-wider block mb-1">Notice:</strong>
            We focus exclusively on updating the database schema with new content updates. Debugging or custom scripting modifications are not officially supported, but the sheets are fully unlocked for you to copy and customize.
        </div>
    </div>

    <!-- Downloads Grid -->
    <div>
        <h2 class="fjalla text-2xl uppercase tracking-wider text-slate-200 mb-6">Get Your Tracker Sheet</h2>
        <p class="text-slate-400 text-sm poppins mb-6">Choose a template type below. To start using one, open the link, click <strong class="text-slate-200">File &gt; Make a copy</strong>, and save it to your Google Drive.</p>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
            <!-- OpenQ -->
            <a href="https://docs.google.com/spreadsheets/d/1nGr0T2ssFyH-AVC4cd5ZxGIAVUYSUIVt6Cl-9un_NjY/" target="_blank" rel="noopener noreferrer" 
                class="glass-panel p-5 rounded-2xl border border-white/10 hover:border-amber-400/50 hover:bg-white/5 transition-all flex flex-col justify-between group">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-[10px] font-bold text-amber-400 tracking-wider uppercase poppins">OPEN QUEUE</span>
                        <i class="bi bi-box-arrow-up-right text-slate-400 group-hover:text-amber-400 transition-colors"></i>
                    </div>
                    <h4 class="fjalla text-lg uppercase text-slate-200 tracking-wide">OpenQ Template</h4>
                    <p class="text-[11px] text-slate-400 mt-2 poppins leading-relaxed">Track standard open queue formats with open role flexibility.</p>
                </div>
                <span class="text-xs font-bold text-slate-300 mt-6 uppercase tracking-wider poppins group-hover:text-amber-450 transition-colors">Get Copy &rarr;</span>
            </a>

            <!-- Tank -->
            <a href="https://docs.google.com/spreadsheets/d/1zm3TvpIBp9VZeUPLqYiGVTNshz8dZJD6bDBxGmG6AgQ/" target="_blank" rel="noopener noreferrer" 
                class="glass-panel p-5 rounded-2xl border border-white/10 hover:border-amber-400/50 hover:bg-white/5 transition-all flex flex-col justify-between group">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-[10px] font-bold text-amber-400 tracking-wider uppercase poppins">ROLE QUEUE</span>
                        <i class="bi bi-box-arrow-up-right text-slate-400 group-hover:text-amber-400 transition-colors"></i>
                    </div>
                    <h4 class="fjalla text-lg uppercase text-slate-200 tracking-wide">Tank Tracker</h4>
                    <p class="text-[11px] text-slate-400 mt-2 poppins leading-relaxed">Dedicated metrics focusing on tank gameplay mechanics.</p>
                </div>
                <span class="text-xs font-bold text-slate-300 mt-6 uppercase tracking-wider poppins group-hover:text-amber-450 transition-colors">Get Copy &rarr;</span>
            </a>

            <!-- Damage -->
            <a href="https://docs.google.com/spreadsheets/d/1rkf7e8CwdoWv0T6HWvmR7o8WbstfYPrZnkjGJzvp468/" target="_blank" rel="noopener noreferrer" 
                class="glass-panel p-5 rounded-2xl border border-white/10 hover:border-amber-400/50 hover:bg-white/5 transition-all flex flex-col justify-between group">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-[10px] font-bold text-amber-400 tracking-wider uppercase poppins">ROLE QUEUE</span>
                        <i class="bi bi-box-arrow-up-right text-slate-400 group-hover:text-amber-400 transition-colors"></i>
                    </div>
                    <h4 class="fjalla text-lg uppercase text-slate-200 tracking-wide">Damage Tracker</h4>
                    <p class="text-[11px] text-slate-400 mt-2 poppins leading-relaxed">Optimize DPS stats, hero selections, and map pressure.</p>
                </div>
                <span class="text-xs font-bold text-slate-300 mt-6 uppercase tracking-wider poppins group-hover:text-amber-450 transition-colors">Get Copy &rarr;</span>
            </a>

            <!-- Support -->
            <a href="https://docs.google.com/spreadsheets/d/1yj0OLx1f9Hs9YxRqmH02wkQwODvIAfotvA77AhyOIW4/" target="_blank" rel="noopener noreferrer" 
                class="glass-panel p-5 rounded-2xl border border-white/10 hover:border-amber-400/50 hover:bg-white/5 transition-all flex flex-col justify-between group">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-[10px] font-bold text-amber-400 tracking-wider uppercase poppins">ROLE QUEUE</span>
                        <i class="bi bi-box-arrow-up-right text-slate-400 group-hover:text-amber-400 transition-colors"></i>
                    </div>
                    <h4 class="fjalla text-lg uppercase text-slate-200 tracking-wide">Support Tracker</h4>
                    <p class="text-[11px] text-slate-400 mt-2 poppins leading-relaxed">Detailed logging for healing, utility support, and survival rates.</p>
                </div>
                <span class="text-xs font-bold text-slate-300 mt-6 uppercase tracking-wider poppins group-hover:text-amber-450 transition-colors">Get Copy &rarr;</span>
            </a>
        </div>

        <div class="mt-4 text-center">
            <span class="text-xs text-slate-450 poppins">Want to preview a populated dataset? Check out the 
                <a href="https://docs.google.com/spreadsheets/d/18wktlOAZqmi-AOHrb6EqLhOkpEckR_K3v0Zd3AYqaOQ/" target="_blank" rel="noopener noreferrer" class="text-amber-400 hover:underline">Sample Sheet</a>.
            </span>
        </div>
    </div>

    <!-- Translator Card -->
    <div class="glass-panel p-6 rounded-3xl border border-white/10 shadow-lg">
        <button id="toggleButton" class="w-full flex items-center justify-between focus:outline-none py-2 text-left group">
            <div class="flex flex-col">
                <span class="fjalla text-xl uppercase tracking-wider text-slate-200 group-hover:text-amber-400 transition-colors">SR &amp; Tier Translator</span>
                <span class="text-[10px] text-slate-450 uppercase tracking-widest font-semibold poppins mt-1">Convert competitive ranks back to numerical SR</span>
            </div>
            <i class="bi bi-chevron-down text-slate-400 group-hover:text-amber-400 transition-all duration-200 text-lg" id="toggleIcon"></i>
        </button>
        <div id="listContainer" class="hidden mt-6 pt-6 border-t border-white/5 poppins">
            <p class="text-xs text-slate-450 mb-6 leading-relaxed">
                The spreadsheet uses the legacy numerical Skill Rating (SR) values. Use this reference map to translate your current division tiers into mathematical equivalents.
            </p>
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                @php
                    $tiers = [
                        'Champion 1' => '4900 SR', 'Champion 2' => '4800 SR', 'Champion 3' => '4700 SR', 'Champion 4' => '4600 SR', 'Champion 5' => '4500 SR',
                        'Grandmaster 1' => '4400 SR', 'Grandmaster 2' => '4300 SR', 'Grandmaster 3' => '4200 SR', 'Grandmaster 4' => '4100 SR', 'Grandmaster 5' => '4000 SR',
                        'Master 1' => '3900 SR', 'Master 2' => '3800 SR', 'Master 3' => '3700 SR', 'Master 4' => '3600 SR', 'Master 5' => '3500 SR',
                        'Diamond 1' => '3400 SR', 'Diamond 2' => '3300 SR', 'Diamond 3' => '3200 SR', 'Diamond 4' => '3100 SR', 'Diamond 5' => '3000 SR',
                        'Platinum 1' => '2900 SR', 'Platinum 2' => '2800 SR', 'Platinum 3' => '2700 SR', 'Platinum 4' => '2600 SR', 'Platinum 5' => '2500 SR',
                        'Gold 1' => '2400 SR', 'Gold 2' => '2300 SR', 'Gold 3' => '2200 SR', 'Gold 4' => '2100 SR', 'Gold 5' => '2000 SR',
                        'Silver 1' => '1900 SR', 'Silver 2' => '1800 SR', 'Silver 3' => '1700 SR', 'Silver 4' => '1600 SR', 'Silver 5' => '1500 SR',
                        'Bronze 1' => '1400 SR', 'Bronze 2' => '1300 SR', 'Bronze 3' => '1200 SR', 'Bronze 4' => '1100 SR', 'Bronze 5' => '1000 SR or less'
                    ];
                @endphp
                @foreach ($tiers as $name => $sr)
                    <div class="flex justify-between items-center bg-white/5 rounded-xl px-4 py-2.5 border border-white/5">
                        <span class="font-semibold text-slate-300 text-xs truncate mr-2">{{ $name }}</span>
                        <span class="font-bold text-amber-400 text-xs shrink-0">{{ $sr }}</span>
                    </div>
                @endforeach
            </div>
            <div class="mt-6 p-4 bg-white/[0.02] border border-white/5 rounded-2xl text-[11px] text-slate-400 leading-relaxed">
                <strong>Bronze 5 Note:</strong> Numerical calculation parameters under 1100 SR may deviate from standard formulas due to the wider skill compression range in the lowest division tier.
            </div>
        </div>
    </div>

    <!-- Instructions Card -->
    <div class="glass-panel p-6 sm:p-8 rounded-3xl border border-white/10 shadow-lg poppins">
        <h2 class="fjalla text-2xl uppercase tracking-wider text-slate-200 mb-6">Setup Instructions</h2>
        <div class="space-y-6">
            <div class="flex gap-4">
                <span class="w-8 h-8 rounded-lg bg-amber-400/10 border border-amber-400/30 flex items-center justify-center font-bold text-amber-450 shrink-0 text-sm">1</span>
                <div>
                    <h4 class="font-semibold text-slate-200 text-sm sm:text-base">Configure Time Zone</h4>
                    <p class="text-xs sm:text-sm text-slate-400 mt-1 leading-relaxed">
                        In your copied Google Sheet, navigate to <strong class="text-slate-350">File &gt; Settings</strong> and select your local Time Zone. Do not modify other regional spreadsheet settings to avoid math errors.
                    </p>
                </div>
            </div>
            <div class="flex gap-4">
                <span class="w-8 h-8 rounded-lg bg-amber-400/10 border border-amber-400/30 flex items-center justify-center font-bold text-amber-450 shrink-0 text-sm">2</span>
                <div>
                    <h4 class="font-semibold text-slate-200 text-sm sm:text-base">Initialize Placement SR</h4>
                    <p class="text-xs sm:text-sm text-slate-400 mt-1 leading-relaxed">
                        Once your competitive tier placement maps finish, populate your baseline rating into the <a href="https://i.imgur.com/dYIZndi.png" target="_blank" rel="noopener noreferrer" class="text-amber-400 hover:underline">starting SR cell</a> to establish your stats history baseline.
                    </p>
                </div>
            </div>
            <div class="flex gap-4">
                <span class="w-8 h-8 rounded-lg bg-amber-400/10 border border-amber-400/30 flex items-center justify-center font-bold text-amber-450 shrink-0 text-sm">3</span>
                <div>
                    <h4 class="font-semibold text-slate-200 text-sm sm:text-base">Log Match History</h4>
                    <p class="text-xs sm:text-sm text-slate-400 mt-1 leading-relaxed">
                        After each game session, fill in the metrics (Map, Hero choices, Team average rating, and notes). Cell inputs highlighted in <strong class="text-sky-400">Blue</strong> require manual inputs; <strong class="text-sky-300">Light Blue</strong> cells contain automated formulas.
                    </p>
                </div>
            </div>
            <div class="flex gap-4">
                <span class="w-8 h-8 rounded-lg bg-amber-400/10 border border-amber-400/30 flex items-center justify-center font-bold text-amber-450 shrink-0 text-sm">4</span>
                <div>
                    <h4 class="font-semibold text-slate-200 text-sm sm:text-base">Input Sheet URL</h4>
                    <p class="text-xs sm:text-sm text-slate-400 mt-1 leading-relaxed">
                        Copy the exact web URL of your spreadsheet into the cell next to the "Next Match" top bar button. This links the custom macros correctly and lets the link cleanly disappear.
                    </p>
                </div>
            </div>
        </div>

        <div class="mt-8 pt-6 border-t border-white/5 flex flex-col md:flex-row items-center gap-6">
            <div class="md:w-1/2">
                <h4 class="font-semibold text-slate-200 text-sm mb-2 uppercase tracking-wide">Quick Abbreviations Key</h4>
                <p class="text-xs text-slate-400 leading-relaxed">
                    Refer to this shorthand reference layout to log maps, objectives, and heroes accurately.
                </p>
            </div>
            <div class="md:w-1/2 w-full">
                <a href="https://i.imgur.com/d4wJhCM.png" target="_blank" rel="noopener noreferrer" class="block glass-panel p-1 rounded-2xl border border-white/10 hover:border-amber-400/30 transition-all overflow-hidden">
                    <img src="{{ asset('images/assets/ABREBIATIONS.webp') }}" alt="Overwatch Tracker Manual Abbreviations Map" class="w-full rounded-xl">
                </a>
            </div>
        </div>
    </div>

    <!-- Sheet Architecture -->
    <div class="glass-panel p-6 sm:p-8 rounded-3xl border border-white/10 shadow-lg poppins">
        <h2 class="fjalla text-2xl uppercase tracking-wider text-slate-200 mb-6">Sheet Architecture</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h4 class="font-bold text-amber-450 text-sm uppercase tracking-wider mb-1">Home Dashboard</h4>
                <p class="text-xs text-slate-400 leading-relaxed mb-4">
                    Presents a unified overview of all competitive ranks, season wins/losses, role distributions, and key KPIs.
                </p>
                <h4 class="font-bold text-amber-450 text-sm uppercase tracking-wider mb-1">Maps Performance</h4>
                <p class="text-xs text-slate-400 leading-relaxed mb-4">
                    Correlates specific stages with your win rates, tracking which objectives fit your roster's pools.
                </p>
                <h4 class="font-bold text-amber-450 text-sm uppercase tracking-wider mb-1">Mates &amp; Groups</h4>
                <p class="text-xs text-slate-400 leading-relaxed mb-4">
                    Assesses team performance variables based on who you group up with in your matches.
                </p>
                <h4 class="font-bold text-amber-450 text-sm uppercase tracking-wider mb-1">SR/WR Progression</h4>
                <p class="text-xs text-slate-400 leading-relaxed">
                    A visual progress line tracking rating changes over time to monitor consistency.
                </p>
            </div>
            <div>
                <h4 class="font-bold text-amber-450 text-sm uppercase tracking-wider mb-1">Hero Database</h4>
                <p class="text-xs text-slate-400 leading-relaxed mb-4">
                    Highlights average SR swings (won/lost) per character, general win ratios, and role efficiency.
                </p>
                <h4 class="font-bold text-amber-450 text-sm uppercase tracking-wider mb-1">Timeline Analytics</h4>
                <p class="text-xs text-slate-400 leading-relaxed mb-4">
                    Find patterns detailing when you secure wins by cross-referencing day schedules and peak playtimes.
                </p>
                <h4 class="font-bold text-amber-450 text-sm uppercase tracking-wider mb-1">Advanced Assets</h4>
                <p class="text-xs text-slate-400 leading-relaxed mb-4">
                    Dynamic background assets syncing sheets to a global schema to auto-populate future game content updates.
                </p>
                <h4 class="font-bold text-amber-450 text-sm uppercase tracking-wider mb-1">SR Swing Dynamics</h4>
                <p class="text-xs text-slate-400 leading-relaxed">
                    Evaluates point fluctuations after matches to map performance swings against expectations.
                </p>
            </div>
        </div>
    </div>

    <!-- FAQ Accordion -->
    <div>
        <h2 class="fjalla text-2xl uppercase tracking-wider text-slate-200 mb-6">Frequently Asked Questions</h2>
        <div class="space-y-4 poppins">
            @php
                $faqs = [
                    [
                        'q' => 'Can I request additional tips or advice matrices?',
                        'a' => 'Currently, the advice templates remain static, but custom advice sheets can be easily written straight inside your copied spreadsheet file.'
                    ],
                    [
                        'q' => 'Where are Overwatch screenshots stored by default?',
                        'a' => 'By default, the client writes files to "Documents\Overwatch\ScreenShots\Overwatch". Check your in-game keybind layouts for the screenshot shortcut.'
                    ],
                    [
                        'q' => 'Can I use this file inside Excel, Calc, or Apple Numbers?',
                        'a' => 'No. Many core metrics rely on Google Sheets exclusive dynamic functions (like QUERY and custom imports) and will break on other engines.'
                    ],
                    [
                        'q' => 'What is the naming scheme behind the version tags?',
                        'a' => 'Following the original creator\'s convention of naming versions after geography, we tag updates using high peak names (Aconcagua, Bonete Chico, Paramillo, etc.).'
                    ],
                    [
                        'q' => 'Is there an easier way? Doing this manually feels like a job!',
                        'a' => 'Until public competitive match APIs are open, manual data entry is necessary. Tools like Overbuff track stats automatically, but cannot correlate personal variables like schedule, stack teammates, or match notes.'
                    ]
                ];
            @endphp
            @foreach ($faqs as $i => $faq)
                <div class="glass-panel p-5 rounded-2xl border border-white/10">
                    <h4 class="font-semibold text-slate-200 text-sm sm:text-base mb-2">Q: {{ $faq['q'] }}</h4>
                    <p class="text-xs sm:text-sm text-slate-400 leading-relaxed">A: {{ $faq['a'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toggleButton = document.getElementById('toggleButton');
        const listContainer = document.getElementById('listContainer');
        const toggleIcon = document.getElementById('toggleIcon');

        toggleButton.addEventListener('click', () => {
            const isHidden = listContainer.classList.toggle('hidden');
            if (isHidden) {
                toggleIcon.style.transform = 'rotate(0deg)';
                toggleIcon.classList.remove('text-amber-400');
            } else {
                toggleIcon.style.transform = 'rotate(180deg)';
                toggleIcon.classList.add('text-amber-400');
            }
        });
    });
</script>
@endsection
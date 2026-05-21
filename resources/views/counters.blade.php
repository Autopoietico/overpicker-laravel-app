@extends('layouts.home')
@section('content')
    <section class="mt-12 flex justify-center sm:mt-16">
        <div class="text-2xl font-black text-center max-w-4xl sm:text-4xl">
            <h1 class="fjalla uppercase text-4xl sm:text-5xl tracking-wide leading-tight">
                Overwatch Counter Matrix
            </h1>
        </div>
    </section>

    <section class="mb-16 text-center sm:text-left text-sm max-w-4xl m-auto px-4 mt-6">
        <div class="glass-panel p-6 rounded-3xl border border-white/10 shadow-lg text-slate-300 poppins leading-relaxed">
            <p class="sm:text-lg mb-4 text-slate-200">
                Select a hero below to view their matchups, ranked from the strongest counters to the easiest targets.
                On desktop, the results are divided by role. On mobile, you can use the role tabs to navigate the list.
            </p>
            <div class="pt-4 border-t border-white/5">
                <p class="font-semibold text-slate-200 mb-2">How the Scoring System Works:</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-slate-350">
                    <p>
                        <strong class="text-emerald-400 font-bold">+20 (Hard Counter):</strong> The hero completely dominates this matchup. We recommend switching or playing with extreme caution.
                    </p>
                    <p>
                        <strong class="text-emerald-300 font-bold">+10 (Favorable Matchup):</strong> The hero has clear utility, damage, or positional advantages.
                    </p>
                    <p>
                        <strong class="text-slate-400 font-bold">0 (Skill Matchup):</strong> Neither hero has an inherent kits/mechanics advantage; outcome depends on player skill.
                    </p>
                    <p>
                        <strong class="text-rose-400 font-bold">-10 to -20 (Weak Matchup):</strong> The selected hero is weak against your opponent. Avoid picking the opponent in this scenario.
                    </p>
                </div>
            </div>
        </div>

        <div class="mt-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <!-- Hero Selector Label -->
            <div>
                <p class="fjalla text-xl uppercase tracking-wider text-slate-100">Select Your Hero:</p>
            </div>
            <!-- Hero Search -->
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" id="heroSearch" placeholder="Search hero..."
                    class="w-full sm:w-80 pl-9 pr-4 py-2 rounded-xl bg-[#294452]/40 text-white border border-white/10 placeholder-slate-400 focus:outline-none focus:border-amber-400/50 transition-all font-semibold poppins text-sm">
            </div>
        </div>

        <!-- Hero Selector Strip -->
        <div class="mt-3 relative">
            <div class="overflow-x-auto pb-3 scrollbar-custom">
                <div class="flex gap-2.5 flex-nowrap">
                    @foreach ($heroes as $hero)
                        @php
                            $heroImage = $hero_images[$hero['name']] ?? 'images/assets/blank-hero.webp';
                            $role = $hero_roles[$hero['name']] ?? 'Unknown';
                        @endphp
                        <button
                            class="hero-selector-btn flex flex-col items-center p-2 rounded-2xl bg-white/5 border border-white/5 hover:bg-white/10 cursor-pointer min-w-[70px] transition-all duration-200"
                            data-hero="{{ $hero['name'] }}" data-role="{{ $role }}"
                            onclick="selectHero('{{ $hero['name'] }}')">
                            <img src="{{ $heroImage }}" alt="{{ $hero['name'] }}" class="w-10 h-10 rounded-xl shadow-md border border-white/5">
                            <span class="text-[11px] font-semibold text-slate-350 truncate max-w-[62px] mt-1.5 leading-tight poppins">{{ $hero['name'] }}</span>
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Role Filters (mobile only) -->
        <div class="mt-6 flex flex-wrap items-center gap-3 lg:hidden">
            <button onclick="filterByRole('Tank', event)"
                class="role-filter-btn flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white/5 hover:bg-white/10 border border-white/5 transition-all text-slate-300 font-semibold poppins text-xs"
                data-role="Tank">
                <img src="\images\assets\tank.webp" alt="Tank Icon" class="w-4 h-4">
                TANK
            </button>
            <button onclick="filterByRole('Damage', event)"
                class="role-filter-btn flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white/5 hover:bg-white/10 border border-white/5 transition-all text-slate-300 font-semibold poppins text-xs"
                data-role="Damage">
                <img src="\images\assets\damage.webp" alt="Damage Icon" class="w-4 h-4">
                DAMAGE
            </button>
            <button onclick="filterByRole('Support', event)"
                class="role-filter-btn flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white/5 hover:bg-white/10 border border-white/5 transition-all text-slate-300 font-semibold poppins text-xs"
                data-role="Support">
                <img src="\images\assets\support.webp" alt="Support Icon" class="w-4 h-4">
                SUPPORT
            </button>
            <button id="resetFilter"
                class="px-4 py-2.5 bg-white/5 border border-white/5 text-slate-400 rounded-xl hover:bg-white/10 transition-all font-semibold poppins text-xs">
                RESET
            </button>
        </div>

        <!-- Hero info line -->
        <div id="heroInfo" class="mt-6 text-sm text-amber-450 font-bold poppins uppercase tracking-wider text-center sm:text-left"></div>

        <!-- Empty state -->
        <div id="emptyState" class="mt-16 mb-16 text-center text-slate-400 text-lg fjalla tracking-wide uppercase">
            Select a hero above to reveal the counter matrix.
        </div>

        <!-- Results: 3 columns on desktop, 1 on mobile -->
        <div class="mt-6 grid grid-cols-1 lg:grid-cols-3 gap-6" id="resultsContainer" style="display:none">

            <div id="tankSection" class="glass-panel p-5 rounded-3xl border border-white/10 shadow-lg">
                <h3 class="fjalla uppercase text-center text-lg mb-4 flex items-center justify-center gap-2 text-slate-100">
                    <img src="\images\assets\tank.webp" class="w-5 h-5" alt="Tank"> Tank Matchups
                </h3>
                <div class="overflow-hidden rounded-2xl border border-white/5 shadow-inner">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-white/5 text-slate-300 fjalla text-xs uppercase tracking-wider border-b border-white/5">
                                <th class="p-3">Hero</th>
                                <th class="p-3 text-center w-20">Score</th>
                            </tr>
                        </thead>
                        <tbody id="tankBody" class="divide-y divide-white/5"></tbody>
                    </table>
                </div>
            </div>

            <div id="damageSection" class="glass-panel p-5 rounded-3xl border border-white/10 shadow-lg">
                <h3 class="fjalla uppercase text-center text-lg mb-4 flex items-center justify-center gap-2 text-slate-100">
                    <img src="\images\assets\damage.webp" class="w-5 h-5" alt="Damage"> Damage Matchups
                </h3>
                <div class="overflow-hidden rounded-2xl border border-white/5 shadow-inner">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-white/5 text-slate-300 fjalla text-xs uppercase tracking-wider border-b border-white/5">
                                <th class="p-3">Hero</th>
                                <th class="p-3 text-center w-20">Score</th>
                            </tr>
                        </thead>
                        <tbody id="damageBody" class="divide-y divide-white/5"></tbody>
                    </table>
                </div>
            </div>

            <div id="supportSection" class="glass-panel p-5 rounded-3xl border border-white/10 shadow-lg">
                <h3 class="fjalla uppercase text-center text-lg mb-4 flex items-center justify-center gap-2 text-slate-100">
                    <img src="\images\assets\support.webp" class="w-5 h-5" alt="Support"> Support Matchups
                </h3>
                <div class="overflow-hidden rounded-2xl border border-white/5 shadow-inner">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-white/5 text-slate-300 fjalla text-xs uppercase tracking-wider border-b border-white/5">
                                <th class="p-3">Hero</th>
                                <th class="p-3 text-center w-20">Score</th>
                            </tr>
                        </thead>
                        <tbody id="supportBody" class="divide-y divide-white/5"></tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- Counters Legend -->
        <div class="mt-12 p-6 glass-panel rounded-3xl border border-white/10 shadow-lg">
            <h4 class="fjalla uppercase text-sm tracking-wider text-slate-300 text-center mb-4">Legend Overview</h4>
            <div class="grid grid-cols-2 sm:grid-cols-5 gap-4">
                <div class="flex flex-col items-center">
                    <div class="w-12 h-9 bg-emerald-600 rounded-lg flex items-center justify-center mb-2 shadow text-white font-bold text-sm">
                        +20
                    </div>
                    <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wide poppins text-center">Hard Counter</span>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-12 h-9 bg-emerald-500 rounded-lg flex items-center justify-center mb-2 shadow text-white font-bold text-sm">
                        +10
                    </div>
                    <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wide poppins text-center">Counter</span>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-12 h-9 bg-white/10 rounded-lg flex items-center justify-center mb-2 shadow text-slate-300 font-bold text-sm">
                        0
                    </div>
                    <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wide poppins text-center">Skill Match</span>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-12 h-9 bg-rose-500/20 border border-rose-550/30 rounded-lg flex items-center justify-center mb-2 shadow text-rose-300 font-bold text-sm">
                        -10
                    </div>
                    <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wide poppins text-center">No Counter</span>
                </div>
                <div class="flex flex-col items-center col-span-2 sm:col-span-1">
                    <div class="w-12 h-9 bg-rose-600 rounded-lg flex items-center justify-center mb-2 shadow text-white font-bold text-sm mx-auto">
                        -20
                    </div>
                    <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wide poppins text-center">Not Recommended</span>
                </div>
            </div>
        </div>
    </section>

    <script>
        const counterMatrix = @json($counters);
        const heroImages = @json($hero_images);
        const heroRoles = @json($hero_roles);
        const heroMeta = @json($heroes);

        let selectedHero = null;
        let activeRoleFilter = null;

        const roleBodies = {
            Tank: document.getElementById('tankBody'),
            Damage: document.getElementById('damageBody'),
            Support: document.getElementById('supportBody'),
        };

        function getScoreClass(value) {
            if (value >= 20) return 'bg-emerald-600 text-white border border-emerald-500/20';
            if (value >= 10) return 'bg-emerald-500 text-white border border-emerald-400/20';
            if (value > 0) return 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/20';
            if (value === 0) return 'bg-white/10 text-slate-300';
            if (value >= -10) return 'bg-rose-500/20 text-rose-300 border border-rose-500/20';
            return 'bg-rose-600 text-white border border-rose-500/20';
        }

        function getRoleIcon(role) {
            const icons = {
                Tank: '\\images\\assets\\tank.webp',
                Damage: '\\images\\assets\\damage.webp',
                Support: '\\images\\assets\\support.webp'
            };
            return icons[role] || '';
        }

        function showEmptyState() {
            document.getElementById('emptyState').style.display = '';
            document.getElementById('resultsContainer').style.display = 'none';
            document.getElementById('heroInfo').textContent = '';
        }

        function applyMobileFilter() {
            if (window.innerWidth >= 1024) {
                ['tankSection', 'damageSection', 'supportSection'].forEach(function(id) {
                    document.getElementById(id).classList.remove('hidden');
                });
                return;
            }
            const map = {
                Tank: 'tankSection',
                Damage: 'damageSection',
                Support: 'supportSection'
            };
            Object.entries(map).forEach(function([role, id]) {
                const el = document.getElementById(id);
                (!activeRoleFilter || activeRoleFilter === role) ?
                el.classList.remove('hidden'): el.classList.add('hidden');
            });
        }

        function renderTable() {
            if (!selectedHero) {
                showEmptyState();
                return;
            }

            ['Tank', 'Damage', 'Support'].forEach(function(role) {
                const entries = heroMeta
                    .filter(h => h.name !== selectedHero && (heroRoles[h.name] ?? 'Unknown') === role)
                    .map(h => ({
                        name: h.name,
                        image: heroImages[h.name] ?? 'images/assets/blank-hero.webp',
                        score: (counterMatrix[h.name] && counterMatrix[h.name][selectedHero] !==
                            undefined) ?
                            counterMatrix[h.name][selectedHero] :
                            0
                    }))
                    .sort((a, b) => b.score - a.score || a.name.localeCompare(b.name));

                const tbody = roleBodies[role];
                tbody.innerHTML = '';
                entries.forEach(function(entry, index) {
                    const tr = document.createElement('tr');
                    tr.className = 'hover:bg-white/5 transition-all duration-150 odd:bg-white/[0.02]';
                    const scoreClass = getScoreClass(entry.score);
                    
                    tr.innerHTML =
                        '<td class="p-3">' +
                        '<div class="flex items-center gap-3">' +
                        '<img src="' + entry.image + '" alt="' + entry.name +
                        '" class="w-10 h-10 rounded-xl shadow border border-white/5">' +
                        '<div class="flex flex-col">' +
                        '<span class="text-sm font-semibold text-slate-200 poppins">' + entry.name + '</span>' +
                        '</div>' +
                        '</div>' +
                        '</td>' +
                        '<td class="p-3 text-center align-middle">' +
                        '<div class="w-12 h-9 flex items-center justify-center rounded-lg font-bold text-sm shadow ' +
                        scoreClass + '">' + (entry.score > 0 ? '+' : '') + entry.score + '</div>' +
                        '</td>';
                    tbody.appendChild(tr);
                });
            });

            document.getElementById('emptyState').style.display = 'none';
            document.getElementById('resultsContainer').style.display = '';

            const selectedRole = heroRoles[selectedHero] ?? '';
            document.getElementById('heroInfo').textContent =
                'Showing counters for: ' + selectedHero + ' (' + selectedRole + ')';

            applyMobileFilter();
        }

        window.selectHero = function(heroName) {
            selectedHero = heroName;
            document.querySelectorAll('.hero-selector-btn').forEach(function(btn) {
                if (btn.dataset.hero === heroName) {
                    btn.classList.add('border-amber-400', 'bg-[#294452]/90', 'shadow-md', 'shadow-amber-400/5');
                    btn.classList.remove('border-white/5', 'bg-white/5');
                } else {
                    btn.classList.remove('border-amber-400', 'bg-[#294452]/90', 'shadow-md', 'shadow-amber-400/5');
                    btn.classList.add('border-white/5', 'bg-white/5');
                }
            });
            renderTable();
        };

        window.filterByRole = function(roleName, event) {
            event.stopPropagation();
            activeRoleFilter = (activeRoleFilter === roleName) ? null : roleName;
            document.querySelectorAll('.role-filter-btn').forEach(function(btn) {
                if (btn.dataset.role === activeRoleFilter) {
                    btn.classList.add('border-amber-400/50', 'bg-[#294452]/80', 'text-amber-400');
                    btn.classList.remove('border-white/5', 'bg-white/5', 'text-slate-300');
                } else {
                    btn.classList.remove('border-amber-400/50', 'bg-[#294452]/80', 'text-amber-400');
                    btn.classList.add('border-white/5', 'bg-white/5', 'text-slate-300');
                }
            });
            applyMobileFilter();
        };

        document.getElementById('resetFilter').addEventListener('click', function() {
            activeRoleFilter = null;
            document.querySelectorAll('.role-filter-btn').forEach(function(btn) {
                btn.classList.remove('border-amber-400/50', 'bg-[#294452]/80', 'text-amber-400');
                btn.classList.add('border-white/5', 'bg-white/5', 'text-slate-300');
            });
            applyMobileFilter();
        });

        document.getElementById('heroSearch').addEventListener('input', function() {
            const query = this.value.toLowerCase().trim();
            document.querySelectorAll('.hero-selector-btn').forEach(function(btn) {
                btn.style.display = btn.getAttribute('data-hero').toLowerCase().includes(query) ? '' :
                    'none';
            });
        });

        window.addEventListener('resize', applyMobileFilter);

        // Preselect hero from ?hero= param, or random
        const heroNames = Object.keys(heroRoles);
        const urlHero = new URLSearchParams(window.location.search).get('hero');
        selectHero(urlHero && heroRoles[urlHero] ? urlHero : heroNames[Math.floor(Math.random() * heroNames.length)]);
    </script>
@endsection


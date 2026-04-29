@extends('layouts.home')
@section('content')
    <section class="mt-12 flex justify-center sm:mt-16">
        <div class="text-2xl font-black text-center max-w-4xl sm:text-4xl">
            <h1 class="font-normal text-4xl fjalla sm:text-6xl uppercase">
                Complete Overwatch Counter Chart
            </h1>
        </div>
    </section>

    <section class="mb-10 text-center sm:text-left text-sm">
        <div class="mt-6 pb-2 border-b-2 border-dashed sm:mt-8 max-w-4xl m-auto">
            <p class="sm:text-lg mb-4">
                Select your hero to see which heroes counter them, ranked from strongest to weakest counter.
                Use the role filters to narrow down results by Tank, Damage, or Support.
            </p>
            <p class="sm:text-lg mb-4">
                <strong>How the Scoring System Works:</strong> Our Overwatch counter matrix uses a
                <strong>-20 to +20 scale</strong> to rate hero matchups.

                A score of
                <strong class="bg-green-600 text-white px-1 rounded">+20</strong> (Hard Counter)
                means the hero completely dominates your selected hero — avoid this matchup.

                A score of
                <strong class="bg-green-400 text-white px-1 rounded">+10</strong> (Counter)
                indicates a favorable matchup for the opponent.

                A score of
                <strong class="bg-gray-300 text-black px-1 rounded">0</strong> (Skill Match)
                means the outcome depends on player skill.

                Scores of
                <strong class="bg-red-200 text-black px-1 rounded">-10</strong> (No Counter)
                and
                <strong class="bg-red-600 text-white px-1 rounded">-20</strong> (Not Recommended)
                indicate the opponent is weak against your selected hero.
            </p>
        </div>

        <!-- Hero Selector Strip -->
        <div class="mt-6 max-w-4xl m-auto">
            <p class="fjalla text-xl uppercase mb-2">Select Your Hero:</p>
            <div class="overflow-x-auto pb-2">
                <div class="flex gap-2 flex-nowrap">
                    @foreach ($heroes as $hero)
                        @php
                            $heroImage = $hero_images[$hero['name']] ?? 'images/assets/blank-hero.webp';
                            $role = $hero_roles[$hero['name']] ?? 'Unknown';
                        @endphp
                        <button
                            class="hero-selector-btn flex flex-col items-center p-1 rounded-lg bg-[#294452] hover:bg-[#3a5a6a] cursor-pointer min-w-[60px] transition-all"
                            data-hero="{{ $hero['name'] }}"
                            data-role="{{ $role }}"
                            onclick="selectHero('{{ $hero['name'] }}')"
                        >
                            <img src="{{ $heroImage }}" alt="{{ $hero['name'] }}" class="w-10 h-10 rounded-lg">
                            <span class="text-xs abel truncate max-w-[58px] mt-0.5 leading-tight">{{ $hero['name'] }}</span>
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Role Filters -->
        <div class="mt-4 max-w-4xl m-auto flex flex-wrap items-center gap-3">
            <button onclick="filterByRole('Tank', event)"
                class="role-filter-btn flex items-center gap-1 px-3 py-2 rounded-lg bg-[#294452] hover:bg-gray-600 cursor-pointer"
                data-role="Tank">
                <img src="\images\assets\tank.webp" alt="Tank Icon" class="w-5 h-5">
                <span class="fjalla text-sm uppercase">Tank</span>
            </button>
            <button onclick="filterByRole('Damage', event)"
                class="role-filter-btn flex items-center gap-1 px-3 py-2 rounded-lg bg-[#294452] hover:bg-gray-600 cursor-pointer"
                data-role="Damage">
                <img src="\images\assets\damage.webp" alt="Damage Icon" class="w-5 h-5">
                <span class="fjalla text-sm uppercase">Damage</span>
            </button>
            <button onclick="filterByRole('Support', event)"
                class="role-filter-btn flex items-center gap-1 px-3 py-2 rounded-lg bg-[#294452] hover:bg-gray-600 cursor-pointer"
                data-role="Support">
                <img src="\images\assets\support.webp" alt="Support Icon" class="w-5 h-5">
                <span class="fjalla text-sm uppercase">Support</span>
            </button>
            <button id="resetFilter"
                class="px-3 py-2 bg-[#294452] text-white rounded-lg hover:bg-gray-600 fjalla text-sm uppercase">
                Reset
            </button>
        </div>

        <!-- Hero info line -->
        <div id="heroInfo" class="mt-3 max-w-4xl m-auto text-sm text-slate-400"></div>

        <!-- Empty state -->
        <div id="emptyState" class="mt-16 mb-16 text-center text-slate-400 text-lg fjalla">
            Select a hero above to see their counters.
        </div>

        <!-- Results Table -->
        <div class="mt-6 text-center overflow-x-auto" id="tableWrapper" style="display:none">
            <table class="mx-auto" id="countersTable">
                <thead>
                    <tr class="fjalla text-base">
                        <th class="p-2 w-32 text-left">Hero</th>
                        <th class="p-2 w-20 text-center">Score</th>
                    </tr>
                </thead>
                <tbody id="tableBody"></tbody>
            </table>
        </div>

        <!-- Counters Legend -->
        <div class="mt-8 p-4 bg-[#294452] rounded-lg max-w-2xl m-auto">
            <div class="grid grid-cols-1 sm:grid-cols-5 gap-2">
                <div class="flex flex-col items-center">
                    <div class="w-8 h-8 bg-green-600 rounded flex items-center justify-center mb-1">
                        <span class="font-bold text-white text-xs">20</span>
                    </div>
                    <span class="text-xs text-center">Hard Counter</span>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-8 h-8 bg-green-400 rounded flex items-center justify-center mb-1">
                        <span class="font-bold text-white text-xs">10</span>
                    </div>
                    <span class="text-xs text-center">Counter</span>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-8 h-8 bg-gray-300 rounded flex items-center justify-center mb-1">
                        <span class="font-bold text-white text-xs">0</span>
                    </div>
                    <span class="text-xs text-center">Skill Match</span>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-8 h-8 bg-red-200 rounded flex items-center justify-center mb-1">
                        <span class="font-bold text-white text-xs">-10</span>
                    </div>
                    <span class="text-xs text-center">No Counter</span>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-8 h-8 bg-red-600 rounded flex items-center justify-center mb-1">
                        <span class="font-bold text-white text-xs">-20</span>
                    </div>
                    <span class="text-xs text-center">Not Recommended</span>
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

        function getScoreClass(value) {
            if (value >= 20) return 'bg-green-600';
            if (value >= 10) return 'bg-green-400';
            if (value > 0)  return 'bg-green-200';
            if (value === 0) return 'bg-gray-300';
            if (value >= -10) return 'bg-red-200';
            return 'bg-red-600';
        }

        function getRoleIcon(role) {
            const icons = { Tank: '\\images\\assets\\tank.webp', Damage: '\\images\\assets\\damage.webp', Support: '\\images\\assets\\support.webp' };
            return icons[role] || '';
        }

        function showEmptyState() {
            document.getElementById('emptyState').style.display = '';
            document.getElementById('tableWrapper').style.display = 'none';
            document.getElementById('heroInfo').textContent = '';
        }

        function renderTable() {
            if (!selectedHero) { showEmptyState(); return; }

            const entries = heroMeta
                .filter(h => h.name !== selectedHero)
                .map(h => ({
                    name: h.name,
                    role: heroRoles[h.name] ?? 'Unknown',
                    image: heroImages[h.name] ?? 'images/assets/blank-hero.webp',
                    score: (counterMatrix[h.name] && counterMatrix[h.name][selectedHero] !== undefined)
                        ? counterMatrix[h.name][selectedHero]
                        : 0
                }))
                .sort((a, b) => b.score - a.score || a.name.localeCompare(b.name));

            const filtered = activeRoleFilter ? entries.filter(e => e.role === activeRoleFilter) : entries;

            const tbody = document.getElementById('tableBody');
            tbody.innerHTML = '';

            filtered.forEach((entry, index) => {
                const tr = document.createElement('tr');
                tr.className = 'hero-row';
                tr.dataset.role = entry.role;
                if (index % 2 === 1) tr.style.backgroundColor = '#294452';

                const roleIcon = getRoleIcon(entry.role);
                const scoreClass = getScoreClass(entry.score);

                tr.innerHTML = `
                    <td class="p-2 w-32">
                        <div class="flex flex-col items-center">
                            <img src="${entry.image}" alt="${entry.name} profile" class="w-10 h-10 rounded-lg">
                            <h4 class="text-xs abel font-medium truncate max-w-[80px]">${entry.name}</h4>
                            <div class="text-xs mt-1">
                                ${roleIcon ? `<img src="${roleIcon}" alt="${entry.role}" class="w-6 h-6 inline cursor-pointer" onclick="filterByRole('${entry.role}', event)">` : ''}
                            </div>
                        </div>
                    </td>
                    <td class="p-2 text-center w-20">
                        <div class="w-12 h-10 flex items-center justify-center rounded mx-auto ${scoreClass}">
                            <span class="font-bold text-white">${entry.score}</span>
                        </div>
                    </td>
                `;
                tbody.appendChild(tr);
            });

            document.getElementById('emptyState').style.display = 'none';
            document.getElementById('tableWrapper').style.display = '';

            const selectedRole = heroRoles[selectedHero] ?? '';
            document.getElementById('heroInfo').textContent =
                `Showing heroes that counter: ${selectedHero} (${selectedRole})`;
        }

        window.selectHero = function(heroName) {
            selectedHero = heroName;
            document.querySelectorAll('.hero-selector-btn').forEach(btn => {
                if (btn.dataset.hero === heroName) {
                    btn.classList.add('ring-2', 'ring-white');
                } else {
                    btn.classList.remove('ring-2', 'ring-white');
                }
            });
            renderTable();
        };

        window.filterByRole = function(roleName, event) {
            event.stopPropagation();
            activeRoleFilter = (activeRoleFilter === roleName) ? null : roleName;
            document.querySelectorAll('.role-filter-btn').forEach(btn => {
                if (btn.dataset.role === activeRoleFilter) {
                    btn.classList.add('ring-2', 'ring-white');
                } else {
                    btn.classList.remove('ring-2', 'ring-white');
                }
            });
            renderTable();
        };

        document.getElementById('resetFilter').addEventListener('click', function() {
            activeRoleFilter = null;
            document.querySelectorAll('.role-filter-btn').forEach(btn => {
                btn.classList.remove('ring-2', 'ring-white');
            });
            renderTable();
        });

        showEmptyState();
    </script>
@endsection

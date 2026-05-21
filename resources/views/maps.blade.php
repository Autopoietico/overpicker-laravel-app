@extends('layouts.home')
@section('content')
    <section class="mt-12 flex justify-center sm:mt-16">
        <div class="text-2xl font-black text-center max-w-4xl sm:text-4xl">
            <h1 class="fjalla uppercase text-4xl sm:text-5xl tracking-wide leading-tight">
                Hero Performance by Map
            </h1>
        </div>
    </section>

    <section class="mb-16 text-center sm:text-left text-sm max-w-4xl m-auto px-4 mt-6">
        <div class="glass-panel p-6 rounded-3xl border border-white/10 shadow-lg text-slate-350 poppins leading-relaxed">
            <p class="sm:text-lg mb-4 text-slate-200">
                Understand how every hero fares across the pool. Select a map below to view dynamic performance rankings based on competitive data.
            </p>
            <div class="pt-4 border-t border-white/5">
                <p class="font-semibold text-slate-250 mb-2">Scoring & Points:</p>
                <p class="text-slate-400">
                    Calculated on a scale from <strong class="text-emerald-450 font-bold">-20 to +20</strong>. Assault and Hybrid map pools evaluate Attack (ATK) and Defense (DEF) independently for their initial stages. Other modes assess the points directly.
                </p>
            </div>
        </div>

        <!-- Controls Bar -->
        <div class="mt-8 glass-panel p-6 rounded-3xl border border-white/10 shadow-lg flex flex-col md:flex-row md:items-center justify-between gap-6 max-w-4xl m-auto">
            <!-- Map Selector -->
            <div class="flex items-center gap-4">
                <label for="mapSelect" class="fjalla text-xl uppercase tracking-wider text-slate-250">Map:</label>
                <div class="relative">
                    <select id="mapSelect"
                        class="appearance-none bg-[#294452]/40 text-white pl-4 pr-10 py-2.5 rounded-xl border border-white/10 focus:outline-none focus:border-amber-400/50 transition-all font-semibold poppins text-sm uppercase cursor-pointer hover:bg-[#294452]/60">
                        @foreach ($map_list as $type => $maps)
                            <optgroup label="{{ $type }}" class="bg-[#1C2E37] text-white">
                                @foreach ($maps as $mapName)
                                    <option value="{{ $mapName }}">{{ $mapName }}</option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                    <span class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-slate-400">
                        <i class="bi bi-chevron-down"></i>
                    </span>
                </div>
            </div>

            <!-- Role Filters -->
            <div class="flex flex-wrap items-center gap-3">
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
        </div>

        <!-- Map info line -->
        <div id="mapInfo" class="mt-6 text-sm text-amber-450 font-bold poppins uppercase tracking-wider text-center sm:text-left"></div>

        <!-- Maps Table Container -->
        <div class="mt-4 glass-panel p-6 rounded-3xl border border-white/10 shadow-lg max-w-4xl m-auto overflow-hidden">
            <div class="overflow-x-auto custom-scrollbar">
                <table class="w-full text-left border-collapse" id="mapsTable">
                    <thead>
                        <tr class="text-slate-300 fjalla text-sm uppercase tracking-wider border-b border-white/5" id="tableHeaderRow">
                            <th class="p-3 w-40 text-left">Hero</th>
                            <th class="p-3 w-24 text-center">Overall</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody" class="divide-y divide-white/5">
                        @foreach ($heroes_ordered as $hero)
                            @php
                                $heroName  = $hero['name'];
                                $role      = $hero['role'];
                                $heroImage = $hero_images[$heroName] ?? 'images/assets/blank-hero.webp';
                            @endphp
                            <tr class="hero-row hover:bg-white/5 transition-all duration-150" data-hero="{{ $heroName }}" data-role="{{ $role }}">
                                <td class="p-3 w-40">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ $heroImage }}" alt="{{ $heroName }} profile"
                                            class="w-10 h-10 rounded-xl shadow border border-white/5">
                                        <div class="flex flex-col">
                                            <span class="text-sm font-semibold text-slate-200 poppins">{{ $heroName }}</span>
                                            <span class="text-[10px] font-medium text-slate-400 uppercase poppins tracking-wider flex items-center gap-1 mt-0.5">
                                                @if ($role == 'Tank')
                                                    <img src="\images\assets\tank.webp" alt="Tank" class="w-3 h-3">
                                                @elseif ($role == 'Damage')
                                                    <img src="\images\assets\damage.webp" alt="Damage" class="w-3 h-3">
                                                @elseif ($role == 'Support')
                                                    <img src="\images\assets\support.webp" alt="Support" class="w-3 h-3">
                                                @endif
                                                {{ $role }}
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-3 text-center w-24 align-middle" data-col="overall">
                                    <div class="w-12 h-9 flex items-center justify-center rounded-lg font-bold text-sm bg-white/10 text-slate-300 mx-auto">
                                        –
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Legend Overview -->
        <div class="mt-12 p-6 glass-panel rounded-3xl border border-white/10 shadow-lg">
            <h4 class="fjalla uppercase text-sm tracking-wider text-slate-300 text-center mb-4">Legend Overview</h4>
            <div class="grid grid-cols-2 sm:grid-cols-5 gap-4">
                <div class="flex flex-col items-center">
                    <div class="w-12 h-9 bg-emerald-600 rounded-lg flex items-center justify-center mb-2 shadow text-white font-bold text-sm">
                        +20
                    </div>
                    <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wide poppins text-center">Excellent</span>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-12 h-9 bg-emerald-500 rounded-lg flex items-center justify-center mb-2 shadow text-white font-bold text-sm">
                        +10
                    </div>
                    <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wide poppins text-center">Good</span>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-12 h-9 bg-white/10 rounded-lg flex items-center justify-center mb-2 shadow text-slate-300 font-bold text-sm">
                        0
                    </div>
                    <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wide poppins text-center">Neutral</span>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-12 h-9 bg-rose-500/20 border border-rose-550/30 rounded-lg flex items-center justify-center mb-2 shadow text-rose-300 font-bold text-sm">
                        -10
                    </div>
                    <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wide poppins text-center">Poor</span>
                </div>
                <div class="flex flex-col items-center col-span-2 sm:col-span-1">
                    <div class="w-12 h-9 bg-rose-600 rounded-lg flex items-center justify-center mb-2 shadow text-white font-bold text-sm mx-auto">
                        -20
                    </div>
                    <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wide poppins text-center">Avoid</span>
                </div>
            </div>
        </div>
    </section>

    <script>
        const mapData  = @json($processed_data);
        const heroRoles = @json($hero_roles);
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let activeRoleFilter = null;

            const mapSelect  = document.getElementById('mapSelect');
            const resetBtn   = document.getElementById('resetFilter');
            const headerRow  = document.getElementById('tableHeaderRow');
            const tbody      = document.getElementById('tableBody');

            function getScoreClass(value) {
                if (value >= 20)  return 'bg-emerald-600 text-white border border-emerald-500/20';
                if (value >= 10)  return 'bg-emerald-500 text-white border border-emerald-400/20';
                if (value > 0)    return 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/20';
                if (value === 0)  return 'bg-white/10 text-slate-350';
                if (value >= -10) return 'bg-rose-500/20 text-rose-300 border border-rose-500/20';
                return 'bg-rose-600 text-white border border-rose-500/20';
            }

            function applyAlternatingRowColors() {
                const visibleRows = Array.from(tbody.querySelectorAll('tr.hero-row')).filter(
                    row => row.style.display !== 'none'
                );
                visibleRows.forEach(function (row, index) {
                    row.style.backgroundColor = index % 2 === 1 ? 'rgba(255, 255, 255, 0.02)' : '';
                });
            }

            function applyRoleFilter() {
                Array.from(tbody.querySelectorAll('tr.hero-row')).forEach(function (row) {
                    row.style.display = (!activeRoleFilter || row.getAttribute('data-role') === activeRoleFilter)
                        ? ''
                        : 'none';
                });
                applyAlternatingRowColors();
            }

            function sortByOverall(heroesData, columns) {
                function getTotalPoints(heroData) {
                    if (!heroData || !columns) return 0;
                    let total = 0;
                    columns.forEach(function (col) {
                        const pt = heroData.points[col.pointName];
                        if (!pt) return;
                        if (col.dual) {
                            total += (pt.attack || 0) + (pt.defense || 0);
                        } else {
                            total += (pt.score || 0);
                        }
                    });
                    return total;
                }

                const rows = Array.from(tbody.querySelectorAll('tr.hero-row'));
                rows.sort(function (a, b) {
                    const nameA  = a.getAttribute('data-hero');
                    const nameB  = b.getAttribute('data-hero');
                    const dataA  = heroesData[nameA];
                    const dataB  = heroesData[nameB];
                    const scoreA = dataA ? dataA.overall : 0;
                    const scoreB = dataB ? dataB.overall : 0;
                    if (scoreB !== scoreA) return scoreB - scoreA;
                    return getTotalPoints(dataB) - getTotalPoints(dataA);
                });
                rows.forEach(function (row) { tbody.appendChild(row); });
            }

            function loadMap(mapName) {
                const data = mapData[mapName];
                if (!data) return;

                // Rebuild dynamic <th> columns (keep first two: Hero + Overall)
                while (headerRow.children.length > 2) {
                    headerRow.removeChild(headerRow.lastChild);
                }

                data.columns.forEach(function (col) {
                    const isDual = col.dual;
                    if (isDual) {
                        const th = document.createElement('th');
                        th.className = 'p-3 text-center border-l border-white/5';
                        th.colSpan  = 2;
                        th.innerHTML = '<div class="fjalla uppercase text-xs tracking-wider text-slate-350">' + col.pointName + '</div>' +
                                       '<div class="flex justify-around text-[10px] font-semibold text-slate-400 mt-1 min-w-[90px] poppins">' +
                                       '<span>ATK</span><span>DEF</span></div>';
                        headerRow.appendChild(th);
                    } else {
                        const th = document.createElement('th');
                        th.className = 'p-3 text-center fjalla uppercase text-xs tracking-wider text-slate-350 border-l border-white/5 align-middle';
                        th.textContent = col.pointName;
                        headerRow.appendChild(th);
                    }
                });

                // Update each hero row
                Array.from(tbody.querySelectorAll('tr.hero-row')).forEach(function (row) {
                    const heroName = row.getAttribute('data-hero');
                    const heroData = data.heroes[heroName];

                    // Update overall cell
                    const overallTd  = row.querySelector('[data-col="overall"]');
                    const overall    = heroData ? heroData.overall : 0;
                    const cls        = getScoreClass(overall);
                    overallTd.innerHTML = '<div class="w-12 h-9 flex items-center justify-center rounded-lg font-bold text-sm shadow mx-auto ' +
                                          cls + '">' + (overall > 0 ? '+' : '') + overall + '</div>';

                    // Remove old per-point cells (beyond index 1)
                    while (row.cells.length > 2) {
                        row.deleteCell(2);
                    }

                    // Add per-point cells
                    data.columns.forEach(function (col) {
                        const pointData = heroData ? heroData.points[col.pointName] : null;
                        const isDual    = col.dual;

                        if (isDual) {
                            const atk = pointData ? pointData.attack  : 0;
                            const def = pointData ? pointData.defense : 0;

                            const tdAtk = document.createElement('td');
                            tdAtk.className = 'py-2 pl-3 pr-1 text-center border-l border-white/5 align-middle';
                            const cAtk = getScoreClass(atk);
                            tdAtk.innerHTML = '<div class="w-11 h-9 flex items-center justify-center rounded-lg font-bold text-sm shadow mx-auto ' +
                                              cAtk + '">' + (atk > 0 ? '+' : '') + atk + '</div>';
                            row.appendChild(tdAtk);

                            const tdDef = document.createElement('td');
                            tdDef.className = 'py-2 pl-1 pr-3 text-center align-middle';
                            const cDef = getScoreClass(def);
                            tdDef.innerHTML = '<div class="w-11 h-9 flex items-center justify-center rounded-lg font-bold text-sm shadow mx-auto ' +
                                              cDef + '">' + (def > 0 ? '+' : '') + def + '</div>';
                            row.appendChild(tdDef);
                        } else {
                            const val = pointData ? pointData.score : 0;
                            const td  = document.createElement('td');
                            td.className = 'py-2 px-3 text-center border-l border-white/5 align-middle';
                            const c = getScoreClass(val);
                            td.innerHTML = '<div class="w-11 h-9 flex items-center justify-center rounded-lg font-bold text-sm shadow mx-auto ' +
                                           c + '">' + (val > 0 ? '+' : '') + val + '</div>';
                            row.appendChild(td);
                        }
                    });
                });

                sortByOverall(data.heroes, data.columns);

                // Update map info line
                const pointDescriptions = data.columns.map(function (col) {
                    return col.dual ? col.pointName + ' (Atk/Def)' : col.pointName;
                }).join(' · ');
                document.getElementById('mapInfo').textContent =
                    mapName + ' — ' + data.type + ' | Points: ' + pointDescriptions;

                applyRoleFilter();
            }

            window.filterByRole = function (roleName, event) {
                event.stopPropagation();
                activeRoleFilter = (activeRoleFilter === roleName) ? null : roleName;

                // Update button active states
                document.querySelectorAll('.role-filter-btn').forEach(function (btn) {
                    if (btn.getAttribute('data-role') === activeRoleFilter) {
                        btn.classList.add('border-amber-400/50', 'bg-[#294452]/80', 'text-amber-400');
                        btn.classList.remove('border-white/5', 'bg-white/5', 'text-slate-300');
                    } else {
                        btn.classList.remove('border-amber-400/50', 'bg-[#294452]/80', 'text-amber-400');
                        btn.classList.add('border-white/5', 'bg-white/5', 'text-slate-300');
                    }
                });

                applyRoleFilter();
            };

            mapSelect.addEventListener('change', function () {
                loadMap(this.value);
            });

            resetBtn.addEventListener('click', function () {
                activeRoleFilter = null;
                document.querySelectorAll('.role-filter-btn').forEach(function (btn) {
                    btn.classList.remove('border-amber-400/50', 'bg-[#294452]/80', 'text-amber-400');
                    btn.classList.add('border-white/5', 'bg-white/5', 'text-slate-300');
                });
                applyRoleFilter();
            });

            // Load map from ?map= param, or first in list
            const urlMap = new URLSearchParams(window.location.search).get('map');
            if (urlMap && mapSelect.querySelector('option[value="' + urlMap + '"]')) {
                mapSelect.value = urlMap;
            }
            loadMap(mapSelect.value);
        });
    </script>
@endsection


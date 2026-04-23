@extends('layouts.home')
@section('content')
    <section class="mt-12 flex justify-center sm:mt-16">
        <div class="text-2xl font-black text-center max-w-4xl sm:text-4xl">
            <h1 class="font-normal text-4xl fjalla sm:text-6xl uppercase">
                Overwatch Hero Performance by Map
            </h1>
        </div>
    </section>

    <section class="mb-10 text-center sm:text-left text-sm">
        <div class="mt-6 pb-2 border-b-2 border-dashed sm:mt-8 max-w-4xl m-auto">
            <p class="sm:text-lg mb-4">
                This page shows how each Overwatch hero performs on each competitive map. Select a map from the
                dropdown to see heroes ranked by their overall map score. Scores are broken down by objective point
                so you can see where each hero is strongest.
            </p>
            <p class="sm:text-lg mb-4">
                <strong>How the Scoring System Works:</strong> Scores use a
                <strong>-20 to +20 scale</strong>.

                A score of
                <strong class="bg-green-600 text-white px-1 rounded">+20</strong> (Excellent)
                means the hero excels on this point.

                A score of
                <strong class="bg-green-400 text-white px-1 rounded">+10</strong> (Good)
                indicates a favorable performance.

                A score of
                <strong class="bg-gray-300 text-black px-1 rounded">0</strong> (Neutral)
                means average performance.

                Scores of
                <strong class="bg-red-200 text-black px-1 rounded">-10</strong> (Poor)
                and
                <strong class="bg-red-600 text-white px-1 rounded">-20</strong> (Avoid)
                indicate the hero struggles on this point.
            </p>
            <p class="sm:text-lg mb-4">
                For <strong>Assault</strong> and <strong>Hybrid</strong> maps, the first objective shows both
                <strong>ATK</strong> (attacking side) and <strong>DEF</strong> (defending side) scores separately.
                Other game modes show a single performance score per point.
            </p>
        </div>

        <!-- Map Selector and Role Filters -->
        <div class="mt-6 max-w-4xl m-auto flex flex-wrap items-center gap-4">
            <div class="flex items-center gap-3">
                <label for="mapSelect" class="fjalla text-xl uppercase">Map:</label>
                <select id="mapSelect"
                    class="bg-[#294452] text-white px-3 py-2 rounded-lg fjalla text-lg uppercase cursor-pointer hover:bg-[#1C2E37] border border-white/20">
                    @foreach ($map_list as $type => $maps)
                        <optgroup label="{{ $type }}">
                            @foreach ($maps as $mapName)
                                <option value="{{ $mapName }}">{{ $mapName }}</option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center gap-3">
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
        </div>

        <!-- Map info line -->
        <div id="mapInfo" class="mt-3 max-w-4xl m-auto text-sm text-slate-400"></div>

        <!-- Maps Table -->
        <div class="mt-6 text-center overflow-x-auto">
            <table class="mx-auto" id="mapsTable">
                <thead>
                    <tr class="fjalla text-base" id="tableHeaderRow">
                        <th class="p-2 w-32 text-left">Hero</th>
                        <th class="p-2 w-20 text-center">Overall</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    @foreach ($heroes_ordered as $hero)
                        @php
                            $heroName  = $hero['name'];
                            $role      = $hero['role'];
                            $heroImage = $hero_images[$heroName] ?? 'images/assets/blank-hero.webp';
                        @endphp
                        <tr class="hero-row" data-hero="{{ $heroName }}" data-role="{{ $role }}">
                            <td class="p-2 w-32">
                                <div class="flex flex-col items-center">
                                    <img src="{{ $heroImage }}" alt="{{ $heroName }} profile"
                                        class="w-10 h-10 rounded-lg">
                                    <h4 class="text-xs abel font-medium truncate max-w-[80px]">{{ $heroName }}</h4>
                                    <div class="text-xs mt-1">
                                        @if ($role == 'Tank')
                                            <img src="\images\assets\tank.webp" alt="Tank Icon" class="w-6 h-6 inline cursor-pointer"
                                                onclick="filterByRole('Tank', event)">
                                        @elseif ($role == 'Damage')
                                            <img src="\images\assets\damage.webp" alt="Damage Icon" class="w-6 h-6 inline cursor-pointer"
                                                onclick="filterByRole('Damage', event)">
                                        @elseif ($role == 'Support')
                                            <img src="\images\assets\support.webp" alt="Support Icon" class="w-6 h-6 inline cursor-pointer"
                                                onclick="filterByRole('Support', event)">
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="p-2 text-center w-20" data-col="overall">
                                <div class="w-12 h-10 flex items-center justify-center rounded mx-auto bg-gray-300">
                                    <span class="font-bold text-white">–</span>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Legend -->
        <div class="mt-8 p-4 bg-[#294452] rounded-lg max-w-2xl m-auto">
            <div class="grid grid-cols-1 sm:grid-cols-5 gap-2">
                <div class="flex flex-col items-center">
                    <div class="w-8 h-8 bg-green-600 rounded flex items-center justify-center mb-1">
                        <span class="font-bold text-white text-xs">+20</span>
                    </div>
                    <span class="text-xs text-center">Excellent</span>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-8 h-8 bg-green-400 rounded flex items-center justify-center mb-1">
                        <span class="font-bold text-white text-xs">+10</span>
                    </div>
                    <span class="text-xs text-center">Good</span>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-8 h-8 bg-gray-300 rounded flex items-center justify-center mb-1">
                        <span class="font-bold text-black text-xs">0</span>
                    </div>
                    <span class="text-xs text-center">Neutral</span>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-8 h-8 bg-red-200 rounded flex items-center justify-center mb-1">
                        <span class="font-bold text-black text-xs">-10</span>
                    </div>
                    <span class="text-xs text-center">Poor</span>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-8 h-8 bg-red-600 rounded flex items-center justify-center mb-1">
                        <span class="font-bold text-white text-xs">-20</span>
                    </div>
                    <span class="text-xs text-center">Avoid</span>
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
                if (value >= 20)  return 'bg-green-600 text-white';
                if (value >= 10)  return 'bg-green-400 text-white';
                if (value > 0)    return 'bg-green-200 text-black';
                if (value === 0)  return 'bg-gray-300 text-black';
                if (value >= -10) return 'bg-red-200 text-black';
                return 'bg-red-600 text-white';
            }

            function applyAlternatingRowColors() {
                const visibleRows = Array.from(tbody.querySelectorAll('tr.hero-row')).filter(
                    row => row.style.display !== 'none'
                );
                visibleRows.forEach(function (row, index) {
                    row.style.backgroundColor = index % 2 === 1 ? '#294452' : '';
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

            function sortByOverall(heroesData) {
                const rows = Array.from(tbody.querySelectorAll('tr.hero-row'));
                rows.sort(function (a, b) {
                    const nameA  = a.getAttribute('data-hero');
                    const nameB  = b.getAttribute('data-hero');
                    const scoreA = heroesData[nameA] ? heroesData[nameA].overall : 0;
                    const scoreB = heroesData[nameB] ? heroesData[nameB].overall : 0;
                    return scoreB - scoreA;
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
                        th.className = 'p-1 text-center';
                        th.colSpan  = 2;
                        th.innerHTML = '<div class="fjalla uppercase text-sm">' + col.pointName + '</div>' +
                                       '<div class="grid grid-cols-2 gap-1 text-xs text-slate-300 mt-0.5">' +
                                       '<span>ATK</span><span>DEF</span></div>';
                        headerRow.appendChild(th);
                    } else {
                        const th = document.createElement('th');
                        th.className = 'p-2 w-20 text-center fjalla uppercase text-sm';
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
                    overallTd.innerHTML = '<div class="w-12 h-10 flex items-center justify-center rounded mx-auto font-bold ' +
                                          cls + '">' + overall + '</div>';

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

                            [atk, def].forEach(function (val) {
                                const td = document.createElement('td');
                                td.className = 'p-1 text-center';
                                const c = getScoreClass(val);
                                td.innerHTML = '<div class="w-10 h-10 flex items-center justify-center rounded mx-auto font-bold text-sm ' +
                                               c + '">' + val + '</div>';
                                row.appendChild(td);
                            });
                        } else {
                            const val = pointData ? pointData.score : 0;
                            const td  = document.createElement('td');
                            td.className = 'p-2 text-center w-20';
                            const c = getScoreClass(val);
                            td.innerHTML = '<div class="w-10 h-10 flex items-center justify-center rounded mx-auto font-bold ' +
                                           c + '">' + val + '</div>';
                            row.appendChild(td);
                        }
                    });
                });

                sortByOverall(data.heroes);

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
                        btn.classList.add('ring-2', 'ring-white');
                    } else {
                        btn.classList.remove('ring-2', 'ring-white');
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
                    btn.classList.remove('ring-2', 'ring-white');
                });
                applyRoleFilter();
            });

            // Load first map on page load
            loadMap(mapSelect.value);
        });
    </script>
@endsection

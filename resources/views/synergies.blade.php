@extends('layouts.home')
@section('content')
    <section class="mt-12 flex justify-center sm:mt-16">
        <div class="text-2xl font-black text-center max-w-4xl sm:text-4xl">
            <h1 class="font-normal text-4xl fjalla sm:text-6xl uppercase">
                Hero Synergies
            </h1>
        </div>
    </section>

    <section class="mb-10 text-center sm:text-left text-sm">
        <div class="mt-6 pb-2 border-b-2 border-dashed sm:mt-8 max-w-4xl m-auto">
            <p class="sm:text-lg">
                This page shows the synergies between heroes in Overwatch. The matrix illustrates how well each hero works
                with others. The hero at the top represents the one already selected, while the hero on the left is the
                recommended pick.

            </p>
        </div>

        <!-- Synergies Matrix Table -->
        <div class="mt-10 text-center overflow-x-auto">
            <table class="w-full table-fixed mx-auto" id="synergiesTable">
                <thead>
                    <tr class=" fjalla text-xl">
                        <th class="p-2 bg-white bg-color-text w-32">Hero</th>
                        @foreach ($heroes as $hero)
                            @php
                                $heroImage = $hero_images[$hero['name']] ?? 'images/assets/blank-hero.webp';
                                $role = $hero_roles[$hero['name']] ?? 'Unknown';
                            @endphp
                            <th class="p-2 text-xs sm:text-sm w-24" data-hero="{{ $hero['name'] }}"
                                data-role="{{ $role }}" onclick="filterByHero('{{ $hero['name'] }}')">
                                <div class="flex flex-col items-center cursor-pointer hover:bg-gray-500 rounded p-1">
                                    <img src="{{ $heroImage }}" alt="{{ $hero['name'] }} profile"
                                        class="w-8 h-8 rounded-lg">
                                    <span class="mt-1">{{ $hero['name'] }}</span>
                                    <div class="text-xs mt-1">
                                        @if ($role == 'Tank')
                                            <img src="\images\assets\tank.webp" alt="Tank Icon" class="w-4 h-4 inline"
                                                onclick="filterByRole('Tank', event)">
                                        @elseif($role == 'Damage')
                                            <img src="\images\assets\damage.webp" alt="Damage Icon" class="w-4 h-4 inline"
                                                onclick="filterByRole('Damage', event)">
                                        @elseif($role == 'Support')
                                            <img src="\images\assets\support.webp" alt="Support Icon" class="w-4 h-4 inline"
                                                onclick="filterByRole('Support', event)">
                                        @endif
                                    </div>
                                </div>
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($synergies as $heroName => $synergyData)
                        @php
                            $role = $hero_roles[$heroName] ?? 'Unknown';
                            $heroImage = $hero_images[$heroName] ?? 'images/assets/blank-hero.webp';
                        @endphp
                        <tr class="hero-row" data-hero="{{ $heroName }}" data-role="{{ $role }}">
                            <td class="p-2 w-32" data-hero="{{ $heroName }}" data-role="{{ $role }}"
                                onclick="filterByRowHero('{{ $heroName }}')">
                                <div class="flex flex-col items-center cursor-pointer hover:bg-gray-500 rounded p-1">
                                    <img src="{{ $heroImage }}" alt="{{ $heroName }} profile"
                                        class="w-10 h-10 rounded-lg">
                                    <h4 class="text-xs abel font-medium truncate max-w-[80px]">
                                        {{ $heroName }}
                                    </h4>
                                    <div class="text-xs mt-1">
                                        @if ($role == 'Tank')
                                            <img src="\images\assets\tank.webp" alt="Tank Icon" class="w-6 h-6 inline"
                                                onclick="filterByRole('Tank', event)">
                                        @elseif($role == 'Damage')
                                            <img src="\images\assets\damage.webp" alt="Damage Icon" class="w-6 h-6 inline"
                                                onclick="filterByRole('Damage', event)">
                                        @elseif($role == 'Support')
                                            <img src="\images\assets\support.webp" alt="Support Icon" class="w-6 h-6 inline"
                                                onclick="filterByRole('Support', event)">
                                        @endif
                                    </div>
                                </div>
                            </td>
                            @foreach ($heroes as $columnHero)
                                @php
                                    $value = $synergyData[$columnHero['name']] ?? 0;
                                    $bgColor = '';
                                    if ($value >= 20) {
                                        $bgColor = 'bg-green-600';
                                    } elseif ($value >= 10) {
                                        $bgColor = 'bg-green-400';
                                    } elseif ($value > 0) {
                                        $bgColor = 'bg-green-200';
                                    } elseif ($value == 0) {
                                        $bgColor = 'bg-gray-300';
                                    } elseif ($value >= -10) {
                                        $bgColor = 'bg-red-200';
                                    } elseif ($value >= -20) {
                                        $bgColor = 'bg-red-400';
                                    } else {
                                        $bgColor = 'bg-red-600';
                                    }
                                @endphp
                                <td class="p-2 text-center w-24">
                                    <div
                                        class="w-10 h-10 flex items-center justify-center rounded mx-auto {{ $bgColor }}">
                                        <span class="font-bold text-white">{{ $value }}</span>
                                    </div>
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Synergies Legend -->
        <div class="mt-8 p-4 bg-[#294452] rounded-lg max-w-2xl m-auto">
            <div class="grid grid-cols-1 sm:grid-cols-5 gap-2">
                <div class="flex flex-col items-center">
                    <div class="w-8 h-8 bg-green-600 rounded flex items-center justify-center mb-1">
                        <span class="font-bold text-white text-xs">20</span>
                    </div>
                    <span class="text-xs text-center">Must Pick</span>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-8 h-8 bg-green-400 rounded flex items-center justify-center mb-1">
                        <span class="font-bold text-white text-xs">10</span>
                    </div>
                    <span class="text-xs text-center">Good Synergy</span>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-8 h-8 bg-gray-300 rounded flex items-center justify-center mb-1">
                        <span class="font-bold text-white text-xs">0</span>
                    </div>
                    <span class="text-xs text-center">Decent</span>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-8 h-8 bg-red-200 rounded flex items-center justify-center mb-1">
                        <span class="font-bold text-white text-xs">-10</span>
                    </div>
                    <span class="text-xs text-center">No Synergy</span>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-8 h-8 bg-red-600 rounded flex items-center justify-center mb-1">
                        <span class="font-bold text-white text-xs">-20</span>
                    </div>
                    <span class="text-xs text-center">Antisynergy</span>
                </div>
            </div>
        </div>

        <div class="mt-4 text-center">
            <button id="resetFilter" class="px-4 py-2 bg-[#29452] text-white rounded hover:bg-gray-600">
                Reset Filters
            </button>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Current active filters
            let activeColumnHeroFilter = null; // For filtering by clicking header row heroes
            let activeRowHeroFilter = null; // For filtering by clicking first column heroes
            let activeColumnRoleFilter = null; // For filtering columns by role (clicked in header row)
            let activeRowRoleFilter = null; // For filtering rows by role (clicked in first column)

            // Elements
            const resetButton = document.getElementById('resetFilter');
            const rows = document.querySelectorAll('#synergiesTable tbody tr');
            const headerCells = document.querySelectorAll('#synergiesTable thead th:not(:first-child)');
            const firstColumnCells = document.querySelectorAll('#synergiesTable tbody td:first-child');
            const table = document.getElementById('synergiesTable');
            const tableContainer = table.parentElement;

            // Function to apply alternating row colors
            function applyAlternatingRowColors() {
                const visibleRows = Array.from(rows).filter(row => row.style.display !== 'none');
                visibleRows.forEach((row, index) => {
                    // Apply background based on position in visible rows
                    if (index % 2 === 0) {
                        // Even index in visible array (0, 2, 4...) - keep default white
                        row.style.backgroundColor = '';
                    } else {
                        // Odd index in visible array (1, 3, 5...) - apply blue
                        row.style.backgroundColor = '#294452';
                    }
                });
            }

            // Function to apply alternating column colors
            function applyAlternatingColumnColors() {
                // Reset all column backgrounds first
                headerCells.forEach(cell => {
                    cell.style.backgroundColor = '';
                });

                // Get visible header cells
                const visibleHeaderCells = Array.from(headerCells).filter(cell => cell.style.display !== 'none');

                // Apply alternating colors to visible columns
                visibleHeaderCells.forEach((cell, index) => {
                    if (index % 2 === 0) {
                        // Even index in visible array - apply default
                        cell.style.backgroundColor = '';
                    } else {
                        // Odd index in visible array - apply blue
                        cell.style.backgroundColor = '#294452';
                    }
                });
            }

            // Function to calculate and set table width based on visible columns
            function setTableWidth() {
                const visibleHeaderCells = Array.from(headerCells).filter(cell => cell.style.display !== 'none');
                const visibleCount = visibleHeaderCells.length;

                // Calculate the total width needed: first column (w-32 = 8rem = 128px) + visible columns (w-24 = 6rem = 96px each)
                // Plus some padding for the first column content
                const firstColumnWidth = 128; // w-32 = 8rem = 8*16px
                const columnWidth = 96; // w-24 = 6rem = 6*16px
                const totalWidth = firstColumnWidth + (visibleCount * columnWidth);

                // Set the table width to prevent expansion
                table.style.width = totalWidth + 'px';

                // If there are no filtered columns, reset to full width
                if (visibleCount === headerCells.length) {
                    table.style.width = '100%';
                }
            }

            // Function to filter the table
            function applyFilters() {
                // Process rows
                rows.forEach(row => {
                    const rowHero = row.getAttribute('data-hero');
                    const rowRole = row.getAttribute('data-role');

                    let showRow = true;

                    // Apply row hero filter (when clicking hero in first column)
                    if (activeRowHeroFilter && activeRowHeroFilter !== rowHero) {
                        showRow = false;
                    }

                    // Apply row role filter (when clicking role in first column)
                    if (activeRowRoleFilter && activeRowRoleFilter !== rowRole) {
                        showRow = false;
                    }

                    // Apply row visibility
                    row.style.display = showRow ? '' : 'none';

                    // If row is visible, determine which columns to show
                    if (showRow) {
                        const cells = row.querySelectorAll(
                            'td:not(:first-child)'); // Exclude first cell (hero name)

                        cells.forEach((cell, index) => {
                            const columnHero = headerCells[index].getAttribute('data-hero');
                            const columnRole = headerCells[index].getAttribute('data-role');

                            let showColumn = true;

                            // Apply column hero filter (when clicking hero in header row)
                            if (activeColumnHeroFilter && activeColumnHeroFilter !== columnHero) {
                                showColumn = false;
                            }

                            // Apply column role filter (when clicking role in header row)
                            if (activeColumnRoleFilter && activeColumnRoleFilter !== columnRole) {
                                showColumn = false;
                            }

                            cell.style.display = showColumn ? '' : 'none';
                        });
                    }
                });

                // Filter header cells (columns)
                headerCells.forEach(cell => {
                    const cellHero = cell.getAttribute('data-hero');
                    const cellRole = cell.getAttribute('data-role');

                    let showCell = true;

                    // Apply column hero filter only
                    if (activeColumnHeroFilter && activeColumnHeroFilter !== cellHero) {
                        showCell = false;
                    }

                    // Apply column role filter only
                    if (activeColumnRoleFilter && activeColumnRoleFilter !== cellRole) {
                        showCell = false;
                    }

                    cell.style.display = showCell ? '' : 'none';
                });

                // Reapply alternating colors after filtering
                applyAlternatingRowColors();
                applyAlternatingColumnColors();

                // Adjust table width based on visible columns to maintain fixed column widths
                setTableWidth();
            }

            // Function to filter by hero in header row (column filter)
            window.filterByHero = function(heroName) {
                if (activeColumnHeroFilter === heroName) {
                    activeColumnHeroFilter = null; // Toggle off if already active
                } else {
                    activeColumnHeroFilter = heroName;
                }

                applyFilters();
            };

            // Function to filter by hero in first column (row filter)
            window.filterByRowHero = function(heroName) {
                if (activeRowHeroFilter === heroName) {
                    activeRowHeroFilter = null; // Toggle off if already active
                } else {
                    activeRowHeroFilter = heroName;
                }

                applyFilters();
            };

            // Function to filter by role
            window.filterByRole = function(roleName, event) {
                event.stopPropagation(); // Prevent triggering the hero filter

                // Determine if the role was clicked in header row (column filter) or first column (row filter)
                const target = event.target;
                const thElement = target.closest('th');

                if (thElement && thElement.closest('thead')) {
                    // Role clicked in header row - affects columns
                    if (activeColumnRoleFilter === roleName) {
                        activeColumnRoleFilter = null; // Toggle off if already active
                    } else {
                        activeColumnRoleFilter = roleName;
                    }
                } else {
                    // Role clicked in first column - affects rows
                    if (activeRowRoleFilter === roleName) {
                        activeRowRoleFilter = null; // Toggle off if already active
                    } else {
                        activeRowRoleFilter = roleName;
                    }
                }

                applyFilters();
            };

            // Reset filters
            resetButton.addEventListener('click', function() {
                activeColumnHeroFilter = null;
                activeRowHeroFilter = null;
                activeColumnRoleFilter = null;
                activeRowRoleFilter = null;
                // Reset table width to default
                table.style.width = '100%';
                applyFilters();
            });

            // Initial filter application
            applyFilters();
        });
    </script>
@endsection

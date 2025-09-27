@extends('layouts.home')
@section('content')
    <section class="mt-12 flex justify-center sm:mt-16">
        <div class="text-2xl font-black text-center max-w-4xl sm:text-4xl">
            <h1 class="font-normal text-4xl fjalla sm:text-6xl uppercase">
                Hero Synergies
            </h1>
        </div>
    </section>

    <section class="mb-10 text-center sm:text-left text-sm max-w-4xl m-auto">
        <div class="mt-6 pb-2 border-b-2 border-dashed sm:mt-8">
            <p class="sm:text-lg">
                This page shows the synergies between heroes in Overwatch.
                The matrix displays how well each hero works with others.
            </p>
        </div>

        <!-- Synergies Matrix Table -->
        <div class="mt-10 text-center overflow-x-auto">
            <h2 class="font-bold text-2xl mb-4 fjalla">Hero Synergies Matrix</h2>
            <table class="w-full min-w-max" id="synergiesTable">
                <thead>
                    <tr class="bg-white bg-color-text fjalla text-xl">
                        <th class="p-2">Hero</th>
                        @foreach ($heroes as $hero)
                            @php
                                $heroImage = $hero_images[$hero['name']] ?? 'images/assets/blank-hero.webp';
                                $role = $hero_roles[$hero['name']] ?? 'Unknown';
                            @endphp
                            <th class="p-2 text-xs sm:text-sm" data-hero="{{ $hero['name'] }}"
                                data-role="{{ $role }}" onclick="filterByHero('{{ $hero['name'] }}')">
                                <div class="flex flex-col items-center cursor-pointer hover:bg-gray-200 rounded p-1">
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
                        <tr class="odd:bg-[#294452] hero-row" data-hero="{{ $heroName }}"
                            data-role="{{ $role }}">
                            <td class="p-2" data-hero="{{ $heroName }}" data-role="{{ $role }}"
                                onclick="filterByRowHero('{{ $heroName }}')">
                                <div class="flex flex-col items-center cursor-pointer hover:bg-gray-200 rounded p-1">
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
                                <td class="p-2 text-center">
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
            let activeRoleFilter = null; // For filtering by role

            // Elements
            const resetButton = document.getElementById('resetFilter');
            const rows = document.querySelectorAll('#synergiesTable tbody tr');
            const headerCells = document.querySelectorAll('#synergiesTable thead th:not(:first-child)');
            const firstColumnCells = document.querySelectorAll('#synergiesTable tbody td:first-child');

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

                    // Apply role filter (only affects rows, not columns)
                    if (activeRoleFilter && activeRoleFilter !== rowRole) {
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

                            let showColumn = true;

                            // Apply column hero filter (when clicking hero in header row)
                            if (activeColumnHeroFilter && activeColumnHeroFilter !== columnHero) {
                                showColumn = false;
                            }

                            cell.style.display = showColumn ? '' : 'none';
                        });
                    }
                });

                // Filter header cells (columns) - role filter does NOT affect columns
                headerCells.forEach(cell => {
                    const cellHero = cell.getAttribute('data-hero');

                    let showCell = true;

                    // Apply column hero filter only
                    if (activeColumnHeroFilter && activeColumnHeroFilter !== cellHero) {
                        showCell = false;
                    }

                    cell.style.display = showCell ? '' : 'none';
                });

                // Update visual indication for active filters
                updateFilterIndicators();
            }

            // Function to update visual indicators for active filters
            function updateFilterIndicators() {
                // Reset all indicators
                headerCells.forEach(cell => {
                    cell.classList.remove('bg-yellow-200', 'bg-blue-200', 'bg-purple-200');
                });

                firstColumnCells.forEach(cell => {
                    cell.classList.remove('bg-yellow-200', 'bg-blue-200', 'bg-purple-200');
                });

                // Highlight active column hero filter (header row)
                if (activeColumnHeroFilter) {
                    headerCells.forEach(cell => {
                        if (cell.getAttribute('data-hero') === activeColumnHeroFilter) {
                            cell.classList.add('bg-yellow-200');
                        }
                    });

                    // Highlight corresponding row cells across all rows
                    rows.forEach(row => {
                        const cells = row.querySelectorAll('td:not(:first-child)');

                        // Highlight the specific cell in the column
                        cells.forEach((cell, index) => {
                            const columnHero = headerCells[index].getAttribute('data-hero');
                            if (columnHero === activeColumnHeroFilter) {
                                cell.classList.add('bg-yellow-200');
                            }
                        });
                    });

                    // Highlight corresponding first column cell
                    firstColumnCells.forEach(cell => {
                        if (cell.getAttribute('data-hero') === activeColumnHeroFilter) {
                            cell.classList.add('bg-yellow-200');
                        }
                    });
                }

                // Highlight active row hero filter (first column)
                if (activeRowHeroFilter) {
                    firstColumnCells.forEach(cell => {
                        if (cell.getAttribute('data-hero') === activeRowHeroFilter) {
                            cell.classList.add('bg-purple-200');
                        }
                    });

                    // Highlight corresponding header cells across all columns
                    headerCells.forEach(cell => {
                        if (cell.getAttribute('data-hero') === activeRowHeroFilter) {
                            cell.classList.add('bg-purple-200');
                        }
                    });
                }

                // Highlight active role filter
                if (activeRoleFilter) {
                    // Highlight header cells with matching role
                    headerCells.forEach(cell => {
                        if (cell.getAttribute('data-role') === activeRoleFilter) {
                            cell.classList.add('bg-blue-200');
                        }
                    });

                    // Highlight first column cells with matching role
                    firstColumnCells.forEach(cell => {
                        if (cell.getAttribute('data-role') === activeRoleFilter) {
                            cell.classList.add('bg-blue-200');
                        }
                    });

                    // Highlight all cells in rows with matching role
                    rows.forEach(row => {
                        if (row.getAttribute('data-role') === activeRoleFilter) {
                            // Highlight the first column cell
                            const firstCell = row.querySelector('td:first-child');
                            if (firstCell) {
                                firstCell.classList.add('bg-blue-200');
                            }

                            // Highlight the row's data cells
                            const cells = row.querySelectorAll('td:not(:first-child)');
                            cells.forEach(cell => {
                                cell.classList.add('bg-blue-200');
                            });
                        }
                    });
                }
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

                if (activeRoleFilter === roleName) {
                    activeRoleFilter = null; // Toggle off if already active
                } else {
                    activeRoleFilter = roleName;
                }

                applyFilters();
            };

            // Reset filters
            resetButton.addEventListener('click', function() {
                activeColumnHeroFilter = null;
                activeRowHeroFilter = null;
                activeRoleFilter = null;
                applyFilters();
            });

            // Initial filter application
            applyFilters();
        });
    </script>
@endsection

@extends('layouts.home')
@section('content')
    <section class="mt-12 flex justify-center sm:mt-16">
        <div class="text-2xl font-black text-center max-w-4xl sm:text-4xl">
            <h1 class="font-normal text-4xl fjalla sm:text-6xl uppercase">
                Overwatch Competitive Tier List
            </h1>
        </div>
    </section>
    <section class="mb-10 text-center sm:text-left text-sm max-w-4xl m-auto">
        <div class="mt-6 pb-2 border-b-2 border-dashed sm:mt-8">
            <p class="sm:text-lg">
                Compare hero tier rankings across all competitive ranks — from <b>GrandMaster</b> to <b>Bronze</b>.
                Select your rank below to see which heroes dominate your bracket.
            </p>
        </div>

        <div class="mt-6 overflow-x-auto pb-1">
            <div class="flex justify-center gap-2 flex-wrap">
                @foreach ($allRanks as $index => $rankData)
                    <button
                        onclick="showRank('{{ $rankData['name'] }}', this)"
                        class="rank-tab flex flex-col items-center gap-1 px-3 py-2 rounded-xl transition-colors {{ $index === 0 ? 'bg-[#3a5a6e]' : 'hover:bg-[#2a4a5e]' }}"
                    >
                        <img src="{{ asset($rankData['icon']) }}" alt="{{ $rankData['name'] }}" class="w-9 h-9 invert">
                        <span class="text-xs abel {{ $index === 0 ? 'text-white' : 'text-gray-400' }}">{{ $rankData['name'] }}</span>
                    </button>
                @endforeach
            </div>
        </div>

        @foreach ($allRanks as $index => $rankData)
            <div data-rank="{{ $rankData['name'] }}"@if($index !== 0) style="display:none"@endif>
                @foreach ($tierValues as $tier)
                    @php
                        $tierValue     = $tier[0];
                        $tierComponent = $tier[1];
                        $heroesInTier  = array_filter($rankData['heroes'], fn($h) => $h['value'] == $tierValue);
                        $roles = [
                            'Tank'    => '\images\assets\tank.webp',
                            'Damage'  => '\images\assets\damage.webp',
                            'Support' => '\images\assets\support.webp',
                        ];
                    @endphp

                    @if (count($heroesInTier) > 0)
                        <div class="mt-10 text-center">
                            {!! $tierComponent !!}
                            <table class="w-full">
                                <thead>
                                    <tr class="bg-white bg-color-text fjalla text-xl">
                                        <th>Hero:</th>
                                        <th class="hidden sm:table-cell">Role:</th>
                                        <th>Description:</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $roleName => $roleIcon)
                                        @foreach ($heroesInTier as $hero)
                                            @if ($hero['role'] == $roleName)
                                                <tr class="odd:bg-[#294452]">
                                                    <td>
                                                        <div class="flex flex-col items-center m-1">
                                                            <img src="{{ $hero['img'] ?? 'images/assets/blank-hero.webp' }}"
                                                                alt="{{ $hero['name'] }} profile" class="w-14 rounded-lg">
                                                            <h4 class="text-base abel font-medium w-14 truncate sm:w-20 sm:text-clip">
                                                                {{ $hero['name'] }}
                                                            </h4>
                                                        </div>
                                                    </td>
                                                    <td class="border-x-2 hidden sm:table-cell">
                                                        <div class="flex flex-col items-center m-1">
                                                            <img src="{{ $roleIcon }}" alt="{{ $roleName }} Icon" class="w-14 rounded-lg">
                                                            <h4 class="text-base abel font-medium">{{ $roleName }}</h4>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="p-2 text-xs sm:text-sm">{{ $hero['description'] }}</p>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                @endforeach
            </div>
        @endforeach
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tabs = document.querySelectorAll('.rank-tab');
            const random = tabs[Math.floor(Math.random() * tabs.length)];
            random.click();
        });

        function showRank(rank, btn) {
            document.querySelectorAll('[data-rank]').forEach(el => el.style.display = 'none');
            document.querySelector('[data-rank="' + rank + '"]').style.display = 'block';
            document.querySelectorAll('.rank-tab').forEach(el => {
                el.classList.remove('bg-[#3a5a6e]');
                el.querySelector('span').classList.replace('text-white', 'text-gray-400');
            });
            btn.classList.add('bg-[#3a5a6e]');
            btn.querySelector('span').classList.replace('text-gray-400', 'text-white');
        }
    </script>
@endsection

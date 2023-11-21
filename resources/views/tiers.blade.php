@extends('layouts.home')
@section('content')
<section class="mt-12 flex justify-center sm:mt-16">
    <div class="text-2xl font-black text-center max-w-4xl sm:text-4xl">
        <p>
            Overpicker is a hero composition calculator inspired in
            jazzmasta25's
            <a
                href="https://heropicker.com/"
                target="_blank"
                rel="noopener noreferrer"
                class="underline decoration-amber-400"
                >Hero Picker</a
            >
        </p>
    </div>
</section>
<section class="mb-10 text-center sm:text-left text-sm max-w-4xl m-auto">
    <div class="mt-12 pb-2 border-b-2 border-dashed sm:mt-16">
        <p class="sm:text-lg">
            The tiers system allows the calculator to quickly pick heroes according to their performance in the last weeks, the tiers presented here are based on the heroes that are currently in the <b>Top500 leaderboard</b> in Overwatch 2, but the calculator has other types of tiers that may be more convenient for you!
        </p>
    </div>
    @foreach($tierValues as $tier)
        @php
            $tierValue = $tier[0];
            $tierLetter = $tier[1];
            $tierColor = $tier[2];            
        @endphp
        <div class="mt-10 text-center">
            <h2 class="{{ $tierColor }} text-3xl fjalla font-normal border-t-4 pt-1">Tier - {{ $tierLetter }}</h2>
            <table class="w-full">
                <thead>
                    <tr class="bg-white bg-color-text fjalla text-xl"><th>Hero:</th><th class="hidden sm:table-cell">Role:</th><th>Description:</th></tr>
                </thead>
                <tbody>
                    @foreach($tiers as $hero)
                        @if($hero["value"] == $tierValue && $hero["role"] == "Tank")
                            <tr class="odd:bg-[#294452]">
                                <td>
                                    <div class="flex flex-col items-center m-1">
                                        <img src="{{$hero["img"]}}" alt="{{$hero["name"]}} profile" class="w-14 rounded-lg">
                                    </div>
                                </td>
                                <td class="border-x-2 hidden sm:table-cell">
                                    <div class="flex flex-col items-center m-1">
                                        <img src="\images\assets\tank.png" alt="Tank Icon" class="w-14 rounded-lg">
                                        <h4 class="text-base abel font-medium w-14 truncate sm:w-20 sm:text-clip">Tank</h4>
                                    </div>
                                </td>
                                <td>
                                    <p class="p-2 text-xs sm:text-sm">{{$hero["description"]}}</p>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    @foreach($tiers as $hero)
                        @if($hero["value"] == $tier[0] && $hero["role"] == "Damage")
                            <tr class="odd:bg-[#294452]">
                                <td>
                                    <div class="flex flex-col items-center m-1">
                                        <h4 class="text-base abel font-medium w-14 truncate sm:w-20 sm:text-clip">{{$hero["name"]}}</h4>
                                        <img src="{{$hero["img"]}}" alt="{{$hero["name"]}} profile" class="w-14 rounded-lg">
                                    </div>
                                </td>
                                <td class="border-x-2 hidden sm:table-cell">
                                    <div class="flex flex-col items-center m-1">
                                        <img src="\images\assets\damage.png" alt="Damage Icon" class="w-14 rounded-lg">
                                        <h4 class="text-base abel font-medium w-14 truncate sm:w-20 sm:text-clip">Damage</h4>
                                    </div>
                                </td>
                                <td>
                                    <p class="p-2 text-xs sm:text-sm">{{$hero["description"]}}</p>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                @foreach($tiers as $hero)
                    @if($hero["value"] == $tier[0] && $hero["role"] == "Support")
                        <tr class="odd:bg-[#294452]">
                            <td>
                                <div class="flex flex-col items-center m-1">
                                    <h4 class="text-base abel font-medium w-14 truncate sm:w-20 sm:text-clip">{{$hero["name"]}}</h4>
                                    <img src="{{$hero["img"]}}" alt="{{$hero["name"]}} profile" class="w-14 rounded-lg">
                                </div>
                            </td>
                            <td class="border-x-2 hidden sm:table-cell">
                                <div class="flex flex-col items-center m-1">
                                    <img src="\images\assets\support.png" alt="Support Icon" class="w-14 rounded-lg">
                                    <h4 class="text-base abel font-medium w-14 truncate sm:w-20 sm:text-clip">Support</h4>
                                </div>
                            </td>
                            <td>
                                <p class="p-2 text-xs sm:text-sm">{{$hero["description"]}}</p>
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    @endforeach
</section>
@endsection
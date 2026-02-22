@extends('layouts.home') @section('content')
    <section class="relative mt-7 flex justify-center">
        {{--     <div id="alert"
        class="fixed z-50 top-0 left-1/2 transform -translate-x-1/2 translate-y-1/2 bg-[#1C2E37] text-white p-4 rounded-md shadow-md border border-white">
        <div class="flex justify-between items-center">
            <p class="text-lg font-semibold text-center">
                Important Message:
                <a href="#" target="_blank" rel="noopener noreferrer"
                    class="underline decoration-amber-400">overpicker.win</a>
                is now
                <a href="http://www.overpicker.com/" target="_blank" rel="noopener noreferrer"
                    class="underline decoration-amber-400">overpicker.com</a> - The old domain will stop working in
                March, so please update your bookmarks!
            </p>
            <button id="closeAlert" class="ml-10 text-white focus:outline-none">
                <span class="text-4xl font-bold text-amber-400">×</span>
            </button>
        </div>
    </div> --}}
        <div class="text-2xl font-black text-center mb-8 max-w-4xl sm:text-4xl">
            <h1>Overwatch Hero Picker & Team Composition Calculator</h1>
        </div>
    </section>

    <section class="mb-10">
        <div class="poppins font-bold text-center text-xl sm:text-2xl md:text-3xl">
            <span class="text-sky-600">Ally Team</span>
            <span>/</span>
            <span class="text-red-600">Enemy Team</span>
        </div>
        <div class="calculator"></div>
    </section>

    {{-- SEO Content Section --}}
    <section class="max-w-4xl mx-auto mb-12 px-4">
        <h2 class="text-2xl font-bold text-center mb-6">What is Overpicker?</h2>
        <div class="bg-[#2a3f4a] rounded-lg p-6">
            <p class="text-lg mb-4">
                Overpicker is an advanced <strong>Overwatch hero picker</strong> designed to help players build the perfect
                team composition.
                Whether you're looking to counter the enemy team, find synergistic hero combinations, or simply pick the
                best hero for your map,
                Overpicker has you covered.
            </p>
            <ul class="space-y-3 mt-6">
                <li class="flex items-start">
                    <i class="bi bi-check-circle-fill text-green-400 mt-1 mr-3"></i>
                    <span><strong>Hero Selection Tool</strong> - Quickly find the best heroes based on your team and enemy
                        composition</span>
                </li>
                <li class="flex items-start">
                    <i class="bi bi-check-circle-fill text-green-400 mt-1 mr-3"></i>
                    <span><strong>Tierlist System</strong> - Discover the best heroes for every competitive rank based on
                        high-level performance data</span>
                </li>
                <li class="flex items-start">
                    <i class="bi bi-check-circle-fill text-green-400 mt-1 mr-3"></i>
                    <span><strong>Counter Scoring Matrix</strong> - Identify which heroes hard counter the enemy picks and
                        gain the
                        advantage</span>
                </li>
                <li class="flex items-start">
                    <i class="bi bi-check-circle-fill text-green-400 mt-1 mr-3"></i>
                    <span><strong>Synergy Scoring System</strong> - Discover powerful hero combinations that work well
                        together</span>
                </li>
            </ul>
        </div>
    </section>
    <script defer src="js/calculator.js" type="module"></script>
    <script>
        // JavaScript to close the alert when the close button is clicked
        /* document
            .getElementById("closeAlert")
            .addEventListener("click", function () {
                document.getElementById("alert").style.display = "none";
            });
        */
    </script>
@endsection

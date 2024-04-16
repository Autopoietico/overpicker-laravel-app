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
        <p>
            Find your best composition, counter the enemy comp, and find the
            best hero for every map in Overwatch
        </p>
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
<script defer src="js/calculator.js"></script>
<script>
    // JavaScript to close the alert when the close button is clicked
    document
        .getElementById("closeAlert")
        .addEventListener("click", function () {
            document.getElementById("alert").style.display = "none";
        });
</script>
@endsection
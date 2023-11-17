@extends('layouts.home') @section('content')
<section class="mt-7 flex justify-center">
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
@endsection

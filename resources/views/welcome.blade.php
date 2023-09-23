@extends('layouts.home')
@section('content')
<section class="mt-7">
  <div class="text-2xl text-center mb-8 border-t-2 border-b-2 border-white">
    <p>Find your best composition, counter the enemy comp, and find the best hero for every map in Overwatch</p>
  </div>
</section>
<section>
  <div class="poppins font-bold text-center text-1xl">
    <span class="text-sky-600">Ally Team</span>
    <span>/</span>
    <span class="text-red-600">Enemy Team</span>
  </div>
  <div class="calculator">

  </div>
</section>
<script defer src="js/calculator.js"></script>
@endsection
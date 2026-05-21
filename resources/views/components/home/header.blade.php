<div class="visible z-50 text-3xl absolute top-6 left-6 bg-[#294452]/90 border border-white/10 p-2 rounded-xl shadow-lg cursor-pointer transition-all hover:bg-amber-400 hover:text-[#1c2e37] sm:invisible" id="burger-menu">
    <i class="bi bi-list"></i>
</div>
<header class="relative mt-6 grid gap-y-6 justify-items-center sm:grid-cols-2 w-full">
    <div class="select-none sm:place-self-start flex flex-col">
        <h1 class="fjalla text-5xl sm:text-6xl tracking-wide uppercase"><a href="/" class="hover:text-amber-400 transition-colors duration-300">Overpicker</a></h1>
        <h2 class="poppins text-xs font-semibold uppercase tracking-widest text-slate-400/80 text-right mt-1">
            <a href="/about" class="hover:text-amber-400 transition-colors">By Autopoietico</a>
        </h2>
    </div>
    <div class="header-tip text-slate-400 text-center select-none max-w-sm sm:place-self-end w-full">
        <div class="glass-panel border-l-4 border-amber-400 bg-amber-400/5 px-4 py-2.5 rounded-r-xl text-left shadow-md">
            <p class="poppins text-[11px] font-medium tracking-wide text-slate-300 leading-relaxed mb-1 uppercase opacity-75">
                Daily Tip
            </p>
            <p class="poppins text-[13px] font-semibold text-slate-100 leading-snug">
                "{{ $advice }}"
            </p>
        </div>
    </div>
    
    <nav class="invisible opacity-0 fixed -top-1 bg-[#294452]/95 z-40 w-full py-10 rounded-b-2xl transition-all ease-in-out duration-300 shadow-2xl sm:visible sm:static sm:bg-inherit sm:col-span-2 sm:py-0 sm:opacity-100 w-full"
        id="header-nav">
        <ol class="glass-panel py-3 px-4 rounded-2xl grid gap-x-2 gap-y-6 fjalla text-2xl uppercase justify-center text-center sm:grid-flow-col sm:gap-y-0 sm:justify-around w-full shadow-lg border border-white/10">
            <li>
                <a class="px-4 py-2.5 rounded-xl transition-all duration-300 hover:text-amber-400 hover:bg-white/5 tracking-wider text-lg" href="/heroes">Heroes</a>
            </li>
            <li>
                <a class="px-4 py-2.5 rounded-xl transition-all duration-300 hover:text-amber-400 hover:bg-white/5 tracking-wider text-lg" href="/tiers">Tiers</a>
            </li>
            <li>
                <a class="px-4 py-2.5 rounded-xl transition-all duration-300 hover:text-amber-400 hover:bg-white/5 tracking-wider text-lg" href="/counters">Counters</a>
            </li>
            <li>
                <a class="px-4 py-2.5 rounded-xl transition-all duration-300 hover:text-amber-400 hover:bg-white/5 tracking-wider text-lg" href="/synergies">Synergies</a>
            </li>
            <li>
                <a class="px-4 py-2.5 rounded-xl transition-all duration-300 hover:text-amber-400 hover:bg-white/5 tracking-wider text-lg" href="/maps">Maps</a>
            </li>
            <li>
                <a class="px-4 py-2.5 rounded-xl transition-all duration-300 hover:text-amber-400 hover:bg-white/5 tracking-wider text-lg" href="/trackers">Trackers</a>
            </li>
            <li>
                <a class="px-4 py-2.5 rounded-xl transition-all duration-300 hover:text-amber-400 hover:bg-white/5 tracking-wider text-lg" href="/about">About</a>
            </li>
        </ol>
    </nav>
</header>
<script defer src="js/hamburger.js"></script>


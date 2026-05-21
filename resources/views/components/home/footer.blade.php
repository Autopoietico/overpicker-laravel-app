<footer class="mt-12 mb-6 glass-panel p-6 rounded-2xl grid gap-y-6 justify-items-center border border-white/10 w-full shadow-lg">

    <nav class="w-full hidden sm:block">
        <ol class="grid grid-flow-col gap-x-6 justify-center mt-1 fjalla tracking-wider">
            <li>
                <a class="hover:text-amber-400 hover:bg-white/5 px-3 py-1.5 rounded-lg transition-all duration-300 text-lg" href="tiers">Tiers</a>
            </li>
            <li>
                <a class="hover:text-amber-400 hover:bg-white/5 px-3 py-1.5 rounded-lg transition-all duration-300 text-lg" href="counters">Counters</a>
            </li>
            <li>
                <a class="hover:text-amber-400 hover:bg-white/5 px-3 py-1.5 rounded-lg transition-all duration-300 text-lg" href="synergies">Synergies</a>
            </li>
            <li>
                <a class="hover:text-amber-400 hover:bg-white/5 px-3 py-1.5 rounded-lg transition-all duration-300 text-lg" href="maps">Maps</a>
            </li>
            <li>
                <a class="hover:text-amber-400 hover:bg-white/5 px-3 py-1.5 rounded-lg transition-all duration-300 text-lg" href="trackers">Trackers</a>
            </li>
            <li>
                <a class="hover:text-amber-400 hover:bg-white/5 px-3 py-1.5 rounded-lg transition-all duration-300 text-lg" href="sources">Sources</a>
            </li>
            <li>
                <a class="hover:text-amber-400 hover:bg-white/5 px-3 py-1.5 rounded-lg transition-all duration-300 text-lg" href="about">About</a>
            </li>
        </ol>
    </nav>
    <div class="text-center select-none mt-2">
        <h3 class="fjalla text-3xl sm:text-4xl tracking-wide uppercase"><a href="/" class="hover:text-amber-400 transition-colors duration-300">Overpicker</a></h3>
        <h4 class="poppins text-xs font-semibold uppercase tracking-widest text-slate-400/80 text-center mt-1">
            <a href="about" class="hover:text-amber-400 transition-colors">By Autopoietico</a>
        </h4>
    </div>
    <div class="h-fit w-full grid text-center text-xs tracking-wider uppercase font-semibold text-slate-400 sm:text-inherit sm:grid-flow-col sm:place-content-between sm:px-4">
        <span>Last Update: <strong class="text-slate-200">{{ $dates['LAST_DATA_UPDATE'] }}</strong></span>
        <span>CC({{ $dates['COPY_DATE'] }})</span>
    </div>
    <div class="grid grid-flow-col gap-x-6 items-center">
        <a href="https://discord.gg/PBfMUzz" title="OW Picker Discord" target="_blank" class="hover:scale-110 opacity-75 hover:opacity-100 transition-all duration-300"><img class="w-10"
                src="{{ asset('images/social/discord-brands.svg') }}" alt="Discord Icon" /></a>
        <a href="https://paypal.me/car930" title="Paypal Account" target="_blank" class="hover:scale-110 opacity-75 hover:opacity-100 transition-all duration-300"><img class="w-10"
                src="{{ asset('images/social/paypal-brands.svg') }}" alt="PayPal Icon" /></a>
    </div>
    <div class="h-fit w-full grid text-center text-xs text-slate-400/90 sm:text-inherit sm:grid-flow-col sm:place-content-between sm:px-4 border-t border-white/5 pt-4">
        <span><a href="/privacy" class="underline decoration-amber-400 hover:text-amber-400 transition-colors">Privacy
                Policy</a></span>
        <span class="mt-2 sm:mt-0 text-[10px] sm:text-xs">This site is not affiliated with Overwatch or Blizzard Entertainment.</span>
    </div>
</footer>

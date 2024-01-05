<footer class="mt-5 mb-1 grid gap-y-1 justify-items-center border-t-2">

    {{-- <div class="relative w-96 h-80 overflow-hidden">
        <iframe
            class="absolute -top-12 w-96 h-80"
            src="https://ow2countdown.com/event/112/season-7-rise-of-darkness/embed?title=1&progress_bar=1&theme=dark#svelte-qisv2e"
            scrolling="no"
        ></iframe>
    </div> --}}

    <nav class="w-full hidden sm:block">
        <ol class="grid grid-flow-col gap-x-4 text-2xl justify-center mt-1">
            <li>
                <a class="hover:bg-[#294452] px-2 py-1 rounded-lg" href="tiers"
                    >Tiers</a
                >
            </li>
            <li>
                <a
                    class="hover:bg-[#294452] px-2 py-1 rounded-lg"
                    href="sources"
                    >Sources</a
                >
            </li>
            <li>
                <a class="hover:bg-[#294452] px-2 py-1 rounded-lg" href="about"
                    >About</a
                >
            </li>
        </ol>
    </nav>
    <div class="mt-6 select-none">
        <h1 class="fjalla-n text-5xl uppercase"><a href="/">Overpicker</a></h1>
        <h2 class="abel text-base text-right">
            <a href="about">By Autopoietico</a>
        </h2>
    </div>
    <div
        class="mt-6 h-fit w-full grid text-center sm:text-inherit sm:grid-flow-col sm:place-content-between"
    >
        <span class="footer-final-line-left">Last Update: {{$dates['LAST_DATA_UPDATE']}}</span>
        <span>CC({{$dates['COPY_DATE']}})</span>
    </div>
    <div class="mt-3 grid grid-flow-col gap-x-5">
        <a
            href="https://discord.gg/PBfMUzz"
            title="OW Picker Discord"
            target="_blank"
            ><img
                class="w-12"
                src="{{ asset('images/social/discord-brands.svg') }}"
                alt="Discord Icon"
        /></a>
        <a
            href="https://paypal.me/car930"
            title="Paypal Account"
            target="_blank"
            ><img
                class="w-12"
                src="{{ asset('images/social/paypal-brands.svg') }}"
                alt="PayPal Icon"
        /></a>
    </div>
    <div
        class="mt-6 h-fit w-full grid text-center sm:text-inherit sm:grid-flow-col sm:place-content-between"
    >
        <span class="footer-final-line-left"><a href="/privacy" class="underline decoration-amber-400">Privacy Policy</a></span>
        <span>This site is not affiliated with Overwatch or Blizzard Entertainment.</span>
    </div>
</footer>

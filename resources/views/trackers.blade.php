@extends('layouts.home') @section('content')
<section class="mt-12 flex justify-center sm:mt-16">
    <div class="text-2xl font-black text-center max-w-4xl sm:text-4xl">
        <h1 class="font-normal text-4xl fjalla sm:text-6xl uppercase">
            Overwatch Tracker
            </h2>
            <img src="{{ asset('images\assets\trackers-hero.webp') }}" alt="Overwatch Tracker Dashboard screenshot"
                class="rounded-2xl shadow-md shadow-slate-500">
    </div>
</section>
<section class="mb-10 text-center sm:text-left text-sm max-w-4xl m-auto">
    <div class="mt-10 pb-2 border-b-2 border-dashed sm:mt-16">
        <h2 class="font-normal text-2xl fjalla sm:text-3xl">
            Tracker Origin:
        </h2>
        <p class="mt-3 sm:text-lg">
            This tracker was created by <b><a href="https://www.reddit.com/user/LeCorbuisoverrated/" target="_blank"
                    rel="noopener noreferrer" class="underline decoration-amber-400">LeCorbuisoverrated</a></b> but is
            now abandoned. However I try to keep it updated with the new maps and heroes added to the game.
        </p>
        <p class="mt-3 sm:text-lg">
            <b>IMPORTANT: I am only adding new maps and heroes. I'm avoiding fixing bugs or errors in the trackers
                because I really don't have too much time for that, but you can take the sheets and improve them for
                your own use.</b>
        </p>
        <p class="mt-3 sm:text-lg">
            The tracker still uses the old SR system, but I have added this table that indicate which rank is
            matematically similar to the old numbered rank (This is merely a numerical translation, and <b><a
                    href="https://twitter.com/AutopoieticoLP/status/1722801534830891312" target="_blank"
                    rel="noopener noreferrer" class="underline decoration-amber-400">is not related to skill</a></b> )
        </p>
        <p class="mt-3 sm:text-lg">
            You only need to locate your rank and add the percentage after each match. If you have demotion protection,
            just take the average SR losses/wins from the home page and subtract/add that from your last match.
        </p>
    </div>
    <div class="mt-3 pb-6 sm:text-lg flex justify-center border-b-2 border-dashed flex-col">
        <button id="toggleButton" class="focus:outline-none mt-3">
            <b><span class="underline decoration-amber-400">SR Translator Hide/Show</span></b>
        </button>
        <ul id="listContainer" class="mt-3 sm:text-lg hidden mb-6 text-center">
            <li><b>Champion 1</b> - 4900SR</li>
            <li><b>Champion 2</b> - 4800SR</li>
            <li><b>Champion 3</b> - 4700SR</li>
            <li><b>Champion 4</b> - 4600SR</li>
            <li><b>Champion 5</b> - 4500SR</li>
            <li><b>Granmaster 1</b> - 4400SR</li>
            <li><b>Granmaster 2</b> - 4300SR</li>
            <li><b>Granmaster 3</b> - 4200SR</li>
            <li><b>Granmaster 4</b> - 4100SR</li>
            <li><b>Granmaster 5</b> - 4000SR</li>
            <li><b>Master 1</b> - 3900SR</li>
            <li><b>Master 2</b> - 3800SR</li>
            <li><b>Master 3</b> - 3700SR</li>
            <li><b>Master 4</b> - 3600SR</li>
            <li><b>Master 5</b> - 3500SR</li>
            <li><b>Diamond 1</b> - 3400SR</li>
            <li><b>Diamond 2</b> - 3300SR</li>
            <li><b>Diamond 3</b> - 3200SR</li>
            <li><b>Diamond 4</b> - 3100SR</li>
            <li><b>Diamond 5</b> - 3000SR</li>
            <li><b>Platinum 1</b> - 2900SR</li>
            <li><b>Platinum 2</b> - 2800SR</li>
            <li><b>Platinum 3</b> - 2700SR</li>
            <li><b>Platinum 4</b> - 2600SR</li>
            <li><b>Platinum 5</b> - 2500SR</li>
            <li><b>Gold 1</b> - 2400SR</li>
            <li><b>Gold 2</b> - 2300SR</li>
            <li><b>Gold 3</b> - 2200SR</li>
            <li><b>Gold 4</b> - 2100SR</li>
            <li><b>Gold 5</b> - 2000SR</li>
            <li><b>Silver 1</b> - 1900SR</li>
            <li><b>Silver 2</b> - 1800SR</li>
            <li><b>Silver 3</b> - 1700SR</li>
            <li><b>Silver 4</b> - 1600SR</li>
            <li><b>Silver 5</b> - 1500SR</li>
            <li><b>Bronze 1</b> - 1400SR</li>
            <li><b>Bronze 2</b> - 1300SR</li>
            <li><b>Bronze 3</b> - 1200SR</li>
            <li><b>Bronze 4</b> - 1100SR</li>
            <li><b>Bronze 5</b> - 1000SR or less</li>
            <p class="mt-3"><b>Presumably, individuals in Bronze 5 have SR values between 0 and 1099, so adding 1000 and
                    calculating the percentage is not accurate.</b></p>
        </ul>
    </div>
    <div class="mt-10 pb-2 border-b-2 border-dashed">
        <h2 class="font-normal text-2xl fjalla sm:text-3xl">Instructions:</h2>
        <p>
            You can get a <b>blank sheet</b> from here:
        </p>
        <p class="sm:text-lg">
            <b><a href="https://docs.google.com/spreadsheets/d/1nGr0T2ssFyH-AVC4cd5ZxGIAVUYSUIVt6Cl-9un_NjY/"
                    target="_blank" rel="noopener noreferrer" class="underline decoration-amber-400">OpenQ
                    tracker</a></b>
        </p>
        <p class="sm:text-lg">
            <b><a href="https://docs.google.com/spreadsheets/d/1zm3TvpIBp9VZeUPLqYiGVTNshz8dZJD6bDBxGmG6AgQ/"
                    target="_blank" rel="noopener noreferrer" class="underline decoration-amber-400">Tank
                    tracker</a></b>
        </p>
        <p class="sm:text-lg">
            <b><a href="https://docs.google.com/spreadsheets/d/1rkf7e8CwdoWv0T6HWvmR7o8WbstfYPrZnkjGJzvp468/"
                    target="_blank" rel="noopener noreferrer" class="underline decoration-amber-400">Damage
                    tracker</a></b>
        </p>
        <p class="sm:text-lg">
            <b><a href="https://docs.google.com/spreadsheets/d/1yj0OLx1f9Hs9YxRqmH02wkQwODvIAfotvA77AhyOIW4/"
                    target="_blank" rel="noopener noreferrer" class="underline decoration-amber-400">Support
                    tracker</a></b>
        </p>
        <p class="sm:text-lg">
            If you want to see one that's already filled, here's a <b><a
                    href="https://docs.google.com/spreadsheets/d/18wktlOAZqmi-AOHrb6EqLhOkpEckR_K3v0Zd3AYqaOQ/"
                    target="_blank" rel="noopener noreferrer" class="underline decoration-amber-400">sample</a></b>.
        </p>
        <ul class="mt-5 sm:text-lg">
            <li>
                <p class="mt-1">&bull; If you wanna get a copy of the blank one, click File > Make a copy. It should
                    save it to your Google Drive account.</p>
            </li>
            <li class="mt-3">
                <p>
                <h3 class="font-normal text-1xl fjalla sm:text-2xl">IMPORTANT</h3>
                </p>
                <p class="mt-1">&bull; Click File > Settings and change your time zone for the one you are, don't change
                    anything else.</p>
            </li>
            <li class="mt-5">
                <p>1. After your placements (that you'll be able to log this time around!) you should fill is <a
                        href="https://i.imgur.com/dYIZndi.png" target="_blank" rel="noopener noreferrer"
                        class="underline decoration-amber-400">this cell</a> with your first SR once you have managed to
                    rank.</p>
            </li>
            <li class="mt-1">
                <p>2. Then proceed to fill the rows you want to after each match: the more you fill, the more useful the
                    spreadsheet will become: Map, hero(es), AVG SR per team, notes, etc. After a few matches you'll be
                    able to get some useful data from the <b>Home sheet</b> and the <b>Progression sheets</b>.</p>
            </li>
            <li class="mt-3">
                <p>&bull; I usually take two screenshots during the game, one at the beginning, to get the SR per team
                    and one at the end, to get the score and the hero stats. Everything is set up in order to get the
                    screenshots saved in a folder, so I'm free to do the logging after the end the game session, though,
                    most of the time I do it between games.</p>
            </li>
        </ul>
    </div>
    <div class="mt-10 pb-2 border-b-2 border-dashed sm:mb-14">
        <h2 class="font-normal text-2xl fjalla sm:text-3xl">
            About the Spreadsheet:
        </h2>
        <p class="mt-1"><em>This is the info that <b><a href="https://www.reddit.com/user/LeCorbuisoverrated/"
                        target="_blank" rel="noopener noreferrer"
                        class="underline decoration-amber-400">LeCorbuisoverrated</a></b> previously shared in his
                posts.</em></p>
        <ul class="mt-5 sm:text-lg">
            <li>
                <p>
                <h3 class="font-normal text-1xl fjalla sm:text-2xl">Home</h3>
                </p>
                <p class="mt-1">This is the sheet where you'll be able to get a quick status on most of your stats.</p>
            </li>
            <li class="mt-3">
                <p>
                <h3 class="font-normal text-1xl fjalla sm:text-2xl">Tracker</h3>
                </p>
                <p class="mt-1"><em>This sheet is where you log your games, the more data you write down, the more
                        useful everything else will become.</em></p>
                <p class="mt-2">&bull; You can add up to five heroes per match, just remember, <b>that might skew most
                        of the other stats.</b></p>
                <p class="mt-1">&bull; There are two <b>customizable</b> (C1 and C2, rename them as you see fit)
                    <b>columns</b> in between the stats, so that you can keep track on your [rezzes/aim/sleeps/etc] more
                    easily, just edit AY5 and BD5 to add the title to each column (the spreadsheet will replicate them
                    everywhere else that is needed).
                </p>
                <p class="mt-1">&bull; Please, remember that the <b>cells that need to be filled are blue</b> and the
                    ones that <b>should not be touched are light blue.</b></p>
                <p class="mt-1">&bull; A big white button that says "<b>Next Match</b>" will pop-up in the top bar after
                    the placements, for it to work, it is needed for you, my dear user, to copy the document's url in
                    the cell next to it (I've left a message for you to remember it), once you do it, the link should go
                    invisible.</p>
                <p class="mt-1">&bull; The tips change daily.</p>
                <p class="mt-1">&bull; <b>If you need some help about filling the sheet, check the next image. (Also, no
                        need to write the date manually, it should do it by its own).</b></p>
                <p class="mt-1"><a href="https://i.imgur.com/d4wJhCM.png" target="_blank" rel="noopener noreferrer"><img
                            src="{{ asset('images\assets\ABREBIATIONS.webp') }}"
                            alt="Overwatch Tracker Manual Indications"></a></p>
            </li>
            <li class="mt-3">
                <p>
                <h3 class="font-normal text-1xl fjalla sm:text-2xl">Maps</h3>
                </p>
                <p class="mt-1"><em>This is the sheet that will have everything you need to know about Maps: best/worst
                        maps, best hero per map, winrates, etc.</em></p>
                <p class="mt-2">&bull; Here you'll find everything you use to have in the Map Dashboard, the Starting
                    Point Detail and some of the charts from the Dashboard.</p>
            </li>
            <li class="mt-3">
                <p>
                <h3 class="font-normal text-1xl fjalla sm:text-2xl">Heroes</h3>
                </p>
                <p class="mt-1"><em>This is the sheet that will have everything you need to know about Heroes:
                        best/worst heroes, average SR won/lost per hero, winrates, etc.</em></p>
                <p class="mt-2">&bull; 'Stat per hero' will enable you to see the total, the average and the progression
                    of each stat per hero. </p>
                <p class="mt-1">&bull; Take these with a gran of salt as the spreadsheet (when you play more than one
                    hero per match) CAN'T possibly know to whom (and how much of it) does each statis relates. For
                    example: if during one match you play both Mercy and Winston, you'll see that Winston's row will
                    have some heals. </p>
            </li>
            <li class="mt-3">
                <p>
                <h3 class="font-normal text-1xl fjalla sm:text-2xl">Mates</h3>
                </p>
                <p class="mt-1"><em>This is the sheet that will tell you how well do you do when in groups and with each
                        player.</em></p>
                <p class="mt-2">&bull; Every player you list in the tracker will be here for you to see how are you
                    doing when you play with them.</p>
            </li>
            <li class="mt-3">
                <p>
                <h3 class="font-normal text-1xl fjalla sm:text-2xl">Date & Time</h3>
                </p>
                <p class="mt-1"><em>This sheet will have a chart that cross-references the days and times in which you
                        play.</em></p>
                <p class="mt-2">&bull; Bellow that chart, you'll be find a log of your performance per day.</p>
            </li>
            <li class="mt-3">
                <p>
                <h3 class="font-normal text-1xl fjalla sm:text-2xl">Hero/Map Progression</h3>
                </p>
                <p class="mt-1"><em>This sheet will enable you to get the log of certain hero or map.</em></p>
                <p class="mt-2">&bull; It will show your stats per minute and your Custom Stats.</p>
            </li>
            <li class="mt-3">
                <p>
                <h3 class="font-normal text-1xl fjalla sm:text-2xl">SR/WR Progression</h3>
                </p>
                <p class="mt-1"><em>This graph will show your SR/WR progression through games.</em></p>
            </li>
            <li class="mt-3">
                <p>
                <h3 class="font-normal text-1xl fjalla sm:text-2xl">AVG. SR Won/Lost</h3>
                </p>
                <p class="mt-1"><em>This graph will show you how much SR have you been winning/losing, and how has that
                        changed through the season.</em></p>
            </li>
        </ul>
    </div>
    <div class="mt-10 pb-2 border-b-2 border-dashed sm:mb-14">
        <h2 class="font-normal text-2xl fjalla sm:text-3xl">
            Extra Stuff:
        </h2>
        <p class="mt-3 sm:text-lg">
            For those of you who want to either to get more data or to know how everything is tied together, if you go
            to the little burger button in the bottom left corner it will show you a list of every sheet included, even
            the hidden ones that do some of the backstage work:
        </p>
        <ul class="mt-5 sm:text-lg">
            <li>
                <p>
                <h3 class="font-normal text-1xl fjalla sm:text-2xl">&bull; ASSETS_HERO/MAPS/RANKS/ADVICES/TIMES</h3>
                </p>
                <p class="ml-3 mt-1">-This is the sheet where you'll be able to get a quick status on most of your
                    stats.</p>
                <p class="ml-3 mt-1">-ASSETS_TIMES sheet help keeping the timing in all the sheets.</p>
                <p class="ml-3 mt-1">-There is a bridge between your spreadsheet and the server (see below), so that
                    you'll get the new heroes and maps when Blizz releases them.</p>
            </li>
            <li class="mt-4">
                <p>
                <h3 class="font-normal text-1xl fjalla sm:text-2xl">&bull; ASSETS_PERSONALISED_ADVICES</h3>
                </p>
                <p class="ml-3 mt-1">-This one will take note of your most used heroes and filter some advices that are
                    useful to you. </p>
            </li>
            <li class="mt-4">
                <p>
                <h3 class="font-normal text-1xl fjalla sm:text-2xl">&bull; <a
                        href="https://docs.google.com/spreadsheets/d/1JqxVVmhN0swqh_2puB-sL0mFRI4jd1mU1VbBOUnkzu8"
                        target="_blank" rel="noopener noreferrer" class="underline decoration-amber-400">Overwatch Game
                        Tracker 1.8.7 "Sierra Nevada" Server</a></h3>
                </p>
                <p class="ml-3 mt-1">-By using the old server, I can keep updated even older versions of the sheet.</p>
            </li>
        </ul>
    </div>
    <div class="mt-10 pb-2 border-b-2 border-dashed sm:mb-14">
        <h2 class="font-normal text-2xl fjalla sm:text-3xl">
            F. A. Q.
        </h2>
        <ul class="mt-5 sm:text-lg">
            <li class="mt-4">
                <p>
                <b>&bull; <em>"Hey, those tips seem useful, but you should add this one."</em></b> - At this moment, I'm not adding new tips to the spreadsheet, but I may do so in the future for both the webpage and the spreadsheet!
                </p>
            </li>
            <li class="mt-4">
                <p>
                <b>&bull; <em>"Hey, How can I save Overwatch's screenshots?"</em></b> - Overwatch itself saves screenshots in 'Documents\Overwatch\ScreenShots\Overwatch'.
                </p>
            </li>
            <li class="mt-4">
                <p>
                <b>&bull; <em>"Hey, How do I do to get a blank copy?"</em></b> - ****If you wanna get a copy of the blank one, click File > Make a copy. It should save it to your Google Drive account.
                </p>
            </li>
            <li class="mt-4">
                <p>
                <b>&bull; <em>"Hey, you said something about customizable columns, How do I do that?"</em></b> - Edit AY5 and BD5, then the text to have there will mirror in the rest of thre spreadsheet, try to keep it short though.
                </p>
            </li>
            <li class="mt-4">
                <p>
                <b>&bull; <em>"Hey, Can I use this file in Excel/Calc/Numbers/1-2-3/VisiCalc?"</em></b> -  Due to some features that might be unique to Google Sheets (see Query) it might not work in other apps. 
                </p>
            </li>
            <li class="mt-4">
                <p>
                <b>&bull; <em>"Hey, WTF is Paramillo?"</em></b> - Paramillo is a massif located in Colombia. The original author of this spreadsheet named each version after a geographical feature of their country, Argentina. I've followed suit, using names from my country. (Aconcagua, Bonete Chico, Chuscha, Calinga, Colangüil and Piltriquitrón for 1.3, 1.4, 1.8.3, 1.8.5, 1.8.6 and 1.9 respectively).
                </p>
            </li>
            <li class="mt-4">
                <p>
                <b>&bull; <em>"Hey, Do I have to fill this myself? Really, I feel like an accountant!"</em></b> - Well, yeah. It will be that way till the day Blizz releases an API in the shape of something that works with Google Sheets or something like that. If you don't like it, webs like Overbuff and MasterOverwatch can track plenty of your stats without any input.
                </p>
            </li>
            <li class="mt-4">
                <p>
                <b>&bull; <em>"Hey, What kind of information does it provide that other available tools (such as Overbuff for example) don't?"</em></b> - A few seasons ago, u/WumpaWolfy provided an excellent answer to this question: 
                </p>
                <p class="mt-2 ml-3 text-slate-300">
                    I imagine using this chart would allow you to notice a bunch of patterns about your play you otherwise may have never realized, such as maybe your win rate tanks after midnight, rises after your first half hour, or that you have a horrible win rate defending Numbani point A as Reinhardt. In these cases changing when you play, how long you play (and warm up), and who you play and where can all be informed better with this method. Not to mention I find that taking notes and being so focused on improvement during a session can really help you see past just winning and losing to diagnose the real problems holding you back. 
                </p>
            </li>
            <li class="mt-4">
                <p>
                <b>&bull; <em>"Hey, Is there someplace where I could see the average SR gained/lost per hero?"</em></b> - You can either go to "Heroes" and see the values for every hero, or by going to "Hero Progression" you'll be able to select the hero you're interested in, and see the average SR won/lost on the top right corner. There's also a little graph that will show you the evolution of that stat.
                </p>
            </li>
        </ul>
    </div>
</section>
<script>
    const toggleButton = document.getElementById('toggleButton');
    const listContainer = document.getElementById('listContainer');

    toggleButton.addEventListener('click', () => {
        listContainer.classList.toggle('hidden');
    });
</script>

@endsection
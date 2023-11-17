@extends('layouts.home') @section('content')
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
<section class="text-center sm:text-left text-sm max-w-4xl m-auto">
    <div class="mt-10 pb-2 border-b-2 border-dashed sm:mt-16">
        <h2 class="font-normal text-2xl fjalla sm:text-3xl">
            Tiers, Map Type, Maps, Counters and Synergies:
        </h2>
        <p class="mt-3 sm:text-lg">
            <b
                ><a
                    href="https://heropicker.com/"
                    class="underline decoration-amber-400"
                    >Hero Picker</a
                ></b
            >
            was the first source for this picker before, but right now the page
            has my own data and ideas about interactions in the game.
        </p>
    </div>
    <div class="mt-10 pb-2 border-b-2 border-dashed">
        <h2 class="font-normal text-2xl fjalla sm:text-3xl">Tiers:</h2>
        <p class="sm:text-lg">
            I create a tier list based in the
            <b
                ><a
                    href="https://www.overbuff.com/heroes"
                    class="underline decoration-amber-400"
                    >Overbuff</a
                ></b
            >
            stats, this tiers are adjusted taking into consideration the win
            rate and the pick rate.
        </p>
        <p class="sm:text-lg">
            I use the
            <b
                ><a
                    href="https://t500-aggregator.aryankothari.dev/"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="underline decoration-amber-400"
                    >Top 500 Agregator</a
                ></b
            >
            tool to get the top 500 pickrate and best heroes played in the top
            500 ranking.
        </p>
        <p class="sm:text-lg">
            I check the tierlists created from top500 players like
            <b
                ><a
                    href="https://www.youtube.com/@KarQ"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="underline decoration-amber-400"
                    >KarQ</a
                ></b
            >,
            <b
                ><a
                    href="https://www.youtube.com/@Flats_OW"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="underline decoration-amber-400"
                    >Flats</a
                ></b
            >,
            <b
                ><a
                    href="https://www.youtube.com/@YourOverwatch"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="underline decoration-amber-400"
                    >Freedo</a
                ></b
            >,
            <b
                ><a
                    href="https://www.youtube.com/@Kajor1"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="underline decoration-amber-400"
                    >Kajor</a
                ></b
            >,
            <b
                ><a
                    href="https://www.youtube.com/@Toniki"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="underline decoration-amber-400"
                    >Toniki</a
                ></b
            >
            , and Others
        </p>
    </div>
    <div class="mt-10 pb-2 border-b-2 border-dashed mb-10 sm:mb-14">
        <h2 class="font-normal text-2xl fjalla sm:text-3xl">
            Synergies & Counters::
        </h2>
        <p class="sm:text-lg">
            <b
                ><a
                    href="https://www.youtube.com/playlist?list=PLgRMcvKNkYFyD7RyWlNmvYF0NWcKei5z7"
                    class="underline decoration-amber-400"
                    >1 Tip for Every Hero Series</a
                ></b
            >
            made for KarQ, is a great inspiration to know counters for every
            hero in the game.
        </p>
        <p class="sm:text-lg">
            <b
                ><a
                    href="https://www.youtube.com/playlist?list=PLfv7DSFO1b69Kb4vzlakeE5MiGL3UKnSh"
                    class="underline decoration-amber-400"
                    >Thought Process Series</a
                ></b
            >
            made for SVB have great ideas about what heroes are good with others
            and also help me knowing other counters.
        </p>
        <p class="sm:text-lg">
            <b
                ><a
                    href="https://docs.google.com/document/d/11_VDsXLCrBwogQLaXgoNNbNel3kQkZ6txfT81H7iau0/edit?usp=sharing"
                    class="underline decoration-amber-400"
                    >A List on All Existing Compositions in Overwatch</a
                ></b
            >
            made for Shielder_OW, is a good summary of many of the game's most
            important compositions in the game.
        </p>
        <p class="sm:text-lg">
            <b
                ><a
                    href="https://www.youtube.com/watch?v=WfLzVVsHUGI&list=PLxTGkfX26YAguJHHTDFqwuwqLPzBqKXOh"
                    class="underline decoration-amber-400"
                    >KarQ Tier Lists</a
                ></b
            >, KarQ made a lot of informal Tierlist about sinergies and counters
            that I take in consideration
        </p>
        <p class="sm:text-lg">
            I'm also inspired for coaches and game theorycrafters like
            <b
                ><a
                    href="https://www.youtube.com/c/StormcrowProductions"
                    class="underline decoration-amber-400"
                    >Spillo</a
                ></b
            >,
            <b
                ><a
                    href="https://www.youtube.com/@Kajor1/"
                    class="underline decoration-amber-400"
                    >Kajor</a
                ></b
            >,
            <b
                ><a
                    href="https://www.youtube.com/@YourOverwatch"
                    class="underline decoration-amber-400"
                    >Freedo</a
                ></b
            >
            and others
        </p>
    </div>
</section>
@endsection

/*
All this code is copyright Autopoietico, 2023.
    -This code includes a bit of snippets found on stackoverflow.com and others
I'm not a javascript expert, I use this project to learn how to code, and how to design web pages, is a funny hobby to do, but if I
gain something in the process is a plus.
Feel free to alter this code to your liking, but please do not re-host it, do not profit from it and do not present it as your own.
*/

import {
    TIER_MIN,
    COUNTER_WEIGHT,
    MIN_COUNTER_VALUE,
    SINERGY_WEIGHT,
    MIN_SINERGY_VALUE,
    MAPAD_WEIGHT,
    MIN_MAPAD_VALUE,
} from "../utils/constants.js";

//Model of every Tier
class ModelTier {
    constructor(heroTier) {
        this.name = heroTier["name"];
        this.heroTiers = heroTier["hero-tiers"];
    }

    findScore(heroName) {
        if (this.heroTiers[heroName]) {
            return this.heroTiers[heroName];
        } else {
            return 0;
        }
    }
}

export default ModelTier;

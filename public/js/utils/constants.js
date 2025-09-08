/*
All this code is copyright Autopoietico, 2023.
    -This code includes a bit of snippets found on stackoverflow.com and others
I'm not a javascript expert, I use this project to learn how to code, and how to design web pages, is a funny hobby to do, but if I
gain something in the process is a plus.
Feel free to alter this code to your liking, but please do not re-host it, do not profit from it and do not present it as your own.
*/

const LASTUPDATE = "2025-07-10";

//////////////////////
// Miscelaneus
//////////////////////

const getSelectValue = function (name) {
    //https://stackoverflow.com/a/544877 changing to lowcase and changing spaces to '-'
    let selectValue = name.replace(/\s+/g, "-");
    return selectValue.toLowerCase();
};

//////////////////////
// Miscelaneus
//////////////////////

const TIER_MIN = 5;
const COUNTER_WEIGHT = 1 / 5;
const MIN_COUNTER_VALUE = 4;
const SINERGY_WEIGHT = 1 / 2;
const MIN_SINERGY_VALUE = 10;
const MAPAD_WEIGHT = 1 / 2;
const MIN_MAPAD_VALUE = 45;

//////////////////////
// API METHODS
//////////////////////

const API_URL = "https://api.overpicker.com/";

//subdirectory link in the API.
const JSON_URL = {
    mapInfo: "map-info",
    mapTypes: "map-type",
    heroInfo: "hero-info",
    heroIMG: "hero-img",
    heroTiers: "hero-tiers",
    heroCounters: "hero-counters",
    heroSynergies: "hero-synergies",
    heroMaps: "hero-maps",
    heroADC: "hero-adc",
    version: "version",
};

export {
    LASTUPDATE,
    getSelectValue,
    TIER_MIN,
    COUNTER_WEIGHT,
    MIN_COUNTER_VALUE,
    SINERGY_WEIGHT,
    MIN_SINERGY_VALUE,
    MAPAD_WEIGHT,
    MIN_MAPAD_VALUE,
    API_URL,
    JSON_URL,
};

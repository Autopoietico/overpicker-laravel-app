/*
All this code is copyright Autopoietico, 2023.
    -This code includes a bit of snippets found on stackoverflow.com and others
I'm not a javascript expert, I use this project to learn how to code, and how to design web pages, is a funny hobby to do, but if I
gain something in the process is a plus.
Feel free to alter this code to your liking, but please do not re-host it, do not profit from it and do not present it as your own.
*/

const LASTUPDATE = "2025-03-16";

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

class ModelAPI {
    constructor() {
        //This are temporary data savers before the model take the data from the API.
        this.mapInfo = JSON.parse(localStorage.getItem("mapInfo")) || [];
        this.mapTypes = JSON.parse(localStorage.getItem("mapTypes")) || [];
        this.heroTiers = JSON.parse(localStorage.getItem("heroTiers")) || [];
        this.heroInfo = JSON.parse(localStorage.getItem("heroInfo")) || [];
        this.heroIMG = JSON.parse(localStorage.getItem("heroIMG")) || [];
        this.heroCounters =
            JSON.parse(localStorage.getItem("heroCounters")) || [];
        this.heroSynergies =
            JSON.parse(localStorage.getItem("heroSynergies")) || [];
        this.heroMaps = JSON.parse(localStorage.getItem("heroMaps")) || [];
        this.heroADC = JSON.parse(localStorage.getItem("heroADC")) || [];
        this.version = JSON.parse(localStorage.getItem("version")) || [];

        //This a temporal solution to fixing the charging of incorrect info to adc data
        if (!this.heroADC["Ana"]) {
            console.log(
                "Trying to clearing incorrect data in the local storage"
            );
            localStorage.clear();
        }
    }

    loadLocalStorage(model) {
        //If local storage data is aviable these is loaded in the model
        if (Object.keys(this.mapInfo).length) {
            model.buildMapPool();
        }

        if (Object.keys(this.mapTypes).length) {
            model.loadMapTypes();
        }

        if (Object.keys(this.heroTiers).length) {
            model.loadHeroTiers();
        }

        if (
            Object.keys(this.heroTiers).length &&
            Object.keys(this.heroInfo).length &&
            Object.keys(this.heroIMG).length &&
            Object.keys(this.heroCounters).length &&
            Object.keys(this.heroSynergies).length &&
            Object.keys(this.heroMaps).length &&
            Object.keys(this.heroADC).length
        ) {
            model.loadHeroDataForTeams();
        }
    }

    loadAPIJSON(apiURL, jsonURL, model, controller) {
        //This charge the data from the API one by one and load them in the model
        fetch(apiURL + jsonURL["mapInfo"])
            .then((res) => res.json())
            .then((data) => {
                this.mapInfo = {
                    ...data,
                };

                model.buildMapPool();

                localStorage.setItem("mapInfo", JSON.stringify(this.mapInfo));
                return fetch(apiURL + jsonURL["mapTypes"]);
            })
            .then((res) => res.json())
            .then((data) => {
                this.mapTypes = {
                    ...data,
                };

                model.loadMapTypes();

                localStorage.setItem("mapTypes", JSON.stringify(this.mapTypes));
                return fetch(apiURL + jsonURL["heroTiers"]);
            })
            .then((res) => res.json())
            .then((data) => {
                this.heroTiers = {
                    ...data,
                };

                model.loadHeroTiers();

                localStorage.setItem(
                    "heroTiers",
                    JSON.stringify(this.heroTiers)
                );
                return fetch(apiURL + jsonURL["heroInfo"]);
            })
            .then((res) => res.json())
            .then((data) => {
                this.heroInfo = {
                    ...data,
                };

                localStorage.setItem("heroInfo", JSON.stringify(this.heroInfo));
                return fetch(apiURL + jsonURL["heroIMG"]);
            })
            .then((res) => res.json())
            .then((data) => {
                this.heroIMG = {
                    ...data,
                };

                localStorage.setItem("heroIMG", JSON.stringify(this.heroIMG));
                return fetch(apiURL + jsonURL["heroCounters"]);
            })
            .then((res) => res.json())
            .then((data) => {
                this.heroCounters = {
                    ...data,
                };

                localStorage.setItem(
                    "heroCounters",
                    JSON.stringify(this.heroCounters)
                );
                return fetch(apiURL + jsonURL["heroSynergies"]);
            })
            .then((res) => res.json())
            .then((data) => {
                this.heroSynergies = {
                    ...data,
                };

                localStorage.setItem(
                    "heroSynergies",
                    JSON.stringify(this.heroSynergies)
                );
                return fetch(apiURL + jsonURL["heroMaps"]);
            })
            .then((res) => res.json())
            .then((data) => {
                this.heroMaps = {
                    ...data,
                };

                localStorage.setItem("heroMaps", JSON.stringify(this.heroMaps));
                return fetch(apiURL + jsonURL["heroADC"]);
            })
            .then((res) => res.json())
            .then((data) => {
                this.heroADC = {
                    ...data,
                };

                model.loadHeroDataForTeams();

                localStorage.setItem("heroADC", JSON.stringify(this.heroADC));
                return fetch(apiURL + jsonURL["version"]);
            })
            .then((res) => res.json())
            .then((data) => {
                this.version = {
                    ...data,
                };

                localStorage.setItem("version", JSON.stringify(this.version));
                controller.reloadControllerModel(this.version);
            });
    }

    findElement(jsonOBJ, name, valueName) {
        //Find the position for a element in a JSON, based in the name of the element, and return the desire value

        for (let jO in jsonOBJ) {
            if (jsonOBJ[jO]["name"] == name) {
                return jsonOBJ[jO][valueName];
            }
        }

        return "";
    }
}

//////////////////////
// Model Elements
//////////////////////

class ModelTier {
    //Model of every Tier
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

class ModelMapType {
    //Model of the type of point
    constructor(mapTypeData) {
        this.name = mapTypeData["name"];
        this.pointsType = mapTypeData["internal_type"];
    }

    getType(point) {
        this.pointsType[point];
    }

    getPointsLenght() {
        return this.pointsType.length;
    }
}

class ModelMap {
    //Model of every map
    constructor(mapData) {
        this.name = mapData["name"];
        this.type = mapData["type"];
        this.onPool = mapData["onPool"];
        this.points = mapData["points"];
    }
}

class ModelHero {
    //Model of every hero
    constructor(heroData) {
        this.name = heroData["name"];
        this.generalRol = heroData["general_rol"];
        this.nicks = heroData["nicks"];
        this.onRotation = heroData["on_rotation"];
        this.IMG = [];

        this.tiers = [];
        this.counters = []; //This are the heroes that are countered by this hero
        this.synergies = []; //This are the heroes that have sinergy with your hero
        this.maps = [];
        this.adc = [];

        this.value = 0;
        this.echoValue = 0;

        this.selected = false;
        this.filtered = false;
    }

    addIMG(IMGUrl, type) {
        //The type define the type of img we want, normally white, but probably a "Echo" type, a SVG or a black type
        this.IMG[type] = new Image();
        this.IMG[type].src = IMGUrl;
    }

    addTier(tierName, tierScore) {
        this.tiers[tierName] = tierScore;
    }

    addCounters(counters) {
        this.counters = counters[this.name];
    }

    addSynergies(synergies) {
        this.synergies = synergies[this.name];
    }
    addMaps(maps) {
        let heroMaps = maps[this.name];

        //Hard coded because of things
        for (let mt in heroMaps) {
            this.maps[mt] = heroMaps[mt];
        }
    }

    addADC(adc) {
        let heroADC = adc[this.name];

        for (let mt in heroADC) {
            this.adc[mt] = heroADC[mt];
        }
    }

    getIMG(type) {
        return this.IMG[type];
    }

    getSinergyValue(alliedHeroes, isWeighted, isEchoValue) {
        let sinergyValue = 0;

        for (let ah in alliedHeroes) {
            let alliedHero = alliedHeroes[ah];

            if (alliedHero != this.name && !isEchoValue) {
                if (isWeighted) {
                    sinergyValue +=
                        this.synergies[alliedHero] * SINERGY_WEIGHT +
                        MIN_SINERGY_VALUE;
                } else {
                    sinergyValue += this.synergies[alliedHero];
                }
            } else if (isEchoValue && alliedHero != "Echo") {
                //With Echo can happen that a team can have the same two heroes at the same time for a moment
                //Also Echo can't have sinergy with herself
                if (isWeighted) {
                    sinergyValue +=
                        this.synergies[alliedHero] * SINERGY_WEIGHT +
                        MIN_SINERGY_VALUE;
                } else {
                    sinergyValue += this.synergies[alliedHero];
                }
            }
        }

        return sinergyValue;
    }

    getCounterValue(enemyHeroes, isWeighted) {
        let counterValue = 0;

        for (let eh in enemyHeroes) {
            let enemyHero = enemyHeroes[eh];

            if (isWeighted) {
                counterValue +=
                    this.counters[enemyHero] * COUNTER_WEIGHT +
                    MIN_COUNTER_VALUE;
            } else {
                counterValue += this.counters[enemyHero];
            }
        }

        return counterValue;
    }

    calcScore(
        tier,
        map,
        point,
        adc,
        pointType,
        alliedHeroes,
        enemyHeroes,
        isWeighted
    ) {
        this.value = 0;

        if (map != "None") {
            if (isWeighted) {
                this.value +=
                    this.maps[adc][map][point] * MAPAD_WEIGHT + MIN_MAPAD_VALUE; //Point Value
            } else {
                this.value += this.maps[adc][map][point]; //Point Value
            }
        }

        if (adc != "None" && pointType != "None") {
            if (pointType == "Control" || pointType == "Flashpoint") {
                if (isWeighted) {
                    this.value +=
                        this.adc[pointType] * MAPAD_WEIGHT + MIN_MAPAD_VALUE; //Control or Flashpoint Value
                } else {
                    this.value += this.adc[pointType]; //Control or Flashpoint Value
                }
            } else if (pointType == "Push") {
                if (isWeighted) {
                    this.value +=
                        this.adc[adc][point] * MAPAD_WEIGHT + MIN_MAPAD_VALUE; //Push Value
                } else {
                    this.value += this.adc[adc][point]; //Push Value
                }
            } else {
                if (isWeighted) {
                    this.value +=
                        this.adc[adc][pointType][point] * MAPAD_WEIGHT +
                        MIN_MAPAD_VALUE; //Attack-Deffense-Control Value
                } else {
                    this.value += this.adc[adc][pointType][point]; //Attack-Deffense-Control Value
                }
            }
        }

        this.value += this.getSinergyValue(alliedHeroes, isWeighted); //Synergies Values
        this.value += this.getCounterValue(enemyHeroes, isWeighted); //Counters Values

        if (tier != "None") {
            if (isWeighted) {
                this.value += this.tiers[tier] + TIER_MIN; //Tier Value + Min Value
            } else {
                this.value += this.tiers[tier]; //Tier Value
            }
        }
    }

    calcEchoScore(
        tier,
        map,
        point,
        adc,
        pointType,
        alliedHeroes,
        enemyHeroes,
        isWeighted
    ) {
        let isEchoValue = true;

        this.echoValue = 0;

        if (this.name != "Echo" && this.selected) {
            if (map != "None") {
                if (isWeighted) {
                    this.echoValue +=
                        this.maps[adc][map][point] * MAPAD_WEIGHT +
                        MIN_MAPAD_VALUE; //Point Value
                } else {
                    this.echoValue += this.maps[adc][map][point]; //Point Value
                }
            }

            if (adc != "None" && pointType != "None") {
                if (pointType == "Control" || pointType == "Flashpoint") {
                    if (isWeighted) {
                        this.echoValue +=
                            this.adc[pointType] * MAPAD_WEIGHT +
                            MIN_MAPAD_VALUE; //Control or Flashpoint Value
                    } else {
                        this.echoValue += this.adc[pointType]; //Control or Flashpoint Value
                    }
                } else if (pointType == "Push") {
                    if (point == "Ally") {
                        point = "Enemy";
                    } else {
                        point = "Ally";
                    }

                    if (isWeighted) {
                        this.echoValue +=
                            this.adc[adc][point] * MAPAD_WEIGHT +
                            MIN_MAPAD_VALUE; //Push Value
                    } else {
                        this.echoValue += this.adc[adc][point]; //Push Value
                    }
                } else {
                    if (isWeighted) {
                        this.echoValue +=
                            this.adc[adc][pointType][point] * MAPAD_WEIGHT +
                            MIN_MAPAD_VALUE; //Attack-Deffense-Control Value
                    } else {
                        this.echoValue += this.adc[adc][pointType][point]; //Attack-Deffense-Control Value
                    }
                }
            }

            this.echoValue += this.getSinergyValue(
                enemyHeroes,
                isWeighted,
                isEchoValue
            ); //Synergie Values but with enemy heroes for echo targets
            this.echoValue += this.getCounterValue(alliedHeroes, isWeighted); //Counter Values but with allied heroes for echo targets

            if (tier != "None") {
                if (isWeighted) {
                    this.echoValue += this.tiers[tier] + TIER_MIN; //Tier Value + Min Value
                } else {
                    this.echoValue += this.tiers[tier]; //Tier Value
                }
            }
        } else if (this.name == "Echo") {
            this.echoValue = -20;
        }
    }
}

class ModelTeam {
    constructor(name) {
        this.name = name;
        this.value = 0;
        this.heroes = [];
        this.selectedHeroes = [];
        this.hasEcho = false;
        this.bestCopyHeroes = [];
    }

    loadHeroes(heroInfo) {
        //This function build an array with all the heroes of the game for the team.
        //Is important to have all the heroes loaded before we make all the calcs, all the heroes despite
        //not been selected need his own score.
        let allHeroes = [];

        for (let h in heroInfo) {
            allHeroes[heroInfo[h].name] = new ModelHero(heroInfo[h]);
        }

        this.heroes = allHeroes;
    }

    loadHeroIMG(APIData) {
        for (let h in this.heroes) {
            let whiteURL = APIData.findElement(
                APIData.heroIMG,
                this.heroes[h].name,
                "white-img"
            );
            let echoURL = APIData.findElement(
                APIData.heroIMG,
                this.heroes[h].name,
                "white-echo-img"
            );
            let profileURL = APIData.findElement(
                APIData.heroIMG,
                this.heroes[h].name,
                "profile-img"
            );
            let profEchoURL = APIData.findElement(
                APIData.heroIMG,
                this.heroes[h].name,
                "profile-echo-img"
            );
            let artURL = APIData.findElement(
                APIData.heroIMG,
                this.heroes[h].name,
                "art-img"
            );
            let artEchoURL = APIData.findElement(
                APIData.heroIMG,
                this.heroes[h].name,
                "art-echo-img"
            );
            let sideURL = APIData.findElement(
                APIData.heroIMG,
                this.heroes[h].name,
                "side-img"
            );
            let sideEchoURL = APIData.findElement(
                APIData.heroIMG,
                this.heroes[h].name,
                "side-echo-img"
            );

            this.heroes[h].addIMG(whiteURL, "white-img");
            this.heroes[h].addIMG(echoURL, "white-echo-img");
            this.heroes[h].addIMG(profileURL, "profile-img");
            this.heroes[h].addIMG(profEchoURL, "profile-echo-img");
            this.heroes[h].addIMG(artURL, "art-img");
            this.heroes[h].addIMG(artEchoURL, "art-echo-img");
            this.heroes[h].addIMG(sideURL, "side-img");
            this.heroes[h].addIMG(sideEchoURL, "side-echo-img");
        }
    }

    loadHeroTiers(tiers) {
        for (let h in this.heroes) {
            for (let t in tiers) {
                let heroName = this.heroes[h].name;
                let tierName = tiers[t].name;
                let tierScore = tiers[t].findScore(heroName);

                this.heroes[h].addTier(tierName, tierScore);
            }
        }
    }

    loadHeroCounters(APIData) {
        for (let h in this.heroes) {
            this.heroes[h].addCounters(APIData.heroCounters);
        }
    }

    loadHeroSynergies(APIData) {
        for (let h in this.heroes) {
            this.heroes[h].addSynergies(APIData.heroSynergies);
        }
    }

    loadHeroMaps(APIData) {
        for (let h in this.heroes) {
            this.heroes[h].addMaps(APIData.heroMaps);
        }
    }

    loadHeroADC(APIData) {
        for (let h in this.heroes) {
            this.heroes[h].addADC(APIData.heroADC);
        }
    }

    getHero(hero) {
        return this.heroes[hero];
    }

    getRoleAmount(role) {
        let amount = 0;

        for (let h in this.heroes) {
            let heroRole = this.heroes[h].generalRol;
            let selected = this.heroes[h].selected;

            if (role == heroRole && selected) {
                amount++;
            }
        }

        return amount;
    }

    selectHero(hero) {
        this.selectedHeroes.push(hero);

        this.heroes[hero].selected = true;
    }

    unselectAllHeroes() {
        this.selectedHeroes = [];
        for (let h in this.heroes) {
            this.heroes[h].selected = false;
        }
    }

    resetValues() {
        this.value = 0;

        for (let h in this.heroes) {
            this.heroes[h].value = 0;
        }
    }

    resetEchoValues() {
        for (let h in this.heroes) {
            this.heroes[h].echoValue = 0;
        }
    }

    calcScores(tier, map, point, adc, pointType, enemyHeroes, isWeighted) {
        let alliedHeroes = this.selectedHeroes;

        this.resetValues();

        for (let h in this.heroes) {
            let isHeroSelected = this.heroes[h].selected;

            this.heroes[h].calcScore(
                tier,
                map,
                point,
                adc,
                pointType,
                alliedHeroes,
                enemyHeroes,
                isWeighted
            );

            if (isHeroSelected) {
                this.value += this.heroes[h].value;
            }
        }
    }

    calcEchoScores(tier, map, point, adc, pointType, enemyHeroes, isWeighted) {
        let alliedHeroes = this.selectedHeroes;

        this.resetEchoValues();

        for (let h in this.heroes) {
            let isHeroSelected = this.heroes[h].selected;

            if (isHeroSelected) {
                this.heroes[h].calcEchoScore(
                    tier,
                    map,
                    point,
                    adc,
                    pointType,
                    alliedHeroes,
                    enemyHeroes,
                    isWeighted
                );
            }
        }
    }

    checkEcho() {
        this.hasEcho = false;

        for (let sh in this.selectedHeroes) {
            if (this.selectedHeroes[sh] == "Echo") {
                this.hasEcho = true;
            }
        }
    }

    checkBestEchoCopy() {
        this.bestCopyHeroes = [];
        let bestEchoValue = -20;

        for (let h in this.heroes) {
            let echoValue = this.heroes[h].echoValue;
            let selected = this.heroes[h].selected;

            if (echoValue >= bestEchoValue && selected) {
                bestEchoValue = echoValue;
            }
        }

        if (bestEchoValue > -20) {
            for (let h in this.heroes) {
                let echoValue = this.heroes[h].echoValue;
                if (bestEchoValue == echoValue) {
                    this.bestCopyHeroes.push(h);
                }
            }
        }
    }

    filterHero(nick) {
        nick = nick.toLowerCase();

        for (let h in this.heroes) {
            let nicks = this.heroes[h].nicks;

            //Make easy to find the hero nick forcing all to be lowercase
            nicks = nicks.map(function (nick) {
                return nick.toLowerCase();
            });

            let found = nicks.find((element) => element == nick);

            if (found) {
                this.heroes[h].filtered = true;
            } else {
                this.heroes[h].filtered = false;
            }
        }
    }

    isRoleFiltered(role) {
        //Check if Hero is filtered and avoid cleaning the role that don't belongs to the hero
        let isFiltered = false;

        for (let h in this.heroes) {
            let hero = this.heroes[h];

            if (hero.filtered && hero.generalRol == role) {
                return !isFiltered;
            }
        }
    }

    getSortedHeroesNameperValue() {
        let sortedHeroesNames = [];

        for (let h in this.heroes) {
            sortedHeroesNames.push([h, this.heroes[h].value]);
        }

        sortedHeroesNames.sort(function (a, b) {
            return b[1] - a[1];
        });

        return sortedHeroesNames;
    }
}

class ModelOverPiker {
    constructor() {
        //Panel Select Consts
        this.ROLE_LOCK = 0;
        this.TIER_MODE = 1;
        this.FIVE_VS_FIVE = 2;
        this.MAP_POOLS = 3;
        this.HERO_ROTATION = 4;
        this.WEIGHTED_SCORES = 5;

        //General
        this.APIData = new ModelAPI();

        this.maps = [];
        this.mapTypes = [];
        this.tiers = [];

        this.mapLength = 0;

        this.teams = {
            Blue: new ModelTeam("Blue"),
            Red: new ModelTeam("Red"),
        };

        this.checkDate();

        this.panelOptions =
            JSON.parse(localStorage.getItem("panelOptions")) ||
            this.buildPanelOptions();

        //Hiden Options panel state
        this.gearOptionsState = false;

        this.checkFullOptions();

        this.panelSelections =
            JSON.parse(localStorage.getItem("panelSelections")) ||
            this.buildPanelSelections();

        this.checkTeamSize();
        this.checkHiddenState();

        //This map the size of the teams and the heroes selected in the team panel, initial selection is "None" for all heroes and 5v5
        this.selectedHeroes = JSON.parse(
            localStorage.getItem("selectedHeroes")
        ) || [
            {
                team: "Blue",
                selectedHeroes: ["None", "None", "None", "None", "None"],
            },
            {
                team: "Red",
                selectedHeroes: ["None", "None", "None", "None", "None"],
            },
        ];

        //The pre-saved APIdata from localstorage are loaded first into the model before calling the API
        this.APIData.loadLocalStorage(this);
    }

    checkDate() {
        //To avoid problems with data previously stored in the local storage, we check the date of the last
        // update and clear the local storage if the date is different
        let savedDate = localStorage.getItem("savedDate");
        if (savedDate != LASTUPDATE) {
            localStorage.clear();
        }
        localStorage.setItem("savedDate", LASTUPDATE);
    }

    checkFullOptions() {
        if (!this.panelOptions[this.HERO_ROTATION]) {
            this.panelOptions[this.HERO_ROTATION] = {
                text: "Hero Rotation",
                id: `cb${getSelectValue("Hero Rotation")}`,
                state: true,
                hidden: true,
            };
        }
    }

    checkTeamSize() {
        //Make a general reset if localstorage is different to the actual teamsize
        let isFiveVsFive = this.panelOptions[this.FIVE_VS_FIVE].state;

        let tempSelectedHeroes = JSON.parse(
            localStorage.getItem("selectedHeroes")
        );

        if (tempSelectedHeroes) {
            let teamSize = tempSelectedHeroes[0].selectedHeroes.length;

            if (teamSize == 6 && isFiveVsFive) {
                localStorage.removeItem("selectedHeroes");
            } else if (teamSize == 5 && !isFiveVsFive) {
                localStorage.removeItem("selectedHeroes");
            }
        }
    }

    checkHiddenState() {
        if (!this.panelOptions[this.MAP_POOLS].hidden) {
            localStorage.removeItem("panelOptions");
            localStorage.removeItem("panelSelection");
            this.panelOptions = this.buildPanelOptions();
            this.panelSelections = this.buildPanelSelections();
        }

        if (!this.panelSelections[4]) {
            localStorage.removeItem("panelOptions");
            localStorage.removeItem("panelSelection");
            this.panelOptions = this.buildPanelOptions();
            this.panelSelections = this.buildPanelSelections();
        }
    }

    buildPanelOptions() {
        const panelOptions = [
            {
                text: "Role Lock",
                id: `cb${getSelectValue("Role Lock")}`,
                state: true,
                hidden: false,
            },
            {
                text: "Tier Mode",
                id: `cb${getSelectValue("Tier Mode")}`,
                state: true,
                hidden: false,
            },
            {
                text: "5Vs5",
                id: `cb${getSelectValue("5Vs5")}`,
                state: true,
                hidden: false,
            },
            {
                text: "Map Pools",
                id: `cb${getSelectValue("Map Pools")}`,
                state: true,
                hidden: true,
            },
            {
                text: "Hero Rotation",
                id: `cb${getSelectValue("Hero Rotation")}`,
                state: true,
                hidden: true,
            },
            {
                text: "Weighted Scores",
                id: `cb${getSelectValue("Weighted Scores")}`,
                state: false,
                hidden: true,
            },
        ];
        localStorage.setItem("panelOptions", JSON.stringify(panelOptions));
        return panelOptions;
    }

    buildPanelSelections() {
        const panelSelections = [
            {
                text: "Tier",
                id: getSelectValue("Tier") + "-select",
                selectedIndex: 0,
                class: "",
                options: ["None"],
                hidden: false,
            },
            {
                text: "Map",
                id: getSelectValue("Map") + "-select",
                selectedIndex: 0,
                class: "selection-map",
                options: ["None"],
                hidden: false,
            },
            {
                text: "Point",
                id: getSelectValue("Point") + "-select",
                selectedIndex: 0,
                class: "",
                options: ["None"],
                hidden: false,
            },
            {
                text: "A/D",
                id: getSelectValue("A/D") + "-select",
                selectedIndex: 0,
                class: "",
                options: ["None"],
                hidden: false,
            },
            {
                text: "Hero Icons",
                id: getSelectValue("Hero Icons") + "-select",
                selectedIndex: 0,
                class: "",
                options: ["Profile", "Art", "White", "Side"],
                hidden: true,
            },
        ];
        localStorage.setItem(
            "panelSelections",
            JSON.stringify(panelSelections)
        );
        return panelSelections;
    }

    buildMapPool() {
        this.maps = [];
        this.mapLength = 0;

        for (let m in this.APIData.mapInfo) {
            let mapName = this.APIData.mapInfo[m].name;
            this.maps[mapName] = new ModelMap(this.APIData.mapInfo[m]);
            this.mapLength++;
        }

        this.loadMapSelections();
    }

    loadMapTypes() {
        this.mapTypes = [];

        for (let mt in this.APIData.mapTypes) {
            let nameMapType = this.APIData.mapTypes[mt].name;
            this.mapTypes[nameMapType] = new ModelMapType(
                this.APIData.mapTypes[mt]
            );
        }
    }

    loadHeroDataForTeams() {
        //Data for every hero in every team
        for (let t in this.teams) {
            this.teams[t].loadHeroes(this.APIData.heroInfo);
            this.teams[t].loadHeroIMG(this.APIData);
            this.teams[t].loadHeroTiers(this.tiers);
            this.teams[t].loadHeroCounters(this.APIData);
            this.teams[t].loadHeroSynergies(this.APIData);
            this.teams[t].loadHeroMaps(this.APIData);
            this.teams[t].loadHeroADC(this.APIData);
        }

        this.loadSelectedHeroes();
    }

    loadHeroTiers() {
        this.tiers = [];

        for (let ht in this.APIData.heroTiers) {
            this.tiers.push(new ModelTier(this.APIData.heroTiers[ht]));
        }

        this.loadTiersSelections();
    }

    //This push the tiers to the panel selections
    loadTiersSelections() {
        if (this.tiers.length) {
            this.panelSelections[0].options = [];

            for (let t in this.tiers) {
                this.panelSelections[0].options.push(this.tiers[t].name);
            }

            if (
                this.panelSelections[0].selectedIndex >=
                this.panelSelections[0].options.length
            ) {
                this.panelSelections[0].selectedIndex = 0;
            }
        }
    }

    //This push the maps, the points and the A/D to the panel selections
    loadMapSelections() {
        if (this.mapLength) {
            this.panelSelections[1].options = ["None"];

            for (let m in this.maps) {
                let mapPoolsOn = this.panelOptions[this.MAP_POOLS].state;

                //Check map pools
                if (this.maps[m].onPool && mapPoolsOn) {
                    this.panelSelections[1].options.push(m);
                } else if (!mapPoolsOn) {
                    this.panelSelections[1].options.push(m);
                }
            }

            let panelMapsLength = this.panelSelections[1].options.length;

            //If maps are less and than before this fix the selected index position

            if (this.panelSelections[1].selectedIndex >= panelMapsLength) {
                this.panelSelections[1].selectedIndex = panelMapsLength - 1;
            }

            let selIndex = this.panelSelections[1].selectedIndex;

            this.panelSelections[2].options = ["None"];
            this.panelSelections[3].options = ["None"];

            if (selIndex) {
                const mapName = this.panelSelections[1].options[selIndex];
                let map = this.maps[mapName];

                this.panelSelections[2].options = [];

                for (let p in map.points) {
                    this.panelSelections[2].options.push(map.points[p]);
                }

                //I don't want to hard code this part, but is hard
                if (map.type == "Control") {
                    this.panelSelections[3].options = ["Control"];
                    this.panelSelections[3].selectedIndex = 0;
                } else if (map.type == "Flashpoint") {
                    this.panelSelections[3].options = ["Flashpoint"];
                    this.panelSelections[3].selectedIndex = 0;
                } else if (map.type == "Push") {
                    this.panelSelections[3].options = ["Push"];
                    this.panelSelections[3].selectedIndex = 0;
                } else if (map.type == "Clash") {
                    this.panelSelections[3].options = ["A-Team", "E-Team"];
                } else {
                    this.panelSelections[3].options = ["Attack", "Defense"];
                }
            }
        }
    }

    loadSelectedHeroes() {
        //This take the selected heroes in the Team Panel and then copy them in the Teams Models

        for (let team in this.teams) {
            this.teams[team].unselectAllHeroes();

            let selectedHeroesTeam = this.selectedHeroes.find(
                (element) => element.team == team
            );

            let selectedHeroes = selectedHeroesTeam.selectedHeroes;

            for (let selected in selectedHeroes) {
                if (selectedHeroes[selected] != "None") {
                    this.teams[team].selectHero(selectedHeroes[selected]);
                }
            }
        }

        this.calcTeamScores();
        this.checkEchoOnTeams();
    }

    calcTeamScores() {
        //We get the other selected values, map, point, etc
        let isTierSelected = this.panelOptions[this.TIER_MODE].state;
        let tier = "None";
        let map = "None";
        let point = "None";
        let adc = "None";
        let mapType = "None";
        let pointType = "None";
        let pointNumber = 0;
        let isWeighted = this.panelOptions[this.WEIGHTED_SCORES].state;

        map =
            this.panelSelections[1].options[
                this.panelSelections[1].selectedIndex
            ];
        adc =
            this.panelSelections[3].options[
                this.panelSelections[3].selectedIndex
            ];
        pointNumber = this.panelSelections[2].selectedIndex;

        if (map != "None") {
            mapType = this.maps[map].type;

            //The map type depend from the map, but also for the point (first point in Hybrid is assault)
            pointNumber = this.panelSelections[2].selectedIndex;
            pointType = this.mapTypes[mapType].pointsType[pointNumber];
        }

        point = this.panelSelections[2].options[pointNumber];

        //Even if a tier is selected we don't want to send it to the teams when the tier option is no selected
        if (isTierSelected) {
            tier =
                this.panelSelections[0].options[
                    this.panelSelections[0].selectedIndex
                ];
        }

        //Now we calculate scores for teams and their heroes
        this.teams["Blue"].calcScores(
            tier,
            map,
            point,
            adc,
            pointType,
            this.teams["Red"].selectedHeroes,
            isWeighted
        );
        this.teams["Red"].calcEchoScores(
            tier,
            map,
            point,
            adc,
            pointType,
            this.teams["Blue"].selectedHeroes,
            isWeighted
        );

        //When blue team attack, red team deffends and viceversa
        if (adc == "Attack") {
            this.teams["Red"].calcScores(
                tier,
                map,
                point,
                "Defense",
                pointType,
                this.teams["Blue"].selectedHeroes,
                isWeighted
            );
            this.teams["Blue"].calcEchoScores(
                tier,
                map,
                point,
                adc,
                pointType,
                this.teams["Red"].selectedHeroes,
                isWeighted
            );
        } else if (adc == "Defense") {
            this.teams["Red"].calcScores(
                tier,
                map,
                point,
                "Attack",
                pointType,
                this.teams["Blue"].selectedHeroes,
                isWeighted
            );
            this.teams["Blue"].calcEchoScores(
                tier,
                map,
                point,
                adc,
                pointType,
                this.teams["Red"].selectedHeroes,
                isWeighted
            );
        } else if (adc == "A-Team") {
            this.teams["Red"].calcScores(
                tier,
                map,
                point,
                "E-Team",
                pointType,
                this.teams["Blue"].selectedHeroes,
                isWeighted
            );
            this.teams["Blue"].calcEchoScores(
                tier,
                map,
                point,
                adc,
                pointType,
                this.teams["Red"].selectedHeroes,
                isWeighted
            );
        } else if (adc == "A-Team") {
            this.teams["Red"].calcScores(
                tier,
                map,
                point,
                "A-Team",
                pointType,
                this.teams["Blue"].selectedHeroes,
                isWeighted
            );
            this.teams["Blue"].calcEchoScores(
                tier,
                map,
                point,
                adc,
                pointType,
                this.teams["Red"].selectedHeroes,
                isWeighted
            );
        } else {
            this.teams["Red"].calcScores(
                tier,
                map,
                point,
                adc,
                pointType,
                this.teams["Blue"].selectedHeroes,
                isWeighted
            );
            this.teams["Blue"].calcEchoScores(
                tier,
                map,
                point,
                adc,
                pointType,
                this.teams["Red"].selectedHeroes,
                isWeighted
            );
        }
    }

    checkEchoOnTeams() {
        this.teams["Red"].checkEcho();
        this.teams["Blue"].checkEcho();

        this.teams["Red"].checkBestEchoCopy();
        this.teams["Blue"].checkBestEchoCopy();
    }

    bindOptionChanged(callback) {
        this.onOptionsChanged = callback;
    }

    bindOptionGearChanged(callback) {
        this.onGearStateChanged = callback;
    }

    bindSelectionsChanged(callback) {
        this.onSelectionsChanged = callback;
    }

    bindSelectedHeroesChanged(callback) {
        this.onSelectedHeroesChanged = callback;
    }

    _commitOptions(panelOptions, panelSelections, gearOptionsState) {
        //Save the changes of panelOptions on the local storage
        this.onOptionsChanged(panelOptions, panelSelections, gearOptionsState);
        localStorage.setItem("panelOptions", JSON.stringify(panelOptions));
    }

    _commitGearOptions(panelOptions, panelSelections, gearOptionsState) {
        //Save the changes of panelOptions on the local storage
        this.onGearStateChanged(
            panelOptions,
            panelSelections,
            gearOptionsState
        );
        localStorage.setItem(
            "gearOptionsState",
            JSON.stringify(gearOptionsState)
        );
    }

    _commitSelections(panelSelections, gearOptionsState) {
        //Save the changes of panelSelections on the local storage
        this.onSelectionsChanged(panelSelections, gearOptionsState);
        localStorage.setItem(
            "panelSelections",
            JSON.stringify(panelSelections)
        );
    }

    _commitSelectedHeroes(teams, selectedHeroes) {
        //Save the changes of Selected Heroes on the local storage
        this.onSelectedHeroesChanged(teams, selectedHeroes);
        localStorage.setItem("selectedHeroes", JSON.stringify(selectedHeroes));
    }

    //Flip the option panel
    toggleOptionPanel(id) {
        this.panelOptions = this.panelOptions.map((option) =>
            option.id === id
                ? {
                      text: option.text,
                      id: option.id,
                      state: !option.state,
                      hidden: option.hidden,
                  }
                : option
        );

        this._commitOptions(
            this.panelOptions,
            this.panelSelections,
            this.gearOptionsState
        );
    }

    toggleGearOptions() {
        this.gearOptionsState = !this.gearOptionsState;

        this._commitGearOptions(
            this.panelOptions,
            this.panelSelections,
            this.gearOptionsState
        );
    }

    //Selected option in the panel (Like map selections or icons) are saved here
    editSelected(id, newSelIndex) {
        //Adding +1 because this recieve an index, any index even zero
        if (id && newSelIndex + 1) {
            this.panelSelections = this.panelSelections.map((selector) =>
                selector.id === id
                    ? {
                          text: selector.text,
                          id: selector.id,
                          selectedIndex: newSelIndex,
                          class: selector.class,
                          options: selector.options,
                          hidden: selector.hidden,
                      }
                    : selector
            );
        }

        let map = "None";
        let mapType = "None";
        let pointNumber = 0;

        let mapSelectionLength = this.panelSelections[1].options.length;
        let selIndex = this.panelSelections[1].selectedIndex;

        if (selIndex >= mapSelectionLength) {
            selIndex = mapSelectionLength - 1;
        }

        map = this.panelSelections[1].options[selIndex];
        pointNumber = this.panelSelections[2].selectedIndex;

        if (map != "None") {
            //This avoid problems when maps have different amount of points
            mapType = this.maps[map].type;

            let points = this.mapTypes[mapType].getPointsLenght() - 1;

            if (points < pointNumber) {
                this.panelSelections[2].selectedIndex = points;
            }
        } else {
            this.panelSelections[2].selectedIndex = 0;
            this.panelSelections[3].selectedIndex = 0;
        }

        this.loadMapSelections();
        this._commitSelections(this.panelSelections, this.gearOptionsState);
    }

    filterHero(nick, team) {
        this.teams[team].filterHero(nick);
    }

    switchTeamSize() {
        this.selectedHeroes.forEach((team) => {
            if (
                this.panelOptions[this.FIVE_VS_FIVE].state &&
                team.selectedHeroes.length == 6
            ) {
                team.selectedHeroes.pop();
            } else if (
                !this.panelOptions[this.FIVE_VS_FIVE].state &&
                team.selectedHeroes.length == 5
            ) {
                team.selectedHeroes.push("None");
            }
        });

        this.loadSelectedHeroes();
        this._commitSelectedHeroes(this.teams, this.selectedHeroes);
    }

    editSelectedHeroes(team, hero, role) {
        //If Role Lock selected and role exists
        if (this.panelOptions[this.ROLE_LOCK].state && role) {
            //If Role Lock selected check amount of Tank, Damage and Supports to fill 1Tank-2Damage-2Supports or 2tanks if 6vs6
            let maxTanks = this.panelOptions[this.FIVE_VS_FIVE].state ? 0 : 1; //0 = 1 tank, 1 = 2 tanks

            if (
                this.teams[team].getRoleAmount(role) <= maxTanks &&
                role == "Tank"
            ) {
                this.selectedHeroes = this.selectedHeroes.map(function (
                    selector
                ) {
                    if (selector.team === team) {
                        let found = selector.selectedHeroes.indexOf(hero);

                        //-1 means they don't found the hero in the array of selectedHeroes
                        if (found == -1) {
                            let foundNone =
                                selector.selectedHeroes.indexOf("None");
                            if (foundNone != -1) {
                                selector.selectedHeroes[foundNone] = hero;
                            }
                        } else {
                            selector.selectedHeroes[found] = "None";
                        }

                        return selector;
                    } else {
                        return selector;
                    }
                });

                this.loadSelectedHeroes();
                this._commitSelectedHeroes(this.teams, this.selectedHeroes);
            }
            if (this.teams[team].getRoleAmount(role) <= 1 && role == "Damage") {
                this.selectedHeroes = this.selectedHeroes.map(function (
                    selector
                ) {
                    if (selector.team === team) {
                        let found = selector.selectedHeroes.indexOf(hero);

                        //-1 means they don't found the hero in the array of selectedHeroes
                        if (found == -1) {
                            let foundNone =
                                selector.selectedHeroes.indexOf("None");
                            if (foundNone != -1) {
                                selector.selectedHeroes[foundNone] = hero;
                            }
                        } else {
                            selector.selectedHeroes[found] = "None";
                        }

                        return selector;
                    } else {
                        return selector;
                    }
                });

                this.loadSelectedHeroes();
                this._commitSelectedHeroes(this.teams, this.selectedHeroes);
            }
            if (
                this.teams[team].getRoleAmount(role) <= 1 &&
                role == "Support"
            ) {
                this.selectedHeroes = this.selectedHeroes.map(function (
                    selector
                ) {
                    if (selector.team === team) {
                        let found = selector.selectedHeroes.indexOf(hero);

                        //-1 means they don't found the hero in the array of selectedHeroes
                        if (found == -1) {
                            let foundNone =
                                selector.selectedHeroes.indexOf("None");
                            if (foundNone != -1) {
                                selector.selectedHeroes[foundNone] = hero;
                            }
                        } else {
                            selector.selectedHeroes[found] = "None";
                        }

                        return selector;
                    } else {
                        return selector;
                    }
                });

                this.loadSelectedHeroes();
                this._commitSelectedHeroes(this.teams, this.selectedHeroes);
            }
        } else {
            this.selectedHeroes = this.selectedHeroes.map(function (selector) {
                if (selector.team === team) {
                    let found = selector.selectedHeroes.indexOf(hero);

                    //-1 means they don't found the hero in the array of selectedHeroes
                    if (found == -1) {
                        let foundNone = selector.selectedHeroes.indexOf("None");
                        if (foundNone != -1) {
                            selector.selectedHeroes[foundNone] = hero;
                        }
                    } else {
                        selector.selectedHeroes[found] = "None";
                    }

                    return selector;
                } else {
                    return selector;
                }
            });

            this.loadSelectedHeroes();
            this._commitSelectedHeroes(this.teams, this.selectedHeroes);
        }
    }
}

//////////////////////
// View Elements
//////////////////////

class ViewOverPiker {
    constructor() {
        //Base div
        this.calculator = this.getElement(".calculator");
        this.calculator.classList.add(
            "sm:grid",
            "sm:grid-cols-[minmax(0,_1fr)_32px_minmax(0,_1fr)]",
            "md:grid-cols-[minmax(0,_1fr)_64px_minmax(0,_1fr)]",
            "lg:grid-cols-[minmax(0,_1fr)_128px_minmax(0,_1fr)]",
            "sm:justify-between"
        );

        //Clear Selection
        this.clearSelection = this.createElement(
            "div",
            "selection-team-clear-all",
            "clear-all-values"
        );
        this.clearSelection.classList.add(
            "text-center",
            "underline",
            "cursor-pointer",
            "mt-2",
            "mb-5",
            "decoration-amber-400",
            "sm:col-span-3",
            "md:text-xl"
        );
        this.clearSelection.textContent = "Clear All";

        //Selection and Option Panels
        this.checkboxPanel = this.createElement(
            "div",
            "selection-checkbox-panel"
        );
        this.checkboxPanel.classList.add(
            "group",
            "grid",
            "grid-flow-row",
            "grid-cols-2",
            "justify-center",
            "sm:grid-flow-col",
            "sm:grid-cols-none",
            "sm:gap-x-1",
            "sm:text-xl",
            "sm:col-span-3",
            "md:gap-x-3",
            "md:text-2xl",
            "lg:gap-x-3.5",
            "lg:text-3xl"
        );

        this.selectionPanel = this.createElement("div", "selection-panel");
        this.selectionPanel.classList.add(
            "grid",
            "text-center",
            "mt-2",
            "mb-10",
            "lg:mt-3",
            "sm:grid-flow-col",
            "sm:justify-center",
            "sm:col-span-3",
            "md:text-xl",
            "lg:text-2xl"
        );

        this.teamSeparator = this.createElement("div");
        this.teamSeparator.classList.add(
            "my-10",
            "border-t-2",
            "sm:justify-self-center",
            "sm:my-0",
            "sm:border-t-0",
            "sm:border-r-2",
            "sm:row-[start_6_/_end_9]",
            "sm:invisible",
            "lg:visible"
        );

        //Team Scores
        this.blueTeamScore = this.createElement(
            "div",
            "heroes-selection-title-text",
            "blue-team-title-text"
        );
        this.blueTeamScore.classList.add(
            "text-2xl",
            "text-center",
            "md:text-left",
            "sm:col-start-1",
            "sm:col-end-2",
            "sm:row-start-4"
        );

        //Team Hero Selections
        this.teamBlueComposition = this.createElement(
            "div",
            "team-composition",
            "heroes-selected-blue"
        );
        this.teamBlueComposition.classList.add(
            "mt-2",
            "flex",
            "flex-wrap",
            "justify-center",
            "md:justify-start",
            "sm:col-start-1",
            "sm:col-end-2",
            "sm:row-start-5"
        );

        //Filters
        this.blueFilter = this.createElement(
            "div",
            "heroes-filter",
            "heroes-filter-blue",
            "hidden"
        );
        this.blueFilter.classList.add(
            "mt-5",
            "text-sm",
            "text-center",
            "sm:text-left",
            "sm:col-start-1",
            "sm:col-end-2",
            "sm:row-start-6"
        );

        //Hero per Rol Options
        this.blueTankRolSelection = this.createElement(
            "div",
            "rol-selection",
            "tank-selection-blue"
        );
        this.blueTankRolSelection.classList.add(
            "mt-5",
            "grid",
            "grid-flow-row",
            "content-start",
            "justify-items-center",
            "sm:justify-items-start",
            "sm:row-start-7"
        );

        this.blueDamageRolSelection = this.createElement(
            "div",
            "rol-selection",
            "damage-selection-blue"
        );
        this.blueDamageRolSelection.classList.add(
            "mt-5",
            "grid",
            "grid-flow-row",
            "content-start",
            "justify-items-center",
            "sm:justify-items-start",
            "sm:row-[start_7_]"
        );

        this.blueSupportRolSelection = this.createElement(
            "div",
            "rol-selection",
            "support-selection-blue"
        );
        this.blueSupportRolSelection.classList.add(
            "mt-5",
            "grid",
            "grid-flow-row",
            "content-start",
            "justify-items-center",
            "sm:justify-items-start",
            "sm:row-[start_8_]"
        );

        this.redTeamScore = this.createElement(
            "div",
            "heroes-selection-title-text",
            "red-team-title-text"
        );
        this.redTeamScore.classList.add(
            "enemy-team-direction",
            "text-2xl",
            "text-center",
            "md:text-right",
            "sm:col-start-3",
            "sm:col-end-4",
            "sm:row-start-4"
        );

        this.teamRedComposition = this.createElement(
            "div",
            "team-composition",
            "heroes-selected-red"
        );
        this.teamRedComposition.classList.add(
            "enemy-team-direction",
            "mt-2",
            "flex",
            "flex-wrap",
            "justify-center",
            "md:justify-end",
            "sm:col-start-3",
            "sm:col-end-4",
            "sm:row-start-5"
        );

        this.redFilter = this.createElement(
            "div",
            "heroes-filter",
            "heroes-filter-red"
        );
        this.redFilter.classList.add(
            "enemy-team-direction",
            "mt-5",
            "text-sm",
            "text-center",
            "sm:text-right",
            "sm:col-start-3",
            "sm:col-end-4",
            "sm:row-start-6"
        );

        this.blueSupportRolSelection.classList.add("rol-selection-support");
        this.redTankRolSelection = this.createElement(
            "div",
            "rol-selection",
            "tank-selection-red"
        );
        this.redTankRolSelection.classList.add(
            "mt-5",
            "grid",
            "grid-flow-row",
            "content-start",
            "justify-items-center",
            "sm:justify-items-end",
            "sm:row-start-7"
        );

        this.redTankRolSelection.classList.add("enemy-team-direction");
        this.redDamageRolSelection = this.createElement(
            "div",
            "rol-selection",
            "damage-selection-red"
        );
        this.redDamageRolSelection.classList.add(
            "mt-5",
            "grid",
            "grid-flow-row",
            "content-start",
            "justify-items-center",
            "sm:justify-items-end",
            "sm:row-[start_7_]"
        );

        this.redDamageRolSelection.classList.add("enemy-team-direction");
        this.redSupportRolSelection = this.createElement(
            "div",
            "rol-selection",
            "support-selection-red"
        );
        this.redSupportRolSelection.classList.add(
            "mt-5",
            "grid",
            "grid-flow-row",
            "content-start",
            "justify-items-center",
            "sm:justify-items-end",
            "sm:row-[start_8_]"
        );

        this.redSupportRolSelection.classList.add("rol-selection-support");
        this.redSupportRolSelection.classList.add("enemy-team-direction");

        this.calculator.append(this.clearSelection);

        this.calculator.append(this.checkboxPanel);
        this.calculator.append(this.selectionPanel);

        this.calculator.append(this.blueTeamScore);
        this.calculator.append(this.teamBlueComposition);
        this.calculator.append(this.blueFilter);
        this.calculator.append(this.blueTankRolSelection);
        this.calculator.append(this.blueDamageRolSelection);
        this.calculator.append(this.blueSupportRolSelection);

        this.calculator.append(this.teamSeparator);

        this.calculator.append(this.redTeamScore);
        this.calculator.append(this.teamRedComposition);
        this.calculator.append(this.redFilter);
        this.calculator.append(this.redTankRolSelection);
        this.calculator.append(this.redDamageRolSelection);
        this.calculator.append(this.redSupportRolSelection);

        this.displayFilters();
    }

    createElement(tag, className, id) {
        //This create a DOM element, the CSS class and the ID is optional

        const element = document.createElement(tag);

        if (className) {
            element.classList.add(className);
        }

        if (id) {
            element.id = id;
        }

        return element;
    }

    createHeroFigure(hero, team, value, heroIMG, notRound) {
        const figure = this.createElement("figure", "hero-value");

        figure.classList.add(
            "w-14",
            "text-center",
            "grid",
            "grid-flow-row",
            "items-baseline",
            "justify-center",
            "mx-0.5",
            "rounded-lg",
            "drop-shadow-lg",
            "sm:mx-1"
        );

        if (hero == "None") {
            figure.classList.add("no-hero-selected", "bg-color-text");

            const figcaption = this.createElement("figcaption");
            figcaption.classList.add("h-6");
            figcaption.textContent = "Empty";

            const img = this.createElement("img");
            img.classList.add("h-14", "justify-self-center");
            img.src = "images/assets/blank-hero.webp";
            img.alt = "Blank hero space";

            const border = this.createElement("div", "border-bottom-75");
            border.classList.add("border-b-2");

            figure.append(figcaption, img, "0", border);
        } else {
            figure.classList.add(
                "cursor-pointer",
                "group",
                "hover:bg-[#294452]",
                "hover:-translate-y-1"
            );

            figure.dataset.name = hero;
            figure.dataset.team = team;

            const figcaption = this.createElement("figcaption");
            figcaption.classList.add(
                "h-6",
                "justify-self-center",
                "rounded-t-lg",
                "group-hover:w-full",
                "group-hover:bg-white",
                "group-hover:text-black",
                "group-hover:poppins"
            );

            figcaption.textContent = hero;

            const img = heroIMG;
            img.classList.add("h-14", "justify-self-center");
            img.alt = hero + " icon";

            if (!notRound) {
                img.classList.add("rounded-t-lg");
            }

            figure.append(figcaption, img, value);
        }

        return figure;
    }

    getElement(selector) {
        //Get element from the DOM with the desire queryselector

        const element = document.querySelector(selector);

        return element;
    }

    createSingleOption(option, index) {
        //Label enclose the elements
        const optionLabel = this.createElement("label");
        optionLabel.classList.add("flex");

        if (index % 2 == 0) {
            optionLabel.classList.add("text-left");
        } else {
            optionLabel.classList.add(
                "text-right",
                "flex-row-reverse",
                "sm:text-left",
                "sm:flex-row"
            );
        }

        index++;

        const checkbox = this.createElement("input");
        checkbox.type = "checkbox";
        checkbox.checked = option.state;
        checkbox.id = option.id;

        const span = this.createElement("span");
        span.classList.add("mx-1");
        span.textContent = option.text;

        optionLabel.append(checkbox, span);

        return optionLabel;
    }

    createSingleSelect(selector) {
        const select = this.createElement("select", "", selector.id);
        select.classList.add(
            "bg-[#1C2E37]",
            "border",
            "border-white",
            "rounded-md",
            "sm:mr-0.5",
            "md:mr-1",
            "lg:mr-1.5"
        );

        selector.options.forEach((option) => {
            const optionElement = this.createElement("option");

            optionElement.value = getSelectValue(option);
            optionElement.textContent = option;

            select.append(optionElement);
        });

        select.selectedIndex = selector.selectedIndex;

        return select;
    }

    createSingleSelectSpan(selector) {
        //Add a special class for selectors that have long names
        const selectorSpan = this.createElement("span", selector.class);
        selectorSpan.classList.add("sm:mr-0.5", "md:mr-1", "lg:mr-1.5");

        //The text don't have a html label
        selectorSpan.classList.add("selection-span", "font-bold");
        selectorSpan.textContent = selector.text + ":";

        return selectorSpan;
    }

    getIMGandNotRound(
        iconOption,
        teams,
        team,
        hero,
        enemyEcho,
        bestCopyHeroes,
        notRoundParam
    ) {
        let IMGRound = [];
        let heroIMG;
        let notRound = notRoundParam;
        const iconOptionSelect = getSelectValue(iconOption) + "-img";
        const iconOptionEchoSelect = getSelectValue(iconOption) + "-echo-img";

        heroIMG = teams[team].heroes[hero].getIMG(iconOptionSelect);

        if (enemyEcho) {
            for (let bch in bestCopyHeroes) {
                if (bestCopyHeroes[bch] == hero) {
                    if (iconOption != "White") {
                        notRound = true;
                    }
                    const echoIMG =
                        teams[team].heroes[hero].getIMG(iconOptionEchoSelect);

                    if (echoIMG) {
                        heroIMG = echoIMG;
                    }
                }
            }
        }

        IMGRound["heroIMG"] = heroIMG;
        IMGRound["notRound"] = notRound;
        return IMGRound;
    }

    displayOptions(panelOptions, gearOptionsState) {
        while (this.checkboxPanel.firstChild) {
            this.checkboxPanel.removeChild(this.checkboxPanel.firstChild);
        }

        let index = 0;
        //Create panel options nodes
        panelOptions.forEach((option) => {
            //Check if is an hidden option
            if (!gearOptionsState && !option.hidden) {
                this.checkboxPanel.append(
                    this.createSingleOption(option, index)
                );
            } else if (gearOptionsState && option.hidden) {
                this.checkboxPanel.append(
                    this.createSingleOption(option, index)
                );
            }
        });

        //This show hidden options
        this.gearIcon = this.createElement("i");
        //Bootstrap Icons
        this.gearIcon.classList.add(
            "bi",
            "bi-gear-fill",
            "cursor-pointer",
            "px-1",
            "rounded-lg"
        );

        if (gearOptionsState) {
            this.gearIcon.classList.add("bg-[#294452]", "border");
        }
        this.checkboxPanel.append(this.gearIcon);
    }

    displaySelections(panelSelections, gearOptionsState) {
        while (this.selectionPanel.firstChild) {
            this.selectionPanel.removeChild(this.selectionPanel.firstChild);
        }

        //Create panel selection nodes
        panelSelections.forEach((selector) => {
            //Check if is an hidden selection
            if (!gearOptionsState && !selector.hidden) {
                this.selectionPanel.append(
                    this.createSingleSelectSpan(selector)
                );
                this.selectionPanel.append(this.createSingleSelect(selector));
            } else if (gearOptionsState && selector.hidden) {
                this.selectionPanel.append(
                    this.createSingleSelectSpan(selector)
                );
                this.selectionPanel.append(this.createSingleSelect(selector));
            }
        });
    }

    displayTeamScores(teams) {
        while (this.blueTeamScore.firstChild) {
            this.blueTeamScore.removeChild(this.blueTeamScore.firstChild);
        }

        while (this.redTeamScore.firstChild) {
            this.redTeamScore.removeChild(this.redTeamScore.firstChild);
        }

        //Team Titles and Score
        const blueTitleStrong = this.createElement("strong", "ally-team");
        blueTitleStrong.classList.add("text-sky-600");
        blueTitleStrong.textContent = "Ally Team";

        const teamBlueScoreSeparator = this.createElement(
            "span",
            "heroes-selection-title-separator"
        );
        teamBlueScoreSeparator.textContent = " - ";

        const teamBlueScoreSpan = this.createElement(
            "span",
            "",
            "value-team-blue"
        );
        teamBlueScoreSpan.textContent = "Score " + teams["Blue"].value;

        const redTitleStrong = this.createElement("strong", "enemy-team");
        redTitleStrong.classList.add("text-red-600");

        redTitleStrong.textContent = "Enemy Team";

        const teamRedScoreSpan = this.createElement(
            "span",
            "",
            "value-team-red"
        );

        teamRedScoreSpan.textContent = "Score " + teams["Red"].value;

        const teamRedScoreSeparator = this.createElement(
            "span",
            "heroes-selection-title-separator"
        );
        teamRedScoreSeparator.textContent = teamBlueScoreSeparator.textContent;

        this.blueTeamScore.append(
            blueTitleStrong,
            teamBlueScoreSeparator,
            teamBlueScoreSpan
        );
        this.redTeamScore.append(
            teamRedScoreSpan,
            teamRedScoreSeparator,
            redTitleStrong
        );
    }

    displaySelectedHeroes(teams, selectedHeroes, iconOption) {
        while (this.teamBlueComposition.firstChild) {
            this.teamBlueComposition.removeChild(
                this.teamBlueComposition.firstChild
            );
        }

        while (this.teamRedComposition.firstChild) {
            this.teamRedComposition.removeChild(
                this.teamRedComposition.firstChild
            );
        }

        //Display Blue Team
        for (let shb in selectedHeroes[0].selectedHeroes) {
            let hero = selectedHeroes[0].selectedHeroes[shb];
            let team = "Blue";
            let value = 0;
            let heroIMG = "";
            let enemyEcho = teams["Red"].hasEcho;
            let bestCopyHeroes = teams[team].bestCopyHeroes;
            let notRound = false;

            if (hero != "None") {
                value = teams[team].heroes[hero].value;

                //This get the img and the value of notRound
                let IMGRound = this.getIMGandNotRound(
                    iconOption,
                    teams,
                    team,
                    hero,
                    enemyEcho,
                    bestCopyHeroes,
                    notRound
                );

                heroIMG = IMGRound["heroIMG"];
                notRound = IMGRound["notRound"];
            }

            const figure = this.createHeroFigure(
                hero,
                team,
                value,
                heroIMG,
                notRound
            );
            this.teamBlueComposition.append(figure);
        }

        //Display Red Team
        for (let shb in selectedHeroes[1].selectedHeroes) {
            let hero = selectedHeroes[1].selectedHeroes[shb];
            let team = "Red";
            let value = 0;
            let heroIMG = "";
            let enemyEcho = teams["Blue"].hasEcho;
            let bestCopyHeroes = teams[team].bestCopyHeroes;
            let notRound = false;

            if (hero != "None") {
                value = teams[team].heroes[hero].value;

                //This get the img and the value of notRound
                let IMGRound = this.getIMGandNotRound(
                    iconOption,
                    teams,
                    team,
                    hero,
                    enemyEcho,
                    bestCopyHeroes,
                    notRound
                );

                heroIMG = IMGRound["heroIMG"];
                notRound = IMGRound["notRound"];
            }

            const figure = this.createHeroFigure(
                hero,
                team,
                value,
                heroIMG,
                notRound
            );
            this.teamRedComposition.append(figure);
        }
    }

    displayFilters() {
        while (this.blueFilter.firstChild) {
            this.blueFilter.removeChild(this.blueFilter.firstChild);
        }

        while (this.redFilter.firstChild) {
            this.redFilter.removeChild(this.redFilter.firstChild);
        }

        const blueInput = this.createElement("input", "", "blue-hero-filter");
        blueInput.classList.add("mx-1", "text-black");

        blueInput.type = "text";
        blueInput.name = "filter";
        blueInput.placeholder = "Genji";

        const redInput = this.createElement("input", "", "red-hero-filter");
        redInput.classList.add("mx-1");

        redInput.type = "text";
        redInput.name = "filter";
        redInput.placeholder = "Genji";

        this.blueFilter.append("Filter:", blueInput);
        this.redFilter.append("Filter:", redInput);
    }

    displayHeroRoles(teams, iconOption) {
        while (this.blueTankRolSelection.firstChild) {
            this.blueTankRolSelection.removeChild(
                this.blueTankRolSelection.firstChild
            );
        }

        while (this.redTankRolSelection.firstChild) {
            this.redTankRolSelection.removeChild(
                this.redTankRolSelection.firstChild
            );
        }

        while (this.blueDamageRolSelection.firstChild) {
            this.blueDamageRolSelection.removeChild(
                this.blueDamageRolSelection.firstChild
            );
        }

        while (this.redDamageRolSelection.firstChild) {
            this.redDamageRolSelection.removeChild(
                this.redDamageRolSelection.firstChild
            );
        }

        while (this.blueSupportRolSelection.firstChild) {
            this.blueSupportRolSelection.removeChild(
                this.blueSupportRolSelection.firstChild
            );
        }

        while (this.redSupportRolSelection.firstChild) {
            this.redSupportRolSelection.removeChild(
                this.redSupportRolSelection.firstChild
            );
        }

        for (let t in teams) {
            const tankRoleIcon = this.createElement("figure", "rol-icon");
            tankRoleIcon.classList.add(
                "grid",
                "grid-flow-col",
                "w-fit",
                "items-center",
                "mt-2"
            );

            const tankIcon = this.createElement("img");
            tankIcon.classList.add("h-11");

            const tankFigCap = this.createElement("figcaption");
            tankFigCap.classList.add(
                "text-3xl",
                "poppins",
                "font-bold",
                "uppercase"
            );

            const tankRoleSel = this.createElement(
                "div",
                "heroes-rol-selection"
            );
            tankRoleSel.classList.add(
                "flex",
                "flex-wrap",
                "justify-center",
                "mt-2",
                "pb-4",
                "border-b-2"
            );

            const damageRoleIcon = this.createElement("figure", "rol-icon");
            damageRoleIcon.classList.add(
                "grid",
                "grid-flow-col",
                "w-fit",
                "items-center",
                "mt-2"
            );

            const damageIcon = this.createElement("img");
            damageIcon.classList.add("h-11");

            const damageFigCap = this.createElement("figcaption");
            damageFigCap.classList.add(
                "text-3xl",
                "poppins",
                "font-bold",
                "uppercase"
            );

            const damageRoleSel = this.createElement(
                "div",
                "heroes-rol-selection"
            );
            damageRoleSel.classList.add(
                "flex",
                "flex-wrap",
                "justify-center",
                "mt-2",
                "pb-4",
                "border-b-2"
            );

            const supportRoleIcon = this.createElement("figure", "rol-icon");
            supportRoleIcon.classList.add(
                "grid",
                "grid-flow-col",
                "w-fit",
                "items-center",
                "mt-2"
            );

            const supportIcon = this.createElement("img");
            supportIcon.classList.add("h-11");

            const supportFigCap = this.createElement("figcaption");
            supportFigCap.classList.add(
                "text-3xl",
                "poppins",
                "font-bold",
                "uppercase"
            );

            const supportRoleSel = this.createElement(
                "div",
                "heroes-rol-selection"
            );
            supportRoleSel.classList.add(
                "flex",
                "flex-wrap",
                "justify-center",
                "mt-2"
            );

            tankIcon.src = "images/assets/tank.webp";
            tankIcon.alt = "Tank icon";
            tankFigCap.textContent = "Tank";

            damageIcon.src = "images/assets/damage.webp";
            damageIcon.alt = "Damage icon";
            damageFigCap.textContent = "Damage";

            supportIcon.src = "images/assets/support.webp";
            supportIcon.alt = "Support icon";
            supportFigCap.textContent = "Support";

            tankRoleIcon.append(tankIcon, tankFigCap);
            damageRoleIcon.append(damageIcon, damageFigCap);
            supportRoleIcon.append(supportIcon, supportFigCap);

            if (t == "Blue") {
                tankRoleSel.id = "tanks-onselect-blue";
                tankRoleSel.classList.add("sm:justify-start");

                tankFigCap.classList.add("ml-1");

                damageRoleSel.id = "damage-onselect-blue";
                damageRoleSel.classList.add("sm:justify-start");

                damageFigCap.classList.add("ml-1");

                supportRoleSel.id = "support-onselect-blue";
                supportRoleSel.classList.add("sm:justify-start");

                supportFigCap.classList.add("ml-1");
            } else if (t == "Red") {
                tankRoleSel.id = "tanks-onselect-red";
                tankRoleSel.classList.add(
                    "enemy-team-direction",
                    "sm:justify-end"
                );

                tankRoleIcon.classList.add("sm:flex", "sm:flex-row-reverse");

                tankFigCap.classList.add("mr-1");

                damageRoleSel.id = "damage-onselect-red";
                damageRoleSel.classList.add(
                    "enemy-team-direction",
                    "sm:justify-end"
                );

                damageRoleIcon.classList.add("sm:flex", "sm:flex-row-reverse");

                damageFigCap.classList.add("mr-1");

                supportRoleSel.id = "support-onselect-red";
                supportRoleSel.classList.add(
                    "enemy-team-direction",
                    "sm:justify-end"
                );

                supportRoleIcon.classList.add("sm:flex", "sm:flex-row-reverse");

                supportFigCap.classList.add("mr-1");
            }

            let sortedHeroes = teams[t].getSortedHeroesNameperValue();

            for (let sh in sortedHeroes) {
                let h = sortedHeroes[sh][0];

                let hero = teams[t].heroes[h];
                let role = hero.generalRol;
                let notRound = false;

                if (!hero.selected) {
                    let figHeroOption;

                    const iconOptionSelect =
                        getSelectValue(iconOption) + "-img";

                    figHeroOption = this.createHeroFigure(
                        hero.name,
                        t,
                        hero.value,
                        hero.getIMG(iconOptionSelect),
                        notRound
                    );

                    const figHero = figHeroOption;

                    if (role == "Tank") {
                        if (teams[t].isRoleFiltered(role) && hero.filtered) {
                            tankRoleSel.append(figHero);
                        } else if (!teams[t].isRoleFiltered(role)) {
                            tankRoleSel.append(figHero);
                        }
                    } else if (role == "Damage") {
                        if (teams[t].isRoleFiltered(role) && hero.filtered) {
                            damageRoleSel.append(figHero);
                        } else if (!teams[t].isRoleFiltered(role)) {
                            damageRoleSel.append(figHero);
                        }
                    } else if (role == "Support") {
                        if (teams[t].isRoleFiltered(role) && hero.filtered) {
                            supportRoleSel.append(figHero);
                        } else if (!teams[t].isRoleFiltered(role)) {
                            supportRoleSel.append(figHero);
                        }
                    }
                }
            }

            if (t == "Blue") {
                this.blueTankRolSelection.append(tankRoleIcon, tankRoleSel);
                this.blueDamageRolSelection.append(
                    damageRoleIcon,
                    damageRoleSel
                );
                this.blueSupportRolSelection.append(
                    supportRoleIcon,
                    supportRoleSel
                );
            } else if (t == "Red") {
                this.redTankRolSelection.append(tankRoleIcon, tankRoleSel);
                this.redDamageRolSelection.append(
                    damageRoleIcon,
                    damageRoleSel
                );
                this.redSupportRolSelection.append(
                    supportRoleIcon,
                    supportRoleSel
                );
            }
        }
    }

    displayTeams(teams, selectedHeroes, iconOption) {
        this.displayTeamScores(teams);
        this.displaySelectedHeroes(teams, selectedHeroes, iconOption);
        this.displayHeroRoles(teams, iconOption);
    }

    bindClearSelection(handler) {
        this.clearSelection.addEventListener("click", (event) => {
            if (event.target.id == "clear-all-values") {
                handler();
            }
        });
    }

    bindToggleOptions(handler) {
        this.checkboxPanel.addEventListener("change", (event) => {
            if (event.target.type == "checkbox") {
                const id = event.target.id;
                handler(id);
            }
        });
    }

    bindGearOptions(handler) {
        this.checkboxPanel.addEventListener("click", (event) => {
            if (event.target.classList.contains("bi-gear-fill")) {
                handler();
            }
        });
    }

    bindEditSelected(handler) {
        this.selectionPanel.addEventListener("change", (event) => {
            if (event.target.type == "select-one") {
                const id = event.target.id;
                const selIndex = event.target.options.selectedIndex;
                handler(id, selIndex);
            }
        });
    }

    bindHeroFilter(handler) {
        this.blueFilter.addEventListener("input", (event) => {
            //The Input is easy to get with the ID
            let nick = document.getElementById("blue-hero-filter").value;

            handler(nick, "Blue");
        });

        this.redFilter.addEventListener("input", (event) => {
            //The Input is easy to get with the ID
            let nick = document.getElementById("red-hero-filter").value;

            handler(nick, "Red");
        });
    }

    bindSelectedHeroes(handler) {
        this.teamBlueComposition.addEventListener("click", (event) => {
            let element;
            let team = "Blue";

            if (event.target.getAttribute("data-name")) {
                element = event.target;
            } else if (event.target.parentElement.getAttribute("data-name")) {
                element = event.target.parentElement;
            }

            if (element) {
                let hero;

                hero = element.getAttribute("data-name");

                handler(team, hero);
            }
        });

        this.blueTankRolSelection.addEventListener("click", (event) => {
            let element;
            let team = "Blue";
            let role = "Tank";

            if (event.target.getAttribute("data-name")) {
                element = event.target;
            } else if (event.target.parentElement.getAttribute("data-name")) {
                element = event.target.parentElement;
            }

            if (element) {
                let hero;

                hero = element.getAttribute("data-name");

                handler(team, hero, role);
            }
        });

        this.blueDamageRolSelection.addEventListener("click", (event) => {
            let element;
            let team = "Blue";
            let role = "Damage";

            if (event.target.getAttribute("data-name")) {
                element = event.target;
            } else if (event.target.parentElement.getAttribute("data-name")) {
                element = event.target.parentElement;
            }

            if (element) {
                let hero;

                hero = element.getAttribute("data-name");

                handler(team, hero, role);
            }
        });

        this.blueSupportRolSelection.addEventListener("click", (event) => {
            let element;
            let team = "Blue";
            let role = "Support";

            if (event.target.getAttribute("data-name")) {
                element = event.target;
            } else if (event.target.parentElement.getAttribute("data-name")) {
                element = event.target.parentElement;
            }

            if (element) {
                let hero;

                hero = element.getAttribute("data-name");

                handler(team, hero, role);
            }
        });

        this.teamRedComposition.addEventListener("click", (event) => {
            let element;
            let team = "Red";

            if (event.target.getAttribute("data-name")) {
                element = event.target;
            } else if (event.target.parentElement.getAttribute("data-name")) {
                element = event.target.parentElement;
            }

            if (element) {
                let hero;

                hero = element.getAttribute("data-name");

                handler(team, hero);
            }
        });

        this.redTankRolSelection.addEventListener("click", (event) => {
            let element;
            let team = "Red";
            let role = "Tank";

            if (event.target.getAttribute("data-name")) {
                element = event.target;
            } else if (event.target.parentElement.getAttribute("data-name")) {
                element = event.target.parentElement;
            }

            if (element) {
                let hero;

                hero = element.getAttribute("data-name");

                handler(team, hero, role);
            }
        });

        this.redDamageRolSelection.addEventListener("click", (event) => {
            let element;
            let team = "Red";
            let role = "Damage";

            if (event.target.getAttribute("data-name")) {
                element = event.target;
            } else if (event.target.parentElement.getAttribute("data-name")) {
                element = event.target.parentElement;
            }

            if (element) {
                let hero;

                hero = element.getAttribute("data-name");

                handler(team, hero, role);
            }
        });

        this.redSupportRolSelection.addEventListener("click", (event) => {
            let element;
            let team = "Red";
            let role = "Support";

            if (event.target.getAttribute("data-name")) {
                element = event.target;
            } else if (event.target.parentElement.getAttribute("data-name")) {
                element = event.target.parentElement;
            }

            if (element) {
                let hero;

                hero = element.getAttribute("data-name");

                handler(team, hero, role);
            }
        });
    }

    updateVersion(version) {
        let dateElement = this.getElement(".footer-final-line-left");

        dateElement.textContent = "Last Update: " + version["last-update"];
    }
}

//////////////////////
// Controller Elements
//////////////////////

class ControllerOverPiker {
    constructor(model, view) {
        this.model = model;
        this.view = view;

        //Bind controller with the clear selection
        this.view.bindClearSelection(this.handleClearSelection);

        //Bind controller with the Option panel
        this.model.bindOptionChanged(this.onOptionsChanged);
        this.model.bindOptionGearChanged(this.onGearStateChanged);
        this.view.bindToggleOptions(this.handleToggleOptions);
        this.view.bindGearOptions(this.handleGearOptions);

        //Bind controller with the Selection panel
        this.model.bindSelectionsChanged(this.onSelectionsChanged);
        this.view.bindEditSelected(this.handleEditSelected);

        this.view.bindHeroFilter(this.handleFilter);

        //Bind controller with HeroeSelection
        this.model.bindSelectedHeroesChanged(this.onSelectedHeroesChanged);
        this.view.bindSelectedHeroes(this.handleSelectedHeroes);

        //Bind View with Model
        this.onOptionsChanged(
            this.model.panelOptions,
            this.model.panelSelections,
            this.model.gearOptionsState
        );
        this.onSelectedHeroesChanged(
            this.model.teams,
            this.model.selectedHeroes
        );
        this.onSelectionsChanged(
            this.model.panelSelections,
            this.model.gearOptionsState
        );
    }

    onOptionsChanged = (panelOptions, panelSelections, gearOptionsState) => {
        this.view.displayOptions(panelOptions, gearOptionsState);
        this.view.displaySelections(panelSelections, gearOptionsState);
    };

    onGearStateChanged = (panelOptions, panelSelections, gearOptionsState) => {
        this.view.displayOptions(panelOptions, gearOptionsState);
        this.view.displaySelections(panelSelections, gearOptionsState);
    };

    onSelectionsChanged = (panelSelections, gearOptionsState) => {
        this.view.displaySelections(panelSelections, gearOptionsState);
    };

    onSelectedHeroesChanged = (teams, selectedHeroes) => {
        let selectedIcon = 0;
        if (this.model.panelSelections[4]) {
            selectedIcon = this.model.panelSelections[4].selectedIndex;
        }
        let iconOption = this.model.panelSelections[4].options[selectedIcon];
        this.view.displayTeams(teams, selectedHeroes, iconOption);
    };

    handleClearSelection = () => {
        //This re-use the handleSelectedHeroes function and attempt to clear the selected heroes if there any selected
        let teams = this.model.selectedHeroes;

        for (let t in teams) {
            let selectedHeroes = teams[t].selectedHeroes;

            for (let sh in selectedHeroes) {
                let team = teams[t].team;
                let hero = selectedHeroes[sh];

                if (hero != "None") {
                    this.handleSelectedHeroes(team, hero);
                }
            }
        }
    };

    handleToggleOptions = (id) => {
        this.model.toggleOptionPanel(id);
        this.model.switchTeamSize(); //This switch the Team size if 5v5 is selected or not
        this.model.editSelected(); //This recharge the options if map pools are selected
        this.model.editSelectedHeroes(); //This recharge the heroes if TierMode or Hero Rotation is activated
    };

    handleGearOptions = () => {
        this.model.toggleGearOptions();
    };

    handleFilter = (nick, team) => {
        this.model.filterHero(nick, team);
        this.model.editSelectedHeroes();
    };

    handleEditSelected = (id, selIndex) => {
        this.model.editSelected(id, selIndex);
        this.model.editSelectedHeroes();
    };

    handleSelectedHeroes = (team, hero, role) => {
        this.model.editSelectedHeroes(team, hero, role);
    };

    loadAPIJSON(apiURL, jsonURL) {
        //Charge the API data and update the model and the view
        this.model.APIData.loadAPIJSON(apiURL, jsonURL, this.model, this);
    }

    reloadControllerModel(version) {
        //The model is reloaded in the controller and the view here
        this.onOptionsChanged(
            this.model.panelOptions,
            this.model.panelSelections,
            this.model.gearOptionsState
        );
        this.onSelectedHeroesChanged(
            this.model.teams,
            this.model.selectedHeroes
        );
        this.onSelectionsChanged(
            this.model.panelSelections,
            this.model.gearOptionsState
        );
        this.view.updateVersion(version);
    }
}

//////////////////////
// Start the APP
//////////////////////

const calculator = new ControllerOverPiker(
    new ModelOverPiker(),
    new ViewOverPiker()
);

//After the calculator is loaded we call the data from the API, this data is saved in local and then load in the model
calculator.loadAPIJSON(API_URL, JSON_URL);

/*
All this code is copyright Autopoietico, 2023.
    -This code includes a bit of snippets found on stackoverflow.com and others
I'm not a javascript expert, I use this project to learn how to code, and how to design web pages, is a funny hobby to do, but if I
gain something in the process is a plus.
Feel free to alter this code to your liking, but please do not re-host it, do not profit from it and do not present it as your own.
*/

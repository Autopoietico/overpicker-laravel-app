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

//Model of every hero
class ModelHero {
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
            // Check if point is "none" to use map-level score
            if (point === "none") {
                if (this.maps["Maps"] && this.maps["Maps"][map] !== undefined) {
                    // Use map-level score if available
                    if (isWeighted) {
                        this.value +=
                            this.maps["Maps"][map] * MAPAD_WEIGHT +
                            MIN_MAPAD_VALUE; //Map Level Value
                    } else {
                        this.value += this.maps["Maps"][map]; //Map Level Value
                    }
                } else {
                    // Fallback: use the first point's score if map-level score is not available
                    let firstPoint = Object.keys(this.maps[adc][map])[0];
                    if (firstPoint) {
                        if (isWeighted) {
                            this.value +=
                                this.maps[adc][map][firstPoint] * MAPAD_WEIGHT +
                                MIN_MAPAD_VALUE; //First Point Value
                        } else {
                            this.value += this.maps[adc][map][firstPoint]; //First Point Value
                        }
                    }
                }
            } else {
                if (isWeighted) {
                    this.value +=
                        this.maps[adc][map][point] * MAPAD_WEIGHT +
                        MIN_MAPAD_VALUE; //Point Value
                } else {
                    this.value += this.maps[adc][map][point]; //Point Value
                }
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
                // Check if point is "none" to use map-level score
                if (point === "none") {
                    if (
                        this.maps["Maps"] &&
                        this.maps["Maps"][map] !== undefined
                    ) {
                        // Use map-level score if available
                        if (isWeighted) {
                            this.echoValue +=
                                this.maps["Maps"][map] * MAPAD_WEIGHT +
                                MIN_MAPAD_VALUE; //Map Level Value
                        } else {
                            this.echoValue += this.maps["Maps"][map]; //Map Level Value
                        }
                    } else {
                        // Fallback: use the first point's score if map-level score is not available
                        let firstPoint = Object.keys(this.maps[adc][map])[0];
                        if (firstPoint) {
                            if (isWeighted) {
                                this.echoValue +=
                                    this.maps[adc][map][firstPoint] *
                                        MAPAD_WEIGHT +
                                    MIN_MAPAD_VALUE; //First Point Value
                            } else {
                                this.echoValue +=
                                    this.maps[adc][map][firstPoint]; //First Point Value
                            }
                        }
                    }
                } else {
                    if (isWeighted) {
                        this.echoValue +=
                            this.maps[adc][map][point] * MAPAD_WEIGHT +
                            MIN_MAPAD_VALUE; //Point Value
                    } else {
                        this.echoValue += this.maps[adc][map][point]; //Point Value
                    }
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

export default ModelHero;

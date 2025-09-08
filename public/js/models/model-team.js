/*
All this code is copyright Autopoietico, 2023.
    -This code includes a bit of snippets found on stackoverflow.com and others
I'm not a javascript expert, I use this project to learn how to code, and how to design web pages, is a funny hobby to do, but if I
gain something in the process is a plus.
Feel free to alter this code to your liking, but please do not re-host it, do not profit from it and do not present it as your own.
*/

import ModelHero from "./model-hero.js";

//ModelTeam
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

    calcScores(
        tier,
        map,
        point,
        adc,
        mapType,
        pointType,
        enemyHeroes,
        isWeighted
    ) {
        let alliedHeroes = this.selectedHeroes;

        this.resetValues();

        for (let h in this.heroes) {
            let isHeroSelected = this.heroes[h].selected;

            this.heroes[h].calcScore(
                tier,
                map,
                point,
                adc,
                mapType,
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

    calcEchoScores(
        tier,
        map,
        point,
        adc,
        mapType,
        pointType,
        enemyHeroes,
        isWeighted
    ) {
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
                    mapType,
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

export default ModelTeam;

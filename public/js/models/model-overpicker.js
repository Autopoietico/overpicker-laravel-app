/*
All this code is copyright Autopoietico, 2023.
    -This code includes a bit of snippets found on stackoverflow.com and others
I'm not a javascript expert, I use this project to learn how to code, and how to design web pages, is a funny hobby to do, but if I
gain something in the process is a plus.
Feel free to alter this code to your liking, but please do not re-host it, do not profit from it and do not present it as your own.
*/

import { LASTUPDATE, getSelectValue } from "../utils/constants.js";
import ModelAPI from "../api/model-api.js";
import ModelTier from "./model-tier.js";
import ModelMapType from "./model-map-type.js";
import ModelMap from "./model-map.js";
import ModelTeam from "./model-team.js";

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

                // Add "none" option for map-level scores
                this.panelSelections[2].options = ["none"];

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

export default ModelOverPiker;

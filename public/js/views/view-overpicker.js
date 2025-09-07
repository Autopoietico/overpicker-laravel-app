/*
All this code is copyright Autopoietico, 2023.
    -This code includes a bit of snippets found on stackoverflow.com and others
I'm not a javascript expert, I use this project to learn how to code, and how to design web pages, is a funny hobby to do, but if I
gain something in the process is a plus.
Feel free to alter this code to your liking, but please do not re-host it, do not profit from it and do not present it as your own.
*/

import { getSelectValue } from "../utils/constants.js";

//View Elements
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

    createHeroFigure(hero, team, value, heroIMG, notRound, borderState = 0) {
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

            // Add border classes based on borderState
            if (borderState === 1) {
                img.classList.add("border", "border-green-500");
            } else if (borderState === 2) {
                img.classList.add("border", "border-yellow-500");
            } else if (borderState === 3) {
                img.classList.add("border", "border-red-500");
            }

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
            let borderState = 0;

            if (hero != "None") {
                value = teams[team].heroes[hero].value;
                borderState = teams[team].heroes[hero].borderState;

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
                notRound,
                borderState
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
            let borderState = 0;

            if (hero != "None") {
                value = teams[team].heroes[hero].value;
                borderState = teams[team].heroes[hero].borderState;

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
                notRound,
                borderState
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
                        notRound,
                        hero.borderState
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
        // Add border rotation handler
        this.onBorderRotation = null;

        this.teamBlueComposition.addEventListener("click", (event) => {
            let element;
            let team = "Blue";

            if (event.target.getAttribute("data-name")) {
                element = event.target;
            } else if (event.target.parentElement.getAttribute("data-name")) {
                element = event.target.parentElement;
            }

            if (element) {
                let hero = element.getAttribute("data-name");

                // Check if Shift key is pressed for border rotation
                if (event.shiftKey) {
                    if (this.onBorderRotation) {
                        this.onBorderRotation(team, hero);
                    }
                } else {
                    handler(team, hero);
                }
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
                let hero = element.getAttribute("data-name");

                // Check if Shift key is pressed for border rotation
                if (event.shiftKey) {
                    if (this.onBorderRotation) {
                        this.onBorderRotation(team, hero);
                    }
                } else {
                    handler(team, hero, role);
                }
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
                let hero = element.getAttribute("data-name");

                // Check if Shift key is pressed for border rotation
                if (event.shiftKey) {
                    if (this.onBorderRotation) {
                        this.onBorderRotation(team, hero);
                    }
                } else {
                    handler(team, hero, role);
                }
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
                let hero = element.getAttribute("data-name");

                // Check if Shift key is pressed for border rotation
                if (event.shiftKey) {
                    if (this.onBorderRotation) {
                        this.onBorderRotation(team, hero);
                    }
                } else {
                    handler(team, hero, role);
                }
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
                let hero = element.getAttribute("data-name");

                // Check if Shift key is pressed for border rotation
                if (event.shiftKey) {
                    if (this.onBorderRotation) {
                        this.onBorderRotation(team, hero);
                    }
                } else {
                    handler(team, hero);
                }
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
                let hero = element.getAttribute("data-name");

                // Check if Shift key is pressed for border rotation
                if (event.shiftKey) {
                    if (this.onBorderRotation) {
                        this.onBorderRotation(team, hero);
                    }
                } else {
                    handler(team, hero, role);
                }
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
                let hero = element.getAttribute("data-name");

                // Check if Shift key is pressed for border rotation
                if (event.shiftKey) {
                    if (this.onBorderRotation) {
                        this.onBorderRotation(team, hero);
                    }
                } else {
                    handler(team, hero, role);
                }
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
                let hero = element.getAttribute("data-name");

                // Check if Shift key is pressed for border rotation
                if (event.shiftKey) {
                    if (this.onBorderRotation) {
                        this.onBorderRotation(team, hero);
                    }
                } else {
                    handler(team, hero, role);
                }
            }
        });
    }

    bindBorderRotation(handler) {
        this.onBorderRotation = handler;
    }

    updateVersion(version) {
        let dateElement = this.getElement(".footer-final-line-left");

        dateElement.textContent = "Last Update: " + version["last-update"];
    }
}

export default ViewOverPiker;

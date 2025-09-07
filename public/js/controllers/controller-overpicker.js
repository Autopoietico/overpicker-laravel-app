/*
All this code is copyright Autopoietico, 2023.
    -This code includes a bit of snippets found on stackoverflow.com and others
I'm not a javascript expert, I use this project to learn how to code, and how to design web pages, is a funny hobby to do, but if I
gain something in the process is a plus.
Feel free to alter this code to your liking, but please do not re-host it, do not profit from it and do not present it as your own.
*/

import ModelOverPiker from "../models/model-overpicker.js";
import ViewOverPiker from "../views/view-overpicker.js";
import { API_URL, JSON_URL } from "../utils/constants.js";

//Controller Elements
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

        //Bind controller with Border Rotation
        this.view.bindBorderRotation(this.handleBorderRotation);

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

    handleBorderRotation = (team, hero) => {
        this.model.rotateHeroBorder(team, hero);
        // Refresh the display to show the updated border
        this.onSelectedHeroesChanged(
            this.model.teams,
            this.model.selectedHeroes
        );
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

export default ControllerOverPiker;

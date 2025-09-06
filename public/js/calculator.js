/*
All this code is copyright Autopoietico, 2023.
    -This code includes a bit of snippets found on stackoverflow.com and others
I'm not a javascript expert, I use this project to learn how to code, and how to design web pages, is a funny hobby to do, but if I
gain something in the process is a plus.
Feel free to alter this code to your liking, but please do not re-host it, do not profit from it and do not present it as your own.
*/

import { API_URL, JSON_URL } from "./utils/constants.js";
import ModelOverPiker from "./models/model-overpicker.js";
import ViewOverPiker from "./views/view-overpicker.js";
import ControllerOverPiker from "./controllers/controller-overpicker.js";

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

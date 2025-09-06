/*
All this code is copyright Autopoietico, 2023.
    -This code includes a bit of snippets found on stackoverflow.com and others
I'm not a javascript expert, I use this project to learn how to code, and how to design web pages, is a funny hobby to do, but if I
gain something in the process is a plus.
Feel free to alter this code to your liking, but please do not re-host it, do not profit from it and do not present it as your own.
*/

//Model of the type of point
class ModelMapType {
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

export default ModelMapType;

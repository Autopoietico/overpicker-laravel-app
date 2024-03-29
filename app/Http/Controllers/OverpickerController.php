<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class OverpickerController extends Controller
{
    //
    public $DATES;

    public function __construct()
    {
        $this->DATES = include(config_path('dates.php'));
    }

    public function home(){

        $title = ' - Overwatch tool made to build Composition based in Counter and Synergies';

        return view('calculator',[
            'title' => $title,
            'dates' => $this->DATES,
        ]);
    }
    public function tiers(){
        
        $TOP500 = 0; //Top 500 is indexed as 0 in the tiers
        $tierValues = array(//Tier value and the blade component with the Tier Name and color
            array(45, View::make('components.tiers.tier-s')),
            array(35, View::make('components.tiers.tier-a')),
            array(25, View::make('components.tiers.tier-b')),
            array(15, View::make('components.tiers.tier-c')),
            array(5, View::make('components.tiers.tier-d')),
        );
        
        //Extract all the data from the storage
        $url_heroes = storage_path() . "/api/hero-data/hero-info.json";
        $url_tiers = storage_path() . "/api/hero-data/hero-tiers.json";
        $url_img = storage_path() . "/api/hero-data/hero-img.json";      
        
        $data_heroes = file_get_contents($url_heroes);
        $data_tiers = file_get_contents($url_tiers);
        $data_img = file_get_contents($url_img);        
        
        //converting string to objects
        $heroes_obj = json_decode($data_heroes, true);
        $tiers_obj = json_decode($data_tiers, true)[$TOP500]; 
        $img_obj = json_decode($data_img, true);        
        
        //empty array
        $sorted_heroes = array();
        
        foreach($heroes_obj as $heroe){
    
            $item = [];//Empty object to be added in the array
    
            $item["name"] = $heroe["name"];
            $item["role"] = $heroe["general_rol"];
            $item["description"] = $heroe["description"];
            $item["value"] = $tiers_obj['hero-tiers'][$heroe["name"]]; //values are stored in the tiers json
    
            foreach($img_obj as $img){
    
                if($img["name"] == $heroe["name"]){
    
                    $item["img"] = $img["profile-img"]; //values are stored in the img json
                }
            }
            
            array_push($sorted_heroes, $item);
        }

        $title = ' - Tiers';

        return view('tiers',[
            'title' => $title,
            'dates' => $this->DATES,
            'tiers' => $sorted_heroes,
            'tierValues' => $tierValues
        ]);
    }

    public function about(){

        $title = ' - About';

        return view('about',[
            'title' => $title,
            'dates' => $this->DATES,
        ]);
    }

    public function sources(){

        $title = ' - Sources';

        return view('sources',[
            'title' => $title,
            'dates' => $this->DATES,
        ]);
    }

    public function privacy(){

        $title = ' - Privacy Policy';

        return view('privacy',[
            'title' => $title,
            'dates' => $this->DATES,
        ]);
    }

    public function trackers(){

        $title = ' - Trackers';

        return view('trackers',[
            'title' => $title,
            'dates' => $this->DATES,
        ]);
    }
}

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

    public function home()
    {

        $title = ' – Overwatch Hero Picker & Team Composition Calculator';

        $seo = [
            'title' => 'Overpicker – Overwatch Hero Picker & Team Composition Calculator',
            'keywords' => 'overwatch hero picker, overwatch counter picker, overwatch team composition calculator, overwatch comp builder, overwatch draft tool, overwatch hero recommendation tool, overwatch composition analyzer, overwatch, best heroes, counters, synergies, pick, overpicker, composition, heropicker, maps, tiers',
            'description' => 'Overpicker is an advanced Overwatch hero picker that analyzes team compositions, counters, and synergies to help you choose the best hero for competitive play.',
            'og_title' => 'Overpicker – Overwatch Hero Picker & Team Composition Calculator',
            'og_description' => 'Overpicker is an advanced Overwatch hero picker that analyzes team compositions, counters, and synergies to help you choose the best hero for competitive play.',
            'og_url' => 'https://overpicker.com/',
        ];

        return view('calculator', [
            'title' => $title,
            'dates' => $this->DATES,
            'seo' => $seo,
        ]);
    }
    public function tiers()
    {

        $TOP500 = 0; //Top 500 is indexed as 0 in the tiers
        $tierValues = array( //Tier value and the blade component with the Tier Name and color
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

        foreach ($heroes_obj as $heroe) {

            $item = []; //Empty object to be added in the array

            $item["name"] = $heroe["name"];
            $item["role"] = $heroe["general_rol"];
            $item["description"] = $heroe["description"];
            $item["value"] = $tiers_obj['hero-tiers'][$heroe["name"]]; //values are stored in the tiers json

            foreach ($img_obj as $img) {

                if ($img["name"] == $heroe["name"]) {

                    $item["img"] = $img["profile-img"]; //values are stored in the img json
                }
            }

            array_push($sorted_heroes, $item);
        }

        $title = ' - Tiers';

        $seo = [
            'title' => 'OverPicker - Hero Tier List',
            'keywords' => 'overwatch, tiers, tier list, hero tier, best heroes, top 500, hero ranking, overpicker, meta, strongest heroes',
            'description' => 'View the complete Overwatch hero tier list based on Top 500 rankings. Find out which heroes are currently the strongest in the meta.',
            'og_title' => 'OverPicker - Hero Tier List',
            'og_description' => 'View the complete Overwatch hero tier list based on Top 500 rankings. Find out which heroes are currently the strongest in the meta.',
            'og_url' => 'https://overpicker.win/tiers',
        ];

        return view('tiers', [
            'title' => $title,
            'dates' => $this->DATES,
            'tiers' => $sorted_heroes,
            'tierValues' => $tierValues,
            'seo' => $seo,
        ]);
    }

    public function counters()
    {

        //Extract all the data from the storage
        $url_heroes = storage_path() . "/api/hero-data/hero-info.json";
        $url_counters = storage_path() . "/api/hero-data/hero-counters.json";
        $url_img = storage_path() . "/api/hero-data/hero-img.json";

        $data_heroes = file_get_contents($url_heroes);
        $data_counters = file_get_contents($url_counters);
        $data_img = file_get_contents($url_img);

        //converting string to objects
        $heroes_obj = json_decode($data_heroes, true);
        $counters_obj = json_decode($data_counters, true);
        $img_obj = json_decode($data_img, true);

        // Create a mapping of hero names to roles
        $hero_roles = [];
        foreach ($heroes_obj as $hero) {
            $hero_roles[$hero["name"]] = $hero["general_rol"];
        }

        // Create a mapping of hero names to images
        $hero_images = [];
        foreach ($img_obj as $img) {
            $hero_images[$img["name"]] = $img["profile-img"];
        }

        // Generate dynamic "Who counters [hero]" keywords
        $whoCountersKeywords = [];
        foreach ($heroes_obj as $hero) {
            $whoCountersKeywords[] = 'who counters ' . strtolower($hero['name']) . ' overwatch';
        }

        $title = ' - Hero Counters';

        $seo = [
            'title' => 'Overwatch Hero Counters Chart – Complete Counter Matrix',
            'keywords' => 'overwatch counters list, overwatch hero counters chart, ' . implode(', ', $whoCountersKeywords) . ', overwatch matchup chart, overwatch counter matrix',
            'description' => 'View the complete Overwatch hero counters chart with our interactive counter matrix. Understand the -20 to 20 scoring system to find which heroes counter your enemies and win more games.',
            'og_title' => 'Overwatch Hero Counters Chart – Complete Counter Matrix',
            'og_description' => 'View the complete Overwatch hero counters chart with our interactive counter matrix. Understand the -20 to 20 scoring system to find which heroes counter your enemies.',
            'og_url' => 'https://overpicker.win/counters',
        ];

        return view('counters', [
            'title' => $title,
            'dates' => $this->DATES,
            'counters' => $counters_obj,
            'hero_roles' => $hero_roles,
            'hero_images' => $hero_images,
            'heroes' => $heroes_obj,
            'seo' => $seo,
        ]);
    }

    public function synergies()
    {

        //Extract all the data from the storage
        $url_heroes = storage_path() . "/api/hero-data/hero-info.json";
        $url_synergies = storage_path() . "/api/hero-data/hero-synergies.json";
        $url_img = storage_path() . "/api/hero-data/hero-img.json";

        $data_heroes = file_get_contents($url_heroes);
        $data_synergies = file_get_contents($url_synergies);
        $data_img = file_get_contents($url_img);

        //converting string to objects
        $heroes_obj = json_decode($data_heroes, true);
        $synergies_obj = json_decode($data_synergies, true);
        $img_obj = json_decode($data_img, true);

        // Create a mapping of hero names to roles
        $hero_roles = [];
        foreach ($heroes_obj as $hero) {
            $hero_roles[$hero["name"]] = $hero["general_rol"];
        }

        // Create a mapping of hero names to images
        $hero_images = [];
        foreach ($img_obj as $img) {
            $hero_images[$img["name"]] = $img["profile-img"];
        }

        $title = ' - Hero Synergies';

        $seo = [
            'title' => 'OverPicker - Hero Synergies',
            'keywords' => 'overwatch, synergies, synergy, team synergy, hero synergies, combo, overpicker, best combo, team composition',
            'description' => 'Find hero synergies and powerful combinations in Overwatch. Build the ultimate team composition with synergistic heroes.',
            'og_title' => 'OverPicker - Hero Synergies',
            'og_description' => 'Find hero synergies and powerful combinations in Overwatch. Build the ultimate team composition with synergistic heroes.',
            'og_url' => 'https://overpicker.win/synergies',
        ];

        return view('synergies', [
            'title' => $title,
            'dates' => $this->DATES,
            'synergies' => $synergies_obj,
            'hero_roles' => $hero_roles,
            'hero_images' => $hero_images,
            'heroes' => $heroes_obj,
            'seo' => $seo,
        ]);
    }

    public function about()
    {

        $title = ' - About';

        $seo = [
            'title' => 'OverPicker - About',
            'keywords' => 'overpicker, about, about us, overwatch tools, hero picker, composition builder, about the project',
            'description' => 'Learn more about OverPicker, the ultimate Overwatch composition builder tool. Find counters, synergies, and build better teams.',
            'og_title' => 'OverPicker - About Us',
            'og_description' => 'Learn more about OverPicker, the ultimate Overwatch composition builder tool. Find counters, synergies, and build better teams.',
            'og_url' => 'https://overpicker.win/about',
        ];

        return view('about', [
            'title' => $title,
            'dates' => $this->DATES,
            'seo' => $seo,
        ]);
    }

    public function sources()
    {

        $title = ' - Sources';

        $seo = [
            'title' => 'OverPicker - Sources',
            'keywords' => 'overpicker, sources, data sources, api sources, overwatch data, hero data, resources',
            'description' => 'View the data sources and resources used by OverPicker to provide hero counters, synergies, and tier information.',
            'og_title' => 'OverPicker - Sources',
            'og_description' => 'View the data sources and resources used by OverPicker to provide hero counters, synergies, and tier information.',
            'og_url' => 'https://overpicker.win/sources',
        ];

        return view('sources', [
            'title' => $title,
            'dates' => $this->DATES,
            'seo' => $seo,
        ]);
    }

    public function privacy()
    {

        $title = ' - Privacy Policy';

        $seo = [
            'title' => 'OverPicker - Privacy Policy',
            'keywords' => 'overpicker, privacy, privacy policy, data policy, cookies, tracking',
            'description' => 'Read the privacy policy for OverPicker. Learn how we handle your data and protect your privacy.',
            'og_title' => 'OverPicker - Privacy Policy',
            'og_description' => 'Read the privacy policy for OverPicker. Learn how we handle your data and protect your privacy.',
            'og_url' => 'https://overpicker.win/privacy',
        ];

        return view('privacy', [
            'title' => $title,
            'dates' => $this->DATES,
            'seo' => $seo,
        ]);
    }

    public function trackers()
    {

        $title = ' - Trackers';

        $seo = [
            'title' => 'OverPicker - Trackers',
            'keywords' => 'overpicker, trackers, overwatch trackers, player trackers, stats, overwatch stats',
            'description' => 'Track your Overwatch progress with recommended trackers and stats tools. Find the best resources to improve your gameplay.',
            'og_title' => 'OverPicker - Trackers',
            'og_description' => 'Track your Overwatch progress with recommended trackers and stats tools. Find the best resources to improve your gameplay.',
            'og_url' => 'https://overpicker.win/trackers',
        ];

        return view('trackers', [
            'title' => $title,
            'dates' => $this->DATES,
            'seo' => $seo,
        ]);
    }
}

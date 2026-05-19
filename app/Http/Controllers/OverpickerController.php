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

        // Get rank names from hero-tiers.json for dynamic keywords
        $tiers_data = json_decode($data_tiers, true);
        $rankKeywords = [];
        foreach ($tiers_data as $rank) {
            $rankKeywords[] = 'best heroes in ' . strtolower($rank['name']) . ' Overwatch';
        }

        $title = ' - Tiers';

        $seo = [
            'title' => 'Overwatch Tier List by Rank – Competitive Meta Breakdown',
            'keywords' => 'overwatch tier list competitive, overwatch best heroes by rank, overwatch meta tier list, ' . implode(', ', $rankKeywords) . ', overwatch ranked tier list, best heroes in low rank overwatch, best heroes in high rank overwatch, overwatch tier list by rank',
            'description' => 'Explore our comprehensive Overwatch tier list by rank. Find the best heroes for Top 500, GrandMaster, Master, Diamond, Platinum, Gold, Silver, and Bronze ranks. Stay ahead of the meta with our competitive hero rankings.',
            'og_title' => 'Overwatch Tier List by Rank – Competitive Meta Breakdown',
            'og_description' => 'Explore our comprehensive Overwatch tier list by rank. Find the best heroes for Top 500, GrandMaster, Master, Diamond, Platinum, Gold, Silver, and Bronze ranks. Stay ahead of the meta with our competitive hero rankings.',
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
            'title' => 'Overwatch Hero Synergies – Best Hero Combinations',
            'keywords' => 'overwatch hero synergies, best hero combinations overwatch, overwatch team synergy chart, overwatch comp synergy list, best duo picks overwatch, overwatch synergies, hero synergies, team synergy, overwatch combo, overwatch team composition',
            'description' => 'Explore the Overwatch synergy chart to find the best hero combinations. Learn how the -20 to 20 scoring system works to build powerful team synergies and dominate your matches.',
            'og_title' => 'Overwatch Hero Synergies – Best Hero Combinations',
            'og_description' => 'Explore the Overwatch synergy chart to find the best hero combinations. Learn how the -20 to 20 scoring system works to build powerful team synergies and dominate your matches.',
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

    public function maps()
    {
        $heroes_obj    = json_decode(file_get_contents(storage_path('/api/hero-data/hero-info.json')), true);
        $img_obj       = json_decode(file_get_contents(storage_path('/api/hero-data/hero-img.json')), true);
        $hero_maps_obj = json_decode(file_get_contents(storage_path('/api/hero-data/hero-maps.json')), true);
        $map_info_obj  = json_decode(file_get_contents(storage_path('/api/map-data/map-info.json')), true);
        $map_type_obj  = json_decode(file_get_contents(storage_path('/api/map-data/map-type.json')), true);

        $hero_roles = [];
        foreach ($heroes_obj as $hero) {
            $hero_roles[$hero['name']] = $hero['general_rol'];
        }

        $hero_images = [];
        foreach ($img_obj as $img) {
            $hero_images[$img['name']] = $img['profile-img'];
        }

        // Map types that have both Attack and Defense scores for every point
        $dual_types = ['Assault', 'Escort', 'Hybrid'];

        // Map type -> single data key in hero-maps.json
        $single_key = [
            'Push'       => 'Push',
            'Control'    => 'Control',
            'Flashpoint' => 'Flashpoint',
            'Clash'      => 'Clash',
        ];

        $processed_data = [];
        $map_list = [];

        foreach ($map_info_obj as $mapInfo) {
            if (!$mapInfo['onPool']) continue;

            $mapName  = $mapInfo['name'];
            $mapType  = $mapInfo['type'];
            $points   = $mapInfo['points'];
            $isDual   = in_array($mapType, $dual_types);

            $columns = [];
            foreach ($points as $pointName) {
                $columns[] = ['pointName' => $pointName, 'dual' => $isDual];
            }

            $map_list[$mapType][] = $mapName;

            $heroData = [];
            foreach ($heroes_obj as $heroInfo) {
                $heroName    = $heroInfo['name'];
                if (!isset($hero_maps_obj[$heroName])) continue;
                $heroMapData = $hero_maps_obj[$heroName];

                $overall = $heroMapData['Maps'][$mapName] ?? null;
                if ($overall === null) {
                    $lookupKey = $isDual ? 'Attack' : ($single_key[$mapType] ?? 'Attack');
                    if (isset($heroMapData[$lookupKey][$mapName])) {
                        $vals    = array_values($heroMapData[$lookupKey][$mapName]);
                        $overall = (int)(round(array_sum($vals) / count($vals) / 10) * 10);
                    } else {
                        $overall = 0;
                    }
                }

                $pointScores = [];
                foreach ($points as $pointName) {
                    if ($isDual) {
                        $pointScores[$pointName] = [
                            'attack'  => $heroMapData['Attack'][$mapName][$pointName] ?? 0,
                            'defense' => $heroMapData['Defense'][$mapName][$pointName] ?? 0,
                        ];
                    } else {
                        $key = $single_key[$mapType] ?? 'Attack';
                        $pointScores[$pointName] = [
                            'score' => $heroMapData[$key][$mapName][$pointName] ?? 0,
                        ];
                    }
                }

                $heroData[$heroName] = ['overall' => $overall, 'points' => $pointScores];
            }

            $processed_data[$mapName] = [
                'type'    => $mapType,
                'points'  => $points,
                'columns' => $columns,
                'heroes'  => $heroData,
            ];
        }

        $heroes_ordered = [];
        foreach ($heroes_obj as $hero) {
            if (isset($hero_maps_obj[$hero['name']])) {
                $heroes_ordered[] = ['name' => $hero['name'], 'role' => $hero['general_rol']];
            }
        }

        $mapKeywords = [];
        foreach ($map_info_obj as $m) {
            if ($m['onPool']) {
                $mapKeywords[] = 'best heroes on ' . strtolower($m['name']) . ' overwatch';
                $mapKeywords[] = 'overwatch ' . strtolower($m['name']) . ' hero picks';
            }
        }

        $seo = [
            'title'          => 'Overwatch Hero Performance by Map – Best Picks for Every Map',
            'keywords'       => 'overwatch best heroes by map, overwatch map hero scores, overwatch map tier list, ' . implode(', ', $mapKeywords) . ', overwatch competitive map picks',
            'description'    => 'Discover the best Overwatch heroes for every competitive map. See attack, defense, and per-point performance scores for all active maps including King\'s Row, Ilios, Colosseo and more.',
            'og_title'       => 'Overwatch Hero Performance by Map – Best Picks for Every Map',
            'og_description' => 'Discover the best Overwatch heroes for every map. See per-point attack and defense scores for all competitive maps.',
            'og_url'         => 'https://overpicker.win/maps',
        ];

        return view('maps', [
            'title'          => ' - Maps',
            'dates'          => $this->DATES,
            'seo'            => $seo,
            'processed_data' => $processed_data,
            'hero_roles'     => $hero_roles,
            'hero_images'    => $hero_images,
            'heroes_ordered' => $heroes_ordered,
            'map_list'       => $map_list,
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

    public function heroes()
    {
        $TOP_RANK_INDEX = 0;

        $tierValues = [
            [45, \Illuminate\Support\Facades\View::make('components.tiers.tier-s')],
            [35, \Illuminate\Support\Facades\View::make('components.tiers.tier-a')],
            [25, \Illuminate\Support\Facades\View::make('components.tiers.tier-b')],
            [15, \Illuminate\Support\Facades\View::make('components.tiers.tier-c')],
            [5,  \Illuminate\Support\Facades\View::make('components.tiers.tier-d')],
        ];

        $heroes_obj = json_decode(file_get_contents(storage_path('/api/hero-data/hero-info.json')), true);
        $tiers_data = json_decode(file_get_contents(storage_path('/api/hero-data/hero-tiers.json')), true);
        $img_obj    = json_decode(file_get_contents(storage_path('/api/hero-data/hero-img.json')), true);

        $topRankName = $tiers_data[$TOP_RANK_INDEX]['name'];
        $tiers_obj   = $tiers_data[$TOP_RANK_INDEX]['hero-tiers'];

        $hero_images = [];
        foreach ($img_obj as $img) {
            $hero_images[$img['name']] = $img['profile-img'];
        }

        $sorted_heroes = [];
        foreach ($heroes_obj as $hero) {
            $sorted_heroes[] = [
                'name'  => $hero['name'],
                'role'  => $hero['general_rol'],
                'img'   => $hero_images[$hero['name']] ?? null,
                'value' => $tiers_obj[$hero['name']] ?? 5,
                'slug'  => \Illuminate\Support\Str::slug($hero['name']),
            ];
        }

        $seo = [
            'title'          => 'Overwatch Heroes Tier List – All Heroes by Rank',
            'keywords'       => 'overwatch heroes tier list, overwatch all heroes, overwatch hero list by tier, overwatch best heroes, overwatch hero guide, overwatch competitive heroes, overwatch hero rankings',
            'description'    => 'Browse all Overwatch heroes ranked by tier. Click any hero to see their full guide including counters, synergies, best maps, and tier by rank.',
            'og_title'       => 'Overwatch Heroes Tier List – All Heroes by Rank',
            'og_description' => 'Browse all Overwatch heroes ranked by tier. Click any hero for counters, synergies, best maps, and tier by rank.',
            'og_url'         => 'https://overpicker.win/heroes',
        ];

        return view('heroes', [
            'title'        => ' - Heroes',
            'dates'        => $this->DATES,
            'tiers'        => $sorted_heroes,
            'tierValues'   => $tierValues,
            'topRankName'  => $topRankName,
            'seo'          => $seo,
        ]);
    }

    public function heroDetail(string $hero)
    {
        $heroes_obj    = json_decode(file_get_contents(storage_path('/api/hero-data/hero-info.json')), true);
        $tiers_data    = json_decode(file_get_contents(storage_path('/api/hero-data/hero-tiers.json')), true);
        $img_obj       = json_decode(file_get_contents(storage_path('/api/hero-data/hero-img.json')), true);
        $counters_obj  = json_decode(file_get_contents(storage_path('/api/hero-data/hero-counters.json')), true);
        $synergies_obj = json_decode(file_get_contents(storage_path('/api/hero-data/hero-synergies.json')), true);
        $hero_maps_obj = json_decode(file_get_contents(storage_path('/api/hero-data/hero-maps.json')), true);
        $map_info_obj  = json_decode(file_get_contents(storage_path('/api/map-data/map-info.json')), true);

        // Find hero by slug
        $heroInfo = null;
        foreach ($heroes_obj as $h) {
            if (\Illuminate\Support\Str::slug($h['name']) === $hero) {
                $heroInfo = $h;
                break;
            }
        }
        if (!$heroInfo) {
            abort(404);
        }

        $heroName = $heroInfo['name'];
        $heroSlug = \Illuminate\Support\Str::slug($heroName);

        // Images
        $heroImg = null;
        foreach ($img_obj as $img) {
            if ($img['name'] === $heroName) {
                $heroImg = $img;
                break;
            }
        }

        // All hero images for lookup
        $allHeroImages = [];
        foreach ($img_obj as $img) {
            $allHeroImages[$img['name']] = $img;
        }

        // Tier per rank (7 competitive ranks only)
        $rankIcons = [
            'GrandMaster' => 'images/ranks/grand-master-icon.svg',
            'Master'      => 'images/ranks/master-icon.svg',
            'Diamond'     => 'images/ranks/diamond-icon.svg',
            'Platinum'    => 'images/ranks/platinum-icon.svg',
            'Gold'        => 'images/ranks/gold-icon.svg',
            'Silver'      => 'images/ranks/silver-icon.svg',
            'Bronze'      => 'images/ranks/bronze-icon.svg',
        ];
        $tierMap = [
            45 => ['letter' => 'S', 'color' => 'text-emerald-400'],
            35 => ['letter' => 'A', 'color' => 'text-lime-400'],
            25 => ['letter' => 'B', 'color' => 'text-sky-400'],
            15 => ['letter' => 'C', 'color' => 'text-amber-400'],
             5 => ['letter' => 'D', 'color' => 'text-rose-400'],
        ];

        $tiersByRank = [];
        foreach ($tiers_data as $rankData) {
            $rankName = $rankData['name'];
            if (!isset($rankIcons[$rankName])) continue;
            $val = $rankData['hero-tiers'][$heroName] ?? 5;
            $tiersByRank[] = [
                'rankName'   => $rankName,
                'rankIcon'   => $rankIcons[$rankName],
                'tierLetter' => $tierMap[$val]['letter'],
                'tierColor'  => $tierMap[$val]['color'],
            ];
        }

        // Synergies: this hero paired with others
        $synergyScores = $synergies_obj[$heroName] ?? [];
        arsort($synergyScores);
        $topSynergies  = array_slice($synergyScores, 0, 3, true);
        $bottomSynergy = array_reverse($synergyScores, true);
        $antiSynergies = array_slice($bottomSynergy, 0, 3, true);

        $topSynergiesList  = [];
        foreach ($topSynergies as $name => $score) {
            $topSynergiesList[] = ['name' => $name, 'img' => $allHeroImages[$name]['profile-img'] ?? null, 'score' => $score, 'slug' => \Illuminate\Support\Str::slug($name)];
        }
        $antiSynergiesList = [];
        foreach ($antiSynergies as $name => $score) {
            $antiSynergiesList[] = ['name' => $name, 'img' => $allHeroImages[$name]['profile-img'] ?? null, 'score' => $score, 'slug' => \Illuminate\Support\Str::slug($name)];
        }

        // Counters: heroes this hero beats (counters[$heroName][$other] high = this hero beats other)
        $heroCounterScores = $counters_obj[$heroName] ?? [];
        arsort($heroCounterScores);
        $heroCountersList = [];
        foreach (array_slice($heroCounterScores, 0, 3, true) as $name => $score) {
            $heroCountersList[] = ['name' => $name, 'img' => $allHeroImages[$name]['profile-img'] ?? null, 'score' => $score, 'slug' => \Illuminate\Support\Str::slug($name)];
        }

        // Countered by: heroes that beat this hero (counters[$other][$heroName] high = other beats this hero)
        $counteredByScores = [];
        foreach ($counters_obj as $otherName => $matchups) {
            if ($otherName === $heroName) continue;
            if (isset($matchups[$heroName])) {
                $counteredByScores[$otherName] = $matchups[$heroName];
            }
        }
        arsort($counteredByScores);
        $counteredByList = [];
        foreach (array_slice($counteredByScores, 0, 3, true) as $name => $score) {
            $counteredByList[] = ['name' => $name, 'img' => $allHeroImages[$name]['profile-img'] ?? null, 'score' => $score, 'slug' => \Illuminate\Support\Str::slug($name)];
        }

        // Maps: only onPool maps
        $onPoolMaps = [];
        foreach ($map_info_obj as $mapInfo) {
            if ($mapInfo['onPool']) $onPoolMaps[] = $mapInfo['name'];
        }

        $mapScores = [];
        $heroMapData = $hero_maps_obj[$heroName] ?? [];
        foreach ($onPoolMaps as $mapName) {
            $score = $heroMapData['Maps'][$mapName] ?? null;
            if ($score === null) {
                // Fallback: average attack scores
                if (isset($heroMapData['Attack'][$mapName])) {
                    $vals  = array_values($heroMapData['Attack'][$mapName]);
                    $score = (int)(round(array_sum($vals) / count($vals) / 10) * 10);
                } else {
                    foreach (['Push', 'Control', 'Flashpoint', 'Clash'] as $key) {
                        if (isset($heroMapData[$key][$mapName])) {
                            $vals  = array_values($heroMapData[$key][$mapName]);
                            $score = (int)(round(array_sum($vals) / count($vals) / 10) * 10);
                            break;
                        }
                    }
                }
            }
            if ($score !== null) {
                $mapScores[$mapName] = $score;
            }
        }
        arsort($mapScores);
        $bestMaps  = array_slice($mapScores, 0, 3, true);
        $worstMaps = array_slice(array_reverse($mapScores, true), 0, 3, true);

        $roleLabel = $heroInfo['general_rol'];
        $seo = [
            'title'          => "{$heroName} Overwatch Guide – Counters, Synergies, Tiers & Maps",
            'keywords'       => "{$heroName} counters overwatch, {$heroName} synergies overwatch, {$heroName} tier list overwatch, best heroes with {$heroName}, {$heroName} best maps overwatch, how to counter {$heroName}, {$heroName} overwatch guide, {$heroName} overwatch competitive, {$heroName} {$roleLabel} overwatch",
            'description'    => "Complete {$heroName} guide for Overwatch: best counters, synergies, tier by rank, and best maps. Find out how to play {$heroName} in competitive.",
            'og_title'       => "{$heroName} Overwatch Guide – Counters, Synergies & Tier List",
            'og_description' => "Find the best counters, synergies, and maps for {$heroName} in Overwatch competitive play.",
            'og_url'         => "https://overpicker.win/heroes/{$heroSlug}",
            'og_image'       => $heroImg ? ('https://overpicker.win/' . $heroImg['art-img']) : null,
        ];

        return view('hero', [
            'title'            => " - {$heroName}",
            'dates'            => $this->DATES,
            'heroInfo'         => $heroInfo,
            'heroImg'          => $heroImg,
            'heroSlug'         => $heroSlug,
            'tiersByRank'      => $tiersByRank,
            'topSynergies'     => $topSynergiesList,
            'antiSynergies'    => $antiSynergiesList,
            'heroCounters'     => $heroCountersList,
            'counteredBy'      => $counteredByList,
            'bestMaps'         => $bestMaps,
            'worstMaps'        => $worstMaps,
            'seo'              => $seo,
        ]);
    }

    public function sitemap()
    {
        $urls = [
            ['loc' => 'https://overpicker.win/', 'priority' => '1.0', 'changefreq' => 'weekly'],
            ['loc' => 'https://overpicker.win/tiers', 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['loc' => 'https://overpicker.win/heroes', 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['loc' => 'https://overpicker.win/counters', 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['loc' => 'https://overpicker.win/synergies', 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['loc' => 'https://overpicker.win/maps', 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['loc' => 'https://overpicker.win/about', 'priority' => '0.5', 'changefreq' => 'monthly'],
            ['loc' => 'https://overpicker.win/sources', 'priority' => '0.5', 'changefreq' => 'monthly'],
            ['loc' => 'https://overpicker.win/privacy', 'priority' => '0.3', 'changefreq' => 'yearly'],
            ['loc' => 'https://overpicker.win/trackers', 'priority' => '0.3', 'changefreq' => 'monthly'],
        ];

        $heroes_obj = json_decode(file_get_contents(storage_path('/api/hero-data/hero-info.json')), true);
        foreach ($heroes_obj as $hero) {
            $urls[] = [
                'loc'        => 'https://overpicker.win/heroes/' . \Illuminate\Support\Str::slug($hero['name']),
                'priority'   => '0.8',
                'changefreq' => 'weekly',
            ];
        }

        return response()->view('sitemap', ['urls' => $urls])
            ->header('Content-Type', 'application/xml');
    }
}

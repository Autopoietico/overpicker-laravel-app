<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;

class OverpickerController extends BaseController
{
    public function home()
    {
        $seo = [
            'title'          => 'Overpicker – Overwatch Hero Picker & Team Composition Calculator',
            'keywords'       => 'overwatch hero picker, overwatch counter picker, overwatch team composition calculator, overwatch comp builder, overwatch draft tool, overwatch hero recommendation tool, overwatch composition analyzer, overwatch, best heroes, counters, synergies, pick, overpicker, composition, heropicker, maps, tiers',
            'description'    => 'Overpicker is an advanced Overwatch hero picker that analyzes team compositions, counters, and synergies to help you choose the best hero for competitive play.',
            'og_title'       => 'Overpicker – Overwatch Hero Picker & Team Composition Calculator',
            'og_description' => 'Overpicker is an advanced Overwatch hero picker that analyzes team compositions, counters, and synergies to help you choose the best hero for competitive play.',
            'og_url'         => 'https://overpicker.com/',
        ];

        return view('calculator', [
            'title' => ' – Overwatch Hero Picker & Team Composition Calculator',
            'dates' => $this->DATES,
            'seo'   => $seo,
        ]);
    }

    public function tiers()
    {
        $tierValues = [
            [45, View::make('components.tiers.tier-s')],
            [35, View::make('components.tiers.tier-a')],
            [25, View::make('components.tiers.tier-b')],
            [15, View::make('components.tiers.tier-c')],
            [5,  View::make('components.tiers.tier-d')],
        ];

        $heroes_obj = json_decode(file_get_contents(storage_path('/api/hero-data/hero-info.json')), true);
        $tiers_data = json_decode(file_get_contents(storage_path('/api/hero-data/hero-tiers.json')), true);
        $img_obj    = json_decode(file_get_contents(storage_path('/api/hero-data/hero-img.json')), true);

        $hero_images = [];
        foreach ($img_obj as $img) {
            $hero_images[$img['name']] = $img['profile-img'];
        }

        $rankIcons = [
            'GrandMaster' => 'images/ranks/grand-master-icon.svg',
            'Master'      => 'images/ranks/master-icon.svg',
            'Diamond'     => 'images/ranks/diamond-icon.svg',
            'Emerald'     => 'images/ranks/emerald-icon.svg',
            'Platinum'    => 'images/ranks/platinum-icon.svg',
            'Gold'        => 'images/ranks/gold-icon.svg',
            'Silver'      => 'images/ranks/silver-icon.svg',
            'Bronze'      => 'images/ranks/bronze-icon.svg',
        ];

        $allRanks = [];
        foreach ($tiers_data as $rankData) {
            $rankName = $rankData['name'];
            if (!isset($rankIcons[$rankName])) continue;
            $rankHeroes = [];
            foreach ($heroes_obj as $hero) {
                $name      = $hero['name'];
                $tierValue = $rankData['hero-tiers'][$name] ?? null;
                if (!$tierValue) continue;
                $rankHeroes[] = [
                    'name'        => $name,
                    'role'        => $hero['general_rol'],
                    'description' => $hero['description'],
                    'value'       => $tierValue,
                    'img'         => $hero_images[$name] ?? null,
                    'slug'        => \Illuminate\Support\Str::slug($name),
                ];
            }
            usort($rankHeroes, fn($a, $b) => $b['value'] <=> $a['value']);
            $allRanks[] = [
                'name'   => $rankName,
                'icon'   => $rankIcons[$rankName],
                'heroes' => $rankHeroes,
            ];
        }

        // Load "All Ranks" and "Community Ranking" entries from the JSON
        $allRanksEntry  = collect($tiers_data)->firstWhere('name', 'All Ranks');
        $communityEntry = collect($tiers_data)->firstWhere('name', 'Community Ranking');

        $buildHeroList = function (?array $entry) use ($heroes_obj, $hero_images): array {
            if (!$entry) return [];
            $list = [];
            foreach ($heroes_obj as $hero) {
                $name      = $hero['name'];
                $tierValue = $entry['hero-tiers'][$name] ?? null;
                if (!$tierValue) continue;
                $list[] = [
                    'name'        => $name,
                    'role'        => $hero['general_rol'],
                    'description' => $hero['description'],
                    'value'       => $tierValue,
                    'img'         => $hero_images[$name] ?? null,
                    'slug'        => \Illuminate\Support\Str::slug($name),
                ];
            }
            usort($list, fn($a, $b) => $b['value'] <=> $a['value']);
            return $list;
        };

        $allRanksHeroes  = $buildHeroList($allRanksEntry);
        $communityHeroes = $buildHeroList($communityEntry);

        $rankKeywords = [];
        foreach ($tiers_data as $rank) {
            $rankKeywords[] = 'best heroes in ' . strtolower($rank['name']) . ' Overwatch';
        }

        $seo = [
            'title'          => 'Overwatch Tier List All Ranks – GrandMaster to Bronze Meta',
            'keywords'       => 'overwatch tier list all ranks, overwatch tier list by rank, overwatch competitive ranks tier list, ' . implode(', ', $rankKeywords) . ', overwatch tier by rank, best heroes in low rank overwatch, best heroes in high rank overwatch',
            'description'    => 'Compare Overwatch hero tiers across every competitive rank — from GrandMaster to Bronze. See S, A, B, C, D rankings for each bracket and find the best heroes for your rank.',
            'og_title'       => 'Overwatch Tier List All Ranks – GrandMaster to Bronze Meta',
            'og_description' => 'Compare Overwatch hero tiers across all competitive ranks. Find the best heroes for GrandMaster, Master, Diamond, Platinum, Gold, Silver, and Bronze.',
            'og_url'         => 'https://overpicker.com/tiers',
        ];

        return view('tiers', [
            'title'             => ' - Tiers',
            'dates'             => $this->DATES,
            'allRanks'        => $allRanks,
            'allRanksHeroes'  => $allRanksHeroes,
            'communityHeroes' => $communityHeroes,
            'tierValues'        => $tierValues,
            'seo'               => $seo,
        ]);
    }

    public function counters()
    {
        $heroes_obj   = json_decode(file_get_contents(storage_path('/api/hero-data/hero-info.json')), true);
        $counters_obj = json_decode(file_get_contents(storage_path('/api/hero-data/hero-counters.json')), true);
        $img_obj      = json_decode(file_get_contents(storage_path('/api/hero-data/hero-img.json')), true);

        $hero_roles = [];
        foreach ($heroes_obj as $hero) {
            $hero_roles[$hero['name']] = $hero['general_rol'];
        }

        $hero_images = [];
        foreach ($img_obj as $img) {
            $hero_images[$img['name']] = $img['profile-img'];
        }

        $whoCountersKeywords = [];
        foreach ($heroes_obj as $hero) {
            $whoCountersKeywords[] = 'who counters ' . strtolower($hero['name']) . ' overwatch';
        }

        $seo = [
            'title'          => 'Overwatch Hero Counters Chart – Complete Counter Matrix',
            'keywords'       => 'overwatch counters list, overwatch hero counters chart, ' . implode(', ', $whoCountersKeywords) . ', overwatch matchup chart, overwatch counter matrix',
            'description'    => 'View the complete Overwatch hero counters chart with our interactive counter matrix. Understand the -20 to 20 scoring system to find which heroes counter your enemies and win more games.',
            'og_title'       => 'Overwatch Hero Counters Chart – Complete Counter Matrix',
            'og_description' => 'View the complete Overwatch hero counters chart with our interactive counter matrix. Understand the -20 to 20 scoring system to find which heroes counter your enemies.',
            'og_url'         => 'https://overpicker.com/counters',
        ];

        return view('counters', [
            'title'       => ' - Hero Counters',
            'dates'       => $this->DATES,
            'counters'    => $counters_obj,
            'hero_roles'  => $hero_roles,
            'hero_images' => $hero_images,
            'heroes'      => $heroes_obj,
            'seo'         => $seo,
        ]);
    }

    public function synergies()
    {
        $heroes_obj    = json_decode(file_get_contents(storage_path('/api/hero-data/hero-info.json')), true);
        $synergies_obj = json_decode(file_get_contents(storage_path('/api/hero-data/hero-synergies.json')), true);
        $img_obj       = json_decode(file_get_contents(storage_path('/api/hero-data/hero-img.json')), true);

        $hero_roles = [];
        foreach ($heroes_obj as $hero) {
            $hero_roles[$hero['name']] = $hero['general_rol'];
        }

        $hero_images = [];
        foreach ($img_obj as $img) {
            $hero_images[$img['name']] = $img['profile-img'];
        }

        $seo = [
            'title'          => 'Overwatch Hero Synergies – Best Hero Combinations',
            'keywords'       => 'overwatch hero synergies, best hero combinations overwatch, overwatch team synergy chart, overwatch comp synergy list, best duo picks overwatch, overwatch synergies, hero synergies, team synergy, overwatch combo, overwatch team composition',
            'description'    => 'Explore the Overwatch synergy chart to find the best hero combinations. Learn how the -20 to 20 scoring system works to build powerful team synergies and dominate your matches.',
            'og_title'       => 'Overwatch Hero Synergies – Best Hero Combinations',
            'og_description' => 'Explore the Overwatch synergy chart to find the best hero combinations. Learn how the -20 to 20 scoring system works to build powerful team synergies and dominate your matches.',
            'og_url'         => 'https://overpicker.com/synergies',
        ];

        return view('synergies', [
            'title'       => ' - Hero Synergies',
            'dates'       => $this->DATES,
            'synergies'   => $synergies_obj,
            'hero_roles'  => $hero_roles,
            'hero_images' => $hero_images,
            'heroes'      => $heroes_obj,
            'seo'         => $seo,
        ]);
    }

    public function maps()
    {
        $heroes_obj    = json_decode(file_get_contents(storage_path('/api/hero-data/hero-info.json')), true);
        $img_obj       = json_decode(file_get_contents(storage_path('/api/hero-data/hero-img.json')), true);
        $hero_maps_obj = json_decode(file_get_contents(storage_path('/api/hero-data/hero-maps.json')), true);
        $map_info_obj  = json_decode(file_get_contents(storage_path('/api/map-data/map-info.json')), true);

        $hero_roles = [];
        foreach ($heroes_obj as $hero) {
            $hero_roles[$hero['name']] = $hero['general_rol'];
        }

        $hero_images = [];
        foreach ($img_obj as $img) {
            $hero_images[$img['name']] = $img['profile-img'];
        }

        $dual_types = ['Assault', 'Escort', 'Hybrid'];
        $single_key = [
            'Push'       => 'Push',
            'Control'    => 'Control',
            'Flashpoint' => 'Flashpoint',
            'Clash'      => 'Clash',
        ];

        $processed_data = [];
        $map_list       = [];

        foreach ($map_info_obj as $mapInfo) {
            if (!$mapInfo['onPool']) continue;

            $mapName = $mapInfo['name'];
            $mapType = $mapInfo['type'];
            $points  = $mapInfo['points'];
            $isDual  = in_array($mapType, $dual_types);

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
            'og_url'         => 'https://overpicker.com/maps',
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
}

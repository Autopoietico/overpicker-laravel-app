<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class HeroController extends BaseController
{
    public function heroes()
    {
        $TOP_RANK_INDEX = 0;

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
                'slug'  => Str::slug($hero['name']),
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
            'title'       => ' - Heroes',
            'dates'       => $this->DATES,
            'tiers'       => $sorted_heroes,
            'tierValues'  => $tierValues,
            'topRankName' => $topRankName,
            'seo'         => $seo,
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
            if (Str::slug($h['name']) === $hero) {
                $heroInfo = $h;
                break;
            }
        }
        if (!$heroInfo) {
            abort(404);
        }

        $heroName = $heroInfo['name'];
        $heroSlug = Str::slug($heroName);

        // Images
        $heroImg       = null;
        $allHeroImages = [];
        foreach ($img_obj as $img) {
            $allHeroImages[$img['name']] = $img;
            if ($img['name'] === $heroName) {
                $heroImg = $img;
            }
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

        // Synergies
        $synergyScores = $synergies_obj[$heroName] ?? [];
        arsort($synergyScores);
        $topSynergiesList = [];
        foreach (array_slice($synergyScores, 0, 3, true) as $name => $score) {
            $topSynergiesList[] = ['name' => $name, 'img' => $allHeroImages[$name]['profile-img'] ?? null, 'score' => $score, 'slug' => Str::slug($name)];
        }
        $antiSynergiesList = [];
        foreach (array_slice(array_reverse($synergyScores, true), 0, 3, true) as $name => $score) {
            $antiSynergiesList[] = ['name' => $name, 'img' => $allHeroImages[$name]['profile-img'] ?? null, 'score' => $score, 'slug' => Str::slug($name)];
        }

        // Counters: heroes this hero beats
        $heroCounterScores = $counters_obj[$heroName] ?? [];
        arsort($heroCounterScores);
        $heroCountersList = [];
        foreach (array_slice($heroCounterScores, 0, 3, true) as $name => $score) {
            $heroCountersList[] = ['name' => $name, 'img' => $allHeroImages[$name]['profile-img'] ?? null, 'score' => $score, 'slug' => Str::slug($name)];
        }

        // Countered by: heroes that beat this hero
        $counteredByScores = [];
        foreach ($counters_obj as $otherName => $matchups) {
            if ($otherName !== $heroName && isset($matchups[$heroName])) {
                $counteredByScores[$otherName] = $matchups[$heroName];
            }
        }
        arsort($counteredByScores);
        $counteredByList = [];
        foreach (array_slice($counteredByScores, 0, 3, true) as $name => $score) {
            $counteredByList[] = ['name' => $name, 'img' => $allHeroImages[$name]['profile-img'] ?? null, 'score' => $score, 'slug' => Str::slug($name)];
        }

        // Maps: only onPool maps
        $mapScores   = [];
        $heroMapData = $hero_maps_obj[$heroName] ?? [];
        foreach ($map_info_obj as $mapInfo) {
            if (!$mapInfo['onPool']) continue;
            $mapName = $mapInfo['name'];
            $score   = $heroMapData['Maps'][$mapName] ?? null;
            if ($score === null) {
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
            'title'         => " - {$heroName}",
            'dates'         => $this->DATES,
            'heroInfo'      => $heroInfo,
            'heroImg'       => $heroImg,
            'heroSlug'      => $heroSlug,
            'tiersByRank'   => $tiersByRank,
            'topSynergies'  => $topSynergiesList,
            'antiSynergies' => $antiSynergiesList,
            'heroCounters'  => $heroCountersList,
            'counteredBy'   => $counteredByList,
            'bestMaps'      => $bestMaps,
            'worstMaps'     => $worstMaps,
            'seo'           => $seo,
        ]);
    }
}
